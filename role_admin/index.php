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

    <!-- font google -->
    <!-- <style type="text/css">
        @import url("https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap");

        body {
            font-family: "Kanit", sans-serif;
            font-size: 16px;
        }
    </style> -->
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
                            <i class='subheader-icon fal fa-home'></i> หน้าแรก
                            <small></small>
                        </h1>
                    </div>
                    <div class="row">

                        <div class="col-lg-6 col-xl-3 order-lg-1 order-xl-1"></div>

                        <div class="col-lg-12 col-xl-6 order-lg-3 order-xl-2">

                            <div class="card mb-g rounded-top">
                                <div class="row no-gutters row-grid">
                                    <div class="col-12">
                                        <div class="d-flex flex-column align-items-center justify-content-center p-4">
                                            <h1 class="display-5">ยินดีต้อนรับเข้าสู่ระบบ สำหรับผู้ดูแลระบบ</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 col-xl-3 order-lg-2 order-xl-3"></div>

                    </div>
                </main>

                <?php include('include/footer.inc.php'); ?>

            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->

    <?php include('include/settings_page.inc.php'); ?>


    <script src="js/app.bundle.js"></script>
    <script>
        $(document).ready(function() {

        });
    </script>
</body>
<!-- END Body -->

</html>