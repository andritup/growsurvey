<?php

require '../functions.php';

// Pemanggilan Namespace
use AuthManager\OwnerRegister as OwnerRegister;

// Cek pengiriman data registrasi
if(!isset($_POST['registrasi'])) {
    header('Location: ../index.php?page=login');
    exit();
} 

$email = $_POST['email'];
$password = $_POST['password'];

// Inisialisasi Class OwnerRegister
$ownerRegister = new OwnerRegister($conn);

// Proses registrasi dengan method $ownerRegister->register($email, $password)
$result = $ownerRegister->register($email, $password);

// Kondisi gagal
if (!$result['success']) {
    $_SESSION['msg'] = [
        'value' => $result['message'],
        'type' => 'danger',
    ];
    header('Location: ../index.php?page=registrasi');
    exit();
}

// Kondisi berhasil
$_SESSION['msg'] = [
    'value' => $result['message'],
    'type' => 'success',
];

// Redirect ke halaman login
header('Location: ../index.php?page=login');
