<?php
include "dbh.php";

$sql = "SELECT * FROM slider Order BY id_slider DESC";
$query = mysqli_query($connection,$sql);

$slider = [];
while($row = mysqli_fetch_assoc($query)){
    $slider[] = $row;
}

header('Content-Type: application/json');
echo json_encode($slider);
