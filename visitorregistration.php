<?php
include_once "./config/config.inc.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subtech Visitor Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .form-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        #video-preview, #photo-canvas { max-width: 100%; border-radius: 5px; }
        #photo-canvas { display: none; }
        .form-section-title { margin-bottom: 1.5rem; border-bottom: 1px solid #dee2e6; padding-bottom: 0.5rem; }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 shadow-sm">
			<img src="https://subtech.in/images/logo/logo.png" alt="subtech logo" class="logo">
                <h2 class="text-center mb-0">UP International Trade Show 2025</h2>
                <h5 class="text-center text-muted mb-4">Subtech's Visitor Registration</h5>
                <form method="post" class="form-default" id="cnt_form">
                    <input type="hidden" name="_token" value="<?=$post_id;?>" />
			<input type="hidden" name="method" value="Visitor" />
			<input type="hidden" name="visitin" value="UPITS2025" />
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control name" id="fullName" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobileNumber" class="form-label">Mobile Number</label>
                        <input type="text" maxlength="10" name="mobile" class="form-control" id="mob" required onkeypress="return isNumber(event)">
                    </div>
                    <div class="mb-3">
                        <label for="identity" class="form-label">Select your identity</label>
                        <select class="form-select" name="subject" id="identity" required>
                            <option selected disabled value="">Choose...</option>
                            <option>Distributor</option>
                            <option>Dealer</option>
                            <option>Corporates</option>
                            <option>Govt. Contractors</option>
                            <option>End Customer</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="inquiry" class="form-label">Inquiry</label>
                        <textarea class="form-control" name="message" id="inquiry" rows="3"></textarea>
                    </div>
                    <div class="form-text text-center text-muted mb-3">
                        We'll only use your contact info to connect with you about UPITS 2025.
                    </div>
                    <div class="form-text text-center text-muted mb-3" id="msg">
                    </div>
                    <div class="d-grid">
                        <button type="submit" id="btnSubmit" class="btn text-bold" style="background:#e50006; color:#fff">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
    <script src="<?=BASE_PATH?>js/jquery.min.js"></script>
<script>
	function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	//if(charCode==46 ||charCode==43 ||charCode==45 ){return true;}
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
	}
</script>
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
	
  });
  </script>
</html>