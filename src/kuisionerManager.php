<?php

namespace Manager;

use Interfaces\ManagerInterface;
use Models\Kuisioner as Kuisioner;
use PhpOffice\PhpSpreadsheet\IOFactory;

class KuisionerManager extends Kuisioner implements ManagerInterface {

    // menambahkan data kuisioner ke database
    public function insert($data) {
        $id_survey = $data['id_survey'];

        // proses tambah data kuisioner
        foreach ($data['kuisioner'] as $pertanyaan) {
            $query = "INSERT INTO kuisioner (id_survey, pertanyaan) VALUES ('$id_survey', '$pertanyaan')";
            if (!parent::query($query)) {
                return [
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menambahkan data'
                ];
            } 
        }
        return [
            'success' => true,
            'message' => 'Data berhasil ditambahkan'
        ];
    }

    // import file xlsx
    public function import($post, $file) {
        $file_path = $file['survey_file']['tmp_name'];

        // Membaca file .xlsx menjadi array
        $data = $this->readExcelFile($file_path);

        $id_survey = $post['id_survey'];
        
        if (!parent::kuisionerExist($id_survey)) {
            
            // Tambah data pertanyaan ke database
            for ($i=0; $i < count($data[0]); $i++) { 
                $pertanyaan = $data[0][$i];
                $query = "INSERT INTO kuisioner (id_survey, pertanyaan) VALUES ('$id_survey', '$pertanyaan')";
                parent::query($query);
            }
        } 
        
        // Ambil id_kuisioner pada tabel kuisioner berdasarkan id_survey
        $id_kuisioner =  $this->get_id_kuisioner($id_survey);
        
        // Insert data jawaban ke database berdasarkan id pertanyaan(id_kuisioner)
        for ($i=1; $i < count($data); $i++) { 
            for ($j=0; $j < count($id_kuisioner) ; $j++) { 
                $kuisioner_id = $id_kuisioner[$j];
                $jawaban = $data[$i][$j];
                $query = "INSERT INTO respon (id_survey, id_kuisioner, jawaban) VALUES ('$id_survey', '$kuisioner_id', '$jawaban')";
                parent::query($query);
            }
        }

        return [
            'success' => true,
            'message' => 'Data survey berhasil diimport'
        ];
    }

    // fungsi mendapatkan id_kuisioner terbaru berdasarkan id_survey
    private function get_id_kuisioner($id_survey) {
        $id_kuisioner = [];
        $query_get_id = "SELECT id_kuisioner FROM kuisioner WHERE id_survey = '$id_survey'";
        $result = parent::query($query_get_id);
        while($kuisioner = mysqli_fetch_assoc($result)) {
            $id_kuisioner[] = $kuisioner['id_kuisioner'];
        }

        return $id_kuisioner;
    }

    // Fungsi untuk membaca data dari file Excel
    private function readExcelFile($file_path) {
        $spreadsheet = IOFactory::load($file_path);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

        $data = [];

        // Loop melalui setiap baris dan kolom untuk membaca data
        for ($row = 1; $row <= $highestRow; ++$row) {
            $rowData = [];
            for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $cellValue = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                $rowData[] = $cellValue;
            }
            $data[] = $rowData;
        }

        return $data;
    }
}
