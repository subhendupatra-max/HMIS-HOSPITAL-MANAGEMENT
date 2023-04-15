@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Donor Details</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('update-blood-donor') }}" method="POST">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{$editBloodDonor->id}}" />
                    <div class="form-group col-md-4">
                        <label for="donor_name" class="form-label">Donor Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="donor_name" value="{{ $editBloodDonor->donor_name }}" name="donor_name" placeholder="Enter Donor Name">
                        <small class="text-danger">{{ $errors->first('donor_name') }}</small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="date_of_birth" class="form-label">Date Of Birth<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required @if(isset($editBloodDonor->date_of_birth)) value="{{ date('Y-m-d',strtotime($editBloodDonor->date_of_birth))}}" @endif>
                        @error('date_of_birth')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="blood_group" class="form-label"> Blood Group <span class="text-danger">*</span></label>
                        <select id="blood_group" class="form-control" name="blood_group">
                            <option value="">Select</option>
                            @foreach (Config::get('static.blood_groups') as $lang => $item)
                            <option value="{{$item}}" {{ $item == $editBloodDonor->blood_group ? 'selected' : " "}}> {{$item}}</option>
                            @endforeach
                        </select>
                        @error('blood_group')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                        <select id="gender" class="form-control" name="gender">
                            <option value="">Select</option>
                            @foreach (Config::get('static.gender') as $lang => $genders)
                            <option value="{{$genders}}" {{ $genders == $editBloodDonor->gender ? 'selected' : " "}}> {{$genders}}</option>
                            @endforeach
                        </select>
                        @error('gender')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="father_name" class="form-label">Father Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="father_name" name="father_name" value="{{ $editBloodDonor->father_name }}" placeholder="Enter Father Name">
                        <small class="text-danger">{{ $errors->first('father_name') }}</small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="ph_no" class="form-label">Contact No</label>
                        <input type="text" class="form-control" id="ph_no"  name="ph_no" placeholder="Enter Contact No" value="{{ $editBloodDonor->ph_no }}">
                        <small class="text-danger">{{ $errors->first('ph_no') }}</small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" class="form-control"> {{ $editBloodDonor->address }} </textarea>
                        <small class="text-danger">{{ $errors->first('address') }}</small>
                    </div>

                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Blood Donor</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>

@endsection