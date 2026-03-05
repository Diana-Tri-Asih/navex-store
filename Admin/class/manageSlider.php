<?php
include "dbh.php";
include "../include/ProdukController.php";

if (isset($_POST["create_slider"])){
    $judulSlider = $_POST["create_judul_slider"];
    $deskripsiSlider = $_POST["create_deskripsi_slider"];
    $gambar = $_FILES["create_gambar"];
    $status = $_POST["create_status"];

    $produkProfil = new ProdukController($connection);
    $produkProfil->createProduk($judulSlider,$deskripsiSlider,$gambar,$status);
} else {
    echo "Produk Tidak Ditemukan";
}