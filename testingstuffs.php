<?php


$checkPath = "../../lessonnotes/626b7bfb4912alessonnotesPDF.pdf";
function pathstringcheck($str)
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

$pathstringcheck = pathstringcheck($checkPath);
if ($pathstringcheck) {
} else {
}
$passwordMatchStatus = password_verify("fad4a917869b276e85ce38d9ae736b6d", "$2y$10$ymBrIILI5t1.CshFsGb52OGAnIK20arR0UQySfbJkYfaZjHKI4Ssa");
if ($passwordMatchStatus) {
    echo "No problem";
} else {
    echo "Nope";
}
echo "<br/>";

// $assignment_due_date =date_create("2022-03-01");
// $today = date_create("2022-05-01");
// $datedifference = date_diff($today,$assignment_due_date);
// $d= $datedifference->format('%R%d');
// $numbers = preg_replace('/[^0-9]/', '', $d);
// echo $numbers;
// echo "<br/>";

function getDateDifference2($date)
{
    $newDate = date("Y-m-d", strtotime($date));
    $tdate = time();

    $formattedDate = strtotime(str_replace("/", "-", $newDate));

    $realDateDifference = ceil(($formattedDate -  $tdate) / 86400);
    // echo $realDateDifference;
    //  $dateDifference = date('Y', $tdate) - date('Y', $formattedDate);

    return $realDateDifference;
}

function getactualdatedifference($d1, $d2)
{
    $t1 = strtotime($d1);
    $t2 = strtotime($d2);
}

echo getDateDifference2("2022-03-01");


$date1 = date_create("2013-03-15");
$date2 = date_create("2005-12-12");
$diff = date_diff($date1, $date2);
$diffdate = $diff->format("%R%a days");
$getthesign = preg_replace("/[(A-Za-z0-9)*]/", "", $diffdate);
$onlydays = preg_replace("/[^(0-9)*]/", "", $diffdate);

class GetResults
{
    public $result;
    function giveresults($marks, $sign)
    {

        if ($sign == "-") {
            $marks = $marks * (90 / 100);
            echo "right over there";
        }
        if ($marks < 40) {
            $this->result = "F";
        }
        if ($marks >= 40 && $marks < 50) {
            $this->result = "D";
        }
        if ($marks >= 50 && $marks < 60) {
            $this->result = "C";
        }
        if ($marks >= 60 && $marks < 75) {
            $this->result = "B";
        }
        if ($marks >= 75) {
            $this->result = "A";
        }
        echo "</br>";
        echo "</br>";
        echo $marks;
        return  $this->result;
    }
}
echo "</br>";
echo "</br>";

$getresults = new GetResults();
$results = $getresults->giveresults(65, "-");
echo $results;
echo "</br>";
echo "</br>";


// $days = explode("+",$d);
// echo $days[1];
