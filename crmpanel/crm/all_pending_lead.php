<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.lead.php';
include 'Model/class.user.php';
include 'Model/class.enquiry_status.php';
include 'Model/class.task_type.php';

include 'Model/class.followup_type.php';

$page="pending_lead";
include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_delete']!='Yes' and $page_permission['pg_view']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
$fr_date=(isset($_REQUEST['fr_date']) and $_REQUEST['fr_date'] !='')?$db->filterVar($_REQUEST['fr_date']):'';
$to_date=(isset($_REQUEST['to_date']) and $_REQUEST['to_date'] !='')?$db->filterVar($_REQUEST['to_date']):'';

?>
<!DOCTYPE html>
<html lang="en">
	<title>Pending Work sheet </title>
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
							<header>Your Pending Work Sheet</header>
						</div>
						<div class="card-body ">
						<form method="post">
							<div class="row">
							<div class="col-md-5 col-sm-6 col-6">
							</div>
								<div class="col-md-3 col-sm-6 col-6">
									<?php echo $error;?>
									<div class="form-group">
										<label>From Date. *</label>
										<div class="input-append date form_date" data-date-format="dd-mm-yyyy" data-date="<?php echo date("Y-m-d");?>">
											<input size="30" class="form-control" type="text" value="<?php echo ($fr_date=='')?date("d-m-Y"):date("d-m-Y",strtotime($fr_date));?>" name="fr_date" readonly="" required style="width:85%;float:left;" />
											<span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
											<span class="add-on"><i class="fa fa-calendar"></i></span>
										</div>
									</div>
								</div>
								<div class="col-md-3 col-sm-6 col-6">
									<?php echo $error;?>
									<div class="form-group ">
										<label>To Date. *</label>
										<div class="input-append date form_date" data-date-format="dd-mm-yyyy" data-date="<?php echo date("Y-m-d");?>">
											<input size="30" class="form-control" type="text" value="<?php echo ($to_date=='')?date("d-m-Y"):date("d-m-Y",strtotime($to_date));?>" name="to_date" readonly="" required style="width:85%;float:left;" />
											<span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
											<span class="add-on"><i class="fa fa-calendar"></i></span>
										</div>
									</div>
								</div>
								
								<div class="col-md-1 col-sm-6 col-6">
								<label>&nbsp;</label><br>
								<button type="submit" class="btn btn-primary btn-sm" >Go</button>
								</div>
							
							</div>
							</form>							
							
							<div class="table-scrollable">
								<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
									<thead>
										<tr>
											<th> S.No.</th>
											<th> Date</th>
											<th> Organization Name </th>
											<th> Address </th>
											<th> Mobile </th>
											<th> Objective</th>
											<th> Task Type </th>
											<th> Action Taken </th>
											<th> Entry For </th>
											<th> Action </th>
										</tr>
									</thead>
									<tbody id="displaydata">
								<?php
																
								if($_SESSION[SITE_NAME]['MICMP_usertype']=='Admin'){
									if($fr_date!=""){
									$qr=$db->exeQuery("select * from mi_lead_activity where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and date(plan_date)>='".date("Y-m-d",strtotime($fr_date))."' and date(plan_date)<='".date("Y-m-d",strtotime($to_date))."' and lead_action='Not Completed' and mi_status='Yes' order by plan_date desc");
									}else{
									$qr=$db->exeQuery("select * from mi_lead_activity where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and  date(plan_date)<='".date("Y-m-d")."' and lead_action='Not Completed' and mi_status='Yes' order by plan_date desc");
									}
									
									
								}else{
									if($fr_date!=""){
									$qr=$db->exeQuery("select * from mi_lead_activity where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and date(plan_date)>='".date("Y-m-d",strtotime($fr_date))."' and date(plan_date)<='".date("Y-m-d",strtotime($to_date))."' and lead_action='Not Completed' and plan_for='".$_SESSION[SITE_NAME]['MICMP_userid']."' and mi_status='Yes' order by plan_date desc");
									}else{
									$qr=$db->exeQuery("select * from mi_lead_activity where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."'  and  date(plan_date)<='".date("Y-m-d")."' and lead_action='Not Completed' and plan_for='".$_SESSION[SITE_NAME]['MICMP_userid']."' and mi_status='Yes' order by plan_date desc");
									}
								}
								
								$i=1;
								while($row=$qr->fetch_assoc())
								{
									$cq=$db->exeQuery("select * from mi_lead_address where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and lead_id='".$row['lead_id']."' and act_status='Yes' and mi_status='Yes'");
									if($cq->num_rows){
									$crow=$cq->fetch_assoc();
									$add=$crow['address'];
									}else{
									$cq=$db->exeQuery("select * from mi_lead where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$row['lead_id']."' and mi_status='Yes'");
									$crow=$cq->fetch_assoc();
									$add=$crow['address'];
									}
									$mq=$db->exeQuery("select * from mi_lead_contacts where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and lead_id='".$row['lead_id']."' and act_status='Yes' and mi_status='Yes'");
									if($mq->num_rows){
									$mrow=$mq->fetch_assoc();
									$mob=$mrow['fname']."-".$mrow['mobile'];
									}else{
									$mq=$db->exeQuery("select * from mi_lead where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and id='".$row['lead_id']."' and mi_status='Yes'");
									$mrow=$mq->fetch_assoc();
									$mob=$mrow['mobile'];
									}
									if($row['lead_action']=='Completed'){
									echo "<tr><td>".$i."</td><td>".date("d-m-Y",strtotime($row['plan_date']))." </td><td><a href='".BASE_PATH."Add_Lead/Edit/".$row['lead_id']."/' title='Edit'>".$objlead->lead_name($row['lead_id'])."</a></td><td>".$add."</td><td>".$mob."</td><td>".$row['act_taken']."</td><td> ".$objtask->task_type_name($row['act_type'])." </td> <td>".$row['plan_action']."</td><td>".$objuser->username($row['plan_for'])."</td><td>";
									
										echo "<label class='btn btn-disabled'>".$row['lead_action']."</label>";
									}else{
									echo "<tr><td>".$i."</td><td><input type='text' name='act_date' id='act_date".$row['id']."' autocomplete='off' data-required='1' class='dp1' size='10' value='".date("d-m-Y",strtotime($row['plan_date']))."' /> </td><td><a href='".BASE_PATH."Add_Lead/Edit/".$row['lead_id']."/' title='Edit'>".$objlead->lead_name($row['lead_id'])."</a></td><td>".$add."</td><td>".$mob."</td><td>".$row['act_taken']."</td><td><select id='act_type".$row['id']."'> ".$objtask->task_type_list($row['act_type'])."</select> </td> <td><textarea id='act".$row['id']."'></textarea></td><td>".$objuser->username($row['plan_for'])."</td><td>";	
									echo "<a href='#' class='btn btn-success btn-sm leadc' data-id='".$row['id']."' data-lead='".$row['lead_id']."' plan-for='".$row['plan_for']."' plan-date='".date("Y-m-d H:i:s")."' title='Update'>Lead Complete</a> <a href='#notiupdate' data-id='".$row['id']."' data-lead='".$row['lead_id']."' plan-for='".$row['plan_for']."' plan-date='".date("Y-m-d H:i:s")."' data-toggle='modal' class='btn btn-primary btn-sm leaduc' title='Lead For New Planning'>Lead Planning</a>"; 
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
	$("body").on("click",".leadc",function(e){
		var did=$(this).attr("data-id");
		var act=$("#act"+did).val();
		var act_date=$("#act_date"+did).val();
		var act_type=$("#act_type"+did).val();
		var lead=$(this).attr("data-lead");
		var plan_for=$(this).attr("plan-for");
		var plan_date=$(this).attr("plan-date");
		
		e.preventDefault();
		if(act==""){var cnf=confirm("Action Taken is Required");return false;}
		
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&plan_date="+plan_date+"&plan_action="+act+"&plan_act_type="+act_type+"&lead_id="+lead+"&edit_id="+did+"&plan_for="+plan_for+"&method=ActivityComplete";
		
		$(this).html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/LEAD/',
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
					setTimeout(function(){window.location.reload(true);},2500);
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
			url:'<?php echo BASE_PATH;?>Controller/PURCHASE/',
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
	$("body").on("click",".leaduc",function(e){
		e.preventDefault();
		var did=$(this).attr("data-id");
		var act=$("#act"+did).val();
		var act_date=$("#act_date"+did).val();
		var act_type=$("#act_type"+did).val();
		var lead=$(this).attr("data-lead");
		var plan_date=$(this).attr("plan-date");
		if(act==""){var cnf=confirm("Action Taken is Required");return false;}
		$("#up_date").addClass("form_datetime");
		$("#up_date").addClass("input-append");
		$("#edit_id").val(lead);
		$("#lead_id").val(did);
		$("#plan_date").val(plan_date);
		$("#plan_action").val(act);
		$("#plan_act_type").val(act_type);
		
	});
	$("#activity-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/LEAD/',
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
					$("#acmsg").html(response.message);
					setTimeout(function(){$("#acmsg").html('');},1500);
					setTimeout(function(){window.location.reload(true);},2500);
				}
				else
				{
					$("#acmsg").html(response.message);
					setTimeout(function(){$("#acmsg").html('');},1500);
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

</html>
<div class="modal fade" id="notiupdate" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document" style="">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="addEventTitle">Update Plan of Action</h4>
			</div>
			<div class="modal-body">
				<form id="activity-form" autocomplete="off" enctype="multipart/form-data">
					<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
					<input type="hidden" name="edit_id" id="edit_id" />
					<input type="hidden" name="lead_id" id="lead_id" />
					<input type="hidden" name="method" value="ActivityAdvUpdate" />
					<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
					<input type="hidden" name="plan_date" id="plan_date" />
					<input type="hidden" name="plan_action" id="plan_action" />
					<input type="hidden" name="plan_act_type" id="plan_act_type" />
					
					<div class="row">
					
					<div class="col-md-12">
						<div class="card-box">
						
						<div class="card-body">
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Plan Date / Time </label>
							<div class="col-md-8 col-sm-6 date form_datetime" data-date-format="dd-mm-yyyy h:m:s" data-date="<?php echo date("d-m-Y H:i:s");?>"  data-provide="datetimepicker-inline">
								<input size="30" class="form-control" type="text" value="<?php echo date("d-m-Y H:i:s");?>" name="act_date"  required style="width:85%;float:left;" />
								<span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
								<span class="add-on"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Update Plan of Action </label>
							<div class="col-md-8 col-sm-6">
								<select class="form-control select2" name="act_type" id="industry" >
								<?php echo $objfollowup->followup_type_list();?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-sm-6"> Action Taken</label>
							<div class="col-md-8 col-sm-6">
								<textarea class="form-control" name="act_taken"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Status </label>
							<div class="col-md-8 col-sm-6">
							<select class="form-control " name="enquiry_status" >
								<?php echo $objenqs->enquiry_status_list();?>
							</select> 
							
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Plan of Action For</label>
							<div class="col-md-8 col-sm-6">
								<select class="form-control select2" name="plan_for">
									<?php echo $objuser->user_list($_SESSION[SITE_NAME]['MICMP_userid']);?>
								</select>
							</div>
						</div>
						<div class="col-lg-12 p-t-20 text-center">
						<p id="acmsg"></p>
							<button type="submit" class="btn btn-pink">	Submit</button> &nbsp;
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