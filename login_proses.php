<?php
session_start();
include("koneksi.php");

$username = "";
$password = "";
$err = "";

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == '' or $password == ''){
        $err .= "<li>Silahkan Masukkan Username dan Password</li>";
    }

    if(empty($err)){
        $sql1 = "SELECT * FROM admin WHERE username = '$username'";
        $q1 = mysqli_query($conn, $sql1);
        $r1 = mysqli_fetch_array($q1);
        
        if ($r1 && md5($password) == $r1['password']) {
            $_SESSION['admin_username'] = $username;
            header("location:main.php");
            exit();
        } else {
            $err .= "<li>Username atau Password salah</li>";
        }
    }

    if(!empty($err)){
        $_SESSION['error'] = $err;
        header("location:index.php");
        exit();
    }
} else {
    header("location:index.php");
    exit();
}
?>
