@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add New Pathology Test Master</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('save-pathology-test-master-details') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        {{-- <label for="test_name" class="form-label"> Test Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="test_name" name="test_name" placeholder="Enter Test Name" value="{{ old('test_name') }}" required> --}}
                        <input type="text" id="test_name"name="test_name" required />
                    <label for="test_name"> Test Name<span class="text-danger">*</span> </label>
                        @error('test_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12 ">
                        <label for="test_name" class="form-label"> Test Details </label>
                        <textarea class="content" name="test_details"></textarea>
                    </div>
                </div>

                <div class="form-group col-md-12 mt-0 ">
                    <hr>
                </div>
                <div class="form-group col-md-12 mt-0 ">
                    <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 30%"> Test Parameter Name <span class="text-danger">*</span></th>
                                <th scope="col" style="width: 40%">Reference Range <span class="text-danger">*</span></th>
                                <th scope="col" style="width: 28%">Unit <span class="text-danger">*</span>
                                </th>
                                <th scope="col" style="width: 2%">
                                    <button type="button" class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
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
                        </tr>`;
        $('#subhendu').append(html);
        i = i + 1;
    }
</script>

<script>
    function getParameter(i) {
        var parameter = $('#test_parameter_name' + i).val();
        $.ajax({
            url: "{{ route('find-range-by-parameter') }}",
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
