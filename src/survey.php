<?php

namespace Models;

class Survey {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // fungsi query
    public function query($query) {
        return mysqli_query($this->conn, $query);
    }
}