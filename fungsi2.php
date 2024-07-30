<?php
    include 'koneksi1.php';
    require 'vendor/autoload.php'; // Include PHPSpreadsheet
    date_default_timezone_set('Asia/Jakarta');

    use PhpOffice\PhpSpreadsheet\IOFactory;

    function import($file) {
        $fileName = $file['tmp_name'];
        $fileType = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
        if ($file['size'] > 0) {
            if ($fileType == 'csv') {
                importCSV($fileName);
            } elseif ($fileType == 'xlsx') {
                importXLSX($fileName);
            }
        }
        return true;
    }

    function importCSV($fileName) {
        global $conn;
    
        $file = fopen($fileName, "r");
        $headerSkipped = false;
    
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            if (!$headerSkipped) {
                $headerSkipped = true; // Skip the header row
                continue;
            }
    
            $data = [
                'nama' => $column[0],
                'jenis' => $column[1],
                'kode_skpd' => $column[2],
                'tahun_skpd' => $column[3],
                'created_at' => date('Y-m-d H:i:s')
            ];
    
            processImportData($data);
        }
        fclose($file);
    }
    
    function importXLSX($fileName) {
        global $conn;
    
        $spreadsheet = IOFactory::load($fileName);
        $worksheet = $spreadsheet->getActiveSheet();
        $headerSkipped = false;
    
        foreach ($worksheet->getRowIterator() as $row) {
            if (!$headerSkipped) {
                $headerSkipped = true; // Skip the header row
                continue;
            }
    
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            $data = [];
            foreach ($cellIterator as $cell) {
                $data[] = $cell->getValue();
            }
    
            $data = [
                'nama' => $data[0],
                'jenis' => $data[1],
                'kode_skpd' => $data[2],
                'tahun_skpd' => $data[3],
                'created_at' => date('Y-m-d H:i:s')
            ];
    
            processImportData($data);
        }
    }
    
    function processImportData($data) {
        tambah_data($data); // Selalu tambahkan data baru tanpa menghapus yang lama
    }

    function tambah_data($data){
        $nama = $data['nama'];
        $jenis = $data['jenis'];
        $kode = $data['kode_skpd'];
        $tahun = $data['tahun_skpd'];
        $created = $data['created_at'];

        $query = "INSERT INTO tb_skpd2 (nama, jenis, kode_skpd, tahun_skpd, created_at) VALUES('$nama', '$jenis', '$kode', '$tahun', '$created');";
        $sql = mysqli_query($GLOBALS['conn'], $query);

        return true;
    }

    function ubah_data($data){
        $id = $data['id'];
        $nama = $data['nama'];
        $jenis = $data['jenis'];
        $kode = $data['kode_skpd'];
        $tahun = $data['tahun_skpd'];
        $created = $data['created_at'];

        $queryShow = "SELECT * FROM tb_skpd2 WHERE id = '$id';";
        $sqlShow = mysqli_query($GLOBALS['conn'], $queryShow);
        $result = mysqli_fetch_assoc($sqlShow);

        $query = "UPDATE tb_skpd2 SET nama='$nama', jenis='$jenis', kode_skpd='$kode', tahun_skpd='$tahun', created_at='$created' WHERE id = '$id'";
        $sql = mysqli_query($GLOBALS['conn'], $query);
    
        return true;
    }

    function hapus_data($data) {
        $id = $data['hapus'];
    
        $query = "UPDATE tb_skpd2 SET deleted_at = NOW() WHERE id = '$id'";
        $sql = mysqli_query($GLOBALS['conn'], $query);
    
        return true;
    }
?>