<?php  
include 'config/config.inc.php';
include 'config/login_check.php';

include './Model/class.module.php';
include './Model/class.feature.php';

$page="feature";

$del_id=(isset($_REQUEST['deact_id']) and $_REQUEST['deact_id'] !='')?$db->filterVar($_REQUEST['deact_id']):'';
if(!empty($del_id))
{
	$q=$db->exeQuery("update mi_feature set mi_status='No' where id='".$del_id."' ");

	header('Refresh:1;url='.BASE_PATH.'Manage_Feature/');
}
$act_id=(isset($_REQUEST['act_id']) and $_REQUEST['act_id'] !='')?$db->filterVar($_REQUEST['act_id']):'';
if(!empty($act_id))
{
	$q=$db->exeQuery("update mi_feature set mi_status='Yes' where id='".$act_id."' ");

	header('Refresh:1;url='.BASE_PATH.'Manage_Feature/');
}


?>
<!DOCTYPE html>
<html lang="en">
	<title>All Feature </title>
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
		<header>All Features </header>
			<div class="btn-group pull-right" style="padding-right:10px;padding-bottom:5px;">
			<a href="<?php echo BASE_PATH;?>Add_Feature/" id="addRow" class="btn btn-primary" ata-toggle="modal" data-target="#exampleModal">
				Add New Feature <i class="fa fa-plus"></i>
			</a>
		</div>
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
						<!--<th>Feature Group Code </th>-->
						<th>Module Name </th>
						<th>Feature Code </th>
						<th>Feature Name </th>
						<th>Feature Page Name </th><!---->
						
						<th> Action </th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$qr=$db->exeQuery("select * from mi_feature order by f_name");
					$i=1;
					while($row=$qr->fetch_assoc())
					{
						echo '
						<tr>
						<td>'.$i.'</td>
						<td>'.$objmodule->module_name($row['m_code']).'</td>
						<td>'.$row['f_code'].'</td>
						<td>'.$row['f_name'].'</td>
						<td>'.$row['f_page_name'].'</td>
						
						<td>';
						echo'<a class="btn btn-info btn-xs" href="'.BASE_PATH.'Add_Feature/'.$row['id'].'/" title="Edit"><i class="fa fa-pencil "></i></a>';	
						
							if($row['mi_status']=='Yes')
							{
																				echo'<a class="btn btn-danger btn-xs" href="'.BASE_PATH.'Manage_Feature/Deact/'.$row['id'].'/" onclick="return confirm(\'Are You sure to Deactivate this Feature \');" title="Deactivate">
																				<i class="fa fa-times "></i>
																				</a>';
																			}else{
																				echo'<a class="btn btn-success btn-xs" href="'.BASE_PATH.'Manage_Feature/Act/'.$row['id'].'/" onclick="return confirm(\'Are You sure to Deactivate this Feature \');" title="Activate" >
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

<!-- Add New -->
<div class="modal fade" id="addreseller" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

