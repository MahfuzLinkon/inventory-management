@extends('admin.layouts.master')
@section('title')
    Edit Products
@endsection
@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Products</div>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Update Product</h4>
                        <a href="{{ route('products.index') }}" class="btn btn-info float-right">Manage</a>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <label for="" class="col-md-3">Product Name</label>
                            <div class="col-md-9">
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control">
                                <div class="mt-2">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                       </div>
                       <div class="row mt-3">
                            <label for="" class="col-md-3">Product Category</label>
                            <div class="col-md-9">
                                <select name="category_id" id="" class="selectJs form-control" data-placeholder="Select Product Category">
                                    <option></option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-2">
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="" class="col-md-3">Product Unit</label>
                            <div class="col-md-9">
                                <select name="unit_id" id="" class="selectJs form-control" data-placeholder="Select Product Unit">
                                    <option></option>
                                    @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" {{ $unit->id == $product->unit_id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-2">
                                    @error('unit_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="" class="col-md-3">Product Image</label>
                            <div class="col-md-9">
                                <input type="file" name="image" class="form-control">
                            </div>
                       </div>
                       <div class="row mt-3">
                            <label for="" class="col-md-3">Product Description</label>
                            <div class="col-md-9">
                                <textarea name="description" id="editor" cols="30" rows="2" class="form-control">{!! $product->description !!}</textarea>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <label for="" class="col-md-3"></label>
                            <div class="col-md-9">
                                <input type="submit" value="Update Product"  class="btn btn-primary">
                            </div>
                        </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
