<?php
// database connection details
include("connection.php");

$baptismID = $_POST['baptismID'];
$bfname = $_POST['bfname'];
$bmname = $_POST['bmname'];
$blname = $_POST['blname'];
$bchurchname = $_POST['bchurchname'];
$bstatus = $_POST['bstatus'];

$sql = "UPDATE `transaction-baptism` SET `bfname`='$bfname',`bmname`='$bmname',`blname`='$blname',`bchurchname`='$bchurchname',`bstatus`='$bstatus' WHERE `baptismID`='$baptismID'";

if ($conn->query($sql) === TRUE) {
    echo "Transaction details updated successfully";
} else {
    echo "Error updating transaction details: " . $conn->error;
}
$conn->close();
?>