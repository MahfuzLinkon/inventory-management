@extends('admin.layouts.master')

@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Suppiler</div>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Update Supplier</h4>
                        <a href="{{ route('suppliers.index') }}" class="btn btn-info float-right">Manage</a>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('suppliers.update-insert', ['id'=>$supplier->id]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <label for="" class="col-md-3">Name</label>
                            <div class="col-md-9">
                                <input type="text" value="{{ $supplier->name }}" name="name" class="form-control">
                            </div>
                       </div>
                       <div class="row mt-3">
                            <label for="" class="col-md-3">Phone Number</label>
                            <div class="col-md-9">
                                <input type="text" name="phone" value="{{ $supplier->phone }}" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="" class="col-md-3">Email</label>
                            <div class="col-md-9">
                                <input type="email" name="email" value="{{ $supplier->email }}" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="" class="col-md-3">Description</label>
                            <div class="col-md-9">
                                <textarea name="description" id="" cols="30" rows="3"  class="form-control">{{ $supplier->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="" class="col-md-3"></label>
                            <div class="col-md-9">
                                <input type="submit" value="Update Supplier"  class="btn btn-success">
                            </div>
                        </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
  


    </div>
@endsection