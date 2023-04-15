@extends('layouts.layout')

@section('content')

@can('edit symptoms head')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Symptoms Head</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('update-symptoms-head-details') }}">
                @csrf
                <div class="">
                <input type="hidden" value="{{ $editSymptomsHead->id}}" name="id">

                    <div class="form-group">
                        <label for="symptoms_head_name" class="form-label">Symptoms Head Name</label>
                        <input type="text" class="form-control" id="symptoms_head_name" name="symptoms_head_name" value="{{ $editSymptomsHead->symptoms_head_name }}" required>
                        @error('symptoms_head_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="symptoms_type" class="form-label">Symptoms Type<span class="text-danger">*</span></label>
                        <select id="symptoms_type" class="form-control" name="symptoms_type">
                            <option value=" ">Select Symptoms Type</option>
                            @foreach ($symptomsType as $item)
                            <option value="{{$item->id}}" {{ $item->id == $editSymptomsHead->symptoms_type ? 'selected' : " " }}>{{$item->symptoms_type_name}}</option>
                            @endforeach
                        </select>
                        @error('symptoms_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" > {{ $editSymptomsHead->description }} </textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                  

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Edit Head</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Symptoms Head List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Symptoms Head</th>
                                <th class="border-bottom-0">Symptoms Type</th>
                                <th class="border-bottom-0">Description</th>
                                @can('delete symptoms type','edit symptoms type')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($symptomsHead as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->symptoms_head_name }}</td>
                                <td>{{ @$item->symptomsTypeall->symptoms_type_name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit symptoms head')
                                            <a class="dropdown-item" href="{{ route('edit-symptoms-head-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete symptoms head')
                                            <a class="dropdown-item" href="{{ route('delete-symptoms-head-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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