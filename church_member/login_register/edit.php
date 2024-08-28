<?php
session_start();

$msg = "";

include("connection.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">

    <title>Change Profile</title>
</head>

<body>
    <div class="nav">
        <div class="welcome">
            <p><a href="home.php">WELCOME TO CHURCH MEMBERSHIP INFORMATION SYSTEM</a></p>
        </div>

        <div class="right-links">
            <a href="#">Change Profile</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <?php
            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $churchname = $_POST['churchname'];
                $id = $_SESSION['id'];

                $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
                $result = mysqli_fetch_assoc($query);

                // Check if changes have been made
                if ($result['username'] == $username && $result['email'] == $email && $result['churchname'] == $churchname) {
                    echo "<script>alert('No changes have been made.'); window.location.href='home.php';</script>";

                } else {
                    $edit_query = mysqli_query($conn, "UPDATE users SET Username='$username', Email='$email', Churchname='$churchname' WHERE Id=$id") or die("error occurred");

                    if ($edit_query) {
                        echo "<script>alert('Profile updated successfully.'); window.location.href='home.php';</script>";
                    }
                }
            } else {
                $id = $_SESSION['id'];
                $query = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");

                while ($result = mysqli_fetch_assoc($query)) {
                    $res_Uname = $result['username'];
                    $res_Email = $result['email'];
                    $res_Churchname = $result['churchname'];
                }
                ?>
                <header>Change Profile</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>"
                            autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off"
                            required>
                    </div>


                    <div class="field input">
                        <label for="churchname">Churchname</label>
                        <input type="text" name="churchname" id="churchname" value="<?php echo $res_Churchname; ?>"
                            autocomplete="off" required>
                    </div>


                    <div class="field">

                        <input type="submit" class="btn" name="submit" value="Update" required>
                    </div>

                </form>
            </div>
        <?php } ?>
    </div>
</body>

</html>