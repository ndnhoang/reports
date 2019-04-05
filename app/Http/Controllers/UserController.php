<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|different:old_password',
            'confirm_password' => 'required|same:new_password',
        ];

        $messages = [
            'old_password.required' => 'Old Password is required!',
            'new_password.required' => 'New Password is required!',
            'confirm_password.required' => 'Confirm Password is required!',
            'new_password.different' => 'New Password must different Old Passowrd!',
            'confirm_password.same' => 'Confirm Password is incorrect!',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            $request->session()->flash('error', 'Old Password is incorrect!');
        } else {
            $user->password = Hash::make($request->new_password);
            $user->save();
            $request->session()->flash('success', 'Change Password successful.');
        }
        
        return redirect()->back();
    }
}
