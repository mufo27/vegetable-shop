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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">ตะกร้าสินค้า</a></li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date">Sunday, December 18, 2022</span></li>
                    </ol>

                    <div class="row">
                        <div class="col-xl-12">
                            <div id="panel-1" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        แสดงรายการตะกร้าสินค้า
                                    </h2>
                                </div>

                                <div class="panel-container show">
                                    <div class="panel-content">
                                        <!-- datatable start -->
                                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                            <thead class="bg-dark text-white">
                                                <tr>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">No.</th>
                                                    <th style="width:40%; text-align: center; vertical-align: middle;">รูปภาพ</th>
                                                    <th style="width:30%; text-align: center; vertical-align: middle;">สินค้า</th>
                                                    <th style="width:30%; text-align: center; vertical-align: middle;">จำนวนสินค้า</th>
                                                    <th style="width:30%; text-align: center; vertical-align: middle;">ราคา</th>
                                                    <th style="width:20%; text-align: center; vertical-align: middle;">จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['name']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><img src="../upload/<?= $row['img']; ?>" class="profile-image-lg" alt="..." width="250px" height="150px"></td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <button type="button" class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#edit-modal<?= $row['id']; ?>"><i class="fal fa-edit"></i></button>
                                                            <button type="button" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#del-modal<?= $row['id']; ?>"><i class="fal fa-times"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <!-- datatable end -->
                                    </div>
                                </div>
                            </div>
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