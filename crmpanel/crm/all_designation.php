<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.department.php';
$page="designation";

include 'config/page_permission_check.php';
if($_SESSION['MISCHOOL_usertype']!='Admin' and $page_permission['pg_delete']!='Yes' and $page_permission['pg_view']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}


?>
<!DOCTYPE html>
<html lang="en">
	<title>All Designation </title>
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
														<header>All Designation </header>
														
														<div class="btn-group pull-right" style="padding-right:10px;padding-bottom:5px;">
															<a href="<?php echo BASE_PATH;?>Add_Designation/" id="addRow" class="btn btn-primary">
																Add New Designation <i class="fa fa-plus"></i>
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
																		<th> Class Name </th>
																		<th> Designation Name </th>
																		<th> Description </th>
																		<th> Action </th>
																	</tr>
																</thead>
																<tbody id="displaydata">
																<?php 
																$qr=$db->exeQuery("select * from mi_designation where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and mi_status='Yes'");
																$i=1;
																while($row=$qr->fetch_assoc())
																{
																	echo "<tr><td>".$i."</td><td>".$objdep->dep_name($row['dep_id'])."</td><td>".$row['designation']."</td><td>".$row['description']."</td><td><a href='".BASE_PATH."Add_Designation/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."' data-per='".$page_permission."'><i class='fa fa-trash-o '></i></a></td></tr>";
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
<script>
$(document).ready(function(){
	//display();
	var per=<?php echo json_encode($page_permission);?>;
	var pgpmsn=JSON.stringify(per);
	$("body").on("click",".delme",function(e){
		var did=$(this).attr("data-id");
		//var pgpmsn=$(this).attr("data-per");
		var cnf=confirm("Are you want to delete this record");
		
		if(cnf==false){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&del_id="+did+"&method=Delete";
		e.preventDefault();
		$(this).html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/DESIGNATION/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$.toast({
						heading: 'Success',
						text: response.message,
						position: 'mid-center',
						stack: false,
						icon:'success'
					});
					setTimeout(function(){display();},2500);
				}
				else
				{
					$.toast({
						heading: 'Fail',
						text: response.message,
						position: 'mid-center',
						stack: false,
						icon:'error'
					});
					
				}	
			}
			
		});
	} );
	
	function display()
	{
		var per=<?php echo json_encode($page_permission);?>;
		var pgpmsn=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&method=View";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/DESIGNATION/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#displaydata").html(response.message);
					//alert(response.message);
				}
			}
		});
	}
	
	
	<?php 
	if($permission_error!='')
	{
		?>
		$.toast({
			heading: 'Fail',
			text: '<?php echo $permission_error;?>',
			position: 'mid-center',
			stack: false,
			icon:'error'
		});
		<?php 
	}
	?>
} );
</script>
	<!-- end js include path -->
</body>

</html>