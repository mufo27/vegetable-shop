<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กำลังดำเนินการสินค้า</title>
    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php

    if (isset($_POST['btn_add'])) {

        require_once('../../database/condb.inc.php');

        $category_id    =   $_POST['category_id'];
        $name           =   $_POST['name'];
        $detail         =   $_POST['detail'];
        $qty            =   $_POST['qty'];
        $unit           =   $_POST['unit'];
        $price_buy      =   $_POST['price_buy'];
        $price_sell     =   $_POST['price_sell'];
        $status_buy     =   $_POST['status_buy'];
        $status_sell    =   $_POST['status_sell'];

        $select_check = $conn->prepare("SELECT * FROM product WHERE category_id=? AND name=?");
        $select_check->bindParam(1, $category_id);
        $select_check->bindParam(2, $name);
        $select_check->execute();

        if ($select_check->rowCount() > 0) {

            echo '<script type="text/javascript">
                                Swal.fire({
                                icon: "error",
                                title: "ล้มเหลว",
                                text: "ข้อมูลซ้ำกันกับในระบบ..!!"
                                });
                            </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=../product.php?product\">";
            exit;
        } else {

            try {

                $insert = $conn->prepare("INSERT INTO product (category_id, name, detail, qty, unit, price_buy, price_sell, status_buy, status_sell) VALUES (?,?,?,?,?,?,?,?,?) ");
                $insert->bindParam(1, $category_id);
                $insert->bindParam(2, $name);
                $insert->bindParam(3, $detail);
                $insert->bindParam(4, $qty);
                $insert->bindParam(5, $unit);
                $insert->bindParam(6, $price_buy);
                $insert->bindParam(7, $price_sell);
                $insert->bindParam(8, $status_buy);
                $insert->bindParam(9, $status_sell);

                if ($insert->execute()) {


                    echo '<script type="text/javascript">
                                      Swal.fire({
                                          icon: "success",
                                          title: "เพิ่มข้อมูล เรียบร้อย...!!", 
                                          showConfirmButton: false,
                                          timer: 2000
                                      });
                                      </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=../product.php?product\">";
                    exit;
                } else {

                    echo '<script type="text/javascript">
                                      Swal.fire({
                                      icon: "error",
                                      title: "ล้มเหลว",
                                      text: "โปรด ลองใหม่อีกครั้ง..!!"
                                      });
                                  </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=../product.php?product\">";
                    exit;
                }
            } catch (PDOException $e) {

                echo $e->getMessage();
            }
        }
    }

    if (isset($_POST['btn_edit'])) {

        require_once('../../database/condb.inc.php');

        $category_id    =   $_POST['category_id'];
        $name           =   $_POST['name'];
        $detail         =   $_POST['detail'];
        $qty            =   $_POST['qty'];
        $unit           =   $_POST['unit'];
        $price_buy      =   $_POST['price_buy'];
        $price_sell     =   $_POST['price_sell'];
        $status_buy     =   $_POST['status_buy'];
        $status_sell    =   $_POST['status_sell'];
        $id             =   $_POST['id'];

        $select_check = $conn->prepare("SELECT * FROM product WHERE category_id=? AND name=?");
        $select_check->bindParam(1, $category_id);
        $select_check->bindParam(2, $name);
        $select_check->execute();

        if ($select_check->rowCount() > 1) {

            echo '<script type="text/javascript">
                                Swal.fire({
                                icon: "error",
                                title: "ล้มเหลว",
                                text: "ข้อมูลซ้ำกันกับในระบบ..!!"
                                });
                            </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=../product.php?product\">";
            exit;
        } else {

            try {

                $update = $conn->prepare("UPDATE product SET category_id=?, name=?, detail=?, qty=?, unit=?, price_buy=?, price_sell=?, status_buy=?, status_sell=? WHERE id=?");
                $update->bindParam(1, $category_id);
                $update->bindParam(2, $name);
                $update->bindParam(3, $detail);
                $update->bindParam(4, $qty);
                $update->bindParam(5, $unit);
                $update->bindParam(6, $price_buy);
                $update->bindParam(7, $price_sell);
                $update->bindParam(8, $status_buy);
                $update->bindParam(9, $status_sell);
                $update->bindParam(10, $id);

                if ( $update->execute()) {

                    echo '<script type="text/javascript">
                                        Swal.fire({
                                            icon: "success",
                                            title: "แก้ไขข้อมูล เรียบร้อย...!!", 
                                            showConfirmButton: false,
                                            timer: 2000
                                        });
                                        </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=../product.php?product\">";
                    exit;
                } else {

                    echo '<script type="text/javascript">
                                        Swal.fire({
                                        icon: "error",
                                        title: "ล้มเหลว",
                                        text: "โปรด ลองใหม่อีกครั้ง..!!"
                                        });
                                    </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=../product.php?product\">";
                    exit;
                }
            } catch (PDOException $e) {

                echo $e->getMessage();
            }
        }
    }

    if (isset($_POST['btn_del'])) {

        require_once('../../database/condb.inc.php');

        $id =   $_POST['btn_del'];

        try {

            $file_location  = "../../share/image/product/";

            $check_product_img = $conn->prepare("SELECT img FROM product_img WHERE product_id=?");
            $check_product_img->bindParam(1, $id);
            $check_product_img->execute();

            while($row_img = $check_product_img->fetch(PDO::FETCH_ASSOC)){

                if ($row_img['img'] != '') {
                    unlink($file_location . $row_img['img']);
                }
            }

            $delete_product_img = $conn->prepare("DELETE FROM product_img WHERE id=?");
            $delete_product_img->bindParam(1, $id);

            $delete_product_buy = $conn->prepare("DELETE FROM product_buy WHERE id=?");
            $delete_product_buy->bindParam(1, $id);

            $delete_sell = $conn->prepare("DELETE FROM product_sell WHERE id=?");
            $delete_sell->bindParam(1, $id);

            $delete_order_details = $conn->prepare("DELETE FROM order_details WHERE id=?");
            $delete_order_details->bindParam(1, $id);
            
            $delete = $conn->prepare("DELETE FROM product WHERE id=?");
            $delete->bindParam(1, $id);

            if ($delete->execute()) {

                echo '<script type="text/javascript">
                            Swal.fire({
                                icon: "success",
                                title: "ลบข้อมูลทิ้ง เรียบร้อย...!!", 
                                showConfirmButton: false,
                                timer: 2000
                            });
                            </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=../product.php?product\">";
                exit;
            } else {

                echo '<script type="text/javascript">
                            Swal.fire({
                            icon: "error",
                            title: "ล้มเหลว",
                            text: "โปรด ลองใหม่อีกครั้ง..!!"
                            });
                        </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=../product.php?product\">";
                exit;
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }

    ?>

</body>

</html>