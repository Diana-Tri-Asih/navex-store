<?php
session_start();
include "./class/dbh.php";

$response = ['status' => 'error', 'message' => ''];

// Pastikan request POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escape input
    $judul_home = $conn->real_escape_string($_POST['judul_home']);
    $deskripsi_judul = $conn->real_escape_string($_POST['deskripsi_judul']);
    $status = $conn->real_escape_string($_POST['status']);

    // Cek upload gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['gambar']['name'];
        $filetmp = $_FILES['gambar']['tmp_name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            // Buat nama file unik
            $newFilename = uniqid() . '.' . $ext;
            $uploadDir = '../../assets/gambar/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $uploadPath = $uploadDir . $newFilename;

            if (move_uploaded_file($filetmp, $uploadPath)) {
                // Simpan ke database
                $sql = "INSERT INTO produk (judul_home, deskripsi_judul, gambar, status)
                        VALUES ('$judul_home', '$deskripsi_judul', '$newFilename', '$status')";

                if ($conn->query($sql) === TRUE) {
                    $response['status'] = 'success';
                    $response['message'] = 'Data berhasil disimpan.';
                } else {
                    $response['message'] = 'Gagal menyimpan data: ' . $conn->error;
                    // Hapus file yang sudah diupload jika DB gagal
                    unlink($uploadPath);
                }
            } else {
                $response['message'] = 'Gagal mengupload gambar.';
            }
        } else {
            $response['message'] = 'Format gambar tidak diperbolehkan. Hanya JPG, PNG, JPEG, atau GIF.';
        }
    } else {
        $response['message'] = 'Gambar wajib diupload.';
    }
} else {
    $response['message'] = 'Metode request tidak valid.';
}

echo json_encode($response);
?>
