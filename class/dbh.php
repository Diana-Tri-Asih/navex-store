<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'navex_store';                            

$connection = new mysqli($host,$user,$pass,$dbname);

if ($connection->connect_error) {
    die('Koneksi Gagal: ' . $connection->connect_error);
}