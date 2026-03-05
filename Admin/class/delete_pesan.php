<?php
include "dbh.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM hub_kami WHERE id_hub = $id";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Pesan berhasil dihapus']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus pesan']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID tidak ditemukan']);
}
?>
