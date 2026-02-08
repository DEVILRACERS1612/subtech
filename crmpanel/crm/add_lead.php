<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.designation.php';
include 'Model/class.product.php';
include 'Model/class.industry.php';
include 'Model/class.source.php';
include 'Model/class.country.php';
include 'Model/class.user.php';
include 'Model/class.enquiry_status.php';
include 'Model/class.followup_type.php';

$page="lead";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
if($edit_id!=""){
	if($_SESSION[SITE_NAME]['MICMP_usertype']=='Admin'){
	$sql=$db->exeQuery("select * from mi_lead where id='".$edit_id."' and cmp_id='".$_SESSION[SITE_NAME]["MICMP_cmpid"]."' and mi_status='Yes'");
	}else{
	$sql=$db->exeQuery("select * from mi_lead where id='".$edit_id."' and cmp_id='".$_SESSION[SITE_NAME]["MICMP_cmpid"]."' and (user_id='".$_SESSION[SITE_NAME]['MICMP_userid']."' or executive='".$_SESSION[SITE_NAME]['MICMP_userid']."' or initiated_by='".$_SESSION[SITE_NAME]['MICMP_userid']."') and mi_status='Yes'");
	}
	if($sql->num_rows){
		$vrow=$sql->fetch_assoc();
	}else{
		header('Refresh:1;url='.BASE_PATH.'All_Lead');
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Sales New Lead </title>
	<?php include 'config/head.php';?>
<style>
#add{
/*display:none;*/
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
		<div class="col-md-12">
			<div class="card-box">
				<div class="card-head">
					<header>Enter New Sales Lead</header>
				</div>
				<form method="post" action="" id="act-form" enctype="multipart/form-data" autocomplete="off">
				<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
				<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
				<input type="hidden" name="method" value="<?php echo $method;?>" />
				<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
				<div class="card-body " id="bar-parent2">
					<div class="row">
					<div class="col-md-4">
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Lead Date. *</label>
						<div class="col-md-8 col-sm-6 input-append date form_date" data-date-format="dd-mm-yyyy" data-date="<?php echo date("Y-m-d");?>">
							<input size="30" class="form-control" type="text" value="<?php echo ($row['enq_date']=='')?date("d-m-Y"):date("d-m-Y",strtotime($row['enq_date']));?>" name="enq_date" readonly="" required style="width:85%;float:left;" />
							<span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
							<span class="add-on"><i class="fa fa-calendar"></i></span>
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Organization Name <span class="text-danger">*</span></label>
						<div class="col-md-8 col-sm-6">
						<input type="text" class="form-control" name="cmp_name" value="<?php echo $vrow['cmp_name'];?>" maxlength="80" required />
						
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Address </label>
						<div class="col-md-8 col-sm-6">
						<textarea class="form-control" maxlength="150" style="resize:none;" name="address"><?php echo $vrow['address'];?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Web URL </label>
						<div class="col-md-8 col-sm-6">
						<input type="url" class="form-control" name="web_url" value="<?php echo $vrow['web_url'];?>" maxlength="150"  />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Email </label>
						<div class="col-md-8 col-sm-6">
						<input type="email" class="form-control" name="email" value="<?php echo $vrow['email'];?>" maxlength="50"  />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Mobile </label>
						<div class="col-md-8 col-sm-6">
						<input type="text" class="form-control" name="mobile" value="<?php echo $vrow['mobile'];?>" maxlength="50"  />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Telephone </label>
						<div class="col-md-8 col-sm-6">
						<input type="text" class="form-control" name="telephone" value="<?php echo $vrow['telephone'];?>" maxlength="50"  />
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Product </label>
						<div class="col-md-8 col-sm-6">
						<select class="form-control select2" name="product[]" multiple>
							<?php echo $objproduct->item_list($vrow['product']);?>
						</select> 
						</div>
					</div>
					</div>
					<div class="col-md-4">
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Industry </label>
						<div class="col-md-8 col-sm-6">
						<select class="form-control select2" name="industry" id="industry" >
							<?php echo $objindustry->industry_list($vrow['industry']);?>
						</select> 
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Segment </label>
						<div class="col-md-8 col-sm-6">
						<select class="form-control " name="segment" id="segment" >
							<?php echo $objindustry->segment_list($vrow['industry'],$vrow['segment']);?>
						</select> 
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Source </label>
						<div class="col-md-8 col-sm-6">
						<select class="form-control " name="source" id="source">
							<?php echo $objsource->source_list($vrow['source']);?>
						</select> 
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Reference </label>
						<div class="col-md-8 col-sm-6">
						<select class="form-control " id="reference" name="reference" >
							<?php echo $objsource->reference_list($vrow['source'],$vrow['reference']);?>
						</select> 
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Order Expected In. </label>
						<div class="col-md-8 col-sm-6 input-append date form_date" data-date-format="dd-mm-yyyy" data-date="<?php echo date("Y-m-d");?>">
							<input size="30" class="form-control" type="text" value="<?php echo ($row['ext_date']=='')?date("d-m-Y"):date("d-m-Y",strtotime($row['ext_date']));?>" name="ext_date" readonly=""  style="width:85%;float:left;" />
							<span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
							<span class="add-on"><i class="fa fa-calendar"></i></span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Country </label>
						<div class="col-md-8 col-sm-6">
						<select class="form-control " id="country" name="country">
							<?php echo $objcountry->country_list($vrow['country']);?>
						</select> 
						
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">State </label>
						<div class="col-md-8 col-sm-6">
						<select class="form-control " id="state" name="state" >
							<?php echo $objcountry->state_list($vrow['country'],$vrow['state']);?>
						</select> 
						
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Location </label>
						<div class="col-md-8 col-sm-6">
						<select class="form-control select2" id="location" name="location" >
							<?php echo $objcountry->location_list($vrow['state'],$vrow['location']);?>
						</select> 
						
						</div>
					</div>
					
					</div>
					
					<div class="col-md-4">
					
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Tender Code</label>
						<div class="col-md-8 col-sm-6">
						<input type="text" class="form-control" name="tcode" value="<?php echo $vrow['tcode'];?>" maxlength="50"  />
						
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Pin-Code </label>
						<div class="col-md-8 col-sm-6">
						<input type="text" class="form-control" name="pincode" value="<?php echo $vrow['pincode'];?>" maxlength="6" onkeypress="return isNumber(event)" />
						</div>
					</div>
					<?php 
					$executive=($vrow['executive']=="")?$_SESSION[SITE_NAME]['MICMP_userid']:$vrow['executive'];
					?>
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Executive </label>
						<div class="col-md-8 col-sm-6">
						<select class="form-control " name="executive" required>
							<?php echo $objuser->user_list($executive);?>
						</select> 
						
						</div>
					</div>
					<?php 
					$initiated_by=($vrow['initiated_by']=="")?$_SESSION[SITE_NAME]['MICMP_userid']:$vrow['initiated_by'];
					?>
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Initiated by </label>
						<div class="col-md-8 col-sm-6">
						<select class="form-control " name="initiated_by" required>
							<?php echo $objuser->user_list($initiated_by);?>
						</select> 
						
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Status </label>
						<div class="col-md-8 col-sm-6">
						<select class="form-control " name="enquiry_status" >
							<?php echo $objenqs->enquiry_status_list($vrow['enquiry_status']);?>
						</select> 
						
						</div>
					</div>
				
					
				
				
					<div class="form-group row">
						<label class="col-md-4 col-sm-6">Remark </label>
						<div class="col-md-8 col-sm-6">
						<textarea class="form-control" name="remark"><?php echo $vrow['remark'];?></textarea>
						</div>
					</div>
									
					<div id="msg"></div>
					<div class="col-lg-12 p-t-20 text-center">
						<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">
						<?php if($edit_id!=""){  echo "Update";}else{ echo "Submit";}?>
						</button>
						
						<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default" onclick="window.location='<?php echo BASE_PATH;?>'">Cancel</button>
					</div>
					</div>
					</div>
					
				</div>
				</form>
				
			
			</div>
		</div>
		</div>
		<div class="row">
		<div class="col-md-12">
			<?php if($edit_id!=""){ ?>
			
			<div class="panel tab-border card-box" style="border:1px solid #333;">
			<header class="panel-heading panel-heading-gray custom-tab ">
				<ul class="nav nav-tabs btn-info">
					<li class="nav-item"><a href="#profile" data-toggle="tab" class="active">Profile & Others</a>
					</li>
					<li class="nav-item"><a href="#contacts" data-toggle="tab" class="">Contacts</a>
					</li>
					<li class="nav-item"><a href="#address" data-toggle="tab" class="">Address</a>
					</li>
					<li class="nav-item"><a href="#product" data-toggle="tab" class="">Product</a>
					</li>
					<li class="nav-item"><a href="#activity" data-toggle="tab" class="">Activities</a>
					</li>
					<li class="nav-item"><a href="#followup" data-toggle="tab" class="">Followup</a>
					</li>
					
				</ul>
			</header>
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane active" id="profile">
						<form id="profile-form" autocomplete="off">
						<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
						<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
						<input type="hidden" name="method" value="Profile" />
						<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
						<div class="row">
						<?php 
							$pfrow=$db->exeQuery("select * from mi_lead_profile where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and lead_id='".$edit_id."' and mi_status='Yes' order by id")->fetch_assoc();
							
						?>
						<div class="col-sm-6 col-md-4">
						<div class="form-group row">
							<label class="col-md-5 col-sm-6">Pan No. </label>
							<div class="col-md-7 col-sm-6">
								<input type="text" class="form-control" name="panno" value="<?php echo $pfrow['panno'];?>" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-5 col-sm-6">GSTIN. </label>
							<div class="col-md-7 col-sm-6">
								<input type="text" class="form-control" name="gstno" value="<?php echo $pfrow['gstin'];?>" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-5 col-sm-6">Registration No. </label>
							<div class="col-md-7 col-sm-6">
								<input type="text" class="form-control" name="regno" value="<?php echo $pfrow['regno'];?>" />
							</div>
						</div>
						
						</div>
						<div class="col-sm-6 col-md-4">
						<div class="form-group row">
							<label class="col-md-5 col-sm-6">Service Tax No. </label>
							<div class="col-md-7 col-sm-6">
								<input type="text" class="form-control" name="staxno" value="<?php echo $pfrow['staxno'];?>" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-5 col-sm-6">Fax No. </label>
							<div class="col-md-7 col-sm-6">
								<input type="text" class="form-control" name="faxno" value="<?php echo $pfrow['faxno'];?>" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-5 col-sm-6">Remark </label>
							<div class="col-md-7 col-sm-6">
								<textarea class="form-control" name="remark" style="resize:none;"><?php echo $pfrow['remark'];?></textarea>
							</div>
						</div>
						
						</div>
						
						<div class="col-sm-12 col-md-4">
						<div class="form-group row">
							<label class="col-md-3 col-sm-4">Deals in Product </label>
							<div class="col-md-9 col-sm-8">
								<input type="text" class="tags tags-input" data-type="tags" name="dealsin" value="<?php echo $pfrow['dealsin'];?>" placeholder="Multiple products press enter" />
							</div>
						</div>
						</div>
						<div class="col-md-12 text-center">
							<p id="pmsg"></p>
							<input type="submit" class="btn btn-primary" value="Update" />
						</div>
						</div>
						</form>
					</div>
					<div class="tab-pane" id="contacts">
				<form id="contact-form" autocomplete="off">
				<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
				<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
				<input type="hidden" name="method" value="Contacts" />
				<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
						<div class="row">
						<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
							<thead>
							<tr><th>Sr.No</th><th>Designation</th><th>Department</th><th>Title</th><th>First Name</th><th>Last Name</th><th>Mobile No.</th><th>Contact No</th><th>Email-ID</th><th>Action</th></tr>
							</thead>
							<tbody id="addmoredata">
							<?php 
							$cn=1;
							
							$cql=$db->exeQuery("select * from mi_lead_contacts where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and lead_id='".$edit_id."' and mi_status='Yes' order by id");
							if($cql->num_rows)
							{
								while($crow=$cql->fetch_assoc()){
								$sel=($crow['act_status']=='Yes')?"checked":"";
								echo '
								<tr>
								<td>'.$cn.'
								<input type="radio" name="p_cts" class="p_cts" data-id="'.$cn.'" '.$sel.' /> <input type="hidden" name="act_status[]" class="ctactstatus" id="ctactstatus'.$cn.'" value="'.$crow['act_status'].'" />
								</td>
								<td><select name="cdesig_id[]">
									<option value="">Select</option>
									'.$objdesignation->desig_list($crow['desig_id']).'
								</select></td>
								<td><select name="cdep_id[]">
									<option value="">Select</option>
									'. $objdesignation->department_list($crow['dep_id']).'
								</select></td>';
								?>
								<td><select name="ctitle[]">
									<option value="">Select</option>
									<option value="Mr." <?php echo ($crow['title']=='Mr.')?"selected":"";?> >Mr.</option>
									<option value="Mrs." <?php echo ($crow['title']=='Mrs.')?"selected":"";?>>Mrs.</option>
									<option value="Ms." <?php echo ($crow['title']=='Ms.')?"selected":"";?>>Ms.</option>
									<option value="Dr." <?php echo ($crow['title']=='Dr.')?"selected":"";?>>Dr.</option>
								</select></td>
								<?php 
								echo '<td><input name="cfname[]" size="10" value="'.$crow['fname'].'"  /></td>
								<td><input name="clname[]" size="10" value="'.$crow['lname'].'" /></td>
								<td><input name="cmobile[]" size="10" value="'.$crow['mobile'].'"  /></td>
								<td><input name="ccontact[]" size="10" value="'.$crow['contact'].'"  /></td>
								<td><input name="cemail[]" size="10" value="'.$crow['email'].'"  /></td>
								<td><a href="#">View</a></td>
								
							</tr>
									';
									$cn++;
								}
							}else{
							?>
							<tr>
								<td><?php echo $cn;?></td>
								<td>
								<select name="cdesig_id[]">
									<option value="">Select</option>
									<?php echo $objdesignation->desig_list();?>
								</select>
								</td>
								<td>
								<select name="cdepart_id[]">
									<option value="">Select</option>
									<?php echo $objdesignation->department_list();?>
								</select>
								</td>
								<td>
								<select name="ctitle[]">
									<option value="">Select</option>
									<option value="Mr.">Mr.</option>
									<option value="Mrs.">Mrs.</option>
									<option value="Ms.">Ms.</option>
									<option value="Dr.">Dr.</option>
									
								</select>
								</td>
								<td>
								<input name="cfname[]" size="10"  />
								</td>
								<td>
								<input name="clname[]"  size="10" />
								</td>
								<td>
								<input name="cmobile[]" size="10"  />
								</td>
								<td>
								<input name="ccontact[]" size="10"  />
								</td>
								<td>
								<input name="cemail[]" size="10"  />
								</td>
								<td>
								<a href="#">View</a>
								</td>
							</tr>
							<?php $cn++;} ?>
							</tbody>
							</table>
						</div>
						<p id="cmsg"></p>
						</div>
						<div class="col-md-12">
							<a href="#" id="addmore" class="btn btn-info">Add More</a>
							&nbsp; &nbsp; &nbsp; &nbsp; <button type="submit" id="csubmit" class="btn btn-primary">Save</button>
						</div>
						</div>
						</form>
					</div>
					<div class="tab-pane" id="address">
					
						<form id="address1-form" autocomplete="off">
						<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
						<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
						<input type="hidden" name="method" value="Address1" />
						<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
						<div class="row">
							
							<?php 
							$ad=1;
							
							$cql=$db->exeQuery("select * from mi_lead_address where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and lead_id='".$edit_id."' and mi_status='Yes' order by id");
							if($cql->num_rows)
							{
								?>
							
							<div class="col-md-12">
							<div class="table-responsive">	
							<table class="table table-striped table-hover">
							<thead>
							<tr><th>P.Add</th><th>Addresses</th><th>State</th><th>Location</th><th>Pin Code</th><th>GST No.</th></tr>
							</thead>
							<tbody>	
								<?php 
								while($crow=$cql->fetch_assoc()){
									$sel=($crow['act_status']=='Yes')?"checked":"";
									
								echo '<tr>
								<td><input type="radio" name="p_add" class="p_add" data-id="'.$ad.'" '.$sel.' /> <input type="hidden" name="act_status[]" class="actstatus" id="actstatus'.$ad.'" value="'.$crow['act_status'].'" /></td>
								<td><textarea name="address[]" class="form-control" style="resize:none;" required >'.$crow['address'].'</textarea></td>
								<td><select name="state_id[]" class="form-control select2 state" data-id="'.$ad.'">	
									'.$objcountry->state_list('',$crow['state']).'
								</select></td>
								<td><select id="loca'.$ad.'" name="location_id[]" class="form-control select2">
								'.$objcountry->location_list($crow['state'],$crow['location']).'
								</select></td>';
								echo '<td><input name="pin_code[]" class="form-control" value="'.$crow['pincode'].'"  /></td><td><input name="gstin[]" class="form-control" value="'.$crow['gstin'].'"  /></td>
								</tr>';
									$ad++;
								}
							?>
							</tbody>
							</table>
							</div></div>
							<div class="col-md-12 p-b-10 text-center">
							<p id="admsg1"></p>
							<button type="submit" class="btn btn-primary">Update</button>
							</div>
							<?php } else { ?>
							<div class="col-md-12 p-b-10 text-center">
							<h5>No any Address saved for this lead.</h5>
							</div>
					
							<?php }?>
							</div>
						</form>	
						<hr>
						<h4>Add New Address</h4>	
						<form id="address-form" autocomplete="off">
						<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
						<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
						<input type="hidden" name="method" value="Address" />
						
						<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
						<div class="row">
						<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
							<thead>
							<tr><th>Addresses <span class="text-danger">*</span></th><th>State</th><th>Location</th><th>Pin Code</th><th>GST No.</th><th></th></tr>
							</thead>
							<tbody>
							<tr>
								<td><textarea name="address[]" class="form-control" style="resize:none;" required ></textarea></td>
								<td>
								<select name="state_id[]" class="form-control  state" data-id="0">
									<?php echo $objcountry->state_list('','');?>
								</select>
								</td>
								<td>
								<select name="location_id[]" id="loca0" class="form-control ">
									<?php echo $objcountry->location_list('');?>
								</select>
								</td>
								<td><input name="pin_code[]" class="form-control" /></td>
								<td><input name="gstin[]" class="form-control" /></td>
								<td>
								<p id="admsg"></p>
								<button type="submit" id="adsubmit" class="btn btn-primary">Save</button>
								</td>
							</tr>
							</tbody>
							</table>
						</div>
						</div>
						</div>
						</form>
						
					</div>
					<div class="tab-pane" id="product">
					
					<form id="product-form" autocomplete="off" enctype="multipart/form-data">
						<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
						<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
						<input type="hidden" name="method" value="Products" />
						<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
						<div class="row">
						<div class="col-md-12">
							<div class="card-box">
							<div class="card-head">
							<?php
							$qtp=$db->exeQuery("select sum(total) as total from mi_lead_products where lead_id='".$edit_id."' and mi_status='Yes' and active_status='Yes'")->fetch_assoc();
							
							?>
								<h5>Total Quote Price : <input type="text" id="nettotal" value="<?php echo $qtp['total'];?>" readonly /> <!--<a href="#addproduct" data-toggle="modal" class="pull-right">Add Product</a>-->  </h5>
							</div>
							<div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead>
									<tr>
									<th>#</th><th>Product</th><th>Code</th><th>Description</th><th>Quote Price</th><th>Qty.</th><th>Total</th>
									</tr>
									</thead>
									<tbody>
									<?php
									$qry=$db->exeQuery("select * from mi_lead_products where lead_id='".$edit_id."' and mi_status='Yes'");
									if($qry->num_rows){
										$i=1;
										while($prows=$qry->fetch_assoc()){
											$prow=$objproduct->item_details($prows['prod_id']);
										?>
										<tr>
										<input type="hidden" id="act<?php echo $i;?>" name="act_status[]" value="<?php echo $prows['act_status'];?>" />
										<input type="hidden" name="product[]" value="<?php echo $prows['prod_id'];?>" />
										
										<td><input type="checkbox" id="chk<?php echo $i;?>" class="chk" data-id="<?php echo $i;?>" <?php echo ($prows['active_status']=='Yes')?"checked":"";?> /></td>
										<td><label for="chk<?php echo $i;?>"><?php echo $prow['item_name'];?></label></td>
										<td><?php echo $prow['i_code'];?></td>
										<td><?php echo $prow['description'];?></td>
										<td><input size="8" type="text" class="rate" name="rate[]" id="rate<?php echo $i;?>" data-id="<?php echo $i;?>" value="<?php echo $prows['rate'];?>" /></td>
										<td><input size="5" type="text" class="qty" name="qty[]" id="qty<?php echo $i;?>" data-id="<?php echo $i;?>" value="<?php echo $prows['qty'];?>" /></td>
										<td><input size="10" type="text" class="tot" name="total[]" id="tot<?php echo $i;?>" value="<?php echo $prows['total'];?>" readonly /></td>
										
										</tr>
										<?php 
										$i++;
										}
									}else if($vrow['product']!=""){
										$prd=explode(",",$vrow['product']);
										$i=1;
										foreach($prd as $prdval){
										$prows=$objproduct->item_details($prdval);
										?>
										<tr>
										<input type="hidden" id="act<?php echo $i;?>" name="act_status[]" value="" />
										<input type="hidden" name="product[]" value="<?php echo $prows['id'];?>" />
										
										<td><input type="checkbox" id="chk<?php echo $i;?>" class="chk" data-id="<?php echo $i;?>" /></td>
										<td><label for="chk<?php echo $i;?>"><?php echo $prows['item_name'];?></label></td>
										<td><?php echo $prows['i_code'];?></td>
										<td><?php echo $prows['description'];?></td>
										<td><input size="8" type="text" class="rate" name="rate[]" id="rate<?php echo $i;?>" data-id="<?php echo $i;?>" value="<?php echo $prows['rate'];?>" /></td>
										<td><input size="5" type="text" class="qty" name="qty[]" id="qty<?php echo $i;?>" data-id="<?php echo $i;?>" value="1" /></td>
										<td><input size="10" type="text" class="tot" name="total[]" id="tot<?php echo $i;?>" value="<?php echo $prows['rate'];?>" readonly /></td>
										
										</tr>
										<?php 
										$i++;
										}
									}
									
									?>
									</tbody>
								</table>
								<p id="pdmsg"></p>
								<input type="submit" class="btn btn-primary" value="Update" />
							</div>
							</div>
						</div>
						</div>
						</div>
					</form>
					
					</div>
					<div class="tab-pane" id="activity">
					<form id="activity-form" autocomplete="off" enctype="multipart/form-data">
					<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
					<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
					<input type="hidden" name="method" value="Activity" />
					<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
					<div class="row">
					<div class="col-md-6">
						<div class="card-box">
						<div class="card-head">
							<h4>Update Sales Call</h4>
						</div>
						<div class="card-body">
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Date. *</label>
							<div class="col-md-8 col-sm-6 input-append date form_date" data-date-format="dd-mm-yyyy" data-date="<?php echo date("Y-m-d");?>">
								<input size="30" class="form-control" type="text" value="<?php echo date("d-m-Y");?>" name="act_date" readonly="" required style="width:85%;float:left;" />
								<span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
								<span class="add-on"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Action Type. *</label>
							<div class="col-md-8 col-sm-6">
								<select class="form-control" name="act_type" >
								<?php echo $objfollowup->followup_type_list();?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Action Taken</label>
							<div class="col-md-8 col-sm-6">
								<textarea class="form-control" name="act_taken"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Attach File1 : <br>(doc & image file)</label>
							<div class="col-md-8 col-sm-6">
								<input type="file" class="form-control" name="file1" accept=".doc,.docx,.pdf,.xls,.xlsx,image/*" style="font-size:10px;" />	
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Attach File2 : <br>(doc & image file)</label>
							<div class="col-md-8 col-sm-6">
								<input type="file" class="form-control" name="file2" accept=".doc,.docx,.pdf,.xls,.xlsx,image/*" style="font-size:10px;"/>	
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Attach File3 : <br>(doc & image file)</label>
							<div class="col-md-8 col-sm-6">
								<input type="file" class="form-control" name="file3" accept=".doc,.docx,.pdf,.xls,.xlsx,image/*" style="font-size:10px;" />	
							</div>
						</div>
						
						</div>
						
						</div>
					</div>
					<div class="col-md-6">
						<div class="card-box">
						<div class="card-head">
							<h4>Update Diary Section </h4>
						</div>
						<div class="card-body">
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Plan Date / Time </label>
							<div class="col-md-8 col-sm-6 input-append date form_datetime" data-date-format="dd-mm-yyyy H:m:s" data-date="<?php echo date("d-m-Y H:i:s");?>">
								<input size="30" class="form-control" type="text" value="<?php echo date("d-m-Y H:i:s");?>" name="plan_date" readonly="" required style="width:85%;float:left;" />
								<span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
								<span class="add-on"><i class="fa fa-calendar"></i></span>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Plan Action Type. </label>
							<div class="col-md-8 col-sm-6">
								<select class="form-control " name="plan_act_type" id="industry" >
								<?php echo $objfollowup->followup_type_list();?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Plan of Action</label>
							<div class="col-md-8 col-sm-6">
								<textarea class="form-control" name="plan_action"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 col-sm-6">Plan of Action For</label>
							<div class="col-md-8 col-sm-6">
								<select class="form-control " name="plan_for">
									<?php echo $objuser->user_list($initiated_by);?>
								</select>
							</div>
						</div>
						<div class="col-lg-12 p-t-20 text-center">
						<p id="acmsg"></p>
							<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">
							<?php if($edit_id!=""){  echo "Update";}else{ echo "Submit";}?>
							</button>
						</div>
						
						</div>
						
						
						</div>
					</div>
					
					</div>
					
					</form>
						
					</div>
					<div class="tab-pane" id="followup">
						<div class="table-responsive">
							<table class="table table-striped table-hover">
							<thead>
							<tr><th>Sr.No</th><th>Action Date</th><th>Action Type</th><th>Action Taken</th><th>Plan Date</th><th>Plan Action Type</th><th>Plan of Action</th><th>Updated By</th><th>Files</th></tr>
							</thead>
							<tbody>
							<?php 
							$sql=$db->exeQuery("select * from mi_lead_activity where lead_id='".$edit_id."' and mi_status='Yes'");
							$i=1;
							while($frow=$sql->fetch_assoc())
							{
								$f1='';$f2='';$f3='';
								$f1=($frow['file1']!="")?'<a href="'.BASE_PATH.'images/lead_file/'.$frow['file1'].'" download>'.$frow['file1'].'</a>':'';
								$f2=($frow['file2']!="")?'<a href="'.BASE_PATH.'images/lead_file/'.$frow['file2'].'" download>'.$frow['file2'].'</a>':'';
								$f3=($frow['file3']!="")?'<a href="'.BASE_PATH.'images/lead_file/'.$frow['file3'].'" download>'.$frow['file3'].'</a>':'';
								
								echo '
								<tr><td>'.$i.'</td><td>'.date("d-M-Y",strtotime($frow['act_date'])).'</td><td>'.$objfollowup->followup_type_name($frow['act_type']).'</td><td>'.$frow['act_taken'].'</td><td>'.date("d-M-Y H:i:s",strtotime($frow['plan_date'])).'</td><td>'.$objfollowup->followup_type_name($frow['plan_act_type']).' </td><td>'.$frow['plan_action'].'</td><td>'.$objuser->username($frow['user_id']).'</td><td>'.$f1.' '.$f2.' '.$f3.'</td></tr>
								';
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
			
			
			
			<?php } ?>
		</div>
		
	</div>
</div>
</div>

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
	
	$("body").on("change","#industry",function(e){
		//alert("ok");
		e.preventDefault();
		var cat=$(this).val();
		var datastr="industry="+cat+"&pg_pmsn="+per1+"&post_id=<?php echo $post_id;?>&method=SearchSegment";
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/INDUSTRY/',
			type:'post',
			data:datastr,
			success:function(data){
				
				$('#preloader').hide();
				$("#segment").html(data);
				
			}
		});
	});
	$("body").on("change","#source",function(e){
		e.preventDefault();
		var cat=$(this).val();
		var datastr="source="+cat+"&pg_pmsn="+per1+"&post_id=<?php echo $post_id;?>&method=SearchReference";
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/SOURCE/',
			type:'post',
			data:datastr,
			success:function(data){
				
				$('#preloader').hide();
				$("#reference").html(data);
				
			}
		});
	});
	$("body").on("change","#country",function(e){
		e.preventDefault();
		var cat=$(this).val();
		var datastr="country="+cat+"&pg_pmsn="+per1+"&post_id=<?php echo $post_id;?>&method=SearchState";
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COUNTRY/',
			type:'post',
			data:datastr,
			success:function(data){
				
				$('#preloader').hide();
				$("#state").html(data);
				
			}
		});
	});
	$("body").on("change","#state",function(e){
		e.preventDefault();
		var cat=$(this).val();
		var datastr="state="+cat+"&pg_pmsn="+per1+"&post_id=<?php echo $post_id;?>&method=SearchLocation";
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COUNTRY/',
			type:'post',
			data:datastr,
			success:function(data){
				
				$('#preloader').hide();
				$("#location").html(data);
				
			}
		});
	});
	$("body").on("change",".state",function(e){
		e.preventDefault();
		var id=$(this).attr("data-id");
		var cat=$(this).val();
		var datastr="state="+cat+"&pg_pmsn="+per1+"&post_id=<?php echo $post_id;?>&method=SearchLocation";
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COUNTRY/',
			type:'post',
			data:datastr,
			success:function(data){
				$('#preloader').hide();
				$("#loca"+id).html(data);
				
			}
		});
	});
	
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
			url:'<?php echo BASE_PATH;?>Controller/LEAD/',
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
							
					
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>All_Lead/';},2000);
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
	$("#contact-form").on("submit",function(e){
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
				//alert(data);
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#cmsg").html(response.message);
					setTimeout(function(){$("#cmsg").html('');},1500);
				}
				else
				{
					$("#cmsg").html(response.message);
					setTimeout(function(){$("#cmsg").html('');},1500);
				}	
			}
			
		});
	} );
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
					$("#activity-form").trigger("reset");
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
	////////// Contacts ///////////
	var i=0<?php echo $cn;?>;
	$("#addmore").on("click", function(e){
		$(".ctactstatus").val("No");
		e.preventDefault();
		$("#addmoredata").append('<tr><td>'+i+' <input type="radio" name="p_cts" class="p_cts" data-id="'+i+'" checked /> <input type="hidden" name="act_status[]" class="ctactstatus" id="ctactstatus'+i+'" value="Yes" /> </td><td><select name="cdesig_id[]"><option value="">Select</option><?php echo $objdesignation->desig_list();?></select></td><td><select name="cdepart_id[]"><option value="">Select</option><?php echo $objdesignation->department_list();?></select></td><td><select name="ctitle[]"><option value="">Select</option><option value="Mr.">Mr.</option><option value="Mrs.">Mrs.</option><option value="Ms.">Ms.</option><option value="Dr.">Dr.</option></select></td><td><input name="cfname[]" size="10" /></td><td><input name="clname[]"  size="10" /></td><td><input name="cmobile[]" size="10" /></td><td><input name="ccontact[]" size="10" /></td><td><input name="cemail[]" size="10" /></td><td><a href="#">View</a></td></tr>');
		i++;
	});
	////////// Address ///////////
	var a=0<?php echo $ad;?>;
	$("#addmoreaddress").on("click", function(e){
		e.preventDefault();
		$("#addressdata").append('<tr><td>'+a+'</td><td><textarea name="address[]" class="form-control" style="resize:none;"></textarea><td><select name="state_id[]" class="form-control select2 state" data-id="'+a+'"><?php echo $objcountry->state_list("");?></select></td><td><select name="loca_id[]" class="form-control select2" id="loca'+a+'"><?php echo $objcountry->location_list("");?></select></td><td><input name="pincode[]" /></td><td><input name="gstin[]" /></td></tr>');
		a++;
		$('.select2, .select2-multiple').select2({
			theme: "bootstrap",
			placeholder: $(this).attr("placeholder")
		});
	});
	
	
	
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

<script>
$(document).ready(function(){
	$("body").on("click",".chk",function(e){
		var gtotal=0;
		var prop=$(this).prop("checked");
		var id=$(this).attr("data-id");
		if(prop==false){
			$("#act"+id).val("No");
			total(id);
		}
		$('.chk:checkbox:checked').each(function(){
			var cid=$(this).attr("data-id");
			$("#act"+cid).val("Yes");
			//gtotal += +$("#tot"+cid).val();
			total(cid);
		}); 
		//$("#nettotal").val(gtotal);
	});
	
	
	$("body").on("keyup",".qty,.rate",function(e){
		var id=$(this).attr("data-id");
		var prop=$("#chk"+id).prop("checked");
		if(prop==true){
			$("#act"+id).val("Yes");
			total(id);
		}
	});
	
	function total(id)
	{
		var drate=$("#rate"+id).val();
		var qty=$("#qty"+id).val();
		var total=gtotal=0;
		
		total=drate*qty;
		$("#tot"+id).val(total);
		
		var nettotal=0;
		$('.chk:checkbox:checked').each(function(){
			var cid=$(this).attr("data-id");
			//var cid=$("#chk"+id).attr("data-id");
			gtotal += +$("#tot"+cid).val();
		}); 
		/*$(".tot").each(function(){
			gtotal += +$(this).val();
		});*/	
		$("#nettotal").val(gtotal);
	}
	$("#product-form").on("submit",function(e){
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
				//$("#pdmsg").html(data);
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#pdmsg").html(response.message);
					setTimeout(function(){$("#pdmsg").html('');},1500);
					//$("#activity-form").trigger("reset");
				}
				else
				{
					$("#pdmsg").html(response.message);
					setTimeout(function(){$("#pdmsg").html('');},1500);
				}	
			}
			
		});
	} );
	$("#address-form").on("submit",function(e){
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
				//$("#admsg").html(data);
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#admsg").html(response.message);
					setTimeout(function(){window.location="<?php echo BASE_PATH;?>Add_Lead/Edit/<?php echo $edit_id;?>/#address";},1500);
					//$("#activity-form").trigger("reset");
				}
				else
				{
					$("#admsg").html(response.message);
					setTimeout(function(){$("#admsg").html('');},1500);
				}
			}
		});
	});
	
	$("body").on("click",".p_cts",function(e){
		var id=$(this).attr("data-id");
		$(".ctactstatus").val("No");
		$("#ctactstatus"+id).val("Yes");
		
	});
	$("body").on("click",".p_add",function(e){
		var id=$(this).attr("data-id");
		$(".actstatus").val("No");
		$("#actstatus"+id).val("Yes");
		
	});
	
	$("#address1-form").on("submit",function(e){
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
				//$("#admsg1").html(data);
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#admsg1").html(response.message);
					setTimeout(function(){window.location="<?php echo BASE_PATH;?>Add_Lead/Edit/<?php echo $edit_id;?>/#address";},1500);
					//$("#activity-form").trigger("reset");
				}
				else
				{
					$("#admsg1").html(response.message);
					setTimeout(function(){$("#admsg1").html('');},1500);
				}	
			}
			
		});
	} );
	$("#profile-form").on("submit",function(e){
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
				//$("#pmsg").html(data);
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#pmsg").html(response.message);
					setTimeout(function(){window.location="<?php echo BASE_PATH;?>Add_Lead/Edit/<?php echo $edit_id;?>/#profile";},1500);
					//$("#activity-form").trigger("reset");
				}
				else
				{
					$("#pmsg").html(response.message);
					setTimeout(function(){$("#pmsg").html('');},1500);
				}	
			}
			
		});
	} );
	
	
});
</script>


</body>

</html>

<div class="modal fade" id="addproduct" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addEventTitle">Add Product</h5>
			</div>
			<div class="modal-body">
				<form class="">
					<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Title</label>
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Title"
										name="title" id="title">
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Event Details</label>
								<textarea id="eventDetails" name="eventDetails"
									placeholder="Enter Details" class="form-control"></textarea>
							</div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke pr-0">
						<input type="submit" class="btn btn-round btn-primary" value="Add Product" />
						<button type="button" id="close" class="btn btn-danger" data-dismiss="modal"> Close </button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>