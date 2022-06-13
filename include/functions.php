<?php

function debugOutput($input){
    echo "<pre>";
    var_dump($input);
    echo "</pre>";
}

#returns last index of array as a string 
function getLastPeriodDatesinArray ($periodArray) {
    $lastPeriod = end($periodArray);
    return $lastPeriod;
}

function turnStringToDTO ($dateAsString){
    $dateAsDTO = new DateTime($dateAsString);
    return $dateAsDTO;
}

#takes in DateTime() object and returns format as string
#NOTE: MUST convert input to DTO first
function convertDateTimeToMDYFormat($dateToConvert) { 
    $dateToConvert = $dateToConvert->format('m-d-Y');
    return $dateToConvert;
}

function convertDateTimeIntervalToDays ($dateInterval) {
    $dateInterval = $dateInterval->format('%d');
    return $dateInterval;
}


function fetchAllPeriodDates () {
    $dates = dbQuery(' 
          SELECT startDate, endDate
          FROM periods
        ')->fetchAll();
    return $dates;
}

#returns 3d array of start dates
#NOTE: unused function
function fetchPeriodStartDates () {
    $dates = dbQuery(' 
          SELECT startDate
          FROM periods
        ')->fetchAll();
    return $dates;
}

#returns 3d array of end dates
#NOTE: unused function
function fetchPeriodEndDates () {
    $dates = dbQuery(' 
          SELECT endDate
          FROM periods
        ')->fetchAll();
    return $dates;
}


#NOTE: input MUST be DateTime() object
function findDateDifferenceFromToday ($futureDate) {
    $today = new DateTime();
    $dateDifference = date_diff($today, $futureDate);
    return $dateDifference;

}

#returns DateTime object
function findStartDateOfNextPeriod ($lastStartDate, $cycleLengthInDays) {
    $cycleLengthInDays = new DateInterval("P".$cycleLengthInDays."D");
    $nextPeriodStartDate = date_add($lastStartDate, $cycleLengthInDays);
    return $nextPeriodStartDate;
}
