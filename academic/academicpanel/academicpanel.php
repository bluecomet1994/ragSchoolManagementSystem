<?php
session_start();
if (!isset($_SESSION["academic_logged_in_session"])) {
    header('Location: /webAssignment/academic/academiclogin/academiclogin.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/bootstrap.css">
    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/academic.css">
    <title>Academic Panel</title>
</head>

<body>
    <div class="container-fluid">
        <div class="col-12 py-5">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12 px-4  academicWorkOptions">
                            <div class="row gy-3">
                                <div class="col-6">
                                    <button onclick="addstudent();" class="py-2 px-3 fw-bold my-auto w-100">Add a Student</button>
                                </div>
                                <div class="col-6">
                                    <button onclick="viewresults();" class="py-2 px-3 fw-bold my-auto w-100">View Student assignments</button>
                                </div>
                                <div class="col-6">
                                    <button onclick="viewassignmentresults();" class="py-2 px-3 fw-bold my-auto w-100">View submitted answers </button>
                                </div>
                          
                                <div class="col-6">
                                    <button onclick=";" class="py-2 px-3 fw-bold my-auto w-100">Update profile</button>
                                </div>
                                <div class="col-6">
                                    <button onclick="academiclogout();" class="py-2 px-3 fw-bold my-auto w-100">Log Out</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="academicpanel.js"></script>
</body>

</html>