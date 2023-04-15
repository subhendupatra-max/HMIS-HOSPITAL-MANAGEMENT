@extends('layouts.layout')

@section('content')

@can('Add blood unit type')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Uint Types</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-blood-unit-type') }}">
                @csrf
                <div class="">

                    <div class="form-group">
                        <label for="blood_unit_types" class="form-label">Unit Type <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="blood_unit_types" name="blood_unit_types" placeholder="Enter Product Name" value="{{ old('blood_unit_types')}}" required>
                        @error('blood_unit_types')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Uint Types</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Unit Type List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Unit Type Name</th>
                                @can('Edit blood unit type','delete blood unit type')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bloodUnitType as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->blood_unit_types}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('Edit blood unit type')
                                            <a class="dropdown-item" href="{{ route('edit-blood-unit-type',['id'=> base64_encode($item->id) ]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('Delete blood unit type')
                                            <a class="dropdown-item" href="{{ route('delete-blood-unit-type',['id'=> base64_encode($item->id)]) }}"><i class="fa fa-trash"></i> Delete</a>
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