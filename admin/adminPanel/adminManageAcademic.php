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
    <title>Admin Manage Academics</title>
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
                        <div class="col-12    AdminWorkOptions ">
                            <div class="row">
                                <div class="col-lg-12 col-12  ">
                                    <div class="row gy-3 py-2">
                                        <div class="col-6">
                                            <button onclick="showAddacademicDiv();" class="py-2 px-lg-2 px-1 fw-bold my-auto w-100">Add a academic</button>
                                        </div>


                                        <div class="col-6">
                                            <button onclick="showSendMailacademicDiv();" class="py-2 px-lg-2 px-1 fw-bold my-auto w-100">Invite academic</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12  py-3">
                                    <div class="row gy-3 py-2">
                                        <div class="col-12 d-none" id="academicAddDiv">
                                            <div class="row">
                                                <div class="col-12 text-center ">
                                                    <span class="fw-bold text-danger" id="addacademicerrormessage"></span>
                                                </div>
                                                <div class="col-6">
                                                    <span>academic_first_name</span>
                                                    <input type="text" id="academicfname" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>academic_last_name</span>
                                                    <input type="text" id="academiclname" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>academic_email</span>
                                                    <input type="text" id="academicemail" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>academic_age</span>
                                                    <input type="date" id="academicage" class="w-100 px-2 py-2">
                                                </div>
                                
                                                <div class="col-6">
                                                    <span>academic_gender</span>

                                                    <select id="academicgender" class="w-100 px-2 py-2">
                                                        <?php
                                                        require_once "../../admin/adminPanel/AdminQuery.php";
                                                        $query = new AdminQuery();
                                                        $queryGender = $query->getGender();
                                                        $rowCount = $query->rowCount;
                                                        for ($i = 0; $i < $rowCount; $i++) {
                                                            $genderName = $queryGender[$i][1];
                                                            $genderID = $queryGender[$i][0];
                                                        ?>
                                                            <option class="py-2" value="<?php echo $genderID ?>">
                                                                <?php echo $genderName; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>


                                                    </select>
                                                </div>

                                                <div class="col-12 text-center py-4">
                                                    <button onclick="addacademic();" class="px-2 py-2 w-50">Add</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-none" id="academicUpdateDiv">
                                            <div class="row">
                                                <div class="col-12 text-center ">
                                                    <span class="fw-bold text-danger" id="upAddacademicerrormessage"></span>
                                                </div>
                                                <div class="col-6">
                                                    <span>academic_first_name</span>
                                                    <input type="text" id="upacademicfname" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>academic_last_name</span>
                                                    <input type="text" id="upacademiclname" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>academic_email</span>
                                                    <input type="text" id="upacademicemail" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>academic_age</span>
                                                    <input type="date" id="upacademicage" class="w-100 px-2 py-2">
                                                </div>
                                           
                                                <div class="col-6">
                                                    <span>academic_gender</span>

                                                    <select id="upacademicgender" class="w-100 px-2 py-2">
                                                        <?php
                                                        require_once "../../admin/adminPanel/AdminQuery.php";
                                                        $query = new AdminQuery();
                                                        $queryGender = $query->getGender();
                                                        $rowCount = $query->rowCount;
                                                        for ($i = 0; $i < $rowCount; $i++) {
                                                            $genderName = $queryGender[$i][1];
                                                            $genderID = $queryGender[$i][0];
                                                        ?>
                                                            <option class="py-2" value="<?php echo $genderID ?>">
                                                                <?php echo $genderName; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>


                                                    </select>
                                                </div>

                                                <div class="col-12 text-center py-4">
                                                    <button onclick="upDateacademic();" class="px-2 py-2 w-50">update</button>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-12 d-none" id="academicSendEmailDiv">
                                            <div class="row">
                                                <div class="col-12 px-5 ">
                                                    <div class="row  gy-3">
                                                        <div class="col-12  ShowSubjectNGradeNamesDiv ">
                                                            <div class="row gy-3">
                                                                <div class="col-6 pt-3 px-4">Send Email List</div>
                                                                <div id="academicSendEmailDivInnerDiv" class="col-12 px-4 text-white">
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
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 px-5">
                                    <div class="row  ">
                                        <div id="ShowSubjectNGradeNamesDiv" class="col-12  ShowSubjectNGradeNamesDiv ">
                                            <div class="row gy-3">
                                                <div class="col-6 pt-3 px-4">academics List</div>
                                                <div id="academicsList" class="col-12 px-4 text-white">
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
    <script src="adminManageAcademic.js"></script>
</body>

</html>