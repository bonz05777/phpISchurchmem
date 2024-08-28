<?php

include("connection.php");

// Get the ID and status from the AJAX request
$id = $_POST['id'];
$status = $_POST['status'];

// Update the status in the corresponding table
$tableName = '';
switch (substr($id, 0, 3)) {
    case 'tra':
        $tableName = 'transaction-transfer';
        $fname = 'tfname';
        $lname = 'tlname';
        break;
    case 'bap':
        $tableName = 'transaction-baptism';
        $fname = 'bfname';
        $lname = 'blname';
        break;
    case 'exc':
        $tableName = 'transaction-excuse';
        $fname = 'efname';
        $lname = 'elname';
        break;
    case 'pur':
        $tableName = 'transaction-purpose';
        $fname = 'pfname';
        $lname = 'plname';
        break;
}

if (!empty($tableName)) {
    $query = "UPDATE $tableName SET status='$status' WHERE $fname='$fnameValue' AND $lname='$lnameValue'";
    mysqli_query($conn, $query);
}

// Return the updated status
echo $status;

mysqli_close($conn);

?>