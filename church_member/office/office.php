<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>OFFICE INFO</title>
    <link rel="stylesheet" type="text/css" href="officeshow.css">
    <script type="text/javascript">
        function setDepartment() {
            var position = document.getElementById("position");
            var department = document.getElementById("deptname");
            var allowedDepts = [];

            switch (position.value) {
                case "Elder Social":
                case "Elder Communication":
                case "Elder Religious":
                case "Clerk":
                case "Treasurer":
                    allowedDepts = ["Church Board Department"];
                    break;
                case "Pastor":
                case "Deacon":
                case "Deaconess":
                case "Personal Ministries Director":
                case "Bible Study Coordinator":
                    allowedDepts = ["Ministry Department"];
                    break;
                case "Health Ministries Director":
                case "Health Educator":
                case "Health Counselor":
                case "Medical Missionary":
                    allowedDepts = ["Health Department"];
                    break;
                case "SS Chorister":
                case "SS Superintendent":
                case "SS Secretary":
                case "SS Assistant Secretary":
                    allowedDepts = ["Sabbath School Department"];
                    break;
                case "Stewardship Director":
                case "Bookkeeper":
                case "Financial Secretary":
                case "Auditor":
                    allowedDepts = ["Financial Department"];
                    break;
                case "Communication Director":
                case "Public Relations Coordinator":
                case "Media Specialist":
                case "Web Designer/Developer":
                case "Social Media Coordinator":
                    allowedDepts = ["Communication Department"];
                    break;
                case "Music Director":
                case "Pianist/Organist":
                case "Choir Director":
                case "Worship Coordinator":
                case "Audio-Visual Technician":
                case "Usher":
                    allowedDepts = ["Worship Department"];
                    break;
                case "Youth Ministries Director":
                case "Adventist Youth Society (AYS) Leader":
                case "Adventist Youth Society (AYS) Secretary":
                case "Adventist Youth Society (AYS) Treasurer":
                case "Adventist Youth Society (AYS) Chorister":
                case "Adventurer Club Director":
                case "Pathfinder Club Director":
                case "Youth Bible Study Leader":
                case "Campus Ministries Director":
                    allowedDepts = ["Youth Department"];
                    break;
                case "Children’s Ministries Director":
                case "Children’s Sabbath School Leader":
                case "Children’s Church Coordinator":
                case "Vacation Bible School Coordinator":
                    allowedDepts = ["Children’s Department"];
                    break;
                case "Women’s Ministries Director":
                case "Women’s Bible Study Leader":
                case "Women’s Small Group Leader":
                case "Women’s Retreat Coordinator":
                    allowedDepts = ["Women’s Department"];
                    break;
                case "Men’s Ministries Director":
                case "Men’s Bible Study Leader":
                case "Men’s Small Group Leader":
                case "Men’s Retreat Coordinator":
                    allowedDepts = ["Men’s Department"];
                    break;
            }

            for (var i = 0; i < department.options.length; i++) {
                if (allowedDepts.indexOf(department.options[i].value) >= 0) {
                    department.options[i].disabled = false;
                    if (department.options[i].value == allowedDepts[0]) {
                        department.selectedIndex = i;
                    }
                } else {
                    department.options[i].disabled = false;
                }
            }

        }

        document.getElementById("deptname").addEventListener("change", setDepartment);


    </script>
</head>

<body>

    <div style="position: relative;">
        <img src="/church_member/images/SDALogo.png" alt="SDA Logo"
            style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; height: 10vh; width: 6vw; margin-left: 5vw; margin-top:2.5vh;">
    </div>
    <div class="title">
        <h1>OFFICE INFO</h1>
    </div>

    <div class="options">
        <ul>
            <div>
                <a href='/church_member/login_register/home.php?' class="lefthomebtn">HOME</a>
            </div>

            <div>
                <button class="addnew" onclick="showOfficeAddForm()">Add New</button>
            </div>

            <div>
                <form action="" method="GET">
                    <input type="text" id="searchID" name="searchID" placeholder="Search ID">
                    <input type="text" id="searchName" name="searchName" placeholder="Search Department">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>

            <div>
                <a href='office.php?viewData=true'>View Data</a>
            </div>

            <div>
                <a href='/church_member/login_register/home.php'>Back</a>
            </div>
        </ul>
    </div>

    <div id="popup" class="popup"
        style="display:none;position:absolute;top:60%;left:12%;color:white;transform:translate(-50%,-50%);background-color:rgb(1, 25, 83);border-radius:10px;width: 240px;height: 290px;text-decoration: none;z-index:1;">
        <style>
            .selposition {
                width: 180px;
                margin-left: 2vw;
                padding: 12px 15px;
                outline: none;
                border: 1px;
                font-size: 12pt;
                border-radius: 5px;
                align-items: center;
                justify-content: center;
                margin-bottom: 4vh;

            }

            .seldepartment {
                width: 180px;
                margin-left: 2vw;
                padding: 12px 15px;
                outline: none;
                border: 1px;
                font-size: 12pt;
                border-radius: 5px;
                align-items: center;
                justify-content: center;
                margin-bottom: 2vh;
            }

            .options ul {
                list-style: none;
                background: #020004;
                padding: 0;
                margin-bottom: 20pt;
                margin-top: -20pt;
                text-align: right;
            }

            .title {
                width: 100vw;
                background-color: rgb(1, 25, 83);
                color: rgb(254, 245, 166);

                margin-top: 1.1vh;
            }

            .title h1 {
                font-family: 'Franklin Gothic Medium';
                font-size: 60px;
                letter-spacing: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
                margin-top: 1.1vh;
            }

            .options .lefthomebtn {
                margin-left: -23.5vw;
            }
        </style>

        <div class="contents">
            <form action="" method="POST">
                <label class="labelmin"> CHURCH OFFICES </label>

                <div>
                    <input type="hidden" id="officeID" name="officeID" class="data-insert" value="">
                    <br>
                </div>

                <div>
                    <select name="position" id="position" class="selposition" required onchange="setDepartment()">
                        <option value="">Select Position</option>
                        <optgroup label="Church Board Department">
                            <option value="Elder Social">Elder Social</option>
                            <option value="Elder Communication">Elder Communication</option>
                            <option value="Elder Religious">Elder Religious</option>
                            <option value="Clerk">Clerk</option>
                            <option value="Treasurer">Treasurer</option>
                        </optgroup>
                        <optgroup label="Ministry Department">
                            <option value="Pastor">Pastor</option>
                            <option value="Deacon">Deacon</option>
                            <option value="Deaconess">Deaconess</option>
                            <option value="Personal Ministries Director">Personal Ministries Director</option>
                            <option value="Bible Study Coordinator">Bible Study Coordinator</option>
                        </optgroup>
                        <optgroup label="Health Department">
                            <option value="Health Ministries Director">Health Ministries Director</option>
                            <option value="Health Educator">Health Educator</option>
                            <option value="Health Counselor">Health Counselor</option>
                            <option value="Medical Missionary">Medical Missionary</option>
                        </optgroup>
                        <optgroup label="Sabbath School Department">
                            <option value="SS Chorister">SS Chorister</option>
                            <option value="SS Superintendent">SS Superintendent</option>
                            <option value="SS Secretary">SS Secretary</option>
                            <option value="SS Assistant Secretary">SS Assistant Secretary</option>
                        </optgroup>
                        <optgroup label="Financial Department">
                            <option value="Stewardship Director">Stewardship Director</option>
                            <option value="Treasurer">Treasurer</option>
                            <option value="Bookkeeper">Bookkeeper</option>
                            <option value="Financial Secretary">Financial Secretary</option>
                            <option value="Auditor">Auditor</option>
                        </optgroup>
                        <optgroup label="Communication Department">
                            <option value="Communication Director">Communication Director</option>
                            <option value="Public Relations Coordinator">Public Relations Coordinator</option>
                            <option value="Media Specialist">Media Specialist</option>
                            <option value="Web Designer/Developer">Web Designer/Developer</option>
                            <option value="Social Media Coordinator">Social Media Coordinator</option>
                        </optgroup>
                        <optgroup label="Worship Department">
                            <option value="Music Director">Music Director</option>
                            <option value="Pianist/Organist">Pianist/Organist</option>
                            <option value="Choir Director">Choir Director</option>
                            <option value="Worship Coordinator">Worship Coordinator</option>
                            <option value="Audio-Visual Technician">Audio-Visual Technician</option>
                            <option value="Usher">Usher</option>
                        </optgroup>
                        <optgroup label="Youth Department">
                            <option value="Youth Ministries Director">Youth Ministries Director</option>
                            <option value="Adventist Youth Society (AYS) Leader">Adventist Youth Society (AYS) Leader
                            </option>
                            <option value="Adventist Youth Society (AYS) Secretary">Adventist Youth Society (AYS)
                                Secretary</option>
                            <option value="Adventist Youth Society (AYS) Treasurer">Adventist Youth Society (AYS)
                                Treasurer</option>
                            <option value="Adventist Youth Society (AYS) Chorister">Adventist Youth Society (AYS)
                                Chorister</option>
                            <option value="Adventurer Club Director">Adventurer Club Director</option>
                            <option value="Pathfinder Club Director">Pathfinder Club Director</option>
                            <option value="Youth Bible Study Leader">Youth Bible Study Leader</option>
                            <option value="Campus Ministries Director">Campus Ministries Director</option>
                        </optgroup>
                        <optgroup label="Children’s Department">
                            <option value="Children’s Ministries Director">Children’s Ministries Director</option>
                            <option value="Children’s Sabbath School Leader">Children’s Sabbath School Leader</option>
                            <option value="Children’s Church Coordinator">Children’s Church Coordinator</option>
                            <option value="Vacation Bible School Coordinator">Vacation Bible School Coordinator</option>
                        </optgroup>
                        <optgroup label="Women’s Department">
                            <option value="Women’s Ministries Director">Women’s Ministries Director</option>
                            <option value="Women’s Bible Study Leader">Women’s Bible Study Leader</option>
                            <option value="Women’s Small Group Leader">Women’s Small Group Leader</option>
                            <option value="Women’s Retreat Coordinator">Women’s Retreat Coordinator</option>
                        </optgroup>
                        <optgroup label="Men’s Department">
                            <option value="Men’s Ministries Director">Men’s Ministries Director</option>
                            <option value="Men’s Bible Study Leader">Men’s Bible Study Leader</option>
                            <option value="Men’s Small Group Leader">Men’s Small Group Leader</option>
                            <option value="Men’s Retreat Coordinator">Men’s Retreat Coordinator</option>
                        </optgroup>
                    </select>
                </div>

                <div>
                    <select name="deptname" id="deptname" class="seldepartment" required>
                        <option value="">Select Department</option>
                        <option value="Church Board Department">Church Board Department</option>
                        <option value="Ministry Department">Ministry Department</option>
                        <option value="Health Department">Health Department</option>
                        <option value="Sabbath School Department">Sabbath School Department</option>
                        <option value="Financial Department">Financial Department</option>
                        <option value="Communication Department">Communication Department</option>
                        <option value="Worship Department">Worship Department</option>
                        <option value="Youth Department">Youth Department</option>
                        <option value="Children’s Department">Children’s Department</option>
                        <option value="Women’s Department">Women’s Department</option>
                        <option value="Men’s Department">Men’s Department</option>
                    </select>
                </div>

                <button type="submit" name="save" class="sub_btn">Save</button>
                <button type="button" onclick="hideOfficeAddForm()" class="sub_btns">Cancel</button>
            </form>
        </div>
    </div>


    <?php
    // Include the database connection file
    include "connection.php";

    // Insert or update office record
    if (isset($_POST['save'])) {
        $officeID = $_POST['officeID'];
        $position = $_POST['position'];
        $deptname = $_POST['deptname'];

        if (!empty($officeID)) {
            // Office ID is provided, update the record
            $result = mysqli_query($conn, "SELECT * FROM office WHERE officeID='$officeID'");
            if (mysqli_num_rows($result) > 0) {
                $oldValues = mysqli_fetch_assoc($result);
                if ($oldValues['position'] == $position && $oldValues['deptname'] == $deptname) {
                    // No fields have been changed
                    echo "<script>alert('No changes have been made.');window.location.href ='office.php';</script>";
                    exit;
                }
                // Check if the updated record already exists
                $result = mysqli_query($conn, "SELECT * FROM office WHERE position='$position' AND deptname='$deptname' AND officeID != '$officeID'");
                if (mysqli_num_rows($result) > 0) {
                    // Record already exists, show alert message and abort
                    echo "<script>alert('The Position and Department already exists in the table.');
                        window.location.href='office.php';</script>";
                }
            } else {
                // Invalid office ID, abort
                echo "<script>alert('Invalid office ID.');</script>";
                exit();
            }
            $query = "UPDATE office SET position='$position', deptname='$deptname' WHERE officeID='$officeID'";

        } else {
            // Office ID is not provided, create a new record
            $result = mysqli_query($conn, "SELECT * FROM office WHERE position='$position' AND deptname='$deptname'");
            if (mysqli_num_rows($result) > 0) {
                // Record already exists, show alert message and abort
                echo "<script>alert('The Position and Department already exists in the table.');
                    window.location.href='office.php';</script>";
            }
            $query = "INSERT INTO office (position, deptname) VALUES ('$position', '$deptname')";
        }

        // Check if the record already exists
        $result = mysqli_query($conn, "SELECT * FROM office WHERE position='$position' AND deptname='$deptname'");
        if (mysqli_num_rows($result) > 0) {
            // Record already exists, show alert message and abort
            echo "<script>alert('The Position and Department already exists in the table.');
                window.location.href='office.php;</script>";
            exit();
        }

        mysqli_query($conn, $query);

    }


    if (isset($_GET['delete']) && $_GET['delete'] == 'true' && isset($_GET['officeID'])) {
        $officeID = $_GET['officeID'];

        // Delete record from office table
        $query = "DELETE FROM office WHERE officeID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $officeID);
        $stmt->execute();

        // Check if the delete was successful
        if ($stmt->affected_rows > 0) {
            /* ?>
             <script>
                 alert("Record deleted successfully");
             </script>
             <?php
            */

        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }


    // If search button has been clicked
    if (isset($_GET['search'])) {
        $searchID = $_GET['searchID'];
        $searchName = $_GET['searchName'];

        // Construct the search query with ID and/or name filters
        $query = "SELECT * FROM office WHERE 1 = 1 ";
        if (!empty($searchID)) {
            $query .= "AND officeID = '$searchID' ";
        }
        if (!empty($searchName)) {
            $query .= "AND deptname = '$searchName' ";
        }
        // Handle sorting
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'officeID';
        $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
        if (isset($_GET['sort']) && $sort == $_GET['sort'] && $order == 'asc') {
            $order = 'desc';
        } else {
            $order = 'asc';
        }
        $query .= " ORDER BY $sort $order";
        // Execute the search query
        $result = mysqli_query($conn, $query);

        // Display search results in a table
        if (mysqli_num_rows($result) > 0) {
            echo "<div class='container'>";
            echo "<table border='1' cellpadding='0'>";
            echo "<tr>";
            echo "<th><a href=\"office.php?sort=officeID&order=$order\">Office ID</a></th>";
            echo "<th><a href=\"office.php?sort=position&order=$order\">Position</a></th>";
            echo "<th><a href=\"office.php?sort=deptname&order=$order\">Department</a></th>";

            echo "<th>Operation</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['officeID'] . "</td>";
                echo "<td>" . $row['position'] . "</td>";
                echo "<td>" . $row['deptname'] . "</td>";

                echo "<td>
                    <a href='#' onclick=\"showOfficeEditForm('" . $row['officeID'] . "','" . $row['position'] . "','" . $row['deptname'] . "')\" class='opt'>Edit</a>


                    <a href='office.php?delete=true&officeID=" . $row['officeID'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record?" . $row['officeID'] . " \")'>Delete</a>



                    
                    </td>";
                echo "</tr>";
            }
            echo "</table></div>";
        } else {
            echo '<div
                style=" display: flex;
                        justify-content: center;
                        align-items: center;
                        background-color: #f1f1f1;
                        padding: 20px;">';
            echo '<span
                style="color: red;">
                No results found.
                </span>';
            echo '</div>';
        }
    } else {
        // Retrieve office records from the database
        $query = "SELECT * FROM office";
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'officeID';
        $order = isset($_GET['order']) ? $_GET['order'] : 'asc';
        $query .= " ORDER BY $sort $order";
        $result = mysqli_query($conn, $query);

        // Display all stored data automatically
        if (isset($_GET['viewData']) || !isset($_GET['search'])) {
            ?>
            <div class="container">
                <table border="1" cellpadding="0">
                    <tr>
                        <th><a
                                href="office.php?sort=officeID&order=<?php echo $sort == 'officeID' && $order == 'asc' ? 'desc' : 'asc'; ?>">Office
                                ID</a>
                        </th>
                        <th><a
                                href="office.php?sort=position&order=<?php echo $sort == 'position' && $order == 'asc' ? 'desc' : 'asc'; ?>">Position</a>
                        </th>
                        <th><a
                                href="office.php?sort=deptname&order=<?php echo $sort == 'deptname' && $order == 'asc' ? 'desc' : 'asc'; ?>">Department</a>
                        </th>

                        <th>Operation</th>
                    </tr>

                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['officeID'] . "</td>";
                        echo "<td>" . $row['position'] . "</td>";
                        echo "<td>" . $row['deptname'] . "</td>";

                        echo "<td>
                            <a href='#' onclick=\"showOfficeEditForm('" . $row['officeID'] . "','" . $row['position'] . "','" . $row['deptname'] . "')\" class='opt'>Edit</a>
                           
                            <a href='office.php?delete=true&officeID=" . $row['officeID'] . "' class='opt1' onclick='return confirm(\"Are you sure you want to delete this record?" . $row['officeID'] . " \")'>Delete</a>


                            </td>";
                        echo "</tr>";
                    }
                    ?>

                </table>
            </div>

            <?php
        }
    }
    ?>

    <script>
        function showOfficeAddForm() {
            // Clear the form and display the pop-up
            document.getElementById("officeID").value = "";
            document.getElementById("position").value = "";
            document.getElementById("deptname").value = "";
            document.getElementById("popup").style.display = "block";
        }

        function showOfficeEditForm(officeID, position, deptname) {
            // Populate the form with the stored data and display the pop-up
            document.getElementById("officeID").value = officeID;
            document.getElementById("position").value = position;
            document.getElementById("deptname").value = deptname;
            document.getElementById("popup").style.display = "block";
        }

        function hideOfficeAddForm() {
            // Hide the pop-up
            document.getElementById("popup").style.display = "none";
        }
    </script>

</body>

</html>