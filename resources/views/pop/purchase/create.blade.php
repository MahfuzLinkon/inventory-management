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

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Purchase Date</label>
                                    <div>
                                        <input type="date" name="date" id="date" class="form-control">
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
                                    <select name="product_id" id="productId" class="selectJs form-control"  data-placeholder="Select Product">
                                        <option></option>
                                    </select>
                                    <div class="mt-2">
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3 float-right">
                                <button id="purchaseProduct" class="btn btn-sm btn-secondary">Purchase Product <span class="ml-2"><i class="gd-arrow-circle-down"></i></span></button>
                            </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title p-3" style="border: 1px solid #ddd">Product Purchase List</h4>
                        <form action="" onsubmit="return confirm('Are you sure ?')">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Description</th>
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="addRow" id="addRow">

                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="5"></td>
                                        <th>Total Amount : </th>
                                        <td><input type="text" class="form-control" id="estimatedAmount" style="background-color: #ddd" name="estimatedAmount" readonly value="0"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" id="confirmPurchase" class="btn btn-primary float-right">Confirm Purchase</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')


<script id="item-template" type="text/x-handlebars-template">
    <tr id="addOrDeleteItem">
        <input type="hidden" name="date[]" value="@{{ date }}">
        <input type="hidden" name="supplier_id[]" value="@{{ supplierId }}">
        <td>1</td>
        <td>
            <input type="hidden" name="product_id[]" value="@{{ productId }}">
            @{{ productName }}
        </td>
        <td>
            <input type="hidden" name="category_id[]" value="@{{ categoryId }}">
            @{{ categoryName }}
        </td>
        <td>
            <input type="number" class="form-control" placeholder="Enter Quantity" id="quantity" min="1" name="quantity[]" value="">
        </td>
        <td>
            <input type="number" class="form-control" placeholder="Enter unit price" id="unitPrice" name="unit_price[]" value="">
        </td>
        <td>
            <input type="text" class="form-control" placeholder="Enter Description" id="description" name="description[]" value="">
        </td>
        <td>
            <input type="number" class="form-control totalPrice" id="totalPrice" name="total_price[]" value="0" readonly value="">
        </td>
        <td>
            <button type="button" id="removeItem" class="btn btn-sm btn-danger"><i class="gd-close"></i></button>
        </td>
    </tr>
</script>

<script>
    $(document).ready(function(){
        $(document).on('click', '#purchaseProduct', function(){
            let date = $('#date').val();
            let supplierId = $('#supplierId').val();
            let categoryId = $('#categoryId').val();
            let categoryName = $('#categoryId').find('option:selected').text();
            let productId = $('#productId').val();
            let productName = $('#productId').find('option:selected').text();
            if(date == ''){
                $.notify("Purchase Date is required !", {globalPosition: 'top right', className: 'error'});
                return false;
            }
            if(supplierId == ''){
                $.notify("Supplier is required !", {globalPosition: 'top right', className: 'error'});
                return false;
            }
            if(categoryId == ''){
                $.notify("Category is required !", {globalPosition: 'top right', className: 'error'});
                return false;
            }
            if(productId == ''){
                $.notify("Product is required !", {globalPosition: 'top right', className: 'error'});
                return false;
            }
            let sourse = $("#item-template").html();
            let template = Handlebars.compile(sourse);
            data = {
                date: date,
                supplierId: supplierId,
                categoryId: categoryId,
                categoryName: categoryName,
                productId: productId,
                productName: productName,
            }
            let html = template(data);
            $('#addRow').append(html);
        });

        // remove product from list
        $(document).on('click', '#removeItem', function(e){
            e.preventDefault;
            $(this).closest('#addOrDeleteItem').remove();
            totalAmount();
        });

        $(document).on('keyup click', '#quantity, #unitPrice', function(){
            let quantity = $(this).closest('tr').find('input#quantity').val();
            let unitPrice = $(this).closest('tr').find('input#unitPrice').val();
            let totalPrice = quantity * unitPrice ;
            // $('#totalPrice').val(totalPrice);
            $(this).closest('tr').find('input#totalPrice').val(totalPrice);
            totalAmount();
        });
        // calculate total amount
        function totalAmount(){
            let sum = 0;
            $('.totalPrice').each(function(){
                let value = $(this).val();
                if(!isNaN(value) && value.length != 0){
                    sum += parseFloat(value);
                }
            });
            $('#estimatedAmount').val(sum);
        }

    });
</script>











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
                resetOption()
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
    function resetOption(){
        $('#productId').empty();
    }
</script>
@endsection
