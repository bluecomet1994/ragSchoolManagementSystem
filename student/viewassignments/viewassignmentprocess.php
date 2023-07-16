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
                //to get the student assignemnt details using the student grade and student id
                $queryassignment = $query->getassignments($studentgrade,$studentid);

                //this following process is for differenciate the uploaded ones from the not uploaded ones
                $rowCount = $query->rowCount;
                $assignmentIDArrays_from_student = [];
                for ($i = 0; $i < $rowCount; $i++) {
                    $assignmentID =  $queryassignment[$i]['assignment_unique_code'];
                    $assignmentSrc =  $queryassignment[$i]['assignmentSrc'];

                    $assignmentName = $queryassignment[$i]['assignment_name'];

                    $assignmentIDArrays_from_student[$i] = $assignmentID;
                }


                $existingkey_in_student = [];



                $queryassignment = $query->getteacherassignments($studentgrade);
                $rowCount = $query->rowCount;
                $assignmentIDArrays_from_teacher = [];
                for ($i = 0; $i < $rowCount; $i++) {
                    $assignmentID =  $queryassignment[$i]['assignment_unique_code'];
                    $assignmentSrc =  $queryassignment[$i]['assignmentSrc'];
                    $assignmentName = $queryassignment[$i]['assignment_name'];
                    $assignmentSubjectName = $queryassignment[$i]['subject_name'];
                    $assignmentIDArrays_from_teacher[$i] = $assignmentID;
                    if (in_array($assignmentID, $assignmentIDArrays_from_student)) {
                        $imagesrc = "../../icons/correct.png";
                    } else {
                        $imagesrc = "../../icons/wrong.png";
                    }
                ?>
                    <div class="col-12  subjectDivs my-1 py-5">
                        <div class="row gy-5 ">
                            <div class=" col-lg-4 col-md-12 col-12 py-2 py-md-1  text-start ">
                                <span class="ragFancyButton px-5 py-3  w-100 text-white"> Title <?php echo $assignmentName; ?></span>
                            </div>
                            <div class=" col-lg-4 col-md-12 col-12 py-2 py-md-1 text-start ">
                                <span class="ragFancyButton px-5 py-3  w-100 text-white">Subject <?php echo $assignmentSubjectName; ?></span>
                            </div>
                            <div class=" col-lg-4 col-md-12 col-12 py-2 py-md-1   text-center ">
                                <div class="row">
                                    <div class="col-lg-9 col-12 text-start ">
                                        <a class="px-5 ragFancyButton py-3  w-100 text-white" href="<?php echo $assignmentSrc ?>">View PDF</a>
                                    </div>
                                    <div class="col-lg-3 col-12  text-start ">
                                        <img src="<?php echo $imagesrc; ?>" class="writewrongicons" alt="" srcset="">
                                    </div>
                                </div>

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