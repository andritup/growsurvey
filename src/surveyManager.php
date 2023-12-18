<?php

namespace Manager;

use Interfaces\ManagerInterface;
use Models\Survey as Survey;
 
class SurveyManager extends Survey implements ManagerInterface {

    // menambahkan data ke database
    public function insert($data) {
        $id_owner = $_SESSION['user'];
        $nama_survey = $data['nama_survey'];
        $keterangan = $data['keterangan'];
        $jumlah_responden = $data['jumlah_responden'];
        
        // set jenis survey
        $jenis = "public";
        if ($_SESSION['role'] === "owner") $jenis = "private";
        
        // tambah data survey
        $query = "INSERT INTO survey (id_owner, nama_survey, keterangan, jumlah_responden, jenis) 
            VALUES ('$id_owner', '$nama_survey', '$keterangan', '$jumlah_responden', '$jenis')";
        if (!parent::query($query)) {
            return [
                'success' => false,
                'message' => 'Data survey gagal ditambahkan'
            ];
        }

        return [
            'success' => true,
            'message' => 'Data survey berhasil ditambahkan'
        ];
    }

    // hapus data survey
    public function delete($id_survey) {
        $query = "DELETE FROM survey WHERE id_survey = '$id_survey'";
        if (!parent::query($query)) {
            return [
                'success' => false,
                'message' => 'Data survey gagal dihapus'
            ];
        }

        return [
            'success' => true,
            'message' => 'Data survey berhasil dihapus'
        ];
    }

    // fungsi mengalihkan halaman berdasarkan role user
    public function redirect($role) {
        if ($role === "owner") {
            header('Location: ../index.php?page=survey');
        } else {
            header('Location: ../index.php?page=survey-admin');
        }
    }
}