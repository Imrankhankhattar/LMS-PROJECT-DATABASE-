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
<!-- action="Assigncourse2.php" -->
</head>
<body id="body">
    <div id="admin3">
        <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>"  method="post">
            <a href="#" id="top"><h3>**Course Assignment  Form**</h3></a><br>
            Instructor ID: <input type="text" placeholder="Enter Instructor ID" name="I_id" autofocus><br/><br>
            Course ID: <input type="text"placeholder="Enter Course ID" name="C_id"><br/><br/>
            <input type="submit" value="Assign Course" name="submit" id="submission"/><br>
            <?php

if (isset($_POST["submit"])){

    function back()
    {
        ?> <h3><a href="adminchoices.php" >back to Admin portal</h3><?php
    }   


$I_id=$_POST['I_id'];
$C_id=$_POST['C_id'];
if (isset($_POST["submit"]))
{   if(empty($C_id)||empty($I_id))
    {
        echo "<font color='red'>***Missing some fields. ***</font><br/><br/>";
        die("");
    }
}
$link = mysqli_connect("localhost", "root", "", "mydb1");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$dum=999999;
$check="Select * from  instructors where id='$I_id'";
$check2="Select * from courses where C_id='$C_id'";
$check3="Select * from courses where C_id='$C_id' && I_id='$dum'";
     $result3 = mysqli_query($link,$check);
     $result2 = mysqli_query($link,$check2);
     $check_result = mysqli_query($link,$check3);
    
     if (mysqli_num_rows($result3)==0||mysqli_num_rows($result2)==0)
      {
        echo "<font color='red'>***ERROR: Student/course ID does not Exists***</font><br/>";
        back();
        die("");
      } 
      if(mysqli_num_rows($check_result)>0)
      {
        $sql="UPDATE courses SET `I_id` = '$I_id' WHERE `C_id` ='$C_id'";
        $result = mysqli_query($link,$sql);
        if($result){
        echo "<font color='black'>Record inserted successfully.</font><br/>";

        ?> <h3><a href="adminchoices.php" >back to Admin portal</h3><?php
                  }
        else{
            echo"Error".mysqli_error($link);
        }
      }
      else
      {
        echo "<font color='red'>***ERROR: Course Already Assigned.***</font><br/>";
        back();
          die("");
      }

        
mysqli_close($link);
    }
?>
            </form>
    </div>
</body>
</html>