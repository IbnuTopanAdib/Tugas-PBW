<?php
require("connect_db.php");
if (isset($_POST["daftar"])){
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_pwd = $_POST['confirm-password'];
    $duplikat = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email' OR username = '$username'");
    if(mysqli_num_rows($duplikat)>0){
        $message = "username atau email sudah ada";
        $message = urlencode($message);
        header("Location: register.php?message={$message}");
    }
    else{
        if($password==$confirm_pwd){
            $password_hash= password_hash($password, PASSWORD_DEFAULT);
            $query = mysqli_query($conn, "INSERT into admin (email,username,password) VALUES ('$email','$username','$password_hash')");
            $message = "Registrasi Berhasil";
            $message = urlencode($message);
            header("Location: login.php?message={$message}");
        }
        else{
            $message = "Registrasi Gagal Password Tidak Sama";
            $message = urlencode($message);
            header("Location: login.php?message={$message}");   
        }
    }




}


?>