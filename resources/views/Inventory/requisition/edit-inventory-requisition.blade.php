@extends('layouts.layout')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    function getbrandandall(rowno, item, unit_id) {

        // $('#unit' + rowno).empty();
        // var div_dataa = '<option value="">Select One</option>';
        var item = $('#item' + rowno).val();
        $('#unit' + rowno).html('<option value="">Select One</option>');
        var div_dataa = '';

        $.ajax({

            url: "{{ route('get-item-brand-all') }}",
            type: "post",
            data: {
                item_id: item,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(res) {
                div_dataa = "<option value=" + res.unit_id + ">" + res.units + " </option>";
                $('#unit' + rowno).html(div_dataa);
            }
        });
    }
</script>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit Requisition</div>
            <!-- ================================ Add Item===================================== -->

            <!-- ================================ Add Item===================================== -->
            <!-- ================================ Alert Message===================================== -->
            @if (session('success'))
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ session('success') }}</div>
            @endif
            @if (session()->has('error'))
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{ session('error') }}</div>
            @endif
            <!-- ================================ Alert Message===================================== -->
        </div>

        <!-- ================================Save Requisition===================================== -->
        <form method="POST" action="{{ route('edit-requisition-inven') }}">
            @csrf
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Workshop <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" required name="workshop">
                                <option value="">Select Workshop</option>
                                @if ($workshop_list)
                                @foreach ($workshop_list as $value)
                                <option <?php if ($requisition_details->stock_room == $value->id) {
                                            echo 'selected';
                                        } ?> value="{{ $value->id }}">{{ $value->item_store_room }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                            @error('workshop')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="hidden" name="requisition_id" value="{{ $requisition_details->req_no }}">
                        <div class="col-md-3 mt-2">
                            <label class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" required value="<?= date('Y-m-d', strtotime($requisition_details->date)) ?>" name="requisition_date" class="form-control">
                            @error('requisition_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Requested By <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" required name="requested_by">
                                <option value="">Select One </option>
                                @if ($user_list)
                                @foreach ($user_list as $value)
                                <option value="{{ $value->id }}" <?php if ($requisition_details->requested_by == $value->id) {
                                                                        echo 'selected';
                                                                    } ?>>{{ $value->first_name }} {{ $value->last_name }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Checked By <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" required name="checked_by">
                                <option value="">Select One </option>
                                @if ($user_list)
                                @foreach ($user_list as $value)
                                <option value="{{ $value->id }}" <?php if ($requisition_details->checked_by == $value->id) {
                                                                        echo 'selected';
                                                                    } ?>>{{ $value->first_name }} {{ $value->last_name }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                            @error('checked_by')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- <div class="col-md-4">
                                <label class="form-label">Issued By <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search" required name="issued_by">
                                    <option value="">Select One </option>
                                    @if ($user_list)
                                        @foreach ($user_list as $value)
                                            <option value="{{ $value->id }}" <?php if ($requisition_details->issued_by == $value->id) {
                                                                                    echo 'selected';
                                                                                } ?>>{{ $value->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('issued_by')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->
                        <!-- <div class="col-md-4">
                                <label class="form-label">Need Permission ? <span class="text-danger">*</span></label>
                                <select name="need_permission" onchange="needPermission(this.value)" required class="multi-select select2-show-search">
                                    <option value="">Select One</option>
                                    <option value="yes" @if(!empty($permisison_users[0]->permission_type_user_all)) @if (isset($permisison_users[0]->status))  selected @endif @endif >Yes</option>
                                    <option value="no" @if(empty($permisison_users[0]->permission_type_user_all)) @if (!isset($permisison_users[0]->status))  selected @endif @endif >No</option>
                                </select>
                                @error('need_permission')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->
                        <!-- <div class="col-md-4 permission"  >
                                <label class="form-label">Permission Authority <span class="text-danger">*</span></label>
                                <select name="permission_authority[]"
                                 multiple="multiple"
                                    class="multi-select select2-show-search">
                                    <option value="">Select One</option>
                                    @if ($user_list)
                                        @foreach ($user_list as $value)
                                            <option value="{{ $value->id }}" <?php
                                                                                if (empty($permisison_users[0]->permission_type_user_all)) {
                                                                                    foreach ($permisison_users as $key => $res) {
                                                                                        if ($res->user_id == $value->id) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    }
                                                                                } ?>>{{ $value->first_name }} {{ $value->last_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('permission_authority')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->
                        <!-- <div class="col-md-4 permission" style="display:none">
                                <label class="form-label">Permission Type <span class="text-danger">*</span></label>
                                <select name="permission_type"  class="select2-show-search">
                                    <option value="">Select One</option>
                                    <option value="Parallal"
                                    <?php if (!empty($permisison_users[0]->permission_type_user_all)) {
                                        if ($permisison_users[0]->permission_type_user_all == 'Parallal') {
                                            echo 'selected';
                                        }
                                    } ?>
                                    >Parallal</option>
                                    <option value="Sequential" <?php if (!empty($permisison_users[0]->permission_type_user_all)) {
                                                                    if ($permisison_users[0]->permission_type_user_all == 'Sequential') {
                                                                        echo 'selected';
                                                                    }
                                                                } ?>>Sequential</option>
                                </select>
                                @error('permission_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->


                    </div>
                    <!-- <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">For Emergency Challan ? <span
                                        class="text-danger">*</span></label>
                                <select required name="need_permission_for_emg" onchange="needPermissionforemg(this.value)"
                                    required class="multi-select select2-show-search">
                                    <option value="" >Select One</option>
                                    <option value="yes" {{$requisition_details->emg_status != null ? 'selected' : ''}} >Yes</option>
                                    <option value="no" >No</option>
                                </select>
                                @error('need_permission_for_emg')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 emg_challn_no" style="display:none">
                                <label class="form-label"> Emergency Challan No. <span
                                        class="text-danger">*</span></label>
                                <select name="emergency_no[]" multiple
                                    class="multi-select select2-show-search">
                                    <option value="">Select One</option>
                                    @if (isset($emergency_challan))
                                        @foreach ($emergency_challan as $value)
                                            <option value="{{ $value->id }}"
                                                @if (!empty($all_emergency_challan[0]->id))
                                                @foreach ($all_emergency_challan as $e_value)
                                                     {{@$e_value->id == $value->id ? 'selected' : ''}}
                                                @endforeach
                                                @endif
                                                 >
                                                {{ $value->emg_prefix }}{{ $value->id }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('emergency_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 emg_challn_no" style="display:none">
                              <button class="btn btn-primary btn-sm tbtndesign" type="button" onclick="getall_emg_challan_details()"><i class="fa fa-check"></i></button>
                            </div>
                        </div> -->
                </div>
                <!-- <hr style="margin: 15px !important">
                    <span class="text-danger">** Hold cursor point on this field and scan item barcode or enter Part No
                        **</span>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Search using Item code or bar code</label>
                            <input type="text" id="item_code" onblur="addnew()" placeholder="Enter Item code"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Search using Item Part No</label>
                            <input type="text" id="item_part_no" onblur="addnew_using_partno()"
                                placeholder="Enter Item Part No." class="form-control">
                        </div>
                    </div> -->
                <hr>
                <div class="">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 15%">Item Type <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 60%">Item <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 10%">Quantity <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 13%">UOM <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 2%">
                                        <button class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="subhendu">
                                <?php
                                $i = 1;
                                foreach ($requisition_item as $key => $item_value) {
                                ?>
                                    <tr id="rowid<?php echo $i; ?>">
                                        <td>
                                            <select required disabled class="form-control select2-show-search" name="item_type[]" id="item_type<?php echo $i; ?>">
                                                <option value="{{ $item_value->item_type_id }}" selected>
                                                    {{ $item_value->item_type_name }}
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="hidden" name="item[]" value="{{ $item_value->item_id_no }}">
                                            <select disabled onchange="getbrandandall(<?php echo $i; ?>,<?php echo $item_value->item_id_no; ?>,<?php echo $item_value->item_unit_id; ?>)" required class="form-control select2-show-search" id="item<?php echo $i; ?>">
                                                <option value="{{ $item_value->item_id_no }}" selected>
                                                    {{ $item_value->item_name }}(Brand :{{ $item_value->item_brand_name }}
                                                    )(Manufacturer
                                                    :{{ $item_value->manufacture_name }})({{ $item_value->item_description }})
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" required name="qty[]" value="{{ $item_value->quantity }}" class="form-control">
                                        </td>
                                        <td>
                                            <select name="unit[]" required id="unit<?php echo $i; ?>" class="form-control select2-show-search">
                                                <option value="{{ $item_value->item_unit_id }}" selected>
                                                    {{ $item_value->units }}
                                                </option>

                                            </select>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" onclick="remove(<?php echo $i; ?>)"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <hr>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Note</label>
                                    <textarea name="note" class="form-control">{!! $requisition_details->notes !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class=" text-right">
                            <button class="btn btn-primary mb-2" type="submit"><i class="fa fa-paper-plane"></i>
                                Submit</button>
                        </div>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </form>
        <!-- ============================== Save Requisition ===================================== -->
    </div>
</div>


<!-- ===========================Add New Item Using item Code=========================== -->
<script type="text/javascript">
    var table = document.getElementById("subhendu");
    var table_len = (table.rows.length);
    var i = parseInt(table_len);


    function needPermission(ier) {

        if (ier == 'yes') {
            $('.permission').removeAttr('style', true);
        } else {
            $('.permission').attr('style', 'display:none', true);
        }

    }

    function addnew() {
        var table = document.getElementById("subhendu");
        var table_len = (table.rows.length);
        var i = parseInt(table_len);
        var div_da = '';
        var div_manu = '';
        var div_unit = '';
        const itemcode = $("#item_code").val();
        if (itemcode != null) {
            $.ajax({

                url: "{{ route('get-item-details') }}",
                type: "post",
                data: {
                    item_code: itemcode,
                    _token: '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(res) {


                    if (res.item_details.item_type_id != null && res.item_details.item_id != null) {

                        var html = '<tr id="rowid' + i +
                            '"><td><select class="form-control" name="item_type[]" required readonly ><option value="' +
                            res.item_details.item_type_id + '">' + res.item_details.item_type +
                            ' </option></select></td><td><select name="item[]" required class="form-control" readonly><option value="' +
                            res.item_details.item_id + '">' + res.item_details.item_name + '(Brand : ' + res
                            .item_details.item_brand_name + ')(Manufacturer : ' + res.item_details
                            .manufacture_name + ')(' + res.item_details.item_description +
                            ')</option></select></td><td><input type="text" required name="qty[]" class="form-control" style="width: 60%; float: left;"><select name="unit[]" id="unit' +
                            i +
                            '" required class="form-control" style="width: 40%; float: left;"></select></td><td><button class="btn btn-danger" onclick="remove(' +
                            i + ')"><i class="fa fa-trash"></i></button></td></tr>';


                        $.each(res.item_unit, function(i, objjj) {

                            div_unit += "<option value='" + objjj.unit_id + "'>" + objjj.units +
                                "</option>";

                        });


                        $('#subhendu').append(html);
                        $('#unit' + i).append(div_unit);
                        i = i + 1;
                    } else {
                        alert('Enter a valid Item Code');
                    }

                }
            });


        }
    }
</script>
<!-- ===========================Add New Item Using item Code=========================== -->

<!-- ===========================Add New Item Using New Row=========================== -->
<script type="text/javascript">
    function addnewrow() {

        i = i + 1;
        var html = '<tr id="rowid' + i + '"><td><select required onchange="getitem(' + i +
            ')" class="form-control select2-show-search" name="item_type[]" id="item_type' + i +
            '"><option value="">Select Item type</option> @if (isset($item_type_list)) @foreach ($item_type_list as $key => $value)   <option value="{{ $value->id }}">{{ $value->item_type_name }}</option>  @endforeach  @endif </select></td><td><select onchange="getbrandandall(' +
            i + ',this.value)" name="item[]" required class="form-control select2-show-search" id="item' + i +
            '"><option value="">Select item</option></select></td><td><input type="text" required name="qty[]" class="form-control"></td><td><select name="unit[]" required  id="unit' +
            i +
            '" class="form-control select2-show-search"> <option value="">Select Unit</option></select></td><td><button class="btn btn-danger" onclick="remove(' +
            i + ')"><i class="fa fa-trash"></i></button></td></tr>';

        $('#subhendu').append(html);

    }
</script>
<!-- ===========================Add New Item Using New Row=========================== -->

<script type="text/javascript">
    function remove(i) {
        $('#rowid' + i).remove();
    }
</script>

<script type="text/javascript">
    function getitem(rowno) {

        var item_type = $('#item_type' + rowno).val();
        $('#item' + rowno).empty();
        var div_data = '<option value="">Select One</option>';
        var unit = '';
        $.ajax({

            url: "{{ route('get-item-inventoty') }}",
            type: "post",
            data: {
                item_type_id: item_type,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(res) {
                console.log(res);
                $.each(res, function(i, obj) {

                    div_data += "<option value=" + obj.item_id + ">" + obj.item_name + "(Brand:" +
                        obj.brand_name + ")(Manufacturer:" + obj.manufacturar_name + ")" + "(" + obj
                        .item_description + ") </option>";
                });

                $('#item' + rowno).append(div_data);

            }
        });
    }
</script>
<script>
    function addnew_using_partno() {
        var div_da = '';
        var div_manu = '';
        var div_unit = '';
        const itemcode = $("#item_part_no").val();
        if (itemcode != null) {
            $.ajax({

                url: "{{ route('get-item-details-using-part-no-inventory') }}",
                type: "post",
                data: {
                    item_code: itemcode,
                    _token: '{{ csrf_token() }}',
                },
                dataType: 'json',
                success: function(res) {


                    if (res.item_details.item_type_id != null && res.item_details.item_id != '') {

                        var html = '<tr id="rowid' + i +
                            '"><td><select class="form-control select2-show-search" name="item_type[]" required readonly ><option value="' +
                            res.item_details.item_type_id + '">' + res.item_details.item_type +
                            ' </option></select></td><td><select name="item[]" required class="form-control select2-show-search" readonly><option value="' +
                            res.item_details.item_id + '">' + res.item_details.item_name + '(Brand : ' + res
                            .item_details.item_brand_name + ')(Manufacturer : ' + res.item_details
                            .manufacture_name + ')(' + res.item_details.item_description +
                            ')</option></select></td><td><input type="text" required name="qty[]" class="form-control" style="width: 60%; float: left;"><select name="unit[]" id="unit' +
                            i +
                            '" required class="form-control" style="width: 40%; float: left;"></select></td><td><button class="btn btn-danger" onclick="remove(' +
                            i + ')"><i class="fa fa-trash"></i></button></td></tr>';


                        $.each(res.item_unit, function(i, objjj) {

                            div_unit += "<option value='" + objjj.unit_id + "'>" + objjj.units +
                                "</option>";


                        });


                        $('#subhendu').append(html);
                        $('#unit' + i).append(div_unit);
                        i = i + 1;
                    } else {
                        alert('Enter a valid Item Code');
                    }

                }
            });


        }
    }
</script>

@endsection