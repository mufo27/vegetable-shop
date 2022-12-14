<?php

        require_once('../../database/condb.inc.php');

        try {

            $select = $conn->prepare("SELECT * FROM account WHERE status = '2' ORDER BY id ASC");
            $select->execute();

            // $i = 1;
            $emp_array = array();
            while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
            {                     
                // $emp_array["data"][] = $i++;
                $emp_array["data"][] = $row;
            }

            $data = $emp_array;
            
            echo json_encode($data);

        } catch (PDOException $e) {

            echo $e->getMessage();

        }
