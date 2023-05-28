<!DOCTYPE html>
<html lang="en">

<head>
    <title>BillingSummary</title>

</head>
<script>
    window.print();
</script>
<style>
    @page {
        size: A4 portrait;
        margin: 0;
        / change the margins as you want them to be. /
    }

    @media print {

        html,
        body {
            width: 25cm;

            margin: 0 !important;
            padding: 5px !important;
            overflow: hidden;
        }

        .pagebreak {
            page-break-before: always;
        }

        / page-break-after works,
        as well /
    }



    body {
        font-family: sans-serif;
        background: #ffffff;
        margin: 0 auto;
        width: 100%;
    }

    table,
    th,
    td {
        border-collapse: collapse;
    }

    tr {
        width: 100%;
        height: auto;
    }
</style>
<div style="padding: 0px 7px 0px 7px;">
    <!-- ==========================================code here================================== -->
    <table style="width: 100%; border:1px soild black;border-collapse: collapse">
        <tr style="text-align: center;">
            <td>
                <!-- <img src="./image/1571895010.png" style="width: 100%;"> -->
                <img src="{{ asset('public/assets/images/header') }}/{{$header_image->logo}}" alt="" style="width: 80%;">
            </td>
        </tr>
        <tr style="width:100%">
            <td style="width:100%">
                <h1 style="text-align:center;font-size: 20px;margin: 40px 0px 20px 0px; color: #000;padding: 15px 0px 15px 0px;  width: 100%;">Billing Summary</h1>
            </td>
        </tr>
        <table style="width: 100%;">
            <tr>
                <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
                    <b>UHID No. : {{$Opd_details->all_patient_details->patient_prefix}}{{$Opd_details->all_patient_details->id}}</b>
                </td>
                <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
                    <!-- <img src="./image/qr.png" style="width: 80px;"> -->
                    <?php
                    $ipd_de = $Opd_details->opd_prefix . '' . $Opd_details->id;
                    ?>
                    {!! QrCode::size(60)->generate($ipd_de); !!}

                </td>
                <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
                    <!-- <img src="./image/barcodee.png" style="width: 80px;"> -->
                    @php
                    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                    @endphp

                    <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode('@$Opd_details->all_patient_details->patient_prefix @$Opd_details->all_patient_details->id', $generatorPNG::TYPE_CODE_128)) }}" style="width: 150px;height: 40px;">

                </td>
                <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
                    <b>Admission Date : {{$Opd_details->latest_opd_visit_details_for_patient->appointment_date}}</b>
                </td>

            </tr>
            <tr>
                <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;"><b> OPD no. : {{$Opd_details->opd_prefix}}{{$Opd_details->id}}</b></td>


            </tr>
        </table>
        <table style="width: 100%; margin: 15px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Patient Name
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$Opd_details->all_patient_details->first_name}} {{$Opd_details->all_patient_details->meddile_name}} {{$Opd_details->all_patient_details->last_name}}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Guardian Name
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$Opd_details->all_patient_details->guardian_name}}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Mobile No.
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$Opd_details->all_patient_details->phone}}
                </td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Age
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$Opd_details->all_patient_details->year}}Y {{$Opd_details->all_patient_details->month}}M {{$Opd_details->all_patient_details->day}}D
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Gender
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$Opd_details->all_patient_details->gender}}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Patient Type
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$Opd_details->patient_type}}
                </td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Dr. In Charge
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{@$Opd_details->doctor_details->first_name}} {{@$Opd_details->doctor_details->last_name}}
                </td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Department:
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{@$Opd_details->department_details->department_name}}
                </td>

            </tr>

        </table>
        <table style="width: 100%; border-collapse: collapse; ">
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Address
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$Opd_details->all_patient_details->address}}, {{$Opd_details->all_patient_details->_state->name}}, {{$Opd_details->all_patient_details->_district->name}}, {{$Opd_details->all_patient_details->pin_no}}
                </td>

            </tr>
            @if($Opd_details->patient_type == 'Swasthya Sathi' || $Opd_details->patient_type == 'TPA' )
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">

                    @if($Opd_details->patient_type == 'Swasthya Sathi')
                    Swasthya Sathi No.
                    @elseif($Opd_details->patient_type == 'TPA')
                    TPA {{$Opd_details->tpa_details->TPA_name}}
                    @endif
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{@$Opd_details->type_no}}
                </td>

            </tr>
            @endif
        </table>
        <table style="width: 100%; margin: 0px 0px 0px 0px; border-collapse: collapse; border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;">
            <tr>
                <th style="text-align: right;font-size: 13px; padding: 5px 0px 5px 0px;">Total :</th>
                <td style="text-align: right;font-size: 13px; width:90px;padding: 0px 10px 0px 0px; ">{{@$Opd_details->billing_details->total_amount}}</td>
            </tr>
            <tr>
                <th style="text-align: right;font-size: 13px;padding: 5px 0px 5px 0px; ">Tax :</th>
                <td style="text-align: right;font-size: 13px;padding: 0px 10px 0px 0px; ">{{@$Opd_details->billing_details->tax}}</td>
            </tr>
            <tr>
                <th style="text-align: right;font-size: 13px;padding: 5px 0px 5px 0px; ">Discount :</th>
                <td style="text-align: right;font-size: 13px;padding: 0px 10px 0px 0px; ">{{@$Opd_details->billing_details->discount_details->discount_type}}</td>
            </tr>
            <tr>
                <th style="text-align: right;font-size: 13px; padding: 5px 0px 5px 0px;">Grand Total :</th>
                <td style="text-align: right;font-size: 13px; padding: 0px 10px 0px 0px;">{{@$Opd_details->billing_details->grand_total}}</td>
            </tr>
        </table>
        <table style="width: 100%;

margin: 0px 0px 0px 0px;
border-collapse: collapse;
border-left: 1px solid black;
border-right: 1px solid black;
border-bottom: 1px solid black;">
            <tr>
                <th style="text-align: left;font-size: 13px; padding: 10px 10px 10px 10px;">
                    Date:
                </th>
                <td style="text-align: left;font-size: 13px;">
                    {{@$Opd_details->billing_details->bill_date}}
                </td>


            </tr>


            <tr>
                <th style="text-align: left;font-size: 13px;padding: 10px 10px 10px 10px;">
                    Payment Status:
                </th>
                <td style="text-align: left;font-size: 13px;">
                    {{@$Opd_details->billing_details->payment_status}}
                </td>


            </tr>

        </table>
        <table>
            <h1 style="font-size: 15px;">Pathology</h1>
        </table>
        <table style="width: 100%;">

            <tr>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SL.NO</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Charge-Name</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Base Price</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Gst</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Amount</td>
            </tr>

            <tr>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">1</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"> BCRHH/23040754010 </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">10000</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
            </tr>
        </table>
        <table>
            <h1 style="font-size: 15px;">Radiology</h1>
        </table>
        <table style="width: 100%;">

            <tr>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SL.NO</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Charge-Name</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Base Price</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Gst</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Amount</td>
            </tr>

            <tr>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">1</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"> BCRHH/23040754010 </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">10000</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
            </tr>
        </table>
        <table>
            <h1 style="font-size: 15px;">Medicine</h1>
        </table>
        <table style="width: 100%;">

            <tr>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SL.NO</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Medicine Bill Id</td>

                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Amount</td>
            </tr>

            <tr>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">1</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"> BCRHH/23040754010 </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>

            </tr>
        </table>
        <table>
            <h1 style="font-size: 15px;">Others</h1>
        </table>
        <table style="width: 100%;">

            <tr>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SL.NO</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Charge-Name</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Base Price</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Gst</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Amount</td>
            </tr>

            <tr>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">1</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"> BCRHH/23040754010 </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">10000</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
            </tr>
        </table>
        <!-- =================================================================================================== -->
</div>
</body>

</html>