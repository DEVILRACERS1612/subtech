<?php  
include 'config/config.inc.php';
include 'config/function.php';
include 'config/login_check.php';
include 'Model/class.company.php';
$page="Home";

?>
<!DOCTYPE html>
<html lang="en">
<title><?php echo $_SESSION[SITE_NAME]['MI_username'];?> Panel </title>
<head>
<?php include 'config/head.php';?>
<style>
.noti{
position:absolute; z-index:9; margin-top:10px; padding:10px; height:31px!important; width:33px!important; border-radius:50%!important;
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
					
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN PROFILE SIDEBAR -->
							<div class="profile-sidebar">
								<div class="card card-topline-aqua">
									<div class="card-body no-padding height-9">
										<div class="row">
											<div class="profile-userpic">
												<img src="<?php echo BASE_PATH;?>images/reseller_img/<?php echo $reseller['image'];?>" class="img-responsive" alt=""> </div>
										</div>
										<div class="profile-usertitle">
											<div class="profile-usertitle-name"><?php echo $reseller['user_name'];?></div>
											<div class="profile-usertitle-job"><?php echo $reseller['company'];?> </div>
										</div>
										<ul class="list-group list-group-unbordered">
											<li class="list-group-item">
												<b>Mobile</b> <a class="pull-right">+91-<?php echo $reseller['mobile'];?></a>
											</li>
											<li class="list-group-item">
												<b>Email</b> <a class="pull-right"><?php echo $reseller['email'];?></a>
											</li>
											<li class="list-group-item">
												<b>City</b> <a class="pull-right"><?php echo $reseller['city'];?></a>
											</li>
										</ul>
										<!-- END SIDEBAR USER TITLE -->
										<!-- SIDEBAR BUTTONS -->
										<div class="profile-userbuttons">
											<button type="button" class="btn btn-circle green btn-sm">Support</button>
											<button type="button" class="btn btn-circle red btn-sm">View Profile</button>
										</div>
										<!-- END SIDEBAR BUTTONS -->
									</div>
								</div>
								<div class="card">
									<div class="card-head card-topline-aqua">
										<header>Company</header>
									</div>
									<div class="card-body no-padding height-9">
										
										
										<div class="row list-separated profile-stat">
											<div class="col-md-4 col-sm-4 col-6">
												<div class="uppercase profile-stat-title"> <?php echo $objcmp->cmpcount($_SESSION[SITE_NAME]['MI_reseller_id']);?> </div>
												<div class="uppercase profile-stat-text"> Company </div>
											</div>
											<div class="col-md-4 col-sm-4 col-6">
												<div class="uppercase profile-stat-title"> 0 </div>
												<div class="uppercase profile-stat-text"> Students </div>
											</div>
											<div class="col-md-4 col-sm-4 col-6">
												<div class="uppercase profile-stat-title"> 0 </div>
												<div class="uppercase profile-stat-text"> Collection </div>
											</div>
										</div>
										
										<div class="profile-userbuttons">
											
											<button type="button" class="btn btn-success btn-circle btn-sm">Add New School</button>
										</div>
										

									</div>
								</div>
								
								
							</div>
							<!-- END BEGIN PROFILE SIDEBAR -->
							<!-- BEGIN PROFILE CONTENT -->
							<div class="profile-content">
								<div class="row">
									<div class="col-md-12">
									
										<div class="card">
											<div class="card-head card-topline-aqua">
												<header>Any questions</header>
											</div>
											<div class="card-body no-padding height-9">
												<div class="container-fluid">
													<div class="row">
														<div class="col-md-12">
															<div class="panel">
																<form>
																	<textarea class="form-control p-text-area" rows="4" placeholder="Any Help?"></textarea>
																</form>
																<footer class="panel-footer">
																	<button class="btn btn-post pull-right">Send</button>
																	
																</footer>
															</div>
														</div>
													</div>
													
												</div>
											</div>
										</div>
										
										<div class="card">
									<div class="card-head card-topline-aqua">
										<header>Performance</header>
									</div>
									<div class="card-body no-padding height-9">
										<ul class="performance-list">
											<li>
												<a href="#">
													<i class="fa fa-circle-o" style="color:#F39C12;"></i> Total Product Sales <span class="pull-right"><?php echo $objcmp->cmpcount($_SESSION[SITE_NAME]['MI_reseller_id']);?></span>
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fa fa-circle-o" style="color:#DD4B39;"></i> Total Product Refer <span class="pull-right">0</span>
												</a>
											</li>
											<li>
												<a href="#">
													<i class="fa fa-circle-o" style="color:#00A65A;"></i> Total Earn <span class="pull-right"> Rs 345000</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
									</div>
								</div>
								<!-- END PROFILE CONTENT -->
							</div>
						</div>
					</div>
					
					
					
					
						
					</div>
					
					
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