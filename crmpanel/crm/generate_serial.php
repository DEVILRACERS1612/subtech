<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
//error_reporting(E_ALL);
include 'config/function.php';
include 'Model/class.user.php';
include 'Model/class.product.php';
include 'Model/class.category.php';

$page="generate_serial";


include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_delete']!='Yes' and $page_permission['pg_view']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
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
	<title>Generate Product Serial </title>
<head>
<?php include 'config/head.php';?>

 <style>
     
        .orders-pipeline {
            flex: 1;
            min-width: 350px;
        }

       

        .orders-pipeline h2 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #E84949;
        }

        .order-card {
          background-color: #f2f2f2;
    border: 1px solid #cecece;
    border-radius: 10px;
    margin-bottom: 1.5rem;
    padding: 0.5rem;
        }

        .order-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #444;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .order-card-header .order-ref {
            font-size: 1rem;
            font-weight: 500;
        }
        .order-card-header .order-ref span {
            color: #aaa;
        }

        .order-card-header .dispatch-date {
            background-color: #fff;
            padding: 0.3rem 0.8rem;
            border-radius: 5px;
            font-size: 0.9rem;
        }
        .order-card-header .dispatch-date span {
            color: #E84949;
            font-weight: bold;
        }

        .order-card-body h5 {
            font-weight: 700;
            font-size: 1.25rem;
        }

        .order-card-body p {
            color: #ccc;
            margin-bottom: 1rem;
        }

        .order-items {
            list-style: none;
            padding-left: 0;
            margin-bottom: 1rem;
        }
        .order-items li {
            margin-bottom: 0.5rem;
        }
        .order-items b {
            color: #E84949;
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
						<div class="col-md-5">
							<div class="card card-topline-aqua">
					<div class="card-header">
						<div class="">
							<div class="profile-usertitle-name">Orders In Pipeline (3)
						
						</div>
						</div>
					</div>
					<div class="card-body no-padding height-9" style="height: 400px;
    overflow-y: scroll;">
						<div class="">
						
							 <!-- Order Card 1 -->
								<div class="order-card">
									<div class="order-card-header">
										<div class="order-ref">Order: <span>01</span></div>
										<div class="order-ref">Ref: <span>Kartik</span></div>
										<div class="dispatch-date">Dispatch: <span>21 May</span></div>
									</div>
									<div class="order-card-body">
										<h5>GK Electrical</h5>
										<p>271, nirman viman, Uttar Pradesh 201306</p>
										<ul class="order-items">
											<li>Royal • Heavy • 1.5 HP • <b>20 Pcs</b></li>
											<li>Star Delta • Prime • 50 HP • <b>7 Pcs</b></li>
										</ul>
										<div class="created-on">Created on: 13 May 2025</div>
									</div>
								</div>
								
								<!-- Order Card 1 -->
								<div class="order-card">
									<div class="order-card-header">
										<div class="order-ref">Order: <span>01</span></div>
										<div class="order-ref">Ref: <span>Kartik</span></div>
										<div class="dispatch-date">Dispatch: <span>21 May</span></div>
									</div>
									<div class="order-card-body">
										<h5>GK Electrical</h5>
										<p>271, nirman viman, Uttar Pradesh 201306</p>
										<ul class="order-items">
											<li>Royal • Heavy • 1.5 HP • <b>20 Pcs</b></li>
											<li>Star Delta • Prime • 50 HP • <b>7 Pcs</b></li>
										</ul>
										<div class="created-on">Created on: 13 May 2025</div>
									</div>
								</div>
								
								
								<!-- Order Card 1 -->
								<div class="order-card">
									<div class="order-card-header">
										<div class="order-ref">Order: <span>01</span></div>
										<div class="order-ref">Ref: <span>Kartik</span></div>
										<div class="dispatch-date">Dispatch: <span>21 May</span></div>
									</div>
									<div class="order-card-body">
										<h5>GK Electrical</h5>
										<p>271, nirman viman, Uttar Pradesh 201306</p>
										<ul class="order-items">
											<li>Royal • Heavy • 1.5 HP • <b>20 Pcs</b></li>
											<li>Star Delta • Prime • 50 HP • <b>7 Pcs</b></li>
										</ul>
										<div class="created-on">Created on: 13 May 2025</div>
									</div>
								</div>
			
			

								</div>
							</div>
						</div>
						
						
						</div>
						<div class="col-md-7">
							<div class="card card-topline-aqua">
					<div class="card-header">
						<div class="">
							<div class="profile-usertitle-name">Stickers <button type="button" class="btn-success btn-sm" style="    background-color: #28a745; color: white;padding: 0.5rem 1rem;border-radius: 5px; font-weight: 800;">
							<?=date("D M d Y H:i A")?></button>
						
						<button type="button" class="btn-primary btn-sm pull-right" onclick="window.location='<?=BASE_PATH?>All_Serial'"><i class="fa fa-arrow-right icon-th"></i> View All</button></div>
						</div>
					</div>
					<div class="card-body no-padding height-9">
						<div class="container">
						<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#mrpsticker">MRP Stickers</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#deliverybox">Delivery Box</a>
  </li>
 
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active container" id="mrpsticker">
  <?php
$n=$db->exeQuery("select * from mi_product_detail where date(rdate)='".date("Y-m-d")."' and mi_status='Yes'")->num_rows;  
  ?>
   <div class="total-printed mb-4">
	   <span class="count">Today's total printed</span>
	   <span class=""><br><b style="font-size:20px;color:red"><?=$n?> </b>Serial Numbers</span>
	</div>

		<form id="serial_formxx" autocomplete="off" enctype="multipart/form-data">
			<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
			<input type="hidden" name="method" value="reqserial" />
			<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
			
			<div class="row">
				
				<div class="col-md-12">
				<div class="row">
					<label class="col-md-2" for="subcat">Category <span>*</span></label>
					<div class="col-md-10">
					<div class="form-group">
						<select class="form-control ser" id="subcat">
							
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
					<label class="col-md-2" for="reqprd">Product <span>*</span></label>
					<div class="col-md-10">
					<div class="form-group">
						<select class="form-control select2 itm" id="reqprd" name="pcode" required >
							<?=$objproduct->item_list();?>
						</select>
					</div>
					</div>
				</div>
				</div>
				
				<div class="col-md-4">
					<div class="form-group">
						<label for="mfg-date">Manufacturing Date</label>
						<div class="date-input-group">
							<input type="date" class="form-control" id="mfgdt" name="mfgdates"  max="<?=date("Y-m-d")?>" value="<?=date("Y-m-d")?>">
							<i class="fas fa-calendar-alt"></i>
						</div>
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="form-group">
						<label for="mfg-date">No of serial to generate</label>
						<div class="date-input-group">
							<input type="text" class="form-control" id="reqty" name="qty" value="">
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="mfg-date">MRP</label>
						<div class="date-input-group">
							<input type="text" class="form-control" id="mrp" name="mrp" value="">
						</div>
					</div>
				</div>
				
				<div class="col-md-6">
					<div class="form-group">
						<label for="mfg-date">&nbsp;</label>
						<div class="date-input-group">
							<button type="button" class="btn btn-danger waves-effect waves-light" style="width:100%" id="reqBtn" ><i class="fa fa-print icon-th"></i> Print</button>
						</div>
					</div>
				</div>
			</div>
			
			  
			
			 
		</form>
  
  </div>
  <div class="tab-pane container" id="deliverybox">...</div>
 <!-- Tab panes -->
</div>				

		</div>
	</div>
</div>
					
		</div>
	</div>					
</div>
<div class="page-content">
	<div class="row">
	<div class="card card-body ">
	<div id="error"></div>
		<div class="table-scrollable">
			<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="exportTable">
				<thead>
					<tr>
						<th> S.No.</th>
						<th> Date Time</th>
						<th> Product name </th>
						<th> Batch </th>
						<th> Model </th>
						<th> Brand </th>
						<th> Total Serial </th>
						<th> At Customer End </th>
						<th> Image </th>
						<th> Action </th>
					</tr>
				</thead>
				<tbody id="displaydata">
				<?php
				$qr=$db->exeQuery("SELECT
					rdate,
					prd_id,
					batch_no,
					brand,
					COUNT(serial_no) AS serial_count,
					COUNT(CASE WHEN cust_id IS NOT NULL AND cust_id <> '' THEN 1 END) AS cust_id_count,
					MAX(rdate) AS latest_rdate
				FROM
					mi_product_detail
				WHERE
					cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and date(rdate)='".date("Y-m-d")."' and mi_status = 'Yes' and batch_no!='OLD'
				GROUP BY
					prd_id,
					batch_no,
					brand
				ORDER BY
					latest_rdate DESC");
				
				$i=1;
			while($row=$qr->fetch_assoc())
			{
				$img='';
				if($row['image']!=''){
					$img="<img src='".BASE_PATH."images/prod_img/".$row['image']."' style='height:50px;' />";
				}
				$pd=$objproduct->item_details($row['prd_id']);
				
				echo "<tr><td>".$i."</td><td>".date("d-M-Y H:m",strtotime($row['rdate']))."</td><td>".$pd['pname']."</td><td>".$row['batch_no']."</td><td>".$pd['model']."</td><td>".$objcat->brand_name($row['brand'])."</td><td>".$row['serial_count']."</td><td>".$row['cust_id_count']."</td><td>".$img."</td><td><a href='".BASE_PATH."pkt_print/MUL/".$row['batch_no']."' target='_blank' data-id='".$row['batch_no']."' class='btn btn-info btn-xs' title='Print'><i class='fa fa-print'></i></a> <a href='#' data-id='".$row['batch_no']."' class='btn btn-primary btn-xs viewall' title='View'><i class='fa fa-eye'></i></a>";
				
				if($_SESSION[SITE_NAME]['MICMP_usertype']=='Admin'){
					echo "<a href='#' data-id='".$row['batch_no']."' class='btn btn-danger btn-xs delall' title='Delete'><i class='fa fa-trash'></i></a>";
				}
				
				
				echo "</td></tr>";
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
			<!-- end page content -->
			<!-- start chat sidebar -->
		
			<!-- end chat sidebar -->
		</div>
		<!-- end page container -->
		<!-- start footer -->
		<?php include 'config/footer.php';?>
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
	
	
	
	
	
	
	
	var per=<?php echo json_encode($page_permission);?>;
	var per1=JSON.stringify(per);
/////Delete ///////////
	$("body").on("click",".delall",function(e){
		e.preventDefault();
		var cnf=confirm('Do you want to delete this Batch no.');
		if(cnf===false){return false;}
		var did=$(this).attr("data-id");
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&del_id="+did+"&method=DelbyBatch";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PRODUCT/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				//alert(response.mrp);
				$("#error").html(response.message);
				setTimeout($(function(){$("#error").html("");window.location.reload();}),1500);
			}
		});
	});
	$("body").on("click",".del",function(e){
		e.preventDefault();
		var cnf=confirm('Do you want to delete this Serial no.');
		if(cnf===false){return false;}
		var did=$(this).attr("data-id");
		//var v=$(this).val();
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&del_id="+did+"&method=DelbySerial";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PRODUCT/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				//alert(response.mrp);
				$("#error").html(response.message);
				setTimeout($(function(){$("#error").html("");window.location.reload();}),1500);
			}
		});
	});
/////////////////////////////////////
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
				var response=(JSON.parse(data));
				//alert(response.mrp);
				$("#mrp").val(response.mrp);
				
				//alert(response.message);
				
			}
		});

	} );

//////////////////////////////////////
/*
$("body").on("change",".ser",function(){
	var v=$(this).val();
	var id=$(this).attr("id");
	$("#f"+id).val(v);
	$("#serform").submit();
});
$("body").on("submit","#serform",function(e){
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
			//alert(data);
			$('#preloader').hide();
			var response=(JSON.parse(data));
			if(response.type=="success")
			{
				///alert(response.ptype2list);
				$("#reqprd").html(response.prdlist);
				//$("#cat").html(response.catlist);
				//$("#subcat").html(response.subcatlist);
				//$("#ptype").html(response.ptypelist);
				//$("#ptype2").html(response.ptype2list);
				//$("#varient").html(response.varientlist);
				//$("#rating").html(response.ratinglist);
				
			}	
		}
		
	}); 
});

	$("#subcat").on("change",function(){
		$("#ptype").html("");
		$("#ptype2").html("");
		$("#variant").html("");
		$("#rating").html("");
		
		var sctid=$(this).val();
		if(sctid==""){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&subcat_id="+sctid+"&method=FindTypeList";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/CATEGORY/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#ptype").html(response.ptypelist);
				}
			}
		});
	});
	$("#ptype").on("change",function(){
		$("#ptype2").html("");
		$("#variant").html("");
		$("#rating").html("");
		var sctid=$("#subcat").val();
		var ptid=$(this).val();
		if(sctid=="" || ptid==""){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&subcat_id="+sctid+"&ptype_id="+ptid+"&method=FindType2List";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/CATEGORY/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#ptype2").html(response.ptype2list);
				}
			}
		});
	});
	$("#ptype2").on("change",function(){
		$("#variant").html("");
		$("#rating").html("");
		var sctid=$("#subcat").val();
		var ptid=$("#ptype").val();
		var pt2id=$(this).val();
		if(sctid=="" || ptid=="" || pt2id==""){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&subcat_id="+sctid+"&ptype_id="+ptid+"&ptype2_id="+pt2id+"&method=FindVarientList";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/CATEGORY/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					//alert(response.varientlist);
					$("#variant").html(response.varientlist);
				}
			}
		});
	});
	$("#variant").on("change",function(){
		$("#rating").html("");
		var sctid=$("#subcat").val();
		var ptid=$("#ptype").val();
		var pt2id=$("#ptype2").val();
		var varid=$(this).val();
		if(sctid=="" || ptid=="" || pt2id=="" || varid==""){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&subcat_id="+sctid+"&ptype_id="+ptid+"&ptype2_id="+pt2id+"&varient_id="+varid+"&method=FindRatingList";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/CATEGORY/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					//alert(response.ratinglist);
					$("#rating").html(response.ratinglist);
				}
			}
		});
	});
*/
	$("body").on("click","#reqBtn",function(){
		var stk=$("#reqty").val();
		var did=$("#reqprd").val();
		var mfdt=$("#mfgdt").val();
		var mrp=$("#mrp").val();
		if(stk=="" || stk<1){alert("Qty Must be Entered");$("#reqty").focus();return false;}
		if(mfdt==""){alert("Mfg Date Must be Selected");$("#mfgdt").focus();return false;}
		if(did=="" || did<1){alert("Product Must be Selected");$("#reqprd").focus();return false;}
		display_serial(did,stk,mfdt);
		//$("#RqserialModel").modal("hide");
		$("#viewserialModel").modal("show");
		$("#prd_id").val(did);
		$("#mrp_id").val(mrp);
	});
	function display_serial(did,stk,mfdt)
	{
		
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&pcode="+did+"&mfgdates="+mfdt+"&qty="+stk+"&method=ViewSerial";
		//alert(datastr);
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PRODUCT/',
			method:'post',
			data:datastr,
			success:function(data){
				//alert(data);
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					if(response.stk<stk){
						//alert("Stock is no more as your required");
						$("#displaysvdata").html("<tr><th colspan='4'><h4 class='alert alert-danger'>This product has no more stock as you required <h4></th></tr>");
					}else{
						$("#displaysvdata").html(response.message);
					}
					
					//alert(response.message);
				}
			}
		});/**/
	}

	$("body").on("submit","#serial_form",function(e){
		e.preventDefault();
		$("#preloader").show();
		$("#btnserial").attr("disabled",true);
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
					$("#racmsg").html(response.message);
					//setTimeout(function(){$("#msg").html('');},1500);
					setTimeout(function(){window.open('<?php echo BASE_PATH;?>pkt_print/MUL/'+response.batch,'_blank');window.location.reload();},2000);
				}else{
					$("#racmsg").html(response.message);
					setTimeout(function(){$("#racmsg").html('');},1500);
				}	
			}
			
		});
	} );
	$("body").on("click",".viewall",function(){
		var did=$(this).attr("data-id");
		display_all_serial(did);
		$("#serialModel").modal("show");
	});
	function display_all_serial(did)
	{
		
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&pcode="+did+"&method=ViewAllSerial";
		
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PRODUCT/',
			method:'post',
			data:datastr,
			success:function(data){
				//alert(data);
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#displaysdata").html(response.message);
					//alert(response.message);
				}
			}
		});/**/
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
} );
</script>

</body>

</html>
<div class="modal fade" id="viewserialModel" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document" >
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center" id="addEventTitle">All Serial Product Detail</h4>
			</div>
			<div class="modal-body">
				
				<div class="row">
				
				
				<div class="col-md-12 ">
				<div class="card-box">
				<form id="serial_form" action="" method="post">
				<input type="hidden" name="post_id" value="<?php echo $post_id;?>">
				<input type="hidden" name="method" value="UpdateSerial">
				<input type="hidden" name="mrp" id="mrp_id" value="">
				<input type="hidden" name="pcode" id="prd_id" value="">
				<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
					<div class="card-body">
					<div class="table-responsive"></div>
						<table class="table table-bordered">
						<thead>
						<tr>
							<th>Serial No.</th><th>Model</th><th>Brand</th><th>Date</th>
						</tr>
						</thead>
						<tbody id="displaysvdata">
						</tbody>
						</table>
					</div>
					<div id="racmsg"></div>
					<button type="submit" id="btnserial" class="btn btn-primary">Generate & Print</button>
			</form>
				</div>
					
				</div>
				
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="serialModel" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center" id="addEventTitle">All Serial Product Detail</h4>
			</div>
			<div class="modal-body">
				
				<div class="row">
				
				
				<div class="col-md-12 ">
				<div class="card-box">
					<div class="card-body">
					<div class="table-responsive" id="displaysdata"></div>

					</div>
		
					</div>
					<button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
				</div>
				
				</div>
			</div>
		</div>
	</div>
</div>