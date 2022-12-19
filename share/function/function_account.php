<?php 

    require_once ('../config/condb.inc.php');

    class Database extends Config {
        public function insert($phone, $user, $pass, $status, $pkname, $fname, $lname, $email, $address) {
            $sql = "INSERT INTO account(phone, user, pass, status, pkname, fname, lname, email, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$phone, $user, $pass, $status, $pkname, $fname, $lname, $email, $address]);
            return true;
        }

        public function read() {
            $sql = "SELECT * FROM account ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }

        public function readOne($id) {
            $sql = "SELECT * FROM account WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            $result = $stmt->fetch();
            return $result;
        }

        public function update($id, $phone, $user, $pass, $status, $pkname, $fname, $lname, $email, $address) {
            $sql = "UPDATE account SET phone=:phone, user=:user, pass=:pass, status=:status, pkname=:pkname, fname=:fname, lname=:lname, email=:email, address=:address WHERE id=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                $id, $phone, $user, $pass, $status, $pkname, $fname, $lname, $email, $address
            ]);
            return true;
        }

        public function delete($id) {
            $sql = "DELETE FROM account WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id]);
            return true;
        }
    }
