<?php
include "dbh.php";
include "../include/SliderController.php";

$judulSlider = $_POST["create_judul_slide"];
$deskripsiSlider = $_POST["create_deskripsi_slide"];
$gambar = $_FILES["create_gambar"];
$status = $_POST["create_status"];

$sliderProfil = new SliderController($connection);
$sliderProfil->createSlider($judulSlider,$deskripsiSlider,$gambar,$status);