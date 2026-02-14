<?php  
include 'config/config.inc.php';
include 'config/login_check.php';

include 'config/function.php';
include './Model/class.module.php';
$page="feature";

$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$q=$db->exeQuery("select * from mi_feature where id='".$edit_id."' ");
$row=$q->fetch_assoc();
//$q1=$db->exeQuery("select * from mi_sys_user where user_id='".$row['user_id']."' ");
//$row1=$q1->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ADD / EDIT Feature </title>
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
						<div class="col-md-12 col-sm-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Add/Edit Feature </header>
								
								</div>
								<div class="card-body " id="bar-parent2">
									<form method="post" action="" id="act-form" enctype="multipart/form-data">
									<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
									<div class="row">
										<div class="col-md-6 col-sm-6">
											
											<div class="form-group">
												<label>Feature Module Name <span class="text-danger">*</span></label>
												<select class="form-control" name="m_code" required>
												<?php echo $objmodule->module_list($row['m_code']);?>
												</select> 
											</div>
											<div class="form-group">
												<label>Feature Code <span class="text-danger">*</span></label>
												<input type="text" class="form-control" placeholder="" name="f_code" required value="<?php echo $row['f_code'];?>" />
											</div>
											<div class="form-group">
												<label>Feature Name <span class="text-danger">*</span></label>
												<input type="text" class="form-control" placeholder="" name="f_name" required value="<?php echo $row['f_name'];?>" />
											</div>
											<div class="form-group">
												<label>Feature Page Name <span class="text-danger">*</span></label>
												<input type="text" class="form-control" placeholder="" name="f_page_name" required value="<?php echo $row['f_page_name'];?>" />
											</div>
											
											<div id="msg"></div>
											
												
										
										</div>
										<div class="col-md-6 col-sm-6">
										
										
										</div>
									</div>
									
									<div class="row">
									<div class="form-group">
									
										<div class="offset-md-6 col-md-6">
										
											<button type="submit" class="btn btn-info m-r-20">Submit</button>
											
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
	//alert("asdf");
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:"<?php echo BASE_PATH;?>Controller/FEATURE/",
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Manage_Feature/';},500);
				}
				else
				{
					$("#msg").html(response.message);
					setTimeout(function(){$("#msg").html('');},1500);
				}	
			}
			
		});
	} );
	
} );
</script>
<script type="text/javascript">
    function uploadimg(a) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadinput"+a).files[0]);

        oFReader.onload = function (oFREvent) {
            //document.getElementById("image"+a).src = oFREvent.target.result;
			document.getElementById("upload"+a).src = oFREvent.target.result;
        };
    }
</script>
</body>

</html>