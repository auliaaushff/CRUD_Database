<?php
require __DIR__ . '/../vendor/autoload.php'; // Menyertakan autoload Composer
include __DIR__ . '/../koneksi1.php'; // Menyertakan file koneksi database
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