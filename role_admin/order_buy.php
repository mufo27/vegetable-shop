<?php

require_once('../database/condb.inc.php');

$select = $conn->prepare("SELECT o.*, 
                            concat(a.pkname,'',a.fname,' ',a.lname) AS account_name,
                            pb.code AS payment_code, pb.status AS payment_status, 
                            sb.code AS send_code, sb.status AS send_status
                            FROM orders o 
                            INNER JOIN account a ON o.account_id = a.id
                            INNER JOIN payment_buy pb ON o.id = pb.orders_id
                            INNER JOIN send_buy sb ON o.id = sb.orders_id
                            ORDER BY o.save_time DESC
                        ");
$select->execute();


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
                                                    <th style="width:15%; vertical-align: middle;">ชื่อ-นามสกุล</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">เลขที่ใบสั่งซื้อ</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">เลขที่ใบชำระเงิน</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">เลขที่ใบจัดส่ง</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">ยอดรวม</th>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">สถานะชำระเงิน</th>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">สถานะจัดส่ง</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">วันที่สั่งซื้อ</th>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">รายละเอียด</th>
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
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['code']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['payment_code']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['send_code']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['total']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $show_payment_status; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $show_send_status; ?></td>
                                                        <td style="text-align: center;  vertical-align: middle;"><?= date('d-m-y H:i:s', strtotime($row['save_time'])); ?></td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <button type="button" class="btn btn-success btn-sm btn-icon waves-effect waves-themed mb-2" data-toggle="modal" data-target="#orders-detail-modal<?= $row['id']; ?>"><i class="fal fa-search-plus"></i></button>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Detaik -->
                                                    <div class="modal fade" id="orders-detail-modal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl" role="document">
                                                            <div class="modal-content">
                                                                <form action="action/product_db.php" method="post" enctype="multipart/form-data">

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">
                                                                            รายการสั่งซื้อ / รายละเอียดสินค้า
                                                                        </h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body bg-faded">
                                                                        <!-- <div class="row">
                                                                            <div class="col-md-12">
                                                                                <h5 class="text-success">รายละเอียด</h5>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <h5 class="text-info">ที่อยู่</h5>
                                                                            </div>
                                                                        </div> -->
                                                                        
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
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