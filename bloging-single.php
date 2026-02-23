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
    <style>
    body {
        background: #f5f7fa;
    }

    .s-blog-single {
        padding: 60px 0;
    }

    .heading {
        text-align: center;
        margin-bottom: 40px;
    }

    .entry_title {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .entry-meta {
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
        color: #6b7280;
        font-size: 14px;
    }

    .content {
        background: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .entry_image img {
        width: 100%;
        border-radius: 10px;
        margin-bottom: 25px;
    }

    .content .text {
        font-size: 16px;
        line-height: 1.8;
        color: #374151;
    }
    /* Modern Comment Form */
.modern-comment {
    margin-top: 60px;
    padding: 45px;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.comment-title {
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 30px;
}

.form-modern {
    width: 100%;
}

.form-row {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.form-group {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.form-group.full {
    width: 100%;
}

.form-group label {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #374151;
}

.form-group input,
.form-group textarea {
    padding: 14px 16px;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    font-size: 14px;
    transition: 0.3s ease;
    background: #f9fafb;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: #dc3545;
    background: #ffffff;
    outline: none;
    box-shadow: 0 0 0 3px rgba(220,53,69,0.1);
}

.notice-text {
    font-size: 13px;
    color: #6b7280;
    margin: 15px 0 25px;
}

.form-message {
    margin-bottom: 15px;
    font-size: 14px;
}

.form-submit button {
    background: #dc3545;
    border: none;
    padding: 14px 28px;
    border-radius: 10px;
    color: #ffffff;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: 0.3s ease;
}

.form-submit button:hover {
    background: #b02a37;
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
    .modern-comment {
        padding: 25px;
    }

    .form-row {
        flex-direction: column;
    }
}

    /* Tags */
    .entry-tag ul li a {
        background: #f1f5f9;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        text-decoration: none;
        color: #111827;
        transition: .3s;
    }

    .entry-tag ul li a:hover {
        background: #dc3545;
        color: #fff;
    }

    /* Previous & Next */
    .related-post {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
        gap: 20px;
    }

    .related-post a {
        flex: 1;
        padding: 20px;
        background: #f9fafb;
        border-radius: 10px;
        text-decoration: none;
        color: #111827;
        transition: .3s;
    }

    .related-post a:hover {
        background: #dc3545;
        color: #fff;
    }

    /* Comment Section */
    .leave-comment-wrap {
        margin-top: 60px;
        background: #fff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .leave-comment-wrap input,
    .leave-comment-wrap textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        margin-top: 5px;
        margin-bottom: 20px;
        transition: .3s;
    }

    .leave-comment-wrap input:focus,
    .leave-comment-wrap textarea:focus {
        border-color: #dc3545;
        outline: none;
    }

    .button-submit button {
        background: #dc3545;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        color: #fff;
        font-weight: 600;
        transition: .3s;
    }

    .button-submit button:hover {
        background: #bb2d3b;
    }
</style>
</head>

<body>

    <?php include_once "config/header-top.php"; ?>

    <div id="wrapper">

        <?php include_once "config/header.php"; ?>


        <section class="s-blog-single line-bottom-container">
            <div class="container">
                <div class="heading blog-item">
                    <div class="entry-tag">
                        <ul class="style-list">
                            <li>
                                <a href="<?= BASE_PATH ?>blogs/<?= $row['cat_url'] ?>" class="type-life">
                                    <?= $row['cat_name'] ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="entry_title display-sm fw-medium">
                        <?= $row['title'] ?>
                    </h1>
                    <ul class="entry-meta">
                        <li class="entry_author">
                            <div class="avatar">
                                <img src="<?= BASE_PATH ?>images/avatar/blog-author-1.jpg"
                                    data-src="<?= BASE_PATH ?>images/avatar/blog-author-1.jpg" alt="avatar"
                                    class=" ls-is-cached lazyloaded">
                            </div>
                            <p class="entry_name text-md" style="background:#ffe1e1; border-radius:20px; padding:4px 12px;">
                                Post by <span class="fw-medium"> <?= $row['author'] ?> </span>
                            </p>
                        </li>
                        <li class="br-line"></li>
                        <li class="entry_date"style="background:#ffe1e1; border-radius:20px; padding:4px 12px;">
                            <p class="text-md">
                                <?= date("M d Y", strtotime($row['dop'])); ?>
                            </p>
                        </li>
                        <li class="br-line"></li>
                        <li class="entry_comment" style="background:#ffe1e1; border-radius:20px; padding:4px 12px;">
                            <p class="text-md">
                                <?= $row['cmt'] ?> comments
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="content">
                    <div class="entry_image">
                        <img src="<?= BASE_PATH ?>images/blog_img/<?= $row['image'] ?>"
                            data-src="<?= BASE_PATH ?>images/blog_img/<?= $row['image'] ?>" alt="<?= $row['alttext'] ?>"
                            class=" ls-is-cached lazyloaded">
                    </div>
                    <p class="text">
                        <?= $row['blogs'] ?>
                    </p>
                    <!-- <p class="text">
                        Pellentesque dapibus hendrerit tortor. Nam ipsum risus, rutrum vitae, vestibulum eu,
                        molestie vel, lacus. Sed libero. Phasellus tempus. Etiam feugiat lorem non metus.
                        Morbi mattis ullamcorper velit. Donec sodales sagittis magna. Curabitur a felis in
                        nunc fringilla tristique. Quisque malesuada placerat nisl. Phasellus gravida semper
                        nisi.
                    </p>
                    <p class="text">
                        Curabitur blandit mollis lacus. Phasellus nec sem in justo pellentesque facilisis.
                        Mauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula. Fusce ac felis
                        sit amet ligula pharetra condimentum. Integer tincidunt.
                    </p>
                    <p class="text">Maecenas vestibulum mollis diam. Pellentesque auctor neque nec urna.
                        Pellentesque commodo eros a enim. Etiam sit amet orci eget eros faucibus tincidunt.
                        Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus.In hac
                        habitasse platea dictumst. Etiam ultricies nisi vel augue. Pellentesque egestas,
                        neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo
                        non est. Quisque rutrum. Duis leo.</p>
                    <div class="block-quote">
                        <p>“Pellentesque dapibus hendrerit tortor. Nam ipsum risus, rutrum vitae, vestibulum
                            eu, molestie vel, lacus. Sed libero. Phasellus tempus. Etiam feugiat lorem non
                            metus Maecenas vestibulum mollis diam. Pellentesque auctor neque nec urna.
                            Pellentesque commodo eros a enim. Etiam sit amet orci eget eros faucibus
                            tincidunt.”</p>
                    </div>
                    <p class="text">
                        Curabitur blandit mollis lacus. Phasellus nec sem in justo pellentesque facilisis.
                        Mauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula. Fusce ac felis
                        sit amet ligula pharetra condimentum. Integer tincidunt.
                    </p>
                    <div class="group-image">
                        <div class="entry_image">
                            <img src="./images/blog/blog-single-2.jpg" data-src="./images/blog/blog-single-2.jpg" alt="" class=" ls-is-cached lazyloaded">
                        </div>
                        <div class="entry_image">
                            <img src="./images/blog/blog-single-3.jpg" data-src="./images/blog/blog-single-3.jpg" alt="" class=" ls-is-cached lazyloaded">
                        </div>
                    </div>
                    <p class="text">
                        Maecenas vestibulum mollis diam. Pellentesque auctor neque nec urna. Pellentesque
                        commodo eros a enim. Etiam sit amet orci eget eros faucibus tincidunt. Vestibulum
                        purus quam, scelerisque ut, mollis sed, nonummy id, metus.In hac habitasse platea
                        dictumst. Etiam ultricies nisi vel augue. Pellentesque egestas, neque sit amet
                        convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est. Quisque
                        rutrum. Duis leo.
                    </p>-->
                    <div class="bot mt-4">
                        <div class="entry-tag">
                            <p>
                                Tags:
                            </p>
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
                    <div class="related-post">
                        <?php
                        $pqr = $db->query("select urlname,title from mi_blogs  where id < ? and mi_status='Yes' order by id asc limit 1", [$row['id']]);
                        if ($pqr->num_rows) {
                            $prow = $pqr->fetch_assoc();
                            ?>
                            <a href="<?= BASE_PATH ?>blog/<?= $prow['urlname'] ?>" class="post prev">
                                <div class="icon">
                                    <i class="icon-arr-left"></i>
                                </div>
                                <div class="text-wrap-left">
                                    <p>PREVIOUS POST</p>
                                    <p class="name-post"><?= $prow['title'] ?>
                                    </p>
                                </div>
                            </a>
                        <?php
                        }


                        $nqr = $db->query("select urlname,title from mi_blogs  where id > ? and mi_status='Yes' order by id desc limit 1", [$row['id']]);
                        if ($nqr->num_rows) {
                            $nrow = $nqr->fetch_assoc();
                            ?>
                            <a href="<?= BASE_PATH ?>blog/<?= $nrow['urlname'] ?>" class="post next">
                                <div class="text-wrap-right">
                                    <p>PREVIOUS POST</p>
                                    <p class="name-post"><?= $nrow['title'] ?>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="icon-arr-right2"></i>
                                </div>
                            </a>
                        <?php
                        }

                        ?>

                    </div>
                </div>
              <div class="leave-comment-wrap modern-comment">
    <h3 class="comment-title">Leave a Comment</h3>

    <form action="#" id="cmt_form" class="form-modern">
        <input type="hidden" name="_token" value="<?= $post_id ?>" />
        <input type="hidden" name="blog_id" value="<?= $row['id'] ?>" />
        <input type="hidden" name="method" value="Comment" />

        <div class="form-row">
            <div class="form-group">
                <label for="username">Your Name *</label>
                <input id="username" type="text" name="fname" required>
            </div>

            <div class="form-group">
                <label for="email">Your Email *</label>
                <input id="email" type="email" name="email" required>
            </div>
        </div>

        <div class="form-group full">
            <label for="mess">Your Comment *</label>
            <textarea id="mess" name="message" rows="5" required></textarea>
        </div>

        <p class="notice-text">
            Your email address will not be published.
        </p>

        <div id="cmt_error" class="form-message"></div>

        <div class="form-submit">
            <button id="btnSubmit" type="submit">Post Comment</button>
        </div>
    </form>
</div>
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

                            setTimeout(function () { $("#cmt_error").html(""); $("#btnSubmit").html("Post Comment").attr("disabled", false); }, 2500);
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