<?php
//propoer and solid date different class for date difference 
class ProperDateDifference{
    public $pastdate;
    public $futuredate;
    public $datedifferencesign;
    public $datedifferencecount;
    public function datediff ($pastdate,$futuredate){
        $date1=date_create($pastdate);
        $date2=date_create($futuredate);
        $diff=date_diff($date1,$date2);
        $diffdate= $diff->format("%R%adays");
        $getthesign = preg_replace("/[(A-Za-z0-9)*]/","",$diffdate);
        $onlydays = preg_replace("/[^(0-9)*]/","",$diffdate);

        $this->datedifferencecount = $onlydays;
        $this->datedifferencesign = (string)$getthesign;
    }
    public function returndsign(){
        return  $this->datedifferencesign;
    }

}


?>