<?php
include "dbh.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['update_id_home'];
    $judul = $_POST['update_judul_home'];
    $deskripsi = $_POST['update_deskripsi_judul'];
    $status = $_POST['update_status'];

    // Cek apakah ada file gambar yang diupload
    $gambarBaru = $_FILES['update_gambar']['name'];
    $gambarPath = "";

    if (!empty($gambarBaru)) {
        $targetDir = "../img/";
        $gambarPath = $targetDir . basename($gambarBaru);
        $imageFileType = strtolower(pathinfo($gambarPath, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        // Validasi tipe file
        if (!in_array($imageFileType, $allowedTypes)) {
            echo json_encode(["status" => "error", "message" => "Format gambar tidak valid."]);
            exit;
        }

        // Upload file
        if (!move_uploaded_file($_FILES['update_gambar']['tmp_name'], $gambarPath)) {
            echo json_encode(["status" => "error", "message" => "Gagal mengunggah gambar."]);
            exit;
        }

        // Path gambar untuk disimpan di DB
        $gambarPathDB = "img/" . basename($gambarBaru);

        // Update termasuk gambar
        $sql = "UPDATE slider SET judul_slider=?, sub_judul_slider=?, gambar_slider=?, status_slider=? WHERE id_slider=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssi", $judul, $deskripsi, $gambarPathDB, $status, $id);
    } else {
        // Update tanpa mengganti gambar
        $sql = "UPDATE slider SET judul_slider=?, sub_judul_slider=?, status_slider=? WHERE id_slider=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssi", $judul, $deskripsi, $status, $id);
    }

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Slider berhasil diperbarui."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal memperbarui data."]);
    }

    $stmt->close();
    $connection->close();
} else {
    echo json_encode(["status" => "error", "message" => "Metode request tidak valid."]);
}
?>
