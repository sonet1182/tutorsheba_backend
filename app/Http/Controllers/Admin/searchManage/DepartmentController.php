<?php

namespace App\Http\Controllers\Admin\searchManage;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Studytype;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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

            $department = Department::all();


        return view('admin.layout.searchmanage.department.index', compact('department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $types = Studytype::all();
        return view('admin.layout.searchmanage.department.create', compact('types'));
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

        $department = new Department();
        $department->type_id = $request->type_id;
        $department->name = $request->name;
        $department->save();

        return back()->with('status','Department added!');
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
        $department = Department::findOrFail($id);

        return view('admin.layout.searchmanage.department.show', compact('department'));
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
        $department = Department::findOrFail($id);
        $types = Studytype::all();

        return view('admin.layout.searchmanage.department.edit', compact('department','types'));
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

        $department = Department::find($id);
        $department->type_id = $request->type_id;
        $department->name = $request->name;
        $department->save();

        return back()->with('status','Department Updated!');
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
        Department::destroy($id);

        return back()->with('status','Department Deleted');
    }
}
