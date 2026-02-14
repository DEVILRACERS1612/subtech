<?php  
include 'config/config.inc.php';
//error_reporting(E_ALL);
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.category.php';
include 'Model/class.product.php';
$page="product";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_wproduct where id='".$edit_id."' and mi_status='Yes'");
$row=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ADD/EDIT Product  </title>
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
									<header>Add/Edit Product on Website </header>
									
								</div>
								
								<form method="post" action="" id="act-form" autocomplete="off">
								<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
								<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
								<input type="hidden" name="method" value="Product" />
								<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
								<div class="card-body " id="bar-parent2">
									<div class="row">
			<div class="col-md-12">
				<div class="row">
					<label class="col-md-2" for="subcat">Category <span>*</span></label>
					<div class="col-md-10">
					<div class="form-group">
						<select class="form-control ser" id="subcat" name="cat_id">
							<?=$objcat->pcat_list($row['cat_id'])?>
						</select>
					</div>
					</div>
				</div>
				</div>
				<div class="col-md-12">
				<div class="row">
					<label class="col-md-2"  for="ptype">Type <span>*</span></label>
					<div class="col-md-10">
					<div class="form-group">
						<select class="form-control ser" id="ptype">
						</select>
					</div>
					</div>
				</div>
				</div>
				<div class="col-md-12">
				<div class="row">
				<label class="col-md-2"  for="ptype2">Type2 <span>*</span></label>
				<div class="col-md-10">
					<div class="form-group">
						<select class="form-control ser" id="ptype2">
						</select>
					</div>
				</div>
				</div>
				</div>
				<div class="col-md-12">
				<div class="row">
					<label class="col-md-2" for="variant">Variant <span>*</span></label>
					<div class="col-md-10">
					<div class="form-group">
						<select class="form-control ser" id="variant">
						</select>
					</div>
					</div>
				</div>
				</div>
				<div class="col-md-12">
					<div class="row">
					<label class="col-md-2" for="rating">Rating <span>*</span></label>
					<div class="col-md-10">
					<div class="form-group">
						<select class="form-control ser" id="rating">
						</select>
					</div>
					</div>
					</div>
				</div> 
				<div class="col-md-12">
				<div class="row">
					<label class="col-md-2" for="reqprd">Product<span>*</span></label>
					<div class="col-md-10">
					<div class="form-group">
						<select class="form-control select2 itm" id="reqprd" name="pcode"  >
							<?=$objproduct->item_list();?>
						</select>
					</div>
					</div>
				</div>
				</div>								

				<div class="col-md-12 col-sm-6">
					<div class="form-group">
						<label> Product Name *</label>
						<input type="text" class="form-control" id="pname" maxlength="80" name="product_name" value="<?php echo $row['product_name'];?>" readonly />
						<input type="text" class="form-control" id="url" maxlength="200" name="urlname" value="<?php echo $row['urlname'];?>" readonly />
					</div>
				</div>
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label> Rate *</label>
					<input type="text" class="form-control" id="mrp" maxlength="80" name="rate" value="<?php echo $row['rate'];?>" required />
				</div>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label> MOQ (Minimum Order Quantity) *</label>
					<input type="text" class="form-control" maxlength="80" name="moq" value="<?php echo $row['moq'];?>" required />
				</div>
			</div>
			<div class="col-md-12 col-sm-6">
				<div class="form-group">
					<label> Short Description *</label>
					<textarea class="form-control" name="sdes"><?php echo $row['sdes'];?></textarea>
				</div>
			</div>
			<div class="col-md-12 col-sm-6">
				<div class="form-group">
					<label> Product Detail *</label>
					<textarea class="form-control" id="summernote" name="description"><?php echo $row['description'];?></textarea>
				</div>
			</div>
			<div class="col-md-12 col-sm-6">
				<div class="form-group">
					<label> Video URL </label>
					<input type="text" class="form-control" name="vurl" value="<?php echo $row['vurl'];?>" maxlength="250" placeholder=" Video URL" />
				</div>
			</div>
			
			<div class="col-md-12 mb-3 pb-3" style="border-bottom:1px solid #ccc;">
			<label><b> Additional Detail </b></label>
				<div class="row">
					<div class="col-md-5"><label> Key Name</label></div>
					<div class="col-md-6"><label> Key Value</label></div>
					<div class="col-md-1"><label> +/-</label></div>
				</div>
				<?php 
				if($edit_id!=""){
				$qr=$db->exeQuery("select * from mi_wproduct_detail where prd_id='".$edit_id."' and mi_status='YEs'");
				while($prow=$qr->fetch_assoc()){
					?>
				<div class="row mb-3">
					<div class="col-md-5">
					<input type="hidden" name="edid[]" value="<?=$prow['id']?>" />
					<input type="text" class="form-control" name="keyname[]" value="<?=$prow['keyname']?>" />
					</div>
					<div class="col-md-6"><input type="text" class="form-control" name="keyvalue[]" value="<?=$prow['keyvalue']?>" /></div>
					<div class="col-md-1"><a href="#" class="btn btn-xs btn-danger removeme"><i class="fa fa-times"></i></a></div>
				</div>
					<?php 
				}
				}
				?>
				
				<div class="row mb-3">
					<div class="col-md-5">
					<input type="hidden" name="edid[]" value="" />
					<input type="text" class="form-control" name="keyname[]" />
					</div>
					<div class="col-md-6"><input type="text" class="form-control" name="keyvalue[]" /></div>
					<div class="col-md-1"><a href="#" class="btn btn-xs btn-primary" id="addmore"><i class="fa fa-plus"></i></a></div>
				</div>
				<div id="moredata">
				</div>
			</div>
			
			<div class="col-md-12 col-sm-6">
			<div class="row">
			<div class="col-md-4 col-sm-6">
				<div class="form-group">
					<label>Product Brochure (.pdf)</label>
					<input type="file" class="form-control" name="voucher" accept=".pdf"/>
					
				</div>
			</div>
			
			<div class="col-md-2"></div>
			<div class="col-md-4 col-sm-6">
				<div class="form-group">
					<label>Primary Image <br>(600 x 600 for best view)</label>
					<input type="file" id="uploadinput1" class="form-control" name="image" accept="image/*" onchange="uploadimg('1');" <?php echo ($row['image']!='')?'':'required';?> />
					<input type="text" id="" class="form-control" name="alttext" value="<?php echo $row['alttext'];?>" placeholder="Alt/Title Text" />
				</div>
			</div>
			<div class="col-md-2 col-sm-6">
				<div class="form-group">
					<?php 
					if($row['image']!='')
					{
						echo '<img id="upload1" src="'.WEB_PATH.'images/prod_img/'.$row['image'].'" class="img-responsive" />';
					}else{
						echo '<img id="upload1" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
					}
					?>
				</div>
			</div>
			</div>
			</div>
			<div class="col-md-12 col-sm-6">
			<div class="row">
			<div class="col-md-3 col-sm-3">
				<div class="form-group">
					<label>Image 1 <br>(600 x 600 for best view)</label>
					<?php 
					if($row['image1']!='')
					{
						echo '<img id="upload2" src="'.WEB_PATH.'images/prod_img/'.$row['image1'].'" class="img-responsive" />';
					}else{
						echo '<img id="upload2" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
					}
					?>
					
					<input type="file" id="uploadinput2" class="form-control" name="image1" accept="image/*" onchange="uploadimg('2');"  />
					<input type="text" id="" class="form-control" name="alttext1" value="<?php echo $row['alttext1'];?>" placeholder="Alt/Title Text" />
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="form-group">
					<label>Image 2 <br>(600 x 600 for best view)</label>
					<?php 
					if($row['image2']!='')
					{
						echo '<img id="upload3" src="'.WEB_PATH.'images/prod_img/'.$row['image2'].'" class="img-responsive" />';
					}else{
						echo '<img id="upload3" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
					}
					?>
					
					<input type="file" id="uploadinput3" class="form-control" name="image2" accept="image/*" onchange="uploadimg('3');"  />
					<input type="text" id="" class="form-control" name="alttext2" value="<?php echo $row['alttext2'];?>" placeholder="Alt/Title Text" />
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="form-group">
					<label>Image 3 <br>(600 x 600 for best view)</label>
					<?php 
					if($row['image3']!='')
					{
						echo '<img id="upload4" src="'.WEB_PATH.'images/prod_img/'.$row['image3'].'" class="img-responsive" />';
					}else{
						echo '<img id="upload4" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
					}
					?>
					
					<input type="file" id="uploadinput4" class="form-control" name="image3" accept="image/*" onchange="uploadimg('4');"  />
					<input type="text" id="" class="form-control" name="alttext3" value="<?php echo $row['alttext3'];?>" placeholder="Alt/Title Text" />
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="form-group">
					<label>Image 4 <br>(600 x 600 for best view)</label>
					<?php 
					if($row['image4']!='')
					{
						echo '<img id="upload5" src="'.WEB_PATH.'images/prod_img/'.$row['image4'].'" class="img-responsive" />';
					}else{
						echo '<img id="upload5" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
					}
					?>
					
					<input type="file" id="uploadinput5" class="form-control" name="image4" accept="image/*" onchange="uploadimg('5');"  />
					<input type="text" id="" class="form-control" name="alttext4" value="<?php echo $row['alttext4'];?>" placeholder="Alt/Title Text" />
				</div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-3 col-sm-3">
				<div class="form-group">
					<label>Image 5<br>(600 x 600 for best view)</label>
					<?php 
					if($row['image5']!='')
					{
						echo '<img id="upload6" src="'.WEB_PATH.'images/prod_img/'.$row['image5'].'" class="img-responsive" />';
					}else{
						echo '<img id="upload6" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
					}
					?>
					
					<input type="file" id="uploadinput6" class="form-control" name="image5" accept="image/*" onchange="uploadimg('6');"  />
					<input type="text" class="form-control" name="alttext5" value="<?php echo $row['alttext5'];?>" placeholder="Alt/Title Text" />
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="form-group">
					<label>Image 6<br>(600 x 600 for best view)</label>
					<?php 
					if($row['image6']!='')
					{
						echo '<img id="upload7" src="'.WEB_PATH.'images/prod_img/'.$row['image6'].'" class="img-responsive" />';
					}else{
						echo '<img id="upload7" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
					}
					?>
					
					<input type="file" id="uploadinput7" class="form-control" name="image6" accept="image/*" onchange="uploadimg('7');"  />
					<input type="text" id="" class="form-control" name="alttext6" value="<?php echo $row['alttext6'];?>" placeholder="Alt/Title Text" />
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="form-group">
					<label>Image 7<br>(600 x 600 for best view)</label>
					<?php 
					if($row['image7']!='')
					{
						echo '<img id="upload8" src="'.WEB_PATH.'images/prod_img/'.$row['image7'].'" class="img-responsive" />';
					}else{
						echo '<img id="upload8" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
					}
					?>
					
					<input type="file" id="uploadinput8" class="form-control" name="image7" accept="image/*" onchange="uploadimg('8');"  />
					<input type="text" id="" class="form-control" name="alttext7" value="<?php echo $row['alttext7'];?>" placeholder="Alt/Title Text" />
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div class="form-group">
					<label>Image 8<br>(600 x 600 for best view)</label>
					<?php 
					if($row['image8']!='')
					{
						echo '<img id="upload9" src="'.WEB_PATH.'images/prod_img/'.$row['image8'].'" class="img-responsive" />';
					}else{
						echo '<img id="upload9" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
					}
					?>
					
					<input type="file" id="uploadinput9" class="form-control" name="image8" accept="image/*" onchange="uploadimg('9');"  />
					<input type="text" id="" class="form-control" name="alttext8" value="<?php echo $row['alttext8'];?>" placeholder="Alt/Title Text" />
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
			<header>All Product Category  </header>
			
			<div class="btn-group pull-right" style="padding-right:10px; padding-bottom:5px;">
			<a href="#importModal" data-toggle="modal" class="btn-sm btn-info">	Import <i class="fa fa-arrow-up"></i>
			</a> &nbsp; 
			<a class="btn-primary btn-sm" onclick="window.location='<?=BASE_PATH?>Add_Wproduct'"> Add New </a>
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
			</div>
			<div class="table-scrollable">
				<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="exportTable">
					<thead>
						<tr>
							<th>S.No.</th>
							<th> Product  </th>
							<th> Action </th>
						</tr>
					</thead>
					<tbody id="displaydata">
					<?php 
					$qr=$db->exeQuery("select * from mi_wproduct where  mi_status='Yes'");
					$i=1;
					while($row=$qr->fetch_assoc())
					{
						echo "<tr><td>".$i."</td><td>".$row['product_name']."</td><td><a href='".BASE_PATH."Add_Wproduct/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
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
<form method="post" id="serform">
	
	<input type="hidden" name="method" value="searchproduct" />
	<input type="hidden" name="post_id" value="<?=$post_id?>" />
	
	<input type="hidden" id="fsubcat" name="subcat_id" />
	<input type="hidden" id="fptype" name="ptype_id" />
	<input type="hidden" id="fptype2" name="ptype2_id" />
	<input type="hidden" id="fvariant" name="varient_id" />
	<input type="hidden" id="frating" name="rating_id" />
</form>	
<script>
$(document).ready(function(){
	var per=<?php echo json_encode($page_permission);?>;
	var per1=JSON.stringify(per);
	
		let productsData = [];
	$.getJSON("<?=BASE_PATH?>get_data.php", function(data){
        productsData = data;
        // Unique categories fill
		$("#subcat").empty().append("<option value=''>--Select--</option>");
        let cats = [...new Map(data.categories.map(i => [i.id, i.subcat_name])).entries()];
        cats.forEach(c => {
            $("#subcat").append(`<option value="${c[0]}">${c[1]}</option>`);
        });
    });
	function fillProducts(filters){
        let filtered = productsData.products.filter(p=>{
            return (!filters.subcat_id || p.subcat_id==filters.subcat_id) &&
                   (!filters.ptype_id || p.ptype_id==filters.ptype_id) &&
                   (!filters.ptype2_id || p.ptype2_id==filters.ptype2_id) &&
                   (!filters.variant_id || p.variant_id==filters.variant_id) &&
                   (!filters.rating_id || p.rating_id==filters.rating_id);
        });

        $("#reqprd").empty().append("<option value=''>--Select Product--</option>");
        filtered.forEach(p=>{
            $("#reqprd").append(`<option value="${p.id}">${p.pname}</option>`);
        });
    }
	$("#subcat").on("change", function(){
        let scatId = $(this).val();
        $("#ptype, #ptype2, #variant, #rating").empty().append("<option value=''>--Select--</option>");

        if(!scatId) { fillProducts({}); return; }

        let types = [...new Map(productsData.products.filter(p=>p.subcat_id==scatId).map(i=>[i.ptype_id,i.ptype_name])).entries()];
        types.forEach(t=>{
            $("#ptype").append(`<option value="${t[0]}">${t[1]}</option>`);
        });

        fillProducts({subcat_id: scatId});
    });
	
	$("#ptype").on("change", function(){
        let ptypeId = $(this).val();
        let scatId = $("#subcat").val();
        $("#type2, #variant, #rating").empty().append("<option value=''>--Select--</option>");

        if(!ptypeId) { fillProducts({subcat_id: scatId}); return; }

        let type2s = [...new Map(productsData.products.filter(p=>p.ptype_id==ptypeId).map(i=>[i.ptype2_id,i.ptype2_name])).entries()];
        type2s.forEach(t2=>{
            $("#ptype2").append(`<option value="${t2[0]}">${t2[1]}</option>`);
        });

        fillProducts({subcat_id: scatId, ptype_id: ptypeId});
    });
	
	$("#ptype2").on("change", function(){
        let pt2Id = $(this).val();
        let scatId = $("#subcat").val();
        let typeId = $("#ptype").val();
        $("#variant, #rating").empty().append("<option value=''>--Select--</option>");

        if(!pt2Id) { fillProducts({subcat_id: scatId, ptype_id: ptypeId}); return; }

        let vars = [...new Map(productsData.products.filter(p=>p.ptype2_id==pt2Id).map(i=>[i.variant_id,i.variant_name])).entries()];
        vars.forEach(v=>{
            $("#variant").append(`<option value="${v[0]}">${v[1]}</option>`);
        });

        fillProducts({subcat_id: scatId, ptype_id: ptypeId, ptype2_id: pt2Id});
    });

	$("#variant").on("change", function(){
        let vId = $(this).val();
        let scatId = $("#subcat").val();
        let ptypeId = $("#ptype").val();
        let pt2Id = $("#ptype2").val();
        $("#rating").empty().append("<option value=''>--Select--</option>");

        if(!vId) { fillProducts({subcat_id: scatId, ptype_id: ptypeId, ptype2_id: pt2Id}); return; }

        let rats = [...new Map(productsData.products.filter(p=>p.variant_id==vId).map(i=>[i.rating_id,i.rating_name])).entries()];
        rats.forEach(r=>{
            $("#rating").append(`<option value="${r[0]}">${r[1]}</option>`);
        });

        fillProducts({subcat_id: scatId, ptype_id: ptypeId, ptype2_id: pt2Id, variant_id: vId});
    });
	
	$("#rating").on("change", function(){
        let rId = $(this).val();
        let scatId = $("#subcat").val();
        let ptypeId = $("#ptype").val();
        let pt2Id = $("#ptype2").val();
        let vId = $("#variant").val();

        if(!rId) { fillProducts({subcat_id: scatId, ptype_id: ptypeId, ptype2_id: pt2Id, variant_id: vId}); return; }

        fillProducts({subcat_id: scatId, ptype_id: ptypeId, ptype2_id: pt2Id, variant_id: vId, rating_id: rId});
    });
	
	$("body").on("change","#reqprd",function(){
		//e.preventDefault();
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
				
				$("#mrp").val(response.mrp);
				$("#url").val(response.url_name);
				$("#pname").val(response.pname);
				
				//alert(response.message);
				
			}
		});

	} );
	
	
	
	
});
</script>

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
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&del_id="+did+"&method=DeleteProduct";
		
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Add_Wproduct';},1500);
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
	$("#cat").on("keyup",function(){
		var str=$.trim($(this).val());
		str=str.replace(/[\._ ,+'"?&$@\/:-]+/g, " ").toLowerCase();
		str=$.trim(str);
		str=str.replace(/[\._ ,+'"?&$@\/:-]+/g, "-").toLowerCase();
		//str = str.replace(/\s+/g, '-').toLowerCase();
		
		$("#url").val(str);
		
	});
	//////////////////
	$("body").on("click","#addmore",function(e){
		e.preventDefault();
		$("#moredata").append('<div class="row mb-3"><div class="col-md-5"><input type="hidden" name="edid[]" value="" /><input type="text" class="form-control" name="keyname[]" /></div><div class="col-md-6"><input type="text" class="form-control" name="keyvalue[]" /></div><div class="col-md-1"><a href="#" class="btn btn-xs btn-primary" id="addmore"><i class="fa fa-plus" title="Add More"></i></a> <a href="#" class="btn btn-xs btn-danger removeme" title="Remove Me"><i class="fa fa-times"></i></a></div></div>');
	});
	$("body").on("click",".removeme",function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
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
	/////////////////////////////
	$("#importform").on("submit",function(e){
		e.preventDefault();
		//alert("ok");
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>importproduct.php',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
				$('#preloader').hide();
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#upmsg").html(response.message);	
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Add_Wproduct';},1500);	
				}else{
					$("#upmsg").html(response.message);	
				}	
			}
			
		});
	});
	
} );
</script>
</body>

<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-top modal-md" role="document" >
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center" id="addEventTitle">Upload Excel file form Product Upload.</h4>
			</div>
			<div class="modal-body">
			<form id="importform" action="" autocomplete="off" enctype="multipart/form-data">
				<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
				<input type="hidden" name="method" value="import" />
				<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
				<input type="hidden" name="" id="reqprd" value="" />
				
				<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="form-group">
						<label>Upload (.xls,.xlsx)</label>
						<input type="file" class="form-control" accept=".xls,.xlsx" name="excel_file" />
					</div>
				</div>
				<div class="col-lg-12 p-t-20 text-center">
					<p id="upmsg"></p>
					<button type="submit" id="" class="btn btn-pink">Upload</button> &nbsp;
					<button type="button" data-dismiss="modal" class="btn btn-disabled">Close</button>
				</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>

</html>