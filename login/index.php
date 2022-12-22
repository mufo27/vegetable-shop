<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>
    เข้าสู่ระบบ - ระบบขายผักออนไลน์
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
  <link rel="stylesheet" href="style.css">

</head>

<body>

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
            <a href="../register/index.php" class="btn-link text-white ml-auto">
              สมัครสมาชิกใหม่
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
                  ลงชื่อเพื่อเข้าใช้งานระบบ
                </h1>
                <div class="card p-4 rounded-plus bg-faded">
                  <form action="check_login.php" method="post">
                    <div class="form-group">
                      <label class="form-label" for="">บัญชีผู้ใช้งาน</label>
                      <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label class="form-label" for="">รหัสผ่าน</label>
                      <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="" required>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-lg-12 pr-lg-1 my-2">
                        <button type="submit" name="btn_login" class="btn btn-success btn-block btn-lg">เข้าสู่ระบบ</button>
                      </div>
                    </div>
                    <p class="mt-5 text-center">
                      ยังไม่มีบัญชี?
                      <a href="../register/index.php" class="text-danger">สมัครสมาชิกใหม่</a>
                    </p>
                  </form>
                </div>
              </div>
            </div>
            <!-- <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
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

</body>
<!-- END Body -->

</html>