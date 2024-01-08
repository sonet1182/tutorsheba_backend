<?php

namespace App\Http\Controllers\Admin\searchManage;

use App\Http\Controllers\Controller;
use App\Models\AnyClass;
use App\Models\AnySubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AnySubjectController extends Controller
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
        $anysubject = DB::table('any_subjects as t1')
        ->select("t1.id", "t1.subjectName", "t2.className", "t3.mediumName" )
        ->leftjoin("any_classes AS t2", "t1.class_id", "=", "t2.id")
        ->leftjoin("all_media AS t3", "t2.medium_id", "=", "t3.id")
        ->get();

        return view('admin.layout.searchmanage.any-subject.index', compact('anysubject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $allclass = AnyClass::all();

        return view('admin.layout.searchmanage.any-subject.create', compact('allclass'));
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

        $subject = New AnySubject();
        $subject->class_id = $request->class_id;
        $subject->subjectName = $request->name;
        $subject->save();

        return back()->with('status','New Subject added!');
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
        $anysubject = AnySubject::select("any_subjects.id", "any_subjects.subjectName", "t2.className", "t3.mediumName" )
        ->leftjoin("any_classes AS t2", "any_subjects.class_id", "=", "t2.id")
        ->leftjoin("all_media AS t3", "t2.medium_id", "=", "t3.id")
        ->findOrFail($id);

        return view('admin/layout/searchmanage.any-subject.show', compact('anysubject'));
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
        $anysubject = AnySubject::findOrFail($id);
        $allclass = AnyClass::all();

        return view('admin.layout.searchmanage.any-subject.edit', compact('anysubject', 'allclass'));
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
        $subject = AnySubject::findOrFail($id);
        $subject->class_id = $request->class_id;
        $subject->subjectName = $request->name;
        $subject->save();


        return back()->with('status','Subject Updated!');
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
        AnySubject::destroy($id);

        return back()->with('status','Subject Removed!');
    }
}
