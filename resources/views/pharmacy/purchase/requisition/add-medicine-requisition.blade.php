@extends('layouts.layout')
@section('content')

<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add Requisition</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('save-medicine-requisition-details') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-3">
                        <label class="form-label">Checked By <span class="text-danger">*</span></label>
                        <select name="checked_by" class="form-control select2-show-search">
                            <option value="">Select One</option>
                            @if($user_list)
                            @foreach($user_list as $value)
                            <option value="{{$value->id}}">{{$value->first_name}} {{$value->last_name}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('checked_by')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Requested By <span class="text-danger">*</span></label>
                        <select name="requested_by" class="form-control select2-show-search ">
                            <option value="">Select One</option>
                            @if($user_list)
                            @foreach($user_list as $value)
                            <option value="{{$value->id}}">{{$value->first_name}} {{$value->last_name}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('requested_by')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <label for="store_room" class="form-label">Store Room <span class="text-danger">*</span></label>
                        <select name="store_room" class="select2-show-search">
                            <option value="">Select One</option>
                            @if($store_room_list)
                            @foreach($store_room_list as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="date" name="date" required>
                        @error('date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="need_permission" class="form-label">Need permission <span class="text-danger">*</span></label>
                        <select id="need_permission" class="form-control" name="need_permission" onclick="fdsfds(this.value)">
                            <option value=" ">Select Permission</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        @error('need_permission')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-7" style="display:none;" id="pop">

                        <div class="form-group col-md-5 d-inline-block">
                            <label class="form-label">Permission Authority <span class="text-danger">*</span></label>
                            <select name="permission_authority[]" multiple="multiple" class="multi-select select2-show-search">
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

                        <div class="form-group col-md-5 d-inline-block">
                            <label class="form-label">Permission Type <span class="text-danger">*</span></label>
                            <select name="permission_type" class="select2-show-search">
                                <option value="">Select</option>
                                @foreach (Config::get('static.permission_type') as $lang => $permissiton_types)
                                <option value="{{$permissiton_types}}"> {{$permissiton_types}}</option>
                                @endforeach
                            </select>
                            @error('permission_type')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="text-center py-4 m-r m-auto mt-3">
                        <a class="btn btn-primary" data-target="#modaldemo1" data-toggle="modal" href="#"> Medicine</a>
                    </div>


                    <div class="form-group col-md-12">
                        <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 30%">Medicine Catagory<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Medicine Name<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Medicine Unit<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 30%">Qty<span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 2%">
                                        <button type="button" class="btn btn-success" onclick="addnewrow()"><i class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="trLength">
                                @if(isset($medicinedata ) && !empty($medicinedata))
                                <?php $i = 0; ?>
                                @foreach($medicinedata as $item)

                                <tr id="rowid{{$loop->iteration}}">
                                    <td>

                                        <input type="hidden" class="form-control" name="medicine_catagory[]" value="{{$item->catagory_id}}" />

                                        <input type="text" readonly class="form-control" value="{{$item->medicine_catagory_name}}" />
                                    </td>
                                    <td>
                                        <input type="hidden" class="form-control" name="medicine_name[]"value="{{$item->medicine_id}}" />
                                        
                                        <input type="text" readonly class="form-control"  value="{{$item->medicine_name}}" />
                                    </td>
                                    <td>
                                    <input type="hidden"  class="form-control" name="medicine_unit[]" value="{{$item->unit_id}}" />

                                        <input type="text" readonly class="form-control"  value="{{$item->medicine_unit_name}}" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="qty[]" />
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger" onclick="removerow({{$loop->iteration}})"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php $i = $i + 1; ?>
                                @endforeach
                                @endif
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

<!-- medicne add model -->

<div id="modaldemo1" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header pd-x-20">
                <h6 class="modal-title">All Medicine</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <h5 class=" lh-3"><a href="#" class="font-weight-bold">Add Medicine</a></h5>

                <form id="myForm" action="{{ route('add-medicine-catagory-and-medicine-name') }}" method="POST">
                    @csrf

                    <div class="table-responsive">
                        <table id="example1" class="table table-borderless text-nowrap key-buttons">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 30%">#</th>
                                    <th scope="col" style="width: 30%">Medicine Catagory</th>
                                    <th scope="col" style="width: 30%">Medicine Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($medicine as $value)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="seleteMedicine[]" id="seleteMedicine" value="{{$value->id}}" />
                                    </td>
                                    <td>
                                        {{ $value->catagory_name->medicine_catagory_name }}
                                    </td>
                                    <td>
                                        {{ $value->medicine_name}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" onclick="fetchAllMedicine()">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div><!-- modal-body -->

        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- medicne add model -->

<script>
    var i = $('#trLength tr').length;
    i = i + 1;

    function addnewrow() {
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

        $('#trLength').append(html);
        i = i + 1;

    }

    function removerow(i) {
        $('#rowid' + i).empty();
    }
</script>
</script>

<script>
    function getCatagoryId(catagory, rowid) {

        // alert(rowid);
        $('#medicine_name' + rowid).empty();
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
                    $('#medicine_name' + rowid).append(`<option value="${value.id}">${value.medicine_name}</option>`);
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

<script>
    function fdsfds(value) {

        if (value == 'yes') {
            $('#pop').removeAttr('style', true);
        } else {
            $('#pop').attr('style', 'display:none');
        }
    }
</script>

@endsection