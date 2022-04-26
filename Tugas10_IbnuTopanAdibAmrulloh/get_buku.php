<?php

require_once "connect-db.php";

$sql = "SELECT * FROM buku";
$query = mysqli_query($conn,$sql);
while($data = mysqli_fetch_array($query)){

    $item[] = array(
        'id'=>$data["id"],
        'nama_buku_ibnu'=>$data["nama_buku_ibnu"],
        'penulis'=>$data["penulis"],
        
    );
}

$response = array(
    'status'=>'OK',
    'data' => $item
);

echo json_encode($response,JSON_PRETTY_PRINT);

?>