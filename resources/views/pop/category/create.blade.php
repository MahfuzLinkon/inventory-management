@extends('admin.layouts.master')
@section('title')
    Create Category
@endsection
@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Category</div>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Create New Category</h4>
                        <a href="{{ route('categories.index') }}" class="btn btn-info float-right">Manage</a>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <label for="" class="col-md-3">Name</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control">
                                <div class="mt-2">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                       </div>
                        <div class="row mt-3">
                            <label for="" class="col-md-3"></label>
                            <div class="col-md-9">
                                <input type="submit" value="Add New Category"  class="btn btn-success">
                            </div>
                        </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
