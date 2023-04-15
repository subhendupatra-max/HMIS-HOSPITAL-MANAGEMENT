
<?php $__env->startSection('content'); ?>
<!-- ================================ Alert Message===================================== -->
            <?php if(session('success')): ?>
            <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if(session()->has('error')): ?>
            <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo e(session('error')); ?></div>
            <?php endif; ?>
<!-- ================================ Alert Message===================================== -->
	<div class="col-xl-4 col-lg-3 col-md-12">
		<div class="card box-widget widget-user">
			<div class="widget-user-image mx-auto mt-5"><img alt="User Avatar" class="rounded-circle" src="<?php echo e(asset('public/profile_picture')); ?>/<?php echo e($login_details->profile_image); ?>" style="height: 100px;width: 117px;"></div>
			<div class="card-body text-center">
				<div class="pro-user">
					<h4 class="pro-user-username text-dark mb-1 font-weight-bold"><?php echo e($login_details->name); ?></h4>
					<h6 class="pro-user-desc text-muted"><?php echo e($login_details->role_as); ?></h6>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user active deactive')): ?>
                <?php if($login_details->id != Auth::id()): ?>
                    <?php if($login_details->is_active == '1'): ?>
					<a href="<?php echo e(route('user-enable-disable',base64_encode($login_details->id))); ?>"  class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Disabled"><i class="fa fa-thumbs-o-down"></i></a>
                    <?php endif; ?>

                    <?php if($login_details->is_active == '0'): ?>
					<a href="<?php echo e(route('user-enable-disable',base64_encode($login_details->id))); ?>"  class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Enabled"><i class="fa fa-thumbs-o-up"></i></a>
                    <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>
              	<?php if(auth()->user()->can('user edit') || $login_details->id == Auth::id()): ?>
					<a href="<?php echo e(route('user-edit',base64_encode($login_details->id))); ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Profile"><i class="fa fa-pencil"></i></a>	
                <?php endif; ?>

                <?php if($login_details->id == Auth::id()): ?>
					<a href="<?php echo e(route('change-password')); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Change Password"><i class="fa fa-key"></i></a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user delete')): ?>
                <?php if($login_details->id != Auth::id()): ?>
					<a href="<?php echo e(route('user-delete',base64_encode($login_details->id))); ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
				<?php endif; ?>
				<?php endif; ?>
				</div>
			</div>
			<div class="card-body">
				<h4 class="card-title">Personal Details</h4>
				<div class="table-responsive">
					<table class="table mb-0">
						<tbody>
							<tr>
								<td class="py-2 px-0">
									<span class="font-weight-semibold w-50">Name </span>
								</td>
								<td class="py-2 px-0"><?php echo e($login_details->name); ?></td>
							</tr>
							<tr>
								<td class="py-2 px-0">
									<span class="font-weight-semibold w-50">Gender </span>
								</td>
								<td class="py-2 px-0"><?php echo e($login_details->gender); ?></td>
							</tr>
							<tr>
								<td class="py-2 px-0">
									<span class="font-weight-semibold w-50">Age </span>
								</td>
								<td class="py-2 px-0"><?php echo e(date('d-m-Y',strtotime($login_details->age))); ?></td>
							</tr>
							<tr>
								<td class="py-2 px-0">
									<span class="font-weight-semibold w-50">Father's Name </span>
								</td>
								<td class="py-2 px-0"><?php echo e($login_details->father_name); ?></td>
							</tr>
							<tr>
								<td class="py-2 px-0">
									<span class="font-weight-semibold w-50">Mother's Name </span>
								</td>
								<td class="py-2 px-0"><?php echo e($login_details->mother_name); ?></td>
							</tr>
							<tr>
								<td class="py-2 px-0">
									<span class="font-weight-semibold w-50">Metrial Status </span>
								</td>
								<td class="py-2 px-0"><?php echo e($login_details->metrial_status); ?></td>
							</tr>
							<tr>
								<td class="py-2 px-0">
									<span class="font-weight-semibold w-50">Phone </span>
								</td>
								<td class="py-2 px-0"><?php echo e($login_details->phone_no); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
	
		</div>
	</div>

	<?php

	if($login_details->workshop != 0)
	{
		$workshop_na = DB::table('workshops')->where('id',$login_details->workshop)->first();
        $workshop_name = $workshop_na->name;
	}
	else
	{
	    $workshop_name = 'All Workshop';	
	}

	  ?>
	<div class="col-xl-8 col-lg-9 col-md-12">
		<div class="main-content-body main-content-body-profile card">
			<div class="main-profile-body">
				<div class="card-body border-top">
					<h5 class="font-weight-bold">Work & Education</h5>
					<div class="main-profile-contact-list d-lg-flex">
						<div class="media mr-5">
							<div class="media-icon bg-success text-white mr-4">
								<i class="fa fa-whatsapp"></i>
							</div>
							<div class="media-body">
								<h6 class="font-weight-bold mb-1">Whatsapp to <br>
									<a class="text-info" href="https://api.whatsapp.com/send?phone=+91<?php echo e($login_details->whatapps_no); ?>&amp;text=Hi%20<?php echo e($login_details->name); ?>" target="_blank"><?php echo e($login_details->whatapps_no); ?></a>

							</div>
						</div>
						<div class="media mr-5">
							<div class="media-icon bg-danger text-white mr-4">
								<i class="fa fa-briefcase"></i>
							</div>
							<div class="media-body">
								<h6 class="font-weight-bold mb-1">Highest Qualification</h6>
								<span></span>
								<p><?php echo $login_details->highest_qualification; ?></p>
							</div>
						</div>
						<div class="media mr-5">
							<div class="media-icon bg-info text-white mr-4">
								<i class="fa fa-home"></i>
							</div>
							<div class="media-body">
								<h6 class="font-weight-bold mb-1">Workshop</h6>
								<span></span>
								<p><?php echo e(@$workshop_name); ?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body border-top">
					<h5 class="font-weight-bold">Contact</h5>
					<div class="main-profile-contact-list d-lg-flex">
						<div class="media mr-4">
							<div class="media-icon bg-primary text-white  mr-3 mt-1">
								<i class="fa fa-phone"></i>
							</div>
							<div class="media-body">
								<small class="text-muted">Mobile</small>
								<div class="font-weight-normal1">
									<a href="tel:<?php echo e($login_details->phone_no); ?>"><?php echo e($login_details->phone_no); ?></a> / 
									<a href="tel:<?php echo e($login_details->emg_phone_no); ?>"><?php echo e($login_details->emg_phone_no); ?></a>
								
								</div>
							</div>
						</div>
						<div class="media mr-4">
							<div class="media-icon bg-warning text-white mr-3 mt-1">
								<i class="fa fa-slack"></i>
							</div>
							<div class="media-body">
								<small class="text-muted">Mail</small>
								<div class="font-weight-normal1">
									<a href="mailto:<?php echo e($login_details->email); ?>"><?php echo e($login_details->email); ?></a>
								</div>
							</div>
						</div>
						
					</div><!-- main-profile-contact-list -->
				</div>
				<div class="card-body border-top">
					<h5 class="font-weight-bold"> Address</h5>
					<div class="main-profile-contact-list d-lg-flex">
						
						<div class="media">
							<div class="media-icon bg-info text-white mr-3 mt-1">
								<i class="fa fa-map"></i>
							</div>
							<div class="media-body">
								<small class="text-muted">Current Address</small>
								<div class="font-weight-normal1">
									<?php echo $login_details->address; ?>

								</div>
							</div>
						</div>
					</div><!-- main-profile-contact-list -->
				</div>
			</div>
		</div>
	</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ameInventory\resources\views/appPages/Users/user-details.blade.php ENDPATH**/ ?>