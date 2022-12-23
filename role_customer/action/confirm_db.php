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

// if (isset($_POST['btn_confirm'])) {
//     print_r('<pre>');
//     print_r($_POST);
//     print_r('<pre>');
// }

    if (isset($_POST['btn_confirm'])) {

        require_once('../../database/condb.inc.php');

        // data randomly generated
        $orders_code     =  rand(1111111, 9999999);
        $payment_code    =  rand(1111111, 9999999);
        $send_code       =  rand(1111111, 9999999);

        // data order
        $orders_total   =   $_POST['orders_total'];

        // data products
        $product_check_num  =  $_POST['product_check_num'];
        $product_id         =  $_POST['product_id'];
        $product_price      =  $_POST['product_price'];
        $product_number     =  $_POST['product_number'];

        // data payment
        $payment_form = '-';

        // data send

        // data customer
        $account_id     =   $_SESSION['id'];
        $pkname         =   trim($_POST['pkname']);
        $fname          =   trim($_POST['fname']);
        $lname          =   trim($_POST['lname']);
        $phone          =   trim($_POST['phone']);
        $address        =   trim($_POST['address']);

        try {

            $select_check_account = $conn->prepare("SELECT id, pkname, fname, lname, phone, address FROM account WHERE id=?");
            $select_check_account->bindParam(1, $account_id);
            $select_check_account->execute();
            $row_check_account = $select_check_account->fetch(PDO::FETCH_ASSOC);

            if (
                $row_check_account['pkname']    ===   null ||
                $row_check_account['fname']     ===   null ||
                $row_check_account['lname']     ===   null ||
                $row_check_account['phone']     ===   null ||
                $row_check_account['address']   ===   null
            ) {
                $update_account = $conn->prepare("UPDATE account SET pkname=?, fname=?, lname=?, phone=?, address=? WHERE id=?");
                $update_account->bindParam(1, $pkname);
                $update_account->bindParam(2, $fname);
                $update_account->bindParam(3, $lname);
                $update_account->bindParam(4, $phone);
                $update_account->bindParam(5, $address);
                $update_account->bindParam(6, $row_check_account['id']);
                $update_account->execute();
            }

            $insert_orders = $conn->prepare("INSERT INTO orders (account_id, code, total) VALUES (?,?,?)");
            $insert_orders->bindParam(1,  $account_id);
            $insert_orders->bindParam(2,  $orders_code);
            $insert_orders->bindParam(3,  $orders_total);
            $insert_orders->execute();

            $orders_id = $conn->lastInsertId();

            foreach ($product_check_num as $i) {
                $insert_order_details = $conn->prepare("INSERT INTO order_details (product_id, price, number, orders_id) VALUES (?,?,?,?)");
                $insert_order_details->bindParam(1,  $product_id[$i]);
                $insert_order_details->bindParam(2,  $product_price[$i]);
                $insert_order_details->bindParam(3,  $product_number[$i]);
                $insert_order_details->bindParam(4,  $orders_id);
                $insert_order_details->execute();
            }

            $insert_payment = $conn->prepare("INSERT INTO payment (code, form, orders_id) VALUES (?,?,?)");
            $insert_payment->bindParam(1,  $payment_code);
            $insert_payment->bindParam(2,  $payment_form);
            $insert_payment->bindParam(3,  $orders_id);
            $insert_payment->execute();

            $insert_send = $conn->prepare("INSERT INTO send (code, orders_id) VALUES (?,?)");
            $insert_send->bindParam(1,  $send_code);
            $insert_send->bindParam(2,  $orders_id);
            $insert_send->execute();

            if ($update_account && 
                $insert_orders && 
                $insert_order_details && 
                $insert_payment && 
                $insert_send
            ) {

                echo '<script type="text/javascript">
                                    Swal.fire({
                                        icon: "success",
                                        title: "บันทึกข้อมูลสังซื้อสินค้า เรียบร้อย!!", 
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                    </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=../order.php?order\">";
                exit;
            } else {

                echo '<script type="text/javascript">
                                    Swal.fire({
                                    icon: "error",
                                    title: "ล้มเหลว",
                                    text: "โปรด ลองใหม่อีกครั้ง..!!"
                                    });
                                </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=../confirm.php?confirm\">";
                exit;
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }

    ?>

</body>

</html>