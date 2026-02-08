<?php 
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
require './Model/class.company.php';
$page="company";

$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_company where id='".$edit_id."' and mi_status='Yes'");
$row=$sql->fetch_assoc();
$sql1=$db->exeQuery("select * from mi_cmp_profile where cmp_id='".$row['cmp_id']."' and mi_status='Yes'");
$row1=$sql1->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Add New Company</title>
	<?php include 'config/head.php';?>
	<style>#l1,#l2{display:none;}</style> 
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
						<div class="col-md-12 col-sm-12">
							<div class="card card-box">
								<div class="card-head">
									<header>Add / Edit Company</header>
								</div>
								<div class="card-body " id="bar-parent2">
								<form id="act-form" method="post" enctype="multipart/form-data" class="form-horizontal" >

									<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
									<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<div class="form-group">
												<label>Company Name <span class="text-danger">*</span></label>
												<input type="text" value="<?php echo $row['cmp_name'];?>" class="form-control" placeholder="" name="cmp_name" required>
											</div>
											
											
											<div class="form-group">
												<label>Shift Manage <span class="text-danger">*</span></label>
												<select name="shift" class="form-control">
												<option value="No" <?php echo ($row1['shift']=='No')?"selected":"";?> >No</option>
												<option value="Yes" <?php echo ($row1['shift']=='Yes')?"selected":"";?>>Yes</option>
												</select>
												
											</div>
											<div class="form-group">
												<label>Company Link <span class="text-danger">*</span></label><br>
												<b style="font-size: 20px;"> https://www.microelectra.in/crmpanel/crmsoft/</b><input type="text" class="" value="<?php echo $row['cmp_id'];?>" placeholder="" name="cmp_id" style="width:30%;"  required>
											</div>
											<div class="form-group">
												<label>Primary Mobile No. <span class="text-danger">*</span></label>
												<input type="text" value="<?php echo $row['mobile'];?>" class="form-control" placeholder="" maxlength="10" name="mobile" required>
											</div>
											<div class="form-group">
												<label>Email <span class="text-danger">*</span></label>
												<input type="text" value="<?php echo $row['email'];?>" class="form-control" placeholder="" name="email" required>
											</div>
											
										<div class="form-group">
												<label>Company Registration No.</label>
												<input type="text" value="<?php echo $row['regno'];?>" class="form-control" placeholder="" name="regno">
											</div>
											
												
											<div class="form-group">
												<label>Company GST No.</label>
												<input type="text" value="<?php echo $row['gst_no'];?>" class="form-control" placeholder="" name="gst_no">
											</div>
											
											<div class="row">
												<div class="col-md-8 col-sm-6">
													<div class="form-group">
														<label>Company Logo </label>
														<input type="file" id="uploadinput1" class="form-control" name="image" accept="image/*" onchange="uploadimg('1');" />
													</div>
												</div>
												<div class="col-md-4 col-sm-6">
													<div class="form-group">
														<?php 
														if($row['image']!='')
														{
															echo '<img id="upload1" src="'.WEB_PATH.'crm/images/cmp_img/'.$row1['logo'].'" class="img-responsive" />';
														}else{
															echo '<img id="upload1" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
														}
														?>
														
														
													</div>
												</div>
											</div>
											
												
										
										</div>
										<div class="col-md-6 col-sm-6">
										
											<div class="form-group">
												<label>Full Address</label>
												<input type="text" class="form-control" placeholder="" value="<?php echo $row['address']; ?>" name="address">
											</div>
											<div class="form-group">
												<label>Password <span class="text-danger">*</span></label>
												<input type="text" value="<?php echo $row['cmp_pwd']; ?>" class="form-control" placeholder="" name="cmp_pwd">
											</div>
											
											<div class="form-group">
												<label>Other Contact No</label>
												<input type="text" value="<?php echo $row['other_contact']; ?>" class="form-control" placeholder="" name="other_contact">
											</div>
											<div class="form-group">
												<label>Other Email Ids</label>
												<input type="text" value="<?php echo $row['other_email']; ?>" class="form-control" placeholder="" name="other_email">
											</div>
											<div class="form-group">
												<label>Final Amount</label>
												<input type="text" value="<?php echo $row['amount']; ?>" class="form-control" placeholder="" name="amount">
											</div>
											<div class="form-group">
												<label>Exp. Date <span class="text-danger">*</span></label>
												<div class="input-append date form_date" data-date-format="dd-mm-yyyy" data-date="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+1 year"));?>">
                                                <input size="30" type="text" value="<?php echo ($row['exp_date']=='')?date("d-m-Y",strtotime(date("Y-m-d")."+1 year")):date("d-m-Y",strtotime($row['exp_date']));?>" name="exp_date" readonly="" required />
                                                <span class="add-on"><i class="fa fa-remove icon-remove"></i></span>
                                                <span class="add-on"><i class="fa fa-calendar"></i></span>
                                            </div>
											</div>
											<div class="form-group">
												<label>Annual Renewal</label>
												<input type="text" class="form-control" placeholder="" value="<?php echo $row['renew_amt']; ?>" name="renew_amt">
											</div>

										</div>
									</div>
									
									<div class="row">
									<div class="form-group">
											<div class="offset-md-6 col-md-6">
												<button type="submit" class="btn btn-info m-r-20">Submit</button>
												
											</div>
										</div>
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
<script>
$(document).ready(function(){
	$("#l1li").on("change",function(){
		var v=$(this).val();
		if(v=="New")
		{
			$(this).hide();
			$("#l1").show();
			$("#l1").focus();
		}
	} );
	$("#l2li").on("change",function(){
		var v=$(this).val();
		if(v=="New")
		{
			$(this).hide();
			$("#l2").show();
			$("#l2").focus();
		}
	} );
	
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/COMPANY/',
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
					setTimeout(function(){$("#msg").html('');},1500);
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>All_Company/';},500);
				}
				else
				{
					$("#msg").html(response.message);
					setTimeout(function(){$("#msg").html('');},1500);
				}	
			}
			
		});
	} );
	
	$("#mcat").on("change",function(e){
		e.preventDefault();
		$("#preloader").show();
		var c=$(this).val();
		var datastr="cat="+c+"&method=Findsubcat";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/SUBCAT/',
			type:'post',
			data:datastr,
			success:function(data){
				$('#preloader').hide();
				//alert(data);
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#scat").html(response.message);
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
	
	
	var cat=[];
		$.each($("input[class='chk1']:checked"), function(){
			cat.push($(this).val());
		});
	$("#c1").val(cat);
	
	$("body").on("click",".chk1",function(){
		var cat=[];
		$.each($("input[class='chk1']:checked"), function(){
			cat.push($(this).val());
		});
		$("#c1").val(cat);
	});
	
	var scat=[];
		$.each($("input[class='chk2']:checked"), function(){
			scat.push($(this).val());
		});
	$("#c2").val(scat);
	$("body").on("click",".chk2",function(){
		var scat=[];
		$.each($("input[class='chk2']:checked"), function(){
			scat.push($(this).val());
		});
		$("#c2").val(scat);
	});
	
	var ocat=[];
		$.each($("input[class='chk3']:checked"), function(){
			ocat.push($(this).val());
		});
	$("#c3").val(ocat);
	
	$("body").on("click",".chk3",function(){
		var ocat=[];
		$.each($("input[class='chk3']:checked"), function(){
			ocat.push($(this).val());
		});
		$("#c3").val(ocat);
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
</body>

</html>