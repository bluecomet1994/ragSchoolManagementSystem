<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
    if(isset($_POST["id"]) && isset($_POST["email"])){
        //receive the academic id and email assign them to variables
        $id = $_POST["id"];
        $email =$_POST["email"];
       
        require_once "../../inputValidations/ValidateInputs.php";
        //create a new Validation object to do the input validations
        $validation = new ValidateInputs();
        $idvalie = $validation->intIDvalid($id);
        $emailvalie = $validation->mailVali($email);
        if($idvalie && $emailvalie){

        //create a adminquery objects to get the academic details
        require_once "../../admin/adminPanel/AcademicQuery.php";
        $query= new AcademicQuery();
        //search query for getting the individual academic details using 
        //email and id
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
        }else{
            echo "couln't validat the received inputs";
        }

    } 

}
?>