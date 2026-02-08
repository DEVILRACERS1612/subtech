   <!-- Top Bar-->
        <div class="tf-topbar bg-dark-5 topbar-bg">
            <div class="container">
                <div class="topbar-wraper">
                    <div class="d-none d-xl-block flex-shrink-0">
                        <ul class="tf-social-icon topbar-left">
                            <li><a href="https://www.facebook.com/subtech.e" class="social-item social-facebook"><i
                                        class="icon icon-fb"></i></a></li>
                            <li><a href="https://www.instagram.com/subtech.e/" class="social-item social-instagram"><i
                                        class="icon icon-instagram"></i></a>
                            </li>
                            <li><a href="https://x.com/Subteche" class="social-item social-x"><i class="icon icon-x"></i></a>
                            </li>
							<li><a href="https://www.youtube.com/@subtech.e" class="social-item social-x"><i class="icon icon-youtube"></i></a>
                            </li>
                            <li><a href="https://linkedin.com/company/subtech-e/" class="social-item social-snapchat"><i
                                        class="icon icon-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="overflow-hidden">
                        <div class="topbar-center marquee-wrapper">
                            
                        </div>
                    </div>
                    <div class="d-xl-block flex-shrink-0">
                        <div class="topbar-right">
                            <div class="tf-languages">
                              <a href="<?=BASE_PATH?>complains" class="text-white"><i class="icon icon-precision"></i> Complain</a>
                            </div>
							 <div class="tf-languages">
                              <a href="<?=BASE_PATH?>contact" class="text-white"><i class="icon icon-phone"></i>Contact</a>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Top Bar -->
        <!-- Header -->
        <header id="header" class="header-default">
            <div class="container">
                <div class="row wrapper-header align-items-center">
                    <div class="col-md-4 col-3 d-xl-none">
                        <a href="#mobileMenu" class="mobile-menu" data-bs-toggle="offcanvas" aria-controls="mobileMenu">
                            <i class="icon icon-categories1"></i>
                        </a>
                    </div>
                    <div class="col-xl-2 col-md-4 col-6">
                        <a href="<?=BASE_PATH?>" class="logo-header">
                            <img src="<?=BASE_PATH?>images/logo/logo.png" alt="subtech logo" class="logo">
                        </a>
                    </div>
                    <div class="col-xl-8 d-none d-xl-block">
                        <nav class="box-navigation text-center">
                            <ul class="box-nav-menu">
        		  
							  
							  <li class="menu-item"><a href="<?=BASE_PATH?>" class="item-link">Home</a></li>
							  
				
								
                            <li class="menu-item">
                                <a href="#" class="item-link">Products<i class="icon icon-arr-down"></i></a>
                                <div class="sub-menu mega-menu mega-tab">
                                    <div class="wrapper-sub-menu-tab flat-animate-tab">
                                        <ul class="menu-tab" role="tablist">
                                            <li class="nav-tab-item" role="presentation">
                                                <a href="#productLayouts" class="tab-link active"
                                                    data-bs-toggle="tab">Motor Stator <i
                                                        class="icon icon-arr-right"></i></a>
                                            </li>
                                            
                                            <li class="nav-tab-item" role="presentation">
                                                <a href="#productFeatures" class="tab-link" data-bs-toggle="tab">Automatic Changeover / ATS
												<i class="icon icon-arr-right"></i></a>
                                            </li>
                                           
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active show" id="productLayouts" role="tabpanel">
                                                <ul class="menu-list">
                                                    <li><a href="" class="menu-link-text link">Single Phase Starter</a></li>
													<li><a href="" class="menu-link-text link">Two Phase Starter</a></li>
													<li><a href="" class="menu-link-text link">Three Phase Starter</a></li>
													<li><a href="" class="menu-link-text link">GSM Based Starter</a></li>
                                                    
                                                </ul>
                                               
                                            </div>
                                          
                                            <div class="tab-pane" id="productFeatures" role="tabpanel">
                                                <ul class="menu-list">
                                                     <li><a href="" class="menu-link-text link">Single Phase Starter</a></li>
													<li><a href="" class="menu-link-text link">Two Phase Starter</a></li>
													<li><a href="" class="menu-link-text link">Three Phase Starter</a></li>
													<li><a href="" class="menu-link-text link">GSM Based Starter</a></li>
                                                    
                                                </ul>
                                            </div>
                                           
                                        </div>
                                    </div>
                                  
                                </div>
                            </li>
							
							
							  
							  <style>
							  .tabs {
									display: flex
								;
									justify-content: space-around;
									align-items: center;
									text-align: center;
									padding-bottom: 20px;
									border-bottom: 1px solid #e7e7e7;
								}
															  </style>
							  
							 <li class="menu-item">
                                    <a href="<?=BASE_PATH?>products" class="item-link">Products<i class="icon icon-arr-down"></i></a>
                                    <div class="sub-menu mega-menu mega-home">
                                      
									  <div class="container header-menus">
										  <div class="tabs">
											<?php 
											$pdq=$db->exeQuery("select * from mi_pcat where mi_status='Yes' order by id desc");
											while($prow=$pdq->fetch_assoc()){
											  ?>
												<div id="tabs-nav">
												  <div class="">
													<a href="<?=BASE_PATH?>products/<?=$prow['urlname']?>" data-href="#tab1">
													  <img width="70" height="70" class=" ls-is-cached lazyloaded" alt="Fans" data-src="<?=IMG_PATH?>images/cat_img/<?=$prow['image']?>" src="<?=IMG_PATH?>images/cat_img/<?=$prow['image']?>" alt="<?=$prow['alttext']?>">
													  <div class="text-primary"><?=$prow['cat_name']?></div>
													</a>
												  </div>
												</div>
											  <?php 
											}
											?>
											</div>
										</div>
											
	
                                   
                                    </div>
                                </li>

						<li class="menu-item"><a href="<?=BASE_PATH?>solutions" class="item-link">Solutions</a></li>
                                <li class="menu-item position-relative">
                                    <a href="javascript:void(0)" class="item-link">Company<i class="icon icon-arr-down"></i></a>
                                    <div class="sub-menu sub-menu-style-2">
                                        <ul class="menu-list">
                                            <li><a href="<?=BASE_PATH?>about" class="menu-link-text link">About</a></li>
                                            <li><a href="<?=BASE_PATH?>contact" class="menu-link-text link">Contact</a></li>
											<li><a href="<?=BASE_PATH?>teams" class="menu-link-text link">Teams</a></li>
                                            <li><a href="<?=BASE_PATH?>dealer-locator" class="menu-link-text link">Dealer
                                                    Locator</a></li>
                                            <li><a href="<?=BASE_PATH?>news-media" class="menu-link-text link">News & Media</a>
                                            </li>
											 <li><a href="<?=BASE_PATH?>testimonials" class="menu-link-text link">Testimonials</a>
                                            </li>
                                            
                                          
                                            
                                        </ul>
                                        <ul class="menu-list">
                                           
                                          
                                           
											<li><a href="<?=BASE_PATH?>complains" class="menu-link-text link">Grievance</a></li>
                                            <li><a href="<?=BASE_PATH?>blogs" class="menu-link-text link">Blogs</a></li>
											<li><a href="<?=BASE_PATH?>faqs" class="menu-link-text link">FAQ's</a></li>
											  <li><a href="<?=BASE_PATH?>become-a-partner" class="menu-link-text link">Become a Partner</a></li>
											  <li><a href="<?=BASE_PATH?>jobs" class="menu-link-text link">Career</a></li>
                                          
                                        </ul>
										
                                        <div class="banner hover-img">
                                            <a href="<?=BASE_PATH?>about" class="img-style">
                                                <img src="<?=BASE_PATH?>images/subtech.jpg" alt="subtech manufacturing office image">
                                            </a>
                                            <div class="content">
                                                <!--<div class="title">
                                                    Unveiling the latest gear
                                                </div>-->
                                                <a href="<?=BASE_PATH?>about" class="box-icon animate-btn"><i
                                                        class="icon icon-arrow-top-left"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                               
							   
                                
								<li class="menu-item"><a href="<?=BASE_PATH?>contact" class="item-link">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
					
                    <div class="col-xl-2 col-md-4 col-3">
                        <ul class="nav-icon d-flex justify-content-end align-items-center">
                           <!-- <li class="nav-search">
                                <a href="#search" data-bs-toggle="modal" class="nav-icon-item">
                                    <i class="icon icon-search"></i>
                                </a>
                            </li>-->
                            <li class="nav-account">
                                <a href="#login" data-bs-toggle="offcanvas" aria-controls="login" class="nav-icon-item">
                                    <i class="icon icon-user"></i>
                                </a>
                            </li>
							
							
                            <li class="nav-cart">
                                <a href="" class="nav-icon-item">
                                   <img alt="whatsapp" loading="lazy" width="35" height="35" decoding="async" data-nimg="1" src="<?=BASE_PATH?>images/whatsapp.svg" style="color: transparent;">
                                </a>
                            </li>
                           
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->