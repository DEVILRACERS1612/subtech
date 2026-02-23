<?php include_once 'config/config.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Calmingly&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">




    <title>Subtech: 1 to 1000+ HP Smart Motor Starters & AMF Panels | 5-Year Warranty</title>
    <meta name="description"
        content="Subtech is a trusted brand - manufacturer of Motor control panel., AMF Panels, and LT Panels, delivering reliable and efficient power control solutions.">
    <meta property="og:type" content="Website">
    <meta name="og:title" content="1 to 1000+ HP Smart Motor Starters & AMF Panels | 5-Year Warranty">
    <meta name="og:description"
        content="Subtech is a trusted brand - manufacturer of Motor control panel., AMF Panels, and LT Panels, delivering reliable and efficient power control solutions.">
    <meta property="og:image:width" content="250">
    <meta property="og:image:height" content="250">
    <meta name="og:site_name" content="Subtech">
    <meta property="og:url" content="https://subtech.in/">
    <meta name="og:image" content="https://subtech.in/images/subtech.png">
    <meta property="og:image:url" content="https://subtech.in/images/subtech.png">
    <meta name="robots" content="ALL">
    <meta name="revisit-after" content="7 days">
    <meta name="generator" content="Subtech - SS Power System">
    <meta name="author" content="Subtech - SS Power System">
    <meta name="publisher" content="Subtech - SS Power System">
    <link rel="canonical" href="https://subtech.in/">

    <!-- DM Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <?php include_once "config/head.php"; ?>

    <style>
        /* ✅ FORCE Poppins on full website (Bootstrap override) */
        * {
            font-family: "DM Sans", sans-serif !important;
        }

        html,
        body {
            font-family: "DM Sans", sans-serif !important;
            -webkit-text-size-adjust: 100%;
            text-rendering: optimizeLegibility;
        }




        :root {
            --red: #d32f2f;
            --red-dim: rgba(211, 47, 47, 0.08);
            --dark: #0e0e0e;
            --mid: #1a1a1a;
            --border: rgba(255, 255, 255, 0.07);
            --muted: rgba(255, 255, 255, 0.38);
            --text: rgba(255, 255, 255, 0.88);
            --font-heading: 'Barlow Condensed', sans-serif;
            --font-body: 'Barlow', sans-serif;
        }

        body {
            background: #0e0e0e;
            font-family: var(--font-body);
            color: var(--text);
        }

        /* ─── SECTION WRAPPER ─── */
        .footprint {
            padding: 100px 0 80px;
            position: relative;
            overflow: hidden;
            background: #0e0e0e;
        }

        /* subtle diagonal grid lines — purely CSS */
        .footprint::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(-60deg,
                    rgba(255, 255, 255, 0.025) 0px,
                    rgba(255, 255, 255, 0.025) 1px,
                    transparent 1px,
                    transparent 60px);
            pointer-events: none;
        }

        .footprint .container {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 32px;
        }

        /* ─── LABEL + HEADING ─── */
        .section-label {
            font-family: var(--font-heading);
            font-size: 11px;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--red);
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-label::before {
            content: '';
            width: 28px;
            height: 2px;
            background: var(--red);
            flex-shrink: 0;
        }

        .section-heading {
            font-family: var(--font-heading);
            font-size: clamp(36px, 5vw, 54px);
            font-weight: 600;
            line-height: 1.05;
            letter-spacing: -0.01em;
            color: #fff;
            max-width: 520px;
            margin-bottom: 60px;
        }

        .section-heading span {
            color: var(--red);
        }

        /* ─── STAT GRID ─── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            border-top: 1px solid var(--border);
            border-left: 1px solid var(--border);
            margin-bottom: 72px;
        }

        .stat-cell {
            border-right: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding: 40px 32px 36px;
            position: relative;
            transition: background 0.3s;
        }

        .stat-cell:hover {
            background: rgba(211, 47, 47, 0.05);
        }

        .stat-number {
            font-family: var(--font-heading);
            font-size: 56px;
            font-weight: 700;
            color: #fff;
            line-height: 1;
            letter-spacing: -0.02em;
            margin-bottom: 6px;
        }

        .stat-number sup {
            font-size: 28px;
            color: var(--red);
            vertical-align: super;
        }

        .stat-suffix {
            font-size: 28px;
            color: var(--red);
        }

        .stat-label {
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 12px;
        }

        .stat-desc {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.45);
            line-height: 1.6;
            max-width: 160px;
        }

        /* ─── SECTOR TAGS ─── */
        .sector-row {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 72px;
        }

        .sector-label-text {
            font-size: 11px;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--muted);
            margin-right: 4px;
        }

        .sector-tag {
            border: 1px solid var(--border);
            padding: 7px 16px;
            font-size: 12px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.6);
            letter-spacing: 0.05em;
            transition: border-color 0.25s, color 0.25s;
            cursor: default;
        }

        .sector-tag:hover {
            border-color: var(--red);
            color: #fff;
        }

        /* ─── TESTIMONIALS ─── */
        .testimonials-heading {
            font-family: var(--font-heading);
            font-size: 13px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 24px;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: var(--border);
        }

        .testimonial-card {
            background: var(--mid);
            padding: 36px 32px;
            position: relative;
            transition: background 0.3s;
        }

        .testimonial-card:hover {
            background: #202020;
        }

        .testimonial-card::before {
            content: '\201C';
            font-family: Georgia, serif;
            font-size: 64px;
            color: var(--red);
            opacity: 0.25;
            line-height: 1;
            position: absolute;
            top: 24px;
            right: 28px;
        }

        .testimonial-text {
            font-size: 14px;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.62);
            margin-bottom: 28px;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 14px;
            border-top: 1px solid var(--border);
            padding-top: 20px;
        }

        .author-initial {
            width: 38px;
            height: 38px;
            background: var(--red-dim);
            border: 1px solid rgba(211, 47, 47, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-heading);
            font-size: 16px;
            font-weight: 700;
            color: var(--red);
            flex-shrink: 0;
        }

        .author-name {
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 3px;
        }

        .author-role {
            font-size: 11px;
            color: var(--muted);
            letter-spacing: 0.05em;
        }

        /* ─── BOTTOM BAR ─── */
        .network-bar {
            margin-top: 72px;
            border: 1px solid var(--border);
            padding: 32px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            flex-wrap: wrap;
        }

        .network-bar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .network-icon {
            width: 44px;
            height: 44px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .network-icon svg {
            width: 20px;
            height: 20px;
            stroke: var(--red);
            fill: none;
            stroke-width: 1.5;
        }

        .network-text-title {
            font-family: var(--font-heading);
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.02em;
            color: #fff;
            margin-bottom: 3px;
        }

        .network-text-sub {
            font-size: 12px;
            color: var(--muted);
            line-height: 1.5;
        }

        .state-chips {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .state-chip {
            background: var(--red-dim);
            border: 1px solid rgba(211, 47, 47, 0.2);
            padding: 5px 12px;
            font-size: 11px;
            font-weight: 500;
            color: rgba(211, 47, 47, 0.9);
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 900px) {
            .stat-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .testimonials-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            .stat-grid {
                grid-template-columns: 1fr 1fr;
            }

            .stat-cell {
                padding: 28px 20px;
            }

            .stat-number {
                font-size: 40px;
            }

            .network-bar {
                flex-direction: column;
                align-items: flex-start;
            }
        }


        input,
        textarea,
        select,
        button {
            font-family: "DM Sans", sans-serif !important;
        }

        /* :root {
      --red:    #CC1717;
      --red-dk: #990E0E;
      --black:  #0A0A0A;
      --dark:   #111111;
      --card:   #161616;
      --border: #2A2A2A;
      --muted:  #555;
      --text:   #D8D8D8;
      --white:  #F5F5F5;
      --mono:   'JetBrains Mono', monospace;
      --display:'Bebas Neue', cursive;
      --body:   'DM Sans', sans-serif;
    } */

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;

        }

        .products-header {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1rem;
            /* margin-left: -25px; */
            display: flex;
            align-items: center;
        }

        .products-header::before {
            content: '';
            width: 5px;
            height: 40px;
            background-color: #ff4757;
            margin-right: 15px;
            border-radius: 2px;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--body);
            background: var(--black);
            color: var(--text);
            overflow-x: hidden;
        }

        /* ── HERO INTRO BAND ─────────────────────── */
        .tech-intro {
            position: relative;
            padding: 120px 6vw 80px;
            background: var(--dark);
            border-bottom: 1px solid var(--border);
            overflow: hidden;
        }

        .tech-intro::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                repeating-linear-gradient(90deg, transparent, transparent 39px, rgba(255, 255, 255, .03) 39px, rgba(255, 255, 255, .03) 40px),
                repeating-linear-gradient(0deg, transparent, transparent 39px, rgba(255, 255, 255, .03) 39px, rgba(255, 255, 255, .03) 40px);
        }

        .tech-intro::after {
            content: '';
            position: absolute;
            top: -120px;
            right: -80px;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(204, 23, 23, .18) 0%, transparent 70%);
            pointer-events: none;
        }

        .eyebrow {
            font-family: var(--mono);
            font-size: 11px;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--red);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .eyebrow::before {
            content: '';
            display: inline-block;
            width: 32px;
            height: 2px;
            background: var(--red);
        }

        .tech-intro h1 {
            font-family: var(--display);
            font-size: clamp(52px, 9vw, 120px);
            line-height: .92;
            color: var(--white);
            letter-spacing: 1px;
            position: relative;
            z-index: 1;
        }

        .tech-intro h1 span {
            color: var(--red);
            -webkit-text-stroke: 0px;
        }

        .tech-intro .intro-sub {
            max-width: 640px;
            margin-top: 28px;
            font-size: 16px;
            font-weight: 300;
            line-height: 1.75;
            color: var(--text);
            position: relative;
            z-index: 1;
        }

        .tech-intro .badge-row {
            display: flex;
            gap: 16px;
            margin-top: 40px;
            flex-wrap: wrap;
            position: relative;
            z-index: 1;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            border: 1px solid var(--border);
            border-radius: 2px;
            font-family: var(--mono);
            font-size: 11px;
            letter-spacing: 2px;
            color: var(--muted);
            background: rgba(255, 255, 255, .03);
        }

        .badge .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--red);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: .4;
                transform: scale(.7);
            }
        }

        /* ── COMPARISON BAR ──────────────────────── */
        .comparison-bar {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-bottom: 1px solid var(--border);
        }

        .comp-side {
            padding: 56px 6vw;
            position: relative;
        }

        .comp-side.old {
            background: #0E0E0E;
            border-right: 1px solid var(--border);
        }

        .comp-side.new {
            background: linear-gradient(135deg, #150808 0%, #0A0A0A 100%);
        }

        .comp-label {
            font-family: var(--mono);
            font-size: 10px;
            letter-spacing: 4px;
            color: var(--white);
            text-transform: uppercase;
            margin-bottom: 24px;
        }

        /* .comp-side.old .comp-label { color: #444; } */
        .comp-side.new .comp-label {
            color: var(--red);
        }

        .comp-count {
            font-family: var(--display);
            font-size: clamp(60px, 8vw, 110px);
            line-height: 1;
            color: white;
        }

        .comp-side.new .comp-count {
            color: var(--red);
        }

        .comp-desc {
            font-size: 14px;
            color: var(--white);
            margin-top: 16px;
            line-height: 1.6;
        }

        .comp-side.new .comp-desc {
            color: var(--text);
        }

        .comp-parts {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 28px;
        }

        .comp-part {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            color: var(--white);
            text-decoration: line-through;
        }

        .comp-part::before {
            content: '✕';
            color: var(--white);
            font-size: 11px;
        }

        .comp-gain {
            margin-top: 28px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .comp-gain-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            color: var(--white);
        }

        .comp-gain-item::before {
            content: '✓';
            color: var(--red);
            font-weight: 700;
        }

        .vs-divider {
            position: absolute;
            right: -28px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            width: 56px;
            height: 56px;
            background: var(--red);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--display);
            font-size: 22px;
            color: white;
            box-shadow: 0 0 40px rgba(204, 23, 23, .5);
        }

        /* ── SECTION TITLE ───────────────────────── */
        .section-header {
            padding: 80px 6vw 40px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            flex-wrap: wrap;
            border-bottom: 1px solid var(--border);
        }

        .section-header h2 {
            font-family: var(--display);
            font-size: clamp(36px, 5vw, 72px);
            color: var(--white);
            line-height: 1;
        }

        .section-header h2 em {
            color: var(--red);
            font-style: normal;
        }

        .section-num {
            font-family: var(--mono);
            font-size: 80px;
            color: var(--border);
            line-height: 1;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* ── TECHNOLOGY CARDS ────────────────────── */
        .tech-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .tech-card {
            padding: 0;
            border-right: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            position: relative;
            overflow: hidden;
            transition: background .3s;
        }

        .tech-card:last-child {
            border-right: none;
        }

        .tech-card-inner {
            padding: 60px 6vw 56px;
        }

        .tech-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--red);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .5s cubic-bezier(.16, 1, .3, 1);
        }

        .tech-card:hover::before {
            transform: scaleX(1);
        }

        .tech-tag {
            font-family: var(--mono);
            font-size: 10px;
            letter-spacing: 5px;
            color: var(--red);
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .tech-card h3 {
            font-family: var(--display);
            font-size: clamp(40px, 5vw, 72px);
            color: var(--white);
            line-height: .95;
            margin-bottom: 4px;
        }

        .tech-card .tech-fullname {
            font-size: 13px;
            color: var(--muted);
            letter-spacing: 1px;
            margin-bottom: 32px;
            font-family: var(--mono);
        }

        .tech-card .tech-lead {
            font-size: 15px;
            line-height: 1.75;
            color: var(--text);
            margin-bottom: 40px;
            border-left: 2px solid var(--red);
            padding-left: 20px;
        }

        /* Spec grid inside card */
        .spec-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2px;
            background: var(--border);
            border: 1px solid var(--border);
            margin-bottom: 40px;
        }

        .spec-item {
            background: var(--card);
            padding: 20px 18px;
        }

        .spec-label {
            font-family: var(--mono);
            font-size: 9px;
            letter-spacing: 3px;
            color: var(--muted);
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .spec-value {
            font-size: 14px;
            color: var(--white);
            font-weight: 500;
        }

        /* Feature list */
        .feature-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .feature-item {
            display: grid;
            grid-template-columns: 20px 1fr;
            gap: 14px;
            align-items: flex-start;
        }

        .feature-icon {
            width: 20px;
            height: 20px;
            border: 1px solid var(--red);
            border-radius: 2px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: var(--red);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .feature-text {
            font-size: 14px;
            color: var(--text);
            line-height: 1.5;
        }

        .feature-text strong {
            color: var(--white);
            font-weight: 600;
        }

        /* ── BIG STAT STRIP ──────────────────────── */
        .stat-strip {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .stat-block {
            padding: 48px 32px;
            border-right: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .stat-block:last-child {
            border-right: none;
        }

        .stat-block::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 0;
            background: rgba(204, 23, 23, .06);
            transition: height .4s;
        }

        .stat-block:hover::after {
            height: 100%;
        }

        .stat-num {
            font-family: var(--display);
            font-size: clamp(36px, 4vw, 60px);
            color: var(--red);
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.5;
        }

        /* ── HOW IT WORKS TIMELINE ───────────────── */
        .timeline-section {
            padding: 100px 6vw;
            background: var(--dark);
            border-bottom: 1px solid var(--border);
        }

        .timeline-header {
            margin-bottom: 64px;
        }

        .timeline-header h2 {
            font-family: var(--display);
            font-size: clamp(32px, 4vw, 60px);
            color: var(--white);
        }

        .timeline-header p {
            font-size: 15px;
            color: var(--muted);
            margin-top: 16px;
            max-width: 500px;
        }

        .timeline {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 32px;
            left: 10%;
            right: 10%;
            height: 1px;
            background: linear-gradient(90deg, var(--red), var(--border));
            z-index: 0;
        }

        .timeline-step {
            padding: 0 24px 0 0;
            position: relative;
            z-index: 1;
        }

        .timeline-step-num {
            width: 64px;
            height: 64px;
            border-radius: 2px;
            background: var(--card);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--display);
            font-size: 28px;
            color: var(--red);
            margin-bottom: 28px;
            position: relative;
        }

        .timeline-step:first-child .timeline-step-num {
            background: var(--red);
            color: white;
            border-color: var(--red);
            box-shadow: 0 0 30px rgba(204, 23, 23, .4);
        }

        .timeline-step h4 {
            font-size: 15px;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 10px;
        }

        .timeline-step p {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.65;
        }

        /* ── APPLICATIONS BAND ───────────────────── */
        .apps-section {
            padding: 80px 6vw;
            border-bottom: 1px solid var(--border);
        }

        .apps-section h2 {
            font-family: var(--display);
            font-size: clamp(32px, 4vw, 56px);
            color: var(--white);
            margin-bottom: 48px;
        }

        .apps-section h2 span {
            color: var(--red);
        }

        .apps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2px;
            background: var(--border);
        }

        .app-card {
            background: var(--card);
            padding: 36px 28px;
            position: relative;
            cursor: default;
            transition: background .25s;
        }

        .app-card:hover {
            background: #1C1C1C;
        }

        .app-icon {
            font-size: 28px;
            margin-bottom: 20px;
            display: block;
        }

        .app-card h4 {
            font-size: 15px;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 10px;
        }

        .app-card p {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
        }

        .app-tag {
            display: inline-block;
            margin-top: 16px;
            font-family: var(--mono);
            font-size: 9px;
            letter-spacing: 2px;
            color: var(--red);
            border: 1px solid rgba(204, 23, 23, .3);
            padding: 4px 10px;
            border-radius: 2px;
        }

        /* ── EXCLUSIVE BANNER ────────────────────── */
        .exclusive-banner {
            padding: 80px 6vw;
            background: var(--red-dk);
            position: relative;
            overflow: hidden;
        }

        .exclusive-banner::before {
            content: 'SUBTECH';
            position: absolute;
            right: -2%;
            top: 50%;
            transform: translateY(-50%);
            font-family: var(--display);
            font-size: clamp(80px, 14vw, 200px);
            color: rgba(255, 255, 255, .05);
            letter-spacing: 8px;
            pointer-events: none;
            line-height: 1;
        }

        .exclusive-banner h2 {
            font-family: var(--display);
            font-size: clamp(32px, 5vw, 72px);
            color: white;
            line-height: 1;
            max-width: 700px;
            position: relative;
            z-index: 1;
        }

        .exclusive-banner p {
            max-width: 560px;
            font-size: 15px;
            color: rgba(255, 255, 255, .75);
            line-height: 1.75;
            margin-top: 24px;
            position: relative;
            z-index: 1;
        }

        .exclusive-banner .cta-row {
            display: flex;
            gap: 16px;
            margin-top: 40px;
            flex-wrap: wrap;
            position: relative;
            z-index: 1;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: white;
            color: var(--red-dk);
            font-family: var(--mono);
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-weight: 700;
            transition: all .25s;
        }

        .btn-primary:hover {
            background: var(--black);
            color: white;
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: transparent;
            color: white;
            font-family: var(--mono);
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: 1px solid rgba(255, 255, 255, .4);
            cursor: pointer;
            text-decoration: none;
            transition: all .25s;
        }

        .btn-outline:hover {
            border-color: white;
            background: rgba(255, 255, 255, .08);
        }

        /* ── SCROLL ANIMATIONS ───────────────────── */
        .reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity .7s cubic-bezier(.16, 1, .3, 1), transform .7s cubic-bezier(.16, 1, .3, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: none;
        }

        .reveal-delay-1 {
            transition-delay: .1s;
        }

        .reveal-delay-2 {
            transition-delay: .2s;
        }

        .reveal-delay-3 {
            transition-delay: .3s;
        }

        .reveal-delay-4 {
            transition-delay: .4s;
        }

        /* ── RESPONSIVE ──────────────────────────── */
        @media (max-width: 900px) {
            .tech-grid {
                grid-template-columns: 1fr;
            }

            .comparison-bar {
                grid-template-columns: 1fr;
            }

            .stat-strip {
                grid-template-columns: 1fr 1fr;
            }

            .timeline {
                grid-template-columns: 1fr 1fr;
            }

            .timeline::before {
                display: none;
            }

            .apps-grid {
                grid-template-columns: 1fr 1fr;
            }

            .tech-card {
                border-right: none;
            }

            .vs-divider {
                display: none;
            }

            .comp-side.old {
                border-right: none;
                border-bottom: 1px solid var(--border);
            }
        }

        @media (max-width: 600px) {
            .stat-strip {
                grid-template-columns: 1fr 1fr;
            }

            .apps-grid {
                grid-template-columns: 1fr;
            }

            .timeline {
                grid-template-columns: 1fr;
            }

            .spec-grid {
                grid-template-columns: 1fr;
            }
        }



        /* ===== YELLOW CURSOR SPOTLIGHT EFFECT ===== */

        /* Create a radial yellow gradient that follows cursor */
        /* ===== SIMPLE YELLOW CURSOR GLOW ===== */
        /* ===== YELLOW CURSOR GLOW - WHITE AREAS ONLY ===== */
        :root {
            --mouse-x: 50%;
            --mouse-y: 50%;
        }

        /* Apply ONLY to white/light background sections */
        .white-section::after,
        .light-section::after,
        section[style*="background: white"]::after,
        section[style*="background-color: white"]::after,
        section[style*="background: #fff"]::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle,
                    rgba(252, 208, 97, 0.4) 0%,
                    rgba(187, 162, 99, 0.2) 50%,
                    transparent 100%);
            left: var(--mouse-x);
            top: var(--mouse-y);
            border-radius: 50%;
            pointer-events: none;
            z-index: 10;
            transform: translate(-50%, -50%);
            filter: blur(30px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        :root {
            --mouse-x: 50%;
            --mouse-y: 50%;
        }

        body {
            font-family: "DM Sans", sans-serif;
        }


        .yellow-glow {
            position: relative;
            overflow: hidden;
        }

        .yellow-glow::after {
            content: '';
            position: absolute;
            width: 170px;
            height: 170px;
            background: radial-gradient(circle,
                    rgba(239, 68, 68, 0.4) 40%,
                    rgba(220, 53, 69, 0.35) 40%,
                    rgba(239, 68, 68, 0.2) 70%,
                    transparent 100%);
            left: var(--mouse-x);
            top: var(--mouse-y);
            border-radius: 50%;
            pointer-events: none;
            z-index: 10;
            transform: translate(-50%, -50%);
            filter: blur(30px);
            opacity: 0;
        }

        .yellow-glow.active::after {
            opacity: 0.2;
        }

        /* Parent sections must have position relative */
        .white-section,
        .light-section {
            position: relative;
            overflow: hidden;
        }

        /* Show glow when cursor is inside */
        .white-section.active::after,
        .light-section.active::after {
            opacity: 1;
        }

        /* NO GLOW on dark sections */
        .dark-section::after,
        .hero-section::after,
        section[style*="background: #8c2a38"]::after,
        section[style*="background-color: rgb(140, 42, 56)"]::after {
            display: none !important;
        }

        @media (max-width: 768px) {

            .white-section::after,
            .light-section::after {
                display: none;
            }
        }



        .background-video-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
            /* Ensure it's behind the content */
        }

        .background-video-container iframe {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100vw;
            height: 56.25vw;
            /* 100 * 9 / 16 = 56.25 */
            min-height: 100vh;
            min-width: 177.77vh;
            /* 100 * 16 / 9 = 177.77 */
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .btn-custom {
            background-color: #3b82f6;
            /* Equivalent to blue-600 */
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            /* Equivalent to rounded-full */
            font-weight: 600;
            /* Equivalent to font-semibold */
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .btn-custom:hover {
            background-color: #2563eb;
            /* Equivalent to blue-700 */
            transform: scale(1.05);
        }


        .hero-section {
            position: relative;
            height: 100vh;
            /* Full viewport height */
            overflow: hidden;
            display: flex;
            align-items: center;
            /* Vertically center content */
            justify-content: center;
            /* Horizontally center content */
            color: white;
            /* Text color */

        }

        .background-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensures video covers the entire area */
            z-index: -1;
            /* Puts video behind content */
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            /* Dark overlay for text readability */
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            /* Puts content above video and overlay */
            padding: 50px;
        }

        .hero-title {
            font-size: 3.5rem;
            /* Larger title for impact */
            font-weight: bold;
            margin-bottom: 20px;
            color: #fff;

            line-height: 62px;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            max-width: 800px;
            margin: 0 auto 30px auto;

        }

        .btn-custom {
            background-color: #E20027;
            /* Custom button color */
            border-color: #E20027;
            color: white;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 50px;
            /* Rounded button */
        }

        .btn-custom:hover {
            background-color: #c90022;
            border-color: #c90022;
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .btn-custom {
                padding: 12px 25px;
                font-size: 1rem;
            }
        }



        .section-header {
            font-weight: bold;
            font-size: 2.5rem;
            color: #333;
            margin-top: 2rem;
            display: flex;
            align-items: center;
        }

        .section-header::before {
            content: '';
            width: 5px;
            height: 40px;
            background-color: #ff4757;
            margin-right: 15px;
            border-radius: 2px;
        }

        .product-card {
            border-radius: 15px;
            padding: 2.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            /* Ensures all cards have the same height */
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .product-card-title {
            font-weight: 700;
            font-size: 1.3rem;
            color: #020910;
            display: flex;
            align-items: center;
        }

        .product-card-title::before {
            content: '';
            width: 15px;
            height: 15px;
            background-color: #ff4757;
            border-radius: 50%;
            margin-right: 10px;
        }

        .product-card-text {
            color: #7f8c8d;
            font-size: 1rem;
            line-height: 1.6;
        }

        .product-card-image {
            max-width: 100%;
            height: auto;
            margin: 1.5rem 0;
            border-radius: 10px;
        }



        /* body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #ffffff;
            padding: 80px 0;
            overflow-x: hidden;
        } */

        .fade-edge {
            width: 100%;
            position: relative;
        }

        /* Fade effect on edges */
        .fade-edge::before,
        .fade-edge::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 150px;
            z-index: 2;
            pointer-events: none;
        }

        .fade-edge::before {
            left: 0;
            background: linear-gradient(to right, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
        }

        .fade-edge::after {
            right: 0;
            background: linear-gradient(to left, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
        }

        .clients-section {
            width: 100%;
            overflow: hidden;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 52px;
            font-weight: 600;
            color: #1a1a1a;
            letter-spacing: -0.5px;
            margin: 25px
        }

        .section-title h2 em {
            font-style: italic;
            font-weight: 400;
            color: #666;
        }

        .section-title p {
            font-size: 18px;
            color: #666;
            margin-top: 10px;
        }

        .slider-wrapper {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding: 20px 0;
        }

        .slider-track {
            display: flex;
            animation: scroll-left 25s linear infinite;
            width: fit-content;
        }

        .slider-track.reverse {
            animation: scroll-right 35s linear infinite;
        }

        .slider-track:hover {
            animation-play-state: paused;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 80px;
            padding: 0 40px;
        }

        .brand-item {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 150px;
            height: 80px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* .brand-item:hover {
            filter: drop-shadow(0 8px 24px rgba(251, 191, 36, 0.4)) 
                    drop-shadow(0 4px 12px rgba(251, 191, 36, 0.3));
        } */

        .brand-item img {
            max-width: 140px;
            max-height: 60px;
            width: auto;
            height: auto;
            object-fit: contain;
            filter: grayscale(100%) brightness(0.4) contrast(1.2);
            opacity: 0.6;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .brand-item:hover img {
            filter: grayscale(0%) brightness(1) contrast(1);
            opacity: 1;
            transform: scale(1.25);
        }

        .cursor-dot {
            width: 12px;
            height: 12px;
            background-color: #fbbf24;
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            transform: translate(-50%, -50%);
            transition: transform 0.1s ease, opacity 0.3s ease;
        }

        /* Cursor ring with radial blur */
        .cursor-ring {
            width: 40px;
            height: 40px;
            border: 2px solid #fbbf24;
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9998;
            transform: translate(-50%, -50%);
            transition: width 0.3s ease, height 0.3s ease, opacity 0.3s ease;
            box-shadow:
                0 0 20px rgba(251, 191, 36, 0.6),
                0 0 40px rgba(251, 191, 36, 0.4),
                0 0 60px rgba(251, 191, 36, 0.3);
            filter: blur(0.5px);
        }

        /* Radial blur effect behind cursor */
        .cursor-blur {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle,
                    rgba(251, 191, 36, 0.15) 0%,
                    rgba(251, 191, 36, 0.08) 40%,
                    rgba(251, 191, 36, 0) 70%);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9996;
            transform: translate(-50%, -50%);
            filter: blur(30px);
            transition: opacity 0.3s ease;
        }

        /* Hover effect - enlarge everything */
        .cursor-ring.hover {
            width: 60px;
            height: 60px;
            border-color: #f59e0b;
            box-shadow:
                0 0 30px rgba(251, 191, 36, 0.8),
                0 0 60px rgba(251, 191, 36, 0.6),
                0 0 90px rgba(251, 191, 36, 0.4);
            filter: blur(1px);
        }

        .cursor-blur.hover {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle,
                    rgba(251, 191, 36, 0.25) 0%,
                    rgba(251, 191, 36, 0.12) 40%,
                    rgba(251, 191, 36, 0) 70%);
            filter: blur(40px);
        }

        /* Trail particles with blur */
        .cursor-trail {
            width: 8px;
            height: 8px;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9997;
            opacity: 0;
            filter: blur(1px);
            animation: trail-fade 0.8s ease-out;
        }

        @keyframes trail-fade {
            0% {
                opacity: 1;
                transform: scale(1);
                filter: blur(0px);
            }

            100% {
                opacity: 0;
                transform: scale(0.2);
                filter: blur(4px);
            }
        }

        /* Pulsing radial waves */
        .cursor-wave {
            width: 80px;
            height: 80px;
            border: 1px solid rgba(251, 191, 36, 0.4);
            border-radius: 50%;
            position: fixed;
            pointer-events: none;
            z-index: 9995;
            transform: translate(-50%, -50%);
            animation: wave-pulse 2s ease-out infinite;
        }

        @keyframes wave-pulse {
            0% {
                width: 80px;
                height: 80px;
                opacity: 0.6;
                filter: blur(0px);
            }

            100% {
                width: 200px;
                height: 200px;
                opacity: 0;
                filter: blur(10px);
            }
        }

        /* Show default cursor on interactive elements */
        a,
        button,
        input,
        textarea,
        select,
        [onclick] {
            cursor: pointer !important;
        }

        .slider-wrapper+.slider-wrapper {
            margin-top: 10px;
        }

        @keyframes scroll-left {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        @keyframes scroll-right {
            0% {
                transform: translateX(-50%);
            }

            100% {
                transform: translateX(0);
            }
        }

        /* WOW Animation */
        .fadeInUp {
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 1024px) {
            .section-title h2 {
                font-size: 42px;
            }

            .logo-container {
                gap: 60px;
            }

            .brand-item {
                min-width: 120px;
                height: 70px;
            }

            .brand-item img {
                max-width: 110px;
                max-height: 50px;
            }

            .brand-item:hover img {
                transform: scale(1.2);
            }
        }

        @media (max-width: 768px) {
            .section-title h2 {
                font-size: 32px;
            }

            .logo-container {
                gap: 40px;
                padding: 0 20px;
            }

            .brand-item {
                min-width: 100px;
                height: 60px;
            }

            .brand-item img {
                max-width: 90px;
                max-height: 45px;
            }

            .brand-item:hover img {
                transform: scale(1.15);
            }

            .fade-edge::before,
            .fade-edge::after {
                width: 80px;
            }
        }

        .view-now-link {
            color: #ff4757;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        .view-now-link:hover {
            color: #e74c3c;
        }

        .view-now-link .arrow {
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .view-now-link:hover .arrow {
            transform: translateX(5px);
        }

        .image-frame {
            /* Define a fixed size for the image container */
            width: 100%;
            /* 160px */
            height: 20rem;
            /* 160px */
        }

        @media (min-width: 768px) {
            .image-frame {
                width: 100%;
                /* 224px */
                height: 26rem;
                /* 224px */
            }
        }


        .content-card {
            background-color: #8c2a38;
            /* A lighter shade of the burgundy */
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .stats-card {
            display: flex;
            justify-content: space-around;
            text-align: center;
        }

        .stat-item {
            padding: 10px;
        }

        .section-title {
            margin: top 15px;
            px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .stat-label {
            font-size: 0.9rem;
            text-transform: uppercase;
            opacity: 0.8;
        }

        .network-card h3 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .network-card p {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .btn-tag {
            background-color: #8c2a38;
            /* Match card background */
            border: 1px solid #c9939a;
            /* Lighter border for contrast */
            color: white;
            border-radius: 20px;
            padding: 5px 15px;
            margin-right: 10px;
            font-size: 0.8rem;
            cursor: pointer;
        }

        .btn-tag:hover {
            background-color: #a03c4c;
        }

        .image-container {
            border: 8px solid white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 10px rgba(0, 0, 0, 0.2);
        }

        .image-container img {
            width: 100%;
            height: auto;
            display: block;
        }


        .testimonial-card {
            max-width: 600px;
            margin: 0 auto;
            padding: 1rem;
            border-radius: 10px;
        }

        .user-initials {
            width: 50px;
            height: 50px;
            background-color: #3b82f6;
            /* Blue-500 */
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: bold;
            flex-shrink: 0;
        }




        /* highlights Counter */
        .icon-card {
            padding: 1.5rem;
            transition: transform 0.3s ease-in-out;
            cursor: default;
        }

        .icon-card:hover {
            transform: translateY(-5px);
            border: black;
        }

        .display-counter {
            /* Ensure the counter number is bold and large */
            font-weight: 700 !important;
            font-size: 3rem;
            /* Equivalent to display-4 in large screens */
            line-height: 1;
        }

        /* Custom style for the SVG color using Bootstrap's text-secondary color */
        .svg-icon {
            color: var(--bs-secondary);
            /* Uses Bootstrap's secondary color variable */
        }

        .ss_care_linklist {
            background: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 20px;
            padding: 20px;
            width: 100%;

        }

        .ss_care_linklist ul {
            list-style: none;
            display: flex;
            gap: 14px;
        }

        /* ── Each card ── */
        .ss_care_linklist li {
            flex: 1;
        }

        .ss_care_linklist li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px 18px;
            background: #fafafa;
            border: 1px solid #ebebeb;
            border-radius: 14px;
            text-decoration: none;
            color: #111;
            transition: background 0.18s, box-shadow 0.18s, transform 0.15s;
            cursor: pointer;
        }

        .ss_care_linklist li a:hover {


            border: 1px solid gray;
            transform: translateY(-1px);
        }

        /* ── Icon bubble ── */
        .care-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            background: #f0f0f0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .care-icon svg {
            width: 20px;
            height: 20px;
            stroke: #222;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* ── Label ── */
        .care-label {
            flex: 1;
            font-size: 15px;
            font-weight: 500;
            color: #1a1a1a;
            white-space: nowrap;
        }

        /* ── Arrow button ── */
        .care-arrow {
            width: 32px;
            height: 32px;
            min-width: 32px;
            background: #ebebeb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.18s;
        }

        .ss_care_linklist li a:hover .care-arrow {
            background: #d8d8d8;
        }

        .care-arrow svg {
            width: 14px;
            height: 14px;
            stroke: #444;
            fill: none;
            stroke-width: 2;
        }

        /* ── Responsive ── */
        @media (max-width: 767px) {

            /* ── Override the global SVG rule that breaks card layout ── */
            .ss_care_linklist ul li a svg {
                position: static !important;
                transform: none !important;
                top: auto !important;
                font-size: unset !important;
            }

            .ss_care_linklist {
                padding: 10px;
                border-radius: 16px;
            }

            .ss_care_linklist ul {
                flex-direction: column !important;
                gap: 10px;
            }

            .ss_care_linklist li a {
                display: flex !important;
                flex-direction: row !important;
                align-items: center !important;
                padding: 12px 14px !important;
                gap: 12px !important;
                overflow: hidden !important;
            }

            .care-icon {
                width: 36px !important;
                height: 36px !important;
                min-width: 36px !important;
                max-width: 36px !important;
                flex-shrink: 0 !important;
                border-radius: 9px !important;
            }

            .care-icon svg {
                width: 18px !important;
                height: 18px !important;
            }

            .care-label {
                font-size: 14px !important;
                flex: 1 !important;
                white-space: nowrap !important;
            }

            .care-arrow {
                width: 28px !important;
                height: 28px !important;
                min-width: 28px !important;
                max-width: 28px !important;
                flex-shrink: 0 !important;
                margin-right: 2px !important;
            }

            .care-arrow svg {
                width: 12px !important;
                height: 12px !important;
            }

        }
    </style>
</head>

<body>

    <?php include_once "config/header-top.php"; ?>

    <div id="wrapper">

        <?php include_once "config/header.php"; ?>



        <section class="hero-section position-relative overflow-hidden">

            <div class="background-video-container">


                <iframe loading="lazy"
                    src="https://www.youtube.com/embed/oFuWT0fFyhw?controls=0&amp;autoplay=1&amp;mute=1&amp;loop=1&amp;playlist=oFuWT0fFyhw"
                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                </iframe>

            </div>

            <div class="video-overlay"></div>

            <div class="container position-relative z-1 hero-content">
                <div class="row">
                    <div class="col-lg-6 text-center text-lg-start">
                        <h1 class="display-4 fw-bold lh-1 hero-title">Your Global Partner <br>in Electrical
                            <br>Excellence
                        </h1>
                        <p class="lead mt-4 hero-subtitle" style="line-height: 2rem;">Complete solutions in Smart motor
                            control panel, switchgear, and automation, trusted by industries worldwide for a sustainable
                            Earth.</p>

                        <a href="contact" class="btn btn-custom mt-4 d-inline-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-arrow-right me-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                            </svg>
                            <span>Get Your Solution</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>





        <div class="fade-edge">
            <div class="clients-section yellow-glow">
                <div class="flat-title wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="section-title">
                        <h2>Our clients <span class="calm">loves us</span></h2>
                        <p>Trusted by leading companies across industries</p>
                    </div>
                </div>

                <!-- First Row - Scrolling Left -->
                <div class="slider-wrapper">
                    <div class="slider-track">
                        <!-- First Set -->
                        <div class="logo-container">
                            <div class="brand-item">
                                <img src="images/brand/logo-bhutani.png" alt="Brand 1">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/DHLnew.png" alt="Brand 2">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/Airtel-logo.png" alt="Brand 3">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/bptpnew.png" alt="Brand 4">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/lalpathlabnew.png" alt="Brand 5">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/hondanew.png" alt="Brand 6">
                            </div>

                            <div class="brand-item">
                                <img src="images/brand/nalkonew.png" alt="Brand 7">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/unoMinda.png" alt="Brand 7">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/supertechnew.png" alt="Brand 7">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/Hathway_cable_&_Datacom_logo.svg - copy.png" alt="Brand 7">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/NTPC.NS.png" alt="Brand 7">
                            </div>
                        </div>
                        <!-- Duplicate Set for Seamless Loop -->

                    </div>
                </div>

                <!-- Second Row - Scrolling Right -->
                <div class="slider-wrapper">
                    <div class="slider-track reverse">
                        <!-- First Set -->
                        <div class="logo-container">
                            <div class="brand-item">
                                <img src="images/brand/logo-bhutani.png" alt="Brand 1">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/DHLnew.png" alt="Brand 2">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/Airtel-logo.png" alt="Brand 3">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/bptpnew.png" alt="Brand 4">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/lalpathlabnew.png" alt="Brand 5">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/hondanew.png" alt="Brand 6">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/supertechnew.png" alt="Brand 7">
                            </div>
                        </div>
                        <!-- Duplicate Set for Seamless Loop -->
                        <div class="logo-container">
                            <div class="brand-item">
                                <img src="images/brand/logo-bhutani.png" alt="Brand 1">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/DHLnew.png" alt="Brand 2">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/Airtel-logo.png" alt="Brand 3">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/bptpnew.png" alt="Brand 4">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/lalpathlabnew.png" alt="Brand 5">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/hondanew.png" alt="Brand 6">
                            </div>
                            <div class="brand-item">
                                <img src="images/brand/supertechnew.png" alt="Brand 7">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!--
        <section class="hero-section">
        <div class="video-overlay"></div>
        <video autoplay muted loop class="background-video">
            <source src="back.mp4" type="video/mp4">
            <source src="your-video.webm" type="video/webm">
            Your browser does not support the video tag.
        </video>

        <div class="container hero-content">
            <div class="row ">
                <div class="col-lg-6">
                    
                    <h1 class="hero-title">Your Global Partner <br>in Electrical <br>Excellence</h1>
                    <p class="hero-subtitle">Complete solutions in motor starters, switchgear, and automation, trusted by industries worldwide — for a sustainable Earth.</p>
                    
                    <a href="https://www.subtech.com/solutions" class="btn btn-custom">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
    </svg>
    Get Your Solution
</a>
                    
                </div>
            </div>
        </div>
    </section>
        
    -->


        <section class="container-fluid py-2">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="bg-white rounded-3 p-4 p-md-5">
                        <div class="row g-5 align-items-center">
                            <!-- Left Column: Text Content -->
                            <div class="col-md-6 text-center text-md-start">
                                <h2 class="display-4 fw-bold text-dark lh-sm">
                                    Why Us
                                </h2><br>
                                <p class="text-danger fw-semibold fs-5">Because We Care.</p><br>
                                <p style="line-height: 2rem;font-size: 1.25rem;color: #5e5e5e;">
                                    At Subtech, we don't just build electrical products <span class="text-dark">we
                                        create complete automation and control solutions</span> that power industries,
                                    protect the planet, and improve lives. With a commitment to innovation,
                                    sustainability, and trust, we stand as a partner to every customer, <span
                                        class="text-dark">from rural farms to global industries.</span>
                                </p>
                            </div>

                            <!-- Right Column: Image and Card -->
                            <div class="col-md-6 ">

                                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

                                    <div class="carousel-inner"
                                        style="    border-radius: 10px;     border: 1px solid #000000;">


                                        <div class="carousel-item active">
                                            <div
                                                class="image-frame overflow-hidden rounded-3 border border-1 border-secondary shadow-sm">

                                                <img src="images/whychoose1.webp" alt="Smart Solutions"
                                                    class="img-fluid object-fit-cover w-100 h-100">
                                            </div>

                                            <div class="carousel-caption d-none d-md-block"
                                                style=" background-image: linear-gradient(to bottom, rgba(255,0,0,0), rgba(255,0,0,1)); width:100%">
                                                <h3 class="text-white">Smart Solutions</h3>
                                                <p>Automated and customized control systems engineered to solve modern
                                                    industrial challenges.</p>
                                            </div>
                                        </div>


                                        <div class="carousel-item">
                                            <div
                                                class="image-frame overflow-hidden rounded-3 border border-1 border-secondary shadow-sm">

                                                <img src="images/whychoose2.webp" alt="20 years of experience"
                                                    class="img-fluid object-fit-cover w-100 h-100">
                                            </div>

                                            <div class="carousel-caption d-none d-md-block"
                                                style=" background-image: linear-gradient(to bottom, rgba(255,0,0,0), rgba(255,0,0,1));  width:100%">
                                                <h3 class="text-white">About Us</h3>
                                                <p>With over 20 years of experience, Subtech has built lasting trust
                                                    across industries by delivering quality and reliability.</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <div
                                                class="image-frame overflow-hidden rounded-3 border border-1 border-secondary shadow-sm">

                                                <img src="images/whychoose3.webp"
                                                    alt="ISO 9001, ISO 45001 & ISO 50001 certified"
                                                    class="img-fluid object-fit-cover w-100 h-100">
                                            </div>
                                            <div class="carousel-caption d-none d-md-block"
                                                style=" background-image: linear-gradient(to bottom, rgba(255,0,0,0), rgba(255,0,0,1));  width:100%">
                                                <h3 class="text-white">Certified Excellence</h3>
                                                <p>ISO 9001, ISO 45001 & ISO 50001 certified for quality, safety &
                                                    energy management.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- The Counter Section -->
        <section id="counter-section" class="container-fluid py-5">
            <div class="bg-white p-4 p-md-5 rounded-4 shadow w-100 mx-auto" style="max-width: 1200px;">
                <div class="row align-items-center justify-content-between g-4">

                    <div
                        class="col-12 col-md d-flex flex-column flex-sm-row flex-md-column flex-lg-row align-items-center justify-content-around">

                        <!-- Card 1: Channel Partners -->
                        <div class="text-center p-3 icon-card">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-network svg-icon" aria-hidden="true">
                                <rect x="16" y="16" width="6" height="6" rx="1"></rect>
                                <rect x="2" y="16" width="6" height="6" rx="1"></rect>
                                <rect x="9" y="2" width="6" height="6" rx="1"></rect>
                                <path d="M5 16v-3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3"></path>
                                <path d="M12 12V8"></path>
                            </svg>
                            <p class="display-counter fw-bold text-danger mb-0"><span class="counter"
                                    data-target="25">0</span> +</p>
                            <p class="text-dark"><b>Years of Experience</b></p>
                        </div>

                        <!-- Card 2: Approved Service Partners -->
                        <div class="text-center p-3 icon-card">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-users-round svg-icon" aria-hidden="true">
                                <path d="M18 21a8 8 0 0 0-16 0"></path>
                                <circle cx="10" cy="8" r="5"></circle>
                                <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"></path>
                            </svg>
                            <p class="display-counter fw-bold text-danger mb-0"><span class="counter"
                                    data-target="300">0</span> +</p>
                            <p class="text-dark"><b>Dealers Across India</b></p>
                        </div>

                        <!-- Card 3: Field Service Engineers -->
                        <div class="text-center p-3 icon-card">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-hard-hat svg-icon" aria-hidden="true">
                                <path d="M2 18a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v2z">
                                </path>
                                <path d="M10 10V5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5"></path>
                                <path d="M4 15v-3a6 6 0 0 1 6-6"></path>
                                <path d="M14 6a6 6 0 0 1 6 6v3"></path>
                            </svg>
                            <p class="display-counter fw-bold text-danger mb-0"><span class="counter"
                                    data-target="200">0</span> +</p>
                            <p class="text-dark"><b>Product Lines</b></p>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <script>const dot = document.getElementById('dot'), ring = document.getElementById('ring');
            let mx = 0, my = 0, rx = 0, ry = 0;
            document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; dot.style.left = mx + 'px'; dot.style.top = my + 'px' });
            (function animCursor() {
                rx += (mx - rx).15; ry += (my - ry).15;
                ring.style.left = rx + 'px'; ring.style.top = ry + 'px';
                requestAnimationFrame(animCursor);
            })();
            document.querySelectorAll('a,button,.product-card,.why-card,.tech-block').forEach(el => {
                el.addEventListener('mouseenter', () => { ring.style.transform = 'translate(-50%,-50%) scale(1.8)'; ring.style.borderColor = 'rgba(204,23,23,.8)' });
                el.addEventListener('mouseleave', () => { ring.style.transform = 'translate(-50%,-50%) scale(1)'; ring.style.borderColor = 'rgba(204,23,23,.6)' });
            });</script>

        <!-- JavaScript for Scroll-Triggered Counter Animation -->
        <script>

            // Use a modern approach (Intersection Observer) for scroll detection without jQuery
            document.addEventListener('DOMContentLoaded', () => {
                const counterSection = document.getElementById('counter-section');
                const counters = counterSection ? counterSection.querySelectorAll('.counter') : [];
                const animationSpeed = 2000; // Total duration in milliseconds (2 seconds)

                // Function to start the counting animation for a single element
                const animateCounter = (counterElement) => {
                    // Get the final target number from the data-target attribute
                    const target = parseInt(counterElement.getAttribute('data-target'), 10);

                    // If the target is not a valid number, stop.
                    if (isNaN(target)) return;

                    const start = 0;
                    let startTime;

                    const step = (timestamp) => {
                        if (!startTime) startTime = timestamp;
                        const elapsed = timestamp - startTime;

                        // Calculate the percentage of time elapsed
                        const progress = Math.min(elapsed / animationSpeed, 1);

                        // Calculate the current value based on progress
                        const value = Math.floor(progress * target);

                        // Update the text content
                        counterElement.innerText = value;

                        // Continue the animation loop until progress is 100%
                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        } else {
                            // Ensure the final target value is set accurately
                            counterElement.innerText = target;
                        }
                    };

                    // Start the animation frame loop
                    window.requestAnimationFrame(step);
                };

                // Intersection Observer Setup
                if (counterSection && counters.length > 0) {
                    const observerOptions = {
                        root: null, // Viewport is the root
                        rootMargin: '0px',
                        threshold: 0.2 // Trigger when 20% of the section is visible
                    };

                    const observer = new IntersectionObserver((entries, observer) => {
                        entries.forEach(entry => {
                            // Check if the observed element (the section) is intersecting
                            if (entry.isIntersecting) {
                                // Start animation for all counter elements within the section
                                counters.forEach(animateCounter);
                                // Stop observing the section once the animation has started (trigger once)
                                observer.unobserve(entry.target);
                            }
                        });
                    }, observerOptions);

                    // Start observing the main counter section
                    observer.observe(counterSection);
                }
            });
        </script>
        <section class="tech-intro">
            <div class="eyebrow">Subtech Core Technology</div>
            <h1>Built Different.<br><span>Engineered Better.</span></h1>
            <p class="intro-sub">
                While the industry still relies on conventional contactors and disconnected protection components,
                Subtech has developed two proprietary technologies — <strong>MPU</strong> and <strong>PMC</strong> —
                that replace multiple outdated parts with smarter, integrated solutions.
                This is not an upgrade. This is a different class of motor control.
            </p>

        </section>

        <!-- ═══════════════════════════════════════════════════════ -->
        <!--  OLD vs NEW COMPARISON                                  -->
        <!-- ═══════════════════════════════════════════════════════ -->
        <div class="comparison-bar">
            <div class="comp-side old">
                <div class="comp-label">Traditional Starter</div>
                <div class="comp-count">6</div>
                <div class="comp-desc">Separate components wired together. More failure points. More panel space. More
                    maintenance.</div>
                <div class="comp-parts" style="color:white">
                    <div class="comp-part">Thermal Overload Relay</div>
                    <div class="comp-part">Single Phase Preventer</div>
                    <div class="comp-part">Analog Ammeter</div>
                    <div class="comp-part">Push Buttons (Start / Stop)</div>
                    <div class="comp-part">Conventional AC Contactor</div>
                    <div class="comp-part">Extra Protection Modules</div>
                </div>
                <div class="vs-divider">VS</div>
            </div>
            <div class="comp-side new">
                <div class="comp-label">Subtech Smart Panel — MPU + PMC</div>
                <div class="comp-count">2</div>
                <div class="comp-desc">Two intelligent units that do the work of six — and do it better.</div>
                <div class="comp-gain">
                    <div class="comp-gain-item">MPU: 1 unit replaces 5 components</div>
                    <div class="comp-gain-item">PMC: Solves coil burning & chattering for life</div>
                    <div class="comp-gain-item">Compact panel — less wiring, less space</div>
                    <div class="comp-gain-item">Fewer parts = fewer failures = lower lifetime cost</div>
                    <div class="comp-gain-item">Suitable for any motor: agricultural, industrial, commercial</div>
                </div>
            </div>
        </div>


        <section class="container py-24 pb-5 mt-5" style="background:#f4fcfd">
            <div class="row px-5">
                <div class="col-12 mb-4">
                    <h2 class="products-header">Explore Our Products</h2>
                </div>
            </div>
            <div class="row g-4">
                <?php
                $sql = "
SELECT DISTINCT
  c.id AS cat_id,
  c.cat_name AS cat_name,
  c.url_name AS cat_slug,
  c.description AS des,
  c.image AS img,
  c.alttext AS alttext
FROM mi_product p
INNER JOIN mi_wproduct wp on wp.urlname=p.url_name
INNER JOIN mi_category c ON p.cat_id = c.id
WHERE p.mi_status = 'Yes'
  AND c.mi_status = 'Yes'
ORDER BY c.cat_name;
";
                $result = $db->query($sql);
                while ($prow = $result->fetch_assoc()) {

                    $img = ($prow['img'] != "") ? '<img src="' . BASE_PATH . 'images/cat_img/' . $prow['img'] . '" alt="' . $prow['alttext'] . '" style="width:10rem" />' : '<img src="' . BASE_PATH . 'images/noimage.png" alt="' . $prow['alttext'] . '" style="width:6rem" />';
                    echo '<div class="col-lg-4 col-md-6">
            <div class="product-card">
                <h3 class="product-card-title mb-3">' . $prow['cat_name'] . '</h3>
                <p class="product-card-text">
                    ' . $prow['des'] . '
                </p>
               
			<div  class="text-center justify-content-center" >
                ' . $img . '<br>
				 <a href="' . BASE_PATH . 'category/' . $prow['cat_slug'] . '" class="view-now-link mt-2">
                    View Now <span class="arrow">&rarr;</span>
                </a>
				</div>
            </div>
        </div>';
                }
                ?>


            </div>
        </section>



        <!-- <section class="container py-20 " style="background-image: url(./backgorund.jpg); background-size: cover; background-position: center center; background-repeat: no-repeat; padding-top: 50px;
    padding-bottom: 80px;"> -->


        <!-- <div class="row px-5 text-center">
                <div class="col-12 mb-4">
                    <h2 class="text-white" style="font-weight:700">5X Smarter, 3X Safer, 0% Downtime</h2>
                </div>
            </div> -->
        <!-- <div class="row g-4">
                <!-- Card 1 -->
        <!-- <div class="col-lg-4 col-md-6">

                    <div class="text-center justify-content-center">
                        <img src="images/whychoose-4.webp" class="product-card-image justify-content-center"
                            alt="5 Year Extended Warranty Badge" style="width:6rem"><br>
                        <p class="text-white">Coil Burning Warranty</p>
                    </div>

                </div> -->

        <!-- Card 2 -->
        <!-- <div class="col-lg-4 col-md-6">

                    <div class="text-center justify-content-center">
                        <img src="images/whychoose-5.webp" class="product-card-image justify-content-center"
                            alt="Advanced Electronic Circuit Technology" style="width:6rem"><br>
                        <p class="text-white">Micro Controller Technology</p>
                    </div>

                </div> -->

        <!-- Card 3 -->
        <!-- <div class="col-lg-4 col-md-6">
                    <div class="">
                        <div class="text-center justify-content-center">
                            <img src="images/whychoose-6.webp" class="product-card-image justify-content-center"
                                alt="Less Wiring Circuit Design" style="width:6rem"><br>
                            <p class="text-white">Less Wiring Faster Setup</p>
                        </div>
                    </div>
                </div> -->
        <!-- </div>  -->



        <!-- </section> -->











        <!-- About Us -->
        <div class="s-banner-colection flat-spacing-4 yellow-glow">
            <div class="container">
                <div class="banner-content tf-grid-layout tf-col-2 ">
                    <div class="">
                        <img src="images/subtech.webp" data-src="images/subtech.webp" alt="subtech company image"
                            class="lazyload">
                    </div>
                    <div class="box-content ">
                        <div class="box-title-banner wow fadeInUp">
                            <h2 class="title display-md">
                                <b>About Us</b>
                            </h2>
                            <h3 class="sub text-md">Your Trusted Partner in Electrical Solutions.</h3><br>
                            <p class="sub text-md" style="color: black;">
                                At <b>Subtech</b>, we have been providing quality electrical solutions for over 25
                                years, made to be safe, reliable, and eco-friendly. With a focus on new ideas and happy
                                customers, we've built a strong name as a trusted partner across many industries.<br>

                                <b>Our promise is simple:</b> to create and deliver reliable, future-ready electrical
                                products that power businesses, make life easier, and can be trusted for years to come.
                            </p>
                        </div>
                        <div class="box-btn-banner wow fadeInUp">
                            <a href="<?= BASE_PATH ?>about/" class="tf-btn animate-btn btn-dark2">
                                <i class="icon icon-arrow-top-left"></i>Explore more
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /About Us-->



        <section style="padding-top: 50px; padding-bottom: 50px;">


            <div class="container">
                <div class="flat-title wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <h2 class="title">Driving Innovation Across Sectors</h4>
                        <p>Delivering reliable electrical solutions tailored to every industry.</p>
                </div>


                <style>
                    /* 1. Custom CSS for Fixed Height Container and Image Sizing */
                    .fixed-height-card {
                        /* Set the desired fixed height for all cards/columns */
                        height: 350px;
                        /* Adjust this value as needed */
                        position: relative;
                        /* Essential for positioning the overlay text */
                        overflow: hidden;
                        /* Clips content outside the fixed height */
                    }

                    /* 2. Image Scaling to Cover the Fixed Height */
                    .fixed-height-card img {
                        width: 100%;
                        height: 100%;
                        /* Scales and crops the image to cover the entire container */
                        object-fit: cover;
                    }

                    /* 3. Text Overlay Styling */
                    .card-overlay {
                        position: absolute;
                        bottom: 0;
                        left: 0;
                        width: 100%;
                        padding: 1rem 0;
                        text-align: center;
                        color: white;
                        /* Semi-transparent black background (RGBA) */
                        background-color: rgba(0, 0, 0, 0.6);
                        /* Make it slightly transparent/dull */
                        transition: background-color 0.3s ease;
                    }

                    /* Optional: Add a subtle hover effect */
                    .fixed-height-card:hover .card-overlay {
                        background-color: rgba(0, 0, 0, 0.8);
                    }
                </style>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="fixed-height-card rounded-3 shadow-sm">

                            <img src="images/sector/sector1.webp" alt="Energy Generation">

                            <div class="card-overlay">
                                <h4 class="mb-1  text-white">Manufacturing</h4>
                                <p class="small mb-0">Industrial automation and control systems</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="fixed-height-card rounded-3 shadow-sm">
                            <img src="images/sector/sector2.webp" alt="Commercial">
                            <div class="card-overlay">
                                <h4 class="mb-1 text-white">Commercial</h4>
                                <p class="small mb-0">Office buildings and retail spaces</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="fixed-height-card rounded-3 shadow-sm">
                            <img src="images/sector/sector3.webp" alt="Energy">
                            <div class="card-overlay">
                                <h4 class="mb-1 text-white">Energy</h4>
                                <p class="small mb-0">Power generation and distribution</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="fixed-height-card rounded-3 shadow-sm">
                            <img src="images/sector/sector4.webp" alt="Infrastructure">
                            <div class="card-overlay">
                                <h4 class="mb-1 text-white">Infrastructure</h4>
                                <p class="small mb-0">Critical infrastructure projects</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="fixed-height-card rounded-3 shadow-sm">
                            <img src="images/sector/sector5.webp" alt="residential">
                            <div class="card-overlay">
                                <h4 class="mb-1 text-white">Residential</h4>
                                <p class="small mb-0">Residential electrical solutions and home automation</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="fixed-height-card rounded-3 shadow-sm">
                            <img src="images/sector/sector6.webp" alt="defence">
                            <div class="card-overlay">
                                <h4 class="mb-1 text-white">Defence</h4>
                                <p class="small mb-0">Military and defense electrical systems</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

    </div>
    </section>



    <section class="py-5" style="background: radial-gradient(circle, rgb(102 29 29) 0%, rgb(0 0 0) 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8 col-sm-12 text-white">
                    <h1 class="display-3 fw-bold text-white">Free 30 Minutes</h1>
                    <h2 class="mb-3  text-white">Consultation for Your Automation Needs</h2>
                    <p class="lead text-muted  text-white">Your Load, Our Logic.</p>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 text-lg-end text-md-end text-sm-start mt-3 mt-md-0">
                    <a href="https://subtech.in/contact" class="btn btn-lg fw-bold px-5 py-3 rounded-3"
                        style="background: linear-gradient(145deg, #ff4d4d, #cc0000); border: none; color: white;">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="footprint">
        <div class="container">

            <!-- Label + Heading -->
            <p class="section-label">Trusted Across India</p>
            <h2 class="section-heading">
                Our Footprint of<br><span>Reliable Installations</span>
            </h2>

            <!-- Stat Grid -->
            <div class="stat-grid">

                <div class="stat-cell">
                    <div class="stat-number">500<span class="stat-suffix">+</span></div>
                    <div class="stat-label">Active Clients</div>
                    <div class="stat-desc">Industries, institutions, and government bodies served.</div>
                </div>

                <div class="stat-cell">
                    <div class="stat-number">28<span class="stat-suffix">+</span></div>
                    <div class="stat-label">States Covered</div>
                    <div class="stat-desc">Pan-India presence through a trained dealer network.</div>
                </div>

                <div class="stat-cell">
                    <div class="stat-number">99<span class="stat-suffix">+</span></div>
                    <div class="stat-label">Cities</div>
                    <div class="stat-desc">Serviceable locations backed by local support teams.</div>
                </div>

                <div class="stat-cell">
                    <div class="stat-number">25<span class="stat-suffix">+</span></div>
                    <div class="stat-label">Years in Industry</div>
                    <div class="stat-desc">Since 1998 — built on engineering reliability.</div>
                </div>

            </div>

            <!-- Sector Tags -->
            <div class="sector-row">
                <span class="sector-label-text">Sectors &nbsp;—</span>
                <span class="sector-tag">Manufacturing</span>
                <span class="sector-tag">Infrastructure</span>
                <span class="sector-tag">Commercial</span>
                <span class="sector-tag">Industrial</span>
                <span class="sector-tag">Government / PSU</span>
                <span class="sector-tag">Defence</span>
                <span class="sector-tag">Energy & Utilities</span>
            </div>
        </div>
    </section>






    <!-- Testimonial Section - Card Style with Swiper -->
    <?php
    /**
     * Subtech Testimonials Component - Card Style Design
     * Multiple cards visible with swiper functionality
     */

    // Testimonials data array
    $testimonials = [
        [
            'name' => 'Mr. Rakesh P. Seth',
            'designation' => 'Astt. General Manager',
            'company' => 'Honda Power India',
            'rating' => 5,
            'icon' => 'images/Shiva.png',
            'text' => 'We have been recommending Subtech AMF & Changeover Panels with Honda generators. The performance has been outstanding, smooth changeover, robust build quality, and seamless integration. Subtech has delivered a reliable and efficient solution for both residential and commercial applications.'
        ],
        [
            'name' => 'Executive Officer',
            'designation' => '',
            'company' => 'Nagar Palika Parishad, Atrauli (Aligarh)',
            'rating' => 5,
            'icon' => 'images/aligarh.png',
            'text' => 'We were searching for a high-quality Motor Starter Panel. Subtech\'s 40 HP Star-Delta panel performed far better than those from companies we used earlier. Installation was smooth, performance is excellent, and since installation, with zero complaints so far.'
        ],
        [
            'name' => 'Rajiv Kumar Sharma',
            'designation' => 'University Engineer',
            'company' => 'Aligarh Muslim University',
            'rating' => 5,
            'icon' => 'images/AMU.png',
            'text' => 'We are satisfied with Subtech\'s DOL & Star-Delta starters installed across our university sites. They have been performing very well for the last three years with no complaints, supported by excellent after-sales service.'
        ],
        [
            'name' => 'Mr. Jik Chourasia',
            'designation' => 'Junior Warrant Officer',
            'company' => 'Indian Air Force, Bagdogra',
            'rating' => 5,
            'icon' => 'images/airforce.png',
            'text' => 'I appreciate Subtech\'s incredible work during the installation of a 50 kVA AMF Panel at Air Force Station Bagdogra. Their timely delivery, seamless installation, and commitment to quality make a remarkable difference.'
        ]
    ];


    /**
     * Function to generate star rating HTML
     */
    function generateStars($rating)
    {
        $html = '<div class="testimonial-stars">';
        for ($i = 0; $i < 5; $i++) {
            $html .= $i < $rating ? '<span class="star filled">★</span>' : '<span class="star">☆</span>';
        }
        $html .= '</div>';
        return $html;
    }
    ?>

    <style>
        /* Testimonial Card Section Styles */
        .testimonial-cards-section {
            padding: 60px 20px;
            background: linear-gradient(to bottom, #fff 0%, #fef5f5 100%);
        }

        .testimonial-cards-section .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 50px;
            color: #1a1a1a;
        }

        .brand-right img {
            width: 50px;
            height: auto;
            object-fit: contain;
        }

        .testimonial-cards-section .container {
            position: relative;
            padding-left: 70px;
            padding-right: 70px;
        }



        .testimonial-cards-container {
            max-width: 1400px;
            margin: 0 auto;
            overflow: hidden;
            position: static;
            /* ✅ changed from relative */
            padding: 0;
            /* ✅ removed 0 60px */
        }

        .testimonial-cards-wrapper {
            display: flex;
            gap: 30px;
            transition: transform 0.5s ease-in-out;
            padding: 10px 0;
        }

        /* Individual Testimonial Card - Matches your design */
        .testimonial-card-item {
            min-width: 380px;
            max-width: 420px;
            background: white;
            border: 2px solid #dc3545;
            border-radius: 15px;
            padding: 30px 25px;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            flex-shrink: 0;
        }

        .testimonial-card-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 30px rgba(220, 53, 69, 0.25);
            border-color: #c82333;
        }

        /* Client Header */
        .testimonial-card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .client-info-left {
            flex: 1;
        }

        .client-name-title {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0 0 5px 0;
        }

        .client-role {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6c757d;
            font-size: 0.7rem;
        }

        .role-icon {
            width: 16px;
            height: 16px;
            border: 1.5px solid #6c757d;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
        }

        /* Star Rating */
        .testimonial-stars {
            display: flex;
            gap: 4px;
            margin-bottom: 20px;
        }

        .testimonial-stars .star {
            color: #ddd;
            font-size: 1.4rem;
        }

        .testimonial-stars .star.filled {
            color: #dc3545;
        }

        /* Testimonial Text */
        .testimonial-card-text {
            font-size: 0.9rem;
            line-height: 1.7;
            color: #4a4a4a;
            margin: 0;
        }





        /* Navigation Arrows */
        .testimonial-nav-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: white;
            border: 2px solid #dc3545;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s ease;
            font-size: 1.5rem;
            color: #dc3545;
            font-weight: bold;
            box-shadow: 0 2px 10px rgba(220, 53, 69, 0.15);
        }

        .testimonial-nav-arrow:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 4px 20px rgba(220, 53, 69, 0.3);
        }

        .testimonial-nav-arrow.prev {
            left: 0;
        }

        .testimonial-nav-arrow.next {
            right: 0;
        }

        /* Dots Navigation */
        .testimonial-pagination {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 40px;
        }

        .testimonial-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #dee2e6;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .testimonial-dot:hover {
            background: #adb5bd;
        }

        .testimonial-dot.active {
            background: #dc3545;
            width: 35px;
            border-radius: 6px;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .testimonial-card-item {
                min-width: 350px;
                max-width: 380px;
            }
        }

        @media (max-width: 768px) {
            .testimonial-cards-section .section-title {
                font-size: 1.8rem;
            }

            .testimonial-cards-section .container {
                padding-left: 40px;
                padding-right: 40px;
            }

            .testimonial-cards-container {
                padding: 0;
                overflow: hidden;
            }

            .testimonial-cards-wrapper {
                gap: 15px;
            }

            .testimonial-card-item {
                min-width: calc(100% - 2px);
                max-width: 100%;
                padding: 22px 18px;
            }

            .testimonial-nav-arrow {
                width: 32px;
                height: 32px;
                font-size: 1rem;
            }

            .testimonial-nav-arrow.prev {
                left: 4px;
            }

            .testimonial-nav-arrow.next {
                right: 4px;
            }

            .client-name-title {
                font-size: 0.95rem;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .testimonial-card-text {
                font-size: 0.85rem;
            }
        }

        @media (max-width: 768px) {
            .testimonial-cards-section .container {
                padding-left: 50px;
                padding-right: 50px;
            }

            .testimonial-nav-arrow {
                width: 35px;
                /* ✅ smaller arrows */
                height: 35px;
                font-size: 1.1rem;
            }

            .testimonial-nav-arrow.prev {
                left: 5px;
            }

            .testimonial-nav-arrow.next {
                right: 5px;
            }

            .testimonial-card-item {
                min-width: 100%;
                max-width: 100%;
                padding: 20px 15px;
            }

            /* ✅ Stop name from wrapping */
            .client-name-title {
                font-size: 0.95rem;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }
    </style>

    <section class="testimonial-cards-section">
        <div class="container">
            <h2 class="section-title">What our customer Say's</h2>

            <!-- ✅ Arrows are NOW outside the overflow:hidden container -->
            <div class="testimonial-nav-arrow prev" onclick="moveTestimonialCards(-1)">‹</div>

            <div class="testimonial-cards-container">
                <div class="testimonial-cards-wrapper" id="testimonialCardsWrapper">
                    <?php foreach ($testimonials as $index => $testimonial): ?>
                        <div class="testimonial-card-item">
                            <div class="testimonial-card-header">
                                <div class="client-info-left">
                                    <h3 class="client-name-title">
                                        <?php echo htmlspecialchars($testimonial['name']); ?>,
                                    </h3>
                                    <?php if (!empty($testimonial['designation']) || !empty($testimonial['company'])): ?>
                                        <div class="client-role">
                                            <span class="role-icon">◉</span>
                                            <span>
                                                <?php
                                                if (!empty($testimonial['designation'])) {
                                                    echo htmlspecialchars($testimonial['designation']);
                                                    if (!empty($testimonial['company']))
                                                        echo ', ';
                                                }
                                                if (!empty($testimonial['company'])) {
                                                    echo htmlspecialchars($testimonial['company']);
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($testimonial['icon'])): ?>
                                    <div class="brand-right">
                                        <img src="<?= htmlspecialchars($testimonial['icon']); ?>" alt="brand logo">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php echo generateStars($testimonial['rating']); ?>
                            <p class="testimonial-card-text">
                                <?php echo htmlspecialchars($testimonial['text']); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>

                    <!-- Duplicate cards for infinite scroll -->
                    <?php foreach ($testimonials as $index => $testimonial): ?>
                        <div class="testimonial-card-item">
                            <div class="testimonial-card-header">
                                <div class="client-info-left">
                                    <h3 class="client-name-title">
                                        <?php echo htmlspecialchars($testimonial['name']); ?>,
                                    </h3>
                                    <?php if (!empty($testimonial['designation']) || !empty($testimonial['company'])): ?>
                                        <div class="client-role">
                                            <span class="role-icon">◉</span>
                                            <span>
                                                <?php
                                                if (!empty($testimonial['designation'])) {
                                                    echo htmlspecialchars($testimonial['designation']);
                                                    if (!empty($testimonial['company']))
                                                        echo ', ';
                                                }
                                                if (!empty($testimonial['company'])) {
                                                    echo htmlspecialchars($testimonial['company']);
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($testimonial['icon'])): ?>
                                    <div class="brand-right">
                                        <img src="<?= htmlspecialchars($testimonial['icon']); ?>" alt="brand logo">
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php echo generateStars($testimonial['rating']); ?>
                            <p class="testimonial-card-text">
                                <?php echo htmlspecialchars($testimonial['text']); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- ✅ Next arrow also outside -->
            <div class="testimonial-nav-arrow next" onclick="moveTestimonialCards(1)">›</div>

            <div class="testimonial-pagination" id="testimonialPagination">
                <?php for ($i = 0; $i < count($testimonials); $i++): ?>
                    <span class="testimonial-dot <?php echo $i === 0 ? 'active' : ''; ?>"
                        onclick="jumpToTestimonial(<?php echo $i; ?>)"></span>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <script>
        // Testimonial Cards Slider JavaScript
        let currentCardIndex = 0;
        const totalCards = <?php echo count($testimonials); ?>;
        const cardsWrapper = document.getElementById('testimonialCardsWrapper');
        const paginationDots = document.querySelectorAll('#testimonialPagination .testimonial-dot');

        // Calculate card width including gap
       function getCardWidth() {
    const card = document.querySelector('.testimonial-card-item');
    if (!card) return 400;
    const width = card.offsetWidth;
    const gap = window.innerWidth <= 768 ? 15 : 30;
    return width + gap;
}
        // Get number of cards to scroll
        function getScrollAmount() {
            // if (window.innerWidth <= 768) return 1;
            // if (window.innerWidth <= 1200) return 2;
            // return 3;
            return 1;
        }

        function updateCardsPosition() {
            const cardWidth = getCardWidth();
            const translateValue = -(currentCardIndex * cardWidth);

            // Remove transition temporarily when jumping
            if (currentCardIndex === 0 || currentCardIndex === totalCards - 1) {
                cardsWrapper.style.transition = 'none';
                setTimeout(() => {
                    cardsWrapper.style.transition = 'transform 0.4s ease';
                }, 50);
            }

            cardsWrapper.style.transform = `translateX(${translateValue}px)`;

            // Update pagination dots
            paginationDots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentCardIndex);
            });
        }

        function moveTestimonialCards(direction) {
            currentCardIndex += direction;

            // Infinite scroll - smooth loop
            if (currentCardIndex >= totalCards) {
                currentCardIndex = 0;
            } else if (currentCardIndex < 0) {
                currentCardIndex = totalCards - 1;
            }

            updateCardsPosition();
        }
        function jumpToTestimonial(index) {
            currentCardIndex = index;
            updateCardsPosition();
        }


        // Auto-play functionality
        let autoPlayInterval;

        function startAutoPlay() {
            autoPlayInterval = setInterval(() => {
                moveTestimonialCards(1);
            }, 5000); // Change slide every 5 seconds
        }

        function stopAutoPlay() {
            clearInterval(autoPlayInterval);
        }

        // Pause auto-play on hover
        const cardsContainer = document.querySelector('.testimonial-cards-container');
        if (cardsContainer) {
            cardsContainer.addEventListener('mouseenter', stopAutoPlay);
            cardsContainer.addEventListener('mouseleave', startAutoPlay);
        }

        // Start auto-play on page load
        startAutoPlay();

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') moveTestimonialCards(-1);
            if (e.key === 'ArrowRight') moveTestimonialCards(1);
        });

        // Touch/Swipe support
        let touchStartX = 0;
        let touchEndX = 0;

        if (cardsWrapper) {
            cardsWrapper.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });

            cardsWrapper.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                const swipeThreshold = 50;
                if (touchStartX - touchEndX > swipeThreshold) moveTestimonialCards(1);
                if (touchEndX - touchStartX > swipeThreshold) moveTestimonialCards(-1);
            }, { passive: true });
        }

        // Handle window resize
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                updateCardsPosition();
            }, 250);
        });
    </script>
    <!-- /Testimonial -->
    <!-- faq -->
    <style>
        .faq-container {
            max-width: 900px;
            margin: 0 auto;
            margin-top: 60px;
            background: #F8F9FA;
            border-radius: 12px;
            padding: 50px 40px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .faq-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .faq-label {
            color: #b22809e5;
            font-size: 36px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
        }

        .faq-title {
            font-size: 25px;
            color: #1a1a1a;
            margin-bottom: 16px;
            font-weight: 600;
        }

        .faq-subtitle {
            font-size: 15px;
            color: #6b7280;
            line-height: 1.6;
            max-width: 700px;
            margin: 0 auto;
        }

        .faq-list {
            margin-top: 40px;
        }

        .faq-item {
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 0;
        }

        .faq-item:last-child {
            border-bottom: none;
        }

        .faq-question {
            width: 100%;
            padding: 24px 0;
            background: none;
            border: none;
            text-align: left;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            transition: color 0.2s ease;
        }

        .faq-question:hover {
            color: #b22809e5;
        }

        .faq-icon {
            flex-shrink: 0;
            width: 24px;
            height: 24px;
            margin-left: 20px;
            transition: transform 0.3s ease;
            color: #9ca3af;
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
            color: #b22809e5;
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
            padding: 0;
        }

        .faq-item.active .faq-answer {
            max-height: 500px;
            padding-bottom: 24px;
        }

        .faq-answer-content {
            color: #4b5563;
            font-size: 16px;
            line-height: 1.7;
        }

        .contact-info {
            margin-top: 50px;
            padding-top: 40px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
        }

        .contact-btn {
            display: inline-block;
            padding: 14px 32px;
            background: #EF2E33;
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            border-radius: 25px;
            transition: background 0.2s ease, transform 0.2s ease;
            margin-top: 16px;
        }

        .contact-btn:hover {
            background: #080808;
            transform: translateY(-2px);
        }

        .contact-title {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 16px;
        }

        .contact-details {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
            color: #6b7280;
            font-size: 15px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .contact-item a {
            color: #b22809e5;
            text-decoration: none;
            font-weight: 500;
        }

        .contact-item a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .faq-container {
                padding: 30px 20px;
            }

            .faq-title {
                font-size: 28px;
            }

            .faq-subtitle {
                font-size: 16px;
            }

            .faq-question {
                font-size: 16px;
                padding: 20px 0;
            }

            .faq-answer-content {
                font-size: 15px;
            }

            .contact-details {
                flex-direction: column;
                gap: 12px;
            }


        }
    </style>
    <?php
    // FAQ data array
    $faqs = [
        [
            'question' => 'What is a motor starter and how does it work?',
            'answer' => 'A motor starter is a device that starts, stops, and protects an electric motor using a switching mechanism and overload/short-circuit protection. Subtech motor starters use PMC (Pre-Magnetic Contactor) technology, an advanced alternative to conventional contactors for enhanced protection and reliable operation.'
        ],
        [
            'question' => 'What are the different types of motor control panels?',
            'answer' => 'Common motor control types include DOL (Direct-On-Line), Star-Delta, Soft Starter, Auto-Transformer, and VFD-based systems. Subtech provides smart motor control panels using PMC technology for safer and more reliable switching in industrial and agricultural applications.'
        ],
        [
            'question' => 'Why do motors need protection and control systems?',
            'answer' => 'Motors need protection to reduce starting stress, prevent overheating/overcurrent damage, and protect wiring and equipment from abnormal conditions. Subtech PMC-based control systems improve protection reliability and help reduce motor failures.'
        ],
        [
            'question' => 'What is PMC technology in motor control?',
            'answer' => 'PMC (Pre-Magnetic Contactor) is Subtech\'s advanced switching/protection technology designed to improve reliability and protection compared to conventional contactor-based switching—delivering safer and more dependable motor control for industrial applications.'
        ],
        [
            'question' => 'Which motor control panel is best for my motor (DOL or Star-Delta)?',
            'answer' => 'For small motors (up to ~10–15 HP), a DOL panel is ideal. For higher HP motors (typically 10–50 HP), a Star-Delta panel is preferred to reduce starting current and improve motor safety. Both are available with Subtech\'s PMC technology.'
        ],
        [
            'question' => 'Can Subtech customize control panels as per site requirements?',
            'answer' => 'Yes. Subtech offers custom-built electrical control panels based on your motor HP, voltage, automation needs, protections, enclosure IP rating, and application. Contact us at HR@subtech.in or call 8383980781 for customized solutions.'
        ]
    ];
    ?>

    <div class="faq-container">
        <div class="faq-header">
            <div class="faq-label">FAQ's</div>
            <h1 class="faq-title">Looking for answer?</h1>
        </div>

        <div class="faq-list">
            <?php foreach ($faqs as $index => $faq): ?>
                <div class="faq-item" id="faq-<?php echo $index; ?>">
                    <button class="faq-question" onclick="toggleFAQ(<?php echo $index; ?>)">
                        <span><?php echo htmlspecialchars($faq['question']); ?></span>
                        <svg class="faq-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            <?php echo htmlspecialchars($faq['answer']); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="contact-info">
            <h3 class="contact-title">Still have questions?</h3>
            <a href="/subtech.in/contact" class="contact-btn">Contact Us</a>
        </div>
    </div>

    <script>
        function toggleFAQ(index) {
            const faqItem = document.getElementById('faq-' + index);
            const isActive = faqItem.classList.contains('active');

            // Close all FAQ items
            const allItems = document.querySelectorAll('.faq-item');
            allItems.forEach(item => item.classList.remove('active'));

            // Open clicked item if it wasn't active
            if (!isActive) {
                faqItem.classList.add('active');
            }
        }

        // Optional: Open first FAQ by default
        // document.getElementById('faq-0').classList.add('active');
    </script>
    <!-- faq -->











    <!-- Customer Care-->
    <div class="s-banner-colection flat-spacing-4">
        <div class="container">



            <div class="ss_care_inner">
                <div class="row">
                    <div class="col-md-6">
                        <div class="subtech_care_left">
                            <ul class="comp_care_list">
                                <li>
                                    <figure>
                                        <img data-src="images/category/shopping-cart.png"
                                            class=" ls-is-cached lazyloaded" alt="Buy Online icon "
                                            src="images/category/shopping-cart.png">
                                    </figure>
                                    Buy in store or online
                                </li>
                                <li>
                                    <figure>
                                        <img data-src="images/category/service.png" class=" ls-is-cached lazyloaded"
                                            src="images/category/service.png" alt="Service and Installation  icon">
                                    </figure>
                                    Service and Installation
                                </li>
                                <li>
                                    <figure>
                                        <img data-src="images/category/warranty-white.png"
                                            class=" ls-is-cached lazyloaded" alt="Product Warranty  icon"
                                            src="images/category/warranty-white.png">
                                    </figure>
                                    Product Warranty
                                </li>
                                <li>
                                    <figure>
                                        <img data-src="images/category/product-review.png"
                                            class=" ls-is-cached lazyloaded" alt=" Top Rated Products icon"
                                            src="images/category/product-review.png">
                                    </figure>

                                    Top Rated Products
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="subtech_care_right">
                            <h3 class="head_1 hide_mobile">Customer Care</h3>
                            <div class="form_box hide_mobile">
                                <h4>Get in touch</h4>
                                <p>Have a query about our services?</p>

                                <!-- Contact Forms -->
                                <div id="c5" style="">

                                    <div class="content-right">


                                        <div class="form-contact-wrap">
                                            <form method="post" class="form-default" id="cnt_form">
                                                <input type="hidden" name="_token" value="<?= $post_id; ?>" />
                                                <input type="hidden" name="method" value="Enquiry" />
                                                <div class="wrap">
                                                    <div class="cols">
                                                        <fieldset>
                                                            <label for="name">Your name*</label>
                                                            <input name="name" id="name" class="radius-8 name"
                                                                type="text" required>
                                                        </fieldset>
                                                        <fieldset>
                                                            <label for="email">Your Mobile*</label>
                                                            <input name="mobile" id="mob" class="radius-8" type="number"
                                                                maxlength="10" required>
                                                        </fieldset>
                                                    </div>

                                                    <div class="cols">
                                                        <fieldset>
                                                            <label for="name">Your Email*</label>
                                                            <input name="email" id="email" class="radius-8" type="email"
                                                                required>
                                                        </fieldset>
                                                    </div>

                                                    <div class="cols">
                                                        <fieldset class="textarea">
                                                            <label for="message">Message*</label>
                                                            <textarea name="message" id="message" required
                                                                class="radius-8"></textarea>
                                                        </fieldset>
                                                    </div>

                                                    <div class="cols">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                value="By clicking here, I state that I have read and agree to the Terms and Conditions."
                                                                required><label>
                                                                By clicking here, I state that I have read and agree to
                                                                the <a target="_blank"
                                                                    href="<?= BASE_PATH ?>term-and-condition"
                                                                    class="text-primary">Terms and Conditions</a>.
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="msg"></div>

                                                    <div class="button-submit send-wrap">
                                                        <button class="tf-btn animate-btn" type="submit">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="ss_care_linklist">
                    <ul>

                        <!-- Service Request -->
                        <li>
                            <a href="<?= BASE_PATH ?>customer-care">
                                <span class="care-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path
                                            d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
                                    </svg>
                                </span>
                                <span class="care-label">Service Request</span>
                                <span class="care-arrow">
                                    <svg viewBox="0 0 24 24">
                                        <line x1="7" y1="17" x2="17" y2="7" />
                                        <polyline points="7 7 17 7 17 17" />
                                    </svg>
                                </span>
                            </a>
                        </li>

                        <!-- For Warranty -->
                        <li>
                            <a href="<?= BASE_PATH ?>customer-care">
                                <span class="care-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                    </svg>
                                </span>
                                <span class="care-label">For Warranty</span>
                                <span class="care-arrow">
                                    <svg viewBox="0 0 24 24">
                                        <line x1="7" y1="17" x2="17" y2="7" />
                                        <polyline points="7 7 17 7 17 17" />
                                    </svg>
                                </span>
                            </a>
                        </li>

                        <!-- Contact Us -->
                        <li>
                            <a href="<?= BASE_PATH ?>contact">
                                <span class="care-icon">
                                    <svg viewBox="0 0 24 24">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.39 2 2 0 0 1 3.59 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.56a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 15.92z" />
                                    </svg>
                                </span>
                                <span class="care-label">Contact Us</span>
                                <span class="care-arrow">
                                    <svg viewBox="0 0 24 24">
                                        <line x1="7" y1="17" x2="17" y2="7" />
                                        <polyline points="7 7 17 7 17 17" />
                                    </svg>
                                </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

        </div>



    </div>
    </div>
    <!-- /About Us-->














    <!-- <section class="s-banner-colection banner-cls-petaccess">
        <div class="container">
            <div class="banner-content tf-grid-layout tf-col-2">
                <div class="image img-hv-overlay" style="    background: #fff;">
                    <img src="images/category/dealer.svg" alt="dealer" class=" ls-is-cached lazyloaded">
                </div>
                <div class="box-content text-center wow fadeInUp"
                    style="visibility: visible; animation-name: fadeInUp;">
                    <div class="box-title-banner">
                        <p class="sub text-lg">
                            Find your
                        </p>
                        <h4 class="title display-md font-5 text-primary fw-bold">
                            Nearest Dealer
                        </h4>

                        <form action="" accept-charset="utf-8" class="form-login">
                            <div>
                                <fieldset class=" mb_12">
                                    <select class="form-select">
                                        <option value="">Dealer Type</option>
                                        <option value="Ply dealer">Electrical Panel </option>
                                        <option value="NAP dealer">Motor Stator</option>
                                    </select>
                                </fieldset>

                                <fieldset class=" mb_12">
                                    <select class="form-select">
                                        <option value="">Select a State</option>
                                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                        <option value="Assam">Assam</option>
                                        <option value="Bihar">Bihar</option>
                                        <option value="Chhattisgarh">Chhattisgarh</option>
                                        <option value="Delhi">Delhi</option>
                                        <option value="Goa">Goa</option>
                                        <option value="Gujarat">Gujarat</option>
                                        <option value="Haryana">Haryana</option>
                                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                                        <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                        <option value="Jharkhand">Jharkhand</option>
                                        <option value="Karnataka">Karnataka</option>
                                        <option value="Kerala">Kerala</option>
                                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                                        <option value="Maharashtra">Maharashtra</option>
                                        <option value="Meghalaya">Meghalaya</option>
                                        <option value="Mizoram">Mizoram</option>
                                        <option value="Odisha">Odisha</option>
                                        <option value="Punjab">Punjab</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                        <option value="Sikkim">Sikkim</option>
                                        <option value="Tamil Nadu">Tamil Nadu</option>
                                        <option value="Telangana">Telangana</option>
                                        <option value="Tripura">Tripura</option>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                        <option value="Uttarakhand">Uttarakhand</option>
                                        <option value="West Bengal">West Bengal</option>
                                    </select>
                                </fieldset>

                                <fieldset class=" mb_12">
                                    <input type="text" class="" placeholder="Type Your Pincode" required="">
                                </fieldset>



                            </div>
                            <div class="box-btn-banner">
                                <a href="" class="tf-btn animate-btn btn-dark2"><i class="icon icon-arrow-top-left"></i>
                                    Find Now</a>
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>
    </section> -->







    <!-- Brand 
        <div class="flat-spacing-2 fade-edge">
            <div class="container">
                    <div class="flat-title wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                   <h2 class="title">Trusted by leading companies across industries</h2>
                    
                    
                </div>
                
                <div class="infiniteslide tf-brand" data-clone="2" data-style="left" data-speed="80">
                    <div class="brand-item">
                        <img src="images/brand/4.png" alt="Brand1">
                    </div>
                    <div class="brand-item">
                        <img src="images/brand/5.png" alt="Brand1">
                    </div>
                    <div class="brand-item">
                        <img src="images/brand/6.png" alt="Brand1">
                    </div>
                    <div class="brand-item">
                        <img src="images/brand/7.png" alt="Brand1">
                    </div>
                    <div class="brand-item">
                         <img src="images/brand/8.png" alt="Brand1">
                    </div>
                    <div class="brand-item">
                         <img src="images/brand/9.png" alt="Brand1">
                    </div>
                     <div class="brand-item">
                         <img src="images/brand/10.png" alt="Brand1">
                    </div>
                </div>
            </div>
        </div>
        <!-- /Brand -->







    <?php include_once "config/footer.php"; ?>








    </div>




    <?php include_once "config/foot.php"; ?>






    <script>
        $(document).ready(function () {
            $("body").on("keypress", ".name", function (e) {
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

            $("body").on("submit", "#cnt_form", function (e) {
                e.preventDefault();
                var mob = $("#mob").val().trim();
                //alert(mob);
                if (mob && !validateMobileNumber(mob)) {
                    $("#msg").html("<span class='alert alert-danger'>Enter Valid Mobile Number</span>");
                    $("#mob").focus();
                    setTimeout(function () { $("#msg").html(""); }, 2500);
                    return false;
                }
                $("#btnSubmit").attr("disabled", true).html("Wait...");
                $.ajax({
                    url: '<?php echo BASE_PATH; ?>Controller/Master/',
                    type: 'post',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#btnSubmit").attr("disabled", false).html("Submit");
                        var response = (JSON.parse(data));
                        if (response.type == "success") {
                            $("#msg").html(response.message);
                            setTimeout(function () { window.location.reload(); }, 2500);
                        } else {
                            $("#msg").html(response.message);
                        }
                    }

                });
            });

        });
    </script>
    <script>
        const glowSections = document.querySelectorAll('.yellow-glow');

        glowSections.forEach(section => {
            section.addEventListener('mouseenter', () => {
                section.classList.add('active');
            });

            section.addEventListener('mouseleave', () => {
                section.classList.remove('active');
            });

            section.addEventListener('mousemove', (e) => {
                const rect = section.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                section.style.setProperty('--mouse-x', x + 'px');
                section.style.setProperty('--mouse-y', y + 'px');
            });
        });
    </script>











</body>


</html>