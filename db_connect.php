<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'growsurvey';

// koneksi ke database
$conn = mysqli_connect($host, $username, $password, $database);

if ($conn === false) {
    echo "Koneksi gagal: " . mysqli_connect_error();
    exit();
}