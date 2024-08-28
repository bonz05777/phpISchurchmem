<?php
include("connection.php");

$table = $_POST['table'];
$status = $_POST['status'];
$id = $_POST['id'];

// Start a transaction
mysqli_begin_transaction($conn);

try {
    // Update status in the corresponding table based on the transaction ID
    if ($table == "transaction-transfer") {
        $query = "UPDATE $table SET tstatus='$status' WHERE transferID=$id";
    } else if ($table == "transaction-baptism") {
        $query = "UPDATE $table SET bstatus='$status' WHERE baptismID=$id";
    } else if ($table == "transaction-excuse") {
        $query = "UPDATE $table SET estatus='$status' WHERE excuseID=$id";
    } else if ($table == "transaction-purpose") {
        $query = "UPDATE $table SET pstatus='$status' WHERE purposeID=$id";
    }

    $result = mysqli_query($conn, $query);

    // Commit the transaction if the SQL statement was executed without errors
    mysqli_commit($conn);
    echo "Updated successfully!";

} catch (Exception $e) {
    // Roll back the transaction if an error occurs
    mysqli_rollback($conn);
    echo "Transaction failed: " . $e->getMessage();
}

mysqli_close($conn);
?>