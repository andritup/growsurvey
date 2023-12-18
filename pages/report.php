<?php

require '../functions.php';

if(!isAuthenticated() || !isset($_GET['id'])) header("Location: ../index.php?page=login-admin");

if ($_SESSION['role'] !== "admin") {
    if (getBayar($_SESSION['user'], $_GET['id']) <= 0) {
        header("Location: ../index.php?page=login");
    }
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Fungsi untuk membuat dan mengembalikan objek Spreadsheet
function createExcelReport() {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $id_survey = $_GET['id'];
    $query = "SELECT * FROM kuisioner WHERE id_survey = '$id_survey'";
    global $conn;
    $result = mysqli_query($conn, $query);

    $start_col = 'A';
    while ($pertanyaan = mysqli_fetch_assoc($result)) {
        $row = 2;

        // Set lebar kolom menjadi 20
        $sheet->getColumnDimension($start_col)->setWidth(20);
        
        // Mengatur agar teks dibungkus di dalam sel
        $sheet->getStyle($start_col . '1')->getAlignment()->setWrapText(true);

        $sheet->setCellValue($start_col . '1', $pertanyaan['pertanyaan']);
        
        $id_kuisioner = $pertanyaan['id_kuisioner'];
        $query_respon = "SELECT * FROM respon WHERE id_kuisioner = '$id_kuisioner'";
        $result_respon = mysqli_query($conn, $query_respon);
        
        while ($respon = mysqli_fetch_assoc($result_respon)) {
            $sheet->setCellValue($start_col . $row, $respon['jawaban']);

            // Mengatur agar teks dibungkus di dalam sel
            $sheet->getStyle($start_col . $row)->getAlignment()->setWrapText(true);
            $row++;
        }

        $sheet->getStyle($start_col . '1')->getFont()->setBold(true);
        $start_col++;
    }

    return $spreadsheet;
}

// Buat dan simpan laporan Excel
$spreadsheet = createExcelReport();
$writer = new Xlsx($spreadsheet);

$filename = 'laporan_growsurvey.xlsx';

// Set header untuk tautan unduh
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Salin hasil ke output
$writer->save('php://output');



