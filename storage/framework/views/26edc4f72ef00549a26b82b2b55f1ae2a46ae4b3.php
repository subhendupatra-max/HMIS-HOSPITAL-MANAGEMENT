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
        <table style="width: 100%;border-collapse: collapse">
            <table>
                <tr style="text-align: center;">
                    <td>
                        <img src="<?php echo e(asset('public/assets/images/header')); ?>/<?php echo e($header_image->logo); ?>" alt=""
                            style="width: 80%;">
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;width:180px">
                        <b>UHID No: বাংলা <?php echo e(@$opd_patient_details->patient_prefix); ?><?php echo e(@$opd_patient_details->patient_id); ?></b>
                    </td>
                    <td
                    style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;width:160px">

                    <b>Date: <?php echo e(@date('d-m-Y h:i A',strtotime($opd_patient_details->appointment_date))); ?></b>
                </td>
                    <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
                        <?php
                        $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                        ?>

                        <img src="data:image/png;base64,<?php echo e(base64_encode($generatorPNG->getBarcode('@$opd_patient_details->patient_prefix @$opd_patient_details->patient_id', $generatorPNG::TYPE_CODE_128))); ?>"
                            style="width: 150px;height: 40px;">
                    </td>
              
                    <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;width:100px"
                     >
                        <b>Ticket No : <?php echo e(@$opd_patient_details->ticket_no); ?></b>
                    </td>
                    
                
                    <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;width:100px"
                        rowspan="2" >
                         <span style="color:#fff "></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
                        <b>OPD No : <?php echo e(@$opd_patient_details->opd_prefix); ?><?php echo e(@$opd_patient_details->opd_id); ?> </b>
                    </td>
                    <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
                        <b>Department: <?php echo e(@$opd_patient_details->department_name); ?></b>
                    </td>
                    <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
                        <b>Case Id: <?php echo e(@$opd_patient_details->case_id); ?></b>
                    </td>
                   
                </tr>
            </table>
            <table style="width: 100%; ;margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Patient Name
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$opd_patient_details->prefix); ?>

                        <?php echo e(@$opd_patient_details->first_name); ?>

                        <?php echo e(@$opd_patient_details->middle_name); ?>

                        <?php echo e(@$opd_patient_details->last_name); ?>

                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Guardian Name
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$opd_patient_details->guardian_name); ?>

                    </td>

                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Patient Mobile No.
                    </th>
                    <td colspan="3"
                        style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$opd_patient_details->phone); ?>

                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Age
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$opd_patient_details->year == '0' ?'':$opd_patient_details->year.'Y'); ?>

                        <?php echo e(@$opd_patient_details->month == '0' ?'':$opd_patient_details->month.'Y'); ?>

                        <?php echo e(@$opd_patient_details->day == '0' ?'':$opd_patient_details->day.'Y'); ?>

                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Gurdian Mobile No.
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$opd_patient_details->guardian_contact_no); ?>

                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Patient Type
                    </th>
                    <td colspan="3"
                        style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$opd_patient_details->patient_type); ?>

                    </td>
                </tr>
                <tr>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Address
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$opd_patient_details->address); ?>,<?php echo e(@$opd_patient_details->district_name); ?>,<br> <?php echo e(@$opd_patient_details->state_name); ?>,<?php echo e(@$opd_patient_details->country_name); ?>,<?php echo e(@$opd_patient_details->pin_no); ?>

                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        Local G Info.
                    </th>
                    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$opd_patient_details->local_guardian_name); ?>,<br><?php echo e(@$opd_patient_details->local_guardian_contact_no); ?>

                    </td>
                    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                       Gender
                    </th>
                    <td colspan="3"
                        style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                        <?php echo e(@$opd_patient_details->gender); ?>

                    </td>
                </tr>
            </table>
            <table
                style="margin: 10px 0px 0px 0px;width: 100%; border-top-style: dotted;border-right-style: dotted;border-left-style: dotted;border-width: 1px;border-collapse: collapse;">
                <tr>
                    <td width="30%"
                        style="border-style: dotted;border-width: 1px;text-align: left;font-size: 13px;padding: 10px 10px 10px 10px; ">
                        <b>Clinical Notes</b>
                    </td>
                    <td width="70%"
                        style="border-style: dotted;border-width: 1px;text-align: left;font-size: 13px;padding: 10px 10px 10px 10px;">

                        <b>Advice</b>

                    </td>
                </tr>
                <tr>
                    <td height="00px" valign="top" style="border-right-style: dotted;border-width: 1px;">
                        <b></b>
                        <div style="height:560px;background:#FFF;"></div>
                        <p
                            style="padding: 10px 0px 7px 10px;margin: 0px;font-size: 13px;">
                            <b>Height -</b>
                        </p>
                        <p style="padding: 7px 0px 7px 10px;margin: 0px;font-size: 13px;">
                            <b>Weight -</b>
                        </p>
                        <p style="padding: 7px 0px 7px 10px;margin: 0px;font-size: 13px;">
                            <b>BP -</b>
                        </p>
                        <p style="padding: 7px 0px 7px 10px;margin: 0px;font-size: 13px;">
                            <b>RR. -</b>
                        </p>
                        <p style="padding: 7px 0px 7px 10px;margin: 0px;font-size: 13px;">
                            <b>Temperature -</b>
                        </p>
                        <p
                            style="padding: 7px 0px 7px 10px;margin: 0px;font-size: 13px; ">
                            <b>&nbsp;SPO<sub>2</sub> -</b>
                        </p>
                        <!-- <hr style="height: 1px; clear: both;margin: 10px 0px 10px 0px;">  -->
                    </td>
                    </td>
                    <td height="00px" valign="top">
                        <img src="<?php echo e(asset('public/hospital_details/rx.png')); ?>" style="width: 30px;">
                    </td>
                </tr>
            </table>
        </table>
        <!-- =================================================================================================== -->
    </div>
</body>

</html><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/OPD/_print/opd_prescription.blade.php ENDPATH**/ ?>