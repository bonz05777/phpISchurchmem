<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tableName = isset($_POST['table']) ? $_POST['table'] : '';
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    // update the status column based on the table name and transaction ID
    switch ($tableName) {
        case "transaction-transfer":
            $statusColumn = "tstatus";
            break;
        case "transaction-baptism":
            $statusColumn = "bstatus";
            break;
        case "transaction-excuse":
            $statusColumn = "estatus";
            break;
        case "transaction-purpose":
            $statusColumn = "pstatus";
            break;
        default:
            $statusColumn = "";
    }

    if (empty($tableName) || empty($id) || empty($status)) {
        echo "Error: Please fill in all required fields.";
        exit;
    }

    $sql = "UPDATE $tableName SET $statusColumn='$status' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Success";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Error: Invalid request method.";
}
?>