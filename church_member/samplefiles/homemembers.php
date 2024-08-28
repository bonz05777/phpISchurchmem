<?php 
   session_start();

   include("connection.php");
   if(!isset($_SESSION['valid'])){
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
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="welcome">
            <p><a href="home.php">WELCOME TO CHURCH MEMBERSHIP INFORMATION SYSTEM</a> </p>
        </div>

        <div class="right-links">

            <?php 
            
            $id = $_SESSION['id'];
            $query = mysqli_query($conn,"SELECT*FROM users WHERE id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_id = $result['id'];
                $res_Uname = $result['username'];
                $res_Email = $result['email'];
               
            }
            
            echo "<a href='edit.php?Id=$res_id' >Change Profile </a> ";
            ?>
            <a href="logout.php">Log Out</a>
         

        </div>
    </div>
    <main>

     
          <div class="top">
            
            <div class="tops">
            <a href='addmember.php?' >Add New Member</a> 
            </div>
            <div class="tops">
            <a href='/church_member/personal_info/memberdetails.php?' >Members Personal Info</a> 
            </div>
            <div class="tops">
            <a href='searchoptioneditdelete.php?'>Search Member</a> 
            </div>
            <div class="tops">
            <a href='aboutstatus.php?' >Member's Status</a> 
            </div>
           
          </div>
          
       

    </main>
</body>
</html>


               
            