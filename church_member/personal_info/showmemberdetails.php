<?php
// Include the connection.php file
include "connection.php";

// Check if the id parameter is set in the URL and the user has confirmed the delete operation
if (isset($_GET['id']) && isset($_GET['confirm'])) {
    // Get the value of the id parameter
    $id = $_GET['id'];

    // Delete the record from the memberpersonaldetails table where id matches
    $delete_church = mysqli_query($conn, "DELETE FROM memberpersonaldetails WHERE id = '$id'");

    // Redirect to this page to prevent resubmission of the delete operation
    header("Location: showmemberdetails.php");
}

$query = "SELECT * FROM memberpersonaldetails";

// Handle sorting
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) ? $_GET['order'] : 'asc';
if (isset($_GET['sort']) && $sort == $_GET['sort']) {
    // if the same header is clicked, toggle the sorting order
    $order = $order == 'desc' ? 'desc' : 'asc';
} else {
    // if a different header is clicked, default to ascending order
    $order = 'asc';
    $sort = $_GET['sort'] ?? 'id';
}
$query .= " ORDER BY $sort $order";

// Check if the search form is submitted
if (isset($_GET['search'])) {
    // Get the value of the search query
    $id = $_GET['searchID'];
    if (empty($id) || $_GET['search'] == 2) {
        $resultQuery = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $results = mysqli_fetch_all($resultQuery, MYSQLI_ASSOC);
    } else {
        // Search for records matching the query
        $results = searchByID($id);
    }
} else {
    // Select all records
    $resultQuery = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $results = mysqli_fetch_all($resultQuery, MYSQLI_ASSOC);
}

// Display results or no results found message
if (!empty($results)) {
    // Display table with results
} else {
    echo '<div style="display: flex; justify-content: center; align-items: center; background-color: #f1f1f1; padding: 20px;"><span style="color: red;">No results found.</span></div>';
}

function searchByID($id)
{
    global $conn;
    $query = "SELECT * FROM memberpersonaldetails WHERE ID = '$id'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        return array(); // return empty array if no matches found
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>MEMBERS PERSONAL INFO</title>

    <!-- Link to styledatashow.css for styling -->
    <link rel="stylesheet" type="text/css" href="/church_member/login_register/styledataviewmember.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>

<body>

    <div style="position: relative;">
        <img src="/church_member/images/SDALogo.png" alt="SDA Logo"
            style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; height: 10vh; width: 6vw; margin-left: 5vw; margin-top:2.5vh;">
    </div>
    <div class="title">
        <h1>MEMBERS PERSONAL INFO</h1>
    </div>

    <div class="options">
        <ul>
            <div>
                <a href='/church_member/login_register/home.php?' class="lefthomebtn">HOME</a>
            </div>

            <div>
                <form action="" method="GET">
                    <input type="text" name="searchID" id="searchID" placeholder="Search ID">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>

            <div>
                <a href='addmemberdetails.php?'>Add Member Details</a>
            </div>

            <div>
                <a href='showmemberdetails.php?viewData=true'>View Data</a>
            </div>

            <div>
                <a href='/church_member/login_register/index.php?'>Logout</a>
            </div>
        </ul>
    </div>

    <div class="container">
        <?php if (empty($results)) { ?>
            <div style="display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f1f1f1;
            padding: 20px;">
                <span style="color: red;">No results found.</span>
            </div>
        <?php } else { ?>
            <table border="1" cellpadding="0">
                <tr>
                    <th>
                        <a
                            href="showmemberdetails.php?sort=id&order=<?php echo $sort == 'id' ? ($order == 'asc' ? 'desc' : 'asc') : 'asc'; ?>">ID</a>
                    </th>
                    <th>
                        <a
                            href="showmemberdetails.php?sort=civilstatus&order=<?php echo $sort == 'civilstatus' ? ($order == 'asc' ? 'desc' : 'asc') : 'asc'; ?>">Civil
                            Status</a>
                    </th>
                    <th>
                        <a
                            href="showmemberdetails.php?sort=addressID&order=<?php echo $sort == 'addressID' ? ($order == 'asc' ? 'desc' : 'asc') : 'asc'; ?>">Address
                            ID</a>
                    </th>
                    <th>
                        <a
                            href="showmemberdetails.php?sort=birthdate&order=<?php echo $sort == 'birthdate' ? ($order == 'asc' ? 'desc' : 'asc') : 'asc'; ?>">Birthplace</a>
                    </th>
                    <th>
                        <a
                            href="showmemberdetails.php?sort=birthplace&order=<?php echo $sort == 'birthplace' ? ($order == 'asc' ? 'desc' : 'asc') : 'asc'; ?>">Birthdate</a>
                    </th>
                    <th>
                        <a
                            href="showmemberdetails.php?sort=father&order=<?php echo $sort == 'father' ? ($order == 'asc' ? 'desc' : 'asc') : 'asc'; ?>">Father</a>
                    </th>
                    <th>
                        <a
                            href="showmemberdetails.php?sort=mother&order=<?php echo $sort == 'mother' ? ($order == 'asc' ? 'desc' : 'asc') : 'asc'; ?>">Mother</a>
                    </th>
                    <th>
                        <a
                            href="showmemberdetails.php?sort=educlevel&order=<?php echo $sort == 'educlevel' ? ($order == 'asc' ? 'desc' : 'asc') : 'asc'; ?>">Educlevel</a>
                    </th>
                    <th>
                        <a
                            href="showmemberdetails.php?sort=contactnumber&order=<?php echo $sort == 'contactnumber' ? ($order == 'asc' ? 'desc' : 'asc') : 'asc'; ?>">Contact
                            #</a>
                    </th>
                    <th>Operation</th>
                </tr>
                <?php foreach ($results as $result) { ?>
                    <tr>
                        <td class="member-id" data-id="<?= $result['id'] ?>">
                            <?= $result['id'] ?>
                        </td>
                        <td>
                            <?= $result['civilstatus'] ?>
                        </td>
                        <td>
                            <?= $result['addressID'] ?>
                        </td>
                        <td>
                            <?= $result['birthdate'] ?>
                        </td>
                        <td>
                            <?= $result['birthplace'] ?>
                        </td>
                        <td>
                            <?= $result['father'] ?>
                        </td>
                        <td>
                            <?= $result['mother'] ?>
                        </td>
                        <td>
                            <?= $result['educlevel'] ?>
                        </td>
                        <td>
                            <?= $result['contactnumber'] ?>
                        </td>
                        <td>

                            <a href="addmemberdetails.php?id=<?= $result['id'] ?>" class="opt">Edit</a>
                            <a href="?id=<?= $result['id'] ?>&confirm=true" class="opt1"
                                onclick="return confirm('Are you sure you want to delete this record? ID: <?= $result['id'] ?>')">Delete</a>

                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    </div>

    <div id="member-popup"></div>

    <script>
        $(document).ready(function () {
            $('.member-id').hover(function () {
                var id = $(this).data('id');
                $.ajax({
                    url: 'getMembername.php',
                    type: 'post',
                    data: { id: id },
                    dataType: 'json',
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    success: function (data) {
                        if (data.fname && data.lname) {
                            $(this).append('<div class="member-popup">' + data.fname + " " + data.lname + '</div>');
                        } else {
                            $(this).append('<div class="member-popup">Member not found</div>');
                        }
                    }.bind(this)
                });
            }, function () {
                $('.member-popup').remove();
            });
        });

        $(document).on('submit', 'form', function (e) {
            e.preventDefault(); // prevent form from submitting
            var searchID = $('#searchID').val();
            $.ajax({
                url: 'showmemberdetails.php',
                type: 'GET',
                data: { search: true, searchID: searchID },
                success: function (response) {
                    $('table').html($(response).find('table').html());
                }
            });
        });

        // Reset search input field after search form is submitted
        document.querySelector('#searchID').value = '';
    </script>

</body>

</html>

<style type="text/css">
    .popup {
        position: relative;
    }

    .popup .popup-content {
        display: none;
        position: absolute;
        z-index: 1;
        background-color: #f1f1f1;
        min-width: 100px;
        padding: 5px;
        border-radius: 5px;
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
        text-align: center;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        white-space: nowrap;
    }

    .popup:hover .popup-content {
        display: block;
    }

    .member-popup {
        position: absolute;
        background-color: #555;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        z-index: 9999;
    }

    .member-id:hover {
        cursor: pointer;
    }

    .options ul {

        margin-bottom: 20pt;
        margin-top: -20pt;
    }

    .title {

        margin-top: 1.1vh;
    }

    .title h1 {

        margin-top: 1.1vh;
    }

    .options .lefthomebtn {
        margin-left: -32.5vw;
    }

    .options div {
        display: inline-block;



    }

    .options a {
        text-decoration: none;
        color: #ffff;
        width: 250px;
        display: block;
        padding: 15px 5px;
        text-transform: uppercase;
        font-size: 15px;
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;

    }

    .options a:hover {
        background: rgb(237, 252, 102);
        color: rgb(2, 15, 89);
    }

    .options .lefthomebtn {
        text-decoration: none;
        color: #ffff;
        width: 250px;
        display: block;
        padding: 15px;
        text-transform: uppercase;
        font-size: 15px;
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
    }

    .options .lefthomebtn:hover {
        background: rgb(237, 252, 102);
        color: rgb(2, 15, 89);
    }

    .options ul {
        list-style: none;
        background: #020004;
        padding: 0;
        margin-bottom: 20pt;
        margin-top: -20pt;
        text-align: right;
    }
</style>