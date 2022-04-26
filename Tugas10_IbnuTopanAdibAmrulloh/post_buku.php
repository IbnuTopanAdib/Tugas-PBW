<?php

require_once "connect-db.php";

$id = isset( $_POST["id"]) ? $_POST["id"] : "";
$nama_buku_ibnu = isset( $_POST["nama_buku_ibnu"])  ? $_POST["nama_buku_ibnu"] : "";
$penulis = isset($_POST["penulis"]) ? $_POST["penulis"] : "";



$sql = "INSERT INTO buku (nama_buku_ibnu, penulis) VALUES ('".$nama_buku_ibnu."','".$penulis."');";

$query = mysqli_query($conn,$sql);

if($query){
    $msg = "Tambah Buku Berhasil";
}else{
    $msg = "Tambah Buku Gagal";
}

$respone = array(
    'status' => "OK",
    'msg' => $msg
);

echo json_encode($respone,JSON_PRETTY_PRINT);
?>