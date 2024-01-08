<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReplyContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function contact(){
        $contact = DB::table('contact_us')->orderBy('id', 'DESC')->get();
        return view('admin.layout.contact',compact('contact'));
    }
    public function contactDelete($id){
        Contact::destroy($id);
        return back()->with('message','Contact Messege deleted');
    }
    public function reply(Request $request){
       if ($request->contactMail){
           $data = array(
             'subject' => $request->contactSubject,
              'email'  => $request->contactMail,
              'comment'  => $request->contactComment,
           );
       Mail::send('email.contactReply', $data, function ($message) use ($data){
           $message->to($data['email']);
           $message->subject($data['subject']);
           $message->from('info@hometutorjobs.com');
//           $message->comment($data['comment']);
       });
       }else{
         return  back()->with('message','email not found');
       }
        return  back()->with('message','E-Mail Successfully send');
    }
}
