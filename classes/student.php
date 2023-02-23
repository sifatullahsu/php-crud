<?php

include 'DB.php';

class Student extends DB {

    public $table = "cr_users";

    public function GetData() {
        $sql = "SELECT * FROM $this->table";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function InsertData($name, $email) {

        $sql = "INSERT INTO $this->table(name, email) VALUES(? , ?)";
        $stmt = $this->connection()->prepare($sql);

        return $stmt->execute([$name, $email]);
    }

    public function getDataById($id) {
        $sql = "SELECT * FROM $this->table WHERE id= ?";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function UpdateData($id, $name, $email) {
        $sql = "UPDATE $this->table SET name=?, email=? WHERE id= ?";
        $stmt = $this->connection()->prepare($sql);

        return $stmt->execute([$name, $email, $id]);
    }

    public function DeleteData($id) {
        $sql = "DELETE FROM $this->table WHERE id= ?";
        $stmt = $this->connection()->prepare($sql);

        return $stmt->execute([$id]);
    }
}