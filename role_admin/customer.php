<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        ลูกค้า - ระบบจัดการสินค้าออนไลน์
    </title>
    <meta name="description" content="">
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
    <link rel="stylesheet" media="screen, print" href="../assets/dist/css/theme-demo.css">
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
                        <li class="breadcrumb-item active">ลูกค้า</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                    </ol>
                    <div class="subheader">
                        <h1 class="subheader-title">
                            <i class='subheader-icon fal fa-users'></i> ลูกค้า
                            <small>

                            </small>
                        </h1>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div id="panel-1" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                        ข้อมูล
                                    </h2>
                                    <div class="panel-toolbar">
                                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                    </div>
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content">

                                        <div class="tab-pane fade show active pt-4" id="1">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100"></table>
                                                </div>
                                            </div>
                                        </div>

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
            // Event Lot
            var events = $("#app-eventlog");

            var columnSet = [{
                    title: "ID",
                    id: "id",
                    data: "id",
                    placeholderMsg: "Auto generated ID",
                    type: "readonly"
                },
                {
                    title: "คำนำหน้า",
                    id: "pkname",
                    data: "pkname",
                    type: "select",
                    "options": [
                        "นาย",
                        "นาง",
                        "นางสาว"
                    ]
                },
                {
                    title: "ชื่อจริง",
                    id: "fname",
                    data: "fname",
                    type: "text"
                },
                {
                    title: "นามสกุล",
                    id: "lname",
                    data: "lname",
                    type: "text"
                },
                {
                    title: "บัญชีผู้ใช้งาน",
                    id: "user",
                    data: "user",
                    type: "text"
                },
                {
                    title: "รหัสผ่าน",
                    id: "pass",
                    data: "pass",
                    type: "text"
                },
                {
                    title: "เบอร์โทร",
                    id: "phone",
                    data: "phone",
                    type: "number"
                },
                {
                    title: "Email",
                    id: "email",
                    data: "email",
                    type: "email"
                },
                {
                    title: "ที่อยู่",
                    id: "address",
                    data: "address",
                    type: "text"
                }
            ]

            /* start data table */
            var myTable = $('#dt-basic-example').dataTable({

                dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

                ajax: "fetch/fetch_customer.php",

                columns: columnSet,

                select: 'single',
                altEditor: true,
                responsive: true,

                buttons: [{
                        extend: 'selected',
                        text: '<i class="fal fa-times mr-1"></i> ลบ',
                        name: 'delete',
                        className: 'btn-primary btn-sm mr-1'
                    },
                    {
                        extend: 'selected',
                        text: '<i class="fal fa-edit mr-1"></i> แก้ไข',
                        name: 'edit',
                        className: 'btn-primary btn-sm mr-1'
                    },
                    {
                        text: '<i class="fal fa-plus mr-1"></i> เพิ่ม',
                        name: 'add',
                        className: 'btn-success btn-sm mr-1'
                    },
                    {
                        text: '<i class="fal fa-sync mr-1"></i> Synchronize',
                        name: 'refresh',
                        className: 'btn-primary btn-sm'
                    }
                ],

                columnDefs: [{
                    targets: 0,
                    type: 'text',
                    render: function(data, type, full, meta) {
                        if (data >= 0) {
                            return '<span class="text-success fw-500">CTM-' + data + '</span>';
                        } else {
                            return '<span class="text-danger fw-500">CTM-' + data + '</span>';
                        }
                    },
                }],

                onAddRow: function(dt, rowdata, success, error) {

                    $.ajax({

                        url: 'add/add_customer.php',
                        type: 'post',
                        dataType: 'json',
                        data: rowdata,
                        success: function(response) {

                            if (response.status == 200) {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'เพิ่มข้อมูล สำเร็จเรียบร้อย...!!'
                                }).then(function() {
                                    window.location.reload();
                                });

                                success(rowdata);

                                $('#modal-id').modal('hide');

                            } else if (response.status == 500) {

                                success(rowdata);

                                $('#modal-id').modal('hide');

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'ข้อมูลซ้ำ...!!'
                                }).then(function() {
                                    window.location.reload();
                                });

                            } else {

                                success(rowdata);

                                $('#modal-id').modal('hide');

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'เพิ่มข้อมูล ไม่สำเร็จ...!!'
                                }).then(function() {
                                    window.location.reload();
                                });

                            }

                        },
                        error: function(error) {
                            console.log("bad", error);
                        }
                    });

                },
                onEditRow: function(dt, rowdata, success, error) {
                    $.ajax({

                        url: 'del/del_customer.php',
                        type: 'post',
                        dataType: "json",
                        data: rowdata,
                        success: success,
                        error: error
                    });
                },
                onDeleteRow: function(dt, rowdata, success, error) {

                    $.ajax({

                        url: 'del/del_customer.php',
                        type: 'post',
                        dataType: "json",
                        data: rowdata,
                        success: function(response) {

                            if (response.status == 200) {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'ลบข้อมูล สำเร็จเรียบร้อย...!!'
                                }).then(function() {
                                    window.location.reload();
                                });

                                success(rowdata);

                                $('#modal-id').modal('hide');

                            } else {
                                success(rowdata);

                                $('#modal-id').modal('hide');

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'ลบข้อมูล ไม่สำเร็จ...!!'
                                }).then(function() {
                                    window.location.reload();
                                });

                            }

                        },
                        error: function(error) {
                            console.log("bad", error);
                        }
                    });
                },


            });

        });
    </script>
</body>
<!-- END Body -->

</html>