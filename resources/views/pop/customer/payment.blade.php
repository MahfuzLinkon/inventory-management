@extends('admin.layouts.master')
@section('title')
Customer Payment Details
@endsection
@section('content')
<div class="py-4 px-3 px-md-4">

    <div class="mb-3 mb-md-4 d-flex justify-content-between">
        <h4 class="float-left">Customer Payment Details</h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-left">
                        <h4>Invoice No: #{{ str_pad($payment->invoice->invoice_no, 10, '0', STR_PAD_LEFT) }}</h4>
                        <h5>Date: {{ date('d-m-Y', strtotime($payment->date)) }}</h5>
                    </div>
                    <div class="float-right">
                        <a href="{{ route('customer.credit') }}" class="btn btn-info"><i class="gd-arrow-left"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <h5>Cutomer Info:</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-left">
                                <p><strong>Name: </strong></p>
                                <p><strong>Phone: </strong></p>
                                <p><strong>Email: </strong></p>
                            </div>
                            <div class="float-left ml-3">
                                <p>{{ $payment->customer->name }}</p>
                                <p>{{ $payment->customer->phone }}</p>
                                <p>{{ $payment->customer->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p><strong>Product List: </strong></p>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subTotal = 0;
                            @endphp
                            @foreach ($payment['invoice_details'] as $details)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $details->product->name }}</td>
                                <td>{{ $details->quantity }}</td>
                                <td>{{ $details->unit_price }}</td>
                                <td>{{ $details->total_price }}</td>
                            </tr>
                            @php
                            $subTotal += $details->total_price;
                            @endphp
                            @endforeach
                            <tr>
                                <th colspan="4">Sub Total</th>
                                <td>{{ $subTotal }}</td>
                            </tr>
                            <tr>
                                <th colspan="4">Discount Amount</th>
                                <td>{{ $payment->discount_amount }}</td>
                            </tr>
                            <tr>
                                <th colspan="4">Grand Total</th>
                                <td><strong>{{ $payment->total_amount }}</strong></td>
                            </tr>
                            <tr>
                                <th colspan="4">Paid Amount</th>
                                <td>{{ $payment->paid_amount }}</td>
                            </tr>
                            <tr>
                                <th colspan="4">Due Amount</th>
                                <td><strong>{{ $payment->due_amount }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Make Payment: </h4>
                    <form action="{{ route('customer.payment-store', ['invoice_id' => $payment->invoice_id]) }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $payment->due_amount }}" name="due_amount">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Paid Status</label>
                                <select name="paid_status" id="paidStatus" class="form-control">
                                    <option selected disabled>Select Payment status</option>
                                    <option value="2">Partial Payment</option>
                                    <option value="1">Full Paid</option>
                                </select>
                            </div>
                            <div class="col-md-4" style="display: none" id="paidAmount">
                                <label for="">Paid Amount</label>
                               <input type="number" name="new_payment_amount" class="form-control">
                            </div>
                            <div class="col-md-4">
                               <input type="Submit"  class="btn btn-info mt-5">
                            </div>
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
    $(document).on('change', '#paidStatus', function(){
        let paidStatus = $(this).val();
        if(paidStatus == '2'){
            $('#paidAmount').show();
        }else{
            $('#paidAmount').hide();
        }
    });
</script>
@endsection
