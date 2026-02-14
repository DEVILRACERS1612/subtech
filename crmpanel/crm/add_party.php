<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.party.php';

$page="party";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH.'/All_Class/');
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_party where id='".$edit_id."' and mi_status='Yes'");
$row=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ADD/EDIT Supplier </title>
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
									<header>Add/Edit Supplier Information</header>
									
								</div>
								
								<form method="post" action="" id="act-form" enctype="multipart/form-data">
								<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
								<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
								<input type="hidden" name="method" value="<?php echo $method;?>" />
								<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
								
								<div class="card-body " id="bar-parent2">
									<div class="row">
									<input type="hidden" name="party_type" value="Creditors"/>
									<!---<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<label>Party Type *</label>
											<select class="form-control" name="party_type" required>
											<option value="">-Select--</option>
											<option value="Admin" <?php echo ($row['party_type']=='Creditors')?"selected":"";?> >Creditors</option>
											<option value="User" <?php echo ($row['party_type']=='Debitors')?"selected":"";?>>Debitors</option>
											</select> 
										</div>
									</div>-->
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<label>Supplier Name *</label>
											<input type="text" class="form-control" name="party_name" value="<?php echo $row['party_name'];?>" maxlength="70" required />
											
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<label>GSTIN </label>
											<input type="text" class="form-control" name="gstin" value="<?php echo $row['gstin'];?>" maxlength="50" required />
											
										</div>
									</div>
									
									<div class="col-md-4 col-sm-4">
										<div class="form-group">
											<label>Email *</label>
											<input type="email" class="form-control" name="email" value="<?php echo $row['email'];?>" maxlength="50" required />
											
										</div>
									</div>
									<div class="col-md-4 col-sm-4">
										<div class="form-group">
											<label>Mobile *</label>
											<input type="text" class="form-control" name="mobile" value="<?php echo $row['mobile'];?>" maxlength="10" onkeypress="return isNumber(event)" required />
											
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<label>Address </label>
											<input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>" maxlength="100"  />
											
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
												echo '<img id="upload1" src="'.BASE_PATH.'images/party_img/'.$row['image'].'" class="img-responsive" />';
											}else{
												echo '<img id="upload1" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
											}
											?>
											
											
										</div>
									</div>
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label>Other Detail </label>
										<textarea class="form-control" name="other_detail"><?php echo $row['other_detail'];?></textarea>
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
			url:'<?php echo BASE_PATH;?>Controller/PARTY/',
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
					//$("#msg").html(response.message);
					//setTimeout(function(){$("#msg").html('');},1500);
							
					
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>All_Party/';},2000);
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
					
					//$("#msg").html(response.message);
					setTimeout(function(){$("#msg").html('');},1500);
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