<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'Model/class.section.php';
include 'config/function.php';
$page="company_profile";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
//print_r($page_permission);
//$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_cmp_profile where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
$row=$sql->fetch_assoc();
$method=(isset($row['id']) and $row['id'] !='')?'Edit':'New';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Company Porfile</title>
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
					<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
									<header>Company Profile </header>
									<!--<small> <a href=""> Edit <i class="fa fa-pencil"></i></a></small>-->
								</div>
								
								<form method="post" action="" id="act-form">
								<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
								<input type="hidden" name="edit_id" value="<?php echo $row['id'];?>" />
								<input type="hidden" name="method" value="<?php echo $method;?>" />
								<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
								<div class="card-body " id="bar-parent2">
									<div class="row">
									
									<div class="col-md-6 col-sm-6">
											<div class="form-group">
												<label> Name <span class="text-danger">*</span></label>
												<input type="text" value="<?php echo $row['cmp_name'];?>" class="form-control" placeholder="" name="cmp_name" required>
											</div>
																															
											<div class="form-group">
												<label> Registration No.</label>
												<input type="text" value="<?php echo $row['regno'];?>" class="form-control" placeholder="" name="regno">
											</div>
											
												
											<div class="form-group">
												<label> Affliation No.</label>
												<input type="text" value="<?php echo $row['affiliation'];?>" class="form-control" placeholder="" name="affiliation">
											</div>
											
											<div class="row">
												<div class="col-md-8 col-sm-6">
													<div class="form-group">
														<label> Logo </label>
														<input type="file" id="uploadinput1" class="form-control" name="image" accept="image/*" onchange="uploadimg('1');" />
													</div>
												</div>
												<div class="col-md-4 col-sm-6">
													<div class="form-group">
														<?php 
														if($row['logo']!='')
														{
															echo '<img id="upload1" src="'.BASE_PATH.'images/cmp_img/'.$row['logo'].'" class="img-responsive" />';
														}else{
															echo '<img id="upload1" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
														}
														?>
														
														
													</div>
												</div>
											</div>
											
												
										
										</div>
										<div class="col-md-6 col-sm-6">
										<div class="form-group">
												<label> Mobile Nos. <span class="text-danger">*</span></label>
												<input type="text" value="<?php echo $row['mobile'];?>" class="form-control" placeholder="" maxlength="100" name="mobile" required>
											</div>
											<div class="form-group">
												<label>Emails <span class="text-danger">*</span></label>
												<input type="text" value="<?php echo $row['emails'];?>" class="form-control" placeholder="" maxlength="100" name="emails" required>
											</div>
											<div class="form-group">
												<label>Web URL <span class="text-danger">*</span></label>
												<input type="text" value="<?php echo $row['web_url'];?>" class="form-control" placeholder="" maxlength="150" name="web_url" required>
											</div>
											<div class="form-group">
												<label>Full Address</label>
												<input type="text" class="form-control" placeholder="" value="<?php echo $row['address']; ?>" name="address">
											</div>
											
										</div>									
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label>Description</label>
										<textarea class="form-control" name="description"><?php echo $row['description'];?></textarea>
									</div>
									</div>
										
									<div id="msg"></div>
									<div class="col-lg-12 p-t-20 text-center">
										<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">
										<?php
										if($row['id']!='')
										{
											echo 'Update';
										}else{
											echo 'Submit';
										}?>
										
										</button>
										<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default" onclick="window.location='<?php echo BASE_PATH;?>'">Close</button>
									</div>
										
										
										
									</div>
								</div>
								</form>
								
							
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
	
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PROFILE/',
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>company-profile/';},1500);
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