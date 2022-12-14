<?php

require_once('../../database/condb.inc.php');

try {

    // $id = $_SESSION['id'];
    $select = $conn->prepare("SELECT * FROM account WHERE id = 6 AND status = '2' ");
    $select->execute();

    // $i = 1;
    $emp_array = array();
    $row = $select->fetch(PDO::FETCH_ASSOC);
    $emp_array['data'][] = $row;


    $data = $emp_array;

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo $e->getMessage();
}
