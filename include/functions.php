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

//////// DATE FORMATTING FUNCTIONS ////////

#takes in DateTime() object and returns format as string
#NOTE: MUST convert input to DTO first

function convertDateTimeToMDYFormat($dateToConvert) { 
    $dateToConvert = $dateToConvert->format('m-d-Y');
    return $dateToConvert;
}

function convertDateTimeToMonthName($dateToConvert) {
    $dateToConvert = $dateToConvert->format('F');
    return $dateToConvert;
}

function convertDateTimeToMonthNo($dateToConvert) {
    $dateToConvert = $dateToConvert->format('n');
    return $dateToConvert;
}

function convertDateTimeToYear($dateToConvert) {
    $dateToConvert = $dateToConvert->format('Y');
    return $dateToConvert;
}

function getFirstDayOfMonth($date) {
    $date = $date->modify('first day of this month');
    return $date;
}

function getWeekNoOfDay($date) {
    $date = $date->format('w');
    return $date;
}

function getTodayDayNo() {
    $date = new DateTime();
    $date = $date->format('j');
    return $date;
}

function getDayNo($date) {
    $date = $date->format('j');
    return $date;
}
//////// ------------------------ ////////

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


function getDateToStoreInSession () {
    if (!isset($_SESSION['date']) ||  isset($_POST['now'])){
        $monthDisplayed = new DateTime();
        return $monthDisplayed;
    }
    
    else if (isset ($_POST['prev'])) {
        $monthInterval = new DateInterval("P1M");
        $monthDisplayed = date_sub($_SESSION['date'], $monthInterval);
        return $monthDisplayed;

    }
    
    else if (isset ($_POST['next'])) {
        $monthInterval = new DateInterval("P1M");
        $monthDisplayed = date_add($_SESSION['date'], $monthInterval);
        return $monthDisplayed;

    }
}