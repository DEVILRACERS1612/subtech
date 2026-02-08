<?php  
error_reporting(0);
session_start();
include 'config/login_check.php';
include 'config/config.inc.php';
include 'Model/class.color.php';
include 'Model/class.cat.php';
include 'Model/class.uom.php';

$page="product";
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from am_products where id='".$edit_id."' and am_status='Yes'");
$row=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ADD/EDIT Products </title>
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
									<header>Product Information</header>
								</div>
								
								<form method="post" action="" id="act-form" enctype="multipart/form-data">
								<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
								
								<div class="card-body " id="bar-parent2">
									<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>Category *</label>
											<select class="form-control" name="cat">
											<?php echo $objcat->catlist($row['cat_id']);?>
											</select> 
										</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>Color *</label>
											<select class="form-control" name="color">
											<?php echo $objcolor->colorlist($row['color']);?>
											</select> 
										</div>
									</div>
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label>Product Name *</label>
											<input type="text" class="form-control" name="pname" value="<?php echo $row['pname'];?>" />
											
										</div>
									</div>
									<div class="col-md-3 col-sm-6">
										<div class="form-group">
											<label>Price Per </label>
											<input type="text" class="form-control" name="price" value="<?php echo $row['price'];?>" />
										</div>
									</div>
									<div class="col-md-2 col-sm-6">
										<div class="form-group">
											<label>Unit </label>
											<select class="form-control" name="uom">
											<?php echo $objuom->uomlist($row['uom']);?>
											</select> 
										</div>
									</div>
									<div class="col-md-3 col-sm-6">
										<div class="form-group">
											<label>Opening Qty </label>
											<input type="text" class="form-control" name="op_qty" value="<?php echo $row['op_qty'];?>" />
										</div>
									</div>
									<div class="col-md-3 col-sm-6">
										<div class="form-group">
											<label>Image </label>
											<input type="file" id="uploadinput1" class="form-control" name="image" accept="image/*" onchange="uploadimg('1');" />
										</div>
									</div>
									<div class="col-md-1 col-sm-6">
										<div class="form-group">
											<?php 
											if($row['image']!='')
											{
												echo '<img id="upload1" src="'.BASE_PATH.'images/product/'.$row['image'].'" class="img-responsive" />';
											}else{
												echo '<img id="upload1" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
											}
											?>
											
											
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
		<!-- end footer -->
	</div>
<script>
$(document).ready(function(){
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/product/',
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>All_product/';},500);
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
<script type="text/javascript">
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	//if(charCode==46){return true;}
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>
</body>

</html>