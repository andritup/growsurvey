<?php

namespace Models;

class Admin {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // mencari ketersediaan username pada tabel admin
    public function usernameExist($username) {
        $query = "SELECT COUNT(*) as count FROM admin WHERE username = '$username'";
        
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
    
        return $row['count'];
    }

    // mengambil data berdasarkan username
    public function getUserByUsername($username) {
        $query = "SELECT * FROM admin WHERE username = '$username'";
        $result = mysqli_query($this->conn, $query);

        return mysqli_fetch_assoc($result);
    }
}