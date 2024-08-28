<?php
// database connection details
include("connection.php");

// start transaction
$conn->begin_transaction();

// check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get the form data and table name from the POST request
    $tableName = $_POST["tableName"];

    // check if the name exists in the churchmembership table
    $fname = $_POST["tfname"] ?? $_POST["bfname"] ?? $_POST["efname"] ?? $_POST["pfname"];
    $lname = $_POST["tlname"] ?? $_POST["blname"] ?? $_POST["elname"] ?? $_POST["plname"];
    $stmt = $conn->prepare("SELECT * FROM churchmembership WHERE fname = ? AND lname = ?");
    $stmt->bind_param("ss", $fname, $lname);
    $stmt->execute();
    $result = $stmt->get_result();

    // insert the form data into the correct table if the name exists
    if ($result->num_rows > 0) {
        switch ($tableName) {
            case "transaction-transfer":
                $stmt = $conn->prepare("CALL insert_transfer_transaction(?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $_POST["tfname"], $_POST["tmname"], $_POST["tlname"], $_POST["tchurchname"], $_POST["ttransferchurch"], $_POST["tplacechurch"]);
                break;

            case "transaction-baptism":
                $stmt = $conn->prepare("CALL insert_baptism_transaction(?, ?, ?, ?)");
                $stmt->bind_param("ssss", $_POST["bfname"], $_POST["bmname"], $_POST["blname"], $_POST["bchurchname"]);
                break;

            case "transaction-excuse":
                $stmt = $conn->prepare("CALL insert_excuse_transaction(?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $_POST["efname"], $_POST["emname"], $_POST["elname"], $_POST["echurchname"], $_POST["eusedfor"], $_POST["eorganization"]);
                break;

            case "transaction-purpose":
                $stmt = $conn->prepare("CALL insert_purpose_transaction(?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $_POST["pfname"], $_POST["pmname"], $_POST["plname"], $_POST["pchurchname"], $_POST["pdescription"]);
                break;

            default:
                echo "Invalid table name.";
                exit;
        }

        // execute the stored procedure
        if ($stmt->execute()) {
            echo "Data saved successfully";
        } else {
            echo "Error: " . $conn->error;
            $conn->rollback(); // rollback if there's an error
        }

    } else {
        // display an error message and exit
        echo "Name not found in the church membership database.";
    }
}

// commit the transaction
$conn->commit();

// Close the database connection
$conn->close();