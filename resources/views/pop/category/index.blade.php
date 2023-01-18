@extends('admin.layouts.master')
@section('title')
    Manage Category
@endsection
@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Category</div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Manage Category</h4>
                        <a href="{{ route('categories.create') }}" class="btn btn-success float-right">Add New</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->createdBy->name }}</td>
                                    <td>{{ isset($category->updatedBy->name) ? $category->updatedBy->name : 'Not updated' }}</td>
                                    <td>{{ $category->status == 1 ? 'Active' : 'Deactive' }}</td>
                                    <td>
                                        <a href="{{ route('categories.status', ['id'=>$category->id]) }}" class="btn btn-{{ $category->status == 1 ? 'warning' : 'success' }}"><i class="gd-arrow-{{ $category->status == 1 ? 'down' : 'up' }}"></i></a>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info"><i class="gd-pencil-alt"></i></a>
                                        {{-- <a href="" class="btn btn-danger"><i class="gd-trash"></i></a> --}}
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are sure want to delete this ?')" style="display: inline-block">
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
