<?php
include_once "./config/config.inc.php";
$url=$_GET['url'];
if($url){
	$qr=$db->query("select a.*, b.cat_name,b.urlname as cat_url, count(c.id) as cmt from mi_blogs a left join mi_bcat b on a.cat_id=b.id left join mi_comment c on c.blog_id=a.id where a.urlname=? and a.mi_status='Yes' order by a.id desc limit 1",[$url]);
	if($qr->num_rows){
		$row=$qr->fetch_assoc();
	}else{
		header('Refresh:1;url='.BASE_PATH);
	}
}else{
	header('Refresh:1;url='.BASE_PATH);
}
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8">
    <title><?=$row['title']?> | Subtech</title>
	<meta name="title" content="<?=$row['mtitle']?>">
	 <meta name="description" content="<?=$row['mdes']?>">
	 <meta property="og:type" content="Website">
		<meta name="og:title" content="<?=$row['mtitle']?>">
		<meta name="og:description" content="<?=$row['mdes']?>">
		<meta property="og:image:width" content="250" >
		<meta property="og:image:height" content="250" >
		<meta name="og:site_name" content="www.subtech.in" >
		<meta property="og:url" content="https://subtech.in/blog/<?=$row['urlname']?>">
		<meta name="og:image" content="https://subtech.in/images/blog_img/<?=$row['image']?>" >
		<meta property="og:image:url" content="https://subtech.in/images/blog_img/<?=$row['image']?>" >
		<meta name="robots" content="ALL" >
		<meta name="revisit-after" content="7 days" >
		<meta name="generator" content="Subtech - SS Power System" >
		<meta name="author" content="Subtech - SS Power System" >
		<meta name="publisher" content="Subtech - SS Power System" >
		<link rel="canonical" href="https://subtech.in/blog/<?=$row['urlname']?>" >
		
		
		<?php include_once"config/head.php";?>
</head>

<body>
	
	<?php include_once"config/header-top.php";?>

    <div id="wrapper">
     
	 <?php include_once"config/header.php";?>
	 
		
		<section class="s-blog-single line-bottom-container">
            <div class="container">
                <div class="heading blog-item">
                    <div class="entry-tag">
                        <ul class="style-list">
                            <li>
                                <a href="<?=BASE_PATH?>blogs/<?=$row['cat_url']?>" class="type-life">
									<?=$row['cat_name']?>
								</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="entry_title display-sm fw-medium">
                        <?=$row['title']?>
                    </h1>
                    <ul class="entry-meta">
                        <li class="entry_author">
                            <div class="avatar">
                                <img src="<?=BASE_PATH?>images/avatar/blog-author-1.jpg" data-src="<?=BASE_PATH?>images/avatar/blog-author-1.jpg" alt="avatar" class=" ls-is-cached lazyloaded">
                            </div>
                            <p class="entry_name text-md">
                                Post by <span class="fw-medium"> <?=$row['author']?> </span>
                            </p>
                        </li>
                        <li class="br-line"></li>
                        <li class="entry_date">
                            <p class="text-md">
                                <?=date("M d Y",strtotime($row['dop']));?>
                            </p>
                        </li>
                        <li class="br-line"></li>
                        <li class="entry_comment">
                            <p class="text-md">
                                <?=$row['cmt']?> comments
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="content">
                    <div class="entry_image">
                        <img src="<?=BASE_PATH?>images/blog_img/<?=$row['image']?>" data-src="<?=BASE_PATH?>images/blog_img/<?=$row['image']?>" alt="<?=$row['alttext']?>" class=" ls-is-cached lazyloaded">
                    </div>
					<p class="text">
						<?=$row['blogs']?>
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
	$tags=explode(",",$row['mtags']);
		foreach($tags as $tag){
			echo '<li><a href="'.BASE_PATH.'tblogs/'.str_replace(" ","-", $tag).'">'.$tag.'</a></li>';
		}
	
	?>					
                            </ul>
                        </div>
                     
                    </div>
                    <div class="related-post">
<?php 
	$pqr=$db->query("select urlname,title from mi_blogs  where id < ? and mi_status='Yes' order by id asc limit 1",[$row['id']]);
	if($pqr->num_row){
		$prow=$pqr->fetch_assoc();
		?>
		<a href="<?=BASE_PATH?>blog/<?=$prow['urlname']?>" class="post prev">
			<div class="icon">
				<i class="icon-arr-left"></i>
			</div>
			<div class="text-wrap-left">
				<p>PREVIOUS POST</p>
				<p class="name-post"><?=$prow['title']?>
				</p>
			</div>
		</a>
		<?php 
	}
	
	
	$nqr=$db->query("select urlname,title from mi_blogs  where id > ? and mi_status='Yes' order by id desc limit 1",[$row['id']]);
	if($nqr->num_row){
		$nrow=$nqr->fetch_assoc();
		?>
		<a href="<?=BASE_PATH?>blog/<?=$nrow['urlname']?>" class="post next">
			<div class="text-wrap-right">
				<p>PREVIOUS POST</p>
				<p class="name-post"><?=$nrow['title']?>
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
                <div class="leave-comment-wrap">
                    <p class="title">
                        Leave a comment
                    </p>
                    <form action="#" id="cmt_form" class="form-default">
					<input type="hidden" name="_token" value="<?=$post_id?>" />
					<input type="hidden" name="blog_id" value="<?=$row['id']?>" />
					<input type="hidden" name="method" value="Comment" />
                        <div class="wrap">
                            <div class="cols">
                                <fieldset>
                                    <label for="username">Your name*</label>
                                    <input id="username" type="text" name="fname" required="">
                                </fieldset>
                                <fieldset>
                                    <label for="email">Your email*</label>
                                    <input id="email" type="email" name="email" required="">
                                </fieldset>
                            </div>
                            <div class="cols">
                                <fieldset class="textarea">
                                    <label for="mess">Your comment*</label>
                                    <textarea id="mess" name="message" required=""></textarea>
                                </fieldset>
                            </div>
                            <p class="notice">
                                Please note, your email won't be published.
                            </p>
							<p id="cmt_error"></p>
                            <div class="button-submit">
                                <button class="tf-btn text-sm animate-btn text-transform-none" id="btnSubmit" type="submit"> Post Comment </button>
                            </div>
                        </div>
                    </form>
					
                </div>
            </div>
        </section>
	 
	 
	 
	 
 <?php include_once"config/footer.php";?> 

   </div>


   
 <?php include_once"config/mobile_menu.php";?>  
 <?php include_once"config/foot.php";?>     
   
   
   
<script>   
	$(document).ready(function(){
		$("#cmt_form").on("submit",function(e){
			e.preventDefault();
			$("#btnSubmit").html("Sending, wait...").attr("disabled", true);
			$.ajax({
				url:'<?php echo BASE_PATH;?>Controller/Master/',
				type:'post',
				data:new FormData(this),
				contentType: false,       
				cache: false,            
				processData:false,
				success:function(data){
					var response=(JSON.parse(data));
					$("#cmt_error").html(response.message);
					if(response.type=="success")
					{
						$("#cmt_form").trigger("reset");
						
						setTimeout(function(){$("#cmt_error").html("");$("#btnSubmit").html("Post Comment").attr("disabled", false);},2500);
					}else{
						$("#btnSubmit").html("Post Comment").attr("disabled", false);
					}	
				}
				
			});
		});
	});
   
</script>   
   
   
   
   




   
   
</body>


</html>