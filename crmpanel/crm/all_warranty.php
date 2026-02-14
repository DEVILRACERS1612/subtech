<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'Model/class.source.php';
include 'Model/class.user.php';
include 'Model/class.complaint_nature.php';
include 'Model/class.product.php';
include 'config/function.php';

$page="allwarranty";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
//print_r($page_permission);
$fdate=(isset($_REQUEST['fdate']) and $_REQUEST['fdate'] !='')?$db->filterVar($_REQUEST['fdate']):'';
$tdate=(isset($_REQUEST['tdate']) and $_REQUEST['tdate'] !='')?$db->filterVar($_REQUEST['tdate']):'';
$tech=(isset($_REQUEST['tech']) and $_REQUEST['tech'] !='')?$db->filterVar($_REQUEST['tech']):'';
$stype=(isset($_REQUEST['stype']) and $_REQUEST['stype'] !='')?$db->filterVar($_REQUEST['stype']):'';
$prod=(isset($_REQUEST['prod']) and $_REQUEST['prod'] !='')?$db->filterVar($_REQUEST['prod']):'';

$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';

$query="select * from mi_customer_product where ";
if($prod!=""){
	$query.="product='".$prod."' and ";
}
if($stype=="Expired"){
	$query.="exp_date < '".date("Y-m-d")."' and ";
}
if($stype=="Warranty"){
	$query.="exp_date >= '".date("Y-m-d")."' and ";
}
$query.=" mi_status='Yes' order by rdate desc";
/*
if($prod==""){//$fdate=="" and $tdate==""
	$fdt=date("Y-m-d",strtotime(date("Y-m-d")."-7 days"));
	$tdt=date("Y-m-d");
	//$sql=$db->exeQuery("select * from mi_customer_product where date(rdate)>='".$fdt."' and date(rdate)<='".$tdt."' and mi_status='Yes' order by rdate desc");
	$sql=$db->exeQuery("select * from mi_customer_product where mi_status='Yes' order by rdate desc");
}else{
	
	$sql=$db->exeQuery("select * from mi_customer_product where product='".$prod."' and mi_status='Yes' order by rdate desc");
}*/
$sql=$db->exeQuery($query);

//$row=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>All Warranty </title>
	<?php include 'config/head.php';?>
	 
</head>
<!-- END HEAD -->

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">

	<div class="page-wrapper">
		<!-- start header -->
		<?php include 'config/header.php';?>

		<div class="page-container">
			<!-- start sidebar menu -->
			<?php include 'config/leftmenu.php';?>
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
									<header>All Warranty</header>
								</div>
						<div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
							<div class="search-set">
								<div class="date-select-small">
									<div class="input-addon-left position-relative">
										<button type="button" class="btn btn-sm btn-primary warranty">Add Warranty</button>
									</div>
								</div>
							</div>
							<form action="" method="post">
							<div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
								<div class="dropdown mr-2">
								<select class="form-control" name="stype" >
									<option value="" selected >All</option>
									<option value="Warranty" <?=($stype=='Warranty')?"selected":"";?> >Under Warranty</option>
									<option value="Expired" <?=($stype=='Expired')?"selected":"";?> >Out of Warranty</option>
								</select>
								</div>
								
								<div class="mr-2 dropdown">
								<select class="form-control select2" name="prod">
									
									<?=$objproduct->item_list($_POST['prod'])?>
								</select>
								</div>
								<div class="date-select-small">
									<div class="input-addon-left position-relative">
										<input type="submit" class="btn btn-sm btn-info" value="Search" >
									</div>
								</div>
								
							</div>
							</form>
						</div>
						<div class="card-body" id="bar-parent2">
							<div class="row">		
								<div class="col-md-12 col-sm-12">
									<div class="table-responsive">
	<table class="table table-bordered table-striped" id="exportTable">
		<thead class="thead-light">
			<tr>
				<th>Sr. No.</th>
				<th>Type</th>
				<th>Date</th>
				<th>Sale Date</th>
				<th>Expiry Date</th>
				<th>Status</th>
				<th>Customer Name</th>
				<th>Product</th>
				<th>Serial No</th>
				
			</tr>
		</thead>
		<tbody>
<?php 
$n=1;
while($row=$sql->fetch_assoc()){
	
$cus=$objcomplaint->customer_detail($row['mobile']);

$exp=($row['exp_date']!="")?date("d-M-Y",strtotime($row['exp_date'])):'';
$type='';
if($exp!="" and strtotime($exp)>strtotime(date("M-Y"))){
	$status='<span class="badge badge-success d-inline-flex align-items-center badge-xs">Running</span>';
	$type='Under Warranty';
}else if($exp==""){
	$status='';
	$type='';
}else{
	$type="Out of Warranty";
	$status='<span class="badge badge-danger d-inline-flex align-items-center badge-xs">Expired</span>';
}

?>
	<tr>
	<td><?=$n?>.</td>
	<td><?=$type?>.</td>
	<td><?=date("d-M-Y",strtotime($row['rdate']))?></td>
	
	<td><?=date("d-M-Y",strtotime($row['pr_date']))?></td>
	<td><?=$exp?></td>
						
	<td>
		<?=$status?>
	</td>
	
		<td><?=$cus['cname']?></td>
	
	<td><?=$objproduct->pname($row['product'])?></td>
	<td><?=$row['serial_no']?></td>
	
		</tr>
	<?php 
	$n++;
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

	$(".notasgn").on("click",function(e){
		e.preventDefault();
		var cmpl=$(this).attr("data-id");
		$("#cmplno").val(cmpl);
		$("#complain_lock").modal("show");
		display_defect(cmpl);
	});
	$(".warranty").on("click",function(e){
		e.preventDefault();
		$("#warrantyModel").modal("show");
		$(".select2").select2({dropdownParent: $("#warrantyModel .modal-body #warranty_form")});
		//display_customer(mobile)
	});
	$("#warranty_form").on("submit",function(e){
		e.preventDefault();
		$("#wrsubmit").html("<i class='fa fa-spinner fa-spin'></i>");
		//$("#wrsubmit").attr("disabled",true);
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
				$("#wrsubmit").html("Submit");
				$("#wrsubmit").attr("disabled",false);
				//alert(data);
				var response=(JSON.parse(data));
				$("#wmsg").html(response.message);
				if(response.type=="success")
				{
					setTimeout(function(){$("#wmsg").html("");},1500);					
				}	
			}
			
		});
	} );

	
	$("body").on("click",".delme",function(e){
		var did=$(this).attr("data-id");
		//var pgpmsn=$(this).attr("data-per");
		var cnf=confirm("Are you want to delete this record");
		e.preventDefault();
		if(cnf==false){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&del_id="+did+"&method=DeleteSource";
		
		$(this).html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/SOURCE/',
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

	function display_defect(cmpl)
	{
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&cmpl_no="+cmpl+"&method=cmpl_detail";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#defect").val(response.defect);
					//alert(response.message);
				}
			}
		});
	}
	
	function display_customer(mobile)
	{
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&mobile="+mobile+"&method=customer_detail";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			method:'post',
			data:datastr,
			success:function(data){
				//alert(data);
				var response=(JSON.parse(data));
				
				if(response.type=="success")
				{
					$("#cdetail").html("<tr><td>"+response.cname+"</td><td>"+response.mobile+"</td><td>"+response.address+"</td></tr>");
				}
			}
		});
	}
	function display_product(mobile)
	{
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&mobile="+mobile+"&method=customer_detail";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			method:'post',
			data:datastr,
			success:function(data){
				//alert(data);
				var response=(JSON.parse(data));
				
				if(response.type=="success")
				{
					$("#cdetail").html("<tr><td>"+response.cname+"</td><td>"+response.mobile+"</td><td>"+response.address+"</td></tr>");
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
	
	
	$("#cat").blur(function(){
		var str=$.trim($(this).val());
		str=str.replace(/[\._ ,+'"&$@\/:-]+/g, "-").toLowerCase();
		//str = str.replace(/\s+/g, '-').toLowerCase();
		$("#url").val(str);
		
	});
	$("body").on("click","#addmore",function(e){
		e.preventDefault();
		$("#moredata").append('<div class="col-md-12 col-sm-12"><div class="form-group"><input type="text" class="form-control" maxlength="50" name="source[]" value="" /></div></div>');
	});
} );
</script>
</body>

</html>

<!-- Add Complain  Modal -->
<div class="modal fade" id="warrantyModel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h5 class="modal-title">Add Warranty Card</h5>
			</div>
		<div class="modal-body">
					  
		<form id="warranty_form" method="post">
			<input type="hidden" name="post_id" value="<?=$post_id?>"/>
			<input type="hidden" name="method" value="add_warranty"/>
			
			<div class="row">
			<div class="col-xl-12">
				<div class="card mb-2">
					<div class="card-header justify-content-between">
						<div class="card-title">
							Product Details
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							 <div class="col-md-4 mb-3">
								<label class="form-label">Product Name</label>
								<select class="form-control select2" name="product">
									<?= $objproduct->item_list();?>
								</select>
							 </div>
							 <div class="col-md-4 mb-3">
								<label class="form-label">Serial Number</label>
								<input type="text" class="form-control" name="serial_no">
							 </div>
						   
							<div class="col-md-4 mb-3">
								<label class="form-label">Upload Image</label>
								<input type="file" class="form-control" name="image" accept="image/*">
							 </div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="col-xl-12">
				<div class="card mb-2">
					<div class="card-header justify-content-between">
						<div class="card-title">
							Customer Details
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-4 mb-3">
								<label class="form-label">Mobile No</label>
								<input type="text" class="form-control" name="mobile">
							</div>
							<div class="col-md-4 mb-3">
								<label class="form-label">Alternate No</label>
								<input type="text" class="form-control" name="mobile2">
							</div>
							<div class="col-md-4 mb-3">
								<label class="form-label">Customer Name</label>
								<input type="text" class="form-control" name="cname">
							</div>
							<div class="col-md-4 mb-3">
								<label class="form-label">Customer Email</label>
								<input type="text" class="form-control" name="email">
							</div>
							
							<div class="col-md-8 mb-3">
								<label class="form-label">Address</label>
								<textarea type="text" class="form-control" name="address"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
				<div class="col-xl-12">
					<div class="card mb2">
						<div class="card-header justify-content-between">
							<div class="card-title">
								Warranty Details
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-4 mb-3">
									<label class="form-label">Sale Date</label>
									<input type="date" class="form-control" name="pdate" />
								 
								</div>
								 
								<!--<div class="col-md-3 mb-3">
									<label class="form-label">Expire in Month</label>
									<input type="month" class="form-control" name="exp_date" />
								</div>-->
							   
								<div class="col-md-4 mb-3">
									<label class="form-label">Sales Person</label>
									 <input type="text" class="form-control" name="pfrom" />
								</div>
								<div class="col-md-4 mb-3">
									<label class="form-label">SO Number</label>
									<input type="number" class="form-control" name="sono" placeholder="SO Number">
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="wmsg"></div>
			<div class="mb-3 col-md-12">
				 <button type="submit" class="btn btn-primary">Update Warranty</button>
			</div>
					
		</form>
		</div>
		
	</div>
</div>
</div>
<!-- Add COmplain  Modal -->
