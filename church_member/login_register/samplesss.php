<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transactions Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="userinterface.css">
    <link rel="stylesheet" href="clerk.css">

    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="interfaceuser.css">

    <div style="position: relative;">
        <img src="/church_member/images/SDALogo.png" alt="SDA Logo"
            style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; height: 10vh; width: 6vw; margin-left: 2vw; margin-top:1.5vh;">
    </div>




    <!-- Link to styledatashow.css for styling -->
    <link rel="stylesheet" type="text/css" href="styledataviewmember.css">

    <div class="title">
        <h1>TRANSACTIONS DATA</h1>
    </div>

    <div class="options">
        <ul>
            <div>
                <a href='home.php?' class="lefthomebtn">HOME</a>
            </div>


            <div>
                <form action="" method="GET" class="searches">
                    <input type="text" id="searchID" name="searchID" placeholder="Search ID">
                    <input type="text" id="searchlname" name="searchlname" placeholder="Search lastname">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>

            <div>
                <a href='index.php?'>Logout</a>
            </div>
        </ul>
    </div>
</head>



<?php

include("connection.php");

//Query all four transaction tables to retrieve the transaction history
$transfer_sql = "SELECT transferID, tfname, tmname, tlname, tchurchname, ttransferchurch, tplacechurch, transaction_date, file, status FROM `transaction-transfer`";
$baptism_sql = "SELECT baptismID, bfname, bmname, blname, bchurchname, transaction_date, file, status FROM `transaction-baptism`";
$excuse_sql = "SELECT excuseID, efname, emname, elname, echurchname, eusedfor, eorganization, transaction_date, file, status FROM `transaction-excuse`";
$purpose_sql = "SELECT purposeID, pfname, pmname, plname, pchurchname, pdescription, transaction_date, file, status FROM `transaction-purpose`";

// Modify queries if search parameters are provided
if (isset($_GET['search'])) {
    $searchID = $_GET['searchID'];
    $searchlname = $_GET['searchlname'];


    if (!empty($searchID)) {
        $transfer_sql .= " WHERE transferID = '$searchID'";
        $baptism_sql .= " WHERE baptismID = '$searchID'";
        $excuse_sql .= " WHERE excuseID = '$searchID'";
        $purpose_sql .= " WHERE purposeID = '$searchID'";

        if (!empty($searchlname)) {
            $transfer_sql .= " AND tlname = '$searchlname'";
            $baptism_sql .= " AND blname = '$searchlname'";
            $excuse_sql .= " AND elname = '$searchlname'";
            $purpose_sql .= " AND plname = '$searchlname'";
        }
    } else if (!empty($searchlname)) {
        $transfer_sql .= " WHERE tlname = '$searchlname'";
        $baptism_sql .= " WHERE blname = '$searchlname'";
        $excuse_sql .= " WHERE elname = '$searchlname'";
        $purpose_sql .= " WHERE plname = '$searchlname'";
    }

}

//Execute the queries and store the result sets in separate variables
$transfer_result = mysqli_query($conn, $transfer_sql);
$baptism_result = mysqli_query($conn, $baptism_sql);
$excuse_result = mysqli_query($conn, $excuse_sql);
$purpose_result = mysqli_query($conn, $purpose_sql);



// Display transaction history tables for each query
if (isset($transfer_result) && mysqli_num_rows($transfer_result) > 0) {
    echo "<h4 style='background-color:rgb(1, 25, 83); color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Transaction Transfer History</h4>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped'>";
    echo "<thead class='thead-inverse'><tr><th>Transaction ID</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Transfer Church</th><th>Place of Church</th><th>Church Name</th><th>Transaction Date</th><th>File</th><th>Status</th><th>Operation</th></tr></thead>";
    $count = 0;
    while ($row = mysqli_fetch_array($transfer_result)) {
        $transferID = isset($row['transferID']) ? $row['transferID'] : '';

        // Add delete button to table row
        echo "<tr id='transfer-$transferID'>";
        echo "<td>$transferID</td>";
        echo "<td>{$row['tfname']}</td>";
        echo "<td>{$row['tmname']}</td>";
        echo "<td>{$row['tlname']}</td>";
        echo "<td>{$row['ttransferchurch']}</td>";
        echo "<td>{$row['tplacechurch']}</td>";
        echo "<td>{$row['tchurchname']}</td>";
        echo "<td>{$row['transaction_date']}</td>";
        echo "<td>{$row['file']}</td>"; // add this line to display the file name
        echo "<td>{$row['status']}</td>";
        // Add Edit button
        echo "<td><button class='opt' onclick='editRow(\"transaction-transfer\", $transferID)'>Edit</button>" .
            "<button class='opt1' onclick='deleteRow(\"transaction-transfer\", $transferID)'>Delete</button></td>";
        echo "</tr>";
        $count++;

    }
    echo "</table>";
    echo "</div>";
}

if (isset($baptism_result) && mysqli_num_rows($baptism_result) > 0) {
    // Display table for transaction-baptism

    echo "<h4 style='background-color:rgb(1, 25, 83);color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Transaction Baptism History</h4>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped'>";
    echo "<thead class='thead-inverse'><tr><th>Transaction ID</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Church Name</th><th>Transaction Date</th><th>File</th><th>Status</th><th>Operation</th></tr></thead>";
    $count = 0;
    while ($row = mysqli_fetch_array($baptism_result)) {
        $baptismID = isset($row['baptismID']) ? $row['baptismID'] : '';
        $bfname = isset($row['bfname']) ? $row['bfname'] : '';
        $bmname = isset($row['bmname']) ? $row['bmname'] : '';
        $blname = isset($row['blname']) ? $row['blname'] : '';
        $churchname = isset($row['bchurchname']) ? $row['bchurchname'] : '';
        $transaction_date = isset($row['transaction_date']) ? $row['transaction_date'] : '';
        $file = isset($row['file']) ? $row['file'] : '';
        $status = isset($row['status']) ? $row['status'] : '';
        // Alternate row color on every other table row
        $count++;
        $row_color = ($count % 2 == 0) ? "table-light" : "";
        echo "<tr class='$row_color' id='baptism-$baptismID'>";
        echo "<td>$baptismID</td>";
        echo "<td>$bfname</td>";
        echo "<td>$bmname</td>";
        echo "<td>$blname</td>";
        echo "<td>$churchname</td>";
        echo "<td>$transaction_date</td>";
        echo "<td>$file</td>";
        echo "<td>$status</td>";
        echo "<td><button class='opt' onclick='editRow(\"transaction-baptism\", $baptismID)'>Edit</button>" .
            "<button class='opt1' onclick='deleteRow(\"transaction-baptism\", $baptismID)'>Delete</button></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}

if (isset($excuse_result) && mysqli_num_rows($excuse_result) > 0) {
    // Display table for transaction-excuse

    echo "<h4 style='background-color:rgb(1, 25, 83);color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Transaction Excuse History</h4>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped'>";
    echo "<thead class='thead-inverse'><tr><th>Transaction ID</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Church Name</th><th>Used For</th><th>Organization</th><th>Transaction Date</th><th>File</th><th>Status</th><th>Operation</th></tr></thead>";
    $count = 0;
    while ($row = mysqli_fetch_array($excuse_result)) {
        $excuseID = isset($row['excuseID']) ? $row['excuseID'] : '';
        $efname = isset($row['efname']) ? $row['efname'] : '';
        $emname = isset($row['emname']) ? $row['emname'] : '';
        $elname = isset($row['elname']) ? $row['elname'] : '';
        $churchname = isset($row['echurchname']) ? $row['echurchname'] : '';
        $usedfor = isset($row['eusedfor']) ? $row['eusedfor'] : '';
        $organization = isset($row['eorganization']) ? $row['eorganization'] : '';
        $transaction_date = isset($row['transaction_date']) ? $row['transaction_date'] : '';
        $file = isset($row['file']) ? $row['file'] : '';
        $status = isset($row['status']) ? $row['status'] : '';
        // Alternate row color on every other table row
        $count++;
        $row_color = ($count % 2 == 0) ? "table-light" : "";
        echo "<tr class='$row_color' id='excuse-$excuseID'>";
        echo "<td>$excuseID</td>";
        echo "<td>$efname</td>";
        echo "<td>$emname</td>";
        echo "<td>$elname</td>";
        echo "<td>$churchname</td>";
        echo "<td>$usedfor</td>";
        echo "<td>$organization</td>";
        echo "<td>$transaction_date</td>";
        echo "<td>$file</td>";
        echo "<td>$status</td>";
        echo "<td><button class='opt' onclick='editRow(\"transaction-excuse\", $excuseID)'>Edit</button>" .
            "<button class='opt1' onclick='deleteRow(\"transaction-excuse\", $excuseID)'>Delete</button></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}

if (isset($purpose_result) && mysqli_num_rows($purpose_result) > 0) {
    // Display table for transaction-purpose

    echo "<h4 style='background-color:rgb(1, 25, 83); color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Transaction Purpose History</h4>";

    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped'>";
    echo "<thead class='thead-inverse'><tr><th>Transaction ID</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Church Name</th><th>Purpose Description</th><th>Transaction Date</th><th>File</th><th>Status</th><th>Operation</th></tr></thead>";
    $count = 0;
    while ($row = mysqli_fetch_array($purpose_result)) {
        $purposeID = isset($row['purposeID']) ? $row['purposeID'] : '';
        $pfname = isset($row['pfname']) ? $row['pfname'] : '';
        $pmname = isset($row['pmname']) ? $row['pmname'] : '';
        $plname = isset($row['plname']) ? $row['plname'] : '';
        $churchname = isset($row['pchurchname']) ? $row['pchurchname'] : '';
        $purpose_description = isset($row['pdescription']) ? $row['pdescription'] : '';
        $transaction_date = isset($row['transaction_date']) ? $row['transaction_date'] : '';
        $file = isset($row['file']) ? $row['file'] : '';
        $status = isset($row['status']) ? $row['status'] : '';

        // Alternate row color on every other table row
        $count++;
        $row_color = ($count % 2 == 0) ? "table-light" : "";
        echo "<tr class='$row_color' id='purpose-$purposeID'>";
        echo "<td>$purposeID</td>";
        echo "<td>$pfname</td>";
        echo "<td>$pmname</td>";
        echo "<td>$plname</td>";
        echo "<td>$churchname</td>";
        echo "<td>$purpose_description</td>";
        echo "<td>$transaction_date</td>";
        echo "<td>$file</td>";
        echo "<td>$status</td>";

        echo "<td><button class='opt' onClick='editRow(\"transaction-purpose\", $purposeID)' data-pfname='$pfname' data-plname='$plname'>Edit</button>" .
            "<button class='opt1' onClick='deleteRow(\"transaction-purpose\", $purposeID)'>Delete</button></td>";
        echo "</tr>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

}

mysqli_close($conn);
?>


<!-- edit form modal -->
<div id="editModal" class="modal">
    <div class="modal-content edit-margin">
        <span class="close" onclick="closeEditModal()">×</span>
        <h3>Edit Transaction</h3>
        <span id="transactionInfo"></span>
        <form id="editForm" onsubmit="submitForm(event)">
            <input type="hidden" id="editID" name="id" value="">
            <div class="form-group">
                <label>Status:</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="editStatusPending" name="status"
                        value="pending">
                    <label class="form-check-label" for="editStatusPending">Pending</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="editStatusDone" name="status" value="done">
                    <label class="form-check-label" for="editStatusDone">Done</label>
                </div>
            </div>
            <div class="form-group">
                <label for="upload">Upload File:</label>
                <input type="file" id="editFile" name="file" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-success">Save Changes</button>
            <button type="button" class="btn btn-secondary" id="closeButton" onclick="closeEditModal()">Close</button>
        </form>
    </div>
</div>

<script>
    function editRow(table, id) {
        // Open modal
        var modal = document.getElementById("editModal");
        modal.style.display = "block";
    }
    // function to close edit modal 
    function closeEditModal() {
        document.getElementById("editModal").style.display = "none";
    }


    function submitForm(event) {
        event.preventDefault(); // Prevent default form submission



        // Get the form values
        var id = document.getElementById("editID").value;
        var status = document.querySelector('input[name="status"]:checked').value;
        var fileInput = document.getElementById('editFile');

        // Create a FormData object to store the form data
        var formData = new FormData();
        formData.append('id', id);
        formData.append('status', status);
        formData.append('table', 'transaction-transfer'); // Update with the correct table name

        if (fileInput.files.length > 0) {
            formData.append('file', fileInput.files[0]);
        }

        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Define a callback function for the AJAX request
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Redirect to clerkTransaction.php after successful update
                    window.location.href = 'clerkTransaction.php';
                } else {
                    console.error('Error:', xhr.status);
                }
            }
        };

        // Open a PUT request to the editTransaction.php endpoint
        xhr.open('PUT', 'editTransaction.php', true);

        // Send the form data
        xhr.send(formData);
    }


</script>



<script>

</script>

<!-- delete function of each row -->
<script>
    function deleteRow(table, id) {
        if (confirm('Are you sure you want to delete this row?')) {
            // Send AJAX request to server with DELETE method
            var xhr = new XMLHttpRequest();
            xhr.open('DELETE', 'delete.php?id=' + id + '&table=' + table);
            xhr.onload = function () {
                // Reload page after delete is complete
                location.reload();
            };
            xhr.send();
        }
    }
</script>