@extends('layout.dashboard')
@section('title', 'history')
@section('content')
<div class="p-2">
    <h4>Dashboard</h4>

</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>History Penjualan</h4><br>
                <form action="{{ route('dashboard.sales.history') }}" method="GET" class="form-inline mr-3">
                    <input type="text" name="search" class="form-control mr-sm-2" placeholder="Cari pembeli...">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
                <div class="card-header-form">
                    <div class="input-group">
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>no</th>
                            <th>Sale Date</th>
                            <th>Total Price</th>
                            <th>Customer</th>
                            <th>Employee</th>
                            <th></th>
                        </tr>
                        @foreach($historys as $history)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{$history->sale_date}}</td>
                            <td>{{$history->total_price}}</td>
                            <td>{{$history->customer->name}}</td>
                            <td>{{$history->user->name}}</td>
                            <td>
                                <a href="{{ route('history.detail', $history->id) }}" class="btn btn-primary">Detail Pembelian</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>

</script>
@endsection