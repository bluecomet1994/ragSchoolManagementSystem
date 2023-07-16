<?php
session_start();
if (!isset($_SESSION["student_logged_in_session"])) {
    header('Location: /webAssignment/student/studentlogin/studentlogin.php');
}
require_once "../../student/studentQuery/studentQuery.php";
$studentmail = $_SESSION["student_logged_in_session"];
$query = new StudentQuery();
$getstudentdetails = $query->getstudentDetails($studentmail);

$student_id = $getstudentdetails[0][0];
$studentgrade =  $getstudentdetails[0][8];
$studentfname =  $getstudentdetails[0][1];
$studentlname =  $getstudentdetails[0][2];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/bootstrap.css">
    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/student.css">
    <title>Update Profile</title>
</head>

<body>
    <div class="container-fluid">
        <div class="col-12 ">
            <div class="row">
                <div class="col-4 ">
                    <span>Go Back to Main Panel</span> <a href="../../student/studentpanel/studentpanel.php" class="text-decoration-none">student Panel</a>
                </div>
            </div>
        </div>
        <div class="mx-0 col-12 d-none uploadpropicdiv" id="uploadpropicdiv">
            <div class="row">
                <div class=" col-12">
                    <label  for="uploadpropic" class="ragFancyButton">Upload Propic</label>
                    <input onchange="uploadpropicdiv();" id="uploadpropic" type="file" class="d-none">
                    <?php
                    $checkpropic = $query->checkpropic($student_id);
                    if ($checkpropic) {
                    ?>
                        <button onclick="removepropic();" class="ragFancyButtonRed">Remove Propic</button>
                    <?php
                    }
                    ?>


                    <button onclick="uploadpropicdiv();">Cancel</button>
                </div>
            </div>
            <?php

            ?>
        </div>
        <div class="col-12 pt-3 pb-5">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <?php

                        $querylesson = $query->getlessonnotes($studentgrade);
                        ?>
                        <div class="ps-4 col-lg-4 col-12 pb-4"><span><?php echo $studentfname . " " . $studentlname; ?></span></div>
                    </div>
                </div>

                <div class="col-12 " id="studentUpdateDiv">
                    <div class="row">
                        <div class="col-12 text-center ">
                            <span class="fw-bold text-danger" id="upAddstudenterrormessage"></span>
                        </div>
                        <div class="col-6">
                            <span>student_first_name</span>
                            <input type="text" id="upstudentfname" value="<?php echo $studentfname; ?>" class="w-100 px-2 py-2">
                        </div>
                        <div class="col-6">
                            <span>student_last_name</span>
                            <input type="text" id="upstudentlname" value="<?php echo $studentlname; ?>" class="w-100 px-2 py-2">
                        </div>
                        <div class="col-6">
                            <span>student_email</span>
                            <input type="text" disabled readonly value="<?php echo $studentmail; ?>" class="w-100 px-2 py-2">
                        </div>

                        <div class="col-6 pt-4">
                            <button onclick="uploadpropicdiv();" class="w-100 px-2 py-2 ragFancyButton">Upload Propic</button>

                        </div>



                        <div class="col-12 text-center py-4">
                            <button onclick="upDatestudent();" class="px-2 py-2 w-50">Update Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="updateprofile.js"></script>
</body>

</html>