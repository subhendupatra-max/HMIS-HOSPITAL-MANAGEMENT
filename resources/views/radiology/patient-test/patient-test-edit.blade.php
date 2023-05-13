@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Radiology Charge</div>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-5 col-xl-4 border-right">
                    {{-- ================== add new patient ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <a class="btn btn-primary btn-sm" href="{{route('add_new_patient')}}"><i class="fa fa-plus"></i> Add New Patient</a>
                            </div>
                        </div>
                    </div>
                    {{-- ================== add new patient ====================== --}}

                    {{-- ================== Search patient ====================== --}}
                    <div class="options px-5 pt-5  border-bottom pb-3">
                        <form method="post" action="{{route('add-pathology-charges-for-a-patient')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <select class="form-control  select2-show-search" name="patient_id">
                                        <option value="">Select One Patient</option>
                                        @if(isset($all_patient))
                                        @foreach ($all_patient as $patient)
                                        <option value="{{@$patient->id}}" {{ @$patient_details_information->id ==
                                            $patient->id ? 'Selected' : '' }}>{{@$patient->prefix}}
                                            {{@$patient->first_name}} {{@$patient->middle_name}}
                                            {{@$patient->last_name}} ( {{@$patient->id}} )
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>
                                        Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- ================== Search patient ====================== --}}

                    @if(isset($patient_details_information))
                    {{-- ================== patient Details ====================== --}}
                    @error('patientId')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="options px-5  pb-3">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Gender </span>
                                            </td>
                                            <td class="py-2 px-5">{{ @$patient_details_information->gender }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Age </span>
                                            </td>
                                            <td class="py-2 px-5">{{ @$patient_details_information->year }}y
                                                {{ @$patient_details_information->month }}m
                                                {{ @$patient_details_information->day }}d
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Guardian Name </span>
                                            </td>
                                            <td class="py-2 px-5">{{
                                                @$patient_details_information->guardian_name_realation }}
                                                {{ @$patient_details_information->guardian_name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Blood Group </span>
                                            </td>
                                            <td class="py-2 px-5">{{ @$patient_details_information->blood_group }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Phone </span>
                                            </td>
                                            <td class="py-2 px-5">{{@$patient_details_information->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Section </span>
                                            </td>
                                            <td class="py-2 px-5">{{@$patient_reg_details->section }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Case Id </span>
                                            </td>
                                            <td class="py-2 px-5"><span style="color:blue">{{@$patient_reg_details->id }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- ================== patient Details ====================== --}}
                    @endif
                </div>

                <div class="col-lg-7 col-xl-8">
                    <form method="post" action="{{route('update-radiology-charge')}}">
                        @csrf
                        <div class="options px-5 pt-1  border-bottom pb-3">
                            <div class="row">
                                <div class="form-group col-md-6 adcharge ">
                                    <label class="date-format"> Date <span class="text-danger">*</span></label>
                                    <input type="datetime-local" name="date" value="{{ date('Y-m-d h:m:s',strtotime($test_details->date)) }}" required />
                                    @error('date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 adchargee ">
                                    <label class="date-format">Test Name <span class="text-danger">*</span></label>
                                    <select required class="form-control select2-show-search" name="test_id" id="test_id">
                                        <option value="">Select Test Name</option>
                                        @if(isset($radiology_all_test))
                                        @foreach ($radiology_all_test as $key => $value)
                                        <option value="{{$value->id}}" {{ @$test_details->test_id ==
                                            $value->id ? 'Selected' : '' }}>{{$value->test_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>

                                    @error('test_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="patientId" value="{{ @$patient_details_information->id }}" />
                        <input type="hidden" name="section" value="{{ @$patient_reg_details->section }}" />
                        <input type="hidden" name="case_id" value="{{ @$patient_reg_details->id }}" />
                        <input type="hidden" name="pre_test_id" value="{{ @$test_details->id }}" />

                        <div class="btn-list p-3">
                            <button class="btn btn-primary btn-sm float-right" value="save" type="submit" name="save"><i class="fa fa-file"></i> Save</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection