<?php
session_start();
if (!isset($_SESSION["teacher_logged_in_session"])) {
    exit();
} else {
?>

    <div class="row ">
        <div class="col-12 subjectNameHolderDiv">
            <div class="row">

                <?php
                require_once "../../teacher/teacherQuery/teacherQuery.php";
                $teachermail = $_SESSION["teacher_logged_in_session"];
                $query = new TeacherQuery();
                $getteacherdetails = $query->getTeacherDetails($teachermail);
                $teachersubjectid = $getteacherdetails[0][5];
                $teacherid = $getteacherdetails[0][0];

                $queryassignment = $query->getassignment($teacherid);
                $rowCount = $query->rowCount;
                for ($i = 0; $i < $rowCount; $i++) {
                    $assignmentSrc =  $queryassignment[$i][0];
                    $subjectid = $queryassignment[$i][3];
                    $gradeid = $queryassignment[$i][2];
                    $assignmentName = $queryassignment[$i][1];
                    $subjectName = $queryassignment[$i][8];
                    $gradeName = $queryassignment[$i][6];
                ?>



                    <div class="col-12  subjectDivs my-1 py-5">
                        <div class="row gy-5 ">
                            <div class="col-lg-6 col-md-2 col-12 py-2 py-md-1     text-start ">
                                <span class="px-5 py-3 bg-primary w-100">assignment Title <?php echo $assignmentName; ?></span>
                            </div>
                            <div class="col-lg-6 col-md-2 col-12 py-2 py-md-1   text-start ">
                                <span class="px-5 py-3 bg-primary w-100">Subject <?php echo $subjectName; ?></span>
                            </div>
                            <div class="col-lg-6 col-md-2 col-12 py-2 py-md-1   text-start ">
                                <span class="px-5 py-3 bg-primary w-100">Grade <?php echo $gradeName; ?> </span>
                            </div>

                            <div class="col-lg-6 col-md-2 col-12 py-2 py-md-1   text-start ">

                                <a class="px-5 py-3 bg-primary w-100 text-white" href="<?php echo $assignmentSrc ?>">View PDF</a>
                            </div>

                            <div class="col-lg-6 col-md-2 col-12 py-2 py-md-1   text-center">
                                <span style="cursor: pointer;" class="px-5 py-3 bg-primary" onclick="removetheassignment('<?php echo $teacherid?>','<?php echo $assignmentSrc?>');"  >Remove assignment Note </span>

                                  
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
?>