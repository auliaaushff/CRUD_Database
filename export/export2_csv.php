<?php 

/*
* Export data to csv file
*/
include_once(__DIR__ . '/../koneksi2.php'); // Menyertakan file koneksi database dengan jalur relatif

// Query untuk mengambil data dari tabel tb_skpd2
$query = "SELECT * FROM tb_skpd2";
$result = mysqli_query($conn, $query);

$data = array();
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
        $data[] = $row;
    }
}

// Mengatur header untuk file CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Data_SKPD.csv');
$output = fopen('php://output', 'w');

// Menulis header kolom ke file CSV
fputcsv($output, array('id', 'nama', 'jenis', 'kode_skpd', 'tahun_skpd', 'created_at'));

// Menulis baris data ke file CSV
if (count($data) > 0) {
    foreach ($data as $row) {
        fputcsv($output, $row);
    }
}

fclose($output);
?>
