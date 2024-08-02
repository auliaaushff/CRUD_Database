<?php
ini_set('memory_limit', '1G'); // Meningkatkan batas memori menjadi 1GB
ini_set('pcre.backtrack_limit', '10000000'); // Meningkatkan batas pcre.backtrack_limit
ini_set('pcre.recursion_limit', '10000000'); // Meningkatkan batas pcre.recursion_limit
set_time_limit(300); // Meningkatkan batas waktu eksekusi menjadi 300 detik (5 menit)

require __DIR__ . '/../vendor/autoload.php'; // Menyertakan autoload Composer dengan jalur relatif
include __DIR__ . '/../koneksi.php'; // Menyertakan file koneksi database dengan jalur relatif
session_start(); // Memulai sesi

use Mpdf\Mpdf;

// Mengambil data dari database
$query = "SELECT id, nama, jenis, kode_skpd, tahun_skpd FROM tb_skpd2";
$sql = mysqli_query($conn, $query);

// Membuat HTML untuk PDF
$html = '<h1>Data OPD Kabupaten Lumajang</h1>';
$html .= '<table border="1" width="100%" style="border-collapse:collapse;">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>No.</th>';
$html .= '<th>Nama</th>';
$html .= '<th>Jenis</th>';
$html .= '<th>Kode SKPD</th>';
$html .= '<th>Tahun SKPD</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

$no = 1;
while($data = mysqli_fetch_assoc($sql)){
    $html .= '<tr>';
    $html .= '<td>'.$no.'</td>';
    $html .= '<td>'.$data['nama'].'</td>';
    $html .= '<td>'.$data['jenis'].'</td>';
    $html .= '<td>'.$data['kode_skpd'].'</td>';
    $html .= '<td>'.$data['tahun_skpd'].'</td>';
    $html .= '</tr>';
    $no++;
}

$html .= '</tbody>';
$html .= '</table>';

// Membuat objek Mpdf dan menambahkan HTML
$mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);

// Membagi HTML menjadi potongan-potongan yang lebih kecil
$htmlChunks = str_split($html, 60000); // Potongan 60.000 karakter

foreach ($htmlChunks as $chunk) {
    $mpdf->WriteHTML($chunk);
}

// Output file PDF ke browser
$mpdf->Output("Data_OPD.pdf", "D");
exit();
?>
