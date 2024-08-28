<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="userinterface.css">

    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="interfaceuser.css">

    <div style="position: relative;">
        <img src="/church_member/images/SDALogo.png" alt="SDA Logo"
            style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; height: 10vh; width: 6vw; margin-left: 2vw; margin-top:1.5vh;">
    </div>
    <div style="position: relative;">
        <img src="/church_member/images/h.png" alt="ACMS Logo"
            style="position: absolute; width: 15vw; height:10vh; margin-top:21vh; margin-left:45vw;">
    </div>


</head>

<style>
    .table {

        width: 85%;
    }
</style>

<div class="nav">
    <div class="welcome">
        <p><a href="userinterface.php">WELCOME TO CHURCH MEMBERSHIP INFORMATION SYSTEM</a></p>
    </div>

    <div class="right-links">
        <a href='/church_member/login_register/edituser.php'>Change Profile</a>
        <a href='/church_member/login_register/logout.php'>Logout</a>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<body>

    <!--main container -->
    <div class="container">
        <div>
            <h1 class="md">Member Data</h1>
        </div>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="my-4">

            <div class="formall">
                <div class="form-group">
                    <label for="fname">First Name:</label>
                    <input type="text" name="fname" id="fname" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" id="lname" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">View</button>
                <button type="button" class="btn btn-secondary" id="closeButton">Close</button>

                <button type="button" class="btn btn-success" onclick="openModal()">Make Transaction</button>

            </div>


            <button class="btn btn-success" onclick="showTransactionHistory()">View Transactions</button>


            <script>
            // Add event listener for the "Close" button
                                                                                       $('#closeButton').click(function() {
                                                                                           $('.tablecontainer').hide();
});
            </script>


            <div class="textright">
                <p>
                <ol>
                    <li>Church management system helps in efficient management of church activities and
                        resources.</li>
                    <li>It helps in providing a secure and safe environment for managing sensitive church data.
                    </li>
                    <li>Church management system provides tools for tracking attendance,
                        and managing member information.</li>
                    <li>It helps in automating repetitive tasks and reducing manual work.</li>
                    <li>It helps in improving communication and collaboration among church staff, members, and
                        volunteers.</li>
                </ol>
                </p>
            </div>
        </form>

        <!--viewing details container-->
        <div class="tablecontainer">
            <?php
            include("connection.php");
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];

                $churchmembership_query = "SELECT * FROM churchmembership WHERE fname = '$fname' AND lname = '$lname'";
                $churchmembership_result = $conn->query($churchmembership_query);
                $churchmembership_data = $churchmembership_result->fetch_assoc();

                if (!$churchmembership_data) {
                    echo "<p class='no-records'>No records found for <span class='highlight'>$fname $lname</span></p>";
                } else {
                    $id = $churchmembership_data['id'];

                    $status_query = "SELECT * FROM status WHERE id = $id";
                    $status_result = $conn->query($status_query);

                    $officer_query = "SELECT o.position, o.deptname, officer.* FROM officer 
            JOIN office o ON officer.officeID = o.officeID 
            WHERE officer.id = $id";
                    $officer_result = $conn->query($officer_query);

                    $memberpersonaldetails_query = "SELECT * FROM memberpersonaldetails WHERE id = $id";
                    $memberpersonaldetails_result = $conn->query($memberpersonaldetails_query);
                    $memberpersonaldetails_data = $memberpersonaldetails_result->fetch_assoc();

                    $address_query = $conn->prepare("SELECT * FROM memberpersonaldetails m JOIN address a ON m.addressID = a.addressID WHERE m.id = ?");
                    $address_query->bind_param("i", $id);
                    $address_query->execute();
                    $address_result = $address_query->get_result();
                    $address_data = $address_result->fetch_assoc();

                    echo "<h2 class='mt-5'>Church Membership</h2>";

                    if ($churchmembership_result->num_rows > 0) {
                        echo "<div class='row'>";
                        echo "<div class='form-group col-md-6'>";
                        echo "<label for='cm-id'>ID:</label>";
                        echo "<input type='text' id='cm-id' class='form-control' value='" . ($churchmembership_data['id'] ?? 'No records found.') . "' readonly>";
                        echo "</div>";
                        echo "<div class='form-group col-md-6'>";
                        echo "<label for='cm-fname'>First Name:</label>";
                        echo "<input type='text' id='cm-fname' class='form-control' value='" . ($churchmembership_data['fname'] ?? 'No records found.') . "' readonly>";
                        echo "</div>";
                        echo "<div class='form-group col-md-6'>";
                        echo "<label for='cm-lname'>Last Name:</label>";
                        echo "<input type='text' id='cm-lname' class='form-control' value='" . ($churchmembership_data['lname'] ?? 'No records found.') . "' readonly>";
                        echo "</div>";
                        echo "<div class='form-group col-md-6'>";
                        echo "<label for='cm-bdate'>Baptized Date:</label>";
                        echo "<input type='text' id='cm-bdate' class='form-control' value='" . ($churchmembership_data['baptizeddate'] ?? 'No records found.') . "' readonly>";
                        echo "</div>";
                        echo "<div class='form-group col-md-6'>";
                        echo "<label for='cm-bplace'>Baptized Place:</label>";
                        echo "<input type='text' id='cm-bplace' class='form-control' value='" . ($churchmembership_data['placebaptized'] ?? 'No records found.') . "' readonly>";
                        echo "</div>";
                        echo "<div class='form-group col-md-6'>";
                        echo "<label for='cm-churchname'>Church Name:</label>";
                        echo "<input type='text' id='cm-churchname' class='form-control' value='" . ($churchmembership_data['churchname'] ?? 'No records found.') . "' readonly>";
                        echo "</div>";
                        echo "</div>";

                        echo "<h2 class='mt-5'>Member Personal Details</h2>";

                        echo "<div class='row'>";
                        echo "<div class='form-group col-md-6'>";
                        echo "<label for='mpd-id'>ID:</label>";
                        echo "<input type='text' id='mpd-id' class='form-control' value='" . ($memberpersonaldetails_data['id'] ?? 'No records found.') . "' readonly>";
                        echo "</div>";
                        echo "<div class='form-group col-md-6'>";
                        echo "<label for='mpd-bdate'>Birth Date:</label>";
                        echo "<input type='text' id='mpd-bdate' class='form-control' value='" . ($memberpersonaldetails_data['birthdate'] ?? 'No records found.') . "' readonly>";
                        echo "</div>";

                        echo "<div class='form-group col-md-6'>";
                        echo "<label for='mpd-place'>Birth Place:</label>";
                        echo "<input type='text' id='mpd-place' class='form-control' value='" . ($memberpersonaldetails_data['birthplace'] ?? 'No records found.') . "' readonly>";
                        echo "</div>";
                        echo "<div class='form-group col-md-6'>";
                        echo "<label for='mpd-contactnumber'>Contact Number:</label>";
                        echo "<input type='text' id='mpd-contactnumber' class='form-control' value='" . ($memberpersonaldetails_data['contactnumber'] ?? 'No records found.') . "' readonly>";
                        echo "</div>";
                        echo "<div class='form-group col-md-6'>";
                        echo "<label for='mpd-addressID'>Address ID:</label>";
                        echo "<input type='text' id='mpd-addressID' class='form-control' value='" . ($memberpersonaldetails_data['addressID'] ?? 'No records found.') . "' readonly>";
                        echo "</div>";

                        echo "<div class='form-group col-md-6'>";
                        echo "<label for='mpd-addressDetails'>Address Details:</label>";
                        if ($address_data != null) {
                            $address = "Street: " . $address_data['street'] . ", Purok: " . $address_data['purok'] . ", Barangay: " . $address_data['barangay'] . ", City/Municipality: " . $address_data['city'];
                        } else {
                            $address = "Address details not found.";
                        }
                        echo "<input type='text' id='mpd-addressDetails' class='form-control' value='" . $address . "' readonly>";
                        echo "</div>";
                        echo "</div>";


                        echo "<h2 class='mt-5'>Status</h2>";
                        echo "<table class='table'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>First Quarter</th>";
                        echo "<th>Second Quarter</th>";
                        echo "<th>Third Quarter</th>";
                        echo "<th>Year</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        if ($status_result->num_rows > 0) {
                            while ($status_data = $status_result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $status_data['id'] . "</td>";
                                echo "<td>" . $status_data['fq'] . "</td>";
                                echo "<td>" . $status_data['sq'] . "</td>";
                                echo "<td>" . $status_data['tq'] . "</td>";
                                echo "<td>" . $status_data['year'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No records found.</td></tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";

                        echo "<h2 class='mt-5'>Officer</h2>";
                        echo "<table class='table'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Office ID</th>";
                        echo "<th>Position</th>";
                        echo "<th>Department</th>";
                        echo "<th>Year</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        if ($officer_result->num_rows > 0) {
                            while ($officer_data = $officer_result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $officer_data['id'] . "</td>";
                                echo "<td>" . $officer_data['officeID'] . "</td>";
                                echo "<td>" . $officer_data['position'] . "</td>";
                                echo "<td>" . $officer_data['deptname'] . "</td>";
                                echo "<td>" . $officer_data['year'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No records found.</td></tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    }
                }
                echo "<script>$('#closeButton').show();</script>";
            }
            ?>
        </div>

        <!--end of viewing details container-->


        <!-- Transaction Selection Modal -->

        <div id="transactionModal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="transactionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="transactionModalLabel">Transaction Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="transactionForm" class="p-3">
                        <div class="form-group">
                            <label for="transactionType">Select Transaction Type:</label>
                            <select id="transactionType" class="form-control" onchange="showTransactionForm()">
                                <option value=""></option>
                                <option value="transfer">Transfer</option>
                                <option value="baptismCertificate">Baptism Certificate</option>
                                <option value="excuseLetter">Excuse Letter</option>
                                <option value="purposeLetter">Purpose Letter</option>
                            </select>
                        </div>
                        <div class="modal-footer bg-white">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                onclick="closeModal('transactionModal')">Close</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- end of Transaction Selection Modal -->




        <!-- Transfer Request Form Modal -->
        <div id="transferModal" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="transferModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="transferModalLabel">Transfer Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="closeModal('transferModal')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="transferForm" onsubmit="saveTransactionDetails(event)" method="POST" class="p-3">

                        <div class="form-group">
                            <label for="tfname">First Name:</label>

                            <input type="text" name="tfname" id="tfname" class="form-control capitalize-words" required>
                        </div>
                        <div class="form-group">
                            <label for="tmname">Middle Name:</label>
                            <input type="text" name="tmname" id="tmname" class="form-control capitalize-words"
                                style="text-transform: capitalize;">
                        </div>
                        <div class="form-group">
                            <label for="tlname">Last Name:</label>
                            <input type="text" name="tlname" id="tlname" class="form-control capitalize-words" required
                                style="text-transform: capitalize;">
                        </div>


                        <div class="form-group">
                            <label for="tchurchname">Church Name:</label>

                            <input type="text" name="tchurchname" id="tchurchname" class="form-control capitalize-words"
                                required style="text-transform: capitalize;">
                        </div>
                        <div class="form-group">
                            <label for="ttransferchurch">Transfer Name:</label>
                            <input type="text" name="ttransferchurch" id="ttransferchurch"
                                class="form-control capitalize-words" style="text-transform: capitalize;">
                        </div>
                        <div class="form-group">
                            <label for="tplacechurch">District Name:</label>
                            <input type="text" name="tplacechurch" id="tplacechurch"
                                class="form-control capitalize-words" required style="text-transform: capitalize;">
                        </div>


                        <div class="text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                onclick="closeModal('transferModal')">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- end of Transfer Request Form Modal -->

        <!-- Baptism Request Form Modal -->

        <div id="baptismCertificateModal" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="baptismCertificateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="baptismCertificateModalLabel">Baptism Certificate Form</h5> <button
                            type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="closeModal('baptismCertificateModal')"><span aria-hidden="true">×</span></button>
                    </div>
                    <form id="baptismCertificateForm" onsubmit="saveTransactionDetails(event)" class="p-3">
                        <div class="form-group"> <label for="bfname">First Name:</label>
                            <input type="text" id="bfname" class="form-control" required
                                style="text-transform: capitalize;">
                        </div>
                        <div class="form-group">
                            <label for="bmname">Middle Name:</label>
                            <input type="text" id="bmname" class="form-control" style="text-transform: capitalize;">
                        </div>
                        <div class="form-group">
                            <label for="blname">Last Name:</label>
                            <input type="text" id="blname" class="form-control" required
                                style="text-transform: capitalize;">
                        </div>
                        <div class="form-group">
                            <label for="bchurchname">Church Name:</label>
                            <input type="text" id="bchurchname" class="form-control" required
                                style="text-transform: capitalize;">
                        </div>

                        <div class="text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                onclick="closeModal('baptismCertificateModal')">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- end of Baptism Request Form Modal -->

        <!-- Excuse Request Form Modal -->

        <div id="excuseLetterModal" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="excuseLetterModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="excuseLetterModalLabel">Excuse Letter Form</h5> <button
                            type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="closeModal('excuseLetterModal')"><span aria-hidden="true">×</span></button>
                    </div>
                    <form id="excuseLetterForm" onsubmit="saveTransactionDetails(event)" class="p-3">
                        <div class="form-group"> <label for="efname">First Name:</label>

                            <input type="text" id="efname" class="form-control" required
                                style="text-transform: capitalize;">
                        </div>
                        <div class="form-group">
                            <label for="emname">Middle Name:</label>
                            <input type="text" id="emname" class="form-control" style="text-transform: capitalize;">
                        </div>
                        <div class="form-group">
                            <label for="elname">Last Name:</label>
                            <input type="text" id="elname" class="form-control" required
                                style="text-transform: capitalize;">
                        </div>
                        <div class="form-group">
                            <label for="echurchname">Church Name:</label>
                            <input type="text" id="echurchname" class="form-control" required
                                style="text-transform: capitalize;">
                        </div>
                        <div class="form-group">
                            <label for="eusedfor">Used For:</label>
                            <input type="text" id="eusedfor" class="form-control" required
                                style="text-transform: capitalize;">
                        </div>
                        <div class="form-group">
                            <label for="eorganization">Organization:</label>
                            <input type="text" id="eorganization" class="form-control" required
                                style="text-transform: capitalize;">
                        </div>

                        <div class="text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                onclick="closeModal('excuseLetterModal')">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- end of Excuse Request Form Modal -->

        <!-- Purpose Request Form Modal -->

        <div id="purposeLetterModal" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="purposeLetterModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-top" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="purposeLetterModalLabel">Purpose Letter Form</h5> <button
                            type="button" class="close" data-dismiss="modal" aria-label="Close"
                            onclick="closeModal('purposeLetterModal')"><span aria-hidden="true">×</span></button>
                    </div>
                    <form id="purposeLetterForm" onsubmit="saveTransactionDetails(event)" class="p-3">
                        <div class="form-group"> <label for="pfname">First Name:</label>
                            <input type="text" id="pfname" class="form-control" required
                                style="text-transform: capitalize;">
                        </div>
                        <div class="form-group">
                            <label for="pmname">Middle Name:</label>
                            <input type="text" id="pmname" class="form-control" style="text-transform: capitalize;">
                        </div>
                        <div class="form-group">
                            <label for="plname">Last Name:</label>
                            <input type="text" id="plname" class="form-control" required
                                style="text-transform: capitalize;">
                        </div>
                        <div class="form-group">
                            <label for="pchurchname">Church Name:</label>
                            <input type="text" id="pchurchname" class="form-control" required
                                style="text-transform: capitalize;">
                        </div>
                        <div class="form-group">
                            <label for="pdescription">Description:</label>
                            <textarea id="pdescription" class="form-control" rows="5" required></textarea>
                        </div>

                        <div class="text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                onclick="closeModal('purposeLetterModal')">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- end of Purpose Request Form Modal -->




        <!-- Load JS code at the bottom of the page -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
                                                                                       function openModal() {
                                                                                           $('#transactionModal').modal({ backdrop: 'static' });
        }

                                                                                       function closeModal(modalId) {
                                                                                           $('#' + modalId).modal('hide');
                                                                                       $('#transactionType').val('');
        }

                                                                                       function showTransactionForm() {
        var selectedValue = $('#transactionType').val();
                                                                                       console.log("Selected transaction type: " + selectedValue);
                                                                                       switch(selectedValue) {
        case "transfer":
                                                                                       $('#transferModal').modal('show');
                                                                                       break;
                                                                                       case "baptismCertificate":
                                                                                       $('#baptismCertificateModal').modal('show');
                                                                                       break;
                                                                                       case "excuseLetter":
                                                                                       $('#excuseLetterModal').modal('show');
                                                                                       break;
                                                                                       case "purposeLetter":
                                                                                       $('#purposeLetterModal').modal('show');
                                                                                       break;
                                                                                       default:
                                                                                       console.log("Invalid transaction type selected.");
        }
        }

                                                                                       function saveTransactionDetails(event) {
                                                                                           event.preventDefault();

                                                                                       // Get the form ID and serialize its data
                                                                                       var formID = event.target.id;
                                                                                       var formData = $("#" + formID).serialize();

                                                                                       // Determine which table to save the data to based on the form ID
                                                                                       var tableName;
                                                                                       switch (formID) {
        case "transferForm":
                                                                                       tableName = "transaction-transfer";
                                                                                       break;
                                                                                       case "baptismCertificateForm":
                                                                                       tableName = "transaction-baptism";
                                                                                       break;
                                                                                       case "excuseLetterForm":
                                                                                       tableName = "excuse_letter_table";
                                                                                       break;
                                                                                       case "purposeLetterForm":
                                                                                       tableName = "purpose_letter_table";
                                                                                       break;
                                                                                       default:
                                                                                       console.error("Invalid form ID.");
                                                                                       return;
        }

                                                                                       // Send an AJAX request to save the data to the appropriate table
                                                                                       $.ajax({
                                                                                           url: "saveTransactionDetails.php",
                                                                                       type: "POST",
                                                                                       data: formData + "&tableName=" + tableName,
                                                                                       success: function(response) {
                                                                                           console.log("Data saved successfully.");
        },
                                                                                       error: function(xhr, status, error) {
                                                                                           console.error("Error saving data to database:", error);
        }
        });

                                                                                       // Clear the form inputs and close the modal
                                                                                       $("#" + formID)[0].reset();
                                                                                       closeModal(formID.replace("Form", "Modal"));
        }
        </script>

        <script>


                                                                                       var inputs = document.querySelectorAll('input.form-control.capitalize-words');

                                                                                       function capitalizeWords() {
  var input = this;
                                                                                       var words = input.value.toLowerCase().split(' ');
                                                                                       for (var i = 0; i < words.length; i++) {
                                                                                           words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
  }
                                                                                       var capitalized = words.join(' ');
                                                                                       input.value = capitalized;
}

                                                                                       for (var i = 0; i < inputs.length; i++) {
                                                                                           inputs[i].addEventListener('change', capitalizeWords);
}   
        </script>


        <script>
        function showTransactionHistory() {
  // Make AJAX request to get the email and password of the currently signed-in user
  $.ajax({
    url: 'getCurrentUser.php',
    type: 'GET',
    success: function(result) {
      // Parse the JSON response from the PHP file to get the email and password
      var currentUser = JSON.parse(result);
      var email = currentUser.email;
      var password = currentUser.password;

      // Make AJAX request to get the transaction history for the current user
      $.ajax({
        url: 'getTransactionHistory.php',
        type: 'GET',
        data: { email: email, password: password },
        success: function (result) {
          // Add the retrieved transaction data to the table body
          $('#transactionTableBody').empty();
          $('#transactionTableBody').append(result);

          // Show the View Transactions modal
          $('#viewTransactionModal').modal('show');
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log('Error: ' + textStatus + ' - ' + errorThrown);
        }
      });
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log('Error: ' + textStatus + ' - ' + errorThrown);
    }
  });
}
        </script>

</body>

</html>