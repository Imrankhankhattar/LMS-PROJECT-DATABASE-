
<?php
$cssFile = "stylesheet.css";
echo "<link rel='stylesheet' href='" . $cssFile . "'>";
?>
<body>
<div id="log" >
    <a href="logout.php" >Logout
</div>
</body>

<?php
session_start();
$username=$_SESSION['username'];
$pass=$_SESSION['password'];


$link = mysqli_connect("localhost", "root", "", "mydb1");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 echo"<h1>Welcome <font color='black'>'$username'</font></h1>";
// Attempt select query execution
$sql = "SELECT * FROM students where username='$username' AND password='$pass'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo"<div class='headings'>";
echo"<font color='black'><h2>Personal details:</h2></font>";
        echo"</div>";
        echo"<div id='t1'>";
        echo "<table>";
            echo "<tr>";
                echo "<th>id</th>";
                echo "<th>Student_name</th>";
                echo "<th>City</th>";
                echo "<th>Gender</th>";
                echo "<th>Contact#:</th>";
                echo "<th>Address</th>";
                echo "<th>Depratment</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                $id=$row['id'];
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['city'] . "</td>";
                echo "<td>" . $row['Gender'] . "</td>";
                echo "<td>" . $row['contact#'] . "</td>";
                echo "<td>" . $row['Address'] . "</td>";
                echo "<td>" . $row['Department'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo"</div>";
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
$sql = "SELECT * FROM courses_details where S_id='$id'";
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
echo"<div class='headings'>";
echo"<font color='black'><h2>Courses details:</h2></font>";
        echo"</div>";
$sql = "SELECT * FROM courses where C_id='$course[0]' or C_id='$course[1]' or C_id='$course[2]'or C_id='$course[3]'or C_id='$course[4]'or C_id='$course[5]'";
if($result = mysqli_query($link, $sql)){
    echo"<div id='t2'>";    
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
        echo"</div>";
        

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
    $sql = "SELECT * FROM department d,students s where d.name=s.department and s.id='$id'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo"<div class='headings'>";
        echo"<font color='black'><h2>Department details:</h2></font>";
        echo"</div>";
        echo"<div id='t3'>";
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
        echo"</div>";

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

