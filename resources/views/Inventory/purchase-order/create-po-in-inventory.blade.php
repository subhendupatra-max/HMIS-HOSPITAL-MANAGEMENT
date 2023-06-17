@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Create Purchase Order</div>
        </div>

        <form method="POST" action="{{route('save-purchase-order-in-inventory')}}">
            @csrf
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Workshop <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" onchange="findrequisition()" id="workshop" name="workshop">
                                <option value="">Select Workshop</option>
                                @if($stockroom)
                                @foreach($stockroom as $value)
                                <option value="{{$value->id}}">{{$value->item_store_room}}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('workshop')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 mt-2">
                            <label class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="po_date" class="form-control">
                            @error('po_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-3" id="gofgk">
                            <label class="form-label">Vendor <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" id="ven" name="vendor" onchange="findrequisition()">
                                <option value="">Select Vendor</option>
                                @if($vendor_list)
                                @foreach($vendor_list as $value)
                                <option value="{{$value->id}}">{{$value->vendor_name}}( {{$value->vendor_gst}} )</option>
                                @endforeach
                                @endif
                            </select>
                            @error('vendor')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- <div class="col-md-3" >
                            <label class="form-label">Requisition <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" name="requisition_no"  onchange="findrequisitiondetails(this.value)">
                                <option value="">Select Requisition</option>
                              
                            </select>
                            @error('requisition_no')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> -->




                        <div class="col-md-3">
                            <label class="form-label">Requisition <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" onchange="findrequisitiondetails(this.value)" name="requisition_no" id="requisitiohbf">
                            <option value="">Select Requisition</option>
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
                                    <th scope="col" style="width: 40%">Item <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 25%">Quantity <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 7%">GST <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 13%">Rate <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 15%">Amount <span class="text-danger">*</span></th>

                                </tr>
                            </thead>
                            <tbody id="alltextre">
                                @error('item')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <!-- dynamic row -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container mt-5">
                    <div class="d-flex justify-content-end">
                        <span class="biltext">Total</span>
                        <input type="text" name="total" readonly id="total_am" class="form-control myfld">
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="text" name="extra_charges_name" placeholder="Enter Extra Charges Name" class="form-control myfld2">
                        <input type="text" name="extra_charges_value" value="00" class="form-control myfld1" id="extra_chages">
                    </div>
                    <div class="d-flex justify-content-end thrdarea">
                        <span class="biltext">Grand Total</span>
                        <input type="text" name="grand_total" readonly id="grnd_total" value="00" class="form-control myfld">
                        @error('grand_total')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Note</label>
                            <textarea name="note" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Payment Terms</label>
                            <select class="form-control" name="payment_terms">
                                <option value="">Select One....</option>
                                @foreach (Config::get('static.payment_terms') as $value)
                                <option value="{{$value}}">{{$value}}</option>
                                @endforeach
                            </select>
                            @error('payment_terms')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>
                <div class=" text-right">
                    <button class="btn btn-success" onclick="gettotal()" type="button"><i class="fa fa-calculator"></i> Calculate</button>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-send"></i> Submit</button>
                </div>
                <!-- End Table with stripped rows -->
            </div>
    </div>
</div>
</form>
</div>
</div>


<script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>
<script type="text/javascript">
    function gettotal() {
        var no_of_row = $('#subhendu tr').length;
        console.log('aaa=>', no_of_row);

        var t = 0;
        $("input[name='amount[]']").map(function() {
            t = t + parseFloat($(this).val());
        }).get();

        var extra = $('#extra_chages').val();

        var grnd_total = parseFloat(t) + parseFloat(extra);
        $('#total_am').val(t);
        $('#grnd_total').val(grnd_total);

    }
</script>

<script type="text/javascript">
    function findrequisition() {
        // $('#requisitiohbf').empty();
        $('#alltextre').empty();
        // $("#ven").prop("selected", false);
        $('#requisitiohbf').html('<option value="">Select One</option>');
        var html = "";
        var workshop = $('#workshop').val();
        var vendor_id = $('#ven').val();
        $.ajax({

            url: "{{ route('get-requisition-details-inventory') }}/" + vendor_id + "/" + workshop,
            type: "get",
            dataType: 'json',
            success: function(res) {

                $.each(res, function(index, value) {
                    html += "<option value='" + value.requisition_id + "'>" + value.requisition_prefix + "" + value.requisition_id + "</option>";

                });
                $('#requisitiohbf').append(html);

            }
        });

    }
</script>

<script type="text/javascript">
    var i = 1;

    function findrequisitiondetails(requisition_id) {

        $.ajax({
            url: "{{ route('get-requisition-item-details-inventory') }}/" + requisition_id,
            type: "get",
            dataType: 'json',
            success: function(resp) {

                $.each(resp, function(input, res) {
                    var html = '<tr id="rowid' + i + '"><input type="hidden" readonly class="form-control" required name="req_id_no[]" value="' + res.requisition_id + '"/><input type="hidden" readonly class="form-control" required name="req_id[]" value="' + res.requisition_prefix + "" + res.requisition_id + '"/><input class="form-control" type="hidden" name="requisition_details_id[]" required readonly value="' + res.requisition_details_id + '" /><input class="form-control" type="hidden" name="brand[]" required readonly value="' + res.brands_id + '" /><input class="form-control" type="hidden" name="manufacturer[]" required readonly value="' + res.manufacturer_id + '" /><td><a href="{{url("add-inventory-requisition-details")}}/' + res.requisition_id + '" target="_blank"><span class="req_no_style">Requisition No - ' + res.requisition_prefix + res.requisition_id + '</span></a><select name="item[]" required class="form-control" readonly><option value="' + res.item_id + '">' + res.item_name + '(' + res.item_description + ')(Brand :' + res.item_brand_name + ')(Manufacturer :' + res.manufacture_name + ')</option></select></td><td><input type="text" required name="qty[]" value="' + res.result_qty + '" onkeyup="getamount(' + i + ')" id="qty' + i + '" class="form-control" style="width: 60%; float: left;"><select name="unit[]" readonly class="form-control" style="width: 40%; float: left;" required ><option value="' + res.item_unit_id + '">' + res.units + '</option></select><td><input type="text" onkeyup="getamount(' + i + ')" required name="gst[]" id="gst' + i + '" class="form-control"></td><td><input type="text"  onkeyup="getamount(' + i + ')" id="rate' + i + '" required name="rate[]" class="form-control"></td><td><input type="text" required name="amount[]" id="amount' + i + '" class="form-control grgrtg"></td><td><button type="button" class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-trash"></i></button></td></tr>';
                    $('#subhendu').append(html);
                    i = i + 1;
                });
            }
        });
        //    $('#requisitiohbf').('option[value=' +requisition_id+ ']').prop('disabled',true);
    }
</script>

<script type="text/javascript">
    function getamount(i) {


        var gst = $('#gst' + i).val();
        console.log(gst);
        var rate = $('#rate' + i).val();
        console.log(rate);
        var qty = $('#qty' + i).val();
        console.log(qty);

        var amnt = (parseFloat(rate) * parseFloat(qty) * parseFloat(gst)) / 100;
        var t_amnt = parseFloat(amnt) + (parseFloat(rate) * parseFloat(qty));

        $('#amount' + i).val(t_amnt);


    }
</script>


<script type="text/javascript">
    function remove(i) {
        $('#rowid' + i).remove();
    }
</script>
<script type="text/javascript">
    function getitem(rowno) {

        var item_type = $('#item_type' + rowno).val();
        var brand = $('#brand' + rowno).val();
        var manufacturer = $('#manufacturer' + rowno).val();
        var div_data = '';
        var unit = '';
        $.ajax({

            url: "{{ route('get-item-inventoty') }}",
            type: "post",
            data: {
                item_type_id: item_type,
                brand_id: brand,
                manufacturer_id: manufacturer,
                _token: '{{ csrf_token() }}',
            },
            dataType: 'json',
            success: function(res) {
                console.log(res);
                $.each(res, function(i, obj) {
                    div_data += "<option value=" + obj.item_id + ">" + obj.item_name + "(" + obj.item_description + ") </option>";
                    unit = obj.units;
                });

                $('#item' + rowno).append(div_data);
                $('#unit' + rowno).val(unit);
            }
        });
    }
</script>
@endsection