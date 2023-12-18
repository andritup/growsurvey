<?php

require '../functions.php';

// Pemanggilan Namespace
use AuthManager\OwnerAuthManager as OwnerAuthManager;

// Cek pengiriman data login
if(!isset($_POST['login'])) {
    header('Location: ../index.php?page=login');
}

$email = $_POST['email'];
$password = $_POST['password'];

// Inisialisasi AuthManager dengan koneksi database
$authManager = new OwnerAuthManager($conn);

// Proses Login
$result = $authManager->loginUser($email, $password);

// Kondisi jika login gagal
if (!$result['success']) {
    $_SESSION['msg'] = [
        'value' => $result['message'],
        'type' => 'danger',
    ];
    header('Location: ../index.php?page=login');
    exit();
}

// kondisi jika login berhasil
$_SESSION['msg'] = [
    'value' => $result['message'],
    'type' => 'success',
];

header('Location: ../index.php?page=home');


