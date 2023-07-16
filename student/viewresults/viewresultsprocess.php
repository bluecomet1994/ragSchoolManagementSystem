<?php
session_start();
if (!isset($_SESSION["student_logged_in_session"])) {
    exit();
} else {
    //to view the stuents assignment resutls
    require_once "../../student/studentQuery/studentQuery.php";
    $studentmail = $_SESSION["student_logged_in_session"];
    $query = new StudentQuery();

    $getstudentdetails = $query->getstudentDetails($studentmail);
    $studentsubjectid = $getstudentdetails[0][5];
    $student_id = $getstudentdetails[0][0];
    $studentgrade =  $getstudentdetails[0][8];
    $studentname =  $getstudentdetails[0][1];
    $querylesson = $query->getlessonnotes($studentgrade);



    $submittedstudentassignments =   $query->getsumittedstudentbystudentid($student_id);
    if ($submittedstudentassignments[0] == "Nothing") {
        echo "Your Results haven't marked or approved yet";
    } else {


        $rowCount = count($submittedstudentassignments);

?>
        <div class="col-10 offset-1  subjectDivs my-1 py-3 mt-4">
            <div class="row  gy-5 ">
                <div class=" col-lg-4 col-md-12 col-12 py-1 py-md-1   text-center ">
                    <span style="font-size: 15px;" class="  py-lg-3 py-1  w-100 text-white"><?php echo "subjectname" ?></span>
                </div>
                <div class=" col-lg-4 col-md-12 col-12 py-1 py-md-1 text-center ">
                    <span style="font-size: 15px;" class="  py-lg-3 py-1  w-100 text-white"><?php echo "assignmentname"  ?></span>
                </div>
                <div class=" col-lg-4 col-md-12 col-12 py-1 py-md-1 text-center ">
                    <span style="font-size: 15px;" class="  py-lg-3 py-1  w-100 text-white"><?php echo "assignmentresultname"  ?></span>
                </div>
            </div>
        </div>
        <?php
        for ($i = 0; $i < $rowCount; $i++) {
            $assignmentname =  $submittedstudentassignments[$i]['assignment_name'];
            $assignmentID =  $submittedstudentassignments[$i]['student_assignment_id'];
            $assignmentsubjectname = $submittedstudentassignments[$i]['subject_name'];
            $assignmentresultname = $submittedstudentassignments[$i]['result_name'];
        ?>
            <div class="col-10 offset-1  subjectDivs my-1 py-3 mt-4">
                <div class="row  gy-5 ">
                    <div class=" col-lg-4 col-md-12 col-12 py-1 py-md-1   text-center ">
                        <span style="font-size: 15px;" class="  py-lg-3 py-1  w-100 text-white"><?php echo $assignmentsubjectname ?></span>
                    </div>
                    <div class=" col-lg-4 col-md-12 col-12 py-1 py-md-1 text-center ">
                        <span style="font-size: 15px;" class="  py-lg-3 py-1  w-100 text-white"><?php echo $assignmentname  ?></span>
                    </div>
                    <div class=" col-lg-4 col-md-12 col-12 py-1 py-md-1 text-center ">
                        <span style="font-size: 15px;" class="  py-lg-3 py-1  w-100 text-white"><?php echo $assignmentresultname  ?></span>
                    </div>



                </div>
            </div>
<?php
        }
    }
}
