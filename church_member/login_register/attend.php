<?php
// Include the database connection file
include "connection.php";

// Initialize variables
$id = "";
$quarter = "";
$year = "";
$fstattendance = "";
$sndattendance = "";
$trdattendance = "";
$frthattendance = "";
$total = "";

// Check if ID and year combination are set in the URL
if (isset($_GET['id']) && isset($_GET['year'])) {
    $id = $_GET['id'];
    $year = $_GET['year'];
    $quarter = isset($_GET['quarter']) ? $_GET['quarter'] : "";

    // Retrieve the data from the database using traditional SQL query
    $sql = "SELECT * FROM attendance WHERE id='" . $id . "' AND year='" . $year . "'";
    if (!empty($quarter)) {
        $sql .= " AND quarter='" . $quarter . "'";
    }
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $fstattendance = $data['fstattendance'];
        $sndattendance = $data['sndattendance'];
        $trdattendance = $data['trdattendance'];
        $frthattendance = $data['frthattendance'];
        $total = $data['total'];
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    $quarter = isset($_POST['quarter']) ? $_POST['quarter'] : "";
    $year = isset($_POST['year']) ? $_POST['year'] : "";
    $fstattendance = isset($_POST['fstattendance']) ? $_POST['fstattendance'] : "";
    $sndattendance = isset($_POST['sndattendance']) ? $_POST['sndattendance'] : "";
    $trdattendance = isset($_POST['trdattendance']) ? $_POST['trdattendance'] : "";
    $frthattendance = isset($_POST['frthattendance']) ? $_POST['frthattendance'] : "";

    // Check if ID is present in churchmembership table before inserting or updating
    function checkMembership($id)
    {
        global $conn;
        $sql = "SELECT * FROM churchmembership WHERE id = '" . $id . "'";
        $result = $conn->query($sql);
        return $result->num_rows > 0;
    }

    if (!checkMembership($id)) {
        // ID not found in churchmembership table
        echo "<script>alert('ID not found in churchmembership table.')</script>";
    } else {
        // Check if ID, quarter, and year combination already exists in attendance table
        $sql = "SELECT * FROM attendance WHERE id = '" . $id . "' AND quarter = '" . $quarter . "' AND year = '" . $year . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // ID, quarter, and year combination already exists, show edit form and compare values
            $data = $result->fetch_assoc();
            if ($fstattendance == $data['fstattendance'] && $sndattendance == $data['sndattendance'] && $trdattendance == $data['trdattendance'] && $frthattendance == $data['frthattendance']) {
                echo "<script>alert('Existed Record. No changes have been made. Data with ID: $id, Quarter: $quarter, and Year: $year');</script>";

            } else {

                // Recalculate total
                $total = 0;
                if ($fstattendance == "Present") {
                    $total++;
                }
                if ($sndattendance == "Present") {
                    $total++;
                }
                if ($trdattendance == "Present") {
                    $total++;
                }
                if ($frthattendance == "Present") {
                    $total++;
                }

                $updateSql = "UPDATE attendance SET fstattendance='" . $fstattendance . "', sndattendance='" . $sndattendance . "', trdattendance='" . $trdattendance . "', frthattendance='" . $frthattendance . "', total='" . $total . "' WHERE id='" . $id . "' AND quarter = '" . $quarter . "' AND year = '" . $year . "'";


                if ($conn->query($updateSql)) {
                    // Update successful

                    echo "<script>alert('Data with ID: " . $_POST['id'] . ", Quarter: " . $_POST['quarter'] . ", and Year: " . $_POST['year'] . " UPDATED successfully.');</script>";
                    echo "<script>window.location.href = 'attend.php';</script>";

                    echo "<script>window.location.href = 'attend.php?id=$id&year=$year&quarter=$quarter';</script>";

                    exit;
                } else {
                    // Error with update statement
                    echo "Error: " . $conn->error;
                }
            }
        } else {
            // ID, quarter, and year combination does not exist, allow saving
            if (empty($fstattendance) && empty($sndattendance) && empty($trdattendance) && empty($frthattendance)) {
                // No attendance selected, show an error message and open the edit form
                $sql = "SELECT * FROM attendance WHERE id='" . $id . "' AND year='" . $year . "'";
                if (!empty($quarter)) {
                    $sql .= " AND quarter='" . $quarter . "'";
                }
                $result = $conn->query($sql);
                $data = $result->fetch_assoc() ?? [];
                echo "<script>alert('Please select at least one attendance.');</script>";
            } else {
                // At least one attendance selected, calculate total and allow saving
                $total = 0;
                if ($fstattendance == "Present") {
                    $total++;
                }
                if ($sndattendance == "Present") {
                    $total++;
                }
                if ($trdattendance == "Present") {
                    $total++;
                }
                if ($frthattendance == "Present") {
                    $total++;
                }

                $insertSql = "INSERT INTO attendance (id, quarter, year, fstattendance, sndattendance, trdattendance, frthattendance, total) VALUES ('" . $id . "', '" . $quarter . "', '" . $year . "', '" . $fstattendance . "', '" . $sndattendance . "', '" . $trdattendance . "', '" . $frthattendance . "', '" . $total . "')";

                if ($conn->query($insertSql)) {
                    // Insert successful
                    echo "<script>alert('Data with ID: " . $_POST['id'] . ", Quarter: " . $_POST['quarter'] . ", and Year: " . $_POST['year'] . " ADDED successfully.');</script>";
                    echo "<script>window.location.href = 'attend.php?id=$id&year=$year&quarter=$quarter';</script>";
                    exit;
                } else {
                    // Error with insert statement
                    echo "Error: " . $conn->error;
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <div style="position: relative;">
        <img src="/church_member/images/SDALogo.png" alt="SDA Logo"
            style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; height: 10vh; width: 6vw; margin-left: 5vw; margin-top:2.5vh;">
    </div>
    <title>Attendance Data</title>
    <link rel="stylesheet" type="text/css" href="stylestatusshows.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>

<body>
    <div class="title">
        <h1>ATTENDANCE DATA</h1>
    </div>

    <div class="options">
        <ul>
            <div>
                <a href='home.php?' class="lefthomebtn">HOME</a>
            </div>
            <div>
                <!-- Add New button -->
                <button class="addnew" onclick="showAddNewForm()">Add New</button>
            </div>
            <div>
                <form action="" method="GET">
                    <input type="text" id="searchID" name="searchID" placeholder="Search ID">
                    <input type="text" id="searchYear" name="searchYear" placeholder="Search Year">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>
            <div>
                <a href='attend.php?viewData=true'>View Attendance</a>
            </div>
            <div>
                <a href='datashowmemberlist.php'>Back</a>
            </div>
        </ul>
    </div>


    <!-- Add New form popup -->
    <div id="add-new-popup">
        <h2>ATTENDANCE DATA</h2>

        <span id="memberNameLabel">Name:</span>
        <span id="memberName"></span>

        <form id="add-new-form" method="POST" action="">
            <input type="text" name="id" id="add-new-id" placeholder="Enter ID" value="<?= $id ?>" required
                onkeyup="memberIDKeyUp(this.value)">

            <label for="quarter">Quarter:</label>
            <select name="quarter" id="add-new-quarter">
                <option value="" disabled selected>Select</option>
                <option value="1st" <?= ($quarter == "1st") ? "selected" : "" ?>>1st</option>
                <option value="2nd" <?= ($quarter == "2nd") ? "selected" : "" ?>>2nd</option>
                <option value="3rd" <?= ($quarter == "3rd") ? "selected" : "" ?>>3rd</option>
                <option value="4th" <?= ($quarter == "4th") ? "selected" : "" ?>>4th</option>
            </select>

            <input type="text" name="year" id="add-new-year" placeholder="Enter Year" value="<?= $year ?>" required>

            <style>
                label {
                    display: inline-block;
                    vertical-align: middle;
                }

                input[type="checkbox"] {
                    width: auto;
                    display: inline-block;
                    vertical-align: middle;
                }
            </style>

            <label>
                First Week:
                <input type="checkbox" name="fstattendance" id="add-new-fstattendance" value="Present"
                    <?= ($fstattendance == "Present") ? "checked" : "" ?>>
            </label>

            <label>
                Second Week:
                <input type="checkbox" name="sndattendance" id="add-new-sndattendance" value="Present"
                    <?= ($sndattendance == "Present") ? "checked" : "" ?>>
            </label>

            <label>
                Third Week:
                <input type="checkbox" name="trdattendance" id="add-new-trdattendance" value="Present"
                    <?= ($trdattendance == "Present") ? "checked" : "" ?>>
            </label>

            <label>
                Fourth Week:
                <input type="checkbox" name="frthattendance" id="add-new-frthattendance" value="Present"
                    <?= ($frthattendance == "Present") ? "checked" : "" ?>>
            </label>

            <div class="btn-wrapper">
                <button type="submit" class="sub_btn">Save</button>
                <button type="button" class="sub_btns" onclick="hideAddNewForm()">Cancel</button>
            </div>

        </form>
    </div>

</body>

</html>


<script>
    // AJAX call to fetch member's first and last name from the churchmembership table
    function memberIDKeyUp(id) {
        if (id) {
            $.ajax({
                url: "getMembername.php",
                method: "POST",
                data: { id: id },
                dataType: "json",
                success: function (data) {
                    if (data !== null) {
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

    // Show add new form popup
    function showAddNewForm() {
        $("#add-new-popup").show();
    }

    // Hide add new form popup
    function hideAddNewForm() {
        $("#add-new-popup").hide();
    }

    $(document).ready(function () {
        // Show member name when typing member ID in add new form
        $("#add-new-id").on("keyup", function () {
            let id = $(this).val();
            if (id) {
                $.ajax({
                    url: "getMembername.php",
                    method: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function (data) {
                        if (data !== null) {
                            $("#memberName").text(data.fname + " " + data.lname);
                        } else {
                            $("#memberName").text("Member ID not found.");
                        }
                    }
                });
            } else {
                $("#memberName").text("");
            }
        });

        // Show member name when hovering over member ID in table rows
        $(document).on("mouseenter", ".member-id", function () {
            let id = $(this).data("id");
            if (id) {
                let $row = $(this).closest("tr"); // Find the closest table row
                $.ajax({
                    url: "getMembername.php",
                    method: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function (data) {
                        if (data !== null) {
                            let memberName = data.fname + " " + data.lname;
                            let popup = "<div class='member-popup'>" + memberName + "</div>";
                            $(popup).appendTo($row) // Append to the table row
                                .css({
                                    position: "absolute",
                                    top: $row.offset().top + $row.outerHeight() - 5, // Adjust the top offset by 5 pixels
                                    left: $row.offset().left + 10 // Adjust the left offset by 10 pixels
                                });
                        } else {
                            alert("Member ID not found.");
                        }
                    }
                });
            } else {
                alert("Invalid member ID.");
            }
        }).on("mouseleave", ".member-id", function () {
            // Hide the popup when hovering away from the table row
            $(".member-popup").remove();
        });
    });

    function showEditForm(id, quarter, year, fstattendance, sndattendance, trdattendance, frthattendance) {
        $("#add-new-popup").show();
        $("#add-new-id").val(id).prop('readonly', true);
        $("#add-new-quarter").val(quarter);
        $("#add-new-year").val(year).prop('readonly', true);
        $("#add-new-fstattendance").prop('checked', fstattendance === "Present" ? true : false);
        $("#add-new-sndattendance").prop('checked', sndattendance === "Present" ? true : false);
        $("#add-new-trdattendance").prop('checked', trdattendance === "Present" ? true : false);
        $("#add-new-frthattendance").prop('checked', frthattendance === "Present" ? true : false);
    }
</script>



<?php
// Include the database connection file
include "connection.php";

// Delete attendance record
if (isset($_GET['delete']) && isset($_GET['id']) && isset($_GET['year']) && isset($_GET['quarter'])) {
    $id = $_GET['id'];
    $year = $_GET['year'];
    $quarter = $_GET['quarter'];

    $query = "DELETE FROM attendance WHERE id='$id' AND year='$year' AND quarter='$quarter'";
    $query = "DELETE FROM attendance WHERE id='$id' AND year='$year' AND quarter='$quarter'";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data with ID: " . $id . ", Quarter: " . $quarter . ", and Year: " . $year . " Deleted Successfully');</script>";
        echo "<script>window.location.href = 'attend.php';</script>";
    } else {
        echo "Error deleting attendance record: " . mysqli_error($conn);
    }
    exit();
}


if (isset($GET['search'])) {
    $searchYear = $_GET['searchYear'];

    // Construct the search query with year filter 
    $query = "SELECT `id`, `quarter`, `year`, `fstattendance`, 
`sndattendance`, `trdattendance`, `frthattendance`, `total` 
FROM `attendance` WHERE 1 = 1 ";

    if (!empty($searchYear)) {
        $query .= "AND year = '$searchYear'";
    }

    // Execute the search query
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='container' id='statusTable'>";
        echo "<table border='1' cellpadding='0'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Quarter</th>";
        echo "<th>Year</th>";
        echo "<th>First Week</th>";
        echo "<th>Second Week</th>";
        echo "<th>Third Week</th>";
        echo "<th>Fourth Week</th>";
        echo "<th>Total</th>";
        echo "<th>Operation</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['quarter'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['fstattendance'] . "</td>";
            echo "<td>" . $row['sndattendance'] . "</td>";
            echo "<td>" . $row['trdattendance'] . "</td>";
            echo "<td>" . $row['frthattendance'] . "</td>";
            echo "<td>" . $row['total'] . "</td>";
            echo "<td>
<a href='#' onclick='showEditForm(" . $row['id'] . ", \"" . $row['quarter'] . "\", \"" . $row['year'] . "\", \"" . $row['fstattendance'] . "\", \"" . $row['sndattendance'] . "\", \"" . $row['trdattendance'] . "\", \"" . $row['frthattendance'] . "\", \"" . $row['total'] . "\")' class='opt'>Edit</a>

<a href='attend.php?delete=true&id=" . $row['id'] . "&quarter=" . $row['quarter'] . "&year=" . $row['year'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? ID:" . $row['id'] . " Quarter:" . $row['quarter'] . " Year:" . $row['year'] . "\")'>Delete</a>

</td>";
            echo "</tr>";
        }
        echo "</table></div>";
    } else {
        echo '<div 
style=" display: flex; 
      justify-content: center; 
      align-items: center; 
      background-color: #f1f1f1; 
      padding: 20px;">';
        echo '<span 
style="color: red;">
No results found.
</span>';
        echo '</div>';
    }
} else {
    $query = "SELECT * FROM attendance";
    $result = mysqli_query($conn, $query);

    if (isset($_GET['viewData']) || !isset($_GET['search'])) { ?>
        <div class="container" id="statusTable">
            <table border="1" cellpadding="0">
                <tr>
                    <th>ID</th>
                    <th>Quarter</th>
                    <th>Year</th>
                    <th>First Week</th>
                    <th>Second Week</th>
                    <th>Third Week</th>
                    <th>Fourth Week</th>
                    <th>Total</th>
                    <th>Operation</th>
                </tr>

                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['quarter'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td>" . $row['fstattendance'] . "</td>";
                    echo "<td>" . $row['sndattendance'] . "</td>";
                    echo "<td>" . $row['trdattendance'] . "</td>";
                    echo "<td>" . $row['frthattendance'] . "</td>";
                    echo "<td>" . $row['total'] . "</td>";
                    echo "<td>
                    <a href='#' onclick='showEditForm(" . $row['id'] . ", \"" . $row['quarter'] . "\", \"" . $row['year'] . "\", \"" . $row['fstattendance'] . "\", \"" . $row['sndattendance'] . "\", \"" . $row['trdattendance'] . "\", \"" . $row['frthattendance'] . "\", \"" . $row['total'] . "\")' class='opt'>Edit</a>
                  
                        <a href='attend.php?delete=true&id=" . $row['id'] . "&quarter=" . $row['quarter'] . "&year=" . $row['year'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? ID:" . $row['id'] . " Quarter:" . $row['quarter'] . " Year:" . $row['year'] . "\")'>Delete</a>
                    
                   
            </td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

    <?php }
}
?>



<style>
    .title {
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
        background-color: rgb(1, 25, 83);
        color: rgb(254, 245, 166);

    }

    .options div {
        display: inline-block;

    }

    .options a {
        text-decoration: none;
        color: #ffff;
        width: 250px;
        display: block;
        padding: 15px 5px;
        text-transform: uppercase;
        font-size: 15px;
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
    }

    .options a:hover {
        background: rgb(237, 252, 102);
        color: rgb(2, 15, 89);
    }

    .options .lefthomebtn {
        text-decoration: none;
        color: #ffff;
        width: 250px;
        display: block;
        padding: 15px;
        text-transform: uppercase;
        font-size: 15px;
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
    }

    .options .lefthomebtn:hover {
        background: rgb(237, 252, 102);
        color: rgb(2, 15, 89);
    }

    .options .addnew {
        text-decoration: none;
        color: #ffff;
        width: 250px;
        display: block;
        background: black;
        padding: 15px 5px;
        text-transform: uppercase;
        font-size: 15px;
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        border: none;
    }

    .options .addnew:hover {
        background: rgb(237, 252, 102);
        color: rgb(2, 15, 89);
    }

    .options ul {
        list-style: none;
        background: #020004;
        padding: 0;
        margin-bottom: 20pt;
        margin-top: -20pt;
        text-align: right;
    }


    form .sub_btn {
        padding: 10px 15px;
        background-color: blue;
        color: #ffff;
        margin-top: 5pt;
        margin-left: 27pt;
        margin-right: 10pt;
        outline: none;
        border: 0;
        font-weight: bold;
        cursor: pointer;
        font-size: 15px;
        font-family: "Century Gothic";
        border-radius: 10px;
        text-decoration: none;
        align-items: center;
        justify-content: center;
    }

    form .sub_btn:hover {
        color: rgb(83, 5, 5);
        background-color: rgb(251, 300, 9);
        text-decoration: none;
    }

    form .sub_btns {
        padding: 10px 15px;
        background-color: darkgreen;
        color: #ffff;
        margin-top: 5pt;
        outline: none;
        border: 0;
        font-weight: bold;
        cursor: pointer;
        margin: 10x 10pt;
        font-size: 15px;
        font-family: "Century Gothic";
        border-radius: 10px;
        text-decoration: none;
        align-items: center;
        justify-content: center;
    }

    form .sub_btns:hover {
        color: rgb(83, 5, 5);
        background-color: rgb(251, 300, 9);
        text-decoration: none;
    }

    table {
        width: 60vw;
    }
</style>