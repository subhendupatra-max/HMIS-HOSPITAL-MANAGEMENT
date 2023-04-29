@extends('layouts.layout')

@section('content')

@can('charges add sub catagory')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Charges Sub Catagory</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('save-charges-sub-catagory-details') }}">
                @csrf
                <div class="">

                    <div class="form-group">
                        <label for="charges_sub_catagories_name" class="medicinelabel">Enter Sub Caragory Name <span class="text-danger">*</span></label>
                        <input type="text" id="charges_sub_catagories_name" name="charges_sub_catagories_name"  value="{{ old('charges_sub_catagories_name')}}" required>
                        @error('charges_sub_catagories_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="subcatagoryedit">
                        <label for="charges_catagories_id" class="subcatagorylabel">Catagory <span class="text-danger">*</span></label>
                        <select id="charges_catagories_id" class="form-control" name="charges_catagories_id">
                            <option value=" ">Select Charges Catagory </option>
                            @foreach ($catagory as $item)
                            <option value="{{$item->id}}">{{$item->charges_catagories_name}}</option>
                            @endforeach
                        </select>
                        @error('charges_catagory_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    </div>

                    <div class="form-group ">
                        <div class="subcatagoryedit">
                        <label for="description" class="subdescriptionlabel">Description</label>
                        <input type="text"id="description" name="description"value="{{ old('description') }}">
                        <small class="text-danger">{{ $errors->first('description') }}</small>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Sub Catagory</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Sub Catagory List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Catagory Name</th>
                                <th class="border-bottom-0">Catagory </th>
                                <th class="border-bottom-0">Description</th>
                                @can('charges edit sub catagory','charges delete sub catagory')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcatagory as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->charges_sub_catagories_name}}</td>
                                <td>{{ $item->charges_catagory->charges_catagories_name}}</td>
                                <td>{{ $item->description}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('charges edit sub catagory')
                                            <a class="dropdown-item" href="{{ route('edit-charges-sub-catagory-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('charges delete sub catagory')
                                            <a class="dropdown-item" href="{{ route('delete-charges-sub-catagory-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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
