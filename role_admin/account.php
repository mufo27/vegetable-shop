<?php

require_once('../database/condb.inc.php');

$check_status = $_GET['status'];

if ($check_status == 0) {
    $show_name = 'ผู้ดูแลระบบ';
} else if ($check_status == 1) {
    $show_name = 'เกษตรกร';
} else if ($check_status == 2) {
    $show_name = 'ลูกค้า';
} else if ($check_status == 3) {
    $show_name = 'พนักงาน';
} else {
    $show_name = 'เกิดข้อผิดพลาด';
}

$select = $conn->prepare("SELECT * FROM account WHERE status=? ORDER BY id ASC");
$select->bindParam(1, $check_status);
$select->execute();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>

        <?= $show_name; ?> - ระบบจัดการสินค้าออนไลน์

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
                        <li class="breadcrumb-item active"> <?= $show_name; ?> </li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-12">
                            <div id="panel-1" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        แสดงรายการข้อมูล<?= $show_name; ?>
                                    </h2>
                                    <div class="panel-toolbar">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-sm btn-success waves-effect waves-themed" data-toggle="modal" data-target="#add-modal"><span class="fal fa-plus mr-1"></span> เพิ่มข้อมูล</button>
                                    </div>
                                </div>

                                <!-- Modal Add-->
                                <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <form action="action/account_db.php" method="post" enctype="multipart/form-data">

                                                <input type="hidden" id="status" name="status" value="<?= $check_status; ?>">

                                                <div class="modal-header">
                                                    <h4 class="modal-title">
                                                        เพิ่มข้อมูล<?= $show_name; ?>
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="id">Account ID:</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" id="id" name="id" class="form-control" value="" placeholder="ระบบสร้างอัตโนมัติ" readonly="">
                                                        </div>

                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">คำนำหน้า:</label>
                                                        <div class="col-lg-9">
                                                            <select class="custom-select form-control" id="" name="pkname" required>
                                                                <option value="">-- เลือก -</option>
                                                                <option value="นาย">นาย</option>
                                                                <option value="นาง">นาง</option>
                                                                <option value="นางสาว">นางสาว</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ชื่อจริง:</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" id="fname" name="fname" class="form-control" value="" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">นามสกุล:</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" id="lname" name="lname" class="form-control" value="" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">เบอร์โทร:</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" id="phone" name="phone" class="form-control" value="" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อีเมล:</label>
                                                        <div class="col-lg-9">
                                                            <input type="email" id="email" name="email" class="form-control" value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ที่อยู่:</label>
                                                        <div class="col-lg-9">
                                                            <textarea class="form-control" id="address" name="address" placeholder="หมู่บ้าน ตำบล อำเภอ จังหวัด" required rows="4"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">Username:</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" id="user" name="user" class="form-control" value="" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">Password:</label>
                                                        <div class="col-lg-9">
                                                            <input type="password" id="pass" name="pass" class="form-control" value="" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                    <button type="submit" name="btn_add" class="btn btn-success">ยันยันบันทึกข้อมูล</button>
                                                </div>
                                            </form>

                                        </div>
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
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">เบอร์โทร</th>
                                                    <th style="width:10%; vertical-align: middle;">อีเมล</th>
                                                    <th style="width:20%; vertical-align: middle;">ที่อยู่</th>
                                                    <th style="width:15%; text-align: center; vertical-align: middle;">Uername</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">Password</th>
                                                    <th style="width:15%; text-align: center; vertical-align: middle;">จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                                                    $fullname = $row['pkname'] . $row['fname'] . '  ' . $row['lname'];
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                                        <td style="vertical-align: middle;"><?= $fullname; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['phone']; ?></td>
                                                        <td style="vertical-align: middle;"><?= $row['email']; ?></td>
                                                        <td style="vertical-align: middle;"><?= $row['address']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['user']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['pass']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <button type="button" class="btn btn-warning btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#edit-modal<?= $row['id']; ?>"><i class="fal fa-edit"></i></button>
                                                            <button type="button" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed" data-toggle="modal" data-target="#del-modal<?= $row['id']; ?>"><i class="fal fa-times"></i></button>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Edit-->
                                                    <div class="modal fade" id="edit-modal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">

                                                                <form action="action/account_db.php" method="post" enctype="multipart/form-data">

                                                                    <input type="hidden" id="status" name="status" value="<?= $check_status; ?>">

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">
                                                                            แก้ไขข้อมูล<?= $show_name; ?>
                                                                        </h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="id">Account ID:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="text" id="id" name="id" class="form-control" value="<?= $row['id']; ?>" placeholder="ระบบสร้างอัตโนมัติ" readonly="">
                                                                            </div>

                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">คำนำหน้า:</label>
                                                                            <div class="col-lg-9">
                                                                                <select class="custom-select form-control" id="pkname" name="pkname" required>
                                                                                    <option value="<?= $row['pkname']; ?>">-- <?= $row['pkname']; ?> -</option>
                                                                                    <option value="นาย">นาย</option>
                                                                                    <option value="นาง">นาง</option>
                                                                                    <option value="นางสาว">นางสาว</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ชื่อจริง:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="text" id="fname" name="fname" class="form-control" value="<?= $row['fname']; ?>" required>
                                                                            </div>

                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">นามสกุล:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="text" id="lname" name="lname" class="form-control" value="<?= $row['lname']; ?>" required>
                                                                            </div>

                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">เบอร์โทร:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="text" id="phone" name="phone" class="form-control" value="<?= $row['phone']; ?>" required>
                                                                            </div>

                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">อีเมล:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="email" id="email" name="email" class="form-control" value="<?= $row['email']; ?>">
                                                                            </div>

                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ที่อยู่:</label>
                                                                            <div class="col-lg-9">
                                                                                <textarea class="form-control" id="address" name="address" placeholder="หมู่บ้าน ตำบล อำเภอ จังหวัด" required rows="4">
                                                                                    <?= $row['address']; ?>
                                                                                </textarea>
                                                                            </div>

                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">Username:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="text" id="user" name="user" class="form-control" value="<?= $row['user']; ?>" required>
                                                                            </div>

                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">Password:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="password" id="pass" name="pass" class="form-control" value="<?= $row['pass']; ?>" required>
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

                                                    <!-- Modal Alert Delete -->
                                                    <div class="modal fade" id="del-modal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form action="action/account_db.php" method="post" enctype="multipart/form-data">

                                                                    <input type="hidden" id="status" name="status" value="<?= $check_status; ?>">

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">
                                                                            ลบข้อมูล<?= $show_name; ?>
                                                                        </h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-12 mb-2"><label class="form-label" for="">Account ID:&nbsp;</label> <?= $row['id']; ?></div>
                                                                            <div class="col-12 mb-2"><label class="form-label" for="">ชื่อ-นามสกุล:&nbsp;</label> <?= $row['pkname']; ?><?= $row['fname']; ?> <?= $row['lname']; ?></div>
                                                                            <div class="col-12 mb-2"><label class="form-label" for="">เบอร์โทร:&nbsp;</label> <?= $row['phone']; ?></div>
                                                                            <div class="col-12 mb-2"><label class="form-label" for="">email:&nbsp;</label> <?= $row['email']; ?></div>
                                                                            <div class="col-12 mb-2"><label class="form-label" for="">ที่อยู่:&nbsp;</label> <?= $row['address']; ?></div>
                                                                            <div class="col-12 mb-2"><label class="form-label" for="">Username:&nbsp;</label> <?= $row['user']; ?></div>
                                                                            <div class="col-12 mb-2"><label class="form-label" for="">Password:&nbsp;</label> <?= $row['pass']; ?></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                                                        <button type="submit" name="btn_del" value="<?= $row['id']; ?>" class="btn btn-danger"><i class="fal fa-times"></i> ยันยันลบข้อมูล</button>
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