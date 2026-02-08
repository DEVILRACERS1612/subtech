<?php  
include 'config/config.inc.php';
include 'config/function.php';
include 'config/login_check.php';
$page="Home";

?>

<!DOCTYPE html>
<html lang="en">
<title>Microelectra CRM Admin Dashboard </title>
<head>
<?php include 'config/head.php';?>
<style>
.noti{
position:absolute;z-index:9;margin-top:10px;padding:10px;height:31px!important;width:33px!important;border-radius:50%!important;
}
</style>
</head>
<!-- END HEAD -->

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
	<div class="page-wrapper">
		<!-- start header -->
		<?php include 'config/header.php';?>
		<!-- end header -->
		
		<!-- start color quick setting -->
		
		<!-- end color quick setting -->
		<!-- start page container -->
		<div class="page-container">
			<?php include 'config/leftmenu.php';?>
			
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title">Dashboard</div>
								
							</div>
							<ol class="breadcrumb page-breadcrumb pull-right">
								<li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo BASE_PATH;?>Home/">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
								</li>
								<li class="active">Dashboard</li>
							</ol>
						</div>
					</div>
					<div class="row">
					<!--<div class="col-md-3 col-sm-3 col-12">
					<span class="badge headerBadgeColor1 noti"> <?php $t=("memu_ti"); echo $t;?> </span>
						<div class="card">
							<a href="<?php echo BASE_PATH;?>Add_TI/">
							<div class="panel-body text-center">
								<h3>	<b style="color:#000;">TI</b></h3>
								<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($t>0)?100:0;?>%;"></div>
								</div>
								<span class="text-small margin-top-10 full-width"><?php echo $t;?> </span>
							</div>
							</a>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-12">
					<span class="badge headerBadgeColor1 noti"> <?php $t=("memu_ia1"); echo $t;?> </span>
						<div class="card">
							<a href="<?php echo BASE_PATH;?>Add_IA1/">
							<div class="panel-body text-center">
								<h3>	<b style="color:#000;">IA1</b></h3>
								<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($t>0)?100:0;?>%;"></div>
								</div>
								<span class="text-small margin-top-10 full-width"><?php echo $t;?> </span>
							</div>
							</a>
						</div>
					</div>
					--->
					
					
					</div>
					<!-- 
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="row clearfix">
								<div class="col-md-3 col-sm-3 col-12">
								<span class="badge headerBadgeColor1 noti"> 26 </span>
									<div class="card">
										<a href="#">
										<div class="panel-body text-center">
											<h3>Total TI</h3>
											<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
												<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="65" aria-valuemin="0"
												 aria-valuemax="100" style="width: 65%;"></div>
											</div>
											<span class="text-small margin-top-10 full-width">Due Date : </span>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-12">
								<span class="badge headerBadgeColor1 noti"> 26 </span>
									<div class="card">
										<a href="#">
										<div class="panel-body text-center">
											<h3>Total IA2</h3>
											<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
												<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="52" aria-valuemin="0"
												 aria-valuemax="100" style="width: 52%;"></div>
											</div>
											<span class="text-small margin-top-10 full-width">Due Date : </span>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-12">
								<span class="badge headerBadgeColor1 noti"> 26 </span>
									<div class="card">
										<a href="#">
										<div class="panel-body text-center">
											<h3>Total IA3 </h3>
											<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
												<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="56" aria-valuemin="0"
												 aria-valuemax="100" style="width: 56%;"></div>
											</div>
											<span class="text-small margin-top-10 full-width">Due Date : </span>
										</div>
										</a>
									</div>
								</div>
							</div>
							<div class="row clearfix">
								<div class="col-md-3 col-sm-3 col-12">
								<span class="badge headerBadgeColor1 noti"> 26 </span>
									<div class="card">
										<a href="#">
										<div class="panel-body text-center">
											<h3>Total IC1</h3>
											<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
												<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="65" aria-valuemin="0"
												 aria-valuemax="100" style="width: 65%;"></div>
											</div>
											<span class="text-small margin-top-10 full-width">Due Date : </span>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-12">
								<span class="badge headerBadgeColor1 noti"> 26 </span>
									<div class="card">
									<a href="#">
										<div class="panel-body text-center">
											<h3>Total IA1</h3>
											<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
												<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="68" aria-valuemin="0"
												 aria-valuemax="100" style="width: 68%;"></div>
											</div>
											<span class="text-small margin-top-10 full-width">Due Date : </span>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-12">
								<span class="badge headerBadgeColor1 noti"> 26 </span>
									<div class="card">
										<a href="#">
										<div class="panel-body text-center">
											<h3>Total IA2</h3>
											<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
												<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="52" aria-valuemin="0"
												 aria-valuemax="100" style="width: 52%;"></div>
											</div>
											<span class="text-small margin-top-10 full-width">Due Date : </span>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-12">
								<span class="badge headerBadgeColor1 noti"> 26 </span>
									<div class="card">
									<a href="#">
										<div class="panel-body text-center">
											<h3>Total IA3 </h3>
											<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
												<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="56" aria-valuemin="0"
												 aria-valuemax="100" style="width: 56%;"></div>
											</div>
											<span class="text-small margin-top-10 full-width">Due Date : </span>
										</div>
										</a>
									</div>
								</div>
							</div>
							<div class="row clearfix">
								<div class="col-md-3 col-sm-3 col-12">
								<span class="badge headerBadgeColor1 noti"> 26 </span>
									<div class="card">
									<a href="#">
										<div class="panel-body text-center">
											<h3>Total IC2</h3>
											<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
												<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="65" aria-valuemin="0"
												 aria-valuemax="100" style="width: 65%;"></div>
											</div>
											<span class="text-small margin-top-10 full-width">Due Date : </span>
										</div></a>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-12">
								<span class="badge headerBadgeColor1 noti"> 26 </span>
									<div class="card">
									<a href="#">
										<div class="panel-body text-center">
											<h3>Total IA1</h3>
											<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
												<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="68" aria-valuemin="0"
												 aria-valuemax="100" style="width: 68%;"></div>
											</div>
											<span class="text-small margin-top-10 full-width">Due Date : </span>
										</div></a>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-12">
								<span class="badge headerBadgeColor1 noti"> 26 </span>
									<div class="card">
										<a href="#">
										<div class="panel-body text-center">
											<h3>Total IA2</h3>
											<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
												<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="52" aria-valuemin="0"
												 aria-valuemax="100" style="width: 52%;"></div>
											</div>
											<span class="text-small margin-top-10 full-width">Due Date : </span>
										</div>
										</a>
									</div>
								</div>
								<div class="col-md-3 col-sm-3 col-12">
								<span class="badge headerBadgeColor1 noti"> 26 </span>
									<div class="card">
										<a href="#">
										<div class="panel-body text-center">
											<h3>Total IA3 </h3>
											<div class="progressbar-xs progress-rounded progress-striped progress ng-isolate-scope active">
												<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="56" aria-valuemin="0"
												 aria-valuemax="100" style="width: 56%;"></div>
											</div>
											<span class="text-small margin-top-10 full-width">Due Date : </span>
										</div>
										</a>
									</div>
								</div>
							</div>
						</div>
						
					</div>--->
					<!-- 			
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
									<header>Salary Status</header>
								</div>
								<div class="card-body ">
									<div class="mdl-tabs mdl-js-tabs">
										<div class="mdl-tabs__tab-bar tab-left-side">
											<a href="#tab4-panel" class="mdl-tabs__tab tabs_three is-active">Professors</a>
											<a href="#tab5-panel" class="mdl-tabs__tab tabs_three">Librarian</a>
											<a href="#tab6-panel" class="mdl-tabs__tab tabs_three">Other</a>
										</div>
										<div class="mdl-tabs__panel is-active p-t-20" id="tab4-panel">
											<div class="table-responsive">
												<table class="table">
													<tbody>
														<tr>
															<th>Image</th>
															<th>Name</th>
															<th>Date</th>
															<th>Status</th>
															<th>Ammount</th>
															<th>Transaction ID</th>
														</tr>
														<tr>
															<td class="patient-img sorting_1">
																<img src="../assets/img/std/std6.jpg" alt="">
															</td>
															<td>John Deo</td>
															<td>05-01-2017</td>
															<td><span class="label label-danger">Unpaid</span></td>
															<td>1200$</td>
															<td>#7234486</td>
														</tr>
														<tr>
															<td class="patient-img sorting_1">
																<img src="../assets/img/std/std4.jpg" alt="">
															</td>
															<td>Eugine Turner</td>
															<td>04-01-2017</td>
															<td><span class="label label-success">Paid</span></td>
															<td>1400$</td>
															<td>#7234417</td>
														</tr>
														<tr>
															<td class="patient-img sorting_1">
																<img src="../assets/img/std/std2.jpg" alt="">
															</td>
															<td>Jacqueline Howell</td>
															<td>03-01-2017</td>
															<td><span class="label label-warning">Pending</span></td>
															<td>1100$</td>
															<td>#7234454</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="text-center">
												<button class="btn btn-outline-primary btn-round btn-sm">Load
													More</button>
											</div>
										</div>
										<div class="mdl-tabs__panel p-t-20" id="tab5-panel">
											<div class="table-responsive">
												<table class="table">
													<tbody>
														<tr>
															<th>Image</th>
															<th>Name</th>
															<th>Date</th>
															<th>Status</th>
															<th>Ammount</th>
															<th>Transaction ID</th>
														</tr>
														<tr>
															<td class="patient-img sorting_1">
																<img src="../assets/img/std/std1.jpg" alt="">
															</td>
															<td>Eugine Turner</td>
															<td>04-01-2017</td>
															<td><span class="label label-success">Paid</span></td>
															<td>700$</td>
															<td>#7234417</td>
														</tr>
														<tr>
															<td class="patient-img sorting_1">
																<img src="../assets/img/std/std4.jpg" alt="">
															</td>
															<td>Jacqueline Howell</td>
															<td>03-01-2017</td>
															<td><span class="label label-warning">Pending</span></td>
															<td>500$</td>
															<td>#7234454</td>
														</tr>
														<tr>
															<td class="patient-img sorting_1">
																<img src="../assets/img/std/std5.jpg" alt="">
															</td>
															<td>Jayesh Parmar</td>
															<td>03-01-2017</td>
															<td><span class="label label-danger">Unpaid</span></td>
															<td>400$</td>
															<td>#72544</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="text-center">
												<button class="btn btn-outline-primary btn-round btn-sm">Load
													More</button>
											</div>
										</div>
										<div class="mdl-tabs__panel p-t-20" id="tab6-panel">
											<div class="table-responsive">
												<table class="table">
													<tbody>
														<tr>
															<th>Image</th>
															<th>Name</th>
															<th>Date</th>
															<th>Status</th>
															<th>Ammount</th>
															<th>Transaction ID</th>
														</tr>
														<tr>
															<td class="patient-img sorting_1">
																<img src="../assets/img/std/std8.jpg" alt="">
															</td>
															<td>Jane Elliott</td>
															<td>06-01-2017</td>
															<td><span class="label label-primary">Paid</span></td>
															<td>300$</td>
															<td>#7234421</td>
														</tr>
														<tr>
															<td class="patient-img sorting_1">
																<img src="../assets/img/std/std7.jpg" alt="">
															</td>
															<td>Jacqueline Howell</td>
															<td>03-01-2017</td>
															<td><span class="label label-warning">Pending</span></td>
															<td>450$</td>
															<td>#723344</td>
														</tr>
														<tr>
															<td class="patient-img sorting_1">
																<img src="../assets/img/std/std9.jpg" alt="">
															</td>
															<td>Jacqueline Howell</td>
															<td>03-01-2017</td>
															<td><span class="label label-primary">Paid</span></td>
															<td>550$</td>
															<td>#7235454</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="text-center">
												<button class="btn btn-outline-primary btn-round btn-sm">Load
													More</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>---->
				</div>
			</div>
			<!-- end page content -->
			<!-- start chat sidebar -->
			
			<!-- end chat sidebar -->
		</div>
		<!-- end page container -->
		<!-- start footer -->
		<?php include 'config/footer.php';?>
		<!-- end footer -->
	</div>

</body>
</html>