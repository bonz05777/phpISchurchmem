<?php

include "connection.php";

$id = "";
$civilstatus = "";
$addressID = "";
$birthdate = "";
$birthplace = "";
$father = "";
$mother = "";
$educlevel = "";
$contactnumber = "";
$street = "";
$purok = "";
$barangay = "";
$city = "";


function checkIdExists($id)
{
  // Check if the ID already exists in the database
  global $conn;
  $sql = "SELECT * FROM memberpersonaldetails WHERE id='$id'";
  $result = $conn->query($sql);
  return $result->num_rows > 0;
}

function generateAddressId()
{
  // Generate a new unique address ID by selecting the lowest available ID
  global $conn;
  $sql = "SELECT MIN(addressID) AS min_id FROM address";
  $result = $conn->query($sql);
  $data = mysqli_fetch_assoc($result);

  if ($data['min_id'] == NULL) {
    // There are no existing address IDs, start from 1
    $generatedId = 1;
  } else {
    // Pick the next available address ID
    $generatedId = $data['min_id'] - 1;
  }

  $idExists = true;
  while ($idExists) {
    $generatedId++;
    $sql = "SELECT * FROM address WHERE addressID='$generatedId'";
    $result = $conn->query($sql);
    $idExists = $result->num_rows > 0;
  }

  return $generatedId;
}


if (isset($_GET['id'])) {
  // If an ID is provided in the query string, retrieve the member data from the database
  $id = $_GET['id'];
  $select = mysqli_query($conn, "SELECT * FROM memberpersonaldetails WHERE id='$id'");
  $data = mysqli_fetch_assoc($select);
  $id = $data['id'];
  $civilstatus = $data['civilstatus'];
  $addressID = $data['addressID'];
  $birthdate = $data['birthdate'];
  $birthplace = $data['birthplace'];
  $father = $data['father'];
  $mother = $data['mother'];
  $educlevel = $data['educlevel'];
  $contactnumber = $data['contactnumber'];
  $address = mysqli_query($conn, "SELECT * FROM address WHERE addressID = '$addressID'");
  $addressData = mysqli_fetch_assoc($address);
  $street = $addressData['street'];
  $purok = $addressData['purok'];
  $barangay = $addressData['barangay'];
  $city = $addressData['city'];
}


if (isset($_POST['submit'])) {
  // If the form is submitted, process the data
  $id = $_POST['id'];
  $civilstatus = $_POST['civilstatus'];
  $birthdate = $_POST['birthdate'];
  $birthplace = $_POST['birthplace'];
  $father = $_POST['father'];
  $mother = $_POST['mother'];
  $educlevel = $_POST['educlevel'];
  $contactnumber = $_POST['contactnumber'];
  $street = $_POST['street'];
  $purok = $_POST['purok'];
  $barangay = $_POST['barangay'];
  $city = $_POST['city'];


  // Check if ID is present in churchmembership table before inserting or updating
  function checkMembership($id)
  {
    global $conn;
    $sql = "SELECT * FROM churchmembership WHERE id = '$id'";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
  }

  if (!checkMembership($id)) {
    echo "<script>alert('ID not found in churchmembership table.');</script>";
    echo "<script>window.location.href = 'addmemberdetails.php';</script>";
    exit;
  }

  // Check if address details are empty
  if (empty($street) || empty($purok) || empty($barangay) || empty($city)) {
    echo "<script>alert('Address details cannot be empty.');window.location.href ='addmemberdetails.php';</script>";
    exit;
  }

  // Check if address already exists
  $sql = "SELECT * FROM address WHERE street='$street' AND purok='$purok' AND barangay='$barangay' AND city='$city'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Address already exists, get the ID
    $data = mysqli_fetch_assoc($result);
    $addressID = $data['addressID'];
  } else {
    // Address does not exist, insert into table
    $sql = "INSERT INTO address (street, purok, barangay, city) VALUES ('$street', '$purok', '$barangay', '$city')";

    if ($conn->query($sql) === FALSE) {
      die(mysqli_error($conn));
    }

    $addressID = $conn->insert_id;
  }

  // Check if member already exists
  $sql_personal = "SELECT * FROM memberpersonaldetails WHERE id='$id'";
  $result_personal = $conn->query($sql_personal);

  if ($result_personal->num_rows > 0) {
    // Member already exists, update the details if they've been changed
    $data_personal = mysqli_fetch_assoc($result_personal);
    $existingAddressID = $data_personal['addressID'];

    $updateFields = [];

    if ($data_personal['civilstatus'] != $civilstatus) {
      $updateFields[] = "civilstatus='$civilstatus'";
    }
    if ($data_personal['birthdate'] != $birthdate) {
      $updateFields[] = "birthdate='$birthdate'";
    }
    if ($data_personal['birthplace'] != $birthplace) {
      $updateFields[] = "birthplace='$birthplace'";
    }
    if ($data_personal['father'] != $father) {
      $updateFields[] = "father='$father'";
    }
    if ($data_personal['mother'] != $mother) {
      $updateFields[] = "mother='$mother'";
    }
    if ($data_personal['educlevel'] != $educlevel) {
      $updateFields[] = "educlevel='$educlevel'";
    }
    if ($data_personal['contactnumber'] != $contactnumber) {
      $updateFields[] = "contactnumber='$contactnumber'";
    }

    if ($existingAddressID != $addressID || !empty($updateFields)) {
      $updateClause = "";
      if ($existingAddressID != $addressID) {
        $updateClause .= "addressID='$addressID'";
      }
      if (!empty($updateFields)) {
        $separator = empty($updateClause) ? "" : ", ";
        $updateClause .= $separator . implode(", ", $updateFields);
      }
      $sql_personal = "UPDATE memberpersonaldetails SET $updateClause WHERE id='$id'";

      if ($conn->query($sql_personal) === FALSE) {
        die(mysqli_error($conn));
      }

      $update = true;
    } else {
      // No fields have been changed
      echo "<script>alert('Data with ID: " . $id . " No changes have been made.');window.location.href ='showmemberdetails.php';</script>";
      exit;
    }
  } else {
    // Member does not exist, insert details
    if (checkIdExists($id)) {
      die("ID already exists");
    }

    $sql_personal = "INSERT INTO memberpersonaldetails (id, civilstatus, addressID, birthdate,  birthplace, father, mother, educlevel, contactnumber) VALUES ('$id', '$civilstatus',  '$addressID', '$birthdate', '$birthplace', '$father', '$mother', '$educlevel', '$contactnumber')";

    if ($conn->query($sql_personal) === FALSE) {
      die(mysqli_error($conn));
    }

    $update = false;
  }
}


if (isset($update) && $update) {
  echo "<script>alert('Data with ID: " . $id . " Updated Successfully.');window.location.href = 'showmemberdetails.php';</script>";
  exit;
} else if (isset($update) && !$update) {
  echo "<script>alert('Data with ID: " . $id . " Added Successfully.');window.location.href ='addmemberdetails.php';</script>";
  exit;
}

?>




<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>MEMBER'S PERSONAL INFO</title>
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
        <h1>MEMBER'S PERSONAL INFO</h1>
      </div>

      <form method="post" action="">

        <div>
          <span id="memberNameLabel" style="font-size: 12px; margin-left: 2vw; 
                        color: darkblue; ">Name:</span>
          <span id="memberName" style="font-size: 12px; color: darkblue; margin-left: 3pt;"></span>
        </div>
        <div class="contents">
          <div>
            <label for="id">Member ID: </label>
            <input type="text" name="id" class="data-insert" value="<?php echo $id; ?>"
              onkeyup="memberIDKeyUp(this.value)" <?php if (isset($_GET['id'])) {
                echo 'readonly';
              } ?> required>
          </div>

          <div class="cv">
            <label for="civilstatus">Civil Status: </label>
            <select name="civilstatus" class="datainsert" required>
              <option value="" class="cvopt">Select</option>
              <option value="Single" <?php if ($civilstatus == 'Single') {
                echo 'selected';
              } ?>>Single</option>
              <option value="Married" <?php if ($civilstatus == 'Married') {
                echo 'selected';
              } ?>>Married</option>
              <option value="Widowed" <?php if ($civilstatus == 'Widowed') {
                echo 'selected';
              } ?>>Widowed</option>
              <option value="Separated" <?php if ($civilstatus == 'Separated') {
                echo 'selected';
              } ?>>Separated</option>
              <option value="Divorced" <?php if ($civilstatus == 'Divorced') {
                echo 'selected';
              } ?>>Divorced</option>
            </select>
          </div>

          <div>
            <button type="button" class="textboxadd" onclick="showAddressForm()">Address Details</button>
            <input type="text" name="addressID" class="textboxaddinput" value="<?php echo $addressID; ?>"
              placeholder="Address ID" readonly>

            <div id="popup">
              <h2>Address Details Form</h2>
              <div>
                <label for="street">Street:</label>
                <input type="text" name="street" id="modal-street-input" placeholder="Street"
                  value="<?php echo $street; ?>" maxlength="50"
                  oninput="checkAlphabeticbirth(this); this.value = toUpperCaseFirst(this.value);" required>
              </div>
              <div>
                <label for="purok">Purok:</label>
                <input type="text" name="purok" id="modal-purok-input" placeholder="Purok" value="<?php echo $purok; ?>"
                  maxlength="50" oninput="checkAlphabeticbirth(this); this.value = toUpperCaseFirst(this.value);"
                  required>
              </div>
              <div>
                <label for="barangay">Barangay:</label>
                <input type="text" name="barangay" id="modal-barangay-input" placeholder="Barangay"
                  value="<?php echo $barangay; ?>" maxlength="50"
                  oninput="checkAlphabeticbirth(this); this.value = toUpperCaseFirst(this.value);" required>
              </div>
              <div>
                <label for="city">City/Municipality:</label>
                <select name="city" id="modal-city-input" required>
                  <option value="" selected disabled>City/Municipality</option>
                  <optgroup label="South Cotabato">
                    <option value="General Santos City">General Santos City</option>
                    <option value="Koronadal City">Koronadal City</option>
                    <option value="Banga">Banga</option>
                    <option value="Lake Sebu">Lake Sebu</option>
                    <option value="Norala">Norala</option>
                    <option value="Polomolok">Polomolok</option>
                    <option value="Santo Niño">Santo Niño</option>
                    <option value="Surallah">Surallah</option>
                    <option value="Tampakan">Tampakan</option>
                    <option value="Tantangan">Tantangan</option>
                    <option value="Tupi">Tupi</option>
                  </optgroup>
                  <optgroup label="Sultan Kudarat">
                    <option value="Isulan">Isulan</option>
                    <option value="Bagumbayan">Bagumbayan</option>
                    <option value="Esperanza">Esperanza</option>
                    <option value="Kalamansig">Kalamansig</option>
                    <option value="Lambayong">Lambayong</option>
                    <option value="Lebak">Lebak</option>
                    <option value="Lutayan">Lutayan</option>
                    <option value="Palimbang">Palimbang</option>
                    <option value="President Quirino">President Quirino</option>
                    <option value="Sen. Ninoy Aquino">Sen. Ninoy Aquino</option>
                    <option value="Tacurong City">Tacurong City</option>
                  </optgroup>
                  <optgroup label="Sarangani">
                    <option value="Alabel">Alabel</option>
                    <option value="Glan">Glan</option>
                    <option value="Kiamba">Kiamba</option>
                    <option value="Maasim">Maasim</option>
                    <option value="Maitum">Maitum</option>
                    <option value="Malapatan">Malapatan</option>
                  </optgroup>
                </select>
              </div>
              <button type="button" onclick="submitAddressForm()">Submit</button>
              <button type="button" onclick="closeAddressForm()">Close</button>
            </div>

          </div>
          <div>
            <label for="birthdate">Birthdate: </label>
            <input type="date" name="birthdate" class="data-insert" value="<?php echo $birthdate; ?>" required>
          </div>


          <div class="v">
            <label for="birthplace">Birthplace: </label>
            <input type="text" name="birthplace" class="datainsert" value="<?php echo $birthplace; ?>"
              oninput="checkAlphabeticbirth(this); this.value = toUpperCaseFirst(this.value);" required>
          </div>

          <div class="v">
            <label for="father">Father: </label>
            <input type="text" name="father" class="datainsert" value="<?php echo $father; ?>"
              oninput="checkAlphabetic(this); this.value = toUpperCaseFirst(this.value);" required>
          </div>
          <div class="v">
            <label for="mother">Mother: </label>
            <input type="text" name="mother" class="datainsert" value="<?php echo $mother; ?>"
              oninput="checkAlphabetic(this); this.value = toUpperCaseFirst(this.value);" required>
          </div>
          <script>
            function checkAlphabeticbirth(input) {
              var value = input.value;
              if (!/^[a-zA-Z0-9.,\s]*$/g.test(value) && value.length > 0) {
                alert('Invalid input: only letters, numbers, spaces, periods, and commas are allowed.');
                input.value = input.value.replace(/[^a-zA-Z0-9.,\s]/g, '');
              }
            }
          </script>


          <script>
            function toUpperCaseFirst(str) {
              return str.toLowerCase().split(' ').map(function (word) {
                return word.charAt(0).toUpperCase() + word.slice(1);
              }).join(' ');
            }
          </script>
          <script>
            function checkAlphabetic(input) {
              var value = input.value;
              if (!/^[a-zA-Z.\s]*$/g.test(value) && value.length > 0) {
                alert('Invalid input: only letters and spaces are allowed.');
                input.value = input.value.replace(/[^a-zA-Z.\s]/g, '');
              }
            }
          </script>


          <div>
            <label for="educlevel">Education Level: </label>
            <select name="educlevel" class="data-insert" required>
              <option value="">Select</option>
              <option value="Elementary Graduate" <?php if ($educlevel == 'Elementary Graduate') {
                echo 'selected';
              } ?>>
                Elementary Graduate</option>
              <option value="Elementary Undergraduate" <?php if ($educlevel == 'Elementary Undergraduate') {
                echo 'selected';
              } ?>>Elementary Undergraduate</option>
              <option value="High School Graduate" <?php if ($educlevel == 'High School Graduate') {
                echo 'selected';
              } ?>>
                High School Graduate</option>
              <option value="High School Undergraduate" <?php if ($educlevel == 'High School Undergraduate') {
                echo 'selected';
              } ?>>High School Undergraduate</option>
              <option value="College Graduate" <?php if ($educlevel == 'College Graduate') {
                echo 'selected';
              } ?>>College
                Graduate</option>
              <option value="College Undergraduate" <?php if ($educlevel == 'College Undergraduate') {
                echo 'selected';
              } ?>>College Undergraduate</option>
            </select>
          </div>
          <div class="v">
            <label for="contactnumber">Contact Number: </label>
            <input type="text" name="contactnumber" class="datainsert" placeholder="9XXXXXXXXX" pattern="9[0-9]{9}"
              value="<?php echo substr($contactnumber, -10); ?>" required>
            <input type="hidden" name="prefix" value="09" readonly>
          </div>

          <input type="submit" name="submit" class="sub_btn" value="SAVE">
          <a href='showmemberdetails.php?page=1' class="sub_btns">VIEW</a>
          <input type="reset" class="sub_btnss" value="CLEAR">
          <a href='/church_member/login_register/logout.php?' class="out_btns">LOGOUT</a>
        </div>
      </form>


    </div>
  </div>


  <style>
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

    .textboxadd {
      padding: 10px;
      color: black;
      border-radius: 5px;
      font-weight: bold;
      background-color: white;
      font-size: 15px;
      border: none;
    }

    .textboxadd:hover {
      background-color: lightcyan;
    }

    .textboxaddlabel {
      padding: 10px;
      color: black;
      margin-left: 40pt;
      border-radius: 5px;
      margin-right: none;
      font-weight: bold;
      background-color: none;
    }

    .textboxaddinput {
      padding: 5px;
      width: 15vw;
      margin-top: 1vh;
      margin-left: 1vw;
      margin-bottom: none;
    }
  </style>

  <script>

    function memberIDKeyUp(id) {
      if (id) {
        $.ajax({
          url: "getMembername.php",
          method: "POST",
          data: { id: id },
          dataType: "json",
          success: function (data) {
            if (data.fname !== undefined && data.lname !== undefined) {
              $("#memberName").text(data.fname + " " + data.lname);
            } else {
              $("#memberName").text("Member ID not found.");
            }
          }
        });
      } else {
        $("#memberName").text("");
      }
    }

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


    function showAddressForm() {
      // Get the stored address details
      var street = "<?php echo $street; ?>";
      var purok = "<?php echo $purok; ?>";
      var barangay = "<?php echo $barangay; ?>";
      var city = "<?php echo $city; ?>";

      // Populate the address form with the stored data
      $("#modal-street-input").val(street);
      $("#modal-purok-input").val(purok);
      $("#modal-barangay-input").val(barangay);
      $("#modal-city-input").val(city);

      // Show the address form
      $("#popup").show();
    }

    function closeAddressForm() {
      $("#popup").hide();
    }

    function submitAddressForm() {
      var street = $("#modal-street-input").val();
      var purok = $("#modal-purok-input").val();
      var barangay = $("#modal-barangay-input").val();
      var city = $("#modal-city-input").val();

      if (street.trim() !== "" && purok.trim() !== "" && barangay.trim() !== "" && city.trim() !== "") {
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

</body>

</html>