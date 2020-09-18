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
<!-- <style>
        a{
            text-decoration: none;
            border: 1px solid black;
            color: green;
        }
        a:hover{
            background-color: lightblue;
            padding: 2px;
        }
    </style> 
action="registerteacher.php"-->
</head>
<body>
    <div id="admin">
        <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>"  method="POST">
        <a href="" id="top">**Instructor Enrollment  Form**</a><br><br><br>
        Teacher Id: <input type="text" placeholder="Enter Instructor ID" name="id" autofocus><br/><br/><br>
        Teacher name: <input type="text"placeholder="Enter Instructor Name" name="name"><br/><br/><br>
        Education: <input type="text"placeholder="Enter Degree" name="education"><br/><br/><br>
        Department: <input type="text" placeholder="Enter department name" name="d_name"><br/><br/> <br>
        Username: <input type="text" placeholder="Enter user name" name="username" /><br/><br/><br>
        Password: <input type = "password" placeholder="Enter password" name="password" /><br/><br/>
        <input type="submit" value="Register Instructor" name="submit" id="submission"/><br>
<?php
if (isset($_POST["submit"])){
    $link = mysqli_connect('localhost','root','','mydb1');
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    $id = $_POST['id'];
     $name = $_POST['name'];
     $d_name = $_POST['d_name'];
     $edu = $_POST['education'];
	 $user = $_POST['username'];
     $pass = $_POST['password'];
     if (isset($_POST["submit"]))
     {   if(empty ($pass)||empty($user)||empty ($d_name)||empty($edu)||empty($name)||empty($id))
         {
             echo "<font color='red'>***Missing some fields. ***</font><br/><br/>";
             die("");
         }
     }
        $check="Select * from instructors where id='$id' or username='$user'";
        $result3 = mysqli_query($link,$check);
		if (mysqli_num_rows($result3)>0)
		 {
          
           echo "<font color='red'>***id or username is duplicate***</font><br/><br/>";
		 } 
      else{
        $sql= "INSERT INTO `instructors` (`id`, `name`, `education`, `D_name`, `username`, `password`) VALUES ('$id ', '$name ', ' $edu ', '$d_name', '$user ', '  $pass')";
        $result = mysqli_query($link,$sql);
        if($result){
        echo "<p></p>";
        echo "<font color='green'>Record inserted successfully.</font><br/><br/>";
        ?> <h3><a href="adminchoices.php" >back to Admin portal</h3><?php
    } 
    else{
        echo "<font color='red'>***ERROR: Could not able to execute the Query Duplicate ID***</font><br/><br/>";
    }
}
     
    // Close connection
    mysqli_close($link);}
?>
        </form>
    </div>
</body>
</html>