<?php
include_once "./config/config.inc.php";

// Fetch all active jobs from CRM
$jobs = [];
$qr = $db->query("SELECT * FROM mi_jobs WHERE mi_status='Yes' ORDER BY id DESC");
if ($qr->num_rows) {
    while ($r = $qr->fetch_assoc()) {
        $jobs[] = $r;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Careers – Subtech</title>
  <meta name="description" content="Join Subtech and help power the future of Electrical Automation. Explore open positions and apply today.">
  <link rel="canonical" href="https://subtech.in/careers">
  <?php include_once "config/head.php"; ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet"/>

  <style>
    :root {
      --red: #EF2E33;
      --red-dark: #c9232a;
      --red-light: #fdeaeb;
      --red-glow: rgba(239,46,51,0.12);
      --black: #0d0d0d;
      --black-soft: #1a1a1a;
      --gray-700: #444;
      --gray-500: #777;
      --gray-400: #999;
      --gray-300: #c4c4c4;
      --gray-200: #e2e2e2;
      --gray-100: #f0f0f0;
      --gray-50: #f7f7f7;
      --white: #fff;
      --radius: 12px;
    }

    /* Reset overrides */
    #wrapper { min-height: 0 !important; height: auto !important; display: block !important; }
    html, body, #wrapper, .page-wrapper, .site-wrapper, main, #main {
      min-height: 0 !important; height: auto !important; flex: none !important;
    }
    #page-detail, #page-apply { display: none !important; height: 0 !important; overflow: hidden !important; padding: 0 !important; margin: 0 !important; border: 0 !important; }

    /* ══════════════════════════════
       HERO
    ══════════════════════════════ */
    .careers-hero {
      position: relative;
      width: 100%;
      min-height: 420px;
      overflow: hidden;
      background: var(--black-soft);
    }
    .careers-hero-img {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      object-fit: cover;
      object-position: left center;
    }
    .careers-hero-overlay {
      position: relative;
      width: 100%;
      min-height: 420px;
      background: linear-gradient(to right, rgba(0,0,0,0.05) 25%, rgba(0,0,0,0.7) 65%);
      display: flex;
      align-items: center;
      justify-content: flex-end;
      z-index: 1;
    }
    .careers-hero-text {
      max-width: 500px;
      margin-right: 80px;
      padding: 40px 20px;
    }
    .careers-hero-text h1 {
      font-family: 'DM Serif Display', serif;
      font-size: 3.2rem;
      font-weight: 400;
      color: #fff;
      margin-bottom: 14px;
      letter-spacing: -0.5px;
    }
    .careers-hero-text p {
      font-family: 'DM Sans', sans-serif;
      font-size: 1.05rem;
      color: rgba(255,255,255,0.85);
      line-height: 1.65;
      font-weight: 400;
    }

    /* ══════════════════════════════
       SECTION HEADER
    ══════════════════════════════ */
    .section-header {
      padding: 44px 48px 28px;
      background: var(--white);
    }
    .section-header h2 {
      font-family: 'DM Serif Display', serif;
      font-size: 1.7rem;
      font-weight: 400;
      margin-bottom: 10px;
      color: var(--black);
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .section-header h2::before {
      content: '';
      width: 4px; height: 26px;
      background: var(--red);
      border-radius: 2px;
      display: inline-block;
      flex-shrink: 0;
    }
    .section-header p {
      font-size: 0.88rem;
      color: var(--gray-500);
      line-height: 1.65;
      max-width: 560px;
    }
    .section-actions {
      display: flex;
      gap: 10px;
      margin-top: 20px;
    }
    .btn-outline {
      padding: 8px 22px;
      border: 1.5px solid var(--black);
      background: var(--black);
      color: var(--white);
      font-size: 0.78rem;
      font-weight: 700;
      cursor: pointer;
      border-radius: 8px;
      font-family: 'DM Sans', sans-serif;
      transition: all 0.2s;
    }
    .btn-outline:hover {
      background: var(--black-soft);
      transform: translateY(-1px);
    }
    .btn-red {
      padding: 8px 22px;
      background: var(--red);
      color: var(--white);
      border: none;
      font-size: 0.78rem;
      font-weight: 700;
      cursor: pointer;
      border-radius: 8px;
      font-family: 'DM Sans', sans-serif;
      transition: all 0.2s;
    }
    .btn-red:hover {
      background: var(--red-dark);
      transform: translateY(-1px);
      box-shadow: 0 4px 16px rgba(239,46,51,0.2);
    }

    /* ══════════════════════════════
       JOBS COUNT BAR
    ══════════════════════════════ */
    .jobs-count-bar {
      padding: 16px 48px;
      background: var(--gray-50);
      border-bottom: 1px solid var(--gray-200);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .jobs-count-bar span {
      font-size: 0.78rem;
      font-weight: 700;
      color: var(--gray-400);
      letter-spacing: 0.06em;
      text-transform: uppercase;
    }
    .jobs-count-bar .count {
      background: var(--red);
      color: var(--white);
      font-size: 0.68rem;
      font-weight: 800;
      padding: 2px 10px;
      border-radius: 100px;
      margin-left: 8px;
    }

    /* ══════════════════════════════
       JOB CARDS
    ══════════════════════════════ */
    .jobs-wrapper {
      background: var(--gray-50);
      padding: 24px 48px 40px;
    }
    .job-card {
      background: var(--white);
      border: 1.5px solid var(--gray-200);
      border-radius: var(--radius);
      padding: 22px 24px;
      margin-bottom: 14px;
      cursor: pointer;
      transition: all 0.2s;
      position: relative;
    }
    .job-card:hover {
      border-color: var(--gray-300);
      box-shadow: 0 2px 12px rgba(0,0,0,0.04);
      transform: translateY(-1px);
    }
    .job-card.active {
      border-color: var(--red);
      box-shadow: 0 0 0 1px var(--red), 0 2px 12px rgba(239,46,51,0.08);
    }
    .job-card-top {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      gap: 16px;
      flex-wrap: wrap;
    }
    .job-card h3 {
      color: var(--red);
      font-size: 1rem;
      font-weight: 700;
      margin-bottom: 6px;
      font-family: 'DM Sans', sans-serif;
    }
    .job-card .job-meta-line {
      display: flex;
      flex-wrap: wrap;
      gap: 14px;
      margin-bottom: 10px;
      font-size: 0.75rem;
      color: var(--gray-500);
      font-weight: 500;
    }
    .job-card .job-meta-line i { margin-right: 4px; color: var(--gray-400); }
    .tags {
      display: flex;
      gap: 6px;
      margin-bottom: 10px;
      flex-wrap: wrap;
    }
    .tag {
      background: var(--gray-50);
      border: 1px solid var(--gray-200);
      font-size: 0.68rem;
      padding: 3px 12px;
      border-radius: 6px;
      color: var(--gray-500);
      font-weight: 600;
    }
    .tag.tag-type {
      background: var(--red-light);
      color: var(--red);
      border-color: rgba(239,46,51,0.12);
    }
    .job-card p.job-desc {
      font-size: 0.82rem;
      color: var(--gray-500);
      line-height: 1.6;
      margin: 0;
    }
    .job-card .card-actions {
      display: flex;
      gap: 8px;
      flex-shrink: 0;
    }
    .btn-sm-red {
      padding: 7px 18px;
      background: var(--red);
      color: var(--white);
      border: none;
      font-size: 0.72rem;
      font-weight: 700;
      cursor: pointer;
      border-radius: 8px;
      font-family: 'DM Sans', sans-serif;
      transition: all 0.2s;
      white-space: nowrap;
    }
    .btn-sm-red:hover { background: var(--red-dark); }
    .btn-sm-outline {
      padding: 7px 18px;
      background: var(--white);
      color: var(--gray-700);
      border: 1.5px solid var(--gray-200);
      font-size: 0.72rem;
      font-weight: 700;
      cursor: pointer;
      border-radius: 8px;
      font-family: 'DM Sans', sans-serif;
      transition: all 0.2s;
      white-space: nowrap;
      text-decoration: none;
    }
    .btn-sm-outline:hover {
      border-color: var(--red);
      color: var(--red);
    }

    /* No jobs */
    .no-jobs {
      text-align: center;
      padding: 60px 20px;
      color: var(--gray-400);
    }
    .no-jobs h4 {
      font-size: 1.1rem;
      font-weight: 700;
      margin-bottom: 8px;
      color: var(--gray-500);
    }
    .no-jobs p {
      font-size: 0.85rem;
      color: var(--gray-400);
    }

    /* Perks bar */
    .perks-bar {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      margin-top: 12px;
    }
    .perk {
      font-size: 0.68rem;
      font-weight: 600;
      color: var(--gray-500);
      background: var(--gray-50);
      border: 1px solid var(--gray-200);
      padding: 3px 10px;
      border-radius: 100px;
    }

    /* ══════════════════════════════
       DETAIL PAGE
    ══════════════════════════════ */
    .detail-wrap { background: var(--white); }
    .detail-header {
      padding: 44px 48px 28px;
      border-bottom: 1px solid var(--gray-200);
    }
    .detail-header h2 {
      font-family: 'DM Serif Display', serif;
      font-size: 1.7rem;
      font-weight: 400;
      margin-bottom: 10px;
      color: var(--black);
    }
    .detail-header p {
      font-size: 0.88rem;
      color: var(--gray-500);
      line-height: 1.65;
      max-width: 560px;
    }
    .detail-body {
      padding: 36px 48px 48px;
      max-width: 780px;
    }
    .detail-section { margin-bottom: 28px; }
    .detail-section h4 {
      font-size: 0.92rem;
      font-weight: 800;
      margin-bottom: 10px;
      color: var(--black);
      text-transform: uppercase;
      letter-spacing: 0.04em;
      font-size: 0.82rem;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .detail-section h4::before {
      content: '';
      width: 3px; height: 16px;
      background: var(--red);
      border-radius: 2px;
    }
    .detail-section p, .detail-section li {
      font-size: 0.86rem;
      color: var(--gray-700);
      line-height: 1.7;
    }
    .detail-section ul { padding-left: 18px; }
    .detail-section ul li { margin-bottom: 5px; }
    .detail-section ul li::marker { color: var(--red); }
    .meta-grid {
      display: grid;
      grid-template-columns: repeat(3, auto);
      gap: 20px 40px;
      margin-top: 8px;
      background: var(--gray-50);
      border: 1px solid var(--gray-200);
      border-radius: var(--radius);
      padding: 20px 24px;
    }
    .meta-item label {
      display: block;
      font-size: 0.68rem;
      font-weight: 800;
      color: var(--gray-400);
      margin-bottom: 4px;
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }
    .meta-item span {
      font-size: 0.86rem;
      color: var(--black);
      font-weight: 600;
    }
    .apply-btn-wrap { margin-top: 32px; }
    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 0.78rem;
      color: var(--gray-400);
      cursor: pointer;
      margin-bottom: 8px;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s;
    }
    .back-link:hover { color: var(--red); }

    /* ══════════════════════════════
       APPLY FORM
    ══════════════════════════════ */
    .apply-wrap { background: var(--white); }
    .apply-header {
      padding: 44px 48px 28px;
      border-bottom: 1px solid var(--gray-200);
    }
    .apply-header h2 {
      font-family: 'DM Serif Display', serif;
      font-size: 1.7rem;
      font-weight: 400;
      margin-bottom: 10px;
      color: var(--black);
    }
    .apply-header p {
      font-size: 0.88rem;
      color: var(--gray-500);
      line-height: 1.65;
      max-width: 560px;
    }
    .apply-body {
      padding: 36px 48px 56px;
      max-width: 560px;
    }
    .apply-body h3 {
      font-family: 'DM Serif Display', serif;
      font-size: 1.3rem;
      font-weight: 400;
      margin-bottom: 6px;
      color: var(--black);
    }
    .apply-body > p {
      font-size: 0.82rem;
      color: var(--gray-500);
      margin-bottom: 24px;
      line-height: 1.6;
    }
    .form-group { margin-bottom: 16px; }
    .form-group label {
      display: block;
      font-size: 0.72rem;
      font-weight: 700;
      color: var(--gray-500);
      margin-bottom: 6px;
      text-transform: uppercase;
      letter-spacing: 0.06em;
    }
    .form-group label .req { color: var(--red); }
    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%;
      border: 1.5px solid var(--gray-200);
      border-radius: 10px;
      padding: 12px 16px;
      font-size: 0.86rem;
      color: var(--black);
      background: var(--white);
      outline: none;
      transition: all 0.2s;
      font-family: 'DM Sans', sans-serif;
    }
    .form-group input::placeholder,
    .form-group textarea::placeholder { color: var(--gray-300); }
    .form-group input:focus,
    .form-group textarea:focus {
      border-color: var(--red);
      box-shadow: 0 0 0 3px var(--red-glow);
    }
    .form-group textarea { resize: vertical; min-height: 100px; }
    .upload-area {
      border: 2px dashed var(--gray-200);
      border-radius: 10px;
      padding: 20px;
      text-align: center;
      cursor: pointer;
      transition: all 0.2s;
      background: var(--gray-50);
    }
    .upload-area:hover {
      border-color: var(--red);
      background: var(--red-light);
    }
    .upload-area i {
      font-size: 1.5rem;
      color: var(--gray-300);
      display: block;
      margin-bottom: 6px;
    }
    .upload-area span {
      font-size: 0.78rem;
      color: var(--gray-400);
      font-weight: 500;
    }
    .upload-area .file-chosen {
      color: var(--red);
      font-weight: 700;
    }
    .checkbox-row {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      margin: 22px 0;
    }
    .checkbox-row input[type="checkbox"] { margin-top: 3px; cursor: pointer; accent-color: var(--red); }
    .checkbox-row label {
      font-size: 0.78rem;
      color: var(--gray-500);
      line-height: 1.5;
      cursor: pointer;
      font-weight: 500;
      text-transform: none;
      letter-spacing: 0;
    }
    .submit-btn {
      width: 100%;
      padding: 14px;
      background: var(--red);
      color: #fff;
      border: none;
      font-size: 0.88rem;
      font-weight: 700;
      cursor: pointer;
      border-radius: 10px;
      transition: all 0.2s;
      font-family: 'DM Sans', sans-serif;
      letter-spacing: 0.02em;
    }
    .submit-btn:hover {
      background: var(--red-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 16px rgba(239,46,51,0.25);
    }
    .submit-btn:active { transform: translateY(0); }

    /* ══════════════════════════════
       RESPONSIVE
    ══════════════════════════════ */
    @media (max-width: 992px) {
      .careers-hero, .careers-hero-overlay { min-height: 360px; }
      .careers-hero-text { margin-right: 40px; }
      .careers-hero-text h1 { font-size: 2.4rem; }
    }
    @media (max-width: 768px) {
      .section-header, .jobs-wrapper, .detail-header, .detail-body, .apply-header, .apply-body,
      .jobs-count-bar { padding-left: 20px; padding-right: 20px; }
      .meta-grid { grid-template-columns: 1fr 1fr; }
      .job-card-top { flex-direction: column; }
      .job-card .card-actions { margin-top: 12px; }
    }
    @media (max-width: 576px) {
      .careers-hero { min-height: 0 !important; overflow: visible !important; position: relative; }
      .careers-hero-img { position: relative !important; width: 100% !important; height: 300px !important; display: block; }
      .careers-hero-overlay {
        position: absolute !important; top: 0; left: 0; width: 100%; height: 100%;
        min-height: 0 !important; background: rgba(0,0,0,0.5); justify-content: center;
      }
      .careers-hero-text { text-align: center; padding: 10px 16px; margin-right: 0; }
      .careers-hero-text h1 { font-size: 1.4rem; margin-bottom: 6px; }
      .careers-hero-text p { font-size: 0.78rem; }
      .meta-grid { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
  <?php include_once "config/header-top.php"; ?>

  <div id="wrapper">
    <?php include_once "config/header.php"; ?>

    <!-- ════════════════════════════════════════
         PAGE 1: CAREERS LIST
    ════════════════════════════════════════ -->
    <div id="page-list">

      <div class="careers-hero">
        <img src="<?= BASE_PATH ?>images/careers.png" alt="Careers at Subtech" class="careers-hero-img">
        <div class="careers-hero-overlay">
          <div class="careers-hero-text">
            <h1>Careers</h1>
            <p>Join Subtech and help power the future of Electrical Automation.</p>
          </div>
        </div>
      </div>

      <div class="section-header">
        <h2>Open Positions</h2>
        <p>From smart tech to seamless commerce, we help businesses grow faster. Discover where you fit in at Subtech and make an impact in the world of Electrical Automation.</p>
        <div class="section-actions">
          <button class="btn-outline" onclick="window.location.href='<?= BASE_PATH ?>careers'">View All Jobs</button>
          <button class="btn-red">Subscribe</button>
        </div>
      </div>

      <div class="jobs-count-bar">
        <span>Showing all openings <span class="count"><?= count($jobs) ?></span></span>
      </div>

      <div class="jobs-wrapper">
        <?php if (count($jobs) > 0): ?>
          <?php foreach ($jobs as $i => $job): ?>
            <div class="job-card <?= $i === 0 ? 'active' : '' ?>"
                 onclick="showDetail(<?= $job['id'] ?>)"
                 data-id="<?= $job['id'] ?>">
              <div class="job-card-top">
                <div>
                  <h3><?= htmlspecialchars($job['title']) ?></h3>
                  <div class="job-meta-line">
                    <?php if (!empty($job['cat_name'])): ?>
                      <span><i class="bi bi-building"></i> <?= htmlspecialchars($job['cat_name']) ?></span>
                    <?php endif; ?>
                    <?php if (!empty($job['location'])): ?>
                      <span><i class="bi bi-geo-alt-fill"></i> <?= htmlspecialchars($job['location']) ?></span>
                    <?php endif; ?>
                    <?php if (!empty($job['pdate'])): ?>
                      <span><i class="bi bi-calendar3"></i> Posted: <?= date("d M Y", strtotime($job['pdate'])) ?></span>
                    <?php endif; ?>
                  </div>
                  <div class="tags">
                    <?php if (!empty($job['job_type'])): ?>
                      <span class="tag tag-type"><?= htmlspecialchars($job['job_type']) ?></span>
                    <?php endif; ?>
                    <?php if (!empty($job['experience'])): ?>
                      <span class="tag"><?= htmlspecialchars($job['experience']) ?></span>
                    <?php endif; ?>
                  </div>
                  <?php if (!empty($job['sdes'])): ?>
                    <p class="job-desc"><?= mb_strimwidth(strip_tags($job['sdes']), 0, 180, '…') ?></p>
                  <?php endif; ?>
                  <div class="perks-bar">
                    <span class="perk">Health Insurance</span>
                    <span class="perk">Performance Bonus</span>
                    <span class="perk">Flexible Hours</span>
                  </div>
                </div>
                <div class="card-actions">
                  <a href="<?= BASE_PATH ?>job/<?= urlencode($job['url_name']) ?>" class="btn-sm-outline" onclick="event.stopPropagation()">View Details</a>
                  <button class="btn-sm-red" onclick="event.stopPropagation(); showDetail(<?= $job['id'] ?>)">Apply</button>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="no-jobs">
            <h4>No Current Openings</h4>
            <p>We don't have open positions right now, but we're always looking for talented people. Subscribe to get notified when new roles open up.</p>
          </div>
        <?php endif; ?>
      </div>

    </div>


    <!-- ════════════════════════════════════════
         PAGE 2: JOB DETAIL
    ════════════════════════════════════════ -->
    <div id="page-detail">

      <div class="careers-hero">
        <img src="<?= BASE_PATH ?>images/careers.png" alt="Careers at Subtech" class="careers-hero-img">
        <div class="careers-hero-overlay">
          <div class="careers-hero-text">
            <h1 id="detail-title"></h1>
          </div>
        </div>
      </div>

      <div class="detail-wrap">
        <div class="detail-header">
          <span class="back-link" onclick="showList()">← Back to all jobs</span>
          <h2 id="detail-heading"></h2>
          <p id="detail-subtitle">Discover where you fit in at Subtech and make an impact in the world of Electrical Automation.</p>
          <div class="section-actions">
            <button class="btn-outline" onclick="showList()">All Jobs</button>
            <button class="btn-red" onclick="showApply()">Apply Now</button>
          </div>
        </div>

        <div class="detail-body">

          <div class="detail-section">
            <h4>About Subtech</h4>
            <p>Subtech operates in electrical and automation solutions including motor starters, AMF panels, automatic changeover switches, LT/Control panels, and related power-control equipment. With 25+ years of experience and 500+ clients across 28 states, we are a trusted name in industrial automation.</p>
          </div>

          <div class="detail-section">
            <h4>Job Description</h4>
            <div id="detail-description"></div>
          </div>

          <div class="detail-section">
            <div class="meta-grid">
              <div class="meta-item">
                <label>Department</label>
                <span id="detail-cat"></span>
              </div>
              <div class="meta-item">
                <label>Employment Type</label>
                <span id="detail-type"></span>
              </div>
              <div class="meta-item">
                <label>Experience Required</label>
                <span id="detail-exp"></span>
              </div>
              <div class="meta-item">
                <label>Job Location</label>
                <span id="detail-loc"></span>
              </div>
              <div class="meta-item">
                <label>Posted On</label>
                <span id="detail-date"></span>
              </div>
            </div>
          </div>

          <div class="detail-section">
            <h4>Why Subtech</h4>
            <ul>
              <li>Work with a trusted and growing brand in electrical &amp; automation.</li>
              <li>Supportive, performance-driven culture with room for career growth.</li>
              <li>ISO 9001, ISO 45001 &amp; ISO 50001 certified workplace.</li>
              <li>Competitive salary, health insurance, and performance bonuses.</li>
            </ul>
          </div>

          <div class="apply-btn-wrap">
            <button class="btn-red" onclick="showApply()">Apply for this Position →</button>
          </div>

        </div>
      </div>

    </div>


    <!-- ════════════════════════════════════════
         PAGE 3: APPLY FORM
    ════════════════════════════════════════ -->
    <div id="page-apply">

      <div class="careers-hero">
        <img src="<?= BASE_PATH ?>images/careers.png" alt="Careers at Subtech" class="careers-hero-img">
        <div class="careers-hero-overlay">
          <div class="careers-hero-text">
            <h1 id="apply-title"></h1>
          </div>
        </div>
      </div>

      <div class="apply-wrap">
        <div class="apply-header">
          <span class="back-link" onclick="showDetailBack()">← Back to job detail</span>
          <h2 id="apply-heading"></h2>
          <p>Fill out the form below to submit your application. We'll review it and get back to you soon.</p>
          <div class="section-actions">
            <button class="btn-outline" onclick="showList()">All Jobs</button>
            <button class="btn-red" onclick="showDetailBack()">Job Details</button>
          </div>
        </div>

        <div class="apply-body">
          <h3>Apply Now</h3>
          <p>Join the Subtech Team — fill in your details below.</p>

          <form id="applyForm" onsubmit="handleSubmit(event)">
            <input type="hidden" name="job_id" id="apply-job-id" value="" />

            <div class="form-group">
              <label>Applying For</label>
              <input type="text" id="applying-for" readonly />
            </div>

            <div class="form-group">
              <label>Full Name <span class="req">*</span></label>
              <input type="text" name="fname" required placeholder="e.g. Rajesh Kumar" />
            </div>

            <div class="form-group">
              <label>Email Address</label>
              <input type="email" name="email" placeholder="you@company.com" />
            </div>

            <div class="form-group">
              <label>Mobile Number <span class="req">*</span></label>
              <input type="tel" name="mobile" required placeholder="+91 98XXX XXXXX" />
            </div>

            <div class="form-group">
              <label>Total Years of Experience <span class="req">*</span></label>
              <input type="text" name="experience" required placeholder="e.g. 3 years" />
            </div>

            <div class="form-group">
              <label>Previous Job Title</label>
              <input type="text" name="prev_title" placeholder="e.g. Junior Developer" />
            </div>

            <div class="form-group">
              <label>LinkedIn Profile Link</label>
              <input type="url" name="linkedin" placeholder="https://linkedin.com/in/yourname" />
            </div>

            <div class="form-group">
              <label>Cover Letter</label>
              <textarea name="cover_letter" rows="5" placeholder="Tell us why you'd be a great fit…"></textarea>
            </div>

            <div class="form-group">
              <label>Upload Your Resume <span class="req">*</span></label>
              <div class="upload-area" id="uploadArea" onclick="document.getElementById('resume-file').click()">
                <input type="file" id="resume-file" name="resume" style="display:none" accept=".pdf,.doc,.docx" required />
                <i class="bi bi-cloud-arrow-up"></i>
                <span id="file-label">Click to upload PDF, DOC, DOCX</span>
              </div>
            </div>

            <div class="checkbox-row">
              <input type="checkbox" id="confirm-check" required />
              <label for="confirm-check">I confirm that all the information above is accurate and I consent to Subtech processing my data for recruitment purposes.</label>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn">Submit Application</button>
          </form>
        </div>
      </div>

    </div>

    <?php include_once "config/footer.php"; ?>
  </div>

  <?php include_once "config/mobile_menu.php"; ?>
  <?php include_once "config/foot.php"; ?>

  <script>
    // ── Store all jobs data from DB into JS ──
    var jobsData = <?= json_encode($jobs, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
    var currentJob = null;

    // ── Page switching helpers ──
    function hidePage(id) {
      document.getElementById(id).style.cssText = 'display:none !important;height:0 !important;overflow:hidden !important;padding:0 !important;margin:0 !important;border:0 !important;';
    }
    function showPage(id) {
      document.getElementById(id).style.cssText = 'display:block !important;height:auto !important;overflow:visible !important;';
    }

    // ── Show list ──
    function showList() {
      showPage('page-list');
      hidePage('page-detail');
      hidePage('page-apply');
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // ── Show detail ──
    function showDetail(jobId) {
      // Find job from data
      var job = jobsData.find(function(j) { return j.id == jobId; });
      if (!job) return;
      currentJob = job;

      // Highlight active card
      document.querySelectorAll('.job-card').forEach(function(c) { c.classList.remove('active'); });
      var activeCard = document.querySelector('.job-card[data-id="' + jobId + '"]');
      if (activeCard) activeCard.classList.add('active');

      // Populate detail page
      document.getElementById('detail-title').textContent = job.title || '';
      document.getElementById('detail-heading').textContent = job.title || '';
      document.getElementById('detail-cat').textContent = job.cat_name || '—';
      document.getElementById('detail-type').textContent = job.job_type || 'Full Time';
      document.getElementById('detail-exp').textContent = job.experience || '—';
      document.getElementById('detail-loc').textContent = job.location || '—';
      document.getElementById('detail-date').textContent = job.pdate || '—';

      // Description — use HTML if available, else plain text
      var descEl = document.getElementById('detail-description');
      if (job.sdes) {
        descEl.innerHTML = job.sdes;
      } else {
        descEl.innerHTML = '<p>Detailed job description will be shared during the interview process.</p>';
      }

      hidePage('page-list');
      showPage('page-detail');
      hidePage('page-apply');
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // ── Show apply ──
    function showApply() {
      if (!currentJob) return;

      document.getElementById('apply-title').textContent = currentJob.title;
      document.getElementById('apply-heading').textContent = currentJob.title;
      document.getElementById('applying-for').value = currentJob.title;
      document.getElementById('apply-job-id').value = currentJob.id;

      // Reset form
      document.getElementById('applyForm').reset();
      document.getElementById('applying-for').value = currentJob.title;
      document.getElementById('apply-job-id').value = currentJob.id;
      document.getElementById('file-label').textContent = 'Click to upload PDF, DOC, DOCX';
      document.getElementById('file-label').className = '';

      hidePage('page-list');
      hidePage('page-detail');
      showPage('page-apply');
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // ── Back from apply to detail ──
    function showDetailBack() {
      if (currentJob) {
        showDetail(currentJob.id);
      } else {
        showList();
      }
    }

    // ── Init: hide detail & apply ──
    hidePage('page-detail');
    hidePage('page-apply');

    // ── File upload label ──
    document.getElementById('resume-file').addEventListener('change', function () {
      var label = document.getElementById('file-label');
      if (this.files[0]) {
        label.textContent = this.files[0].name;
        label.className = 'file-chosen';
      } else {
        label.textContent = 'Click to upload PDF, DOC, DOCX';
        label.className = '';
      }
    });

    // ── Form submission ──
    function handleSubmit(e) {
      e.preventDefault();
      var btn = document.getElementById('submitBtn');
      btn.textContent = 'Submitting…';
      btn.disabled = true;

      // AJAX submit
      var formData = new FormData(document.getElementById('applyForm'));
      formData.append('method', 'JobApply');

      $.ajax({
        url: '<?= BASE_PATH ?>Controller/Master/',
        type: 'POST',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          try {
            var res = JSON.parse(data);
            if (res.type === 'success') {
              alert('Application submitted successfully! We will get back to you soon.');
              document.getElementById('applyForm').reset();
              showList();
            } else {
              alert(res.message || 'Something went wrong. Please try again.');
            }
          } catch(err) {
            alert('Application submitted successfully!');
            showList();
          }
          btn.textContent = 'Submit Application';
          btn.disabled = false;
        },
        error: function() {
          alert('Network error. Please try again.');
          btn.textContent = 'Submit Application';
          btn.disabled = false;
        }
      });
    }
  </script>
</body>
</html>