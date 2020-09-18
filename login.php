<?php
session_start();
?>
<html>
<head>
<title>login form 
</title>
<!-- including css file -->
<?php
$cssFile = "loginstyles.css";
echo "<link rel='stylesheet' href='" . $cssFile . "'>";
?>

<body>
<div class="login">
  <div class="login-triangle"></div>
  
  <h2 class="login-header">Log in</h2>
  <!-- redirecting it self -->
  <form method="post" class="login-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
    <p><input type="text" placeholder="username" name="username"></p>
    <p><input type="password" placeholder="Password" name="password"></p>
    <p><input type="submit" value="Login"name="submit"></p>
    <p id="forgot">Forgot Password...  <a href="forgot_password.php">Click here</a></p>
   <!-- when user submits the form -->
    <?php
    // maiking connection with db
     $link = mysqli_connect('localhost','root','','mydb1');
     if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
                    }
    //  saving values of credentials
     if (isset($_POST["submit"])){
       $user = $_POST['username'];
       $pass = $_POST['password'];
       $_SESSION['username']= $_POST['username'];
       $_SESSION['password']= $_POST['password'];

     }
     //checking if user did not entered any thing
	if (isset($_POST["submit"]))
	{  if(empty ($_POST["username"])||empty($_POST["password"]))
    {
      if (empty($_POST["username"])) //if username field is empty echo below statement
        {
            echo "<font color='red'>***Username is required .***</font><br/>";
        }
         if (empty ($_POST["password"])) //if password field is empty echo below statement
        {
            echo "<font color='red'>***Password required***</font><br/>";
          }
    die(""); 
      }
	else
	{	//checking user  username and password from database :validation
		$query  = "select * from admin where username = '$user' || password= '$pass'"; 
		$query2  = "select * from students where username = '$user' || password= '$pass'"; 
		$query3  = "select * from  instructors where username = '$user' || password= '$pass'"; 
		$result = mysqli_query($link,$query);
		$result2 = mysqli_query($link,$query2);
    $result3 = mysqli_query($link,$query3);
    //if username is not in all certain tables
		if (mysqli_num_rows($result) == 0 && mysqli_num_rows($result2) == 0 && mysqli_num_rows($result3) == 0) 
		 {
			echo "<font color='red'>***You are not registered yet.***</font><br/><br/>";
			die("");
		 } 
    //now comparing with data of tables
		 $query  = "select * from admin where username = '$user' && password= '$pass'"; 
		 $query2  = "select * from students where username = '$user' && password= '$pass'"; 
		 $query3  = "select * from  instructors where username = '$user' && password= '$pass'"; 
		 $result = mysqli_query($link,$query);
		$result2 = mysqli_query($link,$query2);
    $result3 = mysqli_query($link,$query3);
    //if user is admin redirecting it
		if (mysqli_num_rows($result) == 1) 
		 {
		   header('location:adminchoices.php');
     } 
     //if user is student redirecting it to student view
		 else if (mysqli_num_rows($result2) == 1) 
		 {
		   header('location:student.php');
     } 
     //if user is teacher
		 else if (mysqli_num_rows($result3) == 1) 
		 {
		   header('location:instructor.php');
     } 
     //else invalid username or password
		  else
		 {
		   echo "<font color='red'>***Incorrect username or password***</font><br/><br/>";
		 }
	}}  
?>
  </form>
</div>
</html>
