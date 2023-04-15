

<?php $__env->startSection('content'); ?>
<?php
$total_users = DB::table('users')->count();
$total_requisitions = DB::table('requisitions')->count();
$total_purchase_orders = DB::table('purchase_order_details')->count();

?>
	<!-- Business Summery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden dash1-card border-0">
			<div class="card-body">
				<p class=" mb-1 ">Total Requisition</p>
				<h2 class="mb-1 number-font"><?php echo e($total_requisitions); ?></h2>
				<!-- <small class="fs-12 text-muted">Compared to Last Month</small>
				<span class="ratio bg-warning">76%</span>
				<span class="ratio-text text-muted">Goals Reached</span> -->
			</div>
			<div id="spark1"></div>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden dash1-card border-0">
			<div class="card-body">
				<p class=" mb-1 ">Total User</p>
				<h2 class="mb-1 number-font"><?php echo e($total_users); ?></h2>
				<!-- <small class="fs-12 text-muted">Compared to Last Month</small>
				<span class="ratio bg-info">85%</span>
				<span class="ratio-text text-muted">Goals Reached</span> -->
			</div>
			<div id="spark2"></div>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden dash1-card border-0">
			<div class="card-body">
				<p class=" mb-1 ">Total Purchase Order</p>
				<h2 class="mb-1 number-font"><?php echo e($total_purchase_orders); ?></h2>
				<!-- <small class="fs-12 text-muted">Compared to Last Month</small>
				<span class="ratio bg-danger">62%</span>
				<span class="ratio-text text-muted">Goals Reached</span> -->
			</div>
			<div id="spark3"></div>
		</div>
	</div>
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden dash1-card border-0">
			<div class="card-body">
				<p class=" mb-1">Total Job</p>
				<h2 class="mb-1 number-font">5</h2>
				<!-- <small class="fs-12 text-muted">Compared to Last Month</small>
				<span class="ratio bg-success">53%</span>
				<span class="ratio-text text-muted">Goals Reached</span> -->
			</div>
			<div id="spark4"></div>
		</div>
	</div>


<!-- ============================= not needed =================================== -->

    <div class="row" style="display: none;">
							<div class="col-xl-8 col-lg-8 col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Sales Analysis</h3>
										<div class="card-options">
											<div class="btn-group p-0">
												<button class="btn btn-outline-light btn-sm" type="button">Week</button>
												<button class="btn btn-light btn-sm" type="button">Month</button>
												<button class="btn btn-outline-light btn-sm" type="button">Year</button>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="row mb-3">
											<div class="col-xl-3 col-6">
												<p class="mb-1">Total Sales</p>
												<h3 class="mb-0 fs-20 number-font1">$52,618</h3>
												<p class="fs-12 text-muted"><span class="text-danger mr-1"><i class="fe fe-arrow-down"></i>0.9%</span>this month</p>
											</div>
											<div class="col-xl-3 col-6 ">
												<p class=" mb-1">Maximum Sales</p>
												<h3 class="mb-0 fs-20 number-font1">$26,197</h3>
												<p class="fs-12 text-muted"><span class="text-success mr-1"><i class="fe fe-arrow-up"></i>0.15%</span>this month</p>
											</div>
											<div class="col-xl-3 col-6">
												<p class=" mb-1">Total Units Sold</p>
												<h3 class="mb-0 fs-20 number-font1">13,876</h3>
												<p class="fs-12 text-muted"><span class="text-danger mr-1"><i class="fe fe-arrow-down"></i>0.8%</span>this month</p>
											</div>
											<div class="col-xl-3 col-6">
												<p class=" mb-1">Maximum Units Sold</p>
												<h3 class="mb-0 fs-20 number-font1">5,876</h3>
												<p class="fs-12 text-muted"><span class="text-success mr-1"><i class="fe fe-arrow-up"></i>0.06%</span>this month</p>
											</div>
										</div>
										<div id="echart1" class="chart-tasks chart-dropshadow text-center"></div>
										<div class="text-center mt-2">
											<span class="mr-4"><span class="dot-label bg-primary"></span>Total Sales</span>
											<span><span class="dot-label bg-secondary"></span>Total Units Sold</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Recent Activity</h3>
										<div class="card-options">
											<a href="index-2.html#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-horizontal fs-20"></i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="index-2.html#">Today</a>
												<a class="dropdown-item" href="index-2.html#">Last Week</a>
												<a class="dropdown-item" href="index-2.html#">Last Month</a>
												<a class="dropdown-item" href="index-2.html#">Last Year</a>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="latest-timeline scrollbar3" id="scrollbar3">
											<ul class="timeline mb-0">
												<li class="mt-0">
													<div class="d-flex"><span class="time-data">Task Finished</span><span class="ml-auto text-muted fs-11">09 June 2020</span></div>
													<p class="text-muted fs-12"><span class="text-info">Joseph Ellison</span> finished task on<a href="index-2.html#" class="font-weight-semibold"> Project Management</a></p>
												</li>
												<li>
													<div class="d-flex"><span class="time-data">New Comment</span><span class="ml-auto text-muted fs-11">05 June 2020</span></div>
													<p class="text-muted fs-12"><span class="text-info">Elizabeth Scott</span> Product delivered<a href="index-2.html#" class="font-weight-semibold"> Service Management</a></p>
												</li>
												<li>
													<div class="d-flex"><span class="time-data">Target Completed</span><span class="ml-auto text-muted fs-11">01 June 2020</span></div>
													<p class="text-muted fs-12"><span class="text-info">Sonia Peters</span> finished target on<a href="index-2.html#" class="font-weight-semibold"> this month Sales</a></p>
												</li>
												<li>
													<div class="d-flex"><span class="time-data">Revenue Sources</span><span class="ml-auto text-muted fs-11">26 May 2020</span></div>
													<p class="text-muted fs-12"><span class="text-info">Justin Nash</span> source report on<a href="index-2.html#" class="font-weight-semibold"> Generated</a></p>
												</li>
												<li>
													<div class="d-flex"><span class="time-data">Dispatched Order</span><span class="ml-auto text-muted fs-11">22 May 2020</span></div>
													<p class="text-muted fs-12"><span class="text-info">Ella Lambert</span> ontime order delivery <a href="index-2.html#" class="font-weight-semibold">Service Management</a></p>
												</li>
												<li>
													<div class="d-flex"><span class="time-data">New User Added</span><span class="ml-auto text-muted fs-11">19 May 2020</span></div>
													<p class="text-muted fs-12"><span class="text-info">Nicola	Blake</span> visit the site<a href="index-2.html#" class="font-weight-semibold"> Membership allocated</a></p>
												</li>
												<li>
													<div class="d-flex"><span class="time-data">Revenue Sources</span><span class="ml-auto text-muted fs-11">15 May 2020</span></div>
													<p class="text-muted fs-12"><span class="text-info">Richard	Mills</span> source report on<a href="index-2.html#" class="font-weight-semibold"> Generated</a></p>
												</li>
												<li class="mb-0">
													<div class="d-flex"><span class="time-data">New Order Placed</span><span class="ml-auto text-muted fs-11">11 May 2020</span></div>
													<p class="text-muted fs-12"><span class="text-info">Steven Hart</span> is proces the order<a href="index-2.html#" class="font-weight-semibold"> #987</a></p>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>

<!-- ============================= not needed =================================== -->
<div class="col-md-12">
<div class="row">
<div class="col-xl-6 col-lg-6 col-md-6 col-xm-6">
<div class="card custom_cardx">
<div class="card-header">
<div class="card-title">Item Stock Amount / Item Issue Amount</div>
</div>
<div class="card-body">
<canvas id="myChart_issue_stock"></canvas>
</div>
</div>
</div>
<div class="col-xl-6 col-lg-6 col-md-6 col-xm-6">
<div class="card">
<div class="card-header">
<h3 class="card-title">Issue Amount</h3>
</div>
<div>
<canvas id="myChart"></canvas>
</div>
</div>
</div>
</div>
</div>


	

	<script>
var xValues = ['jan','feb','mar','apr','may','june','july','aug','sep','oct','nov','dec'];
var issue_amount = [86000,114000,10600,10600,10708,11102,133001,221004,783042,247824,0,0];
var stock_amount = [8600,14000,100,-20600,10708,1102,13001,22004,78042,27824,0,0];

new Chart("myChart_issue_stock", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{ 
      data: issue_amount,
      borderColor: "red",
      fill: true,
      label: 'Item Issue Amount',
    }, { 
      data: stock_amount,
      borderColor: "blue",
      fill: true,
      label: 'Item Stock Amount',
    }]
  },
  options: {
    legend: {display: true}
  }
});
</script>

<script type="text/javascript">
	var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
	  type: 'bar',
	  data: {
	    labels: ['jan','feb','mar','apr','may','june','july','aug','sep','oct','nov','dec'],
	    datasets: [{
	      label: 'Workshop 2',
	      data: [12, 19, 3, 17, 28],
	      backgroundColor: "rgba(255, 51, 100)"
	    }, {
	      label: 'Workshop 2',
	      data: [30, 29, 5, 5, 20],
	      backgroundColor: "rgba(51, 113, 255)"
	    }
	      ]
	  }
	});
</script>

	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\ameInventory\resources\views/appPages/dashboard.blade.php ENDPATH**/ ?>