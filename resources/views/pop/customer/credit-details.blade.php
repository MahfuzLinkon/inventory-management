@extends('admin.layouts.master')
@section('title')
Customer Payment Summary
@endsection
@section('content')
<div class="py-4 px-3 px-md-4">

    <div class="mb-3 mb-md-4 d-flex justify-content-between">
        <h4 class="float-left">Customer Payment Summary</h4>
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
                        <a href="{{ url()->previous() }}" class="btn btn-info"><i class="gd-arrow-left"></i></a>
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
                    <table class="table table-bordered">
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
                            <tr>
                                <th colspan="5" class="text-center">Payment Summary</th>
                            </tr>
                            <tr class="text-center">
                                <th colspan="3">Date</th>
                                <th colspan="2">Amount</th>
                            </tr>
                            @foreach ($payment['payment_details'] as $details)
                            <tr class="text-center">
                                <td colspan="3">{{ date('d-m-Y', strtotime($details->date)) }}</td>
                                <td colspan="2">{{ $details->current_paid_amount }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-5 mb-5 float-right">
                        <button title="Print Invoice" type="button" class="mr-2 btn btn-success" onclick="window.print()"><i class="gd-printer"></i></button>
                        <button title="Download Invoice" class="btn btn-info "><i class="gd-download"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
