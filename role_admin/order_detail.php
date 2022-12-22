<?php
require_once('include/auth.inc.php');
require_once('../database/condb.inc.php');

if (isset($_GET['order_detail'])) {

    $order_id = $_GET['order_detail'];

    $select_order = $conn->prepare("SELECT * FROM orders WHERE id=?");
    $select_order->bindParam(1, $order_id);
    $select_order->execute();
    $row_order = $select_order->fetch(PDO::FETCH_ASSOC);

    $select_address_send = $conn->prepare("SELECT *, concat(pkname,'',fname,' ',lname) AS fullname FROM account WHERE id=?");
    $select_address_send->bindParam(1, $row_order['account_id']);
    $select_address_send->execute();
    $row_address_send = $select_address_send->fetch(PDO::FETCH_ASSOC);

    $select_order_detail = $conn->prepare("SELECT od.*,
                            p.name AS product_name , p.unit AS product_unit,
                            (SELECT im.img FROM product_img im WHERE im.product_id=od.product_id ORDER BY im.id ASC LIMIT 1) AS show_img
                            FROM order_details od
                            INNER JOIN product p ON od.product_id = p.id
                            WHERE od.orders_id=?
                        ");
    $select_order_detail->bindParam(1, $row_order['id']);
    $select_order_detail->execute();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>

        รายละเอียดการสั่งซื้อ - ระบบจัดการสินค้าออนไลน์

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
                        <li class="breadcrumb-item"><a href="product.php?product">รายการสั่งซื้อ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">รายละเอียดการสั่งซื้อ /</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                    </ol>

                    <div class="row">
                        <div class="col-xl-12">
                            <div id="panel-1" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        แสดงรายการข้อมูล / รายละเอียดการสั่งซื้อ
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
                                                        <th style="width:15%; text-align: center; vertical-align: middle;">รูปภาพ</th>
                                                        <th style="width:30%; vertical-align: middle;">สินค้า</th>
                                                        <th style="width:10%; text-align: center; vertical-align: middle;">ราคาสินค้า</th>
                                                        <th style="width:10%; text-align: center; vertical-align: middle;">จำนวน</th>
                                                        <th style="width:10%; text-align: center; vertical-align: middle;">หน่วยนับ</th>
                                                        <th style="width:10%; text-align: right; vertical-align: middle;">ราคารวม</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $total = 0;
                                                    $i = 1;
                                                    while ($row_order_detail = $select_order_detail->fetch(PDO::FETCH_ASSOC)) {

                                                        $sum = $row_order_detail['price'] * $row_order_detail['number'];
                                                        $total += $sum;

                                                    ?>
                                                        <tr>
                                                            <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><img src="../share/image/product/<?= $row_order_detail['show_img']; ?>" class="profile-image-lg" alt="..." width="50px" height="50px"></td>
                                                            <td style="vertical-align: middle;"><?= $row_order_detail['product_name']; ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?= $row_order_detail['price']; ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?= $row_order_detail['number']; ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?= $row_order_detail['product_unit']; ?></td>
                                                            <td style="text-align: right; vertical-align: middle;"><?= $sum; ?></td>
                                                        </tr>

                                                    <?php } ?>

                                                    <tr class="text-right text-dark">
                                                        <td colspan="6">
                                                            <h4><B>ยอดชำระเงินทั้งหมด</B></h4>
                                                        </td>
                                                        <td colspan="1">
                                                            <h4><B><?= $total; ?></B></h4>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!-- datatable end -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div id="panel-6" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        แสดงข้อมูลที่อยู่</span>
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
                                        <form>
                                            <div class="panel-content">
                                                <div class="form-row">
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label" for="">ชื่อ-นามสกุล</label>
                                                        <input type="text" class="form-control" value="<?= $row_address_send['fullname']; ?>" readonly="">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label" for="">เบอร์โทร</label>
                                                        <input type="text" class="form-control" value="<?= $row_address_send['phone']; ?>" readonly="">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label class="form-label" for="">Email</label>
                                                        <input type="text" class="form-control" value="<?= $row_address_send['email']; ?>" readonly="">
                                                    </div>
                                                </div>
                                                <div class="form row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label" for="">ที่อยู่:</label>
                                                        <input type="text" class="form-control" value="<?= $row_address_send['address']; ?>" readonly="">

                                                    </div>
                                                </div>
                                                <h5 class="mt-5">ตำแหน่งที่ตั้ง</h5>
                                                <div class="form row">
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label" for="">ละติจูด:</label>
                                                        <input type="text" class="form-control" value="-" readonly="">
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label" for="">ลองติจูด:</label>
                                                        <input type="text" class="form-control" value="-" readonly="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 text-center">
                            <a href="print_order_detail.php?pdf=<?= $row_order['id']; ?>" class="btn btn-lg btn-primary waves-effect waves-themed"><span class="fal fa-print mr-1"></span> ปริ้น</a>
                        </div>
                    </div>
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