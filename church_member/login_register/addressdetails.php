<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>ADDRESS INFO</title>
    <link rel="stylesheet" type="text/css" href="/church_member/churches/churchshow.css">
</head>

<body>
    <div style="position: relative;">
        <img src="/church_member/images/SDALogo.png" alt="SDA Logo"
            style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; height: 10vh; width: 6vw; margin-left: 5vw; margin-top:2.5vh;">
    </div>
    <div class="title">
        <h1>ADDRESS INFO</h1>
    </div>

    <div class="options">
        <ul>
            <div>
                <a href='/church_member/login_register/home.php?' class="lefthomebtn">HOME</a>
            </div>

            <div>
                <button class="addnew" onclick="showAddressAddForm()">Add New</button>
            </div>
            <div>
                <form action="" method="POST">
                    <input type="text" id="searchID" name="searchID" placeholder="Search ID">
                    <input type="text" id="searchaddress" name="searchaddress" placeholder="Search Address">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>
            <div>
                <a href='addressdetails.php?viewData=true'>View Data</a>
            </div>
            <div>
                <a href='/church_member/login_register/home.php'>Back</a>
            </div>
        </ul>
    </div>

    <div id="popup" style="
        display:none;
        position:absolute;
        top:60%;
        left:10%;
        color:white;
        transform:translate(-50%,-50%);
        background-color:rgb(1, 25, 83);
        border-radius:10px;
        width: 240px;
        height: 400px;
        text-decoration: none;
        z-index:1;">


        <style>
            .contents .data-insertoption {

                padding: 12px;
                outline: none;
                border: 1px;
                font-size: 12pt;
                border-radius: 5px;
                align-items: center;
                justify-content: center;
                width: 13vw;
                margin: 10pt;
                margin-left: 15pt;
            }


            .options ul {
                list-style: none;
                background: #020004;
                padding: 0;
                margin-bottom: 20pt;
                margin-top: -20pt;
                text-align: right;
            }

            .title {
                width: 100vw;
                background-color: rgb(1, 25, 83);
                color: rgb(254, 245, 166);

                margin-top: 1.1vh;
            }

            .title h1 {
                font-family: 'Franklin Gothic Medium';
                font-size: 60px;
                letter-spacing: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
                margin-top: 1.1vh;
            }

            .options .lefthomebtn {
                margin-left: -23.5vw;
            }

            form .sub_btn {
                margin-top: 2pt;
            }

            form .sub_btns {
                margin-top: 2pt;
            }
        </style>


        <div class="contents">
            <form action="" method="POST">
                <label class="labelmin"> ADDRESS INFO </label>
                <div>
                    <input type="hidden" id="addressID" name="addressID" class="data-insert" value="">
                    <br>
                </div>
                <div>
                    <input type="text" id="street" name="street" class="data-insert" placeholder="Enter Street" required
                        oninput="checkInput(this); this.value = toUpperCaseFirst(this.value);">
                    <br>
                </div>
                <div>
                    <input type="text" id="purok" name="purok" class="data-insert" placeholder="Enter Purok" required
                        oninput="checkInput(this); this.value = toUpperCaseFirst(this.value);"><br>
                </div>
                <div>
                    <input type="text" id="barangay" name="barangay" class="data-insert" placeholder="Enter Barangay"
                        required oninput="checkInput(this); this.value = toUpperCaseFirst(this.value);">
                </div>
                <div>
                    <select id="city" name="city" class="data-insert" style="width:13vw;" required>
                        <option value="" selected disabled>City/Municipality</option>
                        <optgroup label="Davao Occidental">
                            <option value="Malita">Malita</option>
                            <option value="Santa Maria">Santa Maria</option>
                            <option value="Don Marcelino">Don Marcelino</option>
                            <option value="Jose Abad Santos">Jose Abad Santos</option>
                        </optgroup>
                        <optgroup label="Maguindanao">
                            <option value="Ampatuan">Ampatuan</option>
                            <option value="Buluan">Buluan</option>
                            <option value="Datu Odin Sinsuat">Datu Odin Sinsuat</option>
                            <option value="Pagalungan">Pagalungan</option>
                            <option value="Rajah Buayan">Rajah Buayan</option>
                            <option value="Shariff Aguak">Shariff Aguak</option>
                            <option value="Talayan">Talayan</option>
                        </optgroup>
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
                        <optgroup label="Cotabato">
                            <option value="Kidapawan City">Kidapawan City</option>
                            <option value="Kabacan">Kabacan</option>
                            <option value="Midsayap">Midsayap</option>
                            <option value="Pigcawayan">Pigcawayan</option>
                            <option value="Makilala">Makilala</option>
                            <option value="Banisilan">Banisilan</option>
                            <option value="Carmen">Carmen</option>
                            <option value="Kabuntalan">Kabuntalan</option>
                            <option value="Datu Montawal">Datu Montawal</option>
                            <option value="Datu Piang">Datu Piang</option>
                            <option value="Datu Saudi-Ampatuan">Datu Saudi-Ampatuan</option>
                            <option value="Datu Unsay">Datu Unsay</option>
                            <option value="Mamasapano">Mamasapano</option>
                            <option value="Mangudadatu">Mangudadatu</option>
                            <option value="Pagalungan">Pagalungan</option>
                            <option value="Shariff Saydona Mustapha">Shariff Saydona Mustapha</option>
                            <option value="Sultan sa Barongis">Sultan sa Barongis</option>
                            <option value="Talitay">Talitay</option>
                            <option value="Upi">Upi</option>
                        </optgroup>
                    </select>

                </div>

                <script>
                    function checkInput(input) {
                        var value = input.value;
                        if (!/^[a-zA-Z.\s]*$/.test(value)) {
                            alert('Invalid input: only letters and spaces are allowed.');
                            input.value = input.value.replace(/[^a-zA-Z.\s]/g, '');
                        }
                    }

                    function checkInputLocation(input) {
                        var value = input.value;
                        if (!/^[a-zA-Z0-9.,\-\s]*$/.test(value)) {
                            alert('Invalid input: only letters, numbers, period, comma, and dash are allowed.');
                            input.value = input.value.replace(/[^a-zA-Z0-9.,\-\s]/g, '');
                        }
                    }

                    function toUpperCaseFirst(str) {
                        var words = str.split(' ');
                        for (var i = 0; i < words.length; i++) {
                            words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
                        }
                        return words.join(' ');
                    }
                </script>




                <!-- Hidden input field for old addressID value -->
                <input type="hidden" id="old_addressID" name="old_addressID">

                <button type="submit" name="save" class="sub_btn">Save</button>
                <button type="button" onclick="hideAddressAddForm()" class="sub_btns">Cancel</button>
            </form>
        </div>
    </div>

</body>

</html>


<?php
// Include the database connection file
include "connection.php";

// Check if the save button has been clicked
if (isset($_POST['save'])) {
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $purok = mysqli_real_escape_string($conn, $_POST['purok']);
    $barangay = mysqli_real_escape_string($conn, $_POST['barangay']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $old_addressID = mysqli_real_escape_string($conn, $_POST['old_addressID']);
    $addressID = mysqli_real_escape_string($conn, $_POST['addressID']);

    // Check if address name has been modified
    if ($old_addressID === '') {
        // Inserting a new record, so check for existing address name
        $result = mysqli_query($conn, "SELECT * FROM address WHERE addressID='$addressID'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $street = $row['street'];
            $purok = $row['purok'];
            $barangay = $row['barangay'];
            $city = $row['city'];
            echo "<script>";
            echo "alert('The Address already exists in the table.');";
            echo "document.getElementById('addressID').value = '" . $addressID . "';";
            echo "document.getElementById('street').value = '" . $street . "';";
            echo "document.getElementById('purok').value = '" . $purok . "';";
            echo "document.getElementById('barangay').value = '" . $barangay . "';";
            echo "document.getElementById('city').value = '" . $city . "';";
            echo "document.getElementById('popup').style.display = 'block';";
            echo "</script>";
        } else {
            // Insert the new record into the database
            $query = "INSERT INTO address (street, purok, barangay, city) VALUES ('$street', '$purok', '$barangay', '$city')";
            mysqli_query($conn, $query);
        }
    } else {
        // Updating an existing record, so check for existing church name with different value
        if ($addressID !== $old_addressID) {
            $result = mysqli_query($conn, "SELECT * FROM address WHERE addressID='$addressID' AND addressID != '$old_addressID'");
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $street = $row['street'];
                $purok = $row['purok'];
                $barangay = $row['barangay'];
                $city = $row['city'];
                echo "<script>";
                echo "alert('The Address already exists in the table.');";
                echo "document.getElementById('addressID').value = '" . $old_addressID . "';";
                echo "document.getElementById('street').value = '" . $street . "';";
                echo "document.getElementById('purok').value = '" . $purok . "';";
                echo "document.getElementById('barangay').value = '" . $barangay . "';";
                echo "document.getElementById('city').value = '" . $city . "';";
                echo "document.getElementById('popup').style.display = 'block';";
                echo "</script>";
            } else {
                // Update the existing record in the database
                $query = "UPDATE address SET street='$street', purok='$purok', barangay='$barangay', city='$city' WHERE addressID='$old_addressID'";
                mysqli_query($conn, $query);
            }
        } else {
            // Address name has not been changed, update the existing record as before
            // Check if any fields were actually changed
            $result = mysqli_query($conn, "SELECT * FROM address WHERE addressID='$old_addressID'");
            $oldValues = mysqli_fetch_assoc($result);
            if ($oldValues['street'] == $street && $oldValues['purok'] == $purok && $oldValues['barangay'] == $barangay && $oldValues['city'] == $city) {
                // No fields have been changed
                echo "<script>alert('No changes have been made.');window.location.href ='addressdetails.php';</script>";
                exit;
            } else {
                // At least one field has been changed, update the record in the database
                $query = "UPDATE address SET street='$street', purok='$purok', barangay='$barangay', city='$city' WHERE addressID='$old_addressID'";
                mysqli_query($conn, $query);
            }
        }
    }
}


// If delete button has been clicked
if (isset($_GET['delete']) && $_GET['delete'] == 'true' && isset($_GET['addressID'])) {
    $addressID = $_GET['addressID'];

    // TODO: sanitize and validate $addressID

    // Perform the delete query
    $sql = "DELETE FROM address WHERE addressID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $addressID);
    $stmt->execute();

    // TODO: handle any errors or success messages
}

if (isset($_POST['search'])) {
    // Retrieve search input values
    $searchID = mysqli_real_escape_string($conn, $_POST['searchID']);
    $searchaddress = mysqli_real_escape_string($conn, $_POST['searchaddress']);

    // Define filter parameters
    $where = "";
    if (!empty($searchID)) {
        $where .= "addressID LIKE '%$searchID%' AND ";
    }
    if (!empty($searchaddress)) {

        $where .= "(street LIKE '%$searchaddress%' OR purok LIKE '%$searchaddress%' OR barangay LIKE '%$searchaddress%' OR city LIKE '%$searchaddress%') AND ";

    }
    if (!empty($where)) {
        // Remove trailing "AND" from where clause
        $where = substr($where, 0, -5);
        $where = "WHERE " . $where;
    }

    // Define SQL query with filter parameters
    $query = "SELECT * FROM address $where";

    // Handle sorting
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'addressID';
    $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
    if (isset($_GET['sort']) && $sort == $_GET['sort'] && $order == 'asc') {
        $order = 'desc';
    } else {
        $order = 'asc';
    }
    $query .= " ORDER BY $sort $order";

    // Execute the search query
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='container'>";
        echo "<table border='1' cellpadding='0'>";
        echo "<tr>";
        echo "<th><a href=\"addressdetails.php?sort=addressID&order=$order\">ID</a></th>";
        echo "<th><a href=\"addressdetails.php?sort=street&order=$order\">Street</a></th>";
        echo "<th><a href=\"addressdetails.php?sort=purok&order=$order\">Purok</a></th>";
        echo "<th><a href=\"addressdetails.php?sort=barangay&order=$order\">Barangay</a></th>";
        echo "<th><a href=\"addressdetails.php?sort=city&order=$order\">City</a></th>";
        echo "<th>Operation</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['addressID'] . "</td>";
            echo "<td>" . $row['street'] . "</td>";
            echo "<td>" . $row['purok'] . "</td>";
            echo "<td>" . $row['barangay'] . "</td>";
            echo "<td>" . $row['city'] . "</td>";
            echo "<td>
                <a href='#' onclick='editAddress(\"" . $row['addressID'] . "\",\"" . $row['street'] . "\",\"" . $row['purok'] . "\",\"" . $row['barangay'] . "\",\"" . $row['city'] . "\"); return false;' class='opt'>Edit</a>
                <a href='addressdetails.php?delete=true&addressID=" . $row['addressID'] . "&street=" . $row['purok'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? " . $row['addressID'] . " " . $row['street'] . "\")'>Delete</a>
            </td>";
            echo "</tr>";
        }
        echo "</table></div>";
    } else {
        // Check if search inputs are not empty
        if (!empty($searchID) || !empty($searchaddress)) {
            echo '<div
                style="display: flex;
                justify-content: center;
                align-items: center;
                background-color: #f1f1f1;
                padding: 20px;">';
            echo '<span style="color: red;">No results found.</span>';
            echo '</div>';
        }
    }
} else {
    // Retrieve church records from the database
    $query = "SELECT * FROM address";
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'addressID';
    $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
    $query .= " ORDER BY $sort $order";
    $result = mysqli_query($conn, $query);

    // Display all stored data automatically
    if (isset($_GET['viewData']) || !isset($_POST['search'])) {
        ?>
        <div class="container">
            <table border="1" cellpadding="0">
                <tr>
                    <th><a
                            href="addressdetails.php?sort=addressID&order=<?php echo $sort == 'addressID' && $order == 'asc' ? 'desc' : 'asc'; ?>">ID</a>
                    <th><a
                            href="addressdetails.php?sort=street&order=<?php echo $sort == 'street' && $order == 'asc' ? 'desc' : 'asc'; ?>">Street</a>
                    <th><a
                            href="addressdetails.php?sort=purok&order=<?php echo $sort == 'purok' && $order == 'asc' ? 'desc' : 'asc'; ?>">Purok</a>
                    <th><a
                            href="addressdetails.php?sort=barangay&order=<?php echo $sort == 'barangay' && $order == 'asc' ? 'desc' : 'asc'; ?>">Barangay</a>
                    <th><a
                            href="addressdetails.php?sort=city&order=<?php echo $sort == 'city' && $order == 'asc' ? 'desc' : 'asc'; ?>">City</a>

                    <th>Operation</th>
                </tr>

                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['addressID'] . "</td>";
                    echo "<td>" . $row['street'] . "</td>";
                    echo "<td>" . $row['purok'] . "</td>";
                    echo "<td>" . $row['barangay'] . "</td>";
                    echo "<td>" . $row['city'] . "</td>";

                    echo "<td>
                    <a href='#' onclick='editAddress(\"" . $row['addressID'] . "\",\"" . $row['street'] . "\",\"" . $row['purok'] . "\",\"" . $row['barangay'] . "\",\"" . $row['city'] . "\"); return false;' class='opt'>Edit</a>
                
                    <a href='addressdetails.php?delete=true&addressID=" . $row['addressID'] . "&street=" . $row['purok'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? " . $row['addressID'] . " " . $row['street'] . "\")'>Delete</a>
                    
                    </td>";
                    echo "</tr>";
                }
                ?>

            </table>
        </div>

        <?php
    }
}
?>



<script>
    function showAddressAddForm() {
        // Clear the form and display the pop-up
        document.getElementById("street").value = "";
        document.getElementById("purok").value = "";
        document.getElementById("barangay").value = "";
        document.getElementById("city").value = "";
        document.getElementById("old_addressID").value = "";

        document.getElementById("popup").style.display = "block";
    }

    function hideAddressAddForm() {
        // Hide the pop-up
        document.getElementById("popup").style.display = "none";
    }

    function editAddress(addressID, street, purok, barangay, city) {
        // Populate the form with the record values and display the pop-up
        document.getElementById("addressID").value = addressID;
        document.getElementById("street").value = street;
        document.getElementById("purok").value = purok;
        document.getElementById("barangay").value = barangay;
        document.getElementById("city").value = city;
        document.getElementById("old_addressID").value = addressID;

        document.getElementById("popup").style.display = "block";
    }
</script>