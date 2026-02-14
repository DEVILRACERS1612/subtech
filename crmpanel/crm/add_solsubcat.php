<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include './Model/class.category.php';
$page="category";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_solsubcat where id='".$edit_id."' and mi_status='Yes'");
$row=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ADD/EDIT Solution SubCategory </title>
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
						<div class="col-sm-5">
							<div class="card-box">
								<div class="card-head">
									<header>Add/Edit Solution SubCategory Form</header>
									
								</div>
								
								<form method="post" action="" id="act-form" autocomplete="off">
								<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
								<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
								<input type="hidden" name="method" value="solsubcat" />
								<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
								<div class="card-body " id="bar-parent2">
									<div class="row">
									
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label>Category Name *</label>
											
											<select name="cat_id" class="form-control">
												<?=$objcat->solcat_list($row['cat_id'])?>
											</select>
											
											
										</div>
									</div>
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label>Sub-Category Name *</label>
											<input type="text" class="form-control" maxlength="150" name="subcat_name" value="<?php echo $row['subcat_name'];?>" required />
											
										</div>
									</div>
									
									<!---<div class="col-md-6 col-sm-6">
										<div class="form-group">
											<label>Code *</label>
											<input type="text" class="form-control" maxlength="50" name="code" value="<?php echo $row['code'];?>" required />
											
										</div>
									</div>	
									<div class="col-md-12 col-sm-12">
										<div class="form-group">
											<label>Software Title </label>
											<input type="text" class="form-control" maxlength="70" name="soft_title" value="<?php echo $row['soft_title'];?>" />
										</div>
									</div>	
									<div class="col-md-12 col-sm-12">
										<div class="form-group">
											<label>Public Title </label>
											<input type="text" class="form-control" maxlength="70" name="web_title" value="<?php echo $row['web_title'];?>" />
										</div>
									</div>	-->
									
									<div class="col-md-8 col-sm-6">
										<div class="form-group">
											<label> Image <br>(600 x 600 for best view)</label>
											<input type="file" id="uploadinput1" class="form-control" name="image" accept="image/*" onchange="uploadimg('1');" />
											<input type="text" id="" class="form-control" name="alttext" value="<?php echo $row['alttext'];?>" placeholder="Alt/Title Text" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<?php 
											if($row['image']!='')
											{
												echo '<img id="upload1" src="'.WEB_PATH.'images/solsubcat_img/'.$row['image'].'" class="img-responsive" />';
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
						<div class="col-md-7">
						<div class="card-box">
						<div class="card-head">
							<header>All Solution Sub-Category </header>
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
											<th> Sub Category  </th>
											<th> Category  </th>
											<!--<th> Code </th>-->
											<th> Action </th>
										</tr>
									</thead>
									<tbody id="displaydata">
									<?php 
									$qr=$db->exeQuery("select * from mi_solsubcat where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
									$i=1;
									while($row=$qr->fetch_assoc())
									{//<td>".$row['code']."</td>
										echo "<tr><td>".$i."</td><td>".$row['subcat_name']."</td><td>".$objcat->solcat_name($row['cat_id'])."</td><td><a href='".BASE_PATH."Add_Solsubcat/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."' data-per='".$page_permission."'><i class='fa fa-trash-o '></i></a></td></tr>";
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
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&del_id="+did+"&method=DeleteSolsubcat";
		
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
					setTimeout(function(){display();},2500);
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
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&method=ViewSolsubcat";
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Add_Solsubcat/';},1500);
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