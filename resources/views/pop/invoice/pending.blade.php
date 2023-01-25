@extends('admin.layouts.master')
@section('title')
Products Invoice
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
                        <h4 class="float-left">Pending Invoice</h4>
                        <a href="{{ route('invoice.index') }}" class="btn btn-info float-right">Manage Invoice</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Invoice No</th>
                                    <th>Customer Name</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ str_pad($invoice->invoice_no, 10, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $invoice->payment->customer->name }}</td>
                                    <td>{{ date('d-m-Y', strtotime($invoice->date)) }}</td>
                                    <td>{!! isset($invoice->description) ? Str::words($invoice->description, 20, '...') : 'No Description' !!}</td>
                                    <td><span class="badge badge-pill badge-{{ $invoice->status == 1 ? 'success' : 'warning' }}">{{ $invoice->status == 1 ? 'success' : 'pending' }}</span></td>
                                    <td>&#2547; {{ $invoice->payment->total_amount }}</td>
                                    <td>
                                        <a title="Approve Invoice" href="{{ route('invoice.details', ['id'=>$invoice->id]) }}" class="btn btn-info"><i class="gd-check-box"></i></a>
                                        <form action="{{ route('invoice.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('Are sure want to delete this ?')" style="display: inline-block">
                                            @csrf
                                            @method('delete')
                                            <button title="Delete Invoice" type="submit" class="btn btn-danger"><i class="gd-trash"></i></button>
                                        </form>
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
