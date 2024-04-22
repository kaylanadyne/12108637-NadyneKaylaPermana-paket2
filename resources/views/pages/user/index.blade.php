@extends('layout.dashboard')
@section('title', 'User')
@section('content')
<div class="p-2">
    <h4>Dashboard</h4>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Users Table</h4>
                <div class="card-header-form">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <a href="{{ route('dashboard.user.register') }}" class="btn btn-primary" style="background-color: #572D0C"><i class="fas fa-plus"></i> New Account</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            @if($user->role === 'admin')
                            <td>
                                <div class="badge badge-success">Admin</div>
                            </td>
                            @else
                            <td>
                                <div class="badge badge-info">Employee</div>
                            </td>
                            @endif

                            <td>
                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#editProdukModal{{ $user->id }}">Edit User</button>
                                <form action="{{ route('dashboard.user.delete', $user->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete user">Delete</button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" tabindex="-1" role="dialog" id="editProdukModal{{ $user->id }}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Produk</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action=" {{ route('dashboard.user.update', $user->id)}}" class="needs-validation" novalidate="">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="product_name">Nama User<span class="text-danger">*</span></label>
                                                <input id="product_name" class="form-control" name="name" tabindex="1" value="{{ $user->name }}" type="text" required autofocus>
                                                <div class="invalid-feedback">
                                                    Silahkah isi nama produk
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="d-block">
                                                    <label for="price" class="control-label">Email<span class="text-danger">*</span></label>
                                                </div>
                                                <input id="price" class="form-control" name="email" tabindex="2" value="{{ $user->email }}" type="email" required>
                                                <div class="invalid-feedback">
                                                    Silahkan isi nama produk
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="d-block">
                                                    <label for="price" class="control-label">Password<span class="text-danger">*</span></label>
                                                </div>
                                                <input id="price" class="form-control" name="password" tabindex="2" value="{{ $user->password }}" type="password" required>
                                                <div class="invalid-feedback">
                                                    Silahkan isi nama produk
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="d-block">
                                                    <label for="price" class="control-label">Role<span class="text-danger">*</span></label>
                                                </div>
                                                <select name="role" class="input-group mb-3 border">
                                                    <option value="{{$user->role}}"> {{$user->role}}</option>
                                                    <option value="employee" >Employee </option>
                                                    <option value="admin">Admin</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan isi nama produk
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer bg-whitesmoke br">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                            <button class="btn btn-success">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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