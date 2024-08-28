<?php
// database connection details
include("connection.php");

$transferID = $_POST['transferID'];
$tfname = $_POST['tfname'];
$tmname = $_POST['tmname'];
$tlname = $_POST['tlname'];
$tchurchname = $_POST['tchurchname'];
$ttransferchurch = $_POST['ttransferchurch'];
$tplacechurch = $_POST['tplacechurch'];
$tstatus = $_POST['tstatus'];

$sql = "UPDATE `transaction-transfer` SET `tfname`='$tfname',`tmname`='$tmname',`tlname`='$tlname',`tchurchname`='$tchurchname',`ttransferchurch`='$ttransferchurch',`tplacechurch`='$tplacechurch',`tstatus`='$tstatus' WHERE `transferID`='$transferID'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data with ID: " . $transferID . " Updated Successfully.');";
    echo "window.location.href = 'retrieve_all_history.php';</script>";

} else {
    echo "Error updating transaction details: " . $conn->error;
}
$conn->close();
?>