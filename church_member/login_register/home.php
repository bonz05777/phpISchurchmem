<?php
session_start();

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
    <link rel="stylesheet" href="homeadmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Home</title>
</head>

<body>
    <div class="fixedcontainer">

        <div style="position: relative;">
            <img src="/church_member/images/SDALogo.png" alt="SDA Logo"
                style="position: absolute; top: 0; left: 0; bottom: 0; right: 0; margin: auto; height: 10vh; width: 6vw; margin-left: 2vw; margin-top:1.5vh;">
        </div>

        <div class="nav">
            <div class="welcome">
                <p><a href="home.php">WELCOME TO CHURCH MEMBERSHIP INFORMATION SYSTEM</a> </p>
            </div>



            <div class="right-links">

                <?php

                $id = $_SESSION['id'];
                $query = mysqli_query($conn, "SELECT*FROM users WHERE id=$id");

                while ($result = mysqli_fetch_assoc($query)) {
                    $res_id = $result['id'];
                    $res_Uname = $result['username'];
                    $res_Email = $result['email'];

                }

                echo "<a href='edit.php?Id=$res_id' >Change Profile </a> ";
                ?>
                <a href="logout.php">Logout</a>


            </div>
        </div>


        <main>


            <div class="dropdown-container">
                <button class="dropdown-btn">View Members</button>
                <div class="dropdown-menu">
                    <a href="datashowmemberlist.php">Membership List</a>
                    <a href="addmember.php">Add Member</a>
                    <a href="datashowmemberlist.php">Search Member</a>
                </div>
            </div>

            <div class="dropdown-container">
                <button class="dropdown-btn">Member's Status</button>
                <div class="dropdown-menu">
                    <a href="aboutstatus1.php">Status List</a>
                    <a href="aboutstatus1.php">Add Status</a>
                    <a href="attendance.php">Attendance</a>
                </div>
            </div>

            <div class="dropdown-container">
                <button class="dropdown-btn">Member's Personal Info</button>
                <div class="dropdown-menu">
                    <a href="/church_member/personal_info/showmemberdetails.php">View List</a>
                    <a href="/church_member/personal_info/addmemberdetails.php">Add Details</a>
                    <a href="addressdetails.php">Residency Address</a>
                </div>
            </div>

            <div class="dropdown-container">
                <button class="dropdown-btn">Ministerial Info</button>
                <div class="dropdown-menu">
                    <a href="/church_member/minister_info/ministeradd.php">View List</a>
                    <a href="/church_member/minister_info/ministeradd.php">Add Details</a>
                    <a href="/church_member/minister_assigned/ministerassigned.php">Minister Assignment</a>
                </div>
            </div>

            <div class="dropdown-container">
                <button class="dropdown-btn">Church Info</button>
                <div class="dropdown-menu">
                    <a href="/church_member/churches/churchesaddshow.php">View Churches</a>
                    <a href="/church_member/office/office.php">Church Offices</a>
                    <a href="/church_member/officer/officer.php">Church Officers</a>
                </div>
            </div>

            <div class="dropdown-container">
                <button class="dropdown-btn">Transaction Info</button>
                <div class="dropdown-menu">
                    <a href="/church_member/login_register/viewAllTransactions.php">View
                        Transactions</a>
                    <a href="/church_member/login_register/viewAllTransactions.php">Search
                        Transactions</a>
                </div>
            </div>


        </main>
    </div>

    <div class="missionvision-container">

        <div class="image-container">
            <div class="acms">
                <h1> ACMS </h1>
            </div>

            <img src="/church_member/images/sda.jpg" alt="Adventist Church Image">
            <div class="overlay"> <svg viewBox="0 0 500 200">
                    <path d="M 0 50 C 150 150 300 0 500 80 L 500 0 L 0 0" fill="rgb(1, 25, 83)"></path>
                    <path d=" M 0 50 C 150 150 330 -30 500 50 L 500 0 L 0 0" fill="white"> </path>
                </svg>
            </div>
            <div class="overlaybottom"> <svg viewBox="0 0 500 200">

                    <path d="M 0 50 C 150 150 330 -30 500 50 L 500 0 L 0 0" fill="white" opacity="0.5"></path>
                </svg>
            </div>
        </div>

        <div class="mission-statement">
            <h1>
                Mission
            </h1>
            <p>The mission of the Adventist Membership Systems department is to develop, implement, and support
                an
                effective Adventist church management software system that empowers local churches and enhances
                membership ministries.</p>
            <h1>
                Vision
            </h1>
            <p>Our vision is to enable local churches to serve members more efficiently
                and help
                leaders plan more strategically.</p>
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