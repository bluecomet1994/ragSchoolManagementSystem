<?php
session_start();
if (isset($_SESSION["teacher_logged_in_session"])) {

    require_once "../../teacher/teacherQuery/teacherQuery.php";
    $teachermail = $_SESSION["teacher_logged_in_session"];
    $query = new TeacherQuery();
    //get teacher details from the teacher table
    $getteacherdetails = $query->getTeacherDetails($teachermail);
    $teachersubjectid = $getteacherdetails[0][5];
    $teacherid = $getteacherdetails[0][0];

?>
    <div>
        <?php
        if (isset($_POST["grade_id"])) {
            $gradeid = $_POST["grade_id"];
            require_once "../../inputValidations/ValidateInputs.php";
            //do validations for the input that has been received from the client side
            $validation = new ValidateInputs();
            $gradevali = $validation->gradeVali($gradeid);
            if ($gradevali) {
                //if the grade validation is success now here we write a query to get the submitted students
                $getsubmittedstudents = $query->getsubmittedstudentbygrade($gradeid, $teachersubjectid);
                $sumittedstudentrowcount = count($getsubmittedstudents);
                //this following mechanism is for differenciate the submitted students from the unsubmitted students
                $submittedstudentArray = [];
                $submittedstudentsrc = [];

                if ($getsubmittedstudents[0] !== "Nothing" && $sumittedstudentrowcount >= 1) {
                    for ($i = 0; $i < $sumittedstudentrowcount; $i++) {
                        $submittedstudentid = $getsubmittedstudents[$i][0];
                        $submittedstudentsrc[$i] = (array("0" => $getsubmittedstudents[$i][18], "1" => $submittedstudentid));

                        $submittedstudentArray[$i] = $submittedstudentid;
                    }
                }

                $getstudents = $query->getstudentsbygrade($gradeid);
                $rowcount = count($getstudents);
                $eachstudent = [];
                if ($rowcount >= 1 && $getstudents[0] !== "Nothing") {
                    for ($i = 0; $i < $rowcount; $i++) {

                        if (in_array($getstudents[$i][0], $submittedstudentArray)) {
                            $imagesrc = "../../icons/correct.png";
        ?>
                            <div class="col-12  subjectDivs my-1 py-3">
                                <div class="row gy-5 ">

                                    <div class="ragFancyButton col-lg-3 col-md-12 col-12 py-lg-2 py-1 py-md-1 text-center ">
                                        <span style="font-size: 15px;" class="  py-lg-3 py-2   text-white"><?php echo $getstudents[$i][1]; ?></span>
                                    </div>
                                    <div class="ragFancyButton col-lg-5 col-md-12 col-12 py-lg-2 py-1 py-md-1   text-center ">
                                        <div class="row">
                                            <div class=" col-12  ">
                                                <a style="font-size: 15px;" class="  py-lg-3 py-2 text-decoration-none  text-white" "><?php echo $getstudents[$i][5] ?></a>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="ragFancyButton col-lg-4 col-md-12 col-12 py-lg-2 py-1 py-md-1   text-center ">
                                        <div class="row">
                                            <div class=" col-12  ">
                                                <span  onclick="viewassignmentsindividual(<?php echo $getstudents[$i][0];  ?>);" style="font-size: 15px;cursor:pointer;" class="  py-lg-3 py-2  w-100 text-white">View </span>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php


                        } else {
                            $imagesrc = "../../icons/wrong.png";
                        ?>
                            <div class="col-12  subjectDivs my-1 py-3">
                                <div class="row  gy-5 ">

                                    <div class=" col-lg-3 col-md-12 col-12 py-2 py-md-1 text-center ">
                                        <span style="font-size: 15px;" class="  py-3  w-100 text-white"><?php echo $getstudents[$i][1]; ?></span>
                                    </div>
                                    <div class=" col-lg-5 col-md-12 col-12 py-2 py-md-1   text-center ">
                                        <div class="row">
                                            <div class=" col-12  ">
                                                <a style="font-size: 15px;" class="  py-3  w-100 text-white" href=""><?php echo $getstudents[$i][5] ?></a>
                                            </div>
                                        </div>

                                    </div>
                                    <div class=" col-lg-4 col-md-12 col-12 py-2 py-md-1   text-center ">
                                        <div class="row">
                                            <div class=" col-12  ">
                                                <span   style="font-size: 15px;cursor:pointer;" class="danger  py-3  w-100 text-white">No Uploads</span>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php


                        }
                        ?>

    <?php
                    }
                }
            }
        }
    }
    ?>
    </div>