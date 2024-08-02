<?php
include 'koneksi.php';
header('Content-Type: application/json');
session_start();

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['action'])) {
        if ($data['action'] == 'login') {
            $username = $data['username'];
            $password = $data['password'];

            if ($username == '' || $password == '') {
                echo json_encode(['error' => 'Silahkan Masukkan Username dan Password']);
                exit();
            }

            $sql1 = "SELECT * FROM admin WHERE username = '$username' AND password = '$password';";
            $q1 = mysqli_query($conn, $sql1);
            $r1 = mysqli_fetch_array($q1);

            if ($r1) {
                $_SESSION['admin_username'] = $username;
                echo json_encode(['success' => 'Login berhasil']);
            } else {
                echo json_encode(['error' => 'Username atau Password salah']);
            }
        } elseif ($data['action'] == 'logout') {
            session_destroy();
            echo json_encode(['success' => 'Logout berhasil']);
        } else {
            echo json_encode(['error' => 'Aksi tidak valid']);
        }
    } else {
        echo json_encode(['error' => 'Data tidak lengkap']);
    }
} else {
    echo json_encode(['error' => 'Metode tidak didukung']);
}
