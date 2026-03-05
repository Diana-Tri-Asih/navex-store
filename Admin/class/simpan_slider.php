<?php
session_start();
include "./class/dbh.php";

$response = ['status' => 'error', 'message' => ''];

// Pastikan request POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escape input
    $judul_slider = $conn->real_escape_string($_POST['judul_slider']);
    $sub_judul_slider = $conn->real_escape_string($_POST['sub_judul_slider']);
    $status_slider = $conn->real_escape_string($_POST['status_slider']);

    // Cek upload gambar
    if (isset($_FILES['gambar_slider']) && $_FILES['gambar_slider']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['gambar_slider']['name'];
        $filetmp = $_FILES['gambar_slider']['tmp_name'];
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
                $sql = "INSERT INTO slider (judul_slider, sub_judul_slider, gambar_slider, status_slider)
                        VALUES ('$judul_slider', '$sub_judul_slider', '$newFilename', '$status_slider')";

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
