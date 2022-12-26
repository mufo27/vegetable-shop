<?php require_once('include/auth.inc.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        หน้าแรก - ระบบจัดการสินค้าออนไลน์
    </title>
    <meta name="description" content="Profile">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="../assets/dist/css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="../assets/dist/css/app.bundle.css">
    <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
    <link id="myskin" rel="stylesheet" media="screen, print" href="../assets/dist/css/skins/skin-master.css">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/dist/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/dist/img/favicon/favicon-32x32.png">
    <link rel="mask-icon" href="../assets/dist/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <!-- Optional: page related CSS-->
    <link rel="stylesheet" media="screen, print" href="../assets/dist/css/fa-brands.css">
    <link rel="stylesheet" media="screen, print" href="../assets/dist/css/fa-solid.css">
    <link rel="stylesheet" href="./include/style.css">

</head>

<body class="mod-bg-1 mod-nav-link ">

    <?php include('include/settings_script.inc.php'); ?>

    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">

            <?php include('include/menu_left.inc.php'); ?>

            <div class="page-content-wrapper">

                <?php include('include/menu_top.inc.php'); ?>

                <!-- BEGIN Page Content -->
                <main id="js-page-content" role="main" class="page-content">
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item active">หน้าแรก</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                    </ol>
                    <div class="subheader">
                        <h1 class="subheader-title">
                            <i class='subheader-icon fal fa-home'></i><span class='fw-300'>หน้าแรก</span>
                        </h1>
                    </div>
                    <div class="row text-center">

                        <div class="col-12 col-sm-6">
                            <a href="category.php?category">
                                <div class="p-3 bg-success rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 style="color:aliceblue" class="display-4 d-block l-h-n m-0 fw-500">
                                            สั่งซื้อสินค้า
                                        </h3>
                                    </div>
                                    <i class="fal fa-store-alt position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size: 6rem;"></i>
                                </div>
                            </a>
                        </div>

                        <div class="col-12 col-sm-6">
                            <a href="cart.php?cart">
                                <div class="p-3 bg-secondary rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 style="color:aliceblue" class="display-4 d-block l-h-n m-0 fw-500">
                                            ตะกร้าสินค้า
                                        </h3>
                                    </div>
                                    <i class="fal fa-shopping-basket position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
                                </div>
                            </a>
                        </div>

                        <div class="col-12 col-sm-6">
                            <a href="order.php?order">
                                <div class="p-3 bg-secondary rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 style="color:aliceblue" class="display-4 d-block l-h-n m-0 fw-500">
                                            รายการสั่งซื้อ
                                        </h3>
                                    </div>
                                    <i class="fal fa-shopping-bag position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
                                </div>
                            </a>
                        </div>

                        <div class="col-12 col-sm-6">
                            <a href="payment.php?payment">
                                <div class="p-3 bg-secondary rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 style="color:aliceblue" class="display-4 d-block l-h-n m-0 fw-500">
                                            การชำระเงิน
                                        </h3>
                                    </div>
                                    <i class="fal fa-money-check-alt position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
                                </div>
                            </a>
                        </div>

                        <div class="col-12 col-sm-6">
                            <a href="send.php?send">
                                <div class="p-3 bg-secondary rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 style="color:aliceblue" class="display-4 d-block l-h-n m-0 fw-500">
                                            การจัดส่ง
                                        </h3>
                                    </div>
                                    <i class="fal fa-shipping-fast position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
                                </div>
                            </a>
                        </div>

                        <div class="col-12 col-sm-6">
                            <a href="history.php?history">
                                <div class="p-3 bg-secondary rounded overflow-hidden position-relative text-white mb-g">
                                    <div class="">
                                        <h3 style="color:aliceblue" class="display-4 d-block l-h-n m-0 fw-500">
                                            ประวัติ
                                        </h3>
                                    </div>
                                    <i class="fal fa-history position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
                                </div>
                            </a>
                        </div>

                    </div>
                </main>

                <?php include('include/footer.inc.php'); ?>

            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->

    <?php include('include/settings_page.inc.php'); ?>

    <script src="../assets/dist/js/vendors.bundle.js"></script>

    <script src="../assets/dist/js/app.bundle.js"></script>
    <script>
        $(document).ready(function() {

        });
    </script>
</body>
<!-- END Body -->

</html>