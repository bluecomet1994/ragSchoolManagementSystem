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
    <title>Add student</title>
</head>

<body>

    <div class="container-fluid">
        <div class="col-12 py-5">
            <div class="row">
                <div class="col-12 pb-4">
                    <div class="row">
                        <div class="col-4 ">
                            <span>Go Back to Academic Panel</span> <a href="../../academic/academicPanel/academicPanel.php" class="text-decoration-none">academic Panel</a>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row gy-4">
                        <div class="col-12    academicWorkOptions ">
                            <div class="row">
                                <div class="col-lg-12 col-12  ">
                                    <div class="row gy-3 py-2">
                                        <div class="col-lg-3 col-md-5 col-5 ">
                                            <button onclick="showAddstudentDiv();" class="py-2 px-lg-2 px-1 fw-bold my-auto w-100">Add a student</button>

                                        </div>



                                    </div>
                                </div>
                                <div class="col-lg-12 col-12  py-3">
                                    <div class="row gy-3 py-2">
                                        <div class="col-12 d-none" id="studentAddDiv">
                                            <div class="row">
                                                <div class="col-12 text-center ">
                                                    <span class="fw-bold text-danger" id="addstudenterrormessage"></span>
                                                </div>
                                                <div class="col-6">
                                                    <span>student_first_name</span>
                                                    <input type="text" id="studentfname" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>student_last_name</span>
                                                    <input type="text" id="studentlname" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>student_email</span>
                                                    <input type="text" id="studentemail" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>student_age</span>
                                                    <input type="date" id="studentage" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>student_grade</span>
                                                    <select id="studentgrade" class="w-100 px-2 py-2">
                                                        <?php
                                                        require_once "../../academic/academicQuery/academicQuery.php";
                                                        $query = new AcademicQuery();
                                                        $queryGrades = $query->getGrades();
                                                        $rowCount = $query->rowCount;
                                                        for ($i = 0; $i < $rowCount; $i++) {
                                                            $gradeName = $queryGrades[$i][1];
                                                            $gradeID = $queryGrades[$i][0];
                                                        ?>
                                                            <option class="py-2 bg-white" value="<?php echo $gradeID ?>">
                                                                <?php echo $gradeName; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <span>student_due_date</span>
                                                    <input type="date" id="duedate" class="w-100 px-2 py-2">
                                                </div>

                                                <div class="col-6">
                                                    <span>student_gender</span>

                                                    <select id="studentgender" class="w-100 px-2 py-2">
                                                        <?php
                                                        require_once "../../academic/academicQuery/academicQuery.php";
                                                        $query = new AcademicQuery();
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
                                                    <button onclick="addstudent();" class="px-2 py-2 w-50">Add</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-none" id="studentUpdateDiv">
                                            <div class="row">
                                                <div class="col-12 text-center ">
                                                    <span class="fw-bold text-danger" id="upAddstudenterrormessage"></span>
                                                </div>
                                                <div class="col-6">
                                                    <span>student_first_name</span>
                                                    <input type="text" id="upstudentfname" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>student_last_name</span>
                                                    <input type="text" id="upstudentlname" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>student_email</span>
                                                    <input type="text" id="upstudentemail" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>student_age</span>
                                                    <input type="date" placeholder="yyyy-mm-dd" id="upstudentage" class="w-100 px-2 py-2">
                                                </div>
                                                <div class="col-6">
                                                    <span>student_due_date</span>
                                                    <input type="date" id="upstudentduedate" class="w-100 px-2 py-2">
                                                </div>

                                                <div class="col-6">
                                                    <span>student_gender</span>

                                                    <select id="upstudentgender" class="w-100 px-2 py-2">
                                                        <?php
                                                        require_once "../../academic/academicQuery/academicQuery.php";
                                                        $query = new AcademicQuery();
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
                                                    <button onclick="upDatestudent();" class="px-2 py-2 w-50">update</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-none" id="studentSendEmailDiv">
                                            <div class="row">
                                                <div class="col-12 px-5 ">
                                                    <div class="row  gy-3">
                                                        <div class="col-12  ShowSubjectNGradeNamesDiv ">
                                                            <div class="row gy-3">
                                                                <div class="col-6 pt-3 px-4">Send Email List</div>

                                                                <div id="studentSendEmailDivInnerDiv" class="col-12 px-4 text-white">
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
                                                <div class="col-6 pt-3 px-4 my-auto">students List</div>
                                                <div class="col-4 offset-1 pt-3 px-4"> <span>select_grade</span>

                                                    <select onchange="showstudents();" id="studentgradeselectTag" class="w-100 px-2 py-2">
                                                        <option class="py-1" value="">
                                                            Show All
                                                        </option>
                                                        <?php
                                                        require_once "../../admin/adminPanel/AdminQuery.php";
                                                        $query = new AdminQuery();
                                                        $queryGender = $query->getGrades();
                                                        $rowCount = $query->rowCount;
                                                        for ($i = 0; $i < $rowCount; $i++) {
                                                            $genderName = $queryGender[$i][1];
                                                            $genderID = $queryGender[$i][0];
                                                        ?>
                                                            <option class="py-1" value="<?php echo $genderID ?>">
                                                                <?php echo $genderName; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>


                                                    </select>
                                                </div>
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
    <script src="addstudent.js"></script>
</body>

</html>