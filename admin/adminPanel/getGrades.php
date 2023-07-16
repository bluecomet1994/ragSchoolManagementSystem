<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
?>

<div class="row ">
    <div class="col-10 offset-1 gradeNameHolderDiv">
    <div class="row">
    
    <?php
    //to get the grade write grade search query in the Admin Query class
    require_once "../../admin/adminPanel/AdminQuery.php";
    $query = new AdminQuery();
    $querySubjects = $query->getGrades();
    $rowCount = $query->rowCount;
    for ($i = 0; $i < $rowCount; $i++) {
        $subjectName = $querySubjects[$i][1];
    ?>



        <div class="col-12 text-center subjectDivs my-1 py-2">
            <span><?php echo $subjectName; ?></span>
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