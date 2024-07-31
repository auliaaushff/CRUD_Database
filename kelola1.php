<!doctype html>

<?php
    include 'koneksi1.php';
    session_start();
    date_default_timezone_set('Asia/Jakarta'); // Set timezone sesuai dengan keinginan

    $id_skpd = '';
    $kode_urusan = '';
    $urusan = '';
    $sasaran = '';
    $no = '';
    $indikator = '';
    $level = '';
    $formulasi_perhitungan = '';
    $klasifikasi_kinerja = '';
    $target_tahunan = '';
    $target_satuan = '';
    $tahun_evaluasi = '';
    $created = date('Y-m-d\TH:i:s');

    $id_skpd_options = [];
    $query_skpd = "SELECT id, nama FROM tb_skpd2 WHERE tahun_skpd = 2025";
    $result_skpd = mysqli_query($conn, $query_skpd);
    while ($row = mysqli_fetch_assoc($result_skpd)) {
        $id_skpd_options[] = $row;
    }

    if(isset($_GET['ubah'])){
        $id = $_GET['ubah'];
        
        $query = "SELECT * FROM tb_renja WHERE id_renja = '$id';";
        $sql = mysqli_query($conn, $query);

        $result = mysqli_fetch_assoc($sql);

        $id_skpd = $result['id_skpd'];
        $kode_urusan = $result['kode_urusan'];
        $urusan = $result['urusan'];
        $sasaran = $result['sasaran'];
        $no = $result['no'];
        $indikator = $result['indikator'];
        $level = $result['level'];
        $formulasi_perhitungan = $result['formulasi_perhitungan'];
        $klasifikasi_kinerja = $result['klasifikasi_kinerja'];
        $target_tahunan = $result['target_tahunan'];
        $target_satuan = $result['target_satuan'];
        $tahun_evaluasi = $result['tahun_evaluasi'];
        $created = date('Y-m-d\TH:i:s');
    }
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RENJA Kabupaten Lumajang</title>
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
        <form action="proses1.php" method="POST">
        <input type="hidden" value="<?php echo isset($id) ? $id : ''; ?>" name="id_renja">
            <div class="mb-3">
                <label for="id_skpd" class="form-label">Nama OPD</label>
                <select class="form-control" id="id_skpd" name="id_skpd">
                    <?php foreach ($id_skpd_options as $option) : ?>
                        <option value="<?php echo $option['id']; ?>" <?php echo ($option['id'] == $id_skpd) ? 'selected' : ''; ?>>
                            <?php echo $option['nama']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Other fields remain unchanged -->
            <div class="mb-3">
                <label for="kode_urusan" class="form-label">Kode Urusan</label>
                <input type="text" class="form-control" id="kode_urusan" name="kode_urusan" value="<?php echo $kode_urusan; ?>">
            </div>
            <div class="mb-3">
                <label for="urusan" class="form-label">Urusan</label>
                <input type="text" class="form-control" id="urusan" name="urusan" value="<?php echo $urusan; ?>">
            </div>
            <div class="mb-3">
                <label for="sasaran" class="form-label">Sasaran</label>
                <input type="text" class="form-control" id="sasaran" name="sasaran" value="<?php echo $sasaran; ?>">
            </div>
            <div class="mb-3">
                <label for="no" class="form-label">No</label>
                <input type="text" class="form-control" id="no" name="no" value="<?php echo $no; ?>">
            </div>
            <div class="mb-3">
                <label for="indikator" class="form-label">Indikator</label>
                <input type="text" class="form-control" id="indikator" name="indikator" value="<?php echo $indikator; ?>">
            </div>
            <div class="mb-3">
                <label for="level" class="form-label">Level</label>
                <input type="text" class="form-control" id="level" name="level" value="<?php echo $level; ?>">
            </div>
            <div class="mb-3">
                <label for="formulasi_perhitungan" class="form-label">Formulasi Perhitungan</label>
                <input type="text" class="form-control" id="formulasi_perhitungan" name="formulasi_perhitungan" value="<?php echo $formulasi_perhitungan; ?>">
            </div>
            <div class="mb-3">
                <label for="klasifikasi_kinerja" class="form-label">Klasifikasi Kinerja</label>
                <input type="text" class="form-control" id="klasifikasi_kinerja" name="klasifikasi_kinerja" value="<?php echo $klasifikasi_kinerja; ?>">
            </div>
            <div class="mb-3">
                <label for="target_tahunan" class="form-label">Target Tahunan</label>
                <input type="text" class="form-control" id="target_tahunan" name="target_tahunan" value="<?php echo $target_tahunan; ?>">
            </div>
            <div class="mb-3">
                <label for="target_satuan" class="form-label">Target Satuan</label>
                <input type="text" class="form-control" id="target_satuan" name="target_satuan" value="<?php echo $target_satuan; ?>">
            </div>
            <div class="mb-3">
                <label for="tahun_evaluasi" class="form-label">Tahun Evaluasi</label>
                <input type="text" class="form-control" id="tahun_evaluasi" name="tahun_evaluasi" value="<?php echo $tahun_evaluasi; ?>">
            </div>
            <div class="mb-3">
                <label for="created" class="form-label">Created at</label>
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
                    <a href="index1.php" type="button" class="btn btn-danger">
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