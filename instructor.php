
<div id="log" >
    <a href="logout.php" >Logout

</div>
<?php

$cssFile = "stylesheet.css";
echo "<link rel='stylesheet' href='" . $cssFile . "'>";
?>
<?php
session_start();
$username=$_SESSION['username'];
$pass=$_SESSION['password'];


$link = mysqli_connect("localhost", "root", "", "mydb1");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
echo"<h1>Welcome <font color='blue'>'$username'</font></h1>";
// Attempt select query execution
$sql = "SELECT * FROM instructors where username='$username' AND password='$pass'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
    echo"<font color='red'><h3>Personal details:</h3></font>";
        echo "<table>";
            echo "<tr>";
                echo "<th>id</th>";
                echo "<th>Instructor_name</th>";
                echo "<th>Education</th>";
                echo "<th>Depratment</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                $id=$row['id'];
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['education'] . "</td>";
                echo "<td>" . $row['D_name'] . "</td>";
                
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);

    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute";
}

 $course = array();
 $course = new SplFixedArray(6);
//$course=array();
$sql = "SELECT * FROM courses where I_id='$id'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        $i=0;
        while($row= mysqli_fetch_array($result)){
                $course[$i]=$row['C_id'];
                $i=$i+1;
        }
    } 
    else{
        //echo "No record found .";
        $i=0;
    }
} 
else{
    //echo "ERROR: Could not able to execute";
    $i=0;
}
if($i==0)
{
    department($id,$link);
    die("");
}
$sql="Select * from courses c,instructors i where i.id=c.I_id and i.id='$id'";
if($result = mysqli_query($link, $sql)){
    echo"<font color='red'><h3>Courses details:</h3></font>";
        echo "<table>";
            echo "<tr>";
                echo "<th>Course name</th>";
                echo "<th>Course id</th>";
                echo "<th>Department Name</th>";
            echo "</tr>";
    if(mysqli_num_rows($result) > 0){
    
        while($row = mysqli_fetch_array($result)){
            echo "<tr>"; 
                echo "<td>" . $row['Description'] . "</td>";
                echo "<td>" . $row['C_id'] . "</td>";
                echo "<td>" . $row['D_name'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        

    } else{
        echo "No records matching your query were found.";
    }
}
 else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
department($id,$link);
function department($id,$link)
{
    $sql = "SELECT * FROM department d,instructors s where d.name=s.D_name and s.id='$id'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
    echo"<font color='red'><h3>Department details:</h3></font>";
        echo "<table>";
            echo "<tr>";
                echo "<th>Department_name</th>";
                echo "<th>HOD_name</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "<td>" . $row['hod'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";

    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute ";
}
}
// Free result set
//mysqli_free_result($result);
 
// Close connection
mysqli_close($link);

?>