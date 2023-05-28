<!DOCTYPE html>
<html>
<title>Requisition</title>
<meta charset="utf-8">

<body>
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

        .marksheetheading1 {
            color: #ffffff !important;
            display: inline-block;
            text-align: left;
            font-size: 15px;
            font-weight: 700;
            padding: 10px 10px;
        }

        .headingdesign1 {
            background: #010c45 !important;
        }
    </style>


    <div style="position:relative;background-color:#fff;padding:30px;">
        <!-- ========================================first heading============================== -->
        <table cellspacing="0" border="0" width="100%" hright="100%" style="text-align:center;margin-top: 0px;width: 100%;border-bottom: 2px solid #010c45;">
            <tr style="text-align: center;">
                <td>
                    <img src="{{ asset('public/assets/images/header') }}/{{$header->logo}}" alt="" style="width: 80%;" >
                </td>
            </tr>
        </table>
        <!-- ========================================first heading============================== -->
        <!-- ====================================main area====================================== -->
        <table cellspacing="0" border="0" width="100%" hright="100%" style="margin-top: 0px;width: 100%;border-bottom: none;">
            <tr>
                <th style="padding: 10px 0px 10px 7px;text-align: left;font-size: 12px;border-left: 2px solid #010c45;width: 150px;border-bottom: 2px solid #010c45;">
                    <b>REQUISITION NO :-</b>
                </th>
                <td style="padding: 10px 0px 10px 7px;font-size: 12px;border-right: 2px solid #010c45;border-bottom: 2px solid #010c45;text-align:left;">
                    {{@$requisition_details->requisition_prefix}}{{@$requisition_details->id}}
                </td>
                <th style="padding: 10px 0px 10px 7px;text-align: left;font-size: 12px;width: 150px;border-bottom: 2px solid #010c45;">
                    <b>REQUISITION DATE :-</b>
                </th>
                <td style="padding: 10px 0px 10px 7px;font-size: 12px;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;text-align:left;">
                    <?= date('d-m-Y h:i', strtotime($requisition_details->date)); ?>
                </td>
            </tr>
            <tr>
                <th style="padding: 10px 0px 10px 7px;text-align: left;font-size: 12px;border-left: 2px solid #010c45;border-bottom: 2px solid #010c45;">
                    <b>Store Room :-</b>
                </th>
                <td style="padding: 10px 0px 10px 7px;font-size: 12px;border-bottom: 2px solid #010c45;text-align: left;">
                    {{ @$requisition_details->store_room->name }}
                </td>
                @if($vendor_selected_quataion != null && $vendor_selected_quataion != '')
                <th style="padding: 10px 0px 10px 7px;text-align: left;font-size: 12px;border-left: 2px solid #010c45;border-bottom: 2px solid #010c45;">
                    <b>VENDOR :-</b>
                </th>
                <td style="padding: 10px 0px 10px 7px;font-size: 12px;border-right: 2px solid #010c45;border-bottom: 2px solid #010c45;text-align: left;">

                    @foreach($vendor_selected_quataion as $value)
                    {{ $loop->iteration }}. {{$value->sl_vendors_join->vendor_name}}<br>
                    @endforeach

                </td>
                @endif
            </tr>
        </table>
        <table cellspacing="0" border="0" width="100%" style="">
            <tr style="text-align: center; font-size: 13px;">
                <th style="padding: 7px 0px 7px 0px;border-left: 2px solid #010c45;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                    SL No.
                </th>
                <th style="padding: 7px 0px 7px 0px;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;width: 400px;">
                    Medicine Catagory
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid #010c45;border-bottom:2px solid #010c45;width: 100px;">
                   Quantity
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid #010c45;border-bottom:2px solid #010c45;width: 100px;">
                    Per
                </th>
            </tr>

            @if(isset($requisition_item) && $requisition_item != '')
            @foreach($requisition_item as $requisition)
            <tr style="text-align: left; font-size: 13px;">
                <td style="width: 70px;padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-left: 2px solid #010c45;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                    {{ $loop->iteration }}
                </td>
                <td style="width: 70px;padding: 7px 0px 7px 10px;text-align: left;vertical-align:top;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                    {{@$requisition->medicine_name}} ({{@$requisition->medicine_catagory_name}})
                </td>
                <td style="padding: 7px 0px 7px 0px;vertical-align:top;text-align: center;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                    {{@$requisition->quantity}}
                </td>
                <td style="padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                    {{@$requisition->medicine_unit_name}}
                </td>
            </tr>
            @endforeach
            @endif

        </table>
        <!-- ====================================main area====================================== -->
        <!-- ============================footer area============================================ -->
        <table cellspacing="0" border="0" width="100%" hright="100%" style="width:100%;">
            <tr>
                <!-- <td style="padding: 50px 5px 5px 10px;font-size: 13px;text-align:left;border-left: 2px solid #010c45;">
                       <b style="border-bottom: 2px dotted #c0c0c0;padding: 0px 0px 3px 0px;">  REQUESTED BY  </b> 
                    </td> -->
                <td style="padding: 50px 5px 5px 10px;font-size: 13px;text-align:left;align:left;border-left: 2px solid #010c45;">
                    <b style="border-bottom: 2px dotted #c0c0c0;padding: 0px 0px 3px 0px;"> GENERATED BY </b>
                </td>
                <td style="padding: 50px 5px 5px 10px;font-size: 13px;text-align:left;align:left; border-right: 2px solid #010c45;">
                    <b style="border-bottom: 2px dotted #c0c0c0;padding: 0px 0px 3px 0px;"> SIGNATURE</b>
                </td>
            </tr>
            <tr>
                <!-- <td style="padding: 5px 5px 5px 10px;font-size: 13px;text-align:left;border-left: 2px solid #010c45; border-bottom: 2px solid #010c45;">
                       {{@$requisition_requested_by->name}}
                    </td> -->
                <td style="padding: 5px 5px 5px 10px;font-size: 13px;text-align:left;align:left;border-bottom: 2px solid #010c45;border-left: 2px solid #010c45;">
                    {{@$requisition_details->generate_by_name->first_name}}   {{@$requisition_details->generate_by_name->last_name}}
                </td>
                <td style="padding: 5px 5px 5px 10px;font-size: 13px;text-align:left;align:left; border-right: 2px solid #010c45;border-bottom: 2px solid #010c45;">

                </td>
            </tr>
        </table>
        <!-- ============================footer area============================================ -->
    </div>
</body>

</html>
<!-- =================================================================================== -->