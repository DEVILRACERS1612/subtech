<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.user.php';

$page="customer-list";
include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_delete']!='Yes' and $page_permission['pg_view']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}

/*
$del_id=(isset($_REQUEST['del_id']) and $_REQUEST['del_id'] !='')?$db->filterVar($_REQUEST['del_id']):'';
if(!empty($del_id))
{
	$q=$db->exeQuery("select * from mi_user where id='".$del_id."' and mi_status='Yes'");
	$r=$q->fetch_assoc();
	$picture='./images/rawmat/'.$r['image'];
	chmod($picture, 0644);
	unlink($picture);
	$db->exeQuery("delete from mi_user where id='".$del_id."' and mi_status='Yes'");
	$error="<span class='alert alert-danger'>Data Deleted Successfully</span>";
	header('Refresh:5;url='.BASE_PATH.'All_User/');
}
*/

?>
<!DOCTYPE html>
<html lang="en">
	<title>Customers </title>
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
					<header>All Customers</header>
					<div class="btn-group pull-right" style="padding-right:10px; padding-bottom:5px;">
						<!--<a href="<?php echo BASE_PATH;?>Add_User/" id="addRow" class="btn btn-primary">
							Add New User <i class="fa fa-plus"></i>
						</a>-->
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
									<th> Name </th>
									<th> Mobile </th>
									<th> Product </th>
									<th> Mobile 2 </th>
									<th> Address </th>
									<th> Email </th>
									
								</tr>
							</thead>
							<tbody id="">
							<?php
							//echo "select * from mi_user where cmp_id='".$_SESSION['MICMP_cmpid']."' and mi_status='Yes'";
							$qr=$db->exeQuery("select * from mi_customer where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
							$i=1;
						while($row=$qr->fetch_assoc())
						{
							/*if($row['image']!=''){
								$img="<img src='".BASE_PATH."images/user_img/".$row['image']."' style='height:50px;' />";
							}*/
							$nprd=$db->exeQuery("select count(id) as prd from mi_customer_product where mobile='".$row['mobile']."' and mi_status='Yes'")->fetch_assoc();
							
							echo "<tr><td>".$i."</td><td>".$row['cname']."</td><td>".$row['mobile']."</td><td><a href='#' class='custprd' data-mob='".$row['mobile']."'>".$nprd['prd']."</a></td><td>".$row['mobile2']."</td><td>".$row['address']."</td><td>".$row['email']."</td></tr>";
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
	var per1=JSON.stringify(per);
	$("body").on("click",".delme",function(e){
		var did=$(this).attr("data-id");
		var pgpmsn=$(this).attr("data-per");
		var cnf=confirm("Are you want to delete this record");
		e.preventDefault();
		if(cnf==false){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&del_id="+did+"&method=Delete";
		
		$(this).html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/USER/',
			method:'post',
			data:datastr,
			success:function(data){
				//$('#preloader').hide();
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
	
	function display(mob)
	{
		$("#displaydata").html('<tr><td colspan="4">Wait...</td></tr>');
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&mobile="+mob+"&method=ViewCustomerPrd";
		
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
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
	//////////////////////////////////////////////////
	$("body").on("click",".custprd",function(e){
		var mob=$(this).attr("data-mob");
		e.preventDefault();
		//var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&mobile="+mob+"&method=FindCust";
		$("#cust_view").modal("show");
		display(mob);
		
	});
	
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

</body>
<div class="modal fade" id="cust_view">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Customer Details.</h4>
			</div>
			<div class="modal-body">
			<div class="card-body">
				<div class="row align-center">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
								<th>#</th>
								
								<th>Product</th>
								<th>SerialNo</th>
								<th>Expiry</th>
								<th>Bill</th>
								<th>Installation</th>
								<th>Selfie</th>
								<th>AMF</th>
								<th>AMF Connection</th>
								<th>Gen. Connection</th>
								<th>Gen. Name</th>
								
								</tr>
							</thead>
							<tbody id="displaydata">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
			
		</div>
	</div>
</div>

</html>