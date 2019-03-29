<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->checkUsername($request->username)) {
            $request->session()->flash('error', 'Username already exists!');

            return redirect()->back()->withInput();
        }

        $user = new User;

        $user->username = $request->username;
        $user->password = Hash::make($request->password);

        $user->save();

        $request->session()->flash('success', 'Add user successful.');

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
        $user = User::find($id);

        if ($user) {
            return view('admin.user.reset-password', compact(['id','user']));
        } else {
            $users = User::all();

            return redirect()->route('admin.user')->with('users', $users);
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
        $user = User::find($id);

        $user->password = Hash::make($request->password);

        $user->save();

        $request->session()->flash('success', 'Reset password for User "'. $user->username .'" successful.');

        $users = User::all();

        return view('admin.user.index')->with('users', $users);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);

        $user->delete();

        $request->session()->flash('success', 'Delete user "'. $user->username .'" successful.');

        $users = User::all();

        return redirect()->back()->with('users', $users);
    }

    public function generatePassword()
    {
        return response()->json(str_random(8));
    }

    public function checkUsername($username)
    {
        $user = User::where('username', $username)->first();

        return $user ? true : false;
    }
}
