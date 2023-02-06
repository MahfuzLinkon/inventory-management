@extends('admin.layouts.master')
@section('title')
Credit Customer
@endsection
@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Credit Customer</div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">All Credit Customer</h4>
                        <a href="{{ route('customer.credit-pdf') }}" class="btn btn-info float-right">Print</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th>Due Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($credits as $credit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $credit->customer->name }}</td>
                                    <td>{{ $credit->customer->phone }}</td>
                                    <td>#{{ str_pad($credit->invoice->invoice_no, 10, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($credit->invoice->date)) }}</td>
                                    <td>{{ $credit->total_amount }}</td>
                                    <td>{{ $credit->due_amount }}</td>
                                    <td>
                                        <a title="Make Payment" href="{{ route('customer.payment', ['invoice_id'=> $credit->invoice_id]) }}" class="btn btn-primary">Make Payment</a>
                                        <a title="Details" href="{{ route('customer.payment-summary', ['invoice_id'=> $credit->invoice_id]) }}" class="btn btn-secondary"><i class="gd-info"></i></a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
