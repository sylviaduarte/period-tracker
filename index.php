<?php
include ('include/initialize.php');
?>


<html>
<head>
</head>
<body>

  <h1>History</h1>

    <p>Assume that your expected cycle is 25 days!</p>

  <h2>Previous periods:</h2>

      <?php

      $periodDates = fetchAllPeriodDates();

      foreach ($periodDates as $row) {
        echo "Started on ".convertDateToMDY($row['startDate']).". Ended on ".convertDateToMDY($row['endDate'])."<br><br>";
        // echo "Started on ".fetchPeriodStartDate($row['periodId']).". Ended on ".fetchPeriodEndDate($row['periodId'])."<br><br>"
        // echo $row['periodId'];
      }

      // echo fetchPeriodStartDate(1);

      
      // $nextPeriodArray = (findNextPeriod(fetchPeriodStartDate(4), 25));
      echo "<br><br>";

      $lastPeriod = end($periodDates);

      $startDateOfLastPeriod = $lastPeriod['startDate'];

      // var_dump($startDateOfLastPeriod);
      echo "<h2> Your next period is ";
      echoNextPeriod($startDateOfLastPeriod, 25);
      echo "<br><br>";
      echo returnNextPeriod($startDateOfLastPeriod, 25);
      echo "<br><br><br>";

      // $myDate = date("d-m-y h:i:s");
     
// Display the date and time 
// echo $myDate; 

  $today = (date_create('now'))->format('Y-m-d h:m:s');     
  var_dump($today);

  
      echo $startDateOfLastPeriod;
      echo "<br><br>";

      $date1 = date_create($startDateOfLastPeriod);
      $date2 = date_create(returnNextPeriod($startDateOfLastPeriod, 25));

      // $date1 = $date1['date'];
      // $date2 = $date2['date'];
      $interval = (date_diff($date1, $date2))->format('%R%d days');

     echo $interval;

     echo "<br><br>"

      var_dump(getCurrentDate());

    

    //  echo findDateDifferenceFromToday('2022-09-06 09:00:00');

    // $dt = new DateTime();
    // echo $dt->format('Y-m-d H:i:s');
    //  debugOutput($interval);

      // var_dump($date1);


      // findDaysUntilNextPeriod(returnNextPeriod($startDateOfLastPeriod, 25));

      // echo findDayDifference('2022-01-02 09:00:00');
      // var_dump (findNextPeriod($startDateOfLastPeriod, 25));

      // var_dump (findDaysUntilNextPeriod (findNextPeriod($startDateOfLastPeriod, 25)));

      // $nextPeriodArray = echoNextPeriod(fetchPeriodStartDate(1), 3);

      // debugOutput($nextPeriodArray[0]);
      ?>

  <h2>Your next period is coming in X days. </h2>

</body>
</html>



