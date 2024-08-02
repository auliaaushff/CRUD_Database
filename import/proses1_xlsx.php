<?php
require __DIR__ . '/../vendor/autoload.php'; // Menyertakan autoload Composer
include __DIR__ . '/../koneksi.php'; // Menyertakan file koneksi database
session_start(); // Memulai sesi
date_default_timezone_set('Asia/Jakarta');

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['import'])) {
    $file = $_FILES['file'];
    importXLSX($file);
}

function importXLSX($file) {
    $fileName = $file['tmp_name'];
    global $conn;

    try {
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
                'id_skpd' => isset($data[1]) ? $data[1] : '',
                'kode_urusan' => isset($data[2]) ? $data[2] : '',
                'urusan' => isset($data[3]) ? $data[3] : '',
                'sasaran' => isset($data[4]) ? $data[4] : '',
                'no' => isset($data[5]) ? $data[5] : '',
                'indikator' => isset($data[6]) ? $data[6] : '',
                'level' => isset($data[7]) ? $data[7] : '',
                'formulasi_perhitungan' => isset($data[8]) ? $data[8] : '',
                'klasifikasi_kinerja' => isset($data[9]) ? $data[9] : '',
                'target_tahunan' => isset($data[10]) ? $data[10] : '',
                'target_satuan' => isset($data[11]) ? $data[11] : '',
                'tahun_evaluasi' => isset($data[12]) ? $data[12] : '',
                'created_at' => date('Y-m-d H:i:s')
            ];

            tambah_data($data); // Tambahkan data langsung ke database
        }

        $_SESSION['import'] = "Data imported successfully!";
    } catch (Exception $e) {
        $_SESSION['import'] = "Error importing XLSX data: " . $e->getMessage();
    }

    header("location: ../index1.php");
    exit();
}

function tambah_data($data) {
    global $conn;

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
    $sql = mysqli_query($conn, $query);

    if (!$sql) {
        echo "Error: " . mysqli_error($conn);
    }

    return $sql;
}
?>
