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
                //get the teacher details using the teacher logged in session variable
                $query = new TeacherQuery();
                $getteacherdetails = $query->getTeacherDetails($teachermail);
                $teachersubjectid = $getteacherdetails[0][5];
                $teacherid = $getteacherdetails[0][0];
                //using the teacher id show only the teachers lessons
                $querylesson = $query->getlessonnotes($teacherid);
                $rowCount = $query->rowCount;
                for ($i = 0; $i < $rowCount; $i++) {
                    $lessonSrc =  $querylesson[$i][0];
                    $subjectid = $querylesson[$i][3];
                    $gradeid = $querylesson[$i][2];
                    $lessonName = $querylesson[$i][1];
                    $subjectName = $querylesson[$i][8];
                    $gradeName = $querylesson[$i][6];
                ?>



                    <div class="col-12  subjectDivs my-1 py-5">
                        <div class="row gy-5 ">
                            <div class="col-lg-6 col-md-2 col-12 py-2 py-md-1     text-start ">
                                <span class="px-5 py-3 bg-primary w-100">Lesson Title <?php echo $lessonName; ?></span>
                            </div>
                            <div class="col-lg-4 col-md-2 col-12 py-2 py-md-1   text-start ">
                                <span class="px-5 py-3 bg-primary w-100">Subject <?php echo $subjectName; ?></span>
                            </div>
                            <div class="col-lg-4 col-md-2 col-12 py-2 py-md-1   text-start ">
                                <span class="px-5 py-3 bg-primary w-100">Grade <?php echo $gradeName; ?> </span>
                            </div>

                            <div class="col-lg-4 col-md-2 col-12 py-2 py-md-1   text-start ">

                                <a class="px-5 py-3 bg-primary w-100 text-white" href="<?php echo $lessonSrc ?>">View PDF</a>
                            </div>

                            <div class="col-lg-4 col-md-2 col-12 py-2 py-md-1   text-center">
                                <span style="cursor: pointer;" class="px-5 py-3 bg-primary" onclick="removetheLesson('<?php echo $teacherid?>','<?php echo $lessonSrc?>');"  >Remove Lesson Note </span>

                                  
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