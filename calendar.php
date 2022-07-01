<html>
<head>
    <link rel = 'stylesheet' href = 'style.css'/>
</head>
<body>

<?php
include ('include/initialize.php');

$_SESSION['date'] = getDateToStoreInSession();
$selectedMonthObject = $_SESSION['date'];

$currentMonthObject = new DateTime(); //for checking if we are in current month for ln 54
$currentMonthDisplayedAsNo = convertDateTimeToMonthNo($currentMonthObject);

$selectedMonthDisplayedAsName = convertDateTimeToMonthName($selectedMonthObject);
$selectedMonthDisplayedAsNo = convertDateTimeToMonthNo($selectedMonthObject);
$selectedDateDisplayedAsYear = convertDateTimeToYear($selectedMonthObject);

$firstDayOfSelectedMonth = getFirstDayOfMonth($selectedMonthObject);
$weekNoOfFirstDayOfSelectedMonth = getWeekNoOfDay($firstDayOfSelectedMonth);

$todayDayNo = getTodayDayNo();

$daysInSelectedMonthDisplayed = cal_days_in_month(CAL_GREGORIAN, $selectedMonthDisplayedAsNo, $selectedDateDisplayedAsYear);

?>

<h1><?=$selectedMonthDisplayedAsName?> <?=$selectedDateDisplayedAsYear?></h1>
<div class = 'column'>
    <h2>Mon</h2>
    <h2>Tues</h2>
    <h2>Wed</h2>
    <h2>Thurs</h2>
    <h2>Fri</h2>
    <h2>Sat</h2>
    <h2>Sun</h2>
</div>

<div class = 'column'>
    <?php

    $periodDates = fetchAllPeriodDates();
    $periodStartDates = fetchPeriodStartDates();
    $periodStartDatesAsDays = array();
    $periodStartDatesAsMonthNo = array();
    $periodLengths = array();

    foreach ($periodDates as $array) {
        $periodStart = turnStringToDTO($array['startDate']);
        $periodEnd = turnStringToDTO($array['endDate']);
        $periodLength = date_diff($periodEnd, $periodStart)->format('%d');
        $periodLengths[] = $periodLength;
    }

    // debugOutput($periodLengths);
    foreach ($periodStartDates as $array => $startDate) {
        foreach ($startDate as $array => $dateAsString){
            $dateAsDayNo = turnStringToDTO($dateAsString)->format('j');
            $dateAsMonthNo = turnStringToDTO($dateAsString)->format('n');
            $periodStartDatesAsDays[] = $dateAsDayNo;
            $periodStartDatesAsMonthNo[] = $dateAsMonthNo;
            // $periodStartDatesAsYear[] = $dateAsYear;
        }
    }
//     debugOutput($periodStartDatesAsMonthNo);
//    debugOutput($periodStartDatesAsMonthNo[4]==$currentMonthDisplayedAsNo);
        // debugOutput ($periodStartDates);


        $dayNo = 1; 
        for ($dayCount = 1; $dayCount <= 42; $dayCount++) { //creates a 7x6 grid for calendar view
            if ($dayCount < $weekNoOfFirstDayOfSelectedMonth || $dayNo > $daysInSelectedMonthDisplayed) { //bounds for which days are to be displayed
                echo "
                <div class = 'hidden'>".$dayNo."</div>";
            }
            else if ($dayCount >= $weekNoOfFirstDayOfSelectedMonth) { //days included in the month
                
                if (array_search($dayNo, $periodStartDatesAsDays)!=false) {
                    $dayKey = array_search($dayNo, $periodStartDatesAsDays);
                    if ($periodStartDatesAsMonthNo[$dayKey]==$selectedMonthDisplayedAsNo) {
                        for ($periodDay = 1; $periodDay <= $periodLengths[$dayKey]; $periodDay++) {
                        echo "
                        <div class = 'period day'>".$dayNo."</div>";
                        $dayNo++;
                        // $dayCount++; //have no idea why this fixed the code - ends iteration of loop ig?
                        }
                    }
                    
                }

                
                if ($dayNo == $todayDayNo && $selectedMonthDisplayedAsNo == $currentMonthDisplayedAsNo) {
                    echo "
                    <div class = 'to day'>".$dayNo."</div>";
                    $dayNo++;
                } 
                
                
                else {
                   echo "
                    <div class = 'day'>".$dayNo."</div>";
                    $dayNo++; 
                }
            
            
            }
            if ($dayCount%7 == 0) { //creates new week column
                echo "
                </div>
                <div class = 'column'>";
            }
        }



?>

<form action = '' method = 'post'>
    <button name = 'prev' value = 'previous'>Prev</button>
</form>
<form action = '' method = 'post'>
    <button name = 'next' value = 'next'>Next</button>
</form>

<!--Is there an alternative to display current month on reload without user input?-->
<form action = '' method = 'post'>
    <button name = 'now' value = 'now'>Back to Current Month</button>
</form>

</body>
</html>
