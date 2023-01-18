@extends('admin.layouts.master')
@section('title')
    Create Supplier
@endsection
@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Suppiler</div>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Create New Supplier</h4>
                        <a href="{{ route('suppliers.index') }}" class="btn btn-info float-right">Manage</a>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('suppliers.update-insert') }}" method="POST">
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
                            <label for="" class="col-md-3">Phone Number</label>
                            <div class="col-md-9">
                                <input type="text" name="phone" class="form-control">
                                <div class="mt-2">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="" class="col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="email" name="email"  class="form-control">
                                <div class="mt-2">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="" class="col-md-3">Address</label>
                            <div class="col-md-9">
                                <textarea name="address" id="" cols="30" rows="3"  class="form-control"></textarea>
                                <div class="mt-2">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="" class="col-md-3"></label>
                            <div class="col-md-9">
                                <input type="submit" value="Add New Supplier"  class="btn btn-success">
                            </div>
                        </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
