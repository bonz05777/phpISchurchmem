<?php
// Include the database connection file
include "connection.php";

if (isset($_POST['ministerID'])) {
  $ministerID = $_POST['ministerID'];

  // Fetch the minister's first and last name from the minister table
  $query = "SELECT ministerfname, ministerlname FROM minister WHERE ministerID='$ministerID'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $data = array(
      "ministerfname" => $row['ministerfname'],
      "ministerlname" => $row['ministerlname']
    );
    echo json_encode($data);
  } else {
    echo json_encode(null);
  }
}
?>