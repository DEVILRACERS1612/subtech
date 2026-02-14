<?php
include_once "./config/config.inc.php";

function formatNumber($num) {
    if ($num >= 1000) {
        $x = $num / 1000;
        // Agar round number hai (e.g. 1.0) toh .0 hata dega, warna 1.5k dikhayega
        return (fmod($x, 1) != 0) ? number_format($x, 1) . 'k' : number_format($x, 0) . 'k';
    }
    return $num; // Agar 1000 se kam hai toh wahi number dikhayega
}

?>

<!DOCTYPE html>

<!--[if IE 8 ]><html class="ie" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<!--<![endif]-->


<head>
    <meta charset="utf-8">
    <title>Resources | Electrical Automation Guides, Manuals & Insights – Subtech</title>
	 <meta name="description" content="Subtech resource center offers expert knowledge, product documentation, safety guidelines, and automation insights to support efficient power and motor control systems.">
	  <link rel="canonical" href="https://subtech.in/resources">
    <?php include_once"config/head.php";?>


    <style>
        :root {
            --brand-red:#e40006;
            --soft-shadow: 0 10px 30px rgba(0,0,0,0.07);
        }

        

        /* Search Bar Section */
        .search-wrapper {
            max-width: 650px;
            margin: 15px auto 30px;
        }
        .search-input {
            border-radius: 12px;
            padding: 14px 25px;
            border: 1px solid #eee;
            box-shadow: var(--soft-shadow);
            transition: all 0.3s ease;
        }
        .search-input:focus {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-color: #ddd;
            outline: none;
        }

        /* Filter Tabs */
        .nav-pills .nav-link {
            color: #666;
            border: 1px solid #eee;
            border-radius: 50px;
            margin: 5px;
            padding: 8px 22px;
            background: white;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        .nav-pills .nav-link.active {
            background-color: var(--brand-red) !important;
            border-color: var(--brand-red);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 30, 38, 0.3);
        }

        /* Resource Cards */
        .resource-card {
            border: none;
            border-radius: 25px;
            box-shadow: var(--soft-shadow);
            overflow: hidden;
            height: 100%;
            transition: transform 0.25s ease;
        }
        .resource-card:hover {
            transform: translateY(-8px);
        }

        .img-container {
            position: relative;
            height: 220px;
            overflow: hidden;
        }
        .card-img-top {
            height: 100%;
            object-fit: cover;
        }

        .download-count-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: white;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--brand-red);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .card-body {
            padding: 1.8rem;
        }
        .card-title {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 12px;
        }
        .card-text {
            color: #777;
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .update-date {
            font-size: 0.85rem;
            color: #aaa;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Download Button */
        .btn-download {
            background-color: var(--brand-red);
            color: white;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s;
        }
        .btn-download:hover {
            background-color: #d61920;
            color: white;
        }

        /* Hide logic */
        .hidden {
            display: none !important;
        }
    </style>
    
</head>

<body>
	
	<?php include_once"config/header-top.php";?>

    <div id="wrapper">
     
	 <?php include_once"config/header.php";?>
	 
	
		<section class="flat-spacing-8" style="padding-bottom:1px">
            <div class="container">
                <div class=" text-center">
				
				<div class="box-title">
				      <h1 class="title">Resources</h1>
                       <p class="text-muted">Access our complete suite of downloadable resources, forms, and company information</p>
                     </div>
                 </div>
             </div>
        </section>
		
		

<div class="container pb-5">
    <div class="search-wrapper text-center">
        <input type="text" id="resourceSearch" class="form-control search-input" placeholder="Search resources by name...">
    </div>

    <ul class="nav nav-pills justify-content-center mb-5" id="filterPills">
        <li class="nav-item">
            <button class="nav-link active" data-filter="all">All Resources</button>
        </li>
	<?php 
	$query=$db->query("select * from mi_rcat where mi_status='Yes' and act_status='Yes'");
	while($crow=$query->fetch_assoc()){
		$text = strtolower($crow['cat_name']);
		$text = preg_replace('/[^a-z0-9\s]/', '', $text);
		$text = preg_replace('/\s+/', '-', trim($text));
		echo '<li class="nav-item">
            <button class="nav-link" data-filter="'.$text.'">'.$crow['cat_name'].'</button>
        </li>';
	}
	?>
        <!--<li class="nav-item">
            <button class="nav-link" data-filter="forms">Forms</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-filter="catalogs">Product Catalogs</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-filter="technical">Technical Documents</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-filter="prices">Price Lists</button>
        </li>-->
    </ul>
<!--download="'.$text.'.pdf"-->
    <div class="row g-4" id="resourceGrid">
<?php 
	$cquery=$db->query("SELECT 
    a.*, 
    b.cat_name,
    (SELECT COUNT(*) FROM mi_download_update d WHERE d.res_id = a.id) as cnt
FROM mi_resources a 
LEFT JOIN mi_rcat b ON a.cat_id = b.id 
WHERE a.mi_status = 'Yes' 
AND a.act_status = 'Yes'");
	while($row=$cquery->fetch_assoc()){
		$text = strtolower($row['cat_name']);
		$text = preg_replace('/[^a-z0-9\s]/', '', $text);
		$text = preg_replace('/\s+/', '-', trim($text));
		
		$dnd="";
		if($row['addfile']!=""){
			$dnd='<a href="'.IMG_PATH.'crm/images/resource_img/'.$row['addfile'].'" class="btn btn-download dnd" target="_blank" data-id="'.$row['id'].'" ><i class="bi bi-download"></i> Download </a>';
		}else{
			$dnd='';
		}
		
		echo '<div class="col-md-6 col-lg-4 resource-item" data-category="'.$text.'" data-name="'.$row['cat_name'].'">
            <div class="card resource-card">
                <div class="img-container">
                    <img src="'.IMG_PATH.'crm/images/resource_img/'.$row['photo'].'" class="card-img-top" alt="'.$row['web_title'].'">
                    <div class="download-count-badge">
                        <i class="bi bi-graph-up-arrow"></i> '.formatNumber($row['cnt']).' downloads
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">'.$row['web_title'].'</h5>
                    <p class="card-text">'.$row['description'].'</p>
                    <div class="update-date">
                        <i class="bi bi-calendar3"></i> Last updated: '.date("d M Y",strtotime($row['adate'])).'
                    </div>
                    '.$dnd.'
                </div>
            </div>
        </div>
		';
	}
?>        
        

       <!-- <div class="col-md-6 col-lg-4 resource-item" data-category="company" data-name="Annual Report 2024">
            <div class="card resource-card">
                <div class="img-container">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=600" class="card-img-top" alt="Annual Report">
                    <div class="download-count-badge">
                        <i class="bi bi-graph-up-arrow"></i> 1.9k downloads
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Annual Report 2024</h5>
                    <p class="card-text">Our latest annual report with financial highlights and achievements</p>
                    <div class="update-date">
                        <i class="bi bi-calendar3"></i> Last updated: 05 Jan 2025
                    </div>
                    <button class="btn btn-download">
                        <i class="bi bi-download"></i> Download
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 resource-item" data-category="catalogs" data-name="Corporate Brochure">
            <div class="card resource-card">
                <div class="img-container">
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=600" class="card-img-top" alt="Corporate Brochure">
                    <div class="download-count-badge">
                        <i class="bi bi-graph-up-arrow"></i> 1.5k downloads
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Corporate Brochure</h5>
                    <p class="card-text">Detailed overview of our company values, mission, and services</p>
                    <div class="update-date">
                        <i class="bi bi-calendar3"></i> Last updated: 28 Nov 2024
                    </div>
                    <button class="btn btn-download">
                        <i class="bi bi-download"></i> Download
                    </button>
                </div>
            </div>
        </div>-->

    </div>
</div>

<script>
    const searchInput = document.getElementById('resourceSearch');
    const filterBtns = document.querySelectorAll('#filterPills .nav-link');
    const resourceItems = document.querySelectorAll('.resource-item');

    function performFilter() {
        const query = searchInput.value.toLowerCase();
        const activeCategory = document.querySelector('#filterPills .nav-link.active').getAttribute('data-filter');

        resourceItems.forEach(item => {
            const name = item.getAttribute('data-name').toLowerCase();
            const category = item.getAttribute('data-category');

            const matchesSearch = name.includes(query);
            const matchesTab = (activeCategory === 'all' || category === activeCategory);

            if (matchesSearch && matchesTab) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });
    }

    // Handle Search Typing
    searchInput.addEventListener('input', performFilter);

    // Handle Tab Clicking
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // UI update for tabs
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Run filtering
            performFilter();
        });
    });
</script>



    
    <section class="container-fluid  d-flex justify-content-center align-items-center mt-3" >
 
        
      
    </div>    
    </div>
</section>

		


		
       
       

 <?php include_once"config/footer.php";?> 

   </div>


 <?php include_once"modals/all.php";?>
   
 <?php include_once"config/mobile_menu.php";?>  
 <?php include_once"config/foot.php";?>     
   
   
<script>
$(document).ready(function(){
	$("body").on("click",".dnd",function(e){
		var did=$(this).attr("data-id");
		var datastr="_token=<?php echo $post_id;?>&data_id="+did+"&method=Download";
		$.ajax({
			url:'<?=BASE_PATH;?>Controller/Master/',
			method:'post',
			data:datastr,
			success:function(data){
				var response=(JSON.parse(data));
				if(response.type=="success")
				{
					return true;
				}else{
					e.preventDefault();	
				}	
			}
			
		});
	});
})
</script>   
   
</body>


</html>