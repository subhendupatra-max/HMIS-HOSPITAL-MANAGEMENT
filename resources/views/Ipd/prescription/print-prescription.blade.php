<!DOCTYPE html>
<html>
<title>IIMSAR & DR.BCRHH, HALDIA</title>
<meta charset="utf-8">

<script>
    window.print();
</script>

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
            position: relative;
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
            <table>
                <tr>
                    <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
                        <b>UHID No: {{ @$ipd_details->all_patient_details->patient_prefix}}{{ @$ipd_details->all_patient_details->id}}</b>
                    </td>
                    <td rowspan="2" style="text-align: center;border: 1px solid #899499;width:250px">
                        <!-- <img src="{{ asset('public/hospital_details/barcode.png') }}" style="width: 80px;"> -->
                        @php
                        $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                        @endphp

                        <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode('@$ipd_details->ipd_prefix @$ipd_details->ipd_id', $generatorPNG::TYPE_CODE_128)) }}" style="width: 150px;height:50px">
                    </td>
                    <td rowspan="2" style="text-align: center;border: 1px solid #899499;width:75px">
                        <!-- <img src="{{ asset('public/hospital_details/qr.png') }}" style="width: 80px;"> -->
                        <?php
                        $ipd_de = $ipd_details->ipd_prefix . '' . $ipd_details->ipd_id;
                        ?>
                        <span style="width: 60px;height:60px">{!! QrCode::size(60)->generate($ipd_de); !!} </span>
                    </td>
                    <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">

                        <b>Date: {{ @$ipd_details->appointment_date}}</b>
                    </td>
                    <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
                        <b>Cons. Doctor: {{ @$ipd_details->doctor_details->first_name}} {{ @$ipd_details->doctor_details->last_name}}</b>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;"><b>IPD No : {{ @$ipd_details->ipd_prefix}}{{ @$ipd_details->id}} </b></td>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #899499;"><b>Patient Source:{{ $ipd_details->patient_source }} Source Id:{{ $ipd_details->patient_source_id}}</b></td>
                    <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;"><b>Department: {{ @$ipd_details->department_details->department_name}}</b></td>
                </tr>
            </table>
            <table style="width: 100%; ;margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Patient Name
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{ @$ipd_details->all_patient_details->first_name}} {{ @$ipd_details->all_patient_details->middle_name}} {{ @$ipd_details->all_patient_details->last_name}}
                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Guardian Name
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{ @$ipd_details->all_patient_details->guardian_name}}
                    </td>

                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Mobile No.
                    </th>
                    <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{ @$ipd_details->all_patient_details->phone}}
                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Age
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{ @$ipd_details->all_patient_details->year}}Y {{ @$ipd_details->all_patient_details->first_name}}M {{ @$ipd_details->all_patient_details->first_name}}D
                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Gender
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{ @$ipd_details->all_patient_details->gender}}
                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Patient Type
                    </th>
                    <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{ @$ipd_details->patient_type}}
                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Address
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{ @$ipd_details->all_patient_details->address}}, {{ @$ipd_details->all_patient_details->_state->name}}, {{ @$ipd_details->all_patient_details->_district->name}}
                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Blood Group
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        {{ @$ipd_details->all_patient_details->blood_group}}
                    </td>

                </tr>
            </table>
            <table style="margin: 10px 0px 0px 0px;width: 100%; border-top-style: dotted;border-right-style: dotted;border-left-style: dotted;border-width: 1px;border-collapse: collapse;">
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
                        <div style="background:#FFF;margin-left:6px">
                            Medicine:
                            @if (isset($EPrescriptionMedicine[0]->medicine_id))
                            @foreach ($EPrescriptionMedicine as $value)

                            <h5>
                                <li> {{$value->medicine_details->medicine_name}} {{$value->dose}} {{$value->interval}} {{$value->duration}}</li>
                            </h5>
                            @endforeach
                            @endif
                        </div>
                        <div style="background:#FFF;margin-left:6px">
                            Pathology:
                            @if (isset($EPresPathologyTest[0]->test_id))
                            @foreach ($EPresPathologyTest as $value)

                            <h5>
                                <li> {{$value->test_details->test_name}} </li>
                            </h5>
                            @endforeach
                            @endif
                        </div>
                        <div style="background:#FFF;margin-left:6px">
                            Radiology:
                            @if (isset($EPresRadiologyTest[0]->test_id))
                            @foreach ($EPresRadiologyTest as $value)

                            <h5>
                                <li> {{$value->test_details_radiology->test_name}}</li>
                            </h5>
                            @endforeach
                            @endif
                        </div>
                        <p style="border-top: 1px solid #899499;padding: 10px 0px 7px 10px;margin: 0px;font-size: 13px;">
                            <b>Height -</b>
                        </p>
                        <p style="border-top: 1px solid #899499;padding: 7px 0px 7px 10px;margin: 0px;font-size: 13px;">
                            <b>Weight -</b>
                        </p>
                        <p style="border-top: 1px solid #899499;padding: 7px 0px 7px 10px;margin: 0px;font-size: 13px;">
                            <b>BP -</b>
                        </p>
                        <p style="border-top: 1px solid #899499;padding: 7px 0px 7px 10px;margin: 0px;font-size: 13px;">
                            <b>RR. -</b>
                        </p>
                        <p style="border-top: 1px solid #899499;padding: 7px 0px 7px 10px;margin: 0px;font-size: 13px;">
                            <b>Temperature -</b>
                        </p>
                        <p style="border-top: 1px solid #899499;padding: 7px 0px 7px 10px;margin: 0px;font-size: 13px; ">
                            <b>&nbsp;SPO<sub>2</sub> -</b>
                        </p>
                        <!-- <hr style="height: 1px; clear: both;margin: 10px 0px 10px 0px;">  -->
                    </td>
                    </td>
                  
                    <td height="00px" valign="top">
                        <img src="{{ asset('public/hospital_details/rx.png') }}" style="width: 80px;">
                    </td>
                </tr>
            </table>
        </table>
       <table style="width: 100%;">
        
       <tr>
       <td style="position: fixed; right: 20px; bottom: 15px;">
        <b>Date:</b> {{$ipdPrescription->prescription_date}}
        </td>
       </tr>
       </table>
        <!-- =================================================================================================== -->
    </div>
   
</body>

</html>