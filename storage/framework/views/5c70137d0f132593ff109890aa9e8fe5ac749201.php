
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Create GRM</div>
        </div>


<form method="POST" action="<?php echo e(route('save-grm')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="card-body">
        <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <label  class="requisition_header">Purchase Order <span class="text-danger">*</span></label>
               <select class="form-control select2-show-search" onchange="findPOdetails(this.value)"  name="po_no" id="po">
                <option value="">Select One</option>
                <?php if(!empty($po_list)): ?>
                <?php $__currentLoopData = $po_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($valu->po_id); ?>"><?php echo e($valu->po_prefix); ?><?php echo e($valu->po_id); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
               </select>
            </div>

            <div class="col-md-4">
                <label  class="requisition_header">Materials Rec. Date<span class="text-danger">*</span></label>
                <input type="date" name="material_rec_date" class="form-control">
            <?php $__errorArgs = ['material_rec_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-4">
                <label  class="requisition_header">Bill Rec. Date<span class="text-danger">*</span></label>
                <input type="date" name="bill_rec_date" class="form-control">
            <?php $__errorArgs = ['bill_rec_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="text-danger"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-4">
                <label  class="requisition_header">Challan No.</label>
                <input type="text" name="challan_no" class="form-control">
            </div>
            <div class="col-md-4">
                <label  class="requisition_header">Challan Date</label>
                <input type="date" name="challan_date" class="form-control">
            </div>
            <div class="col-md-4">
                <label  class="requisition_header">Challan Copy</label>
                <input type="file" name="challan_copy">
            </div>


            <div class="col-md-4">
                <label  class="requisition_header">Invoice No.</label>
                <input type="text" name="invoice_no" class="form-control">
            </div>
            <div class="col-md-4">
                <label  class="requisition_header">Invoice Date</label>
                <input type="date" name="invoice_date" class="form-control">
            </div>
            <div class="col-md-4">
                <label  class="requisition_header">Invoice Copy</label>
                <input type="file" name="invoice_copy">
            </div>



            <div class="col-md-12">
                <span class="requisition_header">Purchase Order : </span><span id="po_no" class="requisition_header" style="color:blue"></span>
            </div>
            <div class="col-md-4">
                <span class="requisition_header">PO. Date : </span><span id="po_date" class="requisition_text"></span>
            </div>
            <div class="col-md-4">
                <span class="requisition_header">Workshop : </span><span id="workshop" class="requisition_text"></span>
            </div>
            <input type="hidden" name="workshop_id" id="wrk_id">
            <input type="hidden" name="vendor" id="vend_id">
            <div class="col-md-4">
                <span class="requisition_header">Vendor : </span><span id="vendor_name" class="requisition_text"></span>
            </div>
            
        </div>
        <div class="row" id="req_details">
           

            
        </div>
        </div>
        <hr>
        <div class="">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                <thead>
                    <tr>
                        <th scope="col" style="width: 25%">Req Id <span class="text-danger">*</span></th>
                        <th scope="col" style="width: 55%">Item <span class="text-danger">*</span></th>
                        <th scope="col" style="width: 18%">Quantity <span class="text-danger">*</span></th>
                        <th scope="col" style="width: 2%"></th>


                    </tr>
                </thead>
                <tbody id="alltextre">
                         <!-- dynamic row -->
                </tbody>
                </table>
            </div>
        </div>

        <input type="hidden" name="rowno_" id="jsdfbujdg">
          <div class="container mt-5">
               <div class="d-flex justify-content-end">
                   <span class="biltext">Invoice Value</span>
                   <input type="text" name="invoice_value"  id="invoice_value" class="form-control myfld">
               </div>
                  <div class="d-flex justify-content-end thrdarea">
                   <span class="biltext">PO. Value</span>
                   <input type="text" name="po_value" id="po_value" class="form-control myfld">
               </div>

               <div class="d-flex justify-content-end thrdarea">
                   <span class="biltext">Purpose</span>
                   <textarea name="purpose" class="form-control myfld"></textarea>
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

    function workshop_name(value)
    {
        if(value != null)
        {
           $('#requisitiohbf').empty();
           $('#alltextre').empty(); 
        }
    }

    function gettotal()
    {

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

<script src="http://www.datejs.com/build/date.js" type="text/javascript"></script>

<script type="text/javascript">
     var i = 1;
    function findPOdetails(po_id)
    {
           $.ajax({

            url: "<?php echo e(url('get-po-item-details/')); ?>/"+po_id,
            type: "get",
            dataType: 'json',
            success: function (resp) {
                console.log(resp.po_list.grand_total);
            $('#po_no').text(resp.po_list.po_prefix+''+resp.po_list.po_id);
            $('#po_date').text(resp.po_list.po_date);
            $('#workshop').text(resp.po_list.workshop_name);
            $('#wrk_id').val(resp.po_list.workshop_id_no);
            $('#vend_id').val(resp.po_list.vendor_id_no);
            $('#vendor_name').text(resp.po_list.vendor_name);
            $('#po_value').val(resp.po_list.grand_total);
            
            $.each(resp.po_item, function (input, res)
            {
                console.log(res.brands_id);
                  var html = '<tr id="rowid'+i+'"><td><input class="form-control" type="hidden" name="po_details_id[]" required readonly value="'+res.purchase_order_details_id+'" /><input class="form-control" type="text" name="req[]" required readonly value="'+res.req_id+'" /></td><td><input class="form-control" type="hidden" name="amount[]" required readonly value="'+res.amount+'" /><input class="form-control" type="hidden" name="rate[]" required readonly value="'+res.rate+'" /><input class="form-control" type="hidden" name="gst[]" required readonly value="'+res.gst+'" /><input class="form-control" type="hidden" name="brand[]" required readonly value="'+res.brands_id+'" /><input class="form-control" type="hidden" name="manufacturer[]" required readonly value="'+res.manufacturer_id+'" /><select name="item[]" required class="form-control" readonly><option value="'+res.item_id+'">'+res.item_name+'('+res.item_description+')(Brand :'+res.brand_name+')(Manufacturer :'+res.manufacturar_name+')</option></select></td><td><input type="hidden" required name="ori_qty[]" value="'+res.quantity+'" ><input type="text" required name="qty[]" value="'+(parseFloat(res.quantity) - parseFloat(res.grm_qty))+'" id="qty'+i+'" class="form-control" style="width: 60%; float: left;"><select name="unit[]" class="form-control" style="width: 40%; float: left;"><option value="'+res.unit_id+'">'+res.units+'</option></select></td><td><button type="button" class="btn btn-danger" onclick="remove('+i+')"><i class="fa fa-times"></i></button></td></tr>';
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

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/item/purchase-order/grm-create.blade.php ENDPATH**/ ?>