<?php
include($_SERVER['DOCUMENT_ROOT'] . "/db/db.php");

$data = array();

$sql = "SELECT * FROM `peak_lh` ORDER BY id DESC LIMIT 5";
$res = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($res)) {
    // 콤마로 구분된 데이터를 배열로 변환
    $data2 = explode(',', $row['peak1']);
    $data3 = explode(',', $row['peak2']);
    $data4 = explode(',', $row['peak3']);

    $data[] = array(
        'data1' => $row['id'],
        'data2' => $data2, // 배열로 저장
        'data3' => $data3, // 배열로 저장
        'data4' => $data4, // 배열로 저장
        'data5' => $row['time']
    );
}

echo json_encode($data);
?>
