@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add New Slots</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('save-slots-details') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="doctor" >Doctor <span class="text-danger">*</span></label>
                        <select id="doctor" class="form-control" name="doctor">
                            <option value=" ">Select Doctor</option>
                            @foreach ($doctor as $item)
                            <option value="{{$item->id}}">{{$item->first_name}} {{$item->middle_name}} {{$item->last_name}}</option>
                            @endforeach
                        </select>
                        @error('doctor')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3 appoinmentdays">
                        <label for="date">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date" name="date" required>
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3 appointtimeedit">
                        <label for="from_time">From Time<span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="from_time" name="from_time" required>
                        @error('from_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3 appointtimeedit">
                        <label for="to_time">From To<span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="to_time" name="to_time" required>
                        @error('to_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 appoinmentadd">
                        <label for="charge">Charges <span class="text-danger">*</span></label>
                        <select name="charge" class="form-control select2-show-search" id="charge" required>
                            <option value="">Select charge...</option>
                            @if($charge_name)
                            @foreach($charge_name as $key => $value)
                                <option value="{{  $value->id }}">{{ $value->charges_name }}</option>
                            @endforeach
                            @endif
                        </select>
                        <small class="text-danger">{{ $errors->first('charge') }}</small>
                    </div>
                    <div class="form-group col-md-3 appoinmentadd">
                        <label for="standard_charges">Standard Charges <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="standard_charges" name="standard_charges" required style="margin: 0px 0px 0px 0px;">
                        @error('standard_charges')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <hr>
                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-file"></i> Save</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>

{{-- <script>
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
                    catagory_id: 16,
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
</script> --}}

{{-- <script>
    $(document).ready(function() {
        $("#charge_sub_category").change(function(event) {
            event.preventDefault();
            let charge = $(this).val();

            $("#charge").html('<option value=" ">Select Charge...</option>');
            $.ajax({
                url: "{{ route('find-charge-by-sub-catagory') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    charge_id: charge,
                },

                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#charge').append(`<option value="${value.id}">${value.charges_name}</option>`);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script> --}}

<script>
    $(document).ready(function() {
        $("#charge").change(function(event) {
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
                    $('#standard_charges').val(response.charge_amount);
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
    }
</script>

<script>
    function fdsfds() {
        $('#pop').removeAttr('style', true);
    }
</script>

@endsection
