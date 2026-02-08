<?php include_once 'config/config.inc.php';
$cat=(isset($_GET['catid']) and ($_GET['catid']!=""))?$_GET['catid']:'';
/*if($cat!=""){
    $qr=$db->exeQuery("select * from mi_product where cat_id=(select id from mi_pcat where urlname='".$cat."' and mi_status='Yes') and mi_status='Yes'");
}else{
    $qr=$db->exeQuery("select * from mi_product where mi_status='Yes' group by cat_id");
}*/
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title><?=($cat!="")?ucfirst($cat):'All Products'?> | Subtech Electronics</title>
	 <meta name="description" content="Subtech Electronics">
    <?php include_once"config/head.php";?>
	 

</head>

<body>
	
	<?php include_once"config/header-top.php";?>

    <div id="wrapper">
     
	 <?php include_once"config/header.php";?>
	 
	  <!-- Breadcrumb -->
        <div class="breadcrumb-sec">
            <div class="container">
                <div class="breadcrumb-wrap">
                    <div class="breadcrumb-list">
                        <a class="breadcrumb-item" href="<?=BASE_PATH?>">Home</a>
                        
       <?php
       if($cat!=""){
          $catr=$db->query("select * from mi_pcat where urlname=? and mi_status='Yes'",[$cat])->fetch_assoc(); 
          ?>
          <div class="breadcrumb-item dot"><span></span></div>
          <a href="<?=BASE_PATH?>products" class="breadcrumb-item ">Products</a>
          <div class="breadcrumb-item dot"><span></span></div>
          <div class="breadcrumb-item current"><?=$catr['cat_name']?></div>
          <?php
       }else{
        ?>
        <div class="breadcrumb-item dot"><span></span></div>
          <div class="breadcrumb-item current">Products</div>
        <?php 
       }?>
                        
                        
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->
	 
 <!-- Section Product -->
        <section class="flat-spacing-71">
            <div class="container">
               <div class="wrapper-control-shop">
                    
<?php
if($cat!=""){
    $catr=$db->query("select * from mi_pcat where urlname=? and mi_status='Yes'",[$cat])->fetch_assoc();
    echo '<h4>'.$catr['cat_name'].'</h4>';
?>
        <div class="wrapper-shop tf-grid-layout tf-col-4">      			   
                
                   
        <?php 
        
           
             $qr=$db->query("select * from mi_wproduct where cat_id=? and mi_status='Yes'",[$catr['id']]);
            while($row=$qr->fetch_assoc()){
                ?>
                <div class="card-product grid card-product-size" style="    border: 1px solid #f2f2f2;background: #f7f7f7; border-radius:16px;">
                        <div class="card-product-wrapper">
                            <a href="<?=BASE_PATH?>product/<?=$row['urlname']?>" class="product-img">
                                <img class="img-product lazyload" data-src="<?=IMG_PATH;?>images/prod_img/<?=$row['image']?>"
                                    src="<?=IMG_PATH;?>images/prod_img/<?=$row['image']?>" alt="<?=$row['alttext']?>">
                                <img class="img-hover lazyload" data-src="<?=IMG_PATH;?>images/prod_img/<?=$row['image']?>"
                                    src="<?=IMG_PATH;?>images/prod_img/<?=$row['image']?>" alt="<?=$row['alttext']?>">
                            </a>

                        </div>
                        <div class="cls-content text-center">
                               <br>
                                  <br>
                             <a href="<?=BASE_PATH?>product/<?=$row['urlname']?>" class="text-type text-xl-2 fw-medium link"><?=$row['product_name']?>
                                </a>   <br>   <br>
                                <span class="count-item body-text-2 text-main"> <b>&#x20b9;  <?=$row['rate']?></b></span>
                                        <br>
                                        <a  class="btn-submit-total tf-btn btn-out-line-primary w-50" value="">Buy Now</a>
                                        <br>
                                        <br>
                                    </div>
                                    
                      
                    </div>
                
                <?php
            }
        
        
        ?>

                        <!-- Card Product 1 -->
                    
                        
                       
                        
						
						
						
                       
                        <!-- Pagination 
                        <ul class="wg-pagination">
                            <li class="active">
                                <div class="pagination-item">1</div>
                            </li>
                            <li>
                                <a href="#" class="pagination-item">2</a>
                            </li>
                            <li>
                                <a href="#" class="pagination-item">3</a>
                            </li>
                            <li>
                                <a href="#" class="pagination-item"><i class="icon-arr-right2"></i></a>
                            </li>
                        </ul>-->
                    </div>
    <?php }else{
        
    $catq=$db->query("select * from mi_pcat where mi_status='Yes'");
    while($catr=$catq->fetch_assoc()){
    $qr=$db->query("select * from mi_wproduct where cat_id=? and mi_status='Yes'",[$catr['id']]);    
    if($qr->num_rows){
    echo '<h4>'.$catr['cat_name'].'</h4>';
?>
        <div class="wrapper-shop tf-grid-layout tf-col-4">      			   
      
        <?php 

            while($row=$qr->fetch_assoc()){
                ?>
                <div class="card-product grid card-product-size" style="    border: 1px solid #f2f2f2;background: #f7f7f7; border-radius:16px;">
                        <div class="card-product-wrapper">
                            <a href="<?=BASE_PATH?>product/<?=$row['urlname']?>" class="product-img">
                                <img class="img-product lazyload" data-src="<?=IMG_PATH;?>images/prod_img/<?=$row['image']?>"
                                    src="<?=IMG_PATH;?>images/prod_img/<?=$row['image']?>" alt="<?=$row['alttext']?>">
                                <img class="img-hover lazyload" data-src="<?=IMG_PATH;?>images/prod_img/<?=$row['image']?>"
                                    src="<?=IMG_PATH;?>images/prod_img/<?=$row['image']?>" alt="<?=$row['alttext']?>">
                            </a>

                        </div>
                        <div class="card-product-info">
                            <a href="<?=BASE_PATH?>product/<?=$row['urlname']?>" class="name-product link fw-medium text-md"><?=$row['product_name']?>
                                </a>
                        </div>
                    </div>
                
                <?php
            }
        
        
        ?>

    
                <!-- Pagination 
                <ul class="wg-pagination">
                    <li class="active">
                        <div class="pagination-item">1</div>
                    </li>
                    <li>
                        <a href="#" class="pagination-item">2</a>
                    </li>
                    <li>
                        <a href="#" class="pagination-item">3</a>
                    </li>
                    <li>
                        <a href="#" class="pagination-item"><i class="icon-arr-right2"></i></a>
                    </li>
                </ul>-->
            </div>
    <?php    
    } 
    }
    } 
    
    ?>                
                    
                </div>
            </div>
        </section>
        <!-- /Section Product -->
		
		
       

	   <?php include_once"config/footer.php";?>




  <!-- ask Q  -->
    <div class="modal modalCentered fade  modal-ask-question popup-style-2" id="quote">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="title text-xl-2 fw-medium">Add your information</span>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <form class="form-ask-question">
                    <div class="cols mb_15 flex-md-nowrap flex-wrap">
                        <fieldset class="">
                            <div class="text">Your name*</div>
                            <input type="text" placeholder="" class="" name="text" tabindex="2" value=""
                                aria-required="true" required="">
                        </fieldset>
                        <fieldset class="">
                            <div class="text">Your phone number</div>
                            <input type="number" placeholder="" class="" name="text" tabindex="2" value=""
                                aria-required="true">
                        </fieldset>
                    </div>
                    <fieldset class="mb_15">
                        <div class="text">Your email*</div>
                        <input type="email" placeholder="" class="" name="text" tabindex="2" value=""
                            aria-required="true" required="">
                    </fieldset>
                    
                    <div class="text-center">
                        <button type="submit" class="tf-btn animate-btn d-inline-flex justify-content-center"><span>Submit
                                </span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /ask question  -->







   </div>


 <?php include_once"modals/all.php";?>
   
 <?php include_once"config/mobile_menu.php";?>  
 <?php include_once"config/foot.php";?> 

<script src="js/drift.min.js"></script>


    <script src="js/photoswipe-lightbox.umd.min.js"></script>
    <script src="js/photoswipe.umd.min.js"></script>
    <script src="js/zoom.js"></script>
   
   
   
   
   
   
   
   




   
   
</body>


</html>