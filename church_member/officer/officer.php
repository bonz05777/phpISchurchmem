<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>OFFICER INFO</title>
    <link rel="stylesheet" type="text/css" href="officershow.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>

<body>
    <div style="position: relative;">
        <img src="/church_member/images/SDALogo.png" alt="SDA Logo"
            style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; height: 10vh; width: 6vw; margin-left: 5vw; margin-top:2.5vh;">
    </div>

    <!--
    <div style="float: right; width: 35vw; margin-top: 2.5vh; position:relative; color: white;">
            <p>For as in one body we have many members, and the members do not all have the same function, so we, though
                many, are one body in Christ, and individually members one of another. -Romans 12:4-5</p>
        </div>
    -->

    <div class="title">
        <h1>OFFICER INFO</h1>
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
                    <input type="text" id="searchID" name="searchID" placeholder="Search ID">
                    <input type="text" id="searchPosition" name="searchPosition" placeholder="Search Position">
                    <input type="text" id="searchYear" name="searchYear" placeholder="Search Year">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>
            <div>
                <a href='officer.php?viewData=true'>View Data</a>
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
                height: 400px;
                text-decoration: none;
                margin-top:2vh;
                z-index:1;">

        <script src="getofficedetails.php"></script>
        <script>
            function getOfficeDetails() {
                var officeID = document.getElementById("officeID").value.trim();
                if (officeID !== '') {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            var response = JSON.parse(this.responseText);
                            if (response.error) {
                                alert(response.error);
                            } else {
                                document.getElementById("position").innerText = response.position;
                                document.getElementById("deptname").innerText = response.deptname;
                            }
                        }
                    };
                    xhttp.open("GET", "getofficedetails.php?officeID=" + officeID, true);
                    xhttp.send();
                } else {
                    // Clear the position and department details if officeID is empty
                    document.getElementById("position").innerText = "";
                    document.getElementById("deptname").innerText = "";
                }
            }
        </script>


        <style>
            .spandetails {
                font-size: 13px;
            }

            .spans {

                margin-top: 3vh;
                margin-left: 3px;
                width: 15vw;
                align-self: center;
                justify-content: center;
                justify-self: center;
                justify-items: center;
                text-align: center;
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
                margin-left: -5.5vw;
                width: 13vw;
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

            .office-popup {
                position: absolute;
                background-color: #555;
                color: #fff;
                padding: 5px 10px;
                margin-left: 5vw;
                border-radius: 5px;
                font-size: 12px;
                z-index: 9999;
            }

            .office-id:hover {
                cursor: pointer;
            }
        </style>

        <div class="contents">
            <form action="" method="POST">
                <label class="labelmin">OFFICER DETAIL</label>

                <div>
                    <span id="memberNamesLabel" style="
        font-size: 12px; 
        color: yellow;
        margin-left: 20pt;
        
        ">Name:</span>

                    <span id="memberNames" style="
        font-size: 12px; 
        color: yellow;
        margin-left: 3pt;
        "></span>

                </div>

                <input type="text" id="id" class="data-insert" name="id" placeholder="ID"
                    onkeyup="memberIDKeyUp(this.value); checkIfNumber(this)" required><br>

                <!-- Add the 'oninput' attribute to the officeID input field -->
                <input type="text" id="officeID" class="data-insert" name="officeID" placeholder="Office ID"
                    onkeyup="getOfficeDetails(); checkIfNumber(this.value)" required>

                <input type="text" id="year" class="data-insert" name="year" placeholder="YYYY" required
                    oninput="checkYearFormat(this)"><br>


                <button type="submit" name="save" class="sub_btn">Save</button>
                <button type="button" onclick="hideOfficeAddForm()" class="sub_btns">Cancel</button>
                <div class="spans">
                    <span class="spandetails" id="position"></span>
                    <span class="spandetails" id="deptname"></span><br>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
<?php
// Include the database connection file
include "connection.php";

// Check if the id, officeID, and year parameters are set in the URL for delete
if (isset($_GET['delete']) && isset($_GET['id']) && isset($_GET['officeID']) && isset($_GET['year'])) {
    // Get the value of the id, officeID, and year parameters
    $id = $_GET['id'];
    $officeID = $_GET['officeID'];
    $year = $_GET['year'];

    // Delete the record from the database
    $query = "DELETE FROM officer WHERE id='$id' AND officeID='$officeID' AND year='$year'";
    mysqli_query($conn, $query);

    // Redirect to the officer.php page after deleting the record
    echo "<script>window.location.href ='officer.php';</script>";
    exit;
}

// Check if the id parameter is set in the URL
if (isset($_GET['id']) && isset($_GET['officeID']) && isset($_GET['year'])) {
    // Get the value of the id, officeID, and year parameters
    $id = $_GET['id'];
    $officeID = $_GET['officeID'];
    $year = $_GET['year'];

    // Retrieve the corresponding record from the database
    $query = "SELECT * FROM officer WHERE id='$id' AND officeID='$officeID' AND year='$year'";
    $result = mysqli_query($conn, $query);

    // Check if the record exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Populate the form fields with the record's data
        echo "<script>";
        echo "document.getElementById('id').value = '{$row['id']}';";
        echo "document.getElementById('officeID').value = '{$row['officeID']}';";
        echo "document.getElementById('year').value = '{$row['year']}';";
        echo "document.getElementById('id').setAttribute('readonly', true);";
        echo "document.getElementById('year').setAttribute('readonly', true);";
        echo "document.getElementById('popup').style.display = 'block';";
        echo "</script>";
    }
}

// Insert or update officer record
if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $officeID = $_POST['officeID'];
    $year = $_POST['year'];

    // Check if officer ID exists in the office table
    $result = mysqli_query($conn, "SELECT * FROM office WHERE officeID='$officeID'");
    if (mysqli_num_rows($result) <= 0) {
        echo "<script>alert('Invalid office ID.');</script>";
        exit();
    }

    // Get office details for the popup
    $row = mysqli_fetch_assoc($result);
    $position = $row['position'];
    $deptname = $row['deptname'];

    // Check if ID exists in the churchmembership table
    $result = mysqli_query($conn, "SELECT * FROM churchmembership WHERE id='$id'");
    if (mysqli_num_rows($result) <= 0) {
        echo "<script>alert('Member ID not found.'); document.getElementById('popup').style.display = 'none'; window.location.href ='officer.php';</script>";
        exit();
    }

    if (isset($_POST['update'])) {
        // Officer ID is provided, update the record
        $oldOfficeID = $_POST['oldOfficeID'];
        $oldId = $row['id'];
        $oldYear = $row['year'];
        $query = "UPDATE officer SET officeID='$officeID' WHERE id='$oldId' AND year='$oldYear' AND officeID='$oldOfficeID'";

        // Check if any fields were actually changed
        $result = mysqli_query($conn, "SELECT * FROM officer WHERE id='$id' AND officeID='$officeID' AND year='$year' ");
        $oldValues = mysqli_fetch_assoc($result);

        if ($oldValues['officeID'] == $officeID && $oldValues['id'] == $id && $oldValues['year'] == $year) {
            // No fields have been changed
            echo "<script>alert('No changes have been made.'); document.getElementById('popup').style.display = 'none'; window.location.href ='officer.php';</script>";
            exit;
        }

        // Check if the updated record already exists
        $result = mysqli_query($conn, "SELECT * FROM officer WHERE id='$id' AND officeID='$officeID' AND year='$year' ");
        if (mysqli_num_rows($result) > 0) {
            // Record already exists, show alert message and abort
            echo "<script>alert('Record already exists.'); document.getElementById('popup').style.display = 'none'; window.location.href ='officer.php';</script>";
            exit();
        }
    } else {
        // Officer ID is not provided, create a new record
        $query = "INSERT INTO officer (id, officeID, year) VALUES ('$id', '$officeID', '$year')";

        // Check if the record already exists
        $result = mysqli_query($conn, "SELECT * FROM officer WHERE id='$id' AND officeID='$officeID' AND year='$year' ");
        if (mysqli_num_rows($result) > 0) {
            // Record already exists, show alert message and abort
            echo "<script>alert('Record already exists.'); document.getElementById('popup').style.display = 'none'; window.location.href ='officer.php';</script>";
            exit();
        }
    }

    mysqli_query($conn, $query);
    if (isset($_POST['update'])) {
        echo "<script>alert('Data updated successfully.'); document.getElementById('popup').style.display = 'none'; window.location.href ='officer.php';</script>";
    } else {
        echo "<script>alert('Data added successfully.'); document.getElementById('popup').style.display = 'none'; window.location.href ='officer.php';</script>";
    }
    exit;
}

// If search button has been clicked
if (isset($_POST['search'])) {
    $searchID = $_POST['searchID'];
    $searchPosition = $_POST['searchPosition'];
    $searchYear = $_POST['searchYear'];

    // Construct the search query with ID and/or name filters
    $query = "SELECT * FROM officer WHERE 1 = 1 ";
    if (!empty($searchID)) {
        $query .= "AND id = '$searchID' ";
    }
    if (!empty($searchPosition)) {
        $query .= "AND officeID = '$searchPosition' ";
    }
    if (!empty($searchYear)) {
        $query .= "AND year = '$searchYear' ";
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

    // Display search results in a table
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='container'>";
        echo "<table border='1' cellpadding='0'>";
        echo "<tr>";
        echo "<th><a href=\"officer.php?sort=id&order=$order\">ID</a></th>";
        echo "<th><a href=\"officer.php?sort=officeID&order=$order\">Office ID</a></th>";
        echo "<th><a href=\"officer.php?sort=year&order=$order\">Year</a></th>";

        echo "<th>Operation</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td class='member-id' data-id='" . $row['id'] . "'>" . $row['id'] . "</td>";
            echo "<td class='office-id' data-id='" . $row['officeID'] . "'>" . $row['officeID'] . "</td>"; // Change data-id
            echo "<td>" . $row['year'] . "</td>";

            echo "<td>
                    <a href='officer.php?id=" . $row['id'] . "&officeID=" . $row['officeID'] . "&year=" . $row['year'] . "' class='opt'>Edit</a>
                    <a href='officer.php?delete=true&id=" . $row['id'] . "&officeID=" . $row['officeID'] . "&year=" . $row['year'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? ID:" . $row['id'] . ", Office ID:" . $row['officeID'] . ", Year:" . $row['year'] . "\")'>Delete</a>
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
    // Retrieve officer records from the database
    $query = "SELECT * FROM officer";
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'officeID';
    $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
    $query .= " ORDER BY $sort $order";
    $result = mysqli_query($conn, $query);

    // Display all stored data automatically
    if (isset($_GET['viewData']) || !isset($_GET['search'])) {
        ?>
        <div class="container">
            <table border="1" cellpadding="0">
                <tr>
                    <th><a
                            href="officer.php?sort=id&order=<?php echo $sort == 'id' && $order == 'asc' ? 'desc' : 'asc'; ?>">ID</a>
                    </th>
                    <th><a
                            href="officer.php?sort=officeID&order=<?php echo $sort == 'officeID' && $order == 'asc' ? 'desc' : 'asc'; ?>">Office
                            ID</a>
                    </th>
                    <th><a
                            href="officer.php?sort=year&order=<?php echo $sort == 'year' && $order == 'asc' ? 'desc' : 'asc'; ?>">Year</a>
                    </th>

                    <th>Operation</th>
                </tr>

                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td class='member-id' data-id='" . $row['id'] . "'>" . $row['id'] . "</td>";
                    echo "<td class='office-id' data-id='" . $row['officeID'] . "'>" . $row['officeID'] . "</td>"; // Change data-id
                    echo "<td>" . $row['year'] . "</td>";

                    echo "<td>
                    <a href='officer.php?id=" . $row['id'] . "&officeID=" . $row['officeID'] . "&year=" . $row['year'] . "' class='opt'>Edit</a>
                    <a href='officer.php?delete=true&id=" . $row['id'] . "&officeID=" . $row['officeID'] . "&year=" . $row['year'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? ID:" . $row['id'] . ", Office ID:" . $row['officeID'] . ", Year:" . $row['year'] . "\")'>Delete</a>
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
        document.getElementById("id").value = "";
        document.getElementById("officeID").value = "";
        document.getElementById("year").value = "";
        document.getElementById("popup").style.display = "block";
    }

    function hideOfficeAddForm() {
        document.getElementById("popup").style.display = "none";
    }

    function showOfficeDetails() {
        var officeID = document.getElementById("officeID").value.trim();
        if (officeID !== '') {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    if (response.error) {
                        alert(response.error);
                    } else {
                        document.getElementById("position").innerText = response.position;
                        document.getElementById("deptname").innerText = response.deptname;
                        document.getElementById("popup").style.display = "block";
                    }
                }
            };
            xhttp.open("GET", "getofficedetails.php?officeID=" + officeID, true);
            xhttp.send();
        }
    }




    $(document).ready(function () {
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



    $(document).ready(function () {
        // Show office when hovering over office ID in table rows
        $(document).on("mouseenter", ".office-id", function () {
            let officeID = $(this).data("id"); // Change data('officeID') into data('id')
            if (officeID) {
                let $row = $(this).closest("tr"); // Find the closest table row
                $.ajax({
                    url: "getofficetable.php",
                    method: "POST",
                    data: {
                        officeID: officeID
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data !== null) {
                            let officeName = data.position + " : " + data.deptname;
                            let popup = "<div class='office-popup'>" + officeName + "</div>";
                            $(popup)
                                .appendTo($row) // Append to the table row
                                .css({
                                    position: "absolute",
                                    top: $row.offset().top + $row.outerHeight() - 5, // Adjust the top offset by 5 pixels
                                    left: $row.offset().left + 10 // Adjust the left offset by 10 pixels
                                });
                        } else {
                            alert("Office ID not found.");
                        }
                    }
                });
            } else {
                alert("Invalid Office ID.");
            }
        }).on("mouseleave", ".office-id", function () {
            // Hide the popup when hovering away from the table row
            $(".office-popup").remove();
        });
    });


    function memberIDKeyUp(id) {
        console.log("Member ID:", id); // Debug statement to check if the input value is being passed correctly

        if (id) {
            $.ajax({
                url: "getMemberName.php",
                method: "POST",
                data: { id: id },
                dataType: "json",
                success: function (data) {
                    console.log("Member data:", data); // Debug statement to check if the JSON data is being returned correctly

                    if (data !== null) {
                        $("#memberNames").text(data.fname + " " + data.lname);
                    } else {
                        $("#memberNames").text("Member ID not found.");
                    }
                }
            });
        } else {
            $("#memberNames").text("");
        }
    }

    function checkIfNumber(inputElem) {
        // Get the input value
        var value = inputElem.value;

        // Remove any non-digit characters from the input
        var cleanedValue = value.replace(/\D/g, '');

        // Replace the input value with the cleaned value if they are not equal
        if (value !== cleanedValue) {
            alert('Please enter a valid number.');
            inputElem.value = cleanedValue;
        }
    }

    function checkYearFormat(inputElem) {
        // Get the input value
        var value = inputElem.value;

        // Remove any non-numeric characters from the input
        inputElem.value = value.replace(/[^0-9]/g, '');

        // Limit the input to four characters
        inputElem.value = inputElem.value.slice(0, 4);

        // Test if the value is in the format YYYY using a regular expression
        if (inputElem.value.length === 4 && !/^\d{4}$/.test(inputElem.value)) {
            alert('Please enter a valid 4-digit year (YYYY).');

            // Remove the invalid input value
            inputElem.value = '';
        }
    }


</script>