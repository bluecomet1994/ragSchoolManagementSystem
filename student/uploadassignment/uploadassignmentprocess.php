<?php


session_start();
if (isset($_SESSION["student_logged_in_session"])) {
    require_once "../../student/studentQuery/studentQuery.php";
    $studentmail = $_SESSION["student_logged_in_session"];
    $query = new StudentQuery();
    //get student details from the student table so you can use it in the further works
    $getstudentdetails = $query->getstudentDetails($studentmail);
    $studentgradeid = $getstudentdetails[0]['grade_id'];
    $studentid = $getstudentdetails[0][0];
    $today = date("Y-m-d");

    if (isset($_POST["subject"]) && isset($_POST["assignmentid"]) &&  isset($_FILES["lfile"])) {
        require_once "../../student/studentQuery/studentQuery.php";
        $query = new studentQuery();
        $subjectID = $_POST["subject"];

        $receivedfile = $_FILES["lfile"];
        $assignmentcode = $_POST["assignmentid"];

        $folderpath = "../../submittedassignments";
        require_once "../../inputValidations/ValidateInputs.php";
        //do validations for the received input values that has been received from the client side
        $validation = new ValidateInputs();
        $subectVali = $validation->intIDvalid($subjectID);
        $assignmentidVali = $validation->emptyCheck($assignmentcode);
        if ($subectVali && $assignmentidVali) {
            //if the validations are successful
            //get the specific assignment details by the assignments unique code
            $getassignmentdetails = $query->getassignmentfulldetailsbycode($assignmentcode);
          
            if ($getassignmentdetails[0] == "Nothing") {
                
                echo "Could not found a specific row";
            } else {
                // if a row found
                $assignmentduedate = $getassignmentdetails[0]['assignment_due_date'];
                // if the dead line is reach do not let the student upload his/her asssignemnt so he can cry
                $datedifference = $validation->getDateDifference2($assignmentduedate);
                if ($datedifference < 0) {

                    exit("dead line is reached");
                }


                require_once "../../fileHandler/filehandler.php";
                //file handler object for uploading the pdf 
                $filehandler = new FileHandler();
                $fileuploadresult = $filehandler->filedetails($receivedfile, $folderpath, "50000000", "pdf");
                if ($fileuploadresult) {
                    $enteredfilepath = $filehandler->getFilename();
                    //insert the data to the stuent assignemnt table if its all successfully loaded to the server
                    $insertquery = $query->insertassignment($today, $subjectID, $studentgradeid, $assignmentcode, $studentid, $enteredfilepath);
                }
            }
        } else {
            echo "Not proper input fields";
        }
    } else {
        echo "couldn't receive data properly";
    }
}
