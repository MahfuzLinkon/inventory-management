@extends('admin.layouts.master')
@section('title')
Daily Invoice Report
@endsection
@section('content')
<div class="py-4 px-3 px-md-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card pb-12">
                <div class="card-header">
                    <div class="float-left">
                        <h3>Invoice Report</h3>
                        <p>Date: <strong>{{ date('d-m-Y', strtotime($startDate)) }}</strong> To <strong>{{ date('d-m-Y', strtotime($endDate)) }}</strong></p>
                    </div>
                    <a href="{{ route('invoice.pending') }}" class="btn btn-info float-right">Panding Invoice</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Customer Name</th>
                                <th>Invoice No</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sum = 0;
                            @endphp
                            @foreach ($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $invoice->payment->customer->name }}</td>
                                <td>#{{ Str::padLeft($invoice->invoice_no, '10', '0') }}</td>
                                <td>{{ date('d-m-Y', strtotime($invoice->date)) }}</td>
                                <td>{{  $invoice->description == null ? 'No Description' : $invoice->description }}</td>
                                <td>{{  $invoice->payment->total_amount }} &#x9F3;</td>
                                @php
                                    $sum += $invoice->payment->total_amount;
                                @endphp
                            </tr>
                            @endforeach
                            <tr>
                                <th colspan="5">Total Sell: </th>
                                <td >{{ $sum }} &#x9F3;</td>
                            </tr>
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
