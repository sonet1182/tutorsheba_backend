<?php

namespace App\Http\Controllers\Admin\searchManage;

use App\Http\Controllers\Controller;
use App\Models\AllMedium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AllMediumController extends Controller
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

            $allmedium = AllMedium::all();

        return view('admin.layout.searchmanage.all-medium.index', compact('allmedium'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.layout.searchmanage.all-medium.create');
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
        $media = new AllMedium();
        $media->mediumName = $request->name;
        $media->save();

        return back()->with('status','New Medium added!');
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
        $allmedium = AllMedium::findOrFail($id);

        return view('admin/layout/searchmanage.all-medium.show', compact('allmedium'));
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
        $allmedium = AllMedium::findOrFail($id);

        return view('admin.layout.searchmanage.all-medium.edit', compact('allmedium'));
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
        $allmedium = AllMedium::findOrFail($id);
        $allmedium->mediumName = $request->name;
        $allmedium->update();

        return back()->with('status','Medium Updated!');
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
        AllMedium::destroy($id);

        return back()->with('status','Medium Removed!');
    }
}
