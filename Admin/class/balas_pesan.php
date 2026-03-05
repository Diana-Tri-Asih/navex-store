<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';
require '../../PHPMailer-master/src/Exception.php';
require 'dbh.php'; 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

try {
    // Validasi input 
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!$data) {
        throw new Exception("Invalid JSON data received");
    }
    
    if (!isset($data['id']) || !isset($data['balasan'])) {
        throw new Exception("Data tidak lengkap. ID dan balasan harus diisi.");
    }
    
    $id = intval($data['id']);
    $balasan = trim($data['balasan']);
    
    if ($id <= 0) {
        throw new Exception("ID tidak valid");
    }
    
    if (empty($balasan)) {
        throw new Exception("Balasan tidak boleh kosong");
    }
    
    // Validasi koneksi database
    if (!$connection) {
        throw new Exception("Koneksi database gagal");
    }
    
    // Ambil data user dari database dengan prepared statement
    $query = "SELECT nama_pengirim, email_pengirim FROM hub_kami WHERE id_hub = ?";
    $stmt = mysqli_prepare($connection, $query);
    
    if (!$stmt) {
        throw new Exception("Prepare statement gagal: " . mysqli_error($connection));
    }
    
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (!$result || mysqli_num_rows($result) == 0) {
        throw new Exception("Data pesan tidak ditemukan");
    }
    
    $row = mysqli_fetch_assoc($result);
    $emailTujuan = $row['email_pengirim'];
    $namaTujuan = $row['nama_pengirim'];
    
    // Validasi email
    if (!filter_var($emailTujuan, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Email tujuan tidak valid: " . $emailTujuan);
    }
    
    // Kirim email menggunakan PHPMailer
    $mail = new PHPMailer(true);
    
    // Konfigurasi SMTP Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your_email@gmail.com'; // Ganti dengan email Anda
    $mail->Password = 'your_app_password'; // Ganti dengan App Password Anda
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8'; // Set charset
    
    // Tambahan untuk mengatasi SSL certificate error di localhost
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    
    // Debug SMTP 
    $mail->SMTPDebug = 2; 
    $mail->Debugoutput = 'error_log'; // Log ke error log PHP
    
    // Email pengirim
    $mail->setFrom('your_email@gmail.com', 'Admin NAVEX Indonesia');
    $mail->addAddress($emailTujuan, $namaTujuan);
    $mail->isHTML(false); // Set sebagai plain text
    $mail->Subject = "Balasan dari Admin NAVEX Indonesia";
    $mail->Body = "Halo " . $namaTujuan . ",\n\nIni adalah balasan dari pesan Anda:\n\n" . $balasan . "\n\nSalam,\nAdmin NAVEX Indonesia";
    
    // Kirim email
    if (!$mail->send()) {
        throw new Exception('Gagal mengirim email: ' . $mail->ErrorInfo);
    }
    
    // Update balasan ke database dengan prepared statement
    $updateQuery = "UPDATE hub_kami SET balasan = ? WHERE id_hub = ?";
    $updateStmt = mysqli_prepare($connection, $updateQuery);
    
    if (!$updateStmt) {
        throw new Exception("Prepare update statement gagal: " . mysqli_error($connection));
    }
    
    mysqli_stmt_bind_param($updateStmt, "si", $balasan, $id);
    
    if (!mysqli_stmt_execute($updateStmt)) {
        throw new Exception("Gagal menyimpan balasan ke database: " . mysqli_stmt_error($updateStmt));
    }
    
    // Tutup statements
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($updateStmt);
    
    echo json_encode([
        'status' => 'success', 
        'message' => 'Balasan berhasil dikirim ke ' . $emailTujuan
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error', 
        'message' => $e->getMessage()
    ]);
}