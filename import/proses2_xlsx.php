<?php
require __DIR__ . '/../vendor/autoload.php'; // Menyertakan autoload Composer
include __DIR__ . '/../koneksi2.php'; // Menyertakan file koneksi database
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
                'nama' => isset($data[1]) ? $data[1] : '',
                'jenis' => isset($data[2]) ? $data[2] : '',
                'kode_skpd' => isset($data[3]) ? $data[3] : '',
                'tahun_skpd' => isset($data[4]) ? $data[4] : '',
                'created_at' => date('Y-m-d H:i:s')
            ];

            tambah_data($data); // Tambahkan data langsung ke database
        }

        $_SESSION['import'] = "Data imported successfully!";
    } catch (Exception $e) {
        $_SESSION['import'] = "Error importing XLSX data: " . $e->getMessage();
    }

    header("location: ../index2.php");
    exit();
}

function tambah_data($data){
    global $conn;
    
    $nama = $data['nama'];
    $jenis = $data['jenis'];
    $kode = $data['kode_skpd'];
    $tahun = $data['tahun_skpd'];
    $created = $data['created_at'];

    $query = "INSERT INTO tb_skpd2 (nama, jenis, kode_skpd, tahun_skpd, created_at) VALUES('$nama', '$jenis', '$kode', '$tahun', '$created');";
    $sql = mysqli_query($conn, $query);

    if (!$sql) {
        echo "Error: " . mysqli_error($conn);
    }

    return $sql;
}
?>
