<?php  
error_reporting(0);
session_start();
include 'config/login_check.php';
include 'config/config.inc.php';
$page="cat";
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from am_category where id='".$edit_id."' and am_status='Yes'");
$row=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ADD/EDIT Menu Bar </title>
	<?php include 'config/head.php';?>
	 <link href="<?php echo BASE_PATH;?>assets/plugins/summernote/summernote.css" rel="stylesheet">
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
									<header>Menu Bar Information</header>
									
								</div>
								
								<form method="post" action="" id="act-form">
								<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
								
								<div class="card-body " id="bar-parent2">
									<div class="row">
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label>Category *</label>
											<input type="text" class="form-control" maxlength="50" id="cat" name="cat" value="<?php echo $row['cat'];?>" required/>
											<input type="text" class="form-control" maxlength="50" id="url" name="urlname" value="<?php echo $row['url_name'];?>" required/>
										</div>
									</div>
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label>Page Title</label>
										<textarea class="form-control" name="pagetitle"><?php echo $row['pagetitle'];?></textarea>
									</div>
									</div>
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label>Page Content</label>
										<textarea name="pagecontent" id="summernote" cols="30" rows="10"><?php echo $row['pagecontent'];?></textarea>
										
										
									</div>
									</div>
									
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label>Meta Title</label>
										<textarea class="form-control" name="ptitle"><?php echo $row['ptitle'];?></textarea>
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
		<script src="<?php echo BASE_PATH;?>assets/plugins/summernote/summernote.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/js/pages/summernote/summernote-data.js"></script>
		<!-- end footer -->
	</div>
<script>
$(document).ready(function(){
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/CAT/',
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
					$("#msg").html(response.message);
					setTimeout(function(){$("#msg").html('');},1500);
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>All_cat/';},500);
				}
				else
				{
					$("#msg").html(response.message);
					setTimeout(function(){$("#msg").html('');},1500);
				}	
			}
			
		});
	} );
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