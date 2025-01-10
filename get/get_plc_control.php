<?php
include($_SERVER['DOCUMENT_ROOT'] . "/db/db.php");

$data = array();

$sql = "SELECT * FROM `plc_data_lh` ORDER BY id DESC LIMIT 1";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);

array_push($data, $row['data33']);

echo json_encode($data);
?>
