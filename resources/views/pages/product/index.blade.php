@extends('layout.dashboard')
@section('title', 'Stock')
@section('content')
<div class="p-2">
    <h4>Dashboard</h4>
    <h6 class="font-weight-light">Dashboard / <span class="font-weight-bold"> product </span></h6>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="input-group">
                    <div class="input-group-btn">
                        @if(auth()->user()->role === 'admin')
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addStockModal"><i class="fas fa-plus"></i> Tambah Produk Baru</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>no</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                        
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="" class="btn btn-success">edit</a>
                                <a href="" class="btn btn-info">stok</a>
                                <a href="" class="btn btn-danger">hapus</a>
                            </td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="addStockModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('dashboard.product.create') }}" class="needs-validation" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="product_name">Nama Produk<span class="text-danger">*</span></label>
                        <input id="product_name" class="form-control" name="name" tabindex="1" type="text" required autofocus>
                        <div class="invalid-feedback">
                            Silahkan isi nama produk
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="price" class="control-label">Harga<span class="text-danger">*</span></label>
                        </div>
                        <input id="price" class="form-control" name="price" tabindex="2" type="number" required>
                        <div class="invalid-feedback">
                            Silahkan isi harga produk
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="stock" class="control-label">Stok<span class="text-danger">*</span></label>
                        </div>
                        <input id="stock" class="form-control" name="stock" tabindex="2" type="number" required>
                        <div class="invalid-feedback">
                            Silahkan isi berapa unit produk
                        </div>
                    </div>

                    <div class="form-group">
                        <input id="img" class="form-control" name="img" tabindex="1" type="file" required>
                    </div>

                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection