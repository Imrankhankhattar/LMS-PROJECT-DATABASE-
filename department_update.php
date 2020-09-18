<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php

$cssFile = "registration.css";
echo "<link rel='stylesheet' href='" . $cssFile . "'>";
?>
</head>
<!-- action="updatedep.php" -->
<body id="body">
    <div id="admin3">
        <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" >
           <h3> <a href="#" id="top">**Department updation Form**</a></h3><br>
            Department name: <input type="text"placeholder="Enter Department Name" name="d_name" autofocus><br/><br/><br>
            Hod'name: <input type="text" placeholder="Enter Hod's name" name="hod_name"><br/><br/> <br>
            <input type="submit" value="Register department" name="submit" id="submission"/><br>

            <?php
   
    if (isset($_POST["submit"])){
    $link = mysqli_connect('localhost','root','','mydb1');
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
     
     $d_name = $_POST['d_name'];
     $hod_name = $_POST['hod_name'];
     if (isset($_POST["submit"]))
     {   if(empty ($hod_name)||empty($d_name))
         {
             echo "<font color='red'>***Missing some fields. ***</font><br/>";
             die("");
         }
     }
     $check="Select * from department where Name='$d_name'";
     $result3 = mysqli_query($link,$check);
     if (mysqli_num_rows($result3)==0)
      {
       
        echo "<h3><font color='red'>***ERROR: Department does not Exists***</font><br/></h3>";
        back();
        die("");
      } 

     $sql2="select * from department where hod='$hod_name' and name='$d_name'";
     $result3 = mysqli_query($link,$sql2);
     
     if (mysqli_num_rows($result3)>0)
         {
       
           die ("<font color='red'>* Error: did not gave any updated value*</font><br/>");
         }
         else{
        $sql= "UPDATE `department` SET `hod` = '$hod_name' WHERE `name` = '$d_name';";
        $result = mysqli_query($link,$sql);

        if($result){
        echo "<font color='black'>Record updated successfully</font><br/>";
        ?> <h3><a href="adminchoices.php" >back to Admin portal</h3><?php
                   } 
    else{
        echo "<font color='red'>***ERROR: Could not able to execute the Query***</font><br/><br/>";
        }
}

function back()
{
    ?> <h3><a href="adminchoices.php" >back to Admin portal</h3><?php
}
    // Close connection
    mysqli_close($link);}
?>
            </form>

    </div>
</body>
</html>