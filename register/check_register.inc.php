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

    $select = $conn->prepare("SELECT count(id) AS check_num FROM account WHERE user=:user or phone=:phone");
    $select->bindParam(':user', $user);
    $select->bindParam(':phone', $phone);
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

        $insert = $conn->prepare("INSERT INTO account (phone, user, pass, status) 
                                                VALUES(:phone, :user, :pass, :status)
                                            ");

        $insert->bindParam(':phone',  $phone);
        $insert->bindParam(':user',  $user);
        $insert->bindParam(':pass',  $pass);
        $insert->bindParam(':status',  $status);
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
