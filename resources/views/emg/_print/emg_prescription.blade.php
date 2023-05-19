<!DOCTYPE html>
<html>
<title>IIMSAR & DR.BCRHH, HALDIA</title>
<meta charset="utf-8">

<body>

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
    <script type="text/javascript"> try { this.print(); } catch (e) { window.onload = window.print; } </script>

    <div style="padding: 0px 7px 0px 7px;">
        <!-- ==========================================code here================================== -->
        <table style="width: 100%;border-collapse: collapse">
            <tr style="text-align: center;">
                <td>
                    <img src="{{ asset('public/assets/images/header') }}/{{$header_image->logo}}" alt="" style="width: 80%;">
                </td>
            </tr>
            <table>
                <tr>
                    <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;width: 200px;">
                        <b>UHID No: {{ @$emg_patient_details->patient_prefix }}{{ @$emg_patient_details->patient_id }}</b>
                    </td>
                    <td rowspan="2" style="text-align: center;border: 1px solid #899499;width: 130px;">
                        @php
                        $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                        @endphp
                        <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode('@$emg_patient_details->patient_prefix @$emg_patient_details->patient_id', $generatorPNG::TYPE_CODE_128)) }}" style="width: 120px;height: 40px;">
                    </td>
                
                    <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;width: 180px;">
                        <b>Date: {{$emg_patient_details->appointment_date}}</b>
                    </td>
                    <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;width: 200px;">
                        <b>Cons. Doctor: {{@$emg_patient_details->doctor_first_name}}{{@$emg_patient_details->doctor_last_name}}</b>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;"><b>EMG No : {{@$emg_patient_details->emg_prefix}}{{@$emg_patient_details->emg_id}}</b></td>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #899499;"><b>Medico Legal Case: {{@$emg_patient_details->medico_legal_case}}</b></td>
                    <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;width: 200px;"><b>Department: {{@$emg_patient_details->department_name}}</b></td>
                </tr>
            </table>
            <table style="width: 100%; ;margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Patient Name
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->first_name}}
                        {{@$emg_patient_details->middle_name}}
                        {{@$emg_patient_details->last_name}}
                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Guardian Name
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->guardian_name}}
                    </td>

                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Mobile No.
                    </th>
                    <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->guardian_contact_no}}
                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Age
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{ @$emg_patient_details->year == '0'?'':$emg_patient_details->year.'y' }}
                        {{ @$emg_patient_details->month == '0'?'':$emg_patient_details->month.'m' }}
                        {{ @$emg_patient_details->day == '0'?'':$emg_patient_details->day.'d' }}
                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Gender
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->gender}}
                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Patient Type
                    </th>
                    <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->patient_type}}
                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Address
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->address}}
                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Blood Group
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->blood_group}}
                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Ticket Fees:
                    </th>
                    <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{@$emg_patient_details->ticket_fees}}
                    </td>
                </tr>
            </table>
            <table style="margin: 10px 0px 0px 0px;width: 100%; border-top-style: dotted;border-right-style: dotted;border-bottom: 1px dotted #000;border-left-style: dotted;border-width: 1px;border-collapse: collapse;">
                <tr>
                    <td width="50%" style="border-style: dotted;border-width: 1px;text-align: left;font-size: 13px;padding: 10px 10px 10px 10px; ">
                        <b>Clinical Notes</b>
                    </td>
                    <td width="50%" style="border-style: dotted;border-width: 1px;text-align: left;font-size: 13px;padding: 10px 10px 10px 10px;">

                        <b>Advice</b>

                    </td>
                </tr>
                <tr>
                    <td height="00px" valign="top" style="border-right-style: dotted;border-width: 1px;">
                        <b></b>
                        <div style="height:560px;background:#FFF;"></div>
                        <p style="border-top: 1px solid #899499;padding: 10px 0px 7px 10px;margin: 0px;font-size: 13px;">
                            <b>Height - </b>
                        </p>
                        <p style="border-top: 1px solid #899499;padding: 7px 0px 7px 10px;margin: 0px;font-size: 13px;">
                            <b>Weight - </b>
                        </p>
                        <p style="border-top: 1px solid #899499;padding: 7px 0px 7px 10px;margin: 0px;font-size: 13px;">
                            <b>BP - </b>
                        </p>
                        <p style="border-top: 1px solid #899499;padding: 7px 0px 7px 10px;margin: 0px;font-size: 13px;">
                            <b>RR. - </b>
                        </p>
                        <p style="border-top: 1px solid #899499;padding: 7px 0px 7px 10px;margin: 0px;font-size: 13px;">
                            <b>Temperature - </b>
                        </p>
                        <p style="border-top: 1px solid #899499;padding: 7px 0px 7px 10px;margin: 0px;font-size: 13px; ">
                            <b>&nbsp;SPO<sub>2</sub> -</b>
                        </p>
                        <!-- <hr style="height: 1px; clear: both;margin: 10px 0px 10px 0px;">  -->
                    </td>
                    </td>
                    <td height="00px" valign="top">
                        <img src="{{ asset('public/hospital_details/rx.png') }}" style="width: 30px;">
                    </td>
                </tr>
            </table>
        </table>
        <!-- =================================================================================================== -->
    </div>
</body>

</html>