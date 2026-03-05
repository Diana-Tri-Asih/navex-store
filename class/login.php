<?php
session_start();
require 'dbh.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hash_input = sha1($password);
    $username = mysqli_real_escape_string($connection,$username);
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($connection,$sql);
    
    if (mysqli_num_rows($result) == 1){   
        $user = mysqli_fetch_assoc($result);
        if ($hash_input ===  $user['password']){
            $_SESSION ['id_username'] = $user['id_username'];
            $_SESSION ['username'] = $user['username'];
            $response["success"] = true;
            $response["redirect_url"] = "dashboard.php"; // Include the redirect URL
            echo json_encode($response);
        }else{
            $response["success"] = false;
            $response["message"][] = "Password Salah";
            echo json_encode($response);
        }
    }else{
        $response["success"] = false;
        $response["message"][] = "Username Tidak Ditemukan";
        echo json_encode($response);
    }
}