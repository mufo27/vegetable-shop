<?php
require_once('include/auth.inc.php');
require_once('../database/condb.inc.php');

$category_id = $_GET['product'];

$select_name = $conn->prepare("SELECT c.name AS category_name FROM category c WHERE c.id=?");
$select_name->bindParam(1, $category_id);
$select_name->execute();
$row_name = $select_name->fetch(PDO::FETCH_ASSOC);

$select = $conn->prepare("SELECT p.*, 
                            c.name AS category_name,
                            (SELECT im.img FROM product_img im WHERE im.product_id=p.id ORDER BY im.id ASC LIMIT 1) AS show_img
                            FROM product p 
                            INNER JOIN category c ON p.category_id = c.id 
                            WHERE p.category_id=?
                            AND p.status_sell='เปิด'
                        ");
$select->bindParam(1, $category_id);
$select->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        สินค้า - ระบบจัดการสินค้าออนไลน์
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
                        <li class="breadcrumb-item"><a href="index.php">สั่งซื้อสินค้า / หมวดหมู่: <?= $row_name['category_name']; ?></a></li>
                        <li class="breadcrumb-item active">สินค้า</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date">Sunday, December 18, 2022</span></li>
                    </ol>

                    <div class="input-group input-group-lg mb-3">
                        <input type="text" class="form-control shadow-inset-2" id="filter-icon" aria-label="type 2 or more letters">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fal fa-search"></i></span>
                        </div>
                    </div>

                    <h1><B>แสดงสินค้า / หมวดหมู่: <?= $row_name['category_name']; ?></B></h1>

                    <div class="row">

                        <?php
                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {

                        ?>

                            <div class="col-6 col-md-3 mb-4">
                                <div class="card h-100">
                                    <img class="card-img-top" src="../share/image/product/<?= $row['show_img']; ?>" height="150px" width="100%">
                                    <div class="card-body">
                                        <h4><B><?= $row['name']; ?></B></h4>
                                        <p class="card-text"><?= $row['detail']; ?></p>
                                        <h6 class="text-danger"><B>฿<?= $row['price_sell']; ?>.00</B></h6>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="row">
                                            <div class="col-12 col-md-12 mb-2">
                                                <button type="button" class="btn btn-block btn-success waves-effect waves-themed" data-toggle="modal" data-target="#detail-modal<?= $row['id']; ?>"><i class="fal fa-shopping-cart"></i> หยิบใส่ตะกร้า</button>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <a href="product_detail.php?product_detail=<?= $row['id'] ?>" class="btn btn-block btn-dark waves-effect waves-themed"><i class="fal fa-info-square"></i> รายละเอียด</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Cart -->
                            <div class="modal fade" id="detail-modal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="cart.php" method="post" enctype="multipart/form-data">

                                            <input type="hidden" name="cart" value="<?= $row['id']; ?>">
                                            <input type="hidden" name="act" value="add">

                                            <div class="modal-header">
                                                <h4 class="modal-title">
                                                    โปรดระบุ..!! จำนวนสินค้า
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body bg-faded">
                                                <div class="form-group row">
                                                    <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="id">หมวดหมู่ :</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control" value="<?= $row['category_name']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">สินค้า :</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control" value="<?= $row['name']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">จำนวนสินค้า <span class="text-danger">*</span>:</label>
                                                    <div class="col-lg-9">
                                                        <input type="number" name="number" class="form-control" min="1" max="9999999" value="" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">หน่วยนับ :</label>
                                                    <div class="col-lg-9">
                                                        <input type="text" class="form-control" value="<?= $row['unit']; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                <button type="submit" name="btn_cart" class="btn btn-success">ยืนยันข้อมูล</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        <?php } ?>
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