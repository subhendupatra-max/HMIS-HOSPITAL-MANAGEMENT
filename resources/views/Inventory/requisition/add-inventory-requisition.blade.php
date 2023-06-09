@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Create Requisition</div>
            <!-- ================================ Add Item===================================== -->
            <!-- <div class="create_req">
                <a href="{{route('inventory-item-list')}}" class="btn btn-primary" data-placement="left" data-toggle="tooltip" title="Add New Item"><i class="fa fa-plus"></i></a>
            </div> -->
            <!-- ================================ Add Item===================================== -->
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
        <form method="POST" action="{{route('save-inventory-requisition-details')}}">
            @csrf
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3 newaddappon mt-2">
                            <label class="form-label">Workshop <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search"  name="stockroom">
                                <option value="">Select Workshop</option>
                                @if($stockroom)
                                @foreach($stockroom as $value)
                                <option value="{{$value->id}}">{{$value->item_store_room}}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('stockroom')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 mt-3">
                            <!-- <label class="form-label">Date <span class="text-danger">*</span></label> -->
                            <!-- <h6 class="inventorydate">Date <span class="text-danger">*</span></h6> -->
                            <label class="form-label ">Date <span class="text-danger">*</span></label>
                            <input type="date" required name="date" value="{{date('Y-m-d')}}" class="form-control">
                            @error('date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Requested By <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" required name="requested_by">
                                <option value="">Select One </option>
                                @if($user_list)
                                @foreach(@$user_list as $value)
                                <option value="{{$value->id}}">{{@$value->first_name}}
                                    {{@$value->last_name}}
                                </option>
                                @endforeach
                                @endif
                            </select>
                            @error('requested_by')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Checked By <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" required name="checked_by">
                                <option value="">Select One </option>
                                @if($user_list)
                                @foreach($user_list as $value)
                                <option value="{{$value->id}}">{{$value->first_name}}{{$value->last_name}}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('checked_by')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- <div class="col-md-4">
                            <label class="form-label">Need Permission ? <span class="text-danger">*</span></label>
                            <select name="need_permission" onchange="needPermission(this.value)"  class="multi-select select2-show-search">
                                <option value="">Select One</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            @error('need_permission')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 permission" style="display:none">
                            <label class="form-label">Permission Authority <span class="text-danger">*</span></label>
                            <select name="permission_authority[]"  multiple="multiple" class="multi-select select2-show-search">
                                <option value="">Select One</option>
                                @if($user_list)
                                @foreach($user_list as $value)
                                <option value="{{$value->id}}">{{$value->first_name}}{{$value->last_name}}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('permission_authority')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 permission" style="display:none">
                            <label class="form-label">Permission Type <span class="text-danger">*</span></label>
                            <select name="permission_type"  class="select2-show-search">
                                <option value="" disabled>Select One</option>
                                <option value="Parallal" selected>Parallal</option>
                                <option value="Sequential" disabled>Sequential</option>
                            </select>
                            @error('permission_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> -->


                    </div>
                </div>
                <!-- <hr style="margin: 15px !important">
                <span class="text-danger">** Hold cursor point on this field and scan item barcode or enter item code **</span>
                <div class="col-md-6 newaddappon"> -->
                    <!-- <label class="form-label">Search using Item code or bar code</label>
                    <input type="text" id="item_code" onblur="addnew()" placeholder="Enter Item code" class="form-control"> -->
                    <!-- <input type="text"  id="item_code" onblur="addnew()"  name="alternate_addresss"  />
                        <label for="item_code"> Search using Item code or bar code</div> -->

                <div class="">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 15%">Item Type <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 53%">Item <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 15%">Quantity <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 15%">Unit <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 2%">
                                        <button class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- dynamic row -->
                            </tbody>
                        </table>
                        <hr>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Note</label>
                                    <textarea name="note" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class=" text-right">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
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
    // function needPermission(i) {
    //     $('.permission').attr('style', 'display:none', true);
    //     if (i == 'yes') {
    //         $('.permission').removeAttr('style', true);
    //     } else {
    //         $('.permission').attr('style', 'display:none', true);
    //     }

    // }
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
<script type="text/javascript">
    function addnewrow()

    {
        var html = '<tr id="rowid' + i + '"><td><select required  onchange="getitem(' + i + ')" class="form-control select2-show-search" name="item_type[]" id="item_type' + i + '"><option value="">Select Item type</option> @if(isset($item_type_list)) @foreach ($item_type_list as $key => $value)<option value="{{$value->id}}">{{$value->item_type_name}}</option> @endforeach @endif</select></td><td><select onchange="getbrandandall(' + i + ')" name="item[]" required class="form-control select2-show-search" id="item' + i + '"><option value="">Select item</option></select></td><td><input type="text" required name="qty[]" class="form-control" ></td><td><select name="unit[]" required id="unit' + i + '" class="form-control select2-show-search"><option value="">Select Unit</option></select></td><td><button class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-trash"></i></button></td></tr>';

        $('#subhendu').append(html);
        i = i + 1;
    }
</script>
<!-- ===========================Add New Item Using New Row=========================== -->

<script type="text/javascript">
    function remove(i) {
        $('#rowid' + i).remove();
    }
</script>


<script type="text/javascript">
    function getbrandandall(rowno) {
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
                console.log(res);
                $.each(res, function(i, obj) {
                    div_data += "<option value=" + obj.item_id + ">" + obj.item_name+"(Brand:"+obj.item_brand_name+")(Manufacturer:"+obj.manufacture_name+")" + "(" + obj.item_description + ") </option>";
                });

                $('#item' + rowno).append(div_data);

            }
        });
    }
</script>
@endsection