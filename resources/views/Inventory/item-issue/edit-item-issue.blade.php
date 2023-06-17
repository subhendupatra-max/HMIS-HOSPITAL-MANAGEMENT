@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit New Item Issue</div>
            <!-- ================================ Alert Message===================================== -->
            @if (session('success'))
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('success')}}</div>
            @endif
            @if (session()->has('error'))
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('error')}}</div>
            @endif
            <!-- ================================ Alert Message===================================== -->
        </div>
        <!-- ================================Save Requisition===================================== -->
        <form method="POST" action="{{route('update-item-issue-inventory')}}">
            @csrf
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <input type="hidden" name="item_issue_id" value="{{$item_issue->id}}">
                        <div class="col-md-4">
                            <label class="requisition_header">Workshop <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" name="workshop_id" id="workshop_id">
                                <option value="">Select One</option>
                                @if(!empty($workshop_list))
                                @foreach($workshop_list as $valu)
                                <option value="{{$valu->id}}" {{$valu->id == $item_issue->stock_room_id ? 'selected' : " " }}>{{$valu->item_store_room}}
                                <option>
                                    @endforeach
                                    @endif

                            </select>
                        </div>

                        <div class="col-md-4 grncreateadd">
                            <label class="requisition_header1">Issue Date<span class="text-danger">*</span></label>
                            <input type="date" name="issue_date" class="form-control" @if(!empty($item_issue->issue_date)) value="{{ date('Y-m-d', strtotime($item_issue->issue_date)) }}" @endif>

                            @error('issue_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 grncreateadd">
                            <label class="requisition_header">Issue By <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" name="issue_by" id="issue_by">
                                <option value="">Select One</option>
                                @if(!empty($issue_by))
                                @foreach($issue_by as $valu)
                                <option value="{{$valu->id}}" {{$valu->id == $item_issue->issued_by ? 'selected' : " " }}>{{$valu->first_name}} {{$valu->last_name}}
                                <option>
                                    @endforeach
                                    @endif

                            </select>
                            @error('issue_by')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 grncreateadd">
                            <label class="requisition_header">Department <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" name="department" id="department" onchange="getDepartment(this.value,{{ $item_issue->issue_to }})">
                                <option value="">Select One</option>
                                @if(!empty($department))
                                @foreach($department as $valu)
                                <option value="{{$valu->id}}" {{$valu->id == $item_issue->department_id ? 'selected' : " " }}>{{$valu->department_name}}
                                <option>
                                    @endforeach
                                    @endif

                            </select>
                            @error('department')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-4 grnnewadd">
                            <label class="requisition_header">Issue To <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" name="issue_to" id="issue_to">
                                <option value="">Select One</option>

                            </select>
                            @error('issue_to')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
                <!-- <hr style="margin: 15px !important">
                <span class="text-danger">** Hold cursor point on this field and scan item barcode or enter item code **</span>
                <div class="col-md-6 newaddappon"> -->
                <!-- <label class="form-label">Search using Item code or bar code</label>
                    <input type="text" id="item_code" onblur="addnew()" placeholder="Enter Item code" class="form-control"> -->
                <!-- <input type="text" id="item_code" onblur="addnew()" name="alternate_addresss" />
                    <label for="item_code"> Search using Item code or bar code
                </div> -->

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
                                foreach ($item_issue_details as $key => $item_value) {
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
                                            <select onchange="getbrandandall(<?php echo $i; ?>,<?php echo $item_value->item_id_no; ?>,<?php echo $item_value->item_unit_id; ?>)" required class="form-control select2-show-search" id="item<?php echo $i; ?>">
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
                                    <textarea name="note" class="form-control">{!! $item_issue->note !!}</textarea>
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

<!-- ===========================Add New Item Using item Code or part no=========================== -->
<script type="text/javascript">
    var i = 1;

    function addnew() {
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


                    if (res.item_details.item_type_id != null && res.item_details.item_id != '') {

                        var html = '<tr id="rowid' + i + '"><td><select class="form-control select2-show-search" name="item_type[]" required readonly ><option value="' + res.item_details.item_type_id + '">' + res.item_details.item_type + ' </option></select></td><td><select name="item[]" required class="form-control select2-show-search" readonly><option value="' + res.item_details.item_id + '">' + res.item_details.item_name + '(Brand : ' + res.item_details.item_brand_name + ')(Manufacturer : ' + res.item_details.manufacture_name + ')(' + res.item_details.item_description + ')</option></select></td><td><input type="text" required name="qty[]" class="form-control" style="width: 60%; float: left;"><select name="unit[]" id="unit' + i + '" required class="form-control" style="width: 40%; float: left;"></select></td><td><button class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-trash"></i></button></td></tr>';


                        $.each(res.item_unit, function(i, objjj) {

                            div_unit += "<option value='" + objjj.unit_id + "'>" + objjj.units + "</option>";


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
<!-- ===========================Add New Item Using item Code or part no=========================== -->

<!-- ===========================Add New Item Using New Row=========================== -->

<!-- <script type="text/javascript">
    function addnewrow()

    {

        var html = '<tr id="rowid' + i + '"><td><select required  onchange="getitem(' + i + ')" class="form-control select2-show-search" name="item_type[]" id="item_type' + i + '"><option value="">Select Item type</option> @if(isset($item_type_list)) @foreach ($item_type_list as $key => $value)<option value="{{$value->id}}">{{$value->item_type_name}}</option> @endforeach @endif</select></td><td><select onchange="getbrandandall(' + i + ')"  name="item[]" required class="form-control select2-show-search" id="item' + i + '"><option value="">Select item</option></select></td><td ><input type="text" required name="qty[]" class="form-control" style="width: 60%; float: left;"><select name="unit[]" style="width: 40%; float: left;" required id="unit' + i + '" class="form-control select2-show-search"><option value="">Select Unit</option></select></td><td><button class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-trash"></i></button></td></tr> <tr> <td class="avi_td"><span class="avqty_area" id="available_qty' +
            i +
            '"></span><input type="hidden" name="available_qty" id="available_qtyyy' +
            i + '"></td></tr>';

        $('#subhendu').append(html);
        i = i + 1;
    }
</script> -->

<script type="text/javascript">
    function addnewrow() {

        i = i + 1;
        var html = '<tr id="rowid' + i + '"><td><select required onchange="getitem(' + i +
            ')" class="form-control select2-show-search" name="item_type[]" id="item_type' + i +
            '"><option value="">Select Item type</option> @if (isset($item_type_list)) @foreach ($item_type_list as $key => $value)   <option value="{{ $value->id }}">{{ $value->item_type_name }}</option>  @endforeach  @endif </select></td><td><select onchange="getbrandandall(' +
            i + ',this.value)" name="item[]" required class="form-control select2-show-search" id="item' + i +
            '"><option value="">Select item</option></select></td><td><input type="text" required name="qty[]" onkeyup="writeReqQty(this.value,' + i + ')" class="form-control"><span id="available_qty' + i + '" class="avlqty_text">Avilable Qty : </span><input type="hidden" name="available_qty" id="available_qtyyy' + i + '"></td><td><select name="unit[]" required  id="unit' +
            i +
            '" class="form-control select2-show-search"> <option value="">Select Unit</option></select></td><td><button class="btn btn-danger" onclick="remove(' +
            i + ')"><i class="fa fa-trash"></i></button></td></tr>';

        $('#subhendu').append(html);

    }
</script>
<!-- ===========================Add New Item Using New Row=========================== -->

<script type="text/javascript">
    function writeReqQty(requer_qty, rowno) {

        var avilb_qty = $('#available_qtyyy' + rowno).val();
        if (parseFloat(requer_qty) > parseFloat(avilb_qty)) {
            alert("You don't have enough stock for your requirement");
            $('#qty' + rowno).val('');
        }
    }
</script>

<script type="text/javascript">
    function remove(i) {
        $('#rowid' + i).remove();
    }
</script>


<script type="text/javascript">
    function getbrandandall(rowno = null, item_id_no = null, unit_id = null) {
        //  alert(unit_id);
        // $('#unit' + rowno).empty();
        // var item = $('#item' + rowno).val();

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


        var item = $('#item' + rowno).val();
        var unit = $('#unit' + rowno).val();

        var qty = $('#qty' + rowno).val();

        $.ajax({
            url: "{{ route('get-item-avi-qty') }}",
            type: "post",
            data: {
                item_id: item,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(res) {
                console.log(res)
                $('#available_qty' + rowno).text('Available qty : ' + res);
                $('#available_qtyyy' + rowno).val(res);
            }

        });
    }

    // function getAviQty(rowno) {


    // }
</script>

<script type="text/javascript">
    function getitem(rowno) {

        $('#item' + rowno).empty();
        var item_type = $('#item_type' + rowno).val();
        console.log(item_type);
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
                // console.log(res);
                $.each(res, function(i, obj) {
                    div_data += "<option value=" + obj.item_id + ">" + obj.item_name + "(Brand:" + obj.item_brand_name + ")(Manufacturer:" + obj.manufacture_name + ")" + "(" + obj.item_description + ") </option>";
                });

                $('#item' + rowno).append(div_data);

            }
        });
    }
</script>

<script>
    function getDepartment(department_id, issue_to_id) {

        $("#issue_to").html("<option value=''>Select... </option>");
        $.ajax({
            url: "{{ route('find-issue-to-by-department') }}",
            type: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                get_departement_id: department_id,
            },

            success: function(response) {
                $.each(response, function(key, value) {
                    let sel = (value.id == issue_to_id ? 'selected' : '');
                    $('#issue_to').append(`<option value="${value.id}" ${sel}>${value.first_name} ${value.last_name}</option>`);
                });

            },
            error: function(error) {
                console.log(error);
            }
        });

    }
</script>
@endsection