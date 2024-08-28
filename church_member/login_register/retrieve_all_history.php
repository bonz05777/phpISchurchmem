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


<?php
// database connection details 
include("connection.php");


//Query all four transaction tables to retrieve the transaction history 
$transfer_sql = "SELECT transferID, tfname, tmname, tlname, tchurchname, ttransferchurch, tplacechurch, transaction_date,  tstatus AS status FROM `transaction-transfer` ";
$baptism_sql = "SELECT baptismID, bfname, bmname, blname, bchurchname, transaction_date, bstatus AS status FROM `transaction-baptism`";
$excuse_sql = "SELECT excuseID, efname, emname, elname, echurchname, eusedfor, eorganization, transaction_date, estatus AS status FROM `transaction-excuse`";
$purpose_sql = "SELECT purposeID, pfname, pmname, plname, pchurchname, pdescription, transaction_date,  pstatus AS status FROM `transaction-purpose`";



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
    echo "<h4 style='background-color:rgb(1, 25, 83); color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Transfer History</h4>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped'>";
    echo "<thead class='thead-inverse'>
    <tr>
    <th>Transaction ID</th>
    <th>First Name</th>
    <th>Middle Name</th>
    <th>Last Name</th>
    <th>Transfer Church</th>
    <th>Place of Church</th>
    <th>Church Name</th>
    <th>Transaction Date</th>
    <th>Status</th>
    <th>Operation</th>
    </tr></thead>";
    $sql = "SELECT * FROM `transaction-transfer`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['transferID']}</td>";
            echo "<td>{$row['tfname']}</td>";
            echo "<td>{$row['tmname']}</td>";
            echo "<td>{$row['tlname']}</td>";
            echo "<td>{$row['tchurchname']}</td>";
            echo "<td>{$row['ttransferchurch']}</td>";
            echo "<td>{$row['tplacechurch']}</td>";
            echo "<td>{$row['transaction_date']}</td>";
            echo "<td>{$row['tstatus']}</td>";

            echo "<td> <button class='opt' onclick=\"editTransaction({$row['transferID']})\">Edit</button> <button class='opt1' onclick='deleteRow(\"transaction-transfer\", {$row['transferID']})'>Delete</button> </td>";

            echo "</tr>";
        }
    } else {
        echo "No results found";
    }



    echo "</table>";
    echo "</div>";
}

if (isset($baptism_result) && mysqli_num_rows($baptism_result) > 0) {
    // Display table for transaction-baptism

    echo "<h4 style='background-color:rgb(1, 25, 83);color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Baptism History</h4>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped'>";
    echo "<thead class='thead-inverse'>
    <tr><th>Transaction ID</th>
    <th>First Name</th>
    <th>Middle Name</th>
    <th>Last Name</th>
    <th>Church Name</th>
    <th>Transaction Date</th>
    <th>Status</th>
    <th>Operation</th>
    </tr></thead>";
    $count = 0;
    while ($row = mysqli_fetch_array($baptism_result)) {
        $baptismID = isset($row['baptismID']) ? $row['baptismID'] : '';
        $bfname = isset($row['bfname']) ? $row['bfname'] : '';
        $bmname = isset($row['bmname']) ? $row['bmname'] : '';
        $blname = isset($row['blname']) ? $row['blname'] : '';
        $churchname = isset($row['bchurchname']) ? $row['bchurchname'] : '';
        $transaction_date = isset($row['transaction_date']) ? $row['transaction_date'] : '';
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
        echo "<td>$status</td>";

        echo "<td> <button class='opt' onclick=\"editBaptism({$row['baptismID']})\">Edit</button> <button class='opt1' onclick='deleteRow(\"transaction-baptism\", {$row['baptismID']})'>Delete</button> </td>";
    }
    echo "</table>";
    echo "</div>";
}

if (isset($excuse_result) && mysqli_num_rows($excuse_result) > 0) {
    // Display table for transaction-excuse

    echo "<h4 style='background-color:rgb(1, 25, 83);color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Excuse History</h4>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped'>";
    echo "<thead class='thead-inverse'><tr><th>Transaction ID</th><th>First Name</th><th>Middle Name</th><th>Last Name</th><th>Church Name</th><th>Used For</th><th>Organization</th><th>Transaction Date</th><th>Status</th><th>Operation</th></tr></thead>";
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
        echo "<td>$status</td>";
        echo "<td> <button class='opt' onclick=\"editExcuse({$row['excuseID']})\">Edit</button> <button class='opt1' onclick='deleteRow(\"transaction-excuse\", {$row['excuseID']})'>Delete</button> </td>";

        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}

if (isset($purpose_result) && mysqli_num_rows($purpose_result) > 0) {
    // Display table for transaction-purpose

    echo "<h4 style='background-color:rgb(1, 25, 83); color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Purpose History</h4>";

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
        echo "<td>$status</td>";
        echo "<td> <button class='opt' onclick=\"editPurpose({$row['purposeID']})\">Edit</button> <button class='opt1' onclick='deleteRow(\"transaction-purpose\", {$row['purposeID']})'>Delete</button> </td>";

        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

}

// Close the database connection
mysqli_close($conn);

?>

<script script>
    function deletePurpose(purposeID) {
        console.log("Deleting purpose ID " + purposeID);
        if (confirm("Are you sure you want to delete this purpose?")) {
            $.ajax({
                type: "POST", url: "delete-purpose.php", data: { purposeID: purposeID }, dataType: "json", success: function (response) {
                    if (response.success) { // Remove the table row from the DOM 
                        $("#purpose-" + purposeID).remove();
                    } else { alert(response.message); }
                }, error: function (xhr, status, error) { alert("Error deleting purpose: " + error); }
            });
        }
    }

</script>