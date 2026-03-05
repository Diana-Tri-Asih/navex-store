<?php
include "dbh.php";
include "../include/ProdukController.php";

if (isset($_POST["create_produk"])){
    $judulHome = $_POST["create_judul_home"];
    $deskripsiJudul = $_POST["create_deskripsi_judul"];
    $gambar = $_FILES["create_gambar"];
    $status = $_POST["create_status"];

    $produkProfil = new ProdukController($connection);
    $produkProfil->createProduk($judulHome,$deskripsiJudul,$gambar,$status);
} else {
    echo "Produk Tidak Ditemukan";
}