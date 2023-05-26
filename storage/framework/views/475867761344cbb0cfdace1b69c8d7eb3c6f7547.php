<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Example</title>

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
        <!-- <img src="./image/1571895010.png" style="width: 100%;"> -->
        <img src="<?php echo e(asset('public/assets/images/header')); ?>/<?php echo e($header_image->logo); ?>" alt="" style="width: 100%;">
      </td>
    </tr>
    <tr style="width:100%">
      <td style="width:100%">
        <h1 style="text-align:center;font-size: 20px;margin: 40px 0px 20px 0px; color: #000;padding: 15px 0px 15px 0px;  width: 100%;">
          ADMISSION FORM</h1>
      </td>
    </tr>
    <table style="width: 100%;">
      <tr>
        <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
          <b>UHID No. : <?php echo e($ipd_details->all_patient_details->patient_prefix); ?>/<?php echo e($ipd_details->all_patient_details->id); ?></b>
        </td>
        <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
          <!-- <img src="./image/qr.png" style="width: 80px;"> -->
          <?php
          $ipd_de = $ipd_details->ipd_prefix . '' . $ipd_details->ipd_id;
          ?>

          <span style="width: 80px;height:60px"><?php echo QrCode::size(90)->generate($ipd_de); ?> </span>
        </td>
        <td rowspan="2" style="text-align: center;border: 1px solid #899499;">
          <!-- <img src="./image/barcodee.png" style="width: 80px;"> -->
          <?php
          $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
          ?>

          <img src="data:image/png;base64,<?php echo e(base64_encode($generatorPNG->getBarcode('@$ipd_details->ipd_prefix @$ipd_details->ipd_id', $generatorPNG::TYPE_CODE_128))); ?>" style="width: 190px;height:60px">
        </td>
        <td style="text-align: left; font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;">
          <b>Admission Date : <?php echo e($ipd_details->appointment_date); ?></b>
        </td>

      </tr>
      <tr>
        <td style="text-align: left;font-size: 11px; padding: 5px 10px 5px 10px;border: 1px solid #899499;"><b> IPD no.
            : <?php echo e($ipd_details->ipd_prefix); ?>/<?php echo e($ipd_details->id); ?></b></td>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #899499;"><b>Patient
            Source:<?php echo e($ipd_details->patient_source); ?> Source Id:<?php echo e($ipd_details->patient_source_id); ?>;</b></td>

      </tr>
    </table>
    <table style="width: 100%; margin: 15px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
      <tr>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Patient Name
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($ipd_details->all_patient_details->first_name); ?>

        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Guardian Name
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($ipd_details->all_patient_details->guardian_name); ?>

        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Mobile No.
        </th>
        <td colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($ipd_details->all_patient_details->phone); ?>

        </td>
      </tr>
      <tr>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Age
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($ipd_details->all_patient_details->year); ?>Y <?php echo e($ipd_details->all_patient_details->month); ?>M <?php echo e($ipd_details->all_patient_details->day); ?>D
        </td>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Gender
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($ipd_details->all_patient_details->gender); ?>

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
          <?php echo e($ipd_details->doctor_details->first_name); ?> <?php echo e($ipd_details->doctor_details->last_name); ?>

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
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Floor
        </th>
        <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          3rd Floor
        </td>
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
          <?php echo e($ipd_details->all_patient_details->address); ?>,<?php echo e($ipd_details->all_patient_details->_state->name); ?>,<?php echo e($ipd_details->all_patient_details->_district->name); ?>,<?php echo e($ipd_details->all_patient_details->pin_no); ?>

        </td>

      </tr>
      <?php if($ipd_details->patient_type == 'Swasthya Sathi' || $ipd_details->patient_type == 'TPA' ): ?>
      <tr>
        <th colspan="3" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php if($ipd_details->patient_type == 'Swasthya Sathi'): ?>
          Swasthya Sathi No.
          <?php elseif($ipd_details->patient_type == 'TPA'): ?>
          TPA <?php echo e($ipd_details->tpa_details->TPA_name); ?>

          <?php endif; ?>

        </th>
        <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          <?php echo e($ipd_details->type_no); ?>

        </td>

      </tr>
      <?php endif; ?>

    </table>

    <p style="font-size: 13px; margin-top: 30px;">
      1. While taking admission I/We, have read & understood all the charges of your hospital, which will accure during
      the hospitalization. I/We have been told & understood the payment terms & conditions since admission till
      discharge. I/We here by promise you that I/We shall pay all dues, in time, of my our patient, start from first
      deposit till discharge, accordingly to your terms & condition of payment. I assure you that complete payment of
      the bill of my/our patient will be made prior to discharge .<br>
      2. I am aware that hospital discharge time is :-10:00AM.<br>
      3. I know that your hospital is not responsible for loss of any valuable possession/ Jewellery /Cash of the
      patient or relatives of patient. All valuable are kept entirely at our/my risk.<br>
      4. If you are having mediclaim (Cashless) or Swasthya Sathi, please produce the relevant documents at the time of
      admission.<br><br></p>



    <p style="font-size: 13px; margin-top: 20px;">১) ভর্তি হওয়ার সময় আমি/আমরা, আপনার হাসপাতালের সমস্ত চার্জ পড়েছি এবং
      বুঝেছি, যা হাসপাতালে ভর্তিরর্তি সময় আদায় হবে। ভর্তিরর্তি পর থেকে ডিসচার্জ পর্যন্তর্য
      পেমেন্টের শর্তা বলী আমাকে/আমাদের বলা হয়েছে এবং বুঝেছি। আমি/আমরা এখানে আপনাকে প্রতিশ্রুতি দিয়ে বলছি যে আমি/আমরা
      আমার রোগীর সমস্ত বকেয়া,
      যথাসময়ে, প্রথম জমা থেকে শুরু করে ডিসচার্জ পর্যন্তর্য , আপনার শর্তা বলী এবং অর্থপ্রর্থদানের শর্ত অনুসারে পরিশোধ
      করব। আমি আপনাকে নিশ্চিত করছি যে বিলের সম্পূর্ণ
      পরিশোধ আমার/আমাদের রোগীকে ডিসচার্জ করার আগে তৈরি করা হবে।
      <br>
      ২) আমি সচেতন যে হাসপাতালের ছাড়ার সময় হল:-10:00AM৷<br>
      ৩) আমি জানি যে আপনার হাসপাতাল রোগীর বা রোগীর আত্মীয়দের কোনো মূল্যবান সম্পদ/অলঙ্কার/নগদ হারানোর জন্য দায়ী নয়।
      সমস্ত মূল্যবান সম্পূর্ণরূপে আমাদের/আমার ঝুঁকিতে রাখা হয়।<br>
      ৪) আপনি যদি মেডিক্লেইম (নগদবিহীন) বা স্বাস্থ্য সাথী নিয়ে থাকেন, তাহলে অনুগ্রহ করে ভর্তির সময় প্রাসঙ্গিক নথিগুলি
      উপস্থাপন করুন।
    </p>

    <p style="font-size: 12px; margin-top: 40px;">
      Witness..................................................................<br>Provisional Diagnosis:<br>Final
      Diagnosis:<br>Operations:<br>Discharged Status: Cured/relieved/AMA/Expired<br>Transferred to:</p>

    <div>
      <p style="text-align:right; margin-top: 40px;">
        <br> <br>
        ..........................................................................................................
      </p>
      <p style="text-align:right;font-size: 12px;"><b>Signature of Patient/Patients representative</b></p>
      <p style="text-align:right;font-size: 13px;"><b>(রোগী/রোগী প্রতিনিধির স্বাক্ষর)</b></p>
    </div>

  </table>
  <!-- =================================================================================================== -->
  <div class="pagebreak">
    <h5 style="text-align: center; font-family: Arial; margin-top: 100px;"><b>CONSENT</b></h5>
    <p style="font-size: 11px">
      5. As per Swasthya Sathi rules(Exclusion to Swasthya Sathi Policy As per APPENDIX-I Page No. 50)
      Exclusion to IPD Procedure:-<br>
      i. Referred within 24 hours of being admitted into the hospital or if he / she is referred for medical reasons,
      the full bill of the patient has to be paid by the patient / relative of the patient.<br>
      ii. Discharge at your own risk(DORB/LAMA), the full bill of the patient has to be paid by the patient / relative
      of the patient.<br>
      iii. Drug & Alcohol induced illness and intentional self injury/ Suicide is not to admitted under this scheme.
      <br><br>
      6. You are requested to submit a photo identity of the patient at the time of admission.<br>
       <br>
      <b><u> We/I give consent to:-</u></b><br>
      1. Indoor Hospital Admission.<br>
      2. The administration of such treatment as is necessary, performance of any diagonostic examination, biopsy,
      transfusion, or operation and administration of any anesthetics as may be demand advisable in the course of
      Hospital Admission.<br>
      3. The release of professional and / or other information from medical records as may be deemed necessary, in
      accordance with rules and policies of the hospital.<br>
      4. If necessary due to treatment of patient on urgent basis patient can shift from one ward to another ward.
      <br><br>


      ৫) স্বাস্থ্য সাথি কার্ডের সুবিধা প্রদানের নিয়মাবলী:-<br>
      ( Exclusion to Swasthya Sathi Policy As per APPENDIX-I Page No. 50)<br><br>



      ১)রোগী/রোগীনিকে হাসপাতালে ভর্তি করিবার ২৪ ঘন্টার মধ্যে রেফার করিয়ে নিয়ে গেলে অথবা চিকিৎসাজনিত কারণে রেফার করা
      হইলে রোগী/রোগীনির সম্পূর্ণ বিল রোগী/রোগীনির আত্মীয়কে মেটাতে হবে।<br>
      ২) নিজ দায়িত্বে DORB/LAMA করে নিয়ে যেতে চাইলে উক্ত রোগী/রোগীনির সম্পূর্ণ বিল রোগী/রোগীনির আত্মীয়কে মেটাতে
      হবে।<br>
      ৩) Alcoholic অর্থাৎ মদ্যপান রোগী/রোগীনিকে এই স্কীমের আওতায় ভর্তি নেওয়া হয় না।<br>
      ৪) Suicide অর্থাৎ আত্মঘাতী কোন রোগী/রোগীনিকে এই স্কীমের আওতায় ভর্তি নেওয়া হয় না।<br><br>
      ৬) ভর্তির সময় আপনাকে রোগীর একটি ছবিসহ পরিচয়পত্র জমা দেওয়ার জন্য অনুরোধ করা হচ্ছে ।<br><br>

       <b><u>আমরা/আমি এতে সম্মতি দিচ্ছি:-</u></b> <br>
      ১) হাসপাতালের ইনডোর বিভাগে ভর্তি করার জন্য।।<br>
      ২) প্রয়োজনীয় চিকিৎসার জন্য, যে কোনও ডায়াগনস্টিক পরীক্ষা, বায়োপসি, ট্রান্সফিউশন, ভর্তির সময় পরামর্শযোগ্য যে
      কোনও চেতনানাশক প্রয়োগ করা।<br>
      ৩) হাসপাতালের সমস্ত নিয়ম এবং নীতি বজায় রেখে, প্রয়োজনে মেডিকেল রেকর্ড থেকে তথ্য প্রকাশ করা হতে পারে।<br>
      ৪) চিকিৎসার প্রয়োজনে জরুরি ভিত্তিক উপায়ে রোগী/ রোগীনিকে এক ওয়ার্ড থেকে অন্য ওয়ার্ডে সিফ্ট করা হতে পারে।<br>
    </p>


    <hr style="height: 1px; clear: both;margin-bottom: 10px; margin-top: 10px" /><br><br>
    <p>Witness..................................................................</p>
    <div>
      <p style="text-align:right;">

        ..........................................................................................................</p>
      <p style="text-align:right;font-size: 12px;"><b>Signature of Patient/Patients representative</b></p>
      <p style="text-align:right;font-size: 12px;"><b>(রোগী/রোগী প্রতিনিধির স্বাক্ষর)</b></p>
    </div>

    <p style="padding-top: 180px;font-size: 10px;">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?= date('d-m-Y H:i A'); ?>
    </p>
  </div>
</div>
</div>

<!-- =================================================================================================== -->
</div>

</body>

</html><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Ipd/_print/ipd-admission-form.blade.php ENDPATH**/ ?>