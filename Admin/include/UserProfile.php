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
        if ($newPassword !== $confirmPassword) {
            $response["success"] = false;
            $response["message"][] = "Password tidak sesuai";
            return $response;
        } else {
            $hashPassword = sha1($newPassword);
        }
    } else {
        $hashPassword = $password;
    }

    // Upload file
    $uploadResult = $this->handleFileUpload($foto_profil);
    if (!$uploadResult['success']) {
        $response["success"] = false;
        $response["message"][] = $uploadResult["message"];
        $foto_profil = $uploadResult["filePath"];
    } else {
        $foto_profil = $uploadResult["filePath"];
    }

    // Update database
    $query = "UPDATE user SET username = ?, nama_pengguna = ?, password = ?, email = ?, alamat = ?, foto_profil = ?, status = ? WHERE id_username = ?";
    $stmt = $this->connection->prepare($query);

    if ($stmt === false) {
        $response["success"] = false;
        $response["message"][] = "Ada Masalah Dalam Statement";
        return $response;
    }

    $stmt->bind_param("sssssssi", $username, $nama_pengguna, $hashPassword, $email, $alamat, $foto_profil, $status, $id_username);

    if ($stmt->execute()) {
        $response["success"] = true;
        $response["message"][] = "Data Profile Berhasil Disimpan";
        $response["foto_profil"] = $foto_profil;
    } else {
        $response["success"] = false;
        $response["message"][] = "Error Ketika Mengubah Profile: " . $stmt->error;
    }

    $stmt->close();
    return $response;
}

    // TransferFile
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