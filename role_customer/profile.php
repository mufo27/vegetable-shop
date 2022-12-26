<?php
require_once('include/auth.inc.php');
require_once('../database/condb.inc.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        ข้อมูลส่วนตัว - ระบบจัดการสินค้าออนไลน์
    </title>
    <meta name="description" content="Profile">
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
    <!-- Optional: page related CSS-->
    <link rel="stylesheet" media="screen, print" href="../assets/dist/css/fa-brands.css">
    <link rel="stylesheet" media="screen, print" href="../assets/dist/css/fa-solid.css">
    <link rel="stylesheet" href="./include/style.css">

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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">ข้อมูลส่วนตัว</a></li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-12">
                            <div id="panel-6" class="panel">
                                <div class="panel-hdr">
                                    <h2>
                                    <i class="fal fa-user-circle"></i>&nbsp;ข้อมูลส่วนตัว
                                    </h2>
                                    <!-- <div class="panel-toolbar">
                                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                        <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                    </div> -->
                                </div>
                                <div class="panel-container show">
                                    <div class="panel-content p-0">
                                        <form action="./action/profile_db.php" method="post">
                                            <?php
                                            require_once('../database/condb.inc.php');
                                            $select = $conn->prepare("SELECT * FROM account WHERE id=?");
                                            $select->bindParam(1, $_SESSION['id']);
                                            $select->execute();
                                            while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <div class="panel-content">
                                                    <div class="form-row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="validationDefault01">First name</label>
                                                            <input type="text" class="form-control" id="validationDefault01" name="fname" placeholder="First name" value="<?= $row['fname'] ?>" required="">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="validationDefault02">Last name</label>
                                                            <input type="text" class="form-control" id="validationDefault02" name="lname" placeholder="Last name" value="<?= $row['lname'] ?>" required="">
                                                        </div>

                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="validationDefault02">Username</label>
                                                            <input type="text" class="form-control" id="validationDefault02" name="user" placeholder="Username" value="<?= $row['user'] ?>" required="">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label" for="validationDefault02">Password</label>
                                                            <input type="text" class="form-control" id="validationDefault02" name="pass" placeholder="Password" value="<?= $row['pass'] ?>" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-row mb-2">
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label" for="validationDefault03">ที่อยู่</label>
                                                            <input type="text" class="form-control" id="validationDefault03" name="address" placeholder="ที่อยู่" value="<?= $row['address'] ?>" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-row mb-2">
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label" for="validationDefault03">เบอร์โทร</label>
                                                            <input type="tel" class="form-control" id="validationDefault03" name="phone" placeholder="เบอร์โทร" value="<?= $row['phone'] ?>" maxlength="10" pattern="[0-9]{10}" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row">
                                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                    <button class="btn btn-primary ml-auto waves-effect waves-themed" type="submit" name="btn_edit"><i class="fal fa-save"></i> บันทึกข้อมูล</button>
                                                </div>
                                            <?php } ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

                <?php include('include/footer.inc.php'); ?>

            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->

    <?php include('include/settings_page.inc.php'); ?>

    <script src=" ../assets/dist/js/vendors.bundle.js"></script>
    <script src="../assets/dist/js/app.bundle.js"></script>
</body>
<!-- END Body -->

</html>