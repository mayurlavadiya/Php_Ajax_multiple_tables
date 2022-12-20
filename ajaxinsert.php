<?php
    include("dbconnection.php");
    // print_r ($_FILES);
    // exit;
    $sid = $_POST["id"];
    $first_name = $_POST["fname"];
    $last_name = $_POST["lname"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $enroll_no = $_POST["enroll_no"];
    $classname = $_POST["classname"];

    $unq = md5(time());
    $filename = $_FILES["image"]["name"];
    $location = $unq.$filename;
    $folder="images/".$location;
    
    $stream = $_POST["stream"];
    $clgname = $_POST["clgname"];
    $city = $_POST["city"];


    $sql = "INSERT INTO students (`enrollment_no`, `firstname`, `lastname`, `contact`, `email`, `image`) VALUES 
    ('{$enroll_no}','{$first_name}','{$last_name}','{$contact}','{$email}','{$location}')";

    $runsql = mysqli_query($con, $sql);
    $runsql1=mysqli_insert_id($con);
    
    if($runsql==1){
        
        move_uploaded_file($_FILES["image"]["tmp_name"],$folder);

       $sqlnew = "INSERT INTO collegedetails (`stud_id`,`stream`, `collegename`, `city`) VALUES ('$runsql1','$stream','$clgname','$city')";

        $runsqlnew = mysqli_query($con, $sqlnew);


        if($runsqlnew && $runsql){
            echo 1;
    
        }else{
            echo 0;
        }
    }

?>