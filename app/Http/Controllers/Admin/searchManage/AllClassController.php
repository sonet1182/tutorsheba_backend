<?php

namespace App\Http\Controllers\Admin\searchManage;

use App\Http\Controllers\Controller;
use App\Models\AllMedium;
use App\Models\AnyClass;
use Illuminate\Http\Request;

class AllClassController extends Controller
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

        return view('admin.layout.searchmanage.any-class.create', compact('allmedium'));
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
        $area = new AnyClass();
        $area->medium_id = $request->medium_id;
        $area->className = $request->name;
        $area->save();

        return back()->with('status','New Class added!');
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

        return view('admin.layout.searchmanage.any-class.show', compact('anyclass'));
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

        return view('admin.layout.searchmanage.any-class.edit', compact('anyclass', 'allmedium'));
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
        $allclass = AnyClass::findOrFail($id);
        $allclass->medium_id = $request->medium_id;
        $allclass->className = $request->name;
        $allclass->update();

        return back()->with('status','Class Updated!');
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

        return back()->with('status','Class Removed!');
    }
}

