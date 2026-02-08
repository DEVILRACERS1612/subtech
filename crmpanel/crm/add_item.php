<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.category.php';
include 'Model/class.unit.php';

$page="stkitem";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH.'/All_Class/');
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_item where id='".$edit_id."' and mi_status='Yes'");
$vrow=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add/Edit Item </title>
	<?php include 'config/head.php';?>
<style>
#add{
display:none;
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
		
		<div class="col-md-12"  <?php echo ($edit_id!="")?'class="col-md-8"':'class="col-md-12"';?> id="all">
		<div class="card-box">
		<div class="card-head">
			<header>All Items</header>
			<div class="btn-group pull-right" style="padding-right:10px; padding-bottom:5px;">
			<a href="#" id="addRow" data-val="" class="btn btn-primary">
				Add New Item <i class="fa fa-plus"></i>
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
							<th>#</th>
							<th> Item name </th>
							<th> Item Type </th>
							<th> HSN/SAC Code </th>
							<th> Item Code </th>
							<!--<th> Unit </th>-->
							<th> Rate </th>
							<!--<th> Opening Qty </th>
							<th> Qty-In-Hand </th>
							<th> GST (%) </th>-->
							
							<th> Image </th>
							<th> Action </th>
						</tr>
					</thead>
					<tbody id="displaydata">
					<?php
					
					$qr=$db->exeQuery("select * from mi_item where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
					$i=1;
				while($row=$qr->fetch_assoc())
				{
					if($row['image']!=''){
						$img="<img src='".BASE_PATH."images/item_img/".$row['image']."' style='height:50px;' />";
					}
					echo "<tr><td>".$i."</td><td>".$row['item_name']."</td><td>".$objcat->cat_name($row['cat_id'])."</td><td>".$row['i_code']."</td><td>".$row['hsncode']."</td><!--<td>".$objunit->unit_name($row['unit_id'])."</td>--><td>".$row['rate']."</td><!--<td>".$row['op_qty']."</td><td>".$objstkitem->item_qoh($row['id'])."</td><td>".$row['gst']."</td>--><td>".$img."</td><td><a href='".BASE_PATH."Add_Item/Edit/".$row['id']."/' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'  title='Delete'><i class='fa fa-trash-o'></i></a></td></tr>";
					$i++;
				}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
		
		</div>
		<div class="col-md-4" id="add" <?php echo ($edit_id=="")?'style="display:none"':'';?>>
			<div class="card-box">
				<div class="card-head">
					<header>Add/Edit Item Information</header>
				</div>
				
				<form method="post" action="" id="act-form" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
				<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
				<input type="hidden" name="method" value="<?php echo $method;?>" />
				<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
				
				<div class="card-body " id="bar-parent2">
					<div class="">
					
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Item Type *</label>
							<div class="col-md-8 col-sm-6">
							<select class="form-control" name="cat_id" required>
								<?php echo $objcat->cat_list($vrow['cat_id']);?>
							</select> 
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Item Code</label>
							<div class="col-md-8 col-sm-6">
							<input type="text" class="form-control" name="i_code" value="<?php echo $vrow['i_code'];?>" maxlength="50" required />
							
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Item Name *</label>
							<div class="col-md-8 col-sm-6">
							<input type="text" class="form-control" name="item_name" value="<?php echo $vrow['item_name'];?>" maxlength="50" required />
							
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">HSN/SAC Code</label>
							<div class="col-md-8 col-sm-6">
							<input type="text" class="form-control" name="hsncode" value="<?php echo $vrow['hsncode'];?>" maxlength="50" required />
							
							</div>
						</div>
					
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Unit *</label>
							<div class="col-md-8 col-sm-6">
							<select class="form-control" name="unit_id" required>
								<?php echo $objunit->unit_list($vrow['unit_id']);?>
							</select> 
							
							</div>
						</div>
					
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Rate </label>
							<div class="col-md-8 col-sm-6">
							<input type="text" class="form-control" name="prate" value="<?php echo $vrow['prate'];?>" maxlength="5" onkeypress="return isNumber(event)" />
							</div>
						</div>
					
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Sale Rate </label>
							<div class="col-md-8 col-sm-6">
							<input type="text" class="form-control" name="rate" value="<?php echo $vrow['rate'];?>" maxlength="5" onkeypress="return isNumber(event)" />
							
							</div>
						</div>
						
						<!---<div class="form-group row">
							<label class="col-md-4 col-sm-6">Opening Qty *</label>
							<div class="col-md-8 col-sm-6">
							<input type="text" class="form-control" name="op_qty" value="<?php //echo $vrow['op_qty'];?>" maxlength="10" onkeypress="return isNumber(event)" required />
							
							</div>
						</div>--->
					
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">GST Rate (%) </label>
							<div class="col-md-8 col-sm-6">
							<input type="text" class="form-control" name="gst" value="<?php echo $vrow['gst'];?>" maxlength="5" onkeypress="return isNumber(event)" required />
							
							</div>
						</div>
					
					
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Item Detail </label>
							<div class="col-md-8 col-sm-6">
							<textarea class="form-control" name="description"><?php echo $vrow['description'];?></textarea>
							</div>
						</div>
					
					
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Image </label>
							<div class="col-md-8 col-sm-6">
							<?php 
							if($vrow['image']!='')
							{
								echo '<img id="upload1" src="'.BASE_PATH.'images/item_img/'.$vrow['image'].'" class="img-responsive" style="height:100px;" />';
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
						<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default" onclick="window.location='<?php echo BASE_PATH;?>Add_Item/'">Cancel</button>
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
	
	$("#addRow").on("click",function(e){
		e.preventDefault();
		$(this).attr("data-val","add");
		var st=$(this).attr("data-val");
		if(st=="add"){
			//alert(st);
			$("#add").show("slow");
			$("#all").removeClass("col-md-12");
			$("#all").addClass("col-md-8");
			
		}
	});
	
	
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
	
	
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/ITEM/',
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
					//$("#msg").html(response.message);
					//setTimeout(function(){$("#msg").html('');},1500);
							
					
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Add_Item/';},2000);
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