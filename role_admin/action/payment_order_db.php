<?php require_once('../include/auth.inc.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กำลังดำเนินการชำระเงิน</title>

    <link rel="stylesheet" href="../include/style.css">
    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php

    if (isset($_POST['btn_edit'])) {

        require_once('../../database/condb.inc.php');

        $payment_total = $_POST['payment_total'];
        $payment_form  = $_POST['payment_form'];
        $payment_id    = $_POST['payment_id'];

        try {

            $file_location  = "../../share/image/payment-slip/";

            if ($_FILES['payment_img']['tmp_name'] == "") {

                $newfilename   = $_POST['payment_img2'];
            } else {

                $allowedExts    =   array("jpg,png");
                $temp           =   explode(".", $_FILES["payment_img"]["name"]);
                $source_file    =   $_FILES['payment_img']['tmp_name'];
                $size_file      =   $_FILES['payment_img']['size'];
                $extension      =   end($temp);
                $newfilename    =   'pay_' . round(microtime(true)) . '.' . end($temp);

                unlink($file_location . $_POST['payment_img2']);
                move_uploaded_file($source_file, $file_location . $newfilename);
            }

            $update = $conn->prepare("UPDATE payment SET total=?, form=?, img=? WHERE id=?");
            $update->bindParam(1 , $payment_total);
            $update->bindParam(2 , $payment_form);
            $update->bindParam(3 , $newfilename);
            $update->bindParam(4 , $payment_id);

            if ($update->execute()) {

                echo '<script type="text/javascript">
                                Swal.fire({
                                    icon: "success",
                                    title: "แก้ไขข้อมูล เรียบร้อย...!!", 
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=../payment_order.php?payment_order\">";
                exit;
            } else {

                echo '<script type="text/javascript">
                                Swal.fire({
                                icon: "error",
                                title: "ล้มเหลว",
                                text: "โปรด ลองใหม่อีกครั้ง..!!"
                                });
                            </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=../payment_order.php?payment_order\">";
                exit;
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
        
    }

    ?>

</body>

</html>