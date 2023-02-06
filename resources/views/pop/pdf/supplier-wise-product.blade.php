@extends('admin.layouts.master')
@section('title')
Product Supplier Wise Stock Report
@endsection
@section('content')
<div class="py-4 px-3 px-md-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card pb-12">
                <div class="card-header">
                    <div class="float-left">
                        <h3>Supplier Wise Stock Report</h3>
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Supplier Name: <strong>{{ $suppliers['0']['supplier']['name'] }}</strong></h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Product Name</th>
                                <th>Unit</th>
                                <th>Category Name</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $supplier)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                @foreach ($supplier['products'] as $product)
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->unit->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->quantity }}</td>
                                @endforeach
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
