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
    <title>Admin Manage Students</title>
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
                <div class="col-12 d-none d-flex justify-content-center flex-column align-items-center showRemoveWarningDiv" id="showRemoveWarningDiv">

                    <div class="">
                        <h4>Are you sure on blocking this student?</h4>
                    </div>
                    <div class="py-2">
                        <span id="studentfname"></span>
                    </div>
                    <div class="py-2">
                        <span id="studentemail"></span>
                    </div>
                    <div class="row gy-3">
                        <div class="col-12">
                            <button id="removeYesButton" class="removeYesButton py-2">Yes</button>
                        </div>
                        <div class="col-12"><button id="removeNoButton"  class="removeNoButton py-2">Cancel</button></div>



                    </div>

                </div>
                <div class="col-12">
                    <div class="row gy-4">

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 px-5">
                                    <div class="row  ">
                                        <div id="ShowSubjectNGradeNamesDiv" class="col-12  ShowSubjectNGradeNamesDiv ">
                                            <div class="row gy-3">
                                                <div class="col-6 pt-3 px-4">students List</div>
                                                <div id="studentsList" class="col-12 px-4 text-white">
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
    <script src="adminManagestudent.js"></script>
</body>

</html>