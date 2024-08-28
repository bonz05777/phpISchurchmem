<?php
include "connection.php";
$msg = "";
$id = "";
$fq = "";
$sq = "";
$tq = "";
$year = "";

include "connection.php";

// Function to check if id and year already exist in status table
function checkExistence($id, $year) {
    global $conn;
    $query = "SELECT * FROM status WHERE id = '$id' AND year = '$year'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}

// Function to get list of IDs from churchmembership table
function getIDs() {
    global $conn;
    $query = "SELECT id FROM churchmembership";
    $result = mysqli_query($conn, $query);
    $ids = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $ids[] = $row['id'];
    }
    return $ids;
}

// Insert/update status data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $fq = $_POST['fq'];
    $sq = $_POST['sq'];
    $tq = $_POST['tq'];
    $year = $_POST['year'];
    
    // Function to check if ID is present in churchmembership table
function checkMembership($id) {
    global $conn;
    $sql = "SELECT * FROM churchmembership WHERE id = '$id'";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}

// Function to check if ID and year are already present in status table
function isDuplicate($id, $year) {
    global $conn;
    $sql = "SELECT * FROM status WHERE id = '$id' AND year = '$year'";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}

// Check if ID is present in churchmembership table before inserting or updating
if (!checkMembership($id)) {
    echo "<script>alert('ID not found in churchmembership table.');</script>";
    exit;
}

// Check if ID and year are already present in status table
if (isDuplicate($id, $year)) {
    echo "<script>alert('This ID and year combination already exists in the status table.');</script>";
    exit;
}

// Insert new status data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $sql = "INSERT INTO status (id, fq, sq, tq, year) VALUES ('$id', '$fq', '$sq', '$tq', '$year')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Status record added successfully.');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Update existing status data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $sql = "UPDATE status SET fq = '$fq', sq = '$sq', tq = '$tq' WHERE id = '$id' AND year = '$year'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Status record updated successfully.');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
}

?>





<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
    <title>MEMBER'S STATUS</title>
    <link rel="stylesheet" type="text/css" href="styleaddstatus.css">
</head>

<body>
    

    <div class="container">
        <div class="inner">
            <div class="title">
                <h1>STATUS MEMBERSHIP</h1>
            </div>

            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <div class="contents">
                    <div>
                    <label for="id">ID: </label>
                    </div>
                    <input type="text" name="id" class="data-insert" value="<?php echo $id; ?>">
                    <div>
                    <label for="fq">First Quarter: </label>
                    </div>
                    <select name="fq" class="data-insert" >
                        <option> </option>
                        <option <?php if ($fq == "Active") echo "selected"; ?>>Active</option>
                        <option <?php if ($fq == "Inactive") echo "selected"; ?>>Inactive</option>
                        <option <?php if ($fq == "Transferred") echo "selected"; ?>>Transferred</option>
                        <option <?php if ($fq == "No record") echo "selected"; ?>>No Record</option>
                    </select>
                    <div>
                    <label for="sq">Second Quarter: </label>
                    </div>
                    <select name="sq" class="data-insert" >
                        <option> </option>
                        <option <?php if ($sq == "Active") echo "selected"; ?>>Active</option>
                        <option <?php if ($sq == "Inactive") echo "selected"; ?>>Inactive</option>
                        <option <?php if ($sq == "Transferred") echo "selected"; ?>>Transferred</option>
                        <option <?php if ($sq == "No record") echo "selected"; ?>>No Record</option>
                    </select>
                    </select>
                    <div>
                    <label for="tq">Third Quarter: </label>
                    </div>
                    <select name="tq" class="data-insert" >
                        <option> </option>
                        <option <?php if ($tq == "Active") echo "selected"; ?>>Active</option>
                        <option <?php if ($tq == "Inactive") echo "selected"; ?>>Inactive</option>
                        <option <?php if ($tq == "Transferred") echo "selected"; ?>>Transferred</option>
                        <option <?php if ($tq == "No record") echo "selected"; ?>>No Record</option>
                    </select>
                    </select>
                    <div>
                    <label for="year">Year: </label>
                    </div>
                    <input type="text" name="year" class="data-insert" value="<?php echo $year; ?>">

                    <button type="submit">Save</button>

                    <a href="statusform.php" class="sub_btns">VIEW</a>
                    <input type="reset" class="sub_btnss" value="CLEAR">

                    <a href="index.php" class="out_btns">LOGOUT</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>