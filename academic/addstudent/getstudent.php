<?php
session_start();
if (!isset($_SESSION["academic_logged_in_session"])) {
    exit();
} else {

?>
    <div class="row ">
        <div class="col-12 subjectNameHolderDiv">
            <div class="row">

                <?php
                //search query to get all the students in the student table
                require_once "../../academic/studentQuery/studentQuery.php";
                $query = new StudentQuery();
                if (isset($_POST["grade_id"]) && !empty($_POST["grade_id"])) {
                    $queryStudent = $query->getstudentsbygrade($_POST["grade_id"]);
                } else {
                    $queryStudent = $query->getstudents();
                }
                $rowCount = $query->rowCount;
                for ($i = 0; $i < $rowCount; $i++) {
                    $studentID =  $queryStudent[$i][0];
                    $studentFName = $queryStudent[$i][1];
                    $studentLName = $queryStudent[$i][2];
                    $studentEmail = $queryStudent[$i]['student_email'];
                    $studentStatus = $queryStudent[$i][7];
                    $query2 = new StudentQuery();

                    $studentGradeQuery = $query2->getstudentgrade($studentID);
                    //print_r($studentGradeQuery); 
                    // print_r($studentGradeQuery);
                    $studentGrade = $studentGradeQuery[0]["grade_name"];

                    if ($studentStatus === 0) {
                ?>
                        <div style="font-size:14px;" class="col-12  subjectDivs my-1 py-2">
                            <div class="row">
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1  col-6 col-sm-6 col-md-2  text-start text-md-start">
                                    <span class=""><?php echo $studentFName; ?></span>
                                </div>
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-6 col-sm-6 col-md-2  text-start text-md-start">
                                    <span class=""><?php echo $studentLName; ?></span>
                                </div>
                                <div class="col-lg-1 py-2 py-md-1 py-lg-1 col-6 col-sm-6 col-md-2  text-start text-md-start">
                                    <span class=""><?php echo $studentGrade; ?></span>
                                </div>
                                <div class="col-lg-3 py-2 py-md-1 py-lg-1 col-12 col-sm-6 col-md-3 text-start text-md-start">

                                    <span class=""><?php echo $studentEmail; ?> </span>
                                </div>
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-sm-6 col-md-3   col-6 text-center">
                                    <button class="ragFancyButton" onclick="sendEmailtostudent('<?php echo $studentID ?>', '<?php echo $studentEmail ?>');">Send Email Link</button>
                                </div>
                                <div class="col-lg-1 py-2 py-md-1 py-lg-1 col-sm-6 col-md-1   col-6 text-center">
                                    <img src="../../icons/updateIcon.png" onclick="showUpdatestudentDiv('<?php echo $studentID; ?>','<?php echo $studentEmail; ?>');" class="updateIcon" alt="" srcset="">
                                </div>
                                <div class="col-lg-1 py-2 py-md-1 py-lg-1 col-sm-6 col-md-1   col-6 text-center">
                                    <button class="ragFancyButton" onclick="removeThestudent('<?php echo $studentID; ?>','<?php echo $studentEmail; ?>')">Unblock</button>

                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div style="font-size:14px;" class="col-12  subjectDivs my-1 py-2">
                            <div class="row">
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1  col-6 col-sm-6 col-md-2  text-start text-md-start">
                                    <span class=""><?php echo $studentFName; ?></span>
                                </div>
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-6 col-sm-6 col-md-2  text-start text-md-start">
                                    <span class=""><?php echo $studentLName; ?></span>
                                </div>
                                <div class="col-lg-1 py-2 py-md-1 py-lg-1 col-6 col-sm-6 col-md-2  text-start text-md-start">
                                    <span class=""><?php echo $studentGrade; ?></span>
                                </div>
                                <div class="col-lg-3 py-2 py-md-1 py-lg-1 col-12 col-sm-6 col-md-4 text-start text-md-start">

                                    <span class=""><?php echo $studentEmail; ?> </span>
                                </div>
                                <div class="col-lg-1 py-2 py-md-1 py-lg-1 col-sm-6 col-md-2   col-6 text-center">
                                </div>
                                <div class="col-lg-1 py-2 py-md-1 py-lg-1 col-sm-6 col-md-2   col-6 text-center">
                                    <img src="../../icons/updateIcon.png" onclick="showUpdatestudentDiv('<?php echo $studentID; ?>','<?php echo $studentEmail; ?>');" class="updateIcon" alt="" srcset="">
                                </div>
                                <div class="col-lg-1 py-2 py-md-1 py-lg-1 col-sm-6 col-md-2   col-6 text-center">

                                    <button class="ragFancyButton" onclick="removeThestudent('<?php echo $studentID; ?>','<?php echo $studentEmail; ?>')">block</button>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>




                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
?>