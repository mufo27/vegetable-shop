<?php
require_once('include/auth.inc.php');
require_once('../database/condb.inc.php');

if(isset($_POST['btn_search'])){

    $txt_search = $_POST['txt_search'];

    $select = $conn->prepare("SELECT * FROM category WHERE name LIKE '%".$txt_search."%' ");
    $select->execute();

} else {

    $select = $conn->prepare("SELECT * FROM category");
    $select->execute();
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        สั่งซื้อสินค้า - ระบบจัดการสินค้าออนไลน์
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
                        <li class="breadcrumb-item active">สั่งซื้อสินค้า / เลือกหมวดหมู่</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date">Sunday, December 18, 2022</span></li>
                    </ol>

                 
                    <form action="" method="post">
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" class="form-control shadow-inset-2" name="txt_search" required>
                            <div class="input-group-append">
                                <button type="submit" name="btn_search" class="input-group-text"><i class="fal fa-search"></i></button>
                            </div>
                        </div>
                    </form>

                    <h1><B>แสดงหมวดหมู่</B></h1>

                    <div class="row">
                        <?php
                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                        ?>
 
                            <div class="col-6 col-md-3 mb-4">
                                <div class="card h-100">
                                    <img class="card-img-top" src="../share/image/category/<?= $row['img']; ?>" >
                                    <div class="card-body">
                                        <h4><B><?= $row['name']; ?></B></h4>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="product.php?product=<?= $row['id']; ?>" class="btn btn-success btn-block waves-effect waves-themed">เลือก</a>
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