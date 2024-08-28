<!-- Transaction Selection Modal -->

<div class="modal fade" id="selectTransactionModal" tabindex="-1" role="dialog"
    aria-labelledby="selectTransactionModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectTransactionModalLabel">Select Transaction Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action" id="transferLink">Transfer
                        Request</a>
                    <a href="#" class="list-group-item list-group-item-action" id="baptismLink">Baptism
                        Certificate
                        Request</a>
                    <a href="#" class="list-group-item list-group-item-action" id="excuseLink">Excuse Letter
                        Request</a>
                    <a href="#" class="list-group-item list-group-item-action" id="purposeLink">Purpose Letter
                        Request</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="transferModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transferModalLabel">Transfer Request Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="transferForm">
                    <div class="form-group">
                        <label for="transfer-fname">First Name:</label>
                        <input type="text" class="form-control" id="transfer-fname" name="transfer-fname" required>
                    </div>
                    <div class="form-group">
                        <label for="transfer-mname">Middle Name:</label>
                        <input type="text" class="form-control" id="transfer-mname" name="transfer-mname" required>
                    </div>
                    <div class="form-group">
                        <label for="transfer-lname">Last Name:</label>
                        <input type="text" class="form-control" id="transfer-lname" name="transfer-lname" required>
                    </div>
                    <div class="form-group">
                        <label for="transfer-churchtotransfer">Church to Transfer to:</label>
                        <input type="text" class="form-control" id="transfer-churchtotransfer"
                            name="transfer-churchtotransfer" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitTransferBtn">Send</button>
            </div>
        </div>
    </div>
</div>

<div id="requestTransfer" style="display:none">
    <form>
        <div class="form-group">
            <label for="transaction-fname">First Name:</label>
            <input type="text" class="form-control" id="transaction-fname-transfer" placeholder="Enter first name"
                required>
        </div>
        <div class="form-group">
            <label for="transaction-mname">Middle Name:</label>
            <input type="text" class="form-control" id="transaction-mname-transfer" placeholder="Enter middle name">
        </div>
        <div class="form-group">
            <label for="transaction-lname">Last Name:</label>
            <input type="text" class="form-control" id="transaction-lname-transfer" placeholder="Enter last name"
                required>
        </div>
        <div class="form-group">
            <label for="transaction-churchname">Church Member:</label>
            <input type="text" class="form-control" id="transaction-churchname-transfer" placeholder="Enter church name"
                required>
        </div>
        <div class="form-group">
            <label for="transaction-transferchurch">Transfer to Church:</label>
            <input type="text" class="form-control" id="transaction-transferchurch-transfer"
                placeholder="Enter church to transfer" required>
        </div>
        <div class="form-group">
            <label for="transaction-placechurch">Transfer to Church District:</label>
            <input type="text" class="form-control" id="transaction-placechurch-transfer"
                placeholder="Enter district of the transfer church" required>
        </div>
    </form>
</div>

<!-- Baptism Certificate Request Form Modal -->
<div class="modal fade" id="baptismCertificateModal" tabindex="-1" role="dialog"
    aria-labelledby="baptismCertificateModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="baptismCertificateModalLabel">Baptism Certificate Request Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="baptismCertificateForm">
                    <div class="form-group">
                        <label for="baptism-fname">First Name:</label>
                        <input type="text" class="form-control" id="baptism-fname" name="baptism-fname" required>
                    </div>
                    <div class="form-group">
                        <label for="baptism-mname">Middle Name:</label>
                        <input type="text" class="form-control" id="baptism-mname" name="baptism-mname" required>
                    </div>
                    <div class="form-group">
                        <label for="baptism-lname">Last Name:</label>
                        <input type="text" class="form-control" id="baptism-lname" name="baptism-lname" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitBaptismCertificateBtn">Send</button>
            </div>
        </div>
    </div>
</div>

<!-- Excuse Letter Request Form Modal -->
<div class="modal fade" id="excuseLetterModal" tabindex="-1" role="dialog" aria-labelledby="excuseLetterModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="excuseLetterModalLabel">Excuse Letter Request Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="excuseLetterForm">
                    <div class="form-group">
                        <label for="excuse-fname">First Name:</label>
                        <input type="text" class="form-control" id="excuse-fname" name="excuse-fname" required>
                    </div>
                    <div class="form-group">
                        <label for="excuse-mname">Middle Name:</label>
                        <input type="text" class="form-control" id="excuse-mname" name="excuse-mname" required>
                    </div>
                    <div class="form-group">
                        <label for="excuse-lname">Last Name:</label>
                        <input type="text" class="form-control" id="excuse-lname" name="excuse-lname" required>
                    </div>
                    <div class="form-group">
                        <label for="excuse-usedfor">To be used for:</label>
                        <input type="text" class="form-control" id="excuse-usedfor" name="excuse-usedfor" required>
                    </div>
                    <div class="form-group">
                        <label for="excuse-organization">Organization:</label>
                        <input type="text" class="form-control" id="excuse-organization" name="excuse-organization"
                            required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitExcuseLetterBtn">Send</button>
            </div>
        </div>
    </div>
</div>

<!-- Purpose Letter Request Form Modal -->
<div class="modal fade" id="purposeLetterModal" tabindex="-1" role="dialog" aria-labelledby="purposeLetterModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="purposeLetterModalLabel">Purpose Letter Request Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="purposeLetterForm">
                    <div class="form-group">
                        <label for="purpose-fname">First Name:</label>
                        <input type="text" class="form-control" id="purpose-fname" name="purpose-fname" required>
                    </div>
                    <div class="form-group">
                        <label for="purpose-mname">Middle Name:</label>
                        <input type="text" class="form-control" id="purpose-mname" name="purpose-mname" required>
                    </div>
                    <div class="form-group">
                        <label for="purpose-lname">Last Name:</label>
                        <input type="text" class="form-control" id="purpose-lname" name="purpose-lname" required>
                    </div>
                    <div class="form-group">
                        <label for="purpose-description">Description:</label>
                        <textarea class="form-control" rows="5" id="purpose-description" name="purpose-description"
                            required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitPurposeLetterBtn">Send</button>
            </div>
        </div>
    </div>
</div>



<style>
    .modal-header {
        background-color: #191970;
        color: #fff;
    }

    .modal-title {
        font-weight: bold;
        font-size: 20px;
    }

    .close {
        color: #fff;
    }

    .modal-content {
        width: 600px;
    }

    .modal-body {
        font-size: 18px;
    }

    .modal-footer {
        background-color: #191970;
    }

    #requestTransfer {
        font-size: 18px;
    }

    #requestTransfer input {
        width: 100%;
        margin-bottom: 15px;
    }

    #submitTransferBtn {
        background-color: #191970;
    }

    #submitTransferBtn:hover {
        background-color: #3c3c3c;
    }
</style>

<script>
    $(document).ready(function () {
        // Transfer Request Form Submission
        $("#submitTransferBtn").click(function () {
            var fname = $("#transfer-fname").val();
            var mname = $("#transfer-mname").val();
            var lname = $("#transfer-lname").val();
            var churchtotransfer = $("#transfer-churchtotransfer").val();

            $.post("userinterface.php", {
                "transactionType": "transfer",
                "fname": fname,
                "mname": mname,
                "lname": lname,
                "churchtotransfer": churchtotransfer
            }, function (data) {
                alert(data);
                $('#transferModal').modal('hide');
            });
        });

        // Baptism Certificate Request Form Submission
        $("#submitBaptismCertificateBtn").click(function () {
            var fname = $("#baptism-fname").val();
            var mname = $("#baptism-mname").val();
            var lname = $("#baptism-lname").val();

            $.post("userinterface.php", {
                "transactionType": "baptism",
                "fname": fname,
                "mname": mname,
                "lname": lname
            }, function (data) {
                alert(data);
                $('#baptismCertificateModal').modal('hide');
            });
        });

        // Excuse Letter Request Form Submission
        $("#submitExcuseLetterBtn").click(function () {
            var fname = $("#excuse-fname").val();
            var mname = $("#excuse-mname").val();
            var lname = $("#excuse-lname").val();
            var usedfor = $("#excuse-usedfor").val();
            var organization = $("#excuse-organization").val();

            $.post("userinterface.php", {
                "transactionType": "excuse",
                "fname": fname,
                "mname": mname,
                "lname": lname,
                "usedfor": usedfor,
                "organization": organization
            }, function (data) {
                alert(data);
                $('#excuseLetterModal').modal('hide');
            });
        });

        // Purpose Letter Request Form Submission
        $("#submitPurposeLetterBtn").click(function () {
            var fname = $("#purpose-fname").val();
            var mname = $("#purpose-mname").val();
            var lname = $("#purpose-lname").val();
            var description = $("#purpose-description").val();

            $.post("userinterface.php", {
                "transactionType": "purpose",
                "fname": fname,
                "mname": mname,
                "lname": lname,
                "description": description
            }, function (data) {
                alert(data);
                $('#purposeLetterModal').modal('hide');
            });
        });

        // Handle transaction selection
        $("#transferLink").click(function () {
            $('#selectTransactionModal').modal('hide');
            $('#transferModal').modal('show');
        });
        $("#baptismLink").click(function () {
            $('#selectTransactionModal').modal('hide');
            $('#baptismCertificateModal').modal('show');
        });
        $("#excuseLink").click(function () {
            $('#selectTransactionModal').modal('hide');
            $('#excuseLetterModal').modal('show');
        });
        $("#purposeLink").click(function () {
            $('#selectTransactionModal').modal('hide');
            $('#purposeLetterModal').modal('show');
        });
    });
</script>


<?php
include("connection.php");

if (isset($_POST['transactionType']) && $_POST['transactionType'] == 'transfer') {
    // Insert transfer data into database



    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $churchtotransfer = $_POST['churchtotransfer'];



    $sql = "INSERT INTO transfer (first_name, middle_name, last_name, church_to_transfer) 
            VALUES ('$fname', '$mname', '$lname', '$churchtotransfer')";

    if ($conn->query($sql) === TRUE) {
        echo "Transfer request submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>