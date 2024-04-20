@extends('layout.dashboard')
@section('title', 'Stock')
@section('content')
<div class="p-2">
    <h4>Dashboard</h4>
    <h6 class="font-weight-light">Dashboard / <span class="font-weight-bold"> sales </span></h6>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="" class="btn btn-success">ekspor ke</a>
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
                        </tr>
                        
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection