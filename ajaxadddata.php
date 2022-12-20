<?php
    include("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery"></script>
    <title>PHP AJAX</title>

</head>

<body>
    <main class="container">
        <div class="bg-light p-5 rounded">
            <h1 class="text-center bg-warning">PHP AJAX MULTIPLE</h1>

            <table class="table" id="main" cellspacing="0">
                <tr>
                    <td id="header1">
                        <form actioin="ajaxinsert.php" method="post" class="row" id="addform" enctype="multipart/form-data">
                              <div class="mb-3 col-md-6">
                                <label class="form-label">Student ID</label>
                                <input type="text" class="form-control" id="stud_id" name="stud_id" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Contact</label>
                                <input type="text" class="form-control" maxlength="10" id="contact" name="contact" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Enrollment No.</label>
                                <input type="text" class="form-control" id="enrollment" name="enroll_no" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Class</label>
                                <input type="text" class="form-control" id="classname" name="classname" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Stream</label>
                                <input type="text" class="form-control" id="stream" name="stream" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">College Name</label>
                                <input type="text" class="form-control" id="clgname" name="clgname" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label"><strong>Select Image</strong></label>
                                <input class="form-control" type="file" id="formFile" name="image">
                            </div>

                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>

                        </form></br>
                        <div id="error-message"></div>
                        <div id="success-message"></div>

                        <div id="modal">
                            <div id="modal-form">
                                <h2>Update Details</h2>
                                <table cellpadding="10px" width="100%">

                                </table>
                                <div id="close-btn">X</div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td id="table-data">

                    </td>
                </tr>
            </table>

            <script>
            $(document).ready(function() {
                function loadTable() {
                    $.ajax({
                        url: "ajaxload.php",
                        type: "POST",
                        success: function(data) {
                            $("#table-data").html(data);
                        }
                    });
                }
                loadTable();

                $("#addform").submit(function(event) {
                    event.preventDefault();
                    var addform = document.getElementById('addform');
                    var formData = new FormData(addform); 
                    // console.log(formData);

                    // var formData = {
                    //     fname: $("#fname").val(),
                    //     lname: $("#lname").val(),
                    //     contact: $("#contact").val(),
                    //     email: $("#email").val(),
                    //     enroll_no: $("#enrollment").val(),
                    //     classname: $("#classname").val(),
                    //     stream: $("#stream").val(),
                    //     clgname: $("#clgname").val(),
                    //     city: $("#city").val(),
                    //     image: $("#image").val(),
                    // };

                    $.ajax({
                        type: "POST",
                        url: "ajaxinsert.php",
                        data: formData,
                        dataType: 'json',
                        encode: true,
                        processData: false,
                        contentType: false,
                    }).done(function(data) {
                        if (data == 1) {
                            loadTable();
                            $("#addform").trigger("reset");
                            $("#success-message").html("Data Saved Successfully..")
                                .slideDown();
                            $("#error-message").slideUp();
                        } else {
                            $("#error-message").html("Can't savev record !")
                                .slideDown();
                            $("#success-message").slideUp();
                        }
                    });
                    event.preventDefault();
                });

                // Delete Data
                $(document).on("click", ".delete-btn", function() {

                    if (confirm("Do you want to delete this record ?")) {
                        var studentID = $(this).data("id");
                        var element = this; // variable create for element..

                        $.ajax({
                            type: "POST",
                            url: "ajaxdelete.php",
                            data: {
                                id: studentID
                                
                            }, // object ma lidhu n id ne value api-- studentID
                            success: function(data) {

                                if (data) {
                                    $(element).closest("tr").fadeOut();

                                    $("#success-message").html("Data succesfully Deleted !")
                                        .slideDown();
                                    $("#error-message").slideUp();

                                } else {
                                    $("#error-message").html("Unable to delete records !")
                                        .slideDown();
                                    $("#success-message").slideUp();
                                }
                            }
                        });
                    }

                });

                // Update Data
                $(document).on("click", ".update-btn", function() {
                    $("#modal").show();

                    var studentId = $(this).data("eid");

                    $.ajax({
                        type: "POST",
                        url: "ajaxloadupdateform.php",
                        data: {
                            id: studentId
                        },
                        success: function(data) { // table ma data leva mate  #modal-form table
                            $("#modal-form table").html(data);
                        }
                    });

                });

                // Hide Modal Box - selector
                $('#close-btn').on("click", function() {
                    $("#modal").hide();
                });

                // Save update form
                $(document).on("click", "#submit-btn", function() {
                    var studId = $("#edit-id").val();
                    var fname = $("#edit-fname").val();
                    var lname = $("#edit-lname").val();

                    $.ajax({
                        type: "POST",
                        url: "ajaxupdate.php",
                        data: {
                            id: studId,
                            first_name: fname,
                            last_name: lname
                        },
                        success: function(data) { // function pass kre value to e ama jase
                            if (data) {
                                $("#modal").hide();
                                loadTable(); // for reload table
                            }

                        }
                    });
                });
            });
            </script>

        </div>
    </main>
</body>

</html>