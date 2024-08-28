<?php
// Connect to the database
include("connection.php");

// Retrieve the first name and last name from the AJAX GET request
$fname = $_GET['fname'];
$lname = $_GET['lname'];

// Construct the query to retrieve data from the churchmembership table
$query = "SELECT churchname, birthdate, placebaptized, datereceived FROM churchmembership WHERE fname = ? AND lname = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ss', $fname, $lname);
$stmt->execute();

// Retrieve the data and encode it as JSON
$data = $stmt->get_result()->fetch_assoc();
$jsonData = json_encode($data);

// Return the JSON data to the client
header('Content-Type: application/json');
echo $jsonData;