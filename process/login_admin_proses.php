<?php

require '../functions.php';

// Pemanggilan Namespace
use AuthManager\AdminAuthManager as AdminAuthManager;

// Cek pengiriman data login
if(!isset($_POST['login'])) {
    header('Location: ../index.php?page=login-admin');
}

$username = $_POST['username'];
$password = $_POST['password'];

// Inisialisasi AuthManager dengan koneksi database
$authManager = new AdminAuthManager($conn);

// Proses Login
$result = $authManager->loginUser($username, $password);

// Kondisi jika login gagal
if (!$result['success']) {
    $_SESSION['msg'] = [
        'value' => $result['message'],
        'type' => 'danger',
    ];
    header('Location: ../index.php?page=login-admin');
    exit();
}

// Kondisi jika login berhasil
$_SESSION['msg'] = [
    'value' => $result['message'],
    'type' => 'success',
];

// redirect ke halaman home-admin
header('Location: ../index.php?page=home-admin');


