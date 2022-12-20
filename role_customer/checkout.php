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
                        <li class="breadcrumb-item"><a href="cart.php">ตะกร้าสินค้า</a></li>
                        <li class="breadcrumb-item">รายการสั่งซื้อ</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date">Sunday, December 18, 2022</span></li>
                    </ol>

                    <div class="row">
                        <div class="col-xl-7">
                            <div id="panel-6" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        ข้อมูลผู้ซื้อ
                                    </h2>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content p-0">
                                        <form>
                                            <div class="panel-content">
                                                <div class="form-row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label" for="">ชื่อจริง&nbsp;<abbr style="color:red;">*</abbr></label>
                                                        <input type="text" class="form-control" value="" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label" for="">นามสกุล&nbsp;<abbr style="color:red;">*</abbr></label>
                                                        <input type="text" class="form-control" value="" required>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label" for="">ที่อยู่&nbsp;<abbr style="color:red;">*</abbr></label>
                                                        <input type="text" class="form-control" value="" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label" for="">จังหวัด&nbsp;<abbr style="color:red;">*</abbr></label>
                                                        <input type="text" class="form-control" value="" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label" for="">รหัสไปรษณีย์&nbsp;<abbr style="color:red;">*</abbr></label>
                                                        <input type="text" class="form-control" value="" required>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label" for="">เบอร์โทร&nbsp;<abbr style="color:red;">*</abbr></label>
                                                        <input type="" class="form-control" value="" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-5">
                            <!-- Collapse -->
                            <div id="panel-6" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        รายการสั่งซื้อของคุณ
                                    </h2>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content">
                                        <div id="cp-1" class="card border">
                                            <div class="card-header">
                                                <button class="btn btn-sm btn-default waves-effect waves-themed" data-toggle="collapse" data-target="#cp-1 > .card-body" aria-expanded="true">
                                                    <span class="collapsed-hidden">Expand</span>
                                                    <span class="collapsed-reveal">Collapse</span>
                                                </button>
                                            </div>
                                            <div class="card-body p-0 show">
                                                <!-- notice we place the padding inside another div and remove the padding from the card body -->
                                                <div class="p-4">
                                                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card decks -->

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
</body>
<!-- END Body -->

</html>