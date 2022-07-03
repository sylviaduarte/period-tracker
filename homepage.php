<html>
<head>
    <link rel = 'stylesheet' href = 'style.css'/>
</head>
<body>

<?php
include ('include/initialize.php');

#find period lengths & store in array
$periodDates = fetchAllPeriodDates();
$periodLengths = array();
foreach ($periodDates as $array) {
    $periodStart = turnStringToDTO($array['startDate']);
    $periodEnd = turnStringToDTO($array['endDate']);
    $periodLength = date_diff($periodEnd, $periodStart)->format('%d');
    $periodLengths[] = $periodLength;
}

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

# $_GET['month'] = string -> convert to DTO -> post requests do date math 
# with DTOs and then converts result to string to put in $_GET
# then we generate a new url with the parameters

$monthAsString = $_GET['month'];

debugOutput($monthAsString);

$yearOfMonth = $_GET['year'];

debugOutput($yearOfMonth);

$monthAsDTO = turnStringToDTO ($monthAsString." ".$yearOfMonth);

debugOutput($monthAsDTO);

#no $_GET var = first page load = display current month
if (!isset ($_GET['month']) || $_GET['month'] == "") { 
    $monthAsDTO = new DateTime();
    $monthAsString = $monthAsDTO->format('F');
    $yearOfMonth = $monthAsDTO->format('Y');
}

#date variables
$monthAsNo = $monthAsDTO ->format('n');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN,$monthAsNo,$yearOfMonth);


?>



<h1>period tracker.</h1>

<main>

    <section class = 'calendar-container'>
        <div class = 'month-name'>
            <!-- change with php later -->
            <h3><?=$monthAsString?> <?=$yearOfMonth?></h3>
            <div class = 'cal-arrows'>
                <h3><a class = 'arrow-link' href ="<?php getPrevMonthURL($monthAsDTO); ?>" style = 'text-decoration: none; color: var(--dark-gray)'> < </a></h3>
                <h3><a class = 'arrow-link' href = "<?php getNextMonthURL($monthAsDTO); ?>" style = 'text-decoration: none; color: var(--dark-gray)'> > </a></h3>
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
                <h4>1</h4>
                <h4>2</h4>
                <h4>3</h4>
                <h4 id = 'yo'>4</h4>
                <h4 class = 'today'>5</h4>
                <h4 class = 'today'>6</h4>
                <h4 class = 'today'>7</h4>
            </div>
            <div class = 'cal-row'>
                <h4 class = 'today'>8</h4>
                <h4 class = 'today'>9</h4>
                <h4>10</h4>
                <h4>11</h4>
                <h4>12</h4>
                <h4>13</h4>
                <h4>14</h4>
            </div>
            <div class = 'cal-row'>
                <h4>8</h4>
                <h4>9</h4>
                <h4>10</h4>
                <h4>11</h4>
                <h4>12</h4>
                <h4>13</h4>
                <h4>14</h4>
            </div>
            <div class = 'cal-row'>
                <h4>8</h4>
                <h4>9</h4>
                <h4>10</h4>
                <h4>11</h4>
                <h4>12</h4>
                <h4>13</h4>
                <h4>14</h4>
            </div>
            <div class = 'cal-row'>
                <h4>8</h4>
                <h4>9</h4>
                <h4>10</h4>
                <h4>11</h4>
                <h4>12</h4>
                <h4>13</h4>
                <h4>14</h4>
            </div>
            <div class = 'cal-row'>
                <h4>8</h4>
                <h4>9</h4>
                <h4>10</h4>
                <h4>11</h4>
                <h4>12</h4>
                <h4>13</h4>
                <h4>14</h4>
            </div>
    </section>
    <section class = 'text-container'>
        <!--changed with php later !-->
        <p>status: off your period</p>
        <h2>your period is in <br> <span>3 days.</span></h2>
        <button>start period!</button>
    </section>

</main>

</body>