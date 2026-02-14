<?php
include_once "./config/config.inc.php";
$cat=$_GET['cat'];
$tag=str_replace("-"," ",$_GET['tag']);
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>High-Quality Motor Stator, AMF Panel & LT Panel Manufacturer | Subtech</title>
	<meta name="title" content="High-Quality Motor Stator, AMF Panel & LT Panel Manufacturer | Subtech">
	 <meta name="description" content="Explore expert insights and updates from Subtech – a leading manufacturer of Motor Stators, AMF Panels, and LT Panels. Stay informed on the latest in power control solutions.">
	 <meta property="og:type" content="Website">
		<meta name="og:title" content="High-Quality Motor Stator, AMF Panel & LT Panel Manufacturer | Subtech">
		<meta name="og:description" content="Explore expert insights and updates from Subtech – a leading manufacturer of Motor Stators, AMF Panels, and LT Panels. Stay informed on the latest in power control solutions.">
		<meta property="og:image:width" content="250" >
		<meta property="og:image:height" content="250" >
		<meta name="og:site_name" content="www.microelectra.in" >
		<meta property="og:url" content="https://subtech.in/blogs/">
		<meta name="og:image" content="https://subtech.in/images/subtech.jpg" >
		<meta property="og:image:url" content="https://subtech.in/images/subtech.jpg" >
		<meta name="robots" content="ALL" >
		<meta name="revisit-after" content="7 days" >
		<meta name="generator" content="Subtech - SS Power System" >
		<meta name="author" content="Subtech - SS Power System" >
		<meta name="publisher" content="Subtech - SS Power System" >
		<link rel="canonical" href="https://subtech.in/blogs/" >
		
		<?php include_once"config/head.php";?>
	
		

</head>

<body>
	
	<?php include_once"config/header-top.php";?>

    <div id="wrapper">
     
	 <?php include_once"config/header.php";?>
		 <!-- Latest Tip -->
        <section class="flat-spacing-4 mt-2">
            <div class="container">
                <div class="flat-title box-title">
                        <h1 class="title font-7">Our Blogs </h1>
						  <h6 class="title" style="color:#e93132">Stay connected with Subtech – where reliability meets innovation.</h6>
                        <p class="desc text-main text-md">Our blog is your trusted source for industry insights, product innovations, maintenance tips, and the latest trends in power control systems.</p>
                    </div>
				 </div>
        </section>
        <!-- /Latest Tip -->
		
		<section class="s-blog-list-v2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="sidebar-blog d-lg-grid d-none sidebar-content-wrap type-left">
                            <div class="sb-item sb-contact sticky-top" style="top: 101.996px;">
                                <p class="sb-title text-xl fw-medium">Categories</p>
                                <div class="sb-content">
                                    <ul class="category-blog-list">
		<?php 
			$qr=$db->query("select * from mi_bcat where mi_status='Yes' order by cat_name");
			if($qr->num_rows){
				while($crow=$qr->fetch_assoc()){
					echo '<li>
							<a href="'.BASE_PATH.'blogs/'.$crow['urlname'].'" class="text-md link">
								'.$crow['cat_name'].'
							</a>
						</li>';
				}
			}
		?>		
                                        
                                       <!-- <li>
                                            <a href="Motor Stator" class="text-md link">
                                                Motor Stator
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="text-md link">
                                                AMF Panel
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="text-md link">
                                                LT Panel
                                            </a>
                                        </li>
                                        <li>
                                            <a href="" class="text-md link">
                                              Street Light
                                            </a>
                                        </li>-->
                                    </ul>
                                </div>
                            </div>
                           
                         
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="s-blog-list-grid grid-2">
                            
<?php 
if($cat!=""){
	$qr=$db->query("select a.id,a.dop,a.author,a.title,a.urlname,a.sdes,a.image, b.cat_name,b.urlname as cat_url, count(c.id) as cmt from mi_blogs a left join mi_bcat b on a.cat_id=b.id left join mi_comment c on a.id=c.blog_id where b.urlname=? and a.mi_status='Yes' GROUP BY a.id, a.dop, a.title, a.urlname, a.sdes, a.image, b.cat_name, b.urlname order by a.id desc limit 6",[$cat]);
}else if($tag!=""){
	$qr=$db->query("select a.id,a.dop,a.title,a.urlname,a.sdes,a.author,a.image,a.mtags, b.cat_name,b.urlname as cat_url, count(c.id) as cmt from mi_blogs a left join mi_bcat b on a.cat_id=b.id left join mi_comment c on a.id=c.blog_id where find_in_set(?,a.mtags) and a.mi_status='Yes' GROUP BY a.id, a.dop, a.title, a.urlname, a.sdes, a.image, b.cat_name, b.urlname order by a.id desc limit 6",[$tag]);
}else{
	$qr=$db->query("select a.id,a.dop,a.title,a.urlname,a.sdes,a.author,a.image, b.cat_name,b.urlname as cat_url, count(c.id) as cmt from mi_blogs a left join mi_bcat b on a.cat_id=b.id left join mi_comment c on a.id=c.blog_id where a.mi_status='Yes' GROUP BY a.id, a.dop, a.title, a.urlname, a.sdes, a.image, b.cat_name, b.urlname order by a.id desc limit 6");
//echo "ok";
}

while($row=$qr->fetch_assoc()){
	?>
<div class="blog-item hover-img">	
	<div class="">
		<a href="<?=BASE_PATH?>blog/<?=$row['urlname']?>" class="img-style">
			<img src="<?=BASE_PATH?>images/blog_img/<?=$row['image']?>" data-src="<?=BASE_PATH?>images/blog_img/<?=$row['image']?>" alt="generator automation" class=" ls-is-cached lazyloaded">
		</a>
	</div>
	<div class="blog-content">
		<div class="entry-tag">
			<ul class="style-list">
				<li>
					<a href="<?=BASE_PATH?>bcat/<?=$row['cat_url']?>" class="type-life">
						<?=$row['cat_name']?>
					</a>
				</li>
			</ul>
		</div>
		<a href="<?=BASE_PATH?>blog/<?=$row['urlname']?>" class="entry_title d-block text-xl fw-medium link">
			<?=$row['title']?>
		</a>
		<p class="entry_sub text-md text-main">
		<?=$row['sdes']?>
		
		</p>
		<ul class="entry-meta">
			<li class="entry_author">
			
				<p class="entry_name text-md">
					Post by <span class="fw-medium"> <?=$row['author']?> </span>
				</p>
			</li>
			<li class="br-line"></li>
			<li class="entry_date">
				<p class="text-md">
					<?=date("M d Y",strtotime($row['dop']))?>
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
</div>	
	<?php 
}
?>							
							
                                
								
								
								
								
                            
                        </div>
                    </div>

                </div>
            </div>
        </section>
	 
	 
	 
	 
	 
 <?php include_once"config/footer.php";?> 

   </div>


   
 <?php include_once"config/mobile_menu.php";?>  
 <?php include_once"config/foot.php";?>     
   
   

</body>


</html>