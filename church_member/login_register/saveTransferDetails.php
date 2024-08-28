<?php
include("connection.php");

// Get form data from AJAX request
$tfname = $_POST['tfname'];
$tmname = $_POST['tmname'];
$tlname = $_POST['tlname'];
$tchurchname = $_POST['tchurchname'];
$ttransfername = $_POST['ttransfername'];
$tdistrictname = $_POST['tdistrictname'];


// Prepare query and execute
$sql = "INSERT INTO transaction-transfer (tfname, tmname, tlname, tchurchname, ttransfername, dtistrictname) VALUES ('$tfname', '$tmname', '$tlname', '$tchurchname', '$ttransfername', '$tdistrictname')";
if (mysqli_query($conn, $sql)) {
    echo 'Data saved successfully!';
} else {
    echo 'Error saving data: ' . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>