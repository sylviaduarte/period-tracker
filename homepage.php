<html>
<head>
    <link rel = 'stylesheet' href = 'style.css'/>
</head>

<body>

<?php
include ('include/initialize.php');

#find period lengths & store in array
$periodDates = fetchAllPeriodDates();


#fetch period start date (day, month, year) and store in 3d array
$periodStartDatesQuery = fetchPeriodStartDates();
$periodStartsAsStrings = array();
foreach ($periodStartDatesQuery as $key => $array) {
    foreach ($array as $subArray => $dateAsString) {
        $periodStartsAsString['dayNo'][] = turnStringToDTO($dateAsString)->format('j');
        $periodStartsAsString['monthName'][] = turnStringToDTO($dateAsString)->format('F');
        $periodStartsAsString['year'][] = turnStringToDTO($dateAsString)->format('Y');
    }
} 

// debugOutput ($periodStartsAsString);
# $_GET['month'] = string -> convert to DTO -> post requests do date math 
# with DTOs and then converts result to string to put in $_GET
# then we generate a new url with the parameters

// $monthAsString = $_GET['month'];

// $yearOfMonth = $_GET['year'];

// $monthAsDTO = turnStringToDTO ($monthAsString." ".$yearOfMonth);

#no $_GET var = first page load = display current month
if (!isset ($_GET['month']) || $_GET['month'] == "") { 
    $monthAsDTO = new DateTime();
    $monthAsString = $monthAsDTO->format('F');
    $yearOfMonth = $monthAsDTO->format('Y');
}

#date variables
$monthAsNo = $monthAsDTO ->format('n');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN,$monthAsNo,$yearOfMonth);
$firstDayNoOfMonth = getFirstDayOfMonth($monthAsDTO);
$firstWeekdayNo = getWeekNoOfDay($firstDayNoOfMonth);
$todayDayNo= getTodayDayNo();
$presentMonthAsDTO = new DateTime();
$presentMonthAsString = $presentMonthAsDTO->format('F');
$presentYear = $presentMonthAsDTO->format('Y');

#find date of next period - assume cycle is 30 days
$lastPeriod = end($periodDates);
$lastStartDate = turnStringToDTO($lastPeriod['startDate']);
$nextPeriodStartDate = findStartDateOfNextPeriod($lastStartDate, 30);
$daysUntilNextPeriod = findDateDifferenceFromToday($nextPeriodStartDate);
$daysUntilNextPeriod=$daysUntilNextPeriod->format('%d');




$dayUnit = 'days';
if ($daysUntilNextPeriod<2) {
    $dayUnit = 'day';
}


?>

  
<h1>period tracker.</h1>

<main>
<?php
getCalendar ("August", "2022");

 ?>
        
        </section>
    <section class = 'text-container'>
        <!--changed with php later !-->
        <p>status: off your period</p>
        <h2>your period is in <br> <span><?=$daysUntilNextPeriod?> <?=$dayUnit?>.</span></h2>
        <button>start period!</button>
    </section>

</main>

</body>

