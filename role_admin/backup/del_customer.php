<?php

require_once('../../database/condb.inc.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $check_id = $_POST['id'];

        $delete = $conn->prepare("DELETE FROM account WHERE id=:check_id");
        $delete->bindParam(':check_id', $check_id);
        $delete->execute();

        if ($delete->rowCount() > 0) {
            http_response_code(200);
            echo json_encode(array('status' => 200));
        } else {
            http_response_code(500);
            echo json_encode(array('status' => 501));
        }
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    http_response_code(405);
    echo json_encode(array('status' => 405));
}
