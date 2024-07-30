<?php
header('Content-Type: application/json');
include 'koneksi1.php';

$query = "SELECT * FROM tb_skpd2";
$result = mysqli_query($conn, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode(array("data" => $data));

mysqli_close($conn);
?>
