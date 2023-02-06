@extends('admin.layouts.master')
@section('title')
Daily Purchase Report
@endsection
@section('content')
<div class="py-4 px-3 px-md-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card pb-12">
                <div class="card-header">
                    <div class="float-left">
                        <h3>Purchase Report</h3>
                        <p>Date: <strong>{{ date('d-m-Y', strtotime($startDate)) }}</strong> To <strong>{{ date('d-m-Y', strtotime($endDate)) }}</strong></p>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Supplier Name</th>
                                <th>Purchase No</th>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sum = 0;
                            @endphp
                            @foreach ($purchases as $purchase)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $purchase->supplier->name }}</td>
                                <td>#{{ Str::padLeft( $purchase->purchase_no, '10', '0') }}</td>
                                <td>{{ date('d-m-Y', strtotime($purchase->date)) }}</td>
                                <td>{{ $purchase->total_price }}</td>
                            </tr>
                            @php
                                $sum+= $purchase->total_price;
                            @endphp
                            @endforeach
                            <tr>
                                <th colspan="4"> Total Amount</th>
                                <td>{{ $sum }}</td>
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
