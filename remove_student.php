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
<!-- action="remove_student2.php"  -->
</head>
<body id="body"> 
    <div style="height: 400px;" id="admin">
        <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <a href="#" id="top"><h3>**Student Removel Form**</h3></a><br><br>
            Student ID: <input type="text" placeholder="Enter Student ID" name="S_id"  autofocus><br/><br><br>
            <input type="submit" value="Remove Student" name="submit" id="submission"/><br><br>
            <?php
if (isset($_POST["submit"])){

function back()
        {
            ?> <h3><a href="adminchoices.php"  id="back">back to Admin portal</h3><?php
        }
$S_id=$_POST['S_id'];

$link = mysqli_connect("localhost", "root", "", "mydb1");
// Check connection
if($link === false){
    die("ERROR: Could not connect. ");
}
if (isset($_POST["submit"]))
{   if(empty($S_id))
    {
        echo "<font color='red'>***Missing  Student ID. ***</font><br/><br/>";
        die("");
    }
}
$check="Select * from students where id='$S_id'";
$result3 = mysqli_query($link,$check);
if (mysqli_num_rows($result3)==0)
 {
  
   echo "<font color='red'>***ID does not Exists***</font><br/>";
   back();
   die("");
 } 
$sql="Delete from students where id='$S_id'";
        $result = mysqli_query($link,$sql);
        if($result){
           check($link,$S_id);
           echo"<font color='green'>Student Removed Successfully</font><br>";
           back();
        }

function check($link,$S_id)
{
    
    $sql= "SELECT * FROM courses_details where S_id='$S_id'";
    $sql2= "Delete from courses_details where S_id='$S_id'";
    $result2 = mysqli_query($link,$sql2);
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result) > 0){
        $i=1;
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
mysqli_close($link);
}}
?>
            </form>
    
</body>
</html>