<?php
require 'dbh.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Metode tidak diizinkan']);
    exit;
}

$id_slider = isset($_POST['update_id_home']) ? intval($_POST['update_id_home']) : 0;
$judul_slider = isset($_POST['update_judul_home']) ? trim($_POST['update_judul_home']) : '';
$sub_judul_slider = isset($_POST['update_deskripsi_judul']) ? trim($_POST['update_deskripsi_judul']) : '';
$status_slider = isset($_POST['update_status']) ? trim($_POST['update_status']) : '';

if ($id_slider <= 0 || empty($judul_slider) || empty($sub_judul_slider) || empty($status_slider)) {
    echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
    exit;
}

// Ambil data lama untuk hapus gambar jika perlu
$queryOld = $conn->prepare("SELECT gambar_slider FROM slider WHERE id_slider = ?");
$queryOld->bind_param('i', $id_slider);
$queryOld->execute();
$resultOld = $queryOld->get_result();

if ($resultOld->num_rows === 0) {
    echo json_encode(['status' => 'error', 'message' => 'Data slider tidak ditemukan']);
    exit;
}
$oldData = $resultOld->fetch_assoc();
$oldImage = $oldData['gambar_slider'];

// Proses gambar jika ada file baru diunggah
$newFileName = $oldImage; // Default tetap gambar lama
if (isset($_FILES['update_gambar']) && $_FILES['update_gambar']['error'] === UPLOAD_ERR_OK) {
    $fileTmp = $_FILES['update_gambar']['tmp_name'];
    $fileName = basename($_FILES['update_gambar']['name']);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];

    if (!in_array($fileExt, $allowedExt)) {
        echo json_encode(['status' => 'error', 'message' => 'Format gambar tidak didukung']);
        exit;
    }

    $newFileName = 'uploads/slider_' . time() . '.' . $fileExt;
    if (!move_uploaded_file($fileTmp, '../' . $newFileName)) {
        echo json_encode(['status' => 'error', 'message' => 'Gagal mengunggah gambar']);
        exit;
    }

    // Hapus gambar lama jika bukan gambar default atau kosong
    if (!empty($oldImage) && file_exists('../' . $oldImage)) {
        unlink('../' . $oldImage);
    }
}

// Update data slider
$query = $conn->prepare("UPDATE slider SET judul_slider = ?, sub_judul_slider = ?, gambar_slider = ?, status_slider = ? WHERE id_slider = ?");
$query->bind_param('ssssi', $judul_slider, $sub_judul_slider, $newFileName, $status_slider, $id_slider);

if ($query->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Data slider berhasil diperbarui']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data slider']);
}

$query->close();
$conn->close();
