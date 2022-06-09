<?php

function debugOutput($input){
    echo "<pre>";
    var_dump($input);
    echo "</pre>";
}


function convertDateToMDY($dateToConvert) {
    $datePosted= new DateTime($dateToConvert);
    $datePosted = $datePosted->format('m-d-Y');
    return $datePosted;
}

function fetchAllPeriodDates () {
    $dates = dbQuery(' 
          SELECT startDate, endDate, periodId
          FROM periods
        ')->fetchAll();
    return $dates;
}

function fetchPeriodStartDate ($periodId) {
    $dateData = fetchAllPeriodDates();
    $periodStartDate = $dateData[$periodId]['startDate'];
    return $periodStartDate;
}

function fetchPeriodEndDate ($periodId) {
    $dateData = fetchAllPeriodDates();
    $periodEndDate = $dateData[$periodId]['endDate'];
    return $periodEndDate;
}

function findNextPeriod ($startDate, $expectedCycleLength) {
    $nextPeriodStartDate = dbQuery("
        SELECT DATE_ADD('".$startDate."', INTERVAL ".$expectedCycleLength." DAY)
    ")->fetch();
    return $nextPeriodStartDate;
}

#have different options to echo?
function returnNextPeriod ($startDate, $expectedCycleLength) {
    $periodArray = findNextPeriod($startDate, $expectedCycleLength);
    foreach($periodArray as $query => $periodDate) {
        return $periodDate;
    }
}
#is this needed lol
#convertDateToMDY
function echoNextPeriod ($startDate, $expectedCycleLength) {
    $periodArray = findNextPeriod($startDate, $expectedCycleLength);
    foreach($periodArray as $query => $periodDate) {
        echo $periodDate;
    }
}

function getCurrentDate () {
    $currentDate = dbQuery("
        SELECT CURRENT_TIMESTAMP()
    ")->fetch();
    return $currentDate;
}


#idk
function findDateDifferenceFromToday ($futureDate) {
    // $today = new DateTime();
    // $today->format('Y-m-d h:m:s');
    // $futureDate = strtotime($futureDate);
    // $interval = date_diff($today, $futureDate);
    // return $interval;

    $todayDate = date('Y-m-d H:i:s');

    echo $todayDate;
    
    $dateDifference = (date_diff($todayDate, $futureDate))->format('%R%d days');

    return $dateDifference;


}


#wut
function findDaysUntilNextPeriod ($dateOfNextPeriod) {
    // $today = dbQuery("
    //     SELECT CURRENT_TIMESTAMP
    // ") -> fetch();
    // $todayfr = '';
    // foreach ($today as $query => $date) {
    //     $todayfr = $date;
    // }

    $today = new DateTime();
    $today = date_format($today, 'Y-m-d h:m:s');

    // var_dump($today);
    $dateDifference = dbQuery("
        SELECT DATEDIFF (DAY, '".$today."', '".$dateOfNextPeriod."')
    ") -> fetch();
   
    var_dump($dateDifference);
}