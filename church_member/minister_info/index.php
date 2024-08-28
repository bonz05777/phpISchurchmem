<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>MINISTER INFO</title>
    <link rel="stylesheet" type="text/css" href="/church_member/login_register/.css">
</head>
<body>
    <div class="title">
        <h1>MINISTER INFO</h1>
    </div>

    <div class="options">
        <ul>
            <div>
                <button onclick="openForm()">Add New</button>
            </div>
            <div>
                <form action="ministeradd.php" method="GET">
                    <input type="text" id="searchID" name="searchID" placeholder="Search ID">
                    <input type="text" id="searchLName" name="searchLName" placeholder="Search Last Name">
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

    <div id="popup"></div>

    <?php
    // Include the database connection file
    include "connection.php";

    // Delete minister record
    if (isset($_GET['delete'])) {
        $id = $_GET['id'];

        // Delete record from minister table
        $query = "DELETE FROM minister WHERE id = '$id'";
        mysqli_query($conn, $query);

        // Redirect to index.php
        header("Location: index.php");
        exit();
    }

    // Retrieve minister records from the database if search button is not clicked or no search filters are specified
    $query = "SELECT * FROM minister";

    // If search button has been clicked
    if (isset($_GET['search'])) {
        $searchID = $_GET['searchID'];
        $searchLName = $_GET['searchLName'];

        // Construct the search query with ID and/or Last Name filters 
        $query = "SELECT * FROM minister WHERE 1 = 1 ";
        if (!empty($searchID)) { $query .= "AND ministerID = '$searchID' "; }
        if (!empty($searchLName)) { $query .= "AND ministerlname = '$searchLName'"; } 
    }

    $result = mysqli_query($conn, $query);
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
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row['ministerID']."</td>";
                echo "<td>".$row['ministerfname']."</td>";
                echo "<td>".$row['ministermname']."</td>";
                echo "<td>".$row['ministerlname']."</td>";
                echo "<td>
                        <a href='ministeradd.php?id=".$row['id']."' class='opt'>Edit</a>
                        <a href='index.php?delete=true&id=".$row['id']."' class='opt1'>Delete</a>
                      </td>";
                echo "</tr>";
            }
            ?>

        </table>
    </div>

    <!-- Script for popup form --> 
    <script>
      function openForm() {
        document.getElementById("popup").innerHTML='<object type="text/html" data="addminister.php" ></object>';
      }
    </script>
</body>
</html>