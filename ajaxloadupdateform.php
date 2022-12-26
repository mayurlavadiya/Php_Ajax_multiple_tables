<?php

    include("dbconnection.php");

    $student_id= $_POST["id"];

    $sql="SELECT students.id,students.enrollment_no,students.firstname, students.lastname, students.contact,
    students.email, students.image,
    collegedetails.stream, collegedetails.collegename, collegedetails.city FROM students LEFT JOIN collegedetails 
    ON students.id = collegedetails.stud_id WHERE students.id = '$student_id'";

    $results= mysqli_query($con, $sql) or die(" Sql Query Failed");
    $output="";
    if(mysqli_num_rows($results)> 0){
    $output = '';
    while ($row = mysqli_fetch_assoc($results)){
    $output .= "<tr>
        <td><b>First Name</b></td>
        <td><input type='text' class='form-control' id='edit-fname'  name='fname'
                value='{$row['firstname']}'></td>
fname
        <td><input type='text' class='form-control' id='edit-id' hidden  name='id'
                value='{$row['id']}'></td>
    </tr>
    <tr>
        <td><b>Last Name</b></td>
        <td><input type='text' class='form-control mt-2' id='edit-lname'  name='lname'
                value='{$row['lastname']}'></td>
    </tr>
    <tr>
        <td><b>Enrollment</b></td>
        <td><input type='text' class='form-control mt-2' id='edit-enrollment' name='enroll_no' maxlength='6'
                value='{$row['enrollment_no']}'></td>
    </tr>
    
    <tr>
        <td><b>Contact</b></td>
        <td><input type='text' class='form-control mt-2' id='edit-contact'  name='contact' maxlength='10'
                value='{$row['contact']}'></td>
    </tr>
    <tr>
        <td><b>Email</b></td>
        <td><input type='email' class='form-control mt-2' id='edit-email'  name='email'
                value='{$row['email']}'></td>
    </tr>
    <tr>
        <td><b>Stream</b></td>
        <td><input type='text' class='form-control mt-2' id='edit-stream'  name='stream'
                value='{$row['stream']}'></td>
    </tr>
    <tr>
        <td><b>College Name</b></td>
        <td><input type='text' class='form-control mt-2' id='edit-collegename'  name='clgname'
                value='{$row['collegename']}'></td>
    </tr><tr>
        <td><b>City</b></td>
        <td><input type='text' class='form-control mt-2' id='edit-city'  name='city'
                value='{$row['city']}'></td>
    </tr>
    <tr>
        <td><b>Image</b></td>
        <td><input type='file' class='form-control mt-2' id='edit-image'  name='image'
                value='{$row['image']}'>
        </td>
        </tr>    
        <td class='text-center'> <img width='75vw' src='images/" . $row['image'] . "'></td>

    <tr>
        <td><button type='submit' id='submit-btn' class='btn btn-primary mt-2'>Update</button></td>
    </tr>";
    }

    mysqli_close($con);

    echo $output;
    }else{
    echo "<h2>No record found....</h2>";
    }
    ?>