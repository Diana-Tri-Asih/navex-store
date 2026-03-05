<?php
include "dbh.php";

// Mengambil data dari tabel kontak
$sql = "SELECT * FROM kontak ORDER BY id_profil_perusahaan ASC";
$query = mysqli_query($connection, $sql);

// Datanya
$produk = [];
while ($row = mysqli_fetch_assoc($query)) {
    $produk[] = $row;
}

header('Content-Type: application/json');
echo json_encode($produk);
