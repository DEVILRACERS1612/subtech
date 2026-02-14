<?php  
error_reporting(0);
session_start();
include 'config/login_check.php';
include 'config/config.inc.php';
include 'config/function.php';
$page="news";
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from nt_news where id='".$edit_id."' and nt_status='Yes'");
$row=$sql->fetch_assoc();
$tsql=$db->exeQuery("select * from nt_tags where news_id='".$edit_id."' and nt_status='Yes'");
$tags='';
while($tg=$tsql->fetch_assoc()){$tags.=$tg['tags'].",";}
$tags=rtrim($tags,",");


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ADD / EDIT Post </title>
	<?php include 'config/head.php';?>
	 <link href="<?php echo BASE_PATH;?>assets/plugins/jquery-tags-input/jquery-tags-input.css" rel="stylesheet">
	 <link href="<?php echo BASE_PATH;?>assets/plugins/summernote/summernote.css" rel="stylesheet">
	
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
							<div id="owl-demo2" class="owl-carousel">

								
								<?php 
									$gqr=$db->exeQuery("select * from nt_gallery where nt_status='Yes'");
									$i=1;
									while($grow=$gqr->fetch_assoc() )
									{
										echo '
										<div class="item">
										<img src="'.WEB_PATH.'images/galimg/'.$grow['image'].'" style="height:160px"  />
										</div>
										';
																
										$i++;
									}
								?>
								
								
								
							</div>

						</div>
					</div>
					
					
					
					<div class="row">
						<div class="col-sm-12">
							<div class="card-box">
								<div class="card-head">
									<header>New / Update Post </header>
									
								</div>
								
								<form method="post" id="act-form" enctype="multipart/form-data" >
								<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
								
								<div class="card-body" id="bar-parent2">
									<div class="row">
									<div class="col-md-9 col-sm-12">
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label>Select Category *</label>
											<select class="form-control" id="mcat" name="cat">
												<?php echo total_cat($row['cat']);?>
											</select> 
											
										</div>
									</div>
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label>Select Sub-Category *</label>
											<select class="form-control" id="scat"  name="subcat">
												<?php echo total_subcat($row['subcat']);?>
											</select> 
											
										</div>
									</div>
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
											<label>Post Title *</label>
											<input type="text" class="form-control" id="cat" name="title" value="<?php echo $row['title'];?>" required/>
											<input type="hidden" class="form-control" id="url" name="urlname" value="<?php echo $row['urlname'];?>" required/>
										</div>
									</div>
									<div class="col-md-12 col-sm-6">
										<div class="form-group">
										<label>Blog Content</label>
										<textarea name="news" id="summernote" cols="30" rows="10"><?php echo $row['news'];?></textarea>
										</div>
									</div>
									
									<div class="col-md-12 col-sm-6">
									<div class="row">
									<div class="col-md-9 col-sm-6">
										<div class="form-group">
											<label>Image </label>
											<input type="file" id="uploadinput1" class="form-control" name="image" accept="image/*" onchange="uploadimg('1');" <?php echo ($row['image']!='')?'':'required';?> />
										</div>
									</div>
									<div class="col-md-2 col-sm-6">
										<div class="form-group">
											<?php 
											if($row['image']!='')
											{
												echo '<img id="upload1" src="'.WEB_PATH.'images/newsimg/'.$row['image'].'" class="img-responsive" />';
											}else{
												echo '<img id="upload1" src="'.BASE_PATH.'images/noimage.png" class="img-responsive" />';
											}
											?>
											
											
										</div>
									</div>
									</div>
									</div>
									<div class="col-md-12 col-sm-6">
									 <div class="form-group">
										<label>Meta Title</label>
										<textarea  name="ntitle" class="form-control"><?php echo $row['ntitle'];?></textarea>
									</div>
									</div>
									<div class="col-md-12 col-sm-6">
									 <div class="form-group">
										<label>Meta Description</label>
										<textarea  name="ndes" class="form-control"><?php echo $row['ndes'];?></textarea>
									</div>
									</div>
									<div class="col-md-12 col-sm-6">
									 <div class="form-group">
										<label>Meta Keywords</label>
										<textarea  name="nkeywords" class="form-control"><?php echo $row['nkeywords'];?></textarea>
									</div>
									</div>
									<div class="col-md-12 col-sm-6">
									 <div class="form-group">
										<label>Tags (Use Enter Key for more tag)</label>
										<input type="text" name="tags" class="form-control tags tags-input" data-type="tags" value="<?php echo $tags;?>" />
									</div>
									</div>
									</div>
									<div class="col-md-3 col-sm-12">
										<div class="col-md-12">
										<div class="card-head">Category 1</div>
										<div class="card-body" style="max-height:200px;overflow-y:auto;">
											<?php
												$q1=$db->exeQuery("select * from am_category where am_status='Yes'");
												$ct1=1;
												$cq=$db->exeQuery("select cat_id from nt_cat where news_id='".$edit_id."' and nt_status='Yes'");
												$i=0;
												while($r=$cq->fetch_assoc()){$cr[$i]=$r['cat_id'];$i++;}
												while($c1=$q1->fetch_assoc() )
												{
													$chk=(in_array($c1['id'],$cr) )?'checked':'';
													echo '<div class="checkbox checkbox-red">
															<input id="cat'.$ct1.'" type="checkbox" value="'.$c1['id'].'" '.$chk.' class="chk1">
															<label for="cat'.$ct1.'"> '.$c1['cat'].' </label>
														</div>';
														$ct1++;
												}
											?>
											<input type="hidden" name="cat1" id="c1" value="" />
												
										</div>
										</div>
										<div class="col-md-12">
										<div class="card-head">Category 2</div>
										<div class="card-body" style="max-height:200px;overflow-y:auto;">
												<?php
												$q2=$db->exeQuery("select * from nt_subcategory where nt_status='Yes'");
												$ct2=1;
												$cq=$db->exeQuery("select scat_id from nt_subcat where news_id='".$edit_id."' and nt_status='Yes'");
												$i=0;
												while($r=$cq->fetch_assoc()){$cr2[$i]=$r['scat_id'];$i++;}
												while($c2=$q2->fetch_assoc() )
												{
													$chk=(in_array($c2['id'],$cr2) )?'checked':'';
													echo '<div class="checkbox checkbox-aqua">
															<input id="scat'.$ct2.'" type="checkbox" value="'.$c2['id'].'" '.$chk.' class="chk2">
															<label for="scat'.$ct2.'"> '.$c2['subcat'].' </label>
														</div>';
														$ct2++;
												}
											?>
											<input type="hidden" name="cat2" id="c2" value="" />
										</div>
										</div>
										<div class="col-md-12">
										<div class="card-head">Other Category </div>
										<div class="card-body" style="max-height:200px;overflow-y:auto;">
												<?php
												$q3=$db->exeQuery("select * from nt_othercategory where nt_status='Yes'");
												$ct3=1;
												$cq=$db->exeQuery("select ocat_id from nt_ocat where news_id='".$edit_id."' and nt_status='Yes'");
												$i=0;
												while($r=$cq->fetch_assoc()){$cr3[$i]=$r['ocat_id'];$i++;}
												while($c3=$q3->fetch_assoc() )
												{
													$chk=(in_array($c3['id'],$cr3) )?'checked':'';
													echo '<div class="checkbox checkbox-yellow">
															<input id="ocat'.$ct3.'" type="checkbox"  value="'.$c3['id'].'" '.$chk.' class="chk3">
															<label for="ocat'.$ct3.'"> '.$c3['cat'].' </label>
														</div>';
														$ct3++;
												}
											?>
											<input type="hidden" name="cat3" id="c3" value="" />	
										</div>
										</div>
										
									</div>
									<div id="msg"></div>
									<div class="col-lg-12 p-t-20 text-center">
										<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-pink">Submit</button>
										<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-default">Cancel</button>
									</div>
									
									</div>
								</div>
								</form>
								
							
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
		<script src="<?php echo BASE_PATH;?>assets/plugins/summernote/summernote.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/js/pages/summernote/summernote-data.js"></script>
		<script src="<?php echo BASE_PATH;?>assets/plugins/jquery-tags-input/jquery-tags-input.js"></script>
    <script src="<?php echo BASE_PATH;?>assets/plugins/jquery-tags-input/jquery-tags-input-init.js"></script>

		<!-- end footer -->
	</div>
<script>
$(document).ready(function(){
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/NEWS/',
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>All_news/';},500);
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