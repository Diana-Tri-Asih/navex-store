<?php
class SliderController {
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    // Edit User
    public function createSlider($judulSlider,$deskripsiSlider,$gambar,$status) {
        $response = [
            "success" => true,
            "message" => [],
        ];

        // Perform the SQL update query
        $query = "INSERT INTO slider (judul_slider, sub_judul_slider, gambar_slider, status_slider) VALUES (?,?,'',?)";
        $stmt = $this->connection->prepare($query);
        if ($stmt === false) {
            $response["success"] = false;
            $response["message"][] = "Ada Masalah Dalam Statement";
            echo json_encode($response);
            return;
        }

        $stmt->bind_param("sss", $judulSlider, $deskripsiSlider, $status);
        $stmt->execute();
        $new_id = $stmt -> insert_id;

        // Handle file upload and get the result
        $uploadResult = $this->handleFileUpload($gambar, $new_id);
        if (!$uploadResult['success']) {
            $response["success"] = false;
            $response["message"][] = $uploadResult["message"];
            $gambar = $uploadResult["filePath"];  // Use the default or previously set photo path
        } else {
            // If file upload is successful, update the file path
            $gambar = $uploadResult["filePath"];
            $update = $this -> connection -> prepare('UPDATE slider SET gambar_slider = ? WHERE id_slider = ?');
            $update -> bind_param("si", $gambar, $new_id);
            $update -> execute();
        }

        // Return the final response as a single JSON
        echo json_encode($response);
    }

    public function editProduk($idHome,$judulHome,$deskripsiJudul,$gambar,$gambarDatabase,$status) {
        $response = [
            "success" => true,
            "message" => [],
        ];

        // Perform the SQL update query
        $query = "UPDATE produk SET judul_home = ?, deskripsi_judul = ?, gambar = ?, status = ? WHERE id_home = ?";
        $stmt = $this->connection->prepare($query);
        if ($stmt === false) {
            $response["success"] = false;
            $response["message"][] = "Ada Masalah Dalam Statement";
            echo json_encode($response);
            return;
        }

        $stmt->bind_param("ssssi", $judulHome, $deskripsiJudul, $gambarDatabase, $status, $idHome);
        $stmt->execute();

        // Handle file upload and get the result
        $uploadResult = $this->handleFileUpload($gambar, $idHome);
        if (!$uploadResult['success']) {
            $response["success"] = true;
            $response["message"][] = $uploadResult["message"];
            $gambar = $uploadResult["filePath"];  // Use the default or previously set photo path
        } else {
            // If file upload is successful, update the file path
            $gambar = $uploadResult["filePath"];
            $update = $this -> connection -> prepare('UPDATE produk SET gambar = ? WHERE id_home = ?');
            $update -> bind_param("si", $gambar, $idHome);
            $update -> execute();
        }

        // Return the final response as a single JSON
        echo json_encode($response);
    }

    // Code TransferFile
    private function handleFileUpload($gambar, $new_id) {
        // Validate file existence and no upload error
        if (!isset($gambar) || $gambar['error'] !== UPLOAD_ERR_OK) {
            return [
                "success" => false,
                "message" => "Produk berhasil di Update.",
                "filePath" => "img/default_profile.png",
            ];
        }

        $uploadDirectory = "img/slider/";
        $ext = pathinfo($gambar["name"], PATHINFO_EXTENSION);
        $newFileName = 'slider' . $new_id . '.' . $ext;
        $uploadFile = "../" . $uploadDirectory . $newFileName;

        if (move_uploaded_file($gambar["tmp_name"], $uploadFile)) {
            return [
                "success" => true,
                "message" => "File berhasil diupload ke folder: " . $uploadFile,
                "filePath" => $uploadDirectory . $newFileName,
            ];
        } else {
            return [
                "success" => false,
                "message" => "Gagal memindahkan file.",
                "filePath" => "img/default_profile.png",
            ];
        }
    }
}