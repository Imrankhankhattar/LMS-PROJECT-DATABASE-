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
<!-- action="registercrc.php"   -->
</head>
<body id="body">
    <div id="admin2">
        <form  method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
            <a href="#" id="top">**Course Registration Form**</a><br><br><br>
            Course Id: <input type="text" placeholder="Enter Course ID" name="id" autofocus><br/><br/><br>
            Course name: <input type="text"placeholder="Enter Course  Name" name="name"><br/><br/><br>
            Department: <input type="text" placeholder="Enter department name" name="d_name"><br/><br/> <br>
            Description: <textarea name="description" id="" cols="20" rows="4"></textarea><br/><br/> <br>
            <input type="submit" value="Register course" name="submit" id="submission"/><br>
            <?php
    
    if (isset($_POST["submit"])){
    $link = mysqli_connect('localhost','root','','mydb1');
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    $id = $_POST['id'];
     $name = $_POST['name'];
     $d_name = $_POST['d_name'];
     $des = $_POST['description'];
     $dum=999999;
     if (isset($_POST["submit"]))
     {   if(empty ($d_name)||empty($des)||empty($name)||empty($id))
         {
             echo "<font color='red'>***Missing some fields. ***</font><br/>";
             die("");
         }
     }
     $check="Select * from courses where C_name='$name' || C_id='$id'";
     $result3 = mysqli_query($link,$check);
     
     if (mysqli_num_rows($result3)>0)
         {
       
         echo "<font color='red'>*** ERROR:Course name is duplicate***</font><br/>";
         }   
      else{

        $sql= "INSERT INTO `courses` (`C_name`, `C_id`, `D_name`,`Description`, `I_id`) VALUES ('$name', '$id', '$d_name','$des',999999);";
        $result = mysqli_query($link,$sql);
        if($result){
        echo "";
        echo "<font color='green'>Record inserted successfully.</font><br/>"
        ?> <h3><a href="adminchoices.php" >back to Admin portal</h3><?php
    } 
    else{
        echo "<font color='black'>***ERROR: Could not able to execute the Query***</font>". mysqli_error($link);
    }}
 
    // Close connection
    mysqli_close($link);
}
?>
            </form>

    </div>
</body>
</html>