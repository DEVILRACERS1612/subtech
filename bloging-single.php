<?php
include_once "./config/config.inc.php";
$url = $_GET['url'];
if ($url) {
    $qr = $db->query("select a.*, b.cat_name,b.urlname as cat_url, count(c.id) as cmt from mi_blogs a left join mi_bcat b on a.cat_id=b.id left join mi_comment c on c.blog_id=a.id where a.urlname=? and a.mi_status='Yes' order by a.id desc limit 1", [$url]);
    if ($qr->num_rows) {
        $row = $qr->fetch_assoc();
    } else {
        header('Refresh:1;url=' . BASE_PATH);
    }
} else {
    header('Refresh:1;url=' . BASE_PATH);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8">
    <title><?= $row['title'] ?> | Subtech</title>
    <meta name="title" content="<?= $row['mtitle'] ?>">
    <meta name="description" content="<?= $row['mdes'] ?>">
    <meta property="og:type" content="Website">
    <meta name="og:title" content="<?= $row['mtitle'] ?>">
    <meta name="og:description" content="<?= $row['mdes'] ?>">
    <meta property="og:image:width" content="250">
    <meta property="og:image:height" content="250">
    <meta name="og:site_name" content="www.subtech.in">
    <meta property="og:url" content="https://subtech.in/blog/<?= $row['urlname'] ?>">
    <meta name="og:image" content="https://subtech.in/images/blog_img/<?= $row['image'] ?>">
    <meta property="og:image:url" content="https://subtech.in/images/blog_img/<?= $row['image'] ?>">
    <meta name="robots" content="ALL">
    <meta name="revisit-after" content="7 days">
    <meta name="generator" content="Subtech - SS Power System">
    <meta name="author" content="Subtech - SS Power System">
    <meta name="publisher" content="Subtech - SS Power System">
    <link rel="canonical" href="https://subtech.in/blog/<?= $row['urlname'] ?>">

    <?php include_once "config/head.php"; ?>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Instrument+Serif:ital@0;1&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet"/>

    <style>
        :root {
            --red: #EF2E33;
            --red-dark: #c9232a;
            --red-light: #fdeaeb;
            --red-glow: rgba(239, 46, 51, 0.12);
            --black: #0d0d0d;
            --black-soft: #1a1a1a;
            --gray-900: #222222;
            --gray-700: #444444;
            --gray-500: #777777;
            --gray-400: #999999;
            --gray-300: #c4c4c4;
            --gray-200: #e2e2e2;
            --gray-100: #f0f0f0;
            --gray-50: #f7f7f7;
            --white: #ffffff;
            --max-w: 740px;
            --radius: 12px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 20px rgba(0,0,0,0.07);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family:  'DM Sans', sans-serif;
            background: var(--white);
            color: var(--black);
            line-height: 1.7;
            font-size: 16px;
            -webkit-font-smoothing: antialiased;
        }

        ::selection { background: var(--red-light); color: var(--red); }

        /* ══════════════════════════════════════
           READING PROGRESS BAR
           ══════════════════════════════════════ */
        .reading-progress {
            position: fixed;
            top: 0; left: 0;
            height: 3px;
            background: var(--red);
            width: 0%;
            z-index: 9999;
            transition: width 0.08s linear;
            pointer-events: none;
        }

        /* ══════════════════════════════════════
           BREADCRUMB
           ══════════════════════════════════════ */
        .s-breadcrumb {
            max-width: 900px;
            margin: 28px auto 0;
            padding: 0 40px;
            font-size: 12px;
            font-weight: 500;
            color: var(--gray-400);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .s-breadcrumb a {
            color: var(--gray-400);
            text-decoration: none;
            transition: color 0.2s;
        }
        .s-breadcrumb a:hover { color: var(--red); }
        .s-breadcrumb span { color: var(--gray-300); font-size: 10px; }
        .s-breadcrumb .bc-current { color: var(--gray-700); }

        /* ══════════════════════════════════════
           MAIN SECTION
           ══════════════════════════════════════ */
        .s-blog-single { padding: 28px 0 80px; }

        article {
            max-width: var(--max-w);
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ══════════════════════════════════════
           POST META (Category + Date + Read Time)
           ══════════════════════════════════════ */
        .post-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .cat-tag {
            background: var(--red);
            color: var(--white);
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 6px;
            text-decoration: none;
            transition: background 0.2s;
        }
        .cat-tag:hover { background: var(--red-dark); color: var(--white); }
        .post-date, .read-time {
            font-size: 13px;
            color: var(--gray-400);
            font-weight: 500;
        }
        .dot { color: var(--gray-300); }

        /* ══════════════════════════════════════
           TITLE
           ══════════════════════════════════════ */
        h1.entry_title {
            font-family:  'DM Serif Display', serif;
            font-size: clamp(28px, 5vw, 42px);
            line-height: 1.18;
            color: var(--black);
            margin-bottom: 20px;
            font-weight: 400;
            letter-spacing: -0.02em;
        }

        /* ══════════════════════════════════════
           BYLINE (Author + Date + Comments)
           ══════════════════════════════════════ */
        .entry-meta {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            list-style: none;
            margin-bottom: 0;
            padding: 0;
        }
        .entry-meta li {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .entry-meta .avatar img {
            width: 34px; height: 34px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--gray-100);
        }
        .entry-meta .entry_name {
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            padding: 4px 14px;
            font-size: 13px;
            color: var(--gray-500);
            margin: 0;
            font-weight: 500;
        }
        .entry-meta .entry_name span {
            font-weight: 700;
            color: var(--black);
        }
        .entry-meta .entry_date,
        .entry-meta .entry_comment {
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            padding: 4px 14px;
            font-size: 13px;
            color: var(--gray-500);
            margin: 0;
            font-weight: 500;
        }
        .entry-meta .br-line {
            width: 1px; height: 16px;
            background: var(--gray-200);
            display: inline-block;
        }

        /* ══════════════════════════════════════
           SHARE BAR
           ══════════════════════════════════════ */
        .share-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 16px 0;
            border-top: 1px solid var(--gray-200);
            border-bottom: 1px solid var(--gray-200);
            margin: 22px 0 36px;
            flex-wrap: wrap;
        }
        .share-label {
            font-size: 11px;
            color: var(--gray-400);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-right: 4px;
        }
        .share-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--gray-500);
            background: var(--white);
            border: 1.5px solid var(--gray-200);
            padding: 6px 16px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-family: 'Plus Jakarta Sans', 'DM Sans', sans-serif;
            transition: all 0.2s;
        }
        .share-btn:hover {
            border-color: var(--red);
            color: var(--red);
            background: var(--red-light);
        }
        .share-btn svg {
            width: 14px;
            height: 14px;
            fill: currentColor;
            flex-shrink: 0;
        }

        /* ══════════════════════════════════════
           HERO IMAGE
           ══════════════════════════════════════ */
        .entry_image { margin-bottom: 40px; }
        .entry_image img {
            width: 100%;
            border-radius: var(--radius);
            display: block;
            border: 1px solid var(--gray-200);
            object-fit: cover;
            aspect-ratio: 2 / 1;
        }

        /* ══════════════════════════════════════
           BLOG BODY CONTENT
           ══════════════════════════════════════ */
        .text {
            font-size: 17px;
            color: var(--gray-700);
            line-height: 1.85;
            margin-bottom: 24px;
            display: block;
        }

        /* Style content rendered from DB (inline HTML from CKEditor etc.) */
        .text h2, .text h3, .text h4 {
            font-family: 'Instrument Serif', 'DM Serif Display', serif;
            color: var(--black);
            margin: 2.2rem 0 0.8rem;
            font-weight: 400;
            line-height: 1.25;
        }
        .text h2 { font-size: 1.75rem; letter-spacing: -0.01em; }
        .text h3 { font-size: 1.35rem; }
        .text h4 { font-size: 1.1rem; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; }

        .text p { margin-bottom: 1.4rem; }

        .text a {
            color: var(--red);
            text-decoration: underline;
            text-underline-offset: 3px;
            text-decoration-color: rgba(239,46,51,0.3);
            transition: text-decoration-color 0.2s;
        }
        .text a:hover { text-decoration-color: var(--red); }

        .text strong, .text b { font-weight: 700; color: var(--black); }

        .text img {
            max-width: 100%;
            border-radius: var(--radius);
            border: 1px solid var(--gray-200);
            margin: 1.5rem 0;
            display: block;
        }

        .text ul, .text ol {
            margin: 1rem 0 1.5rem 1.4rem;
        }
        .text li {
            margin-bottom: 0.4rem;
            line-height: 1.8;
            color: var(--gray-700);
        }
        .text li::marker { color: var(--red); font-weight: 700; }

        .text blockquote {
            margin: 2rem 0;
            padding: 24px 28px;
            border-left: 4px solid var(--red);
            background: var(--gray-50);
            border-radius: 0 var(--radius) var(--radius) 0;
            font-family: 'Instrument Serif', serif;
            font-style: italic;
            font-size: 1.1rem;
            color: var(--black);
            line-height: 1.7;
            position: relative;
        }
        .text blockquote::before {
            content: '\201C';
            position: absolute;
            top: 8px; left: 12px;
            font-size: 2.5rem;
            color: var(--red);
            opacity: 0.15;
            line-height: 1;
            font-style: normal;
        }

        .text pre, .text code {
            font-family: 'JetBrains Mono', monospace;
        }
        .text code {
            font-size: 0.85em;
            background: var(--gray-100);
            padding: 2px 7px;
            border-radius: 4px;
            color: var(--red);
        }
        .text pre {
            background: var(--black-soft);
            color: #e0e0e0;
            padding: 24px;
            border-radius: var(--radius);
            overflow-x: auto;
            margin: 1.5rem 0;
            font-size: 0.82rem;
            line-height: 1.7;
            border: 1px solid var(--gray-200);
        }
        .text pre code {
            background: none;
            color: inherit;
            padding: 0;
            border-radius: 0;
        }

        .text table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            font-size: 0.9rem;
        }
        .text table th {
            background: var(--black);
            color: var(--white);
            padding: 10px 14px;
            text-align: left;
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 0.03em;
        }
        .text table td {
            padding: 10px 14px;
            border-bottom: 1px solid var(--gray-200);
            color: var(--gray-700);
        }
        .text table tr:hover td { background: var(--gray-50); }

        .text hr {
            border: none;
            height: 1px;
            background: var(--gray-200);
            margin: 2.5rem 0;
            position: relative;
        }
        .text hr::after {
            content: '';
            position: absolute;
            top: -3px; left: 50%;
            transform: translateX(-50%);
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--red);
        }

        /* ══════════════════════════════════════
           TAGS
           ══════════════════════════════════════ */
        .entry-tag {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin: 40px 0 28px;
            padding-top: 28px;
            border-top: 1px solid var(--gray-200);
        }
        .entry-tag p {
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--gray-400);
            margin: 0;
        }
        .entry-tag .style-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            list-style: none;
            padding: 0;
        }
        .entry-tag .style-list li a {
            background: var(--white);
            color: var(--gray-500);
            border: 1.5px solid var(--gray-200);
            padding: 5px 16px;
            border-radius: 8px;
            font-size: 12.5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }
        .entry-tag .style-list li a:hover {
            background: var(--red-light);
            color: var(--red);
            border-color: var(--red);
        }

        /* ══════════════════════════════════════
           PREV / NEXT NAVIGATION
           ══════════════════════════════════════ */
        .related-post {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 56px;
        }
        .related-post a {
            flex: 1;
            padding: 20px 22px;
            background: var(--white);
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius);
            text-decoration: none;
            color: var(--black);
            transition: all 0.25s;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .related-post a:hover {
            border-color: var(--red);
            background: var(--red-light);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }
        .related-post a .text-wrap-left p:first-child,
        .related-post a .text-wrap-right p:first-child {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--red);
            margin-bottom: 6px;
        }
        .related-post a .name-post {
            font-size: 14px;
            font-weight: 700;
            color: var(--black);
            line-height: 1.4;
            margin: 0;
        }
        .related-post a.next {
            justify-content: flex-end;
            text-align: right;
        }
        .related-post .icon {
            color: var(--red);
            font-size: 20px;
            flex-shrink: 0;
            opacity: 0.6;
            transition: opacity 0.2s;
        }
        .related-post a:hover .icon { opacity: 1; }

        /* ══════════════════════════════════════
           COMMENT FORM
           ══════════════════════════════════════ */
        .modern-comment {
            padding: 44px;
            background: var(--gray-50);
            border-radius: 16px;
            border: 1px solid var(--gray-200);
        }
        .comment-title {
            font-family: 'Instrument Serif', 'DM Serif Display', serif;
            font-size: 26px;
            font-weight: 400;
            margin-bottom: 28px;
            color: var(--black);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .comment-title::before {
            content: '';
            width: 4px; height: 28px;
            background: var(--red);
            border-radius: 2px;
            display: inline-block;
        }

        .form-modern { width: 100%; }

        .form-row {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
        }
        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 200px;
        }
        .form-group.full {
            width: 100%;
            flex: unset;
            margin-top: 16px;
        }
        .form-group label {
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 6px;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .form-group input,
        .form-group textarea {
            padding: 13px 16px;
            border: 1.5px solid var(--gray-200);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', 'DM Sans', sans-serif;
            transition: all 0.2s ease;
            background: var(--white);
            color: var(--black);
        }
        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: var(--gray-300);
        }
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--red);
            background: var(--white);
            outline: none;
            box-shadow: 0 0 0 3px var(--red-glow);
        }
        .notice-text {
            font-size: 12px;
            color: var(--gray-400);
            margin: 14px 0 22px;
        }
        .form-message {
            margin-bottom: 14px;
            font-size: 14px;
            font-weight: 500;
        }
        .form-submit button {
            background: var(--red);
            border: none;
            padding: 13px 32px;
            border-radius: 10px;
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all 0.2s ease;
            letter-spacing: 0.01em;
        }
        .form-submit button:hover {
            background: var(--red-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(239,46,51,0.25);
        }
        .form-submit button:active {
            transform: translateY(0);
        }

        /* ══════════════════════════════════════
           RESPONSIVE
           ══════════════════════════════════════ */
        @media (max-width: 768px) {
            .s-breadcrumb { padding: 0 20px; }
            article { padding: 0 16px; }
            .modern-comment { padding: 24px 20px; }
            .form-row { flex-direction: column; }
            .related-post { flex-direction: column; }
            .entry_image img { aspect-ratio: 16/9; }
        }
        @media (max-width: 480px) {
            .entry-meta { gap: 6px; }
            .share-bar { gap: 6px; }
            h1.entry_title { font-size: 26px; }
        }
    </style>
</head>
<body>

    <!-- READING PROGRESS -->
    <div class="reading-progress" id="readingProgress"></div>

    <?php include_once "config/header-top.php"; ?>

    <div id="wrapper">

        <?php include_once "config/header.php"; ?>

        <!-- BREADCRUMB -->
        <div class="s-breadcrumb">
            <a href="<?= BASE_PATH ?>">Home</a>
            <span>›</span>
            <a href="<?= BASE_PATH ?>blogs">Blog</a>
            <span>›</span>
            <a href="<?= BASE_PATH ?>blogs/<?= $row['cat_url'] ?>"><?= $row['cat_name'] ?></a>
            <span>›</span>
            <span class="bc-current"><?= $row['title'] ?></span>
        </div>

        <section class="s-blog-single line-bottom-container">
            <div class="container">
                <article>

                    <!-- POST META -->
                    <div class="post-meta">
                        <a href="<?= BASE_PATH ?>blogs/<?= $row['cat_url'] ?>" class="cat-tag">
                            <?= $row['cat_name'] ?>
                        </a>
                        <span class="dot">·</span>
                        <span class="post-date"><?= date("F d, Y", strtotime($row['dop'])) ?></span>
                        <span class="dot">·</span>
                        <span class="read-time">6 min read</span>
                    </div>

                    <!-- TITLE -->
                    <h1 class="entry_title display-sm fw-medium">
                        <?= $row['title'] ?>
                    </h1>

                    <!-- BYLINE -->
                    <ul class="entry-meta">
                        <li class="entry_author">
                            <div class="avatar">
                                <img src="<?= BASE_PATH ?>images/avatar/blog-author-1.jpg"
                                     data-src="<?= BASE_PATH ?>images/avatar/blog-author-1.jpg"
                                     alt="avatar" class="ls-is-cached lazyloaded">
                            </div>
                            <p class="entry_name text-md">
                                Post by <span class="fw-medium"><?= $row['author'] ?></span>
                            </p>
                        </li>
                        <li class="br-line"></li>
                        <li class="entry_date">
                            <p class="text-md"><?= date("M d Y", strtotime($row['dop'])) ?></p>
                        </li>
                        <li class="br-line"></li>
                        <li class="entry_comment">
                            <p class="text-md"><?= $row['cmt'] ?> comments</p>
                        </li>
                    </ul>

                    <!-- SHARE BAR -->
                    <div class="share-bar">
                        <span class="share-label">Share</span>

                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=https://subtech.in/blog/<?= $row['urlname'] ?>"
                           target="_blank" rel="noopener" class="share-btn">
                            <svg viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            LinkedIn
                        </a>

                        <a href="https://wa.me/?text=<?= urlencode($row['title'] . ' https://subtech.in/blog/' . $row['urlname']) ?>"
                           target="_blank" rel="noopener" class="share-btn">
                            <svg viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            WhatsApp
                        </a>

                        <a href="https://twitter.com/intent/tweet?url=https://subtech.in/blog/<?= $row['urlname'] ?>&text=<?= urlencode($row['title']) ?>"
                           target="_blank" rel="noopener" class="share-btn">
                            <svg viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            X
                        </a>

                        <button class="share-btn" id="copyLinkBtn"
                                onclick="navigator.clipboard.writeText(window.location.href).then(()=>{this.innerHTML='<svg viewBox=\'0 0 24 24\' width=\'14\' height=\'14\' fill=\'currentColor\'><path d=\'M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z\'/></svg> Copied!';setTimeout(()=>{this.innerHTML='<svg viewBox=\'0 0 24 24\' width=\'14\' height=\'14\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\'><path d=\'M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71\'/><path d=\'M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71\'/></svg> Copy Link'},2000)})">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg>
                            Copy Link
                        </button>
                    </div>

                    <!-- HERO IMAGE -->
                    <div class="entry_image">
                        <img src="<?= BASE_PATH ?>images/blog_img/<?= $row['image'] ?>"
                             data-src="<?= BASE_PATH ?>images/blog_img/<?= $row['image'] ?>"
                             alt="<?= $row['alttext'] ?>"
                             class="ls-is-cached lazyloaded">
                    </div>

                    <!-- BLOG CONTENT -->
                    <div class="text">
                        <?= $row['blogs'] ?>
                    </div>

                    <!-- TAGS -->
                    <div class="bot mt-4">
                        <div class="entry-tag">
                            <p>Tags</p>
                            <ul class="style-list">
                                <?php
                                $tags = explode(",", $row['mtags']);
                                foreach ($tags as $tag) {
                                    echo '<li><a href="' . BASE_PATH . 'tblogs/' . str_replace(" ", "-", $tag) . '">' . trim($tag) . '</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <!-- PREV / NEXT -->
                    <div class="related-post">
                        <?php
                        $pqr = $db->query("select urlname,title from mi_blogs where id < ? and mi_status='Yes' order by id desc limit 1", [$row['id']]);
                        if ($pqr->num_rows) {
                            $prow = $pqr->fetch_assoc();
                        ?>
                            <a href="<?= BASE_PATH ?>blog/<?= $prow['urlname'] ?>" class="post prev">
                                <div class="icon"><i class="icon-arr-left"></i></div>
                                <div class="text-wrap-left">
                                    <p>PREVIOUS POST</p>
                                    <p class="name-post"><?= $prow['title'] ?></p>
                                </div>
                            </a>
                        <?php } ?>

                        <?php
                        $nqr = $db->query("select urlname,title from mi_blogs where id > ? and mi_status='Yes' order by id asc limit 1", [$row['id']]);
                        if ($nqr->num_rows) {
                            $nrow = $nqr->fetch_assoc();
                        ?>
                            <a href="<?= BASE_PATH ?>blog/<?= $nrow['urlname'] ?>" class="post next">
                                <div class="text-wrap-right">
                                    <p>NEXT POST</p>
                                    <p class="name-post"><?= $nrow['title'] ?></p>
                                </div>
                                <div class="icon"><i class="icon-arr-right2"></i></div>
                            </a>
                        <?php } ?>
                    </div>

                    <!-- COMMENT FORM -->
                    <div class="modern-comment">
                        <h3 class="comment-title">Leave a Comment</h3>

                        <form action="#" id="cmt_form" class="form-modern">
                            <input type="hidden" name="_token" value="<?= $post_id ?>" />
                            <input type="hidden" name="blog_id" value="<?= $row['id'] ?>" />
                            <input type="hidden" name="method" value="Comment" />

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="username">Your Name *</label>
                                    <input id="username" type="text" name="fname" required placeholder="e.g. Rajesh Kumar">
                                </div>
                                <div class="form-group">
                                    <label for="email">Your Email *</label>
                                    <input id="email" type="email" name="email" required placeholder="you@company.com">
                                </div>
                            </div>

                            <div class="form-group full">
                                <label for="mess">Your Comment *</label>
                                <textarea id="mess" name="message" rows="5" required placeholder="Write your comment here…"></textarea>
                            </div>

                            <p class="notice-text">Your email address will not be published.</p>

                            <div id="cmt_error" class="form-message"></div>

                            <div class="form-submit">
                                <button id="btnSubmit" type="submit">Post Comment</button>
                            </div>
                        </form>
                    </div>

                </article>
            </div>
        </section>

        <?php include_once "config/footer.php"; ?>

    </div>

    <?php include_once "config/mobile_menu.php"; ?>
    <?php include_once "config/foot.php"; ?>

    <!-- READING PROGRESS + COMMENT FORM SCRIPT -->
    <script>
        // Reading progress bar
        window.addEventListener('scroll', function () {
            var h = document.documentElement.scrollHeight - window.innerHeight;
            var pct = h > 0 ? (window.scrollY / h) * 100 : 0;
            document.getElementById('readingProgress').style.width = pct + '%';
        });

        // Comment form AJAX
        $(document).ready(function () {
            $("#cmt_form").on("submit", function (e) {
                e.preventDefault();
                $("#btnSubmit").html("Sending, wait...").attr("disabled", true);
                $.ajax({
                    url: '<?php echo BASE_PATH; ?>Controller/Master/',
                    type: 'post',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        var response = (JSON.parse(data));
                        $("#cmt_error").html(response.message);
                        if (response.type == "success") {
                            $("#cmt_form").trigger("reset");
                            setTimeout(function () {
                                $("#cmt_error").html("");
                                $("#btnSubmit").html("Post Comment").attr("disabled", false);
                            }, 2500);
                        } else {
                            $("#btnSubmit").html("Post Comment").attr("disabled", false);
                        }
                    }
                });
            });
        });
    </script>

</body>
</html>