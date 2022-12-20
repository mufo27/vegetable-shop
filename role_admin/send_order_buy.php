<?php

require_once('../database/condb.inc.php');

if (isset($_GET['payment_buy'])) {

    $check_order_status = $_GET['payment_buy'];

    if ($check_order_status === 'ยังไม่ชำระเงิน') {

        $select = $conn->prepare("SELECT o.* , concat(a.pkname,'',a.fname,' ',a.lname) as account_name FROM orders o INNER JOIN account a ON o.account_id = a.id WHERE o.payment_status=? ORDER BY o.save_time DESC");
        $select->bindParam(1, $check_order_status);
        $select->execute();
    } else if ($check_order_status === 'ชำระเงินแล้ว') {

        $select = $conn->prepare("SELECT o.* , concat(a.pkname,'',a.fname,' ',a.lname) as account_name FROM orders o INNER JOIN account a ON o.account_id = a.id WHERE o.payment_status=? ORDER BY o.save_time DESC");
        $select->bindParam(1, $check_order_status);
        $select->execute();
    } else {

        $select = $conn->prepare("SELECT o.* , concat(a.pkname,'',a.fname,' ',a.lname) as account_name FROM orders o INNER JOIN account a ON o.account_id = a.id ORDER BY o.save_time DESC");
        $select->execute();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>

        รายการสั่งซื้อ - ระบบจัดการสินค้าออนไลน์

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
    <link rel="stylesheet" media="screen, print" href="../assets/dist/css/datagrid/datatables/datatables.bundle.css">
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
                        <li class="breadcrumb-item active"> รายการสั่งซื้อ </li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                    </ol>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="demo">
                                <a href="payment_buy.php?payment_buy='ยังไม่ชำระเงิน'" class="btn btn-outline-danger waves-effect waves-themed">ยังไม่ชำระเงิน</a>
                                <a href="payment_buy.php?payment_buy='ชำระเงินแล้ว'" class="btn btn-outline-success waves-effect waves-themed">ชำระเงินแล้ว</a>
                                <a href="payment_buy.php?payment_buy" class="btn btn-outline-dark waves-effect waves-themed">ทั้งหมด</a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div id="panel-1" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        แสดงรายการข้อมูลรายการสั่งซื้อ
                                    </h2>
                                    <div class="panel-toolbar">

                                    </div>
                                </div>

                                <div class="panel-container show">
                                    <div class="panel-content">

                                        <!-- datatable start -->
                                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                                            <thead class="bg-dark text-white">
                                                <tr>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">No.</th>
                                                    <th style="width:20%; vertical-align: middle;">ชื่อ-นามสกุล</th>
                                                    <th style="width:10%; vertical-align: middle;">เลขที่ใบสั่งซื้อ</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">ยอดรวม</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">สถานะชำระเงิน</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">สถานะจัดส่ง</th>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {

                                                    if ($row['payment_status'] === 'ยังไม่ชำระเงิน') {
                                                        $show_payment_status = '<span class="badge badge-danger badge-pill">ยังไม่ชำระเงิน</span>';
                                                    } else {
                                                        $show_payment_status = '<span class="badge badge-success badge-pill">ชำระเงินแล้ว</span>';
                                                    }

                                                    if ($row['send_status'] === 'ยังไม่จัดส่ง') {
                                                        $show_send_status = '<span class="badge badge-danger badge-pill">ยังไม่จัดส่ง</span>';
                                                    } else if ($row['send_status'] === 'รอการจัดส่ง') {
                                                        $show_send_status = '<span class="badge badge-warning badge-pill">รอการจัดส่ง</span>';
                                                    } else {
                                                        $show_send_status = '<span class="badge badge-success badge-pill">จัดส่งแล้ว</span>';
                                                    }


                                                ?>
                                                    <tr>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                                        <td style="vertical-align: middle;"><?= $row['account_name']; ?></td>
                                                        <td style="vertical-align: middle;"><?= $row['code']; ?></td>
                                                        <td style="vertical-align: middle;"><?= $row['total']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $show_payment_status; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $show_send_status; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <button type="button" class="btn btn-warning btn-sm btn-icon waves-effect waves-themed mb-2" data-toggle="modal" data-target="#edit-modal<?= $row['id']; ?>"><i class="fal fa-edit"></i></button>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Edit-->
                                                    <div class="modal fade" id="edit-modal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">

                                                                <form action="action/product_db.php" method="post" enctype="multipart/form-data">

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">
                                                                            แก้ไขข้อมูลสินค้า
                                                                        </h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">หมวดหมู่:</label>
                                                                            <div class="col-lg-9">
                                                                                <select class="custom-select form-control" name="category_id" required>
                                                                                    <option value="<?= $row['category_id']; ?>">-- <?= $row['category_name']; ?> --</option>
                                                                                    <?php
                                                                                    $select_t2 = $conn->prepare("SELECT * FROM category ORDER BY id ASC");
                                                                                    $select_t2->execute();
                                                                                    while ($row_t2 = $select_t2->fetch(PDO::FETCH_ASSOC)) {
                                                                                    ?>
                                                                                        <option value="<?= $row_t2['id']; ?>"> <?= $row_t2['name']; ?> </option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="id">Product ID:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="text" id="id" name="id" class="form-control" value="<?= $row['id']; ?>" placeholder="ระบบสร้างอัตโนมัติ" readonly="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">สินค้า:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="text" id="name" name="name" class="form-control" value="<?= $row['name']; ?>" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">รายละเอียด:</label>
                                                                            <div class="col-lg-9">
                                                                                <textarea class="form-control" id="" name="detail" rows="3"><?= $row['name']; ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">จำนวนสินค้า:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="number" id="qty" name="qty" class="form-control" value="<?= $row['qty']; ?>" min="0" max="10000" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">หน่วยนับ:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="text" id="unit" name="unit" class="form-control" value="<?= $row['unit']; ?>" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ราคาซื้อ:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="number" id="price_buy" name="price_buy" class="form-control" min="0" max="999999" value="<?= $row['price_buy']; ?>" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ราคาขาย:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="number" id="price_sell" name="price_sell" class="form-control" min="0" max="999999" value="<?= $row['price_sell']; ?>" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                                        <button type="submit" name="btn_edit" class="btn btn-warning">ยันยันเปลี่ยนแปลงข้อมูล</button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>

                                                  

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
                <!-- END Page Content -->


                <?php include('include/footer.inc.php'); ?>

            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->

    <?php include('include/settings_page.inc.php'); ?>


    <script src="../assets/dist/js/vendors.bundle.js"></script>
    <script src="../assets/dist/js/app.bundle.js"></script>

    <script src="../assets/dist/js/datagrid/datatables/datatables.bundle.js"></script>
    <script>
        $(document).ready(function() {
            $('#dt-basic-example').dataTable({
                responsive: true
            });

            $('.js-thead-colors a').on('click', function() {
                var theadColor = $(this).attr("data-bg");
                console.log(theadColor);
                $('#dt-basic-example thead').removeClassPrefix('bg-').addClass(theadColor);
            });

            $('.js-tbody-colors a').on('click', function() {
                var theadColor = $(this).attr("data-bg");
                console.log(theadColor);
                $('#dt-basic-example').removeClassPrefix('bg-').addClass(theadColor);
            });

        });
    </script>
</body>
<!-- END Body -->

</html>