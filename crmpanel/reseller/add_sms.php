<?php  
error_reporting(0);
session_start();
include 'config/login_check.php';
include 'config/config.inc.php';
$page="sms";
/*$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from nt_news where id='".$edit_id."' and nt_status='Yes'");
$row=$sql->fetch_assoc();
$tsql=$db->exeQuery("select * from nt_tags where news_id='".$edit_id."' and nt_status='Yes'");
$tags='';
while($tg=$tsql->fetch_assoc()){$tags.=$tg['tags'].",";}
$tags=rtrim($tags,",");*/


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Send SMS </title>
	<?php include 'config/head.php';?>
	 <link href="<?php echo BASE_PATH;?>assets/plugins/jquery-tags-input/jquery-tags-input.css" rel="stylesheet">
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
									<header>New / Update SMS </header>
								</div>
								<div class="card-body" id="bar-parent2">
									<div class="row">	
									<div class="col-md-9 col-sm-6">
									<h3>Upload CSV File and send SMS</h3>
									<form id="csvform" action="" method="post" enctype="multipart/form-data">
									<div class="form-group">
									<label class="col-md-4 control-label" for="example-text-input">Select File (.csv) </label>
									<div class="col-md-6">
									<input type="file"  name="csvfile"  class="form-control" >
									<span>Only select .csv file in Proper Format</span>
									</div>
									</div>
									<div class="form-group">
									<div class="col-md-6">
									<input type="submit" name="submit" class="btn btn-primary" value="Upload"/> 
									<span id="msg1"></span>
									</div>
									</div>
									</form>
									</div>
									<div class="col-md-3"> Download Sample .CSV file <a href="<?php echo BASE_PATH;?>mobile.csv" download="sample.csv" class="btn btn-primary" >Click Here</a>
									</div>
									</div>
								</div>
								<form method="post" id="act-form" enctype="multipart/form-data" style="background:#f5f5f5;">
								
								<div class="card-body" id="bar-parent2">
									<div class="row">
									<div class="col-md-9 col-sm-12">
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<h3>Send SMS</h3>
											<label>Type Mobile (Use , for multiple Mobile) *</label>
											<input type="text" class="form-control" id="mob" name="mobile" value="" required/>
											
										</div>
									</div>
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
										<label>Full SMS</label>
										<textarea name="message" class="form-control" cols="30" rows="5"></textarea>
										</div>
									</div>
									<div id="msg"></div>
									<div class="col-lg-12 p-t-20 text-center">
										<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Send</button>
										
									</div>
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
		<script src="<?php echo BASE_PATH;?>assets/plugins/jquery-tags-input/jquery-tags-input.js"></script>
    <script src="<?php echo BASE_PATH;?>assets/plugins/jquery-tags-input/jquery-tags-input-init.js"></script>

		<!-- end footer -->
	</div>
<script>
$(document).ready(function(){
	$("#csvform").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/SMS/',
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
					$("#msg1").html(response.message);
					$("#mob").val(response.mob);
					setTimeout(function(){$("#msg1").html('');},1500);
					$("#csvform").trigger("reset");
				}
				else
				{
					$("#msg").html(response.message);
					setTimeout(function(){$("#msg").html('');},1500);
				}	
			}
			
		});
	} );
	
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/SMS/',
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Add_SMS/';},500);
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