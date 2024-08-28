<?php
include("connection.php");

// Get form data from AJAX request
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$churchname = $_POST['churchname'];
$transfername = $_POST['transfername'];
$districtname = $_POST['districtname'];


// Prepare query and execute
$sql = "INSERT INTO transaction-transfer (fname, mname, lname, churchname, transfername, districtname) VALUES ('$fname', '$mname', '$lname', '$churchname', '$transfername', '$districtname')";
if (mysqli_query($conn, $sql)) {
    echo 'Data saved successfully!';
} else {
    echo 'Error saving data: ' . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>