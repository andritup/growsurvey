<?php

namespace Models;

class Kuisioner {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // fungsi query berdasarkan string query
    public function query($query) {
        return mysqli_query($this->conn, $query);
    }

    // mencari ketersediaan kuisioner berdasarkan id_survey
    public function kuisionerExist($id_survey) {
        $query = "SELECT COUNT(*) as count FROM kuisioner WHERE id_survey = '$id_survey'";
        
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
    
        return $row['count'];
    }


}