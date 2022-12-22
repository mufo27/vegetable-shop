<?php require_once('../include/auth.inc.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กำลังดำเนินแจ้งสถานะจัดส่ง</title>

    <link rel="stylesheet" href="../include/style.css">
    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php

    if (isset($_POST['btn_edit'])) {

        require_once('../../database/condb.inc.php');

        $send_buy_status    =   $_POST['send_buy_status'];
        $account_id         =   $_POST['account_id'];
        $send_buy_id        =   $_POST['send_buy_id'];
        $send_order_buy     =   $_POST['send_order_buy'];
        
        try {

            $update = $conn->prepare("UPDATE send_buy SET status=?, account_id=? WHERE id=?");
            $update->bindParam(1 , $send_buy_status);
            $update->bindParam(2 , $account_id);
            $update->bindParam(3 , $send_buy_id);

            if ($update->execute()) {

                echo '<script type="text/javascript">
                                Swal.fire({
                                    icon: "success",
                                    title: "แก้ไขข้อมูล เรียบร้อย...!!", 
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=../send_order_buy.php?send_order_buy=$send_order_buy\">";
                exit;
            } else {

                echo '<script type="text/javascript">
                                Swal.fire({
                                icon: "error",
                                title: "ล้มเหลว",
                                text: "โปรด ลองใหม่อีกครั้ง..!!"
                                });
                            </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=../send_order_buy.php?send_order_buy=$send_order_buy\">";
                exit;
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
        
    }

    ?>

</body>

</html>