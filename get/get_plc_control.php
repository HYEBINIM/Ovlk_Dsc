<?php
include($_SERVER['DOCUMENT_ROOT'] . "/db/db.php");

$data = array();

# 스테이션1
$sql = "SELECT * FROM `guide1` WHERE id = 3";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($res);

# 스테이션2
$sql01 = "SELECT * FROM `guide1` WHERE id = 5";
$res01 = mysqli_query($conn, $sql01);
$row01 = mysqli_fetch_array($res01);

# 문
$sql02 = "SELECT * FROM `guide1` WHERE id = 11";
$res02 = mysqli_query($conn, $sql02);
$row02 = mysqli_fetch_array($res02);


$data[] = array(
    'data1' => $row['data0'],
    'data2' => $row['data1'],
    'data3' => $row['data2'],
    'data4' => $row['data3'],
    'data5' => $row['data4'],
    'data6' => $row['data5'],
    'data7' => $row['data6'],
    'data8' => $row['data7'],
    'data9' => $row['data8'],
    'data10' => $row02['data1'],
    'data11' => $row01['data0'],
    'data12' => $row01['data1'],
    'data13' => $row01['data2'],
    'data14' => $row01['data3'],
    'data15' => $row01['data4'],
    'data16' => $row01['data5'],
    'data17' => $row01['data6'],
    'data18' => $row01['data7'],
    'data19' => $row01['data8'],
    'data20' => $row02['data2']
);


echo json_encode($data);
?>