@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Referral Payment </h4>
        </div>
    @include('message.notification')
        <div class="card-body">
            <form class="form-horizontal" enctype="multipart/form-data" method="POST"
                action="{{ route('referral-commission-save') }}">
                @csrf
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="form-group col-md-4 newaddappon ">
                                    <label for="reference" class="form-label">Referrel Name</label>
                                    <select name="reference" onchange="getPatientName(this.value)" class="form-control select2-show-search" id="reference">
                                        <option value="">Referrel Name</option>
                                        @foreach ($referer as $key => $reference)
                                        <option value="{{$reference->id}}"> {{$reference->referral_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 newaddappon ">
                                    <label for="patient_details" class="form-label">Patient Name</label>
                                    <select name="patient_details" onchange="getBill(this.value)" class="form-control select2-show-search" id="patient_details">
                                        <option value="">Patient Name</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 newaddappon ">
                                    <label for="bill_id" class="form-label">Bill Id</label>
                                    <select name="bill_id" onchange="getBillDetails(this.value)" class="form-control select2-show-search" id="bill_id">
                                        <option value="">Bill Id...</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 newaddappon ">
                                    <label for="bill_amount" class="form-label">Bill Amount</label>
                                    <input type="text" name="bill_amount"  id="bill_amount" />
                                </div>
                                <div class="form-group col-md-4 newaddappon ">
                                    <label for="commission_amount" class="form-label">Commission Amount</label>
                                    <input type="text" name="commission_amount"  id="commission_amount" />
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="row">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Pathology Commission(%) </span>
                                            </td>
                                            <td class="py-2 px-5">{!!$referral->pathology_commission!!}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Radiology Commission(%) </span>
                                            </td>
                                            <td class="py-2 px-5">
                                                {{ @$referral->radiology_commission }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50">Ambulance Commission(%) </span>
                                            </td>
                                            <td class="py-2 px-5">{{ @$referral->ambulance_commission }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-5">
                                                <span class="font-weight-semibold w-50"> Blood Bank Commission(%) </span>
                                            </td>
                                            <td class="py-2 px-5">{{ @$referral->blood_bank_commission }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> --}}
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-file"></i> Add Referral Payment</button>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function getPatientName(value){
        $('#patient_details').html('<option value="">Select One...</option>');
        var div_data = '';
        $.ajax({
            url: "{{ route('get-patient-by-referral') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                referralId: value,
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    div_data += `<option value="${value.patient_id}">${value.prefix} ${value.first_name} ${value.middle_name} ${value.last_name} ( UHID : ${value.patient_id} )</option>`;
                });
                $('#patient_details').append(div_data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function getBill(value){
        $('#bill_id').html('<option value="">Select One...</option>');
        var div_data = '';
        $.ajax({
            url: "{{ route('get-bill-by-patient-id') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                p_Id: value,
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    div_data += `<option value="${value.id}">${value.id}</option>`;
                });
                $('#bill_id').append(div_data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

     function getBillDetails(bill_id)
    {
        $.ajax({
            url: "{{ route('get-bill-amount-by-bill-id') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                billId: bill_id,
            },
            success: function(response) {
                console.log(response);
                $('#bill_amount').val(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>



<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
@endsection