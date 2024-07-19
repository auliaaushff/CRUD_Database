<?php
  include 'koneksi2.php';
  session_start();

  $query = "SELECT * FROM tb_skpd2";
  $sql = mysqli_query($conn, $query);
  $no = 0;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPD | Kabupaten Lumajang</title>
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/index.css">
    <!-- Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
      <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
    <!-- DataTables -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
      <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
      <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <style>
        table th, table td {
            text-align: left;
            vertical-align: middle;
        }
        .nama-cell {
            white-space: normal;
            word-wrap: break-word;
        }
        .created-cell {
            width: 150px; /* Menyesuaikan lebar kolom aksi */
        }
        .aksi-cell {
            width: 50px; /* Menyesuaikan lebar kolom aksi */
        }
    </style>
  </head>

  <script type="text/javascript">
        $(document).ready(function(){
            $('#dt').DataTable({
                "ajax": {
                    "url": "fetch2_data.php",
                    "type": "GET"
                },
                "columns": [
                    { "data": null, "render": function (data, type, row, meta) { return meta.row + 1; }, "className": "dt-center" },
                    { "data": "nama" },
                    { "data": "jenis" },
                    { "data": "kode_skpd" },
                    { "data": "tahun_skpd" },
                    { "data": "created_at" },
                    { "data": "aksi", "className": "aksi-cell" }
                ]
            });
        });
    </script>

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
    <!-- Close Navbar -->
        <div class="container">
            <h1 class="mt-4">DATA SKPD</h1>
            <figure>
                <blockquote class="blockquote">
                  <p>Berisi data yang telah disimpan di database</p>
                </blockquote>
                <figcaption class="blockquote-footer">
                  KABUPATEN LUMAJANG
                </figcaption>
            </figure>
            <a href="kelola2.php" type="button" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                Tambah Data
            </a>
            <?php 
              if(isset($_SESSION['eksekusi'])): 
            ?>
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                    <?php
                        echo $_SESSION['eksekusi'];
                    ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
              session_destroy();
              endif;
            ?>
            <!-- Export Data -->
            <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-sign-out" aria-hidden="true"></i>
              Export Data
            </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="export/export2_csv.php">CSV</a></li>
                <li><a class="dropdown-item" href="export/export2_xlsx.php">XLSX</a></li>
                <li><a class="dropdown-item" href="export/export2_pdf.php">PDF</a></li>
                <li><a class="dropdown-item" href="export/export2_json.php">JSON</a></li>
              </ul>
            <?php 
              if(isset($_SESSION['export'])): 
            ?>
                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                    <?php
                        echo $_SESSION['export'];
                    ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
              session_destroy();
              endif;
            ?>
            <!-- Import Data -->
            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                Import Data
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#importCSVModal">CSV</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#importXLSXModal">XLSX</a></li>
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#importJSONModal">JSON</a></li>
            </ul>
            <!-- Include Modals -->
            <?php include 'import/import2_csv.php'; ?>
            <?php include 'import/import2_xlsx.php'; ?>
            <?php include 'import/import2_json.php'; ?>

            <?php
            if(isset($_SESSION['import'])): 
            ?>
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <?php
                echo $_SESSION['import'];
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            unset($_SESSION['import']);
            endif;
            ?>
            <div class="table-responsive mt-4">
                <table id = "dt" class="table table-striped" style="width:100%">
                  <thead>
                    <tr>
                      <th><center>No.</center></th>
                      <th>Nama</th>
                      <th>Jenis</th>
                      <th>Kode SKPD</th>
                      <th>Tahun SKPD</th>
                      <th class="created-cell">Created at</th>
                      <th class="aksi-cell">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    while($result = mysqli_fetch_assoc($sql)){
                  ?>
                      <tr>
                        <td><center>
                            <?php echo ++$no; ?>.
                        </center></td>
                        <td>
                            <?php echo $result['nama']; ?>
                        </td>
                        <td>
                            <?php echo $result['jenis']; ?>
                        </td>
                        <td>
                            <?php echo $result['kode_skpd']; ?>
                        </td>
                        <td>
                            <?php echo $result['tahun_skpd']; ?>
                        </td>
                        <td class="created-cell">
                            <?php echo $result['created_at']; ?>
                        </td>
                        <td class="aksi-cell">
                          <a href="kelola2.php?ubah=<?php echo $result['id']; ?>" type="button" class="btn btn-success btn-sm">
                              <i class="fa fa-pencil"></i>
                          </a>
                          <a href="proses2.php?hapus=<?php echo $result['id']; ?>" type="button" class="btn btn-danger btn-sm" onClick="return confirm('Apakah anda yakin ingin menghapus data tersebut?')">
                              <i class="fa fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                  <?php
                    }
                  ?>   
                  </tbody>
                </table>
              </div>
        </div>
      <div class="mb-5"></div>
    </div>
  </body>
</html>