<?php
include ('include/initialize.php');
?>


<html>
<head>
  <link rel = 'stylesheet' href = 'style.css'/>
</head>
<body>

  <h1>History</h1>
  <h2>Assume your cycle length is <span> 30 days </span></h2>

    <?php
    $periodDates = fetchAllPeriodDates();
    
    #display all period dates
    foreach ($periodDates as $row) {
        $periodStart = turnStringToDTO($row['startDate']);
        $periodEnd = turnStringToDTO($row['endDate']);
        echo "Started on ".convertDateTimeToMDYFormat($periodStart).". 
        Ended on ".convertDateTimeToMDYFormat($periodEnd)."<br><br>";
      }

    #gets last index of array as string
    $lastPeriod = getLastPeriodDatesinArray($periodDates);
    
    #convert start date string to DateTime object
    $lastStartDate = turnStringToDTO($lastPeriod['startDate']);

    #find date of next period - assume cycle is 30 days
    #findStartDateOfNextPeriod($lastStartDate, $cycleLengthinDays)
    $nextPeriodStartDate = findStartDateOfNextPeriod($lastStartDate, 30);

    #find days until next period
    $daysUntilNextPeriod = findDateDifferenceFromToday($nextPeriodStartDate);
    
    #then convert interval to days as string!
    $daysUntilNextPeriod = convertDateTimeIntervalToDays($daysUntilNextPeriod);

    ?>

  <h2>Your next period is coming in <span><?= $daysUntilNextPeriod?></span> days. </h2>
  <h3>AKA on <?= convertDateTimeToMDYFormat($nextPeriodStartDate) ?>.</h3>

</body>
</html>


