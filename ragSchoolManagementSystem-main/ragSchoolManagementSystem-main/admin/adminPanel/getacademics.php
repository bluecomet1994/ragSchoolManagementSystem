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
            
                require_once "../../admin/adminPanel/AcademicQuery.php";
                $query = new AcademicQuery();


                $queryTeacher = $query->getacademics();
                $rowCount = $query->rowCount;
                for ($i = 0; $i < $rowCount; $i++) {
                    $academicID =  $queryTeacher[$i][0];
                    $academicFName = $queryTeacher[$i][1];
                    $academicLName = $queryTeacher[$i][2];
                    $academicEmail = $queryTeacher[$i][5];
                ?>



                    <div class="col-12  subjectDivs my-1 py-2">
                        <div class="row">
                            <div class="col-lg-2 py-2 py-md-1 py-lg-1  col-6 col-md-2 text-start text-md-start">
                                <span class=""><?php echo $academicFName; ?></span>
                            </div>
                            <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-6 col-md-2 text-start text-md-start">
                                <span class=""><?php echo $academicLName; ?></span>
                            </div>
                            <div class="col-lg-4 py-2 py-md-1 py-lg-1 col-12 col-md-4 text-start text-md-start">

                                <span class=""><?php echo $academicEmail; ?> </span>
                            </div>
                            <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-md-2 col-6 text-center">
                                <img src="../../icons/updateIcon.png" onclick="showUpdateacademicDiv('<?php echo $academicID; ?>','<?php echo $academicEmail; ?>');" class="updateIcon" alt="" srcset="">
                            </div>
                            <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-md-2  col-6 text-center">

                                <img src="../../icons/delete.png" onclick="removeTheacademic('<?php echo $academicID; ?>','<?php echo $academicEmail; ?>')" class="updateIcon " alt="" srcset="">
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
?>