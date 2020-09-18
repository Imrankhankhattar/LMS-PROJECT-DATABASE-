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
<!-- action="updatestd.php" -->
<body id="body2">
    <div  style="height: 580px" id="admin">
        <form     action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" >
           <h3> <a href="#" id="top">**Student Info updation Form**</a></h3><br>
           StudentID: <input type="text" placeholder="Enter Student ID" name="id" autofocus><br/><br/> 
            contact#: <input type="text"placeholder="Enter Conatact number" name="contact"><br/><br/>
            City: <input type="text" placeholder="Enter City" name="city"><br/><br/> 
            Address: <input type="text" placeholder="Enter Address" name="address"><br/><br/>
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
     $con = $_POST['contact'];
     $dep = $_POST['department'];
     $address = $_POST['address'];
     $city = $_POST['city'];
	 $user = $_POST['username'];
     $pass = $_POST['password'];
     if (isset($_POST["submit"]))
     {   if(empty ($pass)||empty($user)||empty ($dep)||empty($con)||empty($city)||empty($id)||empty($address))
         {
             echo "<font color='red'>***Missing some fields. ***</font><br/>";
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
 $sql="UPDATE `students` SET `contact#` = '$con', `city` = '$city', `Address` = '$address', `Department` = '$dep', `username` = '$user', `password` = '$pass' WHERE `id` = '$id'";
        $result = mysqli_query($link,$sql);
        if($result){
        echo "Record Updated successfully.";
        ?> <h3><a href="adminchoices.php" >back to Admin portal</h3><?php
    } 
    else{
        echo "<font color='red'>***ERROR:  Duplicate ID***</font><br/>";
    }
    // Close connection
    mysqli_close($link);}
            ?>
            </form>

    </div>
    </div>
    <div id="instructions">
    <p style="color:white">
     INSTRUCTIONS <br>
     <ol style="color:white">
            <li> You cannot change id.</li>
            <li> Please Enter the updated value else give previous one .</li>
        </ol> 
    </p>
    </div>
</body>
</html>