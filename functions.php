<?php
session_start();
require 'db_connect.php';
require 'vendor/autoload.php';



function isAuthenticated() {
    if (isset($_SESSION['user'])) {
        return TRUE;
    }
    return FALSE;
}

function dataExist($data, $field, $table) {
    global $conn;
    $query = "SELECT * FROM $table WHERE $field='$data'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);

    return $count;
}

function countResponden($id_survey) {
    global $conn;
    $count_kuisioner = dataExist($id_survey, 'id_survey', 'kuisioner');
    $count_respon = dataExist($id_survey, 'id_survey', 'respon');

    if ($count_kuisioner <= 0 ) return 0;
    return $count_respon/$count_kuisioner;
}


function page($page) {
    header("Location: ../index.php?page=". $page);
}

function getBayar($id_owner, $id_survey) {
    global $conn;
    $query = "SELECT id_bayar FROM bayar WHERE $id_owner ='$id_owner' AND id_survey = '$id_survey'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);

    return $count;
}


