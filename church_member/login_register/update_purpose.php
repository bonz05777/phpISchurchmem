<?php
// database connection details
include("connection.php");

$purposeID = $_POST['purposeID'];
$pfname = $_POST['pfname'];
$pmname = $_POST['pmname'];
$plname = $_POST['plname'];
$pchurchname = $_POST['pchurchname'];
$pdescription = $_POST['pdescription'];
$pstatus = $_POST['pstatus'];

$sql = "UPDATE `transaction-purpose` SET `pfname`='$pfname',`pmname`='$pmname',`plname`='$plname',`pchurchname`='$pchurchname',`pdescription`='$pdescription',`pstatus`='$pstatus' WHERE `purposeID`='$purposeID'";

if ($conn->query($sql) === TRUE) {
    echo "Transaction details updated successfully";
} else {
    echo "Error updating transaction details: " . $conn->error;
}
$conn->close();
?>