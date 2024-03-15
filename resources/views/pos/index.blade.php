@extends('dashboard.body.main')

@section('specificpagescripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endsection

@section('content')
<!-- BEGIN: Header -->
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon">
                            <svg class="svg-inline--fa fa-cart-shopping" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cart-shopping" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M96 0C107.5 0 117.4 8.19 119.6 19.51L121.1 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H170.7L179.9 336H488C501.3 336 512 346.7 512 360C512 373.3 501.3 384 488 384H159.1C148.5 384 138.6 375.8 136.4 364.5L76.14 48H24C10.75 48 0 37.25 0 24C0 10.75 10.75 0 24 0H96zM128 464C128 437.5 149.5 416 176 416C202.5 416 224 437.5 224 464C224 490.5 202.5 512 176 512C149.5 512 128 490.5 128 464zM512 464C512 490.5 490.5 512 464 512C437.5 512 416 490.5 416 464C416 437.5 437.5 416 464 416C490.5 416 512 437.5 512 464z"></path></svg>
                        </div>
                        Point of Sale
                    </h1>
                </div>
            </div>
            <nav class="mt-4 rounded" aria-label="breadcrumb">
                <ol class="breadcrumb px-3 py-2 rounded mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Point of Sale</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<!-- END: Header -->

<!-- BEGIN: Alert -->
@if (session()->has('success'))
<div class="container-xl px-4 mt-n10">
    <div class="alert alert-success alert-icon" role="alert">
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        <div class="alert-icon-aside">
            <i class="far fa-flag"></i>
        </div>
        <div class="alert-icon-content">
            {{ session('success') }}
        </div>
    </div>
</div>
@endif
<!-- END: Alert -->

<!-- BEGIN: Main Page Content -->
<div class="container-xl px-4 mt-n10">
    <div class="row">

        <!-- BEGIN: Section Left -->
        <div class="col-xl-6">
            <!-- BEGIN: Cart -->
            <a href="{{ route('customers.create') }}" class="btn btn-success add-list mx-1 mb-2" style="display:block;">Add Customer</a>

            <div class="card mb-4">
                <div class="card-header">
                    Cart
                </div>
                <div class="card-body">
                    <!-- BEGIN: Table Cart -->
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">QTY</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">SubTotal</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td style="min-width: 170px;">
                                        <form action="{{ route('pos.updateCartItem', $item->rowId) }}" method="POST">
                                            @csrf
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="qty" required value="{{ old('qty', $item->qty) }}">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-success border-none" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sumbit"><i class="fas fa-check"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->subtotal }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <form action="{{ route('pos.deleteCartItem', $item->rowId) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END: Table Cart -->

                    <!-- Form Row -->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (total product) -->
                        <div class="col-md-6">
                            <label class="small mb-1">Total Product</label>
                            <div class="form-control form-control-solid fw-bold text-red">₱{{ Cart::count() }}</div>
                        </div>
                        <!-- Form Group (subtotal) -->
                        <div class="col-md-6">
                            <label class="small mb-1">Subtotal</label>
                            <div class="form-control form-control-solid fw-bold text-red">₱{{ Cart::subtotal() }}</div>
                        </div>
                    </div>
                    <!-- Form Row -->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (tax) -->
                        <div class="col-md-6">
                            <label class="small mb-1">Tax</label>
                            <div class="form-control form-control-solid fw-bold text-red">₱{{ Cart::tax() }}</div>
                        </div>
                        <!-- Form Group (total) -->
                        <div class="col-md-6">
                            <label class="small mb-1">Total</label>
                            <div class="form-control form-control-solid fw-bold text-red">₱{{ Cart::total() }}</div>
                        </div>
                    </div>
                    <!-- Form Group (customer) -->

                    <form action="{{ route('pos.createInvoice') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="small mb-1" for="customer_id">Customer <span class="text-danger">*</span></label>
                                <select class="form-select form-control-solid @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id">
                                    <option selected="" disabled="">Select a customer:</option>
                                    @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" @if(old('customer_id') == $customer->id) selected="selected" @endif>{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                                <!-- Submit button -->
                            <div class="col-md-12 mt-4">
                                <div class="d-flex flex-wrap align-items-center justify-content-center">
                                    
                                    <button type="submit" class="btn btn-success add-list mx-1">Create Invoice</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Cart -->
        </div>
        <!-- END: Section Left -->


        <!-- BEGIN: Section Right -->
        <div class="col-xl-6">
            <!-- Product image card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">List Product</div>

                <div class="card-body">
                    <!-- BEGIN: Search products -->
                    <div class="col-lg-12">
                        <form action="{{ route('pos.index') }}" method="GET">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="form-group row align-items-center">
                                    <label for="row" class="col-auto">Row:</label>
                                    <div class="col-auto">
                                        <select class="form-control" name="row">
                                            <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
                                            <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
                                            <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
                                            <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row align-items-center justify-content-between">
                                    <label class="control-label col-sm-3" for="search">Search:</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" id="search" class="form-control me-1" name="search" placeholder="Search product" value="{{ request('search') }}">
                                            <div class="input-group-append d-flex">
                                                <button type="submit" class="input-group-text bg-primary"><i class="fa-solid fa-magnifying-glass font-size-20 text-white"></i></button>
                                                <a href="{{ route('pos.index') }}" class="input-group-text bg-danger"><i class="fa-solid fa-trash font-size-20 text-white"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- END: Search products -->

                    <!-- BEGIN: Products List -->
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@sortablelink('product_name', 'Name')</th>
                                        <th scope="col">@sortablelink('stock')</th>
                                        <th scope="col">@sortablelink('unit.name', 'unit')</th>
                                        <th scope="col">@sortablelink('selling_price', 'Price')</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                    <tr>
                                        <th scope="row">{{ (($products->currentPage() * (request('row') ? request('row') : 10)) - (request('row') ? request('row') : 10)) + $loop->iteration  }}</th>
                                        {{-- <td>
                                        <div style="max-height: 80px; max-width: 80px;">
                                            <img class="img-fluid"  src="{{ $product->product_image ? asset('storage/products/'.$product->product_image) : asset('assets/img/products/default.png') }}">
                                        </div>
                                        </td> --}}
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>{{ $product->unit->name }}</td>
                                        <td>₱{{ $product->selling_price }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <form action="{{ route('pos.addCartItem', $product->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                                    <input type="hidden" name="name" value="{{ $product->product_name }}">
                                                    <input type="hidden" name="price" value="{{ $product->selling_price }}">

                                                    <button type="submit" class="btn btn-outline-primary btn-sm">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <th colspan="6" class="text-center" >
                                            Data not found!
                                        </th>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END: Products List -->

                    <!-- BEGIN: Pagination -->
                    <div class="col-lg-12">
                        {{ $products->links() }}
                    </div>
                    <!-- END: Pagination -->
                </div>
            </div>
        </div>
        <!-- END: Section Right -->
    </div>
</div>
@endsection
