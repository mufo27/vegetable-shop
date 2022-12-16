<?php

require_once('../../database/condb.inc.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $check_id = $_POST['id'];
        $val1 = $_POST['pkname'];
        $val2 = $_POST['fname'];
        $val3 = $_POST['lname'];
        $val4 = $_POST['user'];
        $val5 = $_POST['pass'];
        $val6 = $_POST['phone'];
        $val7 = $_POST['email'];
        $val8 = $_POST['address'];

        $update = $conn->prepare("UPDATE account SET pkname=:val1, fname=:val2, lname=:val3, user=:val4, pass=:val5, phone=:val6, email=:val7, address=:val8 WHERE id=:check_id");
        $update->bindParam(':check_id', $check_id);
        $update->bindParam(':val1', $val1);
        $update->bindParam(':val2', $val2);
        $update->bindParam(':val3', $val3);
        $update->bindParam(':val4', $val4);
        $update->bindParam(':val5', $val5);
        $update->bindParam(':val6', $val6);
        $update->bindParam(':val7', $val7);
        $update->bindParam(':val8', $val8);
        $update->execute();

        if ($update->rowCount() > 0) {
            http_response_code(200);
            echo json_encode(array('success' => true));
        } else {
            http_response_code(500);
            echo json_encode(array('success' => false));
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    http_response_code(405);
}
