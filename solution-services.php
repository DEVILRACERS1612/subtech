<?php
include_once "./config/config.inc.php";
$cat_slug = $_GET['catid'] ?? '';
$subcat_slug = $_GET['subcatid'] ?? '';

$sql = "SELECT p.id,p.cat_id,p.subcat_id,c.cat_name, c.cat_name,s.subcat_name, p.stitle,p.voucher,p.sdes,p.alttext,p.pf_title,p.pfdes,p.sol_title,p.soldes,p.solimage,p.wcu_title,p.wcudes,p.calculator,p.image
FROM mi_solution p
JOIN mi_solcat c ON p.cat_id = c.id
JOIN mi_solsubcat s ON p.subcat_id = s.id
WHERE c.url_name=? AND s.url_name=?";
$result = $db->select($sql,[$cat_slug,$subcat_slug]);

if($result[0]['stitle']=="")
{
    header('Refresh:0;url='.BASE_PATH);
}

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">



<head>
    <meta charset="utf-8">
    <title><?=$result[0]['stitle']?>- Subtech</title>
	<meta name="title" content="<?=$result[0]['stitle']?> | Subtech">
	 <meta name="description" content="<?=$result[0]['sdes']?>">
	 <meta property="og:type" content="Website">
		<meta name="og:title" content="<?=$result[0]['stitle']?> | Subtech">
		<meta name="og:description" content="<?=$result[0]['sdes']?>">
		<meta property="og:image:width" content="250">
		<meta property="og:image:height" content="250">
		<meta name="og:site_name" content="Subtech">
		<meta property="og:url" content="https://subtech.in/solutions/<?=$cat_slug?>/<?=$subcat_slug?>">
		<meta name="og:image" content="https://subtech.in/images/solution_img/<?=$result[0]['image']?>">
		<meta property="og:image:url" content="https://subtech.in/images/solution_img/<?=$result[0]['image']?>">
		<meta name="robots" content="ALL">
		<meta name="revisit-after" content="7 days" >
		<meta name="generator" content="Subtech - SS Power System">
		<meta name="author" content="Subtech - SS Power System">
		<meta name="publisher" content="Subtech - SS Power System">
		<link rel="canonical" href="https://subtech.in/solutions/<?=$cat_slug?>/<?=$subcat_slug?>">
		<?php include_once"config/head.php";?>
		
		    <style>
        /* Custom Styles to match the design aesthetics */
        :root {
            --subtech-red: #c90000;
        }

        .hero-banner {
            background-color: #f8f9fa; /* Light grey background */
            padding-top: 5rem;
            padding-bottom: 5rem;
        }

        .btn-subtech-red {
            background-color: var(--subtech-red);
            border-color: var(--subtech-red);
            color: white;
            padding: 0.75rem 1.5rem;
            font-weight: bold;
        }
        .btn-subtech-red:hover {
            background-color: #a80000;
            border-color: #a80000;
            color: white;
        }

        .feature-card {
            border: 1px solid #dee2e6;
            padding: 1.5rem;
            text-align: center;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .icon-circle {
            background-color: #f7f7f7;
            color: var(--subtech-red);
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 0.75rem;
            font-size: 1.5rem;
        }

        
		
		
		.preferred-partner-section {
            padding: 40px 0;
            background-color: #ffffff; /* Assuming white background */
        }
        .feature-box {
            /* Light gray background for the box */
            background-color: #f8f8f8; 
            padding: 20px;
            border-radius: 5px;
            /* Red vertical line/border on the left */
            border-left: 5px solid #e40006; 
            min-height: 80px; /* Ensure boxes are roughly the same height */
            display: flex; /* For aligning icon and text */
            align-items: center;
        }
        .feature-box .icon-check {
            color: #ffffff;
    font-size: 0.7rem;
    background: #e40006;
    padding: 6px;
    border-radius: 10px;
    margin-right: 15px;
        }
        .text-content {
            font-size: 1.1rem; /* Slightly larger text */
        }
		
		

        .simulator-box {
            background-color: #f8f9fa;
            padding: 3rem;
            text-align: center;
        }

        .simulator-box h3 {
            color: var(--subtech-red);
        }

        .simulator-output {
            background-color: white;
            border: 2px solid var(--subtech-red);
            padding: 1rem;
            font-size: 3rem;
            font-weight: bold;
            color: #fff;
			background: var(--subtech-red);
            margin-top: 1rem;
        }

        .contact-form-section {
            padding: 3rem 0;
            background-color: #f8f9fa;
        }

        .faq-section {
            padding: 3rem 0;
        }
    </style>
		

</head>

<body>
	
	<?php include_once"config/header-top.php";?>

    <div id="wrapper">
     
	 <?php include_once"config/header.php";?>
	 
	 
	
		
		
    <section class="hero-banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0 mt-5">
                    <h1><?=$result[0]['stitle']?></h1>
                    <p class="lead" style="line-height:2.5rem"><?=$result[0]['sdes']?></p>
                    <div class="d-grid d-md-block gap-2 mt-4">
                        <a href="#contact" class="btn btn-subtech-red me-md-2">Get a Free Consultation</a>
                        <?php if($result[0]['voucher']!=''){ ?>
                        <a href="https://subtech.in/images/solution_img/<?=$result[0]['voucher']?>" download="Solution-Brochure.pdf" class="btn btn-subtech-red btn-outline-secondary">Download Solution Brochure</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-6">
                                        <img src="https://subtech.in/images/solution_img/<?=$result[0]['image']?>" class="img-fluid rounded shadow-sm" alt="<?=$result[0]['alttext']?>">
                </div>
            </div>
        </div>
    </section>
	
	
	
	 <!-- Brand -->
        <div class="flat-spacing-2 fade-edge" style="background: #fdeaef;">
            <div class="container">
			<div class="flat-title wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                   <!--<h2 class="mb-2 fw-bold">Our client's in <?=$result[0]['cat_name']?></h2>-->
                    
					<!--<p>Trusted by leading companies across industries</p>-->
                </div>
				
				
                <div class="infiniteslide tf-brand" data-clone="2" data-style="left" data-speed="80">
    <?php 
    $clsql="select * from mi_solution_client where data_id=? and mi_status='Yes'";
    $res=$db->query($clsql,[$result[0]['id']]);
    if($res->num_rows){
        while($clrow=$res->fetch_assoc()){
            echo '<div class="brand-item">
                    <img src="'.BASE_PATH.'images/solution_img/'.$clrow['climage'].'" alt="'.$clrow['clname'].'">
                </div>';
        }
    }
    ?>
                    
                </div>
            </div>
        </div>
         
		
		
		
		
		

    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold"><?=$result[0]['pf_title']?> in <?=$result[0]['cat_name']?></h2>
            <p><?=$result[0]['pfdes']?></p>
            <div class="row g-4 text-center">
    <?php 
    $clsql="select * from mi_solution_prob where data_id=? and mi_status='Yes'";
    $res=$db->query($clsql,[$result[0]['id']]);
    if($res->num_rows){
        while($clrow=$res->fetch_assoc()){
            echo '<div class="col-md-6 col-lg-3">
                    <div class="feature-card shadow-sm">
                        <div class="icon-circle"><img src="'.BASE_PATH.'images/solution_img/'.$clrow['pbimage'].'" alt="'.$clrow['alttext'].'"></div>
                        <p class="mb-0 fw-bold">'.$clrow['reason'].'</p>
                    </div>
                </div>';
        }
    }
    ?>            
                
            <!--    <div class="col-md-6 col-lg-3">
                    <div class="feature-card shadow-sm">
                        <div class="icon-circle"><i class="fas fa-clock"></i></div>
                        <p class="mb-0 fw-bold">Loss of valuable learning time</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card shadow-sm">
                        <div class="icon-circle"><i class="fas fa-server"></i></div>
                        <p class="mb-0 fw-bold">Data loss and server downtime</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card shadow-sm">
                        <div class="icon-circle"><i class="fas fa-bolt"></i></div>
                        <p class="mb-0 fw-bold">Damage to sensitive lab equipment</p>
                    </div>
                </div>-->
            </div>
        </div>
    </section>
    
    
    <hr class="my-5">

    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-3 fw-bold"><?=$result[0]['sol_title']?></h2>
            <p class="text-center col-lg-8 mx-auto mb-5">
                <?=$result[0]['soldes']?>
            </p>
            <div class="row g-5  align-items-center">
                <div class="col-lg-5 mx-auto">
                     <img src="<?=BASE_PATH?>images/solution_img/<?=$result[0]['solimage']?>" alt="<?=$result[0]['sol_title']?>" class="lazyloaded img-fluid rounded">
                </div>
                
            </div>
			
			
			<div class="row g-4 mt-4 justify-content-center">
            
            <?php 
    $clsql="select * from mi_solution_sol where data_id=? and mi_status='Yes'";
    $res=$db->query($clsql,[$result[0]['id']]);
    if($res->num_rows){
        while($clrow=$res->fetch_assoc()){
            echo '<div class="col-lg-5 col-md-6">
                <div class="feature-box shadow-sm">
                   <div class="icon-check"></div>
                    <span class="text-content">'.$clrow['solution'].'</span>
                </div>
            </div>';
        }
    }
    ?>
            
            
            


        </div>
            </div>
			
			
        </div>
    </section>

<hr>



<section class="preferred-partner-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="fw-bold mb-3"><?=$result[0]['wcu_title']?></h2>
				<p class="text-center col-lg-8 mx-auto mb-1">
                <?=$result[0]['wcudes']?>
            </p>
            </div>
        </div>
        
        <div class="row g-4 justify-content-center">
            
            <?php 
    $clsql="select * from mi_solution_wcu where data_id=? and mi_status='Yes'";
    $res=$db->query($clsql,[$result[0]['id']]);
    if($res->num_rows){
        while($clrow=$res->fetch_assoc()){
            echo '<div class="col-lg-5 col-md-6">
                <div class="feature-box shadow-sm">
                   <div class="icon-check"></div>
                    <span class="text-content">'.$clrow['reason'].'</span>
                </div>
            </div>';
        }
    }
    ?>
            
           
        </div>
    </div>
</section>



<?php 
if($result[0]['calculator']=='Yes') { ?>
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4 fw-bold">Let's Help You Build a Power-Protected <?=$result[0]['cat_name']?></h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="simulator-box rounded shadow">
                        <h3 class="mb-4">Uptime Impact Simulator</h3>
                        <p class="text-muted">Calculate how many hours of of downtime you can avoid each year</p>
                        <form>
                            <div class="row g-3 align-items-end">
                                <div class="col-md-6">
                                    <label for="loadType" class="form-label text-start d-block">Power Outage per month</label>
                                <input type="number" class="form-control" id="loadmon" placeholder="e.g., 50" value="4">
                                </div>
                                <div class="col-md-6">
                                    <label for="loadSize" class="form-label text-start d-block">Average minutes per outage</label>
                                    <input type="number" class="form-control" id="loadmin" placeholder="e.g., 50" value="30">
                                </div>
                                <div class="col-12">
                                    <div class="simulator-output mx-auto">
                                       <span id="res"> 24.0 </span><br><span class="fs-5 fw-normal">Hours of downtime avoided per year</span>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><hr class="my-5">
<?php } ?>
    

    <section class="contact-form-section" id="contact">
        <div class="container">
            <h2 class="text-center mb-4 fw-bold">Let's Help You Build a Power-Protected <?=$result[0]['cat_name']?></h2>
            <!---<div class="text-center mb-4">
                <a href="#" class="btn btn-subtech-red">Request a Site Survey</a>
            </div>--->
            <p class="text-center text-muted mb-4">Or fill in your details for a customized quote.</p>
            <div class="col-lg-8 mx-auto p-4 bg-white rounded shadow-sm">
        <form method="post" class="form-default" id="cnt_form">
			<input type="hidden" name="_token" value="<?=$post_id;?>" />
			<input type="hidden" name="c_type" value="<?=$result[0]['stitle']?>" />
			<input type="hidden" name="method" value="Contact" />
			
				<div class="wrap">
					<div class="cols">
						<fieldset>
							<label for="name">Your name*</label>
							<input name="name" id="name" class="radius-8 name" type="text" required>
						</fieldset>
						<fieldset>
							<label for="email">Your email*</label>
							<input name="email" id="email" class="radius-8" type="email" required>
						</fieldset>
					</div>
					 <div class="cols">
						<fieldset>
							<label for="mob">Your Mobile*</label>
							<input name="mobile" id="mob" class="radius-8" type="number" maxlength="10" required>
						</fieldset>
						<fieldset>
							<label for="sub">Subject*</label>
							<input name="subject" id="sub" class="radius-8" type="text" required>
						</fieldset>
					</div>
					<div class="cols">
						<fieldset class="textarea">
							<label for="message">Message*</label>
							<textarea name="message" id="message" required
								class="radius-8"></textarea>
						</fieldset>
					</div>
					<div id="msg"></div>
					<div class="button-submit send-wrap">
						<button class="tf-btn animate-btn" type="submit" id="btnSubmit">Submit Query</button>
					</div>
				</div>
			</form>
            </div>
            
            
            
        </div>
    </section>

    <section class="faq-section">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Frequently Asked Questions</h2>
            <div class="accordion col-lg-8 mx-auto" id="faqAccordion">
            <?php 
    $clsql="select * from mi_solution_faq where data_id=? and mi_status='Yes'";
    $res=$db->query($clsql,[$result[0]['id']]);
    if($res->num_rows){
        $i=1;
        while($clrow=$res->fetch_assoc()){
            echo '<div class="accordion-item">
                    <h2 class="accordion-header" id="heading'.$i.'">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$i.'" aria-expanded="false" aria-controls="collapse'.$i.'">
                            '.$clrow['faq'].'
                        </button>
                    </h2>
                    <div id="collapse'.$i.'" class="accordion-collapse collapse" aria-labelledby="heading'.$i.'" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            '.$clrow['ans'].'
                        </div>
                    </div>
                </div>';
                $i++;
        }
        
    }
    ?>    
                

         <!--   <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Can your solutions handle multiple buildings/blocks?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Yes, our solutions are highly scalable and can be customized to manage the power backup for an entire campus with multiple independent blocks, through a centralized or decentralized system.
                        </div>
                    </div>
                </div>

                 <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            What is the typical installation time?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                           Installation time varies based on the size and complexity of the campus infrastructure, but a preliminary site survey allows us to provide a precise project timeline.
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </section>
	

	
		
		
		
		
		
		
		
		
	 
	 
	 
	 
 <?php include_once"config/footer.php";?> 

   </div>


   
 <?php include_once"config/mobile_menu.php";?>  
 <?php include_once"config/foot.php";?>     
   
   
   
   
   
   
 <script>
    $("document").ready(function(){
         $("body").on("keyup","#loadmin,#loadmon",function(){
            var mon=$("#loadmon").val();
            var min=$("#loadmin").val();
            var res=(mon*min*12)/60;
            $("#res").text(res.toFixed(1));
         });
    });
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
      
   
   




   
   
</body>


</html>