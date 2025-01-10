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
$sql = "SELECT * FROM guide1";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>";

    // Fetch and display column headers dynamically
    $fields = $result->fetch_fields();
    foreach ($fields as $field) {
        echo "<th>" . htmlspecialchars($field->name) . "</th>";
    }
    echo "</tr>";

    // Fetch and display rows
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $cell) {
            echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No results found.";
}

// Close connection
$conn->close();
?>
