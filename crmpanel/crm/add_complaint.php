<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'Model/class.source.php';
include 'Model/class.product.php';
include 'config/function.php';

$page="newcmpl";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
//print_r($_REQUEST);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$prd=null;

if($edit_id!=""){

$row=$db->exeQuery("select c.rdate,c.cmpl_no,c.csource,c.mobile,c.address, c.google_map_link, c.defect, c.remark, c.priority, c.tech_assigned, s.source,cus.mobile2, cus.cname, cus.email, cp.product, cp.serial_no, cp.pr_from, cp.pr_date, cp.exp_date, cp.image from mi_customer_complain c left join mi_customer_product cp on cp.mobile=c.mobile and cp.product=c.product and cp.serial_no=c.serial_no left join mi_customer cus on cus.mobile=c.mobile left join mi_source s on c.csource=s.id where c.cmpl_no='".$edit_id."' and c.mi_status='Yes'")->fetch_assoc();

$prd=$objproduct->item_details($row['product']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add New Complaint </title>
	<?php include 'config/head.php';?>
	<style>
		#newdiv,#existdiv,#existdtdiv,#nproduct{
			display:none;
		}
	</style>
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
									<header>Add New Complaint</header>
								</div>
								
						<div class="card-body" id="bar-parent2">
							<div class="row">		
								<div class="col-md-3 col-sm-3">
									<div class="form-group">
										<label>Complain *</label>
										<select type="text" class="form-control" id="ctype" name="ctype">
											<option value="">Select</option>
											<option value="New">New</option>
											<option value="Existing">Existing</option>
										</select>
									</div>
								</div>
								<div class="col-md-4 col-sm-4" id="existdtdiv">
									<div class="form-group">
										<label>Enter Customer</label>
										<input type="text" class="form-control" placeholder=" Mobile Number" id="cser" placeholder="Enter Customer Mobile, Complain No., Product Serial No." />
									</div>
								</div>
							</div>
							
						</div>	
					</div>
					
					<div class="card-box" id="newdiv" <?php if($method=='Edit'){echo 'style="display:block"';}?>>
						<div class="card-head">
							<header>Register Complaints - Customer Details</header>
						</div>
			<?php //print_r($row)?>			
						<form method="post" action="" id="cmp_form" autocomplete="off" enctype="multipart/form-data">
							<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
							<input type="hidden" name="edit_id" id="edid" value="<?php echo $edit_id;?>" />
							<input type="hidden" name="method" value="NewComplaint" />
							<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
							<div class="card-body " id="bar-parent2">
								<div class="row">
								<?php 
								if($edit_id!=""){
									echo '<div class="col-md-12 col-sm-12"><h4>Complain No.- '.$edit_id.'</h4></div>';
								}?>
								<div class="col-md-2 col-sm-3">
									<div class="form-group">
										<label>Complaint Source. *</label>
										<select class="form-control" name="csource" required >
											<?= $objsource->cmp_source_list($row['csource']);?>
										</select>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-3">
									<div class="form-group">
										<label>Mobile No. *</label>
										<input type="text" class="form-control" minlength="10" maxlength="10" name="mobile" id="mobile" value="<?=$row['mobile']?>" <?php echo ($edit_id!="")?"readonly":""?> onkeypress="return isNumber(event)" required />
									</div>
								</div>
								<div class="col-md-2 col-sm-3">
									<div class="form-group">
										<label>Alternate Mobile </label>
										<input type="text" class="form-control" minlength="10" maxlength="10" name="mobile2" id="mobile2"  value="<?=$row['mobile2']?>" onkeypress="return isNumber(event)"  />
									</div>
								</div>
								
								<div class="col-md-3 col-sm-3">
									<div class="form-group">
										<label>Customer Name. *</label>
										<input type="text" class="form-control" maxlength="50" name="cname" id="cname"  value="<?=$row['cname']?>" <?php echo ($edit_id!="")?"readonly":""?> required />
									</div>
								</div>
								<div class="col-md-3 col-sm-3">
									<div class="form-group">
										<label>Customer Email</label>
										<input type="email" class="form-control" id="cemail" maxlength="50" name="email"  value="<?=$row['email']?>" />
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<label>Customer Address</label>
										<textarea class="form-control" id="caddress" name="address" style="resize:none"><?=$row['address']?></textarea>
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<label>Problem / Defect</label>
										<textarea class="form-control" name="defect" style="resize:none"><?=$row['defect']?></textarea>
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<label>Remark</label>
										<textarea class="form-control" name="remark" style="resize:none"><?=$row['remark']?></textarea>
									</div>
								</div>
								<div class="col-md-3 col-sm-3">
									<div class="form-group">
										<label>Product Serial No. *</label>
										<input type="text" id="serial_no" class="form-control" maxlength="50" name="serial_no" required value="<?=$row['serial_no']?>" />
									</div>
								</div>
								<div class="col-md-1 col-sm-1">
									<div class="form-group">
										<label>Check</label>
										<button type="button" id="chksr" class="btn btn-sm btn-primary">Check</button>
									</div>
								</div>
								<div class="col-md-4 col-sm-3">
									<div class="form-group">
										<label>Product </label>
										<?php 
										if($edit_id!=""){
											if(is_int($row['product'])){
												?>
												<select class="form-control select2" name="product" required id="product" >
												<?=$objproduct->item_list($row['product'])?>
												</select>
												<input class="form-control" type="text" maxlength="45" name="product" id="nproduct"  value="<?=$row['product']?>" style="display:none" />
												<?php 
											}else{
												?>
											<select class="form-control select2" name="product" id="product" style="display:none" >
											<?=$objproduct->item_list($row['product'])?>
											</select>
											<input class="form-control" type="text" maxlength="45" name="product" id="nproduct"  value="<?=$row['product']?>" style="display:block" />
										<?php 										
											}
										}else{
											?>
										<select class="form-control select2" name="product" required id="product" >
										<?=$objproduct->item_list($row['product'])?>
										</select>
										<input class="form-control" type="text" maxlength="45" name="product" id="nproduct"  value="<?=$row['product']?>" />
											<?php 
										}?>
										
										
									</div>
								</div>
								
								<div class="col-md-4 col-sm-3">
									<div class="form-group">
										<label>Purchase From</label>
										<input type="text" id="pfrom" class="form-control" maxlength="50" name="pfrom" required value="<?=$row['pr_from']?>" />
									</div>
								</div>
								<div class="col-md-2 col-sm-3">
									<div class="form-group">
										<label>Priority</label>
										<select class="form-control" name="priority">
											<option value="">-Select-</option>
											<option value="High" <?=($row['priority']=='High')?"selected":""?> >High</option>
											<option value="Medium" <?=($row['priority']=='Medium')?"selected":""?> >Medium</option>
											<option value="Low" <?=($row['priority']=='Low')?"selected":""?> >Low</option>
										</select>
									</div>
								</div>
								<div class="col-md-2 col-sm-3">
									<div class="form-group">
										<label>Purchase Date</label>
										<input type="date" id="pdate" class="form-control" value="<?=$row['pr_date']?>" name="pdate" />
									</div>
								</div>
								<div class="col-md-4 col-sm-4">
									<div class="form-group">
										<label>Customer Google Location Link</label>
										<input type="text" id="" class="form-control" name="google_map_link" value="<?=$row['google_map_link']?>" />
									</div>
								</div>
								
								<div class="col-md-4 col-sm-6">
									<div class="row">
										<div class="col-md-6 col-sm-4">
										<div class="form-group">
										<label>Warrant Card </label>
										<input type="file" id="uploadinput1" class="form-control" name="image" accept="image/*" onchange="uploadimg('1');" />
										
										</div>
										</div>
										<div class="col-md-6 col-sm-8">
										<?php 
										if($row['image']!=""){ ?>
										<img id="upload1" src="<?=BASE_PATH?>images/warranty_img/<?=$row['image']?>" class="img-responsive" style="height:100px;" />
										<?php }else{ ?>
										<img id="upload1" src="<?=BASE_PATH?>images/noimage.png" class="img-responsive" style="height:100px;" />
										<?php } ?>
										
										</div>
									</div>
								</div>
								<div id="msg"></div>
								<div class="col-lg-12 p-t-20 text-center">
									<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink" id="btnsubmit">Submit</button>
								</div>
								</div>
							</div>
							</form>
					</div>
					
					
					<div class="card-box" id="existdiv">
						<div class="card-head">
							<header> Customer Details</header>
						</div>
					<div class="card-body " id="bar-parent2">
						<div class="row">
						<div class="col-md-12">
					<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Name </th>
								<th>Mobile No.</th>
								<th>Address</th>
							</tr>
						</thead>
						<tbody id="cdetail">
							
						</tbody>
					</table>					
					</div>
					</div>
						
					</div>
					
					<div class="row">
					<div class="col-md-12">
						<h4>Product Details</h4>
					</div>
						<div class="col-md-12">
					<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Sr.No. </th>
								<th>Make.</th>
								<th>Model</th>
								<th>Serial No.</th>
								<th>Expiry Date</th>
								<th>Lock</th>
								
							</tr>
						</thead>
						<tbody id="pdetail">
							
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
<?php if($edit_id==""){ 
	//echo '<script>$("#btnsubmit").attr("disabled",true);</script>';
} ?>	
<script>
$(document).ready(function(){
	var per=<?php echo json_encode($page_permission);?>;
	var pgpmsn=JSON.stringify(per);
	
	

	$("#ctype").on("change",function(e){
		var v=$(this).val();
		if(v=='New'){
			$("#cser").val("");
			$("#newdiv").show();
			$("#existdtdiv").hide();
			$("#existdiv").hide();
		}else{
			$("#cser").val("");
			$("#newdiv").hide();
			$("#existdtdiv").show();
			$("#existdiv").hide();
		}
		
	});
	$("#cser").on("keyup",function(){
		var s=$(this).val();
		if(s.length>2){
			$("#existdiv").show("slow");
			var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&data_id="+s+"&method=SearchData";
		
			$(this).html("<i class='fa fa-spinner fa-spin'></i>");
			$.ajax({
				url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
				method:'post',
				data:datastr,
				success:function(data){
					//$('#preloader').hide();
					var response=(JSON.parse(data));
					//alert(data);
					if(response.type=="success")
					{
						$("#cdetail").html(response.cdetail);
						$("#pdetail").html(response.pdetail);
					}else{
						$("#cdetail").html(response.cdetail);
						$("#pdetail").html(response.pdetail);
					}
				}
			});
		}
	});

	//$("#displaydata").html("<i class='fa fa-spinner fa-spin'></i>");

	$("#chksr").on("click",function(e){
		//alert("ok");

		e.preventDefault();
		var srno=$("#serial_no").val();
		//alert(srno);
		if(srno==""){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&serial_no="+srno+"&method=CheckSerial";
		
		$(this).html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			method:'post',
			data:datastr,
			success:function(data){
				//alert(data);
				$("#chksr").html("Checked");
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#product").show();
					$("#nproduct").hide();
					//$("#btnsubmit").attr("disabled",false);
					$("#product").val(response.product).trigger('change.select2');
					$("#nproduct").val(response.product);
					$("#pfrom").val(response.pfrom);
					$("#pdate").val(response.pdate);
					
					$("#serial_no").attr("readonly", true);
				}else{
					if(response.message=='New'){
						$("#product").hide();
						$("#nproduct").show();
						
						$("#product").addClass("select2");
						$(".select2").select2();
						$("#newserial_view").modal({backdrop: 'static', keyboard: false});
					}else{
						
					}
				}	
			}
		});
	});
	$("body").on("click","#newyes",function(e){
		$('#product').next('.select2-container').hide();
		$("#product").hide().attr("required",false);
		//$(".select2").select2();
		$("#nproduct").show().attr("required",true).focus();
		//$("#btnsubmit").attr("disabled",false);
		
		$("#serial_no").attr("readonly", true);
		$("#newserial_view").modal("hide");
	});
	$("body").on("blur","#mobile",function(e){
		var id=$(this).val();
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&data_id="+id+"&method=FindCustomer";

		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#mobile").val(response.mobile);
					$("#mobile2").val(response.mobile2);
					$("#cemail").val(response.email);
					$("#cname").val(response.name);
					$("#caddress").val(response.address);
				}	
			}
		});
	});
	
	$("#cmp_form").on("submit",function(e){
		var cnf=confirm("Do you sure to update this Complain");
		if(cnf===false){return false;}
		var ed=$("#edid").val();
		//alert(ed);
		e.preventDefault();
		$("#btnsubmit").html("<i class='fa fa-spinner fa-spin'></i>");
		//$("#btnsubmit").attr("disabled",true);
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
				$("#btnsubmit").html("Submit");
				//alert(data);
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					if(ed!=""){
						$.toast({
							heading: 'success',
							text: response.message,
							position: 'mid-center',
							stack: false,
							icon:'success'
						});
						setTimeout(function(){window.location.href = "<?=BASE_PATH?>All_Complaint";},1500);
					}else{
						$("#cmpl_view").modal({backdrop: 'static', keyboard: false});
						$("#cmplres").html(response.message+" Complain No. is "+response.cmpl_no);
					}
					
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
<div class="modal fade" id="newserial_view">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h5 class="modal-title">Confirmation for New Serial No.</h5>
			</div>
			<div class="modal-body">
			<div class="card-body">
				<div class="row align-center">
					<h5 class="text-center">Are you Registered this as a New Serial No. for Product</h5> 
					<div class="col-12 text-center">
					<button class="btn btn-sm btn-primary" id="newyes">Yes</button>
					<button class="btn btn-sm btn-danger" data-dismiss="modal">No</button>
					</div>
				</div>
			</div>
		</div>
			
		</div>
	</div>
</div>
<div class="modal fade" id="cmpl_view">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h5 class="modal-title">Complain Regitration Successfull</h5>
			</div>
			<div class="modal-body">
			<div class="card-body">
				<div class="row align-center">
					<h5 class="text-center" id="cmplres"></h5> 
					<div class="col-12 text-center">
					
					<button class="btn btn-sm btn-danger" onclick="window.location.reload();" >Close</button>
					</div>
				</div>
			</div>
		</div>
			
		</div>
	</div>
</div>