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
    <main class="container-fluid">
        <div class="bg-light p-5 rounded">
            <h1 class="text-center bg-warning">PHP AJAX MULTIPLE</h1>
            <table class="table" id="main" cellspacing="0">
                <tr>
                    <td id="header1">
                        <form action="ajaxinsert.php" method="post" class="row" id="addform"
                            enctype="multipart/form-data">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname" required>
                                <input type="hidden" class="form-control" id="id" name="id">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Contact</label>
                                <input type="text" class="form-control" maxlength="10" id="contact" name="contact"
                                    required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Enrollment No.</label>
                                <input type="text" class="form-control" id="enrollment" name="enroll_no" maxlength="6"
                                    required>
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
                                <input class="form-control" type="file" id="image" name="image">
                            </div>

                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>

                        </form>
                        </br>
                        <!-- live search -->
                        <div id="search-bar" class="mb-3 col-md-6">
                            <label class="form-label">Search :</label>
                            <input type="text" class="form-control" id="search" autocomplete="off">
                        </div>

                        <div id="error-message"></div>
                        <div id="success-message"></div>

                        <div id="modal">
                            <div id="modal-form">
                                <h2>Update Details</h2>
                                <form action="ajaxupdate.php" method="post" class="row" id="updateform"
                                    enctype="multipart/form-data">

                                    <table cellpadding="10px" width="100%">

                                    </table>
                                </form>
                                <div id="close-btn">X</div>
                            </div>
                        </div>
                    </td>

                </tr>

                <tr>
                    <!-- load table data -->
                    <td id="table-data">

                    </td>
                </tr>
            </table>

            <!-- Pagination -->
            <div id="pagination" class="pagination justify-content-center">
                <!-- <li class="active page-item"><a class="page-link" id="1" href="#">1</a></li>
                <li class="page-item"><a class="page-link" id="2" href="#">2</a></li>
                <li class="page-item"><a class="page-link" id="3" href="#">3</a></li> -->
            </div>

            <script>
            $(document).ready(function() {
                function loadTable() {
                    $.ajax({
                        url: "ajaxload.php",
                        type: "POST",
                        success: function(data) {
                            $("#table-data").html(data);
                            // console.log("Hiiiiii");
                        }
                    });
                }
                loadTable();

                $("#addform").submit(function(event) {
                    event.preventDefault();
                    let addform = document.getElementById('addform');
                    let formData = new FormData(addform);
                    // console.log(formData);

                    // var formData = {
                    //     fname: $("#fname").val(),
                    //     lname: $("#lname").val(),
                    //     contact: $("#contact").val(),
                    //     email: $("#email").val(),
                    //     enroll_no: $("#enrollment").val(),
                    //     classname: $("#classname").val(),SS
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
                            $("#success-message").html("Data Saved Successfully..").slideDown();
                            $("#error-message").slideUp();
                        } else {
                            $("#error-message").html("Can't savev record !").slideDown();
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
                $("#updateform").submit(function(event) {
                    event.preventDefault();
                    // alert("Hello");
                    let updateForm = document.getElementById('updateform');
                    let formData = new FormData(updateForm);

                    // let formData = { 
                    //     studId : $("#edit-id").val();
                    //     fname : $("#edit-fname").val();
                    //     lname : $("#edit-lname").val();
                    //     enrollment : $("#edit-enrollment").val();
                    //     contact : $("#edit-contact").val();
                    //     email : $("#edit-email").val();
                    //     stream : $("#edit-stream").val();
                    //     clgname  : $("#edit-collegename").val();
                    //     city : $("#edit-city").val();
                    //     image : $("#edit-image").val();
                    // };


                    $.ajax({
                        type: "POST",
                        url: "ajaxupdate.php",
                        data: formData,
                        dataType: 'json',
                        encode: true,
                        processData: false,
                        contentType: false,
                        success: function(data) { // function pass kre value to e ama jase
                            if (data == 1) {
                                $("#modal").hide();
                                loadTable(); // for reload table
                            }

                        },
                        error: function(error) {
                            console.log(error);
                        }
                    })

                });

                // Live search
                $('#search').on("keyup", function(e) {
                    var searchterm = $(this).val();

                    $.ajax({
                        url: "ajaxlivesearch.php",
                        type: "POST",
                        data: {
                            search: searchterm
                        },
                        success: function(data) {
                            $("#table-data").html(data);
                        }
                    });
                });

                // Pagination
                function loadPagination(page){
                    $.ajax({
                        type: "POST",
                        url: "ajaxpagination.php",
                        data: {page_no : page},
                        success: function (data) {
                            $("#table-data").html(data);
                        }
                    });
                }
                loadPagination();

                // pagination code
                $(document).on("click","#pagination a", function(e){ // pagination ma jetla a tag hse ena mate
                    e.preventDefault();
                    var page_id = $(this).attr("id");

                loadPagination(page_id);

                })
            });
            </script>

        </div>
    </main>
</body>

</html>