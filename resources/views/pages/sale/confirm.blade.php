@extends('layout.dashboard')
@section('title', 'Invoice')
@section('content')
<div class="p-2"> 
    <h6 class="font-weight-light">Pembelian / <span class="font-weight-bold"> Confirm Payment </span></h6>
</div>
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Pribadi</h4>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="row w-100 mb-3">
                        <div class="col-sm-6 col-12">
                            <b>Nama</b>
                        </div>
                        <div class="col-sm-6 col-12">
                            : {{ $name }}
                        </div>
                    </div>
                    <div class="row w-100 mb-3">
                        <div class="col-sm-6 col-12">
                            <b>Alamat</b>
                        </div>
                        <div class="col-sm-6 col-12">
                            : {{ $address == null ? '-' : $address }}
                        </div>
                    </div>
                    <div class="row w-100 mb-3">
                        <div class="col-sm-6 col-12">
                            <b>No Phone</b>
                        </div>
                        <div class="col-sm-6 col-12">
                            : {{ $phone }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Penjualan</h4>
                </div>
                <div class="card-body">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPrice = 0;
                @endphp
                @foreach ($produks as $produk)
                    @foreach ($products as $p)
                        @if ($p['code'] == $produk->code)
                            @php
                                $subtotal = $p['qty'] * $produk->price;
                                $totalPrice += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $produk->name }}</td>
                                <td>Rp{{ number_format($produk->price, 2, ',', '.') }}</td>
                                <td>{{ $p['qty'] }}</td>
                                <td>Rp{{ number_format($subtotal, 2, ',', '.') }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                <tr>
                    <td colspan="3"><b>Total Dibayar:</b></td>
                    <td><b>Rp{{ number_format($totalPrice, 2, ',', '.') }}</b></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


                <div class="card-footer">
                    <form action="" method="post">
                        @csrf
                        <a href="{{ route('dashboard.sales.back')}}"  class="btn btn-success">Return to Menu</a>
                        <a href="{{ route('dashboard.sales.invoice') }}" target="_blank" class="btn btn-danger">Cetak Struk</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection