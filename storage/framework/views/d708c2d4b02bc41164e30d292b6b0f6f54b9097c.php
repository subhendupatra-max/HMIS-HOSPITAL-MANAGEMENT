<!DOCTYPE html>
<html>
<title>Statement Of Marks</title>
<meta charset="utf-8">
<script>
    window.print();
</script>

<body>

    <style>
        @media  print {
            .pagebreak {
                page-break-before: always;
            }

            / page-break-after works,
            as well /
        }

        @page  {
            size: A4 portrait;
            margin: 0;
            / change the margins as you want them to be. /
        }

        @media  print {

            html,
            body {
                width: 25cm;
              
                margin: 0 !important;
                padding: 5px !important;
                overflow: hidden;
            }

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
        <table style="width: 100%;">
            <tr style="text-align: center;">
                <td>
                    <!-- <img src="./assets/images/1571895010.png " style="width: 600px;"> -->
                    <img src="<?php echo e(asset('public/assets/images/header')); ?>/<?php echo e($header_image->logo); ?>" alt="" style="width: 80%;">
                </td>
            </tr>

        </table>
        <table style="margin: 10px 0px 0px 0px;">
            <tr>
                <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;width:280px">
                    <b>UHID No. : <?php echo e(@$patient_discharge_details->patient_details->patient_prefix); ?><?php echo e(@$patient_discharge_details->patient_details->id); ?></b>
                </td>
                <td rowspan="2" style="text-align: center;border: 1px solid #899499;width: 250px;height:60px">
                    <!-- <img src="<?php echo e(asset('public/hospital_details/barcode.png')); ?>" style="width: 80px;"> -->

                    <?php
                    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                    ?>

                    <img src="data:image/png;base64,<?php echo e(base64_encode($generatorPNG->getBarcode('@$ipd_details->ipd_prefix @$ipd_details->id', $generatorPNG::TYPE_CODE_128))); ?>" style="width: 150px;height:60px">
                </td>
                <td rowspan="2" style="text-align: center;border: 1px solid #899499;width: 70px;height:70px">
                    <?php
                    $ipd_de = $ipd_details->ipd_prefix . '' . $ipd_details->id;
                    ?>


                    <!-- <img src="<?php echo e(asset('public/hospital_details/qr.png')); ?>" style="width: 80px;"> -->
                    <span style="width: 60px;height:60px"><?php echo QrCode::size(90)->generate($ipd_de); ?> </span>
                    <!-- <img src="<?php echo e(public_path().'/qr/'.$patient_discharge_details->ipd_prefix); ?>" style="width:70px; height: 85px;position: absolute;right: 0px;top:10px; border: 2px solid #d3d1d1; padding: 4px;"> -->

                </td>
                <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;width:280px">
                    <b>Admission Date : <?php echo e(@$ipd_details->appointment_date); ?></b>
                </td>

            </tr>

            <tr>
                <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;"><b> IPD no. : <?php echo e(@$ipd_details->ipd_prefix); ?><?php echo e(@$ipd_details->id); ?></b></td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #899499;"><b>Discharge Date:<?php echo e($patient_discharge_details->discharge_date); ?>  <br> Discharge Status:<?php echo e($patient_discharge_details->discharge_status); ?></b></td>

            </tr>
        </table>
        <table style="width: 100%; margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Patient Name
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e($patient_discharge_details->patient_details->first_name); ?> <?php echo e($patient_discharge_details->patient_details->middle_name); ?> <?php echo e($patient_discharge_details->patient_details->last_name); ?>

                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Guardian Name
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e($patient_discharge_details->patient_details->guardian_name); ?>

                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Mobile No.
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e($patient_discharge_details->patient_details->phone); ?>

                </td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Age
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e($patient_discharge_details->patient_details->year); ?>-<?php echo e($patient_discharge_details->patient_details->month); ?>-<?php echo e($patient_discharge_details->patient_details->day); ?>

                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Gender
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e($patient_discharge_details->patient_details->gender); ?>

                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Patient Type
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e($ipd_details->patient_type); ?>

                </td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Dr. In Charge
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e($patient_discharge_details->doctor_details->doctor_first_name); ?> <?php echo e($patient_discharge_details->doctor_details->doctor_last_name); ?>

                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Ward
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e($ipd_details->ward_details->ward_name); ?>

                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Unit
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e($ipd_details->unit_details->bedUnit_name); ?>

                </td>
            </tr>
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Department:
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e($ipd_details->department_details->department_name); ?>

                </td>
                <!-- <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Floor
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Floor name
                </td> -->
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Bed
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e($ipd_details->bed_details->bed_name); ?>

                </td>
            </tr>

        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Address
                </th>

                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e($patient_discharge_details->patient_details->address); ?> <?php echo e($patient_discharge_details->patient_details->_state->name); ?> <?php echo e($patient_discharge_details->patient_details->_district->name); ?>

                </td>

            </tr>
            <?php if($ipd_details->patient_type == 'Swasthya Sathi' || $ipd_details->patient_type == 'TPA' ): ?>
            <tr>
                <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">

                    <?php if($ipd_details->patient_type == 'Swasthya Sathi'): ?>
                    Swasthya Sathi No.
                    <?php elseif($ipd_details->patient_type == 'TPA'): ?>
                    TPA <?php echo e($ipd_details->TPA_name); ?>

                    <?php endif; ?>

                </th>
                <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e(@$ipd_details->type_no); ?>

                </td>

            </tr>
            <?php endif; ?>
        </table>
        <table style="width: 100%; margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 20px 10px 20px 10px;border: 1px solid #000;">
                    Provisional Diagnosis at the time of Admission
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e(@$ipd_details->admissionTimeDiagnosis->diagonasis_name); ?>

                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Final Diagnosis at time of Discharge
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e(@$patient_discharge_details->diagnosis_details->diagonasis_name); ?>

                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Icd-10 Code(s) for Final Diagnosis
                </th>
                <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e(@$patient_discharge_details->diagnosis_details->icd_code); ?>

                </td>
            </tr>

        </table>
        <table style="width: 100%; margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
            <tr>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Next Consultant Date
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e(@$patient_discharge_details->next_appointment_date); ?>

                </td>
                <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    Consultant Doctor
                </th>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                    <?php echo e(@$patient_discharge_details->doctor_details->first_name); ?> <?php echo e(@$patient_discharge_details->doctor_details->last_name); ?>

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
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><?php echo e(@$patient_discharge_details->height); ?> </td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"> <?php echo e(@$patient_discharge_details->weight); ?></td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><?php echo e(@$patient_discharge_details->bp); ?></td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><?php echo e(@$patient_discharge_details->temperature); ?></td>
                <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><?php echo e(@$patient_discharge_details->respiration); ?></td>
            </tr>
        </table>

        <table style="width: 100%; border-collapse: collapse; margin: 10px 0px 0px 0px;">
            <tr>
                <th colspan="3" style="text-align: left;font-size: 13px; padding: 25px 10px 25px 10px;border: 1px solid #000;">
                    History of alcoholism,tobacco or substance abuse,if any
                </th>
                <td colspan="7" style="text-align: left;font-size: 13px; padding: 25px 10px 25px 10px;border: 1px solid #000;">
                    <?php echo e(@$patient_discharge_details->history_alcoholism); ?>

                </td>

            </tr>
            <tr>
                <th colspan="3" style="text-align: left;width: 30%;font-size: 13px; padding: 25px 10px 25px 10px;border: 1px solid #000;">
                    Significant Past Medical and Surgical History ,if any
                </th>
                <td colspan="7" style="text-align: left;font-size: 13px; padding: 25px 10px 25px 10px;border: 1px solid #000;">
                    <?php echo e(@$patient_discharge_details->medical_surgical_history); ?>

                </td>

            </tr>
            <tr>
                <th colspan="3" style="text-align: left;font-size: 13px; padding: 25px 10px 25px 10px;border: 1px solid #000;">
                    Family History if significant/relevant to diagnosis or treatment
                </th>
                <td colspan="7" style="text-align: left;font-size: 13px; padding: 25px 10px 25px 10px;border: 1px solid #000;">
                    <?php echo e(@$patient_discharge_details->family_history_diagnosis); ?>

                </td>

            </tr>

        </table>
        <table style="width: 100%; border-collapse: collapse; margin: 10px 0px 80px 0px;">
            <tr>
                <th colspan="2" style="text-align: left;width: 30%;font-size: 13px; padding: 25px 10px 25px 10px;border: 1px solid #000;">
                    Summary of key investigations during Hospitalization
                </th>
                <td colspan="7" style="text-align: left;font-size: 13px; padding: 25px 10px 25px 10px;border: 1px solid #000;">
                    <?php echo e(@$patient_discharge_details->summary_inves_during_hos); ?>

                </td>

            </tr>
            <tr>
                <th colspan="2" style="text-align: left;font-size: 13px; padding: 25px 10px 25px 10px;border: 1px solid #000;">
                    Course in the Hspital including complications if any
                </th>
                <td colspan="7" style="text-align: left;font-size: 13px; padding: 25px 10px 25px 10px;border: 1px solid #000;">
                    <?php echo e(@$patient_discharge_details->course_complications); ?>

                </td>

            </tr>
            <tr>
                <th colspan="2" style="text-align: left;font-size: 13px; padding: 25px 10px 25px 10px;border: 1px solid #000;">
                    Advice on Discharge
                </th>
                <td colspan="7" style="text-align: left;font-size: 13px; padding: 25px 10px 25px 10px;border: 1px solid #000;">
                    <?php echo e(@$patient_discharge_details->dischage_advice); ?>

                </td>

            </tr>
        </table>
        <div class="pagebreak" style="margin: 40px 0px 0px 0px;"></div>
        <table style="">
            <b style="">Medicine: </b>
            <?php if(isset($DischargedMedicine[0]->id)): ?>
            <?php $__currentLoopData = $DischargedMedicine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <h5>
                <li> <?php echo e($value->medicine_details->medicine_name); ?> <?php echo e($value->dose); ?> <?php echo e($value->interval); ?> <?php echo e($value->duration); ?></li>
            </h5>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <b>Pathology: </b>

            <?php if(isset($DischargedPathologyTest[0]->test_id)): ?>
            <?php $__currentLoopData = $DischargedPathologyTest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <h5>
                <li> <?php echo e($value->test_details->test_name); ?> </li>
            </h5>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <b> Radiology: </b>

            <?php if(isset($DischargedRadiologyTest[0]->test_id)): ?>
            <?php $__currentLoopData = $DischargedRadiologyTest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <h5>
                <li> <?php echo e($value->test_details_radiology->test_name); ?></li>
            </h5>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </table>
    </div>
</body>

</html><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/ipd/_print/discharged_patient.blade.php ENDPATH**/ ?>