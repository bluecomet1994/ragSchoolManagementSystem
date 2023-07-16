<?php
session_start();
if (!isset($_SESSION["student_logged_in_session"])) {
    die();
} else {
    if (isset($_POST["subjectid"])) {
        //to get the subjects
        $email = $_SESSION["student_logged_in_session"];
        $subjectID = $_POST["subjectid"];
        require_once "../../student/studentQuery/studentQuery.php";
        $query = new studentQuery();
        $querygrade = $query->getstudentgrade($email);
        $gradeName = $querygrade[0][1];
        $gradeID = $querygrade[0][0];
?>
        <select id="studentassignmentassignment" class="w-100 px-2 py-2">
            <?php          
            $queryassignment = $query->getstudentassignmentwithsubjectid($gradeID, $subjectID);
            $rowCount = $query->rowCount;
            for ($i = 0; $i < $rowCount; $i++) {
                $assignmentName = $queryassignment[$i][1];
                $assignmentID = $queryassignment[$i][7];
            ?>
                <option class="py-2" value="<?php echo $assignmentID ?>">
                    <?php echo $assignmentID; ?>
                </option>
            <?php
            }
            ?>
        </select>
<?php
    }
}

?>