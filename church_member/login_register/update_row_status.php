<?php
// database connection details
include("connection.php");

// Get table, row id, and status from POST data
$table = $_POST['table'];
$id = $_POST['id'];
$status = $_POST['status'];

// Update row status in the database
switch ($table) {
    case 'transaction-transfer':
        $sql = "UPDATE `transaction-transfer` SET tstatus = '$status' WHERE transferID = $id";
        break;
    case 'transaction-baptism':
        $sql = "UPDATE `transaction-baptism` SET bstatus = '$status' WHERE baptismID = $id";
        break;
    case 'transaction-excuse':
        $sql = "UPDATE `transaction-excuse` SET estatus = '$status' WHERE excuseID = $id";
        break;
    case 'transaction-purpose':
        $sql = "UPDATE `transaction-purpose` SET pstatus = '$status' WHERE purposeID = $id";
        break;
}

mysqli_query($conn, $sql);

// Close the database connection
mysqli_close($conn);
?>