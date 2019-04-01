<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ReportType;

class ReportTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $report_types = ReportType::all();

        return view('admin.report-type.index')->with('report_types', $report_types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.report-type.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $report_type = new ReportType;

        $report_type->name = $request->type_name;
        $report_type->description = $request->description;

        $report_type->save();
        
        $request->session()->flash('success', 'Add Report type successful.');
        
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
        $report_type = ReportType::find($id);

        if ($report_type) {
            
            return view('admin.report-type.edit', compact(['id', 'report_type']));
            
        } else {
            $report_types = ReportType::all();
            
            return redirect()->route('admin.report.type')->with('report_types', $report_types);
            
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
        $report_type = ReportType::find($id);

        $report_type->name = $request->type_name;
        $report_type->description = $request->description;

        $report_type->save();
        
        $request->session()->flash('success', 'Edit Report type successful.');
        
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
        $report_type = ReportType::find($id);

        $report_type->delete();
        
        $request->session()->flash('success', 'Delete Report type "'.$report_type->name.'" successful.');

        $report_types = ReportType::all();
        
        return redirect()->back()->with('report_types', $report_types);
        
    }
}
