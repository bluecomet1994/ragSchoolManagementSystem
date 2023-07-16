<?php
session_start();


    unset($_SESSION["sessionVariableOnVerifyCode"]);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/bootstrap.css">
    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/admin.css">
 


    <title>Document</title>
</head>

<body class="mainThemeColor">

    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
    
                <div id="signInSignUpPage" style="margin-top: 65px;z-index: 899;" class=" col-12 colorBlack   text-center signInSignUpPage">
                    <div class="row">
                        <div id="signInOnly" class=" col-md-4 offset-md-4 col-8 offset-2 signInOnly ">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h1 class="fw-bold">ADMIN LOGIN</h1>
                                </div>
                                <div class="col-12 pt-3 pb-1 ">
                                    <div class="row">
                                        <div class="col-12 text-start">
                                            <span class="">Email</span>
                                        </div>
                                        <div class="col-12">
                                            <input id="signem" class="py-2  px-2 w-100 inputFieldsLogin" type="Email">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 pt-3 pb-1 ">
                                    <div class="row">
                               
                                        <div class="col-12 py-2">
                                            <button onclick="adminlogIn();" class="w-100 logInButton py-2">Log In</button>
                                        </div>
                                    </div>

                                </div>

                            
                            </div>
                        </div>
                   
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="adminLogin.js"></script>
</body>

</html>