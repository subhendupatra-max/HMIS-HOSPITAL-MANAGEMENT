<!DOCTYPE html>
<html lang="en">

<head>
    <title>Draft Bill</title>

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
      <!-- ==============================draft copy============================================ -->
  <div
  style="position: absolute; left: 50%; top: 50%; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%);">
  <h2
    style="font-size: 70px; letter-spacing: 2px; text-transform: uppercase; transform: rotate(322deg); color: #9191912b;">
    Draft Copy
  </h2>
</div>
<!-- ==============================draft copy============================================ -->
    <!-- ==========================================code here================================== -->
    <table style="width: 100%; border:1px soild black;border-collapse: collapse">
        <tr style="text-align: center;">
            <td>
                <img src="{{ asset('public/assets/images/header') }}/{{$header_image->logo}}" alt=""
                    style="width: 100%;">
            </td>
        </tr>
        <tr style="width:100%">
            <td style="width:100%">
                <h1
                    style="text-align:center;font-size: 20px;margin: 10px 0px 10px 0px; color: #000;padding: 5px 0px 5px 0px;  width: 100%;">
                    Draft Bill</h1>
            </td>
        </tr>
        <table style="width: 100%;">
            <tr>
                <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
                    <b>UHID No. :
                        {{$ipd_details->all_patient_details->patient_prefix}}/{{$ipd_details->all_patient_details->id}}</b>
                </td>
                <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
                    <!-- <img src="./image/qr.png" style="width: 80px;"> -->
                    <?php
        $ipd_de = $ipd_details->ipd_prefix . '' . $ipd_details->ipd_id;
        ?>

                    <span style="width: 80px;height:60px">{!! QrCode::size(90)->generate($ipd_de); !!} </span>
                </td>
                <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
                    <!-- <img src="./image/barcodee.png" style="width: 80px;"> -->
                    @php
                    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                    @endphp

                    <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode('@$ipd_details->ipd_prefix @$ipd_details->ipd_id', $generatorPNG::TYPE_CODE_128)) }}"
                        style="width: 190px;height:60px">
                </td>
                <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
                    <b>Admission Date : {{$ipd_details->appointment_date}}</b>
                </td>

            </tr>
            <tr>
                <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;"><b>
                        IPD no.
                        : {{$ipd_details->ipd_prefix}}/{{$ipd_details->id}}</b></td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #899499;">
                    <b>Patient
                        Source:{{$ipd_details->patient_source}} Source Id:{{$ipd_details->patient_source_id}};</b></td>

            </tr>
        </table>
        <table style="width: 100%; margin: 15px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Patient Name
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$ipd_details->all_patient_details->first_name}}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Guardian Name
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$ipd_details->all_patient_details->guardian_name}}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Mobile No.
                </th>
                <td colspan="3"
                    style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$ipd_details->all_patient_details->phone}}
                </td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Age
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$ipd_details->all_patient_details->year}}Y {{$ipd_details->all_patient_details->month}}M
                    {{$ipd_details->all_patient_details->day}}D
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Gender
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$ipd_details->all_patient_details->gender}}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Patient Type
                </th>
                <td colspan="3"
                    style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$ipd_details->patient_type}}
                </td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Dr. In Charge
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$ipd_details->doctor_details->first_name}} {{$ipd_details->doctor_details->last_name}}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Ward
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$ipd_details->ward_details->ward_name}}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Unit
                </th>
                <td colspan="3"
                    style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$ipd_details->unit_details->bedUnit_name}}
                </td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Department:
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$ipd_details->department_details->department_name}}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Floor
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    3rd Floor
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Bed
                </th>
                <td colspan="3"
                    style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$ipd_details->bed_details->bed_name}}
                </td>
            </tr>

        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <th colspan="3"
                    style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Address
                </th>
                <td colspan="7"
                    style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$ipd_details->all_patient_details->address}},{{$ipd_details->all_patient_details->_state->name}},{{$ipd_details->all_patient_details->_district->name}},{{$ipd_details->all_patient_details->pin_no}}
                </td>

            </tr>
            @if($ipd_details->patient_type == 'Swasthya Sathi' || $ipd_details->patient_type == 'TPA' )
            <tr>
                <th colspan="3"
                    style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    @if($ipd_details->patient_type == 'Swasthya Sathi')
                    Swasthya Sathi No.
                    @elseif($ipd_details->patient_type == 'TPA')
                    TPA {{$ipd_details->tpa_details->TPA_name}}
                    @endif

                </th>
                <td colspan="7"
                    style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{$ipd_details->type_no}}
                </td>

            </tr>
            @endif

        </table>
        <table style="width: 100%;margin:10px 0px 0px 0px">
            <tr>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SL.NO
                </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Date</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Category</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Charge Name
                </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Price
                </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">CGST
                </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SGST
                </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">IGST
                </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Amount(Rs)</td>
            </tr>
            <?php $total = 0 ; ?>
            @if (@$patient_charges)
            @foreach ($patient_charges as $value)
            <?php $total += $value->amount ; ?>
            <tr>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{$loop->iteration}}
                </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @date('d-m-Y h:i A', strtotime($value->charges_date)) }} </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->charges_category_details->charges_catagories_name }}
                </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->charge_details->charges_name }}
                </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->standard_charges }}
                </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->cgst }}
                </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->sgst }}
                </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->igst }}
                </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->amount }}
                </td>
            </tr>
            @endforeach
            @endif
        </table>

        <table>
            <h1 style="font-size: 15px;">Medicine</h1>
        </table>
        <table style="width: 100%;">
            <tr>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SL.NO
                </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Medicine Bill Id</td>

                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Amount(Rs)</td>
            </tr>
            @if (@$medicine)
            @foreach ($medicine as $value)
            <?php $total += $value->amount ; ?>
            <tr>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{$loop->iteration}}
                </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->bill_prefix }}{{ @$value->id }} </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ @$value->total_amount }}
                </td>

            </tr>
            @endforeach
            @endif
        </table>
        <table>
            <h1 style="font-size: 20px;">  Total :  {{ @$total.' Rs' }} </h1>
        </table>
  

        <!-- =================================================================================================== -->
</div>
</body>

</html>