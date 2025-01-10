<?php
include($_SERVER['DOCUMENT_ROOT'] . "/db/db.php");

$data = array();

$sql = "SELECT DISTINCT lot_code FROM `plc_data_lh`";
$res = mysqli_query($conn, $sql);
for($count = 1; $row = mysqli_fetch_array($res); $count++) {
    $data[] = array(
        'id' => $row['id'],
        'lot' => $row['lot_code'],
        'count' => $row['contents1']
    );
}

echo json_encode($data);
?>
