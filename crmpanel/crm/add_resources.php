<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.category.php';
$page="resources";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_resources where id='".$edit_id."' and mi_status='Yes'");
$row=$sql->fetch_assoc();


?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Resources | Subtech </title>
	<?php include 'config/head.php';?>
	<style>
	.pl-5{padding-left:4px!important; padding-right:4px!important;} 
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

                <div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default panel-admin">
                <div class="panel-heading"><h4>Upload New Resource</h4></div>
                <div class="panel-body p-20">
                    <form id="res-form" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="post_id" value="<?=$post_id?>" />
					<input type="hidden" name="method" value="Resource" />
					<input type="hidden" id="redit_id" name="edit_id" value="<?=$edit_id?>" />
					<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
                        <div class="form-group">
                            <label>Resource Name</label>
                            <input type="text" name="web_title" value="<?=$row['web_title']?>" class="form-control" placeholder="Enter Resource Title" required>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="cat_id" class="form-control" required>
                                        <?=$objcat->rcat_list($row['cat_id']);?>
                                    </select>
                                </div>
                            </div>
							<div class="col-md-1">
								<div class="form-group">
								<label>&nbsp;</label>
									<a href="#catModel" data-toggle="modal" id="addcat" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i></a>
								</div>
							</div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload File (PDF)</label>
                                    <input type="file" name="addfile" class="form-control" accept="pdf">
									<?php 
								if($row['addfile']){
									echo '<a href="'.BASE_PATH.'images/resource_img/'.$row['addfile'].'" target="_blank">Download</a>';
								}
								?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3"><?=$row['description']?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Image</label>
                                    <input type="file" name="photo" class="form-control" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-6">
								<?php 
								if($row['photo']){
									echo '<img src="'.BASE_PATH.'images/resource_img/'.$row['photo'].'"  style="width:100%"/>';
								}
								?>
                                <!--<div class="form-group">
                                    <label>Update Date</label>
                                    <input type="date" name="date" class="form-control">
                                </div>-->
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-upload">PUBLISH RESOURCES</button>
                    </form>
                </div>
            </div>
        </div>
		<div class="col-md-5">
		<div class="card-box">
			<div class="card-head">
				<header>All Resources </header>
			</div>
			<div class="card-body ">
		
		
		<div class="table-scrollable">
				<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="exportTable">
					<thead>
						<tr>
							<th>S.No.</th>
							<th> Resource Name  </th>
							<th> Category  </th>
							
							<th> Action </th>
						</tr>
					</thead>
					<tbody id="displaydata">
					<?php 
					$qr=$db->exeQuery("select a.*,b.cat_name from mi_resources a left join mi_rcat b on a.cat_id=b.id where a.mi_status='Yes' order by a.rdate desc");
					$i=1;
					while($row=$qr->fetch_assoc())
					{
						echo "<tr><td>".$i."</td><td>".$row['web_title']."</td><td>".$row['cat_name']."</td><td><a href='".BASE_PATH."Add-Resources/Edit/".$row['id']."' title='View / Edit'><i class='fa fa-pencil'></i></a> <a href='#' class='text-danger delme' data-id='".$row['id']."' title='Delete Me'><i class='fa fa-trash'></i></a></td></tr>";
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
	var per=<?php echo json_encode($page_permission);?>;
	var pgpmsn=JSON.stringify(per);
	$("body").on("submit","#res-form",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?=BASE_PATH;?>Controller/CATEGORY/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
				$('#preloader').hide();
				
				var response=(JSON.parse(data));
				$("#rmsg").html(response.message);
				if(response.type=="success")
				{
					$.toast({
						heading: 'Success',
						text: response.message,
						position: 'mid-center',
						stack: false,
						icon:'success'
					});
					setTimeout(function(){window.location='<?=BASE_PATH;?>Add-Resources';},1500);
				}else{
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
	});	
	$("body").on("submit","#cat_form",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?=BASE_PATH;?>Controller/CATEGORY/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
				$('#preloader').hide();
				
				var response=(JSON.parse(data));
				$("#rmsg").html(response.message);
				if(response.type=="success")
				{
					displayrcat();
					$.toast({
						heading: 'Success',
						text: response.message,
						position: 'mid-center',
						stack: false,
						icon:'success'
					});
					$("#cat_id").val("");
					$("#cat_form").trigger("reset");
				}else{
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
	});
	$("body").on("click",".editrcat",function(e){
		e.preventDefault();
		var did=$(this).attr("data-id");
		var dname=$(this).attr("data-name");
		$("#cat_id").val(did);
		$("#cat_name").val(dname);
		
	});
	$("body").on("click",".delrcat",function(e){
		var did=$(this).attr("data-id");
		var obj=$(this);
		var cnf=confirm("Are you want to delete this record");
		e.preventDefault();
		if(cnf==false){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&del_id="+did+"&method=DeleteRcat";
		
		$(obj).html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?=BASE_PATH;?>Controller/CATEGORY/',
			method:'post',
			data:datastr,
			success:function(data){
				$(obj).html("<i class='fa fa-pencil'></i>");
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
					setTimeout(function(){displayrcat();},2500);
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
					$("#rmsg").html('<span class="text-danger">'+response.message+'</span>');
				}	
			}
			
		});
	} );
	function displayrcat()
	{
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&method=DisplayRcat";
		$("#displayrcat").html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?=BASE_PATH;?>Controller/CATEGORY/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#displayrcat").html(response.message);
					//alert(response.message);
				}
			}
		});
	}
})
</script>

</body>

</html>

<div class="modal fade" id="catModel">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
				<h4 class="modal-title">Resources Category</h4>
			</div>
			<div class="modal-body">
			<div class="card-body">
				<form action="" method="post" id="cat_form">
				<input type="hidden" name="post_id" value="<?=$post_id?>" />
				<input type="hidden" name="method" value="ResourceCat" />
				<input type="hidden" id="cat_id" name="edit_id" value="<?=$edit_id?>" />
				<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label>Category Name :</label>
								<input type="text" id="cat_name" class="form-control only-text" value=""  name="cat_name" required >
							</div>
						</div>
						<div class="col-md-4">
						<div class="form-group">
								<label>&nbsp;</label>
							<button type="submit" class="btn btn-sm btn-primary btn-upload">Update Category</button>
						</div>
						</div>
					</div>
					<div id="rmsg"></div>
				</form>
				<div class="card-box">
				<div class="card-head">
					<header>All Resources Categories </header>
				</div>
				<div class="card-body ">
				<div class="row">
					<div class="table-scrollable">
						<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="">
							<thead>
								<tr>
									<th>S.No.</th>
									<th> Category  </th>
									<th> Action </th>
								</tr>
							</thead>
							<tbody id="displayrcat">
							<?php 
							$qr=$db->exeQuery("select * from mi_rcat where mi_status='Yes' order by cat_name");
							$i=1;
							while($rrow=$qr->fetch_assoc())
							{
								echo '<tr><td>'.$i.'.</td><td>'.$rrow['cat_name'].'</td><td><a href="#" class="btn btn-xs btn-primary editrcat" data-id="'.$rrow['id'].'" data-name="'.$rrow['cat_name'].'"><i class="fa fa-pencil"></i></a><a href="#" class="btn btn-xs btn-danger delrcat" data-id="'.$rrow['id'].'"><i class="fa fa-trash"></i></a></td></tr>';
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