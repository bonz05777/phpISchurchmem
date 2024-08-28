<?php
session_start();
include("connection.php");

// Check if the user is already logged in
if (isset($_SESSION['id'])) {
    header("Location: home.php");
    exit();
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Register</title>
</head>

<body>

    <style>
        .title {
            width: 100vw;
            background-color: rgb(1, 25, 83);
            color: rgb(254, 245, 166);
        }

        .title h1 {
            font-size: 40px;
            display: flex;
            word-spacing: 10px;
            letter-spacing: 3px;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .btns {
            color: #000000;
            background-color: #ccc;
            height: 30pt;
            border-radius: 5px;
            border: 5pt;
            font-size: 17px;
            font-weight: 500;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            padding: .5rem 1rem;
            width: 100%;
        }

        .btns:hover {
            background: rgb(2, 15, 89);
            color: rgb(244, 238, 135);
        }

        .form-box form .fieldinput {
            text-decoration: none;
            height: 40px;
            width: 100%;
            font-size: 16px;
            padding: 0 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
        }
    </style>

    <div class="title">
        <h1>Church Membership Information System</h1>
    </div>

    <div class="container">
        <div class="box form-box">
            <header>Sign Up</header>
            <?php
            if (isset($_POST['submit'])) {
                // Sanitize user input
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $confirmpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);

                $churchname = mysqli_real_escape_string($conn, $_POST['churchname']);

                // Check if passwords match
                if ($password !== $confirmpassword) {
                    echo "<div class='message'>
                        <p>Passwords do not match</p>
                     </div> <br>";
                } else {
                    // Check if email is unique
                    $verify_query = mysqli_query($conn, "SELECT Email FROM users WHERE Email='$email'");
                    if (mysqli_num_rows($verify_query) != 0) {
                        echo "<div class='message'>
                              <p>This email is used, Try another one please!</p>
                           </div> <br>";
                    } else {
                        // Insert user into the database
                        mysqli_query($conn, "INSERT INTO users(Username, Email, Password, Churchname) VALUES('$username','$email','$password', '$churchname')") or die("Error Occured");

                        echo "<div class='message'>
                              <p>Registered Successfully!</p>
                           </div> <br>";
                        echo "<a href='index.php'><button class='btns'>Login Now</button>";
                    }
                }
            }
            ?>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="confirmpassword">Confirm Password</label>
                    <input type="password" name="confirmpassword" id="confirmpassword" autocomplete="off" required>
                </div>


                <div class="field input">
                    <label for="churchname">Church Name</label>
                    <input type="text" name="churchname" id="churchname" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register">
                </div>

                <div class="links">
                    Already a member? <a href="index.php">Sign In</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>