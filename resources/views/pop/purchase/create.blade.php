@extends('admin.layouts.master')
@section('title')
Purchase Product
@endsection
@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Purchase Products</div>
        </div>

        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Purchase Products</h4>
                        <a href="{{ route('products.index') }}" class="btn btn-info float-right">Manage Purchase</a>
                    </div>
                    <div class="card-body">
                       <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Purchase Date</label>
                                    <div>
                                        <input type="date" name="date" class="form-control">
                                        <div class="mt-2">
                                            @error('supplier_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Supplier Name</label>
                                    <div>
                                        <select name="supplier_id" id="supplierId" class="selectJs form-control" data-placeholder="Select Product Supplier">
                                            <option></option>
                                            @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="mt-2">
                                            @error('supplier_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="row mt-3">
                                <div class="col-md-6">
                                    <label for="">Product Category</label>
                                    <select name="category_id" id="categoryId" class="selectJs form-control"  data-placeholder="Select Product Category">
                                        <option></option>
                                    </select>
                                    <div class="mt-2">
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Product Name</label>
                                    <select name="category_id" id="productId" class="selectJs form-control"  data-placeholder="Select Product">
                                        <option></option>
                                    </select>
                                    <div class="mt-2">
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                        </div>

                            <div class="mt-3">
                                <input type="submit" value="Purchase Product"  class="btn btn-success">
                            </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Supplier wise Category
    $(document).on('change', '#supplierId', function(){
        let supplierId = $(this).val();
        // alert(supplierId);
        $.ajax({
            url: "{{ route('get.category') }}",
            type: "POST",
            dataTypr: "JSON",
            data: {supplier_id: supplierId},
            success: function(response){
                // console.log(response);
                let option = ""
                option += '<option selected disabled >--Select product category--</option>'
                $.each(response, function(key, value){
                // console.log(value.name);
                    option += '<option value="'+value.id+'">'+value.name+'</option>'
                });
                $('#categoryId').empty().append(option);
            }
        });
    });

    // Category wise product
    $(document).on('change', '#categoryId', function(){
        let categoryId = $(this).val();
        $.ajax({
            url: "{{ route('get.product') }}",
            type: "POST",
            dataTypr: "JSON",
            data: {category_id: categoryId},
            success: function(response){
                // console.log(response);
                let option = ""
                option += '<option selected disabled >--Select product name--</option>'
                $.each(response, function(key, value){
                // console.log(value.name);
                    option += '<option value="'+value.id+'">'+value.name+'</option>'
                });
                $('#productId').empty().append(option);
            }
        });
    });



</script>
@endsection
