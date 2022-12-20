<?php

include("dbconnection.php");


$student_id = $_POST["id"];
$enrollment = $_POST["enroll_no"];
$first_name = $_POST["fname"];
$last_name = $_POST["lname"];
$contact = $_POST["contact"];
$email = $_POST["email"]; 
$stream = $_POST["stream"];
$collegename = $_POST["clgname"];
$city = $_POST["city"];
// print_r($_FILES);
$unq = md5(time());
$filename = $_FILES["image"]["name"];
$location = $unq.$filename;
// $path = $_POST['old_files'];
// $old_image = $_POST['old_files'];
$folder ="images/".$location;

if (!empty($_FILES['image']['name'])) //new image uploaded
{
    
$sql = "UPDATE students s JOIN collegedetails c ON s.id = c.stud_id SET s.firstname='$first_name',s.lastname='$last_name', 
s.enrollment_no='$enrollment',s.contact = '$contact', s.email = '$email', s.image ='$location', c.stream = '$stream', 
c.collegename = '$collegename',c.city = '$city' WHERE s.id = '$student_id'";

move_uploaded_file($_FILES["image"]["tmp_name"],  $folder);
// unlink old image and delete from folder 

if(array_key_exists('old_files', $_POST)){
    $path = "images/" . $_POST['old_files'];
    if(file_exists($path)){
      unlink($path);
      echo 'File'.$path.'deleted';
    }else{
      echo 'Unable to delete'.$path.'file not exists';
    }
  }
}
else{
$sql = "UPDATE students s JOIN collegedetails c ON s.id = c.stud_id SET s.firstname='$first_name',s.lastname='$last_name', 
s.enrollment_no='$enrollment',s.contact = '$contact', s.email = '$email', c.stream = '$stream', 
c.collegename = '$collegename',c.city = '$city' WHERE s.id = '$student_id'";
}

if(mysqli_query($con, $sql)){
    echo 1;
}else{
    echo 0;
}
    
?>