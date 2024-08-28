<?php
// Include the database connection file
include "connection.php";

// Check if the officeID parameter is set in the URL
if (isset($_GET['officeID'])) {
  // Get the value of the officeID parameter
  $officeID = $_GET['officeID'];

  // Retrieve the corresponding office record from the database
  $query = "SELECT * FROM office WHERE officeID='$officeID'";
  $result = mysqli_query($conn, $query);

  // Check if the record exists
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Return the office details as a JSON object
    echo json_encode(
      array(
        'position' => $row['position'],
        'deptname' => $row['deptname']
      )
    );

    exit();
  } else {
    // No matching record found
    echo json_encode(
      array(
        'error' => 'Invalid office ID.'
      )
    );

    exit();
  }
}
