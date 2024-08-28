<?php
// Include the database connection file
include "connection.php";

// Initialize variables
$id = "";
$fq = "";
$sq = "";
$tq = "";
$fthq = "";
$year = "";

// Check if ID and year combination are set in the URL
if (isset($_GET['id']) && isset($_GET['year'])) {
    $id = $_GET['id'];
    $year = $_GET['year'];

    // Retrieve the data from the database using traditional SQL query
    $sql = "SELECT * FROM status WHERE id='" . $id . "' AND year='" . $year . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $fq = $data['fq'];
        $sq = $data['sq'];
        $tq = $data['tq'];
        $fthq = $data['fthq'];
    }
} else {
    $fq = "";
    $sq = "";
    $tq = "";
    $fthq = "";
    $year = "";
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    $year = isset($_POST['year']) ? $_POST['year'] : "";
    $fq = isset($_POST['fq']) ? $_POST['fq'] : " ";
    $sq = isset($_POST['sq']) ? $_POST['sq'] : " ";
    $tq = isset($_POST['tq']) ? $_POST['tq'] : " ";
    $fthq = isset($_POST['fthq']) ? $_POST['fthq'] : " ";

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
        // Check if ID and year combination already exists in status table
        $sql = "SELECT * FROM status WHERE id = '" . $id . "' AND year = '" . $year . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // ID and year combination already exists, show edit form and compare values
            $data = $result->fetch_assoc();
            if ($fq == $data['fq'] && $sq == $data['sq'] && $tq == $data['tq'] && $fthq == $data['fthq']) {
                echo "<script>alert('Existed Record. No changes have been made. Data with ID: $id and Year: $year');</script>";

            } else {
                $updateSql = "UPDATE status SET fq='" . $fq . "', sq='" . $sq . "', tq='" . $tq . "', fthq='" . $fthq . "' WHERE id='" . $id . "' AND year='" . $year . "'";
                if ($conn->query($updateSql)) {
                    // Update successful

                    echo "<script>alert('Data with ID: " . $_POST['id'] . " and Year: " . $_POST['year'] . " UPDATED successfully.');</script>";
                    echo "<script>window.location.href = 'aboutstatus1.php';</script>";

                    exit;
                } else {
                    // Error with update statement
                    echo "Error: " . $conn->error;
                }
            }
        } else {
            // ID and year combination does not exist, check that at least one quarter is selected
            if (empty($fq) && empty($sq) && empty($tq)) {
                // No quarter selected, show an error message and open the edit form
                $sql = "SELECT * FROM status WHERE id='" . $id . "' AND year='" . $year . "'";
                $result = $conn->query($sql);
                $data = $result->fetch_assoc() ?? [];
                echo "<script>alert('Please select at least one quarter.'); </script>";
            } else {
                // At least one quarter selected, allow saving

                $insertSql = "INSERT INTO status (id, fq, sq, tq, fthq, year) VALUES ('" . $id . "', '" . $fq . "', '" . $sq . "', '" . $tq . "', '" . $fthq . "', '" . $year . "')";

                if ($conn->query($insertSql)) {
                    // Insert successful
                    $id = "";
                    $fq = "";
                    $sq = "";
                    $tq = "";
                    $fthq = "";
                    $year = "";
                    echo "<script>alert('Data with ID: " . $_POST['id'] . " and Year: " . $_POST['year'] . " ADDED successfully.');</script>";
                    echo "<script>window.location.href = 'aboutstatus1.php';</script>";
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
    <title>Status Data</title>
    <link rel="stylesheet" type="text/css" href="stylestatusshows.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>





<body>
    <div class="title">
        <h1>STATUS DATA</h1>
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
                <a href='aboutstatus1.php?viewData=true'>View Status</a>
            </div>
            <div>
                <a href='datashowmemberlist.php'>Back</a>
            </div>
        </ul>
    </div>


    <!-- Add New form popup -->
    <div id="add-new-popup">
        <h2>STATUS DATA</h2>

        <span id="memberNameLabel">Name:</span>
        <span id="memberName"></span>

        <form id="add-new-form" method="POST" action="">
            <input type="text" name="id" id="add-new-id" placeholder="Enter ID" required>
            <input type="text" name="year" id="add-new-year" placeholder="Enter Year" required>



            <label for="fq">First Quarter:</label>
            <select name="fq" id="add-new-fq">
                <option value="" disabled selected>Select</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Transferred">Transferred</option>
            </select>

            <label for="sq">Second Quarter:</label>
            <select name="sq" id="add-new-sq">
                <option value="" disabled selected>Select</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Transferred">Transferred</option>
            </select>

            <label for="tq">Third Quarter:</label>
            <select name="tq" id="add-new-tq">
                <option value="" disabled selected>Select</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Transferred">Transferred</option>
            </select>


            <label for="fthq">Fourth Quarter:</label>
            <select name="fthq" id="add-new-fthq">
                <option value="" disabled selected>Select</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Transferred">Transferred</option>
            </select>


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
        window.location.href = 'aboutstatus1.php';

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



    function showEditForm(id, year, fq, sq, tq) {
        $("#add-new-popup").show();
        $("#add-new-id").val(id).prop('readonly', true);
        $("#add-new-year").val(year).prop('readonly', true);
        $("#add-new-fq").val(fq);
        $("#add-new-sq").val(sq);
        $("#add-new-tq").val(tq);
        $("#add-new-fthq").val(tq);
    }

</script>




<?php
// Include the database connection file
include "connection.php";

if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $year = $_GET['year'];
    // Delete record from status table
    $query = "DELETE FROM status WHERE id = '$id' AND year = '$year'";
    mysqli_query($conn, $query);
    // Refresh the status table
    echo "<script>window.location.href = 'aboutstatus1.php?viewData=true';</script>";
}



if (isset($_GET['search'])) {
    $searchID = $_GET['searchID'];
    $searchYear = $_GET['searchYear'];

    // Construct the search query with ID and/or year filters 
    $query = "SELECT * FROM status WHERE 1 = 1 ";
    if (!empty($searchID)) {
        $query .= "AND id = '$searchID' ";
    }
    if (!empty($searchYear)) {
        $query .= "AND year = '$searchYear'";
    }


    // Handle sorting
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
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
        echo "<div class='container' id='statusTable'>"; // Added ID to the container to make it visible in JavaScript
        echo "<table border='1' cellpadding='0'>";
        echo "<tr>";

        echo "<th><a href=\"aboutstatus1.php?sort=id&order=$order\">ID</a></th>";
        echo "<th><a href=\"aboutstatus1.php?sort=fq&order=$order\">First Quarter</a></th>";
        echo "<th><a href=\"aboutstatus1.php?sort=sq&order=$order\">Second Quarter</a></th>";
        echo "<th><a href=\"aboutstatus1.php?sort=tq&order=$order\">Third Quarter</a></th>";
        echo "<th><a href=\"aboutstatus1.php?sort=fthq&order=$order\">Fourth Quarter</a></th>";
        echo "<th><a href=\"aboutstatus1.php?sort=year&order=$order\">Year</a></th>";

        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td class='member-id' data-id='" . $row['id'] . "'>" . $row['id'] . "</td>";
            echo "<td>" . $row['fq'] . "</td>";
            echo "<td>" . $row['sq'] . "</td>";
            echo "<td>" . $row['tq'] . "</td>";
            echo "<td>" . $row['fthq'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>

            <a href='#' onclick='showEditForm(" . $row['id'] . ", " . $row['year'] . ", \"" . $row['fq'] . "\", \"" . $row['sq'] . "\", \"" . $row['tq'] . "\")' class='opt'>Edit</a>
    
        <a href='aboutstatus1.php?delete=true&id=" . $row['id'] . "&year=" . $row['year'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? ID:" . $row['id'] . " Year:" . $row['year'] . "\")'>Delete</a>

        <a href='/church_member/login_register/attendance.php?id=" . $row['id'] . "  &year=" . $row['year'] . "  ' class='opt2'>Attendance</a>


   

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
    // Retrieve churchmembership records from the database
    $query = "SELECT * FROM status";
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
    $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
    $query .= " ORDER BY $sort $order";


    $result = mysqli_query($conn, $query);

    if (isset($_GET['viewData']) || !isset($_GET['search'])) {
        ?>
        <div class="container" id="statusTable"> <!-- Added ID to the container to make it visible in JavaScript -->
            <table border="1" cellpadding="0">
                <tr>

                    <th><a
                            href="aboutstatus1.php?sort=id&order=<?php echo $sort == 'id' && $order == 'asc' ? 'desc' : 'asc'; ?>">ID</a>
                    </th>
                    <th><a
                            href="aboutstatus1.php?sort=fq&order=<?php echo $sort == 'fq' && $order == 'asc' ? 'desc' : 'asc'; ?>">First
                            Quarter</a>
                    </th>
                    <th><a
                            href="aboutstatus1.php?sort=sq&order=<?php echo $sort == 'sq' && $order == 'asc' ? 'desc' : 'asc'; ?>">Second
                            Quarter</a>
                    </th>
                    <th><a
                            href="aboutstatus1.php?sort=tq&order=<?php echo $sort == 'tq' && $order == 'asc' ? 'desc' : 'asc'; ?>">Third
                            Quarter</a>
                    </th>
                    <th><a
                            href="aboutstatus1.php?sort=fthq&order=<?php echo $sort == 'fthq' && $order == 'asc' ? 'desc' : 'asc'; ?>">Fourth
                            Quarter</a></th>
                    <th><a
                            href="aboutstatus1.php?sort=year&order=<?php echo $sort == 'year' && $order == 'asc' ? 'desc' : 'asc'; ?>">Year</a>
                    </th>
                    <th>Operation</th>

                </tr>

                <?php



                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td class='member-id' data-id='" . $row['id'] . "'>" . $row['id'] . "</td>";
                    echo "<td>" . ($row['fq'] ? $row['fq'] : '') . "</td>";
                    echo "<td>" . ($row['sq'] ? $row['sq'] : '') . "</td>";
                    echo "<td>" . ($row['tq'] ? $row['tq'] : '') . "</td>";
                    echo "<td>" . ($row['fthq'] ? $row['fthq'] : '') . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td>
                       <a href='#' onclick='showEditForm(" . $row['id'] . ", " . $row['year'] . ", \"" . $row['fq'] . "\", \"" . $row['sq'] . "\", \"" . $row['tq'] . "\", \"" . $row['fthq'] . "\")' class='opt'>Edit</a>
                       <a href='aboutstatus1.php?delete=true&id=" . $row['id'] . "&year=" . $row['year'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? ID:" . $row['id'] . " Year:" . $row['year'] . "\")'>Delete</a>
                       <a href='/church_member/login_register/attendance.php?id=" . $row['id'] . "&year=" . $row['year'] . "' class='opt2'>Attendance</a>
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

    #add-new-popup {
        display: none;
        position: absolute;
        top: 60%;
        left: 13%;
        transform: translate(-50%, -50%);
        background-color: rgb(1, 25, 83);
        padding: 20px;
        border: 1px solid #ccc;
        height: 64vh;
        width: 15vw;
        border-radius: 8px;
        z-index: 9999;
    }

    .opt2 {
        background-color: rgb(1, 52, 148);
        color: #ffff;
        cursor: pointer;
        font-size: 16px;
        text-decoration: none;
        padding: 3px;
    }
</style>