

<?php $__env->startSection('content'); ?>
<?php
$total_users = DB::table('users')->count();
$total_requisitions = DB::table('requisitions')->count();
$total_purchase_orders = DB::table('purchase_order_details')->count();

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<!-- =================================first four section====================================== -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 box_mainarea">
			<div class="row">
				<div class="col-lg-3">
					<div class="incard_boxarea articles__article" style="--animation-order:1">
						<a class="articles__link">
							<div class="articles__content articles__content--lhs">
								<h2 class="articles__title">Total Requisition</h2>
								<div class="articles__footer">
									<p>5</p>
									<!-- <time>1 Jan 2020</time> -->
								</div>
							</div>
							<div class="articles__content articles__content--rhs" aria-hidden="true">
								<h2 class="articles__title">Total Requisition</h2>
								<div class="articles__footer">
									<p>41</p>
									<!-- <time>1 Jan 2020</time> -->
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="incard_boxarea articles__article" style="--animation-order:1">
						<a class="articles__link">
							<div class="articles__content articles__content--lhs">
								<h2 class="articles__title">Total User</h2>
								<div class="articles__footer">
									<p>10</p>
									<!-- <time>1 Jan 2020</time> -->
								</div>
							</div>
							<div class="articles__content articles__content--rhs" aria-hidden="true">
								<h2 class="articles__title">Total User</h2>
								<div class="articles__footer">
									<p>5</p>
									<!-- <time>1 Jan 2020</time> -->
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="incard_boxarea articles__article" style="--animation-order:1">
						<a class="articles__link">
							<div class="articles__content articles__content--lhs">
								<h2 class="articles__title">Total Purchase Order</h2>
								<div class="articles__footer">
									<p>17</p>
									<!-- <time>1 Jan 2020</time> -->
								</div>
							</div>
							<div class="articles__content articles__content--rhs" aria-hidden="true">
								<h2 class="articles__title">Total Purchase Order</h2>
								<div class="articles__footer">
									<p>5</p>
									<!-- <time>1 Jan 2020</time> -->
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="incard_boxarea articles__article" style="--animation-order:1">
						<a class="articles__link">
							<div class="articles__content articles__content--lhs">
								<h2 class="articles__title">Total Job</h2>
								<div class="articles__footer">
									<p>5</p>
									<!-- <time>1 Jan 2020</time> -->
								</div>
							</div>
							<div class="articles__content articles__content--rhs" aria-hidden="true">
								<h2 class="articles__title">Total Job</h2>
								<div class="articles__footer">
									<p>5</p>
									<!-- <time>1 Jan 2020</time> -->
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- =================================first four section====================================== -->

<!-- =================================pie chart section======================================= -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 dashchart_area">
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
					<div class="card mycard_scndchrt">
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
	</div>
</div>
<!-- =================================pie chart section======================================= -->

<!-- =================================second section========================================== -->
<div class="container">
	 <div class="row">
	 	  <div class="col-lg-12 scndfour_outstructure">
	 	  	<div class="row gutters-20">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <div class="item-icon bg-light-green">
                                        <i class="fas fa-users sicon_design"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="item-content">
                                        <div class="item-title">Total Users</div>
                                        <div class="item-number"><span class="counter" data-num="150000">150000</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <div class="item-icon bg-light-blue">
                                        <i class="fas fa-truck sicon_design1"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="item-content">
                                        <div class="item-title">Register Vehicle</div>
                                        <div class="item-number"><span class="counter" data-num="2250">2250</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <div class="item-icon bg-light-yellow">
                                        <i class="fas fa-file sicon_design2"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="item-content">
                                        <div class="item-title">Job Done</div>
                                        <div class="item-number"><span class="counter" data-num="5690">5690</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <div class="item-icon bg-light-red">
                                        <i class="fas fa-book-open sicon_design3"></i>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="item-content">
                                        <div class="item-title">Emergency Challan</div>
                                        <div class="item-number"><span></span><span class="counter" data-num="193000">193000</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
	 	  </div>
	 </div>
</div>
<!-- =================================second section========================================== -->

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
<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\ameInventory\resources\views/appPages/dashboard.blade.php ENDPATH**/ ?>