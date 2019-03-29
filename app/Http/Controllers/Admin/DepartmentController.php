<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$departments = Department::all();
        return view('admin.department.index')->with('departments', $departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$departments = Department::where('parent', 0)->get();

    	return view('admin.department.add')->with('departments', $departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department = new Department;
        $department->name = $request->name;
        $department->parent = $request->parent;

        if ($department->save()) {
        	$request->session()->flash('success', 'Add department successful.');
        } else {
        	$request->session()->flash('error', 'Add department failures!');
        }

        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allDepartments = Department::all();
    	$departments = Department::where('parent', 0)->where('id', '!=', $id)->get();

        $department = Department::find($id);
        if ($department) {
        	return view('admin.department.edit', compact(['id','department', 'departments']));
        } else {
        	return view('admin.department.index')->with('departments', $allDepartments);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $department = Department::find($id);

        $department->name = $request->name;
        $department->parent = $request->parent;

        if ($department->save()) {
        	$request->session()->flash('success', 'Edit department successful.');
        } else {
        	$request->session()->flash('error', 'Edit department failures!');
        }

        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $allDepartments = Department::all();

        $department = Department::find($id);

        $departments = Department::where('id', $id)->orWhere('parent', $id)->get();

        if ($departments) {
            $plucked = $departments->pluck('id');
            $plucked_name = $departments->pluck('name');

            if (Department::destroy($plucked->all())) {
                $request->session()->flash('success', 'Deleted '.count($plucked_name->all()).'  department(s): "'.implode(", ", $plucked_name->all()).'"');
            } else {
                $request->session()->flash('error', 'Delete department failures!');
            }
        }

        return redirect()->back()->with('departments', $allDepartments);
    }
}
