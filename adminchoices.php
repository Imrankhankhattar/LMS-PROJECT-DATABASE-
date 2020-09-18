<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?php 
$cssFile = "adminchoices2.css";
echo "<link rel='stylesheet' href='" . $cssFile . "'>";
?>  
</head>
<body>
  <div class="log">
  <div id="ad1"> 
  <a href="logout.php"> logout</a><br>
  </div>
  </div>
  <!-- student_registration -->
<div class="vertical-menu">
  <span class="indicator"></span>
  <a href="student_registration.php" class="active">Register Student </a><br>
  <a href="teacher_registration.php">Register Instructor</a><br> 
  <a href="course_registration.php">Register New Course</a><br>
  <a href="department_update.php">Update Department</a><br> 
  <a href="updation_student_info.php">Updating Student info</a><br>
  <a href="updation_teacher_info.php">Updating Teacher info</a><br> 
  <a href="subject_enrolment.php">Enroll Student in Course</a><br>
  <a href="Assigncourse.php">Assign Course Instructor</a><br>
  <a href="remove_student.php" >Remove Student</a>
  <a href="remove_teacher.php">Remove Instructor</a><br>
</div>
</body>
</html>
<body >