<!-- ================================================================= -->
<!DOCTYPE html>
<html>
<title>Purchase Order</title>
<meta charset="utf-8">

<body onload="window.print();">
    <style>
        @page  {
            size: A4 portrait;
            margin: 0;
            padding: 0;
            /* change the margins as you want them to be. */
        }

        @media  print {

            html,
            body {
                width: 25cm;

                margin: 0 !important;
                padding: 5 !important;
                overflow: hidden;
            }
        }

        body {
            font-family: sans-serif;
            background: #ffffff;
            margin: 0 auto;

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
            font-size: 25px;
            font-weight: 700;
            padding: 10px 0px;
        }

        .headingdesign {
            background: #010c45 !important;
        }
    </style>


    <div style="position:relative;background-color:#fff;padding:30px;">
        <!-- =================================first heading========================= -->
        <table style="width:100%;text-align: center;background: #3F51B5;">
            <tr>
                <td>
                    <h1
                        style="color: #FFF;margin: 0px;padding: 10px 0px 0px 0px;font-size: 40px;letter-spacing: 1px;font-family: math;">
                        DITS HOSPITAL
                    </h1>
                    <p style="margin: 0px; font-size: 15px; color: #FFF;padding: 0px 0px 5px 0px;">
                        CPT Office Complex, Block - C Chiranjibpur, Haldia - 721604
                    </p>
                </td>
            </tr>
        </table>
        <!-- =================================first heading========================= -->
        <!-- ========================================heading============================== -->
        <table cellspacing="0" border="0" width="100%" hright="100%"
            style="text-align:center;margin-top: 0px;width: 100%;border-bottom: none;">
            <tr>
                <td class="headingdesign">
                    <label class="marksheetheading">
                        PURCHASE ORDER
                    </label>
                </td>
            </tr>
        </table>
        <!-- ========================================heading============================== -->
        <!-- ============================main area======================================== -->
        <table cellspacing="0" border="0" width="100%" style="">
            <tr>
                <td
                    style="padding: 10px 0px 0px 10px;font-size: 14px;line-height: 23px;font-family: inherit;vertical-align:top;border-left: 2px solid black;border-bottom: 2px solid black;border-right:2px solid black;">
                    Invoice To<br>
                    <b>DITS HOSPITAL</b><br>
                    2-FR, FL-2/A, 54 HARISH MUKHERJEE ROAD,<br>
                    KOLKATA - 700025<br>
                    GSTIN/UIN: 19AASCA6670R1ZI<br>
                    State Name : West Bengal, Code : 19
                </td>
                <td
                    style="padding: 10px 0px 0px 10px;font-size: 14px;line-height: 23px;font-family: inherit;vertical-align:top;border-bottom: 2px solid black;border-right:2px solid black;">
                    PO No. :
                    <b><?php echo e($po_list->po_prefix); ?><?php echo e($po_list->po_id); ?></b><br>
                    Dated :
                    <b><?php echo e(date('d-m-Y',strtotime($po_list->po_date))); ?></b><br>
                    Terms of Payment :
                    <b><?php echo e($po_list->payment_terms); ?></b><br>
                </td>
                <td
                    style="padding: 10px 0px 0px 10px;font-size: 14px;line-height: 23px;font-family: inherit;vertical-align:top;border-bottom: 2px solid black;border-right:2px solid black;">
                    Consignee (Ship to)<br>
                    <b><?php echo e($po_list->item_store_room); ?></b><br>
                    <?php echo e($po_list->address); ?><br>
                </td>
                <td colspan="6"
                    style="padding: 10px 0px 0px 10px;font-size: 14px;line-height: 23px;font-family: inherit;vertical-align:top;border-bottom: 2px solid black;border-right:2px solid black;">
                    Supplier (Bill From)<br>
                    <b><?php echo e($po_list->vendor_name); ?></b><br>
                    <?php echo e($po_list->vendor_address); ?><br>
                    GSTIN/UIN : <?php echo e($po_list->vendor_gst); ?>

                </td>
            </tr>
        </table>
        <table cellspacing="0" border="0" width="100%" style="">
            <tr style="text-align: center; font-size: 13px;">
                <th
                    style="padding: 7px 0px 7px 0px;border-left: 2px solid black;border-bottom: 2px solid black;border-right: 2px solid black;">
                    SL No.
                </th>
                <th style="padding: 7px 0px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">
                    Req No.
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid black;border-bottom:2px solid black;">
                    Description of Goods
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid black;border-bottom:2px solid black;">
                    Part No.
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid black;border-bottom:2px solid black;">
                    HSN No.
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid black;border-bottom:2px solid black;">
                    SGST Rate
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid black;border-bottom:2px solid black;">
                    CGST Rate
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid black;border-bottom:2px solid black;">
                    Quantity
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid black;border-bottom:2px solid black;">
                    Rate
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid black;border-bottom:2px solid black;">
                    Per
                </th>
                <th style="padding: 7px 0px 7px 0px;border-right:2px solid black;border-bottom:2px solid black;">
                    Amount
                </th>
            </tr>
            <?php if(!empty($po_item)): ?>
                <?php $__currentLoopData = $po_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="text-align: left; font-size: 13px;">
                        <td
                            style="width: 70px;padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-left: 2px solid black;border-bottom: 2px solid black;border-right: 2px solid black;">
                            <?php echo e($loop->iteration); ?>

                        </td>
                        <td
                            style="width: 70px;padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">
                            <?php echo e(@$value->req_id); ?>

                        </td>
                        <td
                            style="padding: 7px 0px 7px 7px;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">
                            <b><?php echo e(@$value->item_name); ?>(<?php echo e(@$value->item_description); ?>)</b>
                        </td>
                        <td
                            style="padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">
                            <?php echo e(@$value->part_no); ?>

                        </td>
                        <td
                            style="padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">
                            <?php echo e(@$value->hsn_or_sac_no); ?>

                        </td>
                        <td
                            style="padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">
                            <?php echo $value->gst / 2; ?>%
                        </td>
                        <td
                            style="padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">
                            <?php echo $value->gst / 2; ?>%
                        </td>
                        <td
                            style="padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">
                            <b><?php echo e(@$value->quantity); ?> <?php echo e(@$value->units); ?></b>
                        </td>
                        <td
                            style="padding: 7px 0px 7px 0px;text-align: center;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">
                            <?php echo e(@$value->rate); ?>

                        </td>
                        <td
                            style="padding: 7px 7px 7px 7px;text-align: center;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">
                            <?php echo e(@$value->units); ?>

                        </td>
                        <td
                            style="padding: 7px 7px 7px 7px;text-align: center;vertical-align:top;border-bottom: 2px solid black;border-right: 2px solid black;">
                            <b><?php echo e(@$value->amount); ?></b>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <tr style="text-align: right; font-size: 13px;">
                <th
                    style="padding: 7px 0px 7px 0px;border-left: 2px solid black;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 0px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th
                    style="padding: 7px 0px 7px 0px;text-align: center;border-bottom: 2px solid black;border-right: 2px solid black;">
                    Total
                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th
                    style="padding: 7px 0px 7px 0px;text-align: center;border-bottom: 2px solid black;border-right: 2px solid black;">
                    <?php echo e($po_list->total); ?>

                </th>
            </tr>
            <tr style="text-align: right; font-size: 13px;">
                <th
                    style="padding: 7px 0px 7px 0px;border-left: 2px solid black;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 0px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th
                    style="padding: 7px 0px 7px 0px;text-align: center;border-bottom: 2px solid black;border-right: 2px solid black;">
                    <?php echo e($po_list->extra_charges_name); ?>

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th
                    style="padding: 7px 0px 7px 0px;text-align: center;border-bottom: 2px solid black;border-right: 2px solid black;">
                    <?php echo e($po_list->extra_charges_value); ?>

                </th>
            </tr>


            <tr style="text-align: right; font-size: 13px;">
                <th
                    style="padding: 7px 0px 7px 0px;border-left: 2px solid black;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 0px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th
                    style="padding: 7px 0px 7px 0px;text-align: center;border-bottom: 2px solid black;border-right: 2px solid black;">
                    Grand Total
                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th style="padding: 7px 7px 7px 0px;border-bottom: 2px solid black;border-right: 2px solid black;">

                </th>
                <th
                    style="padding: 7px 0px 7px 0px;text-align: center;border-bottom: 2px solid black;border-right: 2px solid black;">
                    <?php echo e($po_list->grand_total); ?>

                </th>
            </tr>
        </table>
        <!-- ============================main area======================================== -->
        <!-- ============================footer area===================================== -->
        <table cellspacing="0" border="0" width="100%" hright="100%" style="width:100%;">
            <tr>
                <td
                    style="padding: 10px 5px 5px 0px;font-size: 13px;border-left: 2px solid black;border-right: 2px solid black;border-bottom: 2px solid black;text-align:right;">
                    <b>E. & O.E</b>
                </td>
            </tr>
        </table>
        <table cellspacing="0" border="0" width="100%" hright="100%" style="width:100%;">
            <tr>
                <td
                    style="padding: 10px 0px 0px 10px;font-size: 14px;line-height: 23px;font-family: inherit;border-left: 2px solid black;border-bottom: 2px solid black;border-right: 2px solid black;width: 60%;">

                    Declaration<br>
                    We declare that this invoice shows the actual price of the
                    goods described and that all particulars are true and correct.
                </td>
                <td
                    style="padding: 10px 10px 0px 10px;font-size: 13px;line-height: 23px;font-family: inherit;border-bottom: 2px solid black;border-right: 2px solid black;text-align: right;width: 40%;">
                    <b>For DITS HOSPITAL</b><br><br><br>
                    Authorised Signatory
                </td>
            </tr>
        </table>
        <!-- ============================footer area===================================== -->
    </div>
</body>

</html>
<!-- =================================================================================== -->
<?php /**PATH D:\xampp\htdocs\DITS-HMIS-15-04-23\HMIS-HOSPITAL-MANAGEMENT\resources\views/Inventory/purchase-order/_print/_PurchaseOrder.blade.php ENDPATH**/ ?>