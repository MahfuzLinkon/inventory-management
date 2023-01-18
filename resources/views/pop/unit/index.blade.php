@extends('admin.layouts.master')
@section('title')
    Manage Units
@endsection
@section('content')
    <div class="py-4 px-3 px-md-4">

        <div class="mb-3 mb-md-4 d-flex justify-content-between">
            <div class="h3 mb-0">Units</div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Manage Units</h4>
                        <a href="{{ route('units.create') }}" class="btn btn-success float-right">Add New</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($units as $unit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $unit->name }}</td>
                                    <td>{{ $unit->createdBy->name }}</td>
                                    <td>{{ isset($unit->updatedBy->name) ? $unit->updatedBy->name : '' }}</td>
                                    <td>{{ $unit->status == 1 ? 'Active' : 'Deactive' }}</td>
                                    <td>
                                        <a href="{{ route('units.status', ['id'=>$unit->id]) }}" class="btn btn-{{ $unit->status == 1 ? 'warning' : 'success' }}"><i class="gd-arrow-{{ $unit->status == 1 ? 'down' : 'up' }}"></i></a>
                                        <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-info"><i class="gd-pencil-alt"></i></a>
                                        {{-- <a href="" class="btn btn-danger"><i class="gd-trash"></i></a> --}}
                                        <form action="{{ route('units.destroy', $unit->id) }}" method="POST" onsubmit="return confirm('Are sure want to delete this ?')" style="display: inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger"><i class="gd-trash"></i></button>
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
