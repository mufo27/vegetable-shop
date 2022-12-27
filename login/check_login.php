<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ตรวจสอบการเข้าสู่ระบบ</title>
    <link rel="stylesheet" href="style.css">
  <!-- sweetalert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

  <?php

  session_start();

  if (isset($_POST['btn_login'])) {

    require_once('../database/condb.inc.php');

    $user  =  $_POST['username'];
    $pass  =  $_POST['password'];

    try {

      $select_login =  $conn->prepare("SELECT id, user, pass, fname, status FROM account WHERE user = :user AND pass = :pass");
      $select_login->bindParam(':user',  $user);
      $select_login->bindParam(':pass',  $pass);
      $select_login->execute();

      if ($select_login->rowCount() > 0) {

        $row_login = $select_login->fetch(PDO::FETCH_ASSOC);

        if ($row_login['user'] === $user && $row_login['pass'] === $pass && $row_login['status'] !== null) {

          if ($row_login['status'] === 0) {

            $_SESSION['id']  = $row_login['id'];
            $_SESSION['fname'] = $row_login['fname'];
            $_SESSION['status'] = $row_login['status'];

            echo '<script type="text/javascript">
                          Swal.fire({
                            icon: "success",
                            title: "เข้าสู่ระบบสำเร็จ ผู้ดูแลระบบ", 
                            showConfirmButton: false,
                            timer: 2000
                          });
                        </script>';
            echo "<meta http-equiv=\"refresh\" content=\"3; URL=../role_admin/index.php\">";
            exit;
          } else if ($row_login['status'] === 1) {

            $_SESSION['id']  = $row_login['id'];
            $_SESSION['fname'] = $row_login['fname'];
            $_SESSION['status'] = $row_login['status'];

            echo '<script type="text/javascript">
                          Swal.fire({
                            icon: "success",
                            title: "เข้าสู่ระบบสำเร็จ เกษตกร", 
                            showConfirmButton: false,
                            timer: 2000
                          });
                        </script>';
            echo "<meta http-equiv=\"refresh\" content=\"3; URL=../role_farmer/index.php\">";
            exit;
          } else if ($row_login['status'] === 2) {

            $_SESSION['id']  = $row_login['id'];
            $_SESSION['fname'] = $row_login['fname'];
            $_SESSION['status'] = $row_login['status'];

            echo '<script type="text/javascript">
                          Swal.fire({
                            icon: "success",
                            title: "เข้าสู่ระบบสำเร็จ ลูกค้า", 
                            showConfirmButton: false,
                            timer: 2000
                          });
                        </script>';
            echo "<meta http-equiv=\"refresh\" content=\"3; URL=../role_customer/index.php\">";
            exit;
          } else if ($row_login['status'] === 3) {

            $_SESSION['id']  = $row_login['id'];
            $_SESSION['fname'] = $row_login['fname'];
            $_SESSION['status'] = $row_login['status'];

            echo '<script type="text/javascript">
                          Swal.fire({
                            icon: "success",
                            title: "เข้าสู่ระบบสำเร็จ พนง.ขนส่ง", 
                            showConfirmButton: false,
                            timer: 2000
                          });
                        </script>';
            echo "<meta http-equiv=\"refresh\" content=\"3; URL=../role_delivery/index.php\">";
            exit;
          } 
          
          else {

            echo '<script type="text/javascript">
                              Swal.fire(
                                "Error User Status ?",
                                "ติดต่อ Admin",
                                "question"
                              );
                            </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
            exit;
          }
        } else {

          echo '<script type="text/javascript">
                      Swal.fire(
                        "Error Code?",
                        "ติดต่อผู้พัฒนาโปรแกรม",
                        "question"
                      );
                    </script>';
          echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
          exit;
        }
      } else {

        echo '<script type="text/javascript">
                    Swal.fire({
                      icon: "error",
                      title: "ล้มเหลว",
                      text: "ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง..!!"
                    });
                  </script>';
        echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
        exit;
      }
    } catch (PDOException $e) {

      $e->getMessage();
    }
  }
  ?>

</body>

</html>