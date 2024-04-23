<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\DetailSale;
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

    public function deleteUser($id) // menghapus user
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'user deleted');
    }

    public function updateUser(Request $request, $id) //mengupdate data user
    {
        $request->validate([
            "name"      => "required",
            "email"     => "required",
            "password"  => "required",
            "role"      => "required",
        ]);
        $user = User::find($id);
        $user->update([
            "name"     => $request->name,
            "email"    => $request->email,
            "password" => bcrypt($request->password),
            "role"     => $request->role
        ]);
        return back()->with('success', 'user updated');
    }

    public function indexProduct(Request $request) { //menampilkan index product
        $search = $request->input('search');
        $products = Product::query()
                        ->where('name', 'LIKE', "%{$search}%")
                        ->get();
        return view('pages.product.index', compact('products'));
    }

    public function createProduct(Request $request)  // create data product
    {
        $request->validate([
            "name" => "required",
            "price" => "required",
            "stock" => "required",
            "img" => "required",
        ]);

        $file = $request->img;
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $path = 'uploads/product/img';
        $file->move(public_path($path), $filename);

        $now = Carbon::now();
        $yearMonthDay = $now->format('y') . $now->format('m') . $now->format('d');
        $producutCount = Product::count();
        $code = false;

        if ($producutCount == 0) {
            $code = "P" . $yearMonthDay . "1";
        } else {
            $code = "P" . $yearMonthDay . ($producutCount + 1);
        }

        Product::create([
            "name" => $request->name,
            "price" => $request->price,
            "stock" => $request->stock,
            "code"  => $code,
            "img"  => $filename
        ]);

        return back()->with('success', 'data product created');
    }

    public function addStock(Request $request, $id) { //menambahkan stok barang
        $request->validate(["stock"=>"required"]);
         $stock = Product::find($id);
 
         $stock->update(["stock" => $stock->stock + $request->stock]);
 
         return back()->with('success', 'updated');
         
    }

    public function updateStock(Request $request, $id){ //mengupdate data produk untuk nama dan harga
         $request->validate([
             "name" => "required",
             "price" => "required"
         ]);
 
         $product = Product::find($id);
 
         $product->update([
             "name" => $request->name,
             "price" => $request->price
         ]);
 
         return back()->with('success', 'data updated');
    }

    public function deleteProduct($id) //menghapus produk
    {
        $user = Product::findOrFail($id);
        $user->delete();
        return back()->with('success', 'user deleted');
    }

    public function saleHistory() { //menampilkan histori penjualan
        return view('pages.sale.index');
    }

    public function viewSale() { //menampilkan produk yang akan dibeli
        $products = Product::all();
        return view('pages.sale.purchasing', compact('products'));
    }
    //function confirm payment - sales
    public function confirm(Request $request) //konfirmasi pembayaran
    {
        $products = [];
        $codes = $request->code;
        $qtys = $request->quantity;

        foreach ($codes as $index => $code) {
            $products[] = [
                "code" => $code,
                "qty" => $qtys[$index]
            ];
        }

        $codeSearch = array_column($products, 'code');
        $produks = Product::whereIn('code', $codeSearch)->get();

        $errorMessage = [];

        foreach ($products as $product) {
            $productModel = Product::where('code', $product['code'])->first();
            $productModel->stock -= $product['qty'];
            $productModel->save();
        }

        if (!empty($errorMessage)) {
            return back()->with('fail', $errorMessage);
        }

        $name   = $request->name;
        $phone   = $request->phone;
        $address = $request->address;
        session([
            "produk" => $products,
            "pelanggan" => [
                "name"    => $name,
                "phone"    => $phone,
                "address"  => $address
            ]
        ]);

        return view('pages.sale.confirm', compact([
            "name",
            "phone",
            "address",
            "products",
            "produks"
        ]));
    }

    public function pdfInvoice() //download bukti pdf
    {
        $products = session("produk");
        $codeSearch = array_column($products, 'code');
        $items = Product::whereIn('code', $codeSearch)->get();
        $total_price = 0;

        foreach ($items as $item) {
            foreach ($products as $product) {
                if ($product["code"] == $item->code) {
                    $price = $product["qty"] * $item->price;
                    $total_price += $price;
                }
            }
        }

        $customers = session("pelanggan");
        $name = $customers['name'];
        $address = $customers['address'];
        $phone = $customers['phone'];

        return view('pages.sale.invoice', compact([
            "name",
            "address",
            "phone",
            "products",
            "items",
            "total_price"
        ]));
    }

    public function back()
    {
        $products = session("produk");
        $codeSearch = array_column($products, 'code');
        $items = Product::whereIn('code', $codeSearch)->get();
        $total_price = 0;

        foreach ($items as $item) {
            foreach ($products as $product) {
                if ($product["code"] == $item->code) {
                    $price = $product["qty"] * $item->price;
                    $total_price += $price;
                }
            }
        }
        
        $customers = session("pelanggan");
        $name = $customers['name'];
        $address = $customers['address'];
        $phone = $customers['phone'];
        $customer = Customer::create([
            "name" => $name,
            "phone" => $phone,
            "address" => $address
        ]);

        $penjualan = Sale::create([
            "customer_id" => $customer->id,
            "sale_date" => now(),
            "total_price" => $total_price,
            "user_id" => auth()->user()->id
        ]);

        foreach ($items as $item) {
            foreach ($products as $product) {
                if ($product["code"] == $item->code) {
                    DetailSale::create([
                        'sale_id' => $penjualan->id,
                        'product_id' => $item->id,
                        'quantity' => $product["qty"],
                        'subtotal' => $item->price * $product["qty"]
                    ]);

                    $productUpdate = Product::find($item->id);
                    $stock = $productUpdate->stock - $product["qty"];
                    $productUpdate->update([
                        "Stock" => $stock
                    ]);
                }
            }
        }

        return redirect('/dashboard/sales')->with('success', 'transaksi berhasil');
    }

    public function viewHistory(Request $request) {
        $searchQuery = $request->input('search');
        
        if (Auth()->user()->role === 'admin') {
            $historys = Sale::with(['user', 'customer'])
                            ->whereHas('customer', function ($search) use ($searchQuery) {
                                $search->where('name', 'like', '%' . $searchQuery . '%');
                            })
                            ->get();
            return view('pages.sale.index', compact('historys'));
        } else {
            $userId = Auth()->user()->id;
    
            $historys = Sale::with(['customer', 'user'])
                            ->where('user_id', $userId)
                            ->whereHas('customer', function ($search) use ($searchQuery) {
                                $search->where('name', 'like', '%' . $searchQuery . '%');
                            })
                            ->get();
        
            return view('pages.sale.index', compact('historys'));
        }
    }
    
    

    public function showDetail($id)
    {    
        $details = DetailSale::where('sale_id', $id)
                    ->with('product')
                    ->get();
        
        return view('pages.sale.detail', compact('details'));
    }
    
    
}