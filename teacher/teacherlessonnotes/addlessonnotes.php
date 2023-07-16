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

                <div class="col-12 " id="teacherUpdateDiv">
                    <div class="row">
                        <div class="col-12 text-center ">
                            <span class="fw-bold text-danger" id="upAddteachererrormessage"></span>
                        </div>
                        <div class="col-6">
                            <span>lesson_name</span>
                            <input type="text" id="teacherlessonname" class="w-100 px-2 py-2">
                        </div>

                        <div class="col-6">
                            <span>lesson_name</span>
                            <div>
                                <label class="w-100 px-2 py-2 bg-white text-dark" for="teacherlessonpdf">Upload lesson notes</label>
                            </div>
                            <input class="d-none" type="file" id="teacherlessonpdf" class="w-100 px-2 py-2">
                        </div>


                        <div class="col-6">
                            <span>select_grade</span>

                            <select id="lessongrade" class="w-100 px-2 py-2">
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

                        <div class="col-12 text-center py-4">
                            <button onclick="uploadlessonnotes();" class="ragFancyButton px-2 py-2 w-50">Add Lesson</button>
                        </div>
                    </div>
                </div>
                <div class="col-10 offset-1 showlessonnotes d-none" id="showlessonnotes">

                </div>
            </div>
        </div>
    </div>









    <script src="addlessonnotes.js"></script>
</body>

</html>