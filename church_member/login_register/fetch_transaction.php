<?php
// database connection details
include("connection.php");

$transferID = $_GET['transferID'];

$sql = "SELECT * FROM `transaction-transfer` WHERE `transferID`='$transferID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array(
        'tfname' => $row['tfname'],
        'tmname' => $row['tmname'],
        'tlname' => $row['tlname'],
        'tchurchname' => $row['tchurchname'],
        'ttransferchurch' => $row['ttransferchurch'],
        'tplacechurch' => $row['tplacechurch'],
        'transaction_date' => $row['transaction_date'],
        'tstatus' => $row['tstatus']
    );
    echo json_encode($data);
} else {
    echo "Transaction not found";
}
$conn->close();
?>