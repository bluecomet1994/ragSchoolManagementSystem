<?php


session_start();
if (isset($_SESSION["student_logged_in_session"])) {
    require_once "../../student/studentQuery/studentQuery.php";
    $studentmail = $_SESSION["student_logged_in_session"];
    $query = new StudentQuery();
    $getstudentdetails = $query->getstudentDetails($studentmail);
    $studentgradeid = $getstudentdetails[0]['grade_id'];
    $studentid = $getstudentdetails[0][0];
    $today = date("Y-m-d");

    if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_FILES["propic"])) {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $receivedfile =$_FILES["propic"];
        require_once "../../fileHandler/filehandler.php";
        $filehandler = new FileHandler();
        $folderpath ="../../studentpropic";
        $fileuploadresult = $filehandler->filedetails($receivedfile, $folderpath, "50000000", "png");
        if ($fileuploadresult) {
            $enteredfilepath = $filehandler->getFilename();
            $updatepropic=$query->updatestudentpropic( $studentid ,$enteredfilepath);
            $updatestudentdetails = $query->updatefnameNlname($studentmail, $fname, $lname);
            if ($updatestudentdetails) {
                echo "Success";
            }
        }
        
    }
    if (isset($_POST["fname"]) && isset($_POST["lname"]) && !isset($_FILES["propic"])) {

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $updatestudentdetails = $query->updatefnameNlname($studentmail, $fname, $lname);
        if ($updatestudentdetails) {
            echo "Success";
        }
    }
}
