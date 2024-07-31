<?php
include_once("../koneksi1.php"); // Menggunakan jalur relatif untuk menyertakan koneksi database

// Ekspor ke CSV dengan memilih kolom tertentu
$query = "SELECT id_renja, id_skpd, kode_urusan, urusan, sasaran, no, indikator, level, formulasi_perhitungan, klasifikasi_kinerja, target_tahunan, target_satuan, tahun_evaluasi FROM tb_renja";
$result = mysqli_query($conn, $query);

$data = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
}

// Mengatur header untuk file CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Data_SAKIP.csv');
$output = fopen('php://output', 'w');

// Menulis header kolom ke file CSV
fputcsv($output, array('id_renja', 'id_skpd', 'kode_urusan', 'urusan', 'sasaran', 'no', 'indikator', 'level', 'formulasi_perhitungan', 'klasifikasi_kinerja','target_tahunan', 'target_satuan', 'tahun_evaluasi'));

// Menulis baris data ke file CSV
if (count($data) > 0) {
    foreach ($data as $row) {
        fputcsv($output, $row);
    }
}

fclose($output);
?>
