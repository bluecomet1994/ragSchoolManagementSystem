<?php
session_start();
if (!isset($_SESSION["academic_logged_in_session"])) {
    header('Location: /webAssignment/academic/academiclogin/academiclogin.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/bootstrap.css">
    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/academic.css">
    <title>academic Panel</title>
</head>

<body>

    <div class="container-fluid">
        <div class="col-12 py-5">
            <div class="row">
                <div class="col-12 pb-4">
                    <div class="row">
                        <div class="col-4 ">
                            <span>Go Back to Academic Panel</span> <a href="../../academic/academicPanel/academicPanel.php" class="text-decoration-none">academic Panel</a>
                        </div>
                    </div>
                </div>
                <div id="showerrormessagediv" class="col-12">

                </div>
                <div class="col-12 " id="teachershowassignmentsdiv">
                    <div class="row">
                        <div class="col-6">
                            <span>select_grade</span>

                            <select onchange="getsubjects();" id="studentgrade" class="w-100 px-2 py-2">
                                <option class="py-2" value="<?php echo ""; ?>">
                                    <?php echo "Select Grade"; ?>
                                </option>
                                <?php
                                require_once "../../admin/adminPanel/AdminQuery.php";
                                $query = new AdminQuery();
                                $queryGender = $query->getGrades();
                                $rowCount = $query->rowCount;
                                for ($i = 0; $i < $rowCount; $i++) {
                                    $genderName = $queryGender[$i][1];
                                    $genderID = $queryGender[$i][0];
                                ?>
                                    <option class="py-2" value="<?php echo $genderID ?>">
                                        <?php echo $genderName; ?>
                                    </option>
                                <?php
                                }
                                ?>


                            </select>
                        </div>

                    </div>
                </div>
                <div class="col-12 ">
                    <div class="row" id="showsubmittedstudents">
                     

                    </div>
                </div>
                <div class="col-12 ">
                    <div class="row" id="showsubmittedstudentsresults">
                     

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="sendstudentresult.js"></script>
</body>

</html>