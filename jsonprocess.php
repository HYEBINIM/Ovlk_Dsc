<?php
session_start();

$servername = "127.0.0.1";
$username = "server";
$password = "dltmxm1234";
$dbname = "dataset";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement
$sql = "SELECT * FROM plc_data_lh WHERE id = 1"; 
$result = $conn->query($sql);

header("Content-Type: application/json; charset=UTF-8");

if ($result->num_rows > 0) {
    // Fetch the data
    $row = $result->fetch_assoc();
    // Return the data in a simple array format
    echo json_encode(array(
        "status" => "success",
        "message" => "Data retrieved successfully",
        "data10" => $row['data10'],
        "data11" => $row['data11'],
        "data12" => $row['data12'],
        "data3" => $row['data3'],
        "data4" => $row['data4'],
        "data5" => $row['data5'],
        "data6" => $row['data6'],
        "data7" => $row['data7'],
        "data8" => $row['data8'],
        "data9" => $row['data9']
    ));
} else {
    // If no data found, return a default structure
    echo json_encode(array(
        "status" => "error",
        "message" => "No data found"
    ));
}

// Close connection
$conn->close();
?>
