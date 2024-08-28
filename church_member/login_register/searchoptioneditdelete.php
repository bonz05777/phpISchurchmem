<?php
include "connection.php"; // Include the connection.php file

if(isset($_POST['submit'])){ // Check if the submit button is clicked
    header("Location: datashowmemberlist.php"); // Redirect to datashowmemberlist.php
}

if (isset($_GET['id'])){ // Check if the id parameter is set in the URL
    $id=$_GET['id']; // Get the value of the id parameter

    $delete=mysqli_query($conn,"DELETE FROM churchmembership WHERE id='$id'"); // Delete the record from the churchmembership table where id matches

    if ($delete){ // If delete is successful
        header("location:datashowmemberlist.php"); // Redirect to datashowmemberlist.php
        die();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Member</title>
    <link rel="stylesheet" type="text/css" href="stylesearch.css"> <!-- Link to stylesearch.css for styling -->
</head>
<body>
    <center>
    <h1>SEARCH MEMBER</h1>

    <form action="" method="POST">
    <div class="options">
        <ul>
            <div>
            <a href='home.php?' class="buttonleft">HOME</a>
            </div>

            <div>
                <input type="text" name="id" placeholder="Enter ID" /><br/>
            </div>

            <div>
               <input type="text" name="lname" placeholder="Enter Lastname" /><br/>
            </div>

            <div>
            <input type="text" name="district" placeholder="Enter District" /><br/>
            </div>

            <div>
            <input type="submit" name="search" class="buttons" value="SEARCH"/>
            </div>

            <div>
            <a href='datashowmemberlist.php?' class="button">VIEW</a>
            </div>
        </ul>
    </div>
    </form>

    <?php
    include "connection.php"; // Include the connection.php file

    if(isset($_POST['search'])){ // Check if the search button is clicked
        $id = $_POST['id']; // Get the values from the form
        $lname = $_POST['lname'];
        $district = $_POST['district'];

        $query="SELECT * FROM churchmembership WHERE  lname='$lname' || id='$id' || district='$district'"; // Build the SQL query

        $result = $conn->query($query); // Execute the query using the connection object

        $search_results = []; // Initialize an array to store the search results

        if($result->num_rows > 0){ // If there are search results returned
            while ($row = $result->fetch_assoc()){ // Loop through each row of the result set
                $search_results[] = $row; // Add the row to the search_results array
            }
        } else{
            echo '<div 
            style=" display: flex; 
                    justify-content: center; 
                    align-items: center; 
                    background-color: #f1f1f1; 
                    padding: 20px;">';
            echo '<span 
            style="color: red;
            ">No results found.</span>';
            echo '</div>';
        }
    }
    ?>

<?php if (!empty($search_results)) { ?>

<div class="container">
    <table border="1" cellpadding="0">
        <tr>
            <th>ID</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Middlename</th>
            <th>Date Baptized</th>
            <th>Officiating Minister</th>
            <th>Received By</th>
            <th>Received Date</th>
            <th>Received Church</th>
            <th>District Name</th>
            <th>Operations</th>
        </tr>

        <tbody>
        <?php
        foreach ($search_results as $member) { // Loop through each search result
        ?>
            <tr>
                <td><?php echo $member['id']; ?></td>
                <td><?php echo $member['lname']; ?></td>
                <td><?php echo $member['fname']; ?></td>
                <td><?php echo $member['mname']; ?></td>
                <td><?php echo $member['baptizeddate']; ?></td>
                <td><?php echo $member['minister']; ?></td>
                <td><?php echo $member['receivedby']; ?></td>
                <td><?php echo $member['receiveddate']; ?></td>
                <td><?php echo $member['receivedchurch']; ?></td>
                <td><?php echo $member['district']; ?></td>
                <td>
                    <a href='addmember.php?id=<?php echo $member['id']; ?>' class='opt'>Edit</a>
                    <a href='?id=<?php echo $member['id']; ?>' class='opt1'>Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
<?php } ?>
</body>
