@extends('layout.dashboard')
@section('title', 'Detail Pembelian')
@section('content')
<div class="p-2">
    <h4>Detail Pembelian</h4>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informasi Penjualan</h5>
                <div>
                    <p>Tanggal Penjualan: {{ $details->first()->sale->created_at }}</p>
                    <p>Nama Petugas: {{ $details->first()->sale->user->name }}</p>
                    <p>Nama Pembeli: {{ $details->first()->sale->customer->name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>No</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                        @foreach($details as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <<td>{{ number_format($detail->subtotal, 0, ',', '.') }}</td> <!-- Format subtotal menjadi Rupiah -->
                        </tr>
                        @endforeach
                    </table>
                    <div class="mt-3 ml-3">
                        <h5>Total Price: <br>{{ 'Rp ' . number_format($details->sum('subtotal'), 0, ',', '.') }}</h5>
                    </div>
                    <a href="/dashboard/sales/history" class="btn btn-primary ml-3 mb-3">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
