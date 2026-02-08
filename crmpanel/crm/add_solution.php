<?php  
include 'config/config.inc.php';
//error_reporting(E_ALL);
include 'config/login_check.php';
include 'config/function.php';
include 'Model/class.category.php';
include 'Model/class.product.php';
$page="solution";

include 'config/page_permission_check.php';
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	header('Refresh:2;url='.BASE_PATH);
}
//print_r($page_permission);
$method=(isset($_REQUEST['method']) and $_REQUEST['method'] !='')?$db->filterVar($_REQUEST['method']):'New';
$edit_id=(isset($_REQUEST['edit_id']) and $_REQUEST['edit_id'] !='')?$db->filterVar($_REQUEST['edit_id']):'';
$sql=$db->exeQuery("select * from mi_solution where id='".$edit_id."' and mi_status='Yes'");
$row=$sql->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>ADD/EDIT Solutions  </title>
	<?php include 'config/head.php';?>
	<link href="<?php echo BASE_PATH;?>assets/plugins/summernote/summernote.css" rel="stylesheet">
	
	<style>
	#client_form,#prob_form,#sol_form,#wcu_form,#faq_form{display:none;}
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
						<div class="col-sm-7">
							<div class="card-box">
								<div class="card-head">
									<header>Add/Edit Solutions on Website </header>
									<div class="pull-right">
					<?php if($edit_id!=""){ ?>				
						<a href="#" id="client_btn" class="btn btn-sm btn-primary">Client</a>
						<a href="#" id="prob_btn" class="btn btn-sm btn-danger">Problem</a>
						<a href="#" id="sol_btn" class="btn btn-sm btn-success">Solution</a>
						<a href="#" id="wcu_btn" class="btn btn-sm btn-warning">WCU</a>
						<a href="#" id="faq_btn" class="btn btn-sm btn-info">FAQ</a>
						
					<?php } ?>			
									</div>
								</div>
		<div id="hero_form">
			
		<form method="post" action="" id="act-form" autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
		<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
		<input type="hidden" name="method" value="Solution" />
		<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
		<div class="card-body " id="bar-parent2">
			<div class="row">
			<label class="col-md-12"><b>Hero Form</b></label>
				<div class="col-md-6">
					<label  for="cat_id">Category <span>*</span></label>
					<div class="form-group">
						<select class="form-control ser" id="cat_id" name="cat_id">
							<?=$objcat->solcat_list($row['cat_id'])?>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<label for="subcat">Sub-Category <span>*</span></label>
					<div class="form-group">
						<select class="form-control ser" id="subcat" name="subcat_id">
							<?=$objcat->solsubcat_list($row['cat_id'],$row['subcat_id'])?>
						</select>
					</div>
				</div>
				
				<div class="col-md-12 col-sm-6 pt-3" style="border-top:1px solid #ccc;margin-top:20px;">
				<label><b> Hero Section </b></label>
					<div class="form-group">
						<label> Solutions Heading *</label>
						<input type="text" class="form-control" id="pname" maxlength="100" name="stitle" value="<?php echo $row['stitle'];?>"  />
						
					</div>
				</div>
			<div class="col-md-12 col-sm-6">
				<div class="form-group">
					<label> Short Description *</label>
					<textarea class="form-control" name="sdes"><?php echo $row['sdes'];?></textarea>
				</div>
			</div>	
			<div class="col-md-12 col-sm-6">
			<div class="row">
			<div class="col-md-4 col-sm-6">
				<div class="form-group">
					<label>Solutions Brochure (.pdf)</label>
					<input type="file" class="form-control" name="voucher" accept=".pdf"/>
				</div>
			</div>
			
			<div class="col-md-2"></div>
			<div class="col-md-4 col-sm-6">
				<div class="form-group">
					<label>Slider Image <br>(600 x 600 for best view)</label>
					<input type="file" id="uploadinput0" class="form-control" name="image" accept="image/*" onchange="uploadimg('0');" <?php echo ($row['image']!='')?'':'required';?> />
					<input type="text" id="" class="form-control" name="alttext" value="<?php echo $row['alttext'];?>" placeholder="Alt/Title Text" />
				</div>
			</div>
			<div class="col-md-2 col-sm-6">
				<div class="form-group">
					<?php 
					if($row['image']!='')
					{
						echo '<img id="upload0" src="'.WEB_PATH.'images/solution_img/'.$row['image'].'" class="img-responsive" />';
					}else{
						echo '<img id="upload0" src="'.BASE_PATH.'images/noimage1.png" class="img-responsive" />';
					}
					?>
				</div>
			</div>
			</div>
			</div>
			
			
			
			<div class="col-md-12 mb-3 pb-3" style="border-bottom:1px solid #ccc;">
			<label><input type="checkbox" name="calculator" value="Yes" <?=($row['calculator']=='Yes')?"Checked":"";?> /><b> Power Cut Calculator </b></label>
			
			</div>
					
			<div id="msg"></div>
			<div class="col-lg-12 p-t-20 text-center">
				<button type="submit" class="btn btn-pink">Submit</button>
				
			</div>
						
						
						
			</div>
		</div>
		</form>
		</div>
		
		<div id="client_form">						
		<form method="post" action="" id="client-form" autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
		<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
		<input type="hidden" name="data_id" value="<?php echo $data_id;?>" />
		<input type="hidden" name="method" value="Solution_client" />
		<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
		<div class="card-body " id="bar-parent2">
			<div class="row">
				<div class="col-md-12 mb-3 pt-3 pb-3" style="border-top:1px solid #ccc;margin-top:20px;border-bottom:1px solid #ccc;">
					<label><b> Client Detail </b></label>
					<div class="row">
						<div class="col-md-4"><label> Name</label></div>
						<div class="col-md-4"><label> Alttext</label></div>
						<div class="col-md-2"><label> Logo</label></div>
						<div class="col-md-2"><label> +/-</label></div>
					</div>
					<?php 
					if($edit_id!=""){
					$qr=$db->exeQuery("select * from mi_solution_client where data_id='".$edit_id."' and mi_status='Yes' order by id asc");
					$cl=50;
					while($prow=$qr->fetch_assoc()){
						?>
					<div class="row mb-3">
						<div class="col-md-4">
						<input type="hidden" name="edid[]" value="<?=$prow['id']?>" />
						<input type="text" class="form-control" name="clname[]" value="<?=$prow['clname']?>" />
						</div>
						<div class="col-md-4"><input type="text" class="form-control" name="alttext[]" value="<?=$prow['alttext']?>" /></div>
						<div class="col-md-2 col-sm-6">
							<div class="form-group">
								<?php 
								if($prow['climage']!='')
								{
									echo '<img id="upload'.$cl.'" src="'.WEB_PATH.'images/solution_img/'.$prow['climage'].'" class="img-responsive" />';
								}else{
									echo '<img id="upload'.$cl.'" src="'.BASE_PATH.'images/noimage1.png" class="img-responsive" />';
								}
								?>
								<input type="file" id="uploadinput<?=$cl?>" class="form-control" name="climage[]" accept="image/*" onchange="uploadimg('<?=$cl?>');" <?php echo ($row['image']!='')?'':'required';?> />
							</div>
						</div>
						<div class="col-md-1"><a href="#" data-id='<?=$prow['id']?>' class="btn btn-xs btn-danger removecl"><i class="fa fa-times"></i></a></div>
					</div>
						<?php 
						$cl++;
					}
					}
					?>
					
					<div class="row mb-3">
						<div class="col-md-4">
						<input type="hidden" name="edid[]" value="" />
						<input type="text" class="form-control" name="clname[]" />
						</div>
						<div class="col-md-4"><input type="text" class="form-control" name="alttext[]" /></div>
						<div class="col-md-2 col-sm-6">
							<div class="form-group">
								<?php 
									echo '<img id="upload1" src="'.BASE_PATH.'images/noimage1.png" class="img-responsive" />';
								?>
								<input type="file" id="uploadinput1" class="form-control" name="climage[]" accept="image/*" onchange="uploadimg('1');" <?php echo ($row['image']!='')?'':'required';?> />
							</div>
						</div>
						<div class="col-md-1"><a href="#" class="btn btn-xs btn-primary" id="addmore"><i class="fa fa-plus"></i></a></div>
					</div>
				<div id="moredata"></div>
			</div>
					
			<div id="clmsg"></div>
			<div class="col-lg-12 p-t-20 text-center">
				<button type="submit" class="btn  m-b-10 m-r-20 btn-pink">Submit</button>
				<button type="button" id="client_close" class="btn btn-default m-b-10 m-r-20">Close</button>
			</div>
						
						
						
			</div>
		</div>
		</form>
		</div>
		
		<div id="prob_form">						
		<form method="post" action="" id="prob-form" autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
		<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
		<input type="hidden" name="data_id" value="<?php echo $data_id;?>" />
		<input type="hidden" name="method" value="Solution_prob" />
		<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
		<div class="card-body " id="bar-parent2">
			<div class="row">
				<div class="col-md-12 mb-3 pb-3" style="border-bottom:1px solid #ccc;">
			<label><b> Problem Statement </b></label>
			<div class="row">
				<div class="col-md-12 col-sm-6">
					<div class="form-group">
						<label> Heading  *</label>
						<input type="text" class="form-control" maxlength="100" name="pf_title" value="<?php echo $row['pf_title'];?>"  />
					</div>
				</div>
				<div class="col-md-12 col-sm-6">
					<div class="form-group">
						<label> Short Description *</label>
						<textarea class="form-control" name="pfdes"><?php echo $row['pfdes'];?></textarea>
					</div>
				</div>	
			</div>
			
				<div class="row">
					<div class="col-md-4"><label> Reason</label></div>
					<div class="col-md-4"><label> Alttext</label></div>
					<div class="col-md-2"><label>Icon</label></div>
					<div class="col-md-2"><label> +/-</label></div>
				</div>
				<?php 
				if($edit_id!=""){
				$pb=500;
				$qr=$db->exeQuery("select * from mi_solution_prob where data_id='".$edit_id."' and mi_status='Yes' order by id asc");
				while($prow=$qr->fetch_assoc()){
					?>
				<div class="row mb-3">
					<div class="col-md-4">
					<input type="hidden" name="edid[]" value="<?=$prow['id']?>" />
					<input type="text" class="form-control" name="reason[]" value="<?=$prow['reason']?>" />
					</div>
					<div class="col-md-4"><input type="text" class="form-control" name="alttext[]" value="<?=$prow['alttext']?>" /></div>
					<div class="col-md-2 col-sm-6">
						<div class="form-group">
							<?php 
							if($prow['pbimage']!='')
							{
								echo '<img id="upload'.$pb.'" src="'.WEB_PATH.'images/solution_img/'.$prow['pbimage'].'" class="img-responsive" />';
							}else{
								echo '<img id="upload'.$pb.'" src="'.BASE_PATH.'images/noimage1.png" class="img-responsive" />';
							}
							?>
							<input type="file" id="uploadinput<?=$pb?>" class="form-control" name="pbimage[]" accept="image/*" onchange="uploadimg('<?=$pb?>');" <?php echo ($row['image']!='')?'':'required';?> />
						</div>
					</div>
					<div class="col-md-1"><a href="#" data-id="<?=$prow['id']?>" class="btn btn-xs btn-danger removepfal"><i class="fa fa-times"></i></a></div>
				</div>
					<?php 
					$pb++;
				}
				}
				?>
				
				<div class="row mb-3">
					<div class="col-md-4">
					<input type="hidden" name="edid[]" value="" />
					<input type="text" class="form-control" name="reason[]" />
					</div>
					<div class="col-md-4"><input type="text" class="form-control" name="alttext[]" /></div>
					<div class="col-md-2 col-sm-6">
						<div class="form-group">
							<?php 
							if($row['pbimage']!='')
							{
								echo '<img id="upload100" src="'.WEB_PATH.'images/solution_img/'.$row['pbimage'].'" class="img-responsive" />';
							}else{
								echo '<img id="upload100" src="'.BASE_PATH.'images/noimage1.png" class="img-responsive" />';
							}
							?>
							<input type="file" id="uploadinput100" class="form-control" name="pbimage[]" accept="image/*" onchange="uploadimg('100');" <?php echo ($row['image']!='')?'':'required';?> />
						</div>
					</div>
					<div class="col-md-1"><a href="#" class="btn btn-xs btn-primary" id="pfaddmore"><i class="fa fa-plus"></i></a></div>
					
				</div>
				<div id="pfmoredata">
				</div>
			</div>
					
			<div id="pbmsg"></div>
			<div class="col-lg-12 p-t-20 text-center">
				<button type="submit" class="btn  m-b-10 m-r-20 btn-pink">Submit</button>
				<button type="button" id="prob_close" class="btn btn-default m-b-10 m-r-20">Close</button>
			</div>
						
						
						
			</div>
		</div>
		</form>
		</div>
		
		<div id="sol_form">						
		<form method="post" action="" id="prob-form" autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
		<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
		<input type="hidden" name="data_id" value="<?php echo $data_id;?>" />
		<input type="hidden" name="method" value="Solution_sol" />
		<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
		<div class="card-body " id="bar-parent2">
			<div class="row">
			
			<div class="col-md-12 mb-3 pb-3" style="border-bottom:1px solid #ccc;">
			<label><b> Solution Detail </b></label>
			<div class="row">
				<div class="col-md-12 col-sm-6">
					<div class="form-group">
						<label> Solution Heading  *</label>
						<input type="text" class="form-control" maxlength="100" name="sol_title" value="<?php echo $row['sol_title'];?>"  />
					</div>
				</div>
				<div class="col-md-12 col-sm-6">
					<div class="form-group">
						<label> Short Description *</label>
						<textarea class="form-control" name="soldes"><?php echo $row['soldes'];?></textarea>
					</div>
				</div>
				<div class="col-md-12 col-sm-6">
				<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-4 col-sm-6">
					<div class="form-group">
						<label>Solution Image <br>(1200 x 400 for best view)</label>
						<input type="file" id="uploadinput00" class="form-control" name="solimage" accept="image/*" onchange="uploadimg('00');" <?php echo ($row['solimage']!='')?'':'required';?> />
						<input type="text" id="" class="form-control" name="solalttext" value="<?php echo $row['solalttext'];?>" placeholder="Alt/Title Text" />
					</div>
				</div>
				<div class="col-md-2 col-sm-6">
					<div class="form-group">
						<?php 
						if($row['solimage']!='')
						{
							echo '<img id="upload00" src="'.WEB_PATH.'images/solution_img/'.$row['solimage'].'" class="img-responsive" />';
						}else{
							echo '<img id="upload00" src="'.BASE_PATH.'images/noimage1.png" class="img-responsive" />';
						}
						?>
					</div>
				</div>
				</div>
				</div>
				
			</div>
			
				<div class="row">
					<div class="col-md-10"><label> Solution</label></div>
					
					<div class="col-md-2"><label> +/-</label></div>
				</div>
				<?php 
				if($edit_id!=""){
				$qr=$db->exeQuery("select * from mi_solution_sol where data_id='".$edit_id."' and mi_status='Yes'");
				while($prow=$qr->fetch_assoc()){
					?>
				<div class="row mb-3">
					<div class="col-md-10">
					<input type="hidden" name="edid[]" value="<?=$prow['id']?>" />
					<input type="text" class="form-control" name="solution[]" value="<?=$prow['solution']?>" />
					</div>
					
					<div class="col-md-1"><a href="#" class="btn btn-xs btn-danger removesol"><i class="fa fa-times"></i></a></div>
				</div>
					<?php 
				}
				}
				?>
				
				<div class="row mb-3">
					<div class="col-md-10">
					<input type="hidden" name="edid[]" value="" />
					<input type="text" class="form-control" name="solution[]" />
					</div>
					
					<div class="col-md-1"><a href="#" class="btn btn-xs btn-primary" id="soladdmore"><i class="fa fa-plus"></i></a></div>
					
				</div>
				<div id="solmoredata">
				</div>
			</div>
			
			<div id="solmsg"></div>
			<div class="col-lg-12 p-t-20 text-center">
				<button type="submit" class="btn  m-b-10 m-r-20 btn-pink">Submit</button>
				<button type="button" id="sol_close" class="btn btn-default m-b-10 m-r-20">Close</button>
			</div>
						
						
						
			</div>
		</div>
		</form>
		</div>
		
		<div id="wcu_form">						
		<form method="post" action="" id="prob-form" autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
		<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
		<input type="hidden" name="data_id" value="<?php echo $data_id;?>" />
		<input type="hidden" name="method" value="Solution_wcu" />
		<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
		<div class="card-body " id="bar-parent2">
			<div class="row">
			<div class="col-md-12 mb-3 pb-3" style="border-bottom:1px solid #ccc;">
			<label><b> Why Choose Us Detail </b></label>
			<div class="row">
				<div class="col-md-12 col-sm-6">
					<div class="form-group">
						<label> Heading  *</label>
						<input type="text" class="form-control" maxlength="100" name="wcu_title" value="<?php echo $row['wcu_title'];?>"  />
					</div>
				</div>
				<div class="col-md-12 col-sm-6">
					<div class="form-group">
						<label> Short Description *</label>
						<textarea class="form-control" name="wcudes"><?php echo $row['wcudes'];?></textarea>
					</div>
				</div>
				
			</div>
			
				<div class="row">
					<div class="col-md-10"><label> Reason</label></div>
					
					<div class="col-md-2"><label> +/-</label></div>
				</div>
				<?php 
				if($edit_id!=""){
				$qr=$db->exeQuery("select * from mi_solution_wcu where data_id='".$edit_id."' and mi_status='Yes'");
				while($prow=$qr->fetch_assoc()){
					?>
					<div class="row mb-3">
						<div class="col-md-10">
						<input type="text" class="form-control" name="reason[]" value="<?=$prow['reason']?>" />
						</div>
						<div class="col-md-1"><a href="#" class="btn btn-xs btn-danger removewcu"><i class="fa fa-times"></i></a></div>
					</div>
					<?php 
					}
				}
				?>
				
				<div class="row mb-3">
					<div class="col-md-10">
					<input type="hidden" name="edid[]" value="" />
					<input type="text" class="form-control" name="reason[]" />
					</div>
					<div class="col-md-1"><a href="#" class="btn btn-xs btn-primary" id="wcuaddmore"><i class="fa fa-plus"></i></a></div>
					
				</div>
				<div id="wcumoredata">
				</div>
			</div>
			
			
			<div id="wcumsg"></div>
			<div class="col-lg-12 p-t-20 text-center">
				<button type="submit" class="btn  m-b-10 m-r-20 btn-pink">Submit</button>
				<button type="button" id="wcu_close" class="btn btn-default m-b-10 m-r-20">Close</button>
			</div>
						
						
						
			</div>
		</div>
		</form>
		</div>	
		
		<div id="faq_form">						
		<form method="post" action="" id="prob-form" autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" name="post_id" value="<?php echo $post_id;?>" />
		<input type="hidden" name="edit_id" value="<?php echo $edit_id;?>" />
		<input type="hidden" name="data_id" value="<?php echo $data_id;?>" />
		<input type="hidden" name="method" value="Solution_faq" />
		<input type="hidden" name="pg_pmsn" value='<?php echo json_encode($page_permission);?>' />
		<div class="card-body " id="bar-parent2">
			<div class="row">
				<div class="col-md-12 mb-3 pb-3" style="border-bottom:1px solid #ccc;">
				<label><b> FAQ Detail </b></label>
				
					<?php 
					if($edit_id!=""){
					$qr=$db->exeQuery("select * from mi_solution_faq where data_id='".$edit_id."' and mi_status='Yes'");
					while($prow=$qr->fetch_assoc()){
						?>
						<div class="row mb-3">
							<div class="col-md-10">
							<input type="hidden" name="edid[]" value="<?=$prow['id']?>" />
							<input type="text" value="<?=$prow['faq']?>" class="form-control" name="faq[]" placeholder="Question" />
							<textarea type="text" class="form-control" name="ans[]" placeholder="Answer"><?=$prow['ans']?></textarea>
							</div>
							
							<div class="col-md-1"><a href="#" class="btn btn-xs btn-danger removefaq"><i class="fa fa-times"></i></a></div>
						</div>
							<?php 
						}
					}
					?>
					
					<div class="row mb-3">
						<div class="col-md-10">
						<input type="hidden" name="edid[]" value="" />
						<input type="text" class="form-control" name="faq[]" placeholder="Question" />
						<textarea type="text" class="form-control" name="ans[]" placeholder="Answer"></textarea>
						</div>
						<div class="col-md-1"><a href="#" class="btn btn-xs btn-primary" id="faqaddmore"><i class="fa fa-plus"></i></a></div>
						
					</div>
					<div id="faqmoredata">
					</div>
				</div>
			
			
			<div id="faqmsg"></div>
			<div class="col-lg-12 p-t-20 text-center">
				<button type="submit" class="btn  m-b-10 m-r-20 btn-pink">Submit</button>
				<button type="button" id="faq_close" class="btn btn-default m-b-10 m-r-20">Close</button>
			</div>
						
						
						
			</div>
		</div>
		</form>
		</div>	
		
		
		
		
		
		
			</div>
		</div>
		<div class="col-md-5">
		<div class="card-box">
		<div class="card-head">
			<header>All Solutions Category <button type="button" class="btn-primary btn-sm pull-right" onclick="window.location='<?=BASE_PATH?>Add_Wproduct'"> Add New </button> </header>
		</div>
		<div class="card-body ">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-6">
					<?php echo $error;?>
				</div>
				<div class="col-md-6 col-sm-6 col-6">
					</div>
				</div>
			</div>
			<div class="table-scrollable">
				<table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="exportTable">
					<thead>
						<tr>
							<th>S.No.</th>
							<th> Solutions  </th>
							<th> Action </th>
						</tr>
					</thead>
					<tbody id="displaydata">
					<?php 
					$qr=$db->exeQuery("select * from mi_solution where  mi_status='Yes'");
					$i=1;
					while($row=$qr->fetch_assoc())
					{
						echo "<tr><td>".$i."</td><td>".$row['stitle']."</td><td><a href='".BASE_PATH."Add_Solution/Edit/".$row['id']."/' class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></a><a class='btn btn-danger btn-xs delme' data-id='".$row['id']."'><i class='fa fa-trash-o '></i></a></td></tr>";
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
			<!-- end page content -->
			<!-- start chat sidebar -->
		
			<!-- end chat sidebar -->
		</div>
		<!-- end page container -->
		<!-- start footer -->
		<?php include 'config/footer.php';?>

<script src="<?php echo BASE_PATH;?>assets/plugins/summernote/summernote.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/pages/summernote/summernote-data.js"></script>		
		<!-- end footer -->
	</div>

<script>
$(document).ready(function(){
	$("#client_btn").on("click",function(e){
		e.preventDefault();
		$("#hero_form").hide();
		$("#prob_form").hide();
		$("#sol_form").hide();
		$("#wcu_form").hide();
		$("#client_form").show();
	});
	$("#prob_btn").on("click",function(e){
		e.preventDefault();
		$("#hero_form").hide();
		$("#client_form").hide();
		$("#sol_form").hide();
		$("#wcu_form").hide();
		$("#faq_form").hide();
		$("#prob_form").show();
		
	});
	$("#sol_btn").on("click",function(e){
		e.preventDefault();
		$("#hero_form").hide();
		$("#client_form").hide();
		$("#sol_form").show();
		$("#prob_form").hide();
		$("#wcu_form").hide();
		$("#faq_form").hide();
	});
	$("#wcu_btn").on("click",function(e){
		e.preventDefault();
		$("#hero_form").hide();
		$("#client_form").hide();
		$("#wcu_form").show();
		$("#prob_form").hide();
		$("#sol_form").hide();
		$("#faq_form").hide();
	});
	$("#faq_btn").on("click",function(e){
		e.preventDefault();
		$("#hero_form").hide();
		$("#client_form").hide();
		$("#wcu_form").hide();
		$("#prob_form").hide();
		$("#sol_form").hide();
		$("#faq_form").show();
	});
	$("#faq_close,#wcu_close,#sol_close,#prob_close,#client_close").on("click",function(e){
		e.preventDefault();
		$("#hero_form").show();
		$("#client_form").hide();
		$("#sol_form").hide();
		$("#wcu_form").hide();
		$("#faq_form").hide();
		$("#prob_form").hide();
	});
	
	
	
	
/////////////////////////////////////////////////////	
	var per=<?php echo json_encode($page_permission);?>;
	var per1=JSON.stringify(per);
	
	$("body").on("change","#cat_id",function(){
		//e.preventDefault();
		//var did=$(this).attr("data-id");
		var v=$(this).val();
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&cat_id="+v+"&method=FindSolsubcat";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/CATEGORY/',
			method:'post',
			data:datastr,
			success:function(data){
				//alert(data);
				var response=(JSON.parse(data));
				$("#subcat").html(response.message);
				//alert(response.message);
			}
		});
	} );
	
	$("body").on("change","#reqprd",function(){
		//e.preventDefault();
		var did=$(this).attr("data-id");
		var v=$(this).val();
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&pcode="+v+"&method=FindProductDetail";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PRODUCT/',
			method:'post',
			data:datastr,
			success:function(data){
				//alert(data);
				var response=(JSON.parse(data));
				
				$("#mrp").val(response.mrp);
				$("#url").val(response.url_name);
				$("#pname").val(response.pname);
				
				//alert(response.message);
				
			}
		});
	} );
	
	
	
	
});
</script>

<script>
$(document).ready(function(){
	var per=<?php echo json_encode($page_permission);?>;
	var pgpmsn=JSON.stringify(per);
	$("body").on("click",".delme",function(e){
		var did=$(this).attr("data-id");
		//var pgpmsn=$(this).attr("data-per");
		var cnf=confirm("Are you want to delete this record");
		e.preventDefault();
		if(cnf==false){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&del_id="+did+"&method=DeleteSolution";
		
		$(this).html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PRODUCT/',
			method:'post',
			data:datastr,
			success:function(data){
				//alert(data);
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
					setTimeout(function(){window.location.reload();},2500);
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
	} );
	
	function display()
	{
		var per=<?php echo json_encode($page_permission);?>;
		var per1=JSON.stringify(per);
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+per1+"&method=ViewBlog";
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/CATEGORY/',
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
//	var per=<?php echo json_encode($page_permission);?>;
//	var per1=JSON.stringify(per);
	$("#act-form").on("submit",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PRODUCT/',
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
					setTimeout(function(){window.location='<?php echo BASE_PATH;?>Add_Solution';},1500);
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
	} );
	$("body").on("submit","#client-form",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PRODUCT/',
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
					setTimeout(function(){window.location.reload();},1500);
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
	} );
	$("body").on("submit","#prob-form",function(e){
		e.preventDefault();
		$("#preloader").show();
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PRODUCT/',
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
					setTimeout(function(){window.location.reload();},1500);
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
	} );
	
	
	
	$("#pname").on("keyup",function(){
		var str=$.trim($(this).val());
		str=str.replace(/[\._ ,+'"?&$@\/:-]+/g, " ").toLowerCase();
		str=$.trim(str);
		str=str.replace(/[\._ ,+'"?&$@\/:-]+/g, "-").toLowerCase();
		//str = str.replace(/\s+/g, '-').toLowerCase();
		
		$("#url").val(str);
		
	});
	//////////////////
	var cl=2;
	$("body").on("click","#addmore",function(e){
		
		e.preventDefault();
		$("#moredata").append('<div class="row mb-3"><div class="col-md-4"><input type="hidden" name="edid[]" value="" /><input type="text" class="form-control" name="clname[]" /></div><div class="col-md-4"><input type="text" class="form-control" name="alttext[]" /></div><div class="col-md-2 col-sm-6"><div class="form-group"><img id="upload'+cl+'" src="<?=BASE_PATH?>images/noimage1.png" class="img-responsive" /><input type="file" id="uploadinput'+cl+'" class="form-control" name="climage[]" accept="image/*" onchange="uploadimg(\''+cl+'\');" /></div></div><div class="col-md-1"><a href="#" class="btn btn-xs btn-primary" id="addmore"><i class="fa fa-plus" title="Add More"></i></a> <a href="#" class="btn btn-xs btn-danger removeme" title="Remove Me"><i class="fa fa-times"></i></a></div></div>');
		cl++;
	});
	$("body").on("click",".removeme",function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
	});
	$("body").on("click",".removecl",function(e){
		var did=$(this).attr("data-id");
		var ob=$(this);
		var cnf=confirm("Do you want to delete this permanently");
		e.preventDefault();
		if(cnf==false){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&del_id="+did+"&method=DeleteSolutionClient";
		
		$(this).html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PRODUCT/',
			method:'post',
			data:datastr,
			success:function(data){
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
					setTimeout(function(){$(ob).parent().parent().remove();},500);
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
	} );
	
	////////PF//////////
	var pb=101;
	$("body").on("click","#pfaddmore",function(e){
		
		e.preventDefault();
		$("#pfmoredata").append('<div class="row mb-3"><div class="col-md-4"><input type="hidden" name="edid[]" value="" /><input type="text" class="form-control" name="reason[]" /></div><div class="col-md-4"><input type="text" class="form-control" name="alttext[]" /></div><div class="col-md-2 col-sm-6"><div class="form-group"><img id="upload'+pb+'" src="<?=BASE_PATH?>images/noimage1.png" class="img-responsive" /><input type="file" id="uploadinput'+pb+'" class="form-control" name="pbimage[]" accept="image/*" onchange="uploadimg(\''+pb+'\');" /></div></div><div class="col-md-1"><a href="#" class="btn btn-xs btn-primary" id="pfaddmore"><i class="fa fa-plus" title="Add More"></i></a> <a href="#" class="btn btn-xs btn-danger removepf" title="Remove Me"><i class="fa fa-times"></i></a></div></div>');
		pb++;
	});
	$("body").on("click",".removepf",function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
	});
	$("body").on("click",".removepfal",function(e){
		var did=$(this).attr("data-id");
		var ob=$(this);
		var cnf=confirm("Do you want to delete this permanently");
		e.preventDefault();
		if(cnf==false){return false;}
		var datastr="post_id=<?php echo $post_id;?>&pg_pmsn="+pgpmsn+"&del_id="+did+"&method=DeleteSolutionProb";
		
		$(this).html("<i class='fa fa-spinner fa-spin'></i>");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/PRODUCT/',
			method:'post',
			data:datastr,
			success:function(data){
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
					setTimeout(function(){$(ob).parent().parent().remove();},500);
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
	} );
	
	///////Solution//////////
	
	$("body").on("click","#soladdmore",function(e){
		e.preventDefault();
		$("#solmoredata").append('<div class="row mb-3"><div class="col-md-10"><input type="hidden" name="edid[]" value="" /><input type="text" class="form-control" name="solution[]" /></div><div class="col-md-1"><a href="#" class="btn btn-xs btn-primary" id="soladdmore"><i class="fa fa-plus" title="Add More"></i></a> <a href="#" class="btn btn-xs btn-danger removesol" title="Remove Me"><i class="fa fa-times"></i></a></div></div>');

	});
	$("body").on("click",".removesol",function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
	});
	///////what makes partners //////////
	$("body").on("click","#wcuaddmore",function(e){
		e.preventDefault();
		$("#wcumoredata").append('<div class="row mb-3"><div class="col-md-10"><input type="text" class="form-control" name="reason[]" /></div><div class="col-md-1"><a href="#" class="btn btn-xs btn-primary" id="wcuaddmore"><i class="fa fa-plus" title="Add More"></i></a> <a href="#" class="btn btn-xs btn-danger removewcu" title="Remove Me"><i class="fa fa-times"></i></a></div></div>');

	});
	$("body").on("click",".removewcu",function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
	});
	/////// FAQ //////////
	$("body").on("click","#faqaddmore",function(e){
		e.preventDefault();
		$("#faqmoredata").append('<div class="row mb-3"><div class="col-md-10"><input type="hidden" name="edid[]" value="" /><input type="text" class="form-control" name="faq[]" placeholder="Question" /> <textarea type="text" class="form-control" placeholder="Answer" name="ans[]"></textarea></div><div class="col-md-1"><a href="#" class="btn btn-xs btn-primary" id="faqaddmore"><i class="fa fa-plus" title="Add More"></i></a> <a href="#" class="btn btn-xs btn-danger removefaq" title="Remove Me"><i class="fa fa-times"></i></a></div></div>');

	});
	$("body").on("click",".removefaq",function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
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
	
	
	/*$("#cat").blur(function(){
		var str=$.trim($(this).val());
		str=str.replace(/[\._ ,+'"&$@\/:-]+/g, "-").toLowerCase();
		//str = str.replace(/\s+/g, '-').toLowerCase();
		$("#url").val(str);
	});*/
} );
</script>
</body>

</html>