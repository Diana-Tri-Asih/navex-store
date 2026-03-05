<?php
class UserProfile {
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    // Edit User
    public function editProfile($id_username, $username, $nama_pengguna, $password, $newPassword, $confirmPassword, $email, $alamat, $foto_profil, $status) {
        $response = [
            "success" => true,
            "message" => [],
        ];

        // Check if user entered new password
        if (!empty($newPassword) || !empty($confirmPassword)) {
            // If either new or confirm is not empty, validate
            if ($newPassword !== $confirmPassword) {
                $response["success"] = true;
                $response["message"][] = "Password tidak sesuai";
                $hashPassword = $password;
            } else {
                // If they match, hash the new password
                $hashPassword = sha1($newPassword);
            }
        } else {
            // If no new password provided, keep the old one
            $hashPassword = $password;
        }

        // Handle file upload and get the result
        $uploadResult = $this->handleFileUpload($foto_profil);
        if (!$uploadResult['success']) {
            $response["success"] = false;
            $response["message"][] = $uploadResult["message"];
            $foto_profil = $uploadResult["filePath"];  // Use the default or previously set photo path
        } else {
            // If file upload is successful, update the file path
            $foto_profil = $uploadResult["filePath"];
        }

        // Perform the SQL update query
        $query = "UPDATE user SET username = ?, nama_pengguna = ?, password = ?, email = ?, alamat = ?, foto_profil = ?, status = ? WHERE id_username = ?";
        $stmt = $this->connection->prepare($query);
        if ($stmt === false) {
            $response["success"] = false;
            $response["message"][] = "Ada Masalah Dalam Statement";
            echo json_encode($response);
            return;
        }

        $stmt->bind_param("sssssssi", $username, $nama_pengguna, $hashPassword, $email, $alamat, $foto_profil, $status, $id_username);
        if ($stmt->execute()) {
            $response["message"][] = "Data Profile Berhasil Disimpan";
        } else {
            $response["success"] = false;
            $response["message"][] = "Error Ketika Mengubah Profile: " . $stmt->error;
        }
        $stmt->close();

        // Return the final response as a single JSON
        echo json_encode($response);
    }

    // Code TransferFile
    private function handleFileUpload($foto_profil) {
        // Check if file is uploaded
        if (isset($_FILES["foto_profil"])) {
            $uploadDirectory = "img/upload/";
            $uploadFile = "../" . $uploadDirectory . basename($_FILES["foto_profil"]["name"]);

            if (move_uploaded_file($_FILES["foto_profil"]["tmp_name"], $uploadFile)) {
                return [
                    "success" => true,
                    "message" => "File Telah Berhasil Diupload di folder: " . $uploadFile,
                    "filePath" => $uploadDirectory . basename($_FILES["foto_profil"]["name"]),
                ];
            } else {
                return [
                    "success" => true,
                    "message" => "File gagal di upload",
                    "filePath" => isset($foto_profil) && $foto_profil !== "" ? $foto_profil : "img/default_profile.png",
                ];
            }
        } else {
            return [
                "success" => false,
                "message" => "File tidak tersedia",
                "filePath" => isset($foto_profil) && $foto_profil !== "" ? $foto_profil : "img/default_profile.png",
            ];
        }
    }
}