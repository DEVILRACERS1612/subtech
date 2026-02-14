<?php
include_once "./config/config.inc.php";
?>


<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Subtech Electronics</title>
	 <meta name="description" content="Subtech Electronics">
    <?php include_once"config/head.php";?>

</head>

<body>
	
	<?php include_once"config/header-top.php";?>

    <div id="wrapper">
     
	 <?php include_once"config/header.php";?>
	 
		
		
		
		<section class="s-faq flat-spacing-13">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="sb-contact sticky-top" style="top: 101.996px;">
                            <p class="title">
                               Frequently Ask Questions
                            </p>
                            <p class="sub">
                               Find answers to the most common questions about our products, services, policies, and support. Whether you're a new or existing customer, 
                                <br><br>
                               our FAQ section is here to help you get the information you need—quickly and easily.
                            </p>
                            <div class="btn-group">
                                <a href="<?=BASE_PATH?>contact" class="tf-btn animate-btn">
                                    Contact us
                                </a>
                              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <ul class="faq-list">
                            <li class="faq-item">
                                <p class="name-faq">
                                  FAQs
                                </p>
<?php 
$fq=$db->exeQuery("select * from mi_faq where mi_status='Yes' order by id");
$q=1;
while($frow=$fq->fetch_assoc()){
    $sh=($q==1)?"show":"";
   ?>
   <div class="faq-wrap" id="accordionShoping1">
        <div class="widget-accordion">
            <div class="accordion-title" data-bs-toggle="collapse" data-bs-target="#collapse<?=$q?>" aria-expanded="true" aria-controls="collapseOne" role="button">
                <span><?=$frow['ques']?></span>
                <span class="icon icon-arrow-down"></span>
                
            </div>
            <div id="collapse<?=$q?>" class="accordion-collapse collapse <?=$sh?>" aria-labelledby="headingOne" data-bs-parent="#accordionShoping1">
                <div class="accordion-body widget-desc">
                    <p class="text-main"><?=$frow['ans']?> </p>
                </div>
            </div>
        </div>
    </div>
   <?php
   $q++;
}
?>
            
      <!--      <div class="faq-wrap" id="accordionShoping2">
                <div class="widget-accordion">
                    <div class="accordion-title" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapseOne" role="button">
                        <span>How long will it take for my order to ship?</span>
                        <span class="icon icon-arrow-down"></span>
                        
                    </div>
                    <div id="collapse2" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionShoping2">
                        <div class="accordion-body widget-desc">
                            <p class="text-main">
                                Orders are typically processed and shipped within 1–3 business days.
                                You'll receive a confirmation email once your order is on the way
                            </p>
                        </div>
                    </div>
                </div>
            </div>-->
            
                            </li>
                        </ul>
                        <!--<ul class="faq-list">
                            <li class="faq-item">
                                <p class="name-faq">
                                  Product 1
                                </p>
                                <div class="faq-wrap" id="accordionShoping">
                                    <div class="widget-accordion">
                                        <div class="accordion-title" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" role="button">
                                            <span>How long will it take for my order to ship?</span>
                                            <span class="icon icon-arrow-down"></span>
                                        </div>
                                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionShoping">
                                            <div class="accordion-body widget-desc">
                                                <p class="text-main">
                                                    Orders are typically processed and shipped within 1–3 business days.
                                                    You'll receive a confirmation email once your order is on the way
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </li>
                            
                            <li class="faq-item">
                                <p class="name-faq">
                                    Product 2
                                </p>
                                <div class="faq-wrap" id="accordionPayment">
                                    <div class="widget-accordion">
                                        <div class="accordion-title" data-bs-toggle="collapse" data-bs-target="#collapsePaymentOne" aria-expanded="true" aria-controls="collapsePaymentOne" role="button">
                                            <span>What payment methods do you accept?</span>
                                            <span class="icon icon-arrow-down"></span>
                                        </div>
                                        <div id="collapsePaymentOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionPayment">
                                            <div class="accordion-body widget-desc">
                                                <p class="text-main">
                                                    We accept all major credit cards, PayPal, Apple Pay, and Google Pay.
                                                    All transactions are secure and encrypted for your protection
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                  

                                </div>
                            </li>
                          
                        </ul>-->
                        
                        
                    </div>
                </div>
            </div>
        </section>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

	   <?php include_once"config/footer.php";?>








   </div>


 <?php include_once"modals/all.php";?>
   
 <?php include_once"config/mobile_menu.php";?>  
 <?php include_once"config/foot.php";?>     
   
   
   
   
   
   
   
   
   
   
   




   
   
</body>


</html>