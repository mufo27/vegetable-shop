<?php require_once('../include/auth.inc.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กำลังดำเนินการสั่งซื้อสินค้า</title>

    <link rel="stylesheet" href="../include/style.css">
    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php

    if (isset($_POST['btn_edit'])) {

        require_once('../../database/condb.inc.php');

        $id = $_POST['id'];
        $pkname = $_POST['pkname'];
        $fname  =   $_POST['fname'];
        $lname  =   $_POST['lname'];
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        $select_check = $conn->prepare("SELECT * FROM account WHERE user=? AND pass=? ");
        $select_check->bindParam(1, $user);
        $select_check->bindParam(2, $phone);
        $select_check->execute();

        if ($select_check->rowCount() > 1) {

            echo '<script type="text/javascript">
                            Swal.fire({
                            icon: "error",
                            title: "ล้มเหลว",
                            text: "ข้อมูลซ้ำกันกับในระบบ..!!"
                            });
                        </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=../profile.php\">";
            exit;
        } else {
            try {

                $update = $conn->prepare("UPDATE account SET fname=?, lname=?, user=?, pass=?, address=?, phone=?, pkname=? WHERE id=?");
                $update->bindParam(1, $fname);
                $update->bindParam(2, $lname);
                $update->bindParam(3, $user);
                $update->bindParam(4, $pass);
                $update->bindParam(5, $address);
                $update->bindParam(6, $phone);
                $update->bindParam(7, $pkname);
                $update->bindParam(8, $id);


                if ($update->execute()) {
                    echo '<script type="text/javascript">
                    Swal.fire({
                        icon: "success",
                        title: "แก้ไขข้อมูล เรียบร้อย...!!", 
                        showConfirmButton: false,
                        timer: 2000
                    });
                    </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=../profile.php\">";
                } else {
                    echo '<script type="text/javascript">
                    Swal.fire({
                    icon: "error",
                    title: "ล้มเหลว",
                    text: "โปรด ลองใหม่อีกครั้ง..!!"
                    });
                </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=../profile.php\">";
                }
            } catch (PDOException $e) {

                echo $e->getMessage();
            }
        }
    }

    ?>

</body>

</html>