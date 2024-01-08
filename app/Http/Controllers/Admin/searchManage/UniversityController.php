<?php

namespace App\Http\Controllers\Admin\searchManage;

use App\Http\Controllers\Controller;
use App\Models\Institype;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UniversityController extends Controller
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

        $university = University::all();

        return view('admin.layout.searchmanage.university.index', compact('university'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $types = Institype::all();

        return view('admin.layout.searchmanage.university.create',compact('types'));
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

        $university = new University();
        $university->type_id = $request->type_id;
        $university->university = $request->name;
        $university->save();

        return back()->with('status', 'University added!');
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
        $university = University::findOrFail($id);

        return view('admin.layout.searchmanage.university.show', compact('university'));
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
        $university = University::findOrFail($id);
        $types = Institype::all();

        return view('admin.layout.searchmanage.university.edit', compact('university', 'types'));
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

        $university = University::find($id);
        $university->type_id = $request->type_id;
        $university->university = $request->name;
        $university->save();

        return back()->with('status', 'University Updated!');
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
        University::destroy($id);

        return back()->with('status', 'University Deleted');
    }
}
