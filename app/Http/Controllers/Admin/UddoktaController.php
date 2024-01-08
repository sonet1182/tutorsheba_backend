<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Afftransaction;
use App\Models\Partner;
use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class UddoktaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function list()
    {
        $studentProfile = Partner::with('districts','areas')
            ->latest()->get();

        return view('admin.layout.partner.list',compact('studentProfile'));
    }

    public function details($id)
    {
        $partner = Partner::where('id',$id)->first();
        $leads = StudentProfile::where('lead_generator',$id)->latest()->get();

        return view('admin.layout.partner.details',compact('partner','leads'));
    }

    public function status($id)
    {
        $partner = Partner::where('id',$id)->first();

        if($partner->status == 1)
        {
            $partner->status = 0;
        }else{
            $partner->status = 1;
        }
        $partner->save();


        return Redirect()->back()->with('status', 'Status Updated!');
    }

    public function make_payment(Request $req, $id)
    {
        $lead = StudentProfile::where('id',$id)->first();
        $lead->lead_due = 0;
        $lead->save();

        $partner = Partner::find($lead->lead_generator);
        $partner->withdraw = $partner->withdraw + $lead->lead_comission;
        $partner->due = $partner->due - $lead->lead_comission;
        $partner->save();

        $txn = new Afftransaction();
        $txn->bank_type = $req->bank_type;
        $txn->acc_number = $req->acc_number;
        $txn->lead_generator = $lead->lead_generator;
        $txn->lead_id = $id;
        $txn->save();

        return Redirect()->back()->with('success', 'Payment Successfull!');
    }
}
