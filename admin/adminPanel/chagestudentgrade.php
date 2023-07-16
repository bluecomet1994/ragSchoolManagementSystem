<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
    if (!isset($_GET["studentid"])) {
        header('Location: /webAssignment/admin/adminPanel/adminManageStudent.php');
    } else {
        $studentid = $_GET["studentid"];
        require_once "../../admin/adminPanel/StudentQuery.php";
        $studentdetails = new StudentQuery();
        //get student details by id using the getstudentDetailsbyid method
        $getstudentgeneraldetails = $studentdetails->getstudentDetailsbyid($studentid);
        $studentfname = $getstudentgeneraldetails[0]['student_fname'];
        $studentlname = $getstudentgeneraldetails[0]['student_lname'];
        $studentid = $getstudentgeneraldetails[0]['student_id'];
        $studentgender = $getstudentgeneraldetails[0]['gender_name'];
        $studentgrade = $getstudentgeneraldetails[0]['grade_name'];
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../../style/bootstrap.css">
            <link rel="stylesheet" href="../../style/global.css">
            <link rel="stylesheet" href="../../style/admin.css">
            <title>Change Student Grade</title>
        </head>

        <body>
            <div class="container-fluid">
                <div class="col-12">
                    <div class="col-4 ">
                        <span>Go Back to Main Panel</span> <a href="../../admin/adminPanel/adminPanel.php" class="text-decoration-none">Admin Panel</a>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">First Name</div>
                            <div class="col-3"><?php echo $studentfname ?></div>
                            <div class="col-3">Last Name</div>
                            <div class="col-3"><?php echo $studentlname ?></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">Current Grade</div>
                            <div class="col-3"><?php echo $studentgrade ?></div>
                            <div class="col-3">Student Gender</div>
                            <div class="col-3"><?php echo $studentgender ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-3 my-auto">Select Student Grade to Update</div>
                        <div class="col-3">
                            <select id="changegradestudent"  class="w-100 px-2 py-1">
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
                        <div class="col-3">
                            <button class="ragFancyButton py-1" onclick="changestudentGradeProcess(<?php echo $studentid; ?>);">Change Grade</button>
                        </div>
                    </div>
                </div>
            </div>
            <script src="adminManageStudent.js"></script>
        </body>

        </html>

<?php
    }
}
?>