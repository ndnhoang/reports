<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
        $departments = $request->departments;
        if ($departments) {
            foreach ($departments as $department) {
                $strRequest = 'detail_'.$department;
                $department_detail = $request->$strRequest;
                
            }
        }
        
        return redirect()->back();
        
    }
}
