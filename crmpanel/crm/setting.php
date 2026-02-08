<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';

include 'Model/class.student.php';
include 'Model/class.class.php';
include 'Model/class.section.php';

$page="setting";

?>

<!DOCTYPE html>
<html lang="en">
<title><?php echo $_SESSION[SITE_NAME]['MICMP_name'];?> CRM Panel </title>
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
								<div class="page-title"><b><?php echo $school['cmp_name'];?> </b> all setting </div>
								
							</div>
							
						</div>
					</div>

					<div class="container">
					<div class="row">
					
					<div class="col-md-4 ">
					<div class="box">
					<h4>1. Employee Master Settings</h4>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>company-profile/" >  <span>Profile</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Designation/" >  <span>Setup Designation</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Department/" >  <span>Setup Department</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Region/" >  <span>Setup Region</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Branch/" >  <span>Setup Branch</span></a>
					
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_User/" ><span>Setup Employee</span></a>
					</div>
					</div>
					<div class="col-md-4 ">
					<div class="box">
					<h4>2. Customer Master Settings</h4>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Industry/" >  <span>Set Industry/Segment</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Source/" >  <span>Set up Source/Reference</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Country/" >  <span>Set up Country/State/Location</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Enquiry_Status/" >  <span>Set up Enquiry Status</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Transport_Mode/" >  <span>Set up Transportation Mode</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Expenses_Head/" >  <span>Expenses Head</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Followup_Type/" >  <span>FollowUp Type Master</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Task_Type/" >  <span>Task Type Master</span></a>
					
					</div>
					</div>
					
					<div class="col-md-4 ">
					<div class="box">
					<h4>3. Product Master Settings</h4>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Unit/" >  <span>Set Unit</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Category/" >  <span>Product Category</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_SubCategory/" >  <span>Product Sub-Category</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Ptype/" >  <span>Product Type-1</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Ptype2/" >  <span>Product Type-2</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Varient/" >  <span>Product Varient-1</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Rating/" >  <span>Product Varient-2 (Rating)</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Sectors/" >  <span>Sectors</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Godown/" >  <span>Product Location</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Brand/" >  <span>Product Brand</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Product/" >  <span>Product</span></a>
					
					</div>
					</div>
					<div class="col-md-4 ">
					<div class="box">
					<h4>4. Complain Master Settings</h4>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_CSource/" >  <span>Set up Source</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Complaint_Nature/" >  <span>Set up Complaint Nature</span></a>
					
					
					</div>
					</div>
					<div class="col-md-4 ">
					<div class="box">
					
					<h4>5. Solution Master Settings</h4>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Solcat/" >  <span>Solution Category</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Solsubcat/" >  <span>Solution Sub-Category</span></a>
					<a class="quick-btn" href="<?php echo BASE_PATH;?>Add_Solution/" >  <span>Solution </span></a>
					
					
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