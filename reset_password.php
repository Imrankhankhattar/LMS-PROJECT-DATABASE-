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
    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>"  method="post">  
        <div class="A">     
      <h2 class="form-signin-heading">Enter New Password</h2>
      <input type="password" class="form-control" name="password" placeholder="Enter password" required="" autofocus="" />
      <input type="password" class="form-control" name="password2" placeholder="Enter password again " required=""/>  <br>    
      <input class="submit" type="submit" value="Submit" name='submit'> <br><br>
      <?php
             if (isset($_POST["submit"])){
              $user=$_SESSION['username'];
              $link = mysqli_connect("localhost", "root", "", "mydb1");
// Check connection
if($link === false){
    die("ERROR: Could not connect. ");
}
            if($_POST['password']==$_POST['password2']){
                $pass=$_POST['password'];
                
            
                 //for checking in which table username belong
                $sql_1="select * from instructors where username='$user'";
                $sql_2="select * from students where username='$user'";
                $sql_3="select * from admin where username='$user'";
                $check1 = mysqli_query($link,$sql_1);
                $check2 = mysqli_query($link,$sql_2);
                $check3 = mysqli_query($link,$sql_3);

                $sql1="update instructors Set password='$pass' where username ='$user'";
                $sql2="update students Set password='$pass' where username ='$user'";
                $sql3="update admin Set password='$pass' where username ='$user'";
                $result1 = mysqli_query($link,$sql1);
                $result2 = mysqli_query($link,$sql2);
                $result3 = mysqli_query($link,$sql3);
    

                if(mysqli_num_rows($check1)==1){
                   if($result1)
                   {
                    echo "<font color='green'> Password reset successfully</font><br/>";
                       ?> <h3><a href="login.php" >back to Login page</h3><?php
                       die("");
                   }
                   else{
                    die("Error in reseting password");
                   }
                }
                 else if(mysqli_num_rows($check2)==1){
                    if($result2)
                    {
                        echo "<font color='green'> Password reset successfully</font><br/>";
                        ?> <h3><a href="login.php" >back to Login page</h3><?php
                        die("");
                    }
                    else{
                        die("Error in reseting password");
                       }
                }
                 else if(mysqli_num_rows($check3)==1){
                    if($result3)
                    {
                        echo "<font color='green'> Password reset successfully</font><br/>";
                        ?> <h3><a href="login.php" >back to Login page</h3><?php
                        die("");
                    }
                    else{
                        die("Error in reseting password");
                       }
                }
                else
                {
                    echo"Error ".mysqli_error($link);
                }
            }
            else
            {
            echo "<font color='red'>***Password not matched***</font><br/><br/>";
            }

             }
             ?>
      </div> 
    </form>
  </div>