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


            // Column Definitions
            var columnSet = [
                {
                    title: "id",
                    id: "id",
                    data: "id",
                    type: "text",
                    placeholderMsg: "ID",
                },
                // {
                //     title: "IP Address",
                //     id: "ipAddress",
                //     data: "ipAddress",
                //     type: "text",
                //     pattern: "((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)(\.|$)){4}",
                //     placeholderMsg: "e.g 82.84.86.88",
                //     errorMsg: "*Invalid address - Enter valid ip.",
                //     hoverMsg: "(Optional) - Ex: 82.84.86.88",
                //     unique: true,
                //     uniqueMsg: "Already exists. IP must be unique!",
                //     required: true
                // },
                // {
                //     title: "Port Number",
                //     id: "port",
                //     data: "port",
                //     type: "number",
                //     pattern: "^([0-9]{1,4}|[1-5][0-9]{4}|6[0-4][0-9]{3}|65[0-4][0-9]{2}|655[0-2][0-9]|6553[0-5])$",
                //     placeholderMsg: "e.g 6112",
                //     errorMsg: "*Invalid port - Enter valid port or range.",
                //     hoverMsg: "Ex: 6112 (single)   or   6111:6333 (range)",
                //     unique: false,
                //     required: true
                // },
                // {
                //     title: "Activation Date",
                //     id: "adate",
                //     data: "adate",
                //     type: "date",
                //     pattern: "((?:19|20)\d\d)-(0?[1-9]|1[012])-([12][0-9]|3[01]|0?[1-9])",
                //     placeholderMsg: "yyyy-mm-dd",
                //     errorMsg: "*Invalid date format. Format must be yyyy-mm-dd"
                // },
                // {
                //     title: "User Email",
                //     id: "user",
                //     data: "user",
                //     type: "text",
                //     pattern: "^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$",
                //     placeholderMsg: "user@domain.com",
                //     errorMsg: "*Invalid email - Enter valid email.",
                //     unique: true,
                //     required: true,
                //     uniqueMsg: "Email already in use"
                // },
                // {
                //     title: "Package",
                //     id: "package",
                //     data: "package",
                //     type: "select",
                //     "options": [
                //         "free",
                //         "silver",
                //         "gold",
                //         "platinum",
                //         "payg"
                //     ]
                // },
                // {
                //     title: "Acc. Balance",
                //     id: "balance",
                //     data: "balance",
                //     type: "number",
                //     placeholderMsg: "Amount due",
                //     defaultValue: "0"
                // }
            ]

            /* start data table */
            var myTable = $('#dt-basic-example').dataTable({
                /* check datatable buttons page for more info on how this DOM structure works */
                dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                // ajax: "../assets/dist/media/data/server-demo.json",
                ajax: "fetch/fetch_customer.php",
                // ajax: "fetch/test.json",
                columns: columnSet,
                /* selecting multiple rows will not work */
                select: 'single',
                /* altEditor at work */
                altEditor: true,
                responsive: true,
                /* buttons uses classes from bootstrap, see buttons page for more details */
                buttons: [{
                        extend: 'selected',
                        text: '<i class="fal fa-times mr-1"></i> Delete',
                        name: 'delete',
                        className: 'btn-primary btn-sm mr-1'
                    },
                    {
                        extend: 'selected',
                        text: '<i class="fal fa-edit mr-1"></i> Edit',
                        name: 'edit',
                        className: 'btn-primary btn-sm mr-1'
                    },
                    {
                        text: '<i class="fal fa-plus mr-1"></i> Add',
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
                        targets: 1,
                        render: function(data, type, full, meta) {
                            var badge = {
                                "active": {
                                    'title': 'Active',
                                    'class': 'badge-success'
                                },
                                "inactive": {
                                    'title': 'Inactive',
                                    'class': 'badge-warning'
                                },
                                "disabled": {
                                    'title': 'Disabled',
                                    'class': 'badge-danger'
                                },
                                "partial": {
                                    'title': 'Partial',
                                    'class': 'bg-danger-100 text-white'
                                }
                            };
                            if (typeof badge[data] === 'undefined') {
                                return data;
                            }
                            return '<span class="badge ' + badge[data].class + ' badge-pill">' + badge[data].title + '</span>';
                        },
                    },
                    {
                        targets: 7,
                        type: 'currency',
                        render: function(data, type, full, meta) {
                            //var number = Number(data.replace(/[^0-9.-]+/g,""));
                            if (data >= 0) {
                                return '<span class="text-success fw-500">$' + data + '</span>';
                            } else {
                                return '<span class="text-danger fw-500">$' + data + '</span>';
                            }
                        },
                    },
                    {
                        targets: 6,
                        render: function(data, type, full, meta) {
                            var package = {
                                "free": {
                                    'title': 'Free',
                                    'class': 'bg-fusion-50',
                                    'info': 'Free users are restricted to 30 days of use'
                                },
                                "silver": {
                                    'title': 'Silver',
                                    'class': 'bg-fusion-50 bg-fusion-gradient'
                                },
                                "gold": {
                                    'title': 'Gold',
                                    'class': 'bg-warning-500 bg-warning-gradient'
                                },
                                "platinum": {
                                    'title': 'Platinum',
                                    'class': 'bg-trans-gradient'
                                },
                                "payg": {
                                    'title': 'PAYG',
                                    'class': 'bg-success-500 bg-success-gradient'
                                }
                            };
                            if (typeof package[data] === 'undefined') {
                                return data;
                            }
                            return '<div class="has-popover d-flex align-items-center"><span class="d-inline-block rounded-circle mr-2 ' + package[data].class + '" style="width:15px; height:15px;"></span><span>' + package[data].title + '</span></div>';
                        },
                    },
                ],

                /* default callback for insertion: mock webservice, always success */
                onAddRow: function(dt, rowdata, success, error) {
                    console.log("Missing AJAX configuration for INSERT");
                    success(rowdata);

                    // demo only below:
                    events.prepend('<p class="text-success fw-500">' + JSON.stringify(rowdata, null, 4) + '</p>');
                },
                onEditRow: function(dt, rowdata, success, error) {
                    console.log("Missing AJAX configuration for UPDATE");
                    success(rowdata);

                    // demo only below:
                    events.prepend('<p class="text-info fw-500">' + JSON.stringify(rowdata, null, 4) + '</p>');
                },
                onDeleteRow: function(dt, rowdata, success, error) {
                    console.log("Missing AJAX configuration for DELETE");
                    success(rowdata);

                    // demo only below:
                    events.prepend('<p class="text-danger fw-500">' + JSON.stringify(rowdata, null, 4) + '</p>');
                },
            });

        });
    </script>
</body>
<!-- END Body -->

</html>