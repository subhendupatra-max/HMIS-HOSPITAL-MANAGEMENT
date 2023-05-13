@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">OPD // <span style="color:blue">{{ @$department_details->department_name }}</span>
                // <span>{{ date('d-m-Y',strtotime($date))}}</span></div>
        </div>
        @include('message.notification')
        <div class="card-body p-0  mt-3">
            <div class="options px-5 pt-1  border-bottom pb-3">
                <div class="row no-gutters">
                    <div class="col-lg-4 col-xl-4 border-right">
                        <span style="color: brown;font-size: 14px;font-weight: 700;"><i class="fa fa-cube"></i> OPD
                            Registation</span>
                        <div class="col-md-12 mt-3">
                            <form method="post" action="{{ route('registation-false-opd') }}">
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
                                            <div class="form-group col-md-12 newaddappon">
                                                <label for="visit_type">Visit Type <span
                                                        class="text-danger">*</span></label>
                                                <select name="visit_type" id="visit_type"
                                                    class="form-control select2-show-search" id="visit_type" required>
                                                    <option value="">Select One</option>
                                                    <option value="New Visit">New-Visit</option>
                                                    <option value="Revisit">Revisit</option>
                                                </select>
                                                @error('visit_type')
                                                <small class="text-danger">{{ $message }}</sma>
                                                    @enderror
                                            </div>
                                            <div class="form-group col-md-12 opd-bladedesign ">
                                                <button class="btn btn-primary btn-sm text-center ml-2" type="button"
                                                    onclick="validate()" name="save" value="save"><i
                                                        class="fa fa-plus"></i> Add OPD Registation</button>
                                            </div>
                                        </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-4 border-right">
                        <span class="ml-2" style="color: brown;font-size: 14px;font-weight: 700;"><i
                                class="fa fa-cube"></i> Add Investigation</span>
                        <div class="col-md-12 mt-3">
                            <form method="post" action="{{ route('registation-false-opd') }}">
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
                                            <div class="form-group col-md-12 newaddappon">
                                                <label class="date-format ml-3"> Test Date<span
                                                        class="text-danger">*</span></label>
                                                <input type="date" name="test_date" id="test_date" required />
                                                @error('test_date')
                                                <small class="text-danger">{{ $message }}</sma>
                                                    @enderror
                                            </div>
                                            <div class="form-group col-md-6 newuserlisttchange ">
                                                <label for="gender">Pathology Catagory <span
                                                        class="text-danger">*</span></label>
                                                <select name="gender" class="form-control select2-show-search"
                                                    id="gender" required>
                                                    <option value="">Select Pathology Category..</option>
                                                    @foreach ($pathology_category as $key => $value)
                                                    <option value="{{ $value->id }}"> {{ $value-> }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('gender')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 newaddappon ">
                                                <label class="date-format"> No. of patient<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="no_of_patient_for_pathology_test"
                                                    id="no_of_patient_for_pathology_test" required />
                                                @error('no_of_patient_for_pathology_test')
                                                <small class="text-danger">{{ $message }}</sma>
                                                    @enderror
                                            </div>
                                            <div class="form-group col-md-6 newuserlisttchange ">
                                                <label for="gender">Radiology Catagory <span
                                                        class="text-danger">*</span></label>
                                                <select name="gender" class="form-control select2-show-search"
                                                    id="gender" required>
                                                    <option value="" >Select Radiology Category..</option>
                                                    @foreach ($radiology_category as $key => $value)
                                                    <option value="{{ $genders }}"> {{ $genders }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('gender')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 newaddappon ">
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
                                                    onclick="validate_for_investigation()" name="save" value="save"><i
                                                        class="fa fa-plus"></i> Add Investigation</button>
                                            </div>
                                        </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-4">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-group">
                                        <li class="list-group-item"><i class="fa fa-cog text-danger"
                                                aria-hidden="true"></i> Today's total OPD Patient : </li>
                                        <li class="list-group-item"><i class="fa fa-cog text-primary"
                                                aria-hidden="true"></i> New Patient : </li>
                                        <li class="list-group-item"><i class="fa fa-cog text-success"
                                                aria-hidden="true"></i> Revisit Patient : </li>
                                        <li class="list-group-item"><i class="fa fa-cog text-warning"
                                                aria-hidden="true"></i> Total for this Department : </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="options px-5 pt-1  border-bottom pb-3 mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap" id="example">
                        <thead>
                            <tr>
                                <th scope="col">OPD Id</th>
                                <th scope="col">Patient Name</th>
                                <th scope="col">Gurdian Name</th>
                                <th scope="col">Mobile No.</th>
                                <th scope="col">Case Id</th>
                                <th scope="col">Last Visit Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($opd_registaion_list))
                            @foreach ($opd_registaion_list as $value)
                            <tr>
                                <td><a class="textlink"
                                        href="{{ route('opd-profile', ['id' => base64_encode($value->id)]) }}">{{
                                        @$value->id }}</a>
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
                                <td>{{ @$value->all_patient_details->guardian_name }}</td>
                                <td>{{ @$value->all_patient_details->phone }}</td>
                                <td>{{ @$value->case_id }}</td>
                                <td>
                                    @if (isset($value->latest_opd_visit_details_for_patient->department_id))
                                    <i class="fa fa-cubes text-primary"></i>
                                    {{
                                    @$value->latest_opd_visit_details_for_patient->department_details->department_name
                                    }}
                                    <br>
                                    @endif
                                    @if (isset($value->latest_opd_visit_details_for_patient->cons_doctor))
                                    <i class="fas fa-user-md text-primary"></i>
                                    {{ @$value->latest_opd_visit_details_for_patient->doctor->first_name }}
                                    {{ @$value->latest_opd_visit_details_for_patient->doctor->last_name }}<br>
                                    @endif
                                    @if (isset($value->latest_opd_visit_details_for_patient->appointment_date))
                                    <i class="fa fa-calendar text-primary"></i>
                                    {{ date('d-m-Y h:i A',
                                    strtotime($value->latest_opd_visit_details_for_patient->appointment_date)) }}
                                    @endif
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
<script>
    function validate() {
    var visit_type_ = $('#visit_type').val();
    var to_age_ = $('#to_age').val();
    var from_age_ = $('#from_age').val();
    var gender_ = $('#gender').val();
    var no_of_patient_ = $('#no_of_patient').val();
    var date_ = $('#date').val();
    var departmentId = $('#department_id').val();

      if( visit_type_ == "" ) {
         alert( "Select Visit Type !!" );
         return false;
      }
      if( to_age_ == "" ) {
         alert( "Enter To Age" );
         return false;
      }
      if( from_age_ == "" ) {
         alert( "Enter From Age" );
         return false;
      }
      if( gender_ == "" ) {
         alert( "Select To Gender" );
         return false;
      }
      if( no_of_patient_ == "" ) {
         alert( "Enter No of patient" );
         return false;
      }
      if( date_ == "" ) {
         alert( "Select Date" );
         return false;
      }
      if( departmentId == "" ) {
         alert( "Select Department" );
         return false;
      }
      savePatientopd();
   }
function savePatientopd()
{
    var visit_type_ = $('#visit_type').val();
    var to_age_ = $('#to_age').val();
    var from_age_ = $('#from_age').val();
    var gender_ = $('#gender').val();
    var no_of_patient_ = $('#no_of_patient').val();
    var date_ = $('#date').val();
    var departmentId = $('#department_id').val();

        $.ajax({
                url: "{{ route('registation-false-opd') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    visit_type : visit_type_,
                    to_age : to_age_,
                    from_age : from_age_,
                    gender : gender_,
                    no_of_patient : no_of_patient_,
                    date : date_,
                    department_id : departmentId,

                },
                success: function(response) {
                    alert(response.message);
                    location.reload();
                    var visit_type_ = $('#visit_type').prop('selectedIndex', -1);;
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