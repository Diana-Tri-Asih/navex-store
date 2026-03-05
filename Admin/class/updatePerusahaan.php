<?php
include "dbh.php";
include "../include/ProdukController.php";

$nama_perusahaan = $_POST["nama"];
$deskripsi = $_POST["deskripsi"];
$alamat = $_POST["alamat"];
$telp = $_POST["telepon"];
$email = $_POST["email"];
$response = [
        "success" => true,
        "message" => [],
];

$query = "UPDATE kontak SET nama_perusahaan = ?, deskripsi = ?, alamat = ?, telp = ?, email = ? WHERE id_profil_perusahaan = 1";
$stmt = $connection->prepare($query);
if ($stmt === false) {
    $response["success"] = false;
    $response["message"][] = "Ada Masalah Dalam Statement";
    echo json_encode($response);
    return;
}
$stmt->bind_param("sssss", $nama_perusahaan, $deskripsi, $alamat, $telp, $email);
$stmt->execute();

// Return the final response as a single JSON
$response["success"] = true;
$response["message"][] = "Berhasil Mengupdate Perusahaan";
echo json_encode($response);