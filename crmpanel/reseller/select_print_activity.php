<?php  
error_reporting(0);
session_start();
include 'config/login_check.php';
include 'config/config.inc.php';
$page="printact";
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from memu_activity_detail where id='".$edit_id."' and m_status='Yes'");
$row=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Print ACTIVITY | MEMU SHED </title>
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
									<header>Select Activity for Print</header>
									
								</div>
								
								<form method="post" action="<?php echo BASE_PATH;?>Print_activity/" target="_blank" >
								<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
								
								<div class="card-body " id="bar-parent2">
									<div class="row">
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label>Select Activity Code</label>
											<select id="act_id" name="act_id" class="form-control select2-multiple" >
												<option value="">--Select--</option>
											<?php 
												$aql=$db->exeQuery("select * from memu_activity where m_status='Yes' order by acode");
												while($arow=$aql->fetch_assoc())
												{
													$act=explode(",",$row['act_id']);
													$cl=(in_array($arow['id'],$act))?'selected':'';
													echo '<option value="'.$arow['id'].'" '.$cl.'>'.$arow['acode'].' '.$arow['aname'].' ('.$arow['a_type'].') '.$arow['coach'].'</option>';
												}
											?>
											</select>
										</div>
									</div>
									<!--<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label>Select Activity Category</label>
											<select id='cat_id' name="cat_id" class="form-control select2-multiple" placeholder="Select Activity">
												<option value="">--Select--</option>
											<?php 
												$aql=$db->exeQuery("select * from memu_activity_cat where m_status='Yes'");
												while($arow=$aql->fetch_assoc())
												{
													$act=explode(",",$row['cat_id']);
													$cl=(in_array($arow['id'],$act))?'selected':'';
													echo '<option value="'.$arow['id'].'" '.$cl.'>'.$arow['cat_name'].' </option>';
												}
											?>
										</select>
										</div>
									</div>
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
										<label>Activity </label>
										<input class="form-control" name="act_name" value="<?php echo $row['act_name'];?>" required />
									</div>
									</div>--->
										
									<div id="msg"></div>
									<div class="col-lg-12 p-t-20 text-center">
										<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Print</button>
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
	$("#act_id").on("change",function(e){
		e.preventDefault();
		var act=$(this).val();
		var datastr="act_id="+act+"&method=findcat";
		$("#preloader").show();
		//alert(datastr);
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/Activity_cat/',
			type:'post',
			data:datastr,//new FormData(this),
			success:function(data){
				$('#preloader').hide();
				//alert(data);
				var response=(JSON.parse(data));
				if(response.type=="success")
				{	
					$("#cat_id").html(response.message);
				}
			}
			
		});
	} );
	////////////////////////
	/*$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/Print_activity/',
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>All_activity_details/';},500);
				}
				else
				{
					$("#msg").html(response.message);
					setTimeout(function(){$("#msg").html('');},1500);
				}	
			}
			
		});
	} );*/
	
	
	
} );
</script>
</body>

</html>