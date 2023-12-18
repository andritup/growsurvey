<?php

namespace Manager;

use Models\Pembayaran as Pembayaran;

class PembayaranManager extends Pembayaran {

    // menambahkan data ke databasae
    public function insert($query) {
        if (!parent::query($query)) {
            return [
                'success' => false,
                'message' => 'Upload bukti pembayaran gagal'
            ];
        }
        return [
            'success' => true,
            'message' => 'Upload bukti pembayaran Berhasil'
        ];
    }

    // upload file bukti transaksi
    public function upload($file) {

        // target menyimpan gambar
        $targetDirectory = "../assets/img/uploads/";

        // Generate nama gambar
        $imgName = $this->generateImgName(basename($_FILES["gambar"]["name"]));
        
        $targetFile = $targetDirectory . $imgName;

        // Periksa apakah file gambar atau bukan
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check === false) {
            return [
                'success' => false,
                'message' => 'File yang diupload bukan gambar!',
            ];
        }

        // Proses upload jika semua kondisi terpenuhi
        if (!move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
            return [
                'success' => false,
                'message' => 'Terjadi kesalahan dalam upload gambar!',
            ];
        }

        return [
            'success' => true,
            'imgName' => $imgName,
        ];
        
    }

    // Generate nama unik untuk file
    private function generateImgName($basename) {
        $timestamp = time(); // Timestamp saat ini
        $dateFormat = date("Ymd_His", $timestamp);
        $imgName = $dateFormat . $basename;
        return $imgName;
    }
}