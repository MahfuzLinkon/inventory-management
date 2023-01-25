@extends('admin.layouts.master')
@section('title')
Approve invoice details
@endsection
@section('content')
<div class="py-4 px-3 px-md-4">

    <div class="mb-3 mb-md-4 d-flex justify-content-between">
        <div class="h3 mb-0">Invoice</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-left">Invoice Details</h4>
                    <a href="{{ route('invoice.pending') }}" class="btn btn-info float-right">Panding Invoice</a>
                </div>
                <div class="card-body">
                    <h4>Invoice No: #{{ str_pad($invoice->invoice_no, 10, '0', STR_PAD_LEFT) }}</h4>
                    <h5>Date: {{ date('d-m-Y', strtotime($invoice->date)) }}</h5>
                </div>
                <div class="card-body">
                    <h5>Cutomer Info:</h5>
                    <div class="row">
                        <div class="col-md-1">
                            <p><strong>Name: </strong></p>
                            <p><strong>Phone: </strong></p>
                            <p><strong>Email: </strong></p>
                        </div>
                        <div class="col-md-10">
                            <p>{{ $invoice->payment->customer->name }}</p>
                            <p>{{ $invoice->payment->customer->phone }}</p>
                            <p>{{ $invoice->payment->customer->email }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p><strong>Product List: </strong></p>
                    <form action="{{ route('invoice.approve', ['id'=>$invoice->id]) }}" method="POST">
                        @csrf
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Product Name</th>
                                    @if ($invoice->status !=1 )
                                    <th>Stock</th>
                                    @endif
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            @php
                                $sum = 0;
                            @endphp
                            <tbody>
                                @foreach ($invoice['invoice_details'] as $details)
                                <tr>
                                    <input type="hidden" name="product_id[]" value="{{ $details->product->id }}">
                                    <input type="hidden" name="quantity[{{ $details->id }}]" value="{{ $details->quantity }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $details->product->name }}</td>
                                    @if ($invoice->status !=1 )
                                    <td style="background-color: #ddd">{{ $details->product->quantity }}</td>
                                    @endif
                                    <td>{{ $details->quantity }}</td>
                                    <td>{{ $details->unit_price }}</td>
                                    <td>{{ $details->total_price }}</td>
                                </tr>
                                @php
                                    $sum += $details->total_price;
                                @endphp
                                @endforeach
                                <tr>
                                    <th colspan="{{ $invoice->status !=1 ? '5' : '4'}}">Sub Total</th>
                                    <td>{{ $sum }}</td>
                                </tr>
                                <tr>
                                    <th colspan="{{ $invoice->status !=1 ? '5' : '4'}}">Discount Amount</th>
                                    <td>{{ $invoice->payment->discount_amount }}</td>
                                </tr>
                                <tr>
                                    <th colspan="{{ $invoice->status !=1 ? '5' : '4'}}">Grand Total</th>
                                    <td>{{ $invoice->payment->total_amount }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @if ($invoice->status !=1 )
                        <div class="mt-5 mb-5">
                            <button class="btn btn-info float-right">Approve Invoice</button>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection
