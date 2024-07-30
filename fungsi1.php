<?php
include 'koneksi1.php';
require 'vendor/autoload.php'; // Include PHPSpreadsheet
date_default_timezone_set('Asia/Jakarta');

use PhpOffice\PhpSpreadsheet\IOFactory;

function import($file) {
    $fileName = $file['tmp_name'];
    $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if ($file['size'] > 0) {
        if ($fileType == 'csv') {
            importCSV($fileName);
        } elseif ($fileType == 'xlsx') {
            importXLSX($fileName);
        }
    }
    return true;
}

function importCSV($fileName) {
    global $conn;

    $file = fopen($fileName, "r");
    $headerSkipped = false;

    while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
        if (!$headerSkipped) {
            $headerSkipped = true; // Skip the header row
            continue;
        }

        $data = [
            'id_skpd' => $column[0],
            'kode_urusan' => $column[1],
            'urusan' => $column[2],
            'sasaran' => $column[3],
            'no' => $column[4],
            'indikator' => $column[5],
            'level' => $column[6],
            'formulasi_perhitungan' => $column[7],
            'klasifikasi_kinerja' => $column[8],
            'target_tahunan' => $column[9],
            'target_satuan' => $column[10],
            'tahun_evaluasi' => $column[11],
            'created_at' => date('Y-m-d H:i:s')
        ];

        processImportData($data);
    }
    fclose($file);
}

function importXLSX($file) {
    global $conn;

    if (isset($file['tmp_name'])) {
        $fileName = $file['tmp_name'];
    } else {
        echo "File not found.";
        return false;
    }

    $spreadsheet = IOFactory::load($fileName);
    $worksheet = $spreadsheet->getActiveSheet();
    $headerSkipped = false;

    foreach ($worksheet->getRowIterator() as $row) {
        if (!$headerSkipped) {
            $headerSkipped = true; // Skip the header row
            continue;
        }

        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
        $data = [];
        foreach ($cellIterator as $cell) {
            $data[] = $cell->getValue();
        }

        $data = [
            'id_skpd' => isset($data[0]) ? $data[0] : '',
            'kode_urusan' => isset($data[1]) ? $data[1] : '',
            'urusan' => isset($data[2]) ? $data[2] : '',
            'sasaran' => isset($data[3]) ? $data[3] : '',
            'no' => isset($data[4]) ? $data[4] : '',
            'indikator' => isset($data[5]) ? $data[5] : '',
            'level' => isset($data[6]) ? $data[6] : '',
            'formulasi_perhitungan' => isset($data[7]) ? $data[7] : '',
            'klasifikasi_kinerja' => isset($data[8]) ? $data[8] : '',
            'target_tahunan' => isset($data[9]) ? $data[9] : '',
            'target_satuan' => isset($data[10]) ? $data[10] : '',
            'tahun_evaluasi' => isset($data[11]) ? $data[11] : '',
            'created_at' => date('Y-m-d H:i:s')
        ];

        processImportData($data);
    }
}

function processImportData($data) {
    tambah_data($data); // Selalu tambahkan data baru tanpa menghapus yang lama
}

function tambah_data($data) {
    $id_skpd = $data['id_skpd'];
    $kode_urusan = $data['kode_urusan'];
    $urusan = $data['urusan'];
    $sasaran = $data['sasaran'];
    $no = $data['no'];
    $indikator = $data['indikator'];
    $level = $data['level'];
    $formulasi_perhitungan = $data['formulasi_perhitungan'];
    $klasifikasi_kinerja = $data['klasifikasi_kinerja'];
    $target_tahunan = $data['target_tahunan'];
    $target_satuan = $data['target_satuan'];
    $tahun_evaluasi = $data['tahun_evaluasi'];
    $created_at = $data['created_at'];

    $query = "INSERT INTO tb_renja (id_skpd, kode_urusan, urusan, sasaran, no, indikator, level, formulasi_perhitungan, klasifikasi_kinerja, target_tahunan, target_satuan, tahun_evaluasi, created_at) VALUES('$id_skpd', '$kode_urusan', '$urusan', '$sasaran', '$no', '$indikator', '$level', '$formulasi_perhitungan', '$klasifikasi_kinerja', '$target_tahunan', '$target_satuan', '$tahun_evaluasi', '$created_at')";
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;
}

function ubah_data($data) {
    $id = $data['id_renja'];
    $id_skpd = $data['id_skpd'];
    $kode_urusan = $data['kode_urusan'];
    $urusan = $data['urusan'];
    $sasaran = $data['sasaran'];
    $no = $data['no'];
    $indikator = $data['indikator'];
    $level = $data['level'];
    $formulasi_perhitungan = $data['formulasi_perhitungan'];
    $klasifikasi_kinerja = $data['klasifikasi_kinerja'];
    $target_tahunan = $data['target_tahunan'];
    $target_satuan = $data['target_satuan'];
    $tahun_evaluasi = $data['tahun_evaluasi'];
    $created_at = $data['created_at'];

    $queryShow = "SELECT * FROM tb_renja WHERE id_renja = '$id';";
    $sqlShow = mysqli_query($GLOBALS['conn'], $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    $query = "UPDATE tb_renja SET id_skpd='$id_skpd', kode_urusan='$kode_urusan', urusan='$urusan', sasaran='$sasaran', no='$no', indikator='$indikator', level='$level', formulasi_perhitungan='$formulasi_perhitungan', klasifikasi_kinerja='$klasifikasi_kinerja', target_tahunan='$target_tahunan', target_satuan='$target_satuan', tahun_evaluasi='$tahun_evaluasi', created_at='$created_at' WHERE id_renja = '$id'";
    $sql = mysqli_query($GLOBALS['conn'], $query);
    
    return true;
}

function hapus_data($data) {
    $id = $data['hapus'];

    $query = "UPDATE tb_renja SET deleted_at = NOW() WHERE id_renja = '$id'";
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;
}
?>
