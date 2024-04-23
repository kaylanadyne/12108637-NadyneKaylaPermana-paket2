@extends('layout.dashboard')
@section('title', 'Detail Pembelian')
@section('content')
<div class="p-2">
    <h4>Detail Pembelian</h4>
</div>
<div class="row">
    <div class="col-12">
    <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>no</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            
                        </tr>
                        @foreach($details as $detail)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{$detail->product->name}}</td>
                            <td>{{$detail->quantity}}</td>
                            <td>{{$detail->subtotal}}</td>
                            
                        </tr>
                        @endforeach
                    </table>
                    <div class="mt-3">
                        <h5>Total Price: <br> {{$details->sum('subtotal')}}</h5>
                    </div>
                    <a href="/dashboard/sales/history" class="btn btn-primary">Back</a>
                </div>
            </div>
    </div>
</div>
@endsection
