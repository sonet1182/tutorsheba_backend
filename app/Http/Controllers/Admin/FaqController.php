<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
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
        $faq_data = FaqData::all();

        return view('admin/layout/management.faq-data.index', compact('faq_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin/layout/management.faq-data.create');
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

        FaqData::create($requestData);

        Session::flash('flash_message', 'FAQ added!');

        return redirect('admin/faq-data');
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
        $faq_data = FaqData::findOrFail($id);

        return view('admin/layout/management.faq-data.show', compact('faq_data'));
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
        $faq_data = FaqData::findOrFail($id);

        return view('admin/layout/management.faq-data.edit', compact('faq_data'));
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

        $faq_data = FaqData::findOrFail($id);
        $faq_data->update($requestData);

        Session::flash('flash_message', 'Faq updated!');

        return redirect('admin/faq-data');
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
        FaqData::destroy($id);

        Session::flash('flash_message', 'Faq deleted!');

        return redirect('admin/faq-data');
    }
}
