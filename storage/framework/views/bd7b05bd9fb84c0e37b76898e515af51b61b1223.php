<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta http-equiv="Content-Type" content="charset=utf-8" />
  <title>Pathology Report</title>
  
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
      html, body {
        width:25cm;
 
        margin: 0 !important; 
        padding: 5px !important;
        overflow: hidden;
      }
      
  }
  
    

  body 
  {
      font-family: sans-serif;
      background: #ffffff;
      margin: 0 auto;
      width:100%;
  }
  table, th, td {
     border-collapse: collapse;
}

  tr 
  {
      width: 100%;
      height: auto;
  }
 
</style>
<div style="padding: 0px 7px 0px 7px;">
<!-- ==========================================code here================================== -->
<table style="width: 100%; border:1px soild black;border-collapse: collapse">
  <tr style="text-align: center;">
      <td>
        <img src="<?php echo e(asset('public/assets/images/header')); ?>/<?php echo e($header_image->logo); ?>" alt="" style="width: 80%;">
      </td>
  </tr>
  <tr style="width:100%">
    <td style= "width:100%">
      <h1 style="text-align:center;font-size: 17px;margin: 5px 0px 0px 0px; color: #000;padding: 10px 0px 10px 0px;  width: 100%;">Pathology Test Report</h1>
   </td>
  </tr>
  <table style="width: 100%; margin: 0px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
    <tr>
    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Patient Name
      </th>
      <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        <?php echo e(@$patient_details->prefix); ?> <?php echo e(@$patient_details->first_name); ?> <?php echo e(@$patient_details->middle_name); ?> <?php echo e(@$patient_details->last_name); ?> 
      </td>
      <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        Age
      </th>
      <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        <?php if($patient_details->year != 0): ?>
        <?php echo e(@$patient_details->year); ?>y
        <?php endif; ?>
        <?php if($patient_details->month != 0): ?>
        <?php echo e(@$patient_details->month); ?>m
        <?php endif; ?>
        <?php if($patient_details->day != 0): ?>
        <?php echo e(@$patient_details->day); ?>d
        <?php endif; ?>
      </td>
      <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
         Sample Collected date
      </th>
      <td colspan="3"  style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        <?php echo e($pathology_patient_test_details->sample_collected_date != null ? date('d-m-Y',strtotime($pathology_patient_test_details->sample_collected_date)) : ''); ?>

      </td>
    </tr>
    <tr>
    <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
      UHID No.
      </th>
      <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        <?php echo e(@$patient_details->patient_prefix); ?><?php echo e(@$patient_details->id); ?> 
      </td> 
      <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Gender
      </th>
      <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        <?php echo e(@$patient_details->gender); ?>

      </td>
      <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
      Reported Date
      </th>
      <td colspan="3"style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        <?php echo e($pathology_patient_test_details->report_date != null ? date('d-m-Y',strtotime($pathology_patient_test_details->report_date)) : ''); ?>

      </td>
   </tr>
   <tr>
   <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        Phone No.
      </th>
      <td  style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
        <?php echo e(@$patient_details->phone); ?>

      </td>
    
      <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
         Generated by
      </th>
      <td colspan="5" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
           <?php echo e($pathology_patient_test_details->generator_details->first_name); ?>  <?php echo e($pathology_patient_test_details->generator_details->last_name); ?>

      </td>
   </tr>
  
  
</table>
<table style="width: 100%;">
  <td style= "width:100%">
    <h4 style="text-align:center;font-size: 13px;margin: 5px 0px 0px 0px; color: #000;padding: 10px 0px 10px 0px;  width: 100%;"><?php echo e(@$pathology_patient_test_details->test_details->test_name); ?><br>(<?php echo e(@$pathology_patient_test_details->test_details->short_name); ?>)</h4>
       
 </td>
</table>
<table style="width: 100%;">
  <td style= "width:100%">
    <h5 style="text-align:center;font-size: 13px;margin: 5px 0px 0px 0px; color: #000;padding: 10px 0px 10px 0px;  width: 100%;">
      <?php echo @$pathology_patient_test_details->description; ?>

    </h5>
 </td>
</table>
<table style="width: 100%; margin: 0px 0px 0px 0px;">

  <tr>
     <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">TEST NAME</th>
     <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">VALUE</th>
     <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">UNITS</th>
     <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">REFERENCE RANGE</th>
     <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Note</th>
    
 </tr>
 <?php $__currentLoopData = $pathologyParameterResult; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <tr>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px; border: 1px solid #000;"><?php echo e(@$value->parameter_name); ?></td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><?php echo e(@$value->report_value); ?></td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><pre><?php echo $value->unit; ?></pre>
    </td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><?php echo @$value->reference_range; ?></td>
    <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"><?php echo @$value->parameter_description; ?></td>
    
 </tr>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
</table>

 
  <!-- =================================================================================================== -->
</div>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pathology/printReport.blade.php ENDPATH**/ ?>