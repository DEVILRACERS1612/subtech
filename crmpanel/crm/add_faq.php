<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.category.php';

$page="faq";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_faq where id='".$edit_id."' and mi_status='Yes'");
$row=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ADD/EDIT FAQ </title>
	<?php include 'config/head.php';?>

	<style>
	.remme{
		position:absolute;
		right:20px;
	}
	</style>
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
									<header>Add/Edit FAQs</header>
									
								</div>
								
								<form method="post" action="" id="act-form" autocomplete="off">
								<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
								<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
								<input type="hidden" name="method" value="FAQ" />
								<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
								<div class="card-body " id="bar-parent2">
									<div class="row">
									
							
							<div class="col-md-12 col-sm-12">
								<div class="form-group">
									<label> FAQ For Products </label>
									<select class="form-control select2" name="prd_id[]" multiple >
									<?= $objcat->product_list($row['prd_id']);?>
									</select>
									
									
								</div>
							</div>
							</div>
							<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label> Question *</label>
					<textarea class="form-control" name="ques[]" style="resize:none;"><?php echo $row['ques'];?></textarea>

				</div>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label>Answer * <?php if($edit_id==""){echo '<a href="" class="btn btn-xs btn-primary addmore"><i class="fa fa-plus"></i></a>';}?></label>
					<textarea class="form-control" id="summernotexx" name="ans[]" style="resize:none;"><?php echo $row['ans'];?></textarea>

				</div>
			</div>
			</div>
			<div id="moredata">
			</div>
							
							
							<div class="row">
								
							
							
										
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
						<div class="col-md-12">
						<div class="card-box">
						<div class="card-head">
							<header>All FAQs </header>
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
											<th> Product  </th>
											<th> Ques  </th>
											<th> Answer  </th>
											<th> Action </th>
										</tr>
									</thead>
									<tbody id="displaydata">
									<?php 
									$qr=$db->exeQuery("select * from mi_faq where  mi_status='Yes'");
									$i=1;
									while($row=$qr->fetch_assoc())
									{
										echo "<tr><td>".$i."</td><td>".$objcat->prd_name($row['prd_id'])."</td><td>".$row['ques']."</td><td>".$row['ans']."</td><td><a href='".BASE_PATH."Add_FAQ/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
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
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&del_id="+did+"&method=DeleteFAQ";
		
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Add_FAQ';},1500);
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
	
	$("#cat").on("keyup",function(){
		var str=$.trim($(this).val());
		str=str.replace(/[\._ ,+'"?&$@\/:-]+/g, " ").toLowerCase();
		str=$.trim(str);
		str=str.replace(/[\._ ,+'"?&$@\/:-]+/g, "-").toLowerCase();
		//str = str.replace(/\s+/g, '-').toLowerCase();
		
		$("#url").val(str);
		
	});
	$(".addmore").on("click",function(e){
		e.preventDefault();
		$("#moredata").append('<div class="row"><div class="col-md-6 col-sm-6"><div class="form-group"><textarea class="form-control" name="ques[]" style="resize:none;"></textarea></div></div><div class="col-md-6 col-sm-6"><div class="form-group"><a href="#" class="btn btn-xs btn-danger remme"><i class="fa fa-times fa-2x"></i></a><textarea class="form-control" name="ans[]" style="resize:none;"></textarea></div></div></div>');
	});
	$("body").on("click",".remme",function(e){
		e.preventDefault();
		$(this).parent().parent().parent().remove();
	})
	
	
	
	
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