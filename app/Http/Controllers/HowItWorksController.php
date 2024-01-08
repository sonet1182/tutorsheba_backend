<?php

namespace App\Http\Controllers;

use App\Models\HowItWorksData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HowItWorksController extends Controller
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
        $howitworks_data = HowItWorksData::all();

        return view('admin/layout/management.howitworks-data.index', compact('howitworks_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin/layout/management.howitworks-data.create');
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

        HowItWorksData::create($requestData);

        Session::flash('flash_message', 'How It Works Added Successfully!');

        return redirect('admin/howitworks-data');
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
        $howitworks_data = HowItWorksData::findOrFail($id);

        return view('admin/layout/management.howitworks-data.show', compact('howitworks_data'));
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
        $howitworks_data = HowItWorksData::findOrFail($id);

        return view('admin/layout/management.howitworks-data.edit', compact('howitworks_data'));
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

        $howitworks_data = HowItWorksData::findOrFail($id);
        $howitworks_data->update($requestData);

        Session::flash('flash_message', 'How It Works Updated Successfully!');

        return redirect('admin/howitworks-data');
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
        HowItWorksData::destroy($id);

        Session::flash('flash_message', 'How It Works Deleted!');

        return redirect('admin/howitworks-data');
    }
}

