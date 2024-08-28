<?php
include("connection.php");

$transactionType = $_POST['transactionType'];

if ($transactionType === 'transfer') {
    $fname = $_POST['formData']['fname'];
    $mname = $_POST['formData']['mname'];
    $lname = $_POST['formData']['lname'];
    $churchname = $_POST['formData']['churchname'];
    $transferchurch = $_POST['formData']['transferchurch'];
    $placechurch = $_POST['formData']['placechurch'];

    $sql = "INSERT INTO transactiontransfer (fname, mname, lname, churchname, transferchurch, placechurch) VALUES ('$fname', '$mname', '$lname', '$churchname', '$transferchurch', '$placechurch')";

    if (!$result = $db->query($sql)) {
        echo "Error inserting transaction data: ";
        exit();
    }

    // Handle success case here.
} //else if (/* handle other transaction types */ ) {
// Handle other transaction types.
//}

$db->close();
?>