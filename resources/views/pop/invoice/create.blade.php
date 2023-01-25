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
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Purchase Products</h4>
                        <a href="{{ route('purchases.index') }}" class="btn btn-info float-right">Manage Purchase</a>
                    </div>
                    <div class="card-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Purchase Date</label>
                                    <div>
                                        <input type="date" name="date" value="{{ $date }}" id="date" class="form-control">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Category Name</label>
                                    <div>
                                        <select name="category_id" id="categoryId" class="selectJs form-control" data-placeholder="Select Product Supplier">
                                            <option></option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="mt-2">
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
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
                                <div class="col-md-3">
                                    <label for="">Stock</label>
                                    <input type="number" name="stock" id="stock" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="mt-3 float-right">
                                <button id="addMore" class="btn btn-sm btn-secondary">Add More <span class="ml-2"><i class="gd-plus"></i></span></button>
                            </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title p-3" style="border: 1px solid #ddd">Product Invoice List</h4>
                        <form action="{{ route('invoice.store') }}" method="POST" onsubmit="return confirm('Are you sure ?')">
                            @csrf
                            <table class="table table-sm table-bordered ">
                                <thead>
                                    <tr class="text-center">
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th width="17%">Quantity</th>
                                        <th width="12%">Unit Price</th>
                                        <th width="12%">Total Price</th>
                                        <th width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="addRow" id="addRow">

                                </tbody>
                                <tbody>
                                    <tr>
                                        <th class="text-left" colspan="4">Discount Amount: </th>
                                        <td><input type="number" name="discount_amount" class="form-control" id="discountAmount"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th class="text-left" colspan="4">Grand Total : </th>
                                        <td><input type="text" class="form-control" id="estimatedAmount" style="background-color: #ddd" name="grand_total" readonly value="0"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-5">
                                        <div>
                                            <label for="">Payment Status</label>
                                            <select name="paid_status" id="paymetStatus" class="form-control">
                                                <option selected disabled>Select Payment status</option>
                                                <option value="2">Partial Payment</option>
                                                <option value="1">Full Paid</option>
                                                <option value="0">Full Due</option>
                                            </select>
                                        </div>
                                        <div class="mt-3" id="paymentAmount" style="display: none">
                                            <label for="">Payment Amount</label>
                                            <input type="number" name="paid_amount" class="form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div>
                                            <label for="">Select Customer</label>
                                            <select name="customer_id" id="customerId" class="form-control">
                                                <option selected disabled>Select Customer</option>
                                                <option value="0">New Customer</option>
                                                @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name . ' - ' . $customer->phone }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-3" id="newCustomer" style="display: none">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" placeholder="Enter Name" name="name" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" placeholder="Enter phone number" name="phone" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <input type="email" placeholder="Enter email address" name="email" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="confirmInvoice" class="mt-3 btn btn-primary float-right">Confirm</button>
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
        <input type="hidden" id="date" name="date" value="@{{ date }}">
        <td>
            <input type="hidden" id="productId" name="product_id[]" value="@{{ productId }}">
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
            <input type="number" class="form-control" placeholder="Unit price" id="unitPrice" name="unit_price[]" value="">
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
        $(document).on('click', '#addMore', function(){
            let date = $('#date').val();
            let categoryId = $('#categoryId').val();
            let categoryName = $('#categoryId').find('option:selected').text();
            let productId = $('#productId').val();
            let productName = $('#productId').find('option:selected').text();
            if(date == ''){
                $.notify("Purchase Date is required !", {globalPosition: 'top right', className: 'error'});
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

            $('#discountAmount').trigger('keyup');
        });
        // discount amount
        $(document).on('keyup', '#discountAmount', function(){
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

            let discountAmount = parseFloat($('#discountAmount').val());
            if(!isNaN(discountAmount)){
                sum -= discountAmount;
            }

            $('#estimatedAmount').val(sum);
        }
    });
</script>

<script>
    $(document).on('change', '#paymetStatus', function(){
        let paymetStatus = $(this).val();
        if(paymetStatus == 2){
            $('#paymentAmount').show();
        }else{
            $('#paymentAmount').hide();
        }
    });

    $(document).on('change', '#customerId', function(){
        let customerId = $(this).val();

        if(customerId == 0){
            $('#newCustomer').show();
        }else{
            $('#newCustomer').hide();
        }
    });
</script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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
                console.log(response);
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

    $(document).on('change', '#productId', function(){
        let productId = $(this).val();
        // alert(productId);
        $.ajax({
            url: "{{ route('get-product.quantity') }}",
            type: "POST",
            dataTypr: "JSON",
            data: {product_id: productId},
            success: function(response){
                // console.log(response.name);
                $('#stock').val(response.quantity)

            }
        });
    });

</script>
@endsection
