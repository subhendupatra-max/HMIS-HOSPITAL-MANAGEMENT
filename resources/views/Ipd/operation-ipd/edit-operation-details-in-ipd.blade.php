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

                    {{-- ================== add new patient ====================== --}}
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
                    <form method="post" action="{{route('update-operation-booking-details-in-ipd')}}">
                        @csrf

                        <div class="options px-5 pt-1  border-bottom pb-3">
                            @error('patient_id')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="row">
                                <input type="hidden" name="operation_booking_id" value="{{ @$operation_booking->id }}" />
                                <input type="hidden" name="operation_theater_id" value="{{ @$operation_theathers->id }}" />

                                <input type="hidden" name="patient_id" value="{{ @$operation_theathers->id }}" />
                                <input type="hidden" name="case_id" value="{{ @$operation_theathers->id }}" />
                                <input type="hidden" name="section" value="{{ @$operation_theathers->section }}" />
                                <input type="hidden" name="section_id" value="{{ @$operation_theathers->ipd_id }}" />

                                <div class="form-group col-md-4 opd-bladedesign ">
                                    <label class="date-format">Operation Date From  <span class="text-danger">*</span></label>

                                    <input type="datetime-local" name="operation_date_from" value="{{ old('operation_date_from') }}" @if (isset($operation_booking->operation_date_from)) value="{{ date('Y-m-d H:i', strtotime($operation_booking->operation_date_from)) }}" @endif required />

                                    @error('operation_date_from')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 opd-bladedesign ">
                                    <label class="date-format">Operation Date To<span class="text-danger">*</span></label>

                                    <input type="datetime-local" name="operation_date_to" value="{{ old('operation_date_to') }}" @if (isset($operation_booking->operation_date_to)) value="{{ date('Y-m-d H:i', strtotime($operation_booking->operation_date_to)) }}" @endif required />

                                    @error('operation_date_to')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="operation_department">Operation Department <span class="text-danger">*</span></label>
                                    <select name="operation_department" class="form-control select2-show-search" id="operation_department" onchange="getOperation(this.value,{{$operation_theathers->operation_category_id}})">
                                        <option value="">Operation Department</option>
                                        @foreach($departments as $item)
                                        <option value="{{$item->id}}" {{ @$item->id == $operation_theathers->operation_department ? 'selected' : ' ' }}>{{$item->department_name}} </option>
                                        @endforeach
                                    </select>
                                    @error('operation_department')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="operation_category_id">Operation Catagory <span class="text-danger">*</span></label>
                                    <select name="operation_category_id" class="form-control select2-show-search" id="operation_category_id" onchange="getOperationCatagory({{$operation_theathers->operation_category_id}},{{$operation_theathers->operation_id}})">
                                        <option value="">Operation Catagory</option>

                                    </select>
                                    @error('operation_category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group col-md-4 newaddappon">
                                    <label for="operation_id">Operation Name <span class="text-danger">*</span></label>
                                    <select name="operation_id" class="form-control select2-show-search" id="operation_id">
                                        <option value="">Select Operation Name</option>

                                    </select>
                                    @error('operation_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="operation_type">Operation Type <span class="text-danger">*</span></label>
                                    <select name="operation_type" class="form-control select2-show-search" id="operation_type">
                                        <option value="">Operation Type</option>
                                        @foreach($operation_type as $item)
                                        <option value="{{$item->id}}" {{ @$item->id == $operation_theathers->operation_type ? 'selected' : ' ' }}>{{$item->operation_type_name}} </option>
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
                                        <option value="{{$item->id}}" {{ @$item->id == $operation_booking->consultant_doctor ? 'selected' : ' ' }}>{{$item->first_name}} {{$item->last_name}}</option>
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
                                        <option value="{{$item->id}}" {{ @$item->id == $operation_booking->ass_consultant_1 ? 'selected' : ' ' }}>{{$item->first_name}} {{$item->last_name}}</option>
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
                                        <option value="{{$item->id}}" {{ @$item->id == $operation_booking->ass_consultant_2 ? 'selected' : ' ' }}>{{$item->first_name}} {{$item->last_name}}</option>
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
                                        <option value="{{$item->id}}" {{ @$item->id == $operation_booking->anesthetist ? 'selected' : ' ' }}>{{$item->first_name}} {{$item->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('anesthetist')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="anaethesia_type">Anaethesia Type <span class="text-danger">*</span></label>
                                    <input type="text" name="anaethesia_type" value="{{ $operation_booking->anaethesia_type }}" />
                                    @error('anaethesia_type')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 newaddappon">
                                    <label for="ot_technician">OT Technician <span class="text-danger">*</span></label>
                                    <select name="ot_technician" class="form-control select2-show-search" id="ot_technician">
                                        <option value="">Select</option>
                                        @foreach($staff as $item)
                                        <option value="{{$item->id}}" {{ @$item->id == $operation_booking->ot_technician ? 'selected' : ' ' }}>{{$item->first_name}} {{$item->last_name}}</option>
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
                                        <option value="{{$item->id}}" {{ @$item->id == $operation_booking->ot_assistant ? 'selected' : ' ' }}>{{$item->first_name}} {{$item->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('ot_assistant')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 newaddappon">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control select2-show-search" id="status">
                                        <option value="">Select</option>
                                        @foreach(Config::get('static.main_operation_status') as $item)
                                        <option value="{{$item}}" {{ @$item == $operation_booking->status ? 'selected' : ' ' }}>{{$item}}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 opd-condition">
                                    <input type="text" id="remark" name="remark" value="{{ $operation_booking->remark }}">
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
    function getOperation(department, catagory) {

        // alert(department);
        $('#operation_category_id').html('<option value="" >Select...</option>');

        $.ajax({
            url: "{{ route('find-operation-catagory-by-department') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                department_id: department,
            },
            success: function(response) {

                $.each(response.operation_catagory, function(key, value) {
                    let sel = (value.id == catagory ? 'selected' : '');
                    $('#operation_category_id').append(`<option value="${value.id}"  ${sel}>${value.operation_catagory_name	}</option>`);
                });

            },
            error: function(error) {
                console.log(error);
            }
        });


    }
</script>


<script>
    function getOperationCatagory(catagory, operation_name) {

        // alert(catagory);
        // alert(department);
        $('#operation_id').html('<option value="" >Select...</option>');

        $.ajax({
            url: "{{ route('find-operation-name-by-catagory') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                catagory_id: catagory,
            },
            success: function(response) {

                $.each(response.operation_name, function(key, values) {
                    let sel = (values.id == operation_name ? 'selected' : '');
                    $('#operation_id').append(`<option value="${values.id}"  ${sel}>${values.operation_name}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>
@endsection