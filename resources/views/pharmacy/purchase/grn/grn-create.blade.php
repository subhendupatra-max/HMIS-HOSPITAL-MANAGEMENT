@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Create GRN</div>
        </div>


        <form method="POST" action="{{route('save-grn')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="requisition_header">Purchase Order <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" onchange="findPOdetails(this.value)"
                                name="po_no" id="po">
                                <option value="">Select One<span class="text-danger">*</span></option>
                                @if(!empty($po_list))
                                @foreach($po_list as $valu)
                                <option value="{{$valu->po_id}}">{{$valu->po_prefix}}{{$valu->po_id}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-4 grncreateadd">
                            <label class="requisition_header1">Medicine Rec. Date<span
                                    class="text-danger">*</span></label>
                            <input type="date" name="medicine_rec_date" class="form-control">

                            @error('medicine_rec_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 grncreateadd">
                            <label class="requisition_header1">Bill Rec. Date</label>
                            <input type="date" name="bill_rec_date" class="form-control">
                            @error('bill_rec_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 grnnewadd">
                            {{-- <label class="requisition_header">Challan No.</label>
                            <input type="text" name="challan_no" class="form-control"> --}}
                            <input type="text" id="challan_no" name="challan_no" required="">
                            <label for="Challan No."> Challan No.</label>
                        </div>
                        <div class="col-md-4 grnnewadd">
                            {{-- <label class="requisition_header">Challan Date (DD-MM-YYYY)</label>
                            <input type="text" name="challan_date" class="form-control"> --}}
                            <input type="text" id="challan_date" name="challan_date" required="">
                            <label for="challan_date">Challan Date </label>
                        </div>
                        {{-- <div class="col-md-4">
                            <label class="requisition_header">Challan Copy</label>
                            <input type="file" name="challan_copy">
                        </div> --}}


                        <div class="col-md-4 grnnewadd">
                            {{-- <label class="requisition_header">Invoice No.</label>
                            <input type="text" name="invoice_no" class="form-control"> --}}
                            <input type="text" id="invoice_no" name="challan_date" required="">
                            <label for="invoice_no">Invoice No. </label>
                        </div>
                        <div class="col-md-4 grnnewadd">
                            {{-- <label class="requisition_header">Invoice Date (DD-MM-YYYY)</label>
                            <input type="text" name="invoice_date" class="form-control"> --}}
                            <input type="text" id="invoice_date" name="invoice_date" required="">
                            <label for="Invoice Date">Invoice Date </label>
                        </div>
                        {{-- <div class="col-md-4">
                            <label class="requisition_header">Invoice Copy</label>
                            <input type="file" name="invoice_copy">
                        </div> --}}



                        <div class="col-md-12 newadd">
                            <span class="requisition_header">Purchase Order : </span><span id="po_no"
                                class="requisition_header" style="color:blue"></span>
                        </div>
                        <div class="col-md-4">
                            <span class="requisition_header">PO. Date : </span><span id="po_date"
                                class="requisition_text"></span>
                        </div>
                        <div class="col-md-4">
                            <span class="requisition_header">Store Room : </span><span id="store_room"
                                class="requisition_text"></span>
                        </div>
                        <input type="hidden" name="storeroom_id" id="wrk_id">
                        <input type="hidden" name="vendor" id="vend_id">
                        <div class="col-md-4">
                            <span class="requisition_header">Vendor : </span><span id="vendor_name"
                                class="requisition_text"></span>
                        </div>

                    </div>
                    <div class="row" id="req_details">



                    </div>
                </div>
                <hr>
                <div class="">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%">Req Id <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 25%">Medicine Name <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 10%">Batch No. <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 10%">Quantity <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 10%">MRP <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 5%">Discount(%) </th>
                                    <th scope="col" style="width: 10%">P Rate <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 10%">S Rate <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 10%">Expire Date <span class="text-danger">*</span>
                                    </th>
                                    <th scope="col" style="width: 10%">CGST(%) </th>
                                    <th scope="col" style="width: 10%">SGST(%) </th>
                                    <th scope="col" style="width: 10%">IGST(%) </th>
                                    <th scope="col" style="width: 10%">Amount <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 2%"></th>
                                </tr>
                            </thead>
                            <tbody id="alltextre">
                                <!-- dynamic row -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="col-md-12 mt-5 mb-3">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" style="width:520px" id="note" name="note" required="">
                            <label for="note">Note </label>
                        </div>
                        <div class="col-md-4">
                            <span class="biltext">Total </span>
                            <input type="text" style="    margin: -34px 0px 12px 212px;
                        width: 208px;" name="total_value" value="0" id="total_value" class="form-control" />
                            <span class="biltext">Total Invoice Amount</span>
                            <input type="text" style="    margin: -34px 0px 12px 212px;
                        width: 208px;" name="invoice_value"  id="invoice_value" class="form-control" />
                            <span class="biltext">Total CGST Amount</span>
                            <input type="text" style="    margin: -34px 0px 12px 212px;
                            width: 208px;" name="total_cgst_amount" value="0" id="total_cgst_amount"
                            class="form-control" />
                            <span class="biltext">Total SGST Amount</span>
                            <input type="text" style="    margin: -34px 0px 12px 212px;
                            width: 208px;" name="total_sgst_amount" value="0" id="total_sgst_amount"
                            class="form-control" />
                            <span class="biltext">Total IGST Amount</span>
                            <input type="text" style="    margin: -34px 0px 12px 212px;
                            width: 208px;" name="total_igst_amount" value="0" id="total_igst_amount"
                            class="form-control" />
                        </div>
                    </div>
                </div>
                <input type="hidden" name="rowno_" id="jsdfbujdg">

                <div class=" text-right">
                    <button class="btn btn-primary" onclick="gettotal()" type="button"><i class="fa fa-send"></i> Calculate</button>
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
    function workshop_name(value) {
        if (value != null) {
            $('#requisitiohbf').empty();
            $('#alltextre').empty();
        }
    }
    function gettotal() {
       // alert('ok');
        var no_of_row = $('#alltextre tr').length;
        var t = 0;
        var sgst = 0;
        var cgst = 0;
        var igst = 0;
        //console.log(t);
        $("input[name='amount[]']").map(function() {
            t = t + parseFloat($(this).val());
        }).get();
        $('#total_value').val(t);

        $("input[name='sgst_value[]']").map(function() {
            sgst = sgst + parseFloat($(this).val());
        }).get();

        $('#total_sgst_amount').val(sgst);
        $("input[name='cgst_value[]']").map(function() {
            cgst = cgst + parseFloat($(this).val());
        }).get();
        $('#total_cgst_amount').val(cgst);

        $("input[name='igst_value[]']").map(function() {
            igst = igst + parseFloat($(this).val());
        }).get();
        $('#total_igst_amount').val(igst);
    }

</script>

<script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>

<script type="text/javascript">
    var i = 1;

    function findPOdetails(po_id) {
        $.ajax({
            url: "{{ route('get-po-item-details') }}/" + po_id,
            type: "get",
            dataType: 'json',
            success: function(resp) {
                console.log(resp.po_list.grand_total);
                $('#po_no').text(resp.po_list.po_prefix + '' + resp.po_list.po_id);
                $('#po_date').text(resp.po_list.po_date);
                $('#store_room').text(resp.po_list.store_room_name);
                $('#wrk_id').val(resp.po_list.medicine_store_rooms_id_no);
                $('#vend_id').val(resp.po_list.vendor_id_no);
                $('#vendor_name').text(resp.po_list.vendor_name);
                $('#po_value').val(resp.po_list.grand_total);

                $.each(resp.po_item, function(input, res) {
                    console.log(res);
                    var html = '<tr id="rowid' + i + '"><td><input class="form-control" type="hidden" name="po_details_id[]" required readonly value="' + res.purchase_order_details_id + '" /><input class="form-control" type="text" name="req[]" required readonly value="' + res.req_no + '" /></td><td><input class="form-control" type="hidden" name="catagory[]" required readonly value="' + res.catagory_id + '" /><input class="form-control" type="hidden" name="unit[]" required readonly value="' + res.unit_id + '" /><select name="medicine[]" required class="form-control" readonly> <option value="' + res.medicine_id + '">' + res.medicine_name + '</option></select></td><td><input type="text" name="batch_no[]" id="batch_no' + i + '" /></td><td><input type="hidden" required name="ori_qty[]" value="' + res.quantity + '"><input type="text" required name="qty[]" value="' + (parseFloat(res.quantity) - parseFloat(res.grn_qty)) + '" id="qty' + i + '" class="form-control" style="width: 60%; float: left;"></td><td><input type="text" onkeyup="getSaleRate(' + i + ')" name="mrp[]" value="0" id="mrp' + i + '" /></td><td><input type="text" onkeyup="getSaleRate(' + i + ')" name="discount[]" value="0" id="discount' + i + '" /></td><td><input type="text" name="p_rate[]" onkeyup="getamount(' + i + ')" value="0" id="p_rate' + i + '" /></td><td><input type="text" value="0" name="s_rate[]" id="s_rate' + i + '" /></td><td><input type="date" name="expire_date[]" id="expire_date' + i + '" /></td><td><input type="text" value="0" name="cgst[]" onkeyup="getamount(' + i + ')" id="cgst' + i + '" /><input type="hidden" value="0" name="cgst_value[]" onkeyup="getamount(' + i + ')" id="cgst_value' + i + '" /></td><td><input type="text" onkeyup="getamount(' + i + ')" value="0" name="sgst[]" id="sgst' + i + '" /><input type="hidden" value="0" name="sgst_value[]" onkeyup="getamount(' + i + ')" id="sgst_value' + i + '" /></td><td><input type="text" value="0" onkeyup="getamount(' + i + ')" name="igst[]" id="igst' + i + '" /> <input type="hidden" value="0" name="igst_value[]" onkeyup="getamount(' + i + ')" id="igst_value' + i + '" /></td><td><input type="text" readonly name="amount[]" value="0" id="amount' + i + '" /></td><td><button type="button" class="btn btn-danger btn-sm" onclick="remove(' + i + ')"><i class="fa fa-times"></i></button></td></tr>';
                    $('#subhendu').append(html);
                    i = i + 1;
                });
                $('#jsdfbujdg').val(i);
            }
        });
    }
</script>
<script>
    function getSaleRate(row_id)
    {
        //alert('ok');
        var mrp = $('#mrp' + row_id).val();
        var discount = $('#discount' + row_id).val();
        var discount_amount = mrp * (discount/100);
        //alert(discount_amount);
        var sale_price = parseFloat(mrp - discount_amount).toFixed(2);
        $('#s_rate' + row_id).val(sale_price);
    }
</script>

<script type="text/javascript">
    function getamount(row_id) {
        var p_rate = $('#p_rate' + row_id).val();
        var qty = $('#qty' + row_id).val();
        var sgst = $('#sgst' + row_id).val();
        var cgst = $('#cgst' + row_id).val();
        var igst = $('#igst' + row_id).val();
        var sgst_amnt = (parseFloat((p_rate * qty) * (sgst / 100)).toFixed(2));
        var cgst_amnt = (parseFloat((p_rate * qty) * (cgst / 100)).toFixed(2));
        var igst_amnt = (parseFloat((p_rate * qty) * (igst / 100)).toFixed(2));
        var amount = (parseFloat(p_rate) * qty) + (parseFloat(sgst_amnt) + parseFloat(cgst_amnt) + parseFloat(igst_amnt));
        $('#amount' + row_id).val(amount);
        $('#igst_value' + row_id).val(igst_amnt);
        $('#cgst_value' + row_id).val(cgst_amnt);
        $('#sgst_value' + row_id).val(sgst_amnt);
        gettotal();
    }

</script>


<script type="text/javascript">
    function remove(i) {
        $('#rowid' + i).remove();
        gettotal();
    }

</script>

@endsection