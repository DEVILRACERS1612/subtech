<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include './Model/class.designation.php';

$page="designation";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH.'/All_Designation/');
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_designation where id='".$edit_id."' and mi_status='Yes'");
$row=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add/Edit Designation </title>
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
									<header>Add Designation and Grade Authority </header>
								</div>
								
								<form method="post" action="" id="act-form">
								<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
								<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
								<input type="hidden" name="method" value="<?php echo $method;?>" />
								<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
								<div class="card-body " id="bar-parent2">
									<div class="row">
									<div class="col-md-3 col-sm-6">
										<div class="form-group">
											<label>Designation</label>
										<input class="form-control" name="designation" value="<?php echo $row['designation'];?>" />
									</div>
									</div>
									<!--<div class="col-md-3 col-sm-6">
										<div class="form-group">
											<label>Level (Above/Below/Same)</label>
											<select class="form-control" name="desig_level">
											<option value="Below" <?php echo ($row['desig_level']=="Below")?"selected":"";?> >Below</option>
											<option value="Above" <?php echo ($row['desig_level']=="Above")?"selected":"";?> >Above</option>
											
											<option value="Same" <?php echo ($row['desig_level']=="Same")?"selected":"";?>>Same</option>
											
											</select> 
										</div>
									</div>
									<div class="col-md-3 col-sm-6">
										<div class="form-group">
											<label>Authority  *</label>
											<select class="form-control" name="authority">
											<?php echo $objdesignation->desig_list($row['authority']);?>
											</select> 
										</div>
									</div>-->
									<div id="msg"></div>
									<div class="col-md-3 p-t-20 text-center">
										<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Submit</button>
										<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default" onclick="window.location='<?php echo BASE_PATH;?>';">Cancel</button>
									</div>
									</div>
								</div>
								</form>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card card-box">
								<div class="card-head">
									<header>All Designation </header>

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
										<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="exportTable111">
											<thead>
												<tr>
													<th>S.No.</th>
													<th> Designation Name </th>
													<th> Action </th>
												</tr>
											</thead>
											<tbody id="displaydata">
											<?php 
											$qr=$db->exeQuery("select * from mi_designation where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and mi_status='Yes'");
											$i=1;
											while($row=$qr->fetch_assoc())
											{
												echo "<tr><td>".$i."</td><td>".$row['designation']."</td><td><a href='".BASE_PATH."Add_Designation/Edit/".$row['id']."/' class='btn-sm btn-primary btn-xs'><i class='fa fa-pencil'></i></a> <a href='#' data-id='".$row['id']."' data-auth='".$row['authority']."' class='btn-sm btn-primary btn-xs auth' title='Update Permission'><i class='fa fa-lock'></i></a></td></tr>";
												$i++;
											}
											?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class='card card-box'><div class='card-head'><header>Modules Assign to Designation</header></div><div class='card-body' id='bar-parent2'><a href='#' class='sa'>Select All</a> / <a href='#' class='ca'>Clear All</a><br><br><form id='auth-form' method='post' enctype='multipart/form-data' class='form-horizontal'><input type='hidden' name='post_id' value='<?php echo $post_id;?>' /><input type='hidden' name='method' value='Authority' /><div class='row' id="displayauth">
							
							</div></form></div></div>
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
	
	checked_value();
	$("body").on("click",".sa",function(e){
		e.preventDefault();
		$(".chk1").prop("checked",true);
		$(".chk2").prop("checked",true);
		checked_value();
	});
	$("body").on("click",".ca",function(e){
		e.preventDefault();
		$(".chk1").prop("checked",false);
		$(".chk2").prop("checked",false);
		checked_value();
	});
	$("body").on("click",".chk1",function(){
		//id=$(this).attr("data-id");
		//$(".chk2"+id).prop("checked",$(this).prop("checked"));
		checked_value();
		
	});
	


	$("body").on("click",".chk2",function(){
		var feat=[];
		$.each($("input[class='chk2']:checked"), function(){
			feat.push($(this).val());
			//alert($(this).val());
		});
		$("#feature").val(feat);
		
	});
	
	function checked_value()
	{
		var mod=[];
		$.each($("input[class='chk1']:checked"), function(){
			mod.push($(this).val());
		});
		$("#module").val(mod);
		var feat=[];
		$.each($("input[class='chk2']:checked"), function(){
			///alert($(this).val());
			feat.push($(this).val());
		});
		$("#feature").val(feat);
	}
	/////////////////////////////////////////
	$("body").on("click",".auth",function(e){
		e.preventDefault();
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var id=$(this).attr("data-id");
		var auth=$(this).attr("data-auth");
		var datastr="authority="+auth+"&desig_id="+id+"&post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&method=ViewAuthority";
		//alert("ok");
		$("#displayauth").html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/DESIGNATION/',
			method:'post',
			data:datastr,
			success:function(data){
				//$('#preloader').hide();
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#displayauth").html(response.message);
				}
			}
		});/**/
	});
	
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/DESIGNATION/',
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Add_Designation/';},1500);
					display();
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
	});
	$("#auth-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/DESIGNATION/',
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Add_Designation/';},1500);
					display();
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
	});
	function display()
	{
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&method=View";
		$("#displaydata").html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/DESIGNATION/',
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
	
	$("#subcat").blur(function(){
		var str=$.trim($(this).val());
		str=str.replace(/[\._ ,+'"&$@\/:-]+/g, "-").toLowerCase();
		//str = str.replace(/\s+/g, '-').toLowerCase();
		$("#url").val(str);
		
	});
} );
</script>
</body>

</html>