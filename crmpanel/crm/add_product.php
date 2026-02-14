<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.category.php';
include 'Model/class.product.php';
include 'Model/class.unit.php';

$page="stkitem";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_product where id='".$edit_id."' and mi_status='Yes'");
$vrow=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Products </title>
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
		<div class="col-md-12" >
			<div class="card-box">
				<div class="card-head">
					<header>Add/Edit Product Information</header>
				</div>
				
				<form method="post" action="" id="act-form" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
				<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
				<input type="hidden" name="method" value="<?php echo $method;?>" />
				<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
				
				<div class="card-body " id="bar-parent2">
					<div class="row">
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label class="">Product Category *</label>
							<select class="form-control select2" id="cat" name="cat_id[]" multiple required>
								<?php echo $objcat->cat_list($vrow['cat_id']);?>
							</select> 
							<input type="hidden" id="catcode"/>
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label>Product Sub-Category </label>
							<select class="form-control" id="subcat" name="subcat_id">
								<?php echo $objcat->subcat_list($vrow['subcat_id']);?>
							</select> 
							<input type="hidden" id="subcatcode" value="<?=$objcat->subcat_code_name($vrow['subcat_id'])?>"/>
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label>Type </label>
							<select class="form-control" id="ptype" name="ptype">
								<?php echo $objcat->ptype_list($vrow['ptype']);?>
							</select> 
							<input type="hidden" id="typecode" value="<?=$objcat->ptype_code_name($vrow['ptype'])?>"/>
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label>Type 2 </label>
							<select class="form-control" id="ptype2" name="ptype2">
								<?php echo $objcat->ptype2_list($vrow['ptype2']);?>
							</select> 
							<input type="hidden" id="type2code" value="<?=$objcat->ptype2_code_name($vrow['ptype'])?>"/>
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label>Varient </label>
							<select class="form-control" id="varient" name="varient">
								<?php echo $objcat->varient_list($vrow['varient']);?>
							</select> 
							<input type="hidden" id="varcode" value="<?=$objcat->varient_code_name($vrow['varient'])?>"/>
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label>Rating </label>
							<select class="form-control" id="rating" name="rating">
								<?php echo $objcat->rating_list($vrow['rating']);?>
							</select> 
							<input type="hidden" id="ratcode" value="<?=$objcat->rating_code_name($vrow['rating'])?>"/>
						</div>
					</div>
					
					<div class="col-md-2 col-sm-2 mb-3">
						<div class="form-group">
							<label class="">Model No.</label>
							<input type="text" class="form-control" id="model" name="model" value="<?php echo $vrow['model'];?>" maxlength="50" required />
						</div>
					</div>
					<div class="col-md-4 col-sm-4 mb-3">
						<div class="form-group">
						<label class="">Product Name *</label>
						<input type="text" class="form-control" name="pname" value="<?php echo $vrow['pname'];?>" id="pname" maxlength="50" required />
						
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="form-group">
						<label class="">Product Url *</label>
						<input type="text" class="form-control" id="weburl" name="url_name" value="<?php echo $vrow['url_name'];?>" maxlength="50" required />
						
						</div>
					</div>
					<div class="col-md-2 col-sm-2 mb-3">
						<div class="form-group">
							<label >Brand </label>
							<select class="form-control" name="brand" required>
								<?php echo $objcat->brand_list($vrow['brand']);?>
							</select> 
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label>Sectors </label>
							<select class="form-control select2" id="" name="sectors[]" multiple >
								<?php echo $objcat->sector_list($vrow['sectors']);?>
							</select> 
						</div>
					</div>
					
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label class="">Product Code</label>
							<input type="text" class="form-control" name="pcode" value="<?php echo $vrow['pcode'];?>" maxlength="50" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label class=""> Length (mm)</label>
							<input type="text" class="form-control" name="length" value="<?php echo $vrow['length'];?>" maxlength="50" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label class=""> Breadth (mm)</label>
							<input type="text" class="form-control" name="breadth" value="<?php echo $vrow['breadth'];?>" maxlength="50" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label class=""> Height (mm)</label>
							<input type="text" class="form-control" name="height" value="<?php echo $vrow['height'];?>" maxlength="50" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label class=""> Weight (kg)</label>
							<input type="text" class="form-control" name="weight" value="<?php echo $vrow['weight'];?>" maxlength="50" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2">	
						<div class="form-group">
							<label class="">HSN/SAC Code</label>
							<input type="text" class="form-control" name="hsncode" value="<?php echo $vrow['hsncode'];?>" maxlength="50" required />
						</div>
					</div>
					
					<div class="col-md-2 col-sm-2 mb-3">
						<div class="form-group">
							<label class="">MRP </label>
							<input type="text" class="form-control" name="mrp" value="<?php echo $vrow['mrp'];?>" maxlength="10" onkeypress="return isNumber(event)" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group ">
							<label class="">Sale Price </label>
							<input type="text" class="form-control" name="srate" value="<?php echo $vrow['srate'];?>" maxlength="10" onkeypress="return isNumber(event)" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label class="">Dealer Price </label>
							<input type="text" class="form-control" name="drate" value="<?php echo $vrow['drate'];?>" maxlength="10" onkeypress="return isNumber(event)" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2 mb-3">
						<div class="form-group">
							<label >Unit *</label>
							<select class="form-control" name="unit_id" required>
								<?php echo $objunit->unit_list($vrow['unit_id']);?>
							</select> 
						</div>
					</div>

					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label class="">GST Rate (%) </label>
							<input type="text" class="form-control" name="gst" value="<?php echo $vrow['gst'];?>" maxlength="5" onkeypress="return isNumber(event)" required />
						</div>
					</div>	
					
					<div class="col-md-2 col-sm-2 mb-3">
						<div class="form-group">
							<label class="">Warranty For *</label>
							<select class="form-control" name="warranty" required>
								<option value="12 Months" <?=($vrow['warranty']=="12 Months")?"selected":"" ?>>12 Months</option>
								<option value="18 Months" <?=($vrow['warranty']=="18 Months")?"selected":"" ?>>18 Months</option>
								<option value="24 Months" <?=($vrow['warranty']=="24 Months")?"selected":"" ?>>24 Months</option>
							</select> 
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label class="">Relay Range </label>
							<input type="text" class="form-control" name="relay" value="<?php echo $vrow['relay'];?>" maxlength="20" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label class="">MCB </label>
							<input type="text" class="form-control" name="mcb" value="<?php echo $vrow['mcb'];?>" maxlength="20" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label class="">MCCB </label>
							<input type="text" class="form-control" name="mccb" value="<?php echo $vrow['mccb'];?>" maxlength="20" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2 mb-3">
						<div class="form-group">
							<label class="">kW </label>
							<input type="text" class="form-control" name="kw" value="<?php echo $vrow['kw'];?>" maxlength="20" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2 mb-3">
						<div class="form-group">
							<label class="">KVA </label>
							<input type="text" class="form-control" name="kva" value="<?php echo $vrow['kva'];?>" maxlength="20" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label class="">Min Voltage Range </label>
							<input type="text" class="form-control" name="minv" value="<?php echo $vrow['minv'];?>" maxlength="20" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2">
						<div class="form-group">
							<label class="">Max Voltage Range </label>
							<input type="text" class="form-control" name="maxv" value="<?php echo $vrow['maxv'];?>" maxlength="20" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2 mb-3">
						<div class="form-group">
							<label class="">Current at 220V </label>
							<input type="text" class="form-control" name="cat220" value="<?php echo $vrow['cat220'];?>" maxlength="20" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2 mb-3">
						<div class="form-group">
							<label class="">Current at 415V </label>
							<input type="text" class="form-control" name="cat415" value="<?php echo $vrow['cat415'];?>" maxlength="20" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2 mb-3">
						<div class="form-group">
							<label class="">Capacitor (MFD) Start </label>
							<input type="text" class="form-control" name="startmfd" value="<?php echo $vrow['startmfd'];?>" maxlength="20" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2 mb-3">
						<div class="form-group">
							<label class="">Capacitor (MFD )Run </label>
							<input type="text" class="form-control" name="runmfd" value="<?php echo $vrow['runmfd'];?>" maxlength="20" />
						</div>
					</div>
					<div class="col-md-2 col-sm-2 mb-3">
						<div class="form-group">
							<label class="">In Box Contains </label>
							<input type="text" class="form-control" name="inbox" value="<?php echo $vrow['inbox'];?>" maxlength="20" />
						</div>
					</div>
					
					<div class="col-md-10 col-sm-8">
						<div class="form-group">
							<label class="">Product Detail </label>
							<textarea class="form-control" name="description"><?php echo $vrow['description'];?></textarea>
						</div>
					</div>
					
					<div class="col-md-2 col-sm-4">
						<div class="form-group ">
							<label class="">Image </label>
							<?php 
							if($vrow['image']!='')
							{
								echo '<img id="upload1" src="'.BASE_PATH.'images/prod_img/'.$vrow['image'].'" class="img-responsive" style="height:100px;" />';
							}else{
								echo '<img id="upload1" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" style="height:100px;" />';
							}
							?>
							<input type="file" id="uploadinput1" class="form-control" name="image" accept="image/*" onchange="uploadimg('1');" />
						</div>
					</div>
					
					<div id="msg"></div>
					<div class="col-lg-12 p-t-20 text-center">
						<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Submit</button>
						<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default" onclick="window.location='<?php echo BASE_PATH;?>Add_Product/'">Cancel</button>
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

</div>
<!-- end page container -->
<!-- start footer -->
<?php include 'config/footer.php';?>
<!-- end footer -->
</div>
<script>
$(document).ready(function(){
	var per=<?php echo json_encode($page_permission);?>;
	var per1=JSON.stringify(per);
	
/////////////////////////
/*$("body").on("change","#cat",function(e){
	var did=$(this).val();
	if(did==""){return false;}
	
	var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&edit_id="+did+"&method=catcode";
	$.ajax({
		url:'<?php echo BASE_PATH;?>Controller/CATEGORY/',
		method:'post',
		data:datastr,
		success:function(data){
			$("#catcode").val(data);
			create_model();
			create_name();
		}
	});
});*/
$("body").on("change","#subcat",function(e){
	var did=$(this).val();
	if(did==""){return false;}
	
	var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&edit_id="+did+"&method=subcatcode";
	$.ajax({
		url:'<?php echo BASE_PATH;?>Controller/CATEGORY/',
		method:'post',
		data:datastr,
		success:function(data){
			$("#subcatcode").val(data);
			create_model();create_name();
		}
	});
});
$("body").on("change","#varient",function(e){
	var did=$(this).val();
	if(did==""){return false;}
	
	var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&edit_id="+did+"&method=varcode";
	$.ajax({
		url:'<?php echo BASE_PATH;?>Controller/CATEGORY/',
		method:'post',
		data:datastr,
		success:function(data){
			$("#varcode").val(data);
			create_model();create_name();
		}
	});
});
$("body").on("change","#rating",function(e){
	var did=$(this).val();
	if(did==""){return false;}
	
	var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&edit_id="+did+"&method=ratcode";
	$.ajax({
		url:'<?php echo BASE_PATH;?>Controller/CATEGORY/',
		method:'post',
		data:datastr,
		success:function(data){
			$("#ratcode").val(data);
			create_model();create_name();
		}
	});
});	
$("body").on("change","#ptype",function(e){
	var did=$(this).val();
	if(did==""){return false;}
	
	var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&edit_id="+did+"&method=typecode";
	$.ajax({
		url:'<?php echo BASE_PATH;?>Controller/CATEGORY/',
		method:'post',
		data:datastr,
		success:function(data){
			$("#typecode").val(data);
			create_model();create_name();
		}
	});
});	
$("body").on("change","#ptype2",function(e){
	var did=$(this).val();
	if(did==""){return false;}
	
	var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&edit_id="+did+"&method=type2code";
	$.ajax({
		url:'<?php echo BASE_PATH;?>Controller/CATEGORY/',
		method:'post',
		data:datastr,
		success:function(data){
			$("#type2code").val(data);
			create_model();create_name();
		}
	});
});	
function create_model(){
	//var cat=$("#catcode").val();
	var subcat=$("#subcatcode").val();
	var varient=$("#varcode").val();
	var type=$("#typecode").val();
	var type2=$("#type2code").val();
	var rat=$("#ratcode").val();
	var mod="S"+subcat+type+type2+varient+rat;
	$("#model").val(mod);
}
function create_name(){
	//var cat=($("#cat").val()!="")?$("#cat option:selected").text():'';
	var subcat=($("#subcat").val()!="")?$("#subcat option:selected").text():'';
	var varient=($("#varient").val()!="")?$("#varient option:selected").text():'';
	var type=($("#ptype").val()!="")?$("#ptype option:selected").text():'';
	var type2=($("#ptype2").val()!="")?$("#ptype2 option:selected").text():'';
	var rat=($("#rating").val()!="")?$("#rating option:selected").text():'';
	var pname=rat+varient+subcat+type+type2+"Model";
	$("#pname").val(pname);
	var slug = pname.toLowerCase()
        .trim()
        .replace(/[^a-z0-9]+/g, '-')   // Replace non-alphanumeric with hyphens
        .replace(/^-+|-+$/g, '');      // Remove leading/trailing hyphens

    $("#weburl").val(slug);
}







/////////////////	

	
	$("body").on("click",".delme",function(e){
		var did=$(this).attr("data-id");
		var pgpmsn=$(this).attr("data-per");
		var cnf=confirm("Are you want to delete this record");
		e.preventDefault();
		if(cnf==false){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&del_id="+did+"&method=Delete";
		
		$(this).html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PRODUCT/',
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
			url:'<?php echo BASE_PATH;?>Controller/PRODUCT/',
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

	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PRODUCT/',
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
					//setTimeout(function(){$("#msg").html('');},1500);
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Add_Product/';},2000);
				}else{
					$("#msg").html(response.message);
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
	
});
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
