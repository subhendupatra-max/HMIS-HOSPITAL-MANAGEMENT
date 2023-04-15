@extends('layouts.layout')

@section('content')

@can('add pathology parameter')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Pathology Parameter</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-pathology-parameter-details') }}">
                @csrf
                <div class="">

                    <div class="form-group">
                        <label for="parameter_name" class="form-label">Pathology Parameter name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="parameter_name" name="parameter_name" placeholder="Enter Parameter Name" value="{{ old('parameter_name')}}" required>
                        @error('parameter_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="reference_range" class="form-label">Reference Range </label>
                        <textarea  class="content" id="reference_range" name="reference_range" > </textarea>

                        @error('reference_range')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="unit_id" class="form-label">Unit Name </label>
                        <select name="unit_id" class="form-control select2-show-search" id="unit_id">
                            <option value="">Select Unit Name ... </option>
                            @foreach($unit as $items)
                            <option value="{{$items->id}}" >{!! $items->unit_name !!}</option>
                            @endforeach
                        </select>
                        @error('unit_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description </label>
                        <textarea  class="form-control" id="description" name="description"> {{ old('description') }} </textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Parameter</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Pathology Parameter List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Parameter Name</th>
                                <th class="border-bottom-0">Reference Range</th>
                                <th class="border-bottom-0">Unit Name</th>
                                <th class="border-bottom-0">Description</th>
                                @can('edit pathology parameter','delete pathology parameter')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parameter as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->parameter_name}}</td>
                                <td>{!! $item->reference_range !!}</td>
                                <td>{!! @$item->unitName->unit_name !!}</td>
                                <td>{{ $item->description}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit pathology parameter')
                                            <a class="dropdown-item" href="{{ route('edit-pathology-parameter-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete pathology parameter')
                                            <a class="dropdown-item" href="{{ route('delete-pathology-parameter-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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
