<?php include_once 'config/config.inc.php';
$prd=(isset($_GET['itmid']) and ($_GET['itmid']!=""))?$_GET['itmid']:'';
if($prd!=""){
    $qr=$db->query("select * from mi_wproduct where urlname=? and mi_status='Yes'",[$prd]);
    if($qr->num_rows){
        $row=$qr->fetch_assoc();
    }else{
        header('Location:'.BASE_PATH);
    }
}else{
    header('Location:'.BASE_PATH);
}
function getYouTubeVideoId($url) {
    // First parse the URL
    $parsed = parse_url($url);
    // Check if we have a query string with 'v'
    if (isset($parsed['query'])) {
        parse_str($parsed['query'], $query);
        if (isset($query['v'])) {
            return $query['v'];
        }
    }
    // If it's a short link (youtu.be)
    if ($parsed['host'] == 'youtu.be') {
        return trim($parsed['path'], '/');
    }
    return false;
}

?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title><?=$row['product_name']?> | Subtech</title>
	<meta name="description" content="<?=$row['sdes']?>">
	 <link rel="canonical" href="<?= BASE_PATH;?><?=$_SERVER['REQUEST_URI']?>">
    <?php include_once"config/head.php";?>
	<link rel="stylesheet" href="<?= BASE_PATH;?>css/drift-basic.min.css">
    <link rel="stylesheet" href="<?= BASE_PATH;?>css/photoswipe.css">
<style>
.video-container {
  position: relative;
  width: 560px;
  height: 315px;
  background: #000;
  cursor: pointer;
}

.video-container .thumbnail {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.video-container .play-button {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 100px;
  color: #fff;
  text-shadow: 0px 0px 20px black;
  pointer-events: none;
}
</style>
</head>

<body>
	
	<?php include_once"config/header-top.php";?>
    <div id="wrapper">
     
	<?php include_once"config/header.php";?>
	 <section class="flat-spacing-8" style="padding-bottom:0px;">
	  <!-- Breadcrumb -->
        <div class="breadcrumb-sec">
            <div class="container">
                <div class="breadcrumb-wrap">
                    <div class="breadcrumb-list">
                        <a class="breadcrumb-item" href="<?=BASE_PATH;?>">Home</a>
                        <div class="breadcrumb-item dot"><span></span></div>
                        <div class="breadcrumb-item current">Product</div>
                        <div class="breadcrumb-item dot"><span></span></div>
                        <div class="breadcrumb-item current"><?=$row['product_name']?></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->
	 </section>
	    <!-- Product Main -->
        <section class="flat-single-product">
            <div class="tf-main-product section-image-zoom">
                <div class="container">
                    <div class="row">
                        <!-- Product Images -->
        <div class="col-md-5">
            <div class="tf-product-media-wrap sticky-top">
                <div class="product-thumbs-slider thumbs-bottom">
                    <div class="flat-wrap-media-product">
                        <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                            <div class="swiper-wrapper">
                                <!-- black -->
        <div class="swiper-slide" data-color="black" data-size="small">
            <a href="<?=BASE_PATH?>images/prod_img/<?=$row['image']?>" target="_blank"
                class="item" data-pswp-width="400px" data-pswp-height="450px">
                <img class="tf-image-zoom lazyload"
                    data-zoom="<?=BASE_PATH?>images/prod_img/<?=$row['image']?>"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image']?>"
                    alt="<?=$row['alttext']?>">
            </a>
        </div>
    <?php
    if($row['image1']!=""){
        ?>
        <div class="swiper-slide" data-color="black" data-size="medium">
            <a href="<?=BASE_PATH?>images/prod_img/<?=$row['image1']?>" target="_blank"
                class="item" data-pswp-width="400px" data-pswp-height="450px">
                <img class="tf-image-zoom lazyload"
                    data-zoom="<?=BASE_PATH?>images/prod_img/<?=$row['image1']?>"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image1']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image1']?>"
                    alt="<?=$row['alttext1']?>">
            </a>
        </div>
        <?php 
    }
    if($row['image2']!=""){
        ?>
        <div class="swiper-slide" data-color="black" data-size="medium">
            <a href="<?=BASE_PATH?>images/prod_img/<?=$row['image2']?>" target="_blank"
                class="item" data-pswp-width="400px" data-pswp-height="450px">
                <img class="tf-image-zoom lazyload"
                    data-zoom="<?=BASE_PATH?>images/prod_img/<?=$row['image2']?>"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image2']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image2']?>"
                    alt="<?=$row['alttext2']?>">
            </a>
        </div>
        <?php 
    }
    if($row['image3']!=""){
        ?>
        <div class="swiper-slide" data-color="black" data-size="medium">
            <a href="<?=BASE_PATH?>images/prod_img/<?=$row['image3']?>" target="_blank"
                class="item" data-pswp-width="400px" data-pswp-height="450px">
                <img class="tf-image-zoom lazyload"
                    data-zoom="<?=BASE_PATH?>images/prod_img/<?=$row['image3']?>"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image3']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image3']?>"
                    alt="<?=$row['alttext3']?>">
            </a>
        </div>
        <?php 
    }
    if($row['image4']!=""){
        ?>
        <div class="swiper-slide" data-color="black" data-size="medium">
            <a href="<?=BASE_PATH?>images/prod_img/<?=$row['image4']?>" target="_blank"
                class="item" data-pswp-width="400px" data-pswp-height="450px">
                <img class="tf-image-zoom lazyload"
                    data-zoom="<?=BASE_PATH?>images/prod_img/<?=$row['image4']?>"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image4']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image4']?>"
                    alt="<?=$row['alttext4']?>">
            </a>
        </div>
        <?php 
    }
    if($row['image5']!=""){
        ?>
        <div class="swiper-slide" data-color="black" data-size="medium">
            <a href="<?=BASE_PATH?>images/prod_img/<?=$row['image5']?>" target="_blank"
                class="item" data-pswp-width="400px" data-pswp-height="450px">
                <img class="tf-image-zoom lazyload"
                    data-zoom="<?=BASE_PATH?>images/prod_img/<?=$row['image5']?>"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image5']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image5']?>"
                    alt="<?=$row['alttext5']?>">
            </a>
        </div>
        <?php 
    }
    if($row['image6']!=""){
        ?>
        <div class="swiper-slide" data-color="black" data-size="medium">
            <a href="<?=BASE_PATH?>images/prod_img/<?=$row['image6']?>" target="_blank"
                class="item" data-pswp-width="400px" data-pswp-height="450px">
                <img class="tf-image-zoom lazyload"
                    data-zoom="<?=BASE_PATH?>images/prod_img/<?=$row['image6']?>"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image6']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image6']?>"
                    alt="<?=$row['alttext6']?>">
            </a>
        </div>
        <?php 
    }
    if($row['image7']!=""){
        ?>
        <div class="swiper-slide" data-color="black" data-size="medium">
            <a href="<?=BASE_PATH?>images/prod_img/<?=$row['image7']?>" target="_blank"
                class="item" data-pswp-width="400px" data-pswp-height="450px">
                <img class="tf-image-zoom lazyload"
                    data-zoom="<?=BASE_PATH?>images/prod_img/<?=$row['image7']?>"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image7']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image7']?>"
                    alt="<?=$row['alttext7']?>">
            </a>
        </div>
        <?php 
    }
    if($row['image8']!=""){
        ?>
        <div class="swiper-slide" data-color="black" data-size="medium">
            <a href="<?=BASE_PATH?>images/prod_img/<?=$row['image8']?>" target="_blank"
                class="item" data-pswp-width="400px" data-pswp-height="450px">
                <img class="tf-image-zoom lazyload"
                    data-zoom="<?=BASE_PATH?>images/prod_img/<?=$row['image8']?>"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image8']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image8']?>"
                    alt="<?=$row['alttext8']?>">
            </a>
        </div>
        <?php 
    }
    
    
    ?>
        
                              
                            
                                <!-- grey -->
                              

            </div>
        </div>
        <div class="swiper-button-next nav-swiper thumbs-next"></div>
        <div class="swiper-button-prev nav-swiper thumbs-prev"></div>
    </div>
                    <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom"
                        data-preview="4" data-direction="horizontal">
                        <div class="swiper-wrapper stagger-wrap">
                            <!-- black -->
        <div class="swiper-slide stagger-item" data-color="black" data-size="small">
            <div class="item">
                <img class="lazyload"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image']?>"
                    alt="<?=$row['alttext']?>">
            </div>
        </div>
    <?php if($row['image1']!=""){ ?>                        
        <div class="swiper-slide stagger-item" data-color="black"
            data-size="medium">
            <div class="item">
                <img class="lazyload"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image1']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image1']?>"
                    alt="<?=$row['alttext1']?>">
            </div>
        </div>
    <?php } ?>                       
    <?php if($row['image2']!=""){ ?>                        
        <div class="swiper-slide stagger-item" data-color="black"
            data-size="medium">
            <div class="item">
                <img class="lazyload"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image2']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image2']?>"
                    alt="<?=$row['alttext2']?>">
            </div>
        </div>
    <?php } ?>                       
    <?php if($row['image3']!=""){ ?>                        
        <div class="swiper-slide stagger-item" data-color="black"
            data-size="medium">
            <div class="item">
                <img class="lazyload"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image3']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image3']?>"
                    alt="<?=$row['alttext3']?>">
            </div>
        </div>
    <?php } ?>                       
    <?php if($row['image4']!=""){ ?>                        
        <div class="swiper-slide stagger-item" data-color="black"
            data-size="medium">
            <div class="item">
                <img class="lazyload"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image4']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image4']?>"
                    alt="<?=$row['alttext4']?>">
            </div>
        </div>
    <?php } ?>                       
    <?php if($row['image5']!=""){ ?>                        
        <div class="swiper-slide stagger-item" data-color="black"
            data-size="medium">
            <div class="item">
                <img class="lazyload"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image5']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image5']?>"
                    alt="<?=$row['alttext5']?>">
            </div>
        </div>
    <?php } ?>                       
    <?php if($row['image6']!=""){ ?>                        
        <div class="swiper-slide stagger-item" data-color="black"
            data-size="medium">
            <div class="item">
                <img class="lazyload"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image6']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image6']?>"
                    alt="<?=$row['alttext6']?>">
            </div>
        </div>
    <?php } ?>                       
    <?php if($row['image7']!=""){ ?>                        
        <div class="swiper-slide stagger-item" data-color="black"
            data-size="medium">
            <div class="item">
                <img class="lazyload"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image7']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image7']?>"
                    alt="<?=$row['alttext7']?>">
            </div>
        </div>
    <?php } ?>                       
    <?php if($row['image8']!=""){ ?>                        
        <div class="swiper-slide stagger-item" data-color="black"
            data-size="medium">
            <div class="item">
                <img class="lazyload"
                    data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image8']?>"
                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image8']?>"
                    alt="<?=$row['alttext8']?>">
            </div>
        </div>
    <?php } ?>                       
                          
                           

                        </div>
                    </div>
                </div>
            </div>
        </div>
                        <!-- /Product Images -->
                        <!-- Product Info -->
    <div class="col-md-5">
        <div class="tf-zoom-main"></div>
        <div class="tf-product-info-wrap other-image-zoom">
            <div class="tf-product-info-list">
                <div class="tf-product-heading">
                   
                    <h1 class="product-name"><?=$row['product_name']?></h5>
                    <!--<div class="product-rate">
                        <div class="list-star">
                            <i class="icon icon-star"></i>
                            <i class="icon icon-star"></i>
                            <i class="icon icon-star"></i>
                            <i class="icon icon-star"></i>
                          
                        </div>
                        <span class="count-review">(4.8 reviews)</span>
                    </div>-->
                    <div class="product-price">
                        <table class="tb-info-product text-md">
            <tbody>
<?php 
$dq=$db->query("select * from mi_wproduct_detail where prd_id=? and mi_status='Yes' order by id asc limit 4",[$row['id']]);
 while($drow=$dq->fetch_assoc()){
   echo '<tr class="tb-attr-item">
                    <th class="tb-attr-label">'.$drow['keyname'].'</th>
                    <td class="tb-attr-value">
                        <p>'.$drow['keyvalue'].'</p>
                    </td>
                </tr>';  
 }
 ?>
                
          
            </tbody>
			
			
        </table>
		<p><?=$row['sdes']?>
		
		</div>
                   
                   
                </div>
               
               
                <ul class="tf-product-cate-sku text-md">
                   
                    <!--<li class="item-cate-sku">
                        <span class="label">Categories:</span>
<?php $cr=$db->query("select * from mi_category where id=? and mi_status='Yes'",[$row['cat_id']])->fetch_assoc(); 
?>
                        <span class="value"><a href="<?=BASE_PATH?>products/<?=$cr['urlname'];?>"><?=$cr['cat_name']?></a></span>
                    </li>-->
 <?php if($row['voucher']!=""){
 ?>
 <li class="item-cate-sku">
    <span class="label">Broucher:</span>
    <span class="value"><a href="<?=BASE_PATH?>images/prod_img/<?=$row['voucher'];?>" download="Broucher_<?=$row['urlname']?>.pdf">Download</a></span>
</li>
 <?php 
 }
 ?>
                    
                    
                </ul>
               
                
            </div>
        </div>
    </div>
						
						
						 <div class="col-md-2 text-center">
						 
								<form method="post" id="ord_form" class="form-default" action="" style="background: #f3f3f3; padding: 20px; border-radius: 16px;">
									<input type="hidden" value="<?=$row['id']?>" name="prd_id" />
								    <input type="hidden" value="<?=$row['product_name']?>" name="prd_name" />
								    <input type="hidden" value="order" name="method" />
									<input type="hidden" value="<?=$post_id?>" name="_token" />
									
                                    <div class="wrap">
									<p class="mb-3">Get a Free Quote</p>
									<div class="cols mb-2">
										<fieldset>
											<input name="name" id="name" class="radius-8 name" type="text" placeholder=" Your Name" required maxlength="50">
										</fieldset>
									</div>
									<div class="cols mb-2">
										<fieldset>
											<input name="mobile" id="mob" class="radius-8" type="number" maxlength="10" required placeholder="Mobile">
										</fieldset>
									</div>
                                       <div class="cols mb-2">
                                            <fieldset>
                                                <input name="qty" id="name" class="radius-8" type="text" required="" placeholder="Quantity*" maxlength="3" required>
                                            </fieldset>
                                           
                                        </div>
										<div class="cols mb-2 text-center">
                                            <fieldset>
                                               <textarea name="message" id="message" placeholder=" Requirement" required class="radius-8"></textarea>
                                            </fieldset>
                                           
                                        </div>
										<div id="msg"></div>
                                        <button type="submit" id="btnSubmit" class="btn btn-sm btn-danger ">Submit</button>
                                       
                                    </div>
                                </form>
								
								
						 
						
									
						 </div>
                        <!-- /Product Info -->

                    </div>
                </div>
            </div>
			
			
			
			
			
			
			
			
            <div class="tf-sticky-btn-atc">
                <div class="container">
                    <div class="tf-height-observer w-100 d-flex align-items-center">
                        <div class="tf-sticky-atc-product d-flex align-items-center">
                            <div class="tf-sticky-atc-img">
                                <img class="lazyload" data-src="<?=BASE_PATH?>images/prod_img/<?=$row['image']?>" alt="<?=$row['alttext']?>"
                                    src="<?=BASE_PATH?>images/prod_img/<?=$row['image']?>">
                            </div>
                            <div class="tf-sticky-atc-title fw-5 d-xl-block d-none"><?=$row['product_name']?></div>
                        </div>
                        <div class="tf-sticky-atc-infos">
                            <form class="">
                               <!-- <div class="tf-sticky-atc-variant-price text-center tf-select">
                                   <input name="name" id="name" class="radius-8" type="text" required="" placeholder="Quantity*">
                                </div>-->
                                <input type="hidden" name="prd_id" value="<?=$row['id']?>"
                                <div class="tf-sticky-atc-btns">
                                    <div class="tf-product-info-quantity">
                                        <input name="name" id="name" class="radius-8" type="text" required="" placeholder="Pieces*">
                                    </div>
                                   
										<a href="#quote" data-bs-toggle="modal" 
                                        class="tf-btn animate-btn d-inline-flex justify-content-center">Get Best Price</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Product Main -->
		
		
	<section class="flat-spacing pt-0">
            <div class="container">
                <div class="widget-accordion wd-product-descriptions">
                    <div class="accordion-title collapsed" data-bs-target="#description" data-bs-toggle="collapse" aria-expanded="true" aria-controls="description" role="button">
                        <span>Descriptions</span>
                        <span class="icon icon-arrow-down"></span>
                    </div>
                    <div id="description" class="collapse">
                        <div class="accordion-body widget-desc">
                            <?=($row['description'])?>
                            <!--<div class="item">
                                <p class="fw-medium title">Composition</p>
                                <ul>
                                    <li>Viscose 55%, Linen 45%</li>
                                    <li>We exclude the weight of minor components</li>
                                </ul>
                            </div>
                            <p class="item">Additional material information</p>
                            <div class="item">
                                <p class="title">The total weight of this product contains:</p>
                                <ul>
                                    <li>55% LivaEco™ viscose</li>
                                    <li>Viscose 55%</li>
                                </ul>
                            </div>
                            <ul class="item">
                                <li>We exclude the weight of minor components such as, but not exclusively: threads,
                                    buttons, zippers, embellishments and prints.</li>
                                <li>The total weight of the product is calculated by adding the weight of all layers and
                                    main components together. Based on that, we calculate how much of that weight is
                                    made out by each material. For sets &amp; multipacks all pieces are counted together as
                                    one product in calculations.</li>
                                <li>Materials in this product explained</li>
                                <li>LinenLinen is a natural bast fibre derived from flax plants.</li>
                                <li>LivaEco™ viscoseLivaEco™ viscose is a branded viscose fibre, made from wood pulp.
                                </li>
                                <li> ViscoseViscose is a regenerated cellulose fibre commonly made from wood, but the
                                    raw material could also consist of other cellulosic materials.</li>
                            </ul>-->
                        </div>
                    </div>
                </div>
<?php 
if($row['vurl']!=""){
    $vid = getYouTubeVideoId($row['vurl']);
    ?>
    <div class="widget-accordion wd-product-descriptions">
        <div class="accordion-title collapsed" data-bs-target="#material" data-bs-toggle="collapse" aria-expanded="true" aria-controls="material" role="button">
            <span>Video For <?=$row['product_name']?> </span>
            <span class="icon icon-arrow-down"></span>
        </div>
        <div id="material" class="collapse">
            <div class="accordion-body widget-material">
                <div class="item">
                    <div class="video-container" id=" video-container">
                      <img src="https://img.youtube.com/vi/<?=$vid?>/maxresdefault.jpg" alt="Preview" class="thumbnail">
                      <div class="play-button">►</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
                
               
                <div class="widget-accordion wd-product-descriptions">
                    <div class="accordion-title collapsed" data-bs-target="#addInformation" data-bs-toggle="collapse" aria-expanded="true" aria-controls="addInformation" role="button">
                        <span>Additional Information</span>
                        <span class="icon icon-arrow-down"></span>
                    </div>
                    <div id="addInformation" class="collapse">
                        <div class="accordion-body">
                            <table class="tb-info-product text-md">
                                <tbody>
<?php 
$dq=$db->query("select * from mi_wproduct_detail where prd_id=? and mi_status='Yes' order by id asc limit 3",[$row['id']]);
 while($drow=$dq->fetch_assoc()){
   echo '<tr class="tb-attr-item">
                    <th class="tb-attr-label">'.$drow['keyname'].'</th>
                    <td class="tb-attr-value">
                        <p>'.$drow['keyvalue'].'</p>
                    </td>
                </tr>';  
 }
 ?>                                    
                           <!--   <tr class="tb-attr-item">
                                        <th class="tb-attr-label">Material</th>
                                        <td class="tb-attr-value">
                                            <p>100% Cotton</p>
                                        </td>
                                    </tr>
                                    <tr class="tb-attr-item">
                                        <th class="tb-attr-label">Color</th>
                                        <td class="tb-attr-value">
                                            <p>White, Black, Brown</p>
                                        </td>
                                    </tr>
                                    <tr class="tb-attr-item">
                                        <th class="tb-attr-label">Brand</th>
                                        <td class="tb-attr-value">
                                            <p>Vineta</p>
                                        </td>
                                    </tr>
                                    <tr class="tb-attr-item">
                                        <th class="tb-attr-label">Size</th>
                                        <td class="tb-attr-value">
                                            <p>S, M, L, XL</p>
                                        </td>
                                    </tr>-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
				 
                
            </div>
        </section>
	
	<?php include_once"config/footer.php";?>

  
   </div>


 <?php include_once"modals/all.php";?>
   
 <?php include_once"config/mobile_menu.php";?>  
 <?php include_once"config/foot.php";?> 

<script src="<?=BASE_PATH?>js/drift.min.js"></script>


    <script src="<?=BASE_PATH?>js/photoswipe-lightbox.umd.min.js"></script>
    <script src="<?=BASE_PATH?>js/photoswipe.umd.min.js"></script>
    <script src="<?=BASE_PATH?>js/zoom.js"></script>
   
<script>
  document.querySelector('.video-container').addEventListener('click', function(){
    this.innerHTML ='<iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1" frameborder="0" allowfullscreen></iframe>';
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

	$("body").on("submit","#ord_form",function(e){
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
$(".tf-sticky-btn-atc").hide();
	
  });
  </script> 
   
   




   
   
</body>


</html>