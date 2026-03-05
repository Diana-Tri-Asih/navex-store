<?php
session_start();
include "dbh.php";

$response = ['status' => 'error', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id_home = intval($_GET['id']);

    // Ambil nama file gambar
    $sqlImg = "SELECT gambar FROM produk WHERE id_home = $id_home";
    $resImg = $connection->query($sqlImg);

    if ($resImg && $resImg->num_rows > 0) {
        $dataImg = $resImg->fetch_assoc();
        $uploadDir = '../../assets/gambar/';
        $filePath = $uploadDir . $dataImg['gambar'];

        // Hapus file gambar jika ada
        if (!empty($dataImg['gambar']) && file_exists($filePath)) {
            unlink($filePath);
        }
    }

    // Hapus data dari database
    $sqlDelete = "DELETE FROM produk WHERE id_home = $id_home";
    if ($connection->query($sqlDelete) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'Data berhasil dihapus.';
    } else {
        $response['message'] = 'Gagal menghapus data: ' . $connection->error;
    }
} else {
    $response['message'] = 'ID tidak valid.';
}

echo json_encode($response);
?>
