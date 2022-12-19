<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กำละงดำเนินการสินค้า</title>
    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php

    if (isset($_POST['btn_add'])) {

        require_once('../../database/condb.inc.php');

        $category_id    =   $_POST['category_id'];
        $name           =   $_POST['name'];
        $qty            =   $_POST['qty'];
        $unit           =   $_POST['unit'];

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

                $insert = $conn->prepare("INSERT INTO product (category_id, name, qty, unit) VALUES (?,?,?,?) ");
                $insert->bindParam(1, $category_id);
                $insert->bindParam(2, $name);
                $insert->bindParam(3, $qty);
                $insert->bindParam(4, $unit);
                $insert->execute();
                $product_id = $conn->lastInsertId();

                $file_location  = "../upload/";

                if ($_FILES['img']['tmp_name'] != "") {

                    if (array_filter($_FILES['img']['tmp_name'])) {

                        foreach ($_FILES['img']['tmp_name'] as $key => $val) {

                            $allowedExts    =   array("jpg,png");
                            $temp           =   explode(".", $_FILES["img"]["name"][$key]);
                            $source_file    =   $_FILES['img']['tmp_name'][$key];
                            $size_file      =   $_FILES['img']['size'][$key];
                            $extension      =   end($temp);
                            $newfilename    =   'pr_' . round(microtime(true)) . '.' . end($temp);

                            if(move_uploaded_file($source_file, $file_location . $newfilename)){

                            $insert_img = $conn->prepare("INSERT INTO product_img (img, product_id) VALUES (?,?)");
                            $insert_img->bindParam(1, $img);
                            $insert_img->bindParam(2,  $product_id);
                            $insert_img->execute();
                            
                            } else {

                                echo '<script type="text/javascript">
                                                    Swal.fire({
                                                    icon: "error",
                                                    title: "ล้มเหลว",
                                                    text: "เกิดข้อผิดพลาดในการย้ายรูปภาพเข้าระบบ"
                                                    });
                                                </script>';
                                echo "<meta http-equiv=\"refresh\" content=\"2; URL=../product.php?product\">";
                                exit;

                            }

                        }
                    }
                }

                if ($insert && $insert_img) {


                    echo '<script type="text/javascript">
                                      Swal.fire({
                                          icon: "success",
                                          title: "บันทึกข้อมูล เรียบร้อย...!!", 
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

        $id     = $_POST['id'];
        $name  = $_POST['name'];
        $qty   = $_POST['qty'];
        $purchase_price  = $_POST['purchase_price'];
        $selling_price  = $_POST['selling_price'];
        $category_id  = $_POST['category_id'];

        $select_check = $conn->prepare("SELECT * FROM product WHERE category_id = :category_id AND name=:name");
        $select_check->bindParam(':category_id', $category_id);
        $select_check->bindParam(':name', $name);
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

                $file_location  = "../upload/";

                if ($_FILES['img']['tmp_name'] == "") {

                    $newfilename   = $_POST['img2'];
                } else {

                    $allowedExts    =   array("jpg,png");
                    $temp           =   explode(".", $_FILES["img"]["name"]);
                    $source_file    =   $_FILES['img']['tmp_name'];
                    $size_file      =   $_FILES['img']['size'];
                    $extension      =   end($temp);
                    $newfilename    =   'pr_' . round(microtime(true)) . '.' . end($temp);

                    unlink($file_location . $_POST['img2']);
                    move_uploaded_file($source_file, $file_location . $newfilename);
                }

                $update = $conn->prepare("UPDATE product SET name=:name, 
                                                            img=:img, 
                                                            qty=:qty, 
                                                            purchase_price=:purchase_price, 
                                                            selling_price=:selling_price, 
                                                            category_id=:category_id 
                                                        WHERE id = :id
                                                    ");
                $update->bindParam(':id', $id);
                $update->bindParam(':name', $name);
                $update->bindParam(':img', $newfilename);
                $update->bindParam(':qty', $qty);
                $update->bindParam(':purchase_price', $purchase_price);
                $update->bindParam(':selling_price', $selling_price);
                $update->bindParam(':category_id', $category_id);
                $update->execute();

                if ($update) {

                    echo '<script type="text/javascript">
                                        Swal.fire({
                                            icon: "success",
                                            title: "อัพเดทข้อมูล เรียบร้อย...!!", 
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

            $file_location  = "../upload/";

            $select_img = $conn->prepare("SELECT img FROM product WHERE id = :id");
            $select_img->bindParam(':id', $id);
            $select_img->execute();
            $row_img = $select_img->fetch(PDO::FETCH_ASSOC);

            if ($row_img['img'] != '') {
                unlink($file_location . $row_img['img']);
            }

            $delete = $conn->prepare("DELETE FROM product WHERE id = :id");
            $delete->bindParam(':id', $id);

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