<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php

$cssFile = "reg.css";
echo "<link rel='stylesheet' href='" . $cssFile . "'>";
?>
</head>
<body>
<!-- action="registerstd.php" -->
    <div id="admin">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <a href="#" id="top"><h3>**Student Registration Form**</h3></a>
            Student Id: <input type="text" placeholder="Enter Student ID" name="id" autofocus><br/><br>
            Student name: <input type="text"placeholder="Enter Student Name" name="name"><br/><br/>
            Department: <input type="text" placeholder="Enter department name" name="d_name"><br/><br/>
            City: <input type="text" placeholder="Enter City" name="city"><br/><br/>
            Gender: <input type="text" placeholder="Enter Gender" name="gender"><br/><br/>
            Contact#: <input type="text" placeholder="Enter contact No" name="num"><br/><br/>
            Address: <input type="text" placeholder="Enter Address" name="address"><br/><br/>
            Username: <input type="text" placeholder="enter a user name" name="username" /><br/><br>
            Password: <input type = "password" placeholder="enter password" name="password" /><br/><br>
            <input type="submit" value="Register Student" name="submit" id="submission"/><br>
            
<?php
	
    $link = mysqli_connect('localhost','root','','mydb1');
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    if (isset($_POST["submit"])){
    $id = $_POST['id'];
     $name = $_POST['name'];
     $d_name = $_POST['d_name'];
     $city = $_POST['city'];
     $address = $_POST['address'];
     $contact = $_POST['num'];
	 $gender = $_POST['gender'];
	 $user = $_POST['username'];
     $pass = $_POST['password'];
    
    if (isset($_POST["submit"]))
	{   if(empty ($pass)||empty($user)||empty ($d_name)||empty($city)||empty($address)||empty($contact)||empty ($gender)||empty($id))
		{ echo"<p></p>";
            echo "<font color='red'>***Missing some fields.***</font><br/><br/>";
            die("");
        }
    }
    
     $check="Select * from students where id='$id' or username='$user'";
     $result2 = mysqli_query($link,$check);
     
     if (mysqli_num_rows($result2)>0)
         {
            echo"<p></p>";
         echo "<font color='red'>***id or username is duplicate or username***</font><br/><br/>";
         }   
      else{
        $sql= "INSERT INTO `students` (`id`, `name`, `contact#`, `city`, `Gender`, `Address`, `Department`, `username`, `password`) VALUES ('  $id ', ' $name', '$contact ', ' $city ', '$gender', '$address', '$d_name', '$user', ' $pass')";
        $result = mysqli_query($link,$sql);
        if($result){
            echo"<p></p>";
        echo "<font color='green'>Record inserted successfully</font><br/><br/>";
        ?> <h3 color="white"><a href="adminchoices.php" >back to Admin portal</h3><?php
                    } 
    else{
        echo"<p></p>";
        die("<font color='red'>***ERROR: Could not connect. ***</font><br/><br/>" . mysqli_error($link));
        }
    }
     
    // Close connection
    mysqli_close($link);}
?>
            </form>

    </div>
</body>
</html>