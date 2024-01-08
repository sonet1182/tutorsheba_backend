<?php

namespace App\Http\Controllers\Admin\searchManage;

use App\Http\Controllers\Controller;
use App\Models\Institype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InstTypeController extends Controller
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


        $institution_type = Institype::all();


        return view('admin.layout.searchmanage.institution_type.index', compact('institution_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.layout.searchmanage.institution_type.create');
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

        $institution_type = new Institype();
        $institution_type->name = $request->name;
        $institution_type->save();

        return back()->with('status', 'Institype added!');
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
        $institution_type = Institype::findOrFail($id);

        return view('admin.layout.searchmanage.institution_type.show', compact('institution_type'));
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
        $institution_type = Institype::findOrFail($id);

        return view('admin.layout.searchmanage.institution_type.edit', compact('institution_type'));
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

        $institution_type = Institype::find($id);
        $institution_type->name = $request->name;
        $institution_type->save();

        return back()->with('status', 'Institype Updated!');
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
        Institype::destroy($id);

        return back()->with('status', 'Institype Deleted');
    }
}
