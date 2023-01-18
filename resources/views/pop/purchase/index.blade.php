@extends('admin.layouts.master')
@section('title')
Purchase Products
@endsection
@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Purchase Products</div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Manage Purchase</h4>
                        <a href="{{ route('purchases.create') }}" class="btn btn-info float-right">Purchase New</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Supplier</th>
                                    <th>Catgory</th>
                                    <th>Unit</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $purchase)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $purchase->name }}</td>
                                    <td>

                                    </td>
                                    <td>{{ $purchase->category->name }}</td>
                                    <td>{{ $purchase->unit->name }}</td>
                                    <td>{!! Str::words($purchase->description, 20, '...') !!}</td>
                                    <td>
                                        <img src="{{ asset($purchase->image) }}" alt="" style="width: 80px; height:80">
                                    </td>
                                    <td>{{ $purchase->status == 1 ? 'Active' : 'Deactive' }}</td>
                                    <td>
                                        <a href="{{ route('products.status', ['id'=>$purchase->id]) }}" class="btn btn-{{ $purchase->status == 1 ? 'warning' : 'success' }}"><i class="gd-arrow-{{ $purchase->status == 1 ? 'down' : 'up' }}"></i></a>
                                        <a href="{{ route('products.edit', $purchase->id) }}" class="btn btn-info"><i class="gd-pencil-alt"></i></a>
                                        <form action="{{ route('products.destroy', $purchase->id) }}" method="POST" onsubmit="return confirm('Are sure want to delete this ?')" style="display: inline-block">
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
