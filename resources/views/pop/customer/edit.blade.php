@extends('admin.layouts.master')
@section('title')
    Edit Customer
@endsection
@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Customer</div>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Edit Customer</h4>
                        <a href="{{ route('customers.index') }}" class="btn btn-info float-right">Manage</a>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('customers.update-insert', ['id'=> $customer->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <label for="" class="col-md-3">Name</label>
                            <div class="col-md-9">
                                <input type="text" name="name" value="{{ $customer->name }}" class="form-control">
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
                                <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control">
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
                                <input type="email" name="email" value="{{ $customer->email }}" class="form-control">
                                <div class="mt-2">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="" class="col-md-3">Image</label>
                            <div class="col-md-9">
                                <input type="file" name="image"  class="form-control">
                                <img src="{{ asset($customer->image) }}" alt="" style="height: 80px; width:80px;">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="" class="col-md-3">Address</label>
                            <div class="col-md-9">
                                <textarea name="address" id="" cols="30" rows="3"  class="form-control">{{ $customer->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="" class="col-md-3"></label>
                            <div class="col-md-9">
                                <input type="submit" value="Update Customer"  class="btn btn-success">
                            </div>
                        </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
