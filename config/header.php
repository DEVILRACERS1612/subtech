<style>
        /* --- Desktop Mega Menu Styles (Lg breakpoint and up) --- */
        /* Make the dropdown menu full width and remove default padding */
        .mega-menu {
            position: static !important;
        }
        .mega-menu .dropdown-menu {
            width: 100%;
            border: none;
            border-radius: 0;
            margin-top: 0;
            padding: 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
			
			height: calc(100vh - 56px); /* Assuming default Bootstrap 5 navbar height is 56px */
			overflow-y: auto;
	
	
        }

        .mega-menu .dropdown-menu .row {
			height: 100%;
			/* The Bootstrap .row is already display: flex, but height is key here */
		}
		
		/* Styling for the columns/sections */
        .menu-column {
            height: 100%; 
			min-height: auto; /* Resetting the original rule */
            padding: 1.5rem 1rem;
            border-right: 1px solid #eee;
        }
        
        /* Specific column background colors */
        .col-1 { background-color: #f7f7f7; }
        .col-2 { background-color: #fcfcfc; }
        .col-3 { background-color: #fcfcfc; }
        .col-4 { background-color: #e9ecef; border-right: none; }

        /* Style for interactive list items (Desktop) */
        .menu-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu-item {
            cursor: pointer;
            padding: 0.5rem 0.75rem;
            margin: 0.25rem 0;
            font-size: 0.95rem;
            color: #495057;
            position: relative;
            transition: all 0.2s ease;
        }

        /* Dot icon */
        .menu-item::before {
            
            color: #dc3545; /* Red dot color */
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
            visibility: hidden;
        }
        
        /* Hover and Active states */
        .menu-item:hover {
            background-color: #e9ecef;
            color: #212529;
        }

        .menu-item.active {
            background-color: #f8d7da; /* Light red/pink background for active item in C1/C2 */
            font-weight: 600;
            color: #dc3545; /* Red text */
        }

        .menu-item.active::before {
            visibility: visible;
        }

        /* Style for the header/title of each column */
        .menu-column h6 {
            font-weight: 700;
            color: #343a40;
            margin-bottom: 1rem;
            border-bottom: 2px solid #dc3545; /* Red underline */
            display: inline-block;
            padding-bottom: 0.25rem;
        }

        /* Style for the CTA button column */
        .col-4 h5 {
            border-bottom: none;
        }
        .cta-box {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            text-align: center;
            margin-top: 3rem;
        }

        /* --- Mobile Menu Styles (Less than Lg breakpoint) --- */
        
        /* Styling for links inside the Offcanvas */
        .offcanvas-body .nav-link {
            font-size: 1.1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
            /* Flex layout to align text and icon */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        /* Ensure non-dropdown links don't have the space-between effect */
        .offcanvas-body .nav-link:not([data-bs-toggle="collapse"]) {
            display: block;
        }


        /* Mobile product list styling */
        .mobile-product-item {
            cursor: pointer;
            padding: 0.5rem 1rem;
            font-weight: 600;
            color: #212529;
            border-bottom: 1px solid #eee;
        }
        
        .mobile-subcategory-list {
            list-style: none;
            padding: 0;
            background-color: #f8f9fa; /* Light grey background for nested items */
            border-top: 1px solid #eee;
        }

        .mobile-subcategory-list .menu-item {
            padding-left: 2rem; /* Indent subcategory items */
            font-weight: normal;
        }

        .mobile-nested-list {
            list-style: none;
            padding-left: 1.5rem; /* Indent for nested items like Company's sub-links */
            margin-bottom: 0;
            background-color: #f8f9fa;
        }
        .mobile-nested-list .dropdown-item {
            padding: 0.5rem 1rem;
            color: #495057;
            font-size: 0.95rem; /* Smaller font for sub-items */
        }
        .mobile-nested-list .dropdown-item:hover {
            background-color: #e9ecef;
        }

    </style>

    <!-- Main Navigation Bar (Fixed Top) --><nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?=BASE_PATH?>">
                <img src="<?=BASE_PATH?>images/logo.png" alt="Logo" class="d-inline-block align-text-top me-2" style="max-width:155px">
            </a>

            <!-- Hamburger Button for Mobile (targets Offcanvas) --><button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav" aria-controls="offcanvasNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Desktop Menu (Visible LG and up) --><div class="collapse navbar-collapse" id="desktopNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=BASE_PATH?>">Home</a>
                    </li>
                    
                    <!-- DESKTOP MEGA MENU --><li class="nav-item dropdown mega-menu d-none d-lg-block">
                        <!-- Kept dropdown-toggle for desktop arrow -->
                        <a class="nav-link dropdown-toggle" href="#" id="navbarProductsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Products
                        </a>
                        <div class="dropdown-menu border-top border-danger border-4 p-0" aria-labelledby="navbarProductsDropdown">
                            <div class="container-fluid  h-100">
                                <div class="row g-0 h-100">
                                    
                                    <!-- Column 1: Select Product --><div class="col-lg-3 menu-column col-1">
                                        <h6>Select Product</h6>
                                        <ul id="product-list" class="menu-list">
                                            <!-- List populated by JS --></ul>
                                    </div>
                                    
                                    <!-- Column 2: Select Sub-category --><div class="col-lg-3 menu-column col-2">
                                        <h6>Select Sub-category</h6>
                                        <ul id="subcategory-list" class="menu-list">
                                            <!-- List populated by JS --></ul>
                                    </div>
                                    
                                    <!-- Column 3: Select Type --><div class="col-lg-3 menu-column col-3">
                                        <h6>Select Type</h6>
                                        <ul id="type-list" class="menu-list">
                                            <!-- List populated by JS --></ul>
                                    </div>
                                    
                                    <!-- Column 4: Design Your Solution --><div class="col-lg-3 menu-column col-4">
                                        <h6>Design Your Solution With Us</h5>
                                        <div class="cta-box">
                                            <p class="text-muted mb-4">Need something specific? Let our experts guide you.</p>
                                            <a href="https://subtech.in/contact" class="btn btn-danger btn-lg w-100">Request a Custom Solution</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </li>
                    
					
					
				<li class="nav-item dropdown mega-menu d-none d-lg-block">
						<a class="nav-link dropdown-toggle" href="#" id="navbarSolutionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Solutions
						</a>
						<div class="dropdown-menu border-top border-danger border-4 p-0" aria-labelledby="navbarSolutionsDropdown">
							<div class="container-fluid h-100">
								<div class="row g-0 h-100">
													
									<div class="col-lg-4 menu-column col-1">
										<h6>Select Industry/Application</h6>
										<ul id="solution-category-list" class="menu-list">
											</ul>
									</div>
													
									<div class="col-lg-5 menu-column col-2">
										<h6>Select Solution</h6>
										<ul id="solution-type-list" class="menu-list">
											</ul>
									</div>
													
									<div class="col-lg-3 menu-column col-4">
										<h6>Talk to an Expert</h6>
										<div class="cta-box">
											<p class="text-muted mb-4">Discuss your specific industry challenges with a specialist.</p>
											<a href="https://subtech.in/contact" class="btn btn-danger btn-lg w-100">Book a Consultation</a>
										</div>
									</div>

								</div>
							</div>
						</div>
					</li>
					
					
                    <li class="nav-item">
                        <a class="nav-link" href="<?=BASE_PATH?>about">About Us</a>
                    </li>
					
					
                    <!-- DESKTOP COMPANY DROPDOWN --><li class="nav-item dropdown d-none d-lg-block">
                        <!-- Kept dropdown-toggle for desktop arrow -->
                        <a class="nav-link dropdown-toggle" href="#" id="navbarCompanyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Company
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarCompanyDropdown">
                            <li><a class="dropdown-item" href="<?=BASE_PATH?>blogs">Blogs</a></li>
							<li><a class="dropdown-item" href="<?=BASE_PATH?>dealer-locator">Dealer Locator</a></li>
                           <li><a class="dropdown-item" href="<?=BASE_PATH?>jobs">Careers</a></li>
                           <li><a class="dropdown-item" href="<?=BASE_PATH?>resources">Resources</a></li>
                        </ul>
                    </li>

                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?=BASE_PATH?>contact">Contact Us</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="<?=BASE_PATH?>customer-care" class="btn btn-care d-inline-flex align-items-center">
                        <img src="<?=BASE_PATH?>images/customer_care.png" alt="Customer Care" class="h-8 w-8 object-contain rounded-lg hover:scale-110 transition-transform duration-200 cursor-pointer" style="cursor:pointer;    height: 1.4rem; margin-right:10px" data-testid="img-customer-care">
                        <span style="font-size:0.8rem"> Customer Care</span>
                    </a>
                </div>
            </div>
            <!-- End Desktop Menu -->

        </div>
    </nav>
    <!-- End Main Navigation Bar -->

    <!-- Mobile Offcanvas Menu (Opens from Right) --><div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasNavLabel">
        <div class="offcanvas-header bg-light border-bottom">
            <h5 class="offcanvas-title fw-bold" id="offcanvasNavLabel">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <!-- Removed dropdown-toggle class --><a class="nav-link" href="<?=BASE_PATH?>">Home</a>
                </li>

                <!-- MOBILE PRODUCTS MENU -->
                <li class="nav-item">
                    <!-- REMOVED: dropdown-toggle class --><a class="nav-link" href="#" id="mobileProductsDropdown" role="button" data-bs-toggle="collapse" data-bs-target="#mobileProductContent" aria-expanded="false">
                        Products <span class="mobile-icon" data-text="Products">+</span>
                    </a>
                    <!-- Content of the mobile product list -->
                    <div class="collapse" id="mobileProductContent">
                        <ul id="mobile-product-list" class="menu-list">
                            <!-- Mobile list populated by JS -->
                        </ul>
                    </div>
                </li>
                <!-- End Mobile Products Menu -->
                
					<li class="nav-item">
					<a class="nav-link" href="#" id="mobileSolutionsDropdown" role="button" data-bs-toggle="collapse" data-bs-target="#mobileSolutionContent" aria-expanded="false">
						Solutions <span class="mobile-icon" data-text="Solutions">+</span>
					</a>
					<div class="collapse" id="mobileSolutionContent">
						<ul id="mobile-solution-category-list" class="menu-list">
							</ul>
					</div>
				</li>
				
				
                    <li class="nav-item">
                        <a class="nav-link" href="<?=BASE_PATH?>about">About Us</a>
                    </li>
                
                <!-- MOBILE COMPANY DROPDOWN -->
                <li class="nav-item">
                    <!-- REMOVED: dropdown-toggle class --><a class="nav-link" href="#" id="mobileCompanyDropdown" role="button" data-bs-toggle="collapse" data-bs-target="#mobileCompanyContent" aria-expanded="false">
                        Company <span class="mobile-icon" data-text="Company">+</span>
                    </a>
                    <div class="collapse" id="mobileCompanyContent">
                        <ul class="mobile-nested-list">
                            <li><a class="dropdown-item" href="<?=BASE_PATH?>blogs">Blogs</a></li>
							<li><a class="dropdown-item" href="<?=BASE_PATH?>dealer-locator">Dealer Locator</a></li>
                           <li><a class="dropdown-item" href="<?=BASE_PATH?>jobs">Careers</a></li>
                        </ul>
                    </div>
                </li>
                <!-- End Mobile Company Dropdown -->

              
                <li class="nav-item">
                    <!-- Removed dropdown-toggle class --><a class="nav-link" href="<?=BASE_PATH?>contact">Contact Us</a>
                </li>
            </ul>
            <hr>
            <div class="d-flex align-items-center p-2">
               <a href="<?=BASE_PATH?>customer-care" class="btn btn-care d-inline-flex align-items-center">
                        <img src="<?=BASE_PATH?>images/customer_care.png" alt="Customer Care" class="h-8 w-8 object-contain rounded-lg hover:scale-110 transition-transform duration-200 cursor-pointer" style="cursor:pointer;    height: 1.4rem;" data-testid="img-customer-care">
                        <span> Customer Care</span>
                    </a>
            </div>
        </div>
    </div>
    <!-- End Mobile Offcanvas Menu -->
    
    <script src="<?=BASE_PATH?>js/jquery.min.js"></script>
    <!-- Load jQuery <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>--->

    <script>
	let productData = {};
	let base_url='<?=BASE_PATH?>';
	$(document).ready(function () {
		$.getJSON('<?=BASE_PATH?>getProductData.php', function (data) {
			productData = data;

			const productNames = Object.keys(productData);
			activeProduct = productNames[0];
			renderMenu('product-list', productNames, 'product', activeProduct);
			renderSubcategories(activeProduct);
			renderMobileProducts();
		});
	});
	let activeProduct = Object.keys(productData)[0] || '';
	let activeSubcategory = '';
	  
	function renderMenu(listId, items, type, activeItem) {
		const $list = $(`#${listId}`);
		$list.empty();
		items.forEach(item => {
			const isActive = item === activeItem;
			const $item = $(`<li class="menu-item ${isActive ? 'active' : ''}" data-type="${type}" data-value="${item}">${item}</li>`);
			$list.append($item);
		});
	}

	// === SUBCATEGORY COLUMN ===
	function renderSubcategories(productName) {
		const entry = productData[productName];
		if (!entry) return;

		const subcategories = Object.keys(entry.subcategories || {});
		activeSubcategory = subcategories[0] || '';
		renderMenu('subcategory-list', subcategories, 'subcategory', activeSubcategory);
		renderTypes(productName, activeSubcategory);
	}

	// === TYPE COLUMN ===
	function renderTypes(productName, subcategoryName) {
		const entry = productData[productName];
		if (!entry || !entry.subcategories[subcategoryName]) return;

		const sub = entry.subcategories[subcategoryName];
		const catSlug = entry.slug;
		const subSlug = sub.slug;
		const types = sub.types || [];

		const $list = $('#type-list');
		$list.empty();

		types.forEach(typeObj => {
			const typeSlug = typeObj.slug;
			const typeName = typeObj.name;
			const url = base_url+`products/${catSlug}/${subSlug}/${typeSlug}`;
			$list.append(`
				<li class="menu-item">
					<a href="${url}" class="text-decoration-none">${typeName}</a>
				</li>
			`);
		});
	}

	// === MOBILE MENU (Nested rendering) ===
	function renderMobileProducts() {
		const $list = $('#mobile-product-list');
		$list.empty();

		Object.keys(productData).forEach(productName => {
			const product = productData[productName];
			const $productItem = $(`
				<li class="mobile-product-item" data-value="${productName}">
					<a href="#" class="d-flex justify-content-between align-items-center text-decoration-none text-dark"
					   data-bs-toggle="collapse" data-bs-target="#mobile-${product.slug}">
					   ${productName}
					   <span class="icon">+</span>
					</a>
				</li>
			`);

			const $collapse = $(`<div class="collapse" id="mobile-${product.slug}"></div>`);
			const $subList = $('<ul class="mobile-subcategory-list"></ul>');

			Object.keys(product.subcategories).forEach(subName => {
				const sub = product.subcategories[subName];
				const $subItem = $(`<li><strong>${subName}</strong></li>`);
				const $typeList = $('<ul class="ps-4 pb-2" style="background-color:#f3f3f3;"></ul>');

				sub.types.forEach(type => {
					const url = base_url+`products/${product.slug}/${sub.slug}/${type.slug}`;
					$typeList.append(`<li><a href="${url}" class="text-decoration-none text-secondary">${type.name}</a></li>`);
				});

				$subList.append($subItem);
				$subList.append($typeList);
			});

			$collapse.append($subList);
			$list.append($productItem);
			$list.append($collapse);

			// Icon toggle logic
			$productItem.find('a').on('click', function (e) {
				e.stopPropagation();
				const $icon = $(this).find('.icon');
				$($collapse).on('show.bs.collapse', () => $icon.text('-'))
							.on('hide.bs.collapse', () => $icon.text('+'));
			});
		});
	}

	// === UTIL ===
	function slugify(text) {
		return text.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
	}

	// === INITIALIZATION ===
	$(document).ready(function() {
		const productNames = Object.keys(productData);
		activeProduct = productNames[0] || '';

		renderMenu('product-list', productNames, 'product', activeProduct);
		renderSubcategories(activeProduct);

		$('#product-list').on('click', '.menu-item', function() {
			const $this = $(this);
			$this.siblings().removeClass('active');
			$this.addClass('active');
			activeProduct = $this.data('value');
			renderSubcategories(activeProduct);
		});

		$('#subcategory-list').on('click', '.menu-item', function() {
			const $this = $(this);
			$this.siblings().removeClass('active');
			$this.addClass('active');
			activeSubcategory = $this.data('value');
			renderTypes(activeProduct, activeSubcategory);
		});

		$('.mega-menu .dropdown-menu').on('click', e => e.stopPropagation());
		//$('.menu-list').on('click', '.menu-item', e => e.preventDefault());

		renderMobileProducts();
	});
	</script>
	
	
<script>
let solutionData = {}; // data from PHP JSON API

// Fetch from PHP API
fetch('<?= BASE_PATH ?>getSolutionData.php')
  .then(response => response.json())
  .then(data => {
    solutionData = data;
    initializeSolutionsMenu();
  })
  .catch(err => console.error('Error loading solutions:', err));

// --- Initialize ---
function initializeSolutionsMenu() {
  renderSolutionCategories();
  renderMobileSolutions();
}

// --- Desktop Rendering ---
function renderSolutionTypes(categoryName) {
  const types = solutionData[categoryName] || [];
  const $list = $('#solution-type-list');
  $list.empty();

  types.forEach(type => {
    // Link format: /solutions/{cat_slug}/{subcat_slug}
    const catSlug = type.cat_slug;  // use from PHP data
    const subSlug = type.slug;
    const link = base_url + `solutions/${catSlug}/${subSlug}`;

    $list.append(`
      <li class="menu-item solution-type" data-value="${type.name}">
        <a href="${link}" class="text-decoration-none">${type.name}</a>
      </li>
    `);
  });
}

function renderSolutionCategories() {
  const categoryNames = Object.keys(solutionData);
  const activeCategory = categoryNames[0];

  renderMenu('solution-category-list', categoryNames, 'solution-category', activeCategory);
  renderSolutionTypes(activeCategory);
}

// --- Mobile Rendering ---
function renderMobileSolutions() {
  const $list = $('#mobile-solution-category-list');
  $list.empty();

  Object.keys(solutionData).forEach(categoryName => {
    const catSlug = solutionData[categoryName][0]?.cat_slug || '';
    const $categoryItem = $(`<li class="mobile-product-item" data-value="${categoryName}"></li>`);

    $categoryItem.html(`
      <a href="#" class="d-flex justify-content-between align-items-center text-decoration-none text-dark"
         data-bs-toggle="collapse" data-bs-target="#mobile-solution-${catSlug}" aria-expanded="false">
        ${categoryName}
        <span class="icon">+</span>
      </a>
    `);

    const $collapse = $(`<div class="collapse" id="mobile-solution-${catSlug}"></div>`);
    const $typeList = renderMobileSolutionTypes(categoryName);
    $collapse.append($typeList);

    $list.append($categoryItem);
    $list.append($collapse);
  });
}

function renderMobileSolutionTypes(categoryName) {
  const $typeList = $('<ul class="mobile-nested-list"></ul>');
  const types = solutionData[categoryName] || [];
  const catSlug = types[0]?.cat_slug || '';

  types.forEach(type => {
    const link = base_url + `solutions/${catSlug}/${type.slug}`;
    $typeList.append(`<li><a class="dropdown-item" href="${link}">${type.name}</a></li>`);
  });

  return $typeList;
}

// --- Click Events (Desktop) ---
$('#solution-category-list').on('click', '.menu-item', function () {
  const $this = $(this);
  $this.siblings().removeClass('active');
  $this.addClass('active');

  const activeCategory = $this.data('value');
  renderSolutionTypes(activeCategory);
});

// --- Mobile Toggle Icons ---
setupMobileIconToggle('mobileProductsDropdown', 'mobileProductContent', 'Products');
setupMobileIconToggle('mobileCompanyDropdown', 'mobileCompanyContent', 'Company');
setupMobileIconToggle('mobileSolutionsDropdown', 'mobileSolutionContent', 'Solutions');
</script>