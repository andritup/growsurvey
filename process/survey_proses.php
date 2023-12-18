<?php

include('../functions.php');

// Pemanggilan namespace
use Manager\SurveyManager as SurveyManager;
use Manager\KuisionerManager as KuisionerManager;

// Inisialisasi objek kelas
$suveyManager = new SurveyManager($conn);
$kuisionerManager = new KuisionerManager($conn);
 
if (isset($_POST['tambah-survey'])) {
    $id_owner = $_SESSION['user'];
            
    // Proses tambah data survey menggunakan method $surveyManager->insert($data)
    $result = $suveyManager->insert($_POST);

    // Kondisi gagal
    if (!$result['success']) {
        $_SESSION['msg'] = [
            'value' => $result['message'],
            'type' => 'danger',
        ];

        $suveyManager->redirect($_SESSION['role']);
        exit();
    }
    
    // Kondisi berhasil
    $_SESSION['msg'] = [
        'value' => 'Data survey berhasil ditambahkan',
        'type' => 'success',
    ];

    $suveyManager->redirect($_SESSION['role']);
}

// Hapus data survey
else if (isset($_POST['hapus-survey'])) {
    $id_survey = $_POST['id_survey'];

    // Proses hapus data survey dengan method $surveyManager->delete($id_survey)
    $result = $suveyManager->delete($id_survey);

    // Kondisi gagal
    if (!$result['success']) {
        $_SESSION['msg'] = [
            'value' => $result['message'],
            'type' => 'danger',
        ];
        $suveyManager->redirect($_SESSION['role']);
        exit();
    }
    
    // Kondisi berhasil
    $_SESSION['msg'] = [
        'value' => 'Data survey berhasil dihapus',
        'type' => 'success',
    ];
    $suveyManager->redirect($_SESSION['role']);
} 

// Import Survey 
else if (isset($_POST['import-survey'])) {

    // cek pengiriman data
    if (isset($_FILES['survey_file']) && $_FILES['survey_file']['error'] === UPLOAD_ERR_OK) {
        // proses import dengan method $kuisionerManager->import($data, $file)
        $result = $kuisionerManager->import($_POST, $_FILES);

        // Kondisi gagal
        if (!$result['success']) {
            $_SESSION['msg'] = [
                'value' => $result['message'],
                'type' => 'danger',
            ];
            $suveyManager->redirect($_SESSION['role']);
            exit();
        }
        
        // Kondisi berhasil
        $_SESSION['msg'] = [
            'value' => 'Data survey berhasil dihapus',
            'type' => 'success',
        ];
        $suveyManager->redirect($_SESSION['role']);
    
    // Kondisi ketika data tidak ada
    } else {
        $_SESSION['msg'] = [
            'value' => 'Maaf, terjadi beberapa kesalahan saat proses import data!',
            'type' => 'danger',
        ];
        header('Location: ../index.php?page=survey-admin');
    }
}   

// Tambah Pertanyaan
else if (isset($_POST['tambah-pertanyaan'])) {
    // proses tambah data dengan method $kuisioner->insert($data)
    $result = $kuisionerManager->insert($_POST);

    // Kondisi gagal
    if (!$result['success']) {
        $_SESSION['msg'] = [
            'value' => $result['message'],
            'type' => 'danger',
        ];
        $suveyManager->redirect($_SESSION['role']);
        exit();
    }

    // Kondisi berhasil
    $_SESSION['msg'] = [
        'value' => 'Data Berhasil Ditambahkan!',
        'type' => 'success',
    ];
    
    $suveyManager->redirect($_SESSION['role']);
}

// Redirect
else {
    header('Location: ../index.php');
    exit();
}
