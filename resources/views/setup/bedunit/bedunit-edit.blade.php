@extends('layouts.layout')

@section('content')

@can('edit bed unit')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Bed Unit</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('update-bed-unit-details') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $editBedUnit->id }}">
                <div class="">
                    <div class="form-group">
                        <label for="bedUnit_name" class="form-label"></label>
                        <input type="text" class="form-control" id="bedUnit_name" name="bedUnit_name" placeholder="Enter Bed Unit Name" value="{{ $editBedUnit->bedUnit_name }}" required>
                        @error('bedUnit_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Bed Unit</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Bed Unit List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Bed Unit Name</th>
                                @can('delete bed unit','edit bed unit')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bedUnit as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->bedUnit_name }}</td>
                                <td>
                                <div class="card-options">
                                    <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right" >
                                        @can('edit bed unit')
                                        <a class="dropdown-item" href="{{ route('edit-bed-unit-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                        @endcan

                                        @can('delete bed unit')
                                        <a class="dropdown-item" href="{{ route('delete-bed-unit-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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