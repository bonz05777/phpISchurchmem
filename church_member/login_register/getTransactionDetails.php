<?php
include("connection.php");

$table = isset($_POST['table']) ? mysqli_real_escape_string($conn, $_POST['table']) : '';
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if (!empty($table) && $id > 0) {
    // Query the appropriate table based on the provided table name
    if ($table == 'transaction-transfer') {
        $sql = "SELECT tstatus AS status FROM `$table` WHERE transferID = $id";
    } elseif ($table == 'transaction-baptism') {
        $sql = "SELECT bstatus AS status FROM `$table` WHERE baptismID = $id";
    } elseif ($table == 'transaction-excuse') {
        $sql = "SELECT estatus AS status FROM `$table` WHERE excuseID = $id";
    } elseif ($table == 'transaction-purpose') {
        $sql = "SELECT pstatus AS status FROM `$table` WHERE purposeID = $id";
    }

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        echo json_encode([
            'status' => $row['status']
        ]);
    } else {
        echo json_encode([
            'status' => ''
        ]);
    }
} else {
    echo json_encode([
        'status' => ''
    ]);
}

mysqli_close($conn);
?>