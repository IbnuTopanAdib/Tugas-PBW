<?php
    session_start(); 


$db_host= "localhost";
$db_user="root";
$db_pass="";
$db_name="kuliah1";

$conn= mysqli_connect($db_host,$db_user,$db_pass,$db_name)or die(mysqli_error($conn));

?>