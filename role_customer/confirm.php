<?php
require_once('include/auth.inc.php');
require_once('../database/condb.inc.php');

if (isset($_GET['confirm'])) {


    $select_address_send = $conn->prepare("SELECT *, concat(pkname,'',fname,' ',lname) AS fullname FROM account WHERE id=?");
    $select_address_send->bindParam(1, $_SESSION['id']);
    $select_address_send->execute();
    $row_address_send = $select_address_send->fetch(PDO::FETCH_ASSOC);

    if (isset($row_address_send['pkname'])) {
        $show_pkname = $row_address_send['pkname'];
    } else {
        $show_pkname = 'เลือก';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>

        ตรวจสอบข้อมูล - ระบบจัดการสินค้าออนไลน์

    </title>
    <meta name="description" content="Basic">
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
    <link rel="stylesheet" href="include/style.css">

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
                        <li class="breadcrumb-item"><a href="product.php?product">ตะกร้าสินค้า</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ตรวจสอบข้อมูล</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                    </ol>

                    <form action="confirm_db.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div id="panel-6" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            ตรวจสอบข้อมูล / ข้อมูลที่อยู่

                                        </h2>
                                        <div class="panel-toolbar">

                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <div class="panel-tag">
                                                <p>
                                                    คำชี้แจ้ง: ข้อมูลที่อยู่นี้ ใช้เพื่อการจัดส่งสินค้า
                                                </p>
                                            </div>
                                        </div>
                                        <div class="panel-content p-0">
                                            <div class="panel-content">
                                                <div class="form-row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label" for="">คำนำหน้า :<span class="text-danger">*</span></label>
                                                        <select class="custom-select form-control" name="pkname" required>
                                                            <option value="<?= $row_address_send['pkname']; ?>">-- <?= $show_pkname; ?> --</option>
                                                            <option value="นาย">นาย</option>
                                                            <option value="นาง">นาง</option>
                                                            <option value="นางสาว">นางสาว</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label" for="">ชื่อจริง :<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="lname" value="<?= $row_address_send['fname']; ?>" required>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label" for="">นามสกุล :<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="fname" value="<?= $row_address_send['lname']; ?>" required>
                                                    </div>

                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label" for="">เบอร์โทร :<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="phone" value="<?= $row_address_send['phone']; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="form row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label" for="">ที่อยู่ :<span class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="" name="address" rows="3">
                                                            <?= $row_address_send['address']; ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <!-- <h5 class="mt-5">ตำแหน่งที่ตั้ง</h5>
                                                    <div class="form row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="">ละติจูด:</label>
                                                            <input type="text" class="form-control" value="-" readonly="">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="">ลองติจูด:</label>
                                                            <input type="text" class="form-control" value="-" readonly="">
                                                        </div>
                                                    </div> -->
                                            </div>
                                            <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div id="panel-1" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            ตรวจสอบข้อมูล / รายละเอียดการสั่งซื้อ
                                        </h2>
                                        <div class="panel-toolbar">

                                        </div>
                                    </div>

                                    <div class="panel-container show">
                                        <div class="panel-content">

                                            <div class="table-responsive">
                                                <!-- datatable start -->
                                                <table id="" class="table table-bordered table-hover table-striped w-100">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th style="width:5%; text-align: center; vertical-align: middle;">No.</th>
                                                            <th style="width:30%; vertical-align: middle;">สินค้า</th>
                                                            <th style="width:10%; text-align: center; vertical-align: middle;">ราคา x จำนวน</th>
                                                            <th style="width:10%; text-align: right; vertical-align: middle;">รวม</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i  =  1;
                                                        $K  =  0;

                                                        $sum    =  0;
                                                        $total  =  0;
                                                        $price =  0;
                                                        foreach ($_SESSION['cart'] as $p_id => $qty) {
                                                            $select_p = $conn->prepare("SELECT p.id, p.name, p.price_sell,
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
                                                                <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                                                <td style="vertical-align: middle;"><?= $row_p['name']; ?></td>
                                                                <td style="text-align: center; vertical-align: middle;"><?= $row_p['price_sell']; ?> x <?= $qty; ?></td>
                                                                <td style="text-align: right; vertical-align: middle;"><?= $sum; ?></td>
                                                            </tr>

                                                            <!-- data product -->
                                                            <input type="hidden" name="product_check_num[]" value="<?= $k++; ?>">
                                                            <input type="hidden" name="product_id[]" value="<?= $row_p['id']; ?>">
                                                            <input type="hidden" name="product_price[]" value="<?= $row_p['price_sell']; ?>">
                                                            <input type="hidden" name="product_number[]" value="<?= $qty; ?>">

                                                        <?php } ?>

                                                        <tr class="bg-warning">
                                                            <td colspan="2" style="text-align: center; vertical-align: middle;">
                                                                <h4 class="text-dark"><B>ยอดชำระเงิน</B></h4>
                                                            </td>
                                                            <td colspan="2" style="text-align: center; vertical-align: middle;">
                                                                <h4 class="text-dark"><B><?= $total; ?></B></h4>
                                                            </td>
                                                        </tr>

                                                        <!-- data orders -->
                                                        <input type="hidden" name="orders_total" value="<?= $total; ?>">

                                                    </tbody>
                                                </table>
                                                <!-- datatable end -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 text-center">
                                <button type="submit" name="btn_confirm" class="btn btn-lg btn-success waves-effect waves-themed"><span class="fal fa-box-check mr-1"></span> ยืนยันข้อมูลการสั่งซื้อสินค้า</ิ>
                            </div>
                        </div>
                    </form>
                </main>
                <!-- END Page Content -->


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