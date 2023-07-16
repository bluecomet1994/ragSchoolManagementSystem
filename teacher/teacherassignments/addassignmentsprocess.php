<?php
session_start();
if (isset($_SESSION["teacher_logged_in_session"])) {
    require_once "../../teacher/teacherQuery/teacherQuery.php";
    //get the teacher details using the teacher logged in session variable
    $teachermail = $_SESSION["teacher_logged_in_session"];
    $query = new TeacherQuery();
    $getteacherdetails = $query->getTeacherDetails($teachermail);
    $teachersubjectid = $getteacherdetails[0][5];
    $teacherid = $getteacherdetails[0][0];

    if (isset($_POST["grade"]) && isset($_POST["lname"]) && isset($_FILES["lfile"]) && isset($_POST["duedate"])) {
        require_once "../../inputValidations/ValidateInputs.php";
        //if we received the values from the client side here we have to do some validations
        $validation = new ValidateInputs();
        $grade = $_POST["grade"];
        $assignmentname = $_POST["lname"];
        $dueDate = $_POST["duedate"];
        $receivedfile = $_FILES["lfile"];
  
        $gradeVali = $validation->gradeVali($grade);
        $nameVali = $validation->stringVali($assignmentname);
     //   $dateVali = $validation->dateVali($dueDate);
        $foldername = "../../assignments";
        //if it reaches all the validation requirements
        if ($gradeVali && $nameVali ) {
            //create the file handler object and upload the files
            require_once "../../fileHandler/filehandler.php";
            $filehandler = new FileHandler();
            $fileuploadedstatus = $addfiles = $filehandler->filedetails($receivedfile, $foldername, "50000000", "pdf");
            $createdfilepath = $filehandler->unique_name_generated;

            if ($fileuploadedstatus) {
                

                //if the file handler upload process is succeed then insert the assignemnt details to the teacher assignment table
                $addassignmentquerystatus = $query->addassignment($createdfilepath, $assignmentname, $grade, $teachersubjectid,$teacherid,$dueDate);
                if($addassignmentquerystatus){
                    echo "Success";
                }
            }else{
                echo "Here";
            }
        }else{
            echo "validation";
        }
    } else {
        echo "couldn't receive data properly";
    }
} else {
}
