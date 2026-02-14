<?php  
error_reporting(0);
session_start();
include 'config/login_check.php';
include 'config/config.inc.php';
date_default_timezone_set("Asia/Kolkata");
$page="popular";
$act_id=(isset($_REQUEST['act_id']) and $_REQUEST['act_id'] !='')?$db->filterVar($_REQUEST['act_id']):'';
$deact_id=(isset($_REQUEST['deact_id']) and $_REQUEST['deact_id'] !='')?$db->filterVar($_REQUEST['deact_id']):'';

if(!empty($act_id))
{
	$q=$db->exeQuery("select * from nt_popular where news_id='".$act_id."'");
	if($q->num_rows)
	{
		$dop=date("Y-m-d");
		$db->exeQuery("update nt_popular set dop='".$dop."',nt_status='Yes' where news_id='".$act_id."'");
	}else{
		$dop=date("Y-m-d");
		$db->exeQuery("INSERT INTO `nt_popular`(`id`, `dop`, `news_id`, `nt_status`) VALUES ('0','".$dop."','".$act_id."','Yes')");
	}
	
	header('Refresh:1;url='.BASE_PATH.'Add_Popular/');
}
if(!empty($deact_id))
{
	$q=$db->exeQuery("select * from nt_popular where news_id='".$deact_id."'");
	if($q->num_rows)
	{
		$db->exeQuery("update nt_popular set nt_status='No' where news_id='".$deact_id."'");
	}
	
	header('Refresh:1;url='.BASE_PATH.'Add_Popular/');
}


?>
<!DOCTYPE html>
<html lang="en">
	<title>Popular News </title>
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
														<header>All News For Popular Category</header>
														
														
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
																		<th> S.No.</th>
																		<th> Title </th>
																		<th> Image </th>
																		<th> Display On Popular </th>
																		<th> Action </th>
																	</tr>
																</thead>
																<tbody>
																<?php 
																	$qr=$db->exeQuery("select * from nt_news where nt_status='Yes' order by dop desc");
																	$i=1;
																	while($row=$qr->fetch_assoc() )
																	{
																		$sl=$db->exeQuery("select * from nt_popular where news_id='".$row['id']."'");
																		$srow=$sl->fetch_assoc();
																		$act=($srow['nt_status']=='Yes')?'Yes':'No';
																		echo '
																		<tr>
																		<td>'.$i.'</td>
																		<td>'.$row['title'].'</td>
																		
																		<td>';
																		if($row['image']!=''){
																			echo '<img src="'.WEB_PATH.'images/newsimg/'.$row['image'].'" style="height:90px;" />';
																		}
																		echo '</td>
																		<td>'.$act.'</td>
																		<td>';
																			if($act=='Yes')
																			{
																				echo'<a class="btn btn-danger btn-xs" href="'.BASE_PATH.'Add_Popular/Deact/'.$row['id'].'/" onclick="return confirm(\'Are You sure to Deactivate this Popular \');" title="Deactivate">
																				<i class="fa fa-times "></i>
																				</a>';
																			}else{
																				echo'<a class="btn btn-success btn-xs" href="'.BASE_PATH.'Add_Popular/Act/'.$row['id'].'/" onclick="return confirm(\'Are You sure to Activate this Popular \');" title="Activate" >
																				<i class="fa fa-check "></i>
																				</a>';
																			}
																		echo '</td>
																		</tr>
																		';
																		$i++;
																	}
																?>
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

</html>