<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MINISTER INFO</title>
    <link rel="stylesheet" type="text/css" href="styleministershow.css">
</head>

<body>
    <div class="title">
        <h1>MINISTER INFO</h1>
    </div>

    <div class="options">
        <ul>
            <div>
                <a href='/church_member/login_register/home.php?'>HOME</a>
            </div>

            <div>
                <button class="addnew" onclick="showMinisterAddForm()">Add New</button>
            </div>
            <div>
                <form action="" method="GET">
                    <input type="text" id="searchID" name="searchID" placeholder="Search ID">
                    <input type="text" id="searchName" name="searchName" placeholder="Search Name">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>
            <div>
                <a href='ministeradd.php?viewData=true'>View Data</a>
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
            height: 350px;
            text-decoration: none;
            z-index:1;">

        <style>
            .opt2 {
                background-color: rgb(1, 52, 148);
                color: #ffff;
                cursor: pointer;
                font-size: 16px;
                text-decoration: none;
                padding: 3px;
            }
        </style>

        <div class="contents">
            <form action="" method="POST">
                <label class="labelmin">MINISTERIAL DETAIL</label>

                <div>
                    <input type="hidden" id="ministerID" name="ministerID" class="data-insert" value="">
                    <br>
                </div>
                <div>
                    <input type="text" id="ministerfname" name="ministerfname" class="data-insert"
                        placeholder="Enter First Name" required>
                    <br>
                </div>
                <div>
                    <input type="text" id="ministermname" name="ministermname" class="data-insert"
                        placeholder="Enter Middle Name" required>
                    <br>
                </div>
                <div>
                    <input type="text" id="ministerlname" name="ministerlname" class="data-insert"
                        placeholder="Enter Last Name" required>
                    <br>
                </div>
                <button type="submit" name="save" class="sub_btn">Save</button>
                <button type="button" onclick="hideMinisterAddForm()" class="sub_btns">Cancel</button>
            </form>
        </div>
    </div>

    <?php
    // Include the database connection file
    include "connection.php";

    // Check if the ID parameter is set in the URL
    if (isset($_GET['ministerID']) || isset($_GET['delMinisterID'])) {
        // Check if the ministerID parameter is set in the URL
        if (isset($_GET['ministerID'])) {
            // Get the value of the ministerID parameter
            $ministerID = $_GET['ministerID'];

            // Retrieve the minister record from the database
            $query = "SELECT * FROM minister WHERE ministerID='$ministerID'";
            $result = mysqli_query($conn, $query);

            // Populate the form with minister record values
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $ministerfname = $row['ministerfname'];
                $ministermname = $row['ministermname'];
                $ministerlname = $row['ministerlname'];
                ?>
                <script>
                    // Display the update pop-up with minister record values
                    document.getElementById("ministerID").value = "<?php echo $ministerID; ?>";
                    document.getElementById("ministerfname").value = "<?php echo $ministerfname; ?>";
                    document.getElementById("ministermname").value = "<?php echo $ministermname; ?>";
                    document.getElementById("ministerlname").value = "<?php echo $ministerlname; ?>";
                    document.getElementById("popup").style.display = "block";
                </script>
                <?php
            }
        }

        // Check if the delMinisterID parameter is set in the URL
        if (isset($_GET['delMinisterID'])) {
            // Get the value of the delMinisterID parameter
            $delMinisterID = $_GET['delMinisterID'];

            // Delete the record from the minister table where ID matches
            $delete_minister = mysqli_query($conn, "DELETE FROM minister WHERE ministerID='$delMinisterID'");

            // Delete the record from the minister_assigned table where ID matches
            $delete_ministerassigned = mysqli_query($conn, "DELETE FROM minister_assigned WHERE ministerID='$delMinisterID'");

            // If both deletes are successful, redirect to ministeradd.php and terminate the script
            if ($delete_minister && $delete_ministerassigned) {
                header("Location: ministeradd.php");
                die();
            }
        }
    }

    // Insert or update minister record
    if (isset($_POST['save'])) {
        $ministerID = $_POST['ministerID'];
        $ministerfname = $_POST['ministerfname'];
        $ministermname = $_POST['ministermname'];
        $ministerlname = $_POST['ministerlname'];

        if (!empty($ministerID)) {
            // Minister ID is provided, update the record
            $query = "SELECT * FROM minister WHERE ministerID <> '$ministerID' AND ministerfname='$ministerfname' AND ministermname='$ministermname' AND ministerlname='$ministerlname'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                // Display an alert if records existed and fill the form with the existing minister record values
                echo "<script>alert('Minister Record already exists with the same details. Please modify the data.');</script>";
                ?>
                <script>
                    document.getElementById("ministerfname").value = "<?php echo $ministerfname; ?>";
                    document.getElementById("ministermname").value = "<?php echo $ministermname; ?>";
                    document.getElementById("ministerlname").value = "<?php echo $ministerlname; ?>";
                    document.getElementById("popup").style.display = "block";
                </script>
                <?php
                exit();
            }
            $query = "UPDATE minister SET ministerfname='$ministerfname', ministermname='$ministermname',
            ministerlname='$ministerlname' WHERE ministerID='$ministerID'";
        } else {
            // Minister ID is not provided, create a new record
            // Check if the minister already exists
            $query = "SELECT * FROM minister WHERE ministerfname='$ministerfname' AND ministermname='$ministermname' AND ministerlname='$ministerlname'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                // Display an alert if records existed and fill the form with the existing minister record values
                $row = mysqli_fetch_assoc($result);
                echo "<script>alert('Minister Record already exists.');
            ;document.getElementById(\"ministerID\").value = \"" . $row['ministerID'] . "\";document.getElementById(\"ministerfname\").value = \"" . $row['ministerfname'] . "\";document.getElementById(\"ministermname\").value = \"" . $row['ministermname'] . "\";document.getElementById(\"ministerlname\").value = \"" . $row['ministerlname'] . "\";document.getElementById(\"popup\").style.display = \"block\";</script>";
                exit();
            } else {
                $query = "INSERT INTO minister (ministerfname, ministermname, ministerlname) VALUES ('$ministerfname', '$ministermname', '$ministerlname')";
            }
        }

        mysqli_query($conn, $query);
        if (mysqli_affected_rows($conn) > 0) {
            // Redirect to ministeradd.php if the update was successful
            header("Location: ministeradd.php");
            exit();
        }
    }




    // If search button has been clicked
    if (isset($_GET['search'])) {
        $searchID = $_GET['searchID'];
        $searchName = $_GET['searchName'];

        // Construct the search query with ID and/or name filters
        $query = "SELECT * FROM minister WHERE 1 = 1 ";
        if (!empty($searchID)) {
            $query .= "AND ministerID = '$searchID' ";
        }
        if (!empty($searchName)) {
            $query .= "AND (ministerfname LIKE '%$searchName%' ";
            $query .= "OR ministermname LIKE '%$searchName%' ";
            $query .= "OR ministerlname LIKE '%$searchName%')";
        }

        // Execute the search query
        $result = mysqli_query($conn, $query);

        // Display search results in a table
        if (mysqli_num_rows($result) > 0) {
            echo "<div class='container'>";
            echo "<table border='1' cellpadding='0'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>First Name</th>";
            echo "<th>Middle Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Operation</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['ministerID'] . "</td>";
                echo "<td>" . $row['ministerfname'] . "</td>";
                echo "<td>" . $row['ministermname'] . "</td>";
                echo "<td>" . $row['ministerlname'] . "</td>";

                echo "<td>
                <a href='ministeradd.php?ministerID=" . $row['ministerID'] . "' class='opt'>Edit</a>
                <a href='ministeradd.php?delMinisterID=" . $row['ministerID'] . "' class='opt1'>Delete</a>
                <a href='/church_member/minister_assigned/ministerassigned.php?ministerID=" . $row['ministerID'] . "' class='opt2'>Assignment</a>
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
            // Display empty table if no results found 
            echo "<div class='container'>";
            echo "<table border='1' cellpadding='0'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>First Name</th>";
            echo "<th>Middle Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Operation</th>";
            echo "</tr>";
            echo "</table></div>";
        }
    } else {
        // Retrieve minister records from the database
        $query = "SELECT * FROM minister";
        $result = mysqli_query($conn, $query);

        // Display all stored data automatically
        if (isset($_GET['viewData']) || !isset($_GET['search'])) {
            ?>
            <div class="container">
                <table border="1" cellpadding="0">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Operation</th>
                    </tr>

                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['ministerID'] . "</td>";
                        echo "<td>" . $row['ministerfname'] . "</td>";
                        echo "<td>" . $row['ministermname'] . "</td>";
                        echo "<td>" . $row['ministerlname'] . "</td>";

                        echo "<td>
                        <a href='ministeradd.php?ministerID=" . $row['ministerID'] . "' class='opt'>Edit</a>
                        <a href='ministeradd.php?delMinisterID=" . $row['ministerID'] . "' class='opt1'>Delete</a>
                        <a href='/church_member/minister_assigned/ministerassigned.php?ministerID=" . $row['ministerID'] . "' class='opt2'>Assignment</a>
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
        function showMinisterAddForm() {
            // Clear the form and display the pop-up
            document.getElementById("ministerID").value = "";
            document.getElementById("ministerfname").value = "";
            document.getElementById("ministermname").value = "";
            document.getElementById("ministerlname").value = "";
            document.getElementById("popup").style.display = "block";
        }

        function hideMinisterAddForm() {
            // Hide the pop-up
            document.getElementById("popup").style.display = "none";
        }
        // Display the table even after alerts 
        window.onload = function () {
            document.getElementById("ministerTable").style.visibility = "visible";
        };
    </script>

</body>

</html>