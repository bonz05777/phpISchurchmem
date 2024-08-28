<?php
include "connection.php";

$id = $_GET['id'];

$query = "SELECT * FROM churchmembership WHERE id='$id'";
$result = mysqli_query($conn, $query);

$response = array();

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $response['fname'] = $row['fname'];
    $response['lname'] = $row['lname'];
} else {
    $response['error'] = "Invalid member ID.";
}

echo json_encode($response);
?>