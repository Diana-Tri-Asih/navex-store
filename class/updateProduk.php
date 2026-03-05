<?php
include "dbh.php";
include "../include/ProdukController.php";

if (isset($_POST["update_produk"])){
    $idHome = $_POST["update_id_home"];
    $judulHome = $_POST["update_judul_home"];
    $deskripsiJudul = $_POST["update_deskripsi_judul"];
    $gambar = $_FILES["update_gambar"];
    $status = $_POST["update_status"];

    $sql = "SELECT gambar FROM produk WHERE id_home = ? ";
    $stmt = $connection -> prepare($sql);
    if($stmt){
        $stmt->bind_param("i", $idHome);
        $stmt->execute();
        $result = $stmt->get_result();
        $produk = $result->fetch_assoc();
        $gambarDatabase = $produk["gambar"];
    }

    $produkProfil = new ProdukController($connection);
    $produkProfil->editProduk($idHome,$judulHome,$deskripsiJudul,$gambar,$gambarDatabase,$status);
} else {
    echo "Produk Tidak Ditemukan";
}