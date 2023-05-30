@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Radiology Test</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('update-radiology-test-details') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ @$radiology_test->id }}" />
                <div class="row">
                    <div class="form-group col-md-4">

                        <input type="text" id="test_name" value="{{ @$radiology_test->test_name }}" name="test_name" required="">
                        <label for="test_name">Test Name <span class="text-danger">*</span></label>
                        @error('test_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
         
                        <input type="text" id="short_name"  value="{{ @$radiology_test->short_name }}" name="short_name" required="">
                        <label for="short_name">Short Name</label>
                        @error('short_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        
                        <input type="text" id="test_type" name="test_type"  value="{{ @$radiology_test->test_type }}" required="">
                        <label for="test_type">Test Type</label>
                        @error('test_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 addnew">
                         <label for="catagory_id" >Category<span class="text-danger">*</span></label>
                        <select id="catagory_id" class="form-control" name="catagory_id">
                            <option value=" ">Select Category</option>
                            @foreach ($catagory as $item)
                            <option value="{{ $item->id }}" {{ $item->id == @$radiology_test->catagory_id ?'selected':''  }}>{{ $item->catagory_name }}</option>
                            @endforeach
                        </select>
                        @error('catagory_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 addnewblade">

                        <input type="text"id="sub_catagory" name="sub_catagory" value="{{ @$radiology_test->sub_catagory }}"  required="">
                        <label for="sub_catagory">Sub Catagory</label>
                        @error('sub_catagory')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 addnewblade">
        
                        <input type="text" id="method" name="method"  value="{{ @$radiology_test->method }}" required="">
                        <label for="method">Method</label>
                        @error('method')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 addnewbladee ">

                        <input type="text"  id="report_days" name="report_days"  value="{{ @$radiology_test->report_days }}" required="">
                        <label for="report_days">Report Days </label>
                        @error('report_days')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 addnewde">
                         <label for="charge_category" >Charges Catagory <span class="text-danger">*</span></label>
                        <select id="charge_category" data-charge_name = {{ $radiology_test->charge }} data-charge_sub_category="{{ $radiology_test->charge_sub_category }}" class="form-control select2-show-search" name="charge_category">
                            <option value=" ">Select Catagory</option>
                            @foreach ($chargeCatagory as $item)
                            <option value="{{ $item->id }}" {{ $item->id == @$radiology_test->charge_category ?'selected':''  }} >{{ $item->charges_catagories_name }}</option>
                            @endforeach
                        </select>
                        @error('charge_category')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4 addnewde">
                        <label for="charge_sub_category">Charges Sub Catagory <span class="text-danger">*</span></label>
                        <select name="charge_sub_category" class="form-control select2-show-search" onchange="getChargeName(this.value,{{ $radiology_test->charge }})" id="charge_sub_category" required >
                            <option value="">Select Sub Catagory...</option>
                        </select>
                        <small class="text-danger">{{ $errors->first('charge_sub_category') }}</small>
                    </div>

                    <div class="form-group col-md-4 addnewblade">
                         <label for="charge">Charge Name <span class="text-danger">*</span></label>
                        <select name="charge" class="form-control select2-show-search" id="charge" onchange="getChargeAmount(this.value)" required>
                            <option value="">Select charge...</option>
                        </select>
                        <small class="text-danger">{{ $errors->first('charge') }}</small>
                    </div>

                    <div class="form-group col-md-8 addnewde" >
                        <span id="charge_details" style="font-size: 16px;"></span>
                    </div>

                    <div class="form-group col-md-12 addnewblade">
                        <label >Description</label>
                        <textarea class="content" name="description">{{ @$radiology_test->description  }}</textarea>
                    </div>
                </div>


                <div class="form-group col-md-12 mt-0 ">
                    <table class="table card-table table-vcenter text-nowrap">
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
                        <tbody  id="subhendu">
                            @if(@$radiology_test_details[0]->id != null)
                                @foreach ($radiology_test_details as $key => $value)
                                <tr id="rowid{{ $key }}">
                                    <td><select id="test_parameter_name{{ $key }}" onchange="getParameter({{ $key }})" class="form-control select2-show-search"
                                    name="test_parameter_name[]">
                                    <option value="">Select Parameter Name</option>
                                    @foreach ($parameter as $item)
                                    <option value="{{ $item->id }}" {{ $item->id == $value->pathology_parameter_id ? 'selected':'' }}>{{ $item->parameter_name }}</option>
                                    @endforeach
                                    </select>
                                    </td>
                                    <td>
                                    <span id="reference_range{{ $key }}"></span>
                                    </td>
                                    <td>
                                    <span id="unit{{ $key }}"></span>
                                    </td>
                                    </tr> 
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Update Test</button>
                </div>
            </form>
        </div>
    </div>

</div>
<script>
    var i = 1;

    function addnewrow() {
        var html = `<tr id="rowid${i}">
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
            url: "{{ route('find-range-by-parameter-in-radiology') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                parameter_id: parameter,
            },

            success: function(response) {
                console.log(response);
                const reference_range = response.range_value.reference_range;
                console.log(reference_range);
                const unit = response.unit_value.unit_name;
                console.log(unit);
                console.log(i);
                $('#reference_range' + i).html(reference_range);
                $('#unit' + i).html(unit);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

{{-- <script>
    var i = 1;
    function addnewrow() {
        var html = `<tr id="rowid${i}">
                        <td>
                            <select id="master_test_name${i}" class="form-control select2-show-search"
                                name="master_test_name[]">
                                <option value="">Select Test Name</option>
                                @if(isset($all_test))
                                @foreach ($all_test as $test)
                                <option value="{{$test->id}}">{{$test->test_name}}</option>
                                @endforeach
                                @endcan
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="remove(${i})"><i class="fa fa-times"></i></button>
                        </td>
                    </tr>`;
        $('#subhendu').append(html);
        i = i + 1;
    }
</script>
<script>
    function remove(i)
    {
         $('#rowid'+i).remove();
    }
</script> --}}


<script>
    $(document).ready(function() {
        $("#charge_category").change(function(event) {
            // alert('ok')
            event.preventDefault();
            let catagory = $(this).val();
            var sub_cat = $(this).attr("data-charge_sub_category")
            var charge_name = $(this).attr("data-charge_name")
            var sel = '';
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
                        if(sub_cat == value.id)
                        {
                            sel = 'selected';
                        }
                        $('#charge_sub_category').append(
                            `<option value="${value.id}" ${sel} >${value.charges_sub_catagories_name}</option>`
                        );
                    });
                    getChargeName(sub_cat,charge_name);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>


<script>
    function getChargeName(sub_cat = null,	charge = null){
        $("#charge").html('<option value=" ">Select Charge...</option>');
        var sel = '';
        $.ajax({
                url: "{{ route('find-charge-by-sub-catagory') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    charge_id: sub_cat,
                },

                success: function(response) {

                    $.each(response, function(key, value) {
                        if(charge == value.id)
                        {
                            sel = 'selected';
                        }
                        $('#charge').append(
                            `<option value="${value.id}" ${sel} >${value.charges_name}</option>`
                        );
                    });
                    getChargeAmount(charge);
                },
                error: function(error) {
                    console.log(error);
                }
            });
    }
</script>

<script>
    function getChargeAmount(charge = null){
        $('#charge_details').text('');
            var div_data = '';
        $.ajax({
                url: "{{ route('getcharges-amount') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    charges: charge,
                },

                success: function(response) {
                    $.each(response, function(key, value) {
                        div_data += `For ${value.charge_type_name} : ${value.standard_charges} Rs , `
                    });
                    console.log(response);
                    $('#charge_details').html(div_data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
    }

</script>

{{-- <script>
    function totalAmount() {
        $("#total_amount").val(00);
        var taxAmount = $("#tax").val();
        var chargeAmount = $("#standard_charges").val();
        var totalAmount = parseInt(chargeAmount * taxAmount / 100) + parseInt(chargeAmount);
        $("#total_amount").val(totalAmount);
    }
</script> --}}


<script>
    $(document).ready(function() {
        $("#abcd").keyup(function(event) {
            event.preventDefault();
            let charge = $(this).val();
        });
    });
</script>
@endsection
