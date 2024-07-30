<?php
session_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
    <link href="sign-in.css" rel="stylesheet">
    <!-- Jumbotron -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/jumbotron/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">

    <title>RENJA Kabupaten Lumajang</title>
</head>
<body>
    <!-- Jumbotron -->
    <main>
        <div class="container py-4">
            <header class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom nav-text">
                <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
                    <img src="img/logolmj.jpg" width="40" height="50" class="me-2" alt="Logo">
                    <span class="fs-4">DATAEASE</span>
                </a>
                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="main.php">HOME</a>
                    <a class="py-2 link-body-emphasis text-decoration-none" href="logout.php">LOGOUT</a>
                </nav>
            </header>

            <div class="p-5 mb-4 bg-body-tertiary border rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-4">Welcome to Our Database Management System</h1>
                    <p class="lead">Efficiently Create, Read, Update, and Delete records with ease.</p>
                    <hr class="my-4">
                    <p>Manage your data seamlessly with our user-friendly interface.</p>
                </div>
            </div>

            <div class="row align-items-md-stretch">
                <div class="col-md-6">
                    <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <h2>Database SAKIP Kabupaten Lumajang</h2>
                    <p>Sistem Terintegrasi : Sistem Akuntabilitas Kinerja Instansi Pemerintah (SAKIP) untuk memudahkan perencanaan dan pelaporan kegiatan di Kabupaten Lumajang.</p>
                    <a class="btn btn-outline-secondary" href="index1.php" type="button">Lihat Detail</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <h2>Database PD Kabupaten Lumajang</h2>
                    <p>Informasi PD : Akses cepat dan mudah ke data Perangkat Daerah (PD) untuk mendukung transparansi dan efisiensi di Kabupaten Lumajang.</p>
                    <a class="btn btn-outline-secondary" href="index2.php" type="button">Lihat Detail</a>
                    </div>
                </div>
            </div>

            <footer class="bg-body-tertiary text-center">
                <!-- Copyright -->
                <div class="text-center p-3 mt-4" style="background-color: rgba(0, 0, 0, 0.05);">
                    © 2024 Copyright:
                    <a class="text-body" href="https://diskominfo.lumajangkab.go.id/">diskominfo.lumajangkab.go.id</a>
                </div>
                <!-- Copyright -->
            </footer>
        </div>
    </main>
    <!-- Close Jumbotron -->
</body>
</html>