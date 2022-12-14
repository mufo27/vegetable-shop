<?php
require_once('include/auth.inc.php');
require_once('../database/condb.inc.php');

$select = $conn->prepare("SELECT p.*, c.name AS category_name FROM product p INNER JOIN category c ON p.category_id = c.id ORDER BY p.category_id ASC");
$select->execute();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>

        สินค้า - ระบบจัดการสินค้าออนไลน์

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
                        <li class="breadcrumb-item active"> สินค้า </li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-12">
                            <div id="panel-1" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        แสดงรายการข้อมูลสินค้า
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

                                            <form action="action/product_db.php" method="post" enctype="multipart/form-data">

                                                <div class="modal-header">
                                                    <h4 class="modal-title">
                                                        เพิ่มข้อมูลสินค้า
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body bg-faded">
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">หมวดหมู่:</label>
                                                        <div class="col-lg-9">
                                                            <select class="custom-select form-control" name="category_id" required>
                                                                <option value="">-- เลือก --</option>
                                                                <?php
                                                                $select_t1 = $conn->prepare("SELECT * FROM category ORDER BY id ASC");
                                                                $select_t1->execute();
                                                                while ($row_t1 = $select_t1->fetch(PDO::FETCH_ASSOC)) {
                                                                ?>
                                                                    <option value="<?= $row_t1['id']; ?>"> <?= $row_t1['name']; ?> </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="id">Product ID:</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" id="id" name="id" class="form-control" value="" placeholder="ระบบสร้างอัตโนมัติ" readonly="">
                                                        </div>

                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">สินค้า:</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" id="name" name="name" class="form-control" value="" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">รายละเอียด:</label>
                                                        <div class="col-lg-9">
                                                            <textarea class="form-control" id="" name="detail" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">จำนวนสินค้า:</label>
                                                        <div class="col-lg-9">
                                                            <input type="number" id="qty" name="qty" class="form-control" value="" min="0" max="10000" placeholder="ระบุจำนวนสินค้าในคลัง" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">หน่วยนับ:</label>
                                                        <div class="col-lg-9">
                                                            <input type="text" id="unit" name="unit" class="form-control" value="" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ราคารับซื้อ:</label>
                                                        <div class="col-lg-9">
                                                            <input type="number" id="price_buy" name="price_buy" class="form-control" min="0" max="999999" value="" placeholder="" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">สถานะรับซื้อ:</label>
                                                        <div class="col-lg-9">
                                                            <select class="custom-select form-control" name="status_buy" required>
                                                                <option value="">-- เลือก --</option>
                                                                <option value="ปิด">ปิด</option>
                                                                <option value="เปิด">เปิด</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ราคาขาย:</label>
                                                        <div class="col-lg-9">
                                                            <input type="number" id="price_sell" name="price_sell" class="form-control" min="0" max="999999" value="" placeholder="" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">สถานะขาย:</label>
                                                        <div class="col-lg-9">
                                                            <select class="custom-select form-control" name="status_sell" required>
                                                                <option value="">-- เลือก --</option>
                                                                <option value="ปิด">ปิด</option>
                                                                <option value="เปิด">เปิด</option>
                                                            </select>
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
                                                    <th style="width:15%; vertical-align: middle;">ประเภท</th>
                                                    <th style="width:15%; vertical-align: middle;">สินค้า</th>
                                                    <th style="width:20%; vertical-align: middle;">รายละเอียด</th>
                                                    <th style="width:10%; text-align: center; vertical-align: middle;">รูปภาพ</th>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">จำนวนสินค้า</th>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">หน่วยนับ</th>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">ราคารับซื้อ</th>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">สถานะรับซื้อ</th>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">ราคาขาย</th>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">สถานะขาย</th>
                                                    <th style="width:5%; text-align: center; vertical-align: middle;">จัดการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {

                                                    if ($row['status_buy'] === 'ปิด') {
                                                        $show_status_buy = '<span class="badge badge-danger badge-pill">ปิด</span>';
                                                    } else {
                                                        $show_status_buy = '<span class="badge badge-success badge-pill">เปิด</span>';
                                                    }

                                                    if ($row['status_sell'] === 'ปิด') {
                                                        $show_status_sell = '<span class="badge badge-danger badge-pill">ปิด</span>';
                                                    } else {
                                                        $show_status_sell = '<span class="badge badge-success badge-pill">เปิด</span>';
                                                    }

                                                ?>
                                                    <tr>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
                                                        <td style="vertical-align: middle;"><?= $row['category_name']; ?></td>
                                                        <td style="vertical-align: middle;"><?= $row['name']; ?></td>
                                                        <td style="vertical-align: middle;"><?= $row['detail']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <a href="product_img.php?product_img=<?= $row['id']; ?>" class="btn btn-info btn-sm waves-effect waves-themed"><span class="fal fa-images mr-1"></span> เปิด</a>
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['qty']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['unit']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['price_buy']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $show_status_buy; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $row['price_sell']; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?= $show_status_sell; ?></td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <button type="button" class="btn btn-warning btn-sm btn-icon waves-effect waves-themed mb-2" data-toggle="modal" data-target="#edit-modal<?= $row['id']; ?>"><i class="fal fa-edit"></i></button>
                                                            <button type="button" class="btn btn-danger btn-sm btn-icon waves-effect waves-themed mb-2" data-toggle="modal" data-target="#del-modal<?= $row['id']; ?>"><i class="fal fa-times"></i></button>
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
                                                                    <div class="modal-body bg-faded">
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
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ราคารับซื้อ:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="number" id="price_buy" name="price_buy" class="form-control" min="0" max="999999" value="<?= $row['price_buy']; ?>" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">สถานะรับซื้อ:</label>
                                                                            <div class="col-lg-9">
                                                                                <select class="custom-select form-control" name="status_buy" required>
                                                                                    <option value="<?= $row['status_buy']; ?>">-- <?= $row['status_buy']; ?> --</option>
                                                                                    <option value="ปิด">ปิด</option>
                                                                                    <option value="เปิด">เปิด</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">ราคาขาย:</label>
                                                                            <div class="col-lg-9">
                                                                                <input type="number" id="price_sell" name="price_sell" class="form-control" min="0" max="999999" value="<?= $row['price_sell']; ?>" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="form-label col-sm-3 col-form-label text-left text-sm-right" for="">สถานะขาย:</label>
                                                                            <div class="col-lg-9">
                                                                                <select class="custom-select form-control" name="status_sell" required>
                                                                                    <option value="<?= $row['status_sell']; ?>">-- <?= $row['status_sell']; ?> --</option>
                                                                                    <option value="ปิด">ปิด</option>
                                                                                    <option value="เปิด">เปิด</option>
                                                                                </select>
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
                                                                <form action="action/product_db.php" method="post" enctype="multipart/form-data">

                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">
                                                                            ลบข้อมูลสินค้า
                                                                        </h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body bg-faded">
                                                                        <div class="row">
                                                                            <div class="col-12 mb-2">
                                                                                <label class="form-label" for="">หมวดหมู่:&nbsp;</label> 
                                                                                <?= $row['category_name']; ?>
                                                                            </div>
                                                                            <div class="col-12 mb-2">
                                                                                <label class="form-label" for="">Product ID:&nbsp;</label> 
                                                                                <?= $row['id']; ?>
                                                                            </div>
                                                                            <div class="col-12 mb-2">
                                                                                <label class="form-label" for="">สินค้า:&nbsp;</label> 
                                                                                <?= $row['name']; ?>
                                                                            </div>
                                                                            <div class="col-12 mb-2">
                                                                                <label class="form-label" for="">รายละเอียด:&nbsp;</label> 
                                                                                <?= $row['detail']; ?>
                                                                            </div>
                                                                            <div class="col-12 mb-2">
                                                                                <label class="form-label" for="">จำนวนสินค้า:&nbsp;</label> 
                                                                                <?= $row['qty']; ?> <?= $row['unit']; ?>
                                                                            </div>
                                                                            <div class="col-12 mb-2">
                                                                                <label class="form-label" for="">ราคารับซื้อ:&nbsp;</label> 
                                                                                <?= $row['price_buy']; ?> บาท
                                                                            </div>
                                                                            <div class="col-12 mb-2">
                                                                                <label class="form-label" for="">สถานะรับซื้อ:&nbsp;</label> 
                                                                                <?= $show_status_buy; ?>
                                                                            </div>
                                                                            <div class="col-12 mb-2">
                                                                                <label class="form-label" for="">ราคาขาย:&nbsp;</label> 
                                                                                <?= $row['price_sell']; ?> บาท
                                                                            </div>
                                                                            <div class="col-12 mb-2">
                                                                                <label class="form-label" for="">สถานะขาย:&nbsp;</label> 
                                                                                <?= $show_status_sell; ?>
                                                                            </div>
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