<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กำลังดำเนินการบัญชีผู้ใช้งาน</title>
    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php


    if (isset($_POST['btn_add'])) {

        require_once('../../database/condb.inc.php');

        $pkname     =   $_POST['pkname'];
        $fname      =   $_POST['fname'];
        $lname      =   $_POST['lname'];
        $phone      =   $_POST['phone'];
        $email      =   $_POST['email'];
        $address    =   $_POST['address'];
        $user       =   $_POST['user'];
        $pass       =   $_POST['pass'];
        $status     =   $_POST['status'];

        $select = $conn->prepare("SELECT count(*) AS check_num FROM account WHERE pkname=? AND fname=? AND lname=? OR phone=?");
        $select->bindParam(1, $pkname);
        $select->bindParam(2, $fname);
        $select->bindParam(3, $lname);
        $select->bindParam(4, $phone);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

        if ($row['check_num'] > 0) {

            echo "<script>alert('**ซ้ำ** มีข้อมูลอยู่ในระบบแล้ว..!!')</script>";
            echo "<script>window.location='javascript:history.back(-1)';</script>";
            exit;
        } else {

            try {

                $insert = $conn->prepare("INSERT INTO account (pkname, fname, lname, phone, email, user, pass, address, status) VALUES (?,?,?,?,?,?,?,?,?)");
                $insert->bindParam(1, $pkname);
                $insert->bindParam(2, $fname);
                $insert->bindParam(3, $lname);
                $insert->bindParam(4, $phone);
                $insert->bindParam(5, $email);
                $insert->bindParam(6, $address);
                $insert->bindParam(7, $user);
                $insert->bindParam(8, $pass);
                $insert->bindParam(9, $status);

                if ($insert->execute()) {

                    echo '<script type="text/javascript">
                                      Swal.fire({
                                          icon: "success",
                                          title: "เพิ่มข้อมูล เรียบร้อย...!!", 
                                          showConfirmButton: false,
                                          timer: 2000
                                      });
                                      </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=../account.php?account&status=$status\">";
                    exit;
                } else {

                    echo '<script type="text/javascript">
                                      Swal.fire({
                                      icon: "error",
                                      title: "ล้มเหลว",
                                      text: "โปรด ลองใหม่อีกครั้ง..!!"
                                      });
                                  </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=../account.php?account&status=$status\">";
                    exit;
                }
            } catch (PDOException $e) {

                echo $e->getMessage();
            }
        }
    } else if (isset($_POST['btn_edit'])) {

        require_once('../../database/condb.inc.php');

        $pkname     =   $_POST['pkname'];
        $fname      =   $_POST['fname'];
        $lname      =   $_POST['lname'];
        $phone      =   $_POST['phone'];
        $email      =   $_POST['email'];
        $address    =   $_POST['address'];
        $user       =   $_POST['user'];
        $pass       =   $_POST['pass'];
        $status     =   $_POST['status'];
        $id         =   $_POST['id'];

        $select = $conn->prepare("SELECT count(*) AS check_num FROM account WHERE pkname=? AND fname=? AND lname=? OR phone=?");
        $select->bindParam(1, $pkname);
        $select->bindParam(2, $fname);
        $select->bindParam(3, $lname);
        $select->bindParam(4, $phone);
        $select->execute();
        $row = $select->fetch(PDO::FETCH_ASSOC);

        if ($row['check_num'] > 1) {

            echo "<script>alert('**ซ้ำ** มีข้อมูลอยู่ในระบบแล้ว..!!')</script>";
            echo "<script>window.location='javascript:history.back(-1)';</script>";
            exit;
        } else {

            try {

                $update = $conn->prepare("UPDATE account SET pkname=?, fname=?, lname=?, phone=?, email=?, address=?, user=?, pass=? WHERE id=?");
                $update->bindParam(1, $pkname);
                $update->bindParam(2, $fname);
                $update->bindParam(3, $lname);
                $update->bindParam(4, $phone);
                $update->bindParam(5, $email);
                $update->bindParam(6, $address);
                $update->bindParam(7, $user);
                $update->bindParam(8, $pass);
                $update->bindParam(9, $id);

                if ($update->execute()) {

                    echo '<script type="text/javascript">
                                    Swal.fire({
                                        icon: "success",
                                        title: "แก้ไขข้อมูล เรียบร้อย...!!", 
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                    </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=../account.php?account&status=$status\">";
                    exit;
                } else {

                    echo '<script type="text/javascript">
                                    Swal.fire({
                                    icon: "error",
                                    title: "ล้มเหลว",
                                    text: "โปรด ลองใหม่อีกครั้ง..!!"
                                    });
                                </script>';
                    echo "<meta http-equiv=\"refresh\" content=\"2; URL=../account.php?account&status=$status\">";
                    exit;
                }
            } catch (PDOException $e) {

                echo $e->getMessage();
            }
        }
    } else if (isset($_POST['btn_del'])) {

        require_once('../../database/condb.inc.php');

        $id         =   $_POST['btn_del'];
        $status     =   $_POST['status'];

        try {

            $delete = $conn->prepare("DELETE FROM account WHERE id=?");
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
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=../account.php?account&status=$status\">";
                exit;
            } else {

                echo '<script type="text/javascript">
                            Swal.fire({
                            icon: "error",
                            title: "ล้มเหลว",
                            text: "โปรด ลองใหม่อีกครั้ง..!!"
                            });
                        </script>';
                echo "<meta http-equiv=\"refresh\" content=\"2; URL=../account.php?account&status=$status\">";
                exit;
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    } else {

        echo '<script type="text/javascript">
                    Swal.fire({
                    icon: "error",
                    title: "ล้มเหลว",
                    text: "เกิดข้อผิดพลาด..!!"
                    });
                </script>';
        echo "<meta http-equiv=\"refresh\" content=\"2; URL=../account.php?account&status=$status\">";
        exit;
    }
    ?>

</body>

</html>