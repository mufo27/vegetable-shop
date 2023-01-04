<?php
require_once('include/auth.inc.php');
require_once('../database/condb.inc.php');

if (isset($_GET['send'])) {

    $account_id = $_SESSION['id'];

    $check_send_status = $_GET['send'];
    $check_payment_status = 'ชำระเงินแล้ว';

    if ($check_send_status === '1' || $check_send_status === '2' || $check_send_status === '3') {


        if ($check_send_status === '1') {

            $val_send_status = 'ยังไม่จัดส่ง';
            $btn_send_status = '<a href="send.php?send" class="btn btn-outline-dark waves-effect waves-themed">ทั้งหมด</a>
                                <a href="send.php?send=1" class="btn btn-dark waves-effect waves-themed">ยังไม่จัดส่ง</a>
                                <a href="send.php?send=2" class="btn btn-outline-dark waves-effect waves-themed">รอการจัดส่ง</a>
                                <a href="send.php?send=3" class="btn btn-outline-dark waves-effect waves-themed">จัดส่งแล้ว</a>
                                ';
        } else if ($check_send_status === '2') {

            $val_send_status = 'รอการจัดส่ง';
            $btn_send_status = '<a href="send.php?send" class="btn btn-outline-dark waves-effect waves-themed">ทั้งหมด</a>
                                <a href="send.php?send=1" class="btn btn-outline-dark waves-effect waves-themed">ยังไม่จัดส่ง</a>
                                <a href="send.php?send=2" class="btn btn-dark waves-effect waves-themed">รอการจัดส่ง</a>
                                <a href="send.php?send=3" class="btn btn-outline-dark waves-effect waves-themed">จัดส่งแล้ว</a>
                                ';
        } else {

            $val_send_status = 'จัดส่งแล้ว';
            $btn_send_status = '<a href="send.php?send" class="btn btn-outline-dark waves-effect waves-themed">ทั้งหมด</a>
                                <a href="send.php?send=1" class="btn btn-outline-dark waves-effect waves-themed">ยังไม่จัดส่ง</a>
                                <a href="send.php?send=2" class="btn btn-outline-dark waves-effect waves-themed">รอการจัดส่ง</a>
                                <a href="send.php?send=3" class="btn btn-dark waves-effect waves-themed">จัดส่งแล้ว</a>
                                ';
        }

        $select = $conn->prepare("SELECT o.id AS orders_id, 
                                            o.total AS orders_total,
                                            s.id AS send_id, 
                                            s.code AS send_code, 
                                            s.status AS send_status,
                                            s.account_id AS account_id,
                                            (SELECT concat(a.pkname,'',a.fname,' ',a.lname) FROM account a WHERE a.id = s.account_id) AS account_name
                                            
                                    FROM orders o 
                                    INNER JOIN payment p ON o.id = p.orders_id
                                    INNER JOIN send s ON o.id = s.orders_id
                                    WHERE p.status=?
                                    AND s.status=? AND o.account_id=?
                                    ORDER BY o.save_time DESC
                                ");
        $select->bindParam(1, $check_payment_status);
        $select->bindParam(2, $val_send_status);
        $select->bindParam(3, $account_id);
        $select->execute();
    } else {

        $btn_send_status = '<a href="send.php?send" class="btn btn-dark waves-effect waves-themed">ทั้งหมด</a>
                            <a href="send.php?send=1" class="btn btn-outline-dark waves-effect waves-themed">ยังไม่จัดส่ง</a>
                            <a href="send.php?send=2" class="btn btn-outline-dark waves-effect waves-themed">รอการจัดส่ง</a>
                            <a href="send.php?send=3" class="btn btn-outline-dark waves-effect waves-themed">จัดส่งแล้ว</a>
                            ';

        $select = $conn->prepare("SELECT o.id AS orders_id, 
                                            o.total AS orders_total,
                                            s.id AS send_id, 
                                            s.code AS send_code, 
                                            s.status AS send_status,
                                            s.account_id AS account_id,
                                            (SELECT concat(a.pkname,'',a.fname,' ',a.lname) FROM account a WHERE a.id = s.account_id) AS account_name

                                    FROM orders o 
                                    INNER JOIN payment p ON o.id = p.orders_id
                                    INNER JOIN send s ON o.id = s.orders_id 
                                    WHERE p.status=? AND s.account_id=?
                                    ORDER BY o.save_time DESC
                                ");
        $select->bindParam(1, $check_payment_status);
        $select->bindParam(2, $_SESSION['id']);
        $select->execute();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>

        การจัดส่ง - ระบบจัดการสินค้าออนไลน์

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
                        <li class="breadcrumb-item active"> การจัดส่ง </li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                    </ol>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="demo">

                                <?= $btn_send_status; ?>

                            </div>
                        </div>
                    </div>

                    <div id="panel-2" class="panel">
                        <div class="panel-container show">
                            <div class="panel-content">
                                <div class="accordion accordion-outline" id="js_demo_accordion-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#js_demo_accordion-3a" aria-expanded="false">
                                                <i class="fal fa-money-check width-2 fs-xl"></i>
                                                ชำระเงินก่อนจัดสั่ง
                                                <span class="ml-auto">
                                                    <span class="collapsed-reveal">
                                                        <i class="fal fa-minus fs-xl"></i>
                                                    </span>
                                                    <span class="collapsed-hidden">
                                                        <i class="fal fa-plus fs-xl"></i>
                                                    </span>
                                                </span>
                                            </a>
                                        </div>
                                        <div id="js_demo_accordion-3a" class="collapse" data-parent="#js_demo_accordion-3">
                                            <div class="card-body">
                                                ขั้นตอนการการทำงาน <br>
                                                1. พนักงานนำถุงรวมสินค้าของแต่ละรายการขึ้นรถไปส่งลูกค้า <br>
                                                2. พนักงานจัดส่งสินค้าแล้วให้ลูกค้าเซ็นรับสินค้าลงในใบรายการจัดส่งสินค้า <br>
                                                3. เมื่อจัดส่งครบทุกรายการแล้ว ให้นำใบรายการจัดส่งสินค้ารวมส่งคืนพนักงานคีย์ข้อมูล(แคชเชียร์) <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#js_demo_accordion-3b" aria-expanded="false">
                                                <i class="fal fa-money-bill width-2 fs-xl"></i>
                                                เก็บเงินปลายทาง
                                                <span class="ml-auto">
                                                    <span class="collapsed-reveal">
                                                        <i class="fal fa-minus fs-xl"></i>
                                                    </span>
                                                    <span class="collapsed-hidden">
                                                        <i class="fal fa-plus fs-xl"></i>
                                                    </span>
                                                </span>
                                            </a>
                                        </div>
                                        <div id="js_demo_accordion-3b" class="collapse" data-parent="#js_demo_accordion-3">
                                            <div class="card-body">
                                            ขั้นตอนการการทำงาน <br>
                                            1.พนักงานนำถุงรวมสินค้าของแต่ละรายการขึ้นรถไปส่งลูกค้า พร้อมใบรายการจัดส่งสินค้ารวม <br>
                                            2.พนักงานจัดส่งสินนำใบรายการจัดส่งสินค้ารวมให้ลูกค้าแต่ละรายเซ็นรับสินค้า <u>(พร้อมเก็บเงินลูกค้าทันที, กรณีลูกค้าต้องสแกนจ่ายให้ลูกค้าสแกนจ่ายผ่านบาร์โค้ดธนาคารท่กำหนดหรือพร้อมเพร์ที่เรากำหนดเท่านั้น)</u> <br>
                                            3.เมื่อจัดส่งครบทุกรายการแล้ว ให้นำใบรายการจัดส่งสินค้ารวมส่งคืนพนักงานคีย์ข้อมูลพร้อมเงินสด(แคชเชียร์) <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div id="panel-1" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        แสดงรายการจัดส่ง
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
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">เลขที่ใบจัดส่ง</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">สถานะ</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">พนักงานส่ง</th>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {

                                                    if ($row['send_status'] === 'ยังไม่จัดส่ง') {
                                                        $show_send_status = '<span class="badge badge-danger badge-pill">ยังไม่จัดส่ง</span>';
                                                    } else if ($row['send_status'] === 'รอการจัดส่ง') {
                                                        $show_send_status = '<span class="badge badge-warning badge-pill">รอการจัดส่ง</span>';
                                                    } else {
                                                        $show_send_status = '<span class="badge badge-success badge-pill">จัดส่งแล้ว</span>';
                                                    }

                                                    if ($row['account_id'] !== '') {
                                                        $modal_account_name = $row['account_name'];
                                                    } else {
                                                        $modal_account_name = 'เลือก';
                                                    }


                                                ?>
                                                    <tr>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['send_code']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $show_send_status; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['account_name']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <button type="button" class="btn btn-warning btn-sm btn-icon waves-effect waves-themed mb-2" data-toggle="modal" data-target="#send-modal<?= $row['orders_id']; ?>"><i class="fal fa-shipping-timed"></i></button>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal send-->
                                                    <div class="modal fade" id="send-modal<?= $row['orders_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">

                                                                <form action="action/send_db.php" method="post" enctype="multipart/form-data">

                                                                    <input type="hidden" name="send_id" value="<?= $row['send_id']; ?>" required>
                                                                    <input type="hidden" name="send" value="<?= $check_send_status; ?>" required>

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">
                                                                            ฟอร์มแจ้งสถานะจัดส่ง
                                                                        </h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body bg-faded">
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="id">เลขที่ใบจัดส่ง:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="text" class="form-control" value="<?= $row['send_code']; ?>" readonly="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ช่องทาง:</label>
                                                                            <div class="col-lg-9">
                                                                                <select class="custom-select form-control" name="send_status" required>
                                                                                    <option value="<?= $row['send_status']; ?>">-- <?= $row['send_status']; ?> --</option>
                                                                                    <option value="ยังไม่จัดส่ง">ยังไม่จัดส่ง</option>
                                                                                    <option value="รอการจัดส่ง">รอการจัดส่ง</option>
                                                                                    <option value="จัดส่งแล้ว">จัดส่งแล้ว</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="id">ชำระเงิน:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="text" class="form-control" value="เก็บเงินปลายทาง" readonly="">
                                                                            </div>
                                                                        </div>
                                                                        <!-- <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">พนักงานส่ง:</label>
                                                                            <div class="col-lg-9">
                                                                                <select class="custom-select form-control" name="account_id">
                                                                                    <option value="<?= $row['account_id']; ?>">-- <?= $modal_account_name; ?> --</option>
                                                                                    <option value="">ว่าง</option>
                                                                                    <?php
                                                                                    $select_account = $conn->prepare("SELECT id, concat(pkname,'',fname,' ',lname) AS fullname 
                                                                                                                        FROM account 
                                                                                                                        WHERE status = 2 
                                                                                                                        ORDER BY pkname ASC, fname ASC, lname ASC
                                                                                                                    ");
                                                                                    $select_account->execute();
                                                                                    while ($row_account = $select_account->fetch(PDO::FETCH_ASSOC)) {
                                                                                    ?>
                                                                                        <option value="<?= $row_account['id']; ?>"> <?= $row_account['fullname']; ?> </option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>  -->
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                                        <button type="submit" name="btn_edit" class="btn btn-warning">ยืนยันการชำระเงิน</button>
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
    <script>
        $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img width="250px" height="150px">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#chooseFile').on('change', function() {
                multiImgPreview(this, 'div.imgGallery');
            });
            $('#chooseFile2').on('change', function() {
                multiImgPreview(this, 'div.imgGallery2');
            });
        });
    </script>
</body>
<!-- END Body -->

</html>