<?php
session_start();
if (!isset($_SESSION["teacher_logged_in_session"])) {
    header('Location: /webAssignment/teacher/teacherlogin/teacherlogin.php');
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

                <div class="col-12 " id="teachershowassignmentsdiv">
                    <div class="row">
                        <div class="col-6">
                            <span>select_grade</span>

                            <select onchange="showstudents();" id="studentgrade" class="w-100 px-2 py-2">
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
                        <div class="col-12 py-2">
                            <span>Select_student</span>
                             <div class="row">
                                 <div id="showstudentassignments" class="col-12">
                                    
                                 </div>
                             </div>
                
                        </div>
                    </div>
                </div>
                <div class="col-10 offset-1 showlessonnotes " id="showsomething">

                </div>
            </div>
        </div>
    </div>









    <script src="addassignmentmarks.js"></script>
</body>

</html>