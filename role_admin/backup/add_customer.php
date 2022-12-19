<?php

require_once('../../database/condb.inc.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {


        $val1 = $_POST['pkname'];
        $val2 = $_POST['fname'];
        $val3 = $_POST['lname'];
        $val4 = $_POST['user'];
        $val5 = $_POST['pass'];
        $val6 = $_POST['phone'];
        $val7 = $_POST['email'];
        $val8 = $_POST['address'];
        $val9 = 2;

        $stmt_check = $conn->prepare("SELECT * FROM account WHERE phone=:val6");
        $stmt_check->bindParam(':val6', $val6);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {

            echo json_encode(array('status' => 500));

        } else {


            $insert = $conn->prepare("INSERT INTO account (pkname, fname, lname, user, pass, phone, email, address, status) 
        VALUES (:val1, :val2, :val3, :val4, :val5, :val6, :val7, :val8, :val9)");
            $insert->bindParam(':val1', $val1);
            $insert->bindParam(':val2', $val2);
            $insert->bindParam(':val3', $val3);
            $insert->bindParam(':val4', $val4);
            $insert->bindParam(':val5', $val5);
            $insert->bindParam(':val6', $val6);
            $insert->bindParam(':val7', $val7);
            $insert->bindParam(':val8', $val8);
            $insert->bindParam(':val9', $val9);
            $insert->execute();

            if ($insert->rowCount() > 0) {
                http_response_code(200);
                echo json_encode(array('status' => 200));
            } else {
                http_response_code(500);
                echo json_encode(array('status' => 501));
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    http_response_code(405);
    echo json_encode(array('status' => 405));

}
