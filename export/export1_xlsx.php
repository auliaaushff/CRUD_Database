<?php
require __DIR__ . '/../vendor/autoload.php'; // Menyertakan autoload Composer dengan jalur relatif
include __DIR__ . '/../koneksi1.php'; // Menyertakan file koneksi database dengan jalur relatif
session_start(); // Memulai sesi

use Shuchkin\SimpleXLSXGen;

// Mengambil data dari database
$query = "SELECT id_renja, id_skpd, kode_urusan, urusan, sasaran, no, indikator, level, formulasi_perhitungan, klasifikasi_kinerja, target_tahunan, target_satuan, tahun_evaluasi FROM tb_renja";
$sql = mysqli_query($conn, $query);

// Menyiapkan data untuk dimasukkan ke dalam file Excel
$data = [
    ['No.', 'ID SKPD', 'Kode Urusan', 'Urusan', 'Sasaran', 'No',
     'Indikator', 'Level', 'Formulasi Perhitungan', 'Klasifikasi Kinerja',
     'Target Tahunan', 'Target Satuan', 'Tahun Evaluasi']
];

$no = 1;
while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = [
        $no,
        $row['id_skpd'],
        $row['kode_urusan'],
        $row['urusan'],
        $row['sasaran'],
        $row['no'],
        $row['indikator'],
        $row['level'],
        $row['formulasi_perhitungan'],
        $row['klasifikasi_kinerja'],
        $row['target_tahunan'],
        $row['target_satuan'],
        $row['tahun_evaluasi'],
    ];
    $no++;
}

// Menghasilkan file Excel menggunakan SimpleXLSXGen
$xlsx = SimpleXLSXGen::fromArray($data);
$xlsx->downloadAs('Data_SAKIP.xlsx');

// Menghentikan eksekusi skrip
exit();
?>
