<?php
require('connect_db.php');
if(isset($_POST['login'])){
    $usernameemail = $_POST['usernameemail'];
    $password = $_POST['password'];
    $result = mysqli_query($conn,"SELECT * from admin WHERE username ='$usernameemail' OR email='$usernameemail'");
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) > 0){
        if(password_verify($password, $row['password'])){
            $_SESSION['login'] = true;
            $_SESSION['id'] = $row['id'];
            header("Location: index.php");
        }
        else{
            $message = "Password Salah";
            $message = urlencode($message);
            header("Location: login.php?message={$message}");
            
        }
    }
    else{
        $message = "Data Kosong";
        $message = urlencode($message);
        header("Location: login.php?message={$message}");
    }
    
}
?>