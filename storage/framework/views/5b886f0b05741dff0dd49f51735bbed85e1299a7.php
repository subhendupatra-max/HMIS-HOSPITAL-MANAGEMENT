<!DOCTYPE html>
<html>
<title>Requisition</title>
<meta charset="utf-8">

<body>
    <style>
        @page  {
            size: A4 portrait;
            margin: 0;
            padding: 0;
            / change the margins as you want them to be. /
        }

        @media  print {

            html,
            body {
                width: 25cm;
                height: 33cm;
                margin: 0 !important;
                padding: 5 !important;
                overflow: hidden;
            }
        }

        body {
            font-family: sans-serif;
            background: #ffffff;
            margin: 0 auto;
            height: 33cm;
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
            color: #ffffff !important;
            display: inline-block;
            text-align: center;
            font-size: 17px;
            font-weight: 700;
            padding: 10px 0px;
        }

        .headingdesign {
            background: #000000 !important;
        }

        .marksheetheading1 {
            color: #ffffff !important;
            display: inline-block;
            text-align: left;
            font-size: 15px;
            font-weight: 700;
            padding: 10px 10px;
        }

        .headingdesign1 {
            background: #3f51b5 !important;
        }
    </style>


    <div style="position:relative;background-color:#fff;padding:30px;">
        <!-- =================================first heading========================= -->
        <table style="width:100%;text-align: center;background: #3f51b5;">
            <tr>
                <td>
                    <h1 style="color: #FFF;margin: 0px;padding: 10px 0px 0px 0px;font-size: 40px;letter-spacing: 1px;font-family: math;">
                        DITS Hospital
                    </h1>
                    <p style="margin: 0px; font-size: 15px; color: #FFF;padding: 0px 0px 5px 0px;">
                        Devant Office Complex, Kolkata 
                    </p>
                </td>
            </tr>
        </table>
        <!-- =================================first heading========================= -->
        <!-- ========================================first heading============================== -->
        <table cellspacing="0" border="0" width="100%" hright="100%" style="text-align:center;margin-top: 0px;width: 100%;border-bottom: none;">
            <tr>
                <td class="headingdesign">
                    <label class="marksheetheading">
                        REQUISITION
                    </label>
                </td>
            </tr>
        </table>
        <!-- ========================================first heading============================== -->
        <!-- ====================================main area====================================== -->
        <table cellspacing="0" border="0" width="100%" hright="100%" style="margin-top: 0px;width: 100%;border-bottom: none;">
            <tr>
                <th style="padding: 10px 0px 10px 7px;text-align: left;font-size: 12px;border-left: 2px solid #3f51b5;width: 150px;border-bottom: 2px solid #3f51b5;">
                    <b>REQUISITION NO :-</b>
                </th>
                <td style="padding: 10px 0px 10px 7px;font-size: 12px;border-right: 2px solid #3f51b5;border-bottom: 2px solid #3f51b5;text-align:left;">
                    <?php echo e(@$requisition_details->requisition_prefix); ?><?php echo e(@$requisition_details->req_no); ?>

                </td>
                <th style="padding: 10px 0px 10px 7px;text-align: left;font-size: 12px;width: 150px;border-bottom: 2px solid #3f51b5;">
                    <b>REQUISITION DATE :-</b>
                </th>
                <td style="padding: 10px 0px 10px 7px;font-size: 12px;border-bottom: 2px solid #3f51b5;border-right: 2px solid #3f51b5;text-align:left;">
                    <?= date('d-m-Y h:i', strtotime($requisition_details->date)); ?>
                </td>
            </tr>
            <tr>
                <th style="padding: 10px 0px 10px 7px;text-align: left;font-size: 12px;border-left: 2px solid #3f51b5;border-bottom: 2px solid #3f51b5;">
                    <b>WORKSHOP :-</b>
                </th>
                <td style="padding: 10px 0px 10px 7px;font-size: 12px;border-bottom: 2px solid #3f51b5;text-align: left;">
                    <?php echo e(@$requisition_details->workshop_name); ?>

                </td>
                <?php if(@$vendor_selected_quataion): ?>
                <th style="padding: 10px 0px 10px 7px;text-align: left;font-size: 12px;border-left: 2px solid #3f51b5;border-bottom: 2px solid #3f51b5;">
                    <b>VENDOR :-</b>
                </th>
                <td style="padding: 10px 0px 10px 7px;font-size: 12px;border-right: 2px solid #3f51b5;border-bottom: 2px solid #3f51b5;text-align: left;">

                    <?php $__currentLoopData = $vendor_selected_quataion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($loop->iteration); ?>. <?php echo e($value->vendor_name); ?><br>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </td>
                <?php endif; ?>
            </tr>
        </table>
        <table cellspacing="0" border="0" width="100%" style="">
            <tr style="text-align: center; font-size: 13px;">
                <th style="padding: 7px 0px 7px 0px;border-left: 2px solid #3f51b5;border-bottom: 2px solid #3f51b5;border-right: 2px solid #3f51b5;">
                    SL No.
                </th>
                <th style="padding: 7px 0px 7px 0px;border-bottom: 2px solid #3f51b5;border-right: 2px solid #3f51b5;width: 400px;">
                    ITEM
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid #3f51b5;border-bottom:2px solid #3f51b5;width: 100px;">
                    QTY
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid #3f51b5;border-bottom:2px solid #3f51b5;width: 100px;">
                    UOM
                </th>
            </tr>

            <?php if(isset($requisition_item) && $requisition_item != ''): ?>
            <?php $__currentLoopData = $requisition_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr style="text-align: left; font-size: 13px;">
                <td style="width: 70px;padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-left: 2px solid #3f51b5;border-bottom: 2px solid #3f51b5;border-right: 2px solid #3f51b5;">
                    <?php echo e($loop->iteration); ?>

                </td>
                <td style="width: 70px;padding: 7px 0px 7px 10px;text-align: left;vertical-align:top;border-bottom: 2px solid #3f51b5;border-right: 2px solid #3f51b5;">
                    <?php echo e(@$requisition->item_name); ?>(<?php echo e(@$requisition->part_no); ?>)(Brand : <?php echo e(@$requisition->item_brand_name); ?>)(Manufacturer : <?php echo e(@$requisition->manufacture_name); ?>)<br>(<?php echo e(@$requisition->item_description); ?>)
                </td>
                <td style="padding: 7px 0px 7px 0px;vertical-align:top;text-align: center;border-bottom: 2px solid #3f51b5;border-right: 2px solid #3f51b5;">
                    <?php echo e(@$requisition->quantity); ?>

                </td>
                <td style="padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid #3f51b5;border-right: 2px solid #3f51b5;">
                    <?php echo e(@$requisition->units); ?>

                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <tr style="text-align: center; font-size: 13px;">
                <th style="padding: 7px 0px 7px 0px;border-left: 2px solid #3f51b5;border-bottom: 2px solid #3f51b5;border-right: 2px solid #3f51b5;">
                    Notes
                </th>
                <td style="padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid #3f51b5;border-right: 2px solid #3f51b5;" colspan="3">
                    <?php echo e(@$requisition_details->notes); ?>

                </td>
            </tr>
        </table>
        <!-- ====================================main area====================================== -->
        <!-- ============================footer area============================================ -->
        <!-- ================================signature area========================= -->
        <table cellspacing="0" border="0" width="100%" hright="100%" style="width:100%;">
            <tr>
                <td style="padding: 20px 5px 5px 10px;font-size: 13px;text-align:center;border-left: 2px solid #3f51b5;">
                    <b style="border-bottom: 2px dotted #c0c0c0;padding: 0px 0px 3px 0px;"> Generated By</b>
                </td>
                <td style="padding: 20px 5px 5px 10px;font-size: 13px;text-align:center;">
                    <b style="border-bottom: 2px dotted #c0c0c0;padding: 0px 0px 3px 0px;"> Checked By</b>
                </td>
                <td style="padding: 20px 5px 5px 10px;font-size: 13px;text-align:center;">
                    <b style="border-bottom: 2px dotted #c0c0c0;padding: 0px 0px 3px 0px;"> Issued By</b>
                </td>
                <td style="padding: 20px 5px 5px 10px;font-size: 13px;text-align:center;border-right: 2px solid #3f51b5;">
                    <b style="border-bottom: 2px dotted #c0c0c0;padding: 0px 0px 3px 0px;"> Approved By</b>
                </td>
            </tr>
            <tr>
                <td style="padding: 5px 5px 5px 10px;font-size: 13px;text-align:center;border-left: 2px solid #3f51b5;">
                    <?php echo e(@$requisition_details->generated_by_details->name); ?>

                </td>
                <td style="padding: 5px 5px 5px 10px;font-size: 13px;text-align:center;">
                    <?php echo e(@$requisition_details->checked_by_details->name); ?>

                </td>
                <td style="padding: 5px 5px 5px 10px;font-size: 13px;text-align:center;">
                    <?php echo e(@$requisition_details->issueed_by_details->name); ?>

                </td>
                <td style="padding: 5px 5px 5px 10px;font-size: 13px;text-align:center;border-right: 2px solid #3f51b5;">

                </td>
            </tr>
        </table>

        <table cellspacing="0" border="0" width="100%" hright="100%" style="width:100%;">
            <!-- <tr>
                <td style="padding: 20px 5px 5px 10px;font-size: 13px;text-align:center;border-left: 2px solid #3f51b5;">
                    <b style="border-bottom: 2px dotted #c0c0c0;padding: 0px 0px 3px 0px;"> Site Supervisor</b>
                </td>
                <td style="padding: 20px 5px 5px 10px;font-size: 13px;text-align:center;">
                    <b style="border-bottom: 2px dotted #c0c0c0;padding: 0px 0px 3px 0px;"> Site Incharge</b>
                </td>
                <td style="padding: 20px 5px 5px 10px;font-size: 13px;text-align:center;">
                    <b style="border-bottom: 2px dotted #c0c0c0;padding: 0px 0px 3px 0px;"> Store Keeper</b>
                </td>
                <td style="padding: 20px 5px 5px 10px;font-size: 13px;text-align:center;border-right: 2px solid #3f51b5;">
                    <b style="border-bottom: 2px dotted #c0c0c0;padding: 0px 0px 3px 0px;"> Partner</b>
                </td>
            </tr> -->
            <tr>
                <td style="padding: 5px 5px 5px 10px;font-size: 13px;text-align:center;border-left: 2px solid #3f51b5;border-bottom: 2px solid #3f51b5;">
                  
                </td>
                <td style="padding: 5px 5px 5px 10px;font-size: 13px;text-align:center;border-bottom: 2px solid #3f51b5;">

                </td>
                <td style="padding: 5px 5px 5px 10px;font-size: 13px;text-align:center;border-bottom: 2px solid #3f51b5;">

                </td>
                <td style="padding: 5px 5px 5px 10px;font-size: 13px;text-align:center;border-bottom: 2px solid #3f51b5;border-right: 2px solid #3f51b5;">

                </td>
            </tr>
        </table>
        <!-- ================================signature area========================= -->
        <!-- ============================footer area============================================ -->
    </div>
</body>

</html>
<!-- =================================================================================== --><?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Inventory/requisition/_print/_printInventoryReq.blade.php ENDPATH**/ ?>