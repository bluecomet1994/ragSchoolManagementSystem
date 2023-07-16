<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    header('Location: /webAssignment/admin/adminLogin/login.php');
} else {
    $adminEmail = $_SESSION["AdminSession"];
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
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12 px-4  AdminWorkOptions">
                            <div class="row gy-3">
                                <div class="col-6">
                                    <button onclick="manageTeachersPage();" class="py-2 px-3 fw-bold my-auto w-100">Manage Teachers</button>
                                </div>
                                <div class="col-6">
                                    <button class="py-2 px-3 fw-bold my-auto w-100">Invite Teachers</button>
                                </div>
                                <div class="col-6">
                                    <button  onclick="manageAcademicPage();" class="py-2 px-3 fw-bold my-auto w-100">Manage Academic</button>
                                </div>
                                <div class="col-6">
                                    <button class="py-2 px-3 fw-bold my-auto w-100">Invite Academic</button>
                                </div>       <div class="col-6">
                                    <button onclick="manageStudentPage();" class="py-2 px-3 fw-bold my-auto w-100">Manage Students</button>
                                </div>
                                <div class="col-6">
                                    <button class="py-2 px-3 fw-bold my-auto w-100">Check Results</button>
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