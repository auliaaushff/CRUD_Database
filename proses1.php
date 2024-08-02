<?php
include 'fungsi1.php';
session_start();

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == "add") {
        
        $berhasil = tambah_data($_POST);

        if ($berhasil) {
            $_SESSION['eksekusi'] = "Data Berhasil Ditambahkan";
            header("location: index1.php");
        } else {
            echo $berhasil;
        }
    } elseif ($_POST['aksi'] == "edit") {
        
        $berhasil = ubah_data($_POST);

        if ($berhasil) {
            $_SESSION['eksekusi'] = "Data Berhasil Diperbarui";
            header("location: index1.php");
        } else {
            echo $berhasil;
        }
    }
}

if (isset($_POST['import'])) {
    $berhasil = import($_FILES['file']);

    if ($berhasil) {
        $_SESSION['import'] = "Data imported successfully!";
        header("location: index1.php");
        exit();
    } else {
        echo $berhasil;
    }
}

if (isset($_GET['hapus'])) {
    
    $berhasil = hapus_data($_GET);

    if ($berhasil) {
        $_SESSION['eksekusi'] = "Data Berhasil Dihapus";
        header("location: index1.php");
    } else {
        echo $berhasil;
    }
}
?>
