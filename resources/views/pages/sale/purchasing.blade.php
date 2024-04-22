@extends('layout.dashboard')
@section('title', 'Pembelian')
@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        <b>Success:</b>
        {{ session('success') }}
    </div>
</div>
@endif
@if (session('fail'))
<div class="alert alert-danger alert-dismissible show fade">
    <div class="alert-body">
        <button class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
        <b>Fail:</b>
        Produk dengan kode
        @foreach (session('fail') as $code)
        <b>{{ $code }}</b>,
        @endforeach
        tidak tersedia
    </div>
</div>
@endif
<div class="p-2">
    <h3>Form Pembelian</h3>
</div>
<div class="container">
    <!-- kasih route untuk confirm payment ini -->
    <form action="{{ route('dashboard.sales.confirm')}}" method="POST" class="needs-validation" novalidate>
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label for="nama">Name Customer <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" id="nama">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label for="telp">No Phone <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="phone" id="telp">
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label for="alamat">Customer Address <span class="text-danger">*</span></label>
                                <textarea name="address" id="alamat" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body p-4">
                <h5 class="text-dark">Produk</h5>
                <div id="productInputs">
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="product">Select Product</label>
                            <select class="form-control" name="code[]" id="product">
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                <option value="{{ $product->code }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="jumlah">Jumlah</label>
                            <input class="form-control" type="text" name="quantity[]" required>
                        </div>
                        <div class="form-group col-12">
                            <button type="button" class="btn btn-danger" onclick="removeProductInput(this)">Cancel</button>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-info add-product"> + Add Product</button>
                    <button type="submit" class="btn btn-success ml-1 add-product"> Submit </button>
                </div>
            </div>
        </div>
</div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productInputs = document.getElementById('productInputs');
        const addProductButton = document.querySelector('.add-product');
        const cancelProductButtons = document.querySelectorAll('.cancel-product');

        addProductButton.addEventListener('click', function() {
            const newRow = productInputs.firstElementChild.cloneNode(true);
            productInputs.appendChild(newRow);
        });

        cancelProductButtons.forEach(button => {
            button.addEventListener('click', function() {
                if (productInputs.children.length > 1) {
                    productInputs.removeChild(button.parentNode.parentNode);
                }
            });
        });
    });
</script>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            tags: true,
            tokenSeparators: [',', ' '],
            createTag: function(params) {
                var term = $.trim(params.term);

                if (term === '') {
                    return null;
                }

                return {
                    id: term,
                    text: term,
                    newTag: true // add additional parameters
                }
            }
        });
    });
    function addProductInput() {
        var productInputs = document.getElementById('productInputs');
        var newProductInputs = productInputs.cloneNode(true); // Clone the entire div with id "productInputs"
        productInputs.parentElement.appendChild(newProductInputs); // Append the cloned div to its parent
        newProductInputs.querySelectorAll('input').forEach(function(input) {
            input.value = ''; // Clear input values in the cloned div
        });
    }

    function removeProductInput(button) {
        var card = button.closest('.row');
        card.remove();
    }
</script>
@endsection