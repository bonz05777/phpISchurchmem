<?php
// Include the database connection file
include "connection.php";

if (isset($_POST['addressID'])) {
  $addressID = $_POST['addressID'];

  // Fetch the minister's first and last name from the minister table
  $query = "SELECT street, purok, barangay, city FROM address WHERE addressID='$addressID'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $data = array(
      "street" => $row['street'],
      "purok" => $row['purok'],
      "barangay" => $row['street'],
      "city" => $row['purok']
    );
    echo json_encode($data);
  } else {
    echo json_encode(null);
  }
}
?>

<?php
// Include the database connection file
include "connection.php";

if (isset($_POST['addressID'])) {
  $addressID = $_POST['addressID'];

  // Call the getAddressDetails stored procedure to fetch the address details
  $stmt = $conn->prepare("CALL getAddressDetails(?)");
  $stmt->bind_param("s", $addressID);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $data = array(
      "street" => $row['street'],
      "purok" => $row['purok'],
      "barangay" => $row['barangay'],
      "city" => $row['city']
    );
    echo json_encode($data);
  } else {
    echo json_encode(null);
  }
}
?>