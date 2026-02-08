<?php 
include_once 'config/config.inc.php';
//error_reporting(E_ALL);
require './Model/class.master.php';


$srno=(isset($_REQUEST['srno']) and $_REQUEST['srno'] !='')?base64_decode($db->filterVar($_REQUEST['srno'])):'';
$qr=$db->exeQuery("select * from mi_product_detail where serial_no='".$srno."' and mi_status='Yes'");
if($qr->num_rows){
$row=$qr->fetch_assoc();
}else{
echo '<script>alert("Serial No is Invalid")</script>';
exit;
}
$prd=$objmaster->prod_details($row['prd_id']);
///////////////////

//$_SESSION['cmobile']='';
//$_SESSION['mobile']='';
//$_SESSION['usertype']='';

if($_SESSION['cmobile']!=""){
	$crow=$db->exeQuery("select * from mi_customer where mobile='".$_SESSION['cmobile']."' and mi_status='Yes'")->fetch_assoc();
	$cadd=$db->exeQuery("select * from mi_customer_address where mobile='".$_SESSION['cmobile']."' and mi_status='Yes'")->fetch_assoc();
	$cprd=$db->exeQuery("select * from mi_customer_product where mobile='".$_SESSION['cmobile']."' and serial_no='".$srno."' and mi_status='Yes'")->fetch_assoc();
} 
if($_SESSION['mobile']!=""){
	$erow=$db->exeQuery("select * from mi_electrician where mobile='".$_SESSION['mobile']."' and mi_status='Yes'")->fetch_assoc();
	//$crow=$db->exeQuery("select * from mi_customer where elect_by='".$_SESSION['mobile']."' and mi_status='Yes'")->fetch_assoc();
	//$cadd=$db->exeQuery("select * from mi_customer_address where mobile='".$crow['mobile']."' and mi_status='Yes'")->fetch_assoc();
	//$cprd=$db->exeQuery("select * from mi_customer_product where mobile='".$crow['mobile']."' and serial_no='".$srno."' and mi_status='Yes'")->fetch_assoc();
}
//print_r($_SESSION);
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8">
    <title>Subtech Electronics</title>
	 <meta name="description" content="Subtech Electronics">
    <?php include_once"config/head.php";?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<style>
       
        .form-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 10px;
            width: 100%;
            max-width: 600px;
            overflow: hidden; /* Hide overflowing steps */
            position: relative;
            transition: height 0.5s ease-in-out; /* Smooth height transition */
        }
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-header img {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .form-header h2 {
            font-size: 1.8rem;
            font-weight: 600;
            color: #333;
        }
        .form-header p {
            color: #666;
            font-size: 0.95rem;
            margin-top: 5px;
        }
        .form-step {
            position: absolute; /* All steps are absolute initially */
            top: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            padding-top: 0;
            box-sizing: border-box;
            transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
            transform: translateX(100%); /* Start off-screen to the right */
            opacity: 0;
            pointer-events: none; /* Disable interaction when hidden */
        }
        .form-step.active {
            position: relative; /* Takes up space when active */
            transform: translateX(0); /* Slide in */
            opacity: 1;
            pointer-events: auto; /* Enable interaction */
        }
        /* Classes for horizontal sliding out */
        .form-step.leaving-right {
            transform: translateX(100%);
            opacity: 0;
        }
        .form-step.leaving-left {
            transform: translateX(-100%);
            opacity: 0;
        }

        /* Classes for vertical sliding (customer/electrician switch) */
        .form-step.slide-up-out {
            transform: translateY(-100%);
            opacity: 0;
            position: absolute; /* Ensure it moves out of flow */
            pointer-events: none;
        }
        .form-step.slide-down-in {
            transform: translateY(0);
            opacity: 1;
            position: relative; /* Takes up space when active */
            pointer-events: auto;
        }
        /* Hidden initially, but ready to slide in */
        .form-step:not(.active) {
            position: absolute;
            transform: translateX(100%);
            opacity: 0;
            pointer-events: none;
        }


        .form-step h3 {
            font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
    padding-bottom: 0px;
    border-bottom: 1px solid #eee;
	line-height: 25px
}
        }
        .form-group label {
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
        }
        .form-group .form-control, .form-group .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px 15px;
            font-size: 1rem;
        }
        .form-group .form-control:focus, .form-group .form-select:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
        }
        /* Validation error styling */
        .form-group .form-control.is-invalid,
        .form-group .form-select.is-invalid {
            border-color: #dc3545 !important;
        }
        .form-group .invalid-feedback {
            display: block; /* Ensure feedback is visible when needed */
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        .btn-primary, .btn-danger {
            background-color: #dc3545; /* Red from image */
            border-color: #dc3545;
            border-radius: 8px;
            padding: 4px 14px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: background-color 0.3s ease, border-color 0.3s ease, transform 0.2s ease;
        }
        .btn-primary:hover, .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
            transform: translateY(-2px);
        }
        .btn-secondary {
            background-color: #e0e0e0; /* Grey from image */
            border-color: #e0e0e0;
            color: #555;
            border-radius: 8px;
            padding: 4px 15px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: background-color 0.3s ease, border-color 0.3s ease, transform 0.2s ease;
        }
        .btn-secondary:hover {
            background-color: #d0d0d0;
            border-color: #c0c0c0;
            transform: translateY(-2px);
        }
        .btn-group-lang .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
        }
        .btn-group-lang .btn.active {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }
        .radio-group label {
            margin-right: 20px;
            font-weight: 500;
        }
        .radio-group input[type="radio"] {
            margin-right: 8px;
            transform: scale(1.2); /* Make radio buttons slightly larger */
        }
        .product-card {
            background-color: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        .product-card img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            margin-right: 20px;
            object-fit: cover;
        }
        .product-info h5 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .product-info p {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 3px;
        }
        .product-info .serial-no {
            font-weight: 600;
            color: #dc3545;
        }
        .upload-section {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .upload-button {
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px 15px;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .upload-button:hover {
            background-color: #e0e0e0;
        }
        .upload-button i {
            margin-right: 8px;
            color: #dc3545;
        }
        .upload-section a {
            margin-left: 15px;
            color: #dc3545;
            text-decoration: none;
            font-weight: 500;
        }
        .upload-section a:hover {
            text-decoration: underline;
        }

        /* Modal Styling */
        .custom-modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1050; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            justify-content: center;
            align-items: center;
        }
        .custom-modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            width: 80%;
            max-width: 400px;
            text-align: center;
            position: relative;
        }
        .custom-modal-content h4 {
            margin-bottom: 20px;
            color: #333;
            font-weight: 600;
        }
        .custom-modal-content .btn {
            margin: 0 10px;
        }
        .close-button {
            position: absolute;
            top: 10px;
            right: 15px;
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close-button:hover,
        .close-button:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        /* Call Support Footer */
        .call-support-footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 15px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            font-size: 0.9rem;
        }
        .call-support-footer a {
            color: #fff;
            text-decoration: none;
            margin-right: 5px;
        }
        .call-support-footer a:hover {
            text-decoration: underline;
        }
        .call-support-footer i {
            margin-right: 8px;
        }

        /* Electrician specific styling */
        .electrician-details-form .form-control,
        .electrician-details-form .form-select {
            border-color: #d7d7d7; /* Blue */
            background-color: #ffffff; /* Blue background */
            color: #000; /* White text for contrast */
        }
        /* Placeholder color for blue inputs */
        .electrician-details-form .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7); /* Lighter white for placeholder */
        }
        .electrician-details-form .form-control:focus,
        .electrician-details-form .form-select:focus {
            border-color: #0056b3;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }
        .electrician-details-form .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .electrician-details-form .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .electrician-details-form h3 {
            border-bottom-color: #007bff;
        }
        .electrician-details-form .upload-button i {
            color: #007bff;
        }
        .electrician-details-form .upload-section a {
            color: #007bff;
        }
        .electrician-details-form .btn-secondary {
            background-color: #e0e0e0; /* Grey */
            border-color: #e0e0e0;
            color: #555;
        }
        .electrician-details-form .btn-secondary:hover {
            background-color: #d0d0d0;
            border-color: #c0c0c0;
        }

        /* Verified button style */
        .btn-verified {
            background-color: #28a745 !important; /* Green */
            border-color: #28a745 !important;
            color: #fff !important;
            cursor: default;
        }
        .btn-verified:hover {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
            transform: none !important;
        }
		#nextBtn1{display:none;}
		#summaryName{display:block!important;}
    </style>
	
	
<style>
    .user-section {
     
      margin-top: 20px;
     padding:10px 10px;
      border: 1px solid #ccc;
      background: #f9f9f9;
    }
  </style>
  
  <style>

/*.card{border:1px solid #ddd; border-radius:12px; padding:16px; box-shadow:0 1px 4px rgba(0,0,0,.06); margin-bottom:20px}*/
video{max-width:360px; width:100%; border-radius:10px; background:#000}

.progress{height:10px; background:#eee; border-radius:40px; overflow:hidden; margin-top:10px}
.bar{height:100%; width:0%; background:#4caf50}
.mono{font-family:ui-monospace, SFMono-Regular, Menlo, Consolas, monospace}
.error{color:red; margin-top:8px}
</style>
</head>

<body>
	
	
    <div id="wrapper">

	<div class="" style="min-height:30vh; background:#f7f7f7; padding-bottom: 5px; border-bottom-right-radius: 20px !important; border-bottom-left-radius: 20px !important;">
		<div class="col-md-4 mx-auto">
		<div class="text-center pt-2">
			 <img src="<?=BASE_PATH?>images/logo/logo.png" class="logo" alt="subtech logo">
				 <h6 for="name">Warranty Registration Form </h6>
			<p style="color: #9b9b9b;">Submit the form and claim <?=$prd['warranty']?> warranty & get Cashback  </p>
			</div>
						
						
		<div class="mb-4" style=" border-radius: 15px;   background: #fff;margin: 10px 8px; padding: 10px;">
			<table style="width:100%">
				<tr>
				<td>
				<?php if($prd['image']!=''){
					?>
					<img src="<?=WEB_PATH?>crmpanel/crm/images/prod_img/<?=$prd['image']?>" class="logo" alt="subtech logo" style="vertical-align: top;">
					<?php 
				}else{
					?>
					<img src="<?=BASE_PATH?>images/noimage.png" class="logo" alt="subtech logo" style="vertical-align: top;">
					<?php 
				}?>
				</td>
				<td style="padding-left:7px;"><h6 style="font-size:15px;line-height:20px;"><?=$prd['pname']?></h6><p style="color: #9b9b9b;"><?=$objmaster->cat_name($prd['cat_id'])?> . <?=$objmaster->varient_name($prd['varient'])?> . <?=$objmaster->rating_name($prd['rating'])?>
				<h6 style="font-size:15px;">Serial No: <b class="text-danger"><?=$srno?></b></h6>
				</td>
				</tr>
			</table>
		</div>
		  </div>
		</div>
 <?php 
if($row['cust_id']!=""){
	echo '<section class="mb-4">';
	echo '<h6 style="text-align:center;">Product is already Registered</h6>';
	echo '</section>';
	
	echo '<section class="mb-4" style="display:none">';
}else{
	echo '<section class="mb-4">';
}
?>	
	
  
  
 
  <div class="form-container col-md-4 mx-auto mb-4" style="margin-bottom:60px;">
		<div id="racmsg"></div>
       <!-- <div class="form-header">
            <img src="https://placehold.co/150x50/dc3545/ffffff?text=SUBTECH" alt="SUBTECH Logo">
            <h2 data-en="Warranty Registration Form" data-hi="वारंटी पंजीकरण फॉर्म">Warranty Registration Form</h2>
            <p data-en="Submit the form and claim 1-year warranty & get Cashback 💰" data-hi="फॉर्म जमा करें और 1 साल की वारंटी और कैशबैक पाएं 💰">Submit the form and claim 1-year warranty & get Cashback 💰</p>
            <p class="serial-no" data-en="Serial No.: F251013124" data-hi="सीरियल नंबर: F251013124">Serial No.: F251013124</p>
        </div>-->

        <!-- Step 1: Language and User Type Selection -->
        <div class="form-step" id="step1">
		<form method="post" id="step1form" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="<?=$post_id?>" />
			<input type="hidden" name="method" value="step1" />
			
            <h3 data-en="Select Language" data-hi="भाषा चुनें">Select Language</h3>
            <div class="mb-4 radio-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="language" id="langEnglish" value="en" checked>
                    <label class="form-check-label" for="langEnglish">English</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="language" id="langHindi" value="hi" <?=($crow['language']=='hi')?'checked':'';?> >
                    <label class="form-check-label" for="langHindi">हिंदी</label>
                </div>
            </div>

            <h3 data-en="Select" data-hi="चुनें">Select</h3>
            <div class="mb-4 radio-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="userType" id="userElectrician" value="electrician" checked>
                    <label class="form-check-label" for="userElectrician" data-en="I am an Electrician" data-hi="मैं एक 'इलेक्ट्रीशियन' हूँ">I am an Electrician</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="userType" id="userCustomer" value="customer" <?=($_SESSION['usertype']=='customer')?'checked':'';?> >
                    <label class="form-check-label" for="userCustomer" data-en="I am a Customer" data-hi="मैं एक 'ग्राहक' हूँ">I am a Customer</label>
                </div>
            </div>
			
			 <div class="mb-3 form-group">
                <label for="electricianMobile" class="form-label" data-en="Enter Mobile Number *" data-hi="मोबाइल नंबर दर्ज करें *">Enter Mobile Number *</label>
                <div class="input-group">
                    <input type="number" name="mobile" class="form-control" id="electricianMobile" placeholder="Enter Mobile Number" value="<?=$_SESSION['mobile']?>" required  >
					<?php if($_SESSION['mobile']==""){ ?>
                    <button class="btn btn-primary" type="button" id="getOtpElectricianBtn" data-en="Get OTP" data-hi="ओटीपी प्राप्त करें">Get OTP</button>
					<?php } ?>
                </div>
				<?php if($_SESSION['mobile']==""){ ?>
                <!--<div class="invalid-feedback" data-en="Mobile number is required." data-hi="मोबाइल नंबर आवश्यक है।"></div>--><?php } ?>
            </div>
			<button type="button" class="btn btn-danger w-100 mb-4" id="nextBtn1" <?=($_SESSION['mobile']=="")?'style="display:none"':'style="display:block"'?> data-en="Next →" data-hi="अगला →">Next → </button>
		</form>
            
        </div>

        <!-- Step 2: Electrician Details (Conditional) -->
        <div class="form-step electrician-details-form" id="step2-electrician">
		<form method="post" id="stepe2form" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="<?=$post_id?>" />
			<input type="hidden" name="method" value="step2" />
			<input type="hidden" name="userType" value="electrician" />
			
            <h3 data-en="Electrician Details" data-hi="इलेक्ट्रीशियन विवरण">Electrician Details</h3>
    <?php if($erow['fname']!="" and $erow['state']!=""){ ?>
	<input type="hidden" name="fname" value="<?=$erow['fname']?>">
	<input type="hidden" name="state" value="<?=$erow['state']?>">
	<input type="hidden" name="city" value="<?=$erow['city']?>">
	<input type="hidden" name="address" value="<?=$erow['address']?>">
		<div class="row mb-2" style="background:#fff;padding-top:10px;border:2px solid #000; border-radius:10px;">
			<div class="col-6 mb-2 form-group">
				<div class="mb-2"> Cashback Points <img src="<?=BASE_PATH?>images/cashboak.png" class="" alt="chasback"></div>
				<div class="mb-2 text-danger" style="font-size:16px;"><b> 0 pts </b></div>
			</div>
			<div class="col-6 mb-2 form-group " style="text-align:right">
				<div class="mb-2"> Quarterly Points <img src="<?=BASE_PATH?>images/cashboak.png" class="" alt="chasback"></div>
				<div class="mb-2 text-danger" style="font-size:16px;"><b> 0 pts </b></div>
			</div>
		</div>
		<div class="row" style="background:#f7eaea;padding-top:10px;border-radius:10px;">
			<div class="col-md-12 mb-2 form-group">
				<label> Name </label>
				<label class="form-control" style="padding:5px 10px"><?=$erow['fname']?></label>
            </div>
			<div class="col-md-6 mb-2 form-group">
				<label  class="form-label">State </label>
				<label class="form-control" style="padding:5px 10px"><?=$objmaster->state_name($erow['state'])?></label>
            </div>
			<div class="col-md-6 mb-2 form-group">
				<label  class="form-label" >City </label>
				<label class="form-control" style="padding:5px 10px"><?=$erow['city']?></label>
            </div>
			<div class="col-md-12 mb-2 form-group">
				<label  class="form-label" >Address </label>
				<label class="form-control" style="padding:5px 10px"><?=$erow['address']?></label>
            </div>
		</div>
	
	
	<?php } else { ?>
            <div class="mb-3 form-group">
                <label for="electricianFirstName" class="form-label" data-en="First Name *" data-hi="पहला नाम *">First Name *</label>
                <input type="text" class="form-control" id="electricianFirstName" name="fname" placeholder="First Name" value="<?=$erow['fname']?>" required>
				<?php if($erow['fname']==""){ ?>
                <div class="invalid-feedback" data-en="First name is required." data-hi="पहला नाम आवश्यक है।"></div>
				<?php } ?>
            </div>
           
            <div class="row">
                <div class="col-md-6 mb-3 form-group">
                    <label for="electricianState" class="form-label" data-en="Select State *" data-hi="राज्य चुनें *">Select State *</label>
                    <select class="form-select" name="state" id="electricianState" required>
                        <?=$objmaster->state_list($erow['state'])?>
                    </select>
					<?php if($erow['state']==""){ ?>
                    <div class="invalid-feedback" data-en="State is required." data-hi="राज्य आवश्यक है।"></div>
					<?php } ?>
                </div>
                <div class="col-md-6 mb-3 form-group">
                    <label for="electricianCity" class="form-label" data-en="Enter City *" data-hi="शहर  *">Enter City *</label>
                    <input type="text" name="city" class="form-control" id="electricianCity" value="<?=$erow['city']?>" required>
                    <?php if($erow['city']==""){ ?>   
                    <div class="invalid-feedback" data-en="City is required." data-hi="शहर आवश्यक है।"></div>
					<?php } ?>
                </div>
            </div>
			
			<div class="mb-3 form-group">
                <label for="electricianAddress" class="form-label" data-en="Address *" data-hi="पता  *">Address *</label>
                <input type="text" name="address" class="form-control" id="electricianAddress" placeholder="Address" value="<?=$erow['address']?>" required>
				<?php if($erow['address']==""){ ?>
                <div class="invalid-feedback" data-en="Address is required." data-hi=" पता आवश्यक है।"></div>
				<?php } ?>
            </div>
	<?php } ?>		
			<!------- /////////////   Customer   \\\\\\\\\\\\\\\\\  ------------>
			
			
			<h3 data-en="Customer Details (For Warranty)" data-hi="ग्राहक विवरण (वारंटी के लिए)">Customer Details (For Warranty)</h3>
			<div class="mb-3 form-group">
                <label for="electricianMobile" class="form-label" data-en="Enter Mobile Number *" data-hi="मोबाइल नंबर दर्ज करें *">Enter Mobile Number *</label>
                <div class="input-group">
                    <input type="number" name="cmobile" class="form-control" id="customerMobile" placeholder="Mobile Number" required value="<?=$crow['mobile']?>" <?=($crow['mobile']!="")?'readonly':''?> >
					<?php if($crow['mobile']==""){ ?>
                    <button class="btn btn-primary" type="button" id="getOtpCustomerBtn" data-en="Get OTP" data-hi="ओटीपी प्राप्त करें">Get OTP</button>
					<?php } ?>
                </div>
				<?php if($crow['mobile']==""){ ?>
                <div class="invalid-feedback" data-en="Mobile number is required." data-hi="मोबाइल नंबर आवश्यक है।"></div>
				<?php } ?>
            </div>
			
            <div class="row">
                <div class="col-md-6 mb-3 form-group">
                    <label for="customerFirstName" class="form-label" data-en="First Name *" data-hi="पहला नाम *">First Name *</label>
                    <input type="text" name="cfname" class="form-control" id="customerFirstName" placeholder="First Name" value="<?=current(explode(" ",$crow['cname']));?>" required>
					<?php if(current(explode(" ",$crow['cname']))==""){ ?>
                    <div class="invalid-feedback" data-en="First name is required." data-hi="पहला नाम आवश्यक है।"></div>
					<?php } ?>
                </div>
                <div class="col-md-6 mb-3 form-group">
                    <label for="customerLastName" class="form-label" data-en="Last Name *" data-hi="अंतिम नाम *">Last Name *</label>
                    <input type="text" name="clname" class="form-control" id="customerLastName" placeholder="Last Name" value="<?=end(explode(" ",$crow['cname']));?>" required >
					<?php if(end(explode(" ",$crow['cname']))==""){ ?>
                    <div class="invalid-feedback" data-en="Last name is required." data-hi="अंतिम नाम आवश्यक है।"></div>
					<?php } ?>
                </div>
            </div>
            
            <!--<div class="row">
                <div class="col-md-6 mb-3 form-group">
                    <label for="customerState" class="form-label" data-en="Select State *" data-hi="राज्य चुनें *">Select State *</label>
                    <select class="form-select" name="cstate" id="customerState" required>
                        <?=$objmaster->state_list($cadd['state'])?>
                    </select>
					<?php if($cadd['state']==""){ ?>
                    <div class="invalid-feedback" data-en="State is required." data-hi="राज्य आवश्यक है।"></div>
					<?php } ?>
					
                </div>
                <div class="col-md-6 mb-3 form-group">
                    <label for="customerCity" class="form-label" data-en="Enter City *" data-hi="शहर *">Enter City *</label>
                    <input type="city" name="ccity" class="form-control" id="customerCity" value="<?=$cadd['city']?>" required >
					<?php if($cadd['city']==""){ ?>
                    <div class="invalid-feedback" data-en="City is required." data-hi="शहर आवश्यक है।"></div>
					<?php } ?>
                </div>
				<div class="mb-3 form-group">
					<label for="customerAddress" class="form-label" data-en="Address *" data-hi="पता   *">Address *</label>
					<input type="text" name="caddress" class="form-control" id="customerAddress" placeholder="Address" value="<?=$cadd['address']?>" required>
					<?php if($cadd['address']==""){ ?>
					<div class="invalid-feedback" data-en="Address is required." data-hi="पता  आवश्यक है।"></div>
					<?php } ?>
				</div>
            </div>--->
			
			
            <!--<div class="mb-3 form-group">
                <label class="form-label" data-en="Click Selfie Photo *" data-hi="सेल्फी फोटो क्लिक करें *">Click Selfie Photo *</label>
                <div class="upload-section">
                    <label for="electricianSelfie" class="upload-button">
                        <i class="fas fa-upload"></i> <span data-en="Upload" data-hi="अपलोड करें">Upload</span>
                        <input type="file" name="selfie" id="electricianSelfie" accept="image/*" style="display: none;" required>
                    </label>
                    <a href="#" data-en="View Sample" data-hi="नमूना देखें">View Sample</a>
                </div>
                <div class="invalid-feedback" data-en="Selfie photo is required." data-hi="सेल्फी फोटो आवश्यक है।"></div>
            </div>-->

            <div class="d-flex justify-content-between mt-4 mb-4">
                <button type="button" class="btn btn-secondary" id="backBtnElectrician" data-en="← Back" data-hi="← पीछे">← Back</button>
                <button type="button" class="btn btn-primary" id="nextBtnElectrician" data-en="Next →" data-hi="अगला →">Next →</button>
            </div>
			</form>
        </div>

        <!-- Step 2: Customer Details (Conditional) -->
        <div class="form-step" id="step2-customer">
		<form method="post" id="stepc2form" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="<?=$post_id?>" />
			<input type="hidden" name="method" value="step2" />
			<input type="hidden" name="userType" value="customer" />
			
            <h3 data-en="Customer Details (For Warranty)" data-hi="ग्राहक विवरण (वारंटी के लिए)">Customer Details</h3>
            <div class="row">
                <div class="col-md-6 mb-3 form-group">
                    <label for="customerFirstName" class="form-label" data-en="First Name *" data-hi="पहला नाम *">First Name *</label>
                    <input type="text" name="fname" class="form-control" id="customerFirstName" placeholder="First Name" value="<?=current(explode(" ",$crow['cname']));?>" required />
					<?php if($crow['cname']==""){ ?>
                    <div class="invalid-feedback" data-en="First name is required." data-hi="पहला नाम आवश्यक है।"></div>
					<?php }?>
                </div>
                <div class="col-md-6 mb-3 form-group">
                    <label for="customerLastName" class="form-label" data-en="Last Name *" data-hi="अंतिम नाम *">Last Name *</label>
                    <input type="text" name="lname" class="form-control" id="customerLastName" placeholder="Last Name" value="<?=end(explode(" ",$crow['cname']));?>" required >
					<?php if(end(explode(" ",$crow['cname']))==""){ ?>
                    <div class="invalid-feedback" data-en="Last name is required." data-hi="अंतिम नाम आवश्यक है।"></div>
					<?php }?>
                </div>
            </div>
			<div class="row">
            <div class="col-md-12 mb-3 form-group">
                <label for="electricianMobile" class="form-label" data-en="Enter Mobile Number *" data-hi="मोबाइल नंबर दर्ज करें *"> Alternate Mobile Number *</label>
                <div class="input-group">
                    <input type="number" name="mobile2" class="form-control" id="customerMobile2" placeholder="Mobile Number" value="<?=$crow['mobile2']?>" <?=($crow['mobile2']!="")?'readonly':''?> >
					
                </div>
            </div>
			</div>
            <!--<div class="row">
                <div class="col-md-6 mb-3 form-group">
                    <label for="customerState" class="form-label" data-en="Select State *" data-hi="राज्य चुनें *">Select State *</label>
                    <select class="form-select" name="state" id="customerState" required>
                        <?=$objmaster->state_list($cadd['state'])?>
                    </select>
					<?php if($cadd['state']==""){ ?>
                    <div class="invalid-feedback" data-en="State is required." data-hi="राज्य आवश्यक है।"></div>
					<?php  } ?>
                </div>
                <div class="col-md-6 mb-3 form-group">
                    <label for="customerCity" class="form-label" data-en="Select City *" data-hi="शहर चुनें *">Select City *</label>
                    <input type="city" name="city" class="form-control" id="customerCity" value="<?=$cadd['city']?>" required >
					<?php if($cadd['city']==""){ ?>
                    <div class="invalid-feedback" data-en="City is required." data-hi="शहर आवश्यक है।"></div>
					<?php } ?>
                </div>
				<div class="mb-3 form-group">
					<label for="customerAddress" class="form-label" data-en="Address *" data-hi="पता   *">Address *</label>
					<input type="text" name="address" class="form-control" id="customerAddress" placeholder="Address" value="<?=$cadd['address']?>" required>
					<?php if($cadd['address']==""){ ?>
					<div class="invalid-feedback" data-en="Address is required." data-hi="पता  आवश्यक है।"></div>
					<?php } ?>
				</div>
            </div>-->

            <div class="d-flex justify-content-between mt-4 mb-4">
                <button type="button" class="btn btn-secondary" id="backBtnCustomer" data-en="← Back" data-hi="← पीछे">← Back</button>
                <button type="button" class="btn btn-danger" id="nextBtnCustomer" data-en="Next →" data-hi="अगला →">Next →</button>
            </div>
			</form>
        </div>

        <!-- Step 3: Product Details -->
        <div class="form-step" id="step3">
		<form method="post" id="step3form" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="<?=$post_id?>" />
			<input type="hidden" name="method" value="step3" />
			<input type="hidden" name="serial_no" value="<?=$srno?>" />
			
            <h3 data-en="Product Details" data-hi="उत्पाद विवरण">Product Details</h3>
            <div class="mb-3 form-group">
                <label for="purchaseDate" class="form-label" data-en="Purchase Date *" data-hi="खरीद की तारीख *">Purchase Date *</label>
                <input type="date" class="form-control" id="purchaseDate" name="pdate" required style="line-height:20px;" max="<?=date("Y-m-d")?>" value="<?=$cprd['pr_date']?>">
				<?php if($cprd['pr_date']==""){ ?>
                <div class="invalid-feedback" data-en="Purchase date is required." data-hi="खरीद की तारीख आवश्यक है।"></div>
				<?php } ?>
				<input type="hidden" name="warranty" value="<?=$prd['warranty']?>" />
				<input type="hidden" name="prd_id" value="<?=$row['prd_id']?>" />
            </div>
			<div class="mb-3 form-group">
                <label class="form-label" data-en="Video (No more than 15-20 Seconds/ 20 MB ) *" data-hi="वीडियो (15/20 सेकेंड या 20MB का )*">Video (No more than 15-20 Seconds/ 20 MB ) *</label>
                <div class="upload-section">
                    <label for="videoInput" class="upload-button">
                        <i class="fas fa-upload"></i> <span data-en="Upload" data-hi="अपलोड करें">Upload</span>
                        <input type="file" id="videoInput" name="video" accept="video/*" style="display: none;" required>
                    </label>
                    <a href="#" class="viewsample" data-href="" data-title="Sample Video" data-en="Sample Video" data-hi="नमूना देखें">View Sample</a>
                </div>
                <div class="invalid-feedback" data-en="Video is required." data-hi="वीडियो आवश्यक है।"></div>
            </div>
			<div id="uploadStatus"></div>
			<video id="preview" controls style="max-width:300px; display:none;"></video>
            <!---<div class="mb-3 form-group">
                <label class="form-label" data-en="Dealer Bill Photo *" data-hi="डीलर बिल फोटो *">Dealer Bill Photo *</label>
                <div class="upload-section">
                    <label for="dealerBillPhoto" class="upload-button">
                        <i class="fas fa-upload"></i> <span data-en="Upload" data-hi="अपलोड करें">Upload</span>
                        <input type="file" id="dealerBillPhoto" name="bill_img" accept="image/*" style="display: none;"  required>
                    </label>
                    <a href="#" class="viewsample" data-href="" data-title="" data-en="view sample" data-hi="नमूना देखें">View Sample</a>
                </div>
				
                <div class="invalid-feedback" data-en="Dealer bill photo is required." data-hi="डीलर बिल फोटो आवश्यक है।"></div>
				
            </div>
			<div id="amfdiv">
				<div class="mb-3 form-group">
					<label class="form-label" data-en="Dealer Bill Photo *" data-hi="डीलर बिल फोटो *">AMF Panel Connection Photo *</label>
					<div class="upload-section">
						<label for="amfconimg" class="upload-button">
							<i class="fas fa-upload"></i> <span data-en="Upload" data-hi="अपलोड करें">Upload</span>
							<input type="file" id="amfconimg" name="amf_con_img" style="display: none;"  accept="image/*">
						</label>
						<a href="#" class="viewsample" data-href="<?=BASE_PATH?>images/sample/srconnection.jpg" data-title="AMP Panel Connection Photo" data-en="view sample" data-hi="नमूना देखें">view sample</a>
					</div>
					
					<div class="invalid-feedback" data-en="Dealer bill photo is required." data-hi="डीलर बिल फोटो आवश्यक है।"></div>
					
				</div>
				<div class="mb-3 form-group">
					<label class="form-label" data-en="Dealer Bill Photo *" data-hi="डीलर बिल फोटो *">Generator Connection Photo *</label>
					<div class="upload-section">
						<label for="genconimg" class="upload-button">
							<i class="fas fa-upload"></i> <span data-en="Upload" data-hi="अपलोड करें">Upload</span>
							<input type="file" id="genconimg" name="gen_con_img"  style="display: none;" accept="image/*">
						</label>
						<a href="#" data-en="view sample" data-href="<?=BASE_PATH?>images/sample/srproduct-connection.jpg" data-title="Product Connection Photo" data-hi="नमूना देखें">view sample</a>
					</div>
					<div class="invalid-feedback" data-en="Dealer bill photo is required." data-hi="डीलर बिल फोटो आवश्यक है।"></div>
				</div>
				<div class="mb-3 form-group">
					<label class="form-label" data-en="Dealer Bill Photo *" data-hi="डीलर बिल फोटो *">Generator Name and Model *</label>
					<div class="upload-section">
						<label for="genname" class="upload-button">
							<input type="text" name="gen_name" class="form-control" id="genname" placeholder="Generator Name and Model" value="<?=$cprd['gen_name']?>" >
						</label>
						
					</div>
					<div class="invalid-feedback" data-en="Generator Name and Model photo is required." data-hi="डीलर बिल फोटो आवश्यक है।"></div>
				</div>
				
			</div>
            <div class="mb-3 form-group">
                <label class="form-label" data-en="Product Installation Photo *" data-hi="उत्पाद स्थापना फोटो *">Product Installation Photo *</label>
                <div class="upload-section">
                    <label for="productInstallationPhoto" class="upload-button">
                        <i class="fas fa-upload"></i> <span data-en="Upload" data-hi="अपलोड करें">Upload</span>
                        <input type="file" name="install_img" id="productInstallationPhoto" accept="image/*" style="display: none;" required>
                    </label>
                    <a href="#" class="viewsample" data-href="<?=BASE_PATH?>images/sample/srproduct-installation.jpg" data-title="Product Installation Photo" data-en="view sample" data-hi="नमूना देखें">View Sample</a>
                </div>
                <div class="invalid-feedback" data-en="Product installation photo is required." data-hi="उत्पाद स्थापना फोटो आवश्यक है।"></div>
            </div>
            <div class="mb-3 form-group">
                <label class="form-label" data-en="Selfie with Product *" data-hi="उत्पाद के साथ सेल्फी *">Selfie with Product *</label>
                <div class="upload-section">
                    <label for="selfieWithProduct" class="upload-button">
                        <i class="fas fa-upload"></i> <span data-en="Upload" data-hi="अपलोड करें">Upload</span>
                        <input type="file" name="selfie_prd_img" id="selfieWithProduct" accept="image/*" style="display: none;" required>
                    </label>
                    <a href="#" class="viewsample" data-href="<?=BASE_PATH?>images/sample/srselfiewith-product.jpg" data-title="Selfie With Product Photo" data-en="View Sample" data-hi="नमूना देखें">View Sample</a>
                </div>
                <div class="invalid-feedback" data-en="Selfie with product is required." data-hi="उत्पाद के साथ सेल्फी आवश्यक है।"></div>
            </div>-->

            <div class="d-flex justify-content-between mt-4 mb-4">
                <button type="button" class="btn btn-secondary" id="backBtn3" data-en="← Back" data-hi="← पीछे">← Back</button>
                <button type="button" class="btn btn-danger" id="nextBtn3" data-en="Next →" data-hi="अगला →">Next →</button>
            </div>
			</form>
        </div>

        <!-- Step 4: Confirmation/Submit -->
        <div class="form-step" id="step4">
			<form method="post" id="step4form" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="<?=$post_id?>" />
			<input type="hidden" name="method" value="step4" />
			
            <h3 data-en="Confirmation" data-hi="पुष्टिकरण">Confirmation</h3>
            <p data-en="Please review your details before submitting." data-hi="कृपया सबमिट करने से पहले अपने विवरण की समीक्षा करें।">Please review your details before submitting.</p>

            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title" data-en="Summary" data-hi="सारांश">Summary</h5>
                    <p data-en="User Type:" data-hi="उपयोगकर्ता प्रकार:">User Type: <span id="summaryUserType"></span></p>
                    <p data-en="Name:" data-hi="नाम:">Name: adafsdf<span id="summaryName"></span></p>
                    <p data-en="Mobile:" data-hi="मोबाइल:">Mobile: <span id="summaryMobile"></span></p>
                    <p data-en="Location:" data-hi="स्थान:">Location: <span id="summaryLocation"></span></p>
					<p data-en="Address:" data-hi="पता:">Address: <span id="summaryAddress"></span></p>
                    <p data-en="Purchase Date:" data-hi="खरीद की तारीख:">Purchase Date: <span id="summaryPurchaseDate"></span></p>
                    <!-- Add more summary details as needed -->
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4 mb-4">
                <button type="button" class="btn btn-secondary" id="backBtn4" data-en="← Back" data-hi="← पीछे">← Back</button>
                <button type="button" class="btn btn-danger" id="submitBtn" data-en="Submit" data-hi="जमा करें">Submit</button>
            </div>
			</form>
        </div>
    </div>

    <!-- Custom Popup Modal (for general confirmation) -->
    <div id="customModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="close-button">&times;</span>
            <h4 data-en="Proceed to next step?" data-hi="अगले चरण पर आगे बढ़ें?">Proceed to next step?</h4>
            <p data-en="Please confirm you want to move to the next section." data-hi="कृपया पुष्टि करें कि आप अगले अनुभाग पर जाना चाहते हैं।">Please confirm you want to move to the next section.</p>
            <button type="button" class="btn btn-secondary" id="cancelProceed" data-en="Cancel" data-hi="रद्द करें">Cancel</button>
            <button type="button" class="btn btn-danger" id="confirmProceed" data-en="Proceed" data-hi="आगे बढ़ें">Proceed</button>
        </div>
    </div>

    <!-- OTP Popup Modal -->
    <div id="otpModal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="close-button otp-close-button">&times;</span>
            <h4 data-en="Enter OTP" data-hi="ओटीपी दर्ज करें">Enter OTP</h4>
            <p data-en="A 4-digit OTP has been sent to your mobile number." data-hi="आपके मोबाइल नंबर पर 4 अंकों का ओटीपी भेजा गया है।">A 4-digit OTP has been sent to your mobile number.</p>
            <div class="mb-3">
                <input type="number" class="form-control text-center" id="otpInput" placeholder="Enter OTP" maxlength="4">
            </div>
			<div id="otpstatus"></div>
            <button type="button" class="btn btn-danger" id="submitOtpBtn" data-en="Submit OTP" data-hi="ओटीपी जमा करें">Submit OTP</button>
        </div>
    </div>
	
	
    <div class="call-support-footer">
        <a href="tel:+919650856175"><i class="fas fa-phone-alt"></i> Call Get Support +919650856175 to fill the form</a>
    </div>
	
	
  
    <script>
        $(document).ready(function() {
		////////////video //////////	
			
const TARGET_VIDEO_BPS = 700_000;
const TARGET_AUDIO_BPS = 64_000;

function pickSupportedMime() {
  const mimes = [
    'video/mp4;codecs=avc1,mp4a',
    'video/webm;codecs=vp9,opus',
    'video/webm;codecs=vp8,opus',
    'video/webm'
  ];
  for (const t of mimes) {
    if (MediaRecorder.isTypeSupported(t)) return t;
  }
  return '';
}

async function compressVideo(file){
  const mimeType = pickSupportedMime();
  if(!mimeType){
    alert("❌ No supported format found in browser");
    return null;
  }

  const video = document.createElement("video");
  video.src = URL.createObjectURL(file);
  await video.play();
  video.pause();

  const stream = video.captureStream ? video.captureStream() : video.mozCaptureStream();
  const recorder = new MediaRecorder(stream, {
    mimeType,
    videoBitsPerSecond: TARGET_VIDEO_BPS,
    audioBitsPerSecond: TARGET_AUDIO_BPS
  });

  let chunks = [];
  recorder.ondataavailable = e => { if(e.data.size) chunks.push(e.data); };

  return new Promise(resolve=>{
    recorder.onstop = ()=>{
      const blob = new Blob(chunks,{type:mimeType.split(";")[0]});
      resolve(blob);
    };
    recorder.start();
    video.currentTime = 0;
    video.play();
    video.onended = ()=> recorder.stop();
  });
}	
			
			
		/////video end /////////////	
	$('#step1form,#stepe2form,#stepc2form,#step3form').on('keyup keypress', function(e) {
		  var keyCode = e.keyCode || e.which;
		  if (keyCode === 13) { 
			e.preventDefault();
			return false;
		  }
		});	
		
			$("body").on("click",".viewsample",function(e){
				e.preventDefault();
				$("#sampletitle").html($(this).attr("data-title"));
				//$("#sampleimg").attr("src",$(this).attr("data-href"));
				$("#sampleVModal").css('display', 'flex');
				
				const video = document.getElementById("myVideo");
				video.muted = false;

				video.currentTime = 0; 

				video.play().catch(err => {
					console.log("Play error:", err);
				});	

			});
		
		////////////////////////	
            let currentStep = 1;
            let userType = $('input[name="userType"]:checked').val(); // Default user type
            let isAMF = '<?=$objmaster->cat_name($prd['cat_id'])?>'; // Default user type
            let selectedLanguage = $('input[name="language"]:checked').val(); // Default language
            let currentOtpButton = null; // To store reference to the button that triggered OTP
			if(isAMF=='AMF Panel'){
				$("#amfdiv").show();
				$("#amfconimg").attr("required");
				$("#genconimg").attr("required");
				$("#genname").attr("required");
			}else{
				$("#amfdiv").hide();
				$("#amfconimg").removeAttr("required");
				$("#genconimg").removeAttr("required");
				$("#genname").removeAttr("required");
			}
			
            // Function to update language
            function updateLanguage(lang) {
                $('[data-en], [data-hi]').each(function() {
                    const element = $(this);
                    if (lang === 'hi' && element.data('hi')) {
                        element.text(element.data('hi'));
                    } else if (lang === 'en' && element.data('en')) {
                        element.text(element.data('en'));
                    }
                });
                // Update validation messages
                $('.invalid-feedback').each(function() {
                    const feedbackElement = $(this);
                    if (lang === 'hi' && feedbackElement.data('hi')) {
                        feedbackElement.text(feedbackElement.data('hi'));
                    } else if (lang === 'en' && feedbackElement.data('en')) {
                        feedbackElement.text(feedbackElement.data('en'));
                    }
                });
            }

            // Initial language update
            updateLanguage(selectedLanguage);

            // Language change listener
            $('input[name="language"]').on('change', function() {
                selectedLanguage = $(this).val();
                updateLanguage(selectedLanguage);
            });

            // Function to show a specific step with slide effect
            function showStep(stepNumber, direction = 'next') {
                const $currentActiveStep = $('.form-step.active');
                let targetStepId;

                // Determine the correct ID for the next step
                if (stepNumber === 2) {
                    targetStepId = userType === 'electrician' ? 'step2-electrician' : 'step2-customer';
                } else {
                    targetStepId = `step${stepNumber}`;
                }
                const $nextStep = $(`#${targetStepId}`);

                if ($nextStep.length === 0) {
                    console.error("Target step not found:", targetStepId);
                    return;
                }

                // Animate the current active step out
                if ($currentActiveStep.length > 0 && $currentActiveStep[0] !== $nextStep[0]) {
                    $currentActiveStep.removeClass('active');
                    if (direction === 'next') {
                        $currentActiveStep.addClass('leaving-left'); // Slide left out
                    } else if (direction === 'back') {
                        $currentActiveStep.addClass('leaving-right'); // Slide right out
                    }
                    // After the transition, reset its position to absolute and off-screen
                    setTimeout(() => {
                        $currentActiveStep.css('position', 'absolute').css('transform', 'translateX(100%)').removeClass('leaving-left leaving-right');
                        $currentActiveStep.css('opacity', '0'); // Ensure it's hidden
                    }, 500); // Matches CSS transition duration
                }

                // Prepare the next step to slide in
                // Ensure all non-active steps are off-screen and absolute
                $('.form-step').not($nextStep).each(function() {
                    if (!$(this).hasClass('active')) {
                        $(this).css({
                            'position': 'absolute',
                            'transform': 'translateX(100%)',
                            'opacity': '0'
                        });
                    }
                });

                // Set initial position for the incoming step
                if (direction === 'next') {
                    $nextStep.css('transform', 'translateX(100%)').css('opacity', '0').css('position', 'absolute');
                } else if (direction === 'back') {
                    $nextStep.css('transform', 'translateX(-100%)').css('opacity', '0').css('position', 'absolute');
                }

                // A small timeout to ensure the initial transform is applied before the transition to 0
                setTimeout(() => {
                    $nextStep.addClass('active').css('transform', 'translateX(0)').css('opacity', '1').css('position', 'relative');
                    // Adjust container height based on the active step's content
                    $('.form-container').css('height', $nextStep.outerHeight(true) + $('.form-header').outerHeight(true) + 60);
                }, 10);

                currentStep = stepNumber;
            }

            // Adjust container height on window resize
            $(window).on('resize', function() {
                const $activeStep = $('.form-step.active');
                if ($activeStep.length) {
                    $('.form-container').css('height', $activeStep.outerHeight(true) + $('.form-header').outerHeight(true) + 60);
                }
            }).trigger('resize'); // Trigger on load

            // Validation function
            function validateStep(stepId) {
                let isValid = true;
                $(`#${stepId} .form-group input[required], #${stepId} .form-group select[required], #${stepId} .form-group textarea[required], #${stepId} .upload-button input[type="file"][required]`).each(function() {
                    if ($(this).val().trim() === '' || ($(this).attr('type') === 'file' && !$(this)[0].files.length)) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                        $(this).siblings('.invalid-feedback').text($(this).siblings('.invalid-feedback').data(selectedLanguage));
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).siblings('.invalid-feedback').text(''); // Clear feedback
                    }
                });

                // Specific validation for mobile number (simple check for now)
                if (stepId === 'step2-electrician' || stepId === 'step2-customer') {
                    const mobileInput = $(`#${stepId} input[type="text"][id$="Mobile"]`);
                    if (mobileInput.length && mobileInput.val().trim() === '') {
                        isValid = false;
                        mobileInput.addClass('is-invalid');
                        mobileInput.siblings('.invalid-feedback').text(mobileInput.siblings('.invalid-feedback').data(selectedLanguage));
                    } else {
                        mobileInput.removeClass('is-invalid');
                        mobileInput.siblings('.invalid-feedback').text('');
                    }
                }
                return isValid;
            }

            // Clear validation on input change
            $('.form-group input, .form-group select, .form-group textarea').on('input change', function() {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').text(''); // Clear feedback
            });
            // For file inputs, clear validation when a file is selected
            $('.upload-button input[type="file"]').on('change', function() {
                if ($(this)[0].files.length > 0) {
                    $(this).removeClass('is-invalid');
                    $(this).siblings('.invalid-feedback').text('');
                }
            });


            // Show general confirmation modal and handle confirmation
            let proceedCallback = null;

            function showGeneralModal(callback) {
                $('#customModal').css('display', 'flex');
                proceedCallback = callback;
            }

            $('#confirmProceed').on('click', function() {
                $('#customModal').css('display', 'none');
                if (proceedCallback) {
                    proceedCallback();
                }
            });

            $('#cancelProceed, .close-button').on('click', function() {
                $('#customModal').css('display', 'none');
                proceedCallback = null;
            });

            // Show OTP modal
            function showOtpModal(otpButton) {
                currentOtpButton = otpButton;
                $('#otpModal').css('display', 'flex');
                $('#otpInput').val(''); // Clear previous OTP
				$('#otpstatus').html('');
            }

            // Handle OTP submission
            $('#submitOtpBtn').on('click', function() {
				const otp = $('#otpInput').val();
				var userType = $('input[name="userType"]:checked').val();
				const mobileInput = $('#electricianMobile');
                const mobileNumber = mobileInput.val().trim();
				if(otp!='' && otp.length>3){
					var datastr="_token=<?php echo $post_id;?>&mobile="+mobileNumber+"&usertype="+userType+"&otp="+otp+"&method=checkotp";
				
					$.ajax({
						url:'<?php echo BASE_PATH;?>Controller/Master/',
						method:'post',
						data:datastr,
						success:function(data){
							var response=(JSON.parse(data));
							if(response.type=="success")
							{
								$("#otpstatus").html(selectedLanguage === 'hi' ? 'ओटीपी सत्यापित!' : 'OTP Verified!');
								$('#otpModal').css('display', 'none');
								if (currentOtpButton) {
									currentOtpButton.addClass('btn-verified').text(selectedLanguage === 'hi' ? 'सत्यापित' : 'Verified').prop('disabled', true);
									currentOtpButton.siblings('input[type="text"]').prop('disabled', true); // Disable mobile input
								}
								$("#nextBtn1").show();
								$("#nextBtn1").trigger("click");
								if($("#customerMobile").val()!=""){
									$("#nextBtnElectrician").show();
									$("#customerMobile").prop("readonly",true);
									$("#customerMobile").removeClass('is-invalid')
									.closest('.form-group')
									.find('.invalid-feedback')
									.text('');
									
								}else{
									window.location.reload();
								}
								//$("#nextBtnElectrician").show();
								/*if($('input[name="userType"]:checked').val()=='customer'){
									$("#nextBtn1").trigger("click");
								}else if($('input[name="userType"]:checked').val()=='electrician'){
									$("#nextBtnElectrician").trigger("click");
								}*/
							}else{
							$("#otpstatus").html(selectedLanguage === 'hi' ? 'अमान्य ओटीपी। कृपया पुनः प्रयास करें।' : 'Invalid OTP. Please try again.');
							}
						}
					});
				} else {
                    alert(selectedLanguage === 'hi' ? 'अमान्य ओटीपी। कृपया पुनः प्रयास करें।' : 'Invalid OTP. Please try again.');
                }
            });

            $('.otp-close-button').on('click', function() {
                $('#otpModal').css('display', 'none');
            });
			$('.sample-close-button').on('click', function() {
                $('#sampleModal').css('display', 'none');
            });

            // Navigation logic for Step 1
            $('#nextBtn1').on('click', function() {
				$("#step1form").submit();
            });
			$("body").on("submit","#step1form",function(e){
				e.preventDefault();
				$.ajax({
					url:'<?php echo BASE_PATH;?>Controller/Master/',
					type:'post',
					data:new FormData(this),
					contentType: false,       
					cache: false,            
					processData:false,
					success:function(data){
						var response=(JSON.parse(data));
						if(response.type=="success")
						{
							
							userType = $('input[name="userType"]:checked').val();
							showStep(2, 'next');
							//window.location.reload();	
							/*showGeneralModal(function() {
								
							});*/
						}else{
							$("#racmsg").html(response.message);
						}	
					}
					
				});
			});
            // Navigation logic for Electrician Details
            $("#nextBtnElectrician").on('click', function() {
				var mob=$("#customerMobile").val();
				var fname=$("#customerFirstName").val();
				if(mob=="" && fname==""){return false;}
				if (validateStep('step2-electrician')) {
					$("#stepe2form").submit();
                }else{
                    alert(selectedLanguage === 'hi' ? 'कृपया सभी आवश्यक फ़ील्ड भरें।' : 'Please fill all required fields.');
                }
            });
			$("body").on("submit","#stepe2form",function(e){
				e.preventDefault();
				$.ajax({
					url:'<?php echo BASE_PATH;?>Controller/Master/',
					type:'post',
					data:new FormData(this),
					contentType: false,       
					cache: false,            
					processData:false,
					success:function(data){
						//alert(data);
						var response=(JSON.parse(data));
						if(response.type=="success")
						{
							userType = $('input[name="userType"]:checked').val();
								showStep(3, 'next');
							/*showGeneralModal(function() {
								
							});*/
						}else{
							$("#racmsg").html(response.message);
						}	
					}
					
				});
			});
			
            $('#backBtnElectrician').on('click', function() {
                showStep(1, 'back');
            });

            // Navigation logic for Customer Details
            $('#nextBtnCustomer').on('click', function(e) {
				e.preventDefault();
				//alert("ok");
                if (validateStep('step2-customer')) {
					$("#stepc2form").submit();                    
                } else {
                    alert(selectedLanguage === 'hi' ? 'कृपया सभी आवश्यक फ़ील्ड भरें.' : 'Please fill all required fields.');
                }
            });
			$("body").on("submit","#stepc2form",function(e){
				e.preventDefault();
				$.ajax({
					url:'<?php echo BASE_PATH;?>Controller/Master/',
					type:'post',
					data:new FormData(this),
					contentType: false,       
					cache: false,            
					processData:false,
					success:function(data){
					//alert(data);
						var response=(JSON.parse(data));
						if(response.type=="success")
						{
							userType = $('input[name="userType"]:checked').val();
								showStep(3, 'next');
							/*showGeneralModal(function() {
								
							});*/
						}else{
							$("#racmsg").html(response.message);
						}	
					}
					
				});
			});
			
            $('#backBtnCustomer').on('click', function() {
                showStep(1, 'back');
            });

            // Navigation logic for Product Details
            $('#nextBtn3').on('click', function() {
                if (validateStep('step3')) {
                    $(this).attr("disabled",true).html("Wait...");
                        // Populate summary before going to step 4
                       $('#summaryUserType').text(userType === 'electrician' ? (selectedLanguage === 'hi' ? 'इलेक्ट्रीशियन' : 'Electrician') : (selectedLanguage === 'hi' ? 'ग्राहक' : 'Customer'));
                        if (userType === 'electrician') {
                            $('#summaryName').text($('#electricianFirstName').val() + ' ' + $('#electricianLastName').val());
							$('#summaryAddress').text($('#electricianAddress').val());
                            $('#summaryMobile').text($('#electricianMobile').val());
                            $('#summaryLocation').text($('#electricianCity').val() + ', ' + $('#electricianState').val());
                        } else {
                            $('#summaryName').text($('#customerFirstName').val() + ' ' + $('#customerLastName').val());
							$('#summaryAddress').text($('#customerAddress').val());
                            $('#summaryMobile').text($('#customerMobile').val());
                            $('#summaryLocation').text($('#customerCity').val() + ', ' + $('#customerState').val());
                        }
                        $('#summaryPurchaseDate').text($('#purchaseDate').val());
						$('#step3form').submit();
                    /*showGeneralModal(function() {
						
					});*/
                } else {
                    alert(selectedLanguage === 'hi' ? 'कृपया सभी आवश्यक फ़ील्ड भरें।' : 'Please fill all required fields.');
                }
            });
			/*$("body").on("submit","#step3form",function(e){
				var cnf=confirm("Are u sure to Upload final Confirmation");
				if(cnf==false){return false;}
				e.preventDefault();
				$.ajax({
					url:'<?php echo BASE_PATH;?>Controller/Master/',
					type:'post',
					data:new FormData(this),
					contentType: false,       
					cache: false,            
					processData:false,
					success:function(data){
					//alert(data);
						var response=(JSON.parse(data));
						if(response.type=="success")
						{
							//showStep(4, 'next');
							setTimeout($(function(){window.location='<?=BASE_PATH?>thanks';}),1000);
						}else{
							$("#racmsg").html(response.message);
						}	
					}
					
				});
			});*/
			

            $('#backBtn3').on('click', function() {
                // Determine which step 2 to go back to
                showStep(2, 'back'); // Go back to step 2, show the appropriate form based on userType
            });

            // Navigation logic for Confirmation
            $('#backBtn4').on('click', function() {
				
                showStep(3, 'back');
            });

            $('#submitBtn').on('click', function() {
				$("#step4form").submit();
            });
		$("body").on("change","#videoInput",function(){
			var file=$(this).files[0];
			if(file){
				$(this).removeClass('is-invalid')
				.closest('.form-group')
				.find('.invalid-feedback')
				.text('');
			}
		});
		
		$("body").on("submit","#step3form",async function(e){
			e.preventDefault();
				var cnf=confirm("Are u sure to Upload final Confirmation");
				if(cnf==false){return false;}
			const file = document.getElementById("videoInput").files[0];
			if(!file){
				$("#uploadStatus").html("❌ Please select a video.");
				$("#nextBtn3").attr("disabled",false).html("Submit");
				return;
			}
			if(file.size > 20*1024*1024){
				$("#uploadStatus").html("❌ File too large (max 20MB)");
				$("#nextBtn3").attr("disabled",false).html("Submit");
				return;
			}

			$("#uploadStatus").html("⏳ Compressing video, please wait...");

			const compressedBlob = await compressVideo(file);
			if(!compressedBlob){
				$("#uploadStatus").html("❌ Compression failed");
				$("#nextBtn3").attr("disabled",false).html("Submit");
				return;
			}

			// Show preview
			$("#preview").attr("src", URL.createObjectURL(compressedBlob)).show();

			// Prepare form data
			let formData = new FormData(this);
			formData.delete("video");
			const filename = "video_" + Date.now() + (compressedBlob.type.includes("mp4") ? ".mp4" : ".webm");
			formData.append("video", compressedBlob, filename);

			$.ajax({
				url:'<?php echo BASE_PATH;?>Controller/Master/',
				type:'post',
				data: formData,
				contentType: false,
				cache: false,
				processData:false,
				success:function(data){
					/*alert(data);*/
					var response = JSON.parse(data);
					if(response.type=="success"){
						$("#uploadStatus").css("color","green").html("✅ Form submitted successfully!");
						setTimeout($(function(){window.location='<?=BASE_PATH?>thanks';}),1000);
					}else{
						$("#uploadStatus").css("color","red").html(response.message);
					}
				},
				error:function(){
					$("#uploadStatus").css("color","red").html("❌ Upload failed");
				}
			});
		});	
			
			
			
			
			
			
			
			
			
			
			
			/*$("body").on("submit","#step4form",function(e){
				e.preventDefault();
				$.ajax({
					url:'<?php echo BASE_PATH;?>Controller/Master/',
					type:'post',
					data:new FormData(this),
					contentType: false,       
					cache: false,            
					processData:false,
					success:function(data){
					//alert(data);
						var response=(JSON.parse(data));
						if(response.type=="success")
						{
							alert(selectedLanguage === 'hi' ? 'फॉर्म सफलतापूर्वक जमा किया गया!' : 'Form submitted successfully!');
							window.location.reload();
						}else{
							$("#racmsg").html(response.message);
						}	
					}
					
				});
			});*/
			
            // Handle user type change on Step 1 dynamically
            $('input[name="userType"]').on('change', function() {
                const newUserType = $(this).val();
                if (currentStep === 1) {
                    userType = newUserType; // Just update userType, showStep will handle it on nextBtn1 click
                } else if (currentStep === 2) {
                    // If currently on step 2, and user changes type, we need to switch forms
                    const $currentActiveStep2 = userType === 'electrician' ? $('#step2-electrician') : $('#step2-customer');
                    const $newStep2 = newUserType === 'electrician' ? $('#step2-electrician') : $('#step2-customer');

                    if ($currentActiveStep2[0] !== $newStep2[0]) { // Only animate if changing forms
                        // Animate current form out (slide up)
                        $currentActiveStep2.removeClass('active slide-down-in').addClass('slide-up-out');

                        // Prepare new form to slide in (from bottom)
                        $newStep2.css({
                            'position': 'absolute',
                            'transform': 'translateY(100%)',
                            'opacity': '0'
                        });

                        setTimeout(() => {
                            $newStep2.removeClass('slide-up-out').addClass('active slide-down-in');
                            // Ensure the old form is fully hidden and reset
                            $currentActiveStep2.css({
                                'position': 'absolute',
                                'transform': 'translateY(100%)',
                                'opacity': '0'
                            }).removeClass('slide-up-out'); // Remove the out class after transition
                            userType = newUserType; // Update userType after transition starts
                            $('.form-container').css('height', $newStep2.outerHeight(true) + $('.form-header').outerHeight(true) + 60);
                        }, 500); // Match CSS transition duration
                    } else {
                        userType = newUserType; // No animation needed if staying on the same form type
                    }
                }

                // Apply electrician specific styles to the form container if selected
                if (newUserType === 'electrician') {
                    $('.form-container').addClass('electrician-details-form-active');
                } else {
                    $('.form-container').removeClass('electrician-details-form-active');
                }
            });

            // OTP button click handlers
            $('#getOtpElectricianBtn').on('click', function() {
                const mobileInput = $('#electricianMobile');
                const mobileNumber = mobileInput.val().trim();
                if (mobileNumber && (validateMobileNumber(mobileNumber))) {
                    mobileInput.removeClass('is-invalid');
                    mobileInput.siblings('.invalid-feedback').text('');
					sendOTP(mobileNumber);
                    showOtpModal($(this)); // Pass the button element
                } else {
                    mobileInput.addClass('is-invalid');
                    mobileInput.siblings('.invalid-feedback').text(selectedLanguage === 'hi' ? 'सही मोबाइल नंबर आवश्यक है।' : 'Valid Mobile number is required.');
                }
            });

            $('#getOtpCustomerBtn').on('click', function() {
                const mobileInput = $('#customerMobile');
                const mobileNumber = mobileInput.val().trim();
                if (mobileNumber && (validateMobileNumber(mobileNumber))) {
                    mobileInput.removeClass('is-invalid');
                    mobileInput.siblings('.invalid-feedback').text('');
					sendCOTP(mobileNumber);
                    showOtpModal($(this)); // Pass the button element
                } else {
                    mobileInput.addClass('is-invalid');
                    mobileInput.siblings('.invalid-feedback').text(selectedLanguage === 'hi' ? 'सही मोबाइल नंबर आवश्यक है।' : 'Valid Mobile number is required.');
                }
            });

            // Initial setup to hide all steps except the first one
            $('.form-step').not('#step1').css({
                'position': 'absolute',
                'transform': 'translateX(100%)',
                'opacity': '0'
            });
            // Ensure step1 is active and relative
            $('#step1').addClass('active').css({
                'position': 'relative',
                'transform': 'translateX(0)',
                'opacity': '1'
            });

            // Initial height adjustment
            $('.form-container').css('height', $('#step1').outerHeight(true) + $('.form-header').outerHeight(true) + 60);
	///////////////////////////////////////////

			function sendCOTP(mobileNumber){
				var datastr="_token=<?php echo $post_id;?>&userType="+userType+"&mobile="+mobileNumber+"&method=sendcotp";
				$.ajax({
					url:'<?php echo BASE_PATH;?>Controller/Master/',
					method:'post',
					data:datastr,
					success:function(data){
						
						var response=(JSON.parse(data));
						if(response.type=="success")
						{
							//$("#displaydata").html(response.message);
							//alert(response.message);
						}
					}
				});
			}


	
			function sendOTP(mobileNumber){
				var datastr="_token=<?php echo $post_id;?>&userType="+userType+"&mobile="+mobileNumber+"&method=sendotp";
				$.ajax({
					url:'<?php echo BASE_PATH;?>Controller/Master/',
					method:'post',
					data:datastr,
					success:function(data){
						
						var response=(JSON.parse(data));
						if(response.type=="success")
						{
							//$("#displaydata").html(response.message);
							//alert(response.message);
						}else{
							window.location.reload();
						}
					}
				});
			}
			
			function validateMobileNumber(number) {
				const mobileRegex = /^[0-9]{10}$/;
				return mobileRegex.test(number);
			}
		//////////////////////////////
		const mob='<?=$_SESSION['mobile']?>';
		if(mob!=""){
			//alert(mob);
			$("#nextBtn1").trigger("click");
		}		
        });
    </script>
	
	
 
 
 
</section>
        <!-- /Store -->


   </div>
 <?php include_once"config/foot.php";?>     
   
</body>

	

</html>
<div id="sampleVModal" class="custom-modal" style="z-index:1051;">
	<div class="custom-modal-content">
		<span class="close-button sample-close-button" data-dismiss="modal">&times;</span>
		<h4 id="sampletitle">Sample Title</h4>
		<div class="mb-3">
			<video id="myVideo" width="100%" height="315" autoplay muted controls>
			  <source src="<?=BASE_PATH?>video/sample.mp4" type="video/mp4">
			  Your browser does not support the video tag.
			</video>
		</div>
	</div>
</div>
<div id="sampleModal" class="custom-modal" style="z-index:1051;">
	<div class="custom-modal-content">
		<span class="close-button sample-close-button" data-dismiss="modal">&times;</span>
		<h4 id="sampletitle">Sample Title</h4>
		<div class="mb-3">
			<img src="<?=BASE_PATH?>images/sample/srconnection.jpg" id="sampleimg" style="width:100%" >
		</div>
	</div>
</div>