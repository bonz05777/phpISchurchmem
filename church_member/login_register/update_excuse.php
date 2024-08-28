<?php
// database connection details
include("connection.php");

$excuseID = $_POST['excuseID'];
$efname = $_POST['efname'];
$emname = $_POST['emname'];
$elname = $_POST['elname'];
$echurchname = $_POST['echurchname'];
$eusedfor = $_POST['eusedfor'];
$eorganization = $_POST['eorganization'];
$estatus = $_POST['estatus'];

$sql = "UPDATE `transaction-excuse` SET `efname`='$efname',`emname`='$emname',`elname`='$elname',`echurchname`='$echurchname',`eusedfor`='$eusedfor',`eorganization`='$eorganization',`estatus`='$estatus' WHERE `excuseID`='$excuseID'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data with ID: " . $excuseID . " Updated Successfully.');";
    echo "window.location.href = 'retrieve_all_history.php';</script>";

} else {
    echo "Error updating transaction details: " . $conn->error;
}
$conn->close();
?>