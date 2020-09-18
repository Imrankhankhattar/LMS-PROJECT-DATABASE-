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
<body id="body2">
<!-- action="update_instr.php" -->
    <div  style="height:530px"  id="admin">
        <form   action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" >
           <h3> <a href="#" id="top">**Instructor Info updation Form**</a></h3><br><br>
           <b>Instructor ID:</b> <input type="text" placeholder="Enter instructor ID" name="id" autofocus><br/><br/>  
            Education<input type="text" placeholder="Enter Education" name="education"><br/><br/>
            Department: <input type="text" placeholder="Enter Department" name="department"><br/><br/>
            Username: <input type="text" placeholder="Enter username" name="username"><br/><br/> 
           password: <input type="text" placeholder="Enter password" name="password"><br/><br/> 
            <input type="submit" value="update" name="submit" id="submission"/><br><br>
            <?php
    
    if (isset($_POST["submit"])){
        function back()
        {
            ?> <h3><a href="adminchoices.php" >back to Admin portal</h3><?php
        }

    $link = mysqli_connect('localhost','root','','mydb1');
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    $id = $_POST['id'];
     $dep= $_POST['department'];
     $edu = $_POST['education'];
	 $user = $_POST['username'];
     $pass = $_POST['password'];
     if (isset($_POST["submit"]))
     {   if(empty ($pass)||empty($user)||empty ($dep)||empty($edu)||empty($id))
         {
             echo "<font color='red'>***Missing some fields. ***</font><br/><br/>";
             die("");
         }
     }
        $check="Select * from instructors where id='$id'";
        $result3 = mysqli_query($link,$check);
		if (mysqli_num_rows($result3)==0)
		 {
          
           echo "<font color='red'>***ID does not Exists***</font><br/>";
           back();
           die("");
		 } 
        $sql= "UPDATE `instructors` SET `education` = '$edu', `D_name` = '$dep', `username` = '$user', `password` = '$pass' WHERE `instructors`.`id` = '$id'";
        $result = mysqli_query($link,$sql);
        if($result){
            echo "<font color='red'>Record inserted successfully.</font><br/>";
           back();
            } 
    else{
        echo "<font color='red'>*ERROR: Could not able to execute*</font><br/><br/>".mysqli_error($link);
        }
    // Close connection
    
    mysqli_close($link);
}?>
            </form>
    </div>
    </div>
    <div id="instructions">
    <p style="color:white">
     INSTRUCTIONS <br>
     <ol style="color:white">
            <li> Enter Orignal ID.You cannot change ID.</li>
            <li> Please Enter the updated value else give previous one .</li>
        </ol> 
    </p>
    </div>
</body>
</html>