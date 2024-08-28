<?php

// Include the database connection file
include "connection.php";

// Get the ID parameter from the Ajax request
$id = $_GET['id'];

// Prepare a SQL query to retrieve the fname and lname of the member with the given ID
$stmt = $db->prepare('SELECT fname, lname FROM churchmembership WHERE id = :id');
$stmt->bindParam(':id', $id);
$stmt->execute();

// Fetch the results and format them as JSON
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data = array(
        'fname' => $row['fname'],
        'lname' => $row['lname']
    );
    echo json_encode($data);
} else {
    // If no results were found, return an empty JSON object
    echo json_encode(array());
}