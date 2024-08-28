<?php
// database connection details 
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Retrieve the provided first name and last name from the user
    $fname = isset($_POST['fname']) ? trim($_POST['fname']) : '';
    $lname = isset($_POST['lname']) ? trim($_POST['lname']) : '';

    // Check if the input is valid
    if (empty($fname) || empty($lname)) {

        echo "<p class='no-records' style='margin-left: 17vw; margin-top:-9vh;'>Please provide first name and last name.</p>";
    } else {
        //Query all four transaction tables to retrieve the transaction history for the provided first and last name
        $transfer_sql = "SELECT transferID, tfname, tmname, tlname, tchurchname, ttransferchurch, tplacechurch, transaction_date, tstatus FROM `transaction-transfer` WHERE `tfname` = '$fname' AND `tlname` = '$lname'";

        $baptism_sql = "SELECT baptismID, bfname, bmname, blname, bchurchname, transaction_date, bstatus FROM `transaction-baptism` WHERE `bfname` = '$fname' AND `blname` = '$lname'";

        $excuse_sql = "SELECT excuseID, efname, emname, elname, echurchname, eusedfor, eorganization, transaction_date, estatus FROM `transaction-excuse` WHERE `efname` = '$fname' AND `elname` = '$lname'";

        $purpose_sql = "SELECT purposeID, pfname, pmname, plname, pchurchname, pdescription, transaction_date, pstatus FROM `transaction-purpose` WHERE `pfname` = '$fname' AND `plname` = '$lname'";

        //Execute the queries and store the result sets in separate variables
        $transfer_result = mysqli_query($conn, $transfer_sql);
        $baptism_result = mysqli_query($conn, $baptism_sql);
        $excuse_result = mysqli_query($conn, $excuse_sql);
        $purpose_result = mysqli_query($conn, $purpose_sql);

        // Check if any rows were returned from any of the queries
        if (mysqli_num_rows($transfer_result) == 0 && mysqli_num_rows($baptism_result) == 0 && mysqli_num_rows($excuse_result) == 0 && mysqli_num_rows($purpose_result) == 0) {
            // No records found for fname lname
            echo "<p class='no-records' style='margin-left: 17vw; margin-top:-9vh;'>No records found for <span class='highlight'>$fname $lname</span></p>";
        } else {
            // Display transaction history tables for each query
            if (mysqli_num_rows($transfer_result) > 0) {
                echo "<h4 style='background-color:rgb(1, 25, 83); color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Transaction Transfer History</h4>";

                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped'>";
                echo "<thead class='thead-inverse'><tr><th>Transaction ID</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Transfer Church</th><th>Place of Church</th><th>Church Name</th><th>Transaction Date</th><th>Status</th></tr></thead>";
                $count = 0;
                while ($row = mysqli_fetch_array($transfer_result)) {
                    $transferID = isset($row['transferID']) ? $row['transferID'] : '';
                    $tfname = isset($row['tfname']) ? $row['tfname'] : '';
                    $tmname = isset($row['tmname']) ? $row['tmname'] : '';
                    $tlname = isset($row['tlname']) ? $row['tlname'] : '';
                    $transfer_church = isset($row['ttransferchurch']) ? $row['ttransferchurch'] : '';
                    $place_of_church = isset($row['tplacechurch']) ? $row['tplacechurch'] : '';
                    $churchname = isset($row['tchurchname']) ? $row['tchurchname'] : '';
                    $transaction_date = isset($row['transaction_date']) ? $row['transaction_date'] : '';
                    $tstatus = isset($row['tstatus']) ? $row['tstatus'] : '';

                    // Alternate row color on every other table row
                    $count++;
                    $row_color = ($count % 2 == 0) ? "table-light" : "";
                    echo "<tr class='$row_color'>";
                    echo "<td>$transferID</td>";
                    echo "<td>$tfname</td>";
                    echo "<td>$tmname</td>";
                    echo "<td>$tlname</td>";
                    echo "<td>$transfer_church</td>";
                    echo "<td>$place_of_church</td>";
                    echo "<td>$churchname</td>";
                    echo "<td>$transaction_date</td>";
                    echo "<td>$tstatus</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
            if (mysqli_num_rows($baptism_result) > 0) {
                echo "<h4 style='background-color:rgb(1, 25, 83);color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Transaction Baptism History</h4>";

                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped'>";
                echo "<thead class='thead-inverse'><tr><th>Transaction ID</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Church Name</th><th>Transaction Date</th><th>Status</th></tr></thead>";
                $count = 0;
                while ($row = mysqli_fetch_array($baptism_result)) {
                    $baptismID = isset($row['baptismID']) ? $row['baptismID'] : '';
                    $bfname = isset($row['bfname']) ? $row['bfname'] : '';
                    $bmname = isset($row['bmname']) ? $row['bmname'] : '';
                    $blname = isset($row['blname']) ? $row['blname'] : '';
                    $churchname = isset($row['bchurchname']) ? $row['bchurchname'] : '';
                    $transaction_date = isset($row['transaction_date']) ? $row['transaction_date'] : '';
                    $bstatus = isset($row['bstatus']) ? $row['bstatus'] : '';

                    // Alternate row color on every other table row
                    $count++;
                    $row_color = ($count % 2 == 0) ? "table-light" : "";
                    echo "<tr class='$row_color'>";
                    echo "<td>$baptismID</td>";
                    echo "<td>$bfname</td>";
                    echo "<td>$bmname</td>";
                    echo "<td>$blname</td>";
                    echo "<td>$churchname</td>";
                    echo "<td>$transaction_date</td>";
                    echo "<td>$bstatus</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
            if (mysqli_num_rows($excuse_result) > 0) {
                echo "<h4 style='background-color:rgb(1, 25, 83);color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Transaction Excuse History</h4>";

                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped'>";
                echo "<thead class='thead-inverse'><tr><th>Transaction ID</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Church Name</th><th>Used For</th><th>Organization</th><th>Transaction Date</th><th>Status</th></tr></thead>";
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
                    $estatus = isset($row['estatus']) ? $row['estatus'] : '';

                    // Alternate row color on every other table row
                    $count++;
                    $row_color = ($count % 2 == 0) ? "table-light" : "";
                    echo "<tr class='$row_color'>";
                    echo "<td>$excuseID</td>";
                    echo "<td>$efname</td>";
                    echo "<td>$emname</td>";
                    echo "<td>$elname</td>";
                    echo "<td>$churchname</td>";
                    echo "<td>$usedfor</td>";
                    echo "<td>$organization</td>";
                    echo "<td>$transaction_date</td>";
                    echo "<td>$estatus</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
            if (mysqli_num_rows($purpose_result) > 0) {
                echo "<h4 style='background-color:rgb(1, 25, 83); color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Transaction Purpose History</h4>";

                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped'>";
                echo "<thead class='thead-inverse'><tr><th>Transaction ID</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Church Name</th><th>Purpose Description</th><th>Transaction Date</th><th>Status</th></tr></thead>";
                $count = 0;
                while ($row = mysqli_fetch_array($purpose_result)) {
                    $purposeID = isset($row['purposeID']) ? $row['purposeID'] : '';
                    $pfname = isset($row['pfname']) ? $row['pfname'] : '';
                    $pmname = isset($row['pmname']) ? $row['pmname'] : '';
                    $plname = isset($row['plname']) ? $row['plname'] : '';
                    $churchname = isset($row['pchurchname']) ? $row['pchurchname'] : '';
                    $purpose_description = isset($row['pdescription']) ? $row['pdescription'] : '';
                    $transaction_date = isset($row['transaction_date']) ? $row['transaction_date'] : '';
                    $pstatus = isset($row['pstatus']) ? $row['pstatus'] : '';

                    // Alternate row color on every other table row
                    $count++;
                    $row_color = ($count % 2 == 0) ? "table-light" : "";
                    echo "<tr class='$row_color'>";
                    echo "<td>$purposeID</td>";
                    echo "<td>$pfname</td>";
                    echo "<td>$pmname</td>";
                    echo "<td>$plname</td>";
                    echo "<td>$churchname</td>";
                    echo "<td>$purpose_description</td>";
                    echo "<td>$transaction_date</td>";
                    echo "<td>$pstatus</td>";
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
        }
    }
}

// Close the database connection
mysqli_close($conn);

?>


<style>
    .table-responsive {
        max-width: 85%;
        margin: 0 auto;
        overflow-x: auto;
    }

    .table {
        margin: 0 auto;
    }

    .thead-inverse {
        background-color: white;
        color: black;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #fff;
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: #f2f2f2;
    }

    .thead-
</style>