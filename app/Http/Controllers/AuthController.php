<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function auth(Request $request) {
        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        $user = User::Where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
         
            if (Auth()->user()->role === 'admin') {
                return redirect('/dashboard/user')->with('success', 'login berhasil');
            } else {
                return redirect('/dashboard/product');
            }
            
        }

        return back()->with('loginError', 'login failed');
    } 

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
