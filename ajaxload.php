
<?php
    include("dbconnection.php");

    $sql = "SELECT students.id,students.enrollment_no,students.firstname, students.lastname, students.contact,
    students.email, students.image,collegedetails.collegename, collegedetails.stud_id,
    collegedetails.stream, collegedetails.city FROM students LEFT JOIN collegedetails 
    ON students.id = collegedetails.stud_id";

    $results = mysqli_query($con, $sql) or die("Sql Query Failed");
    $output = "";
    if(mysqli_num_rows($results)> 0){
        $output = '<table class="table table-warning" cellspacing="0" cellpadding="10px" width="1000%">
        <tr>
            <th class="text-center table-danger">ID</th>
            <th class="text-center table-danger">ENROLLMENT NO</th>
            <th class="text-center table-danger">FIRST NAME</th>
            <th class="text-center table-danger">LAST NAME</th>
            <th class="text-center table-danger">CONTACT</th>
            <th class="text-center table-danger">EMAIL</th>
            <th class="text-center table-danger">STREAM</th>
            <th class="text-center table-danger">COLLEGE</th>
            <th class="text-center table-danger">CITY</th>
            <th class="text-center table-danger">IMAGE</th>
            <th class="text-center table-danger width="100px"">ACTION</th>
        </tr>';
        while ($row = mysqli_fetch_assoc($results)){
            $output .= "<tr><td class='text-center'>{$row["id"]}</td>
            <td class='text-center'> {$row["enrollment_no"]}</td>
            <td class='text-center'> {$row["firstname"]}</td>
            <td class='text-center'> {$row["lastname"]}</td>
            <td class='text-center'> {$row["contact"]}</td>
            <td class='text-center'> {$row["email"]}</td>
            <td class='text-center'> {$row["stream"]}</td>
            <td class='text-center'> {$row["collegename"]}</td>
            <td class='text-center'> {$row["city"]}</td>    
            <td class='text-center'> <img width='100vw' src='images/" . $row['image'] . "' ></td>
            <td class='text-center'><button class='btn btn-primary update-btn' data-eid='{$row["id"]}'>Update</button>
            </br></br>
            <button class='btn btn-danger delete-btn' data-id='{$row["id"]}'>Delete</button></td>
            </tr>";
        }
    $output .= "</table>";

    mysqli_close($con);
    
    echo $output;
    }else{
        echo "<h2>No record found....</h2>";
    }


?>