
<?php $__env->startSection('content'); ?>
<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit Purchase Order</div>

        </div>

        <form method="POST" action="<?php echo e(route('po-update')); ?>">
            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <input type="hidden" name="po_id" value="<?php echo e(@$po_list->id); ?>">
                        <div class="col-md-6">
                            <label class="form-label">Stroe Room <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" onchange="workshop_name(this.value)" id="storeroom" name="store_room_id">
                                <option value="">Select Store Room</option>
                                <?php if($storeroomList): ?>
                                <?php $__currentLoopData = $storeroomList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>" <?php echo e(@$po_list->store_room_id==$value->id?'selected':''); ?>><?php echo e($value->name); ?></option>
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
                        <div class="col-md-6">
                            <label class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="po_date" class="form-control" value="<?php echo e($po_list->po_date); ?>">
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

                        <div class="col-md-6" id="gofgk">
                            <label class="form-label">Vendor <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" id="ven" name="vendor" onchange="findrequisition(this.value)">
                                <option value="">Select Vendor</option>
                                <?php if($sl_vender): ?>
                                <?php $__currentLoopData = $sl_vender; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>" <?php echo e(@$po_list->get_vendor_details->id==$value->id?'selected':''); ?>><?php echo e($value->vendor_name); ?>( <?php echo e($value->vendor_gst); ?> )</option>
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
                        <div class="col-md-6">
                            <label class="form-label">Requisition <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search" onchange="findrequisitiondetails(this.value)" name="requisition_no" id="requisitiohbf">
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
                                    <th scope="col" style="width: 40%">Item <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 25%">Quantity <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 7%">GST <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 13%">Rate <span class="text-danger">*</span></th>
                                    <th scope="col" style="width: 15%">Amount <span class="text-danger">*</span></th>

                                </tr>
                            </thead>
                            <tbody id="alltextre">

                                <?php if(isset($po_item ) && !empty($po_item)): ?>
                                <?php $i = 0; ?>
                                <?php $__currentLoopData = $po_item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $poItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $i += 1; ?>
                                <tr id="rowid<?php echo e($loop->iteration); ?>">
                                    <input type="hidden" readonly class="form-control <?php echo e($i); ?>" required name="req_id_no[]" value="<?php echo e($poItem->req_no); ?>" />
                                    <input type="hidden" readonly class="form-control" required name="req_id[]" value="<?php echo e($poItem->req_id); ?>" />
                                    <input class="form-control" type="hidden" name="requisition_details_id[]" required readonly value="<?php echo e($poItem->req_details_id); ?>" />
                                    <input class="form-control" type="hidden" name="catagory[]" required readonly value="<?php echo e($poItem->fetch_medicine_catagory->id); ?>" />
                                    <input class="form-control" type="hidden" name="unit[]" required readonly value="<?php echo e($poItem->fetch_medicine_unit->id); ?>" />
                                    <td>
                                        <a href="<?php echo e(url('requisition-details')); ?>/<?php echo e($poItem->req_no); ?>" target="_blank">
                                            <span class="req_no_style">Requisition No - <?php echo e($poItem->req_id); ?></span>
                                        </a>
                                        <select name="medicine[]" required class="form-control" readonly>
                                            <option value="<?php echo e($poItem->fetch_medicine_name->id); ?>"><?php echo e($poItem->item_name); ?>(Catagory : <?php echo e($poItem->fetch_medicine_catagory->medicine_catagory_name); ?>)(Unit : <?php echo e($poItem->fetch_medicine_unit->medicine_unit_name); ?>)</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" required name="qty[]" value="<?php echo e($poItem->quantity); ?>" onkeyup="getamount(<?php echo e($loop->iteration); ?>)" id="qty<?php echo e($loop->iteration); ?>" class="form-control" style="width: 60%; float: left;">
                                        </select>
                                    </td>
                                    <td><input type="text" onkeyup="getamount(<?php echo e($loop->iteration); ?>)" required name="gst[]" id="gst<?php echo e($loop->iteration); ?>" class="form-control" value="<?php echo e($poItem->gst); ?>"></td>
                                    <td><input type="text" onkeyup="getamount(<?php echo e($loop->iteration); ?>)" id="rate<?php echo e($loop->iteration); ?>" required name="rate[]" class="form-control" value="<?php echo e($poItem->rate); ?>"></td>
                                    <td><input type="text" required name="amount[]" id="amount<?php echo e($loop->iteration); ?>" class="form-control" value="<?php echo e($poItem->amount); ?>"></td>
                                    <td><button type="button" class="btn btn-danger" onclick="remove(<?php echo e($loop->iteration); ?>)"><i class="fa fa-trash"></i></button></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container mt-5">
                    <div class="d-flex justify-content-end">
                        <span class="biltext">Total</span>
                        <input type="text" name="total" readonly id="total_am" class="form-control myfld">
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="text" name="extra_charges_name" placeholder="Enter Extra Charges Name" class="form-control myfld2" value="<?php echo e($po_list->extra_charges_name?$po_list->extra_charges_name:''); ?>">
                        <input type="text" name="extra_charges_value" value="<?php echo e($po_list->extra_charges_value?$po_list->extra_charges_value:00); ?>" class="form-control myfld1" id="extra_chages">
                    </div>
                    <div class="d-flex justify-content-end thrdarea">
                        <span class="biltext">Grand Total</span>
                        <input type="text" name="grand_total" readonly id="grnd_total" value="00" class="form-control myfld">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Note</label>
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
    $(document).ready(function() {
        let vendor_id = $('#ven').val();
        findrequisition(vendor_id);
    });

    function workshop_name(value) {
        if (value != null) {
            $('#requisitiohbf').empty();
            //$('#alltextre').empty(); 
        }
    }

    function gettotal() {

        var no_of_row = $('#subhendu tr').length;
        console.log('aaa=>', no_of_row);

        var t = 0;
        $("input[name='amount[]']").map(function() {
            t = t + parseFloat($(this).val());
        }).get();

        var extra = $('#extra_chages').val();

        var grnd_total = parseFloat(t) + parseFloat(extra);
        $('#total_am').val(t);
        $('#grnd_total').val(grnd_total);
    }
</script>

<script type="text/javascript">
    function findrequisition(vendor_id) {
        $('#requisitiohbf').empty();

        var html = "<option>Select One</option>";
        var storeroom = $('#storeroom').val();

        $.ajax({

            url: "<?php echo e(route('get-requisition-details')); ?>/" + vendor_id + "/" + storeroom,
            type: "get",
            dataType: 'json',
            success: function(res) {

                $.each(res, function(index, value) {
                    html += "<option value='" + value.requisition_id + "'>" + value.requisition_prefix + "" + value.requisition_id + "</option>";

                });
                $('#requisitiohbf').append(html);

            }
        });

    }
</script>

<script type="text/javascript">
    var i = <?= $i + 1 ?>;

    function findrequisitiondetails(requisition_id) {

        $.ajax({

            url: "<?php echo e(route('get-requisition-item-details')); ?>/" + requisition_id,
            type: "get",
            dataType: 'json',
            success: function(resp) {

                $.each(resp, function(input, res) {
                    var html = '<tr id="rowid' + i + '"><input type="hidden" readonly class="form-control" required name="req_id_no[]" value="' + res.requisition_id + '"/><input type="hidden" readonly class="form-control" required name="req_id[]" value="' + res.requisition_prefix + "" + res.requisition_id + '"/><input class="form-control" type="hidden" name="requisition_details_id[]" required readonly value="' + res.requisition_details_id + '" /><input class="form-control" type="hidden" name="catagory[]" required readonly value="' + res.medicine_catagories_id + '" /><input class="form-control" type="hidden" name="unit[]" required readonly value="' + res.medicine_units_id + '" /><td><a href="<?php echo e(route("medicine-requisition-details")); ?>/' + res.requisition_id + '" target="_blank"><span class="req_no_style">Requisition No - ' + res.requisition_prefix + res.requisition_id + '</span></a><select name="medicine[]" required class="form-control" readonly><option value="' + res.medicine_id + '">' + res.medicine_name + '(' + res.quantity + ')' + '(Catagory :' + res.medicine_catagory_name + ')(Unit :' + res.medicine_unit_name + ')</option></select></td><td><input type="text" required name="qty[]" value="' + res.quantity + '" onkeyup="getamount(' + i + ')" id="qty' + i + '" class="form-control" style="width: 60%; float: left;"><td><input type="text" onkeyup="getamount(' + i + ')" required name="gst[]" id="gst' + i + '" class="form-control"></td><td><input type="text"  onkeyup="getamount(' + i + ')" id="rate' + i + '" required name="rate[]" class="form-control"></td><td><input type="text" required name="amount[]" id="amount' + i + '" class="form-control grgrtg"></td><td><button type="button" class="btn btn-danger" onclick="remove(' + i + ')"><i class="fa fa-trash"></i></button></td></tr>';
                    $('#subhendu').append(html);
                    i = i + 1;
                });
            }
        });
    }

    function req_id_no() {

    }
</script>

<script type="text/javascript">
    function getamount(i) {
        var gst = $('#gst' + i).val();
        console.log(gst);
        var rate = $('#rate' + i).val();
        console.log(rate);
        var qty = $('#qty' + i).val();
        console.log(qty);

        var amnt = (parseFloat(rate) * parseFloat(qty) * parseFloat(gst)) / 100;
        var t_amnt = parseFloat(amnt) + (parseFloat(rate) * parseFloat(qty));

        $('#amount' + i).val(t_amnt);
    }
</script>


<script type="text/javascript">
    function remove(i) {
        $('#rowid' + i).remove();
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\DITS-HMIS\resources\views/pharmacy/purchase/purchase-order/edit-purchase-order-details.blade.php ENDPATH**/ ?>