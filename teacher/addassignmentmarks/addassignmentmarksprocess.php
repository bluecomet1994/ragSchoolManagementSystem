<?php
session_start();
if (isset($_SESSION["teacher_logged_in_session"])) {

    require_once "../../teacher/teacherQuery/teacherQuery.php";
    require_once "../../inputValidations/ValidateInputs.php";
    require_once "../../calculateresults/calculateResults.php";
    require_once "../../properdatedifference/properdatedifference.php";
    $teachermail = $_SESSION["teacher_logged_in_session"];
    $query = new TeacherQuery();
    $getteacherdetails = $query->getTeacherDetails($teachermail);
    $teachersubjectid = $getteacherdetails[0][5];
    $teacherid = $getteacherdetails[0][0];

    if(isset($_POST["sid"]) && isset($_POST["marks"]) && isset($_POST["aid"])){
       //validating input fields
        $validation = new ValidateInputs();
        $sid =$_POST["sid"] ;
        $marks = $_POST["marks"];
        $assignmentid = $_POST["aid"];
        $valisid = $validation->intIDvalid($sid);
        $valiassignmentid = $validation->intIDvalid($assignmentid);
        $valimarks = $validation->marksVali($marks);
        //if it all reached the validation requirements it will come to this section
        if($valimarks && $valisid && $valiassignmentid ){
            //this will return the students assignment details of that specific teachers subjects only
            $studentassignmentdetails = $query->getstudentsubmissionsbystudentidNteacherid($sid, $teachersubjectid,$assignmentid);
            //if rows found it will go to this block
            if($studentassignmentdetails[0] !=="Nothing" && count($studentassignmentdetails) >=1 ){
                //get the required details that are needed to for the insert query for the student assignemnt marks
                $student_assignment_result = $studentassignmentdetails[0]['student_results'];
                $due_date =  $studentassignmentdetails[0]['assignment_due_date'];
                $uploaded_date = $studentassignmentdetails[0]['uploaded_date'];
                $properdateprocess = new ProperDateDifference();
                $date_difference = $properdateprocess->datediff ($uploaded_date,$due_date);
                $date_sign = $properdateprocess->returndsign();
                
                if($student_assignment_result=='1'){
                    
                    $calculateResultprocess = new CalculateResults();
                    //this will calculate and omit the result with the due date if it passed the due date marks will be reduced
                    $calculated_result = $calculateResultprocess->giveresults($marks,$date_sign);
                    //updating the student marks because the default values is pending with the key value 1
                    $resultaddstatus =$query->addresultsforstudent($calculated_result,$assignmentid,$teachersubjectid,$sid);
                    if($resultaddstatus){
                        echo "Success";
                    }
                   
                }else{
                    echo "you already entered cannot change it back";
                }
            }

        }else{
            echo "Couldn't validate inputs";
        }
    }
}
