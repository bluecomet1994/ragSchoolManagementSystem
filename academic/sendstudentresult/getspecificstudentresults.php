<?php
session_start();
if (!isset($_SESSION["academic_logged_in_session"])) {
    exit();
} else {
    if (isset($_POST["student_id"])) {
        //receive the student_id via post method
        $student_id = $_POST["student_id"];

        require_once "../../inputValidations/ValidateInputs.php";
        require_once "../../academic/studentQuery/StudentQuery.php";
        //validation part
        $validation = new ValidateInputs();
        $validstudent_id = $validation->intIDvalid($student_id);
        if ($validstudent_id) {
            $studentQuery = new StudentQuery();
            //check the student_assignment table if the student id is there there in any
            //of the rows if its there return those rows
            $submittedstudentassignments = $studentQuery->getsumittedstudentbystudentid($student_id);

            $rowCount = count($submittedstudentassignments);
?>
            <div class="col-10 offset-1  subjectDivs my-1 py-3 mt-4">
                <div class="row  gy-5 ">
                    <div class=" col-lg-2 col-md-12 col-12 py-1 py-md-1   text-center ">
                        <span style="font-size: 15px;" class="  py-lg-3 py-1  w-100 text-white"><?php echo "subjectname" ?></span>
                    </div>
                    <div class=" col-lg-3 col-md-12 col-12 py-1 py-md-1 text-center ">
                        <span style="font-size: 15px;" class="  py-lg-3 py-1  w-100 text-white"><?php echo "assignmentname"  ?></span>
                    </div>
                    <div class=" col-lg-3 col-md-12 col-12 py-1 py-md-1 text-center ">
                        <span style="font-size: 15px;" class="  py-lg-3 py-1  w-100 text-white"><?php echo "assignmentresultname"  ?></span>
                    </div>
                    <div class=" col-lg-3 col-md-12 col-12 py-1 py-md-1 text-center ">
                        <span class="  w-100 text-white">Action</span>
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
                        <div class=" col-lg-2 col-md-12 col-12 py-1 py-md-1   text-center ">
                            <span style="font-size: 15px;" class="  py-lg-3 py-1  w-100 text-white"><?php echo $assignmentsubjectname ?></span>
                        </div>
                        <div class=" col-lg-3 col-md-12 col-12 py-1 py-md-1 text-center ">
                            <span style="font-size: 15px;" class="  py-lg-3 py-1  w-100 text-white"><?php echo $assignmentname  ?></span>
                        </div>
                        <div class=" col-lg-3 col-md-12 col-12 py-1 py-md-1 text-center ">
                            <span style="font-size: 15px;" class="  py-lg-3 py-1  w-100 text-white"><?php echo $assignmentresultname  ?></span>
                        </div>
                        <div class=" col-lg-3 col-md-12 col-12 py-1 py-md-1 text-center ">
                            <button onclick="approveresult(<?php echo $assignmentID; ?>);" class=" ragFancyButton w-100 text-white">Approve results to student</button>
                        </div>


                    </div>
                </div>
<?php
            }
        }
    }
}
