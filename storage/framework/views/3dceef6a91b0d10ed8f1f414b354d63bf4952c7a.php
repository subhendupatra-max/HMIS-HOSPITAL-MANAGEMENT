
<!-- ================================================================= -->
<!DOCTYPE html>
<html>
<title>JOB CARD</title>
<meta charset="utf-8">

<body>
    <style>
      @page  
      {
         size: A4 portrait;
         margin: 0;
         padding: 0;
         /* change the margins as you want them to be. */
      }
      @media  print 
      {
         html,
         body 
        {
            width: 25cm;
            height: 33cm;
            margin: 0 !important;
            padding: 5 !important;
            overflow: hidden;
        }
      }
      body 
      {
         font-family: sans-serif;
         background: #ffffff;
         margin: 0 auto;
         height: 33cm;
         width: 100%;
      }
      table 
      {
         background-position: Left;
         background-repeat: no-repeat;
      }
      tr 
      {
         width: 100%;
         height: auto;
      }
      .marksheetheading 
      {
          color: #ffffff !important;
          display: inline-block;
          text-align: Left;
          font-size: 25px;
          font-weight: 700;
          padding: 10px 0px;
      }
      .headingdesign
      {
        background: #010c45 !important;
      }
      .marksheetheading1 
      {
          color: #ffffff !important;
          display: inline-block;
          text-align: left;
          font-size: 15px;
          font-weight: 700;
          padding: 10px 10px;
      }
      .headingdesign1
      {
        background: #010c45 !important;
      }
   </style>


    <div style="position:relative;background-color:#fff;padding:30px;">
      <!-- ========================================first heading============================== -->
            <table cellspacing="0" border="0" width="100%" hright="100%" style="text-align:center;margin-top: 0px;width: 100%;border-bottom: none;">
                 <tr>
                        <td class="headingdesign">
                            <label class="marksheetheading">
                                JOB CARD
                            </label>
                        </td>
                 </tr>
            </table>
      <!-- ========================================first heading============================== -->
      <!-- ====================================first area====================================== -->
            <table cellspacing="0" border="0" width="100%" hright="100%" style="text-align:Left;margin-top: 0px;width: 100%;border-bottom: none;">
                <tr>
                      <th style="padding: 10px 0px 10px 7px;text-align: left;font-size: 12px;border-left: 2px solid #010c45;border-bottom: 2px solid #010c45;">
                         <b>DEPT/WORKSHOP :</b>
                      </th>
                      <td style="padding: 10px 0px 10px 0px;font-size: 12px;border-right: 2px solid #010c45;border-bottom: 2px solid #010c45; text-align: Left;">
                           <?php echo e(@$job_description->name); ?>

                      </td>
                      <th style="padding: 10px 0px 10px 7px;text-align: left;font-size: 12px;width: 150px;border-bottom: 2px solid #010c45;">
                         <b>CARD NO :</b>
                      </th>
                      <td style="padding: 10px 0px 10px 0px;font-size: 12px;border-bottom: 2px solid #010c45; text-align: Left;">
                          <?php echo e(@$job_description->prefix); ?><?php echo e(@$job_description->job_id); ?>

                      </td>
                      <th style="padding: 10px 0px 10px 7px;text-align: left;font-size: 12px;border-left: 2px solid #010c45;border-bottom: 2px solid #010c45;">
                         <b>DATE :</b>
                      </th>
                      <td style="padding: 10px 0px 10px 0px;font-size: 12px;border-bottom: 2px solid #010c45; text-align: Left;border-right: 2px solid #010c45;">
                          <?php echo e(date('d-m-Y h:i'),strtotime(@$job_description->job_date)); ?>

                      </td>
                </tr>
                <tr>
                      <th style="padding: 10px 0px 10px 7px;text-align: left;font-size: 12px;border-left: 2px solid #010c45;border-bottom: 2px solid #010c45;">
                         <b>GATE IN :</b>
                      </th>
                      <td style="padding: 10px 0px 10px 0px;font-size: 12px;border-right: 2px solid #010c45;border-bottom: 2px solid #010c45; text-align: Left;">
                          <?php echo e(date('d-m-Y h:i'),strtotime(@$job_description->job_date)); ?>

                      </td>
                      <th style="padding: 10px 0px 10px 7px;text-align: left;font-size: 12px;width: 150px;border-bottom: 2px solid #010c45;">
                         <b>JOB STARTED :</b>
                      </th>
                      <td style="padding: 10px 0px 10px 0px;font-size: 12px;border-bottom: 2px solid #010c45; text-align: Left;">
                         <?php echo e(@$job_description->job_started); ?>

                      </td>

                      <th style="padding: 10px 0px 10px 7px;text-align: left;font-size: 12px;border-left: 2px solid #010c45;border-bottom: 2px solid #010c45;">
                         <b>JOB COMPLETED :</b>
                      </th>
                      <td style="padding: 10px 0px 10px 0px;font-size: 12px;border-bottom: 2px solid #010c45; text-align: Left;border-right: 2px solid #010c45;">
                          <?php echo e(@$job_description->job_completed); ?>

                      </td>
                </tr>
            </table>
      <!-- ====================================first area====================================== -->
      <!-- ========================================second heading============================== -->
            <table cellspacing="0" border="0" width="100%" hright="100%" style="margin-top: 0px;width: 100%;border-bottom: none;">
                 <tr>
                        <td class="headingdesign">
                            <label class="marksheetheading1">
                                JOB DESCRIPTION
                            </label>
                        </td>
                 </tr>
            </table>
      <!-- ========================================second heading============================== -->
      <!-- =====================================second area==================================== -->
             <table cellspacing="0" border="0" width="100%" style="">
                <tr style="text-align: center; font-size: 13px;">
                    <th style="padding: 7px 0px 7px 0px;border-left: 2px solid #010c45;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                        SL No.
                    </th>
                    <th style="padding: 7px 0px 7px 0px;border-right:2px solid #010c45;border-bottom:2px solid #010c45;">
                        JOB DESCRIPTION
                    </th>
                </tr>

            <?php if(isset($job_list)): ?>
            <?php $__currentLoopData = $job_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr style="text-align: left; font-size: 13px;height: 300px;">
                    <td style="width: 110px;padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-left: 2px solid #010c45;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                        <?php echo e($loop->iteration); ?>

                    </td>
                    <td style="padding: 7px 0px 7px 10px;text-align: left;vertical-align:top;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                        <?php echo e($item->desc); ?>

                    </td>
                 </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>


            </table>
      <!-- =====================================second area==================================== -->
      <?php if(@$item->item_name): ?>
      <!-- ========================================second heading============================== -->
            <table cellspacing="0" border="0" width="100%" hright="100%" style="margin-top: 0px;width: 100%;border-bottom: none;">
                 <tr>
                        <td class="headingdesign">
                            <label class="marksheetheading1">
                                ISSUE ITEM
                            </label>
                        </td>
                 </tr>
            </table>
      <!-- ========================================second heading============================== -->
      
      <!-- =====================================Third area==================================== -->
             <table cellspacing="0" border="0" width="100%" style="">
                <tr style="text-align: center; font-size: 13px;">
                    <th style="padding: 7px 0px 7px 0px;border-left: 2px solid #010c45;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                        SL No.
                    </th>
                    <th style="padding: 7px 0px 7px 0px;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                        ITEMS.
                    </th>
                    <th style="padding: 7px 0px 7px 0px;border-right:2px solid #010c45;border-bottom:2px solid #010c45;">
                        QUANTITY
                    </th>
                    <th style="padding: 7px 0px 7px 0px;border-right:2px solid #010c45;border-bottom:2px solid #010c45;">
                        UOM
                    </th>
                    <th style="padding: 7px 0px 7px 0px;border-right:2px solid #010c45;border-bottom:2px solid #010c45;">
                        RATE
                    </th>
                    <th style="padding: 7px 0px 7px 0px;border-right:2px solid #010c45;border-bottom:2px solid #010c45;">
                        VALUE
                    </th>
                </tr>
                
                <?php $__currentLoopData = $issue_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr style="text-align: left; font-size: 13px;height: 40px;">
                    <td style="width: 90px;padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-left: 2px solid #010c45;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                        <?php echo e($loop->iteration); ?>

                    </td>
                    <td style="width: 300px;padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                        <?php echo e(@$item->item_name); ?><br>(<?php echo e(@$item->item_description); ?>)(Brand : <?php echo e(@$item->brand_name); ?>)(Manufacturer : <?php echo e(@$item->manufacturar_name); ?>)
                    </td>
                    <td style="width: 40px;padding: 7px 0px 7px 7px;vertical-align:top;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                        <b><?php echo e(@$item->quantity); ?></b>
                    </td>
                    <td style="width: 30px;padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                        <?php echo e(@$item->unit_name); ?>

                    </td>
                    <td style="width: 50px;padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                        <?php echo e(@$item->rate); ?>

                    </td>
                    <td style="width: 80px;padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;">
                        <b><?php echo e(@$item->amount); ?></b>
                    </td>
                 </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             
            </table>
      <!-- =====================================Third area==================================== -->
         
      <!-- =====================================total value area============================== -->
            <table cellspacing="0" border="0" width="100%" style="">
                <tr style="font-size: 15px;">
                    <td style="border-left: 2px solid #010c45;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;padding: 20px 10px 20px 0px;text-align: right;">
                        <b>TOTAL :  <?php echo e(@$job_description->total_issue_item_amount); ?></b>
                    </td>
                </tr>
            </table>
      <!-- =====================================total value area============================== -->
      <?php endif; ?>
      <!-- ============================footer area============================================ -->
            <table cellspacing="0" border="0" width="100%" hright="100%" style="width:100%;">
                <tr>
                     <td style="padding: 20px 10px 5px 0px;font-size: 12px;text-align: right;border-bottom: 2px solid #010c45;border-right: 2px solid #010c45;border-left: 2px solid #010c45;">
                       <b style="border-bottom: 2px dotted #010c45; padding: 0px 0px 3px 0px;">SIGNATURE & DATE</b> 
                       <h6 style="padding: 13px 0px 0px 0px;margin: 0px 0px 0px 0px;font-size: 15px;">SUBHENDU PATRA</h6>
                       <h6 style="padding: 5px 0px 0px 0px;margin: 0px 0px 0px 0px;font-size: 15px;">25/11/2022</h6>
                    </td>
                </tr>
            </table> 
      <!-- ============================footer area============================================ -->
    </div>
</body>
</html>
<!-- =================================================================================== -->

<?php /**PATH E:\xampp\ameInventory\resources\views/appPages/job/job-with-issue-item-print.blade.php ENDPATH**/ ?>