<?php
session_start();
if (isset($_SESSION['admin_username'])) {
    header("Location: main.php");
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
    <link rel="stylesheet" href="css/login.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
    <link href="sign-in.css" rel="stylesheet">
    <title>SIPD | Kabupaten Lumajang</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 400px;
        }
        .card {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- <header class="d-flex flex-column align-items-center pb-3 mb-4 nav-text">
            <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
                <img src="img/logolmj.jpg" width="40" height="50" class="me-2" alt="Logo">
                <span class="fs-4">DATAEASE</span>
            </a>
        </header> -->

        <!-- Container -->
        <div class="card">
            <div class="card-header text-center">
                <h4 class="my-2">Sign in</h4>
                <?php
                if (isset($_SESSION['error'])){
                    echo "<div class='alert alert-danger'>".$_SESSION['error']."</div>";
                    unset($_SESSION['error']);
                }
                ?>
            </div>
            <div class="card-body">
                <form action="login_proses.php" method="POST">
                    <div class="input-group flex-nowrap mt-2">
                        <span class="input-group-text" id="addon-wrapping">
                            <i class="bi bi-person-fill"></i>
                        </span>
                        <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" required>
                    </div>
                    <div class="input-group flex-nowrap mt-4">
                        <span class="input-group-text" id="addon-wrapping">
                            <i class="bi bi-key-fill"></i>
                        </span>
                        <input type="password" class="form-control" name="password" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping" required>
                    </div>
                    <button class="btn btn-primary w-100 py-2 mt-4" type="submit" name="login">Sign in</button>
                </form>
            </div>
        </div>
        <!-- Close Container -->
    </div>
</body>
</html>
