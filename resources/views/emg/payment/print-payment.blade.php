<!DOCTYPE html>
<html>
<title>IIMSAR & DR.BCRHH, HALDIA</title>
<meta charset="utf-8">

<body>
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
                height: 33cm;
                ;
                margin: 0 !important;
                padding: 5px !important;
                overflow: hidden;
            }
        }

        body {
            font-family: sans-serif;
            background: #ffffff;
            margin: 0 auto;
            height: 33cm;
            ;
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
        <table style="width: 100%;border-collapse: collapse">
            <tr style="text-align: center;">
                <td>
                    <!-- <img src="{{ asset('public/hospital_details/header.png') }}" alt="" style="width: 80%;"> -->
                    <img src="{{ asset('public/assets/images/header') }}/{{$header_image->logo}}" alt="" style="width: 80%;">
                </td>
            </tr>

            <tr style="width:100%">
                <td style="width:100%">
                    <h1 style="text-align:center;font-size: 20px;margin: 0px 0px 0px 0px;background: white;color: black;padding: 15px 0px 15px 0px;  width: 100%;">Payment COPY</h1>
                </td>
            </tr>
            <table>
                <tr>
                    <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
                        <b>UHID No: {{@$emg_patient_details->all_patient_details->patient_prefix}}{{@$emg_patient_details->all_patient_details->id}}</b>
                    </td>
                    <td rowspan="2" style="text-align: center;border: 1px solid #899499;width:270px;">
                        <!-- <img src="{{ asset('public/hospital_details/barcode.png') }}" style="width: 80px;"> -->
                        @php
                        $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                        @endphp

                        <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode('@$emg_patient_details-all_patient_details->>patient_prefix @$emg_patient_details->all_patient_details->patient_id', $generatorPNG::TYPE_CODE_128)) }}" style="width: 170px;height: 50px;">
                    </td>
                    <td rowspan="2" style="text-align: center;border: 1px solid #899499;width:260px;">
                        <!-- <img src="{{ asset('public/hospital_details/qr.png') }}" style="width: 80px;"> -->

                        <?php
                        $emg_de = $emg_patient_details->emg_prefix . '' . $emg_patient_details->id;
                        ?>
                        <!-- <img src="{{ asset('public/hospital_details/qr.png') }}" style="width: 80px;"> -->
                        <span style="width: 60px;height:60px">{!! QrCode::size(55)->generate($emg_de); !!} </span>
                    </td>
                    <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
                        <b>Appointment Date: {{@$emg_patient_details->all_emg_visit_details->appointment_date}}</b>
                    </td>


                </tr>


                <tr>
                    <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;"><b> EMG no. {{@$emg_patient_details->emg_prefix}}{{@$emg_patient_details->id}} </b></td>
                    <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;"><b> Medico Legal Case: {{@$emg_patient_details->all_emg_visit_details->medico_legal_case}} </b></td>

                </tr>

            </table>
            <table style="width: 100%; margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Patient Name
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->all_patient_details->first_name}} {{@$emg_patient_details->all_patient_details->middle_name}}
                        {{@$emg_patient_details->all_patient_details->last_name}}
                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Guardian Name
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->all_patient_details->gurdaian_name}}
                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Mobile No.
                    </th>
                    <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->all_patient_details->phone}}
                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Age
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->all_patient_details->year}}Y {{@$emg_patient_details->all_patient_details->month}}M {{@$emg_patient_details->all_patient_details->day}}D
                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Gender
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->all_patient_details->gender}}
                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Patient Type
                    </th>
                    <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->all_emg_visit_details->patient_type}}
                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Dr. In Charge
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->all_emg_visit_details->doctor->first_name}} {{@$emg_patient_details->all_emg_visit_details->doctor->last_name}}
                    </td>
                    <!-- <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Ward
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        ENT Male
                    </td> -->
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Unit
                    </th>
                    <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->all_emg_visit_details->unit}}
                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Department:
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->all_emg_visit_details->patient_department_details->department_name}}
                    </td>
                    <!-- <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Floor
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        3rd Floor
                    </td> -->
                    <!-- <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Bed
                    </th>
                    <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        ENT-M-01-0006
                    </td> -->
                </tr>

            </table>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Address
                    </th>
                    <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->all_patient_details->address}},{{@$emg_patient_details->all_patient_details->_state->name}},
                        {{@$emg_patient_details->all_patient_details->_district->name}},
                        {{@$emg_patient_details->all_patient_details->pin_no}}
                    </td>

                </tr>
                @if(@$emg_patient_details->all_emg_visit_details->patient_type == 'Swasthya Sathi' || @$emg_patient_details->all_emg_visit_details->patient_type == 'TPA' )
                <tr>
                    <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        @if(@$emg_patient_details->all_emg_visit_details->patient_type == 'Swasthya Sathi')
                        Swasthya Sathi No.
                        @elseif(@$emg_patient_details->all_emg_visit_details->patient_type == 'TPA')
                        TPA {{@$emg_patient_details->tpa_details->TPA_name}}
                        @endif
                    </th>
                    <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->tpa_details->type_no}}
                    </td>

                </tr>
                @endif

            </table>
            <!-- <table style="width: 100%;">

                <tr>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SL.NO</td>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Charge-Name</td>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Tax</td>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Charge Amount</td>
                </tr>

                <tr>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">1</td>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"> BCRHH/23040754010 </td>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">10000</td>
                </tr>
            </table> -->
            <!-- <table style="width: 100%; margin: 0px 0px 0px 0px; border-collapse: collapse; border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;">
                <tr>
                    <th style="text-align: right;font-size: 13px; padding: 5px 0px 5px 0px;">Total :</th>
                    <td style="text-align: right;font-size: 13px; width:90px;padding: 0px 10px 0px 0px; ">10000</td>
                </tr>
                <tr>
                    <th style="text-align: right;font-size: 13px;padding: 5px 0px 5px 0px; ">Tax :</th>
                    <td style="text-align: right;font-size: 13px;padding: 0px 10px 0px 0px; ">100</td>
                </tr>
                <tr>
                    <th style="text-align: right;font-size: 13px;padding: 5px 0px 5px 0px; ">Discount :</th>
                    <td style="text-align: right;font-size: 13px;padding: 0px 10px 0px 0px; ">50</td>
                </tr>
                <tr>
                    <th style="text-align: right;font-size: 13px; padding: 5px 0px 5px 0px;">Grand Total :</th>
                    <td style="text-align: right;font-size: 13px; padding: 0px 10px 0px 0px;">10050</td>
                </tr>
            </table> -->
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
                        {{@$emgPaymentDetails->payment_date }}
                    </td>

                    <th style="text-align: left;font-size: 13px; ">
                        Payment Amount:
                    </th>
                    <td style="text-align: right;font-size: 13px; padding: 0px 10px 0px 0px;">
                        {{@$emgPaymentDetails->payment_amount }}
                    </td>
                </tr>


                <tr>
                    <th style="text-align: left;font-size: 13px;padding: 10px 10px 10px 10px;">
                        Payment Received By:
                    </th>
                    <td style="text-align: left;font-size: 13px;">
                        {{@$emgPaymentDetails->generated_by->first_name }} {{@$emgPaymentDetails->generated_by->last_name }}
                    </td>
                    <th style="text-align: left;font-size: 13px;">
                        Payment Mode:
                    </th>
                    <td style="text-align: right;font-size: 13px; padding: 0px 10px 0px 0px;">
                        {{@$emgPaymentDetails->payment_mode }}
                    </td>

                </tr>
                <!-- <tr>
                    <th style="text-align: left;font-size: 13px; ">
                        Payment Received By:
                    </th>
                    <td style="text-align: right;font-size: 13px; padding: 0px 10px 0px 0px;">
                        {{@$emgPaymentDetails->payment_recived_by }}
                    </td>
                </tr> -->
            </table>
        </table>
        <!-- ==========================================code here================================== -->
    </div>
</body>

</html>