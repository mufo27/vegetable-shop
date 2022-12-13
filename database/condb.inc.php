<?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "shoppuk";

        try {

            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password, 
                                array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
                            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
        
            $e->getMessage();
        }

        // date_default_timezone_set('Asia/Bangkok');

?>