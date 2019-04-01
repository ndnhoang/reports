<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Role;
use Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        auth()->guard('admin')->user()->authorizeRoles(['sadmin']);
        
        $admins = Admin::all();

        return view('admin.admin.index')->with('admins', $admins);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        auth()->guard('admin')->user()->authorizeRoles(['sadmin']);

        $roles = Role::all();
        
        return view('admin.admin.add')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        auth()->guard('admin')->user()->authorizeRoles(['sadmin']);

        $rules = ['username' => 'required|unique:admins|max:100|regex:/^\S*$/u'];

        $messages = [
            'username.required' => 'Username is required!',
            'username.unique' => 'Username already exists!',
            'username.max' => 'Username is too long, maximum 100 character!',
            'username.regex' => 'Username don\'t allow white spaces!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator)->withInput();
            
        }

        $admin = new Admin;

        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);

        $admin->save();

        $admin->roles()->attach($request->role);

        $request->session()->flash('success', 'Add admin successful.');
        
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
        auth()->guard('admin')->user()->authorizeRoles(['sadmin']);
        
        $admin = Admin::find($id);

        if ($admin) {
            return view('admin.admin.reset-password', compact(['id', 'admin']));
        } else {
            $admins = Admin::all();

            return redirect()->route('admin.admin')->with('admins', $admins);
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
        auth()->guard('admin')->user()->authorizeRoles(['sadmin']);
        
        $admin = Admin::find($id);
        
        $admin->password = Hash::make($request->password);

        $admin->save();

        $request->session()->flash('success', 'Reset password for Admin "'.$admin->username.'" successful.');

        $admins = Admin::all();

        return redirect()->route('admin.admin')->with('admins', $admins);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        auth()->guard('admin')->user()->authorizeRoles(['sadmin']);

        $admin = Admin::find($id);

        $admin->delete();
        
        $request->session()->flash('success', 'Delete admin "'.$admin->username.'" successful.');

        $admins = Admin::all();

        return redirect()->back()->with('admins', $admins);
        
    }

    public function generatePassword()
    {
        auth()->guard('admin')->user()->authorizeRoles(['sadmin']);

        return response()->json(str_random(8));
    }
}
