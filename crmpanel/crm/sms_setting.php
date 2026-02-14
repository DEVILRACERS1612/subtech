<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include './Model/class.user.php';

$page="sms_setting";
include 'config/page_permission_check.php';
if($_SESSION['MISCHOOL_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH.'/All_Class/');
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$user_id=(isset($_REQUEST['user_id']) and $_REQUEST['user_id'] !='')?$db->filterVar($_REQUEST['user_id']):'';

$qr=$db->exeQuery("select * from mi_sms_setting where school_id='".$_SESSION['MISCHOOL_schoolid']."' and sess_year='".$_SESSION['sess_year']."' and mi_status='Yes'");

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
		$vld_pg=explode(",",$arr[$i]['page_code']);
		
		if(in_array($pg,$vld_pg))
		{
			return true;
		}
	}
	return false;
}


/*	$msql=$db->exeQuery("select * from mi_module_assign where school_id='".$_SESSION['MISCHOOL_schoolid']."' and mi_status='Yes'");
	$mrow=$msql->fetch_assoc();
	$assign_module=$mrow['module_id'];
	$assign_feature=$mrow['feature_id'];
	$module=explode(",",$assign_module);
	$feature=explode(",",$assign_feature);
*/

?>
<!DOCTYPE html>
<html lang="en">
	<title>Manage SMS  </title>
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
                                    <header>SMS Setting for Page</header>
                                </div>
								
                                <div class="card-body " id="bar-parent2">
                                    <form id="act-form" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <input type="hidden" name="reseller_id" value="<?php echo $_SESSION['MI_reseller_id'];?>" />
										<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
										<input type="hidden" name="method" value="<?php echo $method;?>" />
										<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
										<!--<div class="row">
											<div class="col-md-12 col-sm-12">
												<div class="form-group">
													<label>Permission For User </label>
													<select class="form-control" name="user_id" required>
														<?php //echo $objuser->user_list($user_id);?>
													</select>
												</div>
											</div>
											 </div>-->
											
											<div class="row col-md-8">
											
											<div class="table-responsive" style=" border: 2px solid #adadad; margin-right: 10px;">
												<table class="table table-striped table-hover">
												<tr><th>Page </th><th>Set SMS Authority</th></tr>
												
												<tr><th>Login Page</th>
												<th>
													<div class="checkbox checkbox-icon-black">
													<input id="p1" class="main" type="checkbox" <?php echo (check_page($per,"login_page"))?"Checked":"";?> value="login_page" />
													<label class="mb-0" for="p1"> <span> Allow </b> </label>
													

													</div>
												</th>
												</tr>
												<tr><th>Student Admission Page</th>
												<th>
													<div class="checkbox checkbox-icon-black">
													<input id="p2" class="main" type="checkbox" <?php echo (check_page($per,"stu_admission_page"))?"Checked":"";?> value="stu_admission_page" />
													<label class="mb-0" for="p2"> <span> Allow </b> </label>
													

													</div>
												</th>
												</tr>
												
												<tr><th>Fee Submit Page</th>
												<th>
													<div class="checkbox checkbox-icon-black">
													<input id="p3" class="main" type="checkbox" <?php echo (check_page($per,"fee_submit_page"))?"Checked":"";?> value="fee_submit_page" />
													<label class="mb-0" for="p3"> <span> Allow </b> </label>
													</div>
												</th>
												</tr>
												
												<tr><th>Fee Outstanding Page</th>
												<th>
													<div class="checkbox checkbox-icon-black">
													<input id="p4" class="main" type="checkbox" <?php echo (check_page($per,"fee_outstanding_page"))?"Checked":"";?> value="fee_outstanding_page" />
													<label class="mb-0" for="p4"> <span> Allow </b> </label>
													</div>
												</th>
												</tr>
												<tr><th>Homework Page</th>
												<th>
													<div class="checkbox checkbox-icon-black">
													<input id="p5" class="main" type="checkbox" <?php echo (check_page($per,"homework_page"))?"Checked":"";?> value="homework_page" />
													<label class="mb-0" for="p5"> <span> Allow </b> </label>
													</div>
												</th>
												</tr>
												<tr><th>Send Link for Online payment</th>
												<th>
													<div class="checkbox checkbox-icon-black">
													<input id="p6" class="main" type="checkbox" <?php echo (check_page($per,"send_link"))?"Checked":"";?> value="send_link" />
													<label class="mb-0" for="p6"> <span> Allow </b> </label>
													</div>
												</th>
												</tr>
												
												</table>
											</div>
											<!--Institute Setting End -->
											
																						
											
											</div>
											
											
											<br>
											
											
											
											<br>
											
											
											
										<input type="hidden"  name="user_id" value="<?php echo $_SESSION['MISCHOOL_userid'];?>" />	
										<input type="hidden" id="vd_page" name="page" value="<?php echo $per['page_code'];?>" />
											
										<div class="row">	
										<div class="col-md-12 col-sm-12">
										<div><label>Set Allow SMS for Selected Page</label></div>
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


	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/SMS_SETTING/',
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>sms-setting/';},1500);
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
		$.each($("input[class='main']:checked"), function(){
			mod.push($(this).val());
		});
	$("#vd_page").val(mod);
	
	$("body").on("click",".main",function(){
		var mod=[];
		$.each($("input[class='main']:checked"), function(){
			mod.push($(this).val());
		});
		$("#vd_page").val(mod);
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

