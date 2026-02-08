<?php 
include_once 'config/config.inc.php';
?>
<!DOCTYPE html>


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">



<head>
    <meta charset="utf-8">
    <title>SubTech Service & Support - Claim Warranty, Register Issues & Track</title>
	 <meta name="description" content="SubTech makes support easy. Use this page to effortlessly file a warranty claim, register a new service request/complaint, and track the real-time status of your case. Your satisfaction is our priority.">
    <?php include_once"config/head.php";?>

 <style>
        /* Custom Colors and Utilities */
        :root {
            --custom-red: #e40006;
            --custom-red-light: #FEEEEE;
            --custom-green: #25D366;
            --custom-blue: #007bff; /* Standard blue for email icon */
            --text-color: #333;
        }

       

        /* Styling for the main Customer Care card */
        .care-card {
            border-radius: 1.5rem; /* Large rounded corners */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            max-width: 680px;
            margin-top: 30px;
            margin-bottom: 50px;
        }

        /* Active Tab Styling */
        .nav-tabs .nav-link.active {
            color: var(--custom-red) !important;
            background-color:#ffe2e2;
            border-color: transparent transparent var(--custom-red) transparent !important;
            border-width: 2px;
            font-weight: 600;
			 border-radius: 10px;
        }
        .nav-tabs .nav-link {
            color: var(--text-color) !important;
            border: none;
            padding:0.8rem 1rem;
            transition: color 0.3s;
        }
        .nav-tabs {
            border-bottom: 1px solid #e9ecef;
        }

        /* Icon Circle Styling */
        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }
        /* Style for the larger icon circle in the tab content */
        .icon-lg {
            width: 64px;
            height: 64px;
            margin-bottom: 1rem;
        }
        .icon-red {
            background-color: var(--custom-red-light);
            color: var(--custom-red);
        }
        .icon-green {
            background-color: rgba(37, 211, 102, 0.1);
            color: var(--custom-green);
        }
        .icon-blue {
            background-color: rgba(0, 123, 255, 0.1);
            color: var(--custom-blue);
        }

        /* Button Styling */
        .btn-custom-red {
            background-color: var(--custom-red);
            border-color: var(--custom-red);
            color: white;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            transition: background-color 0.2s, transform 0.1s;
        }
        .btn-custom-red:hover {
            background-color: #c42738;
            border-color: #c42738;
            color: white;
            transform: translateY(-1px);
        }
    </style>
	
	
</head>

<body>
	
	<?php include_once"config/header-top.php";?>

    <div id="wrapper">
     
	 <?php include_once"config/header.php";?>
	 
		
		
	
  <section style="background: #f1f1f1;" class="flat-spacing-5">
            
			<div class="container-fluid mx-auto text-center py-5" style="max-width: 1400px;">
        <!-- 1. Header Section -->
        <h1 class="display-5 fw-bold mb-2" style="color: var(--custom-red);">Customer Care</h1>
        <p class="text-dark mb-5">We're here to help with service, warranty and product support.</p>

        <!-- 2. Main Tabbed Card -->
        <div class="card bg-white care-card mx-auto border-0">
            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs justify-content-center mb-4" id="careTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active d-flex align-items-center" id="service-tab" data-bs-toggle="tab" data-bs-target="#service" type="button" role="tab" aria-controls="service" aria-selected="true">
                        <!-- Red Handset Icon (Service Request) -->
                        <svg style="width: 1.25rem; height: 1.25rem; margin-right: 0; fill: currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.91 15.17c-.15-.56-.63-1.01-1.2-1.12l-3.32-.6a.997.997 0 0 0-1.01.24l-1.92 1.72c-2.3-1.47-4.14-3.32-5.6-5.6l1.72-1.92a.997.997 0 0 0 .24-1.01l-.6-3.32c-.11-.57-.56-1.05-1.12-1.2L4.03 2.09c-.56-.15-1.15.14-1.33.68l-.48 1.45c-.3 1-.03 2.15.7 3.06l.33.39c4.01 4.75 8.89 9.63 13.64 13.64l.39.33c.91.73 2.06 1 3.06.7l1.45-.48c.54-.18.83-.77.68-1.33l-1.18-4.48z"/></svg>
                        Service Request
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link d-flex align-items-center" id="warranty-tab" data-bs-toggle="tab" data-bs-target="#warranty" type="button" role="tab" aria-controls="warranty" aria-selected="false">
                        <!-- Shield Icon (For Warranty) -->
                        <svg style="width: 1.25rem; height: 1.25rem; margin-right: 0; fill: currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.76-7 8.85V12h-7V6.3l7-3.11v8.79z"/></svg>
                        For Warranty
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link d-flex align-items-center" id="track-tab" data-bs-toggle="tab" data-bs-target="#track" type="button" role="tab" aria-controls="track" aria-selected="false">
                        <!-- Search/Magnifying Glass Icon (Track Complaints) -->
                        <svg style="width: 1.25rem; height: 1.25rem; margin-right: 0rem; fill: currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                        Track Complaints
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content pt-1" id="careTabsContent">
                
                <!-- 2.1. Service Request Tab (Active) -->
                <div class="tab-pane fade show active" id="service" role="tabpanel" aria-labelledby="service-tab">
                    
                    <!--<h2 class="fs-4 fw-semibold">Enter Mobile Number</h2>
                    <p class="text-dark mb-1">We'll send you an OTP for verification</p>-->

                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-10 col-md-8 col-lg-8 border border-dark" style="background:#f9f9f9;margin-bottom:10px;border-radius:10px;">
                           <form method="post" class="form-default" id="cnt_form" style="text-align:left; margin-bottom:10px;padding:20px;" enctype="multipart/form-data">
					
					<input type="hidden" name="_token" value="<?=$post_id;?>" />
					<input type="hidden" name="method" value="Complains" />
							<div class="wrap">
								 <div class="cols">
									<fieldset>
										<label for="name">Product Serial Number*</label>
										<input name="serial_no" id="" class="radius-8" type="text" required="">
									</fieldset>
								   
								</div>

								<div class="cols">
									<fieldset>
										<label for="name">Your name*</label>
										<input name="name" id="name" class="radius-8 name" type="text" required>
									</fieldset>
									<fieldset>
										<label for="email">Your Mobile*</label>
										<input name="mobile" id="mob" class="radius-8" type="number" maxlength="10" required>
									</fieldset>
								</div>
								
								<div class="cols">
									<fieldset>
										<label for="name">Your Email*</label>
										<input name="email" id="email" class="radius-8" type="email" required>
									</fieldset>
								   
								</div>
								
								<div class="cols">
									<fieldset>
										<label for="name">Upload Image</label>
										<input name="image" id="name" class="radius-8" type="file">
									</fieldset>
								</div>


								<div class="cols">
									<fieldset class="textarea">
										<label for="message">Problem/Reason*</label>
										<textarea name="message" id="message" required class="radius-8"></textarea>
									</fieldset>
								</div>
								
							
								<div id="msg"></div>
								
								<div class="button-submit send-wrap">
									<button class="tf-btn animate-btn" id="btnSubmit" type="submit">Submit	</button>
								</div>
							</div>
						</form>
                        </div>
                    </div>
                </div>

                <!-- 2.2. For Warranty Tab (Placeholder) -->
                <div class="tab-pane fade" id="warranty" role="tabpanel" aria-labelledby="warranty-tab">
                    <h2 class="fs-4 fw-semibold">Warranty Claim</h2>
                    <p class="text-dark">Please enter your product details below to check warranty status or initiate a claim.</p>
                    <div class="p-4 bg-light rounded-3 mx-auto my-4 border border-dark" style="max-width: 350px;">
                        <form method="post" class="form-default" id="cnt_form2" >
							<input type="hidden" name="_token" value="<?=$post_id;?>" />
							<input type="hidden" name="method" value="warranty_check" />
							<label for="productSerial" class="form-label small text-dark">Product Serial Number</label>
							<input type="text" class="form-control" name="serial_no" id="productSerial" placeholder="e.g., SN12345678" required />
							<button class="btn btn-danger w-100 mt-3" type="submit">Check Warranty</button>
						</form>
						<div id="msg1"></div>
                    </div>
					
                </div>

                <!-- 2.3. Track Complaints Tab (Placeholder) -->
                <div class="tab-pane fade" id="track" role="tabpanel" aria-labelledby="track-tab">
                    <h2 class="fs-4 fw-semibold">Track Your Service Request</h2>
                    <p class="text-dakr">Enter your complaint/ticket ID to view the latest status.</p>
                    <!--<div class="p-4 bg-light rounded-3 mx-auto my-4 border border-dark" style="max-width: 350px;">
                        <label for="ticketId" class="form-label small text-dark">Ticket / Complaint ID</label>
                        <input type="text" class="form-control" id="ticketId" placeholder="e.g., TKT00123456">
                        <button class="btn btn-danger w-100 mt-3">Track Status</button>
                    </div>-->
                </div>
            </div>
        </div>

        <!-- 3. Get in touch with us. Section -->
        <h2 class="fs-3 fw-semibold mb-4 mt-5">Get in touch with us.</h2>

        <div class="row justify-content-center g-4">
            
            <!-- Contact Card 1: Speak to Us -->
            <div class="col-sm-10 col-md-6 col-lg-4">
                <div class="card bg-white p-4 shadow-sm rounded-3 h-100 d-flex flex-column align-items-center border-0">
                    <div class="icon-circle icon-red">
                        <!-- Handset Icon -->
                        <svg style="width: 1.5rem; height: 1.5rem; fill: currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.91 15.17c-.15-.56-.63-1.01-1.2-1.12l-3.32-.6a.997.997 0 0 0-1.01.24l-1.92 1.72c-2.3-1.47-4.14-3.32-5.6-5.6l1.72-1.92a.997.997 0 0 0 .24-1.01l-.6-3.32c-.11-.57-.56-1.05-1.12-1.2L4.03 2.09c-.56-.15-1.15.14-1.33.68l-.48 1.45c-.3 1-.03 2.15.7 3.06l.33.39c4.01 4.75 8.89 9.63 13.64 13.64l.39.33c.91.73 2.06 1 3.06.7l1.45-.48c.54-.18.83-.77.68-1.33l-1.18-4.48z"/></svg>
                    </div>
                    <h3 class="fs-5 fw-semibold mb-2">Speak to Us</h3>
                    <p class=" text-dark mb-4 flex-grow-1">Talk directly with our support team for immediate assistance.</p>
                    <a href="tel:918506060581" class="btn btn-custom-red w-100">Call</a>
                </div>
            </div>

            <!-- Contact Card 2: Chat with Us -->
            <div class="col-sm-10 col-md-6 col-lg-4">
                <div class="card bg-white p-4 shadow-sm rounded-3 h-100 d-flex flex-column align-items-center border-0">
                    <div class="icon-circle icon-green">
                        <!-- Chat Bubble Icon -->
                        <svg style="width: 1.5rem; height: 1.5rem; fill: currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H6l-2 2V4h16v12z"/></svg>
                    </div>
                    <h3 class="fs-5 fw-semibold  mb-2">Chat with Us</h3>
                    <p class=" text-dark mb-4 flex-grow-1">Connect with us on WhatsApp for quick support.</p>
				<a href="https://wa.me/919211034399" style="cursor: pointer!important" target="_blank" class="btn btn-custom-red w-100">Whatsapp</a>                   

                </div>
            </div>

            <!-- Contact Card 3: Write to Us -->
            <div class="col-sm-10 col-md-6 col-lg-4">
                <div class="card bg-white p-4 shadow-sm rounded-3 h-100 d-flex flex-column align-items-center border-0">
                    <div class="icon-circle icon-blue">
                        <!-- Envelope Icon -->
                        <svg style="width: 1.5rem; height: 1.5rem; fill: currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    </div>
                    <h3 class="fs-5 fw-semibold  mb-2">Write to Us</h3>
                    <p class=" text-dark mb-4 flex-grow-1">Send us an email and we'll get back to you soon.</p>
                    <a href="mailto:support@subtech.in" class="btn btn-custom-red w-100">Email</a>
                </div>
            </div>

        </div>
    </div>
	
	
			
			
			
			
			
        </section>
        <!-- /Store -->



	
		
	
		
		

       

	   <?php include_once"config/footer.php";?>








   </div>


 <?php include_once"modals/all.php";?>
   
 <?php include_once"config/mobile_menu.php";?>  
 <?php include_once"config/foot.php";?>     
   
   
   
   
   
     <script>  
 $(document).ready(function(){
   $("body").on("keypress",".name",function(e){
		var regex = /^[a-zA-Z\s]+$/; /// remove \s for space
		var key = String.fromCharCode(e.which);
		if (!regex.test(key)) {
			e.preventDefault(); // galat character block kar dega
		}
	});
	function validateMobileNumber(number) {
		const mobileRegex = /^[0-9]{10}$/;
		return mobileRegex.test(number);
	}

	$("body").on("submit","#cnt_form",function(e){
		e.preventDefault();
		var mob=$("#mob").val().trim();
		//alert(mob);
		if(mob && !validateMobileNumber(mob)){
			$("#msg").html("<span class='alert alert-danger'>Enter Valid Mobile Number</span>");
			$("#mob").focus();
			setTimeout(function(){$("#msg").html("");},2500);
			return false;
		}
		$("#btnSubmit").attr("disabled",true).html("Wait...");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/Master/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
			$("#btnSubmit").attr("disabled",false).html("Submit");
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#msg").html(response.message);
					setTimeout(function(){window.location.reload();},2500);
				}else{
					$("#msg").html(response.message);
				}	
			}
			
		});
	});
	$("body").on("submit","#cnt_form2",function(e){
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
					$("#msg1").html(response.message);
					//setTimeout(function(){window.location.reload();},2500);
				}else{
					$("#msg1").html(response.message);
				}	
			}
			
		});
	});
	
  });
  </script> 
   
   
   
   
   




   
   
</body>


</html>