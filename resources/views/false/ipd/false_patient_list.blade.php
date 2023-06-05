@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header  d-block">
            <div class="row">
                <div class="col-md-6 card-title">
                    IPD // <span style="color:blue">{{ @$department_details->department_name }}</span>
                    // <span>{{ date('d-m-Y',strtotime($date))}}</span>
                </div>

                <div class="col-md-6 text-right">
                    <div class="d-block">
                        <a class="btn btn-primary btn-sm" href="{{ route('ipd-false-generation') }}"><i
                                class="fa fa-reply"></i> Change Department</a>
                    </div>
                </div>

            </div>
        </div>
        @include('message.notification')
        <div class="card-body p-0  mt-3">
            <div class="options px-5 pt-1  border-bottom pb-3">
                <div class="row no-gutters">
                    <div class="col-lg-3 col-xl-3 border-right">
                        <span style="color: brown;font-size: 14px;font-weight: 700;"><i class="fa fa-cube"></i> IPD
                            Registation</span>
                        <div class="col-md-12 mt-3">
                            <form method="post" action="{{ route('registation-false-ipd') }}">
                                @csrf
                                <input type="hidden" id="department_id" name="department_id"
                                    value="{{ $department_id }}" />
                                <input type="hidden" id="date" name="date" value="{{ $date }}" />
                                @error('department_id')
                                <small class="text-danger">{{ $message }}</sma>
                                    @enderror
                                    @error('date')
                                    <small class="text-danger">{{ $message }}</sma>
                                        @enderror
                                        <div class="row">
                                            <div class="form-group col-md-6 newaddappon ">
                                                <label class="date-format"> No. Of Patient <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="no_of_patient" name="no_of_patient" required />
                                                @error('no_of_patient')
                                                <small class="text-danger">{{ $message }}</sma>
                                                    @enderror
                                            </div>
                                            <div class="form-group col-md-6 newuserlisttchange ">
                                                <label for="from">From <span class="text-danger">*</span></label>
                                                <select name="from" onchange="getre_new(this.value)"
                                                    class="form-control select2-show-search" id="from" required>
                                                    <option value="">Select one..</option>
                                                    <option value="OPD">OPD</option>
                                                    <option value="EMG">EMG</option>
                                                </select>
                                                @error('from')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 newuserlisttchange" id="hcedeyvb"
                                                style="display:none">
                                                <label for="re_new">Re/new <span class="text-danger">*</span></label>
                                                <select name="re_new" class="form-control select2-show-search"
                                                    id="re_new">
                                                    <option value="">Select one..</option>
                                                    <option value="Revisit">Revisit</option>
                                                    <option value="New Visit">New Visit</option>
                                                </select>
                                                @error('re_new')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 newuserlisttchange ">
                                                <label for="gender">Gender <span class="text-danger">*</span></label>
                                                <select name="gender" class="form-control select2-show-search"
                                                    id="gender" required>
                                                    <option value="" for="gender">gender</option>
                                                    @foreach (Config::get('static.gender') as $lang => $genders)
                                                    <option value="{{ $genders }}"> {{ $genders }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('gender')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 newaddappon ">
                                                <label class="date-format"> From Age(in year) <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="from_age" id="from_age" required />
                                                @error('from_age')
                                                <small class="text-danger">{{ $message }}</sma>
                                                    @enderror
                                            </div>
                                            <div class="form-group col-md-6 newaddappon ">
                                                <label class="date-format"> To Age(in year) <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="to_age" id="to_age" required />
                                                @error('to_age')
                                                <small class="text-danger">{{ $message }}</sma>
                                                    @enderror
                                            </div>
                                            <div class="form-group col-md-12 opd-bladedesign ">
                                                <button class="btn btn-primary btn-sm text-center ml-2" type="button"
                                                    onclick="validate()" name="save" value="save"><i
                                                        class="fa fa-plus"></i> Add IPD Registation</button>
                                            </div>
                                        </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 border-right">
                        <span class="ml-2" style="color: brown;font-size: 14px;font-weight: 700;"><i
                                class="fa fa-cube"></i> Pathology Investigation</span>
                        <div class="col-md-12 mt-3">
                            <form method="post" action="#">
                                @csrf
                                <input type="hidden" id="pathology_department_id" name="pathology_department_id"
                                    value="{{ $department_id }}" />
                                <input type="hidden" id="pathology_date" name="pathology_date" value="{{ $date }}" />
                                <div class="row">
                                    <div class="form-group col-md-12 newuserlisttchange ">
                                        <label for="gender"> Catagory <span class="text-danger">*</span></label>
                                        <select name="pathology_category" class="form-control select2-show-search"
                                            id="pathology_category" required>
                                            <option value="">Select Category..</option>
                                            @foreach ($pathology_category as $key => $value)
                                            <option value="{{ $value->id }}"> {{ $value->catagory_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('pathology_category')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12 newaddappon ">
                                        <label class="date-format"> No. of patient<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="no_of_patient_for_pathology_test"
                                            id="no_of_patient_for_pathology_test" required />
                                        @error('no_of_patient_for_pathology_test')
                                        <small class="text-danger">{{ $message }}</sma>
                                            @enderror
                                    </div>

                                    <div class="form-group col-md-12 opd-bladedesign ">
                                        <button class="btn btn-primary btn-sm text-center ml-2"
                                            style="margin-top: 66px;" type="button"
                                            onclick="validate_for_investigation_pathology()" name="save" value="save"><i
                                                class="fa fa-plus"></i> Add Pathology</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 border-right">
                        <span class="ml-2" style="color: brown;font-size: 14px;font-weight: 700;"><i
                                class="fa fa-cube"></i> Radiology Investigation</span>
                        <div class="col-md-12 mt-3">
                            <form method="post" action="#">
                                @csrf
                                <input type="hidden" id="radiology_department_id" name="radiology_department_id"
                                    value="{{ $department_id }}" />
                                <input type="hidden" id="radiology_date" name="radiology_date" value="{{ $date }}" />
                                @error('department_id')
                                <small class="text-danger">{{ $message }}</sma>
                                    @enderror
                                    @error('date')
                                    <small class="text-danger">{{ $message }}</sma>
                                        @enderror
                                        <div class="row">

                                            <div class="form-group col-md-12 newuserlisttchange ">
                                                <label for="gender"> Catagory <span class="text-danger">*</span></label>
                                                <select name="radiology_category"
                                                    class="form-control select2-show-search" id="radiology_category"
                                                    required>
                                                    <option value="">Select Category..</option>
                                                    @foreach ($radiology_category as $key => $value)
                                                    <option value="{{ $value->id }}"> {{ $value->catagory_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('radiology_category')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12 newaddappon ">
                                                <label class="date-format"> No. of patient<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="no_of_patient_for_radiology_test"
                                                    id="no_of_patient_for_radiology_test" required />
                                                @error('no_of_patient_for_radiology_test')
                                                <small class="text-danger">{{ $message }}</sma>
                                                    @enderror
                                            </div>

                                            <div class="form-group col-md-12 opd-bladedesign ">
                                                <button class="btn btn-primary btn-sm text-center ml-2" type="button"
                                                    style="    margin-top: 66px;"
                                                    onclick="validate_for_investigation_radiology()" name="save"
                                                    value="save"><i class="fa fa-plus"></i> Add Radiology</button>
                                            </div>
                                        </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-group">
                                        <li class="list-group-item"><i class="fa fa-cog text-danger"
                                                aria-hidden="true"></i> Today's total IPD Patient : {{
                                            @$todays_total_ipd }} <br>
                                            <span class="badge badge-success badge-pill">Original : {{
                                                @$todays_total_ipd_ori }}</span> <span
                                                class="badge badge-danger badge-pill">False : {{ @$todays_total_ipd_sys
                                                }}</span>
                                        </li>
                                        <li class="list-group-item"><i class="fa fa-cog text-primary"
                                                aria-hidden="true"></i> IPD from OPD for this department : {{
                                            @$todays_ipd_from_opd }}
                                            <br>
                                            <span class="badge badge-success badge-pill">Original : {{
                                                @$todays_ipd_from_opd_ori }}</span> <span
                                                class="badge badge-danger badge-pill">False : {{
                                                @$todays_ipd_from_opd_sys
                                                }}</span>
                                        </li>
                                        <li class="list-group-item"><i class="fa fa-cog text-success"
                                                aria-hidden="true"></i> IPD from EMG for this department: {{
                                            @$todays_ipd_from_emg }}
                                            <br>
                                            <span class="badge badge-success badge-pill">Original : {{
                                                @$todays_ipd_from_emg_ori }}</span> <span
                                                class="badge badge-danger badge-pill">False : {{
                                                @$todays_ipd_from_emg_sys
                                                }}</span>
                                        </li>
                                        <li class="list-group-item"><i class="fa fa-cog text-warning"
                                                aria-hidden="true"></i> Total for this Department : {{
                                            @$todays_total_for_this_department }}
                                            <br>
                                            <span class="badge badge-success badge-pill">Original : {{
                                                @$todays_total_for_this_department_ori }}</span> <span
                                                class="badge badge-danger badge-pill">False : {{
                                                @$todays_total_for_this_department_sys
                                                }}</span>
                                        </li>
                                        <li class="list-group-item"><i class="fa fa-cog text-info"
                                            aria-hidden="true"></i> Todays Discharged : {{
                                        @$todays_discharged }}
                                        <br>
                                        <span class="badge badge-success badge-pill">Original : {{
                                            @$todays_discharged_original }}</span> <span
                                            class="badge badge-danger badge-pill">False : {{
                                            @$todays_discharged_false
                                            }}</span>
                                    </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="options px-5 pt-1  border-bottom pb-3">
                <div class="row no-gutters">
                    <span style="color: brown;font-size: 14px;font-weight: 700;"><i class="fa fa-cube"></i>
                        Pathology </span>
                    <div class="col-md-12">
                        <div class="row">
                            @foreach ($pathology_category as $value)
                            <?php
                $ori_pathlogy = DB::table('pathology_patient_tests')->join('pathology_tests', 'pathology_tests.id', 'pathology_patient_tests.test_id')->where('pathology_patient_tests.section', 'IPD')->where('pathology_tests.catagory_id', $value->id)->where('pathology_patient_tests.ins_by', 'ori')->where('pathology_patient_tests.date', 'like', $date . '%')->count();

                $sys_pathlogy = DB::table('pathology_patient_tests')->join('pathology_tests', 'pathology_tests.id', 'pathology_patient_tests.test_id')->where('pathology_patient_tests.section', 'IPD')->where('pathology_tests.catagory_id', $value->id)->where('pathology_patient_tests.ins_by', 'sys')->where('pathology_patient_tests.date', 'like', $date . '%')->count();
                ?>
                            <div class="col-md-2">{{ $value->catagory_name }}<br>
                                <span class="badge badge-success">{{ $ori_pathlogy }}</span>
                                <span class="badge badge-danger">{{ $sys_pathlogy }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="options px-5 pt-1  border-bottom pb-3">
                <div class="row no-gutters">
                    <span style="color: brown;font-size: 14px;font-weight: 700;"><i class="fa fa-cube"></i>
                        Radiology</span>
                    <div class="col-md-12">
                        <div class="row">
                            @foreach ($radiology_category as $value)
                            <?php
                $ori_radiology = DB::table('radiology_patient_tests')->join('radiology_tests', 'radiology_tests.id', 'radiology_patient_tests.test_id')->where('radiology_tests.catagory_id', $value->id)->where('radiology_patient_tests.ins_by', 'ori')->where('radiology_patient_tests.section', 'IPD')->where('radiology_patient_tests.date', 'like', $date . '%')->count();

                $sys_radiology = DB::table('radiology_patient_tests')->join('radiology_tests', 'radiology_tests.id', 'radiology_patient_tests.test_id')->where('radiology_tests.catagory_id', $value->id)->where('radiology_patient_tests.section', 'IPD')->where('radiology_patient_tests.ins_by', 'sys')->where('radiology_patient_tests.date', 'like', $date . '%')->count();
                ?>
                            <div class="col-md-2">{{ $value->catagory_name }}<br>
                                <span class="badge badge-success">{{ $ori_radiology }}</span>
                                <span class="badge badge-danger">{{ $sys_radiology }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="options px-5 pt-1  border-bottom pb-3 mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th scope="col">IPD Id</th>
                                <th scope="col">Patient Details</th>
                                <th scope="col">Admission Details</th>
                                <th scope="col">Bed Details</th>
                      
                                <th scope="col">Discharged</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($ipd_registaion_list))
                            @foreach ($ipd_registaion_list as $value)
                            <tr>
                                <td><a class="textlink"
                                        href="{{ route('ipd-profile', ['id' => base64_encode($value->id)]) }}">{{
                                        @$value->id }}</a>
                                    <br>
                                    <a href="#" onclick="showAllTest({{ $value->case_id }})"
                                        class="badge badge-primary">Investigation</a>
                                </td>
                                <td>
                                    {{ @$value->all_patient_details->prefix }}
                                    {{ @$value->all_patient_details->first_name }}
                                    {{ @$value->all_patient_details->middle_name }}
                                    {{ @$value->all_patient_details->last_name }}({{ @$value->all_patient_details->id
                                    }})<br>
                                    <i class="fa fa-venus-mars text-primary"></i>
                                    {{ @$value->all_patient_details->gender }} <i
                                        class="fa fa-calendar-plus-o text-primary"></i>
                                    @if (@$value->all_patient_details->year != 0)
                                    {{ @$value->all_patient_details->year }}y
                                    @endif
                                    @if (@$value->all_patient_details->month != 0)
                                    {{ @$value->all_patient_details->month }}m
                                    @endif
                                    @if (@$value->all_patient_details->day != 0)
                                    {{ @$value->all_patient_details->day }}d
                                    @endif

                                </td>
                                <td>
                                    <i class="fa fa-calendar text-primary"></i> Admission Date :  {{ date('d-m-Y h:i A',
                                    strtotime($value->appointment_date)) }}
                                </td>
                                <td>
                                    {{$value->bed_details->bed_name}} -
                                    {{$value->unit_details->bedUnit_name}} -
                                    {{$value->ward_details->ward_name}}
                                </td>
                             
                                <td>
                                    <a href="#" onclick="dischargedPatient({{ $value->case_id }},{{ $value->id }},{{ $value->patient_id }},{{$value->bed_details->id}})"
                                        class="badge badge-info"><i class="fa fa-file"></i> Discharged</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modaldemo1">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">All Investigation</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <ul class="list-group" id="investigation">


                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                
                <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="add_operation_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Add Operation</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                   <div class="row">
                        <div class="col-md-6">
                            <input type="date" name="operation_date" />
                        </div>
                        <div class="col-md-6">

                        </div>
                   </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-sm" data-dismiss="modal" type="submit">Save</button>
                <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="discharged_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Discharged</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="#" method="POST">
            @csrf

            <input type="hidden" name="patient_id" id="patient_id" />
            <input type="hidden" name="case_id" id="case_id" />
            <input type="hidden" name="ipd_id" id="ipd_id" />

            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Discharge Date <span class="required">*</span></label>
                            <input type="datetime-local"  name="discharged_date" id="discharged_date" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="discharge_status" class="form-label">Discharge Status <span class="required">*</span></label>
                            <select name="discharge_status" class="form-control" id="discharge_status" required>
                                <option value="">Select...</option>
                                @foreach (Config::get('static.discharge_type') as $lang => $dischargeType)
                                <option value="{{ $dischargeType }}" {{ $dischargeType == 'Normal'? 'selected': '' }}> {{ $dischargeType }}
                                </option>
                                @endforeach
                            </select>
                            @error('discharge_status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
    
                        <div class="form-group col-md-12">
                            <label for="icd_code" class="form-label">Icd Code <span class="required">*</span></label>
                            <select name="icd_code" class="form-control select2-show-search" id="icd_code" required>
                                <option value="">Select...</option>
                                @foreach ( $icd_code as $item)
                                <option value="{{ $item->id }}">{{ $item->diagonasis_name }} ({{ $item->icd_code }})
                                </option>
                                @endforeach
                            </select>
                            @error('icd_code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                   </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-sm" type="button" onclick="patientSave()">Save</button>
                <button class="btn btn-secondary btn-sm" data-dismiss="modal" type="button">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
    function getre_new(val)
    {
        if(val == 'OPD'){
            $('#hcedeyvb').removeAttr('style',true);
        }
        else{
            $('#hcedeyvb').attr('style','display:none',true);  
        }
    }
    function patientSave()
    {
        
        var icd_code_ = $('#icd_code').val();
        var discharge_status_ = $('#discharge_status').val();
        var discharged_date_ = $('#discharged_date').val();
        var case_id_ = $('#case_id').val();
        var ipd_id_ = $('#ipd_id').val();
        var patient_id_ = $('#patient_id').val();

        $.ajax({
            url: "{{ route('add-discharged-false') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                icd_code: icd_code_,
                discharge_status: discharge_status_,
                discharged_date: discharged_date_,
                case_id: case_id_,
                ipd_id: ipd_id_,
                patient_id: patient_id_,
            },
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(error) {
                alert(response.message);
            }
        });
    }
    function showAllTest(case_id) {
        var div_pathology_radiology = '';
        $.ajax({
            url: "{{ route('false-pathology-test-show-in_modal') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                caseId: case_id,
            },
            success: function(response) {
                $.each(response.pathology_test_deatils, function(key, value) {
                    div_pathology_radiology += `<li class="list-group-item"><i class="fa fa-flask text-info"
                                aria-hidden="true"></i> ${value.test_name}
                        </li>`
                });
                $.each(response.radiology_test_deatils, function(key, value) {
                    div_pathology_radiology += `<li class="list-group-item"><i class="fa fa-flask text-info"
                                aria-hidden="true"></i> ${value.test_name}
                        </li>`
                });
                $('#modaldemo1').modal('show');
                $('#investigation').html(div_pathology_radiology);
            },
            error: function(error) {
                alert(response.message);
            }

        });
    }

    function dischargedPatient(case_id,ipd_id,patient_id,bed) {
        $('#patient_id').val(patient_id);
        $('#ipd_id').val(ipd_id);
        $('#case_id').val(case_id);
        $('#bed').val(bed);
        $('#discharged_modal').modal('show');
    }
    
    function addOperation(case_id) {
        $('#add_operation_modal').modal('show');
    }

    function validate_for_investigation_pathology() {
        var pathology_category = $('#pathology_category').val();
        var no_of_patient_for_pathology_test = $('#no_of_patient_for_pathology_test').val();
        if (pathology_category == "") {
            alert("Select Pathology Category");
            return false;
        }
        if (no_of_patient_for_pathology_test == "") {
            alert("Enter no of patient");
            return false;
        }
        savePatientipdpathology();
    }

    function savePatientipdpathology() {

        var no_of_patient_for_pathology_test_ = $('#no_of_patient_for_pathology_test').val();
        var pathology_category_ = $('#pathology_category').val();
        var pathology_date_ = $('#pathology_date').val();
        var pathology_department_id_ = $('#pathology_department_id').val();

        $.ajax({
            url: "{{ route('false-pathology-test-add-ipd') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                no_of_patient_for_pathology_test: no_of_patient_for_pathology_test_,
                pathology_category: pathology_category_,
                pathology_date: pathology_date_,
                pathology_department_id: pathology_department_id_,
            },
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(error) {
                alert(response.message);
            }
        });
    }

    function validate_for_investigation_radiology() {
        // var radiology_test_date = $('#radiology_test_date').val();
        var radiology_category = $('#radiology_category').val();
        var no_of_patient_for_radiology_test = $('#no_of_patient_for_radiology_test').val();

        //   if( radiology_test_date == "" ) {
        //      alert( "Select test date !!" );
        //      return false;
        //   }
        if (radiology_category == "") {
            alert("Select Radiology Category");
            return false;
        }
        if (no_of_patient_for_radiology_test == "") {
            alert("Enter no of patient");
            return false;
        }
        savePatientipdradiology();
    }

    function savePatientipdradiology() {
        // var radiology_visit_type_ = $('#radiology_visit_type').val();
        // var radiology_to_age_ = $('#radiology_to_age').val();
        // var radiology_from_age_ = $('#radiology_from_age').val();
        // var radiology_gender_ = $('#radiology_gender').val();
        var no_of_patient_for_radiology_test_ = $('#no_of_patient_for_radiology_test').val();
        var radiology_category_ = $('#radiology_category').val();
        // var radiology_test_date_ = $('#radiology_test_date').val();
        var radiology_date_ = $('#radiology_date').val();
        var radiology_department_id_ = $('#radiology_department_id').val();

        $.ajax({
            url: "{{ route('false-radiology-test-add-ipd') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                // radiology_visit_type : radiology_visit_type_,
                // radiology_to_age : radiology_to_age_,
                // radiology_from_age : radiology_from_age_,
                // radiology_gender : radiology_gender_,
                no_of_patient_for_radiology_test: no_of_patient_for_radiology_test_,
                radiology_category: radiology_category_,
                // radiology_test_date : radiology_test_date_,
                radiology_date: radiology_date_,
                radiology_department_id: radiology_department_id_,

            },
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(error) {
                alert(response.message);
            }
        });

    }

    function validate() {
    
        var to_age_ = $('#to_age').val();
        var from_age_ = $('#from_age').val();
        var gender_ = $('#gender').val();
        var no_of_patient_ = $('#no_of_patient').val();
        var date_ = $('#date').val();
        var departmentId = $('#department_id').val();
        var from_ = $('#from').val();

        if (from_ == "") {
            alert("Select from Opd or Emg !!");
            return false;
        }

        if (to_age_ == "") {
            alert("Enter To Age");
            return false;
        }
        if (from_age_ == "") {
            alert("Enter From Age");
            return false;
        }
        if (gender_ == "") {
            alert("Select To Gender");
            return false;
        }
        if (no_of_patient_ == "") {
            alert("Enter No of patient");
            return false;
        }
        if (date_ == "") {
            alert("Select Date");
            return false;
        }
        if (departmentId == "") {
            alert("Select Department");
            return false;
        }
        savePatientipd();
    }

    function savePatientipd() {

        var to_age_ = $('#to_age').val();
        var from_age_ = $('#from_age').val();
        var gender_ = $('#gender').val();
        var no_of_patient_ = $('#no_of_patient').val();
        var date_ = $('#date').val();
        var departmentId = $('#department_id').val();
        var from_ = $('#from').val();
        var re_new_ = $('#re_new').val();

        $.ajax({
            url: "{{ route('registation-false-ipd') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                to_age: to_age_,
                from_age: from_age_,
                gender: gender_,
                no_of_patient: no_of_patient_,
                date: date_,
                department_id: departmentId,
                from: from_,
                re_new: re_new_,

            },
            success: function(response) {
                alert(response.message);
                location.reload();
                var to_age_ = $('#to_age').val('');
                var from_age_ = $('#from_age').val('');
                var gender_ = $('#gender').prop('selectedIndex', -1);;
                var no_of_patient_ = $('#no_of_patient').val('');
                var date_ = $('#date').val('');
                var departmentId = $('#department_id').val('');
            },
            error: function(error) {
                alert(response.message);
            }
        });

    }
</script>

@endsection