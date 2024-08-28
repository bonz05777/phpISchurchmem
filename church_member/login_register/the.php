<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Transaction Transfer Table</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Transfer ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Church Name</th>
                <th>Transfer to Church</th>
                <th>Transfer to Place</th>
                <th>Transaction Date</th>
                <th>Status</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // database connection details
            include("connection.php");

            $sql = "SELECT * FROM `transaction-transfer`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['transferID']}</td>";
                    echo "<td>{$row['tfname']}</td>";
                    echo "<td>{$row['tmname']}</td>";
                    echo "<td>{$row['tlname']}</td>";
                    echo "<td>{$row['tchurchname']}</td>";
                    echo "<td>{$row['ttransferchurch']}</td>";
                    echo "<td>{$row['tplacechurch']}</td>";
                    echo "<td>{$row['transaction_date']}</td>";
                    echo "<td>{$row['tstatus']}</td>";
                    echo "<td><button onclick=\"editTransaction({$row['transferID']})\">Edit</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "No results found";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <!-- Modal popup for editing transaction -->
    <div id="edit-transaction-modal" style="display: none;">
        <form>
            <label for="tfname">First Name:</label>
            <input type="text" name="tfname" id="tfname" required><br>

            <label for="tmname">Middle Name:</label>
            <input type="text" name="tmname" id="tmname"><br>

            <label for="tlname">Last Name:</label>
            <input type="text" name="tlname" id="tlname" required><br>

            <label for="tchurchname">Church Name:</label>
            <input type="text" name="tchurchname" id="tchurchname"><br>

            <label for="ttransferchurch">Transfer to Church:</label>
            <input type="text" name="ttransferchurch" id="ttransferchurch"><br>

            <label for="tplacechurch">Transfer to Place:</label>
            <input type="text" name="tplacechurch" id="tplacechurch"><br>

            <label for="transaction_date">Transaction Date:</label>
            <input type="date" name="transaction_date" id="transaction_date" required><br>

            <label for="tstatus">Status:</label>
            <input type="text" name="tstatus" id="tstatus" required><br>

            <input type="submit" value="Update">
        </form>
    </div>

    <!-- Modal popup for adding transaction -->
    <div id="add-transaction-modal" style="display: none;">
        <form>
            <label for="bfname">First Name:</label>
            <input type="text" name="bfname" id="bfname" required><br>

            <label for="bmname">Middle Name:</label>
            <input type="text" name="bmname" id="bmname"><br>

            <label for="blname">Last Name:</label>
            <input type="text" name="blname" id="blname" required><br>

            <label for="bchurchname">Church Name:</label>
            <input type="text" name="bchurchname" id="bchurchname"><br>

            <label for="transaction_date">Transaction Date:</label>
            <input type="date" name="transaction_date" id="transaction_date" required><br>

            <label for="bstatus">Status:</label>
            <input type="text" name="bstatus" id="bstatus" required><br>

            <input type="submit" value="Add">
        </form>
    </div>

    <script>
        function editTransaction(transferID) {
            // Your JavaScript code to display the modal popup and populate the form with data from the database
            var modal = document.getElementById('edit-transaction-modal');
            modal.style.display = 'block';

            fetch('fetch_transaction.php?transferID=' + transferID)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('tfname').value = data.tfname;
                    document.getElementById('tmname').value = data.tmname;
                    document.getElementById('tlname').value = data.tlname;
                    document.getElementById('tchurchname').value = data.tchurchname;
                    document.getElementById('ttransferchurch').value = data.ttransferchurch;
                    document.getElementById('tplacechurch').value = data.tplacechurch;
                    document.getElementById('transaction_date').value = data.transaction_date;
                    document.getElementById('tstatus').value = data.tstatus;
                });

            document.querySelector('#edit-transaction-modal form').addEventListener('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('transferID', transferID);
                fetch('update_transaction.php', {
                    method: 'POST',
                    body: formData,
                }).then(response => {
                    console.log(response);
                    // You can display a success message or close the modal popup here
                }).catch(error => console.error(error));
            });
        }

        function addTransaction() {
            // your JavaScript code to display the modal popup for adding transaction
            var modal = document.getElementById('add-transaction-modal');
            modal.style.display = 'block';

            document.querySelector('#add-transaction-modal form').addEventListener('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                fetch('insert_transaction.php', {
                    method: 'POST',
                    body: formData,
                }).then(response => {
                    console.log(response);
                    // You can display a success message or close the modal popup here
                }).catch(error => console.error(error));
            });
        }
    </script>
</body>

</html>