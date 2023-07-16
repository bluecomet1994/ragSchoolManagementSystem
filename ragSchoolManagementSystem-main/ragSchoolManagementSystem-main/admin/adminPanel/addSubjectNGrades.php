<?php
session_start();
if (!isset($_SESSION['AdminSession'])) {
    header('Location: /webAssignment/admin/adminLogin/login.php');
} else {
    $adminEmail = $_SESSION['AdminSession'];
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
    <link rel="stylesheet" href="../../style/admin.css">
    <title>Admin Panel</title>
</head>

<body>

    <div class="container-fluid">
        <div class="col-12 py-5">
            <div class="row">
                <div class="col-12 pb-4">
                    <div class="row">
                        <div class="col-4 ">
                           <span>Go Back to Admin Panel</span> <a href="../../admin/adminPanel/adminPanel.php" class="text-decoration-none">Admin Panel</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row gy-4">
                        <div class="col-12 col-md-7   AdminWorkOptions ">
                            <div class="row">
                                <div class="col-lg-12 col-12  ">
                                    <div class="row gy-3 py-2">
                                        <div class="col-7">
                                            <input id="subjectField" type="text" class="px-2 py-2 w-100">
                                        </div>
                                        <div class="col-5">
                                            <button onclick="addSubject();" class="py-2 px-3 fw-bold my-auto w-100">Add
                                                Subject</button>
                                        </div>
                                        <div class="col-7">
                                            <input id="gradeField" type="text" class="px-2 py-2 w-100">
                                        </div>
                                        <div class="col-5">
                                            <button onclick="addGrade();" class="py-2 px-3 fw-bold my-auto w-100">Add
                                                Grade</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 col-md-5 ">
                            <div class="row">
                                <div class="col-12 ">
                                    <div class="row  gy-3">
                                        <div class="col-10 offset-1  ShowSubjectNGradeNamesDiv ">

                                            <div class="row gy-3">
                                                <div class="col-6 pt-3">Subject List</div>
                                                <div id="subjectName" class="col-12 text-white">
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-10 offset-1  ShowSubjectNGradeNamesDiv ">

                                            <div class="row gy-3">
                                                <div class="col-6 pt-3">Grade List</div>
                                                <div id="gradeName" class="col-12 text-white">
                                                </div>
                                            </div>


                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="adminPanel.js"></script>
</body>

</html>