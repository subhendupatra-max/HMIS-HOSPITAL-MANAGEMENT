<!DOCTYPE html>
<html>
<title>Statement Of Marks</title>
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
                    <img src="./assets/images/1571895010.png " style="width: 600px;">
                </td>
            </tr>

        </table>
        <table style="margin: 10px 0px 0px 0px;">
            <tr>
                <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
                    <b>UHID No. : {{ $patient_details->patient_prefix }}/{{ $patient_details->id }}</b>
                </td>
                <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
                    <img src="{{ asset('public/hospital_details/barcode.png') }}" style="width: 80px;">
                </td>
                <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
                    <img src="{{ asset('public/hospital_details/qr.png') }}" style="width: 80px;">
                </td>
                <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
                    <b>Admission Date : {{ $patient_details->created_at }}</b>
                </td>

            </tr>
            <tr>
                <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;"><b> IPD no. : {{ $ipd_details->ipd_prefix }}/{{ $ipd_details->id }}</b></td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #899499;"><b>Patient Source:{{ $ipd_details->patient_source }} Source Id:{{ $ipd_details->patient_source_id}};</b></td>

            </tr>
        </table>
        <table style="width: 100%; margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Patient Name
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_details->first_name }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Guardian Name
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_details->gurdian_name }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Mobile No.
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_details->phone }}
                </td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Age
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_details->year }}-{{ $patient_details->month }}-{{ $patient_details->day }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Gender
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_details->gender }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Patient Type
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $ipd_details->patient_type }}
                </td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Dr. In Charge
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $ipd_details->doctor_details->first_name }} {{ $ipd_details->doctor_details->last_name }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Ward
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $ipd_details->ward_details->ward_name }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Unit
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $ipd_details->unit_details->unit_name }}
                </td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Department:
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $ipd_details->department_details->department_name }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Floor
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $ipd_details->floor_details->floor_name }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Bed
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $ipd_details->bed_details->bed_name }}
                </td>
            </tr>

        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Address
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_details->address }} {{ $patient_details->state->name }} {{ $patient_details->address }}
                </td>

            </tr>
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Swastya Sathi No.
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $ipd_details->swastya_sathi_no }}
                </td>

            </tr>
        </table>
        <table style="width: 100%; margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Provisional Diagnosis at the time of Admission
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $discharge_details->diagonsis_admission_time  }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Final Diagnosis at time of Discharge
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $patient_details->final_diagonsis_discharge }}
                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Icd-10 Code(s) for Final Diagnosis
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $discharge_details->diagnosis->name  }}
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
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Bmr</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Temperature</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Ratio</td>
            </tr>

            <tr>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">{{ $patient_physicla_condition->height}} </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"> {{ $patient_physicla_condition->weight}}</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
            </tr>
        </table>

        <table style="width: 100%; border-collapse: collapse; margin: 10px 0px 0px 0px;">
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    History of alcoholism,tobacco or substance abuse,if any
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $discharge_details->history_alcoholism  }}
                </td>

            </tr>
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Significant Past Medical and Surgical History ,if any
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $discharge_details->medical_surgical_history  }}
                </td>

            </tr>
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Family History if significant/relevant to diagnosis or treatment
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $discharge_details->family_history_diagnosis  }}
                </td>

            </tr>
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Summary of key investigations during Hospitalization
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $discharge_details->summary_inves_during_hos  }}
                </td>

            </tr>
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Course in the Hspital including complications if any
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $discharge_details->course_complications  }}
                </td>

            </tr>
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Advice on Discharge
                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    {{ $discharge_details->dischage_advice  }}
                </td>

            </tr>
        </table>
    </div>
</body>

</html>