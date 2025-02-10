<?php
include($_SERVER['DOCUMENT_ROOT'] . "/db/db.php");

$data = array();

$sql = "SELECT * FROM `peak_rh` ORDER BY id DESC LIMIT 5";
$res = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($res)) {
    $data[] = array(
        'data1' => $row['id'],
        // 'data2' => str_replace('-', '', $row['date']) . sprintf('%05d', $row['id']),
        'data2' => $row['peak1'],
        'data3' => $row['peak2'],
        'data4' => $row['peak3'],
        'data5' => $row['time']
    );
}

echo json_encode($data);
?>
