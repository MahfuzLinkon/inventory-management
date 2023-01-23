@extends('admin.layouts.master')
@section('title')
Purchase Pending list
@endsection
@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Purchase Products</div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Pending Purchase</h4>
                        <a href="{{ route('purchases.create') }}" class="btn btn-info float-right">Purchase New</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Purchase No</th>
                                    <th>Supplier</th>
                                    <th>Catgory</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Total Price</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchases as $purchase)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $purchase->product->name }}</td>
                                    <td>{{ str_pad($purchase->purchase_no, 10, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $purchase->supplier->name }}</td>
                                    <td>{{ $purchase->category->name }}</td>
                                    <td>{{ $purchase->unit_price }}</td>
                                    <td>{{ $purchase->quantity }}</td>
                                    <td>{{ $purchase->product->unit->name }}</td>
                                    <td>{{ $purchase->total_price }}</td>
                                    <td>{!! isset($purchase->description) ? Str::words($purchase->description, 20, '...') : 'No Description' !!}</td>

                                    <td><span class="badge badge-pill badge-{{ $purchase->status == 1 ? 'success' : 'warning' }}">{{ $purchase->status == 1 ? 'success' : 'pending' }}</span></td>
                                    <td>
                                        @if ($purchase->status != 1)
                                        <a title="Approve Purchase" onclick="return confirm('Are sure want to approve this ?')" href="{{ route('purchase.status', ['id'=>$purchase->id]) }}" class="btn btn-info"><i class="gd-check-box"></i></a>
                                        @else
                                        <a title="See Purchase Details" href="" class="btn btn-success"><i class="gd-info-alt"></i></a>
                                        @endif
                                        @if ($purchase->status != 1)
                                        <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" onsubmit="return confirm('Are sure want to delete this ?')" style="display: inline-block">
                                            @csrf
                                            @method('delete')
                                            <button title="Delete Purchase" type="submit" class="btn btn-danger"><i class="gd-trash"></i></button>
                                        </form>
                                        @endif

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
