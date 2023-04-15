
<?php if(!empty($print)): ?>
<script>
    window.print();
</script>
<?php endif; ?>
<!-- ================================================================= -->
<!DOCTYPE html>
<html>
<title>Job Card</title>
<meta charset="utf-8">

<body>
    <style>
        @page  {
            size: A4 landscape;
            margin: 0;
            padding: 0;
            / change the margins as you want them to be. /
        }

        @media  print {

            html,
            body {
                width: 100%;
                /*height: 33cm;*/
                margin: 0 !important;
                padding: 5 !important;
                overflow: hidden;
            }
        }

        body {
            font-family: sans-serif;
            background: #ffffff;
            margin: 0 auto;
            height: 20cm;
            width: 100%;
        }

        table {
            background-position: center;
            background-repeat: no-repeat;
        }

        tr {
            width: 100%;
            height: auto;
        }

        .marksheetheading {
            background: #010c45 !important;
            color: #ffffff !important;
            margin: 0 auto;
            display: inline-block;
            text-align: center;
            font-size: 25px;
            font-weight: 700;
            padding: 7px 25px;
            margin-top: 5px;
            margin-bottom: 0px;
        }

        }
    </style>
    <div style="position:relative;background-color:#fff;padding:30px;">

        <div style="margin: 0px 0px 0px 0px;">
            <!-- ========================================heading============================== -->
            <table style="margin:0px 0px 0px 0px;width:100%;">
                <tr>
                    <td colspan="2" style="width:100%;text-align:center;text-transform:uppercase;margin:0 auto;">
                        <label class="marksheetheading">
                            JOB CARD
                        </label>
                    </td>
                </tr>
            </table>
            <!-- ========================================heading============================== -->
            <!-- ========================================head down details============================= -->
            <table style="width: 100%; margin: 20px 0px 20px 0px;">
                <tr>
                    <th style="padding: 0px 0px 0px 0px;text-align: left;font-size: 13px;width: 80px;">
                        Vehicle Reg. No. :
                    </th>
                    <td style="padding: 0px 0px 5px 5px;font-size: 14px;width: 120px;border-bottom: 1px dashed #bfb2b2;">
                        <?php echo e($job_card_pdf->vehicle_reg_no); ?>

                    </td>
                    <th style="padding: 0px 0px 0px 15px;text-align: left;font-size: 13px;width: 50px;">
                        Job Card No:
                    </th>
                    <td style="padding: 0px 0px 5px 5px;font-size: 14px;width: 120px;border-bottom: 1px dashed #bfb2b2;">
                        <?php echo e($job_card_pdf->prefix); ?>

                    </td>
                    <th style="padding: 0px 0px 0px 15px;text-align: left;font-size: 13px;width: 30px;">
                        Date:
                    </th>
                    <td style="padding: 0px 0px 5px 5px;font-size: 14px;width: 120px;border-bottom: 1px dashed #bfb2b2;">
                        <?php echo e($job_card_pdf->created_at); ?>

                    </td>
                </tr>
            </table>

            <table style="width: 100%; margin: 20px 0px 20px 0px;">
                <tr>
                    <th style="padding: 0px 0px 0px 0px;text-align: left;font-size: 13px;width: 80px;">
                        Driver Name:
                    </th>
                    <td style="padding: 0px 0px 5px 5px;font-size: 14px;width: 120px;border-bottom: 1px dashed #bfb2b2;">
                        <?php echo e($job_card_pdf->driver_name); ?>

                    </td>
                    <th style="padding: 0px 0px 0px 15px;text-align: left;font-size: 13px;width: 50px;">
                        Helper Name:
                    </th>
                    <td style="padding: 0px 0px 5px 5px;font-size: 14px;width: 120px;border-bottom: 1px dashed #bfb2b2;">
                        <?php echo e($job_card_pdf->helper_name); ?>

                    </td>
                    <th style="padding: 0px 0px 0px 15px;text-align: left;font-size: 13px;width: 30px;">
                        Ref No:
                    </th>
                    <td style="padding: 0px 0px 5px 5px;font-size: 14px;width: 120px;border-bottom: 1px dashed #bfb2b2;">
                        <?php echo e($job_card_pdf->reference_no); ?>

                    </td>
                </tr>
            </table>

            <table style="width: 100%; margin: 20px 0px 20px 0px;">
                <tr>
                    <th style="padding:0px 0px 0px 0px;text-align:left;font-size: 13px;width:13%;">Machine & Helper:</th>
                    <td style="padding:0px 0px 5px 5px;font-size: 14px;width: 80%;border-bottom: 1px dashed #bfb2b2"><?php echo e($job_card_pdf->mechanic_helper_name); ?></td>
                </tr>
            </table>
            <!-- ========================================head down details============================= -->
            <!-- ========================================table details============================= -->
            <table cellspacing="0" width="100%" style="text-align:center;width:100%;margin: 0 auto;margin-top: 20px;border:2px solid black;">
                <thead>
                    <tr>
                        <th style="padding: 10px 0px 10px 0px; font-size: 15px;border-bottom: 2px solid black; border-right:2px solid black;">SL. NO.</th>
                        <th style="padding: 10px 0px 10px 0px; font-size: 15px;border-bottom: 2px solid black;">Description of Work</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($job_desc)): ?>
                    <?php $__currentLoopData = $job_desc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="padding: 10px 0px 10px 0px; font-size: 14px;border-right:2px solid black;"><?php echo e($loop->iteration); ?></td>
                        <td style="padding: 10px 0px 10px 0px; font-size: 14px;"><?php echo e($list->desc); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <!-- ========================================table details============================= -->
            <!-- ============================footer area=========================================== -->
            <!-- <table style="width: 100%; margin: 20px 0px 0px 0px;">
         	  <tr>
         	  	  <th style="padding: 0px 0px 0px 0px;text-align: left;font-size: 13px;width: 70px;">
         	  	  	Approved by:
         	  	  </th>
         	  	  <td style="padding: 0px 0px 5px 5px;text-align: left;font-size: 14px;width: 115px;border-bottom: 1px dashed #bfb2b2;">
         	  	  	Manik Roy
         	  	  </td>
         	  	  <th style="padding: 0px 0px 0px 15px;text-align: left;font-size: 13px;width: 70px;">
         	  	  	Checked by:
         	  	  </th>
         	  	  <td style="padding: 0px 0px 5px 5px;text-align: left;font-size: 14px;width: 115px;border-bottom: 1px dashed #bfb2b2;">
         	  	  	Manik Das
         	  	  </td>
         	  	  <th style="padding: 0px 0px 0px 15px;text-align: left;font-size: 13px;width: 100px;">
         	  	  	Supervisor / Incharge by:
         	  	  </th>
         	  	  <td style="padding: 0px 0px 5px 5px;text-align: left;font-size: 14px;width: 115px;border-bottom: 1px dashed #bfb2b2;">
         	  	  	Manik Pal
         	  	  </td>
         	  </tr>
         </table>
         <table style="width: 100%; margin: 20px 0px 0px 0px;">
         	  <tr>
         	  	  <th style="padding: 0px 0px 0px 0px;text-align: left;font-size: 13px;width: 70px;">
         	  	  	Director
         	  	  </th>
         	  	  <td style="padding: 0px 0px 5px 5px;text-align: left;font-size: 14px;width: 115px;border-bottom: 1px dashed #bfb2b2;">
         	  	  	Manik Roy
         	  	  </td>
         	  	  <th style="padding: 0px 0px 0px 15px;text-align: left;font-size: 13px;width: 70px;">
         	  	  	Signature
         	  	  </th>
         	  	  <td style="padding: 0px 0px 5px 5px;text-align: left;font-size: 14px;width: 115px;border-bottom: 1px dashed #bfb2b2;">
         	  	  	Manik Das
         	  	  </td>
         	  	  <th style="padding: 0px 0px 0px 15px;text-align: left;font-size: 13px;width: 100px;">
         	  	  	Signature
         	  	  </th>
         	  	  <td style="padding: 0px 0px 5px 5px;text-align: left;font-size: 14px;width: 115px;border-bottom: 1px dashed #bfb2b2;">
         	  	  	Manik Pal
         	  	  </td>
         	  </tr>
         </table> -->
            <!-- ============================footer area=========================================== -->
        </div>

    </div>
</body>

</html>
<!-- ================================================================= --><?php /**PATH C:\ame_inventory\resources\views/appPages/job/job-card-pdf.blade.php ENDPATH**/ ?>