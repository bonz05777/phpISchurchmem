<?php
// Use output buffering
ob_start();

// Include the database connection file
include "connection.php";

// Initialize variables
$addressID = "";
$street = "";
$purok = "";
$barangay = "";
$city = "";

// Call the selectAllAddress stored procedure
$addressResult = mysqli_query($conn, "CALL selectAllAddress()");
$addresses = mysqli_fetch_all($addressResult, MYSQLI_ASSOC);

if (isset($_GET['id'])) {
  $addressID = $_GET['id'];
  // Find the address with the given ID
  foreach ($addresses as $address) {
    if ($address['addressID'] == $addressID) {
      $street = $address['street'];
      $purok = $address['purok'];
      $barangay = $address['barangay'];
      $city = $address['city'];
      break;
    }
  }
}

if (isset($_POST['submit'])) {
  // If the form is submitted, process the data
  $street = $_POST['street'];
  $purok = $_POST['purok'];
  $barangay = $_POST['barangay'];
  $city = $_POST['city'];

  // BEGIN TRANSACTION
  mysqli_autocommit($conn, false);

  // Call the stored function to generate a new address ID
  $result = mysqli_query($conn, "SELECT generate_address_id() AS new_id");
  $data = mysqli_fetch_assoc($result);
  $addressID = $data['new_id'];

  // Call the stored procedure to insert the new address record into the database
  $sql = "CALL insert_address('$addressID', '$street', '$purok', '$barangay', '$city')";

  if (mysqli_query($conn, $sql) === FALSE) {
    // ROLLBACK TRANSACTION
    mysqli_rollback($conn);
    die(mysqli_error($conn));
  }

  // COMMIT TRANSACTION
  mysqli_commit($conn);
}

// Close the connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>ADDRESSINFO</title>
  <link rel="stylesheet" type="text/css" href="addmemberdetails.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // Autopopulate address details in modal
    function populateAddressDetails() {
      var street = $("#street").val();
      var purok = $("#purok").val();
      var barangay = $("#barangay").val();
      var city = $("#city").val();

      $("#modal-street-input").val(street);
      $("#modal-purok-input").val(purok);
      $("#modal-barangay-input").val(barangay);
      $("#modal-city-input").val(city);
    }

    // Show modal
    function showAddressForm() {
      populateAddressDetails();
      $("#popup").show();
    }

    // Close modal
    function closeAddressForm() {
      $("#popup").hide();
    }

    // Submit modal form
    function submitAddressForm() {
      var street = $("#modal-street-input").val();
      var purok = $("#modal-purok-input").val();
      var barangay = $("#modal-barangay-input").val();
      var city = $("#modal-city-input").val();

      if (street.trim() !== "" && purok.trim() !== "" && barangay.trim() !== "" && city.trim() !== "") {
        // Set the address details in the hidden inputs
        $("#street").val(street);
        $("#purok").val(purok);
        $("#barangay").val(barangay);
        $("#city").val(city);

        closeAddressForm();
      } else {
        alert("Please fill in all fields.");
      }
    }
  </script>
</head>

<body>

  <div class="container">
    <div class="inner">
      <div class="title">
        <h1>ADDRESS INFO</h1>
      </div>

      <form method="post" action="address.php">
        <label for="street">Street:</label>
        <input type="text" name="street" placeholder="Street" required value="<?php echo htmlspecialchars($street); ?>">

        <label for="purok">Purok:</label>
        <input type="text" name="purok" placeholder="Purok" required value="<?php echo htmlspecialchars($purok); ?>">

        <label for="barangay">Barangay:</label>
        <input type="text" name="barangay" placeholder="Barangay" required
          value="<?php echo htmlspecialchars($barangay); ?>">

        <label for="city">City/Municipality:</label>
        <input type="text" name="city" placeholder="City/Municipality" required
          value="<?php echo htmlspecialchars($city); ?>">

        <input type="submit" name="submit" value="Submit">
      </form>

      <table>
        <thead>
          <tr>
            <th>Address ID</th>
            <th>Street</th>
            <th>Purok</th>
            <th>Barangay</th>
            <th>City/Municipality</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($addresses as $address) { ?>
            <tr>
              <td>
                <?= $address['addressID'] ?>
              </td>
              <td>
                <?= $address['street'] ?>
              </td>
              <td>
                <?= $address['purok'] ?>
              </td>
              <td>
                <?= $address['barangay'] ?>
              </td>
              <td>
                <?= $address['city'] ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>

      <div class="popup" id="popup">
        <div class="popup-content">
          <div class="modal-header">
            <span class="close" onclick="closeAddressForm()">&times;</span>
            <h2>Edit Address Details</h2>
          </div>
          <div class="modal-body">
            <form>
              <label for="modal-street-input">Street:</label>
              <input type="text" id="modal-street-input">

              <label for="modal-purok-input">Purok:</label>
              <input type="text" id="modal-purok-input">

              <label for="modal-barangay-input">Barangay:</label>
              <input type="text" id="modal-barangay-input">

              <label for="modal-city-input">City/Municipality:</label>
              <input type="text" id="modal-city-input">

              <input type="button" value="Submit" onclick="submitAddressForm()">
            </form>
          </div>
        </div>
      </div>
      <button onclick="showAddressForm()">Edit Address</button>
    </div>
  </div>
</body>

</html>

<style>
  .cv .datainsert {
    width: 15vw;
  }

  .v .datainsert {
    width: 21.2vw;
  }

  .container form label {
    width: 10vw;
    margin-top: 20px;

  }

  .container form .sub_btn {
    margin-top: 10px;
  }

  #popup {
    display: none;
    position: absolute;
    top: 30%;
    left: 50%;
    transform: translate(-50%, -30%);
    z-index: 100;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    padding: 20px;
    max-width: 400px;
    width: 90%;
  }

  #popup label {
    margin-bottom: 10px;
    display: block;
    font-weight: bold;
  }

  #popup input[type="text"],
  #popup input[type="password"],
  #popup input[type="date"],
  #popup select {
    padding: 10px;
    border-radius: 5px;
    font-size: 16px;
    border: 1px solid #ccc;
    width: 100%;
  }

  #popup button {
    display: block;
    width: 100%;
    background-color: rgb(1, 25, 83);
    color: #fff;
    padding: 8px;
    border: none;
    border-radius: 5px;
    margin-top: 10px;
    cursor: pointer;
  }

  #popup button:hover {
    background-color: blue;
  }

  #popup h2 {
    margin-top: 0;
    font-size: 20px;
    text-align: center;
  }

  #popup .error {
    color: red;
    font-weight: bold;
    margin-top: 10px;
  }
</style>