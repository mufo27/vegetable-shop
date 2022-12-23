<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>กำลังดำเนินการสมัครสมาชิก</title>
  <link rel="stylesheet" href="style.css">
  <!-- sweetalert2 -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

  <?php

  if (isset($_POST['btn_register'])) {

    require_once('../database/condb.inc.php');

    $user     =   $_POST['user'];
    $pass     =   $_POST['pass'];
    $phone    =   $_POST['phone'];
    $cpass    =   $_POST['cpass'];
    $status   =   $_POST['status'];

    if ($pass != $cpass) {

      echo '<script type="text/javascript">
                    Swal.fire({
                    icon: "error",
                    title: "ล้มเหลว",
                    text: "ยันยืนรหัสไม่ตรงกัน..!!"
                    });
                </script>';
      echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
      exit;
    } else {

      $select = $conn->prepare("SELECT count(id) AS check_num FROM account WHERE user=? or phone=?");
      $select->bindParam(1, $user);
      $select->bindParam(2, $phone);
      $select->execute();
      $row = $select->fetch(PDO::FETCH_ASSOC);

      if ($row['check_num'] > 0) {

        echo '<script type="text/javascript">
                        Swal.fire({
                        icon: "error",
                        title: "ล้มเหลว",
                        text: "**ซ้ำ** มีข้อมูลอยู่ในระบบแล้ว..!!."
                        });
                    </script>';
        echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
        exit;
      } else {

        try {

          $insert = $conn->prepare("INSERT INTO account (phone, user, pass, status) VALUES (?,?,?,?)");
          $insert->bindParam(1,  $phone);
          $insert->bindParam(2,  $user);
          $insert->bindParam(3,  $pass);
          $insert->bindParam(4,  $status);
          $insert->execute();

          if ($insert) {

            echo '<script type="text/javascript">
                                Swal.fire({
                                    icon: "success",
                                    title: "ลงทะเบียน เรียบร้อย...!!", 
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=../login/index.php\">";
            exit;
          } else {

            echo '<script type="text/javascript">
                                Swal.fire({
                                icon: "error",
                                title: "ล้มเหลว",
                                text: "error..!!"
                                });
                            </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=index.php\">";
            exit;
          }
        } catch (PDOException $e) {

          echo $e->getMessage();
        }
      }
    }
  }
  ?>

</body>

</html>