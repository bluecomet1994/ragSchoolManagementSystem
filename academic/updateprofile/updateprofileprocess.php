<?php


session_start();
if (isset($_SESSION["academic_logged_in_session"])) {
    require_once "../../academic/academicQuery/academicQuery.php";
    //academic email got from the current session
    $academicmail = $_SESSION["academic_logged_in_session"];
    $query = new AcademicQuery();
    //to get the academic details
    $getacademicdetails = $query->getacademicDetails($academicmail);
   
    $academicid = $getacademicdetails[0][0];
    $today = date("Y-m-d");

    if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_FILES["propic"])) {
        //assign variables to the values and do validations
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $receivedfile =$_FILES["propic"];
        require_once "../../fileHandler/filehandler.php";
        //create a new file handler object to save files and stuffs
        $filehandler = new FileHandler();
        $folderpath ="../../academicpropic";
        //this will store the files also it takes bunch of inputs
        //file,file path ,file size ,file type 
        $fileuploadresult = $filehandler->filedetails($receivedfile, $folderpath, "50000000", "png");
        if ($fileuploadresult) {
            //if the file uploading process is success
            $enteredfilepath = $filehandler->getFilename();
            //enter the pro pic table with the input requirements
            $updatepropic=$query->updateacademicpropic( $academicid ,$enteredfilepath);
           //update the academic first and last names
            $updateacademicdetails = $query->updatefnameNlname($academicmail, $fname, $lname);
            if ($updateacademicdetails) {
                echo "Success";
            }
        }
        
    }
    if (isset($_POST["fname"]) && isset($_POST["lname"]) && !isset($_FILES["propic"])) {
        //if only receive the first name and last then update the academic first and last names
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $updateacademicdetails = $query->updatefnameNlname($academicmail, $fname, $lname);
        if ($updateacademicdetails) {
            echo "Success";
        }
    }
}
