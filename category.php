<?php 
include_once 'config/config.inc.php';
include_once 'Model/class.master.php';
error_reporting(E_ALL);
$cat_slug = $_GET['catid'] ?? '';

$sql = "SELECT c.cat_name as cat_name,c.url_name as cat_url,s.subcat_name as subcat_name,s.url_name as subcat_url,t.cat_name as ptype_name,t.url_name as ptype_url
FROM mi_product p
Join mi_wproduct wp on wp.urlname=p.url_name
JOIN mi_category c ON p.cat_id = c.id
JOIN mi_subcategory s ON p.subcat_id = s.id
join mi_ptype2 pt2 on pt2.id=p.ptype2
JOIN mi_ptype t ON p.ptype = t.id
WHERE c.url_name=? group by t.cat_name";

$result = $db->query($sql,[$cat_slug]);



$data = [];
while ($row = $result->fetch_assoc()) {
    $subcat = $row['subcat_name'];
    $subcat_url = $row['subcat_url'];
    $cat_url = $row['cat_url'];
    
    // Step 2: Group by subcategory
    if (!isset($data[$subcat])) {
        $data[$subcat] = [
            'cat_url'     => $cat_url,
            'subcat_name' => $subcat,
            'subcat_url'  => $subcat_url,
            'ptypes'      => []
        ];
    }

    // Step 3: Add ptype to that subcategory
    $data[$subcat]['ptypes'][] = [
        'ptype_name' => $row['ptype_name'],
        'ptype_url'  => $row['ptype_url']
    ];
}

?>


<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title><?=ucwords(str_replace("-"," ",$cat_slug)) ?> | Subtech  </title>
	 <meta name="description" content="<?=ucwords(str_replace("-"," ",$cat_slug)) ?> | Subtech">
	 <meta property="og:type" content="Website">
		<meta name="og:title" content="Subtech | Motor Stators, AMF Panels & LT Panel Manufacturer">
		<meta name="og:description" content="Subtech is a trusted brand - manufacturer of Motor Stators, AMF Panels, and LT Panels, delivering reliable and efficient power control solutions.">
		<meta property="og:image:width" content="250">
		<meta property="og:image:height" content="250">
		<meta name="og:site_name" content="Subtech">
		<meta property="og:url" content="https://subtech.in/">
		<meta name="og:image" content="https://subtech.in/images/subtech.jpg">
		<meta property="og:image:url" content="https://subtech.in/images/subtech.jpg">
		<meta name="robots" content="ALL">
		<meta name="revisit-after" content="7 days" >
		<meta name="generator" content="Subtech - SS Power System">
		<meta name="author" content="Subtech - SS Power System">
		<meta name="publisher" content="Subtech - SS Power System">
		<link rel="canonical" href="https://subtech.in/">
		<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
		 <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="https://subtech.in/images/logo/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="https://subtech.in/images/logo/favicon.png">
		
    <?php include_once"config/head.php";?>
	
	    <style>

		.section-header {
            font-weight: bold;
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 2rem;
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
            padding: 10px 25px 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%; /* Ensures all cards have the same height */
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
      width: 100%; /* 160px */
      height: 20rem; /* 160px */
    }
    @media (min-width: 768px) {
      .image-frame {
        width: 100%; /* 224px */
        height: 26rem; /* 224px */
      }
	  
	  
    
    </style>
</head>

<body>
	
	<?php include_once"config/header-top.php";?>

    <div id="wrapper">
     
	 <?php include_once"config/header.php";?>
	 
		
		

	
	<section class="container flat-spacing-5" style="background:#f4fcfd">
	    <div class="row px-5">
	        
	        <div class="breadcrumb-sec">
            <div class="container">
                <div class="breadcrumb-wrap">
                    <div class="breadcrumb-list">
                        <a class="breadcrumb-item" href="<?=BASE_PATH;?>">Home</a>
                        
                        <div class="breadcrumb-item dot"><span></span></div>
                        <div class="breadcrumb-item current"><?=ucwords(str_replace("-"," ",$cat_slug)) ?></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Breadcrumb -->
        
        
        <div class="col-12 mb-4">
            <h1 class="section-header">Explore Our <?=ucwords(str_replace("-"," ",$cat_slug)) ?></h1>
        </div>
    </div>
    <div class="row g-4">
	
        
        <?php foreach ($data as $subcat): ?>
    <div class="col-lg-4 col-md-6">
        <div class="product-card">
            <h3 class="product-card-title mb-2">
                <?= htmlspecialchars($subcat['subcat_name']) ?>
            </h3>
            
            <div class="justify-content-center">
                <?php foreach ($subcat['ptypes'] as $ptype): ?>
                    <?php 
                        $ptype_link = BASE_PATH.'products/' 
                                      . htmlspecialchars($subcat['cat_url']) . '/' 
                                      . htmlspecialchars($subcat['subcat_url']) . '/' 
                                      . htmlspecialchars($ptype['ptype_url']);
                    ?>
                    <a href="<?= $ptype_link ?>" class="view-now-link">
                        <?= htmlspecialchars($ptype['ptype_name']) ?> <span class="arrow">&rarr;</span>
                    </a><br>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
        <!-- Card 2 
        <div class="col-lg-4 col-md-6">
            <div class="product-card">
                <h3 class="product-card-title">Lighting & Automation</h3>
               
				<div  class=" justify-content-center" >
                
				<a href="#" class="view-now-link">
                    View Now <span class="arrow">&rarr;</span>
                </a>
				</div>
               
            </div>
        </div>
        -->
        <!-- Card 3 -->
       
    </div>
	</section>




	
	
	   
       

	<?php include_once"config/footer.php";?>








   </div>


 <?php include_once"modals/all.php";?>
   
 <?php include_once"config/mobile_menu.php";?>  
 <?php include_once"config/foot.php";?>     
   
   
   
   
   
   
   
   
   
 <script>  
 $(document).ready(function(){
   $("body").on("keypress",".name",function(e){
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

	$("body").on("submit","#cnt_form",function(e){
		e.preventDefault();
		var mob=$("#mob").val().trim();
		//alert(mob);
		if(mob && !validateMobileNumber(mob)){
			$("#msg").html("<span class='alert alert-danger'>Enter Valid Mobile Number</span>");
			$("#mob").focus();
			setTimeout(function(){$("#msg").html("");},2500);
			return false;
		}
		$("#btnSubmit").attr("disabled",true).html("Wait...");
		$.ajax({
			url:'<?php echo BASE_PATH;?>Controller/Master/',
			type:'post',
			data:new FormData(this),
			contentType: false,       
			cache: false,            
			processData:false,
			success:function(data){
			$("#btnSubmit").attr("disabled",false).html("Submit");
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					$("#msg").html(response.message);
					setTimeout(function(){window.location.reload();},2500);
				}else{
					$("#msg").html(response.message);
				}	
			}
			
		});
	});
	
  });
  </script>    
   




   
   
</body>


</html>