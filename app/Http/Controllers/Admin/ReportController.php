<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Report;
use App\ReportType;
use Validator;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::all();

        return view('admin.report.index')->with('reports', $reports);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $report_types = ReportType::all();

        return view('admin.report.add')->with('report_types', $report_types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ['name' => 'required'];

        $messages = [
            'name.required' => 'Report name is required!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator)->withInput();
            
        }

        $report = new Report;
        
        $report->name = $request->name;
        $report->status = ($request->status == 'on') ? true : false;

        $report_type = ReportType::find($request->type);

        $report_type->reports()->save($report);
        
        $request->session()->flash('success', 'Add report successful.');
        
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
        $report = Report::find($id);

        if ($report) {
            $report_types = ReportType::all();

            return view('admin.report.edit', compact(['id', 'report', 'report_types']));
        } else {
            $reports = Report::all();
            
            return redirect()->route('admin.report')->with('reports', $reports);
            
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
        $rules = ['name' => 'required'];

        $messages = [
            'name.required' => 'Report name is required!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator)->withInput();
            
        }

        $report = Report::find($id);

        $report->name = $request->name;
        $report->status = ($request->status == 'on') ? true : false;

        $report->save();

        $report_type = ReportType::find($request->type);

        $report_type->reports()->save($report);
        
        $request->session()->flash('success', 'Edit report successful.');
        
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
        $report = Report::find($id);
        
        $report->delete();
        
        $request->session()->flash('success', 'Delete Report "'.$report->name.'" successful.');
        
        $reports = Report::all();

        return redirect()->route('admin.report')->with('reports', $reports);
        
    }
}
