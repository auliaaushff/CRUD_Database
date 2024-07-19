<?php
include 'koneksi1.php';
$query = "SELECT * FROM tb_renja";
$sql = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($sql)) {
    $row['aksi'] = '<div class="mb-2"><a href="kelola1.php?ubah=' . $row['id_renja'] . '" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a></div>
                    <div><a href="proses1.php?hapus=' . $row['id_renja'] . '" type="button" class="btn btn-danger btn-sm" onClick="return confirm(\'Apakah anda yakin ingin menghapus data tersebut?\')"><i class="fa fa-trash"></i></a></div>';
    $data[] = $row;
}

echo json_encode(['data' => $data]);
?>