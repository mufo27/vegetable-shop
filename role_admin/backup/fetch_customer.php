<?php


        require_once('../../database/condb.inc.php');

        try {

            $select = $conn->prepare("SELECT * FROM account WHERE status = '2' ORDER BY id ASC");
            $select->execute();


            $emp_array = array();
            while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
            {
                $emp_array["data"][] = $row;
            }
            
            $json =  json_encode($emp_array);
            
            echo $json;

        } catch (PDOException $e) {

            echo $e->getMessage();

        }

