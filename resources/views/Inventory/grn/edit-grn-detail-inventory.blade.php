@extends('layouts.layout')
@section('content')
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit GRN</div>
        </div>


        <form method="POST" action="{{route('grm-update-inven')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" value="{{$grm_list->grm_id}}" name="grm_id">
                            <label class="requisition_header">Purchase Order <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" onchange="findPOdetails(this.value)" name="po_no" id="po">
                                @if(!empty($po_list))
                                <option value="{{$po_list->po_id}}" {{(($grm_list->po_no==$po_list->po_id)?'selected':'')}}>{{$po_list->po_prefix}}{{$po_list->po_id}}</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-4 grncreateadd">
                            <label class="requisition_header1">Medicine Rec. Date<span class="text-danger">*</span></label>
                            <input type="date" name="material_rec_date" class="form-control" value="{{@$grm_list->material_rec_date}}">
                            @error('medicine_rec_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="col-md-4 grncreateadd">
                            <label class="requisition_header1">Bill Rec. Date</label>
                            <input type="date" name="bill_rec_date" class="form-control" value="{{@$grm_list->bill_rec_date}}">

                            @error('bill_rec_date')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4 grnnewadd">
                            <input type="text" name="challan_no" class="form-control" value="{{@$grm_list->challan_no}}">
                            <label for="Challan No."> Challan No.</label>
                        </div>

                        <div class="col-md-4 grnnewadd">
                            <input type="text" name="challan_date" class="form-control" value="{{@$grm_list->challan_date}}">
                            <label for="challan_date">Challan Date (DD-MM-YYYY)</label>
                        </div>

                        <div class="col-md-4 grnnewadd">
                            <input type="text" name="invoice_no" class="form-control" value="{{@$grm_list->invoice_no}}">
                            <label for="invoice_no">Invoice No. </label>
                        </div>

                        <div class="col-md-4 grnnewadd">
                            <input type="text" name="invoice_date" class="form-control" value="{{@$grm_list->invoice_date}}">
                            <label for="Invoice Date">Invoice Date </label>
                        </div>
                        <div class="col-md-12">


                            <div class="col-md-12 newadd">
                                <span class="requisition_header">Purchase Order : </span><span id="po_no" class="requisition_header" style="color:blue"></span>
                            </div>
                            <div class="col-md-4">
                                <span class="requisition_header">PO. Date : </span><span id="po_date" class="requisition_text"></span>
                            </div>
                            <div class="col-md-4">
                                <span class="requisition_header">Store Room : </span><span id="store_room" class="requisition_text"></span>
                            </div>

                            <input type="hidden" name="workshop_id" id="wrk_id">
                            <input type="hidden" name="vendor" id="vend_id">

                            <div class="col-md-4">
                                <span class="requisition_header">Vendor : </span><span id="vendor_name" class="requisition_text"></span>
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
                                        <th scope="col" style="width: 25%">Req Id <span class="text-danger">*</span></th>
                                        <th scope="col" style="width: 55%">Item <span class="text-danger">*</span></th>
                                        <th scope="col" style="width: 18%">Quantity <span class="text-danger">*</span></th>
                                        <th scope="col" style="width: 2%"></th>

                                    </tr>
                                </thead>
                                <tbody id="alltextre">
                                    <!-- dynamic row -->
                                    @if(!empty($grm_item))
                                    <?php $i = 0;
                                    $req_ids = array();
                                    ?>
                                    @foreach($grm_item as $grnItem)
                                    <?php $i += 1;
                                    $req_ids[] = $grnItem->req_id; ?>
                                    <tr id="rowid{{$i}}">
                                        <td>
                                            <input class="form-control" type="hidden" name="po_details_id[]" required="" readonly="" value="55">
                                            <input class="form-control" type="text" name="req[]" required="" readonly="" value="{{$grnItem->req_id}}">
                                        </td>
                                        <td>
                                            <input class="form-control" type="hidden" name="amount[]" required="" readonly="" value="{{$grnItem->amount}}">
                                            <input class="form-control" type="hidden" name="rate[]" required="" readonly="" value="{{$grnItem->rate}}">
                                            <input class="form-control" type="hidden" name="gst[]" required="" readonly="" value="{{$grnItem->gst}}">
                                            <input class="form-control" type="hidden" name="brand[]" required="" readonly="" value="{{$grnItem->brand_id}}">
                                            <input class="form-control" type="hidden" name="manufacturer[]" required="" readonly="" value="{{$grnItem->manufacturer_id}}">
                                            <select name="item[]" required="" class="form-control" readonly="">
                                                <option value="{{$grnItem->item_id}}">{{$grnItem->item_name}}({{$grnItem->item_description}})(Brand :{{$grnItem->item_brand_name}})(Manufacturer :{{$grnItem->manufacture_name}})</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="hidden" required="" name="ori_qty[]" value="10"><input type="text" required="" name="qty[]" value="{{$grnItem->quantity}}" id="qty1" class="form-control" style="width: 60%; float: left;">
                                            <select name="unit[]" class="form-control" style="width: 40%; float: left;">
                                                <option value="{{$grnItem->unit_id}}">{{$grnItem->units}}</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" onclick="remove(1)"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12 mt-5 mb-3">
                        <input type="hidden" value="{{json_encode($req_ids)}}" id='ex_reqId'>
                        <input type="hidden" name="rowno_" id="jsdfbujdg">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" style="width:520px" id="note" name="note" required="" value="{{$grm_list->note}}">
                                <label for="note">Note </label>
                            </div>

                            <div class="col-md-4">
                                <span class="biltext">Invoice Value </span>
                                <input type="text" style="margin: -34px 0px 12px 212px;
                              width: 208px;" name="invoice_value" id="invoice_value" class="form-control" value="{{$grm_list->invoice_value}}" />

                                <span class="biltext">PO. Value</span>

                                <input type="text" style="    margin: -34px 0px 12px 212px;
                        width: 208px;" name="po_value" id="po_value" class="form-control" value="{{$grm_list->po_value}}" />

                                <span class="biltext">Purpose</span>
                                <textarea name="purpose" class="form-control">{{$grm_list->purpose}}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class=" text-right">
                        <!-- <button class="btn btn-primary" onclick="gettotal()" type="button"><i class="fa fa-send"></i> Calculate</button> -->
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
            //    $('#alltextre').empty();
        }
    }

    function gettotal() {

        var no_of_row = $('#jsdfbujdg').val();
        console.log(no_of_row);
        var t = 0;
        for (var i = 1; i < no_of_row; i++) {
            var total = $('#amount' + i).val();
            console.log(total);
            var t = parseFloat(total) + parseFloat(t);

        }
        // console.log(t);
        var extra = $('#extra_chages').val();
        var grnd_total = parseFloat(t) + parseFloat(extra);
        $('#total_am').val(t);
        $('#grnd_total').val(grnd_total);
    }
</script>

<script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>

<script type="text/javascript">
    var i = <?= $i + 1 ?>;;

    function findPOdetails(po_id) {
        let reqIds = $('#ex_reqId').val();
        let preReqidjson = JSON.parse(reqIds);
        $.ajax({

            url: "{{ route('get-po-item-details-inven') }}/" + po_id,
            type: "get",
            dataType: 'json',
            success: function(resp) {
                console.log(resp.po_list.grand_total);
                $('#po_no').text(resp.po_list.po_prefix + '' + resp.po_list.po_id);
                $('#po_date').text(resp.po_list.po_date);
                $('#workshop').text(resp.po_list.workshop_name);
                $('#wrk_id').val(resp.po_list.workshop_id_no);
                $('#vend_id').val(resp.po_list.vendor_id_no);
                $('#vendor_name').text(resp.po_list.vendor_name);
                $('#po_value').val(resp.po_list.grand_total);


                $.each(resp.po_item, function(input, res) {
                    console.log(res);
                    const hasValue = Object.values(preReqidjson).includes(res.req_id);
                    if (!hasValue) {
                        console.log('Not Match==>', res.req_id);

                    } else {
                        console.log('Match=>', res.req_id);
                    }

                    console.log(res.brands_id);
                    var html = '<tr id="rowid' + i + '"><td><input class="form-control" type="hidden" name="po_details_id[]" required readonly value="' + res.purchase_order_details_id + '" /><input class="form-control" type="text" name="req[]" required readonly value="' + res.req_id + '" /></td><td><input class="form-control" type="hidden" name="amount[]" required readonly value="' + res.amount + '" /><input class="form-control" type="hidden" name="rate[]" required readonly value="' + res.rate + '" /><input class="form-control" type="hidden" name="gst[]" required readonly value="' + res.gst + '" /><input class="form-control" type="hidden" name="brand[]" required readonly value="' + res.brands_id + '" /><input class="form-control" type="hidden" name="manufacturer[]" required readonly value="' + res.manufacturer_id + '" /><select name="item[]" required class="form-control" readonly><option value="' + res.item_id + '">' + res.item_name + '(' + res.item_description + ')(Brand :' + res.item_brand_name + ')(Manufacturer :' + res.manufacture_name + ')</option></select></td><td><input type="hidden" required name="ori_qty[]" value="' + res.quantity + '" ><input type="text" required name="qty[]" value="' + (parseFloat(res.quantity) - parseFloat(res.grm_qty)) + '" id="qty' + i + '" class="form-control" style="width: 60%; float: left;"><select name="unit[]" class="form-control" style="width: 40%; float: left;"><option value="' + res.unit_id + '">' + res.units + '</option></select></td><td><button type="button" class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-times"></i></button></td></tr>';
                    $('#subhendu').append(html);
                    i = i + 1;

                });
                $('#jsdfbujdg').val(i);
            }
        });
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