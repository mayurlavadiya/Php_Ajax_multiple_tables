<?php
    include("navbar.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"> -->
    </script>
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
    <script type="tetx/javascript" src="js/jquery.js"></script>
    <title>PHP AJAX MULTIPLE</title>
</head>

<body>

    <main class="container">
        <div class="bg-light p-5 rounded">
            <h1 class="text-center bg-warning">PHP AJAX MULTIPLE</h1>
            <table class="table" id="main" cellspacing="0">
                <tr>
                    <td id="table-load">
                        <button type="button" id="load-button" class="btn btn-primary">Click here for Preview</button>
                    </td>
                </tr>
            <tr>
                <td id="table-data">

                </td>
                </tr>
            </table>

            <script>
            $(document).ready(function() {
                $('#load-button').on("click", function(e) {
                    $.ajax({
                        url: "ajaxload.php",
                        type: "POST",
                        success: function(data) {
                            $("#table-data").html(data);
                        }
                    });
                });
                // table-load();

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

                                if (data == 1) {
                                    $(element).closest("tr").fadeOut();

                                    $("#success-message").html("Data Deleted succesfully !")
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
                    var studentId = $(this).data("id");
                    // alert(studentId);
                });              
                
            });
            </script>

        </div>
    </main>
</body>

</html>