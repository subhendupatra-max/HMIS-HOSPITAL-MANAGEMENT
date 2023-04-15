@extends('layouts.layout')

@section('content')

@can('edit pathology unit')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Pathology Unit</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('update-pathology-unit-details') }}">
                @csrf
                <div class="">
                  <input type="hidden" name="id" value="{{ $editUnit->id }}">
                    <div class="form-group">
                        <label for="unit_name" class="form-label">Pathology Unit name <span class="text-danger">*</span></label>
                        <textarea class="content" id="unit_name" name="unit_name" name="example" required >{{ $editUnit->unit_name }}</textarea>
                        @error('unit_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Unit</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Pathology Unit List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Unit Name</th>
                                @can('edit pathology unit','delete pathology unit')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unit as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{!! $item->unit_name !!}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit pathology unit')
                                            <a class="dropdown-item" href="{{ route('edit-pathology-unit-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete pathology unit')
                                            <a class="dropdown-item" href="{{ route('delete-pathology-unit-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/div    route('editRole',['id'=>base64_encode($item->id)]) -->
</div>
@endsection
