

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <!-- font -->
   
   
   <style>
   
   /* --- Header CSS --- */
        /* --- Desktop Mega Menu Styles (Lg breakpoint and up) --- */
        /* Make the dropdown menu full width and remove default padding */
        .mega-menu {
            position: static !important;
        }
        .mega-menu .dropdown-menu {
            width: 100%;
            border: none;
            border-radius: 0;
            margin-top: 0;
            padding: 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
			
			height: calc(100vh - 56px); /* Assuming default Bootstrap 5 navbar height is 56px */
			overflow-y: auto;
	
	
        }

        .mega-menu .dropdown-menu .row {
			height: 100%;
			/* The Bootstrap .row is already display: flex, but height is key here */
		}
		
		/* Styling for the columns/sections */
        .menu-column {
            height: 100%; 
			min-height: auto; /* Resetting the original rule */
            padding: 1.5rem 1rem;
            border-right: 1px solid #eee;
        }
        
        /* Specific column background colors */
        .col-1 { background-color: #f7f7f7; }
        .col-2 { background-color: #fcfcfc; }
        .col-3 { background-color: #fcfcfc; }
        .col-4 { background-color: #e9ecef; border-right: none; }

        /* Style for interactive list items (Desktop) */
        .menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-item {
            cursor: pointer;
            padding: 0.5rem 0.75rem;
            margin: 0.25rem 0;
            font-size: 0.95rem;
            color: #495057;
            position: relative;
            transition: all 0.2s ease;
        }

        /* Dot icon */
        .menu-item::before {
            
            color: #dc3545; /* Red dot color */
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
            visibility: hidden;
        }
        
        /* Hover and Active states */
        .menu-item:hover {
            background-color: #e9ecef;
            color: #212529;
        }

        .menu-item.active {
            background-color: #f8d7da; /* Light red/pink background for active item in C1/C2 */
            font-weight: 600;
            color: #dc3545; /* Red text */
        }

        .menu-item.active::before {
            visibility: visible;
        }

        /* Style for the header/title of each column */
        .menu-column h6 {
            font-weight: 700;
            color: #343a40;
            margin-bottom: 1rem;
            border-bottom: 2px solid #dc3545; /* Red underline */
            display: inline-block;
            padding-bottom: 0.25rem;
        }

        /* Style for the CTA button column */
        .col-4 h5 {
            border-bottom: none;
        }
        .cta-box {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            text-align: center;
            margin-top: 3rem;
        }

        /* --- Mobile Menu Styles (Less than Lg breakpoint) --- */
        
        /* Styling for links inside the Offcanvas */
        .offcanvas-body .nav-link {
            font-size: 1.1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
            /* Flex layout to align text and icon */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        /* Ensure non-dropdown links don't have the space-between effect */
        .offcanvas-body .nav-link:not([data-bs-toggle="collapse"]) {
            display: block;
        }


        /* Mobile product list styling */
        .mobile-product-item {
            cursor: pointer;
            padding: 0.5rem 1rem;
            font-weight: 600;
            color: #212529;
            border-bottom: 1px solid #eee;
        }
        
        .mobile-subcategory-list {
            list-style: none;
            padding: 0;
            background-color: #f8f9fa; /* Light grey background for nested items */
            border-top: 1px solid #eee;
        }

        .mobile-subcategory-list .menu-item {
            padding-left: 2rem; /* Indent subcategory items */
            font-weight: normal;
        }

        .mobile-nested-list {
            list-style: none;
            padding-left: 1.5rem; /* Indent for nested items like Company's sub-links */
            margin-bottom: 0;
            background-color: #f8f9fa;
        }
        .mobile-nested-list .dropdown-item {
            padding: 0.5rem 1rem;
            color: #495057;
            font-size: 0.95rem; /* Smaller font for sub-items */
        }
        .mobile-nested-list .dropdown-item:hover {
            background-color: #e9ecef;
        }

    </style>
    
    


<style>
.ss_care_inner {
	padding: 0 85px 60px;
	position: relative
}
.ss_care_inner:after {
	content: "";
	background: #f7f7f7;
	border-radius: 32px;
	position: absolute;
	bottom: 0;
	top: 115px;
	left: 0;
	right: 0;
	z-index: -1
}
.subtech_care_left {
	background: #ef2e33;
	border-radius: 32px;
	padding: 0 60px;
	color: #fff;
	width: 658px;
	max-width: 100%
}
.comp_care_list {
	list-style: none;
	padding: 0;
	margin: 0
}
.comp_care_list li {
	padding: 56px 10px 56px 110px;
	position: relative;
	min-height: 150px;
	display: flex;
	justify-content: center;
	flex-direction: column;
	border-bottom: 1px solid #f99fa2;
	font-size: 18px;
	font-weight: 600;
	line-height: 32px;
	text-transform: capitalize;
}
.comp_care_list li:last-child {
	border-bottom: 0
}
.comp_care_list li figure {
	width: 74px;
	height: 74px;
	position: absolute;
	left: 0;
	top: 50%;
	line-height: 74px;
	transform: translateY(-50%)
}
.comp_care_list li figure img {
	max-height: 60px
}
.form_box {
	background: #fff;
	border-radius: 32px;
	padding: 40px;
	margin-top: 15px;
}
.subtech_care_right {
	padding-left: 0px;
	padding-top: 50px
}
.crompton_care_sec .head_1 {
	margin-bottom: 60px
}
.form_box .btn_cmn {
	min-width: 250px
}
.form_box>h4 {
	font-size: 24px;
	margin-bottom: 5px
}
.form_box>p {
	font-size: 16px;
	margin-bottom: 25px
}
.form_box .form-control {
	height: 53px;
	border-width: 0 0 1px 0;
	border-color: #d2d2d2 !important;
	border-radius: 0;
	padding: 15px 15px 15px 0;
	box-shadow: none !important;
	font-size: 14px
}
.form_box .input-group-text {
	width: 33px;
	text-align: left;
	padding: 0;
	background: transparent;
	border-width: 0 0 1px 0;
	border-radius: 0
}
.form_box .input-group {
	margin-bottom: 25px
}
.get_touch_form_btn .btn_cmn {
	margin-top: 10px
}
.ss_care_linklist {
	background: #fff;
	border-radius: 32px;
	padding: 25px;
	margin-top: 50px
}
.ss_care_linklist ul {
	list-style: none;
	padding: 0;
	margin: 0;
	text-align: center
}
.ss_care_linklist ul li {
	border-left: 1px solid #d2d2d2;
	padding: 0 70px 0 9px;
	display: inline-block;
	vertical-align: middle
}
.ss_care_linklist ul li:first-child {
	border-left: 0
}
.icon_left {
	display: inline-block;
	width: 80px;
	height: 80px;
	background: #fff;
	border: 3px solid #fafafa;
	border-radius: 50%;
	margin-right: 16px;
	line-height: 74px;
	box-shadow: inset 8px 8px 8px #0000001a, 4px 8px 8px #0000001a;
	padding-top: 20px;
}
.ss_care_linklist ul li a {
	font-size: 18px;
	color: #ef2e33;
	font-weight: 500;
    text-transform: capitalize;
}

.ss_care_linklist ul li a:hover {
	
	color: #000;
	
}
.ss_care_linklist ul li a svg,
.ss_care_linklist ul li a i {
	font-size: 19px;
	margin-left: 6px
}
.comp_care_list li br {
	display: none
}



@media only screen and (max-width: 767px) {
   
   
   
	.ss_care_inner {
		padding: 0;
		background: #f1f1f1
	}
	.subtech_care_left {
		border-radius: 0;
		width: 100%
	}
	.ss_care_linklist {
		background: transparent;
		padding: 40px 20px;
		border-radius: 0;
		margin: 0
	}
	.ss_care_inner>.row {
		margin: 0
	}
	.ss_care_inner>.row>.col-md-6 {
		padding: 0
	}
	.ss_care_inner:after {
		display: none
	}
	.crompton_care_sec .head_1 {
		margin-bottom: 15px
	}
	.comp_care_list li figure img {
		-webkit-filter: brightness(100);
		filter: brightness(100)
	}
	.comp_care_list li {
		padding: 27px;
		border: 0;
		text-align: center
	}
	.comp_care_list li figure {
		position: inherit;
		transform: translate(0);
		margin: 0 auto 10px
	}
	.comp_care_list li {
		font-size: 12px;
		font-weight: 500;
		line-height: 16px;
		display: inline-block;
		width: 24%;
		vertical-align: top;
		position: relative;
		padding: 5px
	}
	.comp_care_list {
		width: 400px;
		max-width: 100%;
		margin: 0 auto
	}
	.subtech_care_left {
		padding: 15px 0;
		text-align: center
	}
	.comp_care_list li br {
		display: block;
		line-height: 0
	}
	.comp_care_list li:not(:first-child):before {
		content: "";
		width: 1px;
		top: 50%;
		height: 95px;
		background: #fff;
		position: absolute;
		left: 0;
		transform: translateY(-50%);
		opacity: .5
	}
	.ss_care_linklist ul li {
		padding: 0;
		display: block;
		border: 0;
		background: #fff;
		border-radius: 10px;
		text-align: left
	}
	.ss_care_linklist ul li+li {
		margin-top: 17px
	}
	.icon_left {
		text-align: center;
		margin-right: 10px
	}
	.ss_care_linklist ul li a {
		font-size: 16px;
		position: relative;
		display: block;
		padding: 20px 15px
	}
	.ss_care_linklist ul li a svg,
	.ss_care_linklist ul li a i {
		font-size: 18px;
		position: absolute;
		right: 36px;
		top: 50%;
		transform: translateY(-50%)
	}
	
}




</style>

    <!--<link rel="stylesheet" href="<?=BASE_PATH?>fonts/fonts.css">-->
   <!-- <link rel="stylesheet" href="<?=BASE_PATH?>fonts/font-icons.css">
     css -->
    <!--<link rel="preload" href="<?=BASE_PATH?>css/swiper-bundle.min.css" as="style" onload="this.rel='stylesheet'">-->
    <link rel="stylesheet" href="<?=BASE_PATH?>css/swiper-bundle.min.css">
    <!--<link rel="preload" href="<?=BASE_PATH?>css/bootstrap.min.css" as="style" onload="this.rel='stylesheet'">
<link rel="preload" href="<?=BASE_PATH?>css/bootstrap-select.min.css" as="style" onload="this.rel='stylesheet'">-->

<link rel="preload" href="<?=BASE_PATH?>fonts/font-icons.css" as="style" onload="this.rel='stylesheet'">


  <link rel="stylesheet" href="<?=BASE_PATH?>css/bootstrap.min.css">
    
    <link rel="stylesheet" href="<?=BASE_PATH?>css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?=BASE_PATH?>css/styles.css">
<!--<link rel="preload" href="<?=BASE_PATH?>css/styles.css" as="style"
      onload="this.onload=null;this.rel='stylesheet'">
<noscript>
<link rel="stylesheet" href="<?=BASE_PATH?>css/styles.css">
</noscript>-->

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="<?=BASE_PATH?>images/logo/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="<?=BASE_PATH?>images/logo/favicon.png">
    
    <meta name="google-site-verification" content="qpCnFeQMZFmQMgeon4-uGnhFcT0kVtShsejqBOIRYBo"/>



<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "S S Power System",
  "alternateName": "Subtech",
  "url": "https://subtech.in/",
  "logo": "https://subtech.in/images/logo.png",
  "contactPoint": [{
    "@type": "ContactPoint",
    "telephone": "8506060581",
    "contactType": "technical support",
    "contactOption": "HearingImpairedSupported",
    "areaServed": "IN",
    "availableLanguage": "en"
  },{
    "@type": "ContactPoint",
    "telephone": "8506060580",
    "contactType": "sales",
    "contactOption": "HearingImpairedSupported",
    "areaServed": "IN",
    "availableLanguage": "en"
  }],
  "sameAs": [
    "https://www.facebook.com/subtech.in",
    "https://www.instagram.com/subtech.in",
    "https://www.youtube.com/@subtech.e",
    "https://linkedin.com/company/subtech-in",
    "https://x.com/Subteche"
  ]
}
</script>


 <style>
		
		
		  .btn-care {
            background-color:#e40006; /* Equivalent to blue-600 */
            border: none;
            color: white;
            padding: 0.5rem 0.9rem;
            border-radius: 9999px; /* Equivalent to rounded-full */
            font-weight: 600; /* Equivalent to font-semibold */
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .btn-care:hover {
            background-color: #cbcdcf; /* Equivalent to blue-700 */
            transform: scale(1.05);
			color:#fff;
        }
        </style>