<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicyData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PrivacyPolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $howitworks_data = PrivacyPolicyData::all();

        return view('admin/layout/management.privacy-policy-data.index', compact('howitworks_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $privacypolicy_data = PrivacyPolicyData::first();

        return view('admin/layout/management.privacy-policy-data.create', compact('privacypolicy_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        PrivacyPolicyData::create($requestData);

        Session::flash('flash_message', 'How It Works Added Successfully!');

        return redirect('admin/privacy-policy-data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $privacypolicy_data = PrivacyPolicyData::findOrFail($id);

        return view('admin/layout/management.privacy-policy-data.show', compact('privacypolicy_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $privacypolicy_data = PrivacyPolicyData::findOrFail($id);

        return view('admin/layout/management.privacy-policy-data.edit', compact('privacypolicy_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $requestData = $request->all();

        $privacypolicy_data = PrivacyPolicyData::findOrFail($id);
        $privacypolicy_data->update($requestData);

        Session::flash('flash_message', 'Privacy Policy Updated Successfully!');

        return redirect('admin/privacy-policy');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        PrivacyPolicyData::destroy($id);

        Session::flash('flash_message', 'How It Works Deleted!');

        return redirect('admin/privacy-policy-data');
    }
}
