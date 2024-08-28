<?php
// database connection details
include("connection.php");

// SQL query to retrieve all transaction data
$sql = "SELECT * FROM `transaction-transfer`
        UNION ALL
        SELECT * FROM `transaction-baptism`
        UNION ALL
        SELECT * FROM `excuse_letter_table`
        UNION ALL
        SELECT * FROM `purpose_letter_table`
        ORDER BY `date_created` DESC";

$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Loop through each row of data
    while ($row = $result->fetch_assoc()) {
        // Output data in table row format
        echo "<tr>";
        echo "<td>" . $row["date_created"] . "</td>";
        echo "<td>" . ucwords(str_replace("_", " ", $row["table_name"])) . "</td>";
        echo "<td>" . ucwords($row["status"]) . "</td>";
        echo "</tr>";
    }
} else {
    echo "No results found";
}

// Close the database connection
$conn->close();
?>