<?php
require_once('include/auth.inc.php');
require_once('../database/condb.inc.php');

if (isset($_POST['cart'])) {

    if (isset($_POST['btn_add'])) {

        $act  = $_POST['btn_add'];
        $p_id = $_POST['cart'];
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
                echo "<script>alert('เพิ่มสินค้า ลงในตะกร้าแล้ว..!!')</script>";
                echo "<meta http-equiv=\"refresh\" content=\"0; URL=cart.php?cart\">";
                exit;
            }
        }
    }

    if (isset($_POST['btn_update'])) {

        $act = $_POST['btn_update'];

        if ($act === 'update') {
            $amount_array = $_POST['amount'];
            foreach ($amount_array as $p_id => $amount) {
                $_SESSION['cart'][$p_id] = $amount;
            }
        }
        echo "<script>alert('อัพเดทสินค้า ในตะกร้าแล้ว..!!')</script>";
        echo "<meta http-equiv=\"refresh\" content=\"0; URL=cart.php?cart\">";
        exit;
    }

    if (isset($_POST['btn_delete'])) {

        $act = $_POST['btn_delete'];
        $p_id = $_POST['cart'];

        if ($act == 'delete' && !empty($p_id)) {
            unset($_SESSION['cart'][$p_id]);
        }
        echo "<script>alert('ลบสินค้า ในตะกร้าออกแล้ว..!!')</script>";
        echo "<meta http-equiv=\"refresh\" content=\"0; URL=cart.php?cart\">";
        exit;
    }
}


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

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="panel-1" class="panel">

                                    <div class="panel-hdr">
                                        <h2>
                                            แสดงรายการตะกร้าสินค้า
                                        </h2>
                                    </div>

                                    <div class="panel-container show">
                                        <div class="panel-content">

                                            <?php if (empty($_SESSION['cart'])) { ?>
                                                <div class="row d-flex justify-content-center mt-2">
                                                    <h2 class="text-primary"><i class="fa fa-cart-plus"></i> ยังไม่มีสินค้าในตะกล้า</h2>
                                                </div>

                                            <?php } else { ?>

                                                <div class="table-responsive">
                                                    <!-- datatable start -->
                                                    <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                                        <thead class="bg-dark text-white">
                                                            <tr>
                                                                <th style="width:5%; text-align: center; vertical-align: middle;">ลบ</th>
                                                                <th style="width:5%; text-align: center; vertical-align: middle;">No.</th>
                                                                <!-- <th style="width:10%; text-align: center; vertical-align: middle;">รูป</th> -->
                                                                <th style="width:40%; vertical-align: middle;">สินค้า</th>
                                                                <th style="width:30%; text-align: center; vertical-align: middle;">ราคา x จำนวน</th>
                                                                <th style="width:10%; text-align: center; vertical-align: middle;">รวม</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $i  =  1;
                                                            $sum    =  0;
                                                            $total  =  0;
                                                            $price =  0;
                                                            foreach ($_SESSION['cart'] as $p_id => $qty) {
                                                                $select_p = $conn->prepare("SELECT p.id, p.name, p.price_sell, p.unit,
                                                                                    (SELECT im.img FROM product_img im WHERE im.product_id=p.id ORDER BY im.id ASC LIMIT 1) AS show_img
                                                                                    FROM product p WHERE p.id=?
                                                                                    ");
                                                                $select_p->bindParam(1, $p_id);
                                                                $select_p->execute();
                                                                $row_p = $select_p->fetch(PDO::FETCH_ASSOC);
                                                                $sum = $row_p['price_sell'] * $qty;
                                                                $total += $sum;

                                                            ?>
                                                                <tr>
                                                                    <td style="text-align: center; vertical-align: middle;">
                                                                        <input type="hidden" name="cart" value="<?= $row_p['id']; ?>">
                                                                        <button type="submit" name="btn_delete" value="delete" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed"><i class="fal fa-times"></i></button>
                                                                    </td>
                                                                    <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                                                    <td style="text-align: center; vertical-align: middle;">
                                                                        <img src="../share/image/product/<?= $row_p['show_img']; ?>" class="profile-image-lg" alt="..." width="50px" height="50px">
                                                                        <?= $row_p['name']; ?>
                                                                    </td>
                                                                    <td style="text-align: center; vertical-align: middle;">
                                                                        <?= $row_p['price_sell']; ?> x <input type="number" name="amount[<?= $p_id ?>];" value="<?= $qty; ?>" min="1" max="100" class="px-3 py-2 border rounded">
                                                                    </td>
                                                                    <td style="text-align: center; vertical-align: middle;"><?= $sum; ?></td>

                                                                </tr>
                                                            <?php
                                                                //$_SESSION['num'] = $i;
                                                            } ?>

                                                            <tr class="bg-warning">
                                                                <td colspan="3" style="text-align: center; vertical-align: middle;">
                                                                    <h4 class="text-dark"><B>ยอดชำระเงิน</B></h4>
                                                                </td>
                                                                <td colspan="2" style="text-align: center; vertical-align: middle;">
                                                                    <h4 class="text-dark"><B><?= $total; ?></B></h4>
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                    <!-- datatable end -->

                                                </div>

                                                <div class="row mt-5">
                                                    <div class="col-12 col-md-4 mb-2">
                                                        <button type="submit" name="btn_update" value="update" class="btn btn-block btn-secondary waves-effect waves-themed"><i class="fal fa-shopping-cart"></i> อัพเดทตะกร้า</button>
                                                    </div>
                                                    <div class="col-12 col-md-8 ">
                                                        <a href="confirm.php?confirm" class="btn btn-block btn-success waves-effect waves-themed"><i class="fal fa-paper-plane"></i> สั่งซื้อสินค้า</a>
                                                    </div>
                                                </div>

                                            <?php } ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>

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