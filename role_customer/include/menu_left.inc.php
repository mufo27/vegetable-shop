<aside class="page-sidebar">
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
            <img src="../assets/dist/img/logo.png" alt="" aria-roledescription="logo">
            <span class="page-logo-text mr-1">ระบบจัดการสินค้าออนไลน์</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">

        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="info-card">
            <img src="../assets/dist/img/demo/avatars/avatar-admin.png" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
            <div class="info-card-text">
                <a href="#" class="d-flex align-items-center text-white">
                    <span class="text-truncate text-truncate-sm d-inline-block">
                        Dr. Codex Lantern
                    </span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm">Toronto, Canada</span>
            </div>
            <img src="../assets/dist/img/card-backgrounds/cover-2-lg.png" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div>

        <ul id="js-nav-menu" class="nav-menu">

            <li class="">
                <a href="index.php" title="" data-filter-tags="">
                    <i class="fal fa-home"></i><span class="nav-link-text" data-i18n="">หน้าแรก</span>
                </a>
            </li>

            <li class="active">
                <a href="dashboard.php" title="" data-filter-tags="">
                    <i class="fal fa-analytics"></i><span class="nav-link-text" data-i18n="">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="#" title="Theme Settings" data-filter-tags="theme settings">
                    <i class="fal fa-users"></i>
                    <span class="nav-link-text" data-i18n="nav.theme_settings">บัญชีผู้ใช้งาน</span>
                </a>
                <ul>
                    <li>
                        <a href="farmer.php" title="" data-filter-tags="">
                            <span class="nav-link-text" data-i18n="">ผู้ดูแลระบบ (Admin)</span>
                        </a>
                    </li>
                    <li>
                        <a href="farmer.php" title="" data-filter-tags="">
                            <span class="nav-link-text" data-i18n="">พนักงาน (Employee)</span>
                        </a>
                    </li>
                    <li>
                        <a href="farmer.php" title="" data-filter-tags="">
                            <span class="nav-link-text" data-i18n="">เกษตรกร (Farmer)</span>
                        </a>
                    </li>
                    <li>
                        <a href="customer.php" title="" data-filter-tags="">
                            <span class="nav-link-text" data-i18n="">ลูกค้า (Customer)</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#" title="Theme Settings" data-filter-tags="theme settings">
                    <i class="fal fa-cog"></i>
                    <span class="nav-link-text" data-i18n="nav.theme_settings">จัดการข้อมูล</span>
                </a>
                <ul>
                    <li>
                        <a href="category.php" title="" data-filter-tags="">
                            <span class="nav-link-text" data-i18n="">หมวดหมู่ (Category)</span>
                        </a>
                    </li>
                    <li>
                        <a href="product.php" title="" data-filter-tags="">
                            <span class="nav-link-text" data-i18n="">สินค้า (Product)</span>
                        </a>
                    </li>
                </ul>
            </li>



            <li class="">
                <a href="order.php" title="" data-filter-tags="">
                    <i class="fal fa-clipboard-list-check"></i><span class="nav-link-text" data-i18n="">รายการสั่งซื้อสินค้า</span>
                </a>
            </li>

            <li class="">
                <a href="payment.php" title="" data-filter-tags="">
                    <i class="fal fa-money-check-alt"></i><span class="nav-link-text" data-i18n="">การชำระเงิน</span>
                </a>
            </li>

            <li class="">
                <a href="send.php" title="" data-filter-tags="">
                    <i class="fal fa-money-check-alt"></i><span class="nav-link-text" data-i18n="">การจัดส่งสินค้า</span>
                </a>
            </li>

            <!-- <li class="nav-title">Tools & Components</li> -->

        </ul>

        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->

</aside>