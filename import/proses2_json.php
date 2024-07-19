<?php
require __DIR__ . '/../vendor/autoload.php'; // Menyertakan autoload Composer
include __DIR__ . '/../koneksi2.php'; // Menyertakan file koneksi database
session_start(); // Memulai sesi
date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['import'])) {
    $file = $_FILES['file'];
    importJSON($file);
}

function importJSON($file) {
    $fileName = $file['tmp_name'];
    global $conn;

    try {
        $jsonData = file_get_contents($fileName);
        $data = json_decode($jsonData, true);

        foreach ($data as $item) {
            $item['created_at'] = date('Y-m-d H:i:s');
            tambah_data($item);
        }

        $_SESSION['import'] = "Data imported successfully!";
    } catch (Exception $e) {
        $_SESSION['import'] = "Error importing JSON data: " . $e->getMessage();
    }

    header("location: ../index2.php");
    exit();
}

function tambah_data($data) {
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