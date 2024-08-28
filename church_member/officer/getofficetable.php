<?php
// Include the database connection file
include "connection.php";

if (isset($_POST['officeID'])) { // Change $_POST['id'] into $_POST['officeID']
  $officeID = $_POST['officeID'];

  // Fetch the first and last name from the churchmembership table
  $query = "SELECT position, deptname FROM office WHERE officeID='$officeID'"; // Change id into officeID
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $data = array(
      "position" => $row['position'],
      "deptname" => $row['deptname']
    );
    echo json_encode($data);
  } else {
    echo json_encode(null);
  }
}
?>