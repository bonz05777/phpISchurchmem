<?php
// database connection details
include("connection.php");

// Get the table and id from AJAX data
$table = $_GET['table'];
$id = $_GET['id'];

// Build the SQL query based on table and id
switch ($table) {
    case 'transaction-transfer':
        $sql = "SELECT * FROM `transaction-transfer` WHERE transferID = $id";
        break;
    case 'transaction-baptism':
        $sql = "SELECT * FROM `transaction-baptism` WHERE baptismID = $id";
        break;
    case 'transaction-excuse':
        $sql = "SELECT * FROM `transaction-excuse` WHERE excuseID = $id";
        break;
    case 'transaction-purpose':
        $sql = "SELECT * FROM `transaction-purpose` WHERE purposeID = $id";
        break;
}

// Execute the query and retrieve the row data
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Convert the row data to JSON format and return it to the AJAX request
echo json_encode($row);

// Close the database connection
mysqli_close($conn);
?>