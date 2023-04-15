
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Create Purchase Order</div>

        </div>
<form method="POST" action="<?php echo e(route('save-purchase-order')); ?>">
    <?php echo csrf_field(); ?>
    <div class="card-body">
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-4">
                <label  class="form-label">Workshop <span class="text-danger">*</span></label>
               <select class="form-control select2-show-search" name="workshop">
                   <option value="">Select Workshop</option>
                   <?php if($workshop_list): ?>
                     <?php $__currentLoopData = $workshop_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <?php endif; ?>
               </select>
            </div>
            <div class="col-md-4">
                 <label  class="form-label">Date <span class="text-danger">*</span></label>
                 <input type="datetime-local" name="po_date" class="form-control">
            </div>

             <div class="col-md-4">
                <label  class="form-label">Permission Authority</label>
               <select name="permission_authority[]" multiple="multiple" class="multi-select select2-show-search">
                   <option value="">......................... Select One ............................</option>
                   <?php if($user_list): ?>
                     <?php $__currentLoopData = $user_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <?php endif; ?>
               </select>
            </div>

              <div class="col-md-4">
                <label  class="form-label">Vendor <span class="text-danger">*</span></label>
               <select class="form-control select2-show-search" name="vendor" onchange="findrequisition(this.value)">
                   <option value="">Select Vendor</option>
                   <?php if($vendor_list): ?>
                     <?php $__currentLoopData = $vendor_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($value->id); ?>"><?php echo e($value->vendor_name); ?>( <?php echo e($value->vendor_gst); ?> )</option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   <?php endif; ?>
               </select>
            </div>
            <div class="col-md-4">
                <label  class="form-label">Requisition <span class="text-danger">*</span></label>
               <select class="form-control select2-show-search" onchange="findrequisitiondetails(this.value)"  name="requisition_no" id="requisitiohbf">
               </select>
            </div>
          <!--   <div class="col-md-4"  style="margin-top: 26px;">
                <div class="row">
                <div class="col-md-6">
            <label  class="form-label">
               Single Permission </label> <input type="radio" name="item_permission" value="1"  >
           </div>
            <div class="col-md-6">
            <label  class="form-label"> Multiple Permission </label> <input type="radio" name="item_permission" value="2"  ></div>
            </div>
            </div> -->

            </div>

        </div>
        <hr>
        <div class="">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                <thead>
                    <tr>
                        <th scope="col" style="width: 14%">Requisition No. <span class="text-danger">*</span></th>
                        <th scope="col" style="width: 5%">Item Type <span class="text-danger">*</span></th>
                        <th scope="col" style="width: 5%">Brand <span class="text-danger">*</span></th>
                        <th scope="col" style="width: 5%">Manufacturer <span class="text-danger">*</span></th>
                        <th scope="col" style="width: 20%">Item <span class="text-danger">*</span></th>
                        <th scope="col" style="width: 13%">Quantity <span class="text-danger">*</span></th>
                        <th scope="col" style="width: 7%">GST <span class="text-danger">*</span></th>
                        <th scope="col" style="width: 13%">Rate <span class="text-danger">*</span></th>
                         <th scope="col" style="width: 18%">Amount <span class="text-danger">*</span></th>

                    </tr>
                </thead>
                <tbody>
                         <!-- dynamic row -->
                </tbody>
                </table>
            </div>
        </div>

        <input type="hidden" name="rowno_" id="jsdfbujdg">
          <div class="container mt-5">
               <div class="d-flex justify-content-end">
                   <span class="biltext">Total</span>
                   <input type="text" name="total" readonly id="total_am" class="form-control myfld">
               </div>
               <div class="d-flex justify-content-end">
                   <input type="text" name="extra_charges_name" placeholder="Enter Extra Charges Name" class="form-control myfld2">
                   <input type="text" name="extra_charges_value" value="00" class="form-control myfld1" id="extra_chages">
               </div>
               <div class="d-flex justify-content-end thrdarea">
                   <span class="biltext">Grand Total</span>
                   <input type="text" name="grand_total" readonly id="grnd_total" value="00" class="form-control myfld">
               </div>
          </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                 <label  class="form-label">Note</label>
                <textarea name="note" class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class=" text-right">
        <button class="btn btn-success" onclick="gettotal()" type="button"><i class="fa fa-calculator"></i> Calculate</button>
        <button class="btn btn-primary" type="submit"><i class="fa fa-send"></i> Submit</button>
    </div>
                <!-- End Table with stripped rows -->
            </div>
        </div>
    </div>
 </form>
 </div>
</div>

<script type="text/javascript">
    function gettotal()
    {
       // alert('ifisfi');
        var no_of_row =  $('#jsdfbujdg').val();
       console.log(no_of_row);
        var t = 0;
        for(var i = 1 ; i < no_of_row ; i++)
        {
            var total = $('#amount'+i).val();
            console.log(total);
            var t = parseFloat(total) + parseFloat(t);

        }
       // console.log(t);
       var extra = $('#extra_chages').val();
       var grnd_total = parseFloat(t) + parseFloat(extra);
       $('#total_am').val(t);
       $('#grnd_total').val(grnd_total);
    }
</script>

<script type="text/javascript">
    function findrequisition(vendor_id)
    {
        var html = "<option>Select One</option>"
          $.ajax({

                url: "<?php echo e(url('get-requisition-details')); ?>/"+vendor_id,
                type: "get",
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    var pr = res.prefix.prefix;

                $.each(res.requisition_list, function( index, value ) {
                  html += "<option value='"+value.requisition_id+"'>"+pr+""+value.requisition_id+"</option>";
                });
                $('#requisitiohbf').append(html);
            }
        });

    }
</script>

<script type="text/javascript">
     var i = 1;
    function findrequisitiondetails(requisition_id)
    {
           $.ajax({

            url: "<?php echo e(url('get-requisition-item-details')); ?>/"+requisition_id,
            type: "get",
            dataType: 'json',
            success: function (resp) {
                var pr = resp.prefix.prefix;
            $.each(resp.requisition_item_list, function (input, res)
            {
                  var html = '<tr id="rowid'+i+'"><td><input type="text" readonly class="form-control" required name="req_id[]" value="'+pr+""+res.requisition_id+'"/></td><td><select class="form-control" name="item_type[]" required readonly ><option value="'+res.items_types_id+'">'+res.item_type+' </option></select></td><td><select name="brand[]" required class="form-control" readonly><option value="'+res.brands_id+'">'+res.brand_name+'</option></select></td><td><select name="manufacturer[]" required class="form-control" readonly><option value="'+res.manufacturer_id+'">'+res.manufacturar_name+'</option></select></td><td><select name="item[]" required class="form-control" readonly><option value="'+res.item_id+'">'+res.item_name+'('+res.item_description+')</option></select></td><td><input type="text" required name="qty[]" value="'+res.quantity+'" onkeyup="getamount('+i+')" id="qty'+i+'" class="form-control" style="width: 60%; float: left;"><input type="text" name="unit[]" required value="'+res.units+'" readonly class="form-control" style="width: 40%; float: left;"></td><td><input type="text" onkeyup="getamount('+i+')" required name="gst[]" id="gst'+i+'" class="form-control"></td><td><input type="text"  onkeyup="getamount('+i+')" id="rate'+i+'" required name="rate[]" class="form-control"></td><td><input type="text" required name="amount[]" id="amount'+i+'" class="form-control"></td><td><button class="btn btn-danger" onclick="remove('+i+')"><i class="fa fa-times"></i></button></td></tr>';
                $('#subhendu').append(html);
                i = i + 1;
            });
           $('#jsdfbujdg').val(i);
        }
     });
    }
</script>

<script type="text/javascript">
    function getamount(i)
    {
        var gst =  $('#gst'+i).val();
        console.log(gst);
        var rate =  $('#rate'+i).val();
         console.log(rate);
        var qty =  $('#qty'+i).val();
         console.log(qty);

        var amnt = ( parseFloat(rate) * parseFloat(qty) * parseFloat(gst) ) / 100;
        var t_amnt = parseFloat(amnt) + (parseFloat(rate) * parseFloat(qty));

        $('#amount'+i).val(t_amnt);


    }
</script>


<script type="text/javascript">
    function remove(i){
        $('#rowid'+i).remove();
    }
</script>
<script type="text/javascript">
    function getitem(rowno)
    {

       var item_type =  $('#item_type'+rowno).val();
       var brand =  $('#brand'+rowno).val();
       var manufacturer =  $('#manufacturer'+rowno).val();
        var div_data ='';
        var unit ='';
        $.ajax({

                url: "<?php echo e(route('get-item')); ?>",
                type: "post",
                data: {
                       item_type_id: item_type,
                       brand_id: brand,
                       manufacturer_id: manufacturer,
                       _token:'<?php echo e(csrf_token()); ?>',
                },
                dataType: 'json',
                success: function (res) {
                console.log(res);
                $.each(res, function (i, obj)
                {
                    div_data += "<option value=" + obj.item_id + ">" + obj.item_name +"("+obj.item_description+") </option>";
                    unit = obj.units;
                });

                $('#item'+rowno).append(div_data);
                $('#unit'+rowno).val(unit);
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\ame_inventory\resources\views/appPages/item/purchase-order/po_create.blade.php ENDPATH**/ ?>