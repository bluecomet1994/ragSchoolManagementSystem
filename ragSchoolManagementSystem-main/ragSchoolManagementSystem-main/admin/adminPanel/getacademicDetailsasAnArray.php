<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
    if(isset($_POST["id"]) && isset($_POST["email"])){
        $id = $_POST["id"];
        $email =$_POST["email"];
      
        require_once "../../admin/adminPanel/AcademicQuery.php";
        $query= new AcademicQuery();
        $queryacademic= $query->getSingleacademic($id, $email);
     
      
            $academicID =  $queryacademic[0][0];
            
            $academicID =  $queryacademic[0][0];
            $academicFName = $queryacademic[0][1];
            $academicGender = $queryacademic[0][6];
            $academicLName = $queryacademic[0][2];
            $academicEmail = $queryacademic[0][5];
            $academicAge = $queryacademic[0][4];

            $academicArray = array($academicID,$academicEmail,$academicFName,$academicLName,$academicGender,$academicAge);

            echo json_encode($academicArray);
        

    } 

}
?>