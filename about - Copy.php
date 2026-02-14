<?php
include_once "./config/config.inc.php";
?>

<!DOCTYPE html>

<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->


<head>
    <meta charset="utf-8">
    <title>Subtech - Electrical Automation | LT Panels, AMF ATS & Control Panel Manufacturer India</title>
    
     <meta name="title" content="Subtech - Electrical Automation | LT Panels, AMF ATS & Control Panel Manufacturer India">
	 <meta name="description" content="Subtech is a leading Indian manufacturer of LT panels, AMF/ATS systems, motor starters, and industrial control panels, delivering reliable and future-ready automation solutions across India.">
	  <link rel="canonical" href="https://subtech.in/about">
    <?php include_once"config/head.php";?>
 

	 <style>
      
        /* Custom styling for the tab header to match the design */
        .nav-tabs .nav-link {
            border: none;
            border-radius: 0;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            transition: color 0.15s ease-in-out, border-color 0.15s ease-in-out;
            color: var(--bs-secondary);
        }

        /* Active tab styling to show the blue bottom border and bold text */
        .nav-tabs .nav-link.active {
            color: var(--bs-dark) !important;
            font-weight: 600 !important;
            border-bottom: 3px solid var(--bs-primary) !important;
            background-color: transparent !important;
        }

        /* Remove default link hover effects that don't match the design */
        .nav-tabs .nav-link:hover {
            border-color: transparent !important;
            color: var(--bs-dark);
        }
        
        /* Custom CSS for Timeline Structure */
        .timeline {
            position: relative;
        }

        /* The vertical connecting line */
        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 2px;
            background: #e9ecef; /* Light gray line color */
            margin-left: -1px;
            z-index: 0;
        }

        /* Timeline item padding is increased to accommodate the larger dot */
        .timeline-item {
            padding-bottom: 70px; /* Space between items */
            padding-top: 20px;
            position: relative;
        }

        /* The circle marker, now containing the year text */
        .timeline-dot {
            position: absolute;
            top: 40px; 
            left: 50%;
            transform: translateX(-50%);
            width: 60px; 
            height: 60px; 
            border-radius: 50%;
            background-color: #e40006; /* Blue color */
            z-index: 10;
            
            /* Text styling for the year inside */
            color: #fff;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            /* Matches the look of the image's dot */
            box-shadow: 0 0 0 3px #af0909; 
        }

        /* Styling for content columns on desktop */
        @media (min-width: 768px) {
            /* Content left of the line (text aligned right) */
            .timeline-content-left {
                text-align: right;
                padding-right: 70px; /* Space between text and dot */
            }

            /* Content right of the line (text aligned left) */
            .timeline-content-right {
                text-align: left;
                padding-left: 70px; /* Space between text and dot */
            }
        }

        /* Responsive adjustments for mobile (stack and align everything to the left) */
        @media (max-width: 767.98px) {
            /* Move the vertical line to the left on mobile */
            .timeline::before {
                left: 30px;
            }

            /* Move the dot to the left on mobile */
            .timeline-dot {
                left: 30px;
                transform: translateX(-50%);
                top: 40px;
            }
            
            /* Align all content to the left on mobile, pushing it past the dot */
            .timeline-content-left, .timeline-content-right {
                padding-left: 80px !important; 
                padding-right: 0 !important;
                text-align: left !important;
                margin-top: 10px;
            }
            
            /* Adjust padding on timeline item to use less vertical space */
            .timeline-item {
                 padding-bottom: 40px;
                 padding-top: 0;
            }

            /* On mobile, stack items but ensure the logo is visually paired with its text block */
            .order-md-1 { order: 2; }
            .order-md-2 { order: 1; }
        }

        /* Styling for the logo placeholders (max-width controls size) */
        .logo-placeholder {
            max-width: 150px;
            height: auto;
            margin-bottom: 0;
        }
        
        /* Ensure logos on the left side are centered/right aligned in their column for desktop */
        .logo-container-left {
            display: flex;
            justify-content: flex-end; /* Right-align on desktop */
            align-items: center;
        }
         /* Ensure logos on the right side are centered/left aligned in their column for desktop */
        .logo-container-right {
            display: flex;
            justify-content: flex-start; /* Left-align on desktop */
            align-items: center;
        }
        
        @media (max-width: 767.98px) {
            .logo-container-left, .logo-container-right {
                justify-content: flex-start !important; /* Left-align on mobile */
                margin-bottom: 15px; /* Add space between logo and text block on mobile */
            }
        }
    </style>

</head>

<body>
	
	<?php include_once"config/header-top.php";?>

    <div id="wrapper">
     
	 <?php include_once"config/header.php";?>
	 
		<section class="flat-spacing-8" style="padding-bottom:1px">
            <div class="container">
                <div class="flat-title-2 text-center">
				
				<div class="box-title">
				      <h1 class="title">About Subtech</h1>
                       
						  <h6 class="title" style="color:#e93132">A Legacy of Innovation and Quality</h6>
                        
						 
						 
                    </div>
                  
						 <div class="col-lg-8 col-md-10 mx-auto">
						 <p class="desc text-main text-md"><b> Subtech</b> is a leading Indian manufacturer and solution provider in the field of electrical automation, specializing in LT panels, AMF/ATS systems, motor starters, and industrial control panels.<br>

With a deep-rooted commitment to innovation, safety, and performance, we serve a diverse clientele across residential, commercial, agricultural, and industrial sectors.<br>

With a presence across India and trust of over 200 businesses, Subtech is recognized for delivering reliable, efficient, and customized solutions that simplify motor control and power management.
<br>
Our product portfolio includes DOL and Star-Delta starters, single-phase and three-phase control panels, and advanced automation systems designed to meet modern energy needs.
<br>
At Subtech, we combine decades of practical experience with a forward-thinking approach.
<br>
Our in-house R&D and quality control practices ensure that every product is built for durability, safety, and long-term performance.
<br>
We are continuously evolving by integrating IoT, smart monitoring, and digital technologies into our solutions—making our systems future-ready.
</p>
						 
						 <div class="image radius-16 overflow-hidden w-100">
                            <img src="<?=BASE_PATH?>images/subtech.png" data-src="images/subtech.jpg" alt="" class="w-100 h-100 object-fit-cover ls-is-cached lazyloaded">
                        </div>
				</div> 
				   
				   
                  
                </div>
              
            </div>
        </section>
		
		
<!--			 		
<section class="container-fluid py-5 d-flex justify-content-center align-items-center min-vh-100 flat-spacing-8" style="background-image: url(./images/vision_back.jpg); background-size: cover; background-position: center center; background-repeat: no-repeat;">-->
    
    <section class="container-flui d-flex justify-content-center align-items-center min-vh-100" >
    <!--<div class="row w-100">
        <div class="col-12 text-center mb-4">
            <div class="text-dark">
                <h2 class="fw-bold fs-1 text-bold">
                    Vision & Mission <span class="text-danger">Subtech</span>
                </h2>
              
            </div>
        </div>-->
        
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="row">
        <div class="col-lg-6 col-md-10">
            <div class="p-5 rounded-3  shadow" style="min-height: 500px;">
					<h4 class="text-danger">Mission</h4>
                <p style="line-height:2.5rem">To deliver high-quality motor control and protection solutions at competitive prices.
					To continuously innovate with smart and connected technologies that simplify everyday operations.
					To build long-term relationships with customers through transparency, service, and trust.
					To contribute to India’s progress toward digital and sustainable electrical infrastructure.<br>
					<!--<b>Core Values</b><br>
					<b>1. Quality First – Every product we build passes rigorous testing to ensure durability and performance.</b><br>
					<b>2. Innovation – We combine engineering expertise with smart automation to stay ahead of the curve.</b><br>
					<b>3. Customer Focus – We design with the user in mind — simple, efficient, and built for real-world needs.</b><br>
					<b>4. Integrity – We believe in honest business, transparent communication, and ethical practices.</b><br>
					<b>5. Sustainability – Our products are designed to save energy, protect motors, and reduce environmental impact.</b><br>
					<b>6. Reliability – We stand behind our products and commitments — ensuring peace of mind for every customer.</b>--></p>
				                            
							
			</div>
        </div>
		
		 <div class="col-lg-6 col-md-10">
            <div class="p-5 rounded-3  shadow"  style="min-height: 500px;">
					<h4 class="text-danger">Vision</h4>
                 <p style="line-height:2.5rem">To become India’s most trusted and innovative brand in electrical automation and control solutions, bringing intelligent, reliable, and sustainable technology to every home, field, and industry by 2030.</p>
				                            
							
			</div>
        </div>
       </div> 
    </div>    
    </div>
</section>

		




		<!-- START OF BOOTSTRAP 5 SECTION -->
    <section class="flat-spacing-5">
        <div class="container">
            <!-- Section Header -->
            <div class="row justify-content-center text-center mb-4">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                    <h2 class="display-6 fw-bold mb-3 text-danger">Why Choose Us?</h2>
                    <p class="lead text-dark mb-0">Our proprietary lamination and winding techniques significantly reduce core and eddy current losses, delivering superior power density and torque.</p>
                </div>
            </div>

            <!-- Feature Cards Grid -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                <!-- Feature 1: Responsive Layout -->
                <div class="col">
                    <div class="card feature-card border-0 shadow-lg h-100 p-4 rounded-4">
                        <div class="card-body text-center">
                            <!-- Icon -->
                            <i class="bi bi-grid-fill display-5 text-primary mb-3"></i>
                            <!-- Content -->
                            <h5 class="card-title fw-bold text-danger mb-2">High Durability Products</h5>
                            <p class="card-text text-dark mb-4 text-danger">
                               Our products are designed to withstand tough industrial conditions. Manufactured using premium materials and tested under rigorous standards, Subtech products offer long-lasting performance, minimal maintenance, and excellent reliability even in extreme environments.
                            </p>
                            
                            
                        </div>
                    </div>
                </div>

                <!-- Feature 2: Utility Classes -->
                <div class="col">
                    <div class="card feature-card border-0 shadow-lg h-100 p-4 rounded-4">
                        <div class="card-body text-center">
                            <!-- Icon -->
                            <i class="bi bi-gear-wide-connected display-5 text-success mb-3"></i>
                            <!-- Content -->
                            <h5 class="card-title fw-bold mb-2 text-danger">Trusted by Thousands of Businesses</h5>
                            <p class="card-text text-dark mb-4">
                                
From OEMs to infrastructure developers and public sector units, our client base spans across industries. The trust of thousands of satisfied customers is a testament to our product quality, transparency, and customer-first approach.
                            </p>
                           
                        </div>
                    </div>
                </div>

                <!-- Feature 3: Modern Components -->
                <div class="col">
                    <div class="card feature-card border-0 shadow-lg h-100 p-4 rounded-4">
                        <div class="card-body text-center">
                            <!-- Icon -->
                            <i class="bi bi-layers-fill display-5 text-danger mb-3"></i>
                            <!-- Content -->
                            <h5 class="card-title fw-bold text-danger mb-2">Robust After-Sales Support</h5>
                            <p class="card-text text-dark mb-4">
                                
We believe in building lasting relationships. Our dedicated support team ensures that any issues or service needs are addressed promptly. From installation guidance to troubleshooting and warranty claims, we stand by our customers long after the purchase.
                            </p>
                           
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Feature Cards Grid -->

        </div>
    </section>
    <!-- END OF BOOTSTRAP 5 SECTION -->
    
		
		
		
		<section class="bg-surface">
           
		   
    <div class="container py-5">
 <h2 class="display-6 fw-bold mb-3 text-danger">Our Journey</h2>
	
<p>At Subtech (S S Power System), our journey is one of innovation, dedication, and continuous growth. From humble beginnings to global recognition, we have consistently evolved to deliver cutting-edge power automation and electrical control solutions that empower industries and simplify lives.</p>


        
        <!-- Header/Filter Tabs (Bootstrap Tabs Structure) -->
        <ul class="nav nav-tabs border-bottom-0 mb-4 pt-3" id="timelineTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link px-3 pb-2 fs-6 active" id="tab-2016-tab" data-bs-toggle="tab" data-bs-target="#tab-2016" type="button" role="tab" aria-controls="tab-2016" aria-selected="true">2016 & Beyond</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link px-3 pb-2 fs-6" id="tab-2015-tab" data-bs-toggle="tab" data-bs-target="#tab-2015" type="button" role="tab" aria-controls="tab-2015" aria-selected="false">2015-2003</button>
            </li>
           <!-- <li class="nav-item" role="presentation">
                <button class="nav-link px-3 pb-2 fs-6" id="tab-pre1999-tab" data-bs-toggle="tab" data-bs-target="#tab-pre1999" type="button" role="tab" aria-controls="tab-pre1999" aria-selected="false">PRE 1999</button>
            </li>-->
        </ul>
        
        <h1 class="visually-hidden">Corporate Journey</h1>
        
        <!-- Tab Content -->
        <div class="tab-content">

            <!-- 1. 2016 & Beyond Content (Active) -->
            <div class="tab-pane fade show active" id="tab-2016" role="tabpanel" aria-labelledby="tab-2016-tab">
                <div class="timeline">
				
				
				  <!-- Item 1: Content Left, Logo Right -->
                    <div class="timeline-item">
                        <div class="row align-items-center">
                            <div class="col-md-6 timeline-content-left order-md-1 order-2">
                               
                            <h6 class="fw-bold text-dark mt-0">Today – Innovating for a Smarter Tomorrow</h6>
<p class="text-dark mb-0">From our early days of innovation to our expanding global presence, <b>Subtech</b> stands as a symbol of trust, technology, and transformation.<br>
Our focus remains on creating sustainable, efficient, and intelligent automation solutions that empower industries, improve energy efficiency, and shape a more reliable future.</p>

								
                            </div>
                            <div class="timeline-dot">2025</div>
                            <div class="col-md-6 logo-container-right order-md-2 order-1">
                              
                            </div>
                        </div>
                    </div>
					
					
                    <!-- Item 1.1: Logo Left, Content Right -->
                    <div class="timeline-item">
                        <div class="row align-items-center">
                            <div class="col-md-6 logo-container-left order-md-1 order-2">
                                <!--<img src="https://placehold.co/150x80/017724/ffffff?text=Growth" alt="Growth" class="img-fluid logo-placeholder rounded-3 shadow-sm" />-->
                            </div>
                            <div class="timeline-dot">2018</div>
                            <div class="col-md-6 timeline-content-right order-md-2 order-1">
                                <h4 class="fw-bold text-dark fs-6 mt-0">2018- A Year of Growth and Diversification</h4> 
                                <p class="text-dark mb-0">We further expanded our reach across government, corporate, and institutional sectors:<br>

 • <b>Aligarh Muslim University</b> – Offered customized control solutions to support their day-to-day operations.<br>
 • <b>Siddhartha Cooperative Group Housing Society</b> – Provided energy-efficient automation solutions tailored to their requirements.<br>
 • <b>Kinobeo Softwares Pvt. Ltd.</b> – Installed electrical distribution systems for efficient power control and monitoring.<br>
 • <b>Supertech </b>– Delivered tailored automation solutions to streamline operations.<br>
 • <b>Jaiprakash Associates Ltd.</b> – Partnered to create efficient water management workflows through automation.<br>
 • <b>GAIL (India) Ltd.</b> – Extended collaboration with new automation systems for enhanced performance.<br>
This year highlighted our growth as a nationwide automation partner, trusted by both private and public sector enterprises.<br></p>

                            </div>
                        </div>
                    </div>

                    <!-- Item 2: Content Left, Logo Right -->
                    <div class="timeline-item">
                        <div class="row align-items-center">
                            <div class="col-md-6 timeline-content-left order-md-1 order-2">
                                <h4 class="fw-bold text-dark fs-6 mt-0">2017- Expanding Into Public Infrastructure</h4>
                                <p class="text-dark mb-0">We extended our expertise into <b>public utilities and infrastructure:</b><br>
• <b>DMRC (Delhi Metro Rail Corporation)</b> – Delivered automation systems that enhanced operational efficiency.</p>
                            </div>
                            <div class="timeline-dot">2017</div>
                            <div class="col-md-6 logo-container-right order-md-2 order-1">
                              
                            </div>
                        </div>
                    </div>

                    <!-- Item 3: Logo Left, Content Right -->
                    <div class="timeline-item">
                        <div class="row align-items-center">
                            <div class="col-md-6 logo-container-left order-md-1 order-2">
                             
                            </div>
                            <div class="timeline-dot">2016</div>
                            <div class="col-md-6 timeline-content-right order-md-2 order-1">
                                <h4 class="fw-bold text-dark fs-6 mt-0">2016 –  Strengthening Industrial Collaboration</h4>
                                <p class="text-dark mb-0">Our expertise expanded across major industrial and construction sectors:<br>
 • <b>Ansal Housing & Construction Ltd.</b> – Supplied advanced electrical systems to enhance centralized control.<br>
 • <b>GAIL (India) Ltd.</b> – Implemented tailored automation systems that increased reliability and safety.<br>
Through these partnerships, we continued to demonstrate excellence in <b>industrial automation and intelligent engineering.</b></p>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Timeline Container -->
            </div>








            <!-- 2. 2015-2000 Content (Placeholder) -->
            <div class="tab-pane fade" id="tab-2015" role="tabpanel" aria-labelledby="tab-2015-tab">
                               <div class="timeline">
							   
						
						<div class="timeline-item">
                        <div class="row align-items-center">
                            <div class="col-md-6 timeline-content-left order-md-1 order-2">
                                <h4 class="fw-bold text-dark fs-6 mt-0">2015 – Building Strong Partnerships</h4>
                                <p class="text-dark mb-0">Our work gained the trust of several leading corporations and institutions across India:<br>
• <b>Gulshan Homes Pvt. Ltd.</b> – Delivered efficient automation solutions for their infrastructure needs.<br>
 • <b>NTPC</b> – Provided tailored control systems to optimize their operations.<br>
 • <b>Homes 121 Apartment Association</b> – Implemented customized automation to streamline daily utilities.<br>
 • <b>Delhi Public School</b> – Offered solutions crafted to meet their institutional requirements.<br>
 • <b>Punjab National Bank</b> – Provided automation systems ensuring consistent operational performance.</p>
                            </div>
                            <div class="timeline-dot">2015</div>
                            <div class="col-md-6 logo-container-right order-md-2 order-1">
                              
                            </div>
                        </div>
                    </div>
					
					
						
						 <div class="timeline-item">
                        <div class="row align-items-center">
                            <div class="col-md-6 logo-container-left order-md-1 order-2">
                                <!--<img src="https://placehold.co/150x80/017724/ffffff?text=Growth" alt="Growth" class="img-fluid logo-placeholder rounded-3 shadow-sm" />-->
                            </div>
                            <div class="timeline-dot">2013</div>
                            <div class="col-md-6 timeline-content-right order-md-2 order-1">
                                <h4 class="fw-bold text-dark fs-6 mt-0">2013 – Advancing Through Technology</h4> 
                                <p class="text-dark mb-0">We developed our specialized <b>“PMC” technology</b> for <b>precise and ideal switching</b>, ensuring accuracy and reliability in automated systems.<br>
This year also marked the establishment of our <b>state-of-the-art manufacturing plant in Greater Noida</b>, boosting our production capacity and enabling us to serve clients with higher efficiency and quality control.
								</p>
								
								<h4 class="fw-bold text-dark fs-6 mt-0">Embracing Smart Protection</h4> 
                                <p class="text-dark mb-0">We introduced <b>Motor Protection Units (MPUs)</b> in our motor starters an innovation driven by <b>digital microcontroller technology </b>— ensuring enhanced safety, reliability, and intelligent motor control for all applications.
								</p>
                            </div>
                        </div>
                    </div>
					
					
						

						
						 <div class="timeline-item">
                        <div class="row align-items-center">
                            <div class="col-md-6 timeline-content-left order-md-1 order-2">
                                <h4 class="fw-bold text-dark fs-6 mt-0">2011 – Expanding Product Horizons</h4>
                                <p class="text-dark mb-0">With a vision to provide comprehensive solutions, we expanded our portfolio by introducing <b>Motor Starters and AMF Panels<//b>, offering integrated systems for diverse industrial applications.<br>
                               
We also entered the <b>real estate sector</b>, introducing Subtech-made products to a new market segment, strengthening our customer base, and diversifying our reach.</p>
                            </div>
                            <div class="timeline-dot">2011</div>
                            <div class="col-md-6 logo-container-right order-md-2 order-1">
                              
                            </div>
                        </div>
                    </div>


	   
                    <!-- Item 1: Logo Left, Content Right -->
                    <div class="timeline-item">
                        <div class="row align-items-center">
                            <div class="col-md-6 logo-container-left order-md-1 order-2">
                                <!--<img src="https://placehold.co/150x80/017724/ffffff?text=Growth" alt="Growth" class="img-fluid logo-placeholder rounded-3 shadow-sm" />-->
                            </div>
                            <div class="timeline-dot">2008</div>
                            <div class="col-md-6 timeline-content-right order-md-2 order-1">
                                <h4 class="fw-bold text-dark fs-6 mt-0">2008 – Partnering for Progress</h4> 
                                <p class="text-dark mb-0">We launched our first <b>AMF Panels</b>, enhancing our product range and earning a reputation for delivering <b>dependable and high-performance electrical solutions.</b><br>
In the same year, we began our collaboration with <b>Honda</b>, developing <b>generator automation and solutions for petrol generators</b> marking the beginning of our journey into <b>smart power automation</b> and establishing Subtech as a trusted name in the generator control industry.
								</p>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2: Content Left, Logo Right -->
                    <div class="timeline-item">
                        <div class="row align-items-center">
                            <div class="col-md-6 timeline-content-left order-md-1 order-2">
                                <h4 class="fw-bold text-dark fs-6 mt-0">2005 – Expanding Beyond Borders</h4>
                                <p class="text-dark mb-0">By 2005, Subtech made its mark globally by starting the <b>export of Subtech products</b>, carrying our innovations to international markets and strengthening our global footprint.</p>
                            </div>
                            <div class="timeline-dot">2005</div>
                            <div class="col-md-6 logo-container-right order-md-2 order-1">
                              
                            </div>
                        </div>
                    </div>

                    <!-- Item 3: Logo Left, Content Right -->
                    <div class="timeline-item">
                        <div class="row align-items-center">
                            <div class="col-md-6 logo-container-left order-md-1 order-2">
                             
                            </div>
                            <div class="timeline-dot">2003</div>
                            <div class="col-md-6 timeline-content-right order-md-2 order-1">
                                <h4 class="fw-bold text-dark fs-6 mt-0">2003 – The Beginning of a Vision</h4>
                                <p class="text-dark mb-0">The foundation of our company was laid with the official registration under the name <b>S S Power System</b>, marking the beginning of our mission to deliver reliable and advanced power solutions.<br>
In the same year, we introduced automatic changeovers to the market an innovation that redefined convenience and efficiency in power management.<br>
That year also saw the birth of our brand <b>“Subtech”</b>, which became the hallmark of our products, symbolizing our unwavering commitment to <b>quality, trust, and innovation.</b></p>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Timeline Container -->
				
				
            </div>

            <!-- 3. PRE 1999 Content (Placeholder) 
            <div class="tab-pane fade" id="tab-pre1999" role="tabpanel" aria-labelledby="tab-pre1999-tab">
                <p class="text-center py-5 text-secondary">
                    **Timeline content for PRE 1999 will go here.**
                    <br>Use the same `<div class="timeline">...</div>` structure from the "2016 & Beyond" tab.
                </p>
            </div>
        </div> <!-- End Tab Content -->

      
    </div>

		   
		   
		   
        </section>
		
		
		
		
					
<section class="flat-spacing-8" style="    background: #e40006;">





            <div class="container">
                <div class="flat-title style-between align-items-end wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="box-title">
                         <h2 class="display-6 fw-bold mb-3 text-white">Awards and Certifications</h2>
                         
                         
                       
						  <h6 class="title" style="color:#fff">Celebrating Excellence, Honoring Achievements</h6>
                        <p class="desc  text-white">Subtech is respected for product quality and consistency. The Company is certified for ISO 9001 and ISO 14001, validating its commitment to quality management and environmentally responsible practices. </p>
                    </div>
                   
                </div>
				
				
				
				
		<div class="row g-4">
            <!-- Awards-->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 product-card rounded-3 overflow-hidden d-flex flex-column">
                    <!-- Product Image Area -->
                    <div class="bg-light p-4 d-flex justify-content-center align-items-center img-container">
                        <img 
                 src="<?= BASE_PATH ?>certificates/ISO 9001_page-0001.jpg" alt="ISO 9001"></img>
                       
                    </div>
                    <!-- Content Area -->
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title h5 fw-semibold text-dark text-center">ISO 9001</h3>
                       </div>
                </div>
            </div>
			
        	
        	    <!-- Awards-->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 product-card rounded-3 overflow-hidden d-flex flex-column">
                    <!-- Product Image Area -->
                    <div class="bg-light p-4 d-flex justify-content-center align-items-center img-container">
                        <img 
                 src="<?= BASE_PATH ?>certificates/ISO 14001_page-0001.jpg" alt="ISO 14001"></img>
                       
                    </div>
                    <!-- Content Area -->
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title h5 fw-semibold text-dark text-center">ISO 14001</h3>
                       </div>
                </div>
            </div>
            
            
            
                <!-- Awards-->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 product-card rounded-3 overflow-hidden d-flex flex-column">
                    <!-- Product Image Area -->
                    <div class="bg-light p-4 d-flex justify-content-center align-items-center img-container">
                        <img 
                 src="<?= BASE_PATH ?>certificates/ISO 45001_page-0001.jpg" alt="ISO 45001"></img>
                       
                    </div>
                    <!-- Content Area -->
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title h5 fw-semibold text-dark text-center">ISO 45001</h3>
                       </div>
                </div>
            </div>
            
            
                <!-- Awards-->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 product-card rounded-3 overflow-hidden d-flex flex-column">
                    <!-- Product Image Area -->
                    <div class="bg-light p-4 d-flex justify-content-center align-items-center img-container">
                        <img 
                 src="<?= BASE_PATH ?>certificates/ISO 50001_page-0001.jpg" alt="ISO 50001"></img>
                       
                    </div>
                    <!-- Content Area -->
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title h5 fw-semibold text-dark text-center">ISO 50001</h3>
                       </div>
                </div>
            </div>
            
            
                <!-- Awards-->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 product-card rounded-3 overflow-hidden d-flex flex-column">
                    <!-- Product Image Area -->
                    <div class="bg-light p-4 d-flex justify-content-center align-items-center img-container">
                        <img 
                 src="<?= BASE_PATH ?>certificates/Zed Silver (1)_page-0001.jpg" alt="Zed Silver"></img>
                       
                    </div>
                    <!-- Content Area -->
                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title h5 fw-semibold text-dark text-center">Zed Silver</h3>
                       </div>
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
   
   
   
   
   
   
   
   
   
   
   




   
   
</body>


</html>