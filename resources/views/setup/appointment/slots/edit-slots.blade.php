@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit New Slots</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('update-slots-details') }}" method="POST">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{$editSlots->id}}">
                    <div class="form-group col-md-4">
                        <label for="doctor" class="form-label">Doctor <span class="text-danger">*</span></label>
                        <select id="doctor" class="form-control" name="doctor">
                            <option value=" ">Select Doctor</option>
                            @foreach ($doctor as $item)
                            <option value="{{$item->id}}" {{ $item->id == $editSlots->doctor ? 'selected' : " " }}>{{$item->first_name}} {{$item->middle_name}} {{$item->last_name}}</option>
                            @endforeach
                        </select>
                        @error('doctor')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="days" class="form-label">Days <span class="text-danger">*</span></label>
                        <select id="days" class="form-control" name="days">
                            <option value="">Select</option>
                            @foreach (Config::get('static.weeks') as $lang => $item)
                            <option value="{{$item}}" {{ $item == $editSlots->days ? 'selected' : " " }}> {{$item}}</option>
                            @endforeach
                        </select>
                        @error('days')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="from_time" class="form-label">From Time<span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="from_time" name="from_time" required @if(isset($editSlots->from_time)) value="{{$editSlots->from_time}}" @endif>
                        @error('from_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="to_time" class="form-label">From To<span class="text-danger">*</span></label>
                        <input type="time" class="form-control" id="to_time" name="to_time" required @if(isset($editSlots->to_time)) value="{{$editSlots->to_time}}" @endif>
                        @error('to_time')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="charge_category" class="form-label">Charges Catagory <span class="text-danger">*</span></label>
                        <select id="charge_category" onchange="getSubCategory(this.value,{{$editSlots->charge_sub_category}},{{$editSlots->charge}})" class="form-control select2-show-search" name="charge_category">
                            <option value=" ">Select Catagory</option>
                            @foreach ($catagory as $item)
                            <option value="{{$item->id}}" {{ $item->id == $editSlots->charge_category ? 'selected':" "}}>{{$item->charges_catagories_name}}</option>
                            @endforeach
                        </select>
                        @error('charge_category')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="charge_sub_category">Charges Sub Catagory <span class="text-danger">*</span></label>
                        <select name="charge_sub_category" class="form-control select2-show-search" onchange="getChargeName(this.value,{{$editSlots->charge}})" id="charge_sub_category" required>
                            <option value="">Select Sub Catagory...</option>
                        </select>
                        <small class="text-danger">{{ $errors->first('charge_sub_category') }}</small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="charge">Charges <span class="text-danger">*</span></label>
                        <select name="charge" onchange="getStandardCharges(this.value)" class="form-control select2-show-search" id="charge" required>
                            <option value="">Select charge...</option>
                        </select>
                        <small class="text-danger">{{ $errors->first('charge') }}</small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="tax">Tax<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{$editSlots->tax}}" id="tax" value="{{ old('tax') }}" onkeyup="totalAmount()" name="tax" placeholder="Enter Tax">
                        <small class="text-danger">{{ $errors->first('tax') }}</small>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="standard_charges">Charge Amount<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="standard_charges" onkeydown="fdsfds()" onkeyup="totalAmount()" name="standard_charges">

                        <div class="mt-3" style="display:none;" id="pop">
                            <input type="checkbox" value="on" id="button1" name="button1" style="margin-right: 5px;" /><label for="permission" class="textlink">Are You Want To Change This ? </label>
                        </div>

                        <small class="text-danger">{{ $errors->first('standard_charges') }}</small>
                    </div>

                    <div class="form-group col-md-4 ">
                        <label for="total_amount">Total Amount<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{$editSlots->total_amount}}" id="total_amount" name="total_amount" readonly>
                        <small class="text-danger">{{ $errors->first('total_amount') }}</small>
                    </div>

                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Solts</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>

<script>
    function getSubCategory(charge_category,sub_category,charge_name)
    {
        $('#charge_sub_category').val('');
        $("#charge_sub_category").html("<option value='l'>loading... </option>");
        $.ajax({
                url: "{{ route('find-sub-catagory-by-catagory') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    catagory_id: charge_category,
                },

                success: function(response) {
                    $.each(response, function(key, value) {
                        let sel = (value.id == sub_category ? 'selected' : '');
                        $('#charge_sub_category').append(`<option value="${value.id}" ${sel}>${value.charges_sub_catagories_name}</option>`);
                    });
                    getChargeName(sub_category,charge_name);
                },
                error: function(error) {
                    console.log(error);
                }
            });
    }
</script>

<script>
    function getChargeName(charge_Sub_category,charge_name)
    {
        var div_data = '';
        $('#charge').val('');
        $("#charge").html("<option value='l'>loading... </option>");
        var ijij =  $('#charge_Sub_category').val();
        $.ajax({
                url: "{{ route('find-charge-by-sub-catagory') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    charge_id: charge_Sub_category,
                },

                success: function(response) {
                  //  console.log(response);
                    console.log('nvifei'+response);
                    $.each(response, function(key, value) {
                        let sel = (value.id == charge_name ? 'selected' : '');
                        div_data += `<option value="${value.id}" ${sel}>${value.charges_name}</option>`;
                    });
                    $('#charge').append(div_data);
                    getStandardCharges(charge_name);
                },
                error: function(error) {
                    console.log(error);
                }
            });
    }
</script>
<script>
    function getStandardCharges(charge)
    {
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
    }
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
