<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexUser()
    {
        $users = User::all();
        return view('pages.user.index', compact('users'));
    }
    public function register()
    {
        return view('auth.register');
    }

    public function createUser(Request $request)
    {
        $request->validate([
            "name"      => "required",
            "email"     => "required",
            "password"  => "required",
            "role"      => "required",
        ]);

        $user = User::create([
            "name"     => $request->name,
            "email"    => $request->email,
            "password" => bcrypt($request->password),
            "role"     => $request->role
        ]);

        return redirect('/dashboard/user')->with('success', 'add user success');
    }
}