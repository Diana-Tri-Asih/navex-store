<?php
include 'dbh.php';
header('Content-Type: application/json');

$sql = "SELECT * FROM hub_kami ORDER BY id_hub DESC";
$result = $connection->query($sql);

$data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode(["status" => "success", "data" => $data]);
?>
