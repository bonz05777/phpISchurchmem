<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>CHURCHES INFO</title>
    <link rel="stylesheet" type="text/css" href="churchshow.css">
</head>

<body>
    <div style="position: relative;">
        <img src="/church_member/images/SDALogo.png" alt="SDA Logo"
            style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; height: 10vh; width: 6vw; margin-left: 5vw; margin-top:2.5vh;">
    </div>
    <div class="title">
        <h1>CHURCHES INFO</h1>
    </div>

    <div class="options">
        <ul>
            <div>
                <a href='/church_member/login_register/home.php?' class="lefthomebtn">HOME</a>
            </div>

            <div>
                <button class="addnew" onclick="showOfficeAddForm()">Add New</button>
            </div>
            <div>
                <form action="" method="POST">
                    <input type="text" id="searchChurch" name="searchChurch" placeholder="Search Church">
                    <input type="text" id="searchDName" name="searchDName" placeholder="Search District">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>
            <div>
                <a href='churchesaddshow.php?viewData=true'>View Data</a>
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
        left:12%;
        color:white;
        transform:translate(-50%,-50%);
        background-color:rgb(1, 25, 83);
        border-radius:10px;
        width: 240px;
        height: 340px;
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
        </style>


        <div class="contents">
            <form action="" method="POST">
                <label class="labelmin"> CHURCH INFO </label>


                <div>
                    <input type="text" id="churchname" name="churchname" class="data-insert" placeholder="Enter Church"
                        required oninput="checkInput(this); this.value = toUpperCaseFirst(this.value);">
                    <br>
                </div>
                <div>
                    <input type="text" id="location" name="location" class="data-insert" placeholder="Enter Location"
                        required oninput="checkInputLocation(this); this.value = toUpperCaseFirst(this.value);">
                    <br>
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


                <select id="districtname" name="districtname" class="data-insertoption" required>
                    <option value="" disabled selected hidden>Choose District</option>
                    <option value="Davao City Central District">Davao City Central District</option>
                    <option value="Davao City East District">Davao City East District</option>
                    <option value="Davao City North District">Davao City North District</option>
                    <option value="Davao City South District">Davao City South District</option>
                    <option value="Davao City West District">Davao City West District</option>
                    <option value="Davao del Norte District">Davao del Norte District</option>
                    <optgroup label="Davao del Norte District Subdistricts">
                        <option value="Asuncion District">Asuncion District</option>
                        <option value="Carmen District">Carmen District</option>
                        <option value="Kapalong District">Kapalong District</option>
                        <option value="New Corella District">New Corella District</option>
                        <option value="Panabo District">Panabo District</option>
                    </optgroup>
                    <option value="Davao del Sur District">Davao del Sur District</option>
                    <optgroup label="Davao del Sur District Subdistricts">
                        <option value="Bansalan District">Bansalan District</option>
                        <option value="Digos District">Digos District</option>
                        <option value="Hagonoy District">Hagonoy District</option>
                        <option value="Magsaysay District">Magsaysay District</option>
                        <option value="Matanao District">Matanao District</option>
                        <option value="Padada District">Padada District</option>
                        <option value="Sta. Cruz District">Sta. Cruz District</option>
                    </optgroup>
                    <option value="Davao Occidental District">Davao Occidental District</option>
                    <optgroup label="Davao Occidental District Subdistricts">
                        <option value="Don Marcelino District">Don Marcelino District</option>
                        <option value="Jose Abad Santos District">Jose Abad Santos District</option>
                        <option value="Malita District">Malita District</option>
                        <option value="Santa Maria District">Santa Maria District</option>
                    </optgroup>
                    <option value="Davao Oriental District">Davao Oriental District</option>
                    <optgroup label="Davao Oriental District Subdistricts">
                        <option value="Baganga District">Baganga District</option>
                        <option value="Boston District">Boston District</option>
                        <option value="Caraga District">Caraga District</option>
                        <option value="Cateel District">Cateel District</option>
                        <option value="Lupon District">Lupon District</option>
                        <option value="Manay District">Manay District</option>
                        <option value="Mati District">Mati District</option>
                    </optgroup>
                    <option value="General Santos District">General Santos District</option>
                    <optgroup label="General Santos District Subdistricts">
                        <option value="Apopong District">Apopong District</option>
                        <option value="Dadiangas East District">Dadiangas East District</option>
                        <option value="Dadiangas North District">Dadiangas North District</option>
                        <option value="Dadiangas West District">Dadiangas West District</option>
                        <option value="Metro Gensan North District">Metro Gensan North District</option>
                        <option value="Metro Gensan West 1 District">Metro Gensan West 1 District</option>
                        <option value="Metro Gensan West 2 District">Metro Gensan West 2 District</option>
                        <option value="Polomolok District">Polomolok District</option>
                        <option value="Silway-8 District">Silway-8 District</option>
                        <option value="Tambler District">Tambler District</option>
                    </optgroup>
                    <option value="North Cotabato District">North Cotabato District</option>
                    <option value="Sarangani District">Sarangani District</option>
                    <optgroup label="Sarangani District Subdistricts">
                        <option value="Alabel District">Alabel District</option>
                        <option value="Glan District">Glan District</option>
                    </optgroup>
                    <option value="South Cotabato District">South Cotabato District</option>
                    <optgroup label="South Cotabato District Subdistricts">
                        <option value="Koronadal Central District">Koronadal Central District</option>
                        <option value="Koronadal East District">Koronadal East District</option>
                        <option value="Koronadal West District">Koronadal West District</option>
                        <option value="Norala District">Norala District</option>
                        <option value="Tboli District">Tboli District</option>
                        <option value="Tampakan District">Tampakan District</option>
                        <option value="Tupi District">Tupi District</option>
                    </optgroup>
                    <option value="Sultan Kudarat District">Sultan Kudarat District</option>
                    <optgroup label="Sultan Kudarat District Subdistricts">
                        <option value="Bagumbayan District">Bagumbayan District</option>
                        <option value="Esperanza District">Esperanza District</option>
                        <option value="Isulan District">Isulan District</option>
                        <option value="Kalamansig District">Kalamansig District</option>
                        <option value="Lambayong District">Lambayong District</option>
                        <option value="Lebak District">Lebak District</option>
                        <option value="Lutayan District">Lutayan District</option>
                        <option value="Senator Ninoy Aquino District">Senator Ninoy Aquino District</option>
                    </optgroup>
                    <option value="Surigao District">Surigao District</option>
                    <optgroup label="Surigao District Subdistricts">
                        <option value="Caraga District">Caraga District</option>
                    </optgroup>
                    <option value="Tagum City District">Tagum City District</option>
                    <optgroup label="Tagum City District Subdistricts">
                        <option value="Carmen District">Carmen District</option>
                        <option value="Kapalong District">Kapalong District</option>
                        <option value="San Isidro District">San Isidro District</option>
                        <option value="Tagum Central District">Tagum Central District</option>
                    </optgroup>
                    <option value="Zamboanga del Norte District">Zamboanga del Norte District</option>
                    <optgroup label="Zamboanga del Norte District Subdistricts">
                        <option value="Dipolog District">Dipolog District</option>
                        <option value="Liloy District">Liloy District</option>
                        <option value="Sindangan District">Sindangan District</option>
                        <option value="Roxas District">Roxas District</option>
                    </optgroup>
                    <option value="Zamboanga del Sur District">Zamboanga del Sur District</option>
                    <optgroup label="Zamboanga del Sur District Subdistricts">
                        <option value="Pagadian City District">Pagadian City District</option>
                        <option value="San Pablo District">San Pablo District</option>
                        <option value="Sominot District">Sominot District</option>
                        <option value="Tigbao District">Tigbao District</option>
                    </optgroup>
                    <option value="Zamboanga Sibugay District">Zamboanga Sibugay District</option>
                    <optgroup label="Zamboanga Sibugay District Subdistricts">
                        <option value="Buug District">Buug District</option>
                        <option value="Diplahan District">Diplahan District</option>
                        <option value="Imelda District">Imelda District</option>
                        <option value="Ipil District">Ipil District</option>
                        <option value="Kalawit District">Kalawit District</option>
                        <option value="Naga District">Naga District</option>
                        <option value="Olutanga District">Olutanga District</option>
                        <option value="Payao District">Payao District</option>
                        <option value="Talusan District">Talusan District</option>
                        <option value="Titay District">Titay District</option>
                        <option value="Tungawan District">Tungawan District</option>
                    </optgroup>
                </select>

                <!-- Hidden input field for old churchname value -->
                <input type="hidden" id="old_churchname" name="old_churchname">

                <button type="submit" name="save" class="sub_btn">Save</button>
                <button type="button" onclick="hideOfficeAddForm()" class="sub_btns">Cancel</button>
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
    $churchname = mysqli_real_escape_string($conn, $_POST['churchname']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $districtname = mysqli_real_escape_string($conn, $_POST['districtname']);
    $old_churchname = mysqli_real_escape_string($conn, $_POST['old_churchname']);

    // Check if church name has been modified
    if ($old_churchname === '') {
        // Inserting a new record, so check for existing church name
        $result = mysqli_query($conn, "SELECT * FROM churches WHERE churchname='$churchname'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $location = $row['location'];
            $districtname = $row['districtname'];
            echo "<script>";
            echo "alert('The Church already exists in the table.');";
            echo "document.getElementById('churchname').value = '" . $churchname . "';";
            echo "document.getElementById('location').value = '" . $location . "';";
            echo "document.getElementById('districtname').value = '" . $districtname . "';";
            echo "document.getElementById('popup').style.display = 'block';";
            echo "</script>";
        } else {
            // Insert the new record into the database
            $query = "INSERT INTO churches (churchname, location, districtname) VALUES ('$churchname', '$location', '$districtname')";
            mysqli_query($conn, $query);
        }
    } else {
        // Updating an existing record, so check for existing church name with different value
        if ($churchname !== $old_churchname) {
            $result = mysqli_query($conn, "SELECT * FROM churches WHERE churchname='$churchname' AND churchname != '$old_churchname'");
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $location = $row['location'];
                $districtname = $row['districtname'];
                echo "<script>";
                echo "alert('The Church already exists in the table.');";
                echo "document.getElementById('churchname').value = '" . $old_churchname . "';";
                echo "document.getElementById('location').value = '" . $location . "';";
                echo "document.getElementById('districtname').value = '" . $districtname . "';";
                echo "document.getElementById('popup').style.display = 'block';";
                echo "</script>";
            } else {
                // Update the existing record in the database
                $query = "UPDATE churches SET churchname='$churchname', location='$location', districtname='$districtname' WHERE churchname='$old_churchname'";
                mysqli_query($conn, $query);
            }
        } else {
            // Church name has not been changed, update the existing record as before
            // Check if any fields were actually changed
            $result = mysqli_query($conn, "SELECT * FROM churches WHERE churchname='$old_churchname'");
            $oldValues = mysqli_fetch_assoc($result);
            if ($oldValues['churchname'] == $churchname && $oldValues['location'] == $location && $oldValues['districtname'] == $districtname) {
                // No fields have been changed
                echo "<script>alert('No changes have been made.');window.location.href ='churchesaddshow.php';</script>";
                exit;
            } else {
                // At least one field has been changed, update the record in the database
                $query = "UPDATE churches SET churchname='$churchname', location='$location', districtname='$districtname' WHERE churchname='$old_churchname'";
                mysqli_query($conn, $query);
            }
        }
    }
}


// If delete button has been clicked
if (isset($_GET['delete']) && $_GET['delete'] == 'true' && isset($_GET['churchname']) && isset($_GET['districtname'])) {
    $churchname = urldecode($_GET['churchname']);
    $districtname = urldecode($_GET['districtname']);

    // TODO: sanitize and validate $churchname and $districtname

    // Perform the delete query
    $sql = "DELETE FROM churches WHERE churchname = ? AND districtname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $churchname, $districtname);
    $stmt->execute();

    // TODO: handle any errors or success messages
}

// If search button has been clicked
if (isset($_POST['search'])) {
    $searchChurch = mysqli_real_escape_string($conn, $_POST['searchChurch']);
    $searchDName = mysqli_real_escape_string($conn, $_POST['searchDName']);

    // Construct the search query with ID and/or name filters
    $query = "SELECT * FROM churches WHERE 1 = 1 ";
    if (!empty($searchChurch)) {
        $query .= "AND churchname LIKE '%$searchChurch%' ";
    }
    if (!empty($searchDName)) {
        $query .= "AND districtname LIKE '%$searchDName%' ";
    }
    // Handle sorting
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'churchname';
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
        echo "<th><a href=\"churchesaddshow.php?sort=churchname&order=$order\">Church</a></th>";
        echo "<th><a href=\"churchesaddshow.php?sort=location&order=$order\">Address</a></th>";
        echo "<th><a href=\"churchesaddshow.php?sort=districtname&order=$order\">District</a></th>";

        echo "<th>Operation</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['churchname'] . "</td>";
            echo "<td>" . $row['location'] . "</td>";
            echo "<td>" . $row['districtname'] . "</td>";
            echo "<td>
    <a href='#' onclick='editChurch(\"" . $row['churchname'] . "\",\"" . $row['location'] . "\",\"" . $row['districtname'] . "\"); return false;' class='opt'>Edit</a>



    <a href='churchesaddshow.php?delete=true&churchname=" . $row['churchname'] . "&districtname=" . $row['districtname'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? " . $row['churchname'] . " " . $row['districtname'] . "\")'>Delete</a>
    
    </td>";
            echo "</tr>";
        }
        echo "</table></div>";
    } else {
        // Check if search inputs are not empty
        if (!empty($searchChurch) || !empty($searchDName)) {
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
    $query = "SELECT * FROM churches";
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'churchname';
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
                            href="churchesaddshow.php?sort=churchname&order=<?php echo $sort == 'churchname' && $order == 'asc' ? 'desc' : 'asc'; ?>">Church</a>
                    <th><a
                            href="churchesaddshow.php?sort=location&order=<?php echo $sort == 'location' && $order == 'asc' ? 'desc' : 'asc'; ?>">Address</a>
                    <th><a
                            href="churchesaddshow.php?sort=districtname&order=<?php echo $sort == 'districtname' && $order == 'asc' ? 'desc' : 'asc'; ?>">District</a>

                    <th>Operation</th>
                </tr>

                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['churchname'] . "</td>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td>" . $row['districtname'] . "</td>";

                    echo "<td>
<a href='#' onclick='editChurch(\"" . $row['churchname'] . "\",\"" . $row['location'] . "\",\"" . $row['districtname'] . "\"); return false;' class='opt'>Edit</a>

<a href='churchesaddshow.php?delete=true&churchname=" . $row['churchname'] . "&districtname=" . $row['districtname'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record?" . $row['churchname'] . " " . $row['districtname'] . "\")'>Delete</a>
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
    function showOfficeAddForm() {
        // Clear the form and display the pop-up
        document.getElementById("churchname").value = "";
        document.getElementById("location").value = "";
        document.getElementById("districtname").value = "";
        document.getElementById("old_churchname").value = "";

        document.getElementById("popup").style.display = "block";
    }

    function hideOfficeAddForm() {
        // Hide the pop-up
        document.getElementById("popup").style.display = "none";
    }

    function editChurch(churchname, location, districtname) {
        // Populate the form with the record values and display the pop-up
        document.getElementById("churchname").value = churchname;
        document.getElementById("location").value = location;
        document.getElementById("districtname").value = districtname;
        document.getElementById("old_churchname").value = churchname;

        document.getElementById("popup").style.display = "block";
    }
</script>