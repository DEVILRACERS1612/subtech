<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'Model/class.source.php';
include 'Model/class.user.php';
include 'Model/class.complaint_nature.php';
include 'Model/class.product.php';
include 'config/function.php';

$page="allcmpl";

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
$ctype=(isset($_REQUEST['ctype']) and $_REQUEST['ctype'] !='')?$db->filterVar($_REQUEST['ctype']):'';

$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
if($fdate=="" and $tdate==""){
	$fdt=date("Y-m-d",strtotime(date("Y-m-d")."-7 days"));
	$tdt=date("Y-m-d");
	$sql=$db->exeQuery("SELECT cc.*, cp.exp_date
FROM mi_customer_complain cc
LEFT JOIN mi_customer_product cp
    ON cp.id = (
        SELECT id FROM mi_customer_product 
        WHERE serial_no = cc.serial_no 
        ORDER BY id DESC LIMIT 1
    )
WHERE date(cc.rdate) >= '".$fdt."'
  AND date(cc.rdate) <= '".$tdt."'
  AND cc.mi_status = 'Yes'
ORDER BY cc.rdate DESC;");
}else{
	$sql=$db->exeQuery("SELECT cc.*, cp.exp_date
FROM mi_customer_complain cc
LEFT JOIN mi_customer_product cp
    ON cp.id = (
        SELECT id FROM mi_customer_product 
        WHERE serial_no = cc.serial_no 
        ORDER BY id DESC LIMIT 1
    )
WHERE date(cc.rdate) >= '".$fdate."'
  AND date(cc.rdate) <= '".$tdate."'
  AND cc.mi_status = 'Yes'
ORDER BY cc.rdate DESC;");
}


//$row=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>All Complaints </title>
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
									<header>All Complaints</header>
								</div>
						<div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
							<div class="search-set">
								
							</div>
							<form action="" method="post">
							<div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
								<div class="dropdown mr-2">
								<select class="form-control">
									<option value="">All</option>
									<option value="Pending">Pending</option>
									<option value="Completed">Completed</option>
									
								</select>
							
							
								</div>
								
								<div class="mr-2 date-select-small">
									<div class="input-addon-left position-relative">
										<input type="date" class="form-control" placeholder="Select Date" name="fdate" value="<?=($_POST['fdate']!="")?date("Y-m-d",strtotime($_POST['fdate'])):date("Y-m-d",strtotime(date("Y-m-d")."-7 days"));?>" />
									</div>
								</div>
								<div class="mr-2 date-select-small">
									<div class="input-addon-left position-relative">
										<input type="date" class="form-control" placeholder="Select Date" name="tdate" value="<?=($_POST['tdate']!="")?date("Y-m-d",strtotime($_POST['tdate'])):date("Y-m-d");?>">
									</div>
								</div>
								<div class="mr-2 dropdown">
								<select class="form-control" name="tech">
									<option value="">Technician</option>
									<?=$objuser->electrician_list($_POST['tech'])?>
								</select>
								</div>
								<div class="date-select-small">
									<div class="input-addon-left position-relative">
										<input type="submit" class="btn btn-sm btn-primary" value="Search" >
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
				<th>Date</th>
				<th>Ticket No</th>
				<th>Type</th>
				<th>Technician</th>
				<th>Stage</th>
				<th>Status</th>
				<th>Product</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
<?php 
$n=1;
while($row=$sql->fetch_assoc()){
$nc=$db->exeQuery("select * from mi_electrician_complain where cmpl_no='".$row['cmpl_no']."' and status='Accepted' and mi_status='Yes'")->num_rows;	
$cus=$objcomplaint->customer_detail($row['mobile']);
$objcomplaint->cmpl_no=	$row['cmpl_no'];
$techa=($row['tech_assigned']=='No')?'<a href="#" class="notasgn" data-id="'.$row['cmpl_no'].'"> Not Assigned </a>':'<a href="#" class="assigned" data-id="'.$row['cmpl_no'].'"> Assigned </a>'; //Replace assigned with technical name function

$strow=$db->exeQuery("select status from mi_complain_assign where cmpl_no='".$row['cmpl_no']."' and mi_status='Yes'")->fetch_assoc();
$wtype=($row['exp_date']>date("Y-m-d"))?'Under Warranty':'Out Of Warranty';
	?>
	<tr>
	<td><?=$n?>.</td>
	<td><?=date("d-M-Y",strtotime($row['rdate']))?></td>
	<td><a href="#" class="cmpl" data-mobile="<?=$row['mobile']?>" data-id="<?=$row['cmpl_no']?>" ><?=$row['cmpl_no']?></a></td>
	<td><?=$wtype?></td>
	<td><?=$techa?></td>
						
	<td>
		<div class="d-flex align-items-center">
		<div class="progress" style="width:100%;height:20px;">
		  <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">Registered</div>
		  <div class="progress-bar <?=($row['tech_assigned']=='Yes')?'bg-dark':'bg-light'?>" role="progressbar" style="width: 25%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">Assigned</div>
		  <div class="progress-bar <?=($strow['status']=='Start' or $strow['status']=='Close')?'bg-dark':'bg-light'?>" role="progressbar" style="width: 25%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">In-Process</div>
		  
		  <div class="progress-bar bg-light <?=($strow['status']=='Close')?'bg-dark':'bg-light'?>" role="progressbar" style="width: 25%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Completed</div>
		</div>

		</div>
	</td>
	<td>
	<?php if($strow['status']=='Close'){
		echo '<span class="badge badge-success d-inline-flex align-items-center badge-xs">Completed</span>';
	}else{
		echo '<span class="badge badge-danger d-inline-flex align-items-center badge-xs">Pending</span>';
	}?>
		
	</td>
	<td><?=$objproduct->pname($row['product'])?></td>
	<td><?php if(!$nc){ ?><a href="<?=BASE_PATH?>Add_Complaint/Edit/<?=$row['cmpl_no']?>"><i class="fa fa-pencil"></i></a><?php } ?></td>
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
	$("body").on("click",".accept",function(e){
		e.preventDefault();
		var cnf=confirm("Do you sure to Accept this electrician");
		if(cnf==false){return false;}
		var cmpl=$(this).attr("data-cmpl");
		var data_id=$(this).attr("data-id");
		accept_electrician(data_id,cmpl);
	});
	$("body").on("click",".reject",function(e){
		e.preventDefault();
		var cnf=confirm("Do you sure to reject this electrician");
		if(cnf==false){return false;}
		var cmpl=$(this).attr("data-cmpl");
		
		var data_id=$(this).attr("data-id");
		reject_electrician(data_id,cmpl);
	});
	$(".assigned").on("click",function(e){
		e.preventDefault();
		var cmpl=$(this).attr("data-id");
		$("#cmplno").val(cmpl);
		$("#assigned_modal").modal("show");
		/*$(".select2").select2({
			dropdownParent: $('#complain_lock #assign_form')
		});*/
		display_assigned(cmpl);
	});
	$(".notasgn").on("click",function(e){
		e.preventDefault();
		var cmpl=$(this).attr("data-id");
		$("#cmplno").val(cmpl);
		$("#complain_lock").modal("show");
		$(".select2").select2({
			dropdownParent: $('#complain_lock #assign_form')
		});
		display_defect(cmpl);
	});
	$(".cmpl").on("click",function(e){
		e.preventDefault();
		var cmpl=$(this).attr("data-id");
		$("#cmplno").val(cmpl);
		//var mobile=$(this).attr("data-mobile");
		display_complain(cmpl);
		$("#complain_view").modal("show");
		
	});
	$("#assign_form").on("submit",function(e){
		e.preventDefault();
		$("#assubmit").html("<i class='fa fa-spinner fa-spin'></i>");
		//$("#assubmit").attr("disabled",true);
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
				$("#assubmit").html("Submit");
				$("#assubmit").attr("disabled",false);
				//alert(data);
				var response=(JSON.parse(data));
				$("#cmsg").html(response.message);
				if(response.type=="success")
				{
					setTimeout(function(){$("#cmsg").html("");window.location.reload();},1500);					
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
	function accept_electrician(data_id,cmpl)
	{
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&data_id="+data_id+"&method=accept_elect";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#elemsg").val(response.message);
					display_assigned(cmpl);
				}
			}
		});
	}
	function reject_electrician(data_id,cmpl)
	{
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&data_id="+data_id+"&method=rej_elect";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#elemsg").val(response.message);
					display_assigned(cmpl);
				}
			}
		});
	}
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
	function display_assigned(cmpl)
	{
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&cmpl_no="+cmpl+"&method=assigned_detail";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#assign_detail").html(response.message);
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
	function display_complain(cmpl)
	{
		$("#cdetail").html("<tr><td><i class='fa fa-spinner fa-spin'></i></td><td><i class='fa fa-spinner fa-spin'></i></td><td><i class='fa fa-spinner fa-spin'></i></td></tr>");
		$("#cmpdetail").html("<tr><td><i class='fa fa-spinner fa-spin'></i></td><td><i class='fa fa-spinner fa-spin'></i></td><td><i class='fa fa-spinner fa-spin'></i></td><td><i class='fa fa-spinner fa-spin'></i></td></tr>");
		
		$("#prddetail").html("<tr><td><i class='fa fa-spinner fa-spin'></i></td><td><i class='fa fa-spinner fa-spin'></i></td><td><i class='fa fa-spinner fa-spin'></i></td><td><i class='fa fa-spinner fa-spin'></i></td><td><i class='fa fa-spinner fa-spin'></i></td><td><i class='fa fa-spinner fa-spin'></i></td></tr>");
		
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&cmpl_no="+cmpl+"&method=complain_detail";
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
					$("#cmpdetail").html("<tr><td>"+response.cmpl_no+"</td><td>"+response.cmpl_date+"</td><td>"+response.defect+"</td><td>"+response.priority+"</td></tr>");
					var model = '-';
					if(response.product_data){
						model = response.product_data.model ?? '-';
					}
					$("#prddetail").html("<tr><td>1.</td><td>"+response.brand+"</td><td>"+model+"</td><td>"+response.product+"</td><td>"+response.serial_no+"</td><td>"+response.exp_date+"</td></tr>");
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
	<div class="modal fade" id="complain_lock">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
					<h5 class="modal-title">Complain Lock</h5>
				</div>
		<div class="modal-body">
					  
		<form id="assign_form" method="post">
			<input type="hidden" name="post_id" value="<?=$post_id?>"/>
			<input type="hidden" name="method" value="tech_assign"/>
			<input type="hidden" name="cmpl_no" id="cmplno" />
			<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
			<div class="row">
			 <div class="col-md-6">
				   <div class="mb-3">
					<label class="form-label">Entry Date</label>
					<input type="date" class="form-control" placeholder="" name="pdate" value="<?=date("Y-m-d");?>">
					</div>
				</div>
				
			  <div class="col-md-6">
				   <div class="mb-3">
					<label class="form-label">Technician</label>
				<select class="form-control select2" name="tech[]" required multiple >
				<option value="">Select Technician</option>
				<?=$objuser->electrician_list()?>
							
				</select>
			</div>
		</div>
				
				<!--<div class="mb-3 col-md-6">
					<label class="form-label">Visit Date</label>
				<input type="date" name="vdate" class="form-control" placeholder="">
				</div>
				<div class="mb-3 col-md-6">
						<label class="form-label">Visit Time</label>
				<input type="time" name="vtime" class="form-control" placeholder="">
				</div>-->
				<div class="mb-3 col-md-6">
					<label class="form-label">Problem/Defect</label>
					<textarea name="defect" id="defect" class="form-control"></textarea>
				</div>
				<div class="mb-3 col-md-6">
					 <div class="mb-3">
						<label class="form-label">Remark</label>
						<textarea name="remark" class="form-control"></textarea>
					</div>
				</div>
				<div id="cmsg"></div>
				<div class="col-sm-3">
				  <button type="submit" class="btn btn-secondary">Submit</button>
				</div>
			   
			</div>
		</form>
		</div>
		
	</div>
</div>
</div>
<!-- Add COmplain  Modal -->
<!-- Assigned View  Modal -->
		<div class="modal fade" id="assigned_modal">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
						<h5 class="modal-title">Complain Assigned Detail</h5>
					</div>
					<div class="modal-body">
					<div class="card-body">
							<div class="row align-items-end">
							  <div class="col-sm-12 mb-5">
								<div id="elemsg"></div>
								<div class="table-responsive">
								<table class="table table-bordered">
									<thead class="thead-light">
										<tr>						
											<th>Assign Date</th>
											<th>Name</th>
											<th>Mobile No</th>
                                            <th>Address</th>
											<th>Complain No.</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="assign_detail">
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


<!-- Complain View  Modal -->
		<div class="modal fade" id="complain_view">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
						<h5 class="modal-title">Complain Detail</h5>
					</div>
					<div class="modal-body">
					<div class="card-body">
							<div class="row align-items-end">
							  <div class="col-sm-6 mb-2">
									  <h5>Customer Details</h5>
									<div class="table-responsive">
								<table class="table border">
									<thead class="thead-light">
										<tr>						
											<th>Name</th>
											<th>Mobile No</th>
                                            <th>Address</th>
										</tr>
									</thead>
									<tbody id="cdetail">
									 
                                                                               
                                         
									</tbody>
									<!--<tfoot>
										<tr><td class="bg-light fw-bold p-3 fs-16">Total</td>
										<td class="bg-light fw-bold p-3 fs-16">$37,000</td>
										<td class="bg-light fw-bold p-3 fs-16">$37,000</td>
									</tr></tfoot>-->
								</table>
							</div>
						</div>
									
									
									
									
									  <div class="col-sm-6 mb-2">
									  <h5>Complains Details</h5>
									<div class="table-responsive">
								<table class="table border">
									<thead class="thead-light">
										<tr>						
											<th>Complain No.</th>
                                            <th>Date</th>
											<th>Defect</th>
											<th>Priority</th>
											
										</tr>
									</thead>
									<tbody id="cmpdetail">
									 
										
									</tbody>
									<!--<tfoot>
										<tr><td class="bg-light fw-bold p-3 fs-16">Total</td>
										<td class="bg-light fw-bold p-3 fs-16">$37,000</td>
										<td class="bg-light fw-bold p-3 fs-16">$37,000</td>
									</tr></tfoot>-->
								</table>
							</div>
									</div>
									
									
									
							<div class="col-sm-12">
								<h5>Product Details</h5>
							<div class="table-responsive">
								<table class="table border">
									<thead class="thead-light">
										<tr>						
											<th>Sr. No.</th>
											<th>Make</th>
											<th>Model</th>
											<th>Product </th>
											<th>Product Serial No.</th>
											<th>Expiry Date</th>
											
										</tr>
									</thead>
									<tbody id="prddetail">
									 
                                       
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