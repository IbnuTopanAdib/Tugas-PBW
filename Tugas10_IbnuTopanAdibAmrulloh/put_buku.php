<?php
require_once "connect-db.php";

parse_str(file_get_contents('php://input'),$value);
$id = $value['id'];
$nama_buku_ibnu = $value['nama_buku_ibnu'];
$penulis = $value['penulis'];

$sql = "UPDATE buku SET nama_buku_ibnu ='$nama_buku_ibnu', penulis = '$penulis' WHERE id = '$id' ";
$query = mysqli_query($conn,$sql);
if($query){
    $msg = "Berhasil";
}else{
    $msg = "Gagal";
}

$respone = array(
    'status' => "OK",
    'msg' => $msg
);


echo json_encode($respone,JSON_PRETTY_PRINT);
?>
