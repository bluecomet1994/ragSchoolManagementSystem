<?php
session_start();
if (!isset($_SESSION["teacher_logged_in_session"])) {
    header('Location: /webAssignment/teacher/teacherlogin/teacherlogin.php');
}
$email= $_SESSION["teacher_logged_in_session"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/bootstrap.css">
    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/teacher.css">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="col-12 py-5">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12 px-4  AdminWorkOptions">
                            <div class="row gy-3">
                                <div class="col-12 text-center">
                                    <?php
                                    require_once "../../teacher/teacherQuery/teacherQuery.php";
                                    $query = new TeacherQuery();
                                    $getTeacherSubject = $query->getteachersubject($email);
                                    $subjectName = $getTeacherSubject[0][1];
                                    ?>
                                    <h5 class="py-2 px-3 fw-bold my-auto w-100">You are currently teaching <b><?php echo $subjectName;?></b></h5>
                                </div>
                                <div class="col-6">
                                    <button onclick="goLessonNotes();" class="py-2 px-3 fw-bold my-auto w-100">Add Lesson Notes</button>
                                </div>
                                <div class="col-6">
                                    <button onclick="goAssignments();" class="py-2 px-3 fw-bold my-auto w-100">Add new assignments</button>
                                </div>
                                <div class="col-6">
                                    <button  class="py-2 px-3 fw-bold my-auto w-100">View submitted answers </button>
                                </div>
                                <div class="col-6">
                                    <button onclick="addassignmentmarks();" class="py-2 px-3 fw-bold my-auto w-100">Add assignment marks</button>
                                </div>
                                <div class="col-6">
                                    <button onclick="updateprofile();" class="py-2 px-3 fw-bold my-auto w-100">Update profile</button>
                                </div>
                                <div class="col-6">
                                    <button onclick="logout();" class="py-2 px-3 fw-bold my-auto w-100">Log Out</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="teacherpanel.js"></script>
</body>

</html>