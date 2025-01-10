<?php
include($_SERVER['DOCUMENT_ROOT'] . "/db/db.php");

$data = array();

$sql = "SELECT * FROM `plc_data_lh` ORDER BY id DESC LIMIT 5";
$res = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($res)) {
    $data[] = array(
        'id' => $row['id'],
        'lot' => str_replace('-', '', $row['date']) . sprintf('%05d', $row['id']),
        'data22' => $row['data22'],
        'data23' => $row['data23'],
        'data24' => $row['data24'],
        'data26' => $row['data26'],
        'data27' => $row['data27'],
        'data28' => $row['data28'],
        'data30' => $row['data30'],
        'data31' => $row['data31'],
        'data32' => $row['data32'],
        'time' => $row['time']
    );
}

echo json_encode($data);
?>
