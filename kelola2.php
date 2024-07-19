<!doctype html>

<?php
    include 'koneksi2.php';
    session_start();
    date_default_timezone_set('Asia/Jakarta'); // Set timezone sesuai dengan keinginan

    $id = '';
    $nama = '';
    $jenis = '';
    $kode = '';
    $tahun = '';
    $created = date('Y-m-d\TH:i:s');

    if(isset($_GET['ubah'])){
        $id = $_GET['ubah'];
        
        $query = "SELECT * FROM tb_skpd2 WHERE id = '$id';";
        $sql = mysqli_query($conn, $query);

        $result = mysqli_fetch_assoc($sql);

        $nama = $result['nama'];
        $jenis = $result['jenis'];
        $kode = $result['kode_skpd'];
        $tahun = $result['tahun_skpd'];
        $created = date('Y-m-d\TH:i:s');
    }
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPD | Kabupaten Lumajang</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
    <!-- Datetime -->
    <script>
        $(document).ready(function() {
            var currentDateTime = new Date().toISOString().slice(0, 19);

            <?php if (!isset($_GET['ubah'])) { ?>
                $('#created').val(currentDateTime);
            <?php } else { ?>
                $('#created').val('<?php echo $created; ?>');
            <?php } ?>
        });
    </script>
  </head>
  <body>
    <div class="container py-4">
        <header class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom nav-text">
            <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
                <img src="img/logolmj.jpg" width="40" height="50" class="me-2" alt="Logo">
                <span class="fs-4">DATAEASE</span>
            </a>
            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="main.php">HOME</a>
                <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">ABOUT</a>
                <a class="py-2 link-body-emphasis text-decoration-none" href="login.php">LOGOUT</a>
            </nav>
        </header>
        <div class="container">
            <form method="POST" action="proses2.php">
                <input type="hidden" value="<?php echo $id; ?>" name="id" >
                <div class="mb-3">
                    <label for="nama" class="form-label">
                        Nama
                    </label>
                    <input required type="text" class="form-control" id="nama" name="nama" placeholder="Dinas Komunikasi dan Informatika" value ="<?php echo $nama; ?>">
                </div>
                <div class="mb-3">
                    <label for="jenis" class="form-label">
                        Jenis
                    </label>
                    <select required class="form-select" name="jenis" aria-label="Default select example" >
                    <option <?php if($jenis == 'Sekretariat Daerah'){echo "selected";} ?> value="Sekretariat Daerah">Sekretariat Daerah</option>
                    <option <?php if($jenis == 'Dinas'){echo "selected";} ?> value="Dinas">Dinas</option>
                    <option <?php if($jenis == 'Lembaga Teknis'){echo "selected";} ?> value="Lembaga Teknis">Lembaga Teknis</option>
                    <option <?php if($jenis == 'BUMD'){echo "selected";} ?> value="BUMD">BUMD</option>
                    <option <?php if($jenis == 'Kecamatan'){echo "selected";} ?> value="Kecamatan">Kecamatan</option>
                    <option <?php if($jenis == 'Kelurahan'){echo "selected";} ?> value="Kelurahan">Kelurahan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kode" class="form-label">
                        Kode SKPD
                    </label>
                    <input value ="<?php echo $kode; ?>" type="text" class="form-control" id="kode" name="kode_skpd" placeholder="2.11.0.00.0.00.01.0000" >
                </div>
                <div class="mb-3">
                    <label for="tahun" class="form-label">
                        Tahun
                    </label>
                    <input value ="<?php echo $tahun; ?>" required type="year" class="form-control" id="tahun" name="tahun_skpd" placeholder="2025">
                </div>
                <div class="mb-3">
                    <label for="created" class="form-label">
                        Created at
                    </label>
                    <input value="<?php echo $created; ?>" required type="datetime-local" class="form-control" id="created" name="created_at">
                </div>
                
                <div class="mb-3 row mt-4">
                    <div class="col">
                        <?php
                            if(isset($_GET['ubah'])){
                        ?>
                            <button type="submit" name="aksi" value="edit" class="btn btn-primary">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                Simpan Perubahan
                            </button>
                        <?php
                            } else {
                        ?>
                            <button type="submit" name="aksi" value="add" class="btn btn-primary">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                Tambahkan
                            </button>
                        <?php
                            }
                        ?>
                        <a href="index2.php" type="button" class="btn btn-danger">
                            <i class="fa fa-times" aria-hidden="true"></i>
                            Batal
                        </a>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
  </body>
</html>