<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'Model/class.section.php';
include 'config/function.php';
$page="chpassword";

include 'config/page_permission_check.php';
if($_SESSION['MISCHOOL_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH.'/All_Class/');
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_class where id='".$edit_id."' and mi_status='Yes'");
$row=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Change Password </title>
	<?php include 'config/head.php';?>
	 
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
			<!-- start sidebar menu -->
			<?php include 'config/leftmenu.php';?>
			<!-- end sidebar menu -->
			<!-- start page content -->
			<div class="page-content-wrapper">
				<div class="page-content">
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
									<header>Change Password Form</header>
									
								</div>
								
								<form method="post" action="" id="act-form">
								<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
								<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
								<input type="hidden" name="method" value="<?php echo $method;?>" />
								<input type="hidden" name="pg_pmsn" value="<?php echo $page_permission;?>" />
								<div class="card-body " id="bar-parent2">
									<div class="row">
									<div class="col-md-12 col-12">
										<div class="form-group">
											<label>User Name *</label>
											<input type="text" class="form-control" maxlength="50" name="user_id" value="<?php echo $_SESSION['MISCHOOL_loginid'];?>" readonly />
										</div>
									</div>
									<div class="col-md-12 col-12">
										<div class="form-group">
											<label>Old Password *</label>
											<input type="text" class="form-control" maxlength="50" name="oldpwd" value="" />
										</div>
									</div>
									<div class="col-md-12 col-12">
										<div class="form-group">
											<label>New Password *</label>
											<input type="text" class="form-control" maxlength="50" name="newpwd" value="" />
										</div>
									</div>
									<div class="col-md-12 col-12">
										<div class="form-group">
											<label>Confirm Password *</label>
											<input type="text" class="form-control" maxlength="50" name="cnfpwd" value="" />
										</div>
									</div>

									<div id="msg"></div>
									<div class="col-lg-12 p-t-20 text-center">
										<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Submit</button>
										<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Cancel</button>
									</div>
										
										
										
									</div>
								</div>
								</form>
								
							
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
	
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/CHNGPWD/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
				$('#preloader').hide();
				//alert(data);
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Change_Password/';},1500);
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
	
	
	$("#cat").blur(function(){
		var str=$.trim($(this).val());
		str=str.replace(/[\._ ,+'"&$@\/:-]+/g, "-").toLowerCase();
		//str = str.replace(/\s+/g, '-').toLowerCase();
		$("#url").val(str);
		
	});
} );
</script>
</body>

</html>