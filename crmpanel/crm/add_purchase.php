<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.category.php';
include 'Model/class.unit.php';
include 'Model/class.party.php';
include 'Model/class.item.php';

$page="purchase";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH.'/All_Class/');
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_purchase where id='".$edit_id."' and cmp_id='".$_SESSION['MICMP_cmpid']."'  and mi_status='Yes'");
$row=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Purchase Stock Item </title>
	<?php include 'config/head.php';?>
	<style>
	.pl-5{padding-left:4px!important; padding-right:4px!important;} 
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
									<header>Purchase Item(s) Information</header>
									
								</div>
								
								<form method="post" action="" id="act-form" enctype="multipart/form-data">
								<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
								<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
								<input type="hidden" name="method" value="<?php echo $method;?>" />
								<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
								
								<div class="card-body " id="bar-parent2">
									<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<label>Party Details *</label>
											<select class="form-control" name="party_id" required>
												<?php echo $objparty->party_list($row['party_id']);?>
											</select> 
											
										</div>
									</div>
									<!--<div class="col-md-2 col-sm-3">
										<div class="form-group">
											<label>&nbsp;</label>
											<button class="form-control btn btn-primary">New Party</button> 
											
										</div>
									</div>-->
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<label>Invoice No. *</label>
											<input type="text" class="form-control" name="inv_no"  value="<?php echo $row['inv_no'];?>" required/>
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<label>Invoice Date. *</label>
											<div class="input-append date form_date" data-date-format="dd-mm-yyyy" data-date="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+1 year"));?>">
                                                <input size="30" class="form-control" type="text" value="<?php echo ($row['inv_date']=='' or $row['inv_date']=='0000-00-00' or $row['inv_date']=='1970-01-01')?date("d-m-Y"):date("d-m-Y",strtotime($row['inv_date']));?>" name="inv_date" readonly="" required style="width:85%;float:left;" />
                                                <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
                                                <span class="add-on"><i class="fa fa-calendar"></i></span>
                                            </div>
										</div>
									</div>
									
									</div>
									
									<div class="row" style="background:#f5f5f5;margin:0;margin-bottom:5px;">
									
										<div class="col-md-1 col-sm-1">
											<div class="form-group">
												<h5 style="font-weight:bold;font-size:13px!important;">#</h5>
											</div>
										</div>
										<div class="col-md-1 col-sm-1">
											<div class="form-group">
												<h5 style="font-weight:bold;font-size:13px!important;">Category</h5>
											</div>
										</div>
										<div class="col-md-2 col-sm-2">
											<div class="form-group">
												<h5 style="font-weight:bold;font-size:13px!important;">Item</h5>
											</div>
										</div>
										<div class="col-md-1 col-sm-1">
											<div class="form-group">
												<h5 style="font-weight:bold;font-size:13px!important;">Rate</h5>
											</div>
										</div>
										<div class="col-md-1 col-sm-1">
											<div class="form-group">
												<h5 style="font-weight:bold;font-size:13px!important;">New.Rate</h5>
											</div>
										</div>
										<div class="col-md-1 col-sm-1">
											<div class="form-group">
												<h5 style="font-weight:bold;font-size:13px!important;">Qty.</h5>
											</div>
										</div>
										<div class="col-md-1 col-sm-1">
											<div class="form-group">
												<h5 style="font-weight:bold;font-size:13px!important;">Total</h5>
											</div>
										</div>
										<div class="col-md-1 col-sm-1">
											<div class="form-group">
												<h5 style="font-weight:bold;font-size:13px!important;">GST(%)</h5>
											</div>
										</div>
										<div class="col-md-1 col-sm-1">
											<div class="form-group">
												<h5 style="font-weight:bold;font-size:13px!important;">GST</h5>
											</div>
										</div>
										<div class="col-md-1 col-sm-1">
											<div class="form-group">
												<h5 style="font-weight:bold;font-size:13px!important;">Sub-Total</h5>
											</div>
										</div>
										<div class="col-md-1 col-sm-1">
											<div class="form-group">
												<h5 style="font-weight:bold;font-size:13px!important;">Action</h5>
											</div>
										</div>
									</div>
									<?php 
									$sr=1;
									if($edit_id!='')
									{
										$qr=$db->exeQuery("Select * from mi_purchase_detail where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and inv_id='".$edit_id."' and mi_status='Yes'");
										while($drow=$qr->fetch_assoc() )
										{
											?>
									<div class="row" style="margin:0;">
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<h5><?php echo $sr;?>.</h5>
											</div>
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<select class="form-control cat" data-id="<?php echo $sr;?>" name="cat_id[]" required>
													<?php echo $objcat->cat_list($drow['cat_id']);?>
												</select> 
											</div>
										</div>
										<div class="col-md-2 col-sm-2 pl-5">
											<div class="form-group">
												<select class="form-control itm" data-id="<?php echo $sr;?>" id="itm<?php echo $sr;?>" name="item_id[]" required>
													<?php echo $objstkitem->item_list($drow['item_id']);?>
												</select> 
											</div>
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<input type="text" class="form-control" id="rate<?php echo $sr;?>" name="rate[]" value="<?php echo $drow['rate'];?>" readonly />
											</div>
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<input type="text" class="form-control drate" data-id="<?php echo $sr;?>" id="drate<?php echo $sr;?>" name="drate[]" value="<?php echo $drow['drate'];?>" />
											</div>
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="row">
											<div class="col-md-8 col-sm-8" style="padding-right:1px">
												<div class="form-group">
													<input type="text" class="form-control qty" data-id="<?php echo $sr;?>" id="qty<?php echo $sr;?>" name="qty[]" value="<?php echo $drow['qty'];?>" />
												</div>
											</div>
											<div class="col-md-4 col-sm-4 p-0">
												<input type="hidden" id="utid<?php echo $sr;?>" name="unit_id[]" value="<?php echo $drow['unit_id'];?>" />
												<label id="ut<?php echo $sr;?>"><?php echo $objunit->unit_name($drow['unit_id']);?></label>
											</div>
											</div>
											
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<input type="text" class="form-control total" id="total<?php echo $sr;?>" name="total[]" value="<?php echo $drow['total'];?>" readonly />
											</div>
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<input type="text" class="form-control gst" data-id="<?php echo $sr;?>" id="gst<?php echo $sr;?>" name="gst[]" value="<?php echo $drow['gst'];?>" />
											</div>
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<input type="text" class="form-control gsttotal" id="gsttotal<?php echo $sr;?>" name="gsttotal[]" value="<?php echo $drow['gsttotal'];?>" readonly />
											</div>
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<input type="text" class="form-control subtotal" id="subtotal<?php echo $sr;?>" name="subtotal[]" value="<?php echo $drow['subtotal'];?>" readonly />
											</div>
										</div>
										<div class="col-md-1 col-sm-1 ">
											<div class="form-group">
												<a href="#" data-id="<?php echo $sr;?>" class="form-control btn btn-danger removeme"><i class="fa fa-close" style="font-size:16px;"></i></a>
											</div>
										</div>
						
									</div>
											<?php 
											$sr++;
										}
									}
									
									
									?>
									<div class="row" style="margin:0;">
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<h5><?php echo $sr;?>.</h5>
											</div>
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<select class="form-control cat" data-id="0" name="cat_id[]" >
													<?php echo $objcat->cat_list($row['cat_id']);?>
												</select> 
											</div>
										</div>
										<div class="col-md-2 col-sm-2 pl-5">
											<div class="form-group">
												<select class="form-control itm" data-id="0" id="itm0" name="item_id[]" >
													<?php echo $objstkitem->item_list($row['itm_id']);?>
												</select> 
											</div>
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<input type="text" class="form-control" id="rate0" name="rate[]" value="" readonly />
											</div>
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<input type="text" class="form-control drate" data-id="0" id="drate0" name="drate[]" value="" />
											</div>
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="row">
											<div class="col-md-8 col-sm-8" style="padding-right:1px">
												<div class="form-group">
													<input type="text" class="form-control qty" data-id="0" id="qty0" name="qty[]" value="" />
												</div>
											</div>
											<div class="col-md-4 col-sm-4 p-0">
												<input type="hidden" id="utid0" name="unit_id[]" />
												<label id="ut0">&nbsp;</label>
											</div>
											</div>
											
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<input type="text" class="form-control total" id="total0" name="total[]" value=""readonly />
											</div>
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<input type="text" class="form-control gst" data-id="0" id="gst0" name="gst[]" value="" />
											</div>
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<input type="text" class="form-control gsttotal" id="gsttotal0" name="gsttotal[]" value="" readonly />
											</div>
										</div>
										<div class="col-md-1 col-sm-1 pl-5">
											<div class="form-group">
												<input type="text" class="form-control subtotal" id="subtotal0" name="subtotal[]" value="" readonly />
											</div>
										</div>
										<div class="col-md-1 col-sm-1 ">
											<div class="form-group">
												<a href="#" id="addmore" class="form-control btn btn-primary"><i class="fa fa-plus" style="font-size:16px;"></i></a>
											</div>
										</div>
						
									</div>
									
									<div id="moredata">
									
									</div>
									
									
									<div class="row" style="margin:0;">
									<div class="col-md-6 col-sm-12"></div>								
									<div class="col-md-1 col-sm-6 pl-5">
										<div class="form-group">
											<label style="font-size:13px;text-align:right;"><b>Total :</b></label>
										</div>
									</div>
									
									<div class="col-md-1 col-sm-6 pl-5">
										<div class="form-group">
											<input type="text" class="form-control" id="gtotal" name="gtotal" value="<?php echo $row['gtotal'];?>" readonly />
										</div>
									</div>
									<div class="col-md-1 col-sm-6 pl-5"></div>
									<div class="col-md-1 col-sm-6 pl-5">
										<div class="form-group">
											<input type="text" class="form-control" id="ggsttotal" name="ggsttotal" value="<?php echo $row['ggsttotal'];?>" readonly />
										</div>
									</div>
									<div class="col-md-1 col-sm-6 pl-5">
										<div class="form-group">
											<input type="text" class="form-control" id="gsubtotal" name="gsubtotal" value="<?php echo $row['gsubtotal'];?>" readonly />
										</div>
									</div>
	
									</div>
									<div class="row" style="margin:0;">
									<div class="col-md-9 col-sm-12"></div>								
									<div class="col-md-1 col-sm-6 pl-5">
										<div class="form-group" style="font-size:13px;text-align:right;">
											<label><b>Fright :</b></label>
										</div>
									</div>
									
									<div class="col-md-1 col-sm-6 pl-5">
										<div class="form-group">
											<input type="text" class="form-control" id="fright" name="fright" value="<?php echo $row['fright'];?>"  onkeypress="return isNumber(event);" maxlength="10" />
										</div>
									</div>
									<div class="col-md-1 col-sm-6 pl-5"></div>
									</div>
									<div class="row" style="margin:0;">
									<div class="col-md-8 col-sm-12"></div>								
									<div class="col-md-2 col-sm-6 pl-5">
										<div class="form-group" style="font-size:13px;text-align:right;">
											<label><b>Adjustment (+/-) :</b></label>
										</div>
									</div>
									
									<div class="col-md-1 col-sm-6 pl-5">
										<div class="form-group">
											<input type="text" class="form-control" id="adjustment" name="adjustment" value="<?php echo $row['adjustment'];?>" onkeypress="return isNumber(event);" maxlength="10" />
										</div>
									</div>
									<div class="col-md-1 col-sm-6 pl-5"></div>
									</div>
									<div class="row" style="margin:0;">
									<div class="col-md-8 col-sm-12"></div>								
									<div class="col-md-2 col-sm-6 pl-5">
										<div class="form-group" style="font-size:13px;text-align:right;">
											<label ><b>Net. Total :</b></label>
										</div>
									</div>
									
									<div class="col-md-1 col-sm-6 pl-5">
										<div class="form-group">
											<input type="text" class="form-control" id="nettotal" name="nettotal" value="<?php echo $row['nettotal'];?>" readonly />
										</div>
									</div>
									<div class="col-md-1 col-sm-6 pl-5"></div>
									</div>
									
									
									<?php $pm=explode(",", $row['pmode']);?>
									<div class="row">
									<div class="col-md-3 col-sm-6">
										<div class="form-group">
											<label>Payment Mode </label>
											<select class="form-control select2-multiple" name="pmode[]" multiple>
												<option value="">--Select--</option>
												<option value="Cash" <?php echo (in_array("Cash",$pm) )?"selected":"";?> >Cash</option>
												<option value="Cheque" <?php echo (in_array("Cheque",$pm) )?"selected":"";?> >Cheque</option>
												<option value="Online" <?php echo (in_array("Online",$pm) )?"selected":"";?> >Online</option>
											</select>
										</div>
									</div>
									<div class="col-md-3 col-sm-6">
										<div class="form-group">
											<label>Payment Details </label>
											<textarea class="form-control" name="pdetail"><?php echo $row['pdetail'];?></textarea>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>Remark </label>
											<textarea class="form-control" name="remark"><?php echo $row['remark'];?></textarea>
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
	$("body").on("change",".cat",function(e){
		e.preventDefault();
		var id=$(this).attr("data-id");
		var cat=$(this).val();
		var datastr="cat_id="+cat+"&post_id=<?php echo $post_id;?>&method=FindItem";
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/ITEM/',
			type:'post',
			data:datastr,
			success:function(data){
				$('#preloader').hide();
				$("#itm"+id).html(data);
			}
		});
	});
	
	$("body").on("change",".itm",function(e){
		e.preventDefault();
		var id=$(this).attr("data-id");
		var itm=$(this).val();
		var datastr="item_id="+itm+"&post_id=<?php echo $post_id;?>&method=ItemView";
		//alert(datastr);
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PURCHASE/',
			type:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#rate"+id).val(response.rate);
					$("#drate"+id).val(response.rate);
					$("#gst"+id).val(response.gst);
					$("#ut"+id).text(response.unit);
					$("#utid"+id).val(response.unitid);
					
					total(id);
				}else{
					
				}
				$('#preloader').hide();
				//$("#itm"+id).html(data);
			}
		});
	});
	$("body").on("keyup",".qty, .gst,.drate,#fright,#adjustment",function(e){
		var id=$(this).attr("data-id");
		//alert(id);
		total(id);
	});
	function total(id)
	{
		var drate=$("#drate"+id).val();
		var qty=$("#qty"+id).val();
		var total=0;
		var gst=$("#gst"+id).val();
		var gsttotal=0;
		var subtotal=0;
		total=drate*qty;
		$("#total"+id).val(total);
		gsttotal=total*gst/100;
		$("#gsttotal"+id).val(gsttotal);
		subtotal=total+gsttotal;
		$("#subtotal"+id).val(subtotal);
		var gtotal=0;
		var ggsttotal=0;
		var gsubtotal=0;
		var fright=0;
		var adjust=0;
		var nettotal=0;

		$(".total").each(function(){
			gtotal += +$(this).val();
		});	
		$("#gtotal").val(gtotal);
		
		$('.gsttotal').each(function() {
			ggsttotal+= +$(this).val();
		});
		$("#ggsttotal").val(ggsttotal);
		
		$('.subtotal').each(function() {
			gsubtotal+= +$(this).val();
		});
		$("#gsubtotal").val(gsubtotal);
		
		fright=$("#fright").val();
		adjust=$("#adjustment").val();
		nettotal=Number(gsubtotal)+Number(fright)+Number(adjust);
		$("#nettotal").val(nettotal);
	}
	
	////////////// Add More Data //////////////////////
	var sr=<?php echo $sr+1;?>;
	$("body").on("click","#addmore",function(e){
		e.preventDefault();
		$("#moredata").append('<div class="row" style="margin:0;"><div class="col-md-1 col-sm-1 pl-5"><div class="form-group"><h5>'+sr+'.</h5></div></div><div class="col-md-1 col-sm-1 pl-5"><div class="form-group"><select class="form-control cat" data-id="'+sr+'" name="cat_id[]" required><?php echo $objcat->cat_list();?></select> </div></div><div class="col-md-2 col-sm-2 pl-5"><div class="form-group"><select class="form-control itm" data-id="'+sr+'" id="itm'+sr+'" name="item_id[]" required><?php echo $objstkitem->item_list();?></select> </div></div><div class="col-md-1 col-sm-1 pl-5"><div class="form-group"><input type="text" class="form-control" id="rate'+sr+'" name="rate[]" readonly /></div></div><div class="col-md-1 col-sm-1 pl-5"><div class="form-group"><input type="text" class="form-control drate" data-id="'+sr+'" id="drate'+sr+'" name="drate[]"  /></div></div><div class="col-md-1 col-sm-1 pl-5"><div class="row"><div class="col-md-8 col-sm-8" style="padding-right:1px"><div class="form-group"><input type="text" class="form-control qty" data-id="'+sr+'" id="qty'+sr+'" name="qty[]" /></div></div><div class="col-md-4 col-sm-4 p-0"><input type="hidden" id="utid'+sr+'" name="unit_id[]" /><label id="ut'+sr+'">&nbsp;</label></div></div></div><div class="col-md-1 col-sm-1 pl-5"><div class="form-group"><input type="text" class="form-control total" id="total'+sr+'" name="total[]" value=""readonly /></div></div><div class="col-md-1 col-sm-1 pl-5"><div class="form-group"><input type="text" class="form-control gst" data-id="'+sr+'" id="gst'+sr+'" name="gst[]" /></div></div><div class="col-md-1 col-sm-1 pl-5"><div class="form-group"><input type="text" class="form-control gsttotal" id="gsttotal'+sr+'" name="gsttotal[]" value="" readonly /></div></div><div class="col-md-1 col-sm-1 pl-5"><div class="form-group"><input type="text" class="form-control subtotal" id="subtotal'+sr+'" name="subtotal[]" value="" readonly /></div></div><div class="col-md-1 col-sm-1 "><div class="form-group"><a href="#" data-id="'+sr+'" class="form-control btn btn-danger removeme"><i class="fa fa-close" style="font-size:16px;"></i></a></div></div></div>');
		sr++;
	} );
	$("body").on("click",".removeme",function(){
		var id=$(this).attr("data-id");
		total(id);
		$(this).parent().parent().parent().remove();
	});
	
	
	////////////// Add More Data End //////////////////////
	$('#act-form').on('keyup keypress', function(e) {
		  var keyCode = e.keyCode || e.which;
		  if (keyCode === 13) { 
			e.preventDefault();
			return false;
		  }
		});
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PURCHASE/',
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>All_Purchase/';},2000);
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

