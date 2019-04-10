<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\AdminUser;

class LoginController extends Controller
{
    use AuthenticatesUsers;

	public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('dashboard');
        }
        return view('admin.auth.login');
    }

    public function username() {
    	return 'username';
    }

    public function login(Request $request) {
    	$credentials = $request->only($this->username(), 'password');

    	$login = $credentials[$this->username()];

		if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
			return redirect()->route('dashboard');
		} else {
            $request->session()->flash('msg', "Username or Password is incorrect!");
            return redirect()->back()->withInput();
        }
    }

     /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        return redirect()->route('admin.login');
    }
}
