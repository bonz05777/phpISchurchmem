<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
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

        <form id="add-new-form" method="POST">
            <input type="text" name="id" id="add-new-id" placeholder="Enter ID" required>
            <input type="text" name="year" id="add-new-year" placeholder="Enter Year" required>



            <label for="fq">First Quarter:</label>
            <select name="fq" id="add-new-fq">
                <option value="">-- Select --</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Transferred">Transferred</option>
            </select>

            <label for="sq">Second Quarter:</label>
            <select name="sq" id="add-new-sq">
                <option value="">-- Select --</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Transferred">Transferred</option>
            </select>

            <label for="tq">Third Quarter:</label>
            <select name="tq" id="add-new-tq">
                <option value="">-- Select --</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Transferred">Transferred</option>
            </select>



            <div class="btn-wrapper">
                <button type="submit" class="btn" name="submit">Save</button>
                <button type="button" class="btn" onclick="hideAddNewForm()">Cancel</button>
            </div>
        </form>
    </div>

    <?php
    // Include the database connection file
    include "connection.php";

    // Check if ID and year combination are set in the URL
    if (isset($_GET['id']) && isset($_GET['year'])) {
        $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM status WHERE id='{$_GET['id']}' AND year='{$_GET['year']}'"));
        $fq = $data['fq'];
        $sq = $data['sq'];
        $tq = $data['tq'];
        $year = $data['year'];
    } else {
        $fq = null;
        $sq = null;
        $tq = null;
        $year = "";
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $fq = isset($_POST['fq']) ? $_POST['fq'] : null;
        $sq = isset($_POST['sq']) ? $_POST['sq'] : null;
        $tq = isset($_POST['tq']) ? $_POST['tq'] : null;
        $year = $_POST['year'];

        // Check if ID and year combination are set in the URL
        if (isset($_GET['id']) && isset($_GET['year'])) {
            $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM status WHERE id='{$_GET['id']}' AND year='{$_GET['year']}'"));
            $fq = $fq ?: $data['fq'];
            $sq = $sq ?: $data['sq'];
            $tq = $tq ?: $data['tq'];
            $year = $year ?: $data['year'];
        }

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
        } else {
            // Check if any quarter is selected
            if ($fq === null && $sq === null && $tq === null) {
                echo "<script>alert('Please select an option for at least one quarter.');</script>";
            } else {
                // Insert or update status data if at least one quarter is selected
                if ($fq !== null || $sq !== null || $tq !== null) {
                    $sql = "INSERT INTO status (id, fq, sq, tq, year) VALUES ('$id', '$fq', '$sq', '$tq', '$year')"
                        . " ON DUPLICATE KEY UPDATE fq = '$fq', sq = '$sq', tq = '$tq'";
                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Data Added/Updated Successfully.');</script>";

                    }
                }
            }
        }
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

        // Execute the search query
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<div class='container' id='statusTable'>";
            echo "<table border='1' cellpadding='0'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>First Quarter</th>";
            echo "<th>Second Quarter</th>";
            echo "<th>Third Quarter</th>";
            echo "<th>Year</th>";
            echo "<th>Operation</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td class='member-id' data-id='" . $row['id'] . "'>" . $row['id'] . "</td>";
                echo "<td>" . $row['fq'] . "</td>";
                echo "<td>" . $row['sq'] . "</td>";
                echo "<td>" . $row['tq'] . "</td>";
                echo "<td>" . $row['year'] . "</td>";
                echo "<td>
        <a href='aboutstatus1.php?id=" . $row['id'] . "&year=" . $row['year'] . "' class='opt'>Edit</a>
        <a href='aboutstatus1.php?delete=true&id=" . $row['id'] . "&year=" . $row['year'] . "' class='opt1'>Delete</a>
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
        $query = "SELECT * FROM status";
        $result = mysqli_query($conn, $query);

        if (isset($_GET['viewData']) || !isset($_GET['search'])) {
            ?>
            <div class="container" id="statusTable">
                <table border="1" cellpadding="0">
                    <tr>
                        <th>ID</th>
                        <th>First Quarter</th>
                        <th>Second Quarter</th>
                        <th>Third Quarter</th>
                        <th>Year</th>
                        <th>Operation</th>
                    </tr>

                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td class='member-id' data-id='" . $row['id'] . "'>" . $row['id'] . "</td>";
                        echo "<td>" . $row['fq'] . "</td>";
                        echo "<td>" . $row['sq'] . "</td>";
                        echo "<td>" . $row['tq'] . "</td>";
                        echo "<td>" . $row['year'] . "</td>";
                        echo "<td>
            <a href='aboutstatus1.php?id=" . $row['id'] . "&year=" . $row['year'] . "' class='opt'>Edit</a>
            <a href='aboutstatus1.php?delete=true&id=" . $row['id'] . "&year=" . $row['year'] . "' class='opt1'>Delete</a>
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




</body>

<!-- JavaScript code -->
<script>
    // AJAX call to fetch member's first and last name from the churchmembership table
    function memberIDKeyUp(id) {
        if (id) {
            $.ajax({
                url: "getMembername.php",
                method: "POST",
                data: {
                    id: id
                },
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
        // Reset form fields
        document.getElementById("add-new-form").reset();
        $("#memberName").text("");
    }

    $(document).ready(function () {
        // Show member name when typing member ID in add new form
        $("#add-new-id").on("keyup", function () {
            let id = $(this).val();
            if (id) {
                $.ajax({
                    url: "getMembername.php",
                    method: "POST",
                    data: {
                        id: id
                    },
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
                    data: {
                        id: id
                    },
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
</script>

</html>