<?php  
include 'config/config.inc.php';
include 'config/login_check.php';

include './Model/class.company.php';

$page="authority";
$cmp_id=(isset($_REQUEST['cmp_id']) and $_REQUEST['cmp_id'] !='')?$db->filterVar($_REQUEST['cmp_id']):'';
if(!empty($cmp_id))
{
	$q=$db->exeQuery("select * from mi_module_assign where cmp_id='".$cmp_id."' and mi_status='Yes' ");
	$row=$q->fetch_assoc();
	$module=$row['module_id'];
	$feature=$row['feature_id'];
	//header('Refresh:1;url='.BASE_PATH.'Manage_School/');
}
/*$act_id=(isset($_REQUEST['act_id']) and $_REQUEST['act_id'] !='')?$db->filterVar($_REQUEST['act_id']):'';
if(!empty($del_id))
{
	$q=$db->exeQuery("update nt_comment set nt_status='Yes' where id='".$act_id."' ");

	header('Refresh:1;url='.BASE_PATH.'All_comment/');
}*/


?>
<!DOCTYPE html>
<html lang="en">
	<title>Manage Company Authority </title>
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
                                    <header>Modules Assign to Company</header>
                                   
                                
                                </div>
                                <div class="card-body " id="bar-parent2">
                                    <form id="act-form" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <input type="hidden" name="reseller_id" value="<?php echo $_SESSION[SITE_NAME]['MI_reseller_id'];?>" />
										<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
									<input type="hidden" name="edit_id" value="" />
										<div class="row">
											<div class="col-md-12 col-sm-12">
											<div class="form-group">
												<label>Authority For Company </label>
												<select class="form-control" name="cmp_id">
												<?php echo $objcmp->cmp_list($cmp_id);?>
												</select>
											</div>
											</div>
										<?php 
										$m_array=explode(",",$module);
										$f_array=explode(",",$feature);
										
											$sql=$db->exeQuery("select * from mi_module where mi_status='Yes'");
											$i=0;$f=1;
											while($row=$sql->fetch_assoc())
											{
												$ch=(in_array($row['m_code'],$m_array ) )?"checked":'';
												echo '
												<div class="col-md-3 col-sm-3">
													<div class="checkbox checkbox-icon-black">
														<input id="checkbox'.$i.'" class="chk1" type="checkbox" name="" value="'.$row['m_code'].'" '.$ch.' />
														<label class="mb-0" for="checkbox'.$i.'"> <b> '.$row['m_name'].'</b> </label>
													';
												$fsql=$db->exeQuery("select * from mi_feature where m_code='".$row['m_code']."' and mi_status='Yes'");
												while($frow=$fsql->fetch_assoc())
												{
													$ch1=(in_array($frow['f_code'],$f_array ) )?"checked":'';
													echo '<div class="col-md-12 ml-10">
													<div class="checkbox checkbox-icon-black">
														<input id="fea'.$f.'" class="chk2" type="checkbox" name="" value="'.$frow['f_code'].'" '.$ch1.' />
													
													<label class="mb-0" for="fea'.$f.'"> '.$frow['f_name'].' </label>
													</div></div>';
													$f++;
												}

												
												echo '</div></div>
												';
												$i++;
											}
										?>
                                            <input type="hidden" id="module" name="module" value="<?php echo $module;?>" />
											<input type="hidden" id="feature" name="feature" value="<?php echo $feature;?>" />
											
										<div class="col-md-12 col-sm-12">
										<div><label>Check Modules which require</label></div>
										</div>
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
						
						<!----<div class="col-md-6 col-sm-6">
                            <div class="card card-box">
                                <div class="card-head">
                                    <header>Company detail</header>
                                    <button id="panel-button2" class="mdl-button mdl-js-button mdl-button--icon pull-right" data-upgraded=",MaterialButton">
                                        <i class="material-icons">more_vert</i>
                                    </button>
                                  
                                </div>
                                <div class="card-body " id="bar-parent2">
                                    <form>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <div class="checkbox checkbox-icon-black">
                                                    <input id="checkbox1" type="checkbox">
                                                    <label for="checkbox1">
                                                        Black Checkbox
                                                    </label>
                                                </div>
                                                <div class="checkbox checkbox-icon-yellow">
                                                    <input id="checkbox2" type="checkbox" checked="checked">
                                                    <label for="checkbox2">
                                                        Yellow Checkbox
                                                    </label>
                                                </div>
                                                <div class="checkbox checkbox-icon-red">
                                                    <input id="checkbox3" type="checkbox" checked="checked">
                                                    <label for="checkbox3">
                                                        Red Checkbox
                                                    </label>
                                                </div>
                                                <div class="checkbox checkbox-icon-aqua">
                                                    <input id="checkbox4" type="checkbox" checked="checked">
                                                    <label for="checkbox4">
                                                        Aqua Checkbox
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <input id="checkboxD1" type="checkbox" disabled="disabled">
                                                    <label for="checkboxD1">
                                                        Checkbox Disabled
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <input id="checkboxCD1" type="checkbox" checked="checked" disabled="disabled">
                                                    <label for="checkboxCD1">
                                                        Checkbox Checked &amp; Disabled
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <div class="checkbox checkbox-black">
                                                    <input id="checkboxbg1" type="checkbox" checked="checked">
                                                    <label for="checkboxbg1">
                                                        Black Checkbox
                                                    </label>
                                                </div>
                                                <div class="checkbox checkbox-yellow">
                                                    <input id="checkboxbg2" type="checkbox" checked="checked">
                                                    <label for="checkboxbg2">
                                                        Yellow Checkbox
                                                    </label>
                                                </div>
                                                <div class="checkbox checkbox-red">
                                                    <input id="checkboxbg3" type="checkbox" checked="checked">
                                                    <label for="checkboxbg3">
                                                        Red Checkbox
                                                    </label>
                                                </div>
                                                <div class="checkbox checkbox-aqua">
                                                    <input id="checkboxbg4" type="checkbox" checked="checked">
                                                    <label for="checkboxbg4">
                                                        Aqua Checkbox
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>--->
							
							
						
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
			url:'<?php echo BASE_PATH;?>Controller/AUTHORITY/',
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

