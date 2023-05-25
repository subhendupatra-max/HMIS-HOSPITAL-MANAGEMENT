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
                            <select class="form-control select2-show-search" onchange="findPOdetails(this.value)" name="po_no" id="po">
                                <option value="">Select One<span class="text-danger">*</span></option>
                                @if(!empty($po_list))
                                @foreach($po_list as $valu)
                                <option value="{{$valu->po_id}}">{{$valu->po_prefix}}{{$valu->po_id}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-4 grncreateadd">
                            <label class="requisition_header1">Medicine Rec. Date<span class="text-danger">*</span></label>
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
                            <input type="text" id="challan_no"  name="challan_no" required="">
                            <label for="Challan No."> Challan No.</label>
                        </div>
                        <div class="col-md-4 grnnewadd">
                            {{-- <label class="requisition_header">Challan Date (DD-MM-YYYY)</label>
                            <input type="text" name="challan_date" class="form-control"> --}}
                            <input type="text" id="challan_date"  name="challan_date" required="">
                            <label for="challan_date">Challan Date </label>
                        </div>
                        {{-- <div class="col-md-4">
                <label  class="requisition_header">Challan Copy</label>
                <input type="file" name="challan_copy">
            </div> --}}


                        <div class="col-md-4 grnnewadd">
                            {{-- <label class="requisition_header">Invoice No.</label>
                            <input type="text" name="invoice_no" class="form-control"> --}}
                            <input type="text" id="invoice_no"  name="challan_date" required="">
                            <label for="invoice_no">Invoice No. </label>
                        </div>
                        <div class="col-md-4 grnnewadd">
                            {{-- <label class="requisition_header">Invoice Date (DD-MM-YYYY)</label>
                            <input type="text" name="invoice_date" class="form-control"> --}}
                            <input type="text" id="invoice_date"  name="invoice_date" required="">
                            <label for="Invoice Date">Invoice Date  </label>
                        </div>
                        {{-- <div class="col-md-4">
                <label  class="requisition_header">Invoice Copy</label>
                <input type="file" name="invoice_copy">
            </div> --}}



                        <div class="col-md-12 newadd">
                            <span class="requisition_header">Purchase Order : </span><span id="po_no" class="requisition_header" style="color:blue"></span>
                        </div>
                        <div class="col-md-4">
                            <span class="requisition_header">PO. Date : </span><span id="po_date" class="requisition_text"></span>
                        </div>
                        <div class="col-md-4">
                            <span class="requisition_header">Store Room : </span><span id="store_room" class="requisition_text"></span>
                        </div>
                        <input type="hidden" name="storeroom_id" id="wrk_id">
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
                            </tbody>
                        </table>
                    </div>
                </div>

                <input type="hidden" name="rowno_" id="jsdfbujdg">
                <div class="container mt-5">
                    <div class="d-flex justify-content-end">
                        <span class="biltext">Invoice Value</span>
                         <input type="text" name="invoice_value" id="invoice_value" class="form-control myfld">

                    </div>
                    <div class="d-flex justify-content-end thrdarea">
                        <span class="biltext">PO. Value</span>
                        <input type="text" name="po_value" id="po_value" class="form-control myfld">
                    </div>

                    <div class="d-flex justify-content-end thrdarea">
                        <span class="biltext">Purpose</span>
                        <textarea name="purpose" class="form-control myfld"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- <label class="form-label">Note</label>
                            <textarea name="note" class="form-control"></textarea> --}}
                            <input type="text" id="note"  name="note" required="">
                            <label for="note">Note  </label>
                        </div>
                    </div>
                </div>
                <div class=" text-right">
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
                    // console.log(res.brands_id);
                    var html = '<tr id="rowid' + i + '"><td><input class="form-control" type="hidden" name="po_details_id[]" required readonly value="' + res.purchase_order_details_id + '" /><input class="form-control" type="text" name="req[]" required readonly value="' + res.req_id + '" /></td><td><input class="form-control" type="hidden" name="amount[]" required readonly value="' + res.amount + '" /><input class="form-control" type="hidden" name="rate[]" required readonly value="' + res.rate + '" /><input class="form-control" type="hidden" name="gst[]" required readonly value="' + res.gst + '" /><input class="form-control" type="hidden" name="catagory[]" required readonly value="' + res.catagory_id + '" /><input class="form-control" type="hidden" name="unit[]" required readonly value="' + res.unit_id + '" /><select name="medicine[]" required class="form-control" readonly><option value="' + res.medicine_id + '">' + res.medicine_name + '(' + res.quantity + ')(Catagory :' + res.medicine_catagory_name + ')(Unit :' + res.medicine_unit_name + ')</option></select></td><td><input type="hidden" required name="ori_qty[]" value="' + res.quantity + '" ><input type="text" required name="qty[]" value="' + (parseFloat(res.quantity) - parseFloat(res.grn_qty)) + '" id="qty' + i + '" class="form-control" style="width: 60%; float: left;"></td><td><button type="button" class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-times"></i></button></td></tr>';
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

@endsection
