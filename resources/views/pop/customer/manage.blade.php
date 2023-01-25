@extends('admin.layouts.master')
@section('title')
    Manage Customer
@endsection
@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Customer</div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Manage Customers</h4>
                        <a href="{{ route('customers.create') }}" class="btn btn-success float-right">Add New</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>image</th>
                                    <th>Address</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>
                                        <img src="{{ asset($customer->image) }}" alt="" style="height: 80px; width:80px;">
                                    </td>
                                    <td>{{ $customer->description }}</td>
                                    <td>{{ isset($customer->createdBy->name) ? $customer->createdBy->name : 'Null' }}</td>
                                    <td>{{ isset($customer->updatedBy) ? $customer->updatedBy->name : 'Not Updated' }}</td>
                                    <td>{{ $customer->status == 1 ? 'Active' : 'Deactive' }}</td>
                                    <td>
                                        <a href="{{ route('customers.status', ['id'=>$customer->id]) }}" class="btn btn-{{ $customer->status == 1 ? 'warning' : 'success' }}"><i class="gd-arrow-{{ $customer->status == 1 ? 'down' : 'up' }}"></i></a>
                                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-info"><i class="gd-pencil-alt"></i></a>
                                        {{-- <a href="" class="btn btn-danger"><i class="gd-trash"></i></a> --}}
                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are sure want to delete this ?')" style="display: inline-block">
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
