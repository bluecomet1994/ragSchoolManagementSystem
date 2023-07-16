<?php
   // include("./config.php");
    include("../paymentGateway/config.php");
    $token = $_POST["stripeToken"];
 
    $token_card_type = $_POST["stripeTokenType"];
    
    $email           = $_POST["stripeEmail"];
    //amount is fixed so it has fixed here
    $amount          = (int)"5000"; 

    $desc            = "Portal payment by Student";
    $charge = \Stripe\Charge::create([
      "amount" => str_replace(",","",$amount) ,
      "currency" => 'inr',
      "description"=>$desc,
      "source"=> $token,
    ]);

    if($charge){
      //if its successfully done then redirect to the success.php with 
      //the binding values such as email and the amount
      header("Location:success.php?amount=$amount&email=$email");
    }
