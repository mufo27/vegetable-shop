<?php
require_once('include/auth.inc.php');
require_once('../database/condb.inc.php');

if (isset($_GET['payment_order'])) {

    $check_payment_status = $_GET['payment_order'];

    if ($check_payment_status === '1' || $check_payment_status === '2') {

        if ($check_payment_status === '1') {

            $val_payment_status = 'ยังไม่ชำระเงิน';
            $btn_payment_status = '<a href="payment_order.php?payment_order" class="btn btn-outline-dark waves-effect waves-themed">ทั้งหมด</a>
                                   <a href="payment_order.php?payment_order=1" class="btn btn-dark waves-effect waves-themed">ยังไม่ชำระเงิน</a>
                                   <a href="payment_order.php?payment_order=2" class="btn btn-outline-dark waves-effect waves-themed">ชำระเงินแล้ว</a>
                                   ';
        } else {

            $val_payment_status = 'ชำระเงินแล้ว';
            $btn_payment_status = '<a href="payment_order.php?payment_order" class="btn btn-outline-dark waves-effect waves-themed">ทั้งหมด</a>
                                   <a href="payment_order.php?payment_order=1" class="btn btn-outline-dark waves-effect waves-themed">ยังไม่ชำระเงิน</a>
                                   <a href="payment_order.php?payment_order=2" class="btn btn-dark waves-effect waves-themed">ชำระเงินแล้ว</a>
                                   ';

        }

        $select = $conn->prepare("SELECT o.id AS orders_id, 
                                            o.total AS orders_total,
                                            p.id AS payment_id, 
                                            p.code AS payment_code, 
                                            p.status AS payment_status,
                                            p.total AS payment_total,
                                            p.form AS payment_form,
                                            p.img AS payment_img
                                            
                                    FROM orders o 
                                    INNER JOIN payment p ON o.id = p.orders_id
                                    WHERE p.status = ?
                                    ORDER BY o.save_time DESC
                                ");
        $select->bindParam(1, $val_payment_status);
        $select->execute();
    } else {

        $btn_payment_status = '<a href="payment_order.php?payment_order" class="btn btn-dark waves-effect waves-themed">ทั้งหมด</a>
                               <a href="payment_order.php?payment_order=1" class="btn btn-outline-dark waves-effect waves-themed">ยังไม่ชำระเงิน</a>
                               <a href="payment_order.php?payment_order=2" class="btn btn-outline-dark waves-effect waves-themed">ชำระเงินแล้ว</a>
                                ';

        $select = $conn->prepare("SELECT o.id AS orders_id, 
                                            o.total AS orders_total,
                                            p.id AS payment_id, 
                                            p.code AS payment_code, 
                                            p.status AS payment_status,
                                            p.total AS payment_total,
                                            p.form AS payment_form,
                                            p.img AS payment_img
                                            
                                    FROM orders o 
                                    INNER JOIN payment p ON o.id = p.orders_id
                                    ORDER BY o.save_time DESC
                                ");
        $select->execute();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>

        การชำระเงิน - ระบบจัดการสินค้าออนไลน์

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
                        <li class="breadcrumb-item active"> การชำระเงิน </li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                    </ol>

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="demo">

                                <?= $btn_payment_status; ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            <div id="panel-1" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        แสดงรายการข้อมูล / การชำระเงิน
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
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">เลขที่ใบชำระเงิน</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">ยอดชำระ</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">สถานะ</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">จำนวนเงิน</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">ช่องทาง</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">แนบหลักฐาน</th>
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

                                                    if ($row['payment_form'] === '-') {
                                                        $show_payment_form = '';
                                                        $show_payment_form_modal = 'เลือก';
                                                    } else {
                                                        $show_payment_form = $row['payment_form'];
                                                        $show_payment_form_modal = $row['payment_form'];
                                                    }

                                                    if (isset($row['payment_img'])) {
                                                        $show_payment_img = '<img src="../share/image/payment-slip/' . $row['payment_img'] . '" class="profile-image-lg" alt="..." width="200px" height="100px">';
                                                    } else {
                                                        $show_payment_img = '';
                                                    }


                                                ?>
                                                    <tr>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['payment_code']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['orders_total']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $show_payment_status; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['payment_total']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $show_payment_form; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"> <?= $show_payment_img ?></td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <button type="button" class="btn btn-warning btn-sm btn-icon waves-effect waves-themed mb-2" data-toggle="modal" data-target="#payment-modal<?= $row['orders_id']; ?>"><i class="fal fa-money-check-edit-alt"></i></button>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Payment-->
                                                    <div class="modal fade" id="payment-modal<?= $row['orders_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">

                                                                <form action="action/payment_order_db.php" method="post" enctype="multipart/form-data">

                                                                    <input type="hidden" name="payment_id" value="<?= $row['payment_id']; ?>" required>

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">
                                                                            ฟอร์มยืนยันการชำระเงิน
                                                                        </h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body bg-faded">

                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="id">เลขที่ใบชำระเงิน:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="text" class="form-control" value="<?= $row['payment_code']; ?>" readonly="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">จำนวนเงิน:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="number" id="payment_total" name="payment_total" class="form-control" value="<?= $row['payment_total']; ?>" min="0" max="999999" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ช่องทาง:</label>
                                                                            <div class="col-lg-9">
                                                                                <select class="custom-select form-control" name="payment_form" required>
                                                                                    <option value="<?= $row['payment_form']; ?>">-- <?= $show_payment_form_modal; ?> --</option>
                                                                                    <option value="-">-</option>
                                                                                    <option value="เงินสด">เงินสด</option>
                                                                                    <option value="พร้อมเพย์">พร้อมเพย์</option>
                                                                                    <option value="โอนผ่านธนาคาร">โอนผ่านธนาคาร</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <!-- <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">หลักฐาน:</label>
                                                                            <div class="col-lg-9">
                                                                                <img src="../share/image/payment-slip/<?= $row['payment_img']; ?>" class="profile-image-lg" alt="..." width="250px" height="150px">
                                                                            </div>
                                                                        </div> -->
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อัพโหลดหลักฐาน:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="file" id="chooseFile2" name="payment_img" class="form-control" value="">
                                                                                <input type="hidden" id="payment_img2" name="payment_img2" class="form-control" value="<?= $row['payment_img']; ?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for=""></label>
                                                                            <div class="col-lg-9">
                                                                                <div class="imgGallery2"></div>
                                                                            </div>
                                                                        </div>
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