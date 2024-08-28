
<?php

// Include the database connection file
include "connection.php";

// Function to check if id and year already exist in status table
function checkExistence($id, $year) {
    global $conn;
    $query = "SELECT * FROM status WHERE id = '$id' AND year = '$year'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}

// Function to get list of IDs from churchmembership table
function getIDs() {
    global $conn;
    $query = "SELECT id FROM churchmembership";
    $result = mysqli_query($conn, $query);
    $ids = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $ids[] = $row['id'];
    }
    return $ids;
}

// Insert/update status data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $fq = $_POST['fq'];
    $sq = $_POST['sq'];
    $tq = $_POST['tq'];
    $year = $_POST['year'];
    
    // Function to check if ID is present in churchmembership table
function checkMembership($id) {
    global $conn;
    $sql = "SELECT * FROM churchmembership WHERE id = '$id'";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}

// Function to check if ID and year are already present in status table
function isDuplicate($id, $year) {
    global $conn;
    $sql = "SELECT * FROM status WHERE id = '$id' AND year = '$year'";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}

// Check if ID is present in churchmembership table before inserting or updating
if (!checkMembership($id)) {
    echo "<script>alert('ID not found in churchmembership table.');</script>";
    exit;
}

// Check if ID and year are already present in status table
if (isDuplicate($id, $year)) {
    echo "<script>alert('This ID and year combination already exists in the status table.');</script>";
    exit;
}

// Insert new status data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $sql = "INSERT INTO status (id, fq, sq, tq, year) VALUES ('$id', '$fq', '$sq', '$tq', '$year')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Status record added successfully.');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Update existing status data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $sql = "UPDATE status SET fq = '$fq', sq = '$sq', tq = '$tq' WHERE id = '$id' AND year = '$year'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Status record updated successfully.');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
}

// Delete status record
if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $year = $_GET['year'];
    // Delete record from status table
    $query = "DELETE FROM status WHERE id = '$id' AND year = '$year'";
    mysqli_query($conn, $query);
    // Redirect to statusform.php
    header("Location: statusform.php");
    exit();
}


// Search status records
if (isset($_GET['search'])) {
    $searchID = $_GET['searchID'];
    $searchYear = $_GET['searchYear'];

    // Construct the search query
    $query = "SELECT * FROM status WHERE id LIKE '%$searchID%'";
    if (!empty($searchYear)) {
        $query .= " AND year = '$searchYear'";
    }

    // Execute the search query
    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>MEMBER'S STATUS</title>
    <link rel="stylesheet" type="text/css" href="stylestatusshow.css">
</head>
<body>
    <div class="title">
        <h1>MEMBER'S STATUS</h1>
    </div>

    <div class="options">
        <ul>
            <div>
                <a href='addstatus.php'>Add New</a>
            </div>
            <div>
                <a href='datashowmemberlist.php'>View Data</a>
            </div>
        </ul>
    </div>

    <div class="container">
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
            // Retrieve status records from database
            $query = "SELECT * FROM status";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['fq']."</td>";
                echo "<td>".$row['sq']."</td>";
                echo "<td>".$row['tq']."</td>";
                echo "<td>".$row['year']."</td>";
                echo "<td>
                    <a href='updatestatus.php? id=".$row['id']."&year=".$row['year']."' class='opt'>Edit</a> 
                    <a href='statusform.php?delete=true&id=".$row['id']."&year=".$row['year']."'class='opt1'>Delete</a>
                </td>";
                echo "</tr>";
            }
            ?>
        </table>
     
    </div>

    


    <div class="container">
    <form action="" method="GET">
        <div>
            <label for="searchID">ID:</label>
            <input type="text" id="searchID" name="searchID">
        </div>
        <div>
            <label for="searchYear">Year:</label>
            <input type="text" id="searchYear" name="searchYear">
        </div>
        <div>
            <button type="submit" name="search">Search</button>
        </div>
    </form>

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
        // Display the search results
        if (isset($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['fq']."</td>";
                echo "<td>".$row['sq']."</td>";
                echo "<td>".$row['tq']."</td>";
                echo "<td>".$row['year']."</td>";
                echo "<td>
                    <a href='updatestatus.php?id=".$row['id']."&year=".$row['year']."' class='opt'>Edit</a>
                    <a href='statusform.php?delete=true&id=".$row['id']."&year=".$row['year']."' class='opt1'>Delete</a>
                </td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</div>


    
</body>

</html>