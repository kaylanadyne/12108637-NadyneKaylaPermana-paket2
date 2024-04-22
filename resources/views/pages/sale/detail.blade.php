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
                <p><strong>Sale Date:</strong> {{ $history->sale_date }}</p>
                <p><strong>Total Price:</strong> {{ $history->total_price }}</p>
                <td>Nama Customer : {{ $history->customer ? $history->customer->name : 'N/A' }}</td><br><br>
                <td>Nama Pegawai : {{ $history->customer ? $history->user->name : 'N/A' }}</td><br>
                <p><strong>Products:</strong></p>
            </div>
        </div>
    </div>
</div>
@endsection
