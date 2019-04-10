<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Report;
use App\ReportType;
use App\Department;
use Validator;
use DB;
use Excel;
use App\Exports\ReportsExport;
use App\ReportMeta;

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

            $report_meta_period = ReportMeta::where('report_id', $id)->where('meta_name', 'period')->first();
            if ($report_meta_period) {
                $report_meta_period = json_decode($report_meta_period->meta_value);
            }

            $report_meta_last_year = ReportMeta::where('report_id', $id)->where('meta_name', 'last_year')->first();
            if ($report_meta_last_year) {
                $report_meta_last_year = $report_meta_last_year->meta_value;
            }

            $report_meta_dispatch_date = ReportMeta::where('report_id', $id)->where('meta_name', 'dispatch_date')->first();
            if ($report_meta_dispatch_date) {
                $report_meta_dispatch_date = $report_meta_dispatch_date->meta_value;
            }

            $departments_selected = array();
            $departmentInstance_selected = DB::table('department_report')->where('report_id', $id)->get(['department_id']);
            if ($departmentInstance_selected) {
                foreach ($departmentInstance_selected as $item) {
                    $departments_selected[] = $item->department_id;
                }
            }

            $report_metas = json_decode(json_encode(array('period' => $report_meta_period, 'last_year' => $report_meta_last_year, 'dispatch_date' => $report_meta_dispatch_date, 'departments' => $departments_selected)));

            if ($departments_selected) {
                $departments = Department::where('parent', 0)->whereNotIn('id', $departments_selected)->get();
            } else {
                $departments = Department::where('parent', 0)->get();
            }

            return view('admin.report.edit', compact(['id', 'report', 'report_types', 'report_metas', 'departments']));
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

    public function showDepartments(Request $request)
    {
        if ($request->departments_add) {
            $ids_ordered = implode(',', $request->departments_add);
            $departments_add = Department::where('parent', 0)->whereIn('id', $request->departments_add)->orderByRaw(DB::raw("FIELD(id, $ids_ordered)"))->get();
        } else {
            $departments_add = [];
        }

        if ($request->departments_remove) {
            $departments_remove = Department::where('parent', 0)->whereIn('id', $request->departments_remove)->get();
        } else {
            $departments_remove = [];
        }

        return response()->json(['departments_add' => $departments_add, 'departments_remove' => $departments_remove]);
        
    }

    public function export($id)
    {
        return Excel::download(new ReportsExport($id), 'report.xlsx');
        
    }

    public function addReportMeta(Request $request, $id)
    {
        $rules = [
            'period_from' => 'required',
            'period_to'   => 'required|gt:period_from',
            'last_year'   => 'required|lte:period_to|gt:period_from',
            'dispatch_date' => 'required'
        ];

        $messages = [
            'period_from.required' => 'Period from is required!',
            'period_to.required' => 'Period to is required!',
            'last_year.required' => 'Last year is required!',
            'dispatch_date.required' => 'Dispatch date is required!',
            'period_to.gt' => 'Period to must greater than Period from',
            'last_year.lte' => 'Last year must less than or equal Period to',
            'last_year.gt' => 'Last year to must greater than Period from',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator)->withInput();
            
        }
        

        $period = json_encode(array('period_from' => $request->period_from, 'period_to' =>$request->period_to));

        ReportMeta::updateOrCreate(
            ['report_id' => $id, 'meta_name' => 'period'],
            ['meta_value' => $period]
        );

        ReportMeta::updateOrCreate(
            ['report_id' => $id, 'meta_name' => 'last_year'],
            ['meta_value' => $request->last_year]
        );

        ReportMeta::updateOrCreate(
            ['report_id' => $id, 'meta_name' => 'dispatch_date'],
            ['meta_value' => $request->dispatch_date]
        );

        $report = Report::find($id);
        $allDepartments = array();
        if ($report) {
            $allDepartmentsInstance = $report->departments()->get(['department_id']);
            if ($allDepartmentsInstance) {
                foreach ($allDepartmentsInstance as $item) {
                    $allDepartments[] = $item->department_id;
                }
            }
        }
        $departments = $request->departments;
        if ($departments) {
            foreach ($departments as $department) {
                $key = 'money_source_'.$department;
                $hasDepartment = Department::whereHas('reports', function($q) use ($id) {
                    $q->where('report_id', $id);
                })->where('id', $department)->first();
                if ($hasDepartment) {
                    $hasDepartment->reports()->updateExistingPivot($id, ['value' => json_encode($request->$key)]);
                } else {
                    $departmentInstance = Department::find($department);
                    $departmentInstance->reports()->attach($id, ['value' => json_encode($request->$key)]);
                }
            }

            if ($allDepartments) {
                foreach ($allDepartments as $item) {
                    if (!in_array($item, $departments)) {
                        $report->departments()->detach([$item]);
                    }
                }
            }
        } else {
            if ($allDepartments) { 
                $report->departments()->detach();
            }
        }

        $request->session()->flash('success', 'Save report meta successful.');
        
        return redirect()->back()->withInput();
        
    }
}
