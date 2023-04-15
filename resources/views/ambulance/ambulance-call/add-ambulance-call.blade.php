@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Ambulance Call</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('save-ambulance-call-details') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="vehicle_model" class="form-label">Vehicle Model <span class="text-danger">*</span></label>
                        <select class="form-control select2-show-search select2-hidden-accessible" value="{{ old('vehicle_model') }}" name="vehicle_model" id="vehicle_model" required>
                            <optgroup>
                                <option value=" ">Select Vehicle Model </option>
                                @foreach ($ambulance as $item)
                                <option value="{{$item->id}}">{{$item->vehicle_model}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        @error('vehicle_model')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="driver_name" class="form-label">Driver Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="driver_name" name="driver_name" required>
                        @error('driver_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="date" class="form-label">Date<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date" name="date" >
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="charge_category" class="form-label">Charges Catagory <span class="text-danger">*</span></label>
                        <select id="charge_category" class="form-control select2-show-search" name="charge_category" required >
                            <option value=" ">Select Catagory</option>
                            @foreach ($catagory as $item)
                            <option value="{{$item->id}}">{{$item->charges_catagories_name}}</option>
                            @endforeach
                        </select>
                        @error('charge_category')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="charge_sub_category" class="form-label">Charges Sub Catagory <span class="text-danger">*</span></label>
                        <select name="charge_sub_category" class="form-control select2-show-search" id="charge_sub_category" required>
                            <option value="">Select Sub Catagory...</option>
                        </select>
                        @error('charge_sub_category')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="charge_name" class="form-label">Charge Name <span class="text-danger">*</span></label>
                        <select name="charge_name" class="form-control select2-show-search" id="charge_name" required>
                            <option value="">Select charge...</option>
                        </select>
                        @error('charge_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="standard_charges" class="form-label">Standard Charge<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="standard_charges" onkeydown="fdsfds()" onkeyup="totalAmount()" name="standard_charges" required>

                        <div class="mt-3" style="display:none;" id="pop">
                            <input type="checkbox" value="on" id="button1" name="button1" style="margin-right: 5px;" /><label for="permission" class="textlink">Are You Want To Change This ? </label>
                        </div>
                        @error('standard_charges')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="form-group col-md-4">
                        <label for="tax" class="form-label">Tax<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="tax" value="{{ old('tax') }}" onkeyup="totalAmount()" name="tax" placeholder="Enter Tax" required>
                        @error('tax')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 ">
                        <label for="total_amount" class="form-label">Total Amount<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="total_amount" name="total_amount" required readonly>
                        @error('total_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 ">
                        <label for="net_amount" class="form-label">Net Amount<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="net_amount" name="net_amount" required readonly>
                        @error('net_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="payment_mode" class="form-label">Payment Mode </label>
                        <select id="payment_mode" class="form-control" name="payment_mode" onchange="paymentMode(this.value)" required>
                            <option value="">Select</option>
                            @foreach (Config::get('static.payment_mode_name') as $lang => $item)
                            <option value="{{$item}}"> {{$item}}</option>
                            @endforeach
                        </select>
                        @error('payment_mode')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 ">
                        <label for="payment_amount" class="form-label">Payment Amount<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="payment_amount" name="payment_amount" readonly required>
                        @error('payment_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3 form-group col-md-12" id="check" style="display:none">
                        <div class="row">
                            <div class="form-group col-lg-4 ">
                                <label for="cheque_no" class="form-label"> Cheque No<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="cheque_no" name="cheque_no">
                                @error('cheque_no')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4 ">
                                <label for="cheque_date" class="form-label">Cheque Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="cheque_date" name="cheque_date">
                                @error('cheque_date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-lg-4  ">
                                <label for="cheque_document" class="form-label"> Attach Document <span class="text-danger">*</span></label>
                                <input type="file" id="cheque_document" name="cheque_document">
                              
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="note" class="form-label"> Note <span class="text-danger">*</span></label>
                        <textarea name="note" class="form-control"> </textarea>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
        </div>

        <div class="text-center m-auto">
            <button type="submit" class="btn btn-primary">Save Ambulance Call</button>
        </div>
    </div>
    </form>
</div>

</div>

</div>


<script>
    $(document).ready(function() {
        $("#vehicle_model").change(function(event) {
            event.preventDefault();
            let driver = $(this).val();
            // alert(driver);
            $.ajax({
                url: "{{ route('find-driver-name-by-vehicial-model') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    driver_id: driver,
                },

                success: function(response) {

                    $('#driver_name').val(response.driver_name);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#charge_category").change(function(event) {
            // alert('ok')
            event.preventDefault();
            let catagory = $(this).val();
            // alert(state);
            $('#charge_sub_category').html('<option vaule="" >Select Sub Catagory...</option>');
            $.ajax({
                url: "{{ route('find-sub-catagory-by-catagory') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    catagory_id: catagory,
                },

                success: function(response) {


                    $.each(response, function(key, value) {
                        $('#charge_sub_category').append(`<option value="${value.id}">${value.charges_sub_catagories_name}</option>`);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#charge_sub_category").change(function(event) {
            event.preventDefault();
            let charge = $(this).val();

            $("#charge_name").html('<option value=" ">Select Charge...</option>');
            $.ajax({
                url: "{{ route('find-charge-by-sub-catagory') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    charge_id: charge,
                },

                success: function(response) {

                    $.each(response, function(key, value) {
                        $('#charge_name').append(`<option value="${value.id}">${value.charges_name}</option>`);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>


<script>
    $(document).ready(function() {
        $("#charge_name").change(function(event) {
            event.preventDefault();
            let charge = $(this).val();

            $.ajax({
                url: "{{ route('find-charge-by-statndard-charges') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    charges: charge,
                },

                success: function(response) {
                    console.log(response);
                    $('#standard_charges').val(response.standard_charges);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<script>
    function totalAmount() {
        $("#total_amount").val(00);
        var taxAmount = $("#tax").val();
        var chargeAmount = $("#standard_charges").val();
        var totalAmount = parseInt(chargeAmount * taxAmount / 100) + parseInt(chargeAmount);
        $("#total_amount").val(totalAmount);
        $("#net_amount").val(totalAmount);
        $("#payment_amount").val(totalAmount);
    }
</script>


<script>
    function fdsfds() {
        $('#pop').removeAttr('style', true);
    }
</script>

<script>
    function paymentMode(val) {
        if (val == 'Cheque') {
            $('#check').removeAttr('style', true);
        } else {
            $('#check').attr('style', 'display:none', true);
        }
    }
</script>
@endsection