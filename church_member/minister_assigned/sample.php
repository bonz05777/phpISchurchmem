<?php
// Use output buffering
ob_start();

// Include the database connection file
include "connection.php";


// Initialize variables
$ministerID = "";
$districtname = "";
$year = "";
$oldMinisterID = "";
$oldYear = "";


// Save data to database
if (isset($_POST['save'])) {
    $ministerID = $_POST['ministerID'];
    $districtname = $_POST['districtname'];
    $year = $_POST['year'];
    $oldMinisterID = $_POST['oldMinisterID'];
    $oldYear = $_POST['oldYear'];

    if (!$ministerID || !$districtname || !$year) {
        // Validate form input
        echo "<script>alert('Please fill in all fields.');</script>";
    } else {
        // Check if ministerID is present in the minister table before inserting
        $query = "SELECT * FROM minister WHERE ministerID='$ministerID'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Check if the minister ID and year already exist in the minister_assigned table
            $query = "SELECT * FROM minister_assigned WHERE ministerID='$ministerID' AND year='$year'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 0 || ($ministerID == $oldMinisterID && $year == $oldYear)) {
                if ($oldMinisterID && $oldYear) {
                    // Update the existing record
                    $query = "UPDATE minister_assigned SET districtname='$districtname', year='$year' WHERE ministerID='$oldMinisterID' AND year='$oldYear'";
                    mysqli_query($conn, $query);
                } else {
                    // Insert a new record
                    $query = "INSERT INTO minister_assigned (ministerID, districtname, year) VALUES ('$ministerID', '$districtname', '$year')";
                    mysqli_query($conn, $query);

                }
            } else {
                echo "<script>alert('Combination of Minister ID and Year already exists.');</script>";
            }
        } else {
            echo "<script>alert('Minister ID is not found in the minister table.');</script>";
        }
    }
}


// Delete data from database
if (isset($_GET['delete'])) {
    $ministerID = $_GET['ministerID'];
    $year = $_GET['year'];

    $query = "DELETE FROM minister_assigned WHERE ministerID='$ministerID' AND year='$year'";
    mysqli_query($conn, $query);
}


// Retrieve minister_assigned records from the database
$searchQuery = "";
if (isset($_GET['search'])) {
    $searchID = $_GET['searchID'];
    $searchdistrictname = $_GET['searchdistrictname'];
    $searchYear = $_GET['searchYear'];

    // Construct the search query with ID and/or name filters
    $query = "SELECT * FROM minister_assigned WHERE 1 = 1 ";
    if (!empty($searchID)) {
        $query .= "AND ministerID = '$searchID' ";
        $searchQuery .= "&searchID=" . $searchID;
    }
    if (!empty($searchdistrictname)) {
        $query .= "AND districtname = '$searchdistrictname'";
        $searchQuery .= "&searchdistrictname=" . $searchdistrictname;
    }
    if (!empty($searchYear)) {
        $query .= "AND year = '$searchYear' ";
        $searchQuery .= "&searchYear=" . $searchYear;
    }

    // Execute the search query
    $result = mysqli_query($conn, $query);

} else if (isset($_GET['ministerID'])) {
    $ministerID = $_GET['ministerID'];
    $query = "SELECT * FROM minister_assigned WHERE ministerID='$ministerID'";
    $result = mysqli_query($conn, $query);

} else {
    $query = "SELECT * FROM minister_assigned";
    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MINISTER ASSIGNMENT</title>
    <link rel="stylesheet" type="text/css" href="/church_member/minister_info/styleministershow.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="title">
        <h1>MINISTER ASSIGNMENT</h1>
    </div>

    <div class="options">
        <ul>
            <div>
                <a href='/church_member/login_register/home.php?'>HOME</a>
            </div>

            <div>
                <button class="addnew" onclick="showAddForm()">Add New</button>
            </div>
            <div>
                <form action="" method="GET">
                    <style>
                        .i {
                            width: 5vw;
                        }

                        .d {
                            width: 8vw;
                        }

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
                    </style>

                    <input class="i" type="text" id="searchID" name="searchID" placeholder="Search ID">
                    <input class="d" type="text" id="searchdistrictname" name="searchdistrictname"
                        placeholder="Search District Name">
                    <input class="i" type="text" id="searchYear" name="searchYear" placeholder="Search Year">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>
            <div>
                <a href='ministerassigned.php?viewData=true'>View Data</a>
            </div>
            <div>
                <a href='/church_member/login_register/home.php'>Back</a>
            </div>
        </ul>
    </div>

    <div id="FormPopup" style="
      display: none;
      position: absolute;
      top:60%;
      left:12%;
      color:white;
      transform:translate(-50%,-50%);
      background-color:rgb(1, 25, 83);
      border-radius:10px;
      width: 240px;
      height: 350px;
      text-decoration: none;
      z-index:1;">

        <div class="contents">
            <form action="" method="POST">
                <label class="labelmin">ADD NEW RECORD</label>

                <span id="ministerNameLabel" style="
        font-size: 12px; 
        color: yellow;
        margin-left: 10pt;
        
        ">Minister Name:</span>

                <span id="ministerName" style="
        font-size: 12px; 
        color: yellow;
        margin-left: 3pt;
        "></span>



                <div>
                    <input type="hidden" id="oldMinisterID" name="oldMinisterID" class="data-insert">
                    <input type="hidden" id="oldYear" name="oldYear" class="data-insert">
                    <input type="text" id="ministerID" name="ministerID" class="data-insert"
                        placeholder="Enter Minister ID" onkeyup="ministerIDKeyUp(this.value)" required>
                    <br>
                </div>

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


                <div>
                    <input type="number" id="year" name="year" class="data-insert" placeholder="Enter Year" required>
                    <br>
                </div>

                <button type="submit" name="save" class="sub_btn">Save</button>
                <button type="button" onclick="hideAddForm()" class="sub_btns">Cancel</button>
            </form>
        </div>
    </div>

    <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='container'>";
        echo "<table border='1' cellpadding='0'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>District Name</th>";
        echo "<th>Year</th>";

        echo "<th>Operation</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['ministerID'] . "</td>";
            echo "<td>" . $row['districtname'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";

            echo "<td>
        <a href='javascript:showEditForm(\"" . $row['ministerID'] . "\", \"" . $row['year'] . "\", \"" . $row['districtname'] . "\")' class='opt'>Edit</a>
        <a href='ministerassigned.php?delete=true&ministerID=" . $row['ministerID'] . "&year=" . $row['year'] . "' class='opt1'>Delete</a>
        </td>";
            echo "</tr>";
        }
    } else {
        echo '<div style=" display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f1f1f1;
        padding: 20px;">';
        echo '<span style="color: red;">
        No results found.
        </span>';
        echo '</div>';
    }
    ?>
    </table>
    </div>

    <script>
        // AJAX call to fetch minister's first and last name from the minister table
        function ministerIDKeyUp(ministerID) {
            if (ministerID) {
                $.ajax({
                    url: "getMinisterName.php",
                    method: "POST",
                    data: {
                        ministerID: ministerID
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data !== null) {
                            $("#ministerName").text(data.ministerfname + " " + data.ministerlname);
                        } else {
                            $("#ministerName").text("Minister ID not found.");
                        }
                    }
                });
            } else {
                $("#ministerName").text("");
            }
        }

        function showAddForm() {
            $("form")[0].reset();
            document.getElementById("FormPopup").style.display = "block";
        }

        function hideAddForm() {
            document.getElementById("FormPopup").style.display = "none";
        }

        function showEditForm(ministerID, year, districtname) {
            document.getElementById("oldMinisterID").value = ministerID;
            document.getElementById("oldYear").value = year;
            document.getElementById("ministerID").value = ministerID;
            document.getElementById("districtname").value = districtname;
            document.getElementById("year").value = year;
            ministerIDKeyUp(ministerID);
            document.getElementById("FormPopup").style.display = "block";
        }
    </script>
</body>

</html>