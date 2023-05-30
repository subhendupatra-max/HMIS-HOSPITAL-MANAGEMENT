@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header d-block">
            <div class="row">
                <div class="col-md-4 card-title">
                    Preparing Discharge Form
                </div>
                <div class="col-md-8 text-right">
                    <div class="d-block">
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="fa fa-building"></i> <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="">
                            @include('ipd.include.menu')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-header">
            @include('ipd.include.patient-name')
        </div>
        @include('message.notification')
        <span class="text-danger" style="0px 0px 0px 17px;">**Before Discharged Please Check patient all bill**</span>
        <div class="card-body">

            <form action="{{ route('save-discharged-patient-in-ipd') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <input type="hidden" name="ipd_id" value="{{ $ipdId }}" />
                    <input type="hidden" name="case_id" value="{{ $ipd_patient_details->case_id }}" />
                    <input type="hidden" name="patient_id" value="{{ $ipd_patient_details->patient_id }}" />



                    <div class="form-group col-md-4">
                        <label for="doctor_name" class="form-label">Treating Consultant's Name<span
                                class="text-danger">*</span></label>
                        <select name="doctor_name" class="form-control" id="doctor_name">
                            <option value="">Select...</option>
                            @foreach ($doctor as $name)
                            <option value="{{ $name->id }}"> {{ $name->first_name }} {{ $name->last_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('doctor_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="discharge_date" class="form-label">Discharge Date <span
                                class="text-danger">*</span></label>
                        <input type="datetime-local" required style="    margin: 0px 0px 0px 0px;" class="form-control"
                            id="discharge_date" name="discharge_date" value="{{ old('discharge_date') }}" />
                        @error('discharge_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="icd_code" class="form-label">Final Diagnosis at the time of Discharge </label>
                        <select name="icd_code" class="form-control" id="icd_code" required>
                            <option value="">Select...</option>
                            @foreach ($icd_code as $icd_codes)
                            <option value="{{ $icd_codes->id }}"> {{ $icd_codes->diagonasis_name }}({{
                                $icd_codes->icd_code }})
                            </option>
                            @endforeach
                        </select>
                        @error('icd_code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="complaiints_duraiton" class="form-label">Presenting Complaints with Duration and
                            Reason for Admission </label>
                        <textarea class="form-control" id="complaiints_duraiton" name="complaiints_duraiton"
                            value="{{ old('complaiints_duraiton') }} "></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="presenting_illness" class="form-label">Summary of Presenting Illness</label>
                        <textarea class="form-control" id="presenting_illness" name="presenting_illness"
                            value="{{ old('presenting_illness') }} "></textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="physical_examinaiton_at_admission" class="form-label">Key findings, on physical
                            examination at the time of admission</label>
                        <textarea class="form-control" id="physical_examinaiton_at_admission"
                            name="physical_examinaiton_at_admission"
                            value="{{ old('physical_examinaiton_at_admission') }} "></textarea>
                    </div>


                    <div class="form-group col-md-4">
                        <label for="summary_inves_during_hos" class="form-label"> Summary of key invesigations during
                            Hospitalization<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="summary_inves_during_hos" name="summary_inves_during_hos"
                            value="{{ old('summary_inves_during_hos') }} "></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="course_complications" class="form-label"> Course in the Hospital including
                            complicaiotns if any</label>
                        <textarea class="form-control" id="course_complications" name="course_complications"
                            value="{{ old('course_complications') }} "></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="dischage_advice" class="form-label">Advice on Discharge</label>
                        <textarea class="form-control" id="dischage_advice" name="dischage_advice"
                            value="{{ old('dischage_advice') }} "></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="discharge_status" class="form-label">Discharge Status <span
                                class="text-danger">*</span></label>
                        <select name="discharge_status" class="form-control" id="discharge_status" required
                            onchange="hide(this.value)">
                            <option value="">Select...</option>
                            @foreach (Config::get('static.discharge_type') as $lang => $dischargeType)
                            <option value="{{ $dischargeType }}"> {{ $dischargeType }}
                            </option>
                            @endforeach
                        </select>
                        @error('discharge_status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4" style="display:none" id="referral_hospital">
                        <label for="refferal_hospital_name" class="form-label">Refferal Hospital Name<span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="refferal_hospital_name"
                            name="refferal_hospital_name" value="{{ old('refferal_hospital_name') }}" />
                    </div>
                    <div class="form-group col-md-4" id="referral_hospital">
                        <label for="next_appointment_date" class="form-label">Next Appointment Date </label>
                        <input style="    margin: 0px 0px 0px 0px;" type="date" class="form-control"
                            id="next_appointment_date" name="next_appointment_date" />
                    </div>
                </div>
                <div class="border-bottom border-top mt-2">
                    <h6>Medicine :</h6>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%">Medicine Catagory
                                    </th>
                                    <th scope="col" style="width: 28%">Medicine Name
                                    </th>
                                    <th scope="col" style="width: 20%">Dosage
                                    </th>
                                    <th scope="col" style="width: 20%">Dose Interval
                                    </th>
                                    <th scope="col" style="width: 20%">Dose Duration
                                    </th>
                                    <th scope="col" style="width: 2%"><button class="btn btn-success btn-sm"
                                            onclick="addNewrow()" type="button"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="chargeTable">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="border-bottom">
                                <h6>Pathology Test :</h6>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 98%">Test Name
                                                </th>
                                                <th scope="col" style="width: 2%"><button class="btn btn-success btn-sm"
                                                        onclick="addNewrowPathology()" type="button"><i
                                                            class="fa fa-plus"></i></button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="addPathologyTable">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border-bottom">
                                <h6>Radiology Test :</h6>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 98%">Test Name
                                                </th>
                                                <th scope="col" style="width: 2%"><button class="btn btn-success btn-sm"
                                                        onclick="addNewrowradiology()" type="button"><i
                                                            class="fa fa-plus"></i></button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="addRadiologyTable">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <hr>
                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Discharged Patient</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>

<script>
    var i = 1;
    var j = 1;
    var k = 1;

function addNewrow() {
    var html = `<tr id="row${i}">
                        <td>
                            <select class="form-control select2-show-search" onchange="getMedicine_name(this.value,${i})"  name="medicine_catagory_id[]" id="medicine_catagory_id${i}" required>
                                    <option value=" ">Select Medicine Category</option>
                                    @foreach ($medicine_catagory as $item)
                                    <option value="{{$item->id}}">{{$item->medicine_catagory_name}}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="medicine_name[]" id="medicine_name${i}" class="form-control select2-show-search">
                                <option value="">Select Medicine Name</option>
                            </select>
                        </td>
                        <td>
                            <select name="dose[]" id="dose${i}" class="form-control select2-show-search">
                                <option value="">Select Dosage</option>
                            </select>
                        </td>
                        <td>
                            <select name="dose_interval[]" id="dose_interval${i}" class="form-control select2-show-search">
                                <option value="">Select Dose Interval</option>
                                @foreach ($DoseInterval as $item)
                                    <option value="{{$item->dose_interval}}">{{$item->dose_interval}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="dose_duration[]" id="dose_duration${i}" class="form-control select2-show-search">
                                <option value="">Select Dose Duration</option>
                                @foreach ($DoseDuration as $item)
                                    <option value="{{$item->dose_duration}}">{{$item->dose_duration}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm"  type="button"
                                    onclick="rowRemove(${i})"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    `;
    $('#chargeTable').append(html);
    i = i + 1;

}
function rowRemove(row_id) {
        $(`#row${row_id}`).remove();
}

function addNewrowPathology() {
    var html = `<tr id="rowpathology${j}">
                        <td>
                            <select class="form-control select2-show-search" name="pathology_test_id[]" id="pathology_test_id${j}" required>
                                    <option value=" ">Select test</option>
                                    @foreach ($pathology_test as $item)
                                    <option value="{{$item->id}}">{{$item->test_name}}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm"  type="button"
                                    onclick="rowRemovepathology(${j})"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>
                    `;
    $('#addPathologyTable').append(html);
    j = j + 1;
}
function rowRemovepathology(row_id) {
        $(`#rowpathology${row_id}`).remove();
}
function addNewrowradiology() {
    var html = `<tr id="rowradiology${k}">
                        <td>
                            <select class="form-control select2-show-search" name="radiology_test_id[]" id="radiology_test_id${k}" required>
                                    <option value=" ">Select test</option>
                                    @foreach ($radiology_test as $item)
                                    <option value="{{$item->id}}">{{$item->test_name}}</option>
                                    @endforeach
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm"  type="button"
                                    onclick="rowRemoveradiology(${k})"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>`;
    $('#addRadiologyTable').append(html);
    j = j + 1;
}
function rowRemoveradiology(row_id) {
        $(`#rowradiology${row_id}`).remove();
}
</script>

<script>
    function hide(val) {
        if (val == 'Refferal') {
            $('#referral_hospital').removeAttr('style', true);
        } else {
            $('#referral_hospital').attr('style', 'display:none !important', true);

        }
    }
</script>
<script>
    function getMedicine_name(cat_id,row_no)
    {
        $("#medicine_name").html('<option value=" ">Select Medicine Name...</option>');
        $("#dose").html('<option value=" ">Select dose...</option>');
        var div_data = '';
        var div_dataa = '';
        $.ajax({
                url: "{{ route('find-medicine-name-by-medicine-catagory-dose') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    medicine_catagory_id: cat_id,
                },

                success: function(response) {
                    $.each(response.medicine_name, function(key, value) {
                      div_data += `<option value="${value.id}">${value.medicine_name}</option>`;
                    });
                    $('#medicine_name'+row_no).append(div_data);

                    $.each(response.dose, function(key, value) {
                      div_dataa += `<option value="${value.dose} ${value.medicine_unit_name}">${value.dose} ${value.medicine_unit_name}</option>`;
                    });
                    $('#dose'+row_no).append(div_dataa);
                },
                error: function(error) {
                    console.log(error);
                }
            });
    }

</script>

<script>
    $(document).ready(function() {
        $("#medicine_catagory_id").change(function(event) {
            event.preventDefault();
            let medicine_catagory_id = $(this).val();

            $("#dosage").html('<option value=" ">Select Dose...</option>');
            $.ajax({
                url: "{{ route('find-dosage-by-medicine-catagory') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    medicine_catagory_id_for_dose: medicine_catagory_id,
                },

                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#dosage').append(`<option value="${value.id}">${value.dose}</option>`);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>
@endsection