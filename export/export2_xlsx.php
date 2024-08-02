<?php
require __DIR__ . '/../vendor/autoload.php'; // Menyertakan autoload Composer dengan jalur relatif
include __DIR__ . '/../koneksi.php'; // Menyertakan file koneksi database dengan jalur relatif
session_start(); // Memulai sesi

use Shuchkin\SimpleXLSXGen;

// Mengambil data dari database
$query = "SELECT id, nama, jenis, kode_skpd, tahun_skpd FROM tb_skpd2";
$sql = mysqli_query($conn, $query);

// Menyiapkan data untuk dimasukkan ke dalam file Excel
$data = [
    ['No.', 'Nama', 'Jenis', 'Kode SKPD', 'Tahun SKPD']
];

$no = 1;
while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = [
        $no,
        $row['nama'],
        $row['jenis'],
        $row['kode_skpd'],
        $row['tahun_skpd'],
    ];
    $no++;
}

// Menghasilkan file Excel menggunakan SimpleXLSXGen
$xlsx = SimpleXLSXGen::fromArray($data);
$xlsx->downloadAs('Data_OPD.xlsx');

// Menghentikan eksekusi skrip
exit();
?>
