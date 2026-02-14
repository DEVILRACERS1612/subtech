<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include './Model/class.user.php';

$page="user_role";
include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH.'/All_Class/');
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$user_id=(isset($_REQUEST['user_id']) and $_REQUEST['user_id'] !='')?$db->filterVar($_REQUEST['user_id']):'';

$qr=$db->exeQuery("select * from mi_role_rights where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and user_id='".$user_id."' and mi_status='Yes'");
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


?>
<!DOCTYPE html>
<html lang="en">
	<title>Manage User Permission </title>
<head>
<?php include 'config/head.php';?>
<style>
.ml-10{margin-left:10px;}
.mb-0{margin-bottom:0px;}
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
						<div class="col-md-12 col-sm-12">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Page Permission Assign to User</header>
                                   
                                
                                </div>
                                <div class="card-body " id="bar-parent2">
                                    <form id="act-form" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <input type="hidden" name="reseller_id" value="<?php echo $_SESSION[SITE_NAME]['MI_reseller_id'];?>" />
										<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
										<input type="hidden" name="method" value="<?php echo $method;?>" />
										<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
										<div class="row">
											<div class="col-md-12 col-sm-12">
												<div class="form-group">
													<label>Permission For User </label>
													<select class="form-control" name="user_id" required>
														<?php echo $objuser->user_list($user_id);?>
													</select>
												</div>
											</div>
											 </div>
											
											<div class="row col-md-12">
											<?php 
											
											if((check_module("setting",$module)))
											{
											?>
											<div class="table-responsive" style="width: 49%;float:left; border: 2px solid #adadad; margin-right: 10px;">
												<table class="table table-striped">
												<tr><th>Company Setting	</th><th>Permission</th></tr>
												
												<tr>
													<td>
													<div class="checkbox checkbox-icon-black">
													<input id="p4" class="main" data-val="4" type="checkbox" <?php echo (check_page($per,"company_profile"))?"Checked":"";?> value="company_profile" />
													<label class="mb-0" for="p4"> <span> Company Profile</b> </label>
													
													<input type="hidden" id="m4" name="page[]" value='<?php echo (check_page($per,"company_profile"))?"company_profile":"";?>' />
													
													</div>
													</td>  
													<td> 
													<div class="checkbox checkbox-icon-black">
														
														<input <?php echo (check_page_per($per,"company_profile","rr_create"))?"Checked":"";?> id="n4" class="check" data-id="ni4" type="checkbox" value="Yes" />
														<label class="mb-0" for="n4"><span>New</b></label> &nbsp; &nbsp;
														
														<input type="hidden" id="ni4" name="rr_create[]" value='<?php echo (check_page_per($per,"company_profile","rr_create"))?"Yes":"No";?>' />
														
														
														<input <?php echo (check_page_per($per,"company_profile","rr_edit"))?"Checked":"";?> id="e4" class="check" data-id="ei4" type="checkbox" value="Yes" />
														<label class="mb-0" for="e4"> <span> Edit</b> </label> &nbsp; &nbsp;
														
														<input type="hidden" id="ei4" name="rr_edit[]" value='<?php echo (check_page_per($per,"company_profile","rr_edit"))?"Yes":"No";?>' />
														
														<input <?php echo (check_page_per($per,"company_profile","rr_delete"))?"Checked":"";?> id="d4"  class="check" data-id="di4" type="checkbox" value="Yes" />
														<label class="mb-0" for="d4"> <span> Delete</b> </label> &nbsp; &nbsp;
														<input type="hidden" id="di4" name="rr_delete[]" value='<?php echo (check_page_per($per,"company_profile","rr_delete"))?"Yes":"No";?>' />
														
														<input <?php echo (check_page_per($per,"company_profile","rr_view"))?"Checked":"";?> id="v4" class="check" data-id="vi4" type="checkbox" value="Yes" />
														<label class="mb-0" for="v4"> <span> View</b> </label>
														<input type="hidden" id="vi4" name="rr_view[]" value='<?php echo (check_page_per($per,"company_profile","rr_view"))?"Yes":"No";?>' />
														
													</div>
													</td>
												</tr>
												
												
												
												
												
												<tr>
													<td>
													<div class="checkbox checkbox-icon-black">
													<input <?php echo (check_page($per,"user"))?"Checked":"";?> id="p0" class="main" data-val="0" type="checkbox" value="user" />
													<label class="mb-0" for="p0"> <span> User</b> </label>
													
													<input type="hidden" id="m0" name="page[]" value='<?php echo (check_page($per,"user"))?"user":"";?>' />
													
													</div>
													</td>  
													<td> 
													<div class="checkbox checkbox-icon-black">
													
													<input type="hidden" id="ni0" name="rr_create[]" value='<?php echo (check_page_per($per,"user","rr_create"))?"Yes":"No";?>' />
													<input type="hidden" id="ei0" name="rr_edit[]" value='<?php echo (check_page_per($per,"user","rr_edit"))?"Yes":"No";?>' />
													<input type="hidden" id="di0" name="rr_delete[]" value='<?php echo (check_page_per($per,"user","rr_delete"))?"Yes":"No";?>' />
													<input type="hidden" id="vi0" name="rr_view[]" value='<?php echo (check_page_per($per,"user","rr_view"))?"Yes":"No";?>' />
													
														<input <?php echo (check_page_per($per,"user","rr_create"))?"Checked":"";?> id="n0" type="checkbox" class="check" data-id="ni0"  value="Yes" />
														<label class="mb-0" for="n0"><span>New</b></label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"user","rr_edit"))?"Checked":"";?> id="e0" type="checkbox" class="check" data-id="ei0" value="Yes" />
														<label class="mb-0" for="e0"> <span> Edit</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"user","rr_delete"))?"Checked":"";?> id="d0" type="checkbox" class="check" data-id="di0" value="Yes" />
														<label class="mb-0" for="d0"> <span> Delete</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"user","rr_view"))?"Checked":"";?> id="v0" type="checkbox" class="check" data-id="vi0" value="Yes" />
														<label class="mb-0" for="v0"> <span> View</b> </label>
														
													</div>
													</td>
												</tr>
												
												
												<tr>
													<td>
													<div class="checkbox checkbox-icon-black">
													<input id="p01" class="main" data-val="01" type="checkbox" <?php echo (check_page($per,"user_role"))?"Checked":"";?> value="user_role" />
													<label class="mb-0" for="p01"> <span> User Role</b> </label>
													<input type="hidden" id="m01" name="page[]" value='<?php echo (check_page($per,"user_role"))?"user_role":"";?>' />
													</div>
													</td>  
													<td> 
													<div class="checkbox checkbox-icon-black">
													<input type="hidden" id="ni01" name="rr_create[]" value='<?php echo (check_page_per($per,"user_role","rr_create"))?"Yes":"No";?>' />
													<input type="hidden" id="ei01" name="rr_edit[]" value='<?php echo (check_page_per($per,"user_role","rr_edit"))?"Yes":"No";?>' />
													<input type="hidden" id="di01" name="rr_delete[]" value='<?php echo (check_page_per($per,"user_role","rr_delete"))?"Yes":"No";?>' />
													<input type="hidden" id="vi01" name="rr_view[]" value='<?php echo (check_page_per($per,"user_role","rr_view"))?"Yes":"No";?>' />
													
													
														<input id="n01" <?php echo (check_page_per($per,"user_role","rr_create"))?"Checked":"";?> type="checkbox" class="check" data-id="ni01"  value="Yes" />
														<label class="mb-0" for="n01"><span>New</b></label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"user_role","rr_edit"))?"Checked":"";?> id="e01" class="check" data-id="ei01" type="checkbox"   value="Yes" />
														<label class="mb-0" for="e01"> <span> Edit</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"user_role","rr_delete"))?"Checked":"";?> id="d01" class="check" data-id="di01" type="checkbox"   value="Yes" />
														<label class="mb-0" for="d01"> <span> Delete</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"user_role","rr_view"))?"Checked":"";?> id="v01" class="check" data-id="vi01" type="checkbox"   value="Yes" />
														<label class="mb-0" for="v01"> <span> View</b> </label>
														
													</div>
													</td>
												</tr>
												
												</table>
											</div>
											<!--Institute Setting End -->
											
											<?php 
											}
											if((check_module("inventory",$module)))
											{
											?>
											<!--Student Management Start -->
											<div class="table-responsive" style="width: 49%;float:left; border: 2px solid #adadad; margin-right: 10px;">
												<table class="table table-striped">
												<tr><th>Inventory Manage	</th><th>Permission</th></tr>
												
												<tr>
													<td>
													<div class="checkbox checkbox-icon-black">
													<input <?php echo (check_page($per,"billing"))?"Checked":"";?> id="p8" class="main" data-val="8" type="checkbox" value="billing" />
													<label class="mb-0" for="p8"> <span> Billing</b> </label>
													<input type="hidden" id="m8" name="page[]" value='<?php echo (check_page($per,"billing"))?"billing":"";?>' />
													
													</div>
													</td>  
													<td> 
													<div class="checkbox checkbox-icon-black">
													<input type="hidden" id="ni8" name="rr_create[]" value='<?php echo (check_page_per($per,"billing","rr_create"))?"Yes":"No";?>' />
													<input type="hidden" id="ei8" name="rr_edit[]" value='<?php echo (check_page_per($per,"billing","rr_edit"))?"Yes":"No";?>' />
													<input type="hidden" id="di8" name="rr_delete[]" value='<?php echo (check_page_per($per,"billing","rr_delete"))?"Yes":"No";?>' />
													<input type="hidden" id="vi8" name="rr_view[]" value='<?php echo (check_page_per($per,"billing","rr_view"))?"Yes":"No";?>' />
													
														<input <?php echo (check_page_per($per,"billing","rr_create"))?"Checked":"";?> id="n8" type="checkbox" class="check" data-id="ni8" value="Yes" />
														<label class="mb-0" for="n8"><span>New</b></label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"billing","rr_edit"))?"Checked":"";?> id="e8" type="checkbox" class="check" data-id="ei8" value="Yes" />
														<label class="mb-0" for="e8"> <span> Edit</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"billing","rr_delete"))?"Checked":"";?> id="d8" type="checkbox" class="check" data-id="di8" value="Yes" />
														<label class="mb-0" for="d8"> <span> Delete</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"billing","rr_view"))?"Checked":"";?> id="v8" type="checkbox" class="check" data-id="vi8" value="Yes" />
														<label class="mb-0" for="v8"> <span> View</b> </label>
														
													</div>
													</td>
												</tr>
												
												
												<tr>
													<td>
													<div class="checkbox checkbox-icon-black">
													<input id="p09" class="main" data-val="09" type="checkbox" <?php echo (check_page($per,"purchase"))?"Checked":"";?> value="purchase" />
													<label class="mb-0" for="p09"> <span> Purchase Item</b> </label>
													<input type="hidden" id="m09" name="page[]" value='<?php echo (check_page($per,"purchase"))?"purchase":"";?>' />
													
													</div>
													</td>  
													<td> 
													<div class="checkbox checkbox-icon-black">
													<input type="hidden" id="ni09" name="rr_create[]" value='<?php echo (check_page_per($per,"purchase","rr_create"))?"Yes":"No";?>' />
													<input type="hidden" id="ei09" name="rr_edit[]" value='<?php echo (check_page_per($per,"purchase","rr_edit"))?"Yes":"No";?>' />
													<input type="hidden" id="di09" name="rr_delete[]" value='<?php echo (check_page_per($per,"purchase","rr_delete"))?"Yes":"No";?>' />
													<input type="hidden" id="vi09" name="rr_view[]" value='<?php echo (check_page_per($per,"purchase","rr_view"))?"Yes":"No";?>' />
													
														<input id="n09" <?php echo (check_page_per($per,"purchase","rr_create"))?"Checked":"";?> type="checkbox" class="check" data-id="ni09" value="Yes" />
														<label class="mb-0" for="n09"><span>New</b></label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"purchase","rr_edit"))?"Checked":"";?> id="e09" type="checkbox" class="check" data-id="ei09"  value="Yes" />
														<label class="mb-0" for="e09"> <span> Edit</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"purchase","rr_delete"))?"Checked":"";?> id="d09" type="checkbox" class="check" data-id="di09" value="Yes" />
														<label class="mb-0" for="d09"> <span> Delete</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"purchase","rr_view"))?"Checked":"";?> id="v09" type="checkbox" class="check" data-id="vi09" value="Yes" />
														<label class="mb-0" for="v09"> <span> View</b> </label>
														
													</div>
													</td>
												</tr>
												<tr>
													<td>
													<div class="checkbox checkbox-icon-black">
													<input id="p10" class="main" data-val="10" type="checkbox" <?php echo (check_page($per,"stkitem"))?"Checked":"";?> value="stkitem" />
													<label class="mb-0" for="p10"> <span> Stock Item</b> </label>
													<input type="hidden" id="m10" name="page[]" value='<?php echo (check_page($per,"stkitem"))?"stkitem":"";?>' />
													</div>
													</td>  
													<td> 
													<div class="checkbox checkbox-icon-black">
													<input type="hidden" id="ni10" name="rr_create[]" value='<?php echo (check_page_per($per,"stkitem","rr_create"))?"Yes":"No";?>' />
													<input type="hidden" id="ei10" name="rr_edit[]" value='<?php echo (check_page_per($per,"stkitem","rr_edit"))?"Yes":"No";?>' />
													<input type="hidden" id="di10" name="rr_delete[]" value='<?php echo (check_page_per($per,"stkitem","rr_delete"))?"Yes":"No";?>' />
													<input type="hidden" id="vi10" name="rr_view[]" value='<?php echo (check_page_per($per,"stkitem","rr_view"))?"Yes":"No";?>' />
													
														<input id="n10" <?php echo (check_page_per($per,"stkitem","rr_create"))?"Checked":"";?> type="checkbox" class="check" data-id="ni10" value="Yes" />
														<label class="mb-0" for="n10"><span>New</b></label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"stkitem","rr_edit"))?"Checked":"";?> id="e10" type="checkbox" class="check" data-id="ei10" value="Yes" />
														<label class="mb-0" for="e10"> <span> Edit</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"stkitem","rr_delete"))?"Checked":"";?>  id="d10" class="check" data-id="di10" type="checkbox" value="Yes" />
														<label class="mb-0" for="d10"> <span> Delete</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"stkitem","rr_view"))?"Checked":"";?> id="v10" class="check" data-id="vi10" type="checkbox" value="Yes" />
														<label class="mb-0" for="v10"> <span> View</b> </label>
														
													</div>
													</td>
												</tr>
												<tr>
													<td>
													<div class="checkbox checkbox-icon-black">
													
													
													<input id="p12" class="main" data-val="12" type="checkbox" <?php echo (check_page($per,"party"))?"Checked":"";?> value="party" />
													<label class="mb-0" for="p12"> <span> Party Details</b> </label>
													<input type="hidden" id="m12" name="page[]" value='<?php echo (check_page($per,"party"))?"party":"";?>' />
													</div>
													</td>  
													<td> 
													<div class="checkbox checkbox-icon-black">
													<input type="hidden" id="ni12" name="rr_create[]" value='<?php echo (check_page_per($per,"party","rr_create"))?"Yes":"No";?>' />
													<input type="hidden" id="ei12" name="rr_edit[]" value='<?php echo (check_page_per($per,"party","rr_edit"))?"Yes":"No";?>' />
													<input type="hidden" id="di12" name="rr_delete[]" value='<?php echo (check_page_per($per,"party","rr_delete"))?"Yes":"No";?>' />
													<input type="hidden" id="vi12" name="rr_view[]" value='<?php echo (check_page_per($per,"party","rr_view"))?"Yes":"No";?>' />
														<input <?php echo (check_page_per($per,"party","rr_create"))?"Checked":"";?> id="n12" type="checkbox" class="check" data-id="ni12" value="Yes" />
														<label class="mb-0" for="n12"><span>New</b></label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"party","rr_edit"))?"Checked":"";?> id="e12" class="check" data-id="ei12" type="checkbox" value="Yes" />
														<label class="mb-0" for="e12"> <span> Edit</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"party","rr_delete"))?"Checked":"";?> id="d12" class="check" data-id="di12" type="checkbox" value="Yes" />
														<label class="mb-0" for="d12"> <span> Delete</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"party","rr_view"))?"Checked":"";?> id="v12" class="check" data-id="vi12" type="checkbox" value="Yes" />
														<label class="mb-0" for="v12"> <span> View</b> </label>
														
													</div>
													</td>
												</tr>
												
												<tr>
													<td>
													<div class="checkbox checkbox-icon-black">
													<input id="p13" class="main" data-val="13" type="checkbox" <?php echo (check_page($per,"category"))?"Checked":"";?> value="category" />
													<label class="mb-0" for="p13"> <span> Category</b> </label>
													<input type="hidden" id="m13" name="page[]" value='<?php echo (check_page($per,"category"))?"category":"";?>' />
													</div>
													</td>  
													<td> 
													<div class="checkbox checkbox-icon-black">
													<input type="hidden" id="ni13" name="rr_create[]" value='<?php echo (check_page_per($per,"category","rr_create"))?"Yes":"No";?>' />
													<input type="hidden" id="ei13" name="rr_edit[]" value='<?php echo (check_page_per($per,"category","rr_edit"))?"Yes":"No";?>' />
													<input type="hidden" id="di13" name="rr_delete[]" value='<?php echo (check_page_per($per,"category","rr_delete"))?"Yes":"No";?>' />
													<input type="hidden" id="vi13" name="rr_view[]" value='<?php echo (check_page_per($per,"category","rr_view"))?"Yes":"No";?>' />
													
														<input <?php echo (check_page_per($per,"category","rr_create"))?"Checked":"";?> id="n13" class="check" data-id="ni13"  type="checkbox" value="Yes" />
														<label class="mb-0" for="n13"><span>New</b></label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"category","rr_edit"))?"Checked":"";?> id="e13" class="check" data-id="ei13" type="checkbox" value="Yes" />
														<label class="mb-0" for="e13"> <span> Edit</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"category","rr_delete"))?"Checked":"";?> id="d13" class="check" data-id="di13" type="checkbox" value="Yes" />
														<label class="mb-0" for="d13"> <span> Delete</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"category","rr_view"))?"Checked":"";?> id="v13" type="checkbox" class="check" data-id="vi13" value="Yes" />
														<label class="mb-0" for="v13"> <span> View</b> </label>
														
													</div>
													</td>
												</tr>
												
												<tr>
													<td>
													<div class="checkbox checkbox-icon-black">
													<input id="p14" class="main" data-val="14" type="checkbox" <?php echo (check_page($per,"unit"))?"Checked":"";?> value="unit" />
													<label class="mb-0" for="p14"> <span> Unit</b> </label>
													<input type="hidden" id="m14" name="page[]" value='<?php echo (check_page($per,"unit"))?"unit":"";?>' />
													</div>
													</td>  
													<td> 
													<div class="checkbox checkbox-icon-black">
													<input type="hidden" id="ni14" name="rr_create[]" value='<?php echo (check_page_per($per,"unit","rr_create"))?"Yes":"No";?>' />
													<input type="hidden" id="ei14" name="rr_edit[]" value='<?php echo (check_page_per($per,"unit","rr_edit"))?"Yes":"No";?>' />
													<input type="hidden" id="di14" name="rr_delete[]" value='<?php echo (check_page_per($per,"unit","rr_delete"))?"Yes":"No";?>' />
													<input type="hidden" id="vi14" name="rr_view[]" value='<?php echo (check_page_per($per,"unit","rr_view"))?"Yes":"No";?>' />
													
														<input <?php echo (check_page_per($per,"unit","rr_create"))?"Checked":"";?> id="n14" class="check" data-id="ni14" type="checkbox" value="Yes" />
														<label class="mb-0" for="n14"><span>New</b></label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"unit","rr_edit"))?"Checked":"";?> id="e14" class="check" data-id="ei14" type="checkbox" value="Yes" />
														<label class="mb-0" for="e14"> <span> Edit</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"unit","rr_delete"))?"Checked":"";?> id="d14" class="check" data-id="di14" type="checkbox" value="Yes" />
														<label class="mb-0" for="d14"> <span> Delete</b> </label> &nbsp; &nbsp;
														<input <?php echo (check_page_per($per,"unit","rr_view"))?"Checked":"";?> id="v14" class="check" data-id="vi14" type="checkbox" value="Yes" />
														<label class="mb-0" for="v14"> <span> View</b> </label>
													</div>
													</td>
												</tr>
												</table>
												<!--End -->
											</div>
											<?php 
											}
											?>
											
											</div>
											
											
											<br>
											
											
											
											
											
											
											
												<br>
											
											
										
											

											
										<div class="row">	
										<div class="col-md-12 col-sm-12">
										<div><label>Check Permission which require</label></div>
										</div>
										</div>
										<div class="row">
										<div class="col-md-12 col-sm-12">
											<div class="form-group">
												<input name="submit" class="btn btn-primary" type="submit" value="Submit" />
											</div>
										</div>
                                        <div id="msg"></div>    
                                       </div>
                                    </form>
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

	<!-- end js include path -->
</body>


</html>
<script>
$(document).ready(function(){
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
	
	$("#act-form").on("submit",function(e){
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>All_User/';},1500);
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
					setTimeout(function(){$("#msg").html('');},1500);
				}	
			}
			
		});
	} );
	

	
	
	
	$("#cat").blur(function(){
		var str=$.trim($(this).val());
		str=str.replace(/[\._ ,+'"?&$@\/:-]+/g, " ").toLowerCase();
		str=$.trim(str);
		str=str.replace(/[\._ ,+'"?&$@\/:-]+/g, "-").toLowerCase();
		//str = str.replace(/\s+/g, '-').toLowerCase();
		
		$("#url").val(str);
		
	});
	
	
	var mod=[];
		$.each($("input[class='chk1']:checked"), function(){
			mod.push($(this).val());
		});
	$("#module").val(mod);
	
	$("body").on("click",".chk1",function(){
		var mod=[];
		$.each($("input[class='chk1']:checked"), function(){
			mod.push($(this).val());
		});
		$("#module").val(mod);
	});
	
	var feat=[];
		$.each($("input[class='chk2']:checked"), function(){
			feat.push($(this).val());
		});
	$("#feature").val(feat);
	
	$("body").on("click",".chk2",function(){
		var feat=[];
		$.each($("input[class='chk2']:checked"), function(){
			feat.push($(this).val());
		});
		$("#feature").val(feat);
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


<!-- Add New -->
<div class="modal fade" id="addreseller" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

