<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.party.php';
include 'Model/class.category.php';
include 'Model/class.unit.php';
include 'Model/class.product.php';

$page="stkitem";
include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_delete']!='Yes' and $page_permission['pg_view']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'';
if($method=='Act'){
	$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
	$q=$db->exeQuery("update mi_product set web_status='Yes' where id='".$edit_id."' and mi_status='Yes'");
	$error="<span class='text-success'>Product Activated On Website Successfull</span>";
	header('Refresh:2;url='.BASE_PATH.'All_Item');
}
else if($method=='Deact'){
	$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
	$q=$db->exeQuery("update mi_product set web_status='No' where id='".$edit_id."' and mi_status='Yes'");
	$error="<span class='text-success'>Product Deactivated on website Successfull</span>";
	header('Refresh:2;url='.BASE_PATH.'All_Item');
}
/*
$del_id=(isset($_REQUEST['del_id']) and $_REQUEST['del_id'] !='')?$db->filterVar($_REQUEST['del_id']):'';
if(!empty($del_id))
{
	$q=$db->exeQuery("select * from mi_user where id='".$del_id."' and mi_status='Yes'");
	$r=$q->fetch_assoc();
	$picture='./images/rawmat/'.$r['image'];
	chmod($picture, 0644);
	unlink($picture);
	$db->exeQuery("delete from mi_user where id='".$del_id."' and mi_status='Yes'");
	$error="<span class='alert alert-danger'>Data Deleted Successfully</span>";
	header('Refresh:5;url='.BASE_PATH.'All_User/');
}
*/

?>
<!DOCTYPE html>
<html lang="en">
	<title>All Product(s) </title>
<head>
<?php include 'config/head.php';?>
<style>
#add{
/*display:none;*/
}
.col{
	padding-left:10px;
	padding-right:10px;
}
.modal-xl{
	max-width:1200px;
}
</style>
</head>
<!-- END HEAD -->

<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
	<div class="page-wrapper">
		<!-- start header -->
		<?php include 'config/header.php';?>
		<!-- end header -->
		
<div class="page-container">
<!-- start sidebar menu -->
<?php include 'config/leftmenu.php';?>
<!-- end sidebar menu -->
<!-- start page content -->
<div class="page-content-wrapper">
<div class="page-content">
<div class="row">
<div class="col-md-12">
<div class="tabbable-line">

<div class="tab-content" style="padding:0;">
<div class="tab-pane active fontawesome-demo" id="tab1">
<div class="row">
<div class="col-md-12">
	<div class="card card-box">
		<div class="card-head">
			<header>All Product</header>
			<div class="btn-group pull-right" style="padding-right:10px; padding-bottom:5px;">
			<a href="<?=BASE_PATH?>exportproduct.php" target="_blank" id="export"  data-val="" class="btn btn-sm btn-info">
				Export in Excel<i class="fa fa-arrow-up"></i>
			</a>
			<a href="#" id="inRow"  data-val="" class="btn btn-sm btn-success">
				In / Recieve<i class="fa fa-arrow-down"></i>
			</a>
			<a href="#" id="outRow" data-val="" class="btn btn-sm btn-danger">
				Out / Issue<i class="fa fa-arrow-up"></i>
			</a>
			<a href="<?php echo BASE_PATH;?>Add_Product/" id="addRow" class="btn btn-sm btn-primary">
					Add New Product <i class="fa fa-plus"></i>
				</a>
			</div>
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
							<th> S.No.</th>
							<th> Item name </th>
							<th> Model </th>
							<th> Unit </th>
							<th> MRP </th>
							<th> Srate </th>
							<th> Drate </th>
							<th> QOH </th>
							<th> Description </th>
							<th> Image </th>
							<!--<th> On Web </th>-->
							<th> Action </th>
						</tr>
					</thead>
					<tbody id="displaydata">
					<?php
					
					$qr=$db->exeQuery("select * from mi_product where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
					$i=1;
				while($row=$qr->fetch_assoc())
				{
					if($row['image']!=''){
						$img="<img src='".BASE_PATH."images/prod_img/".$row['image']."' style='height:50px;' />";
					}
					$qoh=$objproduct->item_qoh($row['id']);
					echo "<tr><td>".$i."</td><td>".$row['pname']."</td><td>".$row['model']."</td><td>".$objunit->unit_name($row['unit_id'])."</td><td>".$row['mrp']."</td><td>".$row['srate']."</td><td>".$row['drate']."</td><td>".$qoh."</td><td>".$row['description']."</td><td>".$img."</td><td><a href='".BASE_PATH."Add_Product/Edit/".$row['id']."/' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i></a>";
					/*if($row['web_status']=='Yes'){<td>".$row['web_status']."</td>
						echo "<a href='".BASE_PATH."All_Item/Deact/".$row['id']."/' class='btn btn-danger btn-xs' title='Deactivate from Website' onclick='return confirm(\"Do you sure to Deactivate from Webstite\")'><i class='fa fa-times'></i></a>";
					}else{
						echo "<a href='".BASE_PATH."All_Item/Act/".$row['id']."/' class='btn btn-primary btn-xs' title='Activate on Website' onclick='return confirm(\"Do you sure to Activate from Webstite\")'><i class='fa fa-check'></i></a>";
					}*/
					echo "<!--<a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'  title='Delete'><i class='fa fa-trash-o'></i></a>--></td></tr>";
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
	//display();
	var per=<?php echo json_encode($page_permission);?>;
	var per1=JSON.stringify(per);
	$("body").on("click",".delme",function(e){
		var did=$(this).attr("data-id");
		var pgpmsn=$(this).attr("data-per");
		var cnf=confirm("Are you want to delete this record");
		e.preventDefault();
		if(cnf==false){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&del_id="+did+"&method=Delete";
		
		$(this).html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/ITEM/',
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
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&method=View";
		
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/ITEM/',
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
	///////////// Serial ///////////////////
	$("body").on("change",".itm",function(e){
		e.preventDefault();
		var did=$(this).attr("data-id");
		var v=$(this).val();
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&pcode="+v+"&method=FindProductDetail";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PRODUCT/',
			method:'post',
			data:datastr,
			success:function(data){
				//alert(data);
				var response=(JSON.parse(data));
				$("#cat"+did).val(response.cat_id);
				$("#subcat"+did).val(response.subcat_id);
				$("#rate"+did).val(response.mrp);
				$("#qty"+did).focus();
				//alert(response.message);
				
			}
		});

	} );


	////////////   IN / Receive //////////////////
	$(".stk,.party,.detail").hide();
	$("body").on("click",".rtype",function(e){
		var v=$(this).val();
		if(v==='purchase'){
			$(".stk,.party").show();
		}else if(v=='user'){
			$(".stk").show();
			$(".party").hide();
			$("#party_id").val("");
		}
	});
	$("body").on("change",".stock",function(){
		var v=$(this).val();
		if(v==""){
			$(".detail").hide();
		}else{
			$(".detail").show();
		}
	});
	
	$("#inRow").on("click",function(e){
		e.preventDefault();
		$(this).attr("data-val","add");
		$("#inProductModel").modal("show");
		$('.select2, .select2-multiple').select2({
			theme: "bootstrap",
			dropdownParent: $('#inProductModel #in-form')
		});
	});
	$("body").on("keyup",".qty,.rate",function(e){
		var id=$(this).attr("data-id");
		total(id);
		
	});
	function total(id)
	{
		var rate=$("#rate"+id).val();
		var qty=$("#qty"+id).val();
		var total=0;
		var subtotal=0;
		total=rate*qty;
		$("#total"+id).val(total);
		
		var gtotal=0;
		$(".total").each(function(){
			gtotal += +$(this).val();
		});	

		$("#nettotal").val(gtotal);
	}
	
	var sr=1;
	$("body").on("click",".addmore",function(e){
		e.preventDefault();
		$("#moredata").append('<div class="row item-row"><input type="hidden" name="cat[]" id="cat'+sr+'" /><input type="hidden" name="sub_cat[]" id="subcat'+sr+'" /><div class="col-5"><div class="form-group"><select class="form-control select2 itm" name="item[]" data-id="'+sr+'" ><?php echo $objproduct->item_list();?></select></div></div><div class="col"><div class="form-group"><select class="form-control select2" name="brand[]" ><?php echo $objcat->brand_list();?></select></div></div><div class="col"><div class="form-group"><input type="text"	class="form-control rate" id="rate'+sr+'" data-id="'+sr+'" name="rate[]"  ></div></div><div class="col"><div class="form-group"><input type="text"	class="form-control qty" id="qty'+sr+'" data-id="'+sr+'" name="qty[]"  ></div></div><div class="col"><div class="form-group"><input type="text" class="form-control total" id="total'+sr+'" name="total[]"></div></div><div class="col-1"><div class="form-group"><a class="btn btn-xs btn-primary addmore"><i class="fa fa-plus"></i></a> <a class="btn btn-xs btn-danger removeme"><i class="fa fa-close"></i></a></div></div></div>');
		$('.select2, .select2-multiple').select2({
			theme: "bootstrap",
			dropdownParent: $('#inProductModel #in-form')
		});
		sr++;
	} );
	$("body").on("click",".removeme",function(){
		$(this).parent().parent().parent().remove();
		total('0');
	});
	$('#in-form').on('keyup keypress', function(e) {
	  var keyCode = e.keyCode || e.which;
	  if (keyCode === 13) { 
		e.preventDefault();
		return false;
	  }
	});
	/////////////////////////////
	$("#submitBtn").on("click", function (e) {
		$(this).html("<i class='fa fa-spinner fa-spin'></i>");
		e.preventDefault();

		const form = $("#in-form");

		// Master data
		const masterData = {
			stock: form.find("select[name='godown']").val(),
			supplier: form.find("select[name='supplier']").val(),
			nettotal: form.find("input[name='nettotal']").val(),
			remark: form.find("textarea[name='remark']").val(),
			method:'updateproductin',
			post_id:'<?php echo $post_id;?>',
			pg_pmsn:per1
		};

		// Item data
		
		const allItems = [];

		$(".item-row").each(function () {
			allItems.push({
				cat: $(this).find("input[name='cat[]']").val(),
				subcat: $(this).find("input[name='sub_cat[]']").val(),
				item: $(this).find("select[name='item[]']").val(),
				brand: $(this).find("select[name='brand[]']").val(),
				rate1: $(this).find("input[name='rate[]']").val(),
				qty: $(this).find("input[name='qty[]']").val(),
				total: $(this).find("input[name='total[]']").val()
			});
		});
		
		
	//alert(allItems);
		const batchSize = 25;
		const batches = [];
		for (let i = 0; i < allItems.length; i += batchSize) {
			batches.push(allItems.slice(i, i + batchSize));
		}
	//alert(batches[0]);
		// Step 1: Save Master Record
		$.post("<?php echo BASE_PATH;?>Controller/PRODUCT/", masterData, function (res) {
			//alert(res);
			var response=(JSON.parse(res));
			if(response.data_id=="")
			{
				alert("Error saving master record");
				return;
			}
			const data_id = response.data_id;
			
			// Step 2: Save item batches
			
			function submitBatch(index) {
				if (index >= batches.length) {
					$.toast({
						heading: 'Success',
						text: 'Item Received Successfull',
						position: 'mid-center',
						stack: false,
						icon:'success'
					});
					alert('Item Received Successfull');
					setTimeout(function(){window.location.reload()},500);
					return;
				}

				$.post("<?php echo BASE_PATH;?>Controller/PRODUCT/", {
					data_id: data_id,
					method:'updateproductindetail',
					pg_pmsn:per1,
					godown: form.find("select[name='godown']").val(),
					post_id:'<?php echo $post_id;?>',
					items: batches[index]
				}, function (r) {
					//alert(r);
					console.log("Saved batch"+ r, index + 1);
					submitBatch(index + 1);
				});
			}
			
		
			submitBatch(0);
		});
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
} );
</script>
</body>
</html>
<div class="modal fade" id="inProductModel" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-xl" role="document" >
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center" id="addEventTitle">In / Receiving of Products</h4>
			</div>
			<div class="modal-body">
				<form id="in-form" autocomplete="off" enctype="multipart/form-data">
					<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
					<input type="hidden" name="method" value="addstock" />
					<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
					<div class="row">
					<div class="col-md-12 text-center mb-2" style="border-bottom:1px solid #ccc;">
						<div class="form-group">
							<label class=""> <input type="radio" name="rtype" class="rtype" value="purchase" /> Purchase Inward / GRN</label>
							<label class=""> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </label>
							<label class=""> <input type="radio" name="rtype" class="rtype" value="user" /> Received From User</label>
						</div>
					</div>
					
					<div class="col-md-6 stk">
						<div class="form-group">
							<label class=""> Store / Location</label>
							<select class="form-control stock" name="godown">
							<?= $objcat->godown_list(); ?> 							
							</select>
						</div>
					</div>
					<div class="col-md-6 party">
						<div class="form-group">
							<label class=""> Supplier List</label>
							<select class="form-control" id="party_id" name="supplier">
							<?= $objparty->party_list(); ?> 							
							</select>
						</div>
					</div>
					
					<div class="col-md-12 detail">
					<div class="card-box">
						<div class="card-body">
						<div class="row">
						
						<div class="col-5">
							<label>Item</label>
						</div>
						<div class="col">
							<label>Brand</label>
						</div>
						<div class="col">
							<label>Rate</label>
						</div>
						<div class="col">
							<label>Qty</label>
						</div>
						<div class="col">
							<label>Total</label>
						</div>
						<div class="col-1">
							<label>+/-</label>
						</div>
						</div>
						<div class="row item-row">
						<input type="hidden" name="cat[]" id="cat0" />
						<input type="hidden" name="sub_cat[]" id="subcat0" />
						
						<div class="col-5">
							<div class="form-group">
								<select class="form-control select2 itm" data-id="0" name="item[]" >
								<?php echo $objproduct->item_list();?>
								</select>
							</div>
						</div>
						
						<div class="col">
							<div class="form-group">
								<select class="form-control select2" name="brand[]" >
								<?php echo $objcat->brand_list();?>
								</select>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text"	class="form-control rate" id="rate0" data-id="0" name="rate[]"  >
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text"	class="form-control qty" id="qty0" data-id="0" name="qty[]"  >
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text"	class="form-control total" id="total0" name="total[]"  >
							</div>
						</div>
						<div class="col-1">
							<div class="form-group">
								<a class="btn btn-xs btn-primary addmore" id=""><i class="fa fa-plus"></i></a>
								
							</div>
						</div>
						
						</div>
						<div id="moredata" >
						</div>
						<div class="row" >
						
						<div class="col-5">
							
						</div>
						
						<div class="col">
							
						</div>
						<div class="col">
							
						</div>
						<div class="col">
							<div class="form-group text-right">
								<label class="label-control" >Net Total</label>
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<input type="text"class="form-control" id="nettotal" name="nettotal"  >
							</div>
						</div>
						<div class="col-1">
						</div>
						</div>
						
						
						<div class="form-group row">
							<label class="col-md-2 col-sm-6"> Remark</label>
							<div class="col-md-10 col-sm-6">
								<textarea class="form-control" name="remark"></textarea>
							</div>
						</div>
						
						
						<div class="col-lg-12 p-t-20 text-center">
						<p id="acmsg"></p>
							<button type="button" id="submitBtn" class="btn btn-pink">	Submit</button> &nbsp;
							<button type="button" data-dismiss="modal" class="btn btn-disabled">Close</button>
						</div>
						
						</div>
						
						
						</div>
					</div>
					
					</div>
					
					</form>
			</div>
		</div>
	</div>
</div>
<!---///////////////////////         \\\\\\\\\\\\\\\\\\\\\\\\\\-->
<div class="modal fade" id="RqserialModel" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md" role="document" >
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center" id="addEventTitle">Enter Required Serial No.</h4>
			</div>
			<div class="modal-body">
			<form id="serial_formxx" autocomplete="off" enctype="multipart/form-data">
				<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
				<input type="hidden" name="method" value="reqserial" />
				<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
				<input type="hidden" name="" id="reqprd" value="" />
				
				<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="form-group">
						<label>Required Qty</label>
						<input type="text" class="form-control" id="reqty" name="qty" />
					</div>
				</div>
				<div class="col-lg-12 p-t-20 text-center">
					<p id="rqmsg"></p>
					<button type="button" id="reqBtn" class="btn btn-pink">	Submit</button> &nbsp;
					<button type="button" data-dismiss="modal" class="btn btn-disabled">Close</button>
				</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
<!---///////////////////////         \\\\\\\\\\\\\\\\\\\\\\\\\\-->
<div class="modal fade" id="serialModel" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-md" role="document" >
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center" id="addEventTitle">All Serial Product Detail</h4>
			</div>
			<div class="modal-body">
				<form id="serial_form" autocomplete="off" enctype="multipart/form-data">
					<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
					<input type="hidden" name="method" value="UpdateSerial" />
					<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
					<input type="hidden" name="i_code" id="prd_id" value="" />
					<div class="row">
					
					
					<div class="col-md-12 ">
					<div class="card-box">
						<div class="card-body">
						<table class="table table-bordered">
							<thead>
							<th>Serial No.</th><th>Model</th><th>Brand</th><th>MFG.</th>
							</thead>
							<tbody id="displaysdata">
							
							</tbody>
						</table>					
						
						
						
						<div class="col-lg-12 p-t-20 text-center">
							<p id="racmsg"></p>
							<button type="submit" id="submitBtn" class="btn btn-pink">	Submit</button> &nbsp;
							<button type="button" data-dismiss="modal" class="btn btn-disabled">Close</button>
						</div>
						
						</div>
						
						
						</div>
					</div>
					
					</div>
					
					</form>
			</div>
		</div>
	</div>
</div>