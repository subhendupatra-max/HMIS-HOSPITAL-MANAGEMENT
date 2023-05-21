@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Operation Booking</div>
        </div>
        @include('message.notification')
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-xl-4 border-right">
                    {{-- ================== add new patient ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <a class="btn btn-primary btn-sm" href="{{route('add_new_patient')}}"><i class="fa fa-plus"></i> Add New Patient</a>
                            </div>
                        </div>
                    </div>
                    {{-- ================== add new patient ====================== --}}

                    <div class="options px-5 pt-5  border-bottom pb-3">

                        <form method="post" action="{{route('booking-operation') }}">

                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <select class="form-control  select2-show-search" name="patient_id">
                                        <option value="">Select One Patient</option>
                                        @if(isset($all_patient))
                                        @foreach ($all_patient as $patient)
                                        <option value="{{@$patient->id}}" {{ @$patient_details_information->id == $patient->id ? 'Selected' : '' }}> {{@$patient->prefix}} {{@$patient->first_name}} {{@$patient->middle_name}} {{@$patient->last_name}} ( {{@$patient->id}} ) </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Search</button>
                                </div>
                            </div>
                        </form>

                    </div>

                    @if(isset($patient_details_information))
                    {{-- ================== patient Details ====================== --}}
                    @error('patientId')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="options px-5  pb-3">
                        <div class="row">

                            <hr class="hr_line">

                            <div class="card-body text-center">
                                <div class="pro-user">
                                    <h4 class="pro-user-username text-dark mb-1 font-weight-bold">
                                        {{ $patient_details_information->prefix }} {{ $patient_details_information->first_name }}
                                        {{ $patient_details_information->middle_name }} {{ $patient_details_information->last_name }}
                                    </h4>
                                    <h6 class="pro-user-desc textlink">
                                        {{ $patient_details_information->patient_prefix }}{{ $patient_details_information->id }}
                                    </h6>

                                    @can('edit patient')
                                    <a href="{{ route('edit-new-patient-opd', base64_encode($patient_details_information->id)) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Patient Profile"><i class="fa fa-edit"></i></a>
                                    @endcan
                                </div>
                            </div>

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
                                            <td class="py-2 px-5">
                                                {{ @$patient_details_information->year == '0'?'':$patient_details_information->year.'y' }}
                                                {{ @$patient_details_information->month == '0'?'':$patient_details_information->month.'m' }}
                                                {{ @$patient_details_information->day == '0'?'':$patient_details_information->day.'d' }}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Guardian Name </span>
                                            </td>
                                            <td class="py-2 px-5">{{ @$patient_details_information->guardian_name_realation }}
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- ================== patient Details ====================== --}}
                    @endif

                </div>

                <div class="col-lg-8 col-xl-8">
                    <form method="post" action="{{route('save-operation-booking')}}">
                        @csrf

                        <div class="options px-5 pt-1  border-bottom pb-3">
                            @error('patient_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="row">
                                <input type="hidden" name="patient_id" value="{{ @$patient_details_information->id }}" />
                                <input type="hidden" name="case_id" value="{{ @$case_details->id }}" />
                                <input type="hidden" name="section" value="{{ @$case_details->section }}" />
                                <input type="hidden" name="section_id" value="{{ @$case_details->section_id }}" />

                                <div class="form-group col-md-4 opd-bladedesign ">
                                    <label class="date-format">Operation Date From<span class="text-danger">*</span></label>

                                    <input type="datetime-local" name="operation_date_from" value="{{ old('operation_date_from') }}" required />

                                    @error('operation_date_from')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 opd-bladedesign ">
                                    <label class="date-format">Operation Date To<span class="text-danger">*</span></label>

                                    <input type="datetime-local" name="operation_date_to" value="{{ old('operation_date_to') }}" required />

                                    @error('operation_date_to')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="operation_department">Operation Department <span class="text-danger">*</span></label>
                                    <select name="operation_department" class="form-control select2-show-search" id="operation_department" onchange="getOperation(this.value)">
                                        <option value="">Operation Department</option>
                                        @foreach($departments as $item)
                                        <option value="{{$item->id}}">{{$item->department_name}} </option>
                                        @endforeach
                                    </select>
                                    @error('operation_department')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="operation_category_id">Operation Catagory <span class="text-danger">*</span></label>
                                    <select name="operation_category_id" class="form-control select2-show-search" id="operation_category_id">
                                        <option value="">Operation Catagory</option>

                                    </select>
                                    @error('operation_category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="operation_type">Operation Type <span class="text-danger">*</span></label>
                                    <select name="operation_type" class="form-control select2-show-search" id="operation_type">
                                        <option value="">Operation Type</option>
                                        @foreach($operation_type as $item)
                                        <option value="{{$item->id}}">{{$item->operation_type_name}} </option>
                                        @endforeach
                                    </select>
                                    @error('operation_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="consultant_doctor">Consultant Doctor <span class="text-danger">*</span></label>
                                    <select name="consultant_doctor" class="form-control select2-show-search" id="consultant_doctor">
                                        <option value="">Consultant Doctor</option>
                                        @foreach($doctor as $item)
                                        <option value="{{$item->id}}">{{$item->first_name}} {{$item->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('consultant_doctor')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 newaddappon">
                                    <label for="ass_consultant_1">Nurse 1<span class="text-danger">*</span></label>
                                    <select name="ass_consultant_1" class="form-control select2-show-search" id="ass_consultant_1">
                                        <option value="">Select</option>
                                        @foreach($nurse as $item)
                                        <option value="{{$item->id}}">{{$item->first_name}} {{$item->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('ass_consultant_1')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="ass_consultant_2">Nurse 2 <span class="text-danger">*</span></label>
                                    <select name="ass_consultant_2" class="form-control select2-show-search" id="ass_consultant_2">
                                        <option value="">Select</option>
                                        @foreach($nurse as $item)
                                        <option value="{{$item->id}}">{{$item->first_name}} {{$item->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('ass_consultant_2')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="anesthetist">Anesthetist <span class="text-danger">*</span></label>
                                    <select name="anesthetist" class="form-control select2-show-search" id="anesthetist">
                                        <option value="">Select</option>
                                        @foreach($staff as $item)
                                        <option value="{{$item->id}}">{{$item->first_name}} {{$item->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('anesthetist')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="anaethesia_type">Anaethesia Type <span class="text-danger">*</span></label>
                                    <input type="text" name="anaethesia_type" value="{{old('anaethesia_type') }}" />
                                    @error('anaethesia_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="ot_technician">OT Technician <span class="text-danger">*</span></label>
                                    <select name="ot_technician" class="form-control select2-show-search" id="ot_technician">
                                        <option value="">Select</option>
                                        @foreach($staff as $item)
                                        <option value="{{$item->id}}">{{$item->first_name}} {{$item->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('ot_technician')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="ot_assistant">OT Assistant <span class="text-danger">*</span></label>
                                    <select name="ot_assistant" class="form-control select2-show-search" id="ot_assistant">
                                        <option value="">Select</option>
                                        @foreach($staff as $item)
                                        <option value="{{$item->id}}">{{$item->first_name}} {{$item->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('ot_assistant')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 opd-condition">

                                    <input type="text" id="remark" name="remark">
                                    <label for="remark">Remarks </label>
                                </div>


                            </div>
                            <div class="btn-list ">
                                <button class="btn btn-primary btn-sm float-right ml-2" type="submit" name="save" value="save"><i class="fa fa-file"></i> Save</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function getOperation(department) {

        $('#operation_category_id').html('<option value="" >Select...</option>');

        $.ajax({
            url: "{{ route('find-operation-catagory-by-department') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                department_id: department,
            },
            success: function(response) {
                // console.log(response);
                $.each(response, function(key, values) {
                    $('#operation_category_id').append(`<option value="${values.id}"  >${values.operation_catagory_name	}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });


    }
</script>
@endsection