@extends('admin.layouts.master')
@section('title')
Search Product Stock
@endsection
@section('content')
<div class="py-4 px-3 px-md-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card pb-12">
                <div class="card-header">
                    <div class="float-left">
                        <h3>Search Product Stock</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h5 class="card-title">Search by: </h5>
                        <hr>
                        <div>
                            <label><input type="radio" class="search"  value="supplier" name="search"> Supplier</label>
                            <label><input type="radio" class="ml-5 search" value="product" name="search"> Product</label>
                        </div>
                    </div>

                    <div id="supplierForm" style="display: none">
                        <form action="{{ route('search.stock-supplier') }}" method="GET" target="_blank">
                            <div class="row">
                                <div class="col-md-7">
                                    <label for="">Select Suppler</label>
                                    <select name="supplier_id" class="form-control">
                                        <option selected disabled>Select Suppler</option>
                                        @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-5 mt-5">
                                    <input type="submit" value="Search" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div id="productForm" style="display: none">
                        <form action="{{ route('search.stock-product') }}" method="GET" target="_blank">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Select Category</label>
                                    <select name="category_id" id="categoryId" class="form-control">
                                        <option selected disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="">Select Product</label>
                                    <select name="product_id" id="productId" class="form-control">

                                    </select>
                                </div>
                                <div class="col-md-4 mt-5">
                                    <input type="submit" value="Search" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).on('change', '.search', function(){
        let serach = $(this).val();
        if(serach == 'supplier'){
            $('#supplierForm').show();
            $('#productForm').hide();
        }else if(serach == 'product'){
            $('#productForm').show();
            $('#supplierForm').hide();
        }

    });
</script>

<script>
    $(document).on('change', '#categoryId', function(){
        let categoryId = $(this).val();
        $.ajax({
            url: "{{ route('search.get-product') }}",
            type: "GET",
            dataType: "JSON",
            data: {category_id: categoryId},

            success: function(response){
                let option = ""
                option += '<option selected disabled>Select Product</option>';
                $.each(response, function(key, value){
                    option += '<option value="'+value.id+'">'+value.name+'</option>'
                });
                $('#productId').empty().append(option);
            }
        });
    });
</script>
@endsection
