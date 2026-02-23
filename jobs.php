<?php include_once "./config/config.inc.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Careers – Subtech</title>
  <meta name="description"
    content="Join Subtech and help power the future of Electrical Automation. Explore open positions and apply today.">
  <?php include_once "config/head.php"; ?>
 <style>
    /* ── CAREERS HERO ── */
    .careers-hero {
      position: relative;
      width: 100%;
      min-height: 450px;
      overflow: hidden;
      background: #1a1a1a;
    }

    .careers-hero-img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: left center;
    }

    .careers-hero-overlay {
      position: relative;
      width: 100%;
      min-height: 450px;
      background: linear-gradient(to right,
          rgba(0, 0, 0, 0.1) 30%,
          rgba(0, 0, 0, 0.65) 65%);
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
      font-size: 3.2rem;
      font-weight: 700;
      color: #fff;
      margin-bottom: 16px;
      letter-spacing: -0.5px;
    }

    .careers-hero-text p {
      font-size: 1.1rem;
      color: rgba(255, 255, 255, 0.9);
      line-height: 1.6;
    }

    /* ── Tablet ── */
    @media (max-width: 992px) {
      .careers-hero,
      .careers-hero-overlay {
        min-height: 380px;
      }

      .careers-hero-text {
        margin-right: 40px;
      }

      .careers-hero-text h1 {
        font-size: 2.4rem;
      }
    }

    /* ── Mobile ── */
    @media (max-width: 576px) {
      .careers-hero {
        min-height: 0 !important;
        overflow: visible !important;
        position: relative;
      }

      .careers-hero-img {
        position: relative !important;
        width: 100% !important;
        height: 350px !important;
        object-fit: cover !important;
        display: block;
      }

      .careers-hero-overlay {
        position: absolute !important;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        min-height: 0 !important;
        background: rgba(0, 0, 0, 0.45);
        justify-content: center;
      }

      .careers-hero-text {
        text-align: center;
        padding: 10px 16px;
        margin-right: 0;
      }

      .careers-hero-text h1 {
        font-size: 1.3rem;
        margin-bottom: 4px;
      }

      .careers-hero-text p {
        font-size: 0.75rem;
      }

      .section-header,
      .jobs-wrapper,
      .detail-header,
      .detail-body,
      .apply-header,
      .apply-body {
        padding-left: 20px;
        padding-right: 20px;
      }

      .meta-grid {
        grid-template-columns: 1fr;
      }
    }

    /* ══════════════════════════════
       CAREERS LIST PAGE
    ══════════════════════════════ */
    #page-list {
      display: block;
    }

    #page-detail {
      display: none;
    }

    #page-apply {
      display: none;
    }

    .section-header {
      padding: 40px 48px 24px;
      background: #fff;
    }

    .section-header h2 {
      font-size: 1.6rem;
      font-weight: 700;
      margin-bottom: 8px;
    }

    .section-header p {
      font-size: 0.85rem;
      color: #555;
      line-height: 1.55;
      max-width: 520px;
    }

    .section-actions {
      display: flex;
      gap: 10px;
      margin-top: 18px;
    }

    .btn-outline {
      padding: 7px 18px;
      border: 1.5px solid #111;
      background: #111;
      color: #fff;
      font-size: 0.78rem;
      font-weight: 600;
      cursor: pointer;
      border-radius: 50px;
      transition: background 0.15s, color 0.15s;
    }

    .btn-red {
      padding: 7px 18px;
      background: #d32f2f;
      color: #fff;
      border: none;
      font-size: 0.78rem;
      font-weight: 600;
      cursor: pointer;
      border-radius: 50px;
      transition: background 0.15s;
    }

    .btn-red:hover {
      background: #b71c1c;
    }

    /* Job Cards */
    .jobs-wrapper {
      background: #f0f0f0;
      padding: 24px 48px 24px;
      margin-bottom: 0;
    }

    .job-card {
      background: #fff;
      border: 1.5px solid #e0e0e0;
      border-radius: 4px;
      padding: 18px 20px;
      margin-bottom: 14px;
      cursor: pointer;
      transition: border-color 0.15s;
    }

    .job-card:hover {
      border-color: #bbb;
    }

    .job-card.active {
      border: 1.5px solid #d32f2f;
    }

    .job-card h3 {
      color: #d32f2f;
      font-size: 0.97rem;
      font-weight: 700;
      margin-bottom: 8px;
    }

    .tags {
      display: flex;
      gap: 8px;
      margin-bottom: 10px;
    }

    .tag {
      background: #f5f5f5;
      border: 1px solid #ddd;
      font-size: 0.72rem;
      padding: 3px 10px;
      border-radius: 2px;
      color: #444;
      font-weight: 500;
    }

    .job-card p {
      font-size: 0.79rem;
      color: #555;
      line-height: 1.5;
    }

    /* ══════════════════════════════
       JOB DETAIL PAGE
    ══════════════════════════════ */
    .detail-wrap {
      background: #fff;
      min-height: auto !important;
    }

    .detail-header {
      padding: 40px 48px 24px;
      border-bottom: 1px solid #eee;
    }

    .detail-header h2 {
      font-size: 1.6rem;
      font-weight: 700;
      margin-bottom: 8px;
    }

    .detail-header p {
      font-size: 0.85rem;
      color: #555;
      line-height: 1.55;
      max-width: 560px;
    }

    .detail-header .section-actions {
      margin-top: 18px;
    }

    .detail-body {
      padding: 36px 48px 48px;
    }

    .detail-section {
      margin-bottom: 28px;
    }

    .detail-section h4 {
      font-size: 0.95rem;
      font-weight: 700;
      margin-bottom: 10px;
      color: #111;
    }

    .detail-section p,
    .detail-section li {
      font-size: 0.83rem;
      color: #444;
      line-height: 1.65;
    }

    .detail-section ul {
      padding-left: 18px;
    }

    .detail-section ul li {
      margin-bottom: 4px;
    }

    .meta-grid {
      display: grid;
      grid-template-columns: repeat(3, auto);
      gap: 20px 40px;
      margin-top: 8px;
    }

    .meta-item label {
      display: block;
      font-size: 0.75rem;
      font-weight: 700;
      color: #888;
      margin-bottom: 3px;
      text-transform: uppercase;
      letter-spacing: 0.4px;
    }

    .meta-item span {
      font-size: 0.83rem;
      color: #111;
      font-weight: 500;
    }

    .apply-btn-wrap {
      margin-top: 30px;
    }

    /* ══════════════════════════════
       APPLY FORM PAGE
    ══════════════════════════════ */
    .apply-wrap {
      background: #fff;
      min-height: auto !important;
    }

    .apply-header {
      padding: 40px 48px 24px;
      border-bottom: 1px solid #eee;
    }

    .apply-header h2 {
      font-size: 1.6rem;
      font-weight: 700;
      margin-bottom: 8px;
    }

    .apply-header p {
      font-size: 0.85rem;
      color: #555;
      line-height: 1.55;
      max-width: 560px;
    }

    .apply-header .section-actions {
      margin-top: 18px;
    }

    .apply-body {
      padding: 36px 48px 48px;
      max-width: 540px;
    }

    .apply-body h3 {
      font-size: 1.2rem;
      font-weight: 700;
      margin-bottom: 6px;
    }

    .apply-body > p {
      font-size: 0.82rem;
      color: #555;
      margin-bottom: 22px;
      line-height: 1.5;
    }

    .form-group {
      margin-bottom: 16px;
    }

    .form-group label {
      display: block;
      font-size: 0.78rem;
      font-weight: 600;
      color: #333;
      margin-bottom: 5px;
    }

    .form-group label .req {
      color: #d32f2f;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%;
      border: 1px solid #ccc;
      border-radius: 3px;
      padding: 9px 12px;
      font-size: 0.83rem;
      color: #111;
      background: #fff;
      outline: none;
      transition: border-color 0.15s;
      font-family: inherit;
    }

    .form-group input:focus,
    .form-group textarea:focus {
      border-color: #999;
    }

    .form-group textarea {
      resize: vertical;
      min-height: 90px;
    }

    .upload-btn {
      padding: 7px 16px;
      background: #f5f5f5;
      border: 1px solid #ccc;
      font-size: 0.78rem;
      font-weight: 600;
      cursor: pointer;
      border-radius: 3px;
      color: #333;
      transition: background 0.15s;
    }

    .upload-btn:hover {
      background: #eee;
    }

    .checkbox-row {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      margin: 20px 0;
    }

    .checkbox-row input[type="checkbox"] {
      margin-top: 2px;
      cursor: pointer;
    }

    .checkbox-row label {
      font-size: 0.78rem;
      color: #555;
      line-height: 1.5;
      cursor: pointer;
    }

    .submit-btn {
      width: 100%;
      padding: 12px;
      background: #d32f2f;
      color: #fff;
      border: none;
      font-size: 0.85rem;
      font-weight: 700;
      cursor: pointer;
      border-radius: 3px;
      transition: background 0.15s;
      letter-spacing: 0.3px;
    }

    .submit-btn:hover {
      background: #b71c1c;
    }

    .back-link {
      display: inline-block;
      font-size: 0.78rem;
      color: #555;
      cursor: pointer;
      margin-bottom: 4px;
      text-decoration: underline;
    }

    .back-link:hover {
      color: #111;
    }
      #wrapper {
    min-height: 0 !important;
    height: auto !important;
    display: block !important;
  }
  </style>
  <style>
  #wrapper {
    min-height: 0 !important;
    height: auto !important;
    display: block !important;
  }
  #page-detail,
  #page-apply {
    display: none !important;
    height: 0 !important;
    overflow: hidden !important;
    padding: 0 !important;
    margin: 0 !important;
    border: 0 !important;
  }
</style>
<style>
  html, body, #wrapper, .page-wrapper, .site-wrapper, main, #main {
    min-height: 0 !important;
    height: auto !important;
    display: block !important;
    flex: none !important;
  }
  body {
    display: block !important;
  }
  footer, .footer, #footer, .site-footer {
    margin-top: 0 !important;
  }
</style>
</head>

<body>
  <?php include_once "config/header-top.php"; ?>

  <div id="wrapper">
    <?php include_once "config/header.php"; ?>

    <!-- ════════════════════════════
         PAGE: CAREERS LIST
    ════════════════════════════ -->
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
        <h2>Careers</h2>
        <p>
          From smart tech to seamless commerce, we help businesses grow faster.<br>
          Discover where you fit in at Subtech and make an impact.<br>
          Subscribe to stay updated on new opportunities and join our mission to power the future of Electrical
          Automation.
        </p>
        <div class="section-actions">
          <button class="btn-outline">View All Jobs</button>
          <button class="btn-red">Subscribe</button>
        </div>
      </div>

      <div class="jobs-wrapper">

        <div class="job-card active"
          onclick="showDetail('Full Stack Developer','Full-time','2+ years','Chennai, Madurai, Coimbatore')">
          <h3>Full Stack Developer</h3>
          <div class="tags">
            <span class="tag">Full-time</span>
            <span class="tag">2+ years</span>
          </div>
          <p>Primary Responsibility: Designing and implementing user interfaces using HTML, CSS, and JavaScript
            frameworks like React or Angular. Building and maintaining server-side application logic, databases…</p>
        </div>

        <div class="job-card"
          onclick="showDetail('React Developer','Full-time','2+ years','Chennai, Madurai, Coimbatore')">
          <h3>React Developer</h3>
          <div class="tags">
            <span class="tag">Full-time</span>
            <span class="tag">2+ years</span>
          </div>
          <p>Primary Responsibility: Designing and implementing user interfaces using HTML, CSS, and JavaScript
            frameworks like React or Angular. Building and maintaining server-side application logic, databases…</p>
        </div>

        <div class="job-card"
          onclick="showDetail('Flutter Developer','Full-time','2+ years','Chennai, Madurai, Coimbatore')">
          <h3>Flutter Developer</h3>
          <div class="tags">
            <span class="tag">Full-time</span>
            <span class="tag">2+ years</span>
          </div>
          <p>Primary Responsibility: Designing and implementing user interfaces using HTML, CSS, and JavaScript
            frameworks like React or Angular. Building and maintaining server-side application logic, databases…</p>
        </div>

        <div class="job-card"
          onclick="showDetail('Php Developer','Full-time','2+ years','Chennai, Madurai, Coimbatore')">
          <h3>Php Developer</h3>
          <div class="tags">
            <span class="tag">Full-time</span>
            <span class="tag">2+ years</span>
          </div>
          <p>Primary Responsibility: Designing and implementing user interfaces using HTML, CSS, and JavaScript
            frameworks like React or Angular. Building and maintaining server-side application logic, databases…</p>
        </div>

        <div class="job-card"
          onclick="showDetail('Mern Stack Developer','Full-time','2+ years','Chennai, Madurai, Coimbatore')">
          <h3>Mern Stack Developer</h3>
          <div class="tags">
            <span class="tag">Full-time</span>
            <span class="tag">2+ years</span>
          </div>
          <p>Primary Responsibility: Designing and implementing user interfaces using HTML, CSS, and JavaScript
            frameworks like React or Angular. Building and maintaining server-side application logic, databases…</p>
        </div>

      </div>

    </div>


    <!-- ════════════════════════════
         PAGE: JOB DETAIL
    ════════════════════════════ -->
    <div id="page-detail">

      <div class="careers-hero">
        <img src="<?= BASE_PATH ?>images/careers.png" alt="Careers at Subtech" class="careers-hero-img">
        <div class="careers-hero-overlay">
          <div class="careers-hero-text">
            <h1 id="detail-title">Full Stack Developer</h1>
          </div>
        </div>
      </div>

      <div class="detail-wrap">
        <div class="detail-header">
          <span class="back-link" onclick="showList()">← Back to all jobs</span>
          <h2 id="detail-heading">Full Stack Developer</h2>
          <p>
            From smart tech to seamless commerce, we help businesses grow faster.<br>
            Discover where you fit in at Subtech and make an impact.<br>
            Subscribe to stay updated on new opportunities and join our mission to power the future of Electrical
            Automation.
          </p>
          <div class="section-actions">
            <button class="btn-outline" onclick="showList()">All Jobs</button>
            <button class="btn-red" onclick="showApply()">Apply Now</button>
          </div>
        </div>

        <div class="detail-body">

          <div class="detail-section">
            <h4>About Subtech</h4>
            <p>Subtech operates in electrical and automation solutions including motor starters, AMP panels, automatic
              changeover switches, LT/Control panels, and related power-control equipment.</p>
          </div>

          <div class="detail-section">
            <h4>Key Responsibilities</h4>
            <p>Designing and implementing user interfaces using HTML, CSS, and JavaScript frameworks like React or
              Angular. Building and maintaining server-side application logic, databases, and APIs using technologies
              such as Node.js, Python, Ruby, Java, etc. Managing databases (SQL or NoSQL) to ensure data integrity and
              efficient retrieval. Using efficient version-control systems like Git to manage code changes and
              collaborate with other developers. Implementing security best practices to protect applications from
              vulnerabilities and threats. Automating deployment processes and managing CI/CD pipelines to streamline
              development and release cycles. Working with cross-functional teams, including designers, product
              managers, and other developers, to deliver high-quality software.</p>
          </div>

          <div class="detail-section">
            <h4>Job Specification</h4>
            <ul>
              <li>Proficiency in front-end technologies HTML, CSS, JavaScript frameworks like React or Angular</li>
              <li>Proficiency in back-end technologies Node.js, Python, Ruby, Java, etc.</li>
              <li>Experience in designing and managing databases (SQL and NoSQL)</li>
              <li>Proficiency in schema design and query optimization</li>
              <li>Strong knowledge of version-control systems, particularly Git</li>
              <li>Expertise in managing and collaborating on work repositories</li>
              <li>Knowledge of web-security best practices</li>
              <li>Experience with performance optimization techniques</li>
              <li>Excellent collaboration skills for working effectively in a team environment</li>
              <li>Ability to communicate technical concepts to non-technical stakeholders</li>
            </ul>
          </div>

          <div class="detail-section">
            <div class="meta-grid">
              <div class="meta-item">
                <label>Employment Type</label>
                <span>Full Time</span>
              </div>
              <div class="meta-item">
                <label>Experience Required</label>
                <span id="detail-exp">Minimum 2 Years</span>
              </div>
              <div class="meta-item">
                <label>Job Location</label>
                <span id="detail-loc">Chennai, Madurai, Coimbatore</span>
              </div>
            </div>
          </div>

          <div class="detail-section">
            <h4>Why Subtech</h4>
            <ul>
              <li>Work with a trusted and growing brand in electrical &amp; automation.</li>
              <li>Supportive, performance-driven culture with room for career growth.</li>
            </ul>
          </div>

          <div class="apply-btn-wrap">
            <button class="btn-red" onclick="showApply()">Apply Now</button>
          </div>

        </div>
      </div>

    </div>


    <!-- ════════════════════════════
         PAGE: APPLY FORM
    ════════════════════════════ -->
    <div id="page-apply">

      <div class="careers-hero">
        <img src="<?= BASE_PATH ?>images/careers.png" alt="Careers at Subtech" class="careers-hero-img">
        <div class="careers-hero-overlay">
          <div class="careers-hero-text">
            <h1 id="apply-title">Full Stack Developer</h1>
          </div>
        </div>
      </div>

      <div class="apply-wrap">
        <div class="apply-header">
          <span class="back-link" onclick="showDetail()">← Back to job detail</span>
          <h2 id="apply-heading">Full Stack Developer</h2>
          <p>
            From smart tech to seamless commerce, we help businesses grow faster.<br>
            Discover where you fit in at Subtech and make an impact.<br>
            Subscribe to stay updated on new opportunities and join our mission to power the future of Electrical
            Automation.
          </p>
          <div class="section-actions">
            <button class="btn-outline" onclick="showList()">All Jobs</button>
            <button class="btn-red">Subscribe</button>
          </div>
        </div>

        <div class="apply-body">
          <h3>Apply Now</h3>
          <p>Join the Subtech Team by filling out the form below.</p>

          <form onsubmit="handleSubmit(event)">

            <div class="form-group">
              <label>Applying for:</label>
              <input type="text" id="applying-for" readonly />
            </div>

            <div class="form-group">
              <label>Full Name <span class="req">*</span></label>
              <input type="text" required />
            </div>

            <div class="form-group">
              <label>Email Address</label>
              <input type="email" />
            </div>

            <div class="form-group">
              <label>Mobile Number <span class="req">*</span></label>
              <input type="tel" required />
            </div>

            <div class="form-group">
              <label>Total Years of Experience <span class="req">*</span></label>
              <input type="text" required />
            </div>

            <div class="form-group">
              <label>Previous Job Title</label>
              <input type="text" />
            </div>

            <div class="form-group">
              <label>LinkedIn Profile link</label>
              <input type="url" />
            </div>

            <div class="form-group">
              <label>Cover Letter</label>
              <textarea rows="5"></textarea>
            </div>

            <div class="form-group">
              <label>Upload Your Resume <span class="req">*</span></label>
              <br />
              <input type="file" id="resume-file" style="display:none" accept=".pdf,.doc,.docx" required />
              <button type="button" class="upload-btn" onclick="document.getElementById('resume-file').click()">Choose
                File</button>
              <span id="file-name" style="font-size:0.78rem;color:#555;margin-left:10px;"></span>
            </div>

            <div class="checkbox-row">
              <input type="checkbox" id="confirm-check" required />
              <label for="confirm-check">I confirm that all the information above is accurate</label>
            </div>

            <button type="submit" class="submit-btn">Submit Application</button>

          </form>
        </div>
      </div>

    </div>
    <div class="margin-top:-20px;"> <?php include_once "config/footer.php"; ?></div>

   
  </div>

  <?php include_once "config/mobile_menu.php"; ?>
  <div class="margin-top:-20px;"> <?php include_once "config/foot.php"; ?></div>

 <script>
    let currentJob = { title: 'Full Stack Developer', exp: 'Minimum 2 Years', loc: 'Chennai, Madurai, Coimbatore' };

    function hidePage(id) {
      document.getElementById(id).style.cssText = 'display:none !important;height:0 !important;overflow:hidden !important;padding:0 !important;margin:0 !important;';
    }

    function showPage(id) {
      document.getElementById(id).style.cssText = 'display:block !important;height:auto !important;overflow:visible !important;';
    }

    function showList() {
      showPage('page-list');
      hidePage('page-detail');
      hidePage('page-apply');
      window.scrollTo(0, 0);
    }

    function showDetail(title, type, exp, loc) {
      document.querySelectorAll('.job-card').forEach(c => c.classList.remove('active'));
      if (event && event.currentTarget) event.currentTarget.classList.add('active');

      currentJob = {
        title: title || currentJob.title,
        exp: exp ? 'Minimum ' + exp : currentJob.exp,
        loc: loc || currentJob.loc
      };

      document.getElementById('detail-title').textContent = currentJob.title;
      document.getElementById('detail-heading').textContent = currentJob.title;
      document.getElementById('detail-exp').textContent = currentJob.exp;
      document.getElementById('detail-loc').textContent = currentJob.loc;

      hidePage('page-list');
      showPage('page-detail');
      hidePage('page-apply');
      window.scrollTo(0, 0);
    }

    function showApply() {
      document.getElementById('apply-title').textContent = currentJob.title;
      document.getElementById('apply-heading').textContent = currentJob.title;
      document.getElementById('applying-for').value = currentJob.title;

      hidePage('page-list');
      hidePage('page-detail');
      showPage('page-apply');
      window.scrollTo(0, 0);
    }

    // Hide detail & apply on page load
    hidePage('page-detail');
    hidePage('page-apply');

    document.getElementById('resume-file').addEventListener('change', function () {
      document.getElementById('file-name').textContent = this.files[0] ? this.files[0].name : '';
    });

    function handleSubmit(e) {
      e.preventDefault();
      alert('Application submitted successfully! We will get back to you soon.');
    }
</script>
</body>



</html>