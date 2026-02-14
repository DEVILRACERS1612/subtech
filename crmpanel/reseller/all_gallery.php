<?php  
error_reporting(0);
session_start();
include 'config/login_check.php';
include 'config/config.inc.php';
$page="gallery";
$del_id=(isset($_REQUEST['del_id']) and $_REQUEST['del_id'] !='')?$db->filterVar($_REQUEST['del_id']):'';
if(!empty($del_id))
{
	$q=$db->exeQuery("select * from nt_gallery where id='".$del_id."' and nt_status='Yes'");
	$r=$q->fetch_assoc();
	unlink("../../images/galimg/".$r['image']);
	$db->exeQuery("delete from nt_gallery where id='".$del_id."' and nt_status='Yes'");
	$error="<span class='alert alert-danger'>Data Deleted Successfully</span>";
	header('Refresh:1;url='.BASE_PATH.'All_Gallery/');
}
$act_id=(isset($_REQUEST['act_id']) and $_REQUEST['act_id'] !='')?$db->filterVar($_REQUEST['act_id']):'';
$deact_id=(isset($_REQUEST['deact_id']) and $_REQUEST['deact_id'] !='')?$db->filterVar($_REQUEST['deact_id']):'';

if(!empty($act_id))
{
	
		$dop=date("Y-m-d");
		$db->exeQuery("update nt_gallery set active='Yes' where id='".$act_id."'");
	
	header('Refresh:1;url='.BASE_PATH.'All_Gallery/');
}
if(!empty($deact_id))
{
	
	$db->exeQuery("update nt_gallery set active='No' where id='".$deact_id."'");
	
	header('Refresh:1;url='.BASE_PATH.'All_Gallery/');
}

?>
<!DOCTYPE html>
<html lang="en">
	<title>Gallery </title>
<head>
<?php include 'config/head.php';?>

</head>
<!-- END HEAD -->

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
	<div class="page-wrapper">
		<!-- start header -->
		<?php include 'config/header.php';?>
		<!-- end header -->
		
		<div class="page-container">
			<!-- start sidebar menu -->
			<?php include 'config/leftmenu.php';?>
			<!-- end sidebar menu -->
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					
					<div class="row">
						<div class="col-md-12">
							<div class="tabbable-line">
								
								<div class="tab-content" style="padding:0;">
									<div class="tab-pane active fontawesome-demo" id="tab1">
										<div class="row">
											<div class="col-md-12">
												<div class="card card-box">
													<div class="card-head">
														<header>All Gallery </header>
														
														<div class="btn-group pull-right" style="padding-right:10px;padding-bottom:5px;">
															<a href="<?php echo BASE_PATH;?>Add_Gallery/" id="addRow" class="btn btn-primary">
																Add New Gallery <i class="fa fa-plus"></i>
															</a>
														</div>
														<div ></div>
													</div>
													<div class="card-body ">
														<div class="row">
															<div class="col-md-6 col-sm-6 col-6">
																<?php echo $error;?>
															</div>
															<div class="col-md-6 col-sm-6 col-6">
																
															</div>
														</div>
														<div class="row">
															
															<?php 
																	$qr=$db->exeQuery("select * from nt_gallery where nt_status='Yes'");
																	$i=1;
																	while($row=$qr->fetch_assoc() )
																	{
																		echo '
																		<div class="col-md-4">
																		<p>'.BASE_PATH.'images/galimg/'.$row['image'].'</p>
																		<img src="'.BASE_PATH.'images/galimg/'.$row['image'].'" class="img-responsive" />
																		
																		';
																		
																		
																		echo '
																			<a href="'.BASE_PATH.'All_Gallery/'.$row['id'].'/" class="btn btn-primary btn-xs">
																				<i class="fa fa-pencil"></i>
																			</a>
																			
																			<a class="btn btn-danger btn-xs" href="'.BASE_PATH.'All_Gallery/'.$row['id'].'/" onclick="return confirm(\'Are You sure to Delete this Record \');">
																				<i class="fa fa-trash-o "></i>
																			</a>
																		</div>
																		
																		';
																		$i++;
																	}
																?>
															
														</div>
														
													</div>
												</div>
											</div>
										</div>
									</div>
									
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

	<!-- end js include path -->
</body>


<!-- Mirrored from radixtouch.in/templates/admin/smart/source/light/all_professors.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Feb 2019 17:10:44 GMT -->
</html>