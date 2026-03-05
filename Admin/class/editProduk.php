<?php
include "dbh.php";

$sql = "SELECT * FROM produk Order BY id_home DESC";
$query = mysqli_query($connection,$sql);

$produk = [];
while($row = mysqli_fetch_assoc($query)){
    $produk[] = $row;
}

header('Content-Type: application/json');
echo json_encode($produk);