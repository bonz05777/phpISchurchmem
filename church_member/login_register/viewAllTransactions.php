<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaction History</title>
    <!-- Bootstrap CSS for table dispalying results -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <link rel="stylesheet" href="interfaceuser.css">
    <link rel="stylesheet" href="userinterface.css">

    <div style="position: relative;">
        <img src="/church_member/images/SDALogo.png" alt="SDA Logo"
            style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; height: 10vh; width: 6vw; margin-left: 2vw; margin-top:1.5vh;">
    </div>


    <style>
        .container {
            margin-top: 5vh;
            margin-bottom: 5vh;
            background-color: white;
            height: 100%;
        }
    </style>

</head>


<div class="nav">
    <div class="welcome">
        <p><a href="home.php">WELCOME TO CHURCH MEMBERSHIP INFORMATION SYSTEM</a></p>
    </div>

    <div class="right-links">
        <a href='/church_member/login_register/edituser.php'>Change Profile</a>
        <a href='/church_member/login_register/logout.php'>Logout</a>
    </div>
</div>

</head>


<body>
    <div class="container" style="height: 50vh;  border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
        <div class="row">
            <div class="col-md-6">
                <h1 style="font-weight: bold; margin-top: 5vh; margin-bottom: 4vh;">Transaction History</h1>

                <form method="POST">
                    <div class="form-group" style="margin-left: 5vw; margin-right: 5vw;">
                        <label for="fname" style="margin-right: 5vw;">First Name:</label>
                        <input type="text" name="fname" id="fname" class="form-control" style="margin-right: 5vw;"
                            required>
                    </div>
                    <div class="form-group" style="margin-left: 5vw; margin-right: 5vw;">
                        <label for="lname" style="margin-right: 5vw;">Last Name:</label>
                        <input type="text" name="lname" id="lname" class="form-control" style="margin-right: 5vw;"
                            required>
                    </div>
                    <div style="margin-left: 5vw;">
                        <button type="button" id="submitBtn" class="btn btn-primary">View
                            History</button>
                        <button type="button" id="clearBtn" class="btn btn-info">Clear</button>
                        <button type="button" id="viewAllBtn" class="btn btn-success">All Transactions</button>
                        <button type="button" id="closeBtn" class="btn btn-secondary"
                            style="display:none;">Close</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6" style="margin-top: 7vh;">
                <div class="textright">
                    <p>
                    <ol>
                        <li>Church management system helps in efficient management of church activities and resources.
                        </li>
                        <li>It helps in providing a secure and safe environment for managing sensitive church data.</li>
                        <li>Church management system provides tools for tracking attendance, and managing member
                            information.</li>
                        <li>It helps in automating repetitive tasks and reducing manual work.</li>
                        <li>It helps in improving communication and collaboration among church staff, members, and
                            volunteers.</li>
                    </ol>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="result"></div>




    <script>
        $(document).ready(function () {
            // This function runs once the DOM is ready, ensuring that the code inside it doesn't execute before the page is fully loaded.

            // Add event listener to the "Submit" button.
            $("#submitBtn").click(function () {
                // Get the values of the "fname" and "lname" input fields.
                var fname = $("#fname").val();
                var lname = $("#lname").val();

                // Make an HTTP POST request to "retrieve_history.php" with the "fname" and "lname" values.
                $.post(
                    "retrieve_historyAdmin.php",
                    {
                        fname: fname,
                        lname: lname
                    },
                    function (data, status) {
                        // This function runs when the server response is received.
                        // Set the HTML content of the "result" element to the data returned by the server.
                        $("#result").html(data);

                        // Show the "Close" button and hide the "Submit" button.
                        $("#closeBtn").show();
                        $("#submitBtn").hide();
                    }
                );
            });


            // Add event listener to the "Close" button.
            $("#closeBtn").click(function () {
                // This function runs when the "Close" button is clicked.
                // Clear the HTML content of the "result" element.
                $("#result").html('');

                // Hide the "Close" button and show the "Submit" button.
                $("#closeBtn").hide();
                $("#submitBtn").show();
            });
        });
    </script>
    <script>
        // add event listener for the clear button
        document.getElementById("clearBtn").addEventListener("click", function () {
            // clear the entered details
            // for example:
            document.getElementById("fname").value = "";
            document.getElementById("lname").value = "";

            // clear the placeholders too
            document.getElementById("fname").placeholder = "";
            document.getElementById("lname").placeholder = "";
        });
    </script>
    <script>
        $(document).ready(function () {
            // Add event listener to the "View All" button.
            $("#viewAllBtn").click(function () {
                // Make an HTTP POST request to "retrieve_all_history.php".
                $.post(
                    "retrieve_all_history.php",
                    function (data, status) {
                        // This function runs when the server response is received.
                        // Set the HTML content of the "result" element to the data returned by the server.
                        $("#result").html(data);
                        // Show the "Close" button and hide the "Submit" and "View All" buttons.
                        $("#closeBtn").show();
                        $("#submitBtn").hide();
                        $("#viewAllBtn").show();
                    }
                );
            });
        });
    </script>
    <!-- delete function of each row -->
    <script>
        function deleteRow(table, id) {
            if (confirm('Are you sure you want to delete this row?')) {
                // Send AJAX request to server with DELETE method
                var xhr = new XMLHttpRequest();
                xhr.open('DELETE', 'delete.php?id=' + id + '&table=' + table);
                xhr.onload = function () {
                    // Reload page after delete is complete
                    location.reload();
                };
                xhr.send();
            }
        }
    </script>

</body>

</html>