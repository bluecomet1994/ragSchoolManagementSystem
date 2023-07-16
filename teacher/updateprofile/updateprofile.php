<?php
session_start();
if (!isset($_SESSION["teacher_logged_in_session"])) {
    header('Location: /webAssignment/teacher/teacherlogin/teacherlogin.php');
}
require_once "../../teacher/teacherQuery/teacherQuery.php";
$teachermail = $_SESSION["teacher_logged_in_session"];
$query = new TeacherQuery();
$getteacherdetails = $query->getteacherDetails($teachermail);

$teacher_id = $getteacherdetails[0][0];
$teachergrade =  $getteacherdetails[0][8];
$teacherfname =  $getteacherdetails[0][1];
$teacherlname =  $getteacherdetails[0][2];
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
    <title>Update Profile</title>
</head>

<body>
    <div class="container-fluid">
        <div class="col-12 ">
            <div class="row">
                <div class="col-4 ">
                    <span>Go Back to Main Panel</span> <a href="../../teacher/teacherpanel/teacherpanel.php" class="text-decoration-none">teacher Panel</a>
                </div>
            </div>
        </div>
        <div class="mx-0 col-12 d-none uploadpropicdiv" id="uploadpropicdiv">
            <div class="row">
                <div class=" col-12">
                    <label on="uploadpropicdiv();" for="uploadpropic" class="ragFancyButton">Upload Propic</label>
                    <input onchange="uploadpropicdiv();" id="uploadpropic" type="file" class="d-none">
                    <?php
                    $checkpropic = $query->checkpropic($teacher_id);
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

                        $querylesson = $query->getlessonnotes($teachergrade);
                        ?>
                        <div class="ps-4 col-lg-4 col-12 pb-4"><span><?php echo $teacherfname . " " . $teacherlname; ?></span></div>
                    </div>
                </div>

                <div class="col-12 " id="teacherUpdateDiv">
                    <div class="row">
                        <div class="col-12 text-center ">
                            <span class="fw-bold text-danger" id="upAddteachererrormessage"></span>
                        </div>
                        <div class="col-6">
                            <span>teacher_first_name</span>
                            <input type="text" id="upteacherfname" value="<?php echo $teacherfname; ?>" class="w-100 px-2 py-2">
                        </div>
                        <div class="col-6">
                            <span>teacher_last_name</span>
                            <input type="text" id="upteacherlname" value="<?php echo $teacherlname; ?>" class="w-100 px-2 py-2">
                        </div>
                        <div class="col-6">
                            <span>teacher_email</span>
                            <input type="text" disabled readonly value="<?php echo $teachermail; ?>" class="w-100 px-2 py-2">
                        </div>

                        <div class="col-6 pt-4">
                            <button onclick="uploadpropicdiv();" class="w-100 px-2 py-2 ragFancyButton">Upload Propic</button>

                        </div>



                        <div class="col-12 text-center py-4">
                            <button onclick="upDateteacher();" class="px-2 py-2 w-50">Update Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="updateprofile.js"></script>
</body>

</html>