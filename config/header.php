<style>
    /* --- Desktop Mega Menu Styles (Lg breakpoint and up) --- */
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
        height: calc(100vh - 56px);
        overflow-y: auto;
    }

    .mega-menu .dropdown-menu .row {
        height: 100%;
    }

    .menu-column {
        height: 100%;
        min-height: auto;
        padding: 1.5rem 1rem;
        border-right: 1px solid #eee;
    }

    .col-1 {
        background-color: #f7f7f7;
    }

    .col-2 {
        background-color: #fcfcfc;
    }

    .col-3 {
        background-color: #fcfcfc;
    }

    .col-4 {
        background-color: #e9ecef;
        border-right: none;
    }

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

    .menu-item::before {
        color: #dc3545;
        font-weight: bold;
        display: inline-block;
        width: 1em;
        margin-left: -1em;
        visibility: hidden;
    }

    .menu-item:hover {
        background-color: #e9ecef;
        color: #212529;
    }

    .menu-item.active {
        background-color: #f8d7da;
        font-weight: 600;
        color: #dc3545;
    }

    .menu-item.active::before {
        visibility: visible;
    }

    .menu-column h6 {
        font-weight: 700;
        color: #343a40;
        margin-bottom: 1rem;
        border-bottom: 2px solid #dc3545;
        display: inline-block;
        padding-bottom: 0.25rem;
    }

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

    /* ==========================================================
       ✅ ONLY MOBILE OFFCANVAS UPDATED (scoped to #offcanvasNav)
       Desktop menu remains same
    ========================================================== */
    #offcanvasNav {
        width: 300px;
        border-left: none !important;
    }

    #offcanvasNav .offcanvas-header {
        background: #0D0F14 !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.07) !important;
        padding: 16px 20px !important;
    }

    #offcanvasNav .offcanvas-title {
        font-family: 'Segoe UI', system-ui, sans-serif;
        font-weight: 700;
        font-size: 15px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #fff !important;
    }

    #offcanvasNav .btn-close {
        filter: invert(1) brightness(2) !important;
        opacity: 0.65 !important;
        transition: opacity .2s, transform .2s !important;
    }

    #offcanvasNav .btn-close:hover {
        opacity: 1 !important;
        transform: rotate(90deg) !important;
    }

    #offcanvasNav .offcanvas-body {
        background:
            radial-gradient(800px 520px at 100% 10%, rgba(226, 0, 39, 0.18), transparent 55%),
            radial-gradient(700px 520px at 50% 120%, rgba(226, 0, 39, 0.12), transparent 55%),
            #0D0F14 !important;

        padding: 0 !important;
        overflow-x: hidden;
    }


    #offcanvasNav .navbar-nav {
        padding: 8px 0;
        margin: 0;
    }

    #offcanvasNav .nav-link {
        font-size: 14px;
        padding: 13px 20px !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        display: flex !important;
        justify-content: space-between;
        align-items: center;
        color: #C8CDD8 !important;
        text-decoration: none;
        transition: background .18s, color .18s;
        position: relative;
    }

    #offcanvasNav .nav-link:hover,
    #offcanvasNav .nav-link:focus {
        background: rgba(255, 255, 255, 0.04);
        color: #fff !important;
    }

    #offcanvasNav .nav-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: #E8232A;
        transform: scaleY(0);
        transition: transform .2s;
        border-radius: 0 2px 2px 0;
    }

    #offcanvasNav .nav-link:hover::before,
    #offcanvasNav .nav-link[aria-expanded="true"]::before {
        transform: scaleY(1);
    }

    #offcanvasNav .nav-link[aria-expanded="true"] {
        color: #fff !important;
        background: rgba(232, 35, 42, 0.08);
    }

    #offcanvasNav .mobile-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: #6B7280;
        transition: transform .3s ease, color .2s ease;
    }

    #offcanvasNav .nav-link[aria-expanded="true"] .mobile-icon {
        transform: rotate(90deg);
        color: #E8232A;
    }


    #offcanvasNav .menu-list,
    #offcanvasNav .mobile-subcategory-list,
    #offcanvasNav .mobile-nested-list {
        list-style: none;
        padding: 4px 0 8px 0;
        margin: 0;
        background: #0D0F14;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    #offcanvasNav .mobile-product-item {
        padding: 0;
        font-weight: 600;
    }

    /* override JS-generated anchors (text-dark/text-secondary) */
    #offcanvasNav .mobile-product-item>a {
        padding: 10px 20px !important;
        color: #C8CDD8 !important;
        background: transparent !important;
    }

    #offcanvasNav .mobile-product-item>a:hover {
        background: rgba(255, 255, 255, 0.04) !important;
        color: #fff !important;
    }

    #offcanvasNav .mobile-nested-list .dropdown-item,
    #offcanvasNav .menu-list li a {
        padding: 10px 20px 10px 36px !important;
        font-size: 13px;
        color: #9CA3AF !important;
        background: transparent !important;
        border: 0 !important;
    }

    #offcanvasNav .mobile-nested-list .dropdown-item:hover,
    #offcanvasNav .menu-list li a:hover {
        color: #fff !important;
        background: rgba(255, 255, 255, 0.03) !important;
    }

    #offcanvasNav hr {
        border-color: rgba(255, 255, 255, 0.07);
        margin: 0;
    }

    #offcanvasNav .d-flex.align-items-center.p-2 {
        padding: 16px 20px !important;
        background: #111318 !important;
    }

    #offcanvasNav .btn-care {
        width: 100%;
        display: inline-flex !important;
        align-items: center;
        gap: 10px;
        padding: 11px 16px;
        background: rgba(232, 35, 42, 0.10) !important;
        border: 1px solid rgba(232, 35, 42, 0.25) !important;
        border-radius: 8px;
        color: #E8232A !important;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: background .2s, border-color .2s;
        letter-spacing: .3px;
    }

    #offcanvasNav .btn-care:hover {
        background: rgba(232, 35, 42, 0.18) !important;
        border-color: rgba(232, 35, 42, 0.5) !important;
    }
</style>

<!-- Main Navigation Bar (Fixed Top) -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_PATH ?>">
            <img src="<?= BASE_PATH ?>images/logo.png" alt="Logo" class="d-inline-block align-text-top me-2"
                style="max-width:155px">
        </a>

        <!-- Hamburger Button for Mobile (targets Offcanvas) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav"
            aria-controls="offcanvasNav" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Desktop Menu (Visible LG and up) -->
        <div class="collapse navbar-collapse" id="desktopNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_PATH ?>">Home</a>
                </li>

                <!-- DESKTOP MEGA MENU -->
                <li class="nav-item dropdown mega-menu d-none d-lg-block">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarProductsDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Products
                    </a>
                    <div class="dropdown-menu border-top border-danger border-4 p-0"
                        aria-labelledby="navbarProductsDropdown">
                        <div class="container-fluid  h-100">
                            <div class="row g-0 h-100">
                                <div class="col-lg-3 menu-column col-1">
                                    <h6>Select Product</h6>
                                    <ul id="product-list" class="menu-list"></ul>
                                </div>

                                <div class="col-lg-3 menu-column col-2">
                                    <h6>Select Sub-category</h6>
                                    <ul id="subcategory-list" class="menu-list"></ul>
                                </div>

                                <div class="col-lg-3 menu-column col-3">
                                    <h6>Select Type</h6>
                                    <ul id="type-list" class="menu-list"></ul>
                                </div>

                                <div class="col-lg-3 menu-column col-4">
                                    <h6>Design Your Solution With Us</h6>
                                    <div class="cta-box">
                                        <p class="text-muted mb-4">Need something specific? Let our experts guide you.
                                        </p>
                                        <a href="https://subtech.in/contact" class="btn btn-danger btn-lg w-100">Request
                                            a Custom Solution</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown mega-menu d-none d-lg-block">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarSolutionsDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Solutions
                    </a>
                    <div class="dropdown-menu border-top border-danger border-4 p-0"
                        aria-labelledby="navbarSolutionsDropdown">
                        <div class="container-fluid h-100">
                            <div class="row g-0 h-100">

                                <div class="col-lg-4 menu-column col-1">
                                    <h6>Select Industry/Application</h6>
                                    <ul id="solution-category-list" class="menu-list"></ul>
                                </div>

                                <div class="col-lg-5 menu-column col-2">
                                    <h6>Select Solution</h6>
                                    <ul id="solution-type-list" class="menu-list"></ul>
                                </div>

                                <div class="col-lg-3 menu-column col-4">
                                    <h6>Talk to an Expert</h6>
                                    <div class="cta-box">
                                        <p class="text-muted mb-4">Discuss your specific industry challenges with a
                                            specialist.</p>
                                        <a href="https://subtech.in/contact" class="btn btn-danger btn-lg w-100">Book a
                                            Consultation</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_PATH ?>about">About Us</a>
                </li>

                <li class="nav-item dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarCompanyDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Company
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarCompanyDropdown">
                        <li><a class="dropdown-item" href="<?= BASE_PATH ?>blogs">Blogs</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_PATH ?>dealer-locator">Dealer Locator</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_PATH ?>jobs">Careers</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_PATH ?>resources">Resources</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= BASE_PATH ?>contact">Contact Us</a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <a href="<?= BASE_PATH ?>customer-care" class="btn btn-care d-inline-flex align-items-center">
                    <img src="<?= BASE_PATH ?>images/customer_care.png" alt="Customer Care"
                        style="cursor:pointer;height:1.4rem;margin-right:10px">
                    <span style="font-size:0.8rem"> Customer Care</span>
                </a>
            </div>
        </div>
        <!-- End Desktop Menu -->
    </div>
</nav>

<!-- Mobile Offcanvas Menu (Opens from Right) -->
<div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasNavLabel">
    <!-- ✅ CHANGED ONLY THIS HEADER to match dark UI -->
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold" id="offcanvasNavLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="<?= BASE_PATH ?>">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" id="mobileProductsDropdown" role="button" data-bs-toggle="collapse"
                    data-bs-target="#mobileProductContent" aria-expanded="false">
                    Products <span class="mobile-icon" data-text="Products">▼</span>
                </a>
                <div class="collapse" id="mobileProductContent">
                    <ul id="mobile-product-list" class="menu-list"></ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" id="mobileSolutionsDropdown" role="button" data-bs-toggle="collapse"
                    data-bs-target="#mobileSolutionContent" aria-expanded="false">
                    Solutions <span class="mobile-icon" data-text="Solutions">▼</span>
                </a>
                <div class="collapse" id="mobileSolutionContent">
                    <ul id="mobile-solution-category-list" class="menu-list"></ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= BASE_PATH ?>about">About Us</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" id="mobileCompanyDropdown" role="button" data-bs-toggle="collapse"
                    data-bs-target="#mobileCompanyContent" aria-expanded="false">
                    Company <span class="mobile-icon" data-text="Company">▼</span>
                </a>
                <div class="collapse" id="mobileCompanyContent">
                    <ul class="mobile-nested-list">
                        <li><a class="dropdown-item" href="<?= BASE_PATH ?>blogs">Blogs </a></li>
                        <li><a class="dropdown-item" href="<?= BASE_PATH ?>dealer-locator">Dealer Locator</a></li>
                        <li><a class="dropdown-item" href="<?= BASE_PATH ?>jobs">Careers</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= BASE_PATH ?>contact">Contact Us</a>
            </li>
        </ul>

        <hr>

        <div class="d-flex align-items-center p-2">
            <a href="<?= BASE_PATH ?>customer-care" class="btn btn-care d-inline-flex align-items-center">
                <img src="<?= BASE_PATH ?>images/customer_care.png" alt="Customer Care"
                    style="cursor:pointer;height:1.4rem;">
                <span> Customer Care</span>
            </a>
        </div>
    </div>
</div>

<script src="<?= BASE_PATH ?>js/jquery.min.js"></script>


<!-- ✅ Your scripts stay same (pasted exactly as you gave) -->
<script>
    let productData = {};
    let base_url = '<?= BASE_PATH ?>';
    $(document).ready(function () {
        $.getJSON('<?= BASE_PATH ?>getProductData.php', function (data) {
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

    function renderSubcategories(productName) {
        const entry = productData[productName];
        if (!entry) return;

        const subcategories = Object.keys(entry.subcategories || {});
        activeSubcategory = subcategories[0] || '';
        renderMenu('subcategory-list', subcategories, 'subcategory', activeSubcategory);
        renderTypes(productName, activeSubcategory);
    }

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
            const url = base_url + `products/${catSlug}/${subSlug}/${typeSlug}`;
            $list.append(`
                <li class="menu-item">
                    <a href="${url}" class="text-decoration-none">${typeName}</a>
                </li>
            `);
        });
    }

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
                       <span class="icon">▼</span>
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
                    const url = base_url + `products/${product.slug}/${sub.slug}/${type.slug}`;
                    $typeList.append(`<li><a href="${url}" class="text-decoration-none text-secondary">${type.name}</a></li>`);
                });

                $subList.append($subItem);
                $subList.append($typeList);
            });

            $collapse.append($subList);
            $list.append($productItem);
            $list.append($collapse);

            $productItem.find('a').on('click', function (e) {
                e.stopPropagation();
                const $icon = $(this).find('.icon');
                $($collapse).on('show.bs.collapse', () => $icon.text('-'))
                    .on('hide.bs.collapse', () => $icon.text('v'));
            });
        });
    }

    $(document).ready(function () {
        const productNames = Object.keys(productData);
        activeProduct = productNames[0] || '';

        renderMenu('product-list', productNames, 'product', activeProduct);
        renderSubcategories(activeProduct);

        $('#product-list').on('click', '.menu-item', function () {
            const $this = $(this);
            $this.siblings().removeClass('active');
            $this.addClass('active');
            activeProduct = $this.data('value');
            renderSubcategories(activeProduct);
        });

        $('#subcategory-list').on('click', '.menu-item', function () {
            const $this = $(this);
            $this.siblings().removeClass('active');
            $this.addClass('active');
            activeSubcategory = $this.data('value');
            renderTypes(activeProduct, activeSubcategory);
        });

        $('.mega-menu .dropdown-menu').on('click', e => e.stopPropagation());
        renderMobileProducts();
    });
</script>

<script>
    let solutionData = {};

    fetch('<?= BASE_PATH ?>getSolutionData.php')
        .then(response => response.json())
        .then(data => {
            solutionData = data;
            initializeSolutionsMenu();
        })
        .catch(err => console.error('Error loading solutions:', err));

    function initializeSolutionsMenu() {
        renderSolutionCategories();
        renderMobileSolutions();
    }

    function renderSolutionTypes(categoryName) {
        const types = solutionData[categoryName] || [];
        const $list = $('#solution-type-list');
        $list.empty();

        types.forEach(type => {
            const catSlug = type.cat_slug;
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
                <span class="icon">	▼</span>
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

    $('#solution-category-list').on('click', '.menu-item', function () {
        const $this = $(this);
        $this.siblings().removeClass('active');
        $this.addClass('active');

        const activeCategory = $this.data('value');
        renderSolutionTypes(activeCategory);
    });

    setupMobileIconToggle('mobileProductsDropdown', 'mobileProductContent', 'Products');
    setupMobileIconToggle('mobileCompanyDropdown', 'mobileCompanyContent', 'Company');
    setupMobileIconToggle('mobileSolutionsDropdown', 'mobileSolutionContent', 'Solutions');
    

</script>