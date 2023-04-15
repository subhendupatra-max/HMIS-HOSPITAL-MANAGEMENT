@extends('layouts.layout')
@section('content')
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add New Radiology Test</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('save-radiology-test-details') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="test_name" class="form-label"> Test Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="test_name" name="test_name"
                                placeholder="Enter Test Name" value="{{ old('test_name') }}" required>
                            @error('test_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="short_name" class="form-label">Short Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="short_name" name="short_name"
                                placeholder="Enter Short Name" value="{{ old('short_name') }}" required>
                            @error('short_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="test_type" class="form-label">Test Type<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="test_type" name="test_type"
                                placeholder="Enter Test Type" value="{{ old('test_type') }}" required>
                            @error('test_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="catagory_id" class="form-label">Category<span class="text-danger">*</span></label>
                            <select id="catagory_id" class="form-control" name="catagory_id">
                                <option value=" ">Select Category</option>
                                @foreach ($catagory as $item)
                                    <option value="{{ $item->id }}">{{ $item->catagory_name }}</option>
                                @endforeach
                            </select>
                            @error('catagory_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="sub_catagory" class="form-label"> Sub Catagory<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="sub_catagory" name="sub_catagory"
                                placeholder="Enter Sub Catagory Name" value="{{ old('sub_catagory') }}" required>
                            @error('sub_catagory')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="method" class="form-label"> Method <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="method" name="method"
                                placeholder="Enter Sub Catagory Name" value="{{ old('method') }}" required>
                            @error('method')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="report_days" class="form-label"> Report Days <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="report_days" name="report_days"
                                placeholder="Enter Report Days" value="{{ old('report_days') }}" required>
                            @error('report_days')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="charge_category" class="form-label">Charges Catagory <span
                                    class="text-danger">*</span></label>
                            <select id="charge_category" class="form-control select2-show-search" name="charge_category">
                                <option value=" ">Select Catagory</option>
                                @foreach ($chargeCatagory as $item)
                                    <option value="{{ $item->id }}">{{ $item->charges_catagories_name }}</option>
                                @endforeach
                            </select>
                            @error('charge_category')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="charge_sub_category">Charges Sub Catagory <span class="text-danger">*</span></label>
                            <select name="charge_sub_category" class="form-control select2-show-search"
                                id="charge_sub_category" required>
                                <option value="">Select Sub Catagory...</option>
                            </select>
                            <small class="text-danger">{{ $errors->first('charge_sub_category') }}</small>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="charge">Charges <span class="text-danger">*</span></label>
                            <select name="charge" class="form-control select2-show-search" id="charge" required>
                                <option value="">Select charge...</option>
                            </select>
                            <small class="text-danger">{{ $errors->first('charge') }}</small>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="tax">Tax<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tax" value="{{ old('tax') }}"
                                onkeyup="totalAmount()" name="tax" placeholder="Enter Tax">
                            <small class="text-danger">{{ $errors->first('tax') }}</small>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="standard_charges">Charge Amount<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="standard_charges" onkeydown="fdsfds()"
                                onkeyup="totalAmount()" name="standard_charges">

                            <div class="mt-3" style="display:none;" id="pop">
                                <input type="checkbox" value="on" id="button1" name="button1"
                                    style="margin-right: 5px;" /><label for="permission" class="textlink">Are You Want To
                                    Change This ? </label>
                            </div>

                            <small class="text-danger">{{ $errors->first('standard_charges') }}</small>
                        </div>

                        <div class="form-group col-md-4 ">
                            <label for="total_amount">Total Amount<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="total_amount" name="total_amount" readonly>
                            <small class="text-danger">{{ $errors->first('total_amount') }}</small>
                        </div>
                    </div>

                    <div class="form-group col-md-12 mt-0 ">
                        <hr>
                    </div>
                    <div class="form-group col-md-12 mt-0 ">
                        <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 15%"> Test Parameter Name <span
                                            class="text-danger">*</span></th>
                                    <th scope="col" style="width: 15%">Reference Range <span
                                            class="text-danger">*</span></th>
                                    <th scope="col" style="width: 10%">Unit <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 58%">Formula
                                    </th>
                                    <th scope="col" style="width: 2%">
                                        <button class="btn btn-success" onclick="addnewrow()"><i
                                                class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- dynamic row -->
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center m-auto">
                        <button type="submit" class="btn btn-primary">Save Test</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script>
        var i = 1;

        function addnewrow() {

            var html = `
                        <tr id="rowid${i}">
                        <td><select id="test_parameter_name${i}" onchange="getParameter(${i})" class="form-control select2-show-search"
                        name="test_parameter_name[]">
                        <option value="">Select Parameter Name</option>
                        @foreach ($parameter as $item)
                        <option value="{{ $item->id }}">{{ $item->parameter_name }}</option>
                        @endforeach
                        </select>
                        </td>
                        <td>
                        <span id="reference_range${i}"></span>
                        </td>
                        <td>
                        <span id="unit${i}"></span>
                        </td>
                        <td>
                        <textarea class="form-control" name="formule[]"></textarea>
                        </td>
                        </tr>`;

            $('#subhendu').append(html);
            i = i + 1;
        }
    </script>

    <script>
        function getParameter(i) {
            var parameter = $('#test_parameter_name' + i).val();
            $.ajax({
                url: "{{ route('find-range-by-parameter-radiology') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    parameter_id: parameter,
                },

                success: function(response) {
                    console.log(response);
                    const reference_range = response.range_value.reference_range;
                    const unit = response.unit_value.unit_name;
                    $('#reference_range' + i).html(reference_range);
                    $('#unit' + i).html(unit);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
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
                            $('#charge_sub_category').append(
                                `<option value="${value.id}">${value.charges_sub_catagories_name}</option>`
                            );
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
                            $('#charge').append(
                                `<option value="${value.id}">${value.charges_name}</option>`
                            );
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
        }
    </script>

    <script>
        function fdsfds() {
            $('#pop').removeAttr('style', true);
        }
    </script>
    <script>
        $(document).ready(function() {
            $("#abcd").keyup(function(event) {
                event.preventDefault();
                let charge = $(this).val();
            });
        });
    </script>
@endsection
