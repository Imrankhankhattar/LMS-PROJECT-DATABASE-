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
<body id="body">
<!-- action="enrstd2.php" -->
    <div id="admin3">
        <form   action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <a href="#" id="top"><h3>**Subject Enrollment Form**</h3></a><br>
            Student ID: <input type="text" placeholder="Enter Student ID" name="S_id" autofocus><br/><br>
            Course ID: <input type="text"placeholder="Enter Course ID" name="C_id"><br/><br/>
            <input type="submit" value="Enroll in Course" name="submit" id="submission"/><br><br>
            <?php

if (isset($_POST["submit"])){
    function back()
    {
        ?> <h3><a href="adminchoices.php" >back to Admin portal</h3><?php
    }   
$link = mysqli_connect("localhost", "root", "", "mydb1");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$S_id=$_POST['S_id'];
$C_id=$_POST['C_id'];

 if(empty($C_id)||empty($S_id))
    {
        echo "<font color='red'>***Missing some fields. ***</font><br/><br/>";
        die("");
    }

$que="select * from courses_details where S_id='$S_id'";
$result = mysqli_query( $link,$que);
$num_rows = mysqli_num_rows($result);
if($num_rows>7)
{
    echo "<font color='red'>*Student Already Enrolled in 7 courses*</font><br/><br/>";
    die("");
}
$que="select * from courses_details where S_id='$S_id' && C_id='$C_id'";
$result = mysqli_query( $link,$que);
$num_rows = mysqli_num_rows($result);
if($num_rows>0)
{
    echo "<font color='red'>*Already Enrolled in course*</font><br/><br/>";
    die("");
}

$check="Select * from students where id='$S_id'";
$check2="Select * from courses where C_id='$C_id'";
     $result3 = mysqli_query($link,$check);
     $result2 = mysqli_query($link,$check2);
     if (mysqli_num_rows($result3)==0||mysqli_num_rows($result2)==0)
      {
           echo "<font color='red'>***ERROR: Student/course ID does not Exists***</font><br/>";
        back();
        die("");
      } 

$sql="INSERT INTO courses_details (`S_id`, `C_id`) VALUES ('$S_id', '$C_id');";
        $result = mysqli_query($link,$sql);
        if($result){
            echo "<font color='black'>Record inserted successfully.</font><br/>";
        ?> <h3><a href="adminchoices.php" >back to Admin portal</h3><?php
    }
        else{
            echo"Error";
        }

      
mysqli_close($link);}

?>
            </form>
    </div>
</body>
</html>