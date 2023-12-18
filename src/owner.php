<?php

namespace Models;

class Owner {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // mencari ketersediaan email pada tabel owner
    public function emailExist($email) {
        $query = "SELECT COUNT(*) as count FROM owner WHERE email = '$email'";
        
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
    
        return $row['count'];
    }

    // mengambil data user berdasarkan email
    public function getUserByEmail($email) {
        $query = "SELECT * FROM owner WHERE email = '$email'";
        $result = mysqli_query($this->conn, $query);

        return mysqli_fetch_assoc($result);
    }

    // menambahkan data user ke database;
    public function insertData($query) {
        return mysqli_query($this->conn, $query);
    }
}