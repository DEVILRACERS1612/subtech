<?php  
error_reporting(0);
session_start();
include 'config/login_check.php';
include 'config/config.inc.php';
include 'config/function.php';
$page="tc";

$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$q=$db->exeQuery("select * from mi_tc where id='".$edit_id."' ");
$row=$q->fetch_assoc();
$q1=$db->exeQuery("select * from mi_sys_user where user_id='".$row['user_id']."' ");
$row1=$q1->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ADD / EDIT TC </title>
	<?php include 'config/head.php';?>

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
									<header>New TC</header>
								
								</div>
								<div class="card-body " id="bar-parent2">
									<form method="post" action="" id="act-form" enctype="multipart/form-data">
									<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
									<div class="row">
										<div class="col-md-6 col-sm-6">
											
											<div class="form-group">
												<label>Title <span class="text-danger">*</span>(Use No space, for FileName)</label>
												<input type="text" class="form-control" placeholder="" name="title" required value="<?php echo $row['title'];?>" />
											</div>
																						
											<div class="form-group">
												<label>Description</label>
												<textarea class="form-control" name="description"><?php echo $row['description'];?></textarea>
											</div>

										</div>
										<div class="col-md-6 col-sm-6">
										<div class="row">
										<div class="col-md-8 col-sm-6">
											<div class="form-group">
												<label>Image </label>
												<input type="file" id="uploadinput1" class="form-control" name="image" accept="image/*" onchange="uploadimg('1');" />
											</div>
										</div>
										<div class="col-md-4 col-sm-6">
											<div class="form-group">
												<?php 
												if($row['image']!='')
												{
													echo '<img id="upload1" src="'.WEB_PATH.'school/images/tc_img/'.$row['image'].'" class="img-responsive" />';
												}else{
													echo '<img id="upload1" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
												}
												?>
												
												
											</div>
										</div>
										</div>
																			
										
										</div>
									</div>
									
									<div class="row">
									<div id="msg"></div>
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
	//alert("asdf");
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:"<?php echo BASE_PATH;?>Controller/TC/",
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>All_TC/';},500);
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