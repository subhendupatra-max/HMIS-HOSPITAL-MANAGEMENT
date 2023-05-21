<!DOCTYPE html>
<html>
<title>IIMSAR & DR.BCRHH, HALDIA</title>
<meta charset="utf-8">

<body>

    <style>
        @page  {
            size: A4 portrait;
            margin: 0;
            / change the margins as you want them to be. /
        }

        @media  print {

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
        <table style="width: 100%; border:1px soild black;border-collapse: collapse">
            <tr style="text-align: center;">
                <td>
                    <img src="<?php echo e(asset('public/hospital_details/header.png')); ?>" alt="" style="width: 80%;">
                </td>
            </tr>
            <tr style="width:100%">
                <td style="width:100%">
                    <h1 style="text-align:center;font-size: 20px;margin: 0px 0px 0px 0px;background: #2a3c92;color: #fff;padding: 15px 0px 15px 0px;  width: 100%;">Patient Bed History</h1>
                </td>
            </tr>
            <table>
                <tr>
                    <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
                        <b>UHID No. :<?php echo e(@$ipd_details->patient_prefix); ?><?php echo e(@$ipd_details->patient_id); ?></b>
                    </td>

                    <?php
                    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                    ?>

                    <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
                        <img src="data:image/png;base64,<?php echo e(base64_encode($generatorPNG->getBarcode('@$ipd_details->ipd_prefix @$ipd_details->patient_id', $generatorPNG::TYPE_CODE_128))); ?>" style="width: 150px;height: 40px;">
                    </td>

                    <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
                        <img src="<?php echo e(asset('public/hospital_details/qr.png')); ?>" style="width: 80px;">
                    </td>
                    <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
                        <b>Admission Date : <?php echo e($ipd_details->appointment_date); ?> PM</b>
                    </td>

                </tr>
                <tr>
                    <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;"><b> IPD no. : <?php echo e(@$ipd_details->ipd_prefix); ?><?php echo e(@$ipd_details->patient_id); ?> </b></td>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #899499;"><b>Patient Source:<?php echo e(@$ipd_details->patient_source); ?> Source Id:<?php echo e(@$ipd_details->patient_source_id); ?>;</b></td>

                </tr>
            </table>
            <table style="width: 100%; margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Patient Name
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$ipd_details->all_patient_details->first_name); ?> <?php echo e(@$ipd_details->all_patient_details->middle_name); ?> <?php echo e(@$ipd_details->all_patient_details->last_name); ?>

                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Guardian Name
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$ipd_details->all_patient_details->guardian_name); ?>

                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Mobile No.
                    </th>
                    <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$ipd_details->all_patient_details->guardian_contact_no); ?>

                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Age
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$ipd_details->all_patient_details->year); ?>-<?php echo e(@$ipd_details->all_patient_details->month); ?>-<?php echo e(@$ipd_details->all_patient_details->day); ?>

                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Gender
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$ipd_details->all_patient_details->gender); ?>

                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Patient Type
                    </th>
                    <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$ipd_details->all_patient_details->patient_type); ?>

                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Dr. In Charge
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$ipd_details->doctor_details->first_name); ?> <?php echo e(@$ipd_details->doctor_details->last_name); ?>

                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Ward
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$ipd_details->ward_details->ward_name); ?>

                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Unit
                    </th>
                    <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$ipd_details->unit_details->bedUnit_name); ?>

                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Department:
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$ipd_details->department_details->department_name); ?>

                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Bed
                    </th>
                    <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$ipd_details->bed_details->bed_name); ?>

                    </td>
                </tr>

            </table>
            <table style="width: 100%; border-collapse: collapse;margin-top:10px">
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Department
                    </th>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Ward - Unit
                    </th>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                      Bed
                    </th>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                      Duration
                    </th>
                </tr>
            </table>

        </table>
        <!-- =================================================================================================== -->

    </div>

</body>

</html><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/ipd/_print/patient_bed_history.blade.php ENDPATH**/ ?>