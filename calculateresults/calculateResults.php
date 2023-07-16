<?php
class CalculateResults{
    private $result;
    function giveresults($marks,$sign){
        //create logics for student results using if else statements
        if($sign == "-"){
            $marks = $marks*(90/100);
            
        }
        if($marks <40){
            $this->result = "F";
        }
        if($marks >=40 && $marks<50){
            $this->result = "D";
        }
        if($marks >=50 && $marks<60){
            $this->result = "C";
        }
        if($marks >=60 && $marks<75){
            $this->result = "B";
        }
        if($marks >=75 ){
            $this->result = "A";
        }
        echo $this->result;
        return  $this->result;
    }
}
