<?php

$studentID = $_POST["id"];

$conn = mysqli_connect("localhost","root","","test") or die("Connection Failed");

echo $sql = "DELETE students, collegedetails FROM students 
INNER JOIN collegedetails ON students.id = collegedetails.stud_id 
WHERE students.id = '{$studentID}'";

if(mysqli_query($conn, $sql)){
    echo 1;
}else{
    echo 0;
}
    
?>