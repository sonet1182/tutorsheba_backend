<?php

namespace App\Http\Controllers\Admin\searchManage;

use App\Http\Controllers\Controller;
use App\Models\AllArea;
use App\Models\AllDistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AllAreaController extends Controller
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
        $allarea = AllArea::with('all_districts')->get();

        return view('admin.layout.searchmanage.all-area.index', compact('allarea'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $alldistricts = AllDistrict::all();

        return view('admin.layout.searchmanage.all-area.create', compact('alldistricts'));
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
        $area = new AllArea();
        $area->district_id = $request->district_id;
        $area->areaName = $request->name;
        $area->save();

        return back()->with('status','New Area added!');
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
        $allarea = AllArea::findOrFail($id);

        return view('admin/layout/searchmanage.all-area.show', compact('allarea'));
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
        $allarea = AllArea::findOrFail($id);
        $alldistricts = AllDistrict::all();

        return view('admin.layout.searchmanage.all-area.edit', compact('allarea', 'alldistricts'));
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
        $area = AllArea::findOrFail($id);
        $area->district_id = $request->district_id;
        $area->areaName = $request->name;
        $area->save();

        return back()->with('status','Area Updated!');
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
        AllArea::destroy($id);

        return back()->with('status','Area Removed!');
    }
}
