<?php
include("connection.php");
if (isset($_POST['table']) && isset($_POST['id']) && isset($_POST['status'])) {
    $table = $_POST['table'];
    $id = $_POST['id'];
    $status = $_POST['status'];
    $sql = "UPDATE `$table` SET tstatus='$status' WHERE ";
    switch ($table) {
        case 'transaction-transfer':
            $sql .= "transferID=$id";
            break;
        case 'transaction-baptism':
            $sql .= "baptismID=$id";
            break;
        case 'transaction-excuse':
            $sql .= "excuseID=$id";
            break;
        case 'transaction-purpose':
            $sql .= "purposeID=$id";
            break;
        default:
            // Invalid table name
            die("Invalid table name");
    }
    mysqli_query($conn, $sql);
    mysqli_close($conn);
}
?>