<?php
include '../../Admin/class/dbh.php'; 

$sql = "SELECT * FROM kontak WHERE status = 'aktif' LIMIT 1";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    $profil = $result->fetch_assoc();
    echo json_encode(["status" => "success", "data" => $profil]);
} else {
    echo json_encode(["status" => "error", "message" => "Data tidak ditemukan."]);
}
?>
