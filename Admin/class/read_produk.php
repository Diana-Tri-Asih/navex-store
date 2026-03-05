<?php
session_start();
include "dbh.php";
$sql = "SELECT * FROM produk ORDER BY id_home DESC";
$result = $connection->query($sql);
$data = array();
if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
 $data[] = $row;
 }
}
echo json_encode(array("data" => $data));
?>