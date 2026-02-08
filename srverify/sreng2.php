<?php include_once 'config/config.inc.php';?>
<!DOCTYPE html>

<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->


<head>
    <meta charset="utf-8">
    <title>Subtech Electronics</title>
	 <meta name="description" content="Subtech Electronics">
    <?php include_once"config/head.php";?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
    #fileInput {
      display: none; /* hide default input */
    }

    .upload-btn {
      
      
      color: white;
      border: none;
      cursor: pointer;
 
    }

    .upload-btn:hover {
      background-color: #45a049;
    }

    .file-name {
      margin-top: 10px;
      font-style: italic;
    }
  </style>
</head>

<body>
	
	
    <div id="wrapper">
     

		
		<div class="" style="min-height:30vh;background:#f7f7f7;     padding-bottom: 5px;     border-bottom-right-radius: 20px !important;
    border-bottom-left-radius: 20px !important;">
		<div class="col-md-4 mx-auto">
					<div class="text-center pt-2">
						 <img src="<?=BASE_PATH?>images/logo/logo.png" class="logo" alt="subtech logo">
                             <h6 for="name">Warranty Registration Form </h6>
						<p style="color: #9b9b9b;">Submit the form and claim 1-year warranty & get Cashback  <img src="<?=BASE_PATH?>images/cashboak.png" class="" alt="chasback"></p>
						</div>
						
						
					<div class="mb-4" style=" border-radius: 15px;   background: #fff;margin: 10px 8px; padding: 10px;">
						<table style="width:100%">
							<tr>
							<td> <img src="<?=BASE_PATH?>images/product1_home_menu.jpg" class="logo" alt="subtech logo" style="height:65px;     vertical-align: top;"></td>
							<td><h6 style="font-size:15px; line-hieght:1px">Automatic Motor Stator</h6><p style="color: #9b9b9b;">Royal . Heavy . 1.5HP
							<h6 style="font-size:15px; line-hieght:1px">Serial No: <b class="text-danger">F-25-3435767</b></h6>
							</td>
							</tr>
						</table>
					</div>
		  </div>
		</div>
  
	
  <section class="flat-spacing-5">
  
 
            <div class="container">
               
		
				<div class="row">
				
					<div class="col-md-4 mx-auto">
					 
						
						<div class="card mt-1">	
							 <form method="post" class="form-default" action="" novalidate="novalidate" style="padding: 20px;">
                                    <div class="wrap">
									

									<div class="row">
										 <label class="form-label"><b><u>Product Details</u></b></label><br>
                                          
											<div class="cols">
										 <fieldset>
                                                <label for="name">Purchase Date*</label>
                                                <input name="name" id="name" class="radius-8" type="date" required="">
                                            </fieldset>
                                            
                                        </div>
										
										  <div class="mb-3 col-md-5 col-sm-5 col-lg-5 col-5">
                                                <p class="form-label">Dealer Bill Photo <b class="text-danger">*</b></p>
                                                <input type="file" id="fileInput" accept="image/*">
												<!-- Custom Button -->
												<img src="<?=BASE_PATH?>images/upload.png" class="upload-btn"  onclick="document.getElementById('fileInput').click();" style="height:30px;     vertical-align: top;">
		
		

  
  
                                            </div>
                                            <div class="mb-4 col-md-7 col-sm-7 col-lg-7 col-7">
                                                <label class="form-label">&nbsp;</label><br>
                                               <a href="" class="" data-bs-toggle="modal" data-bs-target="#bill"> <u>View Sample Photo</u></a>
											   <!-- Dealer Bill Photo Modal -->
											<div class="modal fade" id="bill" tabindex="-1" aria-labelledby="bill" aria-hidden="true">
											  <div class="modal-dialog">
												<div class="modal-content">
												  <div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Dealer Bill Photo Sample</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													
													
												  </div>
												  <div class="modal-body">
												<img src="<?=BASE_PATH?>images/product1_home_menu.jpg" class="logo" alt="subtech logo" style="     vertical-align: top;">	
												  </div>
												  
												</div>
											  </div>
											</div>
											   <!-- Show selected file name -->
											  <div class="file-name" id="fileName"></div>

											  <script>
												const fileInput = document.getElementById('fileInput');
												const fileNameDisplay = document.getElementById('fileName');

												fileInput.addEventListener('change', function() {
												  if (fileInput.files.length > 0) {
													fileNameDisplay.textContent = "Selected: " + fileInput.files[0].name;
												  }
												});
											  </script>
                                            </div>
											
											
											
											
										  <div class="mb-4 col-md-5 col-sm-5 col-lg-5 col-5">
                                                <p class="form-label">Product Install <b class="text-danger">*</b></p>
                                                <input type="file" id="fileInput" accept="image/*">
												<!-- Custom Button -->
												<img src="<?=BASE_PATH?>images/upload.png" class="upload-btn"  onclick="document.getElementById('fileInput').click();" style="height:30px;     vertical-align: top;">
		
		

  
  
                                            </div>
                                            <div class="mb-4 col-md-7 col-sm-7 col-lg-7 col-7">
                                                <label class="form-label">&nbsp;</label><br>
                                               <a href="" class="" data-bs-toggle="modal" data-bs-target="#install"> <u>View Sample Photo</u></a>
											   <!-- Dealer Bill Photo Modal -->
											<div class="modal fade" id="install" tabindex="-1" aria-labelledby="install" aria-hidden="true">
											  <div class="modal-dialog">
												<div class="modal-content">
												  <div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Product Installation Sample</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													
													
												  </div>
												  <div class="modal-body">
												<img src="<?=BASE_PATH?>images/srproduct-installation.jpg"   style="     vertical-align: top;">	
												  </div>
												  
												</div>
											  </div>
											</div>
											   <!-- Show selected file name -->
											  <div class="file-name" id="fileName"></div>

											  <script>
												const fileInput = document.getElementById('fileInput');
												const fileNameDisplay = document.getElementById('fileName');

												fileInput.addEventListener('change', function() {
												  if (fileInput.files.length > 0) {
													fileNameDisplay.textContent = "Selected: " + fileInput.files[0].name;
												  }
												});
											  </script>
                                            </div>
											
											
											
										<div class="mb-3 col-md-5 col-sm-5 col-lg-5 col-5">
                                                <p class="form-label">Product Connection Photo <b class="text-danger">*</b></p>
                                                <input type="file" id="fileInput" accept="image/*">
												<!-- Custom Button -->
												<img src="<?=BASE_PATH?>images/upload.png" class="upload-btn"  onclick="document.getElementById('fileInput').click();" style="height:30px;     vertical-align: top;">
		
										</div>
                                             <div class="mb-4 col-md-7 col-sm-7 col-lg-7 col-7">
                                                <label class="form-label">&nbsp;</label><br>
                                               <a href="" class="" data-bs-toggle="modal" data-bs-target="#connection"> <u>View Sample Photo</u></a>
											   <!-- Dealer Bill Photo Modal -->
											<div class="modal fade" id="connection" tabindex="-1" aria-labelledby="connection" aria-hidden="true">
											  <div class="modal-dialog">
												<div class="modal-content">
												  <div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Connection Sample</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													
													
												  </div>
												  <div class="modal-body">
												<img src="<?=BASE_PATH?>images/srconnection.jpg"   style="     vertical-align: top;">	
												  </div>
												  
												</div>
											  </div>
											</div>
											   <!-- Show selected file name -->
											  <div class="file-name" id="fileName"></div>

											  <script>
												const fileInput = document.getElementById('fileInput');
												const fileNameDisplay = document.getElementById('fileName');

												fileInput.addEventListener('change', function() {
												  if (fileInput.files.length > 0) {
													fileNameDisplay.textContent = "Selected: " + fileInput.files[0].name;
												  }
												});
											  </script>
                                            </div>
											
											
												
										<div class="mb-3 col-md-5 col-sm-5 col-lg-5 col-5">
                                                <p class="form-label">Selfie with Photo <b class="text-danger">*</b></p>
                                                <input type="file" id="fileInput" accept="image/*">
												<!-- Custom Button -->
												<img src="<?=BASE_PATH?>images/upload.png" class="upload-btn"  onclick="document.getElementById('fileInput').click();" style="height:30px;     vertical-align: top;">
		
										</div>
                                             <div class="mb-4 col-md-7 col-sm-7 col-lg-7 col-7">
                                                <label class="form-label">&nbsp;</label><br>
                                               <a href="" class="" data-bs-toggle="modal" data-bs-target="#selfie"> <u>View Sample Photo</u></a>
											   <!-- Dealer Bill Photo Modal -->
											<div class="modal fade" id="selfie" tabindex="-1" aria-labelledby="selfie" aria-hidden="true">
											  <div class="modal-dialog">
												<div class="modal-content">
												  <div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Selfie Photo Sample</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													
													
												  </div>
												  <div class="modal-body">
												<img src="<?=BASE_PATH?>images/srselfiewith-product.jpg"   style="     vertical-align: top;">	
												  </div>
												  
												</div>
											  </div>
											</div>
											   <!-- Show selected file name -->
											  <div class="file-name" id="fileName"></div>

											  <script>
												const fileInput = document.getElementById('fileInput');
												const fileNameDisplay = document.getElementById('fileName');

												fileInput.addEventListener('change', function() {
												  if (fileInput.files.length > 0) {
													fileNameDisplay.textContent = "Selected: " + fileInput.files[0].name;
												  }
												});
											  </script>
                                            </div>
											
											
											
									
										
										 <div class="button-submit send-wrap">
                                           <a href="sreng1.php" class="tf-btn animate-btn btn-dark2 mx-1"><i class="icon icon-arrow1-left"></i> Back</a>
										   <a href="sreng3.php" class="tf-btn animate-btn btn-primary"><i class="icon icon-arrow-right"></i> Next</a>
                                        </div>
                                        </div>
										
										
										
										
										
										
										
										
										
										
										
										
										
										
											
										
										
										
									
										
										
                                        
									
                                    </div>
                                </form>
								
							
						</div>
					</div>
				</div>
			

				
				
				
	
	
				
				
				
            </div>
        </section>
        <!-- /Store -->



	
		
	
		
		







   </div>


 <?php include_once"config/foot.php";?>     
   
   
   
   
   
   
   
   
   
   
   




   
   
</body>


</html>