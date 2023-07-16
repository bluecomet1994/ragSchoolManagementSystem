<?php


session_start();
if (isset($_SESSION["teacher_logged_in_session"])) {
    require_once "../../teacher/teacherQuery/teacherQuery.php";
    $teachermail = $_SESSION["teacher_logged_in_session"];
    $query = new TeacherQuery();
    $getteacherdetails = $query->getteacherDetails($teachermail);
   
    $teacherid = $getteacherdetails[0][0];
    $today = date("Y-m-d");

    if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_FILES["propic"])) {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $receivedfile =$_FILES["propic"];
        require_once "../../fileHandler/filehandler.php";
        $filehandler = new FileHandler();
        $folderpath ="../../teacherpropic";
        $fileuploadresult = $filehandler->filedetails($receivedfile, $folderpath, "50000000", "png");
        if ($fileuploadresult) {
            $enteredfilepath = $filehandler->getFilename();
            $updatepropic=$query->updateteacherpropic( $teacherid ,$enteredfilepath);
            $updateteacherdetails = $query->updatefnameNlname($teachermail, $fname, $lname);
            if ($updateteacherdetails) {
                echo "Success";
            }
        }
        
    }
    if (isset($_POST["fname"]) && isset($_POST["lname"]) && !isset($_FILES["propic"])) {

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $updateteacherdetails = $query->updatefnameNlname($teachermail, $fname, $lname);
        if ($updateteacherdetails) {
            echo "Success";
        }
    }
}
