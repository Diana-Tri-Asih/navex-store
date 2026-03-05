<?php
include "dbh.php";
include "../include/UserProfile.php";

if (isset($_POST["edit_user"])){
    $id_username = $_POST["id_username"];
    $username = $_POST["username"];
    $nama_pengguna = $_POST["nama_pengguna"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];
    $email = $_POST["email"];
    $alamat = $_POST["alamat"];
    $status = $_POST["status"];
    $foto_profil = "";
    $password = "";

    $sql = "SELECT password, foto_profil FROM user WHERE id_username = ? ";
    $stmt = $connection -> prepare($sql);
    if($stmt){
        $stmt->bind_param("i", $id_username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $foto_profil = $user["foto_profil"];
        $password = $user["password"];
    }

    $userProfil = new UserProfile($connection);
    $userProfil->editProfile($id_username,$username,$nama_pengguna,$password,$newPassword,$confirmPassword,$email,$alamat,$foto_profil,$status);
} else {
    echo "User Tidak Ditemukan";
}
