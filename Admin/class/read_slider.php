<?php
session_start();
include "./class/dbh.php";
$sql = "SELECT * FROM slider ORDER BY id_slider DESC";
$result = $conn->query($sql);
$data = array();
if ($result->num_rows > 0) {
 while($row = $result->fetch_assoc()) {
 $data[] = $row;
 }
}
echo json_encode(array("data" => $data));
?>