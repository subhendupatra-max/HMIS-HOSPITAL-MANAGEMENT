<!-- ================================================================= -->
<!DOCTYPE html>
<html>
<title>Feedback Form</title>
<meta charset="utf-8">

<body onload="window.print();">
    <style>
        @page {
            size: A4 portrait;
            margin: 0;
            padding: 0;
            /* change the margins as you want them to be. */
        }

        @media print {

            html,
            body {
                width: 25cm;
                height: 33cm;
                margin: 0 !important;
                padding: 5 !important;
                overflow: hidden;
            }
        }

        body {
            font-family: sans-serif;
            background: #ffffff;
            margin: 0 auto;
            height: 33cm;
            width: 100%;
        }

        table {
            background-position: center;
            background-repeat: no-repeat;
        }

        tr {
            width: 100%;
            height: auto;
        }

        .marksheetheading {
            color: #ffffff !important;
            display: inline-block;
            text-align: center;
            font-size: 25px;
            font-weight: 700;
            padding: 10px 0px;
        }

        .headingdesign {
            background: #010c45 !important;
        }
    </style>


    <div style="position:relative;background-color:#fff;padding:30px;">
        <!-- ========================================heading============================== -->
        <table cellspacing="0" border="0" width="100%" hright="100%" style="text-align:center;margin-top: 0px;width: 100%;border-bottom: none;">
            <tr>
                <td class="headingdesign">
                    <label class="marksheetheading">
                        FEEDBACK FORM
                    </label>
                </td>
            </tr>
        </table>
        <!-- ========================================heading============================== -->
        <!-- ============================main area======================================== -->
        <table cellspacing="0" border="0" width="100%" style="">
            <tr>
                <td style="padding: 10px 0px 0px 10px;font-size: 14px;line-height: 23px;font-family: inherit;vertical-align:top;border-left: 2px solid black;border-bottom: 2px solid black;border-right:2px solid black;">
                    Invoice To<br>
                    <b>DITS HOSPITAL</b><br>
                    2-FR, FL-2/A, 54 HARISH MUKHERJEE ROAD,<br>
                    KOLKATA - 700068<br>
                    GSTIN/UIN: 19AASCA6670R1ZI<br>
                    State Name : West Bengal, Code : 19
                </td>
                <td style="padding: 10px 0px 0px 10px;font-size: 14px;line-height: 23px;font-family: inherit;vertical-align:top;border-bottom: 2px solid black;border-right:2px solid black;">
                    Consignee (Ship to)<br>
                    <b>{{$po_list->item_store_room}}</b><br>
                    {{$po_list->address}}<br>
                </td>
                <td colspan="6" style="padding: 10px 0px 0px 10px;font-size: 14px;line-height: 23px;font-family: inherit;vertical-align:top;border-bottom: 2px solid black;border-right:2px solid black;">
                    Supplier (Bill From)<br>
                    <b>{{$po_list->vendor_name}}</b><br>
                    {{$po_list->vendor_address}}<br>
                    GSTIN/UIN : {{$po_list->vendor_gst}}
                </td>
            </tr>
        </table>
        <table cellspacing="0" border="0" width="100%" style="">
            <tr style="text-align: center; font-size: 13px;">
                <th style="padding: 7px 0px 7px 0px;border-left: 2px solid black;border-bottom: 2px solid black;border-right: 2px solid black;">
                    SL No.
                </th>
                <th style="padding: 7px 0px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">
                    Req No.
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid black;border-bottom:2px solid black;">
                    Description of Goods
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid black;border-bottom:2px solid black;">
                    SGST Rate
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid black;border-bottom:2px solid black;">
                    CGST Rate
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid black;border-bottom:2px solid black;">
                    Quantity
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid black;border-bottom:2px solid black;">
                    Deliverable Qty
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid black;border-bottom:2px solid black;">
                    Remarks
                </th>
            </tr>
            @if(!empty($po_item))
            @foreach($po_item as $value)
            <tr style="text-align: left; font-size: 13px;height: 400px;">
                <td style="width: 70px;padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-left: 2px solid black;border-bottom: 2px solid black;border-right: 2px solid black;">
                    {{ $loop->iteration }}
                </td>
                <td style="width: 70px;padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">
                    {{@$value->req_id}}
                </td>
                <td style="padding: 7px 0px 7px 7px;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">
                    <b>{{@$value->item_name}}({{@$value->item_description}})</b>
                </td>
                <td style="padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">
                    <?php echo ($value->gst / 2); ?>%
                </td>
                <td style="padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">
                    <?php echo ($value->gst / 2); ?>%
                </td>
                <td style="padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">
                    <b>{{@$value->quantity}} {{@$value->units}}</b>
                </td>
                <td style="padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">

                </td>
                <td style="padding: 7px 7px 7px 7px;text-align: center;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">

                </td>
            </tr>
            @endforeach
            @endif

        </table>
        <!-- ============================main area======================================== -->
        <!-- ============================footer area===================================== -->
        <table cellspacing="0" border="0" width="100%" hright="100%" style="width:100%;">
            <tr>
                <td style="padding: 10px 5px 5px 0px;font-size: 13px;border-left: 2px solid black;border-right: 2px solid black;border-bottom: 2px solid black;text-align:right;">
                    <b>E. & O.E</b>
                </td>
            </tr>
        </table>
        <table cellspacing="0" border="0" width="100%" hright="100%" style="width:100%;">
            <tr>
                <td style="padding: 10px 0px 0px 10px;font-size: 14px;line-height: 23px;font-family: inherit;border-left: 2px solid black;border-bottom: 2px solid black;border-right: 2px solid black;width: 60%;"><br>
                    Declaration<br>
                    We declare that this invoice shows the actual price of the
                    goods described and that all particulars are true and correct.
                </td>
                <td style="padding: 10px 10px 0px 10px;font-size: 13px;line-height: 23px;font-family: inherit;border-bottom: 2px solid black;border-right: 2px solid black;text-align: right;width: 40%;">
                    <b>For DITS HOSPITAL</b><br><br><br>
                    Authorised Signatory
                </td>
            </tr>
        </table>
        <!-- ============================footer area===================================== -->
    </div>
</body>

</html>
<!-- =================================================================================== -->