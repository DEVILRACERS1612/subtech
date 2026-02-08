<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';

include 'Model/class.student.php';
include 'Model/class.class.php';
include 'Model/class.section.php';

$page="report";
/*include 'config/page_permission_check.php';
print_r($_SESSION[SITE_NAME]['PAGE_PERMISSION']);
if($_SESSION[SITE_NAME]['MICMP_usertype']!='Admin' and $page_permission['pg_create']!='Yes' and $page_permission['pg_edit']!='Yes')
{
	$permission_error='Permission Error For this Page';
	//header('Refresh:2;url='.BASE_PATH);
}*/
?>

<!DOCTYPE html>
<html lang="en">
<title><?php echo $_SESSION[SITE_NAME]['MICMP_name'];?> Report </title>
<head>
<?php include 'config/head.php';?>
<style>


.quick-btn {
	background:#ccc;
    margin: 8px auto;
	display:block;
    text-decoration: none;
	padding:5px 10px;
	font-size:15px;
	color:#000;
}
.box{
	border:1px solid #ccc;
	border-radius:10px;
	box-shadow:5px 0px 10px #000;
	padding-left:5px;
}


.c1 {background:#73B746;}
.c2 {background:#12BCCB;}
.c3 {background:#837EC1;}
.c4 {background:#FCB600;}
.c5 {background:#60B9FB;}
.c6 {background:#9E499E;}
.c7 {background:#9E7699;}
.c8 {background:#B33062;}
.c9 {background:#F27B51;}
.c10 {background:#0E8819;}
.c11 {background:#2D33AC;}
.c12 {background:#BF6E06;}


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
			<?php include 'config/leftmenu.php';?>
				<div class="page-content-wrapper">
				<div class="page-content">
				<div class="container">
				
				
					<div class="page-bar">
						<div class="page-title-breadcrumb">
							<div class=" pull-left">
								<div class="page-title"><b><?php echo $school['cmp_name'];?> </b> all Report </div>
								
							</div>
							
						</div>
					</div>

					<div class="container">
					<div class="row">
		<?php if(check_feature("sales-report",$feature) and check_page_permission('sales-report')){ ?>
			<div class="col-md-4">
			<div class="box">
			<h4>Sales Leads Reports</h4>
			<?php if(check_feature("new-lead-report",$feature) and check_page_permission('new-lead-report')){ ?>
			<a class="quick-btn" href="<?php echo BASE_PATH;?>new-lead-report/" >  <span>New Leads Generated Report</span></a>
			<?php } ?>
			</div>
			</div>
		<?php } 
		if(check_feature("other-report",$feature) and check_page_permission('other-report')){?>
			<div class="col-md-4 ">
			<div class="box">
			<h4>Other Reports</h4>
				<?php if(check_feature("electrician-list",$feature) and check_page_permission('electrician-list')){ ?>
				<a class="quick-btn" href="<?php echo BASE_PATH;?>all-electrician/" >  <span>All Electricians </span></a>
				<?php }  if(check_feature("customer-list",$feature) and check_page_permission('customer-list')){ ?>
				<a class="quick-btn" href="<?php echo BASE_PATH;?>all-customer/" >  <span>All Customers </span></a>
				<?php } ?>
			</div>
			</div>
		<?php } ?>
					<div class="col-md-4 ">
					<div class="box">
					
					</div>
					</div>
					
					
					
					</div>
				
					
					</div>
					
					
			<!--Row End-->
					
		
			</div>
			
		</div>
		<!-- end page container -->
		<!-- start footer -->
		<?php include 'config/footer.php';?>
		<!-- end footer -->
	</div>
<script>
$(document).ready(function(){

	<?php 
	if($permission_error!='')
	{
		?>
		$.toast({
			heading: 'Fail',
			text: '<?php echo $permission_error;?>',
			position: 'top-center',
			stack: false,
			icon:'error'
		});
		<?php 
	}
	?>
	
} );
</script>
</body>
</html>