<?php
include_once "./config/config.inc.php";
?>


<!DOCTYPE html>


<head>
    <meta charset="utf-8">
    <title>Jobs- Subtech </title>
	 <meta name="description" content="Jobs - Subtech">
	 <link rel="canonical" href="https://subtech.in/jobs">
    <?php include_once"config/head.php";?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body>
	
	<?php include_once"config/header-top.php";?>

    <div id="wrapper">
     
	 <?php include_once"config/header.php";?>
	 
		
		
	<div class="container flat-spacing-8">
    <div class="text-center mb-5">
      <h1>Jobs openings</h1>
      
    </div>
    
    
    
    
    
    
    <?php 
$qr=$db->query("select * from mi_jobs where mi_status='Yes' order by id desc");
if($qr->num_rows){
    while($row=$qr->fetch_assoc()){
        ?>
        
        
    <div class="card shadow-sm mb-4">
  <div class="card-body p-4">
    <div class="row align-items-center">
      <div class="col-md-8 col-lg-9">
        <div class="d-flex align-items-center mb-3">
          
          <div>
            <h4 class="card-title mb-0"><?=$row['title'];?></h4>
            <div class="text-muted small mt-1">
              <span class=""><?=$row['cat_name'];?></span>
              <span class="me-3"><i class="bi bi-geo-alt-fill me-1"></i><?=$row['location'];?></span>
              <span class="me-3"><i class="bi bi-clock-fill me-1"></i><?=$row['job_type'];?></span>
              <!--<span class="me-3"><i class="bi bi-briefcase-fill me-1"></i>5-8 years</span>-->
              <span><i class="bi bi-calendar-fill me-1"></i>Posted: <?=date("d F Y",strtotime($row['pdate']))?></span>
            </div>
          </div>
        </div>

       <!-- <p class="card-text text-dark mb-3">
          Lead electrical system design and implementation for industrial automation projects. Work with cutting-edge technology and mentor junior engineers.
        </p>-->

        <div class="d-flex flex-wrap gap-3 small text-muted">
          <span>Health Insurance</span>
          <span>Performance Bonus</span>
        
          <span>Flexible Hours</span>
        </div>
      </div>

      <div class="col-md-4 col-lg-3 d-grid gap-2 mt-3 mt-md-0">
      
                    
        <a href="<?=BASE_PATH?>job/<?=($row['url_name'])?>" type="button" class="btn btn-danger btn-lg text-white">Apply Now</a>
        <a href="<?=BASE_PATH?>job/<?=($row['url_name'])?>" type="button" class="btn btn-outline-danger btn-lg">View Details</a>
      </div>
    </div>
  </div>
</div>
 <?php
    }
}else{
 echo '<div class="row flex-fill">
            <div class="col-sm-10">
              <h4 class="h5">Current Job Not Available </h4>
			   
            </div>
            
            
          </div>';
}
?>

    
    
    
    
    
    
          
        

  
  
  
  </div>

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		

	   <?php include_once"config/footer.php";?>








   </div>


 <?php include_once"modals/all.php";?>
   
 <?php include_once"config/mobile_menu.php";?>  
 <?php include_once"config/foot.php";?>     
   
   
   
   
   
   
   
   
   
   
   




   
   
</body>


</html>