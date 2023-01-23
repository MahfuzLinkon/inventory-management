@extends('admin.layouts.master')
@section('title')
    Manage Products
@endsection
@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Products</div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Manage Products</h4>
                        <a href="{{ route('products.create') }}" class="btn btn-success float-right">Add New</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Supplier</th>
                                    <th>Catgory</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        @foreach ( $suppliers as $supplier )
                                            @if ($supplier->product_id == $product->id)
                                                {{-- <span></span> --}}
                                                <ul>
                                                    <li>{{ $supplier->supplier->name }}</li>
                                                </ul>
                                            @endif
                                        @endforeach
                                        {{-- @php
                                            foreach($suppliers as $supplier){
                                                if ($supplier->product_id == $product->id) {
                                                    <span></span>
                                                }
                                            }
                                        @endphp --}}
                                    </td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->unit->name }}</td>
                                    <td>{!! Str::words($product->description, 20, '...') !!}</td>
                                    <td>
                                        <img src="{{ asset($product->image) }}" alt="" style="width: 80px; height:80">
                                    </td>
                                    <td>{{ $product->status == 1 ? 'Active' : 'Deactive' }}</td>
                                    <td>
                                        <a href="{{ route('products.status', ['id'=>$product->id]) }}" class="btn btn-{{ $product->status == 1 ? 'warning' : 'success' }}"><i class="gd-arrow-{{ $product->status == 1 ? 'down' : 'up' }}"></i></a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info"><i class="gd-pencil-alt"></i></a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are sure want to delete this ?')" style="display: inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"><i class="gd-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
