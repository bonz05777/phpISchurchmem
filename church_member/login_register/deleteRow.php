<?php

include("connection.php");

if (isset($_POST['tableName']) && isset($_POST['id'])) {
    $tableName = $_POST['tableName'];
    $id = $_POST['id'];
    $delete_query = "DELETE FROM $tableName WHERE " . $tableName . "ID=$id";
    if (mysqli_query($conn, $delete_query)) {
        echo "success";
    } else {
        echo "error";
    }
}

mysqli_close($conn);

?>