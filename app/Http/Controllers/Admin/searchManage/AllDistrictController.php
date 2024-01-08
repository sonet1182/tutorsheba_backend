<?php

namespace App\Http\Controllers\Admin\searchManage;

use App\Http\Controllers\Controller;
use App\Models\AllDistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AllDistrictController extends Controller
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
    public function index(Request $request)
    {
        $alldistricts = AllDistrict::all();

        return view('admin.layout.searchmanage.all-districts.index', compact('alldistricts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.layout.searchmanage.all-districts.create');
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
        $district = new AllDistrict();
        $district->districtName = $request->name;
        $district->save();

        return back()->with('status','District added!');
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
        $alldistrict = AllDistrict::findOrFail($id);

        return view('admin/layout/searchmanage.all-districts.show', compact('alldistrict'));
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
        $alldistrict = AllDistrict::findOrFail($id);

        return view('admin.layout.searchmanage.all-districts.edit', compact('alldistrict'));
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

        $district = AllDistrict::findOrFail($id);
        $district->districtName = $request->name;
        $district->save();

        return back()->with('status','District Updated!');
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
        AllDistrict::destroy($id);

        return back()->with('status','District Removed!');
    }
}
