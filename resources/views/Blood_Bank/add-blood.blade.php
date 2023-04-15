@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Blood Donor Details</div>
        </div>

        <form method="POST" action="{{route('save-blood')}}">
            @csrf
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <input type="hidden" name="blood_group_id" value="{{ $blood_groups_id->id }}" />

                        <div class="form-group col-md-3">
                            <label for="blood_donor_id" class="form-label">Blood Donor <span class="text-danger">*</span></label>
                            <select id="blood_donor_id" class="form-control" name="blood_donor_id">
                                <option value=" ">Select </option>
                                @foreach ($bloodDonorDetails as $item)
                                <option value="{{$item->id}}">{{$item->donor_name}}</option>
                                @endforeach
                            </select>
                            @error('blood_donor_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="donate_date" class="form-label">Donate Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="donate_date" value="{{ old('donate_date') }}" name="donate_date">
                            <small class="text-danger">{{ $errors->first('donate_date') }}</small>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="bag" class="form-label">Bag <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="bag" value="{{ old('bag') }}" name="bag">
                            <small class="text-danger">{{ $errors->first('bag') }}</small>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="volume" class="form-label">Volume <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="volume" value="{{ old('volume') }}" name="volume">
                            <small class="text-danger">{{ $errors->first('volume') }}</small>
                        </div>


                        <div class="form-group col-md-3">
                            <label for="unit_type" class="form-label">Unit Type <span class="text-danger">*</span></label>
                            <select id="unit_type" class="form-control" name="unit_type">
                                <option value=" ">Select Unit Type</option>
                                @foreach ($unit_type as $item)
                                <option value="{{$item->id}}"> {{$item->blood_unit_types}}</option>
                                @endforeach
                            </select>
                            @error('unit_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="lot" class="form-label">lot <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="lot" value="{{ old('lot') }}" name="lot">
                            <small class="text-danger">{{ $errors->first('lot') }}</small>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="charge_category" class="form-label">Charges Catagory <span class="text-danger">*</span></label>
                            <select id="charge_category" class="form-control select2-show-search" name="charge_category" onchange="getCatagory(this.value)">
                                <option value=" ">Select Catagory</option>
                                @foreach ($catagory as $item)
                                <option value="{{$item->id}}">{{$item->charges_catagories_name}}</option>
                                @endforeach
                            </select>
                            @error('charge_category')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-3">
                            <label for="charge_name" class="form-label">Charge Name<span class="text-danger">*</span></label>
                            <select name="charge_name" class="form-control select2-show-search" id="charge_name">
                                <option value="">Select Charge Name...</option>
                            </select>
                            <small class="text-danger">{{ $errors->first('charge_name') }}</small>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="standard_charges" class="form-label"> Standard Charges<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" onkeyup="getStandardCharges()" id="standard_charges" name="standard_charges" value=" ">
                            <small class="text-danger">{{ $errors->first('standard_charges') }}</small>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="institution" class="form-label">Institution <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="institution" value="{{ old('institution') }}" name="institution">
                            <small class="text-danger">{{ $errors->first('institution') }}</small>
                        </div>

                    </div>

                </div>
                <hr>

                <div class="container mt-5">
                    <div class="d-flex justify-content-end">
                        <span class="biltext">Total</span>
                        <input type="text" readonly class="form-control myfld" id="total" name="total">
                    </div>

                    <div class="d-flex justify-content-end">
                        <input type="text" name="getdiscount" onkeyup="discountCalculate()" placeholder="Enter Discount" class="form-control myfld2" id="getdiscount">
                        <input type="text" class="form-control myfld1" id="calculateDiscount" name="discount">
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="text" name="taxfeildid" placeholder="Enter Tax" onkeyup="calculateTax()" class="form-control myfld2" id="taxfeildid">
                        <input type="text" class="form-control myfld1" id="taxid" name="taxid">
                    </div>

                    <div class="d-flex justify-content-end thrdarea">
                        <span class="biltext">Net Amount</span>
                        <input type="text" class="form-control myfld" id="net_amount" name="net_amount" readonly>
                    </div>

                    <div class="d-flex justify-content-end thrdarea">
                        <!-- <span class="biltext">Payment Mode</span> -->
                        <select id="payment_mode" class="form-control myfld2" name="payment_mode">
                            <option value="">Select Payment Amount</option>
                            @foreach (Config::get('static.payment_mode_name') as $lang => $item)
                            <option value="{{$item}}"> {{$item}}</option>
                            @endforeach
                        </select>
                        @error('payment_mode')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <input type="text" class="form-control myfld1" id="payment_amount" name="payment_amount" placeholder="Enter Payment Amount" readonly>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 d-block">
                            <label class="form-label">Note</label>
                            <textarea name="note" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class=" text-right">
                    <button class="btn btn-success" onclick="gettotal()" type="button"><i class="fa fa-calculator"></i> Calculate</button>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-send"></i> Submit</button>
                </div>
                <!-- End Table with stripped rows -->
            </div>
    </div>
</div>
</form>
</div>
</div>

<script type="text/javascript">
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
</script>



@endsection