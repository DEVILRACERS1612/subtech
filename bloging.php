<?php
include_once "./config/config.inc.php";

$cat = isset($_GET['cat']) ? $_GET['cat'] : "";
$tag = isset($_GET['tag']) ? str_replace("-", " ", $_GET['tag']) : "";
$search = isset($_GET['s']) ? trim($_GET['s']) : "";

// Function to truncate text
function truncate_text($text, $limit = 150)
{
  $text = strip_tags($text);
  if (strlen($text) > $limit) {
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, ' '));
    $text .= '...';
  }
  return $text;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
  <meta charset="utf-8">
  <title>Latest Blog Posts on Technology & Automation | Subtech</title>
  <meta name="title" content="Latest Blog Posts on Technology & Automation | Subtech">
  <meta name="description"
    content="Explore expert insights and updates from Subtech – a leading manufacturer of Motor Stators, AMF Panels, and LT Panels. Stay informed on the latest in power control solutions.">
  <meta property="og:type" content="Website">
  <meta name="og:title" content="Latest Blog Posts on Technology & Automation | Subtech">
  <meta name="og:description"
    content="Explore expert insights and updates from Subtech – a leading manufacturer of Motor Stators, AMF Panels, and LT Panels. Stay informed on the latest in power control solutions.">
  <meta property="og:image:width" content="250">
  <meta property="og:image:height" content="250">
  <meta name="og:site_name" content="www.subtech.in">
  <meta property="og:url" content="https://subtech.in/blogs/">
  <meta name="og:image" content="https://subtech.in/images/subtech.jpg">
  <meta property="og:image:url" content="https://subtech.in/images/subtech.jpg">
  <meta name="robots" content="ALL">
  <meta name="revisit-after" content="7 days">
  <meta name="generator" content="Subtech - SS Power System">
  <meta name="author" content="Subtech - SS Power System">
  <meta name="publisher" content="Subtech - SS Power System">
  <link rel="canonical" href="https://subtech.in/blogs/">

  <?php include_once "config/head.php"; ?>

  <style>
    /* Blog Header Section */
    .blog-header-section {
      padding: 80px 0 60px;
      text-align: center;
      border-bottom: 1px solid #dee2e6;
    }

    .blog-main-title {
      font-size: 2.75rem;
      font-weight: 700;
      color: #1a1a1a;
      margin-bottom: 16px;
      line-height: 1.2;
    }

    .blog-subtitle {
      font-size: 1.1rem;
      color: #0e0e0f;
      max-width: 700px;
      margin: 0 auto;
      line-height: 1.6;
    }

    /* Category Filter Buttons */
    .category-filter-section {
      padding: 40px 0;
      background: #ffffff;
      border-bottom: 1px solid #e9ecef;
    }

    .filter-buttons {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 12px;
    }

    .filter-btn {
      padding: 12px 28px;
      border-radius: 30px;
      border: 2px solid #e9ecef;
      background: #ffffff;
      color: #495057;
      font-size: 0.95rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .filter-btn:hover {
      border-color: #e93132;
      color: #e93132;
      background: #fff5f5;
      transform: translateY(-2px);
    }

    .filter-btn.active {
      background: #1a1a1a;
      color: #ffffff;
      border-color: #1a1a1a;
    }

    .filter-btn.active:hover {
      background: #2a2a2a;
      border-color: #2a2a2a;
      color: #ffffff;
    }

    /* ===== Search Icon Trigger ===== */
    .blogTopSearchBtn {
      display: flex;
      justify-content: center;
      margin-top: 18px;
    }

    .blogSearchTrigger {
      width: 56px;
      height: 56px;
      border-radius: 50px;
      border: 1px solid #e9ecef;
      background: #0e0e0f;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all .2s ease;
      outline: none !important;
      box-shadow: none !important;
      -webkit-appearance: none;
      appearance: none;
      padding: 0;
    }

    .blogSearchTriggerBg {
      background-image: url("<?= BASE_PATH ?>images/brand/searchfinal.png");
      background-repeat: no-repeat;
      background-position: center;
      background-size: 25px 25px;
    }

    .blogSearchTrigger:hover {
      transform: translateY(-2px);
      border-color: #e93132;
    }

    .blogSearchTrigger:focus,
    .blogSearchTrigger:active {
      outline: none !important;
      box-shadow: none !important;
    }

    /* ===== Search Modal Overlay ===== */
    .blogSearchModal {
      position: fixed;
      inset: 0;
      z-index: 99999;
      display: none;
    }

    .blogSearchModal.isOpen {
      display: block;
    }

    .blogSearchBackdrop {
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.75);
    }

    .blogSearchBox {
      position: relative;
      width: min(1100px, calc(100% - 32px));
      margin: 140px auto 0;
      padding: 0 8px;
    }

    .blogSearchClose {
      position: absolute;
      top: -56px;
      right: 0;
      width: 44px;
      height: 44px;
      border-radius: 999px;
      border: 1px solid rgba(255, 255, 255, 0.35);
      background: rgba(0, 0, 0, 0.35);
      color: #fff;
      cursor: pointer;
      font-size: 22px;
      line-height: 1;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .blogSearchClose:hover {
      background: rgba(255, 255, 255, 0.08);
    }

    .blogSearchForm {
      width: 100%;
    }

    .blogSearchInputWrap {
      position: relative;
      border: 2px solid rgba(255, 255, 255, 0.85);
      border-radius: 999px;
      padding: 22px 64px 22px 28px;
      background: rgba(0, 0, 0, 0.25);
      backdrop-filter: blur(2px);
    }

    .blogSearchInputWrap input {
      width: 100%;
      background: transparent;
      border: 0;
      outline: none;
      color: #fff;
      font-size: 22px;
      font-weight: 500;
    }

    .blogSearchInputWrap input::placeholder {
      color: rgba(255, 255, 255, 0.75);
    }

    .blogSearchSubmit {
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      width: 44px;
      height: 44px;
      border-radius: 12px;
      border: 0;
      background: transparent;
      color: #fff;
      cursor: pointer;
      opacity: 0.9;
    }

    .blogSearchSubmit:hover {
      opacity: 1;
    }

    body.noScroll {
      overflow: hidden;
    }

    /* ===== Blog Grid (4 per row on desktop) ===== */
    .blog-grid-section {
      padding: 60px 0 80px;
      background: #f8f9fa;
    }

    .blog-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 24px;
      margin-top: 20px;
    }

    @media (max-width: 1200px) {
      .blog-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media (max-width: 992px) {
      .blog-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 576px) {
      .blog-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Blog Card */
    .blog-card {
      background: #ffffff;
      border-radius: 16px;
      overflow: hidden;
      transition: all 0.3s ease;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .blog-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    /* ✅ FIXED IMAGE (no white strip / no invalid width) */
    .blog-card-image {
      position: relative;
      height: 240px;
      overflow: hidden;
      background: #fff;
    }

    .blog-card-image a {
      display: block;
      width: 100%;
      height: 100%;
    }

    .blog-card-image img {
      width: 100%;
      height: 100%;

      object-position: center;
      display: block;
      transition: transform 0.5s ease;
    }

    .blog-card:hover .blog-card-image img {
      transform: scale(1.08);
    }

    .blog-card-category {
      position: absolute;
      top: 16px;
      left: 16px;
      background: rgba(26, 26, 26, 0.85);
      color: #ffffff;
      padding: 6px 16px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
      text-transform: capitalize;
      backdrop-filter: blur(4px);
    }

    .blog-card-content {
      padding: 22px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    .blog-card-title {
      font-size: 1rem;
      font-weight: 700;
      color: #1a1a1a;
      margin-bottom: 12px;
      line-height: 1.35;
      text-decoration: none;
      display: block;
      transition: color 0.3s ease;
      display: -webkit-box;
      -webkit-box-orient: vertical;
      -webkit-line-clamp: 2;
      /* ✅ only 2 lines */
      overflow: hidden;
      text-overflow: ellipsis;
      line-height: 1.35;
      max-height: calc(1.35em * 2);
    }

    .blog-card-title:hover {
      color: #e93132;
    }

    .blog-card-excerpt {
      color: #6c757d;
      font-size: 0.95rem;
      line-height: 1.6;
      margin-bottom: 16px;
      flex-grow: 1;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .read-more-link {
      display: inline-flex;
      align-items: center;
      color: #e93132;
      font-weight: 600;
      font-size: 0.9rem;
      text-decoration: none;
      transition: all 0.3s ease;
      gap: 6px;
      margin-bottom: 16px;
    }

    .read-more-link:hover {
      color: #d02829;
      gap: 10px;
    }

    .read-more-link svg {
      width: 16px;
      height: 16px;
      transition: transform 0.3s ease;
    }

    .read-more-link:hover svg {
      transform: translateX(4px);
    }

    .blog-card-meta {
      display: flex;
      align-items: center;
      gap: 16px;
      padding-top: 16px;
      border-top: 1px solid #e9ecef;
      font-size: 0.85rem;
      color: #6c757d;
      flex-wrap: wrap;
    }

    .blog-card-meta-item {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .blog-card-meta-divider {
      width: 4px;
      height: 4px;
      background: #dee2e6;
      border-radius: 50%;
    }

    /* ===== FULL WIDTH HERO ===== */

    .blog-hero-full {
      width: 100%;
      margin: 0;
      padding: 0;
    }

    /* High quality full width banner */
    .blog-banner-full {
      width: 100%;
      min-height: 450px;

      background-image: url("<?= BASE_PATH ?>images/brand/blog banner.png");
      background-size: contain;
      /* Keep ratio */
      background-position: left;
      /* 🔥 Important for this image */
      background-repeat: no-repeat;

      display: flex;
      align-items: center;
    }

    /* ===== Inline Search Bar ===== */
    .blogInlineSearch {
      width: 100%;
      max-width: 600px;
      margin: 20px auto 0;
    }

    .blogInlineForm {
      width: 100%;
    }

    .blogInlineInputWrap {
      position: relative;
    display: flex;
    width: 100%;
    max-width: 500px;
    align-items: center;
      border: 1.5px solid #d1d5db;
      border-radius: 999px;
      background: #fff;
      padding: 12px 20px;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .blogInlineInputWrap:focus-within {
      border-color: #e93132;
      box-shadow: 0 0 0 3px rgba(233, 49, 50, 0.1);
    }

    .blogInlineIcon {
      flex-shrink: 0;
      margin-right: 10px;
    }

    .blogInlineInputWrap input {
      width: 100%;
      border: 0;
      outline: none;
      background: transparent;
      font-size: 0.95rem;
      color: #1a1a1a;
    }

    /* Smooth dark gradient overlay */
    .blog-banner-overlay-full {
      width: 100%;
      height: 445px;
      background: linear-gradient(to right,
          rgba(0, 0, 0, 0.4) 30%,
          rgba(0, 0, 0, 0.7) 70%);
      display: flex;
      align-items: center;
    }

    /* Right aligned text */
    .banner-text-right {

      text-align: center;
      /* Push text to right */
      color: white;
    }

    /* Desktop typography */
    .banner-text-right h1 {
      font-size: 64px;
      font-weight: 700;
      margin-bottom: 25px;
      color: white;
    }

    .banner-text-right p {
      font-size: 20px;

      line-height: 1.8;
      color: white;
    }

    /* ===== RESPONSIVE ===== */

    @media (max-width: 1200px) {
      .banner-text-right h1 {
        font-size: 52px;
      }
    }

    @media (max-width: 992px) {

      .blog-banner-full {
        height: 70vh;
        min-height: 420px;
      }

      .banner-text-right {
        text-align: center;
        margin: 0 auto;
      }

      .banner-text-right h1 {
        font-size: 38px;
      }

      .banner-text-right p {
        font-size: 16px;
      }
    }

    @media (max-width: 576px) {

      .blog-banner-full {
        height: 60vh;
        min-height: 320px;
        background-position: center;
      }
      /* ── Inline Search ── */
.blogInlineSearch {
    max-width: 100%;
    margin: 12px auto 0;
    padding: 0 16px;
    flex-shrink: 0;
    width: 100%;
    box-sizing: border-box;
}
.blogInlineInputWrap {
    width: 100%;
    max-width: 100%;
    padding: 10px 16px;
    box-sizing: border-box;
}

    }


    /* No Results */
    .no-results {
      text-align: center;
      padding: 80px 20px;
      color: #6c757d;
    }

    .no-results h3 {
      font-size: 1.5rem;
      margin-bottom: 12px;
      color: #495057;
    }

    /* Responsive */
    @media (max-width: 992px) {
      .blog-main-title {
        font-size: 2.2rem;
      }

      .blog-header-section {
        padding: 60px 0 40px;
      }

      .blog-grid-section {
        padding: 40px 0 60px;
      }
    }

    @media (max-width: 768px) {
      .blogSearchBox {
        margin-top: 110px;
      }

      .blogSearchInputWrap {
        padding: 18px 60px 18px 22px;
      }

      .blogSearchInputWrap input {
        font-size: 18px;
      }
    }

    @media (max-width: 576px) {
      .blog-main-title {
        font-size: 1.8rem;
      }

      .blog-subtitle {
        font-size: 1rem;
      }

      .filter-btn {
        padding: 10px 20px;
        font-size: 0.9rem;
      }

      .blog-card-content {
        padding: 20px;
      }

      .blog-card-title {
        font-size: 1.15rem;
      }
    }
    /* ══════════════════════════════
   BLOG PAGE — PHONE OPTIMIZATION
══════════════════════════════ */
@media (max-width: 576px) {

    /* ── Hero Banner ── */
    .blog-banner-full {
        min-height: 200px;
        height: auto;
        background-size: cover;
        background-position: center;
    }

    .blog-banner-overlay-full {
        height: 100%;
        min-height: 300px;
        padding: 30px 0;
    }

    .banner-text-right h1 {
        font-size: 1.6rem;
        margin-bottom: 10px;
    }

    .banner-text-right p {
        font-size: 0.85rem;
        line-height: 1.5;
    }

    /* ── Category Filters ── */
    .category-filter-section {
        padding: 20px 0;
    }

    .filter-buttons {
        gap: 8px;
        justify-content: flex-start;
        overflow-x: auto;
        flex-wrap: nowrap;
        padding: 0 16px 10px;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
    }

    .filter-buttons::-webkit-scrollbar {
        display: none;
    }

    .filter-btn {
        padding: 8px 16px;
        font-size: 0.8rem;
        white-space: nowrap;
        flex-shrink: 0;
    }

    /* ── Inline Search ── */
    .blogInlineSearch {
        max-width: 100%;
        margin: 12px 0 0;
        flex-shrink: 0;
        width: 100%;
    }

    .blogInlineInputWrap {
        padding: 10px 16px;
    }

    .blogInlineInputWrap input {
        font-size: 0.85rem;
    }

    /* ── Blog Grid ── */
    .blog-grid-section {
        padding: 24px 0 40px;
    }

    .blog-grid {
        gap: 16px;
        padding: 0 16px;
    }

    /* ── Blog Card ── */
    .blog-card {
        border-radius: 12px;
    }

    .blog-card:hover {
        transform: none;
    }

    .blog-card-image {
        height: 180px;
    }

    .blog-card-content {
        padding: 16px;
    }

    .blog-card-title {
        font-size: 0.95rem;
        margin-bottom: 8px;
    }

    .blog-card-excerpt {
        font-size: 0.82rem;
        -webkit-line-clamp: 2;
        margin-bottom: 10px;
    }

    .read-more-link {
        font-size: 0.8rem;
        margin-bottom: 10px;
    }

    .blog-card-meta {
        gap: 8px;
        padding-top: 10px;
        font-size: 0.75rem;
    }

    .blog-card-category {
        font-size: 0.72rem;
        padding: 4px 10px;
        top: 10px;
        left: 10px;
    }

    /* ── Search Modal ── */
    .blogSearchBox {
        margin-top: 80px;
    }

    .blogSearchInputWrap {
        padding: 14px 50px 14px 18px;
    }

    .blogSearchInputWrap input {
        font-size: 16px;
    }

    /* ── No Results ── */
    .no-results {
        padding: 40px 16px;
    }

    .no-results h3 {
        font-size: 1.2rem;
    }
}
  </style>


</head>

<body>
  <?php include_once "config/header-top.php"; ?>

  <div id="wrapper">
    <?php include_once "config/header.php"; ?>

    <!-- Blog Header Section -->
    <!-- <section class="hero">
      <section class="blog-header-section">
        <div class="container">
          <h1 class="blog-main-title">Our Blogs</h1>
          <p class="blog-subtitle">Our blog is your trusted source for industry insights, product innovations,
            maintenance tips, and the latest trends in power control systems.</p>
          
        </div>

      </section>
    </section> -->
    <!-- <section class="hero blog-hero">

      <div class="blog-banner">
        <img src="<?= BASE_PATH ?>images/blog page banner_.png" alt="Blog Banner" class="blog-banner-img">

        <div class="blog-banner-overlay">
          <div class="container text-center">
            <h1 class="blog-main-title">Our Blogs</h1>
            <p class="blog-subtitle">
              Our blog is your trusted source for industry insights, product innovations,
              maintenance tips, and the latest trends in power control systems.
            </p>
          </div>
        </div>
      </div>

    </section> -->

    <section class="hero blog-hero-full">

      <div class="blog-banner-full">
        <div class="blog-banner-overlay-full">
          <div class="container">
            <div class="banner-text-right">
              <h1>Our Blogs</h1>
           
            </div>
          </div>
        </div>
      </div>

    </section>
     <div class="blogInlineSearch">
            <form method="get" action="<?= BASE_PATH ?>blogs/" class="blogInlineForm">
              <?php if ($cat != "") { ?><input type="hidden" name="cat" value="<?= $cat ?>"><?php } ?>
              <?php if ($tag != "") { ?><input type="hidden" name="tag"
                  value="<?= str_replace(" ", "-", $tag) ?>"><?php } ?>
              <div class="blogInlineInputWrap">
                <svg class="blogInlineIcon" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="#999"
                  stroke-width="2">
                  <circle cx="11" cy="11" r="7"></circle>
                  <path d="M20 20l-3.5-3.5"></path>
                </svg>
                <input type="text" name="s" value="<?= htmlspecialchars($search) ?>" placeholder="Search blogs..." autocomplete="off">
              </div>
            </form>
          </div>



    <!-- Category Filter Section -->
    <section class="category-filter-section">
      <div class="container">
        <div class="filter-buttons">
          <a href="<?= BASE_PATH ?>blogs/" class="filter-btn <?= ($cat == "" && $tag == "") ? 'active' : '' ?>">All
            Posts</a>
          <?php
          $qr = $db->query("select * from mi_bcat where mi_status='Yes' order by cat_name");
          if ($qr->num_rows) {
            while ($crow = $qr->fetch_assoc()) {
              $active_class = ($cat == $crow['urlname']) ? 'active' : '';
              echo '<a href="' . BASE_PATH . 'blogs/' . $crow['urlname'] . '" class="filter-btn ' . $active_class . '">' . $crow['cat_name'] . '</a>';
            }
          }
          ?>
         
        </div>

        <!-- HPL-like Search Icon Trigger -->



        <?php if ($search != "") { ?>
          <div style="text-align:center;margin-top:10px;font-weight:600;color:#495057;">
            Showing results for: <span style="color:#e93132;"><?= htmlspecialchars($search) ?></span>
            &nbsp;|&nbsp;
            <a href="<?= BASE_PATH ?>blogs/<?= ($cat != "" ? $cat : "") ?>"
              style="color:#1a1a1a;text-decoration:underline;">
              Clear
            </a>
          </div>
        <?php } ?>
      </div>
    </section>

    <!-- Blog Grid Section -->
    <section class="blog-grid-section">
      <div class="container">
        <div class="blog-grid">
          <?php
          $like = "%" . $search . "%";

          if ($cat != "") {
            $qr = $db->query(
              "select a.id,a.dop,a.author,a.title,a.urlname,a.sdes,a.image, b.cat_name,b.urlname as cat_url, count(c.id) as cmt
                     from mi_blogs a
                     left join mi_bcat b on a.cat_id=b.id
                     left join mi_comment c on a.id=c.blog_id
                     where b.urlname=? and a.mi_status='Yes'
                       " . ($search != "" ? " and (a.title like ? or a.sdes like ? or a.author like ? or b.cat_name like ?) " : "") . "
                     GROUP BY a.id, a.dop, a.title, a.urlname, a.sdes, a.image, b.cat_name, b.urlname
                     order by a.id desc",
              $search != "" ? [$cat, $like, $like, $like, $like] : [$cat]
            );
          } else if ($tag != "") {
            $qr = $db->query(
              "select a.id,a.dop,a.title,a.urlname,a.sdes,a.author,a.image,a.mtags, b.cat_name,b.urlname as cat_url, count(c.id) as cmt
                     from mi_blogs a
                     left join mi_bcat b on a.cat_id=b.id
                     left join mi_comment c on a.id=c.blog_id
                     where find_in_set(?,a.mtags) and a.mi_status='Yes'
                       " . ($search != "" ? " and (a.title like ? or a.sdes like ? or a.author like ? or b.cat_name like ?) " : "") . "
                     GROUP BY a.id, a.dop, a.title, a.urlname, a.sdes, a.image, b.cat_name, b.urlname
                     order by a.id desc",
              $search != "" ? [$tag, $like, $like, $like, $like] : [$tag]
            );
          } else {
            $qr = $db->query(
              "select a.id,a.dop,a.title,a.urlname,a.sdes,a.author,a.image, b.cat_name,b.urlname as cat_url, count(c.id) as cmt
                     from mi_blogs a
                     left join mi_bcat b on a.cat_id=b.id
                     left join mi_comment c on a.id=c.blog_id
                     where a.mi_status='Yes'
                       " . ($search != "" ? " and (a.title like ? or a.sdes like ? or a.author like ? or b.cat_name like ?) " : "") . "
                     GROUP BY a.id, a.dop, a.title, a.urlname, a.sdes, a.image, b.cat_name, b.urlname
                     order by a.id desc",
              $search != "" ? [$like, $like, $like, $like] : []
            );
          }

          if ($qr->num_rows > 0) {
            while ($row = $qr->fetch_assoc()) {
              ?>
              <article class="blog-card">
                <div class="blog-card-image">
                  <a href="<?= BASE_PATH ?>blog/<?= $row['urlname'] ?>">
                    <img src="<?= BASE_PATH ?>images/blog_img/<?= $row['image'] ?>" alt="<?= $row['title'] ?>">
                  </a>
                  <span class="blog-card-category"><?= $row['cat_name'] ?></span>
                </div>
                <div class="blog-card-content">
                  <a href="<?= BASE_PATH ?>blog/<?= $row['urlname'] ?>" class="blog-card-title">
                    <?= $row['title'] ?>
                  </a>
                  <p class="blog-card-excerpt">
                    <?= truncate_text($row['sdes'], 150) ?>
                  </p>
                  <a href="<?= BASE_PATH ?>blog/<?= $row['urlname'] ?>" class="read-more-link">
                    Read More
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                  </a>
                  <div class="blog-card-meta">
                    <div class="blog-card-meta-item">
                      <span><?= $row['author'] ?></span>
                    </div>
                    <div class="blog-card-meta-divider"></div>
                    <div class="blog-card-meta-item">
                      <span><?= date("M d, Y", strtotime($row['dop'])) ?></span>
                    </div>
                    <div class="blog-card-meta-divider"></div>
                    <div class="blog-card-meta-item">
                      <span><?= $row['cmt'] ?> comments</span>
                    </div>
                  </div>
                </div>
              </article>
              <?php
            }
          } else {
            ?>
            <div class="no-results" style="grid-column: 1/-1;">
              <h3>No blog posts found</h3>
              <p>Try a different search keyword, select a different category, or check back later for new
                content.</p>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>

    <?php include_once "config/footer.php"; ?>
  </div>

  <?php include_once "config/mobile_menu.php"; ?>
  <?php include_once "config/foot.php"; ?>

  <!-- ===== Search Modal (opens on icon click) ===== -->
  <div class="blogSearchModal" id="blogSearchModal" aria-hidden="true">
    <div class="blogSearchBackdrop" data-close="1"></div>

    <div class="blogSearchBox" role="dialog" aria-modal="true" aria-label="Search blogs">
      <button type="button" class="blogSearchClose" id="closeBlogSearch" aria-label="Close search">×</button>

      <form method="get" action="<?= BASE_PATH ?>blogs/" class="blogSearchForm">
        <?php if ($cat != "") { ?><input type="hidden" name="cat" value="<?= $cat ?>"><?php } ?>
        <?php if ($tag != "") { ?><input type="hidden" name="tag" value="<?= str_replace(" ", "-", $tag) ?>"><?php } ?>

        <div class="blogSearchInputWrap">
          <input type="text" name="s" id="blogSearchInput" value="<?= htmlspecialchars($search) ?>"
            placeholder="Search..." autocomplete="off" />
          <button type="submit" class="blogSearchSubmit" aria-label="Search">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="7"></circle>
              <path d="M20 20l-3.5-3.5"></path>
            </svg>
          </button>
        </div>
      </form>
    </div>
  </div>

  <!-- ===== Modal JS ===== -->
  <script>
    (function () {
      var openBtn = document.getElementById('openBlogSearch');
      var modal = document.getElementById('blogSearchModal');
      var closeBtn = document.getElementById('closeBlogSearch');
      var input = document.getElementById('blogSearchInput');

      function openModal() {
        if (!modal) return;
        modal.classList.add('isOpen');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('noScroll');
        setTimeout(function () { if (input) input.focus(); }, 80);
      }

      function closeModal() {
        if (!modal) return;
        modal.classList.remove('isOpen');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('noScroll');
      }

      if (openBtn) openBtn.addEventListener('click', openModal);
      if (closeBtn) closeBtn.addEventListener('click', closeModal);

      // click outside to close
      if (modal) {
        modal.addEventListener('click', function (e) {
          if (e.target && e.target.getAttribute('data-close') === '1') closeModal();
        });
      }

      // ESC to close
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal && modal.classList.contains('isOpen')) {
          closeModal();
        }
      });
    })();
  </script>

</body>

</html>