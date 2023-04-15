@extends('layouts.layout')

@section('content')

@can('charges add catagory')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Charges Catagory</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-charges-catagory-details') }}">
                @csrf
                <div class="">
                  
                    <div class="form-group">
                        <label for="charges_catagories_name" class="form-label">Charges Catagory name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="charges_catagories_name" name="charges_catagories_name" placeholder="Enter Charges Caragory Name" value="{{ old('charges_catagories_name')}}" required>
                        @error('charges_catagories_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group ">
                        <label for="description" class="form-label">Description</label>
                        <textarea  class="form-control" id="description" name="description"> {{ old('description') }} </textarea>
                        <small class="text-danger">{{ $errors->first('description') }}</small>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Catagory</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Charges Catagory List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Catagory Name</th>
                                <th class="border-bottom-0">Description</th>
                                @can('charges edit catagory','charges delete catagory')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($catagory as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->charges_catagories_name}}</td>
                                <td>{{ $item->description}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('charges edit catagory')
                                            <a class="dropdown-item" href="{{ route('edit-charges-catagory-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('charges delete catagory')
                                            <a class="dropdown-item" href="{{ route('delete-charges-catagory-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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