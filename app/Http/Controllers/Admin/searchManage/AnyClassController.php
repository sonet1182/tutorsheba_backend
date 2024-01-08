<?php

namespace App\Http\Controllers\Admin\searchManage;

use App\Http\Controllers\Controller;
use App\Models\AllMedium;
use App\Models\AnyClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnyClassController extends Controller
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
        $anyclass = AnyClass::with('all_media')->get();

        return view('admin.layout.searchmanage.any-class.index', compact('anyclass'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $allmedium = AllMedium::all();
        $dropdown =  $allmedium->pluck('mediumName', 'id');

        return view('admin/layout/searchmanage.any-class.create', compact('dropdown'));
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

        AnyClass::create($requestData);

        Session::flash('flash_message', 'AnyClass added!');

        return redirect('admin2/any-class');
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
        $anyclass = AnyClass::findOrFail($id);

        return view('admin/layout/searchmanage.any-class.show', compact('anyclass'));
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
        $anyclass = AnyClass::findOrFail($id);
        $allmedium = AllMedium::all();
        $dropdown =  $allmedium->pluck('mediumName', 'id');

        return view('admin/layout/searchmanage.any-class.edit', compact('anyclass', 'dropdown'));
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

        $anyclass = AnyClass::findOrFail($id);
        $anyclass->update($requestData);

        Session::flash('flash_message', 'AnyClass updated!');

        return redirect('admin2/any-class');
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
        AnyClass::destroy($id);

        Session::flash('flash_message', 'AnyClass deleted!');

        return redirect('admin2/any-class');
    }
}
