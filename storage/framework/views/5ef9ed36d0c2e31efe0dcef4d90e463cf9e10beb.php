
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6 card-title">
                        Patient
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="d-block">
                            <a href="<?php echo e(asset('public/import/patient/patients.csv')); ?>" class="btn btn-primary btn-sm"
                                download="Patients"><i class="fa fa-download"></i>
                                Download Sample Data </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <p>1. Your CSV data should be in the format below. The first line of your CSV file should be the column
                        headers as in the table example.<br><span style="color:red">When you import Please remove Header of your file</span> <br>Also make sure that your file is UTF-8 to avoid unnecessary
                        encoding problems.</p>
                    <p>2. For Prefix column use Mr. , Mrs. , Baby , Dr. , Miss , Devi , Mst.</p>
                    <p>3. Gurdian with Relation(guardian_name_realation) use C/O , H/O , W/O</p>
                    <p>4. For patient 'Gender' use Male, Female value.</p>
                    <p>5. For Age column 'Age (year)' and 'Age (month)' and 'Age (day)' make sure that is numbers only.</p>
                    <p> 7. For patient 'Marital Status' user Single, Married, Widowed, Separated, Not Specified value.</p>
                    <p>8. For identification_name use Voter Card, Aadhar Card</p>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class=" table-responsive">
                            <table class="table table-bordered text-nowrap key-buttons">
                                <thead>
                                    <tr>
                                        <th class="border-bottom-0">prefix<span class="text-danger">*</span></th>
                                        <th class="border-bottom-0">first_name<span class="text-danger">*</span> </th>
                                        <th class="border-bottom-0">middle_name</th>
                                        <th class="border-bottom-0">last_name<span class="text-danger">*</span></th>
                                        <th class="border-bottom-0">guardian_name<span class="text-danger">*</span></th>
                                        <th class="border-bottom-0">guardian_name_realation<span
                                                class="text-danger">*</span></th>
                                        <th class="border-bottom-0">marital_status<span class="text-danger">*</span></th>
                                        <th class="border-bottom-0">blood_group<span class="text-danger">*</span></th>
                                        <th class="border-bottom-0">date_of_birth<span class="text-danger">*</span></th>
                                        <th class="border-bottom-0">year<span class="text-danger">*</span></th>
                                        <th class="border-bottom-0">month<span class="text-danger">*</span></th>
                                        <th class="border-bottom-0">day<span class="text-danger">*</span></th>
                                        <th class="border-bottom-0">phone<span class="text-danger">*</span></th>
                                        <th class="border-bottom-0">email</th>
                                        <th class="border-bottom-0">address<span class="text-danger">*</span></th>
                                        <th class="border-bottom-0">state<span class="text-danger">*</span></th>
                                        <th class="border-bottom-0">district<span class="text-danger">*</span></th>
                                        <th class="border-bottom-0">pin_no<span class="text-danger">*</span></th>
                                        <th class="border-bottom-0">identification_name</th>
                                        <th class="border-bottom-0">identification_number</th>
                                        <th class="border-bottom-0">remarks</th>
                                        <th class="border-bottom-0">known_allergies</th>

                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <hr>
                <form action="<?php echo e(route('upload-import-patient')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="state">State <span class="text-danger">*</span></label>
                            <select name="state" class="form-control select2-show-search" id="state">
                                <option value="">Select State... </option>
                                <?php $__currentLoopData = $state; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $states): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($states->id); ?>"><?php echo e($states->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <small class="text-danger"><?php echo e($errors->first('address')); ?></small>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="district">District <span class="text-danger">*</span></label>
                            <select name="district" class="form-control select2-show-search" id="district" required>
                                <option value="">Select District...</option>
                            </select>
                            <small class="text-danger"><?php echo e($errors->first('district')); ?></small>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="district">File <span class="text-danger">*</span></label>
                            <input type="file" name="patient_file" class="form-control" required />

                            <small class="text-danger"><?php echo e($errors->first('patient_file')); ?></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add Patient</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#state").change(function(event) {
                // alert('ok')
                event.preventDefault();
                let state = $(this).val();
                // alert(state);
                $('#district').html('<option vaule="" >Select District...</option>');
                $.ajax({
                    url: "<?php echo e(route('find-fr-district-by-state')); ?>",
                    type: "POST",
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        state_id: state,
                    },

                    success: function(response) {


                        $.each(response, function(key, value) {
                            $('#district').append(
                                `<option value="${value.id}">${value.name}</option>`
                                );
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\DITS-HMIS\resources\views/setup/patient/import_patient.blade.php ENDPATH**/ ?>