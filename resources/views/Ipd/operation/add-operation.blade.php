@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Add Operation
                </div>

                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('ipd.include.menu')
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('message.notification')
        <div class="card-body ">
            <form action="{{ route('save-medicaiton-dose') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ipd_id" value="{{ $ipd_details->id }}" />
                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="operation_department" class="form-label">operation_department <span class="text-danger">*</span></label>
                        <select name="operation_department" class="form-control select2-show-search" id="operation_department" onchange="getOperation_Department(this.value)">
                            <option value="">Select</option>
                            @foreach ($departments as $key => $department)
                            <option value="{{$department->id}}"> {{$department->department_name}}</option>
                            @endforeach
                        </select>
                        @error('operation_department')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="operation_catagory" class="form-label"> Operation Category <span class="text-danger">*</span></label>
                        <select name="operation_catagory" class="form-control select2-show-search" id="operation_catagory" onchange="getCatagory(this.value)">
                            <option value="">Select..</option>
                        </select>
                        @error('operation_catagory')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="medicine_catagory_id" class="form-label">Medicine Category <span class="text-danger">*</span></label>
                        <select class="form-control select2-show-search select2-hidden-accessible" name="medicine_catagory_id" id="medicine_catagory_id" required>
                            <optgroup>
                                <option value=" ">Select Medicine Category</option>
                                @foreach ($medicine_catagory as $item)
                                <option value="{{$item->id}}">{{$item->medicine_catagory_name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        @error('medicine_catagory_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="medicine_name" class="form-label">Medicine Name <span class="text-danger">*</span></label>
                        <select name="medicine_name" id="medicine_name" class="form-control select2-show-search">
                            <option value="">Select Medicine Name</option>
                        </select>
                        @error('medicine_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="dosage" class="form-label">Dosage <span class="text-danger">*</span></label>
                        <select name="dosage" id="dosage" class="form-control select2-show-search">
                            <option value="">Select Dosage</option>
                        </select>
                        @error('dosage')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="remarks" class="form-label">Remarks <span class="text-danger">*</span></label>
                        <textarea name="remarks" id="remarks" class="form-control" rowsapan="1"> </textarea>
                        @error('remarks')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>


                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Medication</button>
                </div>

            </form>
        </div>
    </div>
</div>



@endsection