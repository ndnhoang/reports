<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\ReportMeta;
use App\Department;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        return view('home', ['user' => $user]);
    }

    public function saveReportData(Request $request)
    {
        $departmentParent = 0;
        $report_id = $request->report;
        $departments = $request->departments;
        $value_data = array();
        if ($departments) {
            foreach ($departments as $key => $department) {
                if ($key == 0) {
                    $departmentParent = $department;
                }
                
                $strRequest = 'detail_'.$department;
                $department_detail = $request->$strRequest;
                $department_data = array('detail' => $department_detail);
                
                $report_meta_period = ReportMeta::where('report_id', $report_id)->where('meta_name', 'period')->first();
                if ($report_meta_period) {
                    $report_meta_period = json_decode($report_meta_period->meta_value);
                }

                $report_meta_last_year = ReportMeta::where('report_id', $report_id)->where('meta_name', 'last_year')->first();
                if ($report_meta_last_year) {
                    $report_meta_last_year = $report_meta_last_year->meta_value;
                }

                if ($report_meta_period && $report_meta_period->period_from && $report_meta_last_year) {
                    for ($i = $report_meta_period->period_from; $i <= $report_meta_last_year; $i++) {
                        $strRequest_KH = 'KH'.$i.'_'.$department;
                        $moneySource_KH = $request->$strRequest_KH;
                        $strRequest_TH = 'TH'.$i.'_'.$department;
                        $moneySource_TH = $request->$strRequest_TH;
                        $moneySource =  array('kh' => $moneySource_KH, 'th' => $moneySource_TH);
                        $department_data = array_merge($department_data, array('year_'.$i => $moneySource));
                    }
                }

                $value_data[$department] = $department_data;
            }
        }
        
        $hasDepartment = Department::whereHas('reports', function($q) use ($report_id) {
            $q->where('report_id', $report_id);
        })->where('id', $departmentParent)->first();
        if ($hasDepartment) {
            $hasDepartment->reports()->updateExistingPivot($report_id, ['value_data' => json_encode($value_data)]);
        } else {
            $departmentInstance = Department::find($departmentParent);
            $departmentInstance->reports()->attach($report_id, ['value_data' => json_encode($value_data)]);
        }

        $request->session()->flash('success', "Save data successful.");
        
        return redirect()->back();
        
    }
}
