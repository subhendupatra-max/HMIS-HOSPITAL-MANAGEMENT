@extends('layouts.layout')

@section('content')

@can('edit medicine unit')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Medicine Unit</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('update-medicine-unit-details') }}">
                @csrf
                <div class="">
                  <input type="hidden" name="id" value="{{ $editUnit->id }}" />
                    <div class="form-group">
                        <label for="medicine_unit_name" class="form-label">Medicine Unit name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="medicine_unit_name" name="medicine_unit_name" value="{{ $editUnit->medicine_unit_name }}" required>
                        @error('medicine_unit_name')
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
            <div class="card-title">Medicine Unit List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Unit Name</th>
                                @can('edit medicine unit','delete medicine unit')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unit as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->medicine_unit_name}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit medicine unit')
                                            <a class="dropdown-item" href="{{ route('edit-medicine-unit-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete medicine unit')
                                            <a class="dropdown-item" href="{{ route('delete-medicine-unit-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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