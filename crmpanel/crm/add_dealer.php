<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.category.php';

$page="dealer";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_dealer where id='".$edit_id."' and mi_status='Yes'");
$row=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ADD/EDIT Dealer </title>
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
						<div class="col-sm-7">
							<div class="card-box">
								<div class="card-head">
									<header>Add/Edit Dealer</header>
									
								</div>
								
								<form method="post" action="" id="act-form" autocomplete="off">
								<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
								<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
								<input type="hidden" name="method" value="Dealer" />
								<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
								<div class="card-body " id="bar-parent2">
									<div class="row">
									
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label> Owner Name *</label>
									<input type="text" class="form-control" id="" maxlength="80" name="dname" value="<?php echo $row['dname'];?>" required />

								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label> Agency </label>
									<input type="text" class="form-control" id="" maxlength="80" name="aname" value="<?php echo $row['aname'];?>"  />

								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label> Email </label>
									<input type="email" class="form-control" id="" maxlength="80" name="email" value="<?php echo $row['email'];?>"  />

								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label> Mobile *</label>
									<input type="text" class="form-control" id="" maxlength="50" name="mobile" onkeypress="return isNumber(event)" value="<?php echo $row['mobile'];?>" required />

								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label> Address *</label>
									<input type="text" class="form-control" id="" maxlength="200" name="address" value="<?php echo $row['address'];?>" required />

								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label> Any Link </label>
									<input type="text" class="form-control" id="" maxlength="250" name="urlname" value="<?php echo $row['urlname'];?>"  />

								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label> State </label>
									<select class="form-control" id="" name="state">
									<?=$objcat->state_list($row['state'])?>
									</select>

								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label> City </label>
									<input type="text" class="form-control" id="" maxlength="250" name="city" value="<?php echo $row['city'];?>"  />

								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label> Pincode </label>
									<input type="text" class="form-control" id="" maxlength="6" name="pincode" onkeypress="return isNumber(event)" value="<?php echo $row['pincode'];?>"  />

								</div>
							</div>
							
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label> Product Category </label>
									<select class="form-control select2" id="jcat" name="pcat_id[]" multiple>
									<?= $objcat->pcat_list($row['pcat_id']);?>
									</select>
									
									
								</div>
							</div>
							
							<div class="col-md-12 col-sm-6">
								<div class="form-group">
									<label> Any Description </label>
									<textarea class="form-control" name="description"><?php echo $row['description'];?></textarea>
								</div>
							</div>
							<div class="col-md-12 col-sm-6">
							<div class="row">
							<div class="col-md-9 col-sm-6">
								<div class="form-group">
									<label>Dealer Image </label>
									<input type="file" id="uploadinput1" class="form-control" name="image" accept="image/*" onchange="uploadimg('1');" />
									<input type="text" id="" class="form-control" name="alttext" value="<?php echo $row['alttext'];?>" placeholder="Alt/Title Text" />
								</div>
							</div>
							<div class="col-md-2 col-sm-6">
								<div class="form-group">
									<?php 
									if($row['image']!='')
									{
										echo '<img id="upload1" src="'.WEB_PATH.'images/dealer_img/'.$row['image'].'" class="img-responsive" />';	
										}else{
										echo '<img id="upload1" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
									}
									?>
									
									
								</div>
							</div>
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
						<div class="col-md-5">
						<div class="card-box">
						<div class="card-head">
							<header>All Dealer </header>
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
								<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="exportTable">
									<thead>
										<tr>
											<th>S.No.</th>
											<th> Dealer  </th>
											<th> Deals-in  </th>
											<th> Mobile  </th>
											<th> Action </th>
										</tr>
									</thead>
									<tbody id="displaydata">
									<?php 
									$qr=$db->exeQuery("select * from mi_dealer where  mi_status='Yes'");
									$i=1;
									while($row=$qr->fetch_assoc())
									{
										echo "<tr><td>".$i."</td><td>".$row['dname']."</td><td>".$objcat->pcat_name($row['pcat_id'])."</td><td>".$row['mobile']."</td><td><a href='".BASE_PATH."Add_Dealer/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
										$i++;
									}
									?>
									</tbody>
								</table>
							</div>
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

<script src="<?php echo BASE_PATH;?>assets/plugins/summernote/summernote.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/pages/summernote/summernote-data.js"></script>		
		<!-- end footer -->
	</div>
	
<script>
$(document).ready(function(){
	var per=<?php echo json_encode($page_permission);?>;
	var pgpmsn=JSON.stringify(per);
	$("body").on("click",".delme",function(e){
		var did=$(this).attr("data-id");
		//var pgpmsn=$(this).attr("data-per");
		var cnf=confirm("Are you want to delete this record");
		e.preventDefault();
		if(cnf==false){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&del_id="+did+"&method=DeleteDealer";
		
		$(this).html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/CATEGORY/',
			method:'post',
			data:datastr,
			success:function(data){
				//$('#preloader').hide();
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
					setTimeout(function(){window.location.reload();},2500);
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
	
	function display()
	{
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&method=ViewBlog";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/CATEGORY/',
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
//	var per=<?php echo json_encode($page_permission);?>;
//	var per1=JSON.stringify(per);
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/CATEGORY/',
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Add_Dealer';},1500);
				}else{
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
	$("#jcatname").hide();
	$("#jcat").on("change",function(){
		var v=$(this).val();
		if(v=='New')
		{
			$("#jcat").hide();
			$("#jcatname").show().focus();
		}else{
			$("#jcat").show();
			$("#jcatname").val(v).hide();
		}
	});
	$("#cat").on("keyup",function(){
		var str=$.trim($(this).val());
		str=str.replace(/[\._ ,+'"?&$@\/:-]+/g, " ").toLowerCase();
		str=$.trim(str);
		str=str.replace(/[\._ ,+'"?&$@\/:-]+/g, "-").toLowerCase();
		//str = str.replace(/\s+/g, '-').toLowerCase();
		
		$("#url").val(str);
		
	});
	
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