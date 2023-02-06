@extends('admin.layouts.master')
@section('title')
Manage Stock
@endsection
@section('content')
<div class="py-4 px-3 px-md-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card pb-12">
                <div class="card-header">
                    <div class="float-left">
                        <h3>Product Stock Report</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Category Name</th>
                                <th>Supplier Name</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>
                                    <ul>
                                        @foreach ($product['product_supplier'] as $supplier)
                                        <li>{{ $supplier->supplier->name }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ $product->quantity }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-5 mb-5 float-right">
                        <button title="Print Invoice" type="button" class="mr-2 btn btn-success" onclick="window.print()"><i class="gd-printer"></i></button>
                        <button title="Download Invoice" class="btn btn-info "><i class="gd-download"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
