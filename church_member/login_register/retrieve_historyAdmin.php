<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="alltransactions.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1i6pkaDw/YYT1wo/UkvP65yI+2gLXwo" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmIv99vs3SJPp6wDQm1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZEu0ZnWuqzVXmNWshFkre"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="edittransactions.css">
</head>

<body>
    <!-- Modal popup for editing transaction -->
    <div id="edit-transaction-modal" style="display: none;">
        <label for="transfer" style=" text-align: center; font-family: Arial, sans-serif; font-size:
            18px;    font-weight: 900; ">TRANSFER</label>
        <form>
            <label for="tfname">First Name:</label>
            <input type="text" name="tfname" id="tfname" required readonly><br>

            <label for="tmname">Middle Name:</label>
            <input type="text" name="tmname" id="tmname" readonly><br>

            <label for="tlname">Last Name:</label>
            <input type="text" name="tlname" id="tlname" required readonly><br>

            <label for="tchurchname">Church Name:</label>
            <input type="text" name="tchurchname" id="tchurchname" readonly><br>

            <label for="ttransferchurch">Transfer to Church:</label>
            <input type="text" name="ttransferchurch" id="ttransferchurch" readonly><br>

            <label for="tplacechurch">Transfer to Place:</label>
            <input type="text" name="tplacechurch" id="tplacechurch" readonly><br>

            <label for="tstatus">Status:</label>
            <select name="tstatus" id="tstatus" required>
                <option selected disabled>Select status</option>
                <option value="Done">Done</option>
                <option value="Pending">Pending</option>
                <option value="InProgress">InProgress</option>
                <option value="Rejected">Rejected</option>
            </select>
            <div>
                <input type="submit" class="btn btn-success" value="Update">
                <button type="button" id="close-button" class="btn btn-primary">Close</button>
            </div>
        </form>
    </div>

    <script>

        function editTransaction(transferID) {
            // Your JavaScript code to display the modal popup and populate the form with data from the database
            var modal = document.getElementById('edit-transaction-modal');
            modal.style.display = 'block';
            var closeButton = document.getElementById('close-button');

            fetch('fetch_transaction.php?transferID=' + transferID)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('tfname').value = data.tfname;
                    document.getElementById('tmname').value = data.tmname;
                    document.getElementById('tlname').value = data.tlname;
                    document.getElementById('tchurchname').value = data.tchurchname;
                    document.getElementById('ttransferchurch').value = data.ttransferchurch;
                    document.getElementById('tplacechurch').value = data.tplacechurch;
                    document.getElementById('transaction_date').value = data.transaction_date;
                    document.getElementById('tstatus').value = data.tstatus;

                    // show the modal popup
                    $('#edit-transaction-modal').modal('show');
                });
            closeButton.addEventListener('click', function () {
                modal.style.display = 'none';
            });

            document.querySelector('#edit-transaction-modal form').addEventListener('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('transferID', transferID);
                fetch('update_transaction.php', {
                    method: 'POST',
                    body: formData,
                }).then(response => {
                    console.log(response);
                    alert('Updated successfully!'); // Display the success message
                    window.location.reload(); // Reload the page

                }).catch(error => console.error(error));
            });
        }

    </script>


    <!-- Modal popup for editing baptism -->
    <div id="edit-baptism-modal" style="display: none;">
        <label for="baptism" style=" text-align: center; font-family: Arial, sans-serif; font-size:
            18px;    font-weight: 900; ">BAPTISM</label>
        <form>
            <label for="bfname">First Name:</label>
            <input type="text" name="bfname" id="bfname" required readonly><br>

            <label for="bmname">Middle Name:</label>
            <input type="text" name="bmname" id="bmname" readonly><br>

            <label for="blname">Last Name:</label>
            <input type="text" name="blname" id="blname" required readonly><br>

            <label for="bchurchname">Church Name:</label>
            <input type="text" name="bchurchname" id="bchurchname" readonly><br>

            <label for="bstatus">Status:</label>
            <select name="bstatus" id="bstatus" required>
                <option selected disabled>Select status</option>
                <option value="Done">Done</option>
                <option value="Pending">Pending</option>
                <option value="InProgress">InProgress</option>
                <option value="Rejected">Rejected</option>
            </select>
            <div>
                <input type="submit" class="btn btn-success" value="Update">
                <button type="button" id="close-buttonb" onclick="closeModal()" class="btn btn-primary">Close</button>
            </div>
        </form>
    </div>

    <script>
        var modal = document.getElementById('edit-baptism-modal');
        var closeButtonb = document.getElementById('close-buttonb');

        function closeModal() {
            modal.style.display = 'none';
        }

        function editBaptism(baptismID) {
            // Your JavaScript code to display the modal popup and populate the form with data from the database
            modal.style.display = 'block';

            fetch('fetch_baptism.php?baptismID=' + baptismID)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('bfname').value = data.bfname;
                    document.getElementById('bmname').value = data.bmname;
                    document.getElementById('blname').value = data.blname;
                    document.getElementById('bchurchname').value = data.bchurchname;
                    document.getElementById('transaction_date').value = data.transaction_date;
                    document.getElementById('bstatus').value = data.bstatus;

                    // show the modal popup
                    $('#edit-baptism-modal').modal('show');
                });

            document.querySelector('#edit-baptism-modal form').addEventListener('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('baptismID', baptismID);
                fetch('update_baptism.php', {
                    method: 'POST',
                    body: formData,
                }).then(response => {
                    console.log(response);
                    modal.style.display = 'none'; // close the modal popup
                    alert('Updated successfully!'); // Display the success message
                    window.location.reload(); // Reload the page

                }).catch(error => console.error(error));
            });
        }
    </script>

    <!-- Modal popup for editing excuse -->
    <div id="edit-excuse-modal" style="display: none;">
        <label for="excuse" style=" text-align: center; font-family: Arial, sans-serif; font-size:
            18px;    font-weight: 900; ">EXCUSE</label>
        <form>
            <label for="efname">First Name:</label>
            <input type="text" name="efname" id="efname" required readonly><br>

            <label for="emname">Middle Name:</label>
            <input type="text" name="emname" id="emname" readonly><br>

            <label for="elname">Last Name:</label>
            <input type="text" name="elname" id="elname" required readonly><br>

            <label for="echurchname">Church Name:</label>
            <input type="text" name="echurchname" id="echurchname" readonly><br>

            <label for="eusedfor">Used For:</label>
            <input type="text" name="eusedfor" id="eusedfor" required readonly><br>

            <label for="eorganization">Organization:</label>
            <input type="text" name="eorganization" id="eorganization" readonly><br>

            <label for="estatus">Status:</label>
            <select name="estatus" id="estatus" required>
                <option selected disabled>Select status</option>
                <option value="Done">Done</option>
                <option value="Pending">Pending</option>
                <option value="InProgress">InProgress</option>
                <option value="Rejected">Rejected</option>
            </select>
            <div>
                <input type="submit" class="btn btn-success" value="Update">
                <button type="button" id="close-buttons" class="btn btn-primary">Close</button>
            </div>
        </form>
    </div>

    <script>

        function editExcuse(excuseID) {
            // Your JavaScript code to display the modal popup and populate the form with data from the database
            var modal = document.getElementById('edit-excuse-modal');
            modal.style.display = 'block';
            var closeButtons = document.getElementById('close-buttons');

            fetch('fetch_excuse.php?excuseID=' + excuseID)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('efname').value = data.efname;
                    document.getElementById('emname').value = data.emname;
                    document.getElementById('elname').value = data.elname;
                    document.getElementById('echurchname').value = data.echurchname;
                    document.getElementById('eusedfor').value = data.eusedfor;
                    document.getElementById('eorganization').value = data.eorganization;
                    document.getElementById('transaction_date').value = data.transaction_date;
                    document.getElementById('estatus').value = data.estatus;

                    // show the modal popup
                    $('#edit-excuse-modal').modal('show');
                });

            closeButtons.addEventListener('click', function () {
                modal.style.display = 'none';
            });

            document.querySelector('#edit-excuse-modal form').addEventListener('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('excuseID', excuseID);
                fetch('update_excuse.php', {
                    method: 'POST',
                    body: formData,
                }).then(response => {
                    console.log(response);
                    alert('Updated successfully!'); // Display the success message
                    window.location.reload(); // Reload the page

                }).catch(error => console.error(error));
            });
        }

    </script>

    <!-- Modal popup for editing purpose -->
    <div id="edit-purpose-modal" style="display: none;">
        <label for="purpose" style=" text-align: center; font-family: Arial, sans-serif; font-size:
            18px;    font-weight: 900; ">PURPOSE</label>
        <form>
            <label for="pfname">First Name:</label>
            <input type="text" name="pfname" id="pfname" required readonly><br>

            <label for="pmname">Middle Name:</label>
            <input type="text" name="pmname" id="pmname" readonly><br>

            <label for="plname">Last Name:</label>
            <input type="text" name="plname" id="plname" required readonly><br>

            <label for="pchurchname">Church Name:</label>
            <input type="text" name="pchurchname" id="pchurchname" readonly><br>

            <label for="pdescription">Description:</label>
            <input type="text" name="pdescription" id="pdescription" required><br>

            <label for="pstatus">Status:</label>
            <select name="pstatus" id="pstatus" required>
                <option selected disabled>Select status</option>
                <option value="Done">Done</option>
                <option value="Pending">Pending</option>
                <option value="InProgress">InProgress</option>
                <option value="Rejected">Rejected</option>
            </select>
            <div>
                <input type="submit" class="btn btn-success" value="Update">
                <button type="button" id="close-buttonp" class="btn btn-primary">Close</button>
            </div>
        </form>
    </div>

    <script>

        function editPurpose(purposeID) {
            // Your JavaScript code to display the modal popup and populate the form with data from the database
            var modal = document.getElementById('edit-purpose-modal');
            modal.style.display = 'block';
            var closeButtonp = document.getElementById('close-buttonp');

            fetch('fetch_purpose.php?purposeID=' + purposeID)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('pfname').value = data.pfname;
                    document.getElementById('pmname').value = data.pmname;
                    document.getElementById('plname').value = data.plname;
                    document.getElementById('pchurchname').value = data.pchurchname;
                    document.getElementById('pdescription').value = data.pdescription;
                    document.getElementById('transaction_date').value = data.transaction_date;
                    document.getElementById('pstatus').value = data.pstatus;

                    // show the modal popup
                    $('#edit-purpose-modal').modal('show');
                });

            closeButtonp.addEventListener('click', function () {
                modal.style.display = 'none';
            });

            document.querySelector('#edit-purpose-modal form').addEventListener('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('purposeID', purposeID);
                fetch('update_purpose.php', {
                    method: 'POST',
                    body: formData,
                }).then(response => {
                    console.log(response);
                    alert('Updated successfully!'); // Display the success message
                    window.location.reload(); // Reload the page

                }).catch(error => console.error(error));
            });
        }

    </script>
</body>

<style>
    .table {
        width: 100%;
    }
</style>


<?php
// database connection details 
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Retrieve the provided first name and last name from the user
    $fname = isset($_POST['fname']) ? trim($_POST['fname']) : '';
    $lname = isset($_POST['lname']) ? trim($_POST['lname']) : '';

    // Check if the input is valid
    if (empty($fname) || empty($lname)) {

        echo "<p class='no-records' style='margin-left: 17vw; margin-top:-9vh;'>Please provide both first name and last name.</p>";
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

                    echo "<td> <button class='opt' onclick=\"editTransaction({$row['transferID']})\">Edit</button> <button class='opt1' onclick='deleteRow(\"transaction-transfer\", {$row['transferID']})'>Delete</button> </td>";

                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
            if (mysqli_num_rows($baptism_result) > 0) {
                echo "<h4 style='background-color:rgb(1, 25, 83);color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Transaction Baptism History</h4>";

                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped'>";
                echo "<thead class='thead-inverse'><tr><th>Transaction ID</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Church Name</th><th>Transaction Date</th><th>Status</th><th>Operation</th></tr></thead>";
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

                    echo "<td> <button class='opt' onclick=\"editBaptism({$row['baptismID']})\">Edit</button> <button class='opt1' onclick='deleteRow(\"transaction-baptism\", {$row['baptismID']})'>Delete</button> </td>";

                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
            if (mysqli_num_rows($excuse_result) > 0) {
                echo "<h4 style='background-color:rgb(1, 25, 83);color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Transaction Excuse History</h4>";

                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped'>";
                echo "<thead class='thead-inverse'><tr><th>Transaction ID</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Church Name</th><th>Used For</th><th>Organization</th><th>Transaction Date</th><th>Status</th>   <th>Operation</th></tr></thead>";
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

                    echo "<td> <button class='opt' onclick=\"editExcuse({$row['excuseID']})\">Edit</button> <button class='opt1' onclick='deleteRow(\"transaction-excuse\", {$row['excuseID']})'>Delete</button> </td>";

                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
            if (mysqli_num_rows($purpose_result) > 0) {
                echo "<h4 style='background-color:rgb(1, 25, 83); color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Transaction Purpose History</h4>";

                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped'>";
                echo "<thead class='thead-inverse'><tr><th>Transaction ID</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Church Name</th><th>Purpose Description</th><th>Transaction Date</th><th>Status</th><th>Operation</th></tr></thead>";
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

                    echo "<td> <button class='opt' onclick=\"editPurpose({$row['purposeID']})\">Edit</button> <button class='opt1' onclick='deleteRow(\"transaction-purpose\", {$row['purposeID']})'>Delete</button> </td>";

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