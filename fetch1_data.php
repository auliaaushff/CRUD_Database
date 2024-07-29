<?php
include 'koneksi1.php';

$query = "SELECT * FROM tb_renja";
$sql = mysqli_query($conn, $query);

$data = [];
while($row = mysqli_fetch_assoc($sql)) {
    $data[] = $row;
}

echo json_encode(['data' => $data]);
?>
