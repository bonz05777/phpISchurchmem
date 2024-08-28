<?php
// database connection details
include("connection.php");

$excuseID = $_GET['excuseID'];

$sql = "SELECT * FROM `transaction-excuse` WHERE `excuseID`='$excuseID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array(
        'efname' => $row['efname'],
        'emname' => $row['emname'],
        'elname' => $row['elname'],
        'echurchname' => $row['echurchname'],
        'eusedfor' => $row['eusedfor'],
        'eorganization' => $row['eorganization'],
        'transaction_date' => $row['transaction_date'],
        'estatus' => $row['estatus']
    );
    echo json_encode($data);
} else {
    echo "Transaction not found";
}
$conn->close();
?>