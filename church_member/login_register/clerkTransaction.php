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

<body>
    <!-- Modal popup for editing transaction -->
    <div id="edit-transaction-modal" style="display: none;">
        <form>
            <label for="tfname">First Name:</label>
            <input type="text" name="tfname" id="tfname" required><br>

            <label for="tmname">Middle Name:</label>
            <input type="text" name="tmname" id="tmname"><br>

            <label for="tlname">Last Name:</label>
            <input type="text" name="tlname" id="tlname" required><br>

            <label for="tchurchname">Church Name:</label>
            <input type="text" name="tchurchname" id="tchurchname"><br>

            <label for="ttransferchurch">Transfer to Church:</label>
            <input type="text" name="ttransferchurch" id="ttransferchurch"><br>

            <label for="tplacechurch">Transfer to Place:</label>
            <input type="text" name="tplacechurch" id="tplacechurch"><br>

            <label for="tstatus">Status:</label>
            <input type="text" name="tstatus" id="tstatus" required><br>

            <input type="submit" value="Update">
        </form>
    </div>

    <script>
        function editTransaction(transferID) {
            // Your JavaScript code to display the modal popup and populate the form with data from the database
            var modal = document.getElementById('edit-transaction-modal');
            modal.style.display = 'block';

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
                    // You can display a success message or close the modal popup here
                }).catch(error => console.error(error));
            });
        }

    </script>


    <!-- Modal popup for editing baptism -->
    <div id="edit-baptism-modal" style="display: none;">
        <form>
            <label for="bfname">First Name:</label>
            <input type="text" name="bfname" id="bfname" required><br>

            <label for="bmname">Middle Name:</label>
            <input type="text" name="bmname" id="bmname"><br>

            <label for="blname">Last Name:</label>
            <input type="text" name="blname" id="blname" required><br>

            <label for="bchurchname">Church Name:</label>
            <input type="text" name="bchurchname" id="bchurchname"><br>

            <label for="bstatus">Status:</label>
            <input type="text" name="bstatus" id="bstatus" required><br>

            <input type="submit" value="Update">
        </form>
    </div>

    <script>
        function editBaptism(baptismID) {
            // Your JavaScript code to display the modal popup and populate the form with data from the database
            var modal = document.getElementById('edit-baptism-modal');
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
                    // You can display a success message or close the modal popup here
                }).catch(error => console.error(error));
            });
        }

    </script>


    <!-- Modal popup for editing excuse -->
    <div id="edit-excuse-modal" style="display: none;">
        <form>
            <label for="efname">First Name:</label>
            <input type="text" name="efname" id="efname" required><br>

            <label for="emname">Middle Name:</label>
            <input type="text" name="emname" id="emname"><br>

            <label for="elname">Last Name:</label>
            <input type="text" name="elname" id="elname" required><br>

            <label for="echurchname">Church Name:</label>
            <input type="text" name="echurchname" id="echurchname"><br>

            <label for="eusedfor">Used For:</label>
            <input type="text" name="eusedfor" id="eusedfor" required><br>

            <label for="eorganization">Used For:</label>
            <input type="text" name="eorganization" id="eorganization" required><br>

            <label for="estatus">Status:</label>
            <input type="text" name="estatus" id="estatus" required><br>

            <input type="submit" value="Update">
        </form>
    </div>

    <script>
        function editExcuse(excuseID) {
            // Your JavaScript code to display the modal popup and populate the form with data from the database
            var modal = document.getElementById('edit-excuse-modal');
            modal.style.display = 'block';

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
                    // You can display a success message or close the modal popup here
                }).catch(error => console.error(error));
            });
        }

    </script>

    <!-- Modal popup for editing purpose -->
    <div id="edit-purpose-modal" style="display: none;">
        <form>
            <label for="pfname">First Name:</label>
            <input type="text" name="pfname" id="pfname" required><br>

            <label for="pmname">Middle Name:</label>
            <input type="text" name="pmname" id="pmname"><br>

            <label for="plname">Last Name:</label>
            <input type="text" name="plname" id="plname" required><br>

            <label for="pchurchname">Church Name:</label>
            <input type="text" name="pchurchname" id="pchurchname"><br>

            <label for="pdescrition">Descrition:</label>
            <input type="text" name="pdescrition" id="pdescrition" required><br>

            <label for="pstatus">Status:</label>
            <input type="text" name="pstatus" id="pstatus" required><br>

            <input type="submit" value="Update">
        </form>
    </div>

    <script>
        function editPurpose(purposeID) {
            // Your JavaScript code to display the modal popup and populate the form with data from the database
            var modal = document.getElementById('edit-purpose-modal');
            modal.style.display = 'block';

            fetch('fetch_purpose.php?purposeID=' + purposeID)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('pfname').value = data.pfname;
                    document.getElementById('pmname').value = data.pmname;
                    document.getElementById('plname').value = data.plname;
                    document.getElementById('pchurchname').value = data.pchurchname;
                    document.getElementById('transaction_date').value = data.transaction_date;
                    document.getElementById('pdescription').value = data.pdescription;
                    document.getElementById('pstatus').value = data.pstatus;
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
                    // You can display a success message or close the modal popup here
                }).catch(error => console.error(error));
            });
        }

    </script>

</body>

<?php
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
    echo "<h4 style='background-color:rgb(1, 25, 83); color: white; margin-left: 5vw; max-width: 85%; margin: 3vh auto 0; padding: 2vh 0; text-align: center;'>Transaction Transfer History</h4>";
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
        echo "<td>{$row['status']}</td>";
        // Add Edit button

        echo "<td> <button class='opt' onclick=\"editTransaction({$row['transferID']})\">Edit</button> <button class='opt1' onclick='deleteRow(\"transaction-transfer\", {$row['transferID']})'>Delete</button> </td>";
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
        echo "<td><button class='opt' data-id='{$row['baptismID']}' onclick='editRow(\"transaction-baptism\", {$row['baptismID']})'>Edit</button>" .
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
        echo "<td><button class='opt' data-id='{$row['excuseID']}' onclick='editRow(\"transaction-excuse\", {$row['excuseID']})'>Edit</button>" .
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

        echo "<td><button class='opt' data-id='{$row['purposeID']}' onclick='editRow(\"transaction-purpose\", {$row['purposeID']})'>Edit</button>" .
            "<button class='opt1' onclick='deleteRow(\"transaction-purpose\", $purposeID)'>Delete</button></td>";
        echo "</tr>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

}

mysqli_close($conn);
?>
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

    function editRow(table, id) {
        // Get row element by ID
        var row = document.getElementById(`transfer-${id}`);
        // Get current status value from row
        var status = row.cells[8].textContent;
        // Create form popup element
        var form = document.createElement('div');
        form.innerHTML = `
    <form id="edit-form" method="POST" action="">
      <h2>Edit Transaction ${id}</h2>
      <input type="hidden" name="table" value="${table}">
      <input type="hidden" name="id" value="${id}">
      <label for="status">Status:</label>
      <input type="text" id="status" name="status" value="${status}">
      <button type="submit" name="submit">Save</button>
    </form>
  `;
        // Add form popup to the page
        document.body.appendChild(form);
        // Add event listener to form submit button
        form.querySelector('button[type="submit"]').addEventListener('click', function (event) {
            event.preventDefault();
            // Send AJAX request to update record with new status value
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'update.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                // Reload page after update is complete
                location.reload();
            };
            xhr.send(`table=${table}&id=${id}&status=${form.querySelector('#status').value}`);
        });
    }
</script>