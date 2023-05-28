@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Requisition</h4>
        </div>
        <div class="card-body">
            <script>
                function getMedicineNameId(medicineName, lineid,unit_id = '') {
           // alert(medicineName);
                   // $('#medicine_unit' + lineid).empty();
                    $('#medicine_unit' + lineid).html('<option value="" >Select...</option>');
                    var div_data = '';
                    var sel = '';
            
                    $.ajax({
                        url: "{{ route('find-medicine-unit-by-medicine-name-in-requisition') }}",
                        type: "POST",
                        data: {
                            _token: '{{ csrf_token() }}',
                            medicineName_id: medicineName,
                        },
                        success: function(response) {
                            console.log(lineid);
                               if(unit_id == response.id){
                                 sel = 'selected';
                               }
                                div_data += `<option value="${response.id}" ${sel}>${response.medicine_unit_name}</option>`;
                                // console.log(div_data);
                                // console.log(lineid);
                                $('#medicine_unit' + lineid).append(div_data);
                                
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
            
            
                }
            </script>
            <form action="{{ route('update-medicine-requisition-details') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{ $medicine_requisition_main->id }}" />
                    <div class="col-md-3">
                        <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control newuserrchange" id="date" name="date" required @if(isset($medicine_requisition_main->date)) value="{{ date('Y-m-d h:m:s',strtotime($medicine_requisition_main->date)) }}" @endif >
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3 newuserrchange">
                        <label class="form-label">Checked By <span class="text-danger">*</span></label>
                        <select name="checked_by" class="form-control select2-show-search">
                            <option value="">Select One</option>
                            @if ($user_list)
                                @foreach ($user_list as $value)
                                    <option value="{{ $value->id }}" {{ $value->id == $medicine_requisition_main->checked_by ? 'selected':'' }} >{{ $value->first_name }} {{ $value->last_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('checked_by')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 newuserrchange">
                        <label class="form-label">Requested By <span class="text-danger">*</span></label>
                        <select name="requested_by" class="form-control select2-show-search ">
                            <option value="">Select One</option>
                            @if ($user_list)
                                @foreach ($user_list as $value)
                                    <option value="{{ $value->id }}" {{ $value->id == $medicine_requisition_main->requested_by ? 'selected':'' }} >{{ $value->first_name }} {{ $value->last_name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        @error('requested_by')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
   
                    <div class="col-md-3 newuserrchange ">
                        <label for="store_room" class="form-label">Store Room <span class="text-danger">*</span></label>
                        <select name="store_room" class="form-control select2-show-search">
                            <option value="">Select One</option>
                            @if ($store_room_list)
                                @foreach ($store_room_list as $value)
                                    <option value="{{ $value->id }}" {{ $value->id == $medicine_requisition_main->store_room_id ? 'selected':'' }} >{{ $value->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                            <thead>
                                <tr>
                                    
                                    <th scope="col" style="width: 60%">Medicine Name<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Medicine Unit<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Qty<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 2%">
                                        <button type="button" class="btn btn-success btn-sm" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="trLength">
                                @foreach($medicine_requisition as $key => $value)
                                <script>
                                    getMedicineNameId({{ $value->medicine_name }},{{ $key }},{{$value->medicine_unit}});
                                </script>
                                <tr id="rowid<?php echo $key ?>">
                                    <td>
                                        <select name="medicine_name[]" class="form-control select2-show-search" id="medicine_name{{ $key }}" required onchange="getMedicineNameId(this.value,<?php echo $key ?>)">
                                            <option value="">Select Medicine Name...</option>
                                            @foreach ($medicine_name as $item)
                                            <option value="{{$item->id}}" {{ $item->id == $value->medicine_name ? 'selected' : " " }}>{{$item->medicine_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <select name="medicine_unit[]" class="form-control select2-show-search" id="medicine_unit{{ $key }}" required>
                                            <option value="">Select One....</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" class="form-control" id="qty{{ $key }}" name="qty[]" required value="{{$value->quantity}}">
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="removerow('{{$key}}')"><i class="fa fa-trash"></i></button>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="text-center m-auto">
                    <button type="submit" class="btn btn-primary">Update Requisition </button>
                </div>
        </div>
        </form>
    </div>

</div>

</div>



<script>
    var rowCount = $('#trLength tr').length;
    function addnewrow() {
        var i = rowCount;
        var html = `<tr id="rowid${i}">
                        <td>
                        <select name="medicine_name[]" class="form-control select2-show-search" id="medicine_name${i}" required onchange="getMedicineNameId(this.value,${i})">
                            <option value="">Select Medicine Name...</option>
                            @foreach ($medicine_name as $item)
                                <option value="{{ $item->id }}">{{ @$item->medicine_name }}({{ @$item->catagory_name->medicine_catagory_name }})</option>
                            @endforeach
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
                        <button type="button" class="btn btn-danger btn-sm" onclick="removerow(${i})"><i class="fa fa-trash"></i></button>
                        </td>

                        </tr>`;

            $('#trLength').append(html);
            i = i + 1;

    }

    function removerow(i) {
        $('#rowid' + i).empty();
    }
</script>


@endsection