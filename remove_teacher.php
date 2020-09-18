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
<body id="body">
    <div id="admin9">
    <!-- action="remove_teacher2.php" -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>"  method="post">
            <h3 id="top">**Instructor Removel  Form**</h3><br><br>
            <b>Instructor ID:</b> <input type="text" placeholder="Enter Instructor ID" name="I_id" autofocus><br/><br><br>
            <input type="submit" value="Remove Instructor" name="submit" id="submission"/><br><br>
            <?php
session_start();
if (isset($_POST["submit"])){
{
   
    $link = mysqli_connect("localhost", "root", "", "mydb1");
// Check connection
if($link === false){
    die("ERROR: Could not connect. ");
}
$I_id=$_POST["I_id"];

function back()
{
    ?> <h3><a href="adminchoices.php" >back to Admin portal</h3><?php
}
function check($link,$I_id)
{
    $sql= "SELECT * FROM courses where I_id='$I_id'";
    $sql2= "UPDATE `courses` SET `I_id` = '999999' WHERE `I_id` = '$I_id'";
    $result2 = mysqli_query($link,$sql2);
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        $i=1;
    } 
    else{
        $i=0;
    }
} 
else{
    $i=0;
}
if($i==0)
{
    echo""; 
}
  if($i>0)
{
if($result2)
{
   echo""; 
}
}
}
$I_id=$_POST['I_id'];
$link = mysqli_connect("localhost", "root", "", "mydb1");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if (isset($_POST["submit"]))
{   if(empty($I_id))
    {
        echo "<font color='red'>***Missing Instructor ID. ***</font><br/><br/>";
        die("");
    }
}
$check="Select * from instructors where id='$I_id'";
$result3 = mysqli_query($link,$check);
if (mysqli_num_rows($result3)==0)
 {
  
   echo "<font color='red'>***ID does not Exists***</font><br/>";
   back();
   die("");
 } 
$sql="Delete from instructors where id='$I_id'";
        $result = mysqli_query($link,$sql);
        if($result){
           check($link,$I_id);
           echo"<font color='green'>Instructor Removed Successfully</font><br><br>";
           ?> <h3><a href="adminchoices.php" >back to Admin portal</h3><?php
        }
mysqli_close($link);
    }
}
?>
            </form>
    </div>
</body>
</html>