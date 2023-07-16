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
                        <div class="col-12    AdminWorkOptions ">
                            <div class="row">
                                <div class="col-lg-12 col-12  ">
                                    <div class="row gy-3 py-2">
                                        <div class="col-6">
                                            <button onclick="showAddTeacherDiv();" class="py-2 px-lg-2 px-1 fw-bold my-auto w-100">Add a Teacher</button>
                                        </div>


                                        <div class="col-6">
                                            <button onclick="showSendMailTeacherDiv();" class="py-2 px-lg-2 px-1 fw-bold my-auto w-100">Invite Teacher</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-12  py-3">
                                    <div class="row gy-3 py-2">
                                        <div class="col-12 d-none" id="teacherAddDiv">
                                            <div class="row">
                                                <div class="col-12 text-center ">
                                                    <span class="fw-bold text-danger" id="addteachererrormessage"></span>
                                                </div>
                                                <div class="col-6">
                                                    <span>teacher_first_name</span>
                                                    <input type="text" id="teacherfname" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>teacher_last_name</span>
                                                    <input type="text" id="teacherlname" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>teacher_email</span>
                                                    <input type="text" id="teacheremail" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>teacher_age</span>
                                                    <input type="date" id="teacherage" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>teacher_grade</span>

                                                    <select id="teachergrade" class="w-100 px-2 py-2">
                                                        <?php
                                                        require_once "../../admin/adminPanel/AdminQuery.php";
                                                        $query = new AdminQuery();
                                                        $queryGrades = $query->getGrades();
                                                        $rowCount = $query->rowCount;
                                                        for ($i = 0; $i < $rowCount; $i++) {
                                                            $gradeName = $queryGrades[$i][1];
                                                            $gradeID = $queryGrades[$i][0];
                                                        ?>
                                                            <option class="py-2" value="<?php echo $gradeID ?>">
                                                                <?php echo $gradeName; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>


                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <span>teacher_subject</span>
                                                    <select id="teachersubject" class="w-100 px-2 py-2">
                                                        <?php
                                                        require_once "../../admin/adminPanel/AdminQuery.php";
                                                        $query = new AdminQuery();
                                                        $querySubjects = $query->getSubjects();
                                                        $rowCount = $query->rowCount;
                                                        for ($i = 0; $i < $rowCount; $i++) {
                                                            $subjectName = $querySubjects[$i][1];
                                                            $subjectID = $querySubjects[$i][0];
                                                        ?>
                                                            <option class="py-2" value="<?php echo $subjectID ?>">
                                                                <?php echo $subjectName; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                                <div class="col-6">
                                                    <span>teacher_gender</span>

                                                    <select id="teachergender" class="w-100 px-2 py-2">
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
                                                    <button onclick="addTeacher();" class="px-2 py-2 w-50">Add</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-none" id="teacherUpdateDiv">
                                            <div class="row">
                                                <div class="col-12 text-center ">
                                                    <span class="fw-bold text-danger" id="upAddteachererrormessage"></span>
                                                </div>
                                                <div class="col-6">
                                                    <span>teacher_first_name</span>
                                                    <input type="text" id="upTeacherfname" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>teacher_last_name</span>
                                                    <input type="text" id="upTeacherlname" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>teacher_email</span>
                                                    <input type="text" id="upTeacheremail" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>teacher_age</span>
                                                    <input type="date" placeholder="yyyy-mm-dd" id="upTeacherage" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>teacher_grade</span>

                                                    <select id="upTeachergrade" class="w-100 px-2 py-2">
                                                        <?php
                                                        require_once "../../admin/adminPanel/AdminQuery.php";
                                                        $query = new AdminQuery();
                                                        $queryGrades = $query->getGrades();
                                                        $rowCount = $query->rowCount;
                                                        for ($i = 0; $i < $rowCount; $i++) {
                                                            $gradeName = $queryGrades[$i][1];
                                                            $gradeID = $queryGrades[$i][0];
                                                        ?>
                                                            <option class="py-2" value="<?php echo $gradeID ?>">
                                                                <?php echo $gradeName; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>


                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <span>teacher_subject</span>
                                                    <select id="upTeachersubject" class="w-100 px-2 py-2">
                                                        <?php
                                                        require_once "../../admin/adminPanel/AdminQuery.php";
                                                        $query = new AdminQuery();
                                                        $querySubjects = $query->getSubjects();
                                                        $rowCount = $query->rowCount;
                                                        for ($i = 0; $i < $rowCount; $i++) {
                                                            $subjectName = $querySubjects[$i][1];
                                                            $subjectID = $querySubjects[$i][0];
                                                        ?>
                                                            <option class="py-2" value="<?php echo $subjectID ?>">
                                                                <?php echo $subjectName; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                                <div class="col-6">
                                                    <span>teacher_gender</span>

                                                    <select id="upTeachergender" class="w-100 px-2 py-2">
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
                                                    <button onclick="upDateTeacher();" class="px-2 py-2 w-50">update</button>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-12 d-none" id="teacherSendEmailDiv">
                                            <div class="row">
                                                <div class="col-12 px-5 ">
                                                    <div class="row  gy-3">
                                                        <div class="col-12  ShowSubjectNGradeNamesDiv ">
                                                            <div class="row gy-3">
                                                                <div class="col-6 pt-3 px-4">Send Email List</div>
                                                                <div id="teacherSendEmailDivInnerDiv" class="col-12 px-4 text-white">
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
                                                <div class="col-6 pt-3 px-4">Teachers List</div>
                                                <div id="teachersList" class="col-12 px-4 text-white">
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
    <script src="admin.js"></script>
</body>

</html>