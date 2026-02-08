<?php 
include_once 'config/config.inc.php';
include_once 'Model/class.master.php';

$cat_slug = $_GET['catid'] ?? '';
$subcat_slug = $_GET['subcatid'] ?? '';
$ptype_slug = $_GET['ptype'] ?? '';

//print_r($_GET);
$sql = "SELECT p.id,p.cat_id,p.subcat_id,p.varient,p.ptype,p.ptype2, pt2.cat_name as ptype2_name,p.rating,t.description,p.pname,wp.urlname,wp.sdes,wp.image
FROM mi_product p
Join mi_wproduct wp on wp.urlname=p.url_name
JOIN mi_category c ON p.cat_id = c.id
JOIN mi_subcategory s ON p.subcat_id = s.id
join mi_ptype2 pt2 on pt2.id=p.ptype2
JOIN mi_ptype t ON p.ptype = t.id
WHERE wp.mi_status='Yes' and c.url_name=? AND s.url_name=? AND t.url_name=?";

$result = $db->select($sql,[$cat_slug,$subcat_slug,$ptype_slug]);

//print_r($result);


$groupedData = [];

foreach ($result as $row) {
    $variantName = $objmaster->varient_name($row['varient']); // variant table se name nikalein
    $ratingName  = $objmaster->rating_name($row['rating']);   // rating table se name nikalein
	$ptype2Name  = $objmaster->ptype2_name($row['ptype2']);   // ptype2 table se name nikalein
	
    if (!isset($groupedData[$variantName])) {
        $groupedData[$variantName] = [];
    }

    if (!isset($groupedData[$variantName][$ptype2Name])) {
        $groupedData[$variantName][$ptype2Name] = [];
    }
	
	if (!isset($groupedData[$variantName][$ptype2Name][$ratingName])) {
        $groupedData[$variantName][$ptype2Name][$ratingName] = [];
    }
    $groupedData[$variantName][$ptype2Name][$ratingName][] = $row;
}
//print_r($groupedData);

$variantFilters = array_keys($groupedData);

$ratingFilters = [];
foreach ($groupedData as $variant => $ratings) {
    foreach ($ratings as $rating => $_) {
        $ratingFilters[$rating] = true;
    }
}
$ratingFilters = array_keys($ratingFilters);

$ratingCounts = [];

foreach ($result as $row) {
    $ratingName = $objmaster->rating_name($row['rating']); // e.g. "1 HP"
    if (!isset($ratingCounts[$ratingName])) {
        $ratingCounts[$ratingName] = 0;
    }
    $ratingCounts[$ratingName]++;
}

?>
<!DOCTYPE html>


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
      <title><?=ucwords(str_replace("-"," ",$ptype_slug))?> <?=ucwords(str_replace("-"," ",$subcat_slug))?> - Subtech</title>
	 <meta name="description" content="<?=$row['description']?> - subtech">
    <?php include_once "config/head.php";?>
	
	   <style>
        /* Custom styles to match the original design feel and spacing */
        
        .product-card {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
            transition: transform 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
        }
        .img-container {
            height: 12rem; /* Fixed height for image area */
        }
        .primary-red {
            color: #DC2626;
        }
        .bg-primary-red {
            background-color: #DC2626 !important;
        }
        .btn-primary-red {
            background-color: #DC2626;
            border-color: #DC2626;
        }
        .btn-primary-red:hover {
            background-color: #B91C1C;
            border-color: #B91C1C;
        }
        .btn-outline-red {
            color: #DC2626;
            border-color: #DC2626;
        }
        .btn-outline-red:hover {
            background-color: #fee2e2;
            color: #DC2626;
        }
    </style>

</head>

<body>

    	<?php include_once "config/header-top.php";?>

    <div id="wrapper">
<?php include_once"config/header.php";?>
       
        <!-- Section Product -->
        <section class="flat-spacing-7">
			   <div class="container">
                <div class="box-title" style="margin-bottom:15px; margin-top:50px">
                    <h1 class="title"><?=ucwords(str_replace("-"," ",$ptype_slug))?></h1>
                    <div class="breadcrumb-list">
                        <a class="breadcrumb-item" href="<?=BASE_PATH?>">Home</a>
                        <div class="breadcrumb-item dot"><span></span></div>
                        <a class="breadcrumb-item" href="#"><?=ucwords(str_replace("-"," ",$cat_slug))?> </a>
                        <div class="breadcrumb-item dot"><span></span></div>
                        <div class="breadcrumb-item current"><?=ucwords(str_replace("-"," ",$subcat_slug))?></div>
                    </div>
                  
                </div>
                <p class="mt-1 mb-2"><?=$row['description'];?></p>
            </div>
            <div class="container">
                <div class="tf-filter-dropdown">
                    <span class="title-filter">Filter:</span>
                    <div class="meta-dropdown-filter">
                        <div class="dropdown dropdown-filter">
                            <div class="dropdown-toggle" id="availability" data-bs-toggle="dropdown"
                                aria-expanded="false" data-bs-auto-close="outside">
                                <span class="text-value">Varient</span>
                                <span class="icon icon-arr-down"></span>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="availability">
                                <ul class="filter-group-check">
								<?php 
								if($variantFilters){
								$f=1;
								foreach ($variantFilters as $v): ?>
									<li class="list-item">
										<input type="radio" name="variant_filter" class="tf-check variant-filter" id="Var<?=$f?>" value="<?= htmlspecialchars($v) ?>">
										<label for="Var<?=$f?>" class="label"><span><?= htmlspecialchars($v) ?></span></label>
									</li>
								<?php $f++; endforeach; 
								}else{
									echo 'No Varient Matched';
								}
								?>
							</ul>
                            </div>
                        </div>
                        
                        <div class="dropdown dropdown-filter">
                            <div class="dropdown-toggle" id="size" data-bs-toggle="dropdown" aria-expanded="false"
                                data-bs-auto-close="outside">
                                <span class="text-value">Rating</span>
                                <span class="icon icon-arr-down"></span>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="size">
                                <div class="filter-size-box flat-check-list">
								<?php 
								if($ratingCounts){
								foreach ($ratingCounts as $rating => $count): ?>
									<div class="check-item size-item size-check rating-filter" data-rating="<?= htmlspecialchars($rating) ?>">
										<span class="size"><?= htmlspecialchars($rating) ?></span>&nbsp;<span class="count">(<?= $count ?>)</span>
									</div>
								<?php endforeach; 
								}else{
									echo 'No Rating Matched';
								}
								?>
</div>
                            </div>
                        </div>
                    

                    </div>

                </div>
				
				
				
				
				 <div class="container-fluid">
       
        <div id="product-list" class="row g-4">

            <!-- Card 1: MCB FP C Curve -->
<?php 
if($groupedData){

foreach ($groupedData as $variant => $ptype2Groups): ?>
    <?php foreach ($ptype2Groups as $ptype2Name => $ratings): ?>
        <?php 
            $firstRating = array_key_first($ratings);
            $defaultProduct = $ratings[$firstRating][0];
        ?>
        <div class="col-12 col-md-6 col-lg-3 product-card"
             data-variant="<?= htmlspecialchars($variant) ?>"
             data-ptype2="<?= htmlspecialchars($ptype2Name) ?>" data-rating="<?= htmlspecialchars($firstRating)?>">

            <div class="card h-100 rounded-3 overflow-hidden d-flex flex-column">
                <div class="bg-light p-4 d-flex justify-content-center align-items-center img-container">
                    <img class="product-image img-fluid w-auto"
                         src="<?= BASE_PATH ?>images/prod_img/<?= htmlspecialchars($defaultProduct['image'] ?? 'noimage.png') ?>"
                         alt="<?= htmlspecialchars($defaultProduct['pname']) ?>"
                         style="max-height: 100%; object-fit: contain;">
                </div>

                <div class="card-body d-flex flex-column">
                    <h2 class="card-title h5 fw-semibold text-dark product-title"><?= htmlspecialchars($ptype2Name) ?></h2>
                    <p class="card-subtitle text-muted mb-3 product-rating"><?= htmlspecialchars($firstRating) ?></p>

                    <div class="d-flex flex-wrap gap-2 mb-4 rating-pills">
                        <?php 
						
						foreach ($ratings as $ratingName => $products): ?>
                            <?php $prod = $products[0]; ?>
                            <button type="button"
                                class="badge rounded-pill rating-pill <?= ($ratingName == $firstRating) ? 'bg-primary-red text-white' : 'bg-light text-dark border' ?> px-3 py-1"
                                data-rating="<?= htmlspecialchars($ratingName) ?>"
                                data-image="<?= BASE_PATH ?>images/prod_img/<?= htmlspecialchars($prod['image']) ?>"
								data-pid="<?= htmlspecialchars($prod['id']) ?>"
                                data-pname="<?= htmlspecialchars($prod['pname']) ?>"
                                data-sdes="<?= htmlspecialchars($prod['sdes']) ?>"
                                data-url="<?= BASE_PATH ?>product/<?= htmlspecialchars($prod['urlname']) ?>">
                                <?= htmlspecialchars($ratingName) ?>
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <p class="text-muted small flex-grow-1 product-desc"><?= nl2br(htmlspecialchars($defaultProduct['sdes'] ?? '')) ?></p>

                    <div class="mt-4 d-flex gap-3">
                        <a href="<?= BASE_PATH ?>product/<?= htmlspecialchars($defaultProduct['urlname']) ?>"
                           class="btn btn-sm btn-outline-red fw-medium flex-fill rounded-3 product-link">View Details</a>
                        <button class="btn btn-sm btn-primary-red text-white fw-medium flex-fill rounded-3 order"  data-prdid="" data-pname="" >Order Now</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endforeach; 
}else{
	 echo '<div class="col-12 col-md-12 col-lg-12 product-card">
			<div class="card h-100 rounded-3 overflow-hidden d-flex flex-column">
            <h5 class="text-center">Product Not Found</h5>
			</div>
		</div>';
}
?>
           
        </div>
    </div>
	
	
            </div>
        </section>
        <?php include_once"config/footer.php";?>
    </div>

 <?php include_once"modals/all.php";?>
   
 <?php include_once"config/mobile_menu.php";?>  
 <?php include_once"config/foot.php";?>  
    </body>
	
	
	
<div class="modal modalCentered fade  modal-ask-question popup-style-2" id="ordermodal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="title text-xl-2 fw-medium">Add your requirement for <span id="pname" class="text-danger"></span></span>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <form method="post" id="ord_form" class="form-default" action="" novalidate="novalidate" style="background: #f3f3f3; padding: 20px; border-radius: 16px;">
					<input type="hidden" value="" id="prd_id" name="prd_id" />
					<input type="hidden" value="" id="prd_name" name="prd_name" />
					<input type="hidden" value="order" name="method" />
					<input type="hidden" value="<?=$post_id?>" name="_token" />
                    <div class="cols mb_15 flex-md-nowrap flex-wrap">
                        <fieldset class="">
                            <div class="text">Your name *</div>
                            <input name="name" id="name" class="radius-8 name" maxlength="50" type="text" placeholder=" Your Name" maxlength="50" required>
                        </fieldset>
                        <fieldset class="">
                            <div class="text">Your phone number *</div>
                            <input name="mobile" id="mob" class="radius-8" type="number" maxlength="10" required placeholder="Mobile">
                        </fieldset>
                    </div>
                    <fieldset class="mb_15">
                        <div class="text">Your Qty *</div>
                        <input name="qty" id="name" class="radius-8" maxlength="3" type="text" required="" placeholder="Quantity*" required>
                    </fieldset>
                    <div class="cols mb-2">
						<fieldset>
							<div class="text">Your Requirement *</div>
						   <textarea name="message" id="message" placeholder=" Requirement" required class="radius-8"></textarea>
						</fieldset>
					   
					</div>
					<div id="msg"></div>
                    <div class="text-center">
                        <button type="submit" id="btnSubmit" class="tf-btn animate-btn d-inline-flex justify-content-center"><span>Submit</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	
	
	
	
<script>
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('rating-pill')) {
        const pill = e.target;
        const card = pill.closest('.product-card');

        // Remove active color from all pills in this card
        card.querySelectorAll('.rating-pill').forEach(p => {
            p.classList.remove('bg-primary-red', 'text-white');
            p.classList.add('bg-light', 'text-dark', 'border');
        });

        // Activate clicked pill
        pill.classList.add('bg-primary-red', 'text-white');
        pill.classList.remove('bg-light', 'text-dark', 'border');

        // Update product details
        card.querySelector('.product-image').src = pill.dataset.image;
        card.querySelector('.product-rating').textContent = pill.dataset.rating;
        card.querySelector('.product-desc').textContent = pill.dataset.sdes;
        card.querySelector('.product-link').href = pill.dataset.url;

        // Optional: Update image alt text
        card.querySelector('.product-image').alt = pill.dataset.pname;
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let selectedVariant = null;
    let selectedRating = null;

    const cards = document.querySelectorAll('.product-card');

    // 🔹 Variant Filter (radio buttons)
    document.querySelectorAll('.variant-filter').forEach(input => {
        input.addEventListener('change', function() {
            selectedVariant = this.value;
            filterProducts();
        });
    });

    // 🔹 Rating Filter (clickable divs)
    document.querySelectorAll('.rating-filter').forEach(el => {
        el.addEventListener('click', function() {
            const isActive = this.classList.contains('active');
            document.querySelectorAll('.rating-filter').forEach(r => r.classList.remove('active'));

            if (!isActive) {
                this.classList.add('active');
                selectedRating = this.dataset.rating;
            } else {
                selectedRating = null;
            }

            filterProducts();
        });
    });

    // 🔹 Filtering Logic
    function filterProducts() {
        cards.forEach(card => {
            const cardVariant = card.dataset.variant;
            const cardRating  = card.dataset.rating;

            const variantMatch = !selectedVariant || cardVariant === selectedVariant;
            const ratingMatch  = !selectedRating || cardRating === selectedRating;

            if (variantMatch && ratingMatch) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }
});
</script>
<script>
$(document).ready(function(){
	$("body").on("click",".order",function(e){
		e.preventDefault();
		var card = $(this).closest(".card-body");

		var activeBtn = card.find(".rating-pills .bg-primary-red");
		var pid = activeBtn.data("pid");
		var pname = activeBtn.data("pname");
		$("#pname").text(pname);
		$("#prd_name").val(pname);
		$("#prd_id").val(pid);
		$("#ordermodal").modal("show");
	})
})
</script>
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

	$("body").on("submit","#ord_form",function(e){
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
$(".tf-sticky-btn-atc").hide();
	
  });
  </script> 
</html>