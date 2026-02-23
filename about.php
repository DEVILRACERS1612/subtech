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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <title>Subtech - Electrical Automation | LT Panels, AMF ATS & Control Panel Manufacturer India</title>

    <meta name="title"
        content="Subtech - Electrical Automation | LT Panels, AMF ATS & Control Panel Manufacturer India">
    <meta name="description"
        content="Subtech is a leading Indian manufacturer of LT panels, AMF/ATS systems, motor starters, and industrial control panels, delivering reliable and future-ready automation solutions across India.">
    <link rel="canonical" href="https://subtech.in/about">
    <?php include_once "config/head.php"; ?>

    <style>
        :root {
            --st-red: #e40006;
            --st-bg: #f3f4f6;
        }

        * {
            font-family: "DM Sans", sans-serif !important;
        }

        /* ── HERO ── */
        .st-hero {
            background: #fff;
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .06);
        }

        .st-eyebrow {
            color: var(--st-red);
            font-weight: 600;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .st-eyebrow:before {
            content: "";
            width: 18px;
            height: 2px;
            background: var(--st-red);
            border-radius: 99px;
            display: inline-block;
        }

        .st-hero h1 {
            font-size: 35px;
            line-height: 1.05;
            margin: 12px 0 14px;
            font-weight: 600;
            letter-spacing: -.02em;
        }

        .st-hero h1 .em {
            color: var(--st-red);
            font-style: italic;
        }

        .st-hero p {
            color: #4b5563;
            margin: 0 0 18px;
            max-width: 520px;
            line-height: 1.8;
        }

        /* ── BUTTONS ── */
        .st-btn {
            border-radius: 10px;
            padding: 10px 16px;
            font-weight: 600;
        }

        .st-btn-primary {
            background: var(--st-red);
            border: 1px solid var(--st-red);
            color: #fff;
        }

        .st-btn-primary:hover {
            filter: brightness(.95);
            color: #fff;
        }

        .st-btn-outline {
            background: #fff;
            border: 1px solid #e5e7eb;
            color: #111827;
        }

        .st-btn-outline:hover {
            background: #f9fafb;
        }

        /* ── IMAGE CARD ── */
        .st-imgcard {
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        .st-imgcard img {
            width: 100%;
            height: auto;
            max-height: 420px;
            display: block;
        }

        .st-imgcap {
            position: absolute;
            left: 14px;
            bottom: 14px;
            background: rgba(0, 0, 0, .55);
            color: #fff;
            padding: 10px 12px;
            border-radius: 12px;
            font-size: 12px;
            backdrop-filter: blur(6px);
        }

        .st-imgcap b {
            display: block;
            font-size: 13px;
        }

        /* ── MISSION / VISION CARDS ── */
        .st-section-bg {
            padding: 24px 0 10px;
        }

        .st-card {
            position: relative;
            overflow: hidden;
            background: #F3F4F6;
            border: 1px solid #eceff3;
            border-radius: 16px;
            padding: 18px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            height: 100%;
            margin-top: 20px;
            margin-bottom: 20px;
            transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease;
        }

        .st-card::before {
            content: "";
            position: absolute;
            left: 0;
            top: 14px;
            bottom: 14px;
            width: 3px;
            background: var(--st-red);
            border-radius: 99px;
            opacity: 0;
            transform: translateX(-6px);
            transition: opacity .15s ease, transform .15s ease;
        }

        .st-card:hover {
            border-color: rgba(228, 0, 6, .35);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
            transform: translateY(-2px);
        }

        .st-card:hover::before {
            opacity: 1;
            transform: translateX(0);
        }

        .st-card.is-active {
            border-color: rgba(228, 0, 6, .35);
        }

        .st-card.is-active::before {
            opacity: 1;
            transform: translateX(0);
        }

        .st-card .ico {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(228, 0, 6, .08);
            color: var(--st-red);
            font-size: 18px;
            margin-bottom: 10px;
        }

        .st-card h4 {
            margin: 0 0 8px;
            font-weight: 800;
            font-size: 18px;
        }

        .st-card p {
            margin: 0;
            color: #4b5563;
            line-height: 1.65;
            font-size: 14px;
        }

        .st-card .headrow {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .st-card .headrow .ico {
            margin: 0;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(228, 0, 6, .08);
            color: var(--st-red);
            font-size: 18px;
        }

        .st-card .headrow h4 {
            margin: 0;
            font-weight: 800;
            font-size: 18px;
        }

        /* ── WHY CHOOSE US ── */
        .st-why {
            margin-top: 50px;
            padding: 50px 0;
        }

        .st-why h2 {
            font-weight: 800;
            margin: 50px;
        }

        .st-feature {
            background: #fff;
            border: 1px solid #eceff3;
            border-radius: 16px;
            padding: 18px;
            height: 100%;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
            text-align: center;
        }

        .st-feature .f-ico {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(228, 0, 6, .08);
            color: var(--st-red);
            margin: 0 auto 12px;
            font-size: 22px;
        }

        .st-feature h5 {
            margin: 0 0 8px;
            font-weight: 800;
            color: var(--st-red);
        }

        .st-feature p {
            margin: 0;
            color: #4b5563;
            font-size: 14px;
            line-height: 1.65;
        }

        /* ── AWARDS SLIDER ── */
        .awards-fade-mask {
            position: relative;
            overflow: hidden;
            background: transparent;
            padding: 50px 0;
        }

        .awards-fade-mask::before {
            left: 0;
            background: linear-gradient(90deg, #fff 0%, transparent 100%);
        }

        .awards-fade-mask::after {
            right: 0;
            background: linear-gradient(270deg, #fff 0%, transparent 100%);
        }

        .awards-fade-mask::before {
            left: 0;
            background: linear-gradient(90deg, transparent 100%);
        }

        .awards-fade-mask::after {
            right: 0;
            background: linear-gradient(270deg, transparent 100%);
        }

        .awards-swiper {
            padding: 12px 6px 44px;
            overflow: visible !important;
            padding: 12px 6px 70px;
        }

        .awards-swiper .swiper-wrapper {
            transition-timing-function: ease-in-out !important;
        }

        /* ── SLIDE STATES (single clean definition) ── */
        .awards-swiper .swiper-slide {
            height: auto;
            transition: transform 0.9s cubic-bezier(0.25, 0.1, 0.25, 1),
                filter 0.9s cubic-bezier(0.25, 0.1, 0.25, 1),
                opacity 0.9s cubic-bezier(0.25, 0.1, 0.25, 1);
            transform: scale(0.78);
            filter: blur(3px) brightness(0.6);
            opacity: 0.6;
        }

        .awards-swiper .swiper-slide-prev,
        .awards-swiper .swiper-slide-next {
            transform: scale(0.88);
            filter: blur(1.5px) brightness(0.75);
            opacity: 0.75;
        }

        .awards-swiper .swiper-slide-active {
            transform: scale(1.25);
            /* was 1.12 */
            filter: blur(0) brightness(1);
            opacity: 1;
        }

        /* ── AWARD CARD ── */
        .award-card {
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
            border-radius: 16px;
            overflow: hidden;
        }

        .award-img {
            height: 380px;
            /* was 320px */
            /* remove padding so image fills more space */
            background: transparent !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .award-img img {

            height: 100%;
            /* object-fit: fill; */
            /* display: block; */
        }

        .award-title {
            padding: 14px 14px 16px;
            text-align: center;
            font-weight: 700;
            color: #111827;
        }

        /* ── SWIPER CONTROLS ── */
        .awards-swiper .swiper-button-prev,
        .awards-swiper .swiper-button-next {
            color: red;
            width: 42px;
            height: 42px;
            border-radius: 999px;
            backdrop-filter: blur(6px);
        }

        .awards-swiper .swiper-button-prev:after,
        .awards-swiper .swiper-button-next:after {
            font-size: 16px;
            font-weight: 800;
        }

        .awards-swiper .swiper-pagination-bullet {
            background: rgba(0, 0, 0, .25);
            opacity: 1;
            /* increase last value — was 44px */
        }

        .awards-swiper .swiper-pagination-bullet-active {
            background: var(--st-red);
        }

        /* ── TABS ── */
        .nav-tabs .nav-link {
            border: none;
            border-radius: 0;
            padding-left: .5rem;
            padding-right: .5rem;
            transition: color .15s ease-in-out, border-color .15s ease-in-out;
            color: var(--bs-secondary);
        }

        .nav-tabs .nav-link.active {
            color: var(--bs-dark) !important;
            font-weight: 600 !important;
            border-bottom: 3px solid var(--bs-primary) !important;
            background-color: transparent !important;
        }

        .nav-tabs .nav-link:hover {
            border-color: transparent !important;
            color: var(--bs-dark);
        }

        /* ── TIMELINE ── */
        .timeline {
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 2px;
            background: #e9ecef;
            margin-left: -1px;
            z-index: 0;
        }

        .timeline-item {
            padding-bottom: 70px;
            padding-top: 20px;
            position: relative;
        }

        .timeline-dot {
            position: absolute;
            top: 40px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #e40006;
            z-index: 10;
            color: #fff;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 0 0 4px rgba(175, 9, 9, .95), 0 0 22px 10px rgba(228, 0, 6, .35);
        }

        @media (min-width:768px) {
            .timeline-content-left {
                text-align: right;
                padding-right: 70px;
            }

            .timeline-content-right {
                text-align: left;
                padding-left: 70px;
            }
        }

        @media (max-width:767.98px) {
            .timeline::before {
                left: 30px;
            }

            .timeline-dot {
                left: 30px;
                top: 40px;
            }

            .timeline-content-left,
            .timeline-content-right {
                padding-left: 80px !important;
                padding-right: 0 !important;
                text-align: left !important;
                margin-top: 10px;
            }

            .timeline-item {
                padding-bottom: 40px;
                padding-top: 0;
            }

            .order-md-1 {
                order: 2;
            }

            .order-md-2 {
                order: 1;
            }
        }

        .mission-card {
            background: #fff;
            border-radius: 12px;
            padding: 16px;
            height: 100%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .mission-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .mission-card-title {
            font-weight: 800;
            margin: 8px 0 4px;
            font-size: 13px;
            color: #111827;
        }

        .mission-card-text {
            font-size: 12px;
            color: #4b5563;
            margin: 0;
            line-height: 1.6;
        }

        .vision-hero-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            height: 590px;
            /* fixed height instead of 100% */
            width: 100%;
        }

        .vision-bg-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            display: block;
        }

        .vision-overlay {
            position: absolute;
             bottom: 20px;
            left: 0;
            right: 0;
            /* top: 0; */
            /* stretch to full height */
            /* padding: 28px; */
            display: flex;
            flex-direction: column;
            /* justify-content: center; */
            /* vertical center */
            align-items: flex-start;
            /* text-align: center; */
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.3) 100%);
        }

        .vision-title {
            color: #fff;
            font-weight: 800;
            font-size: 22px;
            margin-bottom: 12px;
            text-align: center;
            width: 100%;
        }

        .vision-text {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
            text-align: center;
        }


        .vision-text strong {
            color: #fff;
            font-weight: 700;
        }

        /* ── LOGO CONTAINERS ── */
        .logo-placeholder {
            max-width: 150px;
            height: auto;
            margin-bottom: 0;
        }

        .logo-container-left {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .logo-container-right {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        @media (max-width:767.98px) {

            .logo-container-left,
            .logo-container-right {
                justify-content: flex-start !important;
                margin-bottom: 15px;
            }
        }

        @media (max-width:991px) {
            .st-hero h1 {
                font-size: 36px;
            }

            .st-imgcard img {
                height: 280px;
            }
        }
        @media (max-width: 575.98px) {
    .mission-card-text {
        font-size: 11px;
        
    }
    
   .mission-card-title {
    font-weight: 800;
    margin: 8px 0 4px;
    font-size: 13px;
    color: #111827;
    white-space: nowrap;
}

@media (max-width: 575.98px) {
    .mission-card-title {
        font-size: 11px;
        line-height: 1.3;
    }
}
    
    .mission-card div[style*="font-size:2rem"] {
        font-size: 1.4rem !important;
    }
    
    .mission-card div[style*="gap:10px"] {
        gap: 6px !important;
    }
    
    .mission-card {
        padding: 12px;
    }
}
    </style>
</head>

<body>

    <?php include_once "config/header-top.php"; ?>



    <?php include_once "config/header.php"; ?>

    <section class="flat-spacing-8" style="padding-bottom:0;">
        <div class="container">

            <!-- HERO (like screenshot) -->
            <div class="st-hero">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <div class="st-eyebrow">A Legacy of Innovation and Quality</div>

                        <h1>
                            Redefining <span>Industrial</span><br>
                            Automation
                        </h1>

                        <p>
                            Subtech is a leading Indian manufacturer and solution provider in the field of
                            electrical automation, specializing in LT panels, AMF/ATS systems, motor starters, and
                            industrial control panels.
                            With a deep-rooted commitment to innovation, safety, and performance, we serve a diverse
                            clientele across residential, commercial, agricultural, and industrial sectors.
                            With a presence across India and trust of over 200 businesses, Subtech is recognized for
                            delivering reliable, efficient, and customized solutions that simplify motor control and
                            power management.
                            Our product portfolio includes DOL and Star-Delta starters, single-phase and three-phase
                            control panels, and advanced automation systems designed to meet modern energy needs.
                            At Subtech, we combine decades of practical experience with a forward-thinking approach.
                            Our in-house R&D and quality control practices ensure that every product is built for
                            durability, safety, and long-term performance.
                            We are continuously evolving by integrating IoT, smart monitoring, and digital
                            technologies into our solutions making our systems future-ready.
                        </p>

                        <div class="d-flex gap-2 flex-wrap">
                            <a href="<?= BASE_PATH ?>contact" class="st-btn st-btn-primary">Our Story</a>
                            <a href="#visionMission" class="st-btn st-btn-outline">Vision &amp; Mission</a>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="st-imgcard" style="display:contain">
                            <img src="<?= BASE_PATH ?>images/subtech.png" alt="Subtech Innovation Hub">

                        </div>
                    </div>
                </div>
            </div>
            <div class="" style="margin-bottom: 100px; margin-top: 100px;">
                <div class="headrow" style="display:flex">
                    <!-- <div class="ico"><i class="bi bi-rocket-takeoff"></i></div> -->
                    <h4 style="margin-left: 9px; font-size: 700; font-weight: 600;">Our Mission</h4>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-6">
                        <div class="mission-card">
                            <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px;">
                                <div style="font-size:2rem;">🚀</div>
                                <h6 class="mission-card-title" style="margin:0;">High-Reliability Manufacturing</h6>
                            </div>
                            <p class="mission-card-text">To design and manufacture <strong>high-reliability control
                                    panels</strong> that reduce downtime, prevent motor burning and optimise energy and
                                water usage.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mission-card">
                            <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px;">
                                <div style="font-size:2rem;">🔒</div>
                                <h6 class="mission-card-title">Smart Technology Innovation</h6>
                            </div>
                            <p class="mission-card-text">To continuously innovate using <strong>microcontroller-based
                                    protection, RF/4G/5G/IoT connectivity</strong> and advanced contactor concepts such
                                as PMC.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mission-card">
                            <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px;">
                                <div style="font-size:2rem;">🤝</div>
                                <h6 class="mission-card-title">Pan-India Channel Network</h6>
                            </div>
                            <p class="mission-card-text">To build a strong <strong>network of dealers, contractors and
                                    service partners</strong> across India who share our customer-first values.</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mission-card">
                            <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px;">
                                <div style="font-size:2rem;">⭐</div>
                                <h6 class="mission-card-title">Government & Infrastructure Support</h6>
                            </div>
                            <p class="mission-card-text">To support government projects with <strong>robust,
                                    field-proven automation solutions</strong> that contribute to water and power
                                conservation.</p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Mission/Vision cards (under hero like screenshot) -->
            <div id="visionMission" class="st-section-bg mt-4 mb-15" style="margin-bottom: 50px;">
                <div class="row g-3">
                    <div class="col-lg-6">


                    </div>

                    <div class="vision-hero-card">
                        <img src="<?= BASE_PATH ?>images/brand/vision-city.png" alt="Vision" class="vision-bg-img">
                        <div class="vision-overlay">
                            <h4 class="vision-title">✦ Subtech's Vision</h4>
                            <p class="vision-text">To become <strong>India's most trusted brand in motor, power & water
                                    automation</strong>, delivering smart, reliable & energy-efficient solutions that
                                improve everyday life for people, businesses, & government organisations.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Why Choose Us (same clean UI) -->
            <div class="st-why mt-4 mb-5">
                <div class="text-center mb-3">
                    <h2 class="display-6 mb-2">Why Choose Us?</h2>
                    <p class="text-muted mb-0">
                        Reliable engineering, smart automation, and long-term support—built for real-world
                        performance.
                    </p>
                </div>

                <div class="row g-3">
                    <div class="col-lg-4">
                        <div class="st-feature">
                            <div class="f-ico"><i class="bi bi-shield-check"></i></div>
                            <h5>High Durability Products</h5>
                            <p>
                                Designed for tough industrial conditions using premium materials and rigorous
                                testing for long-lasting performance.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="st-feature">
                            <div class="f-ico" style="item-align:center;"><i class="bi bi-people"></i></div>
                            <h5>Trusted by Businesses</h5>
                            <p>
                                From OEMs to infrastructure developers and PSUs—our customer-first approach builds
                                long-term trust nationwide.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="st-feature">
                            <div class="f-ico"><i class="bi bi-headset"></i></div>
                            <h5>Robust After-Sales Support</h5>
                            <p>
                                Prompt support from installation guidance to troubleshooting and warranty
                                assistance—after purchase too.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!--			 		
<section class="container-fluid py-5 d-flex justify-content-center align-items-center min-vh-100 flat-spacing-8" style="background-image: url(./images/vision_back.jpg); background-size: cover; background-position: center center; background-repeat: no-repeat;">-->








    <!-- START OF BOOTSTRAP 5 SECTION -->

    <!-- END OF BOOTSTRAP 5 SECTION -->




    <section class="bg-surface">


        <div class="container py-5">
            <h2 class="display-6 fw-bold mb-3 text-danger">Our Journey</h2>

            <p>At Subtech (S S Power System), our journey is one of innovation, dedication, and continuous growth.
                From
                humble beginnings to global recognition, we have consistently evolved to deliver cutting-edge power
                automation and electrical control solutions that empower industries and simplify lives.</p>



            <!-- Header/Filter Tabs (Bootstrap Tabs Structure) -->
            <ul class="nav nav-tabs border-bottom-0 mb-4 pt-3" id="timelineTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link px-3 pb-2 fs-6 active" id="tab-2016-tab" data-bs-toggle="tab"
                        data-bs-target="#tab-2016" type="button" role="tab" aria-controls="tab-2016"
                        aria-selected="true">2016 & Beyond</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link px-3 pb-2 fs-6" id="tab-2015-tab" data-bs-toggle="tab"
                        data-bs-target="#tab-2015" type="button" role="tab" aria-controls="tab-2015"
                        aria-selected="false">2015-2003</button>
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

                                    <h6 class="fw-bold text-dark mt-0">Today – Innovating for a Smarter Tomorrow
                                    </h6>
                                    <p class="text-dark mb-0">From our early days of innovation to our expanding
                                        global
                                        presence, <b>Subtech</b> stands as a symbol of trust, technology, and
                                        transformation.<br>
                                        Our focus remains on creating sustainable, efficient, and intelligent
                                        automation
                                        solutions that empower industries, improve energy efficiency, and shape a
                                        more
                                        reliable future.</p>


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
                                    <h4 class="fw-bold text-dark fs-6 mt-0">2018- A Year of Growth and
                                        Diversification
                                    </h4>
                                    <p class="text-dark mb-0">We further expanded our reach across government,
                                        corporate, and institutional sectors:<br>

                                        • <b>Aligarh Muslim University</b> – Offered customized control solutions to
                                        support their day-to-day operations.<br>
                                        • <b>Siddhartha Cooperative Group Housing Society</b> – Provided
                                        energy-efficient automation solutions tailored to their requirements.<br>
                                        • <b>Kinobeo Softwares Pvt. Ltd.</b> – Installed electrical distribution
                                        systems
                                        for efficient power control and monitoring.<br>
                                        • <b>Supertech </b>– Delivered tailored automation solutions to streamline
                                        operations.<br>
                                        • <b>Jaiprakash Associates Ltd.</b> – Partnered to create efficient water
                                        management workflows through automation.<br>
                                        • <b>GAIL (India) Ltd.</b> – Extended collaboration with new automation
                                        systems
                                        for enhanced performance.<br>
                                        This year highlighted our growth as a nationwide automation partner, trusted
                                        by
                                        both private and public sector enterprises.<br></p>

                                </div>
                            </div>
                        </div>

                        <!-- Item 2: Content Left, Logo Right -->
                        <div class="timeline-item">
                            <div class="row align-items-center">
                                <div class="col-md-6 timeline-content-left order-md-1 order-2">
                                    <h4 class="fw-bold text-dark fs-6 mt-0">2017- Expanding Into Public
                                        Infrastructure
                                    </h4>
                                    <p class="text-dark mb-0">We extended our expertise into <b>public utilities and
                                            infrastructure:</b><br>
                                        • <b>DMRC (Delhi Metro Rail Corporation)</b> – Delivered automation systems
                                        that
                                        enhanced operational efficiency.</p>
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
                                    <h4 class="fw-bold text-dark fs-6 mt-0">2016 – Strengthening Industrial
                                        Collaboration</h4>
                                    <p class="text-dark mb-0">Our expertise expanded across major industrial and
                                        construction sectors:<br>
                                        • <b>Ansal Housing & Construction Ltd.</b> – Supplied advanced electrical
                                        systems to enhance centralized control.<br>
                                        • <b>GAIL (India) Ltd.</b> – Implemented tailored automation systems that
                                        increased reliability and safety.<br>
                                        Through these partnerships, we continued to demonstrate excellence in
                                        <b>industrial automation and intelligent engineering.</b>
                                    </p>
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
                                    <p class="text-dark mb-0">Our work gained the trust of several leading
                                        corporations
                                        and institutions across India:<br>
                                        • <b>Gulshan Homes Pvt. Ltd.</b> – Delivered efficient automation solutions
                                        for
                                        their infrastructure needs.<br>
                                        • <b>NTPC</b> – Provided tailored control systems to optimize their
                                        operations.<br>
                                        • <b>Homes 121 Apartment Association</b> – Implemented customized automation
                                        to
                                        streamline daily utilities.<br>
                                        • <b>Delhi Public School</b> – Offered solutions crafted to meet their
                                        institutional requirements.<br>
                                        • <b>Punjab National Bank</b> – Provided automation systems ensuring
                                        consistent
                                        operational performance.</p>
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
                                    <p class="text-dark mb-0">We developed our specialized <b>“PMC” technology</b>
                                        for
                                        <b>precise and ideal switching</b>, ensuring accuracy and reliability in
                                        automated systems.<br>
                                        This year also marked the establishment of our <b>state-of-the-art
                                            manufacturing
                                            plant in Greater Noida</b>, boosting our production capacity and
                                        enabling us
                                        to serve clients with higher efficiency and quality control.
                                    </p>

                                    <h4 class="fw-bold text-dark fs-6 mt-0">Embracing Smart Protection</h4>
                                    <p class="text-dark mb-0">We introduced <b>Motor Protection Units (MPUs)</b> in
                                        our
                                        motor starters an innovation driven by <b>digital microcontroller technology
                                        </b>— ensuring enhanced safety, reliability, and intelligent motor control
                                        for
                                        all applications.
                                    </p>
                                </div>
                            </div>
                        </div>





                        <div class="timeline-item">
                            <div class="row align-items-center">
                                <div class="col-md-6 timeline-content-left order-md-1 order-2">
                                    <h4 class="fw-bold text-dark fs-6 mt-0">2011 – Expanding Product Horizons</h4>
                                    <p class="text-dark mb-0">With a vision to provide comprehensive solutions, we
                                        expanded our portfolio by introducing <b>Motor Starters and AMF Panels</ /b>
                                            ,
                                            offering integrated systems for diverse industrial applications.<br>

                                            We also entered the <b>real estate sector</b>, introducing Subtech-made
                                            products to a new market segment, strengthening our customer base, and
                                            diversifying our reach.</p>
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
                                    <p class="text-dark mb-0">We launched our first <b>AMF Panels</b>, enhancing our
                                        product range and earning a reputation for delivering <b>dependable and
                                            high-performance electrical solutions.</b><br>
                                        In the same year, we began our collaboration with <b>Honda</b>, developing
                                        <b>generator automation and solutions for petrol generators</b> marking the
                                        beginning of our journey into <b>smart power automation</b> and establishing
                                        Subtech as a trusted name in the generator control industry.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Item 2: Content Left, Logo Right -->
                        <div class="timeline-item">
                            <div class="row align-items-center">
                                <div class="col-md-6 timeline-content-left order-md-1 order-2">
                                    <h4 class="fw-bold text-dark fs-6 mt-0">2005 – Expanding Beyond Borders</h4>
                                    <p class="text-dark mb-0">By 2005, Subtech made its mark globally by starting
                                        the
                                        <b>export of Subtech products</b>, carrying our innovations to international
                                        markets and strengthening our global footprint.
                                    </p>
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
                                    <p class="text-dark mb-0">The foundation of our company was laid with the
                                        official
                                        registration under the name <b>S S Power System</b>, marking the beginning
                                        of
                                        our mission to deliver reliable and advanced power solutions.<br>
                                        In the same year, we introduced automatic changeovers to the market an
                                        innovation that redefined convenience and efficiency in power
                                        management.<br>
                                        That year also saw the birth of our brand <b>“Subtech”</b>, which became the
                                        hallmark of our products, symbolizing our unwavering commitment to
                                        <b>quality,
                                            trust, and innovation.</b>
                                    </p>
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




<h1 style="text-align: center;">Certificates</h1>
    <div class="awards-fade-mask">
        <div class="swiper awards-swiper" id="awardsSwiper">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div class="award-card">
                        <div class="award-img">
                            <img src="<?= BASE_PATH ?>certificates/ISO 9001_page-0001.jpg" alt="ISO 9001">
                        </div>
                        <div class="award-title">ISO 9001</div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="award-card">
                        <div class="award-img">
                            <img src="<?= BASE_PATH ?>certificates/ISO 14001_page-0001.jpg" alt="ISO 14001">
                        </div>
                        <div class="award-title">ISO 14001</div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="award-card">
                        <div class="award-img">
                            <img src="<?= BASE_PATH ?>certificates/ISO 45001_page-0001.jpg" alt="ISO 45001">
                        </div>
                        <div class="award-title">ISO 45001</div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="award-card">
                        <div class="award-img">
                            <img src="<?= BASE_PATH ?>certificates/ISO 50001_page-0001.jpg" alt="ISO 50001">
                        </div>
                        <div class="award-title">ISO 50001</div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="award-card">
                        <div class="award-img">
                            <img src="<?= BASE_PATH ?>certificates/Zed Silver (1)_page-0001.jpg" alt="Zed Silver">
                        </div>
                        <div class="award-title">Zed Silver</div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="award-card">
                        <div class="award-img">
                            <img src="<?= BASE_PATH ?>certificates/AUTH LETTER.jpg" alt="Auth Letter">
                        </div>
                        <div class="award-title">Auth Letter</div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="award-card">
                        <div class="award-img">
                            <img src="<?= BASE_PATH ?>certificates/CE Certificate_page.jpg" alt="CE Certificate certification document for Subtech electrical products and compliance standards">
                        </div>
                        <div class="award-title">CE Certificate</div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="award-card">
                        <div class="award-img">
                            <img src="<?= BASE_PATH ?>certificates/Trade Mark Certificate_page.jpg" alt="Trade Mark Certificate">
                        </div>
                        <div class="award-title">Trade Mark Certificate</div>
                    </div>
                </div>

            </div>

            <!-- dots + arrows -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>



    <?php include_once "config/footer.php"; ?>




    <?php include_once "modals/all.php"; ?>

    <?php include_once "config/mobile_menu.php"; ?>
    <?php include_once "config/foot.php"; ?>

















</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    const awardsSwiper = new Swiper('#awardsSwiper', {
        loop: true,
        speed: 900,
        spaceBetween: 0,
        centeredSlides: true,                                    // ← ADD THIS
        easing: 'cubic-bezier(0.25, 0.1, 0.25, 1)',            // ← ADD THIS

        autoplay: {
            delay: 2100,
            disableOnInteraction: false
        },
        pagination: {
            el: '#awardsSwiper .swiper-pagination',
            clickable: true
        },
        navigation: {
            nextEl: '#awardsSwiper .swiper-button-next',
            prevEl: '#awardsSwiper .swiper-button-prev'
        },
        breakpoints: {
            0: { slidesPerView: 1.15 },
            576: { slidesPerView: 2.2 },
            992: { slidesPerView: 5 }    // show 3, slides through all 5
        }
    });

    const el = document.querySelector('#awardsSwiper');
    el.addEventListener('mouseenter', () => awardsSwiper.autoplay.stop());
    el.addEventListener('mouseleave', () => awardsSwiper.autoplay.start());

</script>


</html>