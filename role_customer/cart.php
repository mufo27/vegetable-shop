<?php
session_start();
require_once('../database/condb.inc.php');

// $id = $_SESSION['id'];

// $select = $conn->prepare("SELECT * FROM accuont WHERE id = ?");
// $select->bindParam(1, $id);
// $select->execute();
// $row = $select->fetch(PDO::FETCH_ASSOC);


$p_id = $_POST['cart'];
$act = $_POST['act'];
$check_number = $_POST['number'];

for ($k = 1; $k <= $check_number; $k++) {
    if ($act == 'add' && !empty($p_id)) {

        if (isset($_SESSION['cart'][$p_id])) {

            $_SESSION['cart'][$p_id]++;
        } else {

            $_SESSION['cart'][$p_id] = 1;
        }
    }
    if ($k >= $check_number) {
        header("location: cart.php");
        exit;
    }
}


if ($act == 'remove' && !empty($p_id)) {
    unset($_SESSION['cart'][$p_id]);
}


// print_r('<pre>');
// print_r($_POST);
// print_r('<pre>');

?>

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
    <link rel="stylesheet" href="./include/style.css">
    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

                                        <?php
                                        if (empty($_SESSION['cart'])) {
                                        ?>
                                            <div class="row d-flex justify-content-center mt-2">
                                                <h2 class="text-primary"><i class="lni lni-cart-full"></i> ยังไม่มี สินค้าในตระกล้า</h2>
                                            </div>

                                        <?php
                                        } else {
                                        ?>
                                            <!-- datatable start -->
                                            <form action="" method="post">
                                                <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th style="width:10%; text-align: center; vertical-align: middle;">No.</th>
                                                            <th style="width:40%; text-align: center; vertical-align: middle;">รูปภาพ</th>
                                                            <th style="width:30%; text-align: center; vertical-align: middle;">สินค้า</th>
                                                            <th style="width:30%; text-align: center; vertical-align: middle;">จำนวนสินค้า</th>
                                                            <th style="width:30%; text-align: center; vertical-align: middle;">ราคา</th>
                                                            <th style="width:30%; text-align: center; vertical-align: middle;">ราคารวมทั้งหมด</th>
                                                            <th style="width:20%; text-align: center; vertical-align: middle;">จัดการ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i  =  1;
                                                        $sum    =  0;
                                                        $total  =  0;
                                                        foreach ($_SESSION['cart'] as $p_id => $qty) {
                                                            $select_p = $conn->prepare("SELECT * FROM product  WHERE id=?");
                                                            $select_p->bindParam(1, $p_id);
                                                            $select_p->execute();
                                                            $row_p = $select_p->fetch(PDO::FETCH_ASSOC);
                                                            $sum = $row_p['price_sell'] * $qty;
                                                            $total += $sum;
                                                        ?>
                                                            <tr>
                                                                <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                                                <td style="text-align: center; vertical-align: middle;"><img src="../share/image/product/<?= $row_img['show_img']; ?>" class="profile-image-lg" alt="..." width="250px" height="150px"></td>
                                                                <td style="text-align: center; vertical-align: middle;"><?= $row_p['name']; ?></td>
                                                                <td style="text-align: center; vertical-align: middle;"><input type="number" name="amount[<?= $p_id ?>];" value="<?= $qty; ?>" min="1" max="100" class="px-3 py-2 border rounded"></td>
                                                                <td style="text-align: center; vertical-align: middle;"><?= $row_p['selling_price']; ?></td>
                                                                <td style="text-align: center; vertical-align: middle;"><?= $sum; ?></td>
                                                                <td style="text-align: center; vertical-align: middle;">
                                                                    <!-- <button type="button" class="btn btn-warning btn-sm btn-icon waves-effect waves-themed"><i class="fal fa-edit"></i></button> -->

                                                                    <input type="hidden" name="cart" value="<?= $row_p['id']; ?>">
                                                                    <input type="hidden" name="act" value="remove">

                                                                    <button type="submit" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed"><i class="fal fa-times"></i></button>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <!-- datatable end -->
                                                <div class="row mt-5">
                                                    <div class="col-6"></div>
                                                    <div class="col-3">
                                                        <div class="single-input">
                                                            <button type="submit" name="update" value="update" class="btn btn-warning btn-lg"><i class="lni lni-pencil-alt"></i> อัพเดท ตระกร้าสินค้า</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="single-input">
                                                            <button type="submit" name="send" value="<?= $_SESSION['cart']; ?>" class="btn btn-success btn-lg"><i class="lni lni-telegram-original"></i> สั่งซื้อสินค้า ตอนนี้</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </main>

                <?php

                if (isset($_POST['update'])) {

                    $act = $_POST['update'];

                    if ($act === 'update') {
                        $amount_array = $_POST['amount'];
                        foreach ($amount_array as $p_id => $amount) {
                            $_SESSION['cart'][$p_id] = $amount;
                        }
                    }

                    echo '<script type="text/javascript">
                              Swal.fire({
                                icon: "success",
                                title: "อัพเดท ตระกร้าสินค้า เรียบร้อยแล้ว",", 
                                showConfirmButton: false,
                                timer: 2000
                              });
                            </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"3; URL=cart.php\">";
                    exit;
                }

                if (isset($_POST['send'])) {

                    $_POST['send'];

                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?confirm\">";
                }
                ?>

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