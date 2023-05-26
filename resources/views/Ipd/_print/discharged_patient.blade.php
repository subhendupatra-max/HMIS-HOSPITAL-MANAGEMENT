<!DOCTYPE html>
<html>
<title>Statement Of Marks</title>
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
        }

        tr {
            width: 100%;
            height: auto;
        }
    </style>

    <div style="padding: 0px 7px 0px 7px;">
        <table style="width: 100%;">
            <tr style="text-align: center;">
                <td>
                    <!-- <img src="./assets/images/1571895010.png " style="width: 600px;"> -->
                    <img src="{{ asset('public/assets/images/header') }}/{{$header_image->logo}}" alt="" style="width: 80%;">
                </td>
            </tr>

        </table>
        <table style="margin: 10px 0px 0px 0px;">
            <tr>
                <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;width:280px">
                    <b>UHID No. : {{ $patient_discharge_details->ipd_prefix }}{{ $patient_discharge_details->ipd_id }}</b>
                </td>
                <td rowspan="2" style="text-align: center;border: 1px solid #899499;width: 250px;height:60px">
                    <!-- <img src="{{ asset('public/hospital_details/barcode.png') }}" style="width: 80px;"> -->

                    @php
                    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                    @endphp

                    <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode('@$patient_discharge_details->ipd_prefix @$patient_discharge_details->ipd_id', $generatorPNG::TYPE_CODE_128)) }}" style="width: 150px;height:60px">
                </td>
                <td rowspan="2" style="text-align: center;border: 1px solid #899499;width: 70px;height:70px">
                    <?php
                    $ipd_de = $patient_discharge_details->ipd_prefix . '' . $patient_discharge_details->ipd_id;
                    ?>


                    <!-- <img src="{{ asset('public/hospital_details/qr.png') }}" style="width: 80px;"> -->
                    <span style="width: 60px;height:60px">{!! QrCode::size(90)->generate($ipd_de); !!} </span>
                    <!-- <img src="{{public_path().'/qr/'.$patient_discharge_details->ipd_prefix}}" style="width:70px; height: 85px;position: absolute;right: 0px;top:10px; border: 2px solid #d3d1d1; padding: 4px;"> -->

                </td>
                <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;width:280px">
                    <b>Admission Date : {{ $patient_discharge_details->appointment_date }}</b>
                </td>

            </tr>
            <tr>
                <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;"><b> IPD no. : {{ $patient_discharge_details->ipd_prefix }}/{{ $patient_discharge_details->ipd_id }}</b></td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #899499;"><b>Patient Source:{{ $patient_discharge_details->patient_source }} Source Id:{{ $patient_discharge_details->patient_source_id}}</b></td>

            </tr>
        </table>
        <table style="width: 100%; margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Patient Name
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->first_name }} {{ $patient_discharge_details->middle_name }} {{ $patient_discharge_details->last_name }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Guardian Name
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->guardian_name }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Mobile No.
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->phone }}
                </td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Age
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->year }}-{{ $patient_discharge_details->month }}-{{ $patient_discharge_details->day }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Gender
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->gender }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Patient Type
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->patient_type }}
                </td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Dr. In Charge
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->doctor_first_name }} {{ $patient_discharge_details->doctor_last_name }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Ward
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->wardname }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Unit
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->bedUnit_name }}
                </td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Department:
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->department_name }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Floor
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Floor name
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Bed
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->bed_name }}
                </td>
            </tr>

        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Address
                </th>

                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->address }} {{ $patient_discharge_details->state_name }} {{ $patient_discharge_details->district_name }}
                </td>

            </tr>
            @if($patient_discharge_details->patient_type == 'Swasthya Sathi' || $patient_discharge_details->patient_type == 'TPA' )
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">

                    @if($patient_discharge_details->patient_type == 'Swasthya Sathi')
                    Swasthya Sathi No.
                    @elseif($patient_discharge_details->patient_type == 'TPA')
                    TPA {{$patient_discharge_details->TPA_name}}
                    @endif

                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{@$ipd_details->type_no}}
                </td>

            </tr>
            @endif
        </table>
        <table style="width: 100%; margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Provisional Diagnosis at the time of Admission
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->diagonsis_admission_time }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Final Diagnosis at time of Discharge
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->final_diagonsis_discharge }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Icd-10 Code(s) for Final Diagnosis
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->diagonasis_name  }}
                </td>
            </tr>

        </table>

        <table style="width:  20%;der-collapse: collapse;padding: 0px 0px 0px 0px;">
            <tr style="">
                <td style="width:100%">
                    <h1 style="text-align:center;font-size: 15px ;margin: : 0px 0px 0px 0px; padding: 0px 0px 0px 0px; width: 100%;color: #000;">Physical Condition</h1>
                </td>
            </tr>
        </table>

        <table style="width: 100%; margin: 10px 0px 0px 0px;">

            <tr>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Height</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Weight</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">bp</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Temperature</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Respiration</td>
            </tr>

            <tr>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ $patient_discharge_details->height}} </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"> {{ $patient_discharge_details->weight}}</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ $patient_discharge_details->bp}}</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ $patient_discharge_details->temperature}}</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ $patient_discharge_details->respiration}}</td>
            </tr>
        </table>

        <table style="width: 100%; border-collapse: collapse; margin: 10px 0px 0px 0px;">
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    History of alcoholism,tobacco or substance abuse,if any
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->history_alcoholism  }}
                </td>

            </tr>
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Significant Past Medical and Surgical History ,if any
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->medical_surgical_history  }}
                </td>

            </tr>
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Family History if significant/relevant to diagnosis or treatment
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->family_history_diagnosis  }}
                </td>

            </tr>

        </table>
        <table style="width: 100%; border-collapse: collapse; margin: 10px 0px 0px 0px;">
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Summary of key investigations during Hospitalization
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->summary_inves_during_hos  }}
                </td>

            </tr>
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Course in the Hspital including complications if any
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->course_complications  }}
                </td>

            </tr>
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Advice on Discharge
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_discharge_details->dischage_advice  }}
                </td>

            </tr>
        </table>
    </div>
</body>

</html>