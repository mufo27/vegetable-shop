<?php require_once('../include/auth.inc.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กำลังดำเนินการหมวดหมู่</title>
    
    <link rel="stylesheet" href="../include/style.css">
    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php

    if (isset($_POST['btn_add'])) {

        require_once('../../database/condb.inc.php');

        $name = $_POST['name'];

        $select_check = $conn->prepare("SELECT name FROM category WHERE name=?");
        $select_check->bindParam(1, $name);
        $select_check->execute();

        if ($select_check->rowCount() > 0) {

            echo '<script type="text/javascript">
                        Swal.fire({
                          icon: "error",
                          title: "ล้มเหลว",
                          text: "ข้อมูลซ้ำกันกับในระบบ..!!"
                        });
                      </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=../category.php?category\">";
            exit;
        } else {

            try {

                $file_location  = "../../share/image/category/";

                if ($_FILES['img']['tmp_name'] == "") {

                    $newfilename   = "";
                } else {

                    $allowedExts    =   array("jpg,png");
                    $temp           =   explode(".", $_FILES["img"]["name"]);
                    $source_file    =   $_FILES['img']['tmp_name'];
                    $size_file      =   $_FILES['img']['size'];
                    $extension      =   end($temp);
                    $newfilename    =   'ctg_' . round(microtime(true)) . '.' . end($temp);

                    move_uploaded_file($source_file, $file_location . $newfilename);
                }

                $insert = $conn->prepare("INSERT INTO category (name, img) VALUES (?,?)");
                $insert->bindParam(1, $name);
                $insert->bindParam(2, $newfilename);
                $insert->execute();

                if ($insert) {

                    echo '<script type="text/javascript">
                                    Swal.fire({
                                        icon: "success",
                                        title: "เพิ่มข้อมูล เรียบร้อย...!!", 
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                    </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=../category.php?category\">";
                    exit;
                } else {

                    echo '<script type="text/javascript">
                                    Swal.fire({
                                    icon: "error",
                                    title: "ล้มเหลว",
                                    text: "โปรด ลองใหม่อีกครั้ง..!!"
                                    });
                                </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=../category.php?category\">";
                    exit;
                }
            } catch (PDOException $e) {

                echo $e->getMessage();
            }
        }
    }


    if (isset($_POST['btn_edit'])) {

        require_once('../../database/condb.inc.php');

        $id   = $_POST['id'];
        $name = $_POST['name'];

        $select_check = $conn->prepare("SELECT * FROM category WHERE name=?");
        $select_check->bindParam(1, $name);
        $select_check->execute();

        if ($select_check->rowCount() > 1) {

            echo '<script type="text/javascript">
                            Swal.fire({
                            icon: "error",
                            title: "ล้มเหลว",
                            text: "ข้อมูลซ้ำกันกับในระบบ..!!"
                            });
                        </script>';
            echo "<meta http-equiv=\"refresh\" content=\"2; URL=../category.php?category\">";
            exit;
        } else {

            try {

                $file_location  = "../../share/image/category/";

                if ($_FILES['img']['tmp_name'] == "") {

                    $newfilename   = $_POST['img2'];
                } else {

                    $allowedExts    =   array("jpg,png");
                    $temp           =   explode(".", $_FILES["img"]["name"]);
                    $source_file    =   $_FILES['img']['tmp_name'];
                    $size_file      =   $_FILES['img']['size'];
                    $extension      =   end($temp);
                    $newfilename    =   'ctg_' . round(microtime(true)) . '.' . end($temp);

                    unlink($file_location . $_POST['img2']);
                    move_uploaded_file($source_file, $file_location . $newfilename);
                }

                $update = $conn->prepare("UPDATE category SET name=?, img=? WHERE id=?");
                $update->bindParam(1 , $name);
                $update->bindParam(2 , $newfilename);
                $update->bindParam(3 , $id);

                if ($update->execute()) {

                    echo '<script type="text/javascript">
                                    Swal.fire({
                                        icon: "success",
                                        title: "แก้ไขข้อมูล เรียบร้อย...!!", 
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                    </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=../category.php?category\">";
                    exit;
                } else {

                    echo '<script type="text/javascript">
                                    Swal.fire({
                                    icon: "error",
                                    title: "ล้มเหลว",
                                    text: "โปรด ลองใหม่อีกครั้ง..!!"
                                    });
                                </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=../category.php?category\">";
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

            $file_location  = "../../share/image/category/";

            $check_category_img = $conn->prepare("SELECT img FROM category WHERE id=?");
            $check_category_img->bindParam(1, $id);
            $check_category_img->execute();
            $row_img = $check_category_img->fetch(PDO::FETCH_ASSOC);

            if ($row_img['img'] != '') {
                unlink($file_location . $row_img['img']);
            }

            // $delete_tb1 = $conn->prepare("DELETE FROM product WHERE category_id=?");
            // $delete_tb1->bindParam(1, $id);
            // $delete_tb1->execute();

            $delete_category = $conn->prepare("DELETE FROM category WHERE id=?");
            $delete_category->bindParam(1, $id);
            $delete_category->execute();

            if ($delete_category) {

                echo '<script type="text/javascript">
                            Swal.fire({
                                icon: "success",
                                title: "ลบข้อมูลทิ้ง เรียบร้อย...!!", 
                                showConfirmButton: false,
                                timer: 2000
                            });
                            </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=../category.php?category\">";
                exit;
            } else {

                echo '<script type="text/javascript">
                            Swal.fire({
                            icon: "error",
                            title: "ล้มเหลว",
                            text: "โปรด ลองใหม่อีกครั้ง..!!"
                            });
                        </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=../category.php?category\">";
                exit;
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }


    ?>

</body>

</html>