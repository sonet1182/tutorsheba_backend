<?php

namespace App\Http\Controllers\Admin\searchManage;

use App\Http\Controllers\Controller;
use App\Models\salaryRange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SalaryRangeController extends Controller
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

        $salaryrange = salaryRange::all();
        return view('admin.layout.searchmanage.salary-range.index', compact('salaryrange'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.layout.searchmanage.salary-range.create');
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

        $salary = new salaryRange();
        $salary-> salaryRange = $request->name;
        $salary->save();

        return back()->with('status','New Salary Range Added!');
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
        $salaryrange = salaryRange::findOrFail($id);

        return view('admin/layout/searchmanage.salary-range.show', compact('salaryrange'));
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
        $salaryrange = salaryRange::findOrFail($id);

        return view('admin.layout.searchmanage.salary-range.edit', compact('salaryrange'));
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
        $salary = salaryRange::findOrFail($id);
        $salary-> salaryRange = $request->name;
        $salary->save();

        return back()->with('status','Salary Range Updated!');
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
        salaryRange::destroy($id);

        return back()->with('status','Salary Range Removed!');
    }
}
