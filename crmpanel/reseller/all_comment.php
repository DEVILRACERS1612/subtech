<?php  
error_reporting(0);
session_start();
include 'config/login_check.php';
include 'config/config.inc.php';
include './Model/class.news.php';

$page="comment";
$del_id=(isset($_REQUEST['deact_id']) and $_REQUEST['deact_id'] !='')?$db->filterVar($_REQUEST['deact_id']):'';
if(!empty($del_id))
{
	$q=$db->exeQuery("update nt_comment set nt_status='No' where id='".$del_id."' ");

	header('Refresh:1;url='.BASE_PATH.'All_comment/');
}
$act_id=(isset($_REQUEST['act_id']) and $_REQUEST['act_id'] !='')?$db->filterVar($_REQUEST['act_id']):'';
if(!empty($del_id))
{
	$q=$db->exeQuery("update nt_comment set nt_status='Yes' where id='".$act_id."' ");

	header('Refresh:1;url='.BASE_PATH.'All_comment/');
}


?>
<!DOCTYPE html>
<html lang="en">
	<title>Comments </title>
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
														<header>All Comments </header>
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
																		<th>Date/Time</th>
																		<th> News </th>
																		<th> Comment </th>
																		<th> User </th>
																		<th> Email </th>
																		<th> Visible </th>
																		<th> Action </th>
																	</tr>
																</thead>
																<tbody>
																<?php 
																	$qr=$db->exeQuery("select * from nt_comment order by dop desc ");
																	$i=1;
																	while($row=$qr->fetch_assoc() )
																	{
																		echo '
																		<tr>
																		<td>'.$i.'</td>
																		<td>'.date("d-m-Y H:i:s",strtotime($row['dop'])).'</td>
																		<td>'.$objnews->newstitle($row['news_id']).'</td>
																		<td>'.$row['comment'].'</td>
																		<td>'.$row['username'].'</td>
																		<td>'.$row['email'].'</td>
																		<td>'.$row['nt_status'].'</td>
																		<td>';
																			if($row['nt_status']=='Yes')
																			{
																				echo'<a class="btn btn-danger btn-xs" href="'.BASE_PATH.'All_Comment/Deact/'.$row['id'].'/" onclick="return confirm(\'Are You sure to Deactivate this Comment \');" title="Deactivate">
																				<i class="fa fa-times "></i>
																				</a>';
																			}else{
																				echo'<a class="btn btn-success btn-xs" href="'.BASE_PATH.'All_Comment/Act/'.$row['id'].'/" onclick="return confirm(\'Are You sure to Deactivate this Comment \');" title="Activate" >
																				<i class="fa fa-check "></i>
																				</a>';
																			}
																		echo '</td>
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