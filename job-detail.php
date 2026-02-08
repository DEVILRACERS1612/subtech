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
	 
		
		<section class="s-faq flat-spacing-14">
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
            <div class="modal-content">
                <div class="modal-header">
                    <span class="title text-xl-2 fw-medium">Apply Job</span>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <form class="form-ask-question" id="applyform" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="<?=$post_id?>" />
                    <input type="hidden" name="method" value="JobApply" />
                    <input type="hidden" name="job" value="<?=$row['id']?>" />
                    
                    <fieldset class="mb_15">
                        <div class="text">Your name*</div>
                        <input type="text" placeholder="Your Full Name" name="name" tabindex="2" value=""
                            aria-required="true" required="">
                    </fieldset>
                    <div class="cols flex-md-nowrap flex-wrap">
                        <fieldset class="mb_15">
                            <div class="text">Your email*</div>
                            <input type="email" placeholder="" name="email" tabindex="1" value=""
                                aria-required="true" required="">
                        </fieldset>
                        <fieldset class="mb_15">
                            <div class="text">Your Mobile *</div>
                            <input type="number" placeholder="Mobile Number"  name="mobile" tabindex="2" value="" aria-required="true">
                        </fieldset>
                    </div>
                    <fieldset class="mb_15">
                        <div class="text">Resume * (upload pdf file)</div>
                        <input type="file" name="resume" tabindex="3" aria-required="true" accept=".pdf" />
                    </fieldset>
                    <fieldset class="">
                        <div class="text">Details</div>
                        <textarea placeholder="Type Aboutself" name="message" tabindex="4" aria-required="true"></textarea>
                    </fieldset>
                    
                    <div id="msg"></div>
                    <div class="text-center">
                        <button type="submit" class="tf-btn animate-btn d-inline-flex justify-content-center" id="btnsubmit"><span>Submit
                                </span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /ask question  -->

   
   
   
   
   




   
   
</body>


</html>