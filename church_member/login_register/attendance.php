<?php
// Include the database connection file
include "connection.php";

// Initialize variables
$id = "";
$month = "";
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
    $month = isset($_GET['month']) ? $_GET['month'] : "";

    // Retrieve the data from the database using the ID and year
    $sql = "SELECT * FROM attendance WHERE id='" . $id . "' AND year='" . $year . "'";

    $result = $conn->query($sql);

    if (!empty($month)) {
        $sql .= " AND month='" . $month . "'";
    }

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $month = $data['month'];
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
    $month = isset($_POST['month']) ? $_POST['month'] : "";
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
        // Check if ID, month, and year combination already exists in attendance table
        $sql = "SELECT * FROM attendance WHERE id = '" . $id . "' AND month = '" . $month . "' AND year = '" . $year . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // ID, month, and year combination already exists, show edit form and compare values
            $data = $result->fetch_assoc();
            if ($fstattendance == $data['fstattendance'] && $sndattendance == $data['sndattendance'] && $trdattendance == $data['trdattendance'] && $frthattendance == $data['frthattendance']) {
                echo "<script>alert('Existed Record. No changes have been made. Data with ID: $id, Month: $month, and Year: $year');</script>";
            } else {

                // Recalculate total using stored function
                $stmt = $conn->prepare("SELECT calculateTotalAttendance(?, ?, ?, ?) AS total");
                $stmt->bind_param("ssss", $fstattendance, $sndattendance, $trdattendance, $frthattendance);
                $stmt->execute();
                $total = $stmt->get_result()->fetch_assoc()['total'];

                // Begin transaction
                $conn->begin_transaction();

                $updateSql = "UPDATE attendance SET fstattendance='" . $fstattendance . "', sndattendance='" . $sndattendance . "', trdattendance='" . $trdattendance . "', frthattendance='" . $frthattendance . "', total='" . $total . "' WHERE id='" . $id . "' AND month = '" . $month . "' AND year = '" . $year . "'";

                if ($conn->query($updateSql)) {
                    // Update successful

                    echo "<script>alert('Data with ID: " . $_POST['id'] . ", Month: " . $_POST['month'] . ", and Year: " . $_POST['year'] . " UPDATED successfully.');</script>";
                    echo "<script>window.location.href = 'attendance.php';</script>";

                    // Commit transaction
                    $conn->commit();

                    exit;
                } else {
                    // Error with update statement
                    echo "Error: " . $conn->error;

                    // Rollback transaction
                    $conn->rollback();
                }
            }
        } else {
            // ID, month, and year combination does not exist, allow saving
            if (empty($fstattendance) && empty($sndattendance) && empty($trdattendance) && empty($frthattendance)) {
                // No attendance selected, show an error message and open the edit form
                $sql = "SELECT * FROM attendance WHERE id='" . $id . "' AND year='" . $year . "'";
                if (!empty($month)) {
                    $sql .= " AND month='" . $month . "'";
                }
                $result = $conn->query($sql);
                $data = $result->fetch_assoc() ?? [];
                echo "<script>alert('Please select at least one attendance.');</script>";
            } else {
                // At least one attendance selected, calculate total using stored function and allow saving
                $stmt = $conn->prepare("SELECT calculateTotalAttendance(?, ?, ?, ?) AS total");
                $stmt->bind_param("ssss", $fstattendance, $sndattendance, $trdattendance, $frthattendance);
                $stmt->execute();
                $total = $stmt->get_result()->fetch_assoc()['total'];

                // Begin transaction
                $conn->begin_transaction();

                $insertSql = "INSERT INTO attendance (id, month, year, fstattendance, sndattendance, trdattendance, frthattendance, total) VALUES ('" . $id . "', '" . $month . "', '" . $year . "', '" . $fstattendance . "', '" . $sndattendance . "', '" . $trdattendance . "', '" . $frthattendance . "', '" . $total . "')";

                if ($conn->query($insertSql)) {
                    // Insert successful
                    echo "<script>alert('Data with ID: " . $_POST['id'] . ", Month: " . $_POST['month'] . ", and Year: " . $_POST['year'] . " ADDED successfully.');</script>";
                    echo "<script>window.location.href = 'attendance.php';</script>";

                    // Commit transaction
                    $conn->commit();

                    exit;
                } else {
                    // Error with insert statement
                    echo "Error: " . $conn->error;

                    // Rollback transaction
                    $conn->rollback();
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
                <a href='attendance.php?viewData=true'>View Attendance</a>
            </div>
            <div>
                <a href='datashowmemberlist.php'>Back</a>
            </div>
        </ul>
    </div>


    <!-- Add New form popup -->
    <div id="add-new-popup" style="height: 50vh; margin-left:-3vw;">
        <h2>ATTENDANCE FORM</h2>

        <span id="memberNameLabel">Name:</span>
        <span id="memberName"></span>

        <form id="add-new-form" method="POST" action="">
            <input type="text" name="id" id="add-new-id" placeholder="Enter ID" value="<?= $id ?>" required
                onkeyup="memberIDKeyUp(this.value)">

            <label for="month">Month:</label>
            <select name="month" id="add-new-month" required>
                <option value="" disabled selected>Select</option>
                <option value="January" <?= ($month == "January") ? "selected" : "" ?>>January</option>
                <option value="February" <?= ($month == "February") ? "selected" : "" ?>>February</option>
                <option value="March" <?= ($month == "March") ? "selected" : "" ?>>March</option>
                <option value="April" <?= ($month == "April") ? "selected" : "" ?>>April</option>
                <option value="May" <?= ($month == "May") ? "selected" : "" ?>>May</option>
                <option value="June" <?= ($month == "June") ? "selected" : "" ?>>June</option>
                <option value="July" <?= ($month == "July") ? "selected" : "" ?>>July</option>
                <option value="August" <?= ($month == "August") ? "selected" : "" ?>>August</option>
                <option value="September" <?= ($month == "September") ? "selected" : "" ?>>September</option>
                <option value="October" <?= ($month == "October") ? "selected" : "" ?>>October</option>
                <option value="November" <?= ($month == "November") ? "selected" : "" ?>>November</option>
                <option value="December" <?= ($month == "December") ? "selected" : "" ?>>December</option>
            </select>

            <input type="text" name="year" id="add-new-year" placeholder="Enter Year" value="<?= $year ?>" required>

            <label>
                First Week:
                <input type="checkbox" name="fstattendance" id="add-new-fstattendance" value="Present"
                    <?= ($fstattendance == "Present") ? "checked" : "" ?> class="attendance-box">
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




    function showEditForm(id, month, year, fstattendance, sndattendance, trdattendance, frthattendance) {
        $("#add-new-popup").show();
        $("#add-new-id").val(id).prop('readonly', true);
        $("#add-new-month").val(month).prop('readonly', true);
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


if (isset($_GET['delete']) && isset($_GET['id']) && isset($_GET['year']) && isset($_GET['month'])) {
    $id = $_GET['id'];
    $year = $_GET['year'];
    $month = $_GET['month'];

    $query = "DELETE FROM attendance WHERE id='$id' AND year='$year' AND month='$month'";
    if (mysqli_query($conn, $query)) {

        echo "<script>window.location.href = 'attendance.php';</script>";
    } else {
        echo "Error deleting attendance record: " . mysqli_error($conn);
    }
    exit();
}

if (isset($_GET['id']) && isset($_GET['year'])) {
    $id = $_GET['id'];
    $year = $_GET['year'];

    $query = "SELECT * FROM attendance WHERE id='$id' AND year='$year'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<div class='container' id='statusTable'>";
        echo "<table border='1' cellpadding='0'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Month</th>";
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
            echo "<td class='member-id' data-id='" . $row['id'] . "'>" . $row['id'] . "</td>";
            echo "<td>" . $row['month'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['fstattendance'] . "</td>";
            echo "<td>" . $row['sndattendance'] . "</td>";
            echo "<td>" . $row['trdattendance'] . "</td>";
            echo "<td>" . $row['frthattendance'] . "</td>";
            echo "<td>" . $row['total'] . "</td>";
            echo "<td>
                    <a href='#' onclick='showEditForm(" . $row['id'] . ", \"" . $row['month'] . "\", \"" . $row['year'] . "\", \"" . $row['fstattendance'] . "\", \"" . $row['sndattendance'] . "\", \"" . $row['trdattendance'] . "\", \"" . $row['frthattendance'] . "\", \"" . $row['total'] . "\")' class='opt'>Edit</a>
                    <a href='attendance.php?delete=true&id=" . $row['id'] . "&month=" . $row['month'] . "&year=" . $row['year'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? ID:" . $row['id'] . " Month:" . $row['month'] . " Year:" . $row['year'] . "\")'>Delete</a>
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
} else if (isset($_GET['search'])) {
    $searchID = isset($_GET['searchID']) ? $_GET['searchID'] : "";
    $searchYear = isset($_GET['searchYear']) ? $_GET['searchYear'] : "";

    // Construct the search query with ID and year filters 
    $query = "SELECT * FROM attendance WHERE 1 = 1 ";
    if (!empty($searchID)) {
        $query .= "AND id LIKE '%$searchID%'";
    }
    if (!empty($searchYear)) {
        $query .= "AND year LIKE '%$searchYear%'";
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
        echo "<div class='container' id='statusTable'>";
        echo "<table border='1' cellpadding='0'>";
        echo "<tr>";

        echo "<th><a href=\"attendance.php?sort=id&order=$order\">ID</a></th>";
        echo "<th><a href=\"attendance.php?sort=month&order=$order\">Month</a></th>";
        echo "<th><a href=\"attendance.php?sort=year&order=$order\">Year</a></th>";
        echo "<th><a href=\"attendance.php?sort=fstattendance&order=$order\">First Week</a></th>";
        echo "<th><a href=\"attendance.php?sort=sndattendance&order=$order\">Second Week</a></th>";
        echo "<th><a href=\"attendance.php?sort=trdattendance&order=$order\">Third Week</a></th>";
        echo "<th><a href=\"attendance.php?sort=frthattendance&order=$order\">Fourth Week</a></th>";
        echo "<th><a href=\"attendance.php?sort=total&order=$order\">Total</a></th>";
        echo "<th>Operation</th>";

        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td class='member-id' data-id='" . $row['id'] . "'>" . $row['id'] . "</td>";
            echo "<td>" . $row['month'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['fstattendance'] . "</td>";
            echo "<td>" . $row['sndattendance'] . "</td>";
            echo "<td>" . $row['trdattendance'] . "</td>";
            echo "<td>" . $row['frthattendance'] . "</td>";
            echo "<td>" . $row['total'] . "</td>";
            echo "<td>
                    <a href='#' onclick='showEditForm(" . $row['id'] . ", \"" . $row['month'] . "\", \"" . $row['year'] . "\", \"" . $row['fstattendance'] . "\", \"" . $row['sndattendance'] . "\", \"" . $row['trdattendance'] . "\", \"" . $row['frthattendance'] . "\", \"" . $row['total'] . "\")' class='opt'>Edit</a>
                    <a href='attendance.php?delete=true&id=" . $row['id'] . "&month=" . $row['month'] . "&year=" . $row['year'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? ID:" . $row['id'] . " Month:" . $row['month'] . " Year:" . $row['year'] . "\")'>Delete</a>
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
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
    $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
    $query .= " ORDER BY $sort $order";
    $result = mysqli_query($conn, $query);

    if (isset($_GET['viewData']) || !isset($_GET['search'])) { ?>
            <div class="container" id="statusTable">
                <table border="1" cellpadding="0">
                    <tr>

                        <th><a
                                href="attendance.php?sort=id&order=<?php echo $sort == 'id' && $order == 'asc' ? 'desc' : 'asc'; ?>">ID</a>
                        </th>
                        <th><a
                                href="attendance.php?sort=month&order=<?php echo $sort == 'month' && $order == 'asc' ? 'desc' : 'asc'; ?>">Month</a>
                        </th>
                        <th><a
                                href="attendance.php?sort=year&order=<?php echo $sort == 'year' && $order == 'asc' ? 'desc' : 'asc'; ?>">Year</a>
                        </th>
                        <th><a
                                href="attendance.php?sort=fstattendance&order=<?php echo $sort == 'fstattendance' && $order == 'asc' ? 'desc' : 'asc'; ?>">First
                                Week</a></th>
                        <th><a
                                href="attendance.php?sort=sndattendance&order=<?php echo $sort == 'sndattendance' && $order == 'asc' ? 'desc' : 'asc'; ?>">Second
                                Week</a></th>
                        <th><a
                                href="attendance.php?sort=trdattendance&order=<?php echo $sort == 'trdattendance' && $order == 'asc' ? 'desc' : 'asc'; ?>">Third
                                Week</a></th>
                        <th><a
                                href="attendance.php?sort=frthattendance&order=<?php echo $sort == 'frthattendance' && $order == 'asc' ? 'desc' : 'asc'; ?>">Fourth
                                Week</a></th>
                        <th><a
                                href="attendance.php?sort=total&order=<?php echo $sort == 'total' && $order == 'asc' ? 'desc' : 'asc'; ?>">Total</a>
                        </th>
                        <th>Operation</th>
                    </tr>

                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td class='member-id' data-id='" . $row['id'] . "'>" . $row['id'] . "</td>";
                        echo "<td>" . $row['month'] . "</td>";
                        echo "<td>" . $row['year'] . "</td>";
                        echo "<td>" . $row['fstattendance'] . "</td>";
                        echo "<td>" . $row['sndattendance'] . "</td>";
                        echo "<td>" . $row['trdattendance'] . "</td>";
                        echo "<td>" . $row['frthattendance'] . "</td>";
                        echo "<td>" . $row['total'] . "</td>";
                        echo "<td>
                        <a href='#' onclick='showEditForm(" . $row['id'] . ", \"" . $row['month'] . "\", \"" . $row['year'] . "\", \"" . $row['fstattendance'] . "\", \"" . $row['sndattendance'] . "\", \"" . $row['trdattendance'] . "\", \"" . $row['frthattendance'] . "\", \"" . $row['total'] . "\")' class='opt'>Edit</a>
                        <a href='attendance.php?delete=true&id=" . $row['id'] . "&month=" . $row['month'] . "&year=" . $row['year'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? ID:" . $row['id'] . " Month:" . $row['month'] . " Year:" . $row['year'] . "\")'>Delete</a>
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

    label {
        display: inline-block;
        vertical-align: middle;
    }

    input[type="checkbox"] {
        width: auto;
        display: inline-block;
        vertical-align: middle;
    }

    .member-popup {
        position: absolute;
        background-color: #555;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        z-index: 9999;
    }

    .member-id:hover {
        cursor: pointer;
    }
</style>