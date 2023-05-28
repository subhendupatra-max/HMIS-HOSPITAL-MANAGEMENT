@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Pathology Billing</div>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-5 col-xl-4 border-right">
                    {{-- ================== add new patient ====================== --}}
                    <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <a class="btn btn-primary btn-sm" href="{{route('add_new_patient')}}"><i
                                        class="fa fa-plus"></i> Add New Patient</a>
                            </div>
                        </div>
                    </div>
                    {{-- ================== add new patient ====================== --}}

                    {{-- ================== Search patient ====================== --}}
                    <div class="options px-5 pt-5  border-bottom pb-3">
                        <form method="post" action="{{route('add-pathology-billing-for-a-patient')}}">
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
                                            {{@$patient->last_name}} ( {{@$patient->id}} )( {{@$patient->phone}} ) </option>
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
                                            <td class="py-2 px-5"><span style="color:blue">{{@$patient_reg_details->id
                                                    }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Patient Type </span>
                                            </td>
                                            <td class="py-2 px-5"><span style="color:blue">{{@$patient_reg_details->id
                                                    }}</span></td>
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
                    <form method="post" action="{{route('save-pathology-billing')}}">
                        @csrf
                        <div class="options px-5 pt-1  border-bottom pb-3">
                            <div class="form-group col-md-4 opd-bladedesign ">
                                <label class="date-format">Billing Date <span class="text-danger">*</span></label>
                                  <input type="datetime-local"  name="billing_date" value="{{ date('Y-m-d H:s') }}" required />
                                  @error('billing_date')
                                  <small class="text-danger">{{ $message }}</small>
                                  @enderror
                              </div>
                        </div>
                        <div class="options px-5 pt-1  border-bottom pb-3">
                            <div class="row">
                                <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 78%">Test Name <span
                                                    class="text-danger">*</span></th>
                                         
                                            <th scope="col" style="width: 20%">Price <span class="text-danger">*</span>
                                            </th>
                                            <th scope="col" style="width: 2%">
                                                <button class="btn btn-success btn-sm" onclick="addnewrow()"><i
                                                        class="fa fa-plus"></i></button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- dynamic row -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <input type="hidden" name="patientId" value="{{ @$patient_details_information->id }}" />
                        <input type="hidden" name="section" value="{{ @$patient_reg_details->section }}" />
                        <input type="hidden" name="case_id" value="{{ @$patient_reg_details->id }}" />
                        <input type="hidden" name="patient_type" value="{{ @$patient_reg_details->id }}" />

                        <div class="options px-5 pt-5  border-bottom pb-3">

                            <div class=" add-pathologydesign">
                                <div class="container mt-5">
                                    <div class="d-flex justify-content-end">
                                        <span class="biltext">Total</span>
                                
                                        <input type="text" id="total_am" name="total"
                                             class="myfld" />
                           
                                        @error('total')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                              
                                </div>
                            </div>

                        </div>
                        <div class="btn-list p-3">
                            <button class="btn btn-primary btn-sm float-right" type="button" onclick="gettotal()"><i
                                    class="fa fa-calculator"></i> Calculate</button>
                            <button class="btn btn-primary btn-sm float-right" value="save" type="submit" name="save"><i class="fa fa-file"></i> Save</button>
                            <button class="btn btn-primary btn-sm float-right mr-2" value="save_and_print" name="save_and_print"
                                type="submit"><i class="fa fa-paste"></i> Save & Print</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===========================Add New Item Using New Row=========================== -->
<script type="text/javascript">
    var i = 0;

    function addnewrow() {
        var html = '<tr id="rowid' + i + '"><td><select required  class="form-control select2-show-search" name="test_id[]" id="test_id' + i + '" onchange="getTestAmount(this.value,' + i + ')"><option value="">Select Test Name</option> @if(isset($pathology_all_test)) @foreach ($pathology_all_test as $key => $value)<option value="{{$value->id}}">{{$value->test_name}}</option> @endforeach @endif</select></td><td><input type="text" required name="charge[]" class="form-control" onkeyup="gettotal('+i+')" id="charge' + i + '"></td><td><button class="btn btn-danger btn-sm" onclick="remove(' + i + ')"><i class="fa fa-times"></i></button></td></tr>';

        $('#subhendu').append(html);
        i = i + 1;
    }

    function getTestAmount(test_id, i) {
        $.ajax({
            url: "{{ route('find-test-amount-by-test') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                testId: test_id,
            },
            success: function(response) {
                $('#charge' + i).val(response.total_amount);

            },
            error: function(error) {
                console.log(error);
            }
        });
        gettotal(i);
    }
</script>
<!-- ===========================Add New Item Using New Row=========================== -->
<script type="text/javascript">
    function remove(i) {
        $('#rowid' + i).remove();
        gettotal(i);
    }
</script>

<script type="text/javascript">
    function gettotal() {
        var no_of_row = $('#subhendu tr').length;
        var t = 0;
        $("input[name='charge[]']").map(function() {
            t = t + parseFloat($(this).val());
        }).get();
        $('#total_am').val(t);

    }
</script>


@endsection
