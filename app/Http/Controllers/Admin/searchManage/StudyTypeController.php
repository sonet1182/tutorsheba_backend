<?php

namespace App\Http\Controllers\Admin\searchManage;

use App\Http\Controllers\Controller;
use App\Models\Studytype;
use Illuminate\Http\Request;

class StudyTypeController extends Controller
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

            $study_type = Studytype::all();


        return view('admin.layout.searchmanage.study_type.index', compact('study_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin/layout/searchmanage.study_type.create');
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

        $study_type = new Studytype();
        $study_type->name = $request->name;
        $study_type->save();

        return back()->with('status','Studytype added!');
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
        $study_type = Studytype::findOrFail($id);

        return view('admin.layout.searchmanage.study_type.show', compact('study_type'));
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
        $study_type = Studytype::findOrFail($id);

        return view('admin.layout.searchmanage.study_type.edit', compact('study_type'));
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

        $study_type = Studytype::find($id);
        $study_type->name = $request->name;
        $study_type->save();

        return back()->with('status','Studytype Updated!');
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
        Studytype::destroy($id);

        return back()->with('status','Studytype Deleted');
    }
}
