<?php
session_start();

// database connection details
include("connection.php");

// Get the user ID or username from the session variable
$user_id = $_SESSION['user_id'];

// SQL query to retrieve the email and password for the given user ID or username
$sql = "SELECT `email`, `password` FROM `users` WHERE `id` = $id"; // UPDATE THIS QUERY AS PER YOUR DATABASE TABLE STRUCTURE

$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Get the first row of data (there should only be one row)
    $row = $result->fetch_assoc();

    // Send the email and password JSON-encoded back to the client side
    echo json_encode($row);
} else {
    echo "No results found";
}

// Close the database connection
$conn->close();
?>