<?php  
error_reporting(0);
session_start();
include 'config/login_check.php';
include 'config/config.inc.php';
$page="gallery";
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from nt_gallery where id='".$edit_id."' and nt_status='Yes'");
$row=$sql->fetch_assoc();


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ADD / EDIT Gallery </title>
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
									<header>New / Update Gallery </header>
									
								</div>
								
								<form method="post" id="act-form" enctype="multipart/form-data" >
								<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
								
								<div class="card-body" id="bar-parent2">
									<div class="row">
									<div class="col-md-9 col-sm-12">
									<!---<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label> Title *</label>
											<input type="text" class="form-control" id="cat" name="ltitle" value="<?php echo $row['ltitle'];?>" required/>
											
										</div>
									</div>-->
									
									
									<div class="col-md-12 col-sm-6">
									<div class="row">
									<div class="col-md-9 col-sm-6">
										<div class="form-group">
											<label>Image </label>
											<input type="file" id="uploadinput1" class="form-control" name="image" accept="image/*" onchange="uploadimg('1');" <?php echo ($row['image']!='')?'':'required';?> />
										</div>
									</div>
									<div class="col-md-2 col-sm-6">
										<div class="form-group">
											<?php 
											if($row['image']!='')
											{
												echo '<img id="upload1" src="'.WEB_PATH.'images/galimg/'.$row['image'].'" class="img-responsive" />';
											}else{
												echo '<img id="upload1" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
											}
											?>
											
											
										</div>
									</div>
									</div>
									</div>
									
									</div>
									<div class="col-md-3 col-sm-12">
									
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
		<script src="<?php echo BASE_PATH;?>assets/plugins/jquery-tags-input/jquery-tags-input.js"></script>
    <script src="<?php echo BASE_PATH;?>assets/plugins/jquery-tags-input/jquery-tags-input-init.js"></script>

		<!-- end footer -->
	</div>
<script>
$(document).ready(function(){
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/Gallery/',
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>All_Gallery/';},500);
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
		str=str.replace(/[\._ ,+'"?&$@\/:-]+/g, " ").toLowerCase();
		str=$.trim(str);
		str=str.replace(/[\._ ,+'"?&$@\/:-]+/g, "-").toLowerCase();
		//str = str.replace(/\s+/g, '-').toLowerCase();
		
		$("#url").val(str);
		
	});
	
	
	var cat=[];
		$.each($("input[class='chk1']:checked"), function(){
			cat.push($(this).val());
		});
	$("#c1").val(cat);
	
	$("body").on("click",".chk1",function(){
		var cat=[];
		$.each($("input[class='chk1']:checked"), function(){
			cat.push($(this).val());
		});
		$("#c1").val(cat);
	});
	
	var scat=[];
		$.each($("input[class='chk2']:checked"), function(){
			scat.push($(this).val());
		});
	$("#c2").val(scat);
	$("body").on("click",".chk2",function(){
		var scat=[];
		$.each($("input[class='chk2']:checked"), function(){
			scat.push($(this).val());
		});
		$("#c2").val(scat);
	});
	
	var ocat=[];
		$.each($("input[class='chk3']:checked"), function(){
			ocat.push($(this).val());
		});
	$("#c3").val(ocat);
	
	$("body").on("click",".chk3",function(){
		var ocat=[];
		$.each($("input[class='chk3']:checked"), function(){
			ocat.push($(this).val());
		});
		$("#c3").val(ocat);
	});
	
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