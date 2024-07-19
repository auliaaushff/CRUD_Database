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
</head>
<body>
    <div class="container py-4">
        <header class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom nav-text">
            <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
                <img src="img/logolmj.jpg" width="40" height="50" class="me-2" alt="Logo">
                <span class="fs-4">DATAEASE</span>
            </a>
            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">HOME</a>
                <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="#">ABOUT</a>
                <a class="py-2 link-body-emphasis text-decoration-none" href="#">LOGOUT</a>
            </nav>
        </header>

        <!-- Container -->
        <div class="card short-card">
            <div class="card-header text-center">
                <h4 class="my-2">Sign in</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="input-group flex-nowrap mt-2">
                        <span class="input-group-text" id="addon-wrapping">
                            <i class="bi bi-envelope-fill"></i>
                        </span>
                        <input type="text" class="form-control" name="email" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping">
                    </div>
                    <div class="input-group flex-nowrap mt-4">
                        <span class="input-group-text" id="addon-wrapping">
                            <i class="bi bi-key-fill"></i>
                        </span>
                        <input type="password" class="form-control" name= "password" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping">
                    </div>
                    <a class="btn btn-primary w-100 py-2 mt-4" href="main.php" type="submit">Sign in</a>
                </form>
            </div>
        </div>
        <!-- Close Container -->
    </div>
</body>
</html>