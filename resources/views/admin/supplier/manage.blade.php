@extends('admin.layouts.master')

@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Suppiler</div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Manage Supplier</h4>
                        <a href="{{ route('suppliers.create') }}" class="btn btn-success float-right">Add New</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Description</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->description }}</td>
                                    <td>{{ $supplier->created_by }}</td>
                                    <td>{{ $supplier->updated_by }}</td>
                                    <td>{{ $supplier->status == 1 ? 'Active' : 'Deactive' }}</td>
                                    <td>
                                        <a href="{{ route('suppliers.status', ['id'=>$supplier->id]) }}" class="btn btn-{{ $supplier->status == 1 ? 'warning' : 'success' }}"><i class="gd-arrow-{{ $supplier->status == 1 ? 'down' : 'up' }}"></i></a>
                                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-info"><i class="gd-pencil-alt"></i></a>
                                        {{-- <a href="" class="btn btn-danger"><i class="gd-trash"></i></a> --}}
                                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" onsubmit="return confirm('Are sure want to delete this ?')" style="display: inline-block">
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