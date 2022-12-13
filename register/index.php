<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>
    ลงทะเบียน - ระบบขายผักออนไลน์
  </title>
  <meta name="description" content="Login">
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
  <link rel="stylesheet" media="screen, print" href="../assets/dist/css/fa-brands.css">
  <!-- sweetalert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- font google -->
  <style type="text/css">
    @import url("https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap");

    body {
      font-family: "Kanit", sans-serif;
      font-size: 16px;
    }
  </style>

</head>

<body>

  <?php require_once('check_register.inc.php'); ?>

  <div class="page-wrapper auth">
    <div class="page-inner bg-brand-gradient">
      <div class="page-content-wrapper bg-transparent m-0">
        <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
          <div class="d-flex align-items-center container p-0">
            <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9 border-0">
              <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                <img src="../assets/dist/img/logo.png" alt="" aria-roledescription="logo">
                <span class="page-logo-text mr-1">ระบบขายผักออนไลน์</span>
              </a>
            </div>
            <a href="../login/index.php" class="btn-link text-white ml-auto">
              เข้าสู่ระบบ
            </a>
          </div>
        </div>
        <div class="flex-1" style="background: url(../assets/dist/img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
          <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
            <div class="row">
              <div class="col col-md-6 col-lg-7 hidden-sm-down">
                <h1 class="display-2 fw-500 mt-4 text-white">
                  ระบบขายผักออนไลน์
                </h1>
                <div class="d-sm-flex flex-column align-items-center justify-content-center d-md-block">
                  <div class="px-0 py-1 mt-3 text-white fs-nano opacity-50">
                    <h1 class="display-5">พบกับเราบนโซเชียลมีเดีย</h1>
                  </div>
                  <div class="d-flex flex-row opacity-70">
                    <a href="#" class="mr-2 fs-xxl text-white">
                      <i class="fab fa-facebook-square"></i>
                    </a>
                    <a href="#" class="mr-2 fs-xxl text-white">
                      <i class="fab fa-twitter-square"></i>
                    </a>
                    <a href="#" class="mr-2 fs-xxl text-white">
                      <i class="fab fa-google-plus-square"></i>
                    </a>
                    <a href="#" class="mr-2 fs-xxl text-white">
                      <i class="fab fa-linkedin"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto">
                <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">
                  แบบฟอร์มสมัครสมาชิกใหม่
                </h1>
                <div class="card p-4 rounded-plus bg-faded">
                  <form id="js-login" novalidate="" action="" method="post">
                    <div class="form-group">
                      <label class="form-label" for="phone">Phone</label>
                      <input type="phone" id="phone" name="phone" class="form-control form-control-lg" placeholder="เบอร์โทร" value="" required>
                      <div class="invalid-feedback">คุณไม่ได้กรอกข้อมูลช่องนี้...!!</div>
                    </div>
                    <div class="form-group">
                      <label class="form-label" for="username">Username</label>
                      <input type="email" id="username" name="user" class="form-control form-control-lg" placeholder="ชื่อบัญชีผู้ใช้งาน" value="" required>
                      <div class="invalid-feedback">คุณไม่ได้กรอกข้อมูลช่องนี้...!!</div>
                    </div>
                    <div class="form-group">
                      <label class="form-label" for="password">Password</label>
                      <input type="password" id="password" name="pass" class="form-control form-control-lg" placeholder="รหัสผ่าน" value="" required>
                      <div class="invalid-feedback">คุณไม่ได้กรอกข้อมูลช่องนี้...!!</div>
                    </div>
                    <div class="form-group">
                      <label class="form-label" for="password">Confirm Password</label>
                      <input type="password" id="re-password" name="cpass" class="form-control form-control-lg" placeholder="ยืนยันรหัสผ่าน" value="" required>
                      <div class="invalid-feedback">คุณไม่ได้กรอกข้อมูลช่องนี้...!!</div>
                    </div>
                    <div class="form-group">
                      <label for="">สถานะพันธมิตร</label>
                      <select class="form-control form-control-lg" name="status" required>
                        <option selected value="">เลือก</option>
                        <option value="1">เกษตกร</option>
                        <option value="2">ลูกค้า</option>
                      </select>
                      <div class="invalid-feedback">คุณไม่ได้กรอกข้อมูลช่องนี้...!!</div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-lg-6 pr-lg-1 my-2">
                        <button type="submit" name="btn_register" class="btn btn-info btn-block btn-lg">ยืนยัน</button>
                      </div>
                      <div class="col-lg-6 pl-lg-1 my-2">
                        <button id="js-login-btn" type="submit" class="btn btn-danger btn-block btn-lg">ตรวจสอบข้อมูล</button>
                      </div>
                    </div>
                    <p class="mt-5 text-muted text-center">
                      มีบัญชีอยู่แล้ว?
                      <a href="../login/index.php">เข้าสู่ระบบ</a>
                    </p>
                  </form>
                </div>
              </div>
            </div>
            <!-- <div class="mt-5 position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
              ระบบขายผักออนไลน์ © 2020
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- BEGIN Color profile -->

  <script src="../assets/dist/js/vendors.bundle.js"></script>
  <script src="../assets/dist/js/app.bundle.js"></script>
  <script>
    $("#js-login-btn").click(function(event) {

      // Fetch form to apply custom Bootstrap validation
      var form = $("#js-login")

      if (form[0].checkValidity() === false) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.addClass('was-validated');
      // Perform ajax submit here...
    });
  </script>
</body>
<!-- END Body -->

</html>