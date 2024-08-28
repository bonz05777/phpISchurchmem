<?php
// Include the connection.php file
include "connection.php";

// Check if the id parameter is set in the URL and the user has confirmed the delete operation
if (isset($_GET['id']) && isset($_GET['confirm'])) {
    // Get the value of the id parameter
    $id = $_GET['id'];

    // Delete the record from the memberpersonaldetails table where id matches
    $delete_church = mysqli_query($conn, "DELETE FROM memberpersonaldetails WHERE id = '$id'");

    // Redirect to this page to prevent resubmission of the delete operation
    header("Location: showmemberdetails.php");
}

function searchByID($id) {
    global $conn;

    // Select records where the ID matches the search query
    $query = "SELECT * FROM memberpersonaldetails WHERE id = '$id'";
    $select = mysqli_query($conn, $query);

    // Return the search results
    return mysqli_fetch_all($select, MYSQLI_ASSOC);
}

// Check if the search form is submitted
if (isset($_GET['searchID'])) {
    // Get the value of the search query
    $id = $_GET['searchID'];

    // Search for records matching the query
    $results = searchByID($id);
} elseif (isset($_GET['searchAll'])) {
    // Get the value of the search query
    $query = $_GET['searchAll'];

    // Search for records matching the query across all fields
    $select = mysqli_query($conn, "SELECT * FROM memberpersonaldetails WHERE 
        id LIKE '%$query%' OR 
        civilstatus LIKE '%$query%' OR 
        addressID LIKE '%$query%' OR 
        birthdate LIKE '%$query%' OR 
        birthplace LIKE '%$query%' OR 
        father LIKE '%$query%' OR 
        mother LIKE '%$query%' OR 
        educlevel LIKE '%$query%' OR 
        contactnumber LIKE '%$query%'");

    // Fetch all matching records
    $results = mysqli_fetch_all($select, MYSQLI_ASSOC);
} else {
    // Select all records
    $select = mysqli_query($conn, "SELECT * FROM memberpersonaldetails");
    $results = mysqli_fetch_all($select, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>MEMBERS PERSONAL INFO</title>

    <!-- Link to styledatashow.css for styling -->
    <link rel="stylesheet" type="text/css" href="/church_member/login_register/styledatashow.css">
</head>
<body>
    <div class="title">
        <h1>MEMBERS PERSONAL INFO</h1>
    </div>

    <div class="options">
        <ul>
            <div>
                <a href='/church_member/login_register/home.php?' class="lefthomebtn">HOME</a>
            </div>

            <div>
                <form action="" method="GET">
                    <input type="text" id="searchID" name="searchID" placeholder="Search ID">
                    <input type="text" id="searchAll" name="searchAll" placeholder="Search All">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>

            <div>
                <a href='addmemberdetails.php?' >Add Member Details</a>
            </div>



            <div>
                <a href='/church_member/login_register/index.php?' >Logout</a>
            </div>
        </ul>
    </div>

    <div class="container">
        <table border="1" cellpadding="0">
            <tr>
                <th>ID</th>
                <th>Civil Status</th>
                <th>Address ID</th>
                <th>Birthdate</th>
                <th>Birthplace</th>
                <th>Father</th>
                <th>Mother</th>
                <th>Education Level</th>
                <th>Contact Number</th>
                <th>Operation</th>
            </tr>

            <?php
            // If there are records available
            if (count($results) > 0){
                // Loop through each record and display the data in a table row
                foreach ($results as $result){
                    echo "
                        <tr>
                            <td>".$result['id']."</td>
                            <td>".$result['civilstatus']."</td>
                            <td>".$result['addressID']."</td>
                            <td>".$result['birthdate']."</td>
                            <td>".$result['birthplace']."</td>
                            <td>".$result['father']."</td>
                            <td>".$result['mother']."</td>
                            <td>".$result['educlevel']."</td>
                            <td>".$result['contactnumber']."</td>
                            <td>
                                <a href='addmemberdetails.php?id=".$result['id']."' class='opt'>Edit</a>
                                <a href='?id=".$result['id']."&confirm=true' class='opt1'>Delete</a>                           
                            </td>
                        </tr>
                    ";
                }
            } else {
                echo "<tr><td colspan='10'>No matching records found</td></tr>";
            }
            ?>

        </table>
    </div>

</body>
</html>