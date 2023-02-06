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
                    <h4 class="float-left">Daily Invoice Report</h4>
                    <a href="{{ route('invoice.pending') }}" class="btn btn-info float-right">Panding Invoice</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('invoice.daily-search') }}" target="_blank" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Start Date</label>
                                <input type="date" class="form-control" placeholder="Start Date" name="start_date">
                                <div class="mt-2">
                                    @error('start_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">End Date</label>
                                <input type="date" class="form-control" name="end_date">
                                <div class="mt-2">
                                    @error('end_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label"></label>
                                <input type="submit" class="btn btn-success mt-5" value="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
