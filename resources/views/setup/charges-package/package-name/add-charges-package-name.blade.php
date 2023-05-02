@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Package Name</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('save-charges-package-name-details') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-3 chargespackageadd">
                        <div class="form-group">
                            <label for="type">Type <span class="text-danger">*</span></label>
                            <select id="type" class="form-control" name="type">
                                <option value=" ">Select type </option>
                                @foreach (Config::get('static.charges_type') as $lang => $charges_type)
                                    <option value="{{ $charges_type }}" > {{ $charges_type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-3 chargespackageadd ">
                        <label for="charge_package_catagory_id" >Charges Package Catagory <span class="text-danger">*</span></label>
                        <select id="charge_package_catagory_id" class="form-control" name="charge_package_catagory_id" onchange="getChargersPackageCatagoryId(this.value)">
                            <option value=" ">Select Charges Package Catagory </option>
                            @foreach ($catagory as $item)
                            <option value="{{$item->id}}">{{$item->charges_package_catagories_name}}</option>
                            @endforeach
                        </select>
                        @error('charge_package_catagory_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3 chargespackageadd">
                        <label for="charge_package_sub_catagory_id">Charges Package Sub Catagory <span class="text-danger">*</span></label>
                        <select id="charge_package_sub_catagory_id" class="form-control" name="charge_package_sub_catagory_id">
                            <option value=" ">Select Charges Package Sub Catagory... </option>
                        </select>
                        @error('charge_package_sub_catagory_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3 packageedit">
                        <label for="package_name">Enter Charges Package Name<span class="text-danger">*</span></label>
                        <input type="text" id="package_name" name="package_name"value="{{ old('package_name')}}" required>
                        @error('package_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-12 newtabledesign">
                        <table class="table card-table table-vcenter text-nowrap " id="subhendu">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 40%">Charge Name<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Charge Amount<span class="text-danger">*</span></th>
                                    </th>
                                    <th scope="col" style="width: 2%">
                                        <button type="button" class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group col-md-3 chargespackagead">
                        <label for="tax">Enter Tax<span class="text-danger">*</span></label>
                        <input type="text" id="tax" value="{{ 0 }}" name="tax">
                        <small class="text-danger">{{ $errors->first('tax') }}</small>
                    </div>

                    <div class="form-group col-md-3 chargespackagead">
                        <label for="total_amount">Total Amount<span class="text-danger">*</span></label>
                        <input type="text" id="total_amount" name="total_amount" >
                        <small class="text-danger">{{ $errors->first('total_amount') }}</small>
                    </div>
                </div>

                <div class="text-center m-auto">
                    <button type="button" class="btn btn-success" onclick="gettotal()">Calculate</button>
                    <button type="submit" class="btn btn-primary">Save Package</button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    function gettotal() {
        var t = 0;
        $("input[name='charge_amount[]']").map(function() {
            t = t + parseFloat($(this).val());
        }).get();
        // alert(t);
        var taxAmount = $("#tax").val();

        var tchargeAmount = parseFloat(t);
        var totalAmount = parseInt(tchargeAmount * taxAmount / 100) + parseInt(tchargeAmount);

        $('#total_amount').val(totalAmount);
    }
</script>

<script>
    var i = 1;

    function addnewrow() {
        var html = `
                        <tr id="rowid${i}">
                        <td><select id="charge_name${i}" onchange="getParameter(${i})" class="form-control select2-show-search"
                        name="charge_name[]">
                        <option value="">Select </option>
                        @foreach ($chargeName as $item)
                        <option value="{{ $item->id }}">{{ $item->charges_name }}</option>
                        @endforeach
                        </select>
                        </td>
                        <td>
                        <input type="text" class="form-control" name="charge_amount[]" id="charge_amount${i}" />

                        </td>

                        <td>
                        <button type="button" class="btn btn-danger" onclick="removerow(${i})"><i class="fa fa-trash"></i></button>
                        </td>

                        </tr>`;

        $('#subhendu').append(html);
        i = i + 1;

    }

    function removerow(i) {
        $('#rowid' + i).empty();
    }
</script>

<script>
    function getParameter(i) {
        var charges = $('#charge_name' + i).val();
        $.ajax({
            url: "{{ route('find-charge-amount-by-charge-name') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                charges_id: charges,
            },

            success: function(response) {
                $('#charge_amount' + i).val(response.standard_charges);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

<script>
    function getChargersPackageCatagoryId(chargeCatagoryId) {
        $('#charge_package_sub_catagory_id').html('<option value="" >Select Charges Package Sub Catagory...</option>');
        $.ajax({
            url: "{{ route('find-charges-package-sub-catagory-by-charges-package-catagory') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                catagory_id: chargeCatagoryId,
            },
            success: function(response) {
                $.each(response, function(key, values) {
                    $('#charge_package_sub_catagory_id').append(`<option value="${values.id}">${values.charges_package_sub_catagory_name}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>

@endsection
