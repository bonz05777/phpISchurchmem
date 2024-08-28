<?php

include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $table = $_GET['table'];
    $id = $_GET['id'];
    if ($table === "transaction-transfer") {
        $column = "transferID";
    } else if ($table === "transaction-baptism") {
        $column = "baptismID";
    } else if ($table === "transaction-excuse") {
        $column = "excuseID";
    } else if ($table === "transaction-purpose") {
        $column = "purposeID";
    } else {
        // Invalid table name
        die("Error: Invalid table name");
    }

    $sql = "DELETE FROM `$table` WHERE `$column` = $id";

    if (mysqli_query($conn, $sql)) {
        echo "Row deleted successfully";
    } else {
        echo "Error deleting row: " . mysqli_error($conn);
    }
}

// Assuming $purposeID has already been set to the relevant purpose ID

$sql = "DELETE FROM transaction-purpose WHERE purposeID=$purposeID";

if ($conn->query($sql) === TRUE) {
    // Success message
} else {
    // Error message
}

mysqli_close($conn);

?>