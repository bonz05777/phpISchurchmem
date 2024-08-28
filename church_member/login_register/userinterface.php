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

    <link rel="stylesheet" href="homeadmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        .textright {

            width: 40vw;
            text-align: left;
            margin-top: -43vh;
            margin-left: 30vw;
            margin-right: 20vw;
            margin-bottom: 15vh;
            /* adjust this value to align the p tag correctly */
        }

        .fixedcontainer {
            z-index: 3;
        }

        .fixedcontainer {
            position: fixed;
            top: 0;
            width: 100%;
            height: 100%;
            overflow-y: scroll;
        }


        .missionvision-container {
            display: flex;
            background-color: rgba(255, 255, 255, 0.9);
            /* Set opacity value between 0 and 1 */
            width: 80%;
            margin-top: 5vh;
            margin-left: 10vw;
            margin-bottom: 5vh;
        }

        .btn {
            margin-top: 1vh;
        }

        .container {
            background-color: white;
            height: 100%;
        }

        .row {
            width: 75vw;
        }
    </style>
    <style>

    </style>




    <div style="position: relative;">
        <img src="/church_member/images/SDALogo.png" alt="SDA Logo"
            style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; height: 10vh; width: 6vw; margin-left: 2vw; margin-top:1.5vh;">
    </div>

    <div class="nav">
        <div class="welcome">
            <p><a href="userinterface.php">WELCOME TO CHURCH MEMBERSHIP INFORMATION SYSTEM</a></p>
        </div>

        <div class=" right-links">
            <a href='/church_member/login_register/edituser.php'>Change Profile</a>
            <a href='/church_member/login_register/logout.php'>Logout</a>
        </div>
    </div>



</head>



<body>


    <!--main container -->
    <div class="container" style=" margin-top:7vh;">
        <div class="image-container">
            <div class="acms"
                style="position: absolute; left: 25%; transform: translateX(-50%); z-index: 10; color: #ffffff; text-shadow: 4px 5px 2px rgba(0, 0, 0, 0.7);">
                <h1 style="font-size: 45pt; font-weight: 1000; margin-left:-160pt; position:absolute;">ACMS</h1>
            </div>

            <img src="/church_member/images/sda.jpg" alt="Adventist Church Image" width="600">
            <div class="overlay"> <svg viewBox="0 0 500 200" width="600">
                    <path d="M 0 50 C 150 150 300 0 500 80 L 500 0 L 0 0" fill="rgb(1, 25, 83)"></path>
                    <path d=" M 0 50 C 150 150 330 -30 500 50 L 500 0 L 0 0" fill="white"> </path>
                </svg>
            </div>
        </div>

        <div class="formcontainerall" style="background-color: white;">
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
                    <div>
                        <button type="submit" class="btn btn-primary">View</button>
                        <button type=" button" class="btn btn-secondary" id="closeButton">Close</button>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div>
                            <button type="button" class="btn btn-success" onclick="openModal()">Make
                                Transaction</button>
                        </div>
                        <div class="ml-2">
                            <button class="btn btn-info" onclick="window.location.href='showAllTransactions.php'">View
                                Transactions</button>
                        </div>
                    </div>
                </div>

                <script>
                    // Add event listener for the "Close" button (member's data -table and row)
                    $('#closeButton').click(function () {
                        $('.tablecontainer').hide();
                    });
                </script>

                <div class="textright" style="margin-top:-105vh; margin-left:43vw; width:30vw; text-align:justify;">

                    <h1 style=" text-align:left; margin-left: .01vw; font-weight: bolder; ">
                        Mission
                    </h1>
                    <p>The mission of the Adventist Membership Systems department is to develop, implement, and support
                        an
                        effective Adventist church management software system that empowers local churches and enhances
                        membership ministries.</p>
                    <h1 style=" text-align:left; margin-left: .01vw; font-weight: bolder; ">
                        Vision
                    </h1>
                    <p>Our vision is to enable local churches to serve members more efficiently
                        and help
                        leaders plan more strategically.</p>
                </div>

            </form>

            <!--viewing details container-->
            <div class="tablecontainer" style="margin-top:40vh;">
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
                            echo "<label for='cm-mname'>Middle Name:</label>";
                            echo "<input type='text' id='cm-mname' class='form-control' value='" . ($churchmembership_data['mname'] ?? 'No records found.') . "' readonly>";
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
                            echo "<label for='cm-ministername'>Officiating Minister:</label>";
                            echo "<input type='text' id='cm-ministername' class='form-control' value='" . ($churchmembership_data['ministername'] ?? 'No records found.') . "' readonly>";
                            echo "</div>";
                            echo "<div class='form-group col-md-6'>";
                            echo "<label for='cm-receivedby'>Received By:</label>";
                            echo "<input type='text' id='cm-receivedby' class='form-control' value='" . ($churchmembership_data['receivedby'] ?? 'No records found.') . "' readonly>";
                            echo "</div>";
                            echo "<div class='form-group col-md-6'>";
                            echo "<label for='cm-receiveddate'>Received date:</label>";
                            echo "<input type='text' id='cm-receiveddate' class='form-control' value='" . ($churchmembership_data['receiveddate'] ?? 'No records found.') . "' readonly>";
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
                            echo "<table class='table' style='width: 70vw; margin: 0 auto;'>";
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
                            echo "<table class='table' style='width: 70vw; margin: 0 auto;'>";
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
                                    <option value="" disabled selected>Please select transaction type</option>
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

                                <input type="text" name="tfname" id="tfname" class="form-control capitalize-words"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="tmname">Middle Name:</label>
                                <input type="text" name="tmname" id="tmname" class="form-control capitalize-words"
                                    style="text-transform: capitalize;">
                            </div>
                            <div class="form-group">
                                <label for="tlname">Last Name:</label>
                                <input type="text" name="tlname" id="tlname" class="form-control capitalize-words"
                                    required style="text-transform: capitalize;">
                            </div>


                            <div class="form-group">
                                <label for="tchurchname">Church Name:</label>

                                <input type="text" name="tchurchname" id="tchurchname"
                                    class="form-control capitalize-words" required style="text-transform: capitalize;">
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
                            <h5 class="modal-title" id="baptismCertificateModalLabel">Baptism Certificate Form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                onclick="closeModal('baptismCertificateModal')"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <form id="baptismCertificateForm" onsubmit="saveTransactionDetails(event)" class="p-3">
                            <div class="form-group"> <label for="bfname">First Name:</label>
                                <input type="text" id="bfname" name="bfname" class="form-control capitalize-words"
                                    required style="text-transform: capitalize;">
                            </div>
                            <div class="form-group">
                                <label for="bmname">Middle Name:</label>
                                <input type="text" id="bmname" name="bmname" class="form-control capitalize-words"
                                    style="text-transform: capitalize;">
                            </div>
                            <div class="form-group">
                                <label for="blname">Last Name:</label>
                                <input type="text" id="blname" name="blname" class="form-control capitalize-words"
                                    required style="text-transform: capitalize;">
                            </div>
                            <div class="form-group">
                                <label for="bchurchname">Church Name:</label>
                                <input type="text" id="bchurchname" name="bchurchname"
                                    class="form-control capitalize-words" required style="text-transform: capitalize;">
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

                                <input type="text" id="efname" name="efname" class="form-control capitalize-words"
                                    required style="text-transform: capitalize;">
                            </div>
                            <div class="form-group">
                                <label for="emname">Middle Name:</label>
                                <input type="text" id="emname" name="emname" class="form-control capitalize-words"
                                    style="text-transform: capitalize;">
                            </div>
                            <div class="form-group">
                                <label for="elname">Last Name:</label>
                                <input type="text" id="elname" name="elname" class="form-control capitalize-words"
                                    required style="text-transform: capitalize;">
                            </div>
                            <div class="form-group">
                                <label for="echurchname">Church Name:</label>
                                <input type="text" id="echurchname" name="echurchname"
                                    class="form-control capitalize-words" required style="text-transform: capitalize;">
                            </div>
                            <div class="form-group">
                                <label for="eusedfor">Used For:</label>
                                <input type="text" id="eusedfor" name="eusedfor" class="form-control capitalize-words"
                                    required style="text-transform: capitalize;">
                            </div>
                            <div class="form-group">
                                <label for="eorganization">Organization:</label>
                                <input type="text" id="eorganization" name="eorganization"
                                    class="form-control capitalize-words" required style="text-transform: capitalize;">
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
                                <input type="text" id="pfname" name="pfname" class="form-control capitalize-words"
                                    required style="text-transform: capitalize;">
                            </div>
                            <div class="form-group">
                                <label for="pmname">Middle Name:</label>
                                <input type="text" id="pmname" name="pmname" class="form-control capitalize-words"
                                    style="text-transform: capitalize;">
                            </div>
                            <div class="form-group">
                                <label for="plname">Last Name:</label>
                                <input type="text" id="plname" name="plname" class="form-control capitalize-words"
                                    required style="text-transform: capitalize;">
                            </div>
                            <div class="form-group">
                                <label for="pchurchname">Church Name:</label>
                                <input type="text" id="pchurchname" name="pchurchname"
                                    class="form-control capitalize-words" required style="text-transform: capitalize;">
                            </div>
                            <div class="form-group">
                                <label for="pdescription">Description:</label>
                                <textarea id="pdescription" name="pdescription" class="form-control capitalize-words"
                                    rows="5" required style="text-transform: capitalize;"></textarea>
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
        </div>

        <!-- end of Purpose Request Form Modal -->


        <!-- Bootstrap and jQuery CDN links -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <!-- end of Bootstrap and jQuery CDN links -->


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
                switch (selectedValue) {
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
                        tableName = "transaction-excuse";
                        break;
                    case "purposeLetterForm":
                        tableName = "transaction-purpose";
                        break;
                    default:
                        console.error("Invalid form ID.");
                        return;
                }


                $.ajax({
                    url: "saveTransactionDetails.php",
                    type: "POST",
                    data: formData + "&tableName=" + tableName,
                    success: function (response) {
                        alert(response);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error saving data to database:", error);
                        // show alert message
                        alert("Error saving data to database: " + error);
                    }
                });

                // Clear the form inputs and close the modal
                $("#" + formID)[0].reset();
                closeModal(formID.replace("Form", "Modal"));
            }



        </script>

        <script>
            // capitalize each word in placeholders front end  
            var inputs = document.querySelectorAll('input.form-control.capitalize-words, textarea.form-control.capitalize-words');
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



        <!--footer-->

        <footer class="footer-distributed"
            style="width:100vw; margin-left:-12vw; margin-top: 40vh; margin-bottom:-5vh;">
            <div class="footer-left">
                <h3 style="font-size: 30pt;">ACMS<span><img src="/church_member/images/SDALogo.png" alt="ACMS Logo"
                            style="height: 5vh;"></span> </h3>
                <p class="footer-links">
                    <a href="#" class="link-1">Home</a>
                    <a href="#">Blog</a>
                    <a href="#">About</a>
                    <a href="#">Faq</a>
                    <a href="#">Contact</a>
                </p>

                <p class="footer-company-name">Copyright 2023, General Conference of Seventh-day Adventists</p>
            </div>
            <div class="footer-center">
                <div>
                    <i class="fa fa-map-marker"></i>
                    <p><span>45H6+793,</span> Salvani St, General Santos City, South Cotabato</p>

                </div>
                <div>
                    <i class="fa fa-phone"></i>
                    <p>63 (83) 553-4662, 887-3110</p>
                </div>
                <div>
                    <i class="fa fa-envelope"></i>
                    <p><a href="mailto:smmsda65@yahoo.com.">smmsda65@yahoo.com.</a></p>
                </div>
            </div>
            <div class="footer-right">

                <p class="footer-company-about">
                    <span>About us</span>
                    ADVENTIST® and SEVENTH-DAY ADVENTIST® are the registered trademarks of the General Conference of
                    Seventh-day
                    Adventists®.
                </p>
                <div class="footer-icons">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>

                </div>

            </div>

        </footer>

        <!-- Credit to https://codepen.io/slstudios/pen/XbzQVK -->

</body>


</html>