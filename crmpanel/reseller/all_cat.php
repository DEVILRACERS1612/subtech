<?php  
error_reporting(0);
session_start();
include 'config/login_check.php';
include 'config/config.inc.php';
$page="cat";
$del_id=(isset($_REQUEST['del_id']) and $_REQUEST['del_id'] !='')?$db->filterVar($_REQUEST['del_id']):'';
if(!empty($del_id))
{
	$db->exeQuery("delete from am_category where id='".$del_id."' and am_status='Yes'");
	$error="<span class='alert alert-danger'>Data Deleted Successfully</span>";
	header('Refresh:1;url='.BASE_PATH.'All_cat/');
}


?>
<!DOCTYPE html>
<html lang="en">
	<title>Main Menu </title>
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
														<header>All Main Menu </header>
														
														<div class="btn-group pull-right" style="padding-right:10px;padding-bottom:5px;">
															<a href="<?php echo BASE_PATH;?>Add_cat/" id="addRow" class="btn btn-primary">
																Add New Main Menu <i class="fa fa-plus"></i>
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
														<div class="table-scrollable">
															<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="exportTable">
																<thead>
																	<tr>
																		<th>S.No.</th>
																		<th> Category </th>
																		<th> Title </th>
																		<th> Description </th>
																		
																		<th> Action </th>
																	</tr>
																</thead>
																<tbody>
																<?php 
																	$qr=$db->exeQuery("select * from am_category where am_status='Yes'");
																	$i=1;
																	while($row=$qr->fetch_assoc() )
																	{
																		echo '
																		<tr>
																		<td>'.$i.'</td>
																		<td>'.$row['cat'].'</td>
																		<td>'.$row['ptitle'].'</td>
																		<td>'.$row['description'].'</td>
																		<td>
																			<a href="'.BASE_PATH.'Add_cat/'.$row['id'].'/" class="btn btn-primary btn-xs">
																				<i class="fa fa-pencil"></i>
																			</a>
																			<a class="btn btn-danger btn-xs" href="'.BASE_PATH.'All_cat/'.$row['id'].'/" onclick="return confirm(\'Are You sure to Delete this Record \');">
																				<i class="fa fa-trash-o "></i>
																			</a>
																		</td>
																		</tr>
																		';
																		$i++;
																	}
																?>
																
																
																	
																	<!---<tr class="odd gradeX">
																		<td class="patient-img">
																			<img src="../assets/img/prof/prof6.jpg" alt="">
																		</td>
																		<td>Megha Trivedi</td>
																		<td class="left">Mathematics</td>
																		<td class="left">Female</td>
																		<td class="left">M.COM, M.Ed.</td>
																		<td><a href="tel:444543564">
																				444543564 </a></td>
																		<td><a href="mailto:shuxer@gmail.com">
																				megha@gmail.com </a></td>
																		<td class="left">17 Mar 2013</td>
																		<td>
																			<a href="edit_professor.html" class="btn btn-primary btn-xs">
																				<i class="fa fa-pencil"></i>
																			</a>
																			<button class="btn btn-danger btn-xs">
																				<i class="fa fa-trash-o "></i>
																			</button>
																		</td>
																	</tr>--->
																</tbody>
															</table>
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