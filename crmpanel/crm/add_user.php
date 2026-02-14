<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
//error_reporting(E_ALL);
include 'config/function.php';
include 'Model/class.user.php';
include 'Model/class.designation.php';
include 'Model/class.branch.php';
include 'Model/class.region.php';

$page="user";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:0;url='.BASE_PATH);
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';

$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_user where id='".$edit_id."' and mi_status='Yes'");
$row=$sql->fetch_assoc();



?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add Employee </title>
	<?php include 'config/head.php';?>
</head>
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
				<div class="col-md-7">
					<div class="card card-box">
						<div class="card-head">
							<header>All Employees</header>
							<div class="btn-group pull-right" style="padding-right:10px; padding-bottom:5px;">
								<a href="<?php echo BASE_PATH;?>Add_User/" id="addRow" class="btn btn-primary">
									Add New Employee <i class="fa fa-plus"></i>
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
											<th>S.No.</th>
											<th> Employee Name </th>
											<th> Designation </th>
											<th> Mobile </th>
											<th> Action </th>
										</tr>
									</thead>
									<tbody id="displaydata">
									<?php
									//echo "select * from mi_user where cmp_id='".$_SESSION['MICMP_cmpid']."' and mi_status='Yes'";
									$qr=$db->exeQuery("select * from mi_user where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
									$i=1;
								while($row1=$qr->fetch_assoc())
								{
									echo "<tr><td>".$i."</td><td>".$row1['username']."</td><td>".$objdesignation->desig_name($row1['designation'])."</td><td>".$row1['mobile']."</td><td><a href='".BASE_PATH."Add_User/Edit/".$row1['id']."/' class='btn-sm btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i></a>  <!--<a href='".BASE_PATH."Add_User/Juniors/".$row1['id']."/' class='btn-sm btn-info btn-xs' title='Juniors'><i class='fa fa-users'></i></a>-->"; 
									if($row1['user_type']!='Admin'){
										echo "<a href='".BASE_PATH."Add_User/Auth/".$row1['id']."/' class='btn-sm btn-warning btn-xs' title='Update Permission'><i class='fa fa-lock'></i></a> <a class='btn-sm btn-danger btn-xs delme' data-id='".$row1['id']."'  title='Delete'><i class='fa fa-trash-o'></i></a>";
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
			
				<div class="col-sm-5">
				<?php if($method=="Auth"){
					?>
				<div class='card card-box'>
				<div class='card-head'><header>Modules Assign to <?php echo $objuser->username($edit_id);?></header></div><div class='card-body' id='bar-parent2'><a href='#' class='sa'>Select All / Clear All</a><br><br>
				<form id='auth-form' method='post' enctype='multipart/form-data' class='form-horizontal'>
				<input type='hidden' name='post_id' value='<?php echo $post_id;?>' />
				<input type='hidden' name='method' value='Authority' />
				<input type='hidden' name='emp_id' value='<?php echo $edit_id;?>' />
					
					<?php 
					
					
				$qr=$db->exeQuery("select * from mi_role_rights where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and emp_id='".$edit_id."' and mi_status='Yes'");
					$per=array();
					$a=0;
					while($row=$qr->fetch_assoc())
					{
						$per[$a]=$row;
						$a++;
					}

					function check_page($arr,$pg)
					{
						$n=count($arr);
						for($i=0;$i<$n;$i++)
						{
							if($arr[$i]['rr_page_code']==$pg)
							{
								return true;
							}
						}
						return false;
					}
					function check_page_per($arr,$pg,$per)
					{
						$n=count($arr);
						for($i=0;$i<$n;$i++)
						{
							if($arr[$i]['rr_page_code']==$pg and $arr[$i][$per]=='Yes')
							{
								return true;
							}
						}
						return false;
					}
				
				
					$msql=$db->exeQuery("select * from mi_module_assign where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and mi_status='Yes'");
					$mrow=$msql->fetch_assoc();
					$assign_module=$mrow['module_id'];
					$assign_feature=$mrow['feature_id'];
					$module=explode(",",$assign_module);
					$feature=explode(",",$assign_feature);
				
				$mq=$db->exeQuery("select * from mi_module where mi_status='Yes'");
				$i=1;
				while($mrow=$mq->fetch_assoc()){
				if(check_module($mrow['m_code'],$module))
				{
					
				?>
				<div class="table-responsive" style="border: 2px solid #adadad; margin:2px 5px;">
					<table class="table table-striped">
					<tr><th> <?php echo ucfirst($mrow['m_code']);?>	Module</th><th>Permission</th></tr>
					<?php 
					$fql=$db->exeQuery("select * from mi_feature where m_code='".$mrow['m_code']."' and mi_status='Yes'");
					while($frow=$fql->fetch_assoc()){
					?>
					<tr><input type="hidden" value="<?php echo $mrow['m_code'];?>" name="module[]" />
						<td>
						<div class="checkbox checkbox-icon-black">
						<input id="p<?php echo $i;?>" class="main" data-val="<?php echo $i;?>" type="checkbox" <?php echo (check_page($per,$frow['f_code']))?"Checked":"";?> value="<?php echo $frow['f_code'];?>" />
						<label class="mb-0" for="p<?php echo $i;?>"> <span> <?php echo ucfirst($frow['f_name']);?></b> </label>
						
						<input type="hidden" id="m<?php echo $i;?>" name="page[]" value='<?php echo (check_page($per,$frow['f_code']))?$frow['f_code']:"";?>' />
						
						</div>
						</td>  
						<td> 
						<div class="checkbox checkbox-icon-black">
							
							<input <?php echo (check_page_per($per,$frow['f_code'],"rr_create"))?"Checked":"";?> id="n<?php echo $i;?>" class="check" data-id="ni<?php echo $i;?>" type="checkbox" value="Yes" />
							<label class="mb-0" for="n<?php echo $i;?>"><span>New</b></label> &nbsp; &nbsp;
							
							<input type="hidden" id="ni<?php echo $i;?>" name="rr_create[]" value='<?php echo (check_page_per($per,$frow['f_code'],"rr_create"))?"Yes":"No";?>' />
							
							
							<input <?php echo (check_page_per($per,$frow['f_code'],"rr_edit"))?"Checked":"";?> id="e<?php echo $i;?>" class="check" data-id="ei<?php echo $i;?>" type="checkbox" value="Yes" />
							<label class="mb-0" for="e<?php echo $i;?>"> <span> Edit</b> </label> &nbsp; &nbsp;
							
							<input type="hidden" id="ei<?php echo $i;?>" name="rr_edit[]" value='<?php echo (check_page_per($per,$frow['f_code'],"rr_edit"))?"Yes":"No";?>' />
							
							<input <?php echo (check_page_per($per,$frow['f_code'],"rr_delete"))?"Checked":"";?> id="d<?php echo $i;?>"  class="check" data-id="di<?php echo $i;?>" type="checkbox" value="Yes" />
							<label class="mb-0" for="d<?php echo $i;?>"> <span> Delete</b> </label> &nbsp; &nbsp;
							<input type="hidden" id="di<?php echo $i;?>" name="rr_delete[]" value='<?php echo (check_page_per($per,$frow['f_code'],"rr_delete"))?"Yes":"No";?>' />
							
							<input <?php echo (check_page_per($per,$frow['f_code'],"rr_view"))?"Checked":"";?> id="v<?php echo $i;?>" class="check" data-id="vi<?php echo $i;?>" type="checkbox" value="Yes" />
							<label class="mb-0" for="v<?php echo $i;?>"> <span> View</b> </label>
							<input type="hidden" id="vi<?php echo $i;?>" name="rr_view[]" value='<?php echo (check_page_per($per,$frow['f_code'],"rr_view"))?"Yes":"No";?>' />
							
						</div>
						</td>
					</tr>
					<?php $i++; } ?>

					</table>
				</div>
				
				
				
				<?php 
				}
				}
				?>
				<div class='col-md-12 col-sm-12'>
				<div class='form-group'>
				<input name='submit' class='btn btn-primary' type='submit' value='Update Permission' />
				</div></div>
				</form>
				</div>
				
			<?php 
			}else{
			?>
					<div class="card card-box">
						<div class="card-head">
							<header>Add/Edit Employee Information</header>
						</div>
						<form class="form-horizontal" method="post" action="" id="act-form" enctype="multipart/form-data" autocomplete="off">
						<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
						<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
						<input type="hidden" name="method" value="<?php echo $method;?>" />
						<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
						
						<div class="card-body " id="bar-parent2">
						
						<input type="hidden" name="user_type" value="<?php echo ($row['user_type']!="")?$row['user_type']:'User';?>" />
						<div class="form-group row">
							<label class="col-md-3" for="emp_id">Username <span class="text-danger">*</span></label>
							<div class="col-md-9">
							<input type="text" id="emp_id" class="form-control" name="emp_id" value="<?php echo $row['emp_id'];?>" maxlength="50" required />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3" for="pwd">Password <span class="text-danger">*</span></label>
							<div class="col-md-9">
							<input type="text" id="pwd" class="form-control" name="pwd" value="<?php echo $row['pwd'];?>" maxlength="50" required />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3" for="username"> Name <span class="text-danger">*</span></label>
							<div class="col-md-9">	
							<input type="text" id="username" class="form-control" name="username" value="<?php echo $row['username'];?>" maxlength="50" required />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3" for="empcode"> Emp Code </label>
							<div class="col-md-9">	
							<input type="text" id="empcode" class="form-control" name="emp_code" value="<?php echo $row['emp_code'];?>" maxlength="50"  />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3" for="region"> Report To <span class="text-danger">*</span></label>
							<div class="col-md-9">
							<select class="form-control" id="region" name="region" required>
							<?php echo $objuser->report_to_list($row['report_to']);?>
							</select> 
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3" for="division"> Division <span class="text-danger">*</span></label>
							<div class="col-md-9">
							<select class="form-control" id="division" name="division" required>
							<option value="">-Select--</option>
							<option value="Sales" <?php echo ($row['division']=='Sales')?"selected":"";?> >Sales</option>
							<option value="Services" <?php echo ($row['division']=='Services')?"selected":"";?>>Services</option>
							<option value="Sales & Services" <?php echo ($row['division']=='Sales & Services')?"selected":"";?>>Sales & Services</option>
							
							</select> 
							</div>
						</div>
						<!--<div class="form-group row">
							<label class="col-md-3" for="region"> Region <span class="text-danger">*</span></label>
							<div class="col-md-9">
							<select class="form-control" id="region" name="region" required>
							<?php //echo $objregion->region_list($row['region']);?>
							</select> 
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3" for="region"> Branch <span class="text-danger">*</span></label>
							<div class="col-md-9">
							<select class="form-control" id="branch" name="branch" required>
							<?php //echo $objbranch->branch_list($row['region'],$row['branch']);?>
							</select> 
							</div>
						</div>-->
						<div class="form-group row">
							<label class="col-md-3" for="desig"> Designation <span class="text-danger">*</span></label>
							<div class="col-md-9">
							<select class="form-control" id="desig" name="designation" required>
							<?php echo $objdesignation->desig_list($row['designation']);?>
							</select> 
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3" for="doj"> Date of Joining. </label>
							<div class="col-md-9">
							<div class="input-append date form_date" data-date-format="dd-mm-yyyy" data-date="<?php echo date("Y-m-d");?>">
								<input id="doj" size="30" class="form-control" type="text" value="<?php echo ($row['doj']=='' or $row['doj']=='1970-01-01')?date("d-m-Y"):date("d-m-Y",strtotime($row['doj']));?>" name="doj" readonly="" style="width:85%;float:left;" />
								<span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
								<span class="add-on"><i class="fa fa-calendar"></i></span>
							</div>
							</div>			
						</div>
						
						
						
						<div class="form-group row">
							<label class="col-md-3" for="dob"> Date of Birth. </label>
							<div class="col-md-9">
							<div class="input-append date form_date" data-date-format="dd-mm-yyyy" data-date="<?php echo date("Y-m-d");?>">
								<input id="dob" size="30" class="form-control" type="text" value="<?php echo ($row['dob']=='' or $row['dob']=='1970-01-01')?date("d-m-Y",strtotime(date("d-m-Y")."-18 year")):date("d-m-Y",strtotime($row['dob']));?>" name="dob" readonly="" style="width:85%;float:left;" />
								<span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
								<span class="add-on"><i class="fa fa-calendar"></i></span>
							</div>
							</div>			
						</div>
						<div class="form-group row">
							<label class="col-md-3" for="gen"> Gender <span class="text-danger">*</span></label>
							<div class="col-md-9">
							<select class="form-control" id="gen" name="gender" required>
							<option value="">-Select--</option>
							<option value="Male" <?php echo ($row['gender']=='Male')?"selected":"";?> >Male</option>
							<option value="Female" <?php echo ($row['gender']=='Female')?"selected":"";?>>Female</option>
							</select> 
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3" for="exp">Experience</label>
							<div class="col-md-9">
							<input type="text" id="exp" class="form-control" name="experience" value="<?php echo $row['experience'];?>" maxlength="50" />
							
						</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3" for="email">Email <span class="text-danger">*</span></label>
							<div class="col-md-9">
							<input type="email" id="email" class="form-control" name="email" value="<?php echo $row['email'];?>" maxlength="50" required />
							
						</div>
						</div>
					<!---	<div class="form-group row">
							<label class="col-md-3" for="email1">Email 1 (Optional) </label>
							<div class="col-md-9">
							<input type="email" id="email1" class="form-control" name="email1" value="<?php echo $row['email1'];?>" maxlength="50"  />
							
						</div>
						</div>
					<div class="form-group row">
							<label class="col-md-3" for="email2">Email 2 (Optional)</label>
							<div class="col-md-9">
							<input type="email" id="email2" class="form-control" name="email2" value="<?php echo $row['email2'];?>" maxlength="50"  />
							
						</div>
						</div>
					--->
					<div class="form-group row">
							<label class="col-md-3" for="mobile">Mobile <span class="text-danger">*</span></label>
							<div class="col-md-9">
							<input type="text" id="mobile" class="form-control" name="mobile" value="<?php echo $row['mobile'];?>" maxlength="10" onkeypress="return isNumber(event)" required />
							
						</div>
					</div>
					<!--<div class="form-group row">
							<label class="col-md-3" for="phone">Phone (Optional)</label>
							<div class="col-md-9">
							<input type="text" id="phone" class="form-control" name="phone" value="<?php echo $row['phone'];?>" maxlength="20" onkeypress="return isNumber(event)" />
							
						</div>
					</div>-->
					
					<div class="form-group row">
						<label class="col-md-3" for="address">Address </label>
						<div class="col-md-9">
						<input type="text" id="address" class="form-control" name="address" value="<?php echo $row['address'];?>" maxlength="100"  />
						</div>
					</div>
					<!--<div class="form-group row">
						<label class="col-md-3" for="semail">SMTP Email <span class="text-danger">*</span></label>
						<div class="col-md-9">
						<input type="email" id="semail" class="form-control" name="smtp_email" value="<?php echo $row['smtp_email'];?>" maxlength="100" required />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3" for="semailpwd">SMTP Email Password <span class="text-danger">*</span></label>
						<div class="col-md-9">
						<input type="text" id="semailpwd" class="form-control" name="smtp_pwd" value="<?php echo $row['smtp_pwd'];?>" maxlength="100"  required />
						</div>
					</div>--->
					
					
					<div class="form-group row">
						<label class="col-md-3" for="uploadinput1">Image </label>
						<div class="col-md-7">
							<input type="file" id="uploadinput1" class="form-control" name="image" accept="image/*" onchange="uploadimg('1');" />
						</div>
						<div class="col-md-2">
						<div class="form-group">
							<?php 
							if($row['image']!='')
							{
								echo '<img id="upload1" src="'.BASE_PATH.'images/user_img/'.$row['image'].'" class="img-responsive" />';
							}else{
								echo '<img id="upload1" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
							}
							?>
						</div>
					</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3" for="detail">Other Detail </label>
						<div class="col-md-9">
						<textarea id="detail" class="form-control" name="other_detail"><?php echo $row['other_detail'];?></textarea>
						</div>
					</div>
					<div id="msg"></div>
					<div class="col-lg-12 p-t-20 text-center">
						<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Submit</button>
						<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Cancel</button>
					</div>

					</div>
					</form>

					</div>
					<?php } ?>
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
	$("body").on("click",".jnr",function(){
		var jnrs=[];
		$.each($("input[class='jnr']:checked"), function(){
			jnrs.push($(this).val());
			//alert($(this).val());
		});
		$("#juniors").val(jnrs);
		
	});
	////////////////////////////
	$("body").on("click",".sa",function(e){
		e.preventDefault();
		//$(".chk1").prop("checked",true);
		//$(".chk2").prop("checked",true);
		$(".main").trigger("click");
	});
	
	
$("body").on("click",".main",function(){
		var v=$(this).prop("checked");
		var d=$(this).attr("data-val");
		var v1=$(this).val();
		if(v==true)
		{
			$("#m"+d).val(v1);
			$("#n"+d).prop("checked",true);
			$("#e"+d).prop("checked",true);
			$("#d"+d).prop("checked",true);
			$("#v"+d).prop("checked",true);
		}else{
			$("#m"+d).val("");
			$("#n"+d).prop("checked",false);
			$("#e"+d).prop("checked",false);
			$("#d"+d).prop("checked",false);
			$("#v"+d).prop("checked",false);
		}
		$.each($("input[class='check']"), function(){
			var id=$(this).attr("data-id");
			var vi=$(this).prop("checked");
			if(vi==true)
			{
				$("#"+id).val("Yes");
			}else{
				$("#"+id).val("No");
			}
		});
		
	});
	
	$("body").on("click",".check",function(){
		var id=$(this).attr("data-id");
		var v=$(this).prop("checked");
		if(v==true)
		{
			$("#"+id).val("Yes");
		}else{
			$("#"+id).val("No");
		}
	});
	
	////////////////////////////////////
	var per=<?php echo json_encode($page_permission);?>;
	var per1=JSON.stringify(per);
	$("body").on("change","#region",function(e){
		var did=$(this).val();
		e.preventDefault();
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&region_id="+did+"&method=ViewBranchList";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/BRANCH/',
			method:'post',
			data:datastr,
			success:function(data){
				$("#branch").html(data);
			}
			
		});
	} );
	
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
	
	function display()
	{
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&method=View";
		
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/USER/',
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
			url:'<?php echo BASE_PATH;?>Controller/USER/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
				$('#preloader').hide();
				//alert(data);
				//$("#msg").html(data);
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Add_User/';},2000);
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
	$("#auth-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PERMISSION/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
				$('#preloader').hide();
				//alert(data);
				//$("#msg").html(data);
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Add_User/';},2000);
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
	$("#junior-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/USER/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
				$('#preloader').hide();
				//alert(data);
				//$("#msg").html(data);
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Add_User/';},2000);
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