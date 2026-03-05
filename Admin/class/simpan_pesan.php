<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

include 'dbh.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_pengirim'] ?? '';
    $email = $_POST['email_pengirim'] ?? '';
    $no_tlp = $_POST['no_tlp_pengirim'] ?? '';
    $isi = $_POST['isi_pesan'] ?? '';

    if ($nama && $email && $no_tlp && $isi) {
        $stmt = $connection->prepare("INSERT INTO hub_kami (nama_pengirim, email_pengirim, no_tlp_pengirim, isi_pesan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $email, $no_tlp, $isi);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal menyimpan pesan"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Semua field wajib diisi"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan"]);
}
