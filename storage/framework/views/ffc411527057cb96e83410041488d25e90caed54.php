
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Create Purchase Order</div>

            </div>

            <form method="POST" action="<?php echo e(route('save-medicine-purchase-order')); ?>">
                <?php echo csrf_field(); ?>
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 ">
                                <label class="form-label">Store Room <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search" onchange="findrequisition()" id="storeroom"
                                    name="store_room_id">
                                    <option value="">Select Store Room</option>
                                    <?php if($storeroomList): ?>
                                        <?php $__currentLoopData = $storeroomList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <?php $__errorArgs = ['store_room_id'];
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
                            <div class="col-md-6 purchaseadd">
                             <label class="form-label">Date <span class="text-danger">*</span></label>  

                                <input type="datetime-local" name="po_date" class="form-control">
                                <?php $__errorArgs = ['po_date'];
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

                            <div class="col-md-6  addpurchase" addpurchase id="gofgk" >
                                <label class="form-label">Vendor <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search" id="ven" name="vendor"
                                    onchange="findrequisition()">
                                    <option value="">Select Vendor</option>
                                    <?php if($vendor_list): ?>
                                        <?php $__currentLoopData = $vendor_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->vendor_name); ?>(
                                                <?php echo e($value->vendor_gst); ?> )</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                                <?php $__errorArgs = ['vendor'];
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
                            <div class="col-md-6" style="margin: 18px 0px 0px 0px;">
                                <label class="form-label">Requisition <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search"
                                    onchange="findrequisitiondetails(this.value)" name="requisition_no" id="requisitiohbf">
                                    <option value="">Select One.....</option>
                                </select>
                            </div>

                        </div>

                    </div>
                    <hr>
                    <div class="">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap" id="subhendu">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 40%">Medicine <span class="text-danger">*</span>
                                        </th>
                                        <th scope="col" style="width: 25%">Unit <span class="text-danger">*</span>
                                        </th>
                                        <th scope="col" style="width: 25%">Quantity <span class="text-danger">*</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="alltextre">
                                    <?php $__errorArgs = ['item'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <!-- dynamic row -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    
                    <div class="col-md-12" style="margin: 55px 0px 0px 0px;">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Note</label>
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
        function findrequisition() {
            $('#requisitiohbf').html('<option value="">Select One.....</option>');
            $('#alltextre').empty();
            $("#ven").prop("selected", false);
            var html = "<option>Select One</option>";
            var storeroom = $('#storeroom').val();
            var vendor_id = $('#ven').val();
            var html = '';
            $.ajax({

                url: "<?php echo e(route('get-requisition-details')); ?>/" + vendor_id + "/" + storeroom,
                type: "get",
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $.each(res, function(index, value) {
                        html += "<option value='" + value.requisition_id + "'>" + value
                            .requisition_prefix + "" + value.requisition_id + "</option>";

                    });
                    $('#requisitiohbf').append(html);

                }
            });

        }
    </script>

    <script type="text/javascript">
        var i = 1;

        function findrequisitiondetails(requisition_id) {

            // alert(requisition_id);
            $.ajax({
                url: "<?php echo e(route('get-requisition-item-details')); ?>/" + requisition_id,
                type: "get",
                dataType: 'json',
                success: function(resp) {
                    console.log(resp);

                    $.each(resp, function(input, res) {
                        var html = '<tr id="rowid' + i +
                            '"><input type="hidden" readonly class="form-control" required name="req_id_no[]" value="' +
                            res.requisition_id +
                            '"/><input type="hidden" readonly class="form-control" required name="req_id[]" value="' +
                            res.requisition_prefix + "" + res.requisition_id +
                            '"/><input class="form-control" type="hidden" name="requisition_details_id[]" required readonly value="' +
                            res.requisition_details_id +
                            '" /><input class="form-control" type="hidden" name="unit[]" required readonly value="' +
                            res.medicine_units_id +
                            '" /><td><span class="req_no_style">Requisition No - ' + res
                            .requisition_prefix + res.requisition_id +
                            '</span><select name="medicine[]" required class="form-control" readonly><option value="' +
                            res.medicine_id + '">' + res.medicine_name+'('+res.medicine_catagory_name+')' +
                            '</option></select></td><td><select name="unit[]" required class="form-control" readonly><option value="' +res.medicine_units_id + '">' + res.medicine_unit_name +
                            '</option></select></td><td><input type="text" required name="qty[]" value="' +
                            res.quantity + '" onkeyup="getamount(' + i + ')" id="qty' + i +
                            '" class="form-control" ><td><button type="button" class="btn btn-danger btn-sm" onclick="remove(' +
                            i + ')"><i class="fa fa-trash"></i></button></td></tr>';
                        $('#subhendu').append(html);
                        i = i + 1;
                    });
                }
            });
            //    $('#requisitiohbf').('option[value=' +requisition_id+ ']').prop('disabled',true);
        }
    </script>


    <script type="text/javascript">
        function remove(i) {
            $('#rowid' + i).remove();
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/purchase/purchase-order/add-medicine-purchase-order.blade.php ENDPATH**/ ?>