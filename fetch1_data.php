<?php
include 'koneksi.php';

// Fetch data for DataTable
$query = "SELECT * FROM tb_renja WHERE deleted_at IS NULL";
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode([
    "data" => $data
]);
?>
