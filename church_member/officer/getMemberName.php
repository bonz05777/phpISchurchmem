<?php
// Include the database connection file
include "connection.php";

if (isset($_POST['id'])) {
  $memberID = $_POST['id'];

  // Fetch the first and last name from the churchmembership table
  $query = "SELECT fname, lname FROM churchmembership WHERE id='$memberID'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $data = array(
      "fname" => $row['fname'],
      "lname" => $row['lname']
    );
    echo json_encode($data);
  } else {
    echo json_encode(null);
  }
}
?>