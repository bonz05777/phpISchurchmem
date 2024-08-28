<?php
if(isset($_POST['submit'])){
    header("datashowmemberlist.php");
}
?>

<?php
include "connection.php";

if (isset($_GET['id'])){
    $id=$_GET['id'];
    $delete=mysqli_query($conn,"delete from churchmembership where id='$id'");
    if ($delete){
        header("location:datashowmemberlist.php");
        die();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Search Member</title>
        <link rel="stylesheet" type="text/css" href="stylesearch.css">

    </head>
<body>
    <center>
    <h1>SEARCH MEMBER</h1>

        <form action="" method="POST">

        <div class="options">
            <ul>
                <div>
                <input type="text" name="id" placeholder="Enter ID"/> <br/>
                </div>

                <div>
                   <input type="text" name="lname" placeholder="Enter Lastname"/> <br/>
                </div>
               
                <div>
                <input type="text" name="district" placeholder="Enter District"/> <br/>
                </div>

                <div>
                <input type="submit" name="search" class="buttons" value="SEARCH"/>
                </div>

                <div>
                <a href='datashowmemberlist.php?' class="button" >Back</a> 
                </div>
            </ul>
        </div>
        </form> 



        <?php
include "connection.php";

if(isset($_POST['search'])){
    $id = $_POST['id'];
    $lname = $_POST['lname'];
    $district = $_POST['district'];


    $query="SELECT * FROM churchmembership WHERE  lname='$lname' || id='$id' || district='$district'";
   
    $result = $conn->query($query);

    $search_results = [];

    if($result-> num_rows > 0){

        while ($row = $result ->fetch_assoc()){
            $search_results[]  =$row;

        }
    } else{

        echo'<script type="text/javascript">alert("No Results Found!")</script>';
       
    }
 } 
 ?>




<?php if (!empty($search_results)) { ?>

<div class="container">
  <table border="1" cellpadding="0">
          <tr>
          <th>ID</th>
          <th>Lastname</th>
          <th>Firstname</th>
          <th>Middlename</th>
          <th>Date Baptized</th>
          <th>Officiating Minister</th>
          <th>Received By</th>
          <th>Received Date</th>
          <th>Received Church</th>
          <th>District Name</th>
          <th>Operations</th>
          </tr>

      <tbody>



      <?php 
              
              foreach ($search_results as $member) { ?>
                  <tr>
                      <td><?php echo $member['id']; ?></td>
                      <td><?php echo $member['lname']; ?></td>
                      <td><?php echo $member['fname']; ?></td>
                      <td><?php echo $member['mname']; ?></td>
                      <td><?php echo $member['baptizeddate']; ?></td>
                      <td><?php echo $member['minister']; ?></td>
                      <td><?php echo $member['receivedby']; ?></td>
                      <td><?php echo $member['receiveddate']; ?></td>
                      <td><?php echo $member['receivedchurch']; ?></td>
                      <td><?php echo $member['district']; ?></td>
                     
                      <td>
                                        <a href='addmember.php?id=".$result['id']."' class='opt'>Edit</a> 
                                        <a href='?id=".$result['id']."' class='opt1'>Delete</a>                                                    
                                    </td>
                                        ";
                                  
                            ?>
                     

                  </tr>
              <?php } ?>
          </tbody> 
          
          













      </table>  
  <?php } ?>
                
</div> 




               
            
        </table> 
               
            
               
</div>              

</body>
</html>
