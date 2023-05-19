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
        html, body {
          width:25cm;
          height:33cm;;
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
        height: 33cm;;
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
<table style="width: 100%;border-collapse: collapse">
    <tr style="text-align: center;">
        <td>
            <img src="<?php echo e(asset('public/assets/images/brand/1571895010.png')); ?>" alt=""
            style="width: 80%;">
        </td>
    </tr>


    <table style="width: 100%; margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
        <tr>
        <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
            Date No.
          </th>
          <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
      18-05-2023
          </td>
          <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
             Bill No
          </th>
          <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
       033tyh
          </td>

        </tr>

<<<<<<< HEAD
=======
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="card-options">
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" style="">
                                    <a class="dropdown-item" href=""><i class="fa fa-file"></i> Bill Summary</a>
                                    <a class="dropdown-item"
                                        href="<?php echo e(route('opd-profile', ['id' => base64_encode($value->id)])); ?>"><i
                                            class="fa fa-eye"></i> View</a>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit opd patient')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('edit-opd-patient', base64_encode($value->id))); ?>">
                                        <i class="fa fa-edit"></i> Edit</a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete opd patient')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('delete-opd-patient', base64_encode(@$value->latest_opd_visit_details_for_patient->id))); ?>"><i class="fa fa-trash"></i>
                                        Delete</a>
                                    <?php endif; ?>
                                  
                                    <a class="dropdown-item" href="<?php echo e(route('print-opd-patient', base64_encode(@$value->latest_opd_visit_details_for_patient->id))); ?>"><i class="fa fa-print"></i>
                                        Print</a>
                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('opd billing')): ?>
                                    <a class="dropdown-item"
                                        href="<?php echo e(route('add-opd-billing',['id'=> base64_encode($value->id)])); ?>"><i
                                            class="fa fa-money-bill"></i>
                                        Add Billing</a>
                                    <?php endif; ?>
                                    <a class="dropdown-item"
                                        href="<?php echo e(route('payment-listing-in-opd', ['id' => base64_encode($value->id)])); ?>"><i
                                            class="fa fa-rupee-sign"></i>Take Payment</a>
>>>>>>> 22d70a23d629df5d33548505b9d6705a051c564c

  </table>
    <table style="width: 100%; margin: 10px 0px 0px 0px;border: 1px solid #899499;border-collapse: collapse;">
          <tr>
          <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                Patient Name
            </th>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
          Mr.Sanjay Bhunia
            </td>
            <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                UHID No
            </th>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                IIMSAR & DR.BCRHH/54010
            </td>
            <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                Guardian Name
            </th>
            <td colspan="3"  style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                H/O-Debashree Bhunia
            </td>
          </tr>
          <tr>
          <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
            Mobile No.
            </th>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
            7602386254
            </td>
            <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                Age
            </th>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                35Y 0M 0D
            </td>
            <th style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                Gender
            </th>
            <td colspan="3"style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                Male
            </td>
         </tr>


    </table>
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
                        <th colspan="3"style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                            Address
                        </th>
                        <td colspan="7" style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">
                           Vill+p.o-Bhekutia Ps-Nandigram,Purba-Medinipur,west-bengal,721656
                        </td>

                    </tr>
                </table>
          <table style="width: 100%">
            <tr style="width:100%">
                <td style= "width:100%">
                   <h1 style="text-align:center;font-size: 20px;margin: 29px 0px 10px 0px;background: #2a3c92;color: #fff;padding: 15px 0px 15px 0px;  width: 100%;">Medicine Details</h1>
                </td>
            </tr>
          </table>
    <table style="width: 100%;">

          <tr>
             <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">SL.NO</td>
             <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Medicine-Name</td>
             <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Qty</td>
             <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">Price</td>
         </tr>

         <tr>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">1</td>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;"> BCRHH/23040754010 </td>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">100</td>
            <td style="text-align: left;font-size: 11px; padding: 10px 10px 10px 10px;border: 1px solid #000;">10000</td>
         </tr>
   </table>
   <table style="width: 100%; margin: 0px 0px 0px 0px; border-collapse: collapse; border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;">
   <tr>
   <th style="text-align: right;font-size: 13px; padding: 13px 0px 12px 0px;">Total :</th>
   <td style="text-align: right;font-size: 13px; width:90px;padding: 0px 10px 0px 0px; ">10000</td>
</tr>

</table>

</table>
<!-- ==========================================code here================================== -->
</div>
</body>
</html>





<?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/OPD/opd-patient-list.blade.php ENDPATH**/ ?>