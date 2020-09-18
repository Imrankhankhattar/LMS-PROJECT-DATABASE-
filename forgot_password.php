<?php
session_start();
?>
<head>
<?php 
$cssFile = "password.css";
echo "<link rel='stylesheet' href='" . $cssFile . "'>";
?>  
</head>

<div class="wrapper">
    <form  method="post" class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">  
        <div class="A">     
      <h2 class="form-signin-heading">Enter Your Username</h2>
      <input type="text" class="form-control" name="username" placeholder="Enter username " required=""/>  <br>  <br>  
      <input class="submit" type="submit" value="Submit" name='submit'> <br>
             <?php
             if (isset($_POST["submit"]))
             {   $user=$_POST["username"];

                $_SESSION['username']=$_POST['username'];
                $link = mysqli_connect('localhost','root','','mydb1');
                if($link === false){
                    die("ERROR: Could not connect. " . mysqli_connect_error());}
                 if(empty($user))
                 {
                     echo "<font color='red'>***Missing username ***</font><br/>";
                     die("");
                 }
               
                 $query  = "select * from admin where username = '$user'"; 
		$query2  = "select * from students where username = '$user'"; 
		$query3  = "select * from  instructors where username = '$user'"; 
		$result = mysqli_query($link,$query);
		$result2 = mysqli_query($link,$query2);
    $result3 = mysqli_query($link,$query3);
    //if username is not in all certain tables
		if (mysqli_num_rows($result) ==1 || mysqli_num_rows($result2) ==1 || mysqli_num_rows($result3)==1) 
		 {
            header('location:reset_password.php');
         }
         else
            {
            echo "<font color='red'>***You are not registered yet.***</font><br/><br/>";
             }
            }
             ?>
      </div> 
    </form>
  </div>