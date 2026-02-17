<?php
include_once "./config/config.inc.php";
$cat=$_GET['cat'];
$tag=str_replace("-"," ",$_GET['tag']);

// Function to truncate text
function truncate_text($text, $limit = 150) {
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
	 <meta name="description" content="Explore expert insights and updates from Subtech – a leading manufacturer of Motor Stators, AMF Panels, and LT Panels. Stay informed on the latest in power control solutions.">
	 <meta property="og:type" content="Website">
		<meta name="og:title" content="Latest Blog Posts on Technology & Automation | Subtech">
		<meta name="og:description" content="Explore expert insights and updates from Subtech – a leading manufacturer of Motor Stators, AMF Panels, and LT Panels. Stay informed on the latest in power control solutions.">
		<meta property="og:image:width" content="250" >
		<meta property="og:image:height" content="250" >
		<meta name="og:site_name" content="www.subtech.in" >
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
	
	<style>
	/* Blog Header Section */
	.blog-header-section {
		/* background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); */
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
	
	/* Blog Grid Section */
	.blog-grid-section {
		padding: 60px 0 80px;
		background: #f8f9fa;
	}
	
	.blog-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
		gap: 32px;
		margin-top: 20px;
	}
	
	@media (max-width: 768px) {
		.blog-grid {
			grid-template-columns: 1fr;
			gap: 24px;
		}
	}
	
	/* Blog Card */
	.blog-card {
		background: #ffffff;
		border-radius: 16px;
		overflow: hidden;
		transition: all 0.3s ease;
		box-shadow: 0 2px 12px rgba(0,0,0,0.08);
		display: flex;
		flex-direction: column;
		height: 100%;
	}
	
	.blog-card:hover {
		transform: translateY(-8px);
		box-shadow: 0 12px 24px rgba(0,0,0,0.15);
	}
	
	.blog-card-image {
		position: relative;
		height: 240px;
		overflow: hidden;
		background: #e9ecef;
	}
	
	.blog-card-image img {
		width: 100%;
		height: 100%;
		object-fit: cover;
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
		padding: 28px;
		flex-grow: 1;
		display: flex;
		flex-direction: column;
	}
	
	.blog-card-title {
		font-size: 1.35rem;
		font-weight: 700;
		color: #1a1a1a;
		margin-bottom: 12px;
		line-height: 1.4;
		text-decoration: none;
		display: block;
		transition: color 0.3s ease;
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
			font-size: 1.2rem;
		}
	}
	</style>

</head>

<body>
	
	<?php include_once"config/header-top.php";?>

    <div id="wrapper">
     
	 <?php include_once"config/header.php";?>
	 
	 <!-- Blog Header Section -->
	 <section class="blog-header-section">
		<div class="container">
			<h1 class="blog-main-title">Our Blogs</h1>
			<p class="blog-subtitle">Our blog is your trusted source for industry insights, product innovations, maintenance tips, and the latest trends in power control systems.</p>
		</div>
	 </section>
	 
	 <!-- Category Filter Section -->
	 <section class="category-filter-section">
		<div class="container">
			<div class="filter-buttons">
				<a href="<?=BASE_PATH?>blogs/" class="filter-btn <?=($cat=="" && $tag=="")?'active':''?>">All Posts</a>
				<?php 
					$qr=$db->query("select * from mi_bcat where mi_status='Yes' order by cat_name");
					if($qr->num_rows){
						while($crow=$qr->fetch_assoc()){
							$active_class = ($cat == $crow['urlname']) ? 'active' : '';
							echo '<a href="'.BASE_PATH.'blogs/'.$crow['urlname'].'" class="filter-btn '.$active_class.'">'.$crow['cat_name'].'</a>';
						}
					}
				?>		
			</div>
		</div>
	 </section>
	 
	 <!-- Blog Grid Section -->
	 <section class="blog-grid-section">
		<div class="container">
			<div class="blog-grid">
				<?php 
				if($cat!=""){
					$qr=$db->query("select a.id,a.dop,a.author,a.title,a.urlname,a.sdes,a.image, b.cat_name,b.urlname as cat_url, count(c.id) as cmt from mi_blogs a left join mi_bcat b on a.cat_id=b.id left join mi_comment c on a.id=c.blog_id where b.urlname=? and a.mi_status='Yes' GROUP BY a.id, a.dop, a.title, a.urlname, a.sdes, a.image, b.cat_name, b.urlname order by a.id desc",[$cat]);
				}else if($tag!=""){
					$qr=$db->query("select a.id,a.dop,a.title,a.urlname,a.sdes,a.author,a.image,a.mtags, b.cat_name,b.urlname as cat_url, count(c.id) as cmt from mi_blogs a left join mi_bcat b on a.cat_id=b.id left join mi_comment c on a.id=c.blog_id where find_in_set(?,a.mtags) and a.mi_status='Yes' GROUP BY a.id, a.dop, a.title, a.urlname, a.sdes, a.image, b.cat_name, b.urlname order by a.id desc",[$tag]);
				}else{
					$qr=$db->query("select a.id,a.dop,a.title,a.urlname,a.sdes,a.author,a.image, b.cat_name,b.urlname as cat_url, count(c.id) as cmt from mi_blogs a left join mi_bcat b on a.cat_id=b.id left join mi_comment c on a.id=c.blog_id where a.mi_status='Yes' GROUP BY a.id, a.dop, a.title, a.urlname, a.sdes, a.image, b.cat_name, b.urlname order by a.id desc");
				}
				
				if($qr->num_rows > 0){
					while($row=$qr->fetch_assoc()){
				?>
				<article class="blog-card">
					<div class="blog-card-image">
						<a href="<?=BASE_PATH?>blog/<?=$row['urlname']?>">
							<img src="<?=BASE_PATH?>images/blog_img/<?=$row['image']?>" alt="<?=$row['title']?>">
						</a>
						<span class="blog-card-category"><?=$row['cat_name']?></span>
					</div>
					<div class="blog-card-content">
						<a href="<?=BASE_PATH?>blog/<?=$row['urlname']?>" class="blog-card-title">
							<?=$row['title']?>
						</a>
						<p class="blog-card-excerpt">
							<?=truncate_text($row['sdes'], 150)?>
						</p>
						<a href="<?=BASE_PATH?>blog/<?=$row['urlname']?>" class="read-more-link">
							Read More 
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
							</svg>
						</a>
						<div class="blog-card-meta">
							<div class="blog-card-meta-item">
								<span><?=$row['author']?></span>
							</div>
							<div class="blog-card-meta-divider"></div>
							<div class="blog-card-meta-item">
								<span><?=date("M d, Y",strtotime($row['dop']))?></span>
							</div>
							<div class="blog-card-meta-divider"></div>
							<div class="blog-card-meta-item">
								<span><?=$row['cmt']?> comments</span>
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
					<p>Try selecting a different category or check back later for new content.</p>
				</div>
				<?php 
				}
				?>
			</div>
		</div>
	 </section>
	 
	 
 <?php include_once"config/footer.php";?> 

   </div>

 <?php include_once"config/mobile_menu.php";?>  
 <?php include_once"config/foot.php";?>     
   
</body>

</html>