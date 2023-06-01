<!DOCTYPE html>
<html lang="en">

<head>
  <title> Bill Summary</title>

</head>
<script>
  window.print();
</script>
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
        <img src="<?php echo e(asset('public/assets/images/header')); ?>/<?php echo e($header_image->logo); ?>" alt="" style="width: 100%;">
      </td>
    </tr>
    <tr style="width:100%">
      <td style="width:100%">
        <h1 style="text-align:center;font-size: 20px;margin: 10px 0px 10px 0px; color: #000;padding: 5px 0px 5px 0px;  width: 100%;"> Bill Summary</h1>
      </td>
    </tr>
    <table style="width: 100%;">
      <tr>
        <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
          <b>UHID No. :
            <?php echo e($opd_details->all_patient_details->patient_prefix); ?>/<?php echo e($opd_details->all_patient_details->id); ?></b>
        </td>
        <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
          <!-- <img src="./image/qr.png" style="width: 80px;"> -->
          <?php
          $ipd_de = $opd_details->opd_prefix . '' . $opd_details->id;
          ?>

          <span style="width: 80px;height:60px"><?php echo QrCode::size(90)->generate($ipd_de); ?> </span>
        </td>
        <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
          <!-- <img src="./image/barcodee.png" style="width: 80px;"> -->
          <?php
          $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
          ?>

          <img src="data:image/png;base64,<?php echo e(base64_encode($generatorPNG->getBarcode('@$opd_details->opd_prefix @$opd_details->id', $generatorPNG::TYPE_CODE_128))); ?>" style="width: 190px;height:60px">
        </td>
        <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
          <b>Admission Date : <?php echo e($opd_details->latest_opd_visit_details_for_patient->appointment_date); ?></b>
        </td>

      </tr>
      <tr>
        <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;"><b>
            OPD no.
            : <?php echo e($opd_details->opd_prefix); ?>/<?php echo e($opd_details->id); ?></b></td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #899499;">
          <b> Department:  <?php echo e($opd_details->latest_opd_visit_details_for_patient->department_details->department_name); ?></b>
        </td>

      </tr>
    </table>
    <table style="width: 100%; margin: 15px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
      <tr>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Patient Name
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($opd_details->all_patient_details->first_name); ?> <?php echo e($opd_details->all_patient_details->middle_name); ?> <?php echo e($opd_details->all_patient_details->last_name); ?>

        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Guardian Name
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($opd_details->all_patient_details->guardian_name); ?>

        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Mobile No.
        </th>
        <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($opd_details->all_patient_details->phone); ?>

        </td>
      </tr>
      <tr>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Age
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($opd_details->all_patient_details->year); ?>Y <?php echo e($opd_details->all_patient_details->month); ?>M
          <?php echo e($opd_details->all_patient_details->day); ?>D
        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Gender
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($opd_details->all_patient_details->gender); ?>

        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Patient Type
        </th>
        <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($opd_details->latest_opd_visit_details_for_patient->patient_type); ?>

        </td>
      </tr>
      <tr>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Dr. In Charge
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($opd_details->latest_opd_visit_details_for_patient->doctor->first_name); ?> <?php echo e($opd_details->latest_opd_visit_details_for_patient->doctor->last_name); ?>

        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Unit
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($opd_details->latest_opd_visit_details_for_patient->unit); ?>

        </td>
        <!-- <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Unit
        </th> -->
        <!-- <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        
        </td> -->
      </tr>
      <!-- <tr>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Department:
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($opd_details->latest_opd_visit_details_for_patient->department_details->department_name); ?>

        </td> -->
        <!-- <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Floor
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          3rd Floor
        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Bed
        </th>
        <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
    
        </td> -->
      <!-- </tr> -->

    </table>
    <table style="width: 100%; border-collapse: collapse;">
      <tr>
        <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Address
        </th>
        <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($opd_details->all_patient_details->address); ?>,<?php echo e($opd_details->all_patient_details->_state->name); ?>,<?php echo e($opd_details->all_patient_details->_district->name); ?>,<?php echo e($opd_details->all_patient_details->pin_no); ?>

        </td>

      </tr>
      <?php if($opd_details->latest_opd_visit_details_for_patient->patient_type == 'Swasthya Sathi' || $opd_details->latest_opd_visit_details_for_patient->patient_type == 'TPA' ): ?>
      <tr>
        <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php if($opd_details->latest_opd_visit_details_for_patient->patient_type == 'Swasthya Sathi'): ?>
          Swasthya Sathi No.
          <?php elseif($opd_details->latest_opd_visit_details_for_patient->patient_type == 'TPA'): ?>
          TPA <?php echo e($opd_details->latest_opd_visit_details_for_patient->tpa_details->TPA_name); ?>

          <?php endif; ?>

        </th>
        <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($opd_details->latest_opd_visit_details_for_patient->tpa_details->type_no); ?>

        </td>

      </tr>
      <?php endif; ?>

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
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Amount(Rs)</td>
      </tr>
      <?php $total = 0; ?>
      <?php if(@$patientCharges): ?>
      <?php $__currentLoopData = $patientCharges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $total += $value->amount; ?>
      <tr>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><?php echo e($loop->iteration); ?>

        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><?php echo e(@date('d-m-Y h:i A', strtotime($value->charges_date))); ?> </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><?php echo e(@$value->charges_category_details->charges_catagories_name); ?>

        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><?php echo e(@$value->charge_details->charges_name); ?>

        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><?php echo e(@$value->amount); ?>

        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
    </table>
    <?php if(@$medicine_billings[0]->id != null): ?>
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

      <?php $__currentLoopData = $medicine_billings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $total += $value->amount; ?>
      <tr>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><?php echo e($loop->iteration); ?>

        </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><?php echo e(@$value->bill_prefix); ?><?php echo e(@$value->id); ?> </td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><?php echo e(@$value->total_amount); ?>

        </td>

      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </table>
    <?php endif; ?>
    <table>
      <h1 style="font-size: 20px;"> Total : <?php echo e(@$total.' Rs'); ?> </h1>
    </table>


    <!-- =================================================================================================== -->
</div>
</body>

</html><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/OPD/billing/_print_opd_billing.blade.php ENDPATH**/ ?>