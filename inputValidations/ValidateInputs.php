<?php
//validation class for validating input fields such as
///names fields , number fields,password fields,get date differences
class ValidateInputs
{
    private $email;
    public function emptyCheck($anything)
    {
        return (!empty($anything));
    }
    public function mailVali($E)
    {
        $state = false;
        if (empty($E)) {

            $state = false;
        } else if (!filter_var($E, FILTER_VALIDATE_EMAIL)) {

            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    function get_date_offset($start_date, $end_date)
    {
        $start_time = new DateTime($start_date);
        $end_time   = new DateTime($end_date);
        $interval   = $end_time->diff($start_time);


        return $interval->format('%a days');
    }

    public function getAgeDifference($bdate)
    {

        $dob = strtotime(str_replace("/", "-", $bdate));
        $tdate = time();
        $dateDifference = date('Y', $tdate) - date('Y', $dob);
        echo $dateDifference;
        return $dateDifference;
    }

    public function getDateDifference($date)
    {
        $newDate = date("Y-m-d", strtotime($date));
        $tdate = time();

        $formattedDate = strtotime(str_replace("/", "-", $newDate));

        $realDateDifference = ceil(($tdate - $formattedDate) / 86400);
        // echo $realDateDifference;
        //  $dateDifference = date('Y', $tdate) - date('Y', $formattedDate);

        return $realDateDifference;
    }

    public function getDateDifference2($date)
    {
        $newDate = date("Y-m-d", strtotime($date));
        $tdate = time();

        $formattedDate = strtotime(str_replace("/", "-", $newDate));

        $realDateDifference = ceil(($formattedDate -  $tdate) / 86400);
        // echo $realDateDifference;
        //  $dateDifference = date('Y', $tdate) - date('Y', $formattedDate);

        return $realDateDifference;
    }
    public function getYearDifference($date)
    {
        $newDate = date("Y-m-d", strtotime($date));
        $tdate = time();

        $formattedDate = strtotime(str_replace("/", "-", $newDate));

        $realDateDifference = ceil(($tdate - $formattedDate) / 31557600);
        // echo $realDateDifference;
        //  $dateDifference = date('Y', $tdate) - date('Y', $formattedDate);

        return $realDateDifference;
    }

    public function dateVali($d)
    {
        $state = false;

        $breakdate = explode("-", $d);

        if (count($breakdate) == 3) {
            if (checkdate($breakdate[1], $breakdate[2], $breakdate[0])) {
                $state = true;
            } else {
                echo "couldn't validate date ";
            }
        } else {
            echo "nope";
        }
        return $state;
    }
    public function ageVali($a)
    {
        $state = false;
        $ageGapString = $this->getYearDifference($a);
        $ageGap = (int)$ageGapString;



        if (empty($a)) {
            echo "empty age";
            $state = false;
        } else if ($ageGap <= 20) {
            echo "lesser than 20";
            $state = false;
        } else if ($ageGap >= 60) {
            echo "higher than 60";
            $state = false;
        } else {
            $state = true;
        }


        return $state;
    }

    public function studentageVali($a, $min, $max)
    {
        $state = false;
        $ageGapString = $this->getYearDifference($a);
        $ageGap = (int)$ageGapString;

        if (empty($a)) {
            echo "empty age";
            $state = false;
        } else if ($ageGap <= $min) {
            echo "lesser than " . "" . $min;
            $state = false;
        } else if ($ageGap >= $max) {
            echo "higher than 20 " . "" . $max;
            $state = false;
        } else {
            $state = true;
        }


        return $state;
    }
    public function gradeVali($g)
    {
        $state = false;
        if (empty($g)) {
            $state = false;
        } else if (!ctype_digit($g)) {
            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function genderVali($g)
    {
        $state = false;
        if (empty($g)) {
            $state = false;
        } else if (!ctype_digit($g)) {
            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function veriCodeVali($VFC)
    {

        $state = false;
        if (empty($VFC)) {
            $state = false;
        } else if (preg_match("/^[a-z0-9-]+$/", $VFC == 0)) {
            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function filePathVali($src)
    {
        $state = false;
        if (empty($src)) {
            $state = false;
        } else if (preg_match("/^[a-z0-9-]+$/", $src == 0)) {
            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function stringVali($str)
    {
        $state = 0;
        if (empty($str)) {

            $state = 0;
        } else if (!preg_match("/^[a-zA-Z0-9 _]+$/", $str)) {
            $state = 0;
        } else {
            $state = 1;
        }
        return $state;
    }
    function pathstringchecklessonnotes($str,)
    {

        $checkfor = "/^(\.\.\/\.\.\/lessonnotes\/)/";
        $state = false;
        if (empty($str)) {

            $state = false;
        } else if (!preg_match($checkfor, $str)) {
            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    function pathstringcheckforassignments($str)
    {

        $checkfor = "/^(\.\.\/\.\.\/assignments\/)/";
        $state = false;
        if (empty($str)) {

            $state = false;
        } else if (!preg_match($checkfor, $str)) {
            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function intIDvalid($id)
    {
        $state = false;
        if (empty($id)) {

            $state = false;
        } else if (!ctype_digit($id)) {

            $state = false;
        } else {
            $state = true;
        }
        return $state;
    }
    public function marksVali($marks){
        $state = false;
        if (!ctype_digit($marks)) {
                $state = false;
        }else if($marks>=100 && $marks<0){
               $state =false;
        }else{
             $state =true;
        }
        return $state;
    }
    public function passwordVali($pwd)
    {
        $error = "";
        $state = true;
        $this->pwd = $pwd;
        if (strlen($pwd) < 8) {
            $error = "Password too short!";
        }
        if (strlen($pwd) > 50) {
            $error = "Password too long!";
        }
        if (strlen($pwd) < 8) {
            $error = "Password too short!";
        }
        if (!preg_match("#[0-9]+#", $pwd)) {
            $error = "Password must include at least one number!";
        }
        if (!preg_match("#[a-z]+#", $pwd)) {
            $error = "Password must include at least one letter!";
        }
        if (!preg_match("#[A-Z]+#", $pwd)) {
            $error = "Password must include at least one CAPS!";
        }
        if (!preg_match("#W+#", $pwd)) {
            $error = "Password must include at least one symbol!";
        }
        if ($error) {
            $state = false;
        } else {
            $state = true;
        }

        return $state;
    }
}
