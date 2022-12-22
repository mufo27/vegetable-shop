<?php require_once('active.inc.php'); ?>

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
                        ลูกค้า
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

            <li class="nav-title">Menu</li>

            <li class="<?= $main; ?>">
                <a href="index.php?main" title="" data-filter-tags="">
                    <i class="fal fa-home"></i><span class="nav-link-text" data-i18n="">หน้าแรก</span>
                </a>
            </li>

            <li class="nav-title">ข้อมูลทั่วไป</li>

            <li class="<?= $profile; ?>">
                <a href="profile.php?profile" title="" data-filter-tags="">
                    <i class="fal fa-user-circle"></i><span class="nav-link-text" data-i18n="">ข้อมูลส่วนตัว</span>
                </a>
            </li>

            <li class="nav-title">ข้อมูลการสั่งซื้อ</li>

            <li class="<?= $category; ?>">
                <a href="category.php?category" title="" data-filter-tags="">
                    <i class="fal fa-store-alt"></i><span class="nav-link-text" data-i18n="">สั่งซื้อสินค้า</span>
                </a>
            </li>

            <li class="<?= $cart; ?>">
                <a href="cart.php?cart" title="" data-filter-tags="">
                    <i class="fal fa-shopping-basket"></i><span class="nav-link-text" data-i18n="">ตะกร้าสินค้า</span>
                </a>
            </li>

            <li class="<?= $order; ?>">
                <a href="order.php?order" title="" data-filter-tags="">
                    <i class="fal fa-list-alt"></i><span class="nav-link-text" data-i18n="">รายการสั่งซื้อ</span>
                </a>
            </li>

            <li class="<?= $payment; ?>">
                <a href="payment.php?payment" title="" data-filter-tags="">
                    <i class="fal fa-money-check-alt"></i><span class="nav-link-text" data-i18n="">การชำระเงิน</span>
                </a>
            </li>

            <li class="<?= $send; ?>">
                <a href="send.php?send" title="" data-filter-tags="">
                    <i class="fal fa-shipping-fast"></i><span class="nav-link-text" data-i18n="">การจัดส่ง</span>
                </a>
            </li>

            <li class="<?= $history; ?>">
                <a href="history.php?history" title="" data-filter-tags="">
                    <i class="fal fa-history"></i><span class="nav-link-text" data-i18n="">ประวัติ</span>
                </a>
            </li>

            <li class="nav-title"></li>

            <li>
                <a href="../../logout.php" title="" data-filter-tags="">
                    <i class="fal fa-power-off"></i><span class="nav-link-text" data-i18n="">ออกจากระบบ</span>
                </a>
            </li>

            <!-- <li class="nav-title">Tools & Components</li> -->

        </ul>

        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->

</aside>