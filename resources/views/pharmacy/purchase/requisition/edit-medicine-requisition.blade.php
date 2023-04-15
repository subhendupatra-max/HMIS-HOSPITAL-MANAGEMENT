@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Requisition</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('update-medicine-requisition-details') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{ $editMedicineRequisition->id }}" />
                    <div class="col-md-3">
                        <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="date" name="date" required @if(isset($editMedicineRequisition->date)) value="{{ date('Y-m-d h:m:s',strtotime($editMedicineRequisition->date)) }}" @endif>
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-md-3">
                        <label class="form-label">Permission Authority <span class="text-danger">*</span></label>
                        <select name="permission_authority[]" required multiple="multiple" class="multi-select select2-show-search">
                            <option value="">Select One</option>
                            @if($user_list)
                            @foreach($user_list as $value)
                            <option value="{{$value->id}}">{{$value->first_name}} {{$value->last_name}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('permission_authority')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Permission Type <span class="text-danger">*</span></label>
                        <select name="permission_type" required class="select2-show-search">
                            <option value="">Select</option>
                            @foreach (Config::get('static.permission_type') as $lang => $permissiton_types)
                            <option value="{{$permissiton_types}}" {{ $permissiton_types == $editMedicineRequisition->permission_type ? 'selected' : " " }}> {{$permissiton_types}}</option>
                            @endforeach
                        </select>
                        @error('permission_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group col-md-12">
                        <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 30%">Medicine Catagory<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Medicine Neme<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Medicine Unit<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Qty<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 2%">
                                        <button type="button" class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($editMedicineRequisitionQty as $key => $value)
                                <tr id="rowid<?php echo $key ?>">
                                    <td>
                                        <select class="form-control select2-show-search " value="{{ old('medicine_catagory') }}" data-medicine_name="{{  $value->medicine_name }}" onchange="getCatagoryId(this.value,<?php echo $key ?>)" name="medicine_catagory[]" id="medicine_catagory${i}" required>
                                            <optgroup>
                                                <option value=" ">Select Medicine Catagory </option>
                                                @foreach ($medicine_catagory as $item)
                                                <option value="{{$item->id}}" {{ $item->id == $value->medicine_catagory ? 'selected' : " " }}>{{$item->medicine_catagory_name}}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </td>

                                    <td>
                                        <select name="medicine_name[]" class="form-control select2-show-search" id="medicine_name${i}" required onchange="getMedicineNameId(this.value,<?php echo $key ?>)">
                                            <option value="">Select Medicine Name...</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select name="medicine_unit[]" class="form-control select2-show-search" id="medicine_unit${i}" required value="{{$value->medicine_unit}}">
                                            <option value="">Select Medicine Unit...</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" class="form-control" id="qty${i}" name="qty[]" required value="{{$value->qty}}">
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="removerow('{{$key}}')"><i class="fa fa-trash"></i></button>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Save Requisition </button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>



<script>
    var p = 1;

    function addnewrow() {
        var table = document.getElementById("subhendu");
        var table_len = (table.rows.length);
        var i = parseInt(table_len);
        i = i + 1;
        var html = `   
                        <tr id="rowid${i}">
                        <td>
                        <select class="form-control select2-show-search " value="{{ old('medicine_catagory') }}" onchange="getCatagoryId(this.value,${i})" name="medicine_catagory[]" id="medicine_catagory${i}" required>
                            <optgroup>
                                <option value=" ">Select Medicine Catagory </option>
                                @foreach ($medicine_catagory as $item)
                                <option value="{{$item->id}}">{{$item->medicine_catagory_name}}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        </td>

                        <td>
                        <select name="medicine_name[]" class="form-control select2-show-search" id="medicine_name${i}" required onchange="getMedicineNameId(this.value,${i})">
                            <option value="">Select Medicine Name...</option>
                        </select>
                        </td>

                        <td>
                        <select name="medicine_unit[]" class="form-control select2-show-search" id="medicine_unit${i}" required>
                            <option value="">Select Medicine Unit...</option>
                        </select>
                        </td>

                        <td>
                        <input type="text" class="form-control" id="qty${i}" name="qty[]" required>
                        </td>
                                                     
                        <td>
                        <button type="button" class="btn btn-danger" onclick="removerow(${i})"><i class="fa fa-trash"></i></button>
                        </td>
                       
                        </tr>`;

        $('#subhendu').append(html);
        p = p + 1;

    }

    function removerow(i) {
        $('#rowid' + i).empty();
    }
</script>

<script>
    function getCatagoryId(catagory, rowid) {

        // alert(rowid);
        $('#medicine_name' + rowid).empty();
        var name = $(this).attr("data-medicine_name");
        // alert(name);
        $('#medicine_name' + rowid).html('<option value="" >Select...</option>');

        $.ajax({
            url: "{{ route('find-medicine-name-by-medicine-catagory-in-requisition') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                catagory_id: catagory,
            },
            success: function(response) {
                $.each(response, function(key, value) {
                    let sel = (value.id == name ? 'selected' : '');
                    $('#medicine_name' + rowid).append(`<option value="${value.id}" ${sel}>${value.medicine_name}</option>`);
                });
            },
            error: function(error) {
                console.log(error);
            }
        });

    }
</script>

<script>
    function getMedicineNameId(medicineName, lineid) {

        $('#medicine_unit' + lineid).empty();
        $('#medicine_unit' + lineid).html('<option value="" >Select...</option>');

        $.ajax({
            url: "{{ route('find-medicine-unit-by-medicine-name-in-requisition') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                medicineName_id: medicineName,
            },
            success: function(response) {

                // console.log(response);
                $.each(response, function(key, value) {

                    $('#medicine_unit' + lineid).append(`<option value="${value.id}">${value.medicine_unit_name}</option>`);

                });
            },
            error: function(error) {
                console.log(error);
            }
        });


    }
</script>
@endsection