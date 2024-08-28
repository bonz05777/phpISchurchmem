<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MINISTER INFO</title>
    <link rel="stylesheet" type="text/css" href="styleministershow.css">
</head>

<body>
    <div style="position: relative;">
        <img src="/church_member/images/SDALogo.png" alt="SDA Logo"
            style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; height: 10vh; width: 6vw; margin-left: 5vw; margin-top:2.5vh;">
    </div>
    <div class="title">
        <h1>MINISTER INFO</h1>
    </div>

    <div class="options">
        <ul>
            <div>
                <a href='/church_member/login_register/home.php?' class="lefthomebtn">HOME</a>
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
                <label class="labelmin">MINISTERIAL DETAIL</label>

                <div>
                    <input type="hidden" id="ministerID" name="ministerID" class="data-insert" value="">
                    <br>
                </div>
                <div>

                    <input type="text" id="ministerfname" name="ministerfname" class="data-insert"
                        placeholder="Enter First Name" required
                        oninput="checkInput(this); this.value = toUpperCaseFirst(this.value);">
                    <br>
                </div>
                <div>

                    <input type="text" id="ministermname" name="ministermname" class="data-insert"
                        placeholder="Enter Middle Name" required
                        oninput="checkInput(this); this.value = toUpperCaseFirst(this.value);">


                    <br>
                </div>
                <div>

                    <input type="text" id="ministerlname" name="ministerlname" class="data-insert"
                        placeholder="Enter Last Name" required
                        oninput="checkInput(this); this.value = toUpperCaseFirst(this.value);">

                    <script>
                        function checkInput(input) {
                            var value = input.value;
                            if (!/^[a-zA-Z.\s]*$/g.test(value) && value.length > 0) {
                                alert('Invalid input: only letters and spaces are allowed.');
                                input.value = input.value.replace(/[^a-zA-Z.\s]/g, '');
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


                    <br>
                </div>




                <button type="submit" name="save" class="sub_btn">Save</button>
                <button type="button" onclick="hideMinisterAddForm()" class="sub_btns">Cancel</button>
            </form>
        </div>
    </div>

</body>

</html>

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
            echo "<script>window.location.href = 'ministeradd.php';</script>";
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

    // Check if any changes have been made before updating the minister record
    $query = "SELECT * FROM minister WHERE ministerID='$ministerID'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['ministerfname'] == $ministerfname && $row['ministermname'] == $ministermname && $row['ministerlname'] == $ministerlname) {
            echo "<script>alert('Data with ID: " . $_POST['ministerID'] . " No changes have been made.');</script>";



        }
    }

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
            echo "<script>alert('Minister Record already exists with the same details. Please modify the data.');
        ;document.getElementById(\"ministerID\").value = \"" . $row['ministerID'] . "\";
        document.getElementById(\"ministerfname\").value = \"" . $row['ministerfname'] . "\";
        document.getElementById(\"ministermname\").value = \"" . $row['ministermname'] . "\";
        document.getElementById(\"ministerlname\").value = \"" . $row['ministerlname'] . "\";
        document.getElementById(\"popup\").style.display = \"block\";</script>";
            exit();
        } else {
            $query = "INSERT INTO minister (ministerfname, ministermname, ministerlname) VALUES ('$ministerfname', '$ministermname', '$ministerlname')";
        }
    }

    mysqli_query($conn, $query);

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

    // Handle sorting
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'ministerID';
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

        echo "<th><a href=\"ministeradd.php?sort=ministerID&order=$order\">ID</a></th>";
        echo "<th><a href=\"ministeradd.php?sort=ministerfname&order=$order\">Firstname</a></th>";
        echo "<th><a href=\"ministeradd.php?sort=ministermname&order=$order\">Lastname</a></th>";
        echo "<th><a href=\"ministeradd.php?sort=ministerlname&order=$order\">Middlename</a></th>";

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

                <a href='ministeradd.php?delete=true&ministerID=" . $row['ministerID'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? ID:" . $row['ministerID'] . " Name: " . $row['ministerfname'] . " " . $row['ministerlname'] . "\")'>Delete</a>

         
                
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

    }
} else {
    // Retrieve minister records from the database
    $query = "SELECT * FROM minister";
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'ministerID';
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
                            href="ministeradd.php?sort=ministerID&order=<?php echo $sort == 'ministerID' && $order == 'asc' ? 'desc' : 'asc'; ?>">ID</a>
                    <th><a
                            href="ministeradd.php?sort=ministerfname&order=<?php echo $sort == 'ministerfname' && $order == 'asc' ? 'desc' : 'asc'; ?>">Firstname</a>
                    <th><a
                            href="ministeradd.php?sort=ministermname&order=<?php echo $sort == 'ministermname' && $order == 'asc' ? 'desc' : 'asc'; ?>">Middlename</a>
                    <th><a
                            href="ministeradd.php?sort=ministerlname&order=<?php echo $sort == 'ministerlname' && $order == 'asc' ? 'desc' : 'asc'; ?>">Lastname</a>
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
                        <a href='ministeradd.php?delete=true&ministerID=" . $row['ministerID'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? ID:" . $row['ministerID'] . " Name: " . $row['ministerfname'] . " " . $row['ministerlname'] . "\")'>Delete</a>

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