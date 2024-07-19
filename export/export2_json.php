<?php

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

// Mengatur header untuk file JSON
header('Content-Type: application/json');
header('Content-Disposition: attachment; filename=Data_SKPD.json');

// Outputkan data dalam format JSON
echo json_encode($data, JSON_PRETTY_PRINT);

// Keluar dari skrip setelah selesai
exit;

?>