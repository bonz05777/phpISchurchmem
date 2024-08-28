<style>
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

    .options ul {
        list-style: none;
        background: #020004;
        padding: 0;
        margin-bottom: 20pt;
        margin-top: -20pt;
        text-align: right;
    }
</style>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <div style="position: relative;">
        <img src="/church_member/images/SDALogo.png" alt="SDA Logo"
            style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; height: 10vh; width: 6vw; margin-left: 5vw; margin-top:2.5vh;">
    </div>
    <title>MEMBERSHIP DATA</title>

    <!-- Link to styledatashow.css for styling -->
    <link rel="stylesheet" type="text/css" href="styledataviewmember.css">
</head>

<body>
    <div class="title">
        <h1>MEMBERSHIP DATA</h1>
    </div>

    <div class="options">
        <ul>
            <div>
                <a href='home.php?' class="lefthomebtn">HOME</a>
            </div>

            <div>
                <form action="" method="GET">
                    <input type="text" id="searchID" name="searchID" placeholder="Search ID">
                    <input type="text" id="searchlname" name="searchlname" placeholder="Search Last Name">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>

            <div>
                <a href='addmember.php?'>Add New Member</a>
            </div>
            <div>
                <a href='datashowmemberlist.php?viewData=true'>View Data</a>
            </div>


            <div>
                <a href='logout.php?'>Logout</a>
            </div>
        </ul>
    </div>



    <?php
    // Include the connection.php file
    include "connection.php";

    // Check if the submit button is clicked
    if (isset($_POST['submit'])) {
        // Redirect to datashowmemberlist.php
        header("Location: datashowmemberlist.php");
        exit();
    }

    // Check if the id parameter is set in the URL
    if (isset($_GET['id'])) {
        // Get the value of the id parameter
        $id = $_GET['id'];

        // Delete the record from the churchmembership table where id matches
        $delete_church = mysqli_query($conn, "DELETE FROM churchmembership WHERE id = '$id'");

        // Delete the record from the status table where id matches
        $delete_status = mysqli_query($conn, "DELETE FROM status WHERE id = '$id'");

        // Delete the record from the memberpersonaldetails table where id matches
        $delete_memberpersonaldetails = mysqli_query($conn, "DELETE FROM memberpersonaldetails WHERE id = '$id'");


        // Delete the record from the officer table where id matches
        $delete_officerdetails = mysqli_query($conn, "DELETE FROM officer WHERE id = '$id'");

        // Delete the record from the attendance table where id matches
        $delete_attendance = mysqli_query($conn, "DELETE FROM attendance WHERE id = '$id'");

        // If deletes are successful, redirect to datashowmemberlist.php and terminate the script
        if ($delete_church && $delete_status && $delete_memberpersonaldetails && $delete_officerdetails && $delete_attendance) {
            header("Location: datashowmemberlist.php");
            exit();
        }
    }

    // If search button has been clicked
    if (isset($_GET['search'])) {
        $searchID = $_GET['searchID'];
        $searchlname = $_GET['searchlname'];

        // Construct the search query with ID and/or year filters and sorting parameter
        $query = "SELECT * FROM churchmembership WHERE 1 = 1 ";
        if (!empty($searchID)) {
            $query .= "AND id = '$searchID' ";
        }
        if (!empty($searchlname)) {
            $query .= "AND lname = '$searchlname'";
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
        $search_result = mysqli_query($conn, $query);

        // Display search results in a table
        if (mysqli_num_rows($search_result) > 0) {
            echo "<div class='container'>";
            echo "<table border='1' cellpadding='0'>";
            echo '<tr>';
            echo "<th><a href=\"datashowmemberlist.php?sort=id&order=$order\">ID</a></th>";
            echo "<th><a href=\"datashowmemberlist.php?sort=lname&order=$order\">Lastname</a></th>";
            echo "<th><a href=\"datashowmemberlist.php?sort=fname&order=$order\">Firstname</a></th>";
            echo "<th><a href=\"datashowmemberlist.php?sort=mname&order=$order\">Middlename</a></th>";
            echo "<th><a href=\"datashowmemberlist.php?sort=baptizeddate&order=$order\">Date Baptized</a></th>";
            echo "<th><a href=\"datashowmemberlist.php?sort=placebaptized&order=$order\">Place Baptized</a></th>";
            echo "<th><a href=\"datashowmemberlist.php?sort=ministername&order=$order\">Officiating Minister</a></th>";
            echo "<th><a href=\"datashowmemberlist.php?sort=receivedby&order=$order\">Received By</a></th>";
            echo "<th><a href=\"datashowmemberlist.php?sort=receiveddate&order=$order\">Received Date</a></th>";
            echo "<th><a href=\"datashowmemberlist.php?sort=churchname&order=$order\">Church Name</a></th>";
            echo "<th>Operation</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($search_result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['lname'] . "</td>";
                echo "<td>" . $row['fname'] . "</td>";
                echo "<td>" . $row['mname'] . "</td>";
                echo "<td>" . $row['baptizeddate'] . "</td>";
                echo "<td>" . $row['placebaptized'] . "</td>";
                echo "<td>" . $row['ministername'] . "</td>";
                echo "<td>" . $row['receivedby'] . "</td>";
                echo "<td>" . $row['receiveddate'] . "</td>";
                echo "<td>" . $row['churchname'] . "</td>";
                echo "<td>
                        <a href='addmember.php?id=" . $row['id'] . "' class='opt'>Edit</a>
                        <a href='datashowmemberlist.php?delete=true&id=" . $row['id'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? ID:" . $row['id'] . ", Name:" . $row['fname'] . " " . $row['lname'] . "\")'>Delete</a>
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
        $query = "SELECT * FROM churchmembership";
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
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
                                href="datashowmemberlist.php?sort=id&order=<?php echo $sort == 'id' && $order == 'asc' ? 'desc' : 'asc'; ?>">ID</a>
                        </th>
                        <th><a
                                href="datashowmemberlist.php?sort=lname&order=<?php echo $sort == 'lname' && $order == 'asc' ? 'desc' : 'asc'; ?>">Lastname</a>
                        </th>
                        <th><a
                                href="datashowmemberlist.php?sort=fname&order=<?php echo $sort == 'fname' && $order == 'asc' ? 'desc' : 'asc'; ?>">Firstname</a>
                        </th>
                        <th><a
                                href="datashowmemberlist.php?sort=mname&order=<?php echo $sort == 'mname' && $order == 'asc' ? 'desc' : 'asc'; ?>">Middlename</a>
                        </th>
                        <th><a
                                href="datashowmemberlist.php?sort=baptizeddate&order=<?php echo $sort == 'baptizeddate' && $order == 'asc' ? 'desc' : 'asc'; ?>">Date
                                Baptized</a></th>
                        <th><a
                                href="datashowmemberlist.php?sort=placebaptized&order=<?php echo $sort == 'placebaptized' && $order == 'asc' ? 'desc' : 'asc'; ?>">Place
                                Baptized</a></th>
                        <th><a
                                href="datashowmemberlist.php?sort=ministername&order=<?php echo $sort == 'ministername' && $order == 'asc' ? 'desc' : 'asc'; ?>">Officiating
                                Minister</a></th>
                        <th><a
                                href="datashowmemberlist.php?sort=receivedby&order=<?php echo $sort == 'receivedby' && $order == 'asc' ? 'desc' : 'asc'; ?>">Received
                                By</a></th>
                        <th><a
                                href="datashowmemberlist.php?sort=receiveddate&order=<?php echo $sort == 'receiveddate' && $order == 'asc' ? 'desc' : 'asc'; ?>">Received
                                Date</a></th>
                        <th><a
                                href="datashowmemberlist.php?sort=churchname&order=<?php echo $sort == 'churchname' && $order == 'asc' ? 'desc' : 'asc'; ?>">Church
                                Name</a></th>
                        <th>Operation</th>
                    </tr>

                    <?php
                    include "connection.php";

                    // Select all records from churchmembership table
                    $select = mysqli_query($conn, $query);

                    // Get the number of rows returned
                    $num = mysqli_num_rows($select);

                    // If there are records available
                    if ($num > 0) {
                        // Loop through each record and display the data in a table row
                        while ($result = mysqli_fetch_assoc($select)) {
                            echo "
                        <tr>
                            <td>" . $result['id'] . "</td>
                            <td>" . $result['lname'] . "</td>
                            <td>" . $result['fname'] . "</td>
                            <td>" . $result['mname'] . "</td>
                            <td>" . $result['baptizeddate'] . "</td>
                            <td>" . $result['placebaptized'] . "</td>
                            <td>" . $result['ministername'] . "</td>
                            <td>" . $result['receivedby'] . "</td>
                            <td>" . $result['receiveddate'] . "</td>
                            <td>" . $result['churchname'] . "</td>
                            <td>
                                <a href='addmember.php?id=" . $result['id'] . "' class='opt'>Edit</a>
                                <a href='datashowmemberlist.php?delete=true&id=" . $result['id'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record? ID:" . $result['id'] . ", Name:" . $result['fname'] . " " . $result['lname'] . "\")'>Delete</a>               
                            </td>
                        </tr>
                    ";
                        }
                    }
                    ?>

                </table>
            </div>

            <?php
        }
    }
    ?>
</body>

</html>