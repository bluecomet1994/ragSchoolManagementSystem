<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
?>

    <div class="row ">
        <div class="col-12 subjectNameHolderDiv">
            <div class="row">

                <?php
                require_once "../../admin/adminPanel/AdminQuery.php";
                $query = new AdminQuery();
                //run the get teachers method to execute the teacher search query for 
                //the teacher table to the teacher details
                $queryTeacher = $query->getTeachers();
                $rowCount = $query->rowCount;
                for ($i = 0; $i < $rowCount; $i++) {
                    $teacherID =  $queryTeacher[$i][0];
                    $teacherFName = $queryTeacher[$i][1];
                    $teacherLName = $queryTeacher[$i][2];
                    $teacherEmail = $queryTeacher[$i][6];
                    $teacherStatus =  $queryTeacher[$i][3];

                    if ($teacherStatus == 1) {
                ?>
                        <div class="col-12  subjectDivs my-1 py-2">
                            <div class="row">
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1  col-6 col-md-2 text-center text-md-start">
                                    <span class=""><?php echo $teacherFName; ?></span>
                                </div>
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-6 col-md-2 text-center text-md-start">
                                    <span class=""><?php echo $teacherLName; ?></span>
                                </div>
                                <div class="col-lg-4 py-2 py-md-1 py-lg-1 col-12 col-md-4 text-center text-md-start">

                                    <span class=""><?php echo $teacherEmail; ?> </span>
                                </div>
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-md-2 col-6 text-center">
                                    <img src="../../icons/updateIcon.png" onclick="showUpdateTeacherDiv('<?php echo $teacherID; ?>','<?php echo $teacherEmail; ?>');" class="updateIcon" alt="" srcset="">
                                </div>
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-md-2  col-6 text-center">

                                    <img src="../../icons/delete.png" onclick="removeTheTeacher('<?php echo $teacherID; ?>','<?php echo $teacherEmail; ?>')" class="updateIcon " alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-12  subjectDivs my-1 py-2">
                            <div class="row">
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1  col-6 col-md-2 text-center text-md-start">
                                    <span class=""><?php echo $teacherFName; ?></span>
                                </div>
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-6 col-md-2 text-center text-md-start">
                                    <span class=""><?php echo $teacherLName; ?></span>
                                </div>
                                <div class="col-lg-4 py-2 py-md-1 py-lg-1 col-12 col-md-4 text-center text-md-start">
                                    <button onclick="sendEmailtoTeacher('<?php echo $teacherID; ?>','<?php echo $teacherEmail; ?>')" class="px-4 py-1 "><?php echo $teacherEmail; ?> </button>

                                </div>
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-md-2 col-6 text-center">
                                    <img src="../../icons/updateIcon.png" onclick="showUpdateTeacherDiv('<?php echo $teacherID; ?>','<?php echo $teacherEmail; ?>');" class="updateIcon" alt="" srcset="">
                                </div>
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-md-2  col-6 text-center">

                                    <img src="../../icons/delete.png" onclick="removeTheTeacher('<?php echo $teacherID; ?>','<?php echo $teacherEmail; ?>')" class="updateIcon " alt="" srcset="">
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
?>