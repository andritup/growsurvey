<?php

include('../functions.php');

// Pemanggilan Namespace
use Manager\PembayaranManager as PembayaranManager;

// Inisialisasi Class PembayaranManager
$pembayaranManager = new PembayaranManager($conn);

// Cek ketersediaan data
if (isset($_POST) && isset($_FILES)) {

    // Proses upload dengan method $pembayaranManager->upload($file)
    $upload = $pembayaranManager->upload($_FILES);

    // Kondisi upload gagal
    if (!$upload['success']) {
        $_SESSION['msg'] = [
            'value' => $upload['message'],
            'type' => 'danger',
        ];
        header('Location: ../index.php?page=home');
        exit();
    }

    // Simpan nama gambar ke variabel
    $imgName = $upload['imgName'];

    // Prepare data
    $id_survey = $_POST['id_survey'];
    $id_owner = $_SESSION['user'];
    $tanggal = date("Y-m-d H:i:s");
    $harga = $_POST['harga'];
    $status = "belum diverifikasi";
    $jenis_bayar = "pengajuan";
    if (isset($_POST['pembelian'])) $jenis_bayar = "pembelian";
    
    // tambah data bayar ke database dengan method $pembayaranManager->insert($query)
    $query = "INSERT INTO bayar (id_owner, id_survey, tanggal, jumlah_bayar, jenis_bayar, foto) 
            VALUES ('$id_owner', '$id_survey', '$tanggal', '$harga', '$jenis_bayar', '$imgName')";
    $result = $pembayaranManager->insert($query);

    // Kondisi pembayaran gagal
    if (!$result['success']) {
        $_SESSION['msg'] = [
            'value' => $result['message'],
            'type' => 'danger',
        ];
        header('Location: ../index.php?page=home');
    } 

    // Kondisi pembayaran berhasil
    $_SESSION['msg'] = [
        'value' => $result['message'],
        'type' => 'success',
    ];
    header('Location: ../index.php?page=home');
    
}

// Redirect ke halaman index.php
else {
    header('Location: ../index.php');
    exit();
}
