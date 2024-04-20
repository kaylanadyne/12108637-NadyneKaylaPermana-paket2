<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexUser() // menampilkan semua pengguna 
    {
        $users = User::all();
        return view('pages.user.index', compact('users'));
    }

    public function register() // menampilkan halaman tambah pengguna
    {
        return view('auth.register');
    }

    public function createUser(Request $request) // membuat pengguna baru 
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

    public function indexProduct() {
        return view('pages.product.index');
    }

    public function createProduct(Request $request) {
        $request->validate([
            "name" => "required",
            "price" => "required",
            "stock" => "required",
            "img" => "required",
        ]);

        $product = Product::create([
            "name"     => $request->name,
            "price"    => $request->price,
            "stock"    => $request->stock,
            "img"     => $request->img
        ]);

    }

    public function saleHistory() {
        return view('pages.sale.index');
    }
}