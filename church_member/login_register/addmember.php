<?php
include "connection.php";
$msg = "";
$lname = "";
$fname = "";
$mname = "";
$baptizeddate = "";
$placebaptized = "";
$ministername = "";
$receivedby = "";
$receiveddate = "";
$churchname = "";
$id = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $select = mysqli_query($conn, "select * from churchmembership where id='$id'");
    $data = mysqli_fetch_assoc($select);
    $lname = $data['lname'];
    $fname = $data['fname'];
    $mname = $data['mname'];
    $baptizeddate = $data['baptizeddate'];
    $placebaptized = $data['placebaptized'];
    $ministername = $data['ministername'];
    $receivedby = $data['receivedby'];
    $receiveddate = $data['receiveddate'];
    $churchname = $data['churchname'];
}
if (isset($_POST['submit'])) {
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $baptizeddate = $_POST['baptizeddate'];
    $placebaptized = $_POST['placebaptized'];
    $ministername = $_POST['ministername'];
    $receivedby = $_POST['receivedby'];
    $receiveddate = $_POST['receiveddate'];
    $churchname = $_POST['churchname'];

    // check for existing records on insert and update
    $query = "SELECT * FROM churchmembership WHERE lname='$lname' AND fname='$fname' AND mname='$mname'";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query .= " AND id!='$id'";
    }
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $urlParams = "lname=".urlencode($lname)."&fname=".urlencode($fname)."&mname=".urlencode($mname)."&baptizeddate=".urlencode($baptizeddate)."&placebaptized=".urlencode($placebaptized)."&ministername=".urlencode($ministername)."&receivedby=".urlencode($receivedby)."&receiveddate=".urlencode($receiveddate)."&churchname=".urlencode($churchname);
        echo "<script>alert('Name already exists. Please modify the existing record.');window.location.href ='addmember.php?".$urlParams."';</script>";
        exit;
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Check if any fields were actually changed
        $result = mysqli_query($conn, "SELECT * FROM churchmembership WHERE id='$id'");
        $oldValues = mysqli_fetch_assoc($result);
        if (
            $oldValues['lname'] == $lname && $oldValues['fname'] == $fname && $oldValues['mname'] == $mname
            && $oldValues['baptizeddate'] == $baptizeddate && $oldValues['placebaptized'] == $placebaptized
            && $oldValues['ministername'] == $ministername
            && $oldValues['receivedby'] == $receivedby && $oldValues['receiveddate'] == $receiveddate
            && $oldValues['churchname'] == $churchname
        ) {
            // No fields have been changed
            echo "<script>alert('Data with ID: ".$id." No changes have been made.');window.location.href ='datashowmemberlist.php';</script>";
            exit;
        }

        $update = mysqli_query($conn, "UPDATE `churchmembership`
        SET `lname`='$lname',`fname`='$fname',
        `mname`='$mname',`baptizeddate`='$baptizeddate',
        `placebaptized`='$placebaptized',`ministername`='$ministername',
        `receivedby`='$receivedby',`receiveddate`='$receiveddate',`churchname`='$churchname' WHERE id='$id'");

        if ($update) {
            // Retrieve updated data from database
            $select = mysqli_query($conn, "CALL selectChurchMembershipById('$id')");
            $updatedData = mysqli_fetch_assoc($select);

            // Update form data values
            $lname = $updatedData['lname'];
            $fname = $updatedData['fname'];
            $mname = $updatedData['mname'];
            $baptizeddate = $updatedData['baptizeddate'];
            $placebaptized = $updatedData['placebaptized'];
            $ministername = $updatedData['ministername'];
            $receivedby = $updatedData['receivedby'];
            $receiveddate = $updatedData['receiveddate'];
            $churchname = $updatedData['churchname'];
            echo "<script>alert('Data with ID: ".$id." Updated Successfully.');";
            echo "window.location.href = 'datashowmemberlist.php';</script>";
            exit;
        } else {
            die(mysqli_error($conn));
        }
    }



    $insert = mysqli_query($conn, "INSERT INTO `churchmembership`(`lname`, `fname`, `mname`, `baptizeddate`,`placebaptized`, `ministername`, `receivedby`, `receiveddate`, `churchname`) VALUES ('$lname','$fname','$mname','$baptizeddate','$placebaptized','$ministername','$receivedby','$receiveddate','$churchname')");

   
    if ($insert) {
        $id = mysqli_insert_id($conn); // retrieve the newly inserted id
        $message = "Data with ID: " . $id . " Added Successfully.";
        echo "<script>alert('" . $message . "');";
        echo "window.location.href = 'addmember.php';</script>";
        exit;
    } else {
        die(mysqli_error($conn));
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>CHURCH MEMBERSHIP</title>
    <link rel="stylesheet" type="text/css" href="addmember.css">
    <!----Link for style.css|for styling form---->

</head>

<body>

    <div class="container">
        <div class="inner">
            <div class="title">
                <h1>CHURCH MEMBERSHIP</h1>
            </div>

            <form method="post" action="">

                <div class="contents">
                    <div>
                        <label for="lname" class="datalabel">Last Name: </label>
                        <input type="text" name="lname" class="data-insert" value="<?php echo $lname; ?>" oninput="checkAlphabetic(this); this.value = toUpperCaseFirst(this.value);" required>
                    </div>
                    <div>
                        <label for="fname" class="datalabel">First Name: </label>
                        <input type="text" name="fname" class="data-insert" value="<?php echo $fname; ?>" oninput="checkAlphabetic(this); this.value = toUpperCaseFirst(this.value);" required>
                    </div>
                    <div>
                        <label for="mname" class="datalabel">Middle Name: </label>
                        <input type="text" name="mname" class="data-insert" value="<?php echo $mname; ?>" oninput="checkAlphabetic(this); this.value = toUpperCaseFirst(this.value);">
                    </div>
                    <div>
                        <label for="baptizeddate" class="datalabel">Date Baptized: </label>
                        <input type="date" name="baptizeddate" class="data-insert" value="<?php echo $baptizeddate; ?>"
                            required>
                    </div>
                    <div>
                        <label for="placebaptized" class="datalabel">Place Baptized: </label>
                        <input type="text" name="placebaptized" class="data-insert" value="<?php echo $placebaptized; ?>" oninput="checkAlphabeticAll(this); this.value = toUpperCaseFirst(this.value);" required>
                    </div>
                    <div>
                        <label for="ministername" class="datalabel">Officiating Minister: </label>
                        <input type="text" name="ministername" class="data-insert" value="<?php echo $ministername; ?>" oninput="checkAlphabetic(this); this.value = toUpperCaseFirst(this.value);">

                    </div>

                    </style>
                    <div>
                        <label for="receivedby" class="datalabel">Received By:</label>
                        <select name="receivedby" class="data-insert" required>
                            <option value="" disabled selected>Select</option>
                            <option <?php if ($receivedby == "Baptism")
                                echo "selected"; ?>>Baptism</option>
                            <option <?php if ($receivedby == "Transfer")
                                echo "selected"; ?>>Transfer</option>
                            <option <?php if ($receivedby == "Profession by Faith")
                                echo "selected"; ?>>Profession by Faith</option>
                        </select>
                    </div>
                    <div>
                        <label for="receiveddate" class="datalabel">Date Received:</label>
                        <input type="date" name="receiveddate" class="data-insert" value="<?php echo $receiveddate; ?>"
                            required>
                    </div>

                <div>
                    
                <label for="churchname">Church Name: </label>
               
                <select id="churchname" name="churchname" class="data-insert" value="<?php echo $churchname; ?>"  required>
              
<option value="" <?php if($churchname == "") echo "selected"; ?> disabled>Choose Churchname</option>
<optgroup label="Davao del Norte District">
    <option value="Asuncion District" <?php if($churchname == "Asuncion District") echo "selected"; ?>>Asuncion</option>
    <option value="Carmen District" <?php if($churchname == "Carmen District") echo "selected"; ?>>Carmen</option>
    <option value="Kapalong District" <?php if($churchname == "Kapalong District") echo "selected"; ?>>Kapalong</option>
    <option value="New Corella District" <?php if($churchname == "New Corella District") echo "selected"; ?>>New Corella</option>
    <option value="Panabo District" <?php if($churchname == "Panabo District") echo "selected"; ?>>Panabo</option>
</optgroup>

<optgroup label="Davao del Sur District">
    <option value="Bansalan District" <?php if($churchname == "Bansalan District") echo "selected"; ?>>Bansalan</option>
    <option value="Digos District" <?php if($churchname == "Digos District") echo "selected"; ?>>Digos</option>
    <option value="Hagonoy District" <?php if($churchname == "Hagonoy District") echo "selected"; ?>>Hagonoy</option>
    <option value="Magsaysay District" <?php if($churchname == "Magsaysay District") echo "selected"; ?>>Magsaysay</option>
    <option value="Matanao District" <?php if($churchname == "Matanao District") echo "selected"; ?>>Matanao</option>
    <option value="Padada District" <?php if($churchname == "Padada District") echo "selected"; ?>>Padada</option>
    <option value="Sta. Cruz District" <?php if($churchname == "Sta. Cruz District") echo "selected"; ?>>Sta. Cruz</option>

<optgroup label="Davao Occidental District">
    <option value="Don Marcelino District" <?php if($churchname == "Don Marcelino District") echo "selected"; ?>>Don Marcelino</option>
    <option value="Jose Abad Santos District" <?php if($churchname == "Jose Abad Santos District") echo "selected"; ?>>Jose Abad Santos</option>
    <option value="Malita District" <?php if($churchname == "Malita District") echo "selected"; ?>>Malita</option>
    <option value="Santa Maria District" <?php if($churchname == "Santa Maria District") echo "selected"; ?>>Santa Maria</option>
</optgroup>

<optgroup label="General Santos District">
    <option value="Apopong District" <?php if($churchname == "Apopong District") echo "selected"; ?>>Apopong</option>
    <option value="Dadiangas East District" <?php if($churchname == "Dadiangas East District") echo "selected"; ?>>Dadiangas East</option>
    <option value="Dadiangas North District" <?php if($churchname == "Dadiangas North District") echo "selected"; ?>>Dadiangas North</option>
    <option value="Dadiangas West District" <?php if($churchname == "Dadiangas West District") echo "selected"; ?>>Dadiangas West</option>
    <option value="Metro Gensan North District" <?php if($churchname == "Metro Gensan North District") echo "selected"; ?>>Metro Gensan North</option>
    <option value="Metro Gensan West 1 District" <?php if($churchname == "Metro Gensan West 1 District") echo "selected"; ?>>Metro Gensan West 1</option>
    <option value="Metro Gensan West 2 District" <?php if($churchname == "Metro Gensan West 2 District") echo "selected"; ?>>Metro Gensan West 2</option>
    <option value="Polomolok District" <?php if($churchname == "Polomolok District") echo "selected"; ?>>Polomolok</option>
    <option value="Silway-8 District" <?php if($churchname == "Silway-8 District") echo "selected"; ?>>Silway-8</option>
    <option value="Tambler District" <?php if($churchname == "Tambler District") echo "selected"; ?>>Tambler</option>
</optgroup>

<option value="Sarangani District" <?php if($churchname == "Sarangani District") echo "selected"; ?>>Sarangani</option>
<optgroup label="Sarangani District Subdistricts">
    <option value="Alabel District" <?php if($churchname == "Alabel District") echo "selected"; ?>>Alabel</option>
    <option value="Glan District" <?php if($churchname == "Glan District") echo "selected"; ?>>Glan</option>
</optgroup>

<optgroup label="South Cotabato District Subdistricts">
    <option value="Koronadal Central District" <?php if($churchname == "Koronadal Central District") echo "selected"; ?>>Koronadal Central</option>
    <option value="Koronadal East District" <?php if($churchname == "Koronadal East District") echo "selected"; ?>>Koronadal East</option>
    <option value="Koronadal West District" <?php if($churchname == "Koronadal West District") echo "selected"; ?>>Koronadal West</option>
    <option value="Norala District" <?php if($churchname == "Norala District") echo "selected"; ?>>Norala</option>
    <option value="Tboli District" <?php if($churchname == "Tboli District") echo "selected"; ?>>Tboli</option>
    <option value="Tampakan District" <?php if($churchname == "Tampakan District") echo "selected"; ?>>Tampakan</option>
    <option value="Tupi District" <?php if($churchname == "Tupi District") echo "selected"; ?>>Tupi</option>
</optgroup>

<optgroup label="Sultan Kudarat District">
    <option value="Bagumbayan District" <?php if($churchname == "Bagumbayan District") echo "selected"; ?>>Bagumbayan</option>
    <option value="Esperanza District" <?php if($churchname == "Esperanza District") echo "selected"; ?>>Esperanza</option>
    <option value="Isulan District" <?php if($churchname == "Isulan District") echo "selected"; ?>>Isulan</option>
    <option value="Kalamansig District" <?php if($churchname == "Kalamansig District") echo "selected"; ?>>Kalamansig</option>
    <option value="Lambayong District" <?php if($churchname == "Lambayong District") echo "selected"; ?>>Lambayong</option>
    <option value="Lebak District" <?php if($churchname == "Lebak District") echo "selected"; ?>>Lebak</option>
    <option value="Lutayan District" <?php if($churchname == "Lutayan District") echo "selected"; ?>>Lutayan</option>
    <option value="Senator Ninoy Aquino District" <?php if($churchname == "Senator Ninoy Aquino District") echo "selected"; ?>>Senator Ninoy Aquino</option>
</optgroup>

                </select>


                    </div>
                    <input type="submit" name="submit" class="sub_btn" value="SAVE">
                    <!---  <input type="reset" class="sub_btn" value="CLEAR">  ---->

                    <a href='datashowmemberlist.php?' class="sub_btns">VIEW</a>
                    <input type="reset" class="sub_btnss" value="CLEAR">
                    <a href='logout.php?' class="out_btns">LOGOUT</a>
                </div>
            </form>
        </div>
    </div>


    <script>
  function toUpperCaseFirst(str) {
    return str.toLowerCase().split(' ').map(function (word) {
      return word.charAt(0).toUpperCase() + word.slice(1);
    }).join(' ');
  }

  function checkAlphabetic(input) {
    var value = input.value;
    if (!/^[a-zA-Z\s]*$/g.test(value) && value.length > 0) {
      alert('Invalid input: only letters and spaces are allowed.');
      input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
    }
  }
    function checkAlphabeticAll(input) {
    var value = input.value;
    if (!/^[a-zA-Z0-9.,\s\-]*$/g.test(value) && value.length > 0) {
      alert('Invalid input: only letters, numbers, spaces, periods, commas, and dashes are allowed.');
      input.value = input.value.replace(/[^a-zA-Z0-9.,\s\-]/g, '');
    }
  }
</script>



    <?php
    if (isset($_GET['lname']) && isset($_GET['fname']) && isset($_GET['mname'])) {
        echo "<script>";
        echo "document.getElementsByName('lname')[0].value='".htmlspecialchars($_GET['lname'])."';";
        echo "document.getElementsByName('fname')[0].value='".htmlspecialchars($_GET['fname'])."';";
        echo "document.getElementsByName('mname')[0].value='".htmlspecialchars($_GET['mname'])."';";
        echo "document.getElementsByName('baptizeddate')[0].value='".htmlspecialchars($_GET['baptizeddate'])."';";
        echo "document.getElementsByName('placebaptized')[0].value='".htmlspecialchars($_GET['placebaptized'])."';";
        echo "document.getElementsByName('ministername')[0].value='".htmlspecialchars($_GET['ministername'])."';";
        echo "document.getElementsByName('receivedby')[0].value='".htmlspecialchars($_GET['receivedby'])."';";
        echo "document.getElementsByName('receiveddate')[0].value='".htmlspecialchars($_GET['receiveddate'])."';";
        echo "document.getElementsByName('churchname')[0].value='".htmlspecialchars($_GET['churchname'])."';";
        echo "</script>";
    }
    ?>

</body>

</html>

