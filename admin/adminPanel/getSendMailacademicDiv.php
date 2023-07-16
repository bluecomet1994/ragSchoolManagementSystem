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
                //run the get academics method to execute the academic search query for 
                //the academic table to the academic details
                $queryacademic = $query->getacademics();
                $rowCount = $query->rowCount;
                for ($i = 0; $i < $rowCount; $i++) {
                    $academicID =  $queryacademic[$i][0];
                    $academicFName = $queryacademic[$i][1];
                    $academicLName = $queryacademic[$i][2];
                    $academicEmail = $queryacademic[$i][5];
                    $academicStatus =  $queryacademic[$i][3];

                    if ($academicStatus == 1) {
                ?>
                        <div class="col-12  subjectDivs my-1 py-2">
                            <div class="row">
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1  col-6 col-md-2 text-center text-md-start">
                                    <span class=""><?php echo $academicFName; ?></span>
                                </div>
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-6 col-md-2 text-center text-md-start">
                                    <span class=""><?php echo $academicLName; ?></span>
                                </div>
                                <div class="col-lg-4 py-2 py-md-1 py-lg-1 col-12 col-md-4 text-center text-md-start">

                                    <span class=""><?php echo $academicEmail; ?> </span>
                                </div>


                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="col-12  subjectDivs my-1 py-2">
                            <div class="row">
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1  col-6 col-md-2 text-center text-md-start">
                                    <span class=""><?php echo $academicFName; ?></span>
                                </div>
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-6 col-md-2 text-center text-md-start">
                                    <span class=""><?php echo $academicLName; ?></span>
                                </div>
                                <div class="col-lg-4 py-2 py-md-1 py-lg-1 col-12 col-md-4 text-center text-md-start">
                                    <button onclick="sendEmailtoacademic('<?php echo $academicID; ?>','<?php echo $academicEmail; ?>')" class="px-4 py-1 "><?php echo $academicEmail; ?> </button>

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