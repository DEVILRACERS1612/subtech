<?php 
include_once 'config/config.inc.php';
include_once 'Model/class.master.php';
$cat_id=(isset($_REQUEST['cat_id']) and ($_REQUEST['cat_id']!=""))?$_REQUEST['cat_id']:'';
$state=(isset($_REQUEST['state']) and ($_REQUEST['state']!=""))?$_REQUEST['state']:'';
$city=(isset($_REQUEST['city']) and ($_REQUEST['city']!=""))?$_REQUEST['city']:'';
$pincode=(isset($_REQUEST['pincode']) and ($_REQUEST['pincode']!=""))?$_REQUEST['pincode']:'';
$sql = "SELECT * FROM mi_dealer WHERE 1=1"; 
$params = [];

// category check
if ($cat_id != '') {
    $sql .= " AND FIND_IN_SET(?, pcat_id)";
    $params[] = $cat_id;
}

// state check
if ($state != "") {
    $sql .= " AND state = ?";
    $params[] = $state;
}

// city check
if ($city != "") {
    $sql .= " AND city = ?";
    $params[] = $city;
}

// pincode check
if ($pincode != "") {
    $sql .= " AND pincode = ?";
    $params[] = $pincode;
}

// status always Yes
$sql .= " AND mi_status = 'Yes'";


/*if($cat!=""){
    $qr=$db->exeQuery("select * from mi_product where cat_id=(select id from mi_pcat where urlname='".$cat."' and mi_status='Yes') and mi_status='Yes'");
}else{
    $qr=$db->exeQuery("select * from mi_product where mi_status='Yes' group by cat_id");
}*/
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Dealer Locatior - Subtech </title>
	 <meta name="description" content="Dealer Locatior - Subtech ">
	 <link rel="canonical" href="https://subtech.in/dealer-locator">
    <?php include_once"config/head.php";?>

</head>

<body>
	
	<?php include_once"config/header-top.php";?>

    <div id="wrapper">
     
	 <?php include_once"config/header.php";?>
	 
		
		<section class="tf-page-title flat-spacing-8" style="background-image: url(./images/section/dealer-page.jpg);">
            <div class="container">
                <div class="box-title text-center">
                    <h1 class="title">Dealer Locations</h1>
                    <div class="breadcrumb-list">
                        <a class="breadcrumb-item" href="<?=BASE_PATH?>">Home</a>
                        <div class="breadcrumb-item dot"><span></span></div>
                        <div class="breadcrumb-item current">Dealer Locations</div>
                    </div>
                </div>
            </div>
        </section>
		
		
	
  <section class="s-store-location flat-spacing-5">
            <div class="container">
               
			   
			   
			   

			   <div class="tf-filter-dropdown" style="background: #f2f2f2;
    padding: 10px 20px; border-radius: 16px;">
                    <span class="title-filter">Filter:</span>
                    <div class="meta-dropdown-filter">
                       
                    
                        
						
						 
<form id="dealer_form" method="post" class="" action="" novalidate="novalidate">
        <div class="wrap">
            <div class="cols">
			  <fieldset>
            <select class="form-select" name="cat_id">
                <option value="">Dealer Type</option>
            <?php 
            echo $objmaster->pcat_list($cat_id);
            ?>
            </select>
                </fieldset>

                <fieldset>
                   <select class="form-select" name="state">
                       <option value="">Select a State</option>
                       <?php 
       echo $objmaster->state_list($state);   
                       ?>
                   </select>
                </fieldset>
				
				    <fieldset>
                   <select class="form-select" name="city">
                       <option value="">Select a City</option>
     <?php 
    $st=$db->query("select distinct(city) from mi_dealer where mi_status='Yes'");
    while($strow=$st->fetch_assoc()){
        if($city!="" and $strow['city']==$city){
            echo '<option value="'.$strow['city'].'" selected>'.$strow['city'].'</option>';
        }else{
            echo '<option value="'.$strow['city'].'">'.$strow['city'].'</option>';
        }
        
    }
                       ?>                   
                       </select>
                </fieldset>
				
				
				<fieldset>
                   <input type="text" name="pincode" class="form-control" placeholder="Search by Pincode" value="<?=$pincode?>" />
                </fieldset>
				
				
				
		<div class="button-submit send-wrap">
              <button type="submit" class="tf-btn animate-btn btn-primary"><i class="icon icon-search"></i> Search </button>
            </div>
            </div>
			
			

        </div>
    </form>

                    </div>

                </div>
				
<div class="tf-grid-layout lg-col-3 sm-col-2">				
<?php 
//echo $sql;
$res=$db->query($sql,$params);
if($res->num_rows){
    while($row=$res->fetch_assoc()){
    ?>
    <div class="card">
      <div class="card-header">
       <h5 class="text-xl fw-medium"><?=$row['aname']?> </h5>
       <p><?=$row['dname']?></p>
       <p><b>Deals In- </b> <?=$objmaster->pcat_name($row['pcat_id'])?></p>
      </div>
      <div class="card-body">
       
        <div class="footer-contact">
            <ul class="footer-info">
                <li class="item">
                    <span class="box-icon">
                        <i class="icon icon-location"></i>
                    </span>  <?=$row['address']?>, <?=$row['city']?>, <?=$row['pincode']?>
                </li>
                <li class="item">
                    <span class="box-icon">
                        <i class="icon icon-phone"></i>
                    </span>
                    <?=$row['mobile']?>
                </li>
                <?php if($row['email']!="") { ?>
                <li class="item">
                    <span class="box-icon">
                        <i class="icon icon-mail"></i>
                    </span>
                    <?=$row['email']?>
                </li>
                <?php } ?>
            </ul>
            <?php 
            if($row['urlname']!=""){
              echo '<a href="'.$row['urlname'].'" class="tf-btn btn-line-dark fw-normal">
                <span class="text-sm text-transform-none"> Go Web </span>
                <i class="icon-arrow-top-left fs-8"></i>
            </a>';  
            }
            ?>
            
        </div>
     </div>
    </div>
    <?php
    } 
}else{
    echo '<h5>Dealers Not Found in this Category and Location</h5>';
}

?>





<!---<div class="card">
  <div class="card-header">
   <h5 class="text-xl fw-medium">BK Agency </h5>
   <p>Mr. Abhishek Kaushik</p>
  </div>
  <div class="card-body">
   
    <div class="footer-contact">
        <ul class="footer-info">
            <li class="item">
                <span class="box-icon">
                    <i class="icon icon-location"></i>
                </span>  271, Udyog Kendra 2, Ecotech III, Greater Noida, Tusyana, Uttar Pradesh 201306
            </li>
            <li class="item">
                <span class="box-icon">
                    <i class="icon icon-phone"></i>
                </span>
                085060 60581
            </li>
            <li class="item">
                <span class="box-icon">
                    <i class="icon icon-mail"></i>
                </span>
                support@subtech.in
            </li>
        </ul>
        <a href="" class="tf-btn btn-line-dark fw-normal">
            <span class="text-sm text-transform-none">
                Go Web
            </span>
            <i class="icon-arrow-top-left fs-8"></i>
        </a>
    </div>
								
								
								
  </div>
</div>-->


                   
				   
				   
				   
                </div>
            </div>
        </section>
        <!-- /Store -->



   

	   <?php include_once"config/footer.php";?>





   </div>


 <?php include_once"modals/all.php";?>
   
 <?php include_once"config/mobile_menu.php";?>  
 <?php include_once"config/foot.php";?>     
   
   
   
   
   
</body>


</html>