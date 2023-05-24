@extends('layouts.layout')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Add Blood Issue</div>
        </div>
        <div class="card-body p-0">
            <div class="row no-gutters">
                <div class="col-lg-4 col-xl-4 border-right">
                    {{-- ================== add new patient ====================== --}}
                    <!-- <div class="options px-5 pt-2  border-bottom pb-1">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <a class="btn btn-primary btn-sm" href="{{route('add_new_patient')}}"><i class="fa fa-plus"></i> Add New Patient</a>
                            </div>
                        </div>
                    </div> -->
                    {{-- ================== add new patient ====================== --}}

                    {{-- ================== Search patient ====================== --}}
                    <div class="options px-5 pt-5  border-bottom pb-3">

                        <form method="post" action="{{route('add-blood-components-issue-belling-for-a-patient',['blood_group_id'=> base64_encode($blood_groups_id->id), 'id'=> base64_encode($blood_details->id)  ]) }}">
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
                    <form method="post" action="{{route('save-blood-components-issue-details')}}">
                        @csrf
                        <div class="options px-5 pt-1  border-bottom pb-3">
                            <div class="row">
                                <input type="hidden" name="patient_id" value="{{@$patient_details_information->id}}" />
                                <input type="hidden" name="blood_group_id" value="{{ $blood_groups_id->id }}" />
                                <input type="hidden" name="components_id" value="{{$components_id}}" />
                                <div class="form-group col-md-3">
                                    <label for="issue_date" class="form-label">Issue Date<span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" id="issue_date" value="{{ old('issue_date') }}" name="issue_date">
                                    <small class="text-danger">{{ $errors->first('issue_date') }}</small>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="issed_by" class="form-label">Issued By <span class="text-danger">*</span></label>
                                    <select id="issed_by" class="form-control" name="issed_by">
                                        <option value=" ">Select </option>
                                        @foreach ($issed_by as $item)
                                        <option value="{{$item->id}}">{{$item->first_name}} {{$item->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('issed_by')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="reference_name" class="form-label">Reference Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="reference_name" value="{{ old('reference_name') }}" name="reference_name">
                                    <small class="text-danger">{{ $errors->first('reference_name') }}</small>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="technician" class="form-label">Technician <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="technician" value="{{ old('technician') }}" name="technician">
                                    <small class="text-danger">{{ $errors->first('technician') }}</small>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="blood_group" class="form-label">Blood Group <span class="text-danger">*</span></label>
                                    <select id="blood_group" class="form-control" name="blood_group">
                                        <option value=" ">Select </option>
                                        @foreach ($blood_groups as $item)
                                        <option value="{{$item->id}}" {{ $item->id == $blood_details->blood_group_id ? 'selected' : " " }}> {{$item->blood_group_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('blood_group')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="bag" class="form-label">Bag <span class="text-danger">*</span></label>
                                    <select id="bag" class="form-control" name="bag">
                                        <option value=" ">Select </option>
                                        @foreach ($getBag as $item)
                                        <option value="{{$item->bag}}" {{ $item->bag == $blood_details->bag ? 'selected' : " " }}> {{$item->bag}}</option>
                                        @endforeach
                                    </select>
                                    @error('bag')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- <div class="col-md-12"> -->
                                <div class="form-group col-md-3">

                                    <label class="form-label">Blood Qty</label>
                                    <input type="text" name="components_qty" class="form-control" />

                                </div>
                                <div class="form-group col-md-3">

                                    <label class="form-label">Note</label>
                                    <textarea name="note" class="form-control"></textarea>

                                </div>
                                <!-- </div> -->


                            </div>
                        </div>


                        <div class="btn-list p-3">

                            <button class="btn btn-primary btn-sm" type="submit" name="save"><i class="fa fa-file"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script type="text/javascript">
    function getStandardCharges() {
        let standard_charges = $('#standard_charges').val();
        $('#total').val(standard_charges);
        $("#net_amount").val(' ');
        $("#payment_amount").val(' ');
        discountCalculate();
        calculateTax();

    }

    function gettotal() {
        var total = $('#total').val();
        var total_with_discount = $('#calculateDiscount').val();
        var total_with_discount_with_tax = $('#taxid').val();
        let net_amount = parseFloat(parseFloat(total) + parseFloat(total_with_discount) + parseFloat(total_with_discount_with_tax)).toFixed(2);
        $('#net_amount').val(net_amount);
        $('#payment_amount').val(net_amount);
    }
</script>

<script type="text/javascript">
    function discountCalculate() {
        var discountFeild = $('#getdiscount').val();
        var totalAmount = $("#total").val();
        var totalDiscount = parseFloat(totalAmount * (discountFeild / 100)).toFixed(2);
        $("#calculateDiscount").val(totalDiscount);
        calculateTax();
    }
</script>

<script type="text/javascript">
    function calculateTax() {

        var totalAmount = $("#total").val();
        var totalDiscount = $('#calculateDiscount').val();
        var total_plus_discount = parseFloat(totalAmount) + parseFloat(totalDiscount);
        var discount_percentage = $("#taxfeildid").val();
        var totalTax = parseFloat(total_plus_discount * (discount_percentage / 100)).toFixed(2);

        $("#taxid").val(totalTax);
        $("#net_amount").val(' ');
        $("#payment_amount").val(' ');
        discountCalculate();
    }
</script>

<script>
    function getCatagory(catagory) {

        $('#charge_name').html('<option value="" >Select...</option>');

        $.ajax({
            url: "{{ route('find-charge-name-by-charge-catagory-in-blood') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                catagory_id: catagory,
            },
            success: function(response) {
                // console.log(response);
                $.each(response, function(key, values) {
                    $('#charge_name').append(`<option value="${values.id}"  >${values.charges_name}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });

    }
</script>

<script>
    $(document).ready(function() {
        $("#charge_name").change(function(event) {
            event.preventDefault();
            let charge_name = $(this).val();

            $.ajax({
                url: "{{ route('find-charge-by-statndard-charges-in-blood-bank') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    charge_id: charge_name,
                },

                success: function(response) {
                    console.log(response);
                    $('#standard_charges').val(response.standard_charges);
                    $('#total').val(response.standard_charges);

                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script> -->


@endsection