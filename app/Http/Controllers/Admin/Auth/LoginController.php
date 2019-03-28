<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\AdminUser;

class LoginController extends Controller
{
	protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.auth.login');
    }

    public function username() {
    	return 'username';
    }

    public function checkLogin(Request $request) {
    	$credentials = $request->only($this->username(), 'password');

    	$login = $credentials[$this->username()];

    	if (AdminUser::where($this->username(), $login)->count() > 0) {
    		if (Auth::attempt($credentials, $request->filled('remember'))) {
    			return redirect()->intended('admin.dashboard');
    		}
    	}
    }
}
