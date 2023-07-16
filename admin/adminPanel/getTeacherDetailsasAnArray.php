<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
    if(isset($_POST["id"]) && isset($_POST["email"])){
        $id = $_POST["id"];
        $email =$_POST["email"];
        require_once "../../admin/adminPanel/AdminQuery.php";
        $query = new AdminQuery();
        //get a specific teacher's details using the id and email
        $queryTeacher = $query->getSingleTeacher($id, $email);
        $rowCount = $query->rowCount;
           
            $teacherID =  $queryTeacher[0][0];
            
            $teacherID =  $queryTeacher[0][0];
            $teacherFName = $queryTeacher[0][1];
           
            $teacherSubject = $queryTeacher[0][5];
            $teacherGender = $queryTeacher[0][7];
            $teacherLName = $queryTeacher[0][2];
            $teacherEmail = $queryTeacher[0][6];
            $teacherAge = $queryTeacher[0][4];
            //set the values into an  array 
            $teacherArray = array($teacherID,$teacherEmail,$teacherFName,$teacherLName,$teacherSubject,$teacherGender,$teacherAge);

            echo json_encode($teacherArray);
        

    } 

}
?>