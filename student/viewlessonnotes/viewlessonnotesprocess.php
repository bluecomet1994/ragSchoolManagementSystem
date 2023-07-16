<?php
session_start();
if (!isset($_SESSION["student_logged_in_session"])) {
    exit();
} else {
?>

    <div class="row ">
        <div class="col-12 subjectNameHolderDiv">
            <div class="row">

                <?php
                require_once "../../student/studentQuery/studentQuery.php";
                $studentmail = $_SESSION["student_logged_in_session"];
                $query = new StudentQuery();
               //get the student details from the student table using the logged in session email 
                $getstudentdetails = $query->getstudentDetails($studentmail);
                $studentsubjectid = $getstudentdetails[0][5];
                $studentid = $getstudentdetails[0][0];
                 $studentgrade =  $getstudentdetails[0][8];
                 //get the lesson notes according to the student grade
                $querylesson = $query->getlessonnotes( $studentgrade );
                $rowCount = $query->rowCount;
               
                for ($i = 0; $i < $rowCount; $i++) {
                    $lessonSrc =  $querylesson[$i]['lessonSrc'];
                  
                    $lessonName = $querylesson[$i]['lesson_name'];
                    $subjectName = $querylesson[$i]['subject_name'];
                    
                ?>



                    <div class="col-12  subjectDivs my-1 py-5">
                        <div class="row gy-5 ">
                            <div class="col-lg-12  col-md-2 col-12 py-2 py-md-1     text-start ">
                                <span class="ragFancyButton px-5  py-3  w-100">Lesson Title <?php echo $lessonName; ?></span>
                            </div>
                            <div class="col-lg-4 col-md-2 col-12 py-2 py-md-1   text-start ">
                                <span class="ragFancyButton px-5 py-3  w-100">Subject <?php echo $subjectName; ?></span>
                            </div>
                   

                            <div class="col-lg-4 col-md-2 col-12 py-2 py-md-1   text-start ">

                                <a class="ragFancyButton px-5 py-3  w-100 text-white" href="<?php echo $lessonSrc ?>">View PDF</a>
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