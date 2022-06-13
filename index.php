<?php
include ('include/initialize.php');
?>


<html>
<head>
</head>
<body>

  <h1>History</h1>
  <h2>Assume your cycle length is <span> 30 days </span></h2>

      <?php

    ##################################################
    //           PLAN FOR PERIOD DATA:

    ## 1: fetch all period dates from SQL -> returns dates in form of array 
    ## 2: convert dates to DateTime objects 
    ## 3: find difference in two dates: today and last period start date 

    ##################################################


    #returns query of dates as array of strings
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

  <h2>Your next period is coming in <span><?php echo $daysUntilNextPeriod?></span> days. </h2>
  <h3>AKA on <?php echo convertDateTimeToMDYFormat($nextPeriodStartDate) ?>.</h3>

</body>
</html>

<style>
  span {
    color: red;
  }
</style>



