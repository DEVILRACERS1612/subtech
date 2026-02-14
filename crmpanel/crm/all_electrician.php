<?php
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.user.php';

$page="electrician-list";
include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_delete']!='Yes' and $page_permission['pg_view']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}

$db->exeQuery("update mi_notifications_soft set read_status='1' where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and noti_for='".$_SESSION[SITE_NAME]['MICMP_userid']."' and noti_page_for='electrician-list' and read_status='0'");

$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
if($method=='Deact')
{
	$q=$db->exeQuery("update mi_electrician set act_status='No' where id='".$edit_id."' and mi_status='Yes'");

	$error="<span class='alert alert-danger'>Electrician Deactivated Successfully</span>";
	header('Refresh:2;url='.BASE_PATH.'all-electrician/');
}
elseif($method=='Act')
{
	$q=$db->exeQuery("update mi_electrician set act_status='Yes' where id='".$edit_id."' and mi_status='Yes'");

	$error="<span class='alert alert-danger'>Electrician Activated Successfully</span>";
	header('Refresh:2;url='.BASE_PATH.'all-electrician/');
}
/**/

?>
<!DOCTYPE html>
<html lang="en">
	<title>Electrician </title>
<head>
<?php include 'config/head.php';?>

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
				<header>All Electrician</header>
				<div class="btn-group pull-right" style="padding-right:10px; padding-bottom:5px;">
					<!---<a href="<?php echo BASE_PATH;?>Add_User/" id="addRow" class="btn btn-primary">
						Add New User <i class="fa fa-plus"></i>
					</a>-->
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
								<th>S.No.</th>
								<th> Mobile </th>
								<th> Name </th>
								<th> Refferal. </th>
								<th> Earn </th>
								<th> Cust. Ref. </th>
								<th> City </th>
								<th> State </th>
								<th> Address </th>
								<th> Active </th>
								<th> Image </th>
								<th> Action </th>
							</tr>
						</thead>
						<tbody id="">
						<?php
						//echo "select * from mi_user where cmp_id='".$_SESSION['MICMP_cmpid']."' and mi_status='Yes'";
						$qr=$db->exeQuery("select a.*,b.state as state_name from mi_electrician a left join mi_state b on a.state=b.id where a.mi_status='Yes' order by id desc");
						$i=1;
					while($row=$qr->fetch_assoc())
					{
						$img="";
						if($row['selfie']!=''){
							$img="<img src='".BASE_PATH."images/ele_img/".$row['selfie']."' style='height:50px;' />";
						}
						$nelect=$db->exeQuery("select count(id) as ref from mi_electrician where refid='".$row['mobile']."' and act_status='Verified' and mi_status='Yes'")->fetch_assoc();

						$ncust=$db->exeQuery("select count(id) as ref,SUM(CASE WHEN act_status='Pending' THEN 1 ELSE 0 END) AS pending_ref from mi_customer_product where elect_by='".$row['mobile']."' and mi_status='Yes'")->fetch_assoc();
						$noti="";
						if($ncust['pending_ref']>0){
							$noti="<span class='badge headerBadgeColor1' style='top:-3px;'>".$ncust['pending_ref']." </span>";
						}
						
						$tamt=$nelect['ref']*50;
						echo "<tr><td>".$i."</td><td>".$row['mobile']."</td><td>".$row['fname']."</td><td><a href='#' class='findelec' data-mob='".$row['mobile']."'>".$nelect['ref']."</a><td>".$tamt."</td></td><td><a href='#' class='findcust' data-mob='".$row['mobile']."'>".$ncust['ref']."</a> ".$noti."</td><td>".$row['city']."</td><td>".$row['state_name']."</td><td>".$row['address']."</td><td>".$row['act_status']."</td><td>".$img."</td><td>";

						echo "<a class='btn btn-primary btn-xs earn' data-name='".$row['fname']."' data-mobile='".$row['mobile']."' data-bank='".$row['bank']."' data-branch='".$row['branch']."' data-ifsc='".$row['ifsc']."' data-acno='".$row['acno']."' data-acname='".$row['acname']."' data-upid='".$row['upid']."'  title='Total Earn'><i class='fa fa-inr'></i></a>";
						if($row['act_status']=='No'){
							echo "<a href='".BASE_PATH."all-electrician/Act/".$row['id']."/' class='btn btn-success btn-xs' title='Active' onclick='return confirm(\"Do you want to Activate this Electrician\")'><i class='fa fa-check'></i>";
						}else{
							echo "<a href='".BASE_PATH."all-electrician/Deact/".$row['id']."/' class='btn btn-danger btn-xs' title='Deactive' onclick='return confirm(\"Do you want to Deactivate this Electrician\")'><i class='fa fa-times'></i>";
						}

						echo "</td></tr>";
						//<a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'  title='Delete'><i class='fa fa-trash-o'></i></a>
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
			url:'<?php echo BASE_PATH;?>Controller/USER/',
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

	function display(mob)
	{
		$("#displaydata").html('<tr><td colspan="4">Wait...</td></tr>');
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&mobile="+mob+"&method=ViewEleCustomer";
		//alert(data);
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
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
	function display_ref_elect(mob)
	{
		$("#displaydata1").html('<tr><td colspan="4">Wait...</td></tr>');
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&mobile="+mob+"&method=ViewRefElec";

		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#displaydata1").html(response.message);
					//alert(response.message);
				}
			}
		});
	}
	//////////////////////////////////////////////////
	$("body").on("click",".findelec",function(e){
		var mob=$(this).attr("data-mob");
		e.preventDefault();
		//var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&mobile="+mob+"&method=FindRefElect";
		$("#elec_view").modal("show");
		display_ref_elect(mob);

	});
	$("body").on("click",".refverify",function(e){
		e.preventDefault();
		var cnf=confirm("Do you want to verify this electrician and distribute cashback");
		if(cnf===false){return false;}
		var id=$(this).attr("data-id");
		var mob=$(this).attr("data-mobile");
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&data_id="+id+"&mobile="+mob+"&method=RefVerify";
		
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			method:'post',
			data:datastr,
			success:function(data){
				//alert(data);
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#elerror").html(response.message);
					setTimeout(function(){$("#elerror").html("");display_ref_elect(mob);},1500);
					
				}
			}
		});
	});
	$("body").on("click",".refreject",function(e){
		e.preventDefault();
		var cnf=confirm("Do you want to reject this product and Cancel cashback");
		if(cnf===false){return false;}
		var id=$(this).attr("data-id");
		var mob=$(this).attr("data-mobile");
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&data_id="+id+"&method=RefRejected";
		//alert(datastr);
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#elerror").html(response.message);
					setTimeout(function(){$("#elerror").html("");display(mob);},1500);
					display_ref_elect(mob);
				}
			}
		});
	});

	$("body").on("click",".findcust",function(e){
		var mob=$(this).attr("data-mob");
		e.preventDefault();
		//alert("asdf");
		$("#cust_view").modal("show");
		display(mob);

	});
	$("body").on("click",".vd",function(e){
		e.preventDefault();
		var src=$(this).attr("data-src");
		$("#videosrc").attr("src",src);
		$("#video")[0].load();
		$("#video_view").modal("show");
	});
	$("body").on("click",".verify",function(e){
		e.preventDefault();
		var cnf=confirm("Do you want to verify this product and distribute cashback");
		if(cnf===false){return false;}
		var id=$(this).attr("data-id");
		var mob=$(this).attr("data-mobile");
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&data_id="+id+"&method=VerifyCustomer";
		//alert(datastr);
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#cserror").html(response.message);
					setTimeout(function(){$("#cserror").html("");display(mob);},1500);
					display(mob);
				}
			}
		});
	});
	$("body").on("click",".reject",function(e){
		e.preventDefault();
		var cnf=confirm("Do you want to reject this product and Cancel cashback");
		if(cnf===false){return false;}
		var id=$(this).attr("data-id");
		var mob=$(this).attr("data-mobile");
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&data_id="+id+"&method=RejectedCustomer";
		//alert(datastr);
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#cserror").html(response.message);
					setTimeout(function(){$("#cserror").html("");display(mob);},1500);
					display(mob);
				}
			}
		});
	});
	$("body").on("click",".earn",function(e){
		var mob=$(this).attr("data-mobile");
		var nam=$(this).attr("data-name");
		$("#bank").val($(this).attr("data-bank"));
		$("#branch").val($(this).attr("data-branch"));
		$("#ifsc").val($(this).attr("data-ifsc"));
		$("#acno").val($(this).attr("data-acno"));
		$("#acname").val($(this).attr("data-acname"));
		$("#upid").val($(this).attr("data-bank"));
		$(".elemobile").val(mob);
		$(".nam").html(nam);
		e.preventDefault();
		$("#earn_view").modal("show");
		display_earn(mob);
	});
	function display_earn(mob)
	{
		$("#displaypaydata").html('<tr><td colspan="4">Wait...</td></tr>');
		
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&mobile="+mob+"&method=ViewPayData";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			method:'post',
			data:datastr,
			success:function(data){
				
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#displaypaydata").html(response.message);
					//alert(response.message);
				}
			}
		});
	}
	$("body").on("click",".pay",function(e){
		e.preventDefault();
		var mob=$(this).attr("data-mobile");
		var bal=$(this).attr("data-bal");
		if(bal<500){
			$("#perror").html("<span class='text-danger'>Low Balance <br>(Minimum Amount &#8377; 500) </span>");
		}else{
			$("#ele_mobile").val(mob);
			$("#pay_amt").val(bal).attr('max-val',bal);
			$("#pay_view").modal("show");
		}
		$("#earn_view").modal("show");
	});
	$("#bank_form").on("submit",function(e){
		e.preventDefault();
		$("#bmsg").html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#bmsg").html(response.message);
				}else{
					$("#bmsg").html(response.message);
				}	
			}
		});
	} );
	
	$("body").on("keyup","#pay_amt",function(){
		var v=$(this).val();
		var x=$(this).attr('max-val');
		if(Number(v)>Number(x)){
			$(this).val(x);
		}
	});
	$("#pay_form").on("submit",function(e){
		e.preventDefault();
		var p=$("#pay_amt").val();
		if(p<500){$("#perror").html("<span class='text-danger'>Low Balance <br>(Minimum Amount &#8377; 500) </span>"); return false;}
		
		var cnf=confirm("Do you want to payment the amount");
		if(cnf===false){return false;}
		var mob=$(".elemobile").val();
		$("#ptnsubmit").attr("disabled",true);
		$("#pmsg").html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPLAINTNATURE/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
				var response=(JSON.parse(data));
				$("#ptnsubmit").attr("disabled",false);
				if(response.type=="success")
				{
					$("#pay_amt").val(0);
					$("#pmsg").html(response.message);
					display_earn(mob);
					setTimeout(function(){$("#pmsg").html("");$("#pay_view").modal("hide");},2000);
				}else{
					$("#pmsg").html(response.message);
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

</body>
<div class="modal fade" id="earn_view">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Total Earning of <span class="text-primary nam"></span></h4>
			</div>
			<div class="modal-body">
			<div class="card-body">
				<div class="row align-center" id="displaypaydata">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
								<th>#</th>
								<th>Earn Type</th>
								<th>Amount</th>
								</tr>
							</thead>
							<tbody id="">
							</tbody>
							<tfoot>
								<tr><th></th><th></th><th>Total</th><th></th></tr>
								<tr><th></th><th></th><th>Total Paid</th><th></th></tr>
								<tr><th></th><th></th><th>Total Balance</th><th></th></tr>
								<tr><th></th><th></th><th></th><th><a href="" class="btn btn-sm btn-primary">Pay Now</a></th></tr>
							</tfoot>
						</table>
					</div>
				</div>
				<form method="post" action="" id="bank_form" autocomplete="off" enctype="multipart/form-data">
				<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
				<input type="hidden" name="method" value="BankDetail" />
				<input type="hidden" name="mobile" class="elemobile" />
				
				<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
				<div class="row align-center">	
					<div class="col-6">
						<div class="form-group">
							<label>Bank Name </label>
							<input type="text" class="form-control" maxlength="50" name="bank" id="bank" value="" />
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label>Branch Name </label>
							<input type="text" class="form-control" maxlength="25" name="branch" id="branch" value="" />
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label>IFSC Code </label>
							<input type="text" class="form-control" maxlength="15" name="ifsc" id="ifsc" value="" />
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label>A/c No </label>
							<input type="text" class="form-control" maxlength="20" name="acno" id="acno" value="" onkeypress="return isNumber(event)" />
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label>A/c Name </label>
							<input type="text" class="form-control" maxlength="20" name="acname" id="acname" value="" />
						</div>
					</div>
					<div class="col-6">
						<div class="form-group">
							<label>UPI ID </label>
							<input type="text" class="form-control" maxlength="20" name="upid" id="upid" value="" />
						</div>
					</div>
										
					<div id="bmsg"></div>
					<div class="col-lg-12 p-t-20 text-center">
						<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink" id="btnsubmit">Submit</button>
					</div>
				</div>		
					
				</form>
			</div>
		</div>

		</div>
	</div>
</div>
<div class="modal fade" id="pay_view">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Pay to <span class="text-primary nam"></span></h4>
			</div>
			<div class="modal-body">
			<div class="card-body">
				
				<form method="post" action="" id="pay_form" autocomplete="off" enctype="multipart/form-data">
				<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
				<input type="hidden" name="method" value="Pay" />
				<input type="hidden" name="mobile" class="elemobile" />
				<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
				<div class="row align-center">	
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label>Pay Amount. *</label>
							<input type="text" class="form-control" maxlength="10" name="amount" id="pay_amt" value="" onkeypress="return isNumber(event)" required />
						</div>
					</div>
						
					<div class="col-md-12 col-sm-12">
						<div class="form-group">
							<label>Remark</label>
							<textarea class="form-control" name="remark" style="resize:none"></textarea>
						</div>
					</div>

					<div id="pmsg"></div>
					<div class="col-lg-12 p-t-20 text-center">
						<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink" id="ptnsubmit">Submit</button>
					</div>
				</div>		
					
				</form>
			</div>
		</div>

		</div>
	</div>
</div>

<div class="modal fade" id="elec_view">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Referral Electrician</h4>
			</div>
			<div class="modal-body">
			<div class="card-body">
			<div id="elerror"></div>
				<div class="row align-center">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
								<th>#</th>
								<th>Date</th>
								<th>Name</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>State</th>
								<th>City</th>
								<th>Address</th>
								<th>Cashback</th>
								<th>Status</th>
								<th>Action</th>
								</tr>
							</thead>
							<tbody id="displaydata1">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		</div>
	</div>
</div>

<div class="modal fade" id="cust_view">
	<div class="modal-dialog modal-lg" role="document" style="max-width:1200px!important;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Customer Details.</h4>
			</div>
			<div class="modal-body">
			<div class="card-body">
				<div id="cserror"></div>
				<div class="row align-center">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
								<th>#</th>
								<th>Product Name</th>
								<th>Electrician Name</th>
								<th>Electrician Mobile</th>
								<th>Customer Name</th>
								<th>Customer Mobile</th>
								<th>Install. Date</th>
								<th>Cashback</th>
								<th>City</th>
								<th>State</th>
								<th>Video</th>
								<th>Status</th>
								<th>Action</th>
								</tr>
							</thead>
							<tbody id="displaydata">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>

<div class="modal fade" id="video_view">
	<div class="modal-dialog" role="document" style="width:800px!important;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Customer Video</h4>
			</div>
			<div class="modal-body">
			<div class="card-body">
				<div class="row align-center">
					<video id="video" controls width='100%' height="350">
					  <source id="videosrc" src='' type='video/webm'>
					  Your browser does not support the video tag.
					</video>
				</div>
			</div>
		</div>

		</div>
	</div>
</div>
</html>