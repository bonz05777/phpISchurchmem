<?php
// database connection details
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["purposeID"])) {
    $purposeID = $_POST["purposeID"];


    $sql = "SELECT * FROM transaction-purpose WHERE purposeID = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $purposeID);
        if (mysqli_stmt_execute($stmt)) {
            error_log("Found " . mysqli_stmt_num_rows($stmt) . " rows matching purpose ID");
        } else {
            error_log("SELECT statement failed: " . mysqli_error($link));
        }
        mysqli_stmt_close($stmt);
    } else {
        error_log("Error preparing SELECT statement: " . mysqli_error($link));
    }


    $sql = "DELETE FROM transaction-purpose WHERE purposeID = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $purposeID);
        if (mysqli_stmt_execute($stmt)) {
            $response = array("success" => true);
        } else {
            $response = array("success" => false, "message" => "Error deleting purpose from database: " . mysqli_error($link));
        }
        mysqli_stmt_close($stmt);
    } else {
        $response = array("success" => false, "message" => "Error preparing statement: " . mysqli_error($link));
    }
    echo json_encode($response);
} else {
    http_response_code(400);
}
mysqli_close($link);
?>