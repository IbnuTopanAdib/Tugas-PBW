<?php
$host="localhost";
$username="root";
$pw = "";
$name= "buku";

$conn = mysqli_connect($host, $username, $pw, $name)or die(mysqli_error($conn));

header('Content-Type:application/json' )

?>