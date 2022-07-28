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

#returns query of start dates
#NOTE: unused function
function fetchPeriodStartDates () {
    $dates = dbQuery(' 
          SELECT startDate
          FROM periods
        ')->fetchAll();
    return $dates;
}

#returns query of end dates
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
    $monthInterval = new DateInterval("P1M");
    $monthDisplayed = new DateTime();
    
    if (!isset($_SESSION['date']) ||  isset($_POST['now'])){
        $monthDisplayed = new DateTime();
    }
    
    else if (isset ($_POST['prev'])) {
        $monthDisplayed = date_sub($_SESSION['date'], $monthInterval);
    }
    
    else if (isset ($_POST['next'])) {
        $monthDisplayed = date_add($_SESSION['date'], $monthInterval);
    }
    return $monthDisplayed;
}


function getPrevMonthURL ($currentMonthAsDTO) {
    $oneMonthInterval = new DateInterval('P1M');
    $previousMonthAsDTO = date_sub($currentMonthAsDTO,$oneMonthInterval);
    $previousMonthAsString = $previousMonthAsDTO->format('F');
    $previousMonthYear = $previousMonthAsDTO->format('Y');
    $_GET['month'] = $previousMonthAsString;
    $_GET['year'] = $previousMonthYear;
    $queryResult = http_build_query($_GET);
    $previousMonthURL = substr($_SERVER['PHP_SELF'], 1). '?'.$queryResult;
    echo $previousMonthURL;
}

#idk why it works with this 2M date interval
function getNextMonthURL ($currentMonthAsDTO) {
    $twoMonthInterval = new DateInterval('P2M');
    $nextMonthAsDTO = date_add($currentMonthAsDTO, $twoMonthInterval);
    $nextMonthAsString = $nextMonthAsDTO->format('F');
    $nextMonthYear = $nextMonthAsDTO->format('Y');
    $_GET['month'] = $nextMonthAsString;
    $_GET['year'] = $nextMonthYear;
    $queryResult = http_build_query($_GET);
    $nextMonthURL = substr($_SERVER['PHP_SELF'], 1). '?'.$queryResult;
    echo $nextMonthURL;
}

#returns period start dates (day, month, year) and store in 3d array as string
function getPeriodStartDatesArray () {
    $periodQueries = fetchPeriodStartDates();
    $periodStarts = array();
    foreach ($periodStarts as $key => $array) {
        foreach ($array as $subArray => $dateAsString) {
            $periodStarts['dayNo'][] = turnStringToDTO ($dateAsString)->format('j');
            $periodStarts['monthName'][] = turnStringToDTO ($dateAsString)->format('F');
            $periodStarts['year'][] = turnStringToDTO ($dateAsString)->format('Y');
        }
    }
    return $periodStarts;
}

#return period lengths that cooresponds to start date index 
function getPeriodLengthsArray () {
    $periodDates = fetchAllPeriodDates();
    $periodLengths = array();
    foreach ($periodDates as $array) {
        $periodStart = turnStringToDTO($array['startDate']);
        $periodEnd = turnStringToDTO($array['endDate']);
        $periodLength = date_diff($periodEnd, $periodStart)->format('%d');
        $periodLengths[] = $periodLength;
    }
    return $periodLengths;
}

#returns calendar
#get parameters from $_GET as string
function getCalendar ($month, $year) {
    $monthAsString = $month;
    $yearOfMonth = $year;
    $periodLengths = getPeriodLengthsArray ();
    $dateTime = turnStringToDTO($month." ".$year);
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $dateTime->format('n'), $dateTime->format('Y'));

    $firstDayNoOfMonth = $dateTime->modify('first day of this month');

    
    $firstWeekdayNo = getWeekNoOfDay($firstDayNoOfMonth);
    $todayDayNo= getTodayDayNo();
    $presentMonthAsDTO = new DateTime();
    $presentMonthAsString = $presentMonthAsDTO->format('F');
    $presentYear = $presentMonthAsDTO->format('Y');

// #find date of next period - assume cycle is 30 days
    $periodDates = fetchAllPeriodDates();
    $lastPeriod = end($periodDates);

    $periodStartDatesQuery = fetchPeriodStartDates();
    $periodStartsAsStrings = array();
    foreach ($periodStartDatesQuery as $key => $array) {
        foreach ($array as $subArray => $dateAsString) {
            $periodStartsAsString['dayNo'][] = turnStringToDTO($dateAsString)->format('j');
            $periodStartsAsString['monthName'][] = turnStringToDTO($dateAsString)->format('F');
            $periodStartsAsString['year'][] = turnStringToDTO($dateAsString)->format('Y');
        }
    } 

    // debugOutput($lastPeriod);
    $lastStartDate = turnStringToDTO($lastPeriod['startDate']);
    $nextPeriodStartDate = findStartDateOfNextPeriod($lastStartDate, 30);
    $daysUntilNextPeriod = findDateDifferenceFromToday($nextPeriodStartDate);
    $daysUntilNextPeriod=$daysUntilNextPeriod->format('%d');

    echo "
        <section class = 'calendar-container'>
            <div class = 'month-name'>
                <!-- change with php later -->
                <h3>".$monthAsString." ".$yearOfMonth."</h3>
                <div class = 'cal-arrows'>

    
                    <h3 onclick = 'CALENDAR FUNCTION GOES HERE' style =  'text-decoration: none; color: var(--dark-gray)'> < </h3>
                    <h3 onclick = 'CALENDAR FUNCTION GOES HERE' style = 'text-decoration: none; color: var(--dark-gray)'> > </h3>
      

                </div>
            </div>
            <div class = 'calendar-display'>
                <div class = 'weekday cal-row'>
                    <h4>M</h4>
                    <h4>T</h4>
                    <h4>W</h4>
                    <h4>T</h4>
                    <h4>F</h4>
                    <h4>S</h4>
                    <h4>S</h4> 
                </div>
                
                <div class = 'cal-row'>
    ";

    $dayNo = 1;

            for ($dayCount = 1; $dayCount <= 42; $dayCount++) {
                if ($dayCount < $firstWeekdayNo || $dayNo > $daysInMonth) {
                    echo "
                    <h4 class = 'hidden'>0</h4>";
                }

                else if ($dayCount >= $firstWeekdayNo) {
                    
                    if (array_search($dayNo, $periodStartsAsString['dayNo'])!==false) {
                        $dateKey = array_search($dayNo, $periodStartsAsString['dayNo']);
                        if ($periodStartsAsString['monthName'][$dateKey] == $monthAsString && $periodStartsAsString['year'][$dateKey] == $yearOfMonth) {
                            $periodLength = $periodLengths[$dateKey];
                            for ($periodDay = 1; $periodDay <= $periodLength; $periodDay++) {
                                #need help on this bc if it is today AND we r on period will it be replicate days?
                                if ($dayNo == $todayDayNo && $monthAsString == $presentMonthAsString) {
                                    echo "
                                    <h4 class = 'period today'>".$dayNo."</h4>";
                                } else {
                                    echo "
                                    <h4 class = 'period' >".$dayNo."</h4>";
                                }
                               
                                if ($dayCount%7 == 0) {
                                    echo "
                                    </div>
                                    <div class = 'cal-row'>";
                                }
                                $dayNo++;
                                $dayCount++;
                             
                            }

                        }
                    }
              
                    if ($dayNo == $todayDayNo && $monthAsString == $presentMonthAsString && $yearOfMonth == $presentYear) {
                        echo "
                        <h4 class = 'today'>".$dayNo."</h4>";
                        $dayNo++;
                    } else {
                        echo "
                        <h4>".$dayNo."</h4>";
                        $dayNo++;
                    }

                }
      
                if ($dayCount%7 == 0) {
                    echo "
                    </div>
                    <div class = 'cal-row'>";
                }
                
            }
}

// getCalendar ("July", "2022");
