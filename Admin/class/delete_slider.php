<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Tambahkan header JSON!
header('Content-Type: application/json');

// Pastikan path file koneksi benar!
include "dbh.php"; // ubah jika perlu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null; 

    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID slider tidak ditemukan.']);
        exit;
    }

    $stmt = $connection->prepare("DELETE FROM slider WHERE id_slider = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Slider berhasil dihapus.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus slider.']);
    }

    $stmt->close();
    $connection->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan.']);
}
?>
