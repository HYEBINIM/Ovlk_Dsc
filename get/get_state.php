<?php
include($_SERVER['DOCUMENT_ROOT'] . "/db/db.php");

$data = array();

$sql = "SELECT * FROM `guide1` WHERE id = 1";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);
$data[] = array(
    'data9' => $row['data9'],
);

echo json_encode($data);
?>