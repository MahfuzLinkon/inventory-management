@extends('admin.layouts.master')

@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Dashboard</div>
        </div>

        <div class="row">


            <div class="col-md-6 col-xl-4 mb-3 mb-xl-4">
                <!-- Widget -->
                <div class="card flex-row align-items-center p-3 p-md-4">
                    <div class="icon icon-lg bg-soft-primary rounded-circle mr-3">
                        <i class="gd-bar-chart icon-text d-inline-block text-primary"></i>
                    </div>
                    <div>
                        <h4 class="lh-1 mb-1">{{ $customers }}</h4>
                        <h6 class="mb-0">Total Customers</h6>
                    </div>
                    <i class="gd-arrow-up icon-text d-flex text-success ml-auto"></i>
                </div>
                <!-- End Widget -->
            </div>

            <div class="col-md-6 col-xl-4 mb-3 mb-xl-4">
                <!-- Widget -->
                <div class="card flex-row align-items-center p-3 p-md-4">
                    <div class="icon icon-lg bg-soft-secondary rounded-circle mr-3">
                        <i class="gd-wallet icon-text d-inline-block text-secondary"></i>
                    </div>
                    <div>
                        <h4 class="lh-1 mb-1">{{ $suppliers }}</h4>
                        <h6 class="mb-0">Total Suppliers</h6>
                    </div>
                    <i class="gd-arrow-down icon-text d-flex text-danger ml-auto"></i>
                </div>
                <!-- End Widget -->
            </div>

            <div class="col-md-6 col-xl-4 mb-3 mb-xl-4">
                <!-- Widget -->
                <div class="card flex-row align-items-center p-3 p-md-4">
                    <div class="icon icon-lg bg-soft-warning rounded-circle mr-3">
                        <i class="gd-money icon-text d-inline-block text-warning"></i>
                    </div>
                    <div>
                        <h4 class="lh-1 mb-1">{{ $categories }}</h4>
                        <h6 class="mb-0">Total Categrories</h6>
                    </div>
                    <i class="gd-arrow-up icon-text d-flex text-success ml-auto"></i>
                </div>
                <!-- End Widget -->
            </div>

        </div>





        <div class="row">
            <div class="col-12">
                <div class="card mb-3 mb-md-4">
                    <div class="card-header">
                        <h5 class="font-weight-semi-bold mb-0">Recent Invoice</h5>
                    </div>

                    <div class="card-body pt-0">
                        <div class="table-responsive-xl">
                            <table class="table text-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th class="font-weight-semi-bold border-top-0 py-2">Sl</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">Invoice NO</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">Customer Name</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">Date</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">Description</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">Status</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">Total Amount</th>
                                    <th class="font-weight-semi-bold border-top-0 py-2">Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
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
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
