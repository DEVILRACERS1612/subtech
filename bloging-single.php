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

    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet"/>

    <style>
        :root {
            --orange: #E85D04;
            --orange-light: #FF8B35;
            --dark: #111111;
            --mid: #444444;
            --soft: #777777;
            --border: #E5E5E5;
            --bg: #FAFAFA;
            --white: #FFFFFF;
            --tag-bg: #FFF1E6;
            --tag-text: #C44A00;
            --max-width: 740px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--dark);
            line-height: 1.7;
            font-size: 16px;
        }

        /* ── BREADCRUMB ── */
        .s-breadcrumb {
            max-width: 900px; margin: 32px auto 0; padding: 0 40px;
            font-size: 13px; color: var(--soft);
            display: flex; align-items: center; gap: 6px;
        }
        .s-breadcrumb a { color: var(--soft); text-decoration: none; }
        .s-breadcrumb a:hover { color: var(--orange); }
        .s-breadcrumb span { color: var(--border); }

        /* ── SECTION ── */
        .s-blog-single { padding: 36px 0 80px; }

        article {
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ── POST META ── */
        .post-meta {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 18px; flex-wrap: wrap;
        }
        .cat-tag {
            background: var(--tag-bg); color: var(--tag-text);
            font-size: 11px; font-weight: 600; letter-spacing: 0.08em;
            text-transform: uppercase; padding: 4px 10px; border-radius: 4px;
            text-decoration: none; transition: background 0.2s, color 0.2s;
        }
        .cat-tag:hover { background: var(--orange); color: #fff; }
        .post-date, .read-time { font-size: 13px; color: var(--soft); }
        .dot { color: #ccc; }

        /* ── TITLE ── */
        h1.entry_title {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(28px, 5vw, 42px);
            line-height: 1.2; color: var(--dark);
            margin-bottom: 20px; font-weight: 400;
        }

        /* ── BYLINE ── */
        .entry-meta {
            display: flex; align-items: center; gap: 10px;
            flex-wrap: wrap; list-style: none; margin-bottom: 0;
            padding: 0;
        }
        .entry-meta li { display: flex; align-items: center; gap: 8px; }
        .entry-meta .avatar img {
            width: 30px; height: 30px;
            border-radius: 50%; object-fit: cover;
        }
        .entry-meta .entry_name {
            background: #FFF1E6; border-radius: 20px;
            padding: 4px 12px; font-size: 13px; color: var(--mid);
            margin: 0;
        }
        .entry-meta .entry_name span { font-weight: 600; color: var(--dark); }
        .entry-meta .entry_date,
        .entry-meta .entry_comment {
            background: #FFF1E6; border-radius: 20px;
            padding: 4px 12px; font-size: 13px; color: var(--mid);
            margin: 0;
        }
        .entry-meta .br-line {
            width: 1px; height: 16px;
            background: var(--border); display: inline-block;
        }

        /* ── SHARE BAR ── */
        .share-bar {
            display: flex; align-items: center; gap: 10px;
            padding: 16px 0;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            margin: 20px 0 36px;
            flex-wrap: wrap;
        }
        .share-label {
            font-size: 12px; color: var(--soft); font-weight: 500;
            text-transform: uppercase; letter-spacing: 0.07em;
        }
        .share-btn {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 13px; font-weight: 500; color: var(--mid);
            background: var(--white); border: 1px solid var(--border);
            padding: 5px 14px; border-radius: 5px;
            cursor: pointer; text-decoration: none;
            font-family: 'DM Sans', sans-serif;
            transition: border-color 0.2s, color 0.2s;
        }
        .share-btn:hover { border-color: var(--orange); color: var(--orange); }

        /* ── HERO IMAGE ── */
        .entry_image { margin-bottom: 36px; }
        .entry_image img {
            width: 100%; border-radius: 10px; display: block;
            border: 1px solid var(--border);
            object-fit: cover; aspect-ratio: 16/9;
        }

        /* ── BODY TEXT ── */
        .text {
            font-size: 17px; color: #2a2a2a;
            line-height: 1.8; margin-bottom: 24px;
            display: block;
        }

        /* ── TAGS ── */
        .entry-tag {
            display: flex; align-items: center; gap: 10px;
            flex-wrap: wrap; margin: 36px 0 28px;
            padding-top: 28px; border-top: 1px solid var(--border);
        }
        .entry-tag p {
            font-size: 13px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.07em;
            color: var(--soft); margin: 0;
        }
        .entry-tag .style-list {
            display: flex; flex-wrap: wrap; gap: 8px; list-style: none; padding: 0;
        }
        .entry-tag .style-list li a {
            background: #FFF1E6; color: var(--tag-text);
            padding: 5px 14px; border-radius: 20px;
            font-size: 13px; text-decoration: none;
            font-weight: 500; transition: 0.2s;
        }
        .entry-tag .style-list li a:hover { background: var(--orange); color: #fff; }

        /* ── PREV / NEXT ── */
        .related-post {
            display: flex; justify-content: space-between;
            gap: 14px; margin-bottom: 56px;
        }
        .related-post a {
            flex: 1; padding: 18px 20px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 10px; text-decoration: none;
            color: var(--dark); transition: 0.25s;
            display: flex; align-items: center; gap: 12px;
        }
        .related-post a:hover { border-color: var(--orange); background: var(--tag-bg); }
        .related-post a .text-wrap-left p:first-child,
        .related-post a .text-wrap-right p:first-child {
            font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.08em;
            color: var(--orange); margin-bottom: 4px;
        }
        .related-post a .name-post {
            font-size: 14px; font-weight: 600;
            color: var(--dark); line-height: 1.4; margin: 0;
        }
        .related-post a.next { justify-content: flex-end; text-align: right; }
        .related-post .icon { color: var(--orange); font-size: 20px; flex-shrink: 0; }

        /* ── COMMENT FORM ── */
        .modern-comment {
            padding: 45px;
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 24px rgba(0,0,0,0.04);
        }
        .comment-title {
            font-family: 'DM Serif Display', serif;
            font-size: 26px; font-weight: 400;
            margin-bottom: 30px; color: var(--dark);
        }
        .form-modern { width: 100%; }
        .form-row { display: flex; gap: 20px; flex-wrap: wrap; }
        .form-group { flex: 1; display: flex; flex-direction: column; min-width: 200px; }
        .form-group.full { width: 100%; flex: unset; margin-top: 16px; }
        .form-group label {
            font-size: 13px; font-weight: 600;
            margin-bottom: 6px; color: var(--mid);
            text-transform: uppercase; letter-spacing: 0.05em;
        }
        .form-group input,
        .form-group textarea {
            padding: 14px 16px;
            border: 1px solid var(--border);
            border-radius: 8px; font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            transition: 0.3s ease; background: #f9fafb;
            color: var(--dark);
        }
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--orange);
            background: var(--white); outline: none;
            box-shadow: 0 0 0 3px rgba(232,93,4,0.1);
        }
        .notice-text { font-size: 13px; color: var(--soft); margin: 15px 0 25px; }
        .form-message { margin-bottom: 15px; font-size: 14px; }
        .form-submit button {
            background: var(--orange); border: none;
            padding: 14px 32px; border-radius: 8px;
            color: #fff; font-weight: 600; font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer; transition: 0.3s ease;
        }
        .form-submit button:hover {
            background: var(--orange-light);
            transform: translateY(-2px);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .s-breadcrumb { padding: 0 20px; }
            article { padding: 0 16px; }
            .modern-comment { padding: 25px 20px; }
            .form-row { flex-direction: column; }
            .related-post { flex-direction: column; }
        }
        @media (max-width: 480px) {
            .entry-meta { gap: 6px; }
            .share-bar { gap: 8px; }
        }
    </style>
</head>
<body>

    <?php include_once "config/header-top.php"; ?>

    <div id="wrapper">

        <?php include_once "config/header.php"; ?>

        <!-- BREADCRUMB -->
        <div class="s-breadcrumb">
            <a href="<?= BASE_PATH ?>">Home</a>
            <span>/</span>
            <a href="<?= BASE_PATH ?>blogs">Blog</a>
            <span>/</span>
            <a href="<?= BASE_PATH ?>blogs/<?= $row['cat_url'] ?>"><?= $row['cat_name'] ?></a>
            <span>/</span>
            <?= $row['title'] ?>
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
                           target="_blank" rel="noopener" class="share-btn">LinkedIn</a>
                        <a href="https://wa.me/?text=<?= urlencode($row['title'] . ' https://subtech.in/blog/' . $row['urlname']) ?>"
                           target="_blank" rel="noopener" class="share-btn">WhatsApp</a>
                        <button class="share-btn"
                                onclick="navigator.clipboard.writeText(window.location.href).then(()=>this.textContent='Copied!')">
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
                    <p class="text">
                        <?= $row['blogs'] ?>
                    </p>

                    <!-- TAGS -->
                    <div class="bot mt-4">
                        <div class="entry-tag">
                            <p>Tags:</p>
                            <ul class="style-list">
                                <?php
                                $tags = explode(",", $row['mtags']);
                                foreach ($tags as $tag) {
                                    echo '<li><a href="' . BASE_PATH . 'tblogs/' . str_replace(" ", "-", $tag) . '">' . $tag . '</a></li>';
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

    <script>
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