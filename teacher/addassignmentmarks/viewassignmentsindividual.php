<?php
session_start();
if (!isset($_SESSION["teacher_logged_in_session"])) {
    header('Location: /webAssignment/teacher/teacherlogin/teacherlogin.php');
}
if (!isset($_GET["X"])) {
    header('Location: /webAssignment/teacher/addassignmentmarks/addassignmentmarks.php');
}
require_once "../../properdatedifference/properdatedifference.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/bootstrap.css">
    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/teacher.css">
    <title>Document</title>
</head>

<body>


    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-12 pb-4">
                    <div class="row">
                        <div class="col-4 ">
                            <span>Go Back to Main Panel</span> <a href="../../teacher/teacherpanel/teacherpanel.php" class="text-decoration-none">Teacher Panel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <?php
            require_once "../../teacher/teacherQuery/teacherQuery.php";
            $teachermail = $_SESSION["teacher_logged_in_session"];
            $query = new TeacherQuery();
            $getteacherdetails = $query->getTeacherDetails($teachermail);
            $teachersubjectid = $getteacherdetails[0][5];
            $teacherid = $getteacherdetails[0][0];

            $studentid = $_GET["X"];
            require_once "../../student/studentQuery/studentQuery.php";
            $studentdetails = new StudentQuery();
            $getstudentgeneraldetails = $studentdetails->getstudentDetailsbyid($studentid);
            $studentfname = $getstudentgeneraldetails[0]['student_fname'];
            $studentid = $getstudentgeneraldetails[0]['student_id'];

            require_once "../../inputValidations/ValidateInputs.php";
            $validation = new ValidateInputs();

            ?>
            <div class="col-12 py-2">
                <div class="row">
                    <div class="col-lg-4 col-12 text-start px-5">
                        <span>Student Name : <?php echo $studentfname; ?></span>
                    </div>
                </div>
            </div>
            <?php
           
            $getindividualstudentassignments = $query->getstudentsubmissionsbystudentid($studentid, $teachersubjectid);
            $rowcount = count($getindividualstudentassignments);
            if ($rowcount >= 1 && $getindividualstudentassignments[0] !== "Nothing") {
                for ($i = 0; $i < $rowcount; $i++) {
                    $assignmentsrc = $getindividualstudentassignments[$i]['assignmentsrc'];
                    $assignmentname = $getindividualstudentassignments[$i]['assignment_name'];
                    $assignmentduedate = $getindividualstudentassignments[$i]['assignment_due_date'];
                    $assignmentuploadeddate = $getindividualstudentassignments[$i]['uploaded_date'];
                    $studentname = $getindividualstudentassignments[$i]['student_fname'];
                    $studentassignmentid = $getindividualstudentassignments[$i]['student_assignment_id'];
                    $studentassignmentresults =  $getindividualstudentassignments[$i]['student_results'];
                    $resultname = $getindividualstudentassignments[$i]['result_name'];
                    $datediffcal = new ProperDateDifference();
                    $getdatedifference = $datediffcal->datediff($assignmentuploadeddate, $assignmentduedate);

                    $ddfsign = $datediffcal->returndsign();
                   
            
            ?>
                    <div class="col-12  subjectDivs my-1 py-3">
                        <div class="row  gy-5 ">

                            <div class=" col-lg-3 col-md-12 col-12 py-1 py-md-1 text-center ">
                                <span style="font-size: 15px;" class="  py-3  w-100 text-white"><?php echo $assignmentname  ?></span>
                            </div>
                            <div class=" col-lg-2 col-md-12 col-12 py-1 py-md-1   text-center ">
                                <span style="font-size: 15px;" class="  py-3  w-100 text-white"><?php echo $assignmentuploadeddate  ?></span>

                            </div>
                            <div class=" col-lg-3 col-md-12 col-12 py-1 py-md-1   text-center ">
                                <div class="row">
                                    <div class=" col-12  ">
                                        <a href="<?php echo $assignmentsrc; ?>">View </a>

                                    </div>
                                </div>

                            </div>
                            <?php
                            if ($studentassignmentresults == 1) {
                            ?>
                                <div class=" col-lg-4 col-md-12 col-12 py-1 py-md-1   text-center ">
                                    <div class="row">
                                        <div class=" col-lg-6 col-12  py-2">
                                            <input id="assignmentmarks<?php echo $studentassignmentid;  ?>" type="number">

                                        </div>
                                        <div class=" col-lg-6 col-12  py-2">
                                            <button id="marksbutton" class="ragFancyButton" onclick="entermarks('<?php echo $studentassignmentid; ?>','<?php echo $studentid; ?>')">Enter Marks</button>

                                        </div>
                                    </div>

                                </div>

                            <?php
                            }else{
                                ?>
                                <div class=" col-lg-4 col-md-12 col-12 py-1 py-md-1   text-center ">
                                    <div class="row">
                                        <div class=" col-lg-6 col-12  py-2">
                                          <span><?php echo $resultname; ?></span>
                                        </div>
                                    </div>
                                </div>

                            <?php 
                            }
                            ?>

                        </div>
                    </div>
            <?php
                }
            } else {
                echo $getindividualstudentassignments[0];
            }
            ?>
        </div>
    </div>


    </div>









    <script src=" addassignmentmarks.js"></script>
</body>

</html>