<?php
include_once "./config/config.inc.php";
$job_id=(isset($_REQUEST['jobid']) and ($_REQUEST['jobid']!=""))?($_REQUEST['jobid']):'';

$row=$db->query("select * from mi_jobs where url_name=? and mi_status='Yes' order by id desc",[$job_id])->fetch_assoc();
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Jobs Detail - Subtech</title>
	 <meta name="description" content="Subtech">
    <?php include_once"config/head.php";?>

</head>

<body>
	
	<?php include_once"config/header-top.php";?>

    <div id="wrapper">
     
	 <?php include_once"config/header.php";?>
	 
		
		<!-- <section class="s-faq flat-spacing-14">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="sb-contact sticky-top" style="top: 15px;">
                            <p class="title">
                                <?=$row['title'];?> <br><span class="badge bg-warning btn-sm"><?=$row['cat_name'];?></span>
                            </p>
                            <p class="sub">
                                <?=$row['location'];?>

                                <br>
                                <?=$row['job_type'];?>
                            </p>
							
                            <div class="btn-group">
                                <a href="#" id="apply" class="tf-btn animate-btn"> Apply Now
                                </a>
                                <a href="<?=BASE_PATH?>contact" class="tf-btn btn-white animate-btn animate-dark">
                                    Mail Us
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <ul class="faq-list">
                            <li class="faq-item">
                                <p class="name-faq">
                                    Job Information
                                </p>
								
								<p class="text-main">
                                    <?=$row['sdes'];?>
                                </p>

                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </section> -->
		
		<section class="career-detail py-5">
    <div class="container career-container" style="max-width: 1000px;">
        <div style="background: #f5f5f5; padding: 20px; border-radius: 8px; margin-bottom: 20px; color: gray;">

        <!-- Title -->
        <h1 class="career-title"><?=$row['title'];?></h1>

        <!-- Short intro (optional) -->
        <p class="career-subtext">
            From smart tech to seamless journeys, we help businesses grow faster.
        </p>

        <!-- Badge -->
        <span class="career-badge"><?=$row['job_type'];?></span>
        </div>

        <!-- Divider -->
        <hr class="career-divider">

        <!-- Description -->
        <div class="career-content">
            <?=$row['sdes'];?>
        </div>

        <!-- Apply Button -->
        <div class="mt-4">
            <button id="apply" class="btn btn-danger px-4 py-2">
                Apply Now
            </button>
        </div>

    </div>
</section>
		
		
		
<!---		
		<div class="container">
    <div class="text-center mb-5 mt-5">
      <h3>Jobs opening</h3>
      
    </div>
    <div class="card mb-3">
      <div class="card-body">
        <div class="d-flex flex-column flex-lg-row">
        
          <div class="row flex-fill">
            <div class="col-sm-10">
              <h4 class="h5">Junior Frontend Developer <span class="badge bg-warning btn-sm">Sales</span></h4>
			  <p>Lorem Ipsom Dolar Lorem Ipsom Dolar Lorem Ipsom Dolar Lorem Ipsom Dolar Lorem Ipsom Dolar Lorem Ipsom Dolar Lorem Ipsom Dolar Lorem Ipsom Dolar ..</p>
              <span class="badge bg-secondary">WORLDWIDE</span> <span class="badge bg-success">$60K - $100K</span> 
            </div>
            
            <div class="col-sm-2 text-lg-end">
             <button class="tf-btn animate-btn" type="submit"> Apply </button>
            </div>
          </div>
        </div>
      </div>
    </div>

  
  
  
  </div>
--->
		

	   <?php include_once"config/footer.php";?>


   </div>


 <?php include_once"modals/all.php";?>
   
 <?php include_once"config/mobile_menu.php";?>  
 <?php include_once"config/foot.php";?>     
   
 <script>
    $(document).ready(function(){
        $("body").on("click","#apply",function(){
            $("#applyModel").modal("show");
        });    
        
       
        $("#applyform").on("submit",function(e){
    		e.preventDefault();
    		$("#btnsubmit").html('Wait...');
    		$.ajax({
    			url:'<?php echo BASE_PATH;?>Controller/Master/',
    			type:'post',
    			data:new FormData(this),
    			contentType: false,       
    			cache: false,            
    			processData:false,
    			success:function(data){
    				//$('#preloader').hide();

    				var response=(JSON.parse(data));
    				$("#msg").html(response.message);
    				if(response.type=="success")
    				{
    					setTimeout(function(){window.location.reload();},1500);
    				}
    				
    			}
    			
    		});
    	} );
    });
 </script>  
   
   
   
   
<!-- ask question  -->
    <div class="modal modalCentered fade  modal-ask-question popup-style-2" id="applyModel">
        <div class="modal-dialog modal-dialog-centered">
           <div class="modal-content custom-apply-modal">
    
    <div class="modal-header border-0 text-center d-block">
        <h3 class="fw-bold mb-1">Apply Now</h3>
        <p class="text-muted small">Join the team by filling out the form below</p>
        <span class="icon-close icon-close-popup position-absolute end-0 top-0 m-3" data-bs-dismiss="modal"></span>
    </div>

    <div class="modal-body px-4 pb-4">
        <form class="form-ask-question" id="applyform" enctype="multipart/form-data">

            <input type="hidden" name="_token" value="<?=$post_id?>" />
            <input type="hidden" name="method" value="JobApply" />
            <input type="hidden" name="job" value="<?=$row['id']?>" />

            <div class="mb-3">
                <label class="form-label" style="max: width 700px;">Full Name *</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address *</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mobile Number *</label>
                <input type="number" class="form-control" name="mobile">
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Resume (PDF only) *</label>
                <input type="file" class="form-control" name="resume" accept=".pdf">
            </div>

            <div class="mb-3">
                <label class="form-label">About You</label>
                <textarea class="form-control" name="message" rows="4"></textarea>
            </div>

            <div id="msg" class="mb-3 text-center"></div>

            <div class="text-center">
                <button type="submit" id="btnsubmit" class="btn btn-danger px-5 py-2 fw-semibold">
                    Submit Application
                </button>
            </div>

        </form>
    </div>
</div>
        </div>
    </div>
    <!-- /ask question  -->

   
   
   
   
   




   
   
</body>


</html>