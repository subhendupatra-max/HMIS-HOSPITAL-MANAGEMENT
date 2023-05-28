@extends('layouts.layout')
@section('content')
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit Purchase Order</div>

            </div>

            <form method="POST" action="{{ route('save-medicine-purchase-order') }}">
                @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 ">
                                <label class="form-label">Store Room <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search" onchange="findrequisition()" id="storeroom"
                                    name="store_room_id">
                                    <option value="">Select Store Room</option>
                                    @if ($storeroomList)
                                        @foreach ($storeroomList as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('store_room_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 purchaseadd">
                             <label class="form-label">Date <span class="text-danger">*</span></label>  

                                <input type="datetime-local" name="po_date"  class="form-control">
                                @error('po_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6  addpurchase" addpurchase id="gofgk" >
                                <label class="form-label">Vendor <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search" id="ven" name="vendor"
                                    onchange="findrequisition()">
                                    <option value="">Select Vendor</option>
                                    @if ($vendor_list)
                                        @foreach ($vendor_list as $value)
                                            <option value="{{ $value->id }}">{{ $value->vendor_name }}(
                                                {{ $value->vendor_gst }} )</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('vendor')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6" style="margin: 18px 0px 0px 0px;">
                                <label class="form-label">Requisition <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search"
                                    onchange="findrequisitiondetails(this.value)" name="requisition_no" id="requisitiohbf">
                                    <option value="">Select One.....</option>
                                </select>
                            </div>

                        </div>

                    </div>
                    <hr>
                    <div class="">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 40%">Medicine <span class="text-danger">*</span>
                                        </th>
                                        <th scope="col" style="width: 25%">Unit <span class="text-danger">*</span>
                                        </th>
                                        <th scope="col" style="width: 25%">Quantity <span class="text-danger">*</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="alltextre">
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

                    {{-- <div class="container mt-5">
                        <div class="d-flex justify-content-end">
                            <span class="biltext">Total</span>
                            <input type="text" name="total" readonly id="total_am" class="form-control myfld">
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="text" name="extra_charges_name" placeholder="Enter Extra Charges Name"
                                class="form-control myfld2">
                            <input type="text" name="extra_charges_value" value="00" class="form-control myfld1"
                                id="extra_chages">
                        </div>
                        <div class="d-flex justify-content-end thrdarea">
                            <span class="biltext">Grand Total</span>
                            <input type="text" name="grand_total" readonly id="grnd_total" value="00"
                                class="form-control myfld">
                        </div>
                    </div> --}}
                    <div class="col-md-12" style="margin: 55px 0px 0px 0px;">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Note</label>
                                <textarea name="note" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class=" text-right">
                        {{-- <button class="btn btn-success" onclick="gettotal()" type="button"><i class="fa fa-calculator"></i>
                            Calculate</button> --}}
                        <button class="btn btn-primary" type="submit"><i class="fa fa-send"></i> Submit</button>
                    </div>
                    <!-- End Table with stripped rows -->
                </div>
        </div>
    </div>
    </form>
    </div>
    </div>

    <script type="text/javascript">
        function findrequisition() {
            $('#requisitiohbf').html('<option value="">Select One.....</option>');
            $('#alltextre').empty();
            $("#ven").prop("selected", false);
            var html = "<option>Select One</option>";
            var storeroom = $('#storeroom').val();
            var vendor_id = $('#ven').val();
            var html = '';
            $.ajax({

                url: "{{ route('get-requisition-details') }}/" + vendor_id + "/" + storeroom,
                type: "get",
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $.each(res, function(index, value) {
                        html += "<option value='" + value.requisition_id + "'>" + value
                            .requisition_prefix + "" + value.requisition_id + "</option>";

                    });
                    $('#requisitiohbf').append(html);

                }
            });

        }
    </script>

    <script type="text/javascript">
        var i = 1;

        function findrequisitiondetails(requisition_id) {

            // alert(requisition_id);
            $.ajax({
                url: "{{ route('get-requisition-item-details') }}/" + requisition_id,
                type: "get",
                dataType: 'json',
                success: function(resp) {
                    console.log(resp);

                    $.each(resp, function(input, res) {
                        var html = '<tr id="rowid' + i +
                            '"><input type="hidden" readonly class="form-control" required name="req_id_no[]" value="' +
                            res.requisition_id +
                            '"/><input type="hidden" readonly class="form-control" required name="req_id[]" value="' +
                            res.requisition_prefix + "" + res.requisition_id +
                            '"/><input class="form-control" type="hidden" name="requisition_details_id[]" required readonly value="' +
                            res.requisition_details_id +
                            '" /><input class="form-control" type="hidden" name="unit[]" required readonly value="' +
                            res.medicine_units_id +
                            '" /><td><span class="req_no_style">Requisition No - ' + res
                            .requisition_prefix + res.requisition_id +
                            '</span><select name="medicine[]" required class="form-control" readonly><option value="' +
                            res.medicine_id + '">' + res.medicine_name+'('+res.medicine_catagory_name+')' +
                            '</option></select></td><td><select name="unit[]" required class="form-control" readonly><option value="' +res.medicine_units_id + '">' + res.medicine_unit_name +
                            '</option></select></td><td><input type="text" required name="qty[]" value="' +
                            res.quantity + '" onkeyup="getamount(' + i + ')" id="qty' + i +
                            '" class="form-control" ><td><button type="button" class="btn btn-danger btn-sm" onclick="remove(' +
                            i + ')"><i class="fa fa-trash"></i></button></td></tr>';
                        $('#subhendu').append(html);
                        i = i + 1;
                    });
                }
            });
            //    $('#requisitiohbf').('option[value=' +requisition_id+ ']').prop('disabled',true);
        }
    </script>


    <script type="text/javascript">
        function remove(i) {
            $('#rowid' + i).remove();
        }
    </script>

@endsection
