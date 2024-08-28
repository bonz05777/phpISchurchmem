<?php
// database connection details
include("connection.php");

$baptismID = $_GET['baptismID'];

$sql = "SELECT * FROM `transaction-baptism` WHERE `baptismID`='$baptismID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array(
        'bfname' => $row['bfname'],
        'bmname' => $row['bmname'],
        'blname' => $row['blname'],
        'bchurchname' => $row['bchurchname'],
        'transaction_date' => $row['transaction_date'],
        'bstatus' => $row['bstatus']
    );
    echo json_encode($data);
} else {
    echo "Transaction not found";
}
$conn->close();
?>