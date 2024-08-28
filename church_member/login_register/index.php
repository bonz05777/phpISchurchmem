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
    <link rel="stylesheet" href="homeadmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
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

    <div style="position: relative;">
        <img src="/church_member/images/SDALogo.png" alt="SDA Logo"
            style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; height: 10vh; width: 6vw; margin-left: 2vw; margin-top:1.5vh;">
    </div>

    <div class="title">
        <h1>CHURCH MEMBERSHIP INFORMATION SYSTEM</h1>
    </div>
    <div class="container">
        <div class="box form-box">
            <header>Login</header>
            <?php
            if (isset($_POST['submit'])) {
                // Sanitize user input
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);

                checkUserType($conn, $email, $password);
            }
            function checkUserType($conn, $email, $password)
            {
                // Check if email exists in the 'users' table
                $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

                if (mysqli_num_rows($checkEmail) == 0) {
                    // Email not registered in database
                    echo "<div class='message'>
                            <p>Email is not registered. Please check your input.</p>
                        </div> <br>";
                } else {
                    // Verify user credentials
                    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
                    $row = mysqli_fetch_assoc($result);

                    if (!$row) {
                        // Invalid email or password
                        echo "<div class='message'>
                                <p>Invalid login credentials. Please try again.</p>
                            </div> <br>";
                    } else {
                        // Log in
                        $redirect = ($row['usertype'] == 'admin') ? 'home.php' : 'userinterface.php';
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['valid'] = $row['email'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['usertype'] = $row['usertype'];
                        header("Location: $redirect");
                        exit();
                    }
                }
            }

            ?>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>



                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login">
                </div>

                <div class="links">
                    Don't have an account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
    </div>
</body>



<!--footer-->

<footer class="footer-distributed">
    <div class="footer-left">
        <h3 style="font-size: 30pt;">ACMS<span><img src="/church_member/images/SDALogo.png" alt="ACMS Logo"
                    style="height: 5vh;"></span> </h3>
        <p class="footer-links">
            <a href="#" class="link-1">Home</a>
            <a href="#">Blog</a>
            <a href="#">About</a>
            <a href="#">Faq</a>
            <a href="#">Contact</a>
        </p>

        <p class="footer-company-name">Copyright 2023, General Conference of Seventh-day Adventists</p>
    </div>
    <div class="footer-center">
        <div>
            <i class="fa fa-map-marker"></i>
            <p><span>45H6+793,</span> Salvani St, General Santos City, South Cotabato</p>

        </div>
        <div>
            <i class="fa fa-phone"></i>
            <p>63 (83) 553-4662, 887-3110</p>
        </div>
        <div>
            <i class="fa fa-envelope"></i>
            <p><a href="mailto:smmsda65@yahoo.com.">smmsda65@yahoo.com.</a></p>
        </div>
    </div>
    <div class="footer-right">

        <p class="footer-company-about">
            <span>About us</span>
            ADVENTIST® and SEVENTH-DAY ADVENTIST® are the registered trademarks of the General Conference of Seventh-day
            Adventists®.
        </p>
        <div class="footer-icons">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-github"></i></a>

        </div>

    </div>

</footer>

<!-- Credit to https://codepen.io/slstudios/pen/XbzQVK -->


</html>