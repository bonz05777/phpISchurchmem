<?php
include("connection.php");

$table = isset($_POST['table']) ? mysqli_real_escape_string($conn, $_POST['table']) : '';
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$status = isset($_POST['status']) ? mysqli_real_escape_string($conn, $_POST['status']) : '';
$statusColumn = isset($_POST['status_column']) ? mysqli_real_escape_string($conn, $_POST['status_column']) : '';

if (!empty($table) && $id > 0 && !empty($status) && !empty($statusColumn)) {
    // Query the appropriate table based on the provided table name
    if ($table == 'transaction-transfer') {
        $sql = "UPDATE `$table` SET $statusColumn='$status' WHERE transferID = $id";
    } elseif ($table == 'transaction-baptism') {
        $sql = "UPDATE `$table` SET $statusColumn='$status' WHERE baptismID = $id";
    } elseif ($table == 'transaction-excuse') {
        $sql = "UPDATE `$table` SET $statusColumn='$status' WHERE excuseID = $id";
    } elseif ($table == 'transaction-purpose') {
        $sql = "UPDATE `$table` SET $statusColumn='$status' WHERE purposeID = $id";
    }

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}

mysqli_close($conn);
?>