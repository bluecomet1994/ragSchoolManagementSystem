<?php
session_start();
if (!isset($_SESSION["student_logged_in_session"])) {
    header('Location: /webAssignment/student/studentlogin/studentlogin.php');
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
    <link rel="stylesheet" href="../../style/student.css">
    <title>Document</title>
</head>

<body>


    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-12 pb-4">
                    <div class="row">
                        <div class="col-4 ">
                            <span>Go Back to Main Panel</span> <a href="../../student/studentpanel/studentpanel.php" class="text-decoration-none">student Panel</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <h4>View Assignments </h4>
                </div>
   
                
                <div class="col-10 offset-1 showassignments " id="showassignments">

                </div>
            </div>
        </div>
    </div>









    <script src="viewassignments.js"></script>
</body>

</html>