<?php
// database connection details
include("connection.php");

$purposeID = $_GET['purposeID'];

$sql = "SELECT * FROM `transaction-purpose` WHERE `purposeID`='$purposeID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data = array(
        'pfname' => $row['pfname'],
        'pmname' => $row['pmname'],
        'plname' => $row['plname'],
        'pchurchname' => $row['pchurchname'],
        'pdescription' => $row['pdescription'],
        'pstatus' => $row['pstatus']
    );
    echo json_encode($data);
} else {
    echo "Transaction not found";
}
$conn->close();
?>