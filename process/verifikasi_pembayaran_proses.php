<?php

include('../functions.php');

// cek pengiriman id
if (isset($_GET['id'])) {
    $id_bayar = $_GET['id'];

    // update status bayar
    $query = "UPDATE bayar SET status = 'selesai'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['msg'] = [
            'value' => 'Verifikasi berhasil!',
            'type' => 'success',
        ];
        header('Location: ../index.php?page=riwayat-pembayaran-admin');
    } else {
        $_SESSION['msg'] = [
            'value' => 'Berifikasi gagal!',
            'type' => 'danger',
        ];
        header('Location: ../index.php?page=riwayat-pembayaran-admin');
    }
}