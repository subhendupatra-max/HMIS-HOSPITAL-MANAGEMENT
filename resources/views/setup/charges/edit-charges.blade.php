@extends('layouts.layout')

@section('content')

@can('edit charges')
<div class="col-lg-12 col-xl-4 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Charges</h4>
        </div>
        @if (session('success'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
        @endif
        <div class="card-body">
            <form method="POST" action="{{ route('update-charges-details') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $editCharges->id }}">
                <div class="">
                <div class="form-group">
                        <label for="charges_catagory_id" class="form-label">Charges Catagory </label>
                        <select id="charges_catagory_id" class="form-control select2-show-search" name="charges_catagory_id">
                        <option value=" ">Select Charges Catagory </option>
                            @foreach (@$charges_catagory_id as $item)
                            <option value="{{$item->id}}" {{ @$item->id == $editCharges->charges_catagory_id ? 'selected' : " " }}>{{$item->charges_catagories_name}}</option>
                            @endforeach
                        </select>
                        @error('charges_catagory_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="charges_sub_catagory_id" class="form-label">Charges Sub Catagory</label>
                        <select id="charges_sub_catagory_id" class="form-control select2-show-search" name="charges_sub_catagory_id">
                            <option value=" ">Select Charges Sub Catagory </option>
                            @foreach ($charges_sub_catagory_id as $item)
                            <option value="{{$item->id}}" {{ @$item->id == $editCharges->charges_sub_catagory_id ? 'selected' : " " }}>{{$item->charges_sub_catagories_name}}</option>
                            @endforeach
                        </select>
                        @error('charges_sub_catagory_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="charges_units_id" class="form-label">Charges Unit</label>
                        <select id="charges_units_id" class="form-control select2-show-search" name="charges_units_id">
                            <option value=" ">Select Charges Unit </option>
                            @foreach ($charges_units_id as $item)
                            <option value="{{$item->id}}" {{ @$item->id == $editCharges->charges_unit_id ? 'selected' : " " }}>{{$item->charges_units_name}}</option>
                            @endforeach
                        </select>
                        @error('charges_units_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="charges_name" class="form-label">Charges name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="charges_name" name="charges_name" placeholder="Enter Charges Name" value="{{ $editCharges->charges_name }}" required>
                        @error('charges_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="standard_charges" class="form-label">Standard Charges  <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="standard_charges" name="standard_charges" value="{{ $editCharges->standard_charges }}" required>
                        @error('standard_charges')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror     
                    </div>
                    
                    <div class="form-group ">
                        <label for="standard_charges" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" @if(isset($editCharges->date)) value="{{date('Y-m-d',strtotime($editCharges->date)) }}" @endif>
                        <small class="text-danger">{{ $errors->first('date') }}</small>
                    </div>

                    <div class="form-group ">
                        <label for="description" class="form-label">Description</label>
                        <textarea  class="form-control" id="description" name="description"> {{ @$editCharges->description }} </textarea>
                        <small class="text-danger">{{ $errors->first('description') }}</small>
                    </div>


                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-0">Add Charges</button>
            </form>
        </div>
    </div>
</div>
@endcan
<div class="col-lg-12 col-xl-8 col-md-12 col-sm-12">
    <!--div-->
    <div class="card">
        <div class="card-header">
            <div class="card-title">Charges List</div>
        </div>
        <div class="card-body">
            <div class="">
                <div class="table-responsive">
                    <table id="example" class="table table-borderless text-nowrap key-buttons">
                    <thead>
                            <tr>
                                <th class="border-bottom-0">Sl. No</th>
                                <th class="border-bottom-0">Catagory Name</th>
                                <th class="border-bottom-0">Sub Catagory Name</th>
                                <th class="border-bottom-0">Unit Name</th>
                                <th class="border-bottom-0">Charges name</th>
                                <th class="border-bottom-0">Standard Charges </th>
                                <th class="border-bottom-0">Date</th>
                                <th class="border-bottom-0">Description</th>
                                @can('delete charges','edit charges')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($charges as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->charges_catagory->charges_catagories_name}}</td>
                                <td>{{ $item->charges_sub_catagory->charges_sub_catagories_name}}</td>
                                <td>{{ @$item->charges_unit->charges_units_name}}</td>
                                <td>{{ $item->charges_name}}</td>
                                <td>{{ $item->standard_charges}}</td>
                                <td>{{ $item->date}}</td>
                                <td>{{ $item->description}}</td>
                                <td>
                                    <div class="card-options">
                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <i class="fa fa-caret-down"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('edit charges')
                                            <a class="dropdown-item" href="{{ route('edit-charges-details',['id'=>$item->id]) }}"><i class="fa fa-edit"></i> Edit</a>
                                            @endcan

                                            @can('delete charges')
                                            <a class="dropdown-item" href="{{ route('delete-charges-details',['id'=>$item->id]) }}"><i class="fa fa-trash"></i> Delete</a>
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
