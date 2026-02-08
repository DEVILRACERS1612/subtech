<?php  
include 'config/config.inc.php';
include 'config/login_check.php';
include 'config/function.php';

$page="Home";

?>

<!DOCTYPE html>
<html lang="en">
<title><?php echo $_SESSION[SITE_NAME]['MICMP_name'];?> CRM Panel </title>


<head>
<?php include 'config/head.php';?>
  
<style>
      
       /* New Dashboard Icons */
       
     /* * OLD BOOTSTRAP GUTTER EMULATION (Kept from previous version) */
    :root {
        --custom-gutter: 12px; /* Slightly increased spacing for wider boxes */
    }

    .row.old-style-gutter {
        margin-left: calc(-1 * var(--custom-gutter));
        margin-right: calc(-1 * var(--custom-gutter));
    }
    
    .row.old-style-gutter > .col,
    .row.old-style-gutter > [class*="col-"] {
        padding-left: var(--custom-gutter); 
        padding-right: var(--custom-gutter);
        margin-top: calc(var(--custom-gutter) * 2); 
    }
    /* END OLD BOOTSTRAP GUTTER EMULATION */


    /* Custom CSS to force 8 columns per row on screens 992px (lg) and up */
    @media (min-width: 992px) {
        .col-8-in-a-row {
            /* 100% / 8 items = 12.5% width per item */
            flex: 0 0 auto;
            width: 12.5%; 
        }
    }

    /* Standard Box Styles (increased size for 8 columns) */
    .icon-box {
        position: relative;
        background-color: #ffffff; 
        border: 1px solid #f0f0f0; 
        border-radius: 0.5rem; 
        padding: 1rem 0.5rem; /* Wider padding */
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
        height: 100%;
    }

    .icon-box:hover {
        box-shadow: 0 0.4rem 0.8rem rgba(0, 0, 0, 0.1); 
        transform: translateY(-2px);
    }
    
    .icon-box-text {
        font-size: 0.95rem; /* Larger font size */
        font-weight: bold;
        color: #212529;
        line-height: 1.1; 
    }

    .icon-box-icon {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        width: 3.2rem; /* Larger icon size */
        height: 3.2rem;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 0.4rem;
    }

    .icon-box-icon i {
        font-size: 1.9rem; /* Larger icon size */
        color: #dc3545;
    }

    .notification-badge {
        position: absolute;
        top: -4px; 
        right: -4px;
        background-color: #dc3545;
        color: white;
        border-radius: 50%;
        padding: 0.1em 0.3em; 
        font-size: 0.7rem; 
        line-height: 1;
        z-index: 10;
        border: 1px solid white;
    }
       
       /* New Dashboard Icons */
      
      
      
      
        .dashboard-box {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            height: 140px; /* Fixed height for consistent appearance */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 10px; /* Margin for spacing between boxes */

            /* Default for mobile (3 in a row) */
            flex-grow: 0;
            flex-shrink: 0;
            flex-basis: calc(33.33% - 20px); /* 100% / 3 - (2 * margin) */
            max-width: calc(33.33% - 20px); /* Ensure it doesn't grow beyond this */
        }
        .dashboard-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        .dashboard-box .icon-wrapper {
            background: linear-gradient(45deg, #ff6b6b, #ffa500); /* Example gradient */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 3rem;
            margin-bottom: 0px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: #f0f2f5; /* Fallback for icon background */
            position: relative;
        }
        /* Specific gradients for each box type */
        .dashboard-box.fa .icon-wrapper {
            background: linear-gradient(45deg, #6dd5ed, #2193b0); /* Blue gradient for User */
            -webkit-background-clip: text;
            -webkit-text-fill-color: #e40006;
        }
       


        .dashboard-box .notification-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #dc3545; /* Red color for notification */
            color: #fff;
            border-radius: 50%;
            padding: 5px 8px;
            font-size: 0.75rem;
            font-weight: bold;
            line-height: 1;
            min-width: 25px;
            height: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }
        .dashboard-box h5 {
            font-size: 1.1rem;
            margin-top: 10px;
            color: #343a40;
            font-weight: 600;
        }

        /* Media queries for responsiveness */

        /* For large devices (laptops and desktops) - 8 in a row */
        @media (min-width: 992px) {
            .dashboard-box {
                flex-basis: calc(25% - 20px); /* 100% / 8 - (2 * margin) */
                max-width: calc(25% - 20px);
            }
        }

        /* For medium devices (tablets) - 4 in a row */
        @media (min-width: 768px) and (max-width: 991px) {
            .dashboard-box {
                flex-basis: calc(25% - 20px); /* 100% / 4 - (2 * margin) */
                max-width: calc(25% - 20px);
            }
        }

        /* For small devices (mobile) - 3 in a row */
        @media (max-width: 767px) {
            .dashboard-box {
                flex-basis: calc(33.33% - 20px); /* 100% / 3 - (2 * margin) */
                max-width: calc(33.33% - 20px);
                height: 140px; /* Slightly smaller height for mobile */
                padding: 15px;
            }
            .dashboard-box .icon-wrapper {
                font-size: 2.5rem;
                width: 60px;
                height: 60px;
            }
            .dashboard-box h5 {
                font-size: 1rem;
            }
            .dashboard-box .notification-badge {
                top: 5px;
                right: 5px;
                padding: 4px 7px;
                font-size: 0.7rem;
                min-width: 22px;
                height: 22px;
            }
        }

        /* For very small devices (portrait mobile) - 2 in a row */
        @media (max-width: 575px) {
            .dashboard-box {
                flex-basis: calc(50% - 20px); /* 100% / 2 - (2 * margin) */
                max-width: calc(50% - 20px);
                height: 120px; /* Even smaller height */
                padding: 10px;
            }
            .dashboard-box .icon-wrapper {
                font-size: 2rem;
                width: 50px;
                height: 50px;
            }
            .dashboard-box h5 {
                font-size: 0.9rem;
            }
            .dashboard-box .notification-badge {
                top: 3px;
                right: 3px;
                padding: 3px 6px;
                font-size: 0.65rem;
                min-width: 20px;
                height: 20px;
            }
        }
    </style>
    

<style>
.noti{
position:absolute;z-index:9;margin-top:10px;padding:10px;height:31px!important;width:33px!important;border-radius:50%!important;
}


.quick-btn {
    background: #eee;
    
    color: #fff;
    display: block;
    height: 95px;
    margin: 10px;
    padding-top: 16px;
    text-align: center;
    text-decoration: none;
    width: 114px;
    position: relative;
    float:left;
}
@media only screen and (max-width: 600px) {
 .quick-btn {
    background: #eee;
    -webkit-box-shadow: 0 0 0 1px #F8F8F8 inset, 0 0 0 1px #CCCCCC;
    box-shadow: 0 0 0 1px #F8F8F8 inset, 0 0 0 1px #CCCCCC;
    color: #fff;
    display: block;
    height: 95px;
      margin: 0px 5px 5px 0px;
    padding-top: 16px;
    text-align: center;
    text-decoration: none;
    width: 107px;
    position: relative;
    float:left;
}
}

.quick-btn i{
padding-bottom:22px;
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


.fa-2x {
    font-size: 2em;
}
.quick-btn span {
    display: block;
	
}
/*.quick-btn .label {
    position: absolute;
    right: -5px;
    top: -5px;
}*/

.quick-btn div {
    display: block;
    height:50px;
    font-size:14px;
}	
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
								<div class="page-title"><b><?php echo $school['school_name'];?> </b>Dashboard </div>
								
							</div>
							
						</div>
					</div>

       
<!--
    <div class="py-4">
    <div class="row row-cols-3 row-cols-md-4 old-style-gutter">
        
        
        <div class="col col-8-in-a-row">
            <a href="<?php echo BASE_PATH;?>Setting/" class="text-decoration-none d-block h-100">
                <div class="icon-box">
                    <div class="icon-box-icon"><i class="fa fa-cogs"></i></div>
                    <span class="icon-box-text">Setting</span>
                </div>
            </a>
        </div>
        
        
        <div class="col col-8-in-a-row">
            <a href="<?php echo BASE_PATH;?>Add_Serial/" class="text-decoration-none d-block h-100">
                <div class="icon-box">
                   <!-- <span class="notification-badge">1</span>
                    <div class="icon-box-icon"><i class="fa fa-qrcode"></i></div>
                    <span class="icon-box-text">Stickers</span>
                </div>
            </a>
        </div>

        <div class="col col-8-in-a-row">
            <a href="<?php echo BASE_PATH;?>All_Complaint/" class="text-decoration-none d-block h-100">
                <div class="icon-box">
                     <div class="icon-box-icon"><i class="fa fa-pencil-square"></i></div>
                    <span class="icon-box-text">Complaints</span>
                </div>
            </a>
        </div>
        
        <div class="col col-8-in-a-row">
            <a href="#" class="text-decoration-none d-block h-100">
                <div class="icon-box">
                    <!--<span class="notification-badge">1</span>
                    <div class="icon-box-icon"><i class="fa fa-address-card"></i></div>
                    <span class="icon-box-text">Warranty Claims</span>
                </div>
            </a>
        </div>

        <div class="col col-8-in-a-row">
            <a href="#" class="text-decoration-none d-block h-100">
                <div class="icon-box">
                  
                    <div class="icon-box-icon"><i class="fa fa-calendar"></i></div>
                    <span class="icon-box-text">Service Request (complaints)</span>
                </div>
            </a>
        </div>

        <div class="col col-8-in-a-row">
            <a href="#" class="text-decoration-none d-block h-100">
                <div class="icon-box">
                    <div class="icon-box-icon"><i class="fa fa-users"></i></div>
                    <span class="icon-box-text">QR Code Customers</span>
                </div>
            </a>
        </div>

        <div class="col col-8-in-a-row">
            <a href="#" class="text-decoration-none d-block h-100">
                <div class="icon-box">
                    <div class="icon-box-icon"><i class="fa fa-user"></i></div>
                    <span class="icon-box-text">Electricians</span>
                </div>
            </a>
        </div>
          <div class="col col-8-in-a-row">
            <a href="#" class="text-decoration-none d-block h-100">
                <div class="icon-box">
                    <div class="icon-box-icon"><i class="fa fa-inr"></i></div>
                    <span class="icon-box-text">Electrician Payments</span>
                </div>
            </a>
        </div>

        <div class="col col-8-in-a-row">
            <a href="#" class="text-decoration-none d-block h-100">
                <div class="icon-box">
                    
                    <div class="icon-box-icon"><i class="fa fa-volume-control-phone"></i></div>
                    <span class="icon-box-text">Product Enquiry</span>
                </div>
            </a>
        </div>

        <div class="col col-8-in-a-row">
            <a href="#" class="text-decoration-none d-block h-100">
                <div class="icon-box">
                    <div class="icon-box-icon"><i class="fa fa-volume-control-phone"></i></div>
                    <span class="icon-box-text">Website Enquiry</span>
                </div>
            </a>
        </div>
        <div class="col col-8-in-a-row">
            <a href="#" class="text-decoration-none d-block h-100">
                <div class="icon-box">
                    <div class="icon-box-icon"><i class="fa fa-file-pdf-o"></i></div>
                    <span class="icon-box-text">Jobs Request</span>
                </div>
            </a>
        </div>
      
        <div class="col col-8-in-a-row">
            <a href="#" class="text-decoration-none d-block h-100">
                <div class="icon-box">
                    <div class="icon-box-icon"><i class="fa fa-ils"></i></div>
                    <span class="icon-box-text">Warranty</span>
                </div>
            </a>
        </div>

    </div>
</div>
-->
      
       
<!--New Icons-->       
       
       
       
       
       <div class="row">
		<div class="col-md-8 col-sm-8 col-12">
		<div class="row d-flex flex-wrap ">
            <?php 	if(check_module("setting",$module) and check_page_permission('setting')){?>
			<div class="dashboard-box fa">
                <a href="<?php echo BASE_PATH;?>Setting/"> 
                <div class="icon-wrapper">
                    <i class="fa fa-cogs"></i>
                </div></a>
                <h5>Setting</h5>
            </div>
            
            
		<?php } if(check_module("inventory",$module) and check_page_permission('generate_serial')){ ?>
			<div class="dashboard-box fa">
                 <a href="<?php echo BASE_PATH;?>Add_Serial/"> <!---<span class="notification-badge">0</span>-->
                <div class="icon-wrapper">
                    <i class="fa fa-qrcode"></i>
                </div></a>
                <h5>Stickers</h5>
            </div>
		<?php } if(check_module("complaint",$module)){ ?>	
		
		<div class="dashboard-box fa">
                <a href="<?php echo BASE_PATH;?>All_Complaint/"> <!--<span class="notification-badge">0</span>-->
                <div class="icon-wrapper">
                    <i class="fa fa-pencil-square"></i>
                </div></a>
                <h5>Complaints</h5>
            </div>
		<?php } if(check_module("inventory",$feature) and check_page_permission('stkitem')){ ?>
		<div class="dashboard-box fa">
                 <a href="<?php echo BASE_PATH;?>All_Item/"> <!--<span class="notification-badge">30</span>-->
                <div class="icon-wrapper">
                    <i class="fa fa-server"></i>
                </div></a>
                <h5>Products</h5>
            </div>
		<?php } if(check_feature("career",$feature) and check_page_permission('career')){ ?>
		<?php 
		
		$np=$db->exeQuery("select count(*) as cnt from mi_notifications_soft where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and noti_for='".$_SESSION[SITE_NAME]['MICMP_userid']."' and noti_page_for='career' and read_status='0' ")->fetch_assoc();
		
		?>
			<div class="dashboard-box fa">
                <a href="<?php echo BASE_PATH;?>All_Career/"><span class="notification-badge"><?=$np['cnt']?></span>
                <div class="icon-wrapper">
                    <i class="fa fa-graduation-cap"></i>
                </div></a>
                <h5>Career</h5>
            </div>
		<?php }  if(check_feature("enquiry",$feature) and check_page_permission('enquiry')){ ?>
			<?php 
		
		$np=$db->exeQuery("select count(*) as cnt from mi_notifications_soft where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and noti_for='".$_SESSION[SITE_NAME]['MICMP_userid']."' and noti_page_for='enquiry' and read_status='0' ")->fetch_assoc();
		
		?><div class="dashboard-box fa">
                <a href="<?php echo BASE_PATH;?>All_Enquiry/"><span class="notification-badge"><?=$np['cnt']?></span>
                <div class="icon-wrapper">
                    <i class="fa fa-question-circle"></i>
                </div></a>
                <h5>Enquiry</h5>
            </div>
		<?php } if(check_feature("order",$feature) and check_page_permission('order')){ ?>
			<?php 
		
		$np=$db->exeQuery("select count(*) as cnt from mi_notifications_soft where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and noti_for='".$_SESSION[SITE_NAME]['MICMP_userid']."' and noti_page_for='order' and read_status='0' ")->fetch_assoc();
		
		?><div class="dashboard-box fa">
                <a href="<?php echo BASE_PATH;?>All_Order/"><span class="notification-badge"><?=$np['cnt']?></span>
                <div class="icon-wrapper">
                    <i class="fa fa-shopping-bag"></i>
                </div></a>
                <h5>Product Order</h5>
            </div>
		<?php } if(check_feature("subscribe",$feature) and check_page_permission('subscribe')){ ?>
			<?php 
		
		$np=$db->exeQuery("select count(*) as cnt from mi_notifications_soft where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and noti_for='".$_SESSION[SITE_NAME]['MICMP_userid']."' and noti_page_for='subscribe' and read_status='0' ")->fetch_assoc();
		
		?><div class="dashboard-box fa">
                <a href="<?php echo BASE_PATH;?>All_Subscribe/"><span class="notification-badge"><?=$np['cnt']?></span>
                <div class="icon-wrapper">
                    <i class="fa fa-bell"></i>
                </div></a>
                <h5>Subscribe</h5>
            </div>
		<?php }  if(check_feature("visitor",$feature) and check_page_permission('visitor')){ ?>
			<?php 
		
		$np=$db->exeQuery("select count(*) as cnt from mi_notifications_soft where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and noti_for='".$_SESSION[SITE_NAME]['MICMP_userid']."' and noti_page_for='visitor' and read_status='0' ")->fetch_assoc();
		
		?><div class="dashboard-box fa">
                <a href="<?php echo BASE_PATH;?>All_Visitor/"><span class="notification-badge"><?=$np['cnt']?></span>
                <div class="icon-wrapper">
                    <i class="fa fa-id-badge"></i>
                </div></a>
                <h5>Visitor</h5>
            </div>
		<?php }  if(check_feature("contact",$feature) and check_page_permission('contact')){ ?>
			<?php 
		
		$np=$db->exeQuery("select count(*) as cnt from mi_notifications_soft where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and noti_for='".$_SESSION[SITE_NAME]['MICMP_userid']."' and noti_page_for='contact' and read_status='0' ")->fetch_assoc();
		
		?><div class="dashboard-box fa">
                <a href="<?php echo BASE_PATH;?>All_Contact/"><span class="notification-badge"><?=$np['cnt']?></span>
                <div class="icon-wrapper">
                    <i class="fa fa-address-book"></i>
                </div></a>
                <h5>Contact</h5>
            </div>
		<?php } if(check_feature("service-request",$feature) and check_page_permission('service-request')){ ?>
			<?php 
		
		$np=$db->exeQuery("select count(*) as cnt from mi_notifications_soft where cmp_id='".$_SESSION[SITE_NAME]['MICMP_cmpid']."' and noti_for='".$_SESSION[SITE_NAME]['MICMP_userid']."' and noti_page_for='service-request' and read_status='0' ")->fetch_assoc();
		
		?><div class="dashboard-box fa">
                <a href="<?php echo BASE_PATH;?>All_Service-request/"><span class="notification-badge"><?=$np['cnt']?></span>
                <div class="icon-wrapper">
                    <i class="fa fa-ticket"></i>
                </div></a>
                <h5>Service Request</h5>
            </div>
		<?php } ?>
		
		<!---	<div class="dashboard-box fa">
                 <a href=""> <span class="notification-badge">0</span>
                <div class="icon-wrapper">
                    <i class="fa-handshake-o"></i>
                 </div></a>
                <h5>Electricians</h5>
            </div>
            <div class="dashboard-box fa">
               <a href="<?php echo BASE_PATH;?>sr_match/"> <span class="notification-badge">0</span>
                <div class="icon-wrapper">
                    <i class="fa fa-users"></i>
                </div></a>
                <h5>Customers</h5>
            </div>
            
            
			
            
            <div class="dashboard-box fa">
                  <a href=""> 
                <div class="icon-wrapper">
                    <i class="fa fa-cube"></i>
                </div></a>
                <h5>Quotations</h5>
            </div>
            <div class="dashboard-box fa">
                 <a href=""> 
                <div class="icon-wrapper">
                    <i class="fa fa-ticket"></i>
                </div></a>
                <h5>Orders</h5>
            </div>
            -->
        </div>
		</div>			
					
				
					
					
					<div class="col-md-4 col-sm-4 col-12">
						<div class="col-md-12 col-sm-12 col-12">
							<div class="card card-topline-aqua">
									<div class="card-body no-padding height-9">
										<div class="row">
											<div class="profile-userpic">
												<img src="<?php echo BASE_PATH;?>images/cmp_img/<?php echo $school['logo'];?>" class="img-responsive" alt=""> </div>
										</div>
										<div class="profile-usertitle">
											<div class="profile-usertitle-name"><?php echo $school['school_name'];?></div>
											<div class="profile-usertitle-job"><?php echo $school['school_id'];?> </div>
										</div>
										<ul class="list-group list-group-unbordered">
											<li class="list-group-item">
												<b>Mobile</b> <a class="pull-right">+91-<?php echo $school['mobile'];?></a>
											</li>
											<li class="list-group-item">
												<b>Email</b> <a class="pull-right"><?php echo $school['emails'];?></a>
											</li>
											<li class="list-group-item">
												<b>City</b> <a class="pull-right"><?php echo $school['address'];?></a>
											</li>
										</ul>
										<!-- END SIDEBAR USER TITLE -->
										<!-- SIDEBAR BUTTONS -->
										<div class="profile-userbuttons">
											<button type="button" class="btn btn-circle green btn-sm">Support</button>
											<button type="button" class="btn btn-circle red btn-sm">View Profile</button>
										</div>
										<!-- END SIDEBAR BUTTONS -->
									</div>
								</div>
					</div>
					</div>
					
					
					
					
			</div>
			<!--Row End-->
					
					
				
					
					
					
					
					
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