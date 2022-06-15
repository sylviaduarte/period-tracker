<style>
    .col {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        margin: 0 100px;
    }

    .day {
        margin: 3vh;
        padding: 1vh;
        border-style: solid;
        border-color: black;
    }

    .hidden {
        margin: 3vh;
        padding: 1vh;
        border-style: solid;
        border-color: red;
        color: white;
    }

    h1 {
        text-align: center;
    }
</style>

<?php
include ('include/initialize.php');

## CALENDAR

## empty 2D array?

## buttons are inputs with method = post
    // [->] name - 'next month'
    // [<-] name - 'prev month'
    // names can be datetime objects


    #month

    #button is for next month - retrieves a dto?

//     for ($x = 0; $x <= 100; $x+=10) {
//         echo "<div class = 'day'>".$x."</div> <br>";
//       }

//       $number = cal_days_in_month(CAL_GREGORIAN, 8, 2003); // 31
// echo "There were {$number} days in August 2003";

// $date = new DateTime();
// $month = '';
// $year = '';




$monthDisplayed = new DateTime();

$monthDisplayedAsName = $monthDisplayed->format('F');

$monthDisplayedAsNo = $monthDisplayed->format('m');

$firstDayOfMonthDisplayed = new DateTime('first day of this month');
$weekNoOfFirstDayOfMonthDisplayed = $firstDayOfMonthDisplayed->format('w');

// $firstDayOfMonthDisplayed = date("Y-".$monthDisplayedAsNo."-01");

// $firstDayOfMonthDisplayed = $firstDayOfMonthDisplayed->format('w');

$date = new DateTime('2010-09-21');
$date->modify('first day of this month');
echo $date->format('r');

debugOutput($date);

$daysInMonthDisplayed = cal_days_in_month(CAL_GREGORIAN, 6, 2022);

debugOutput($monthDisplayed);

debugOutput ($firstDayOfMonthDisplayed);


echo "<h1>".$monthDisplayedAsName."</h1>";
echo "<div class = 'col'>
<div>Mon</div>
<div>Tues</div>
<div>Wed</div>
<div>Thurs</div>
<div>Fri</div>
<div>Sat</div>
<div>Sun</div>
</div>";
echo "<div class = 'col'>";

$j = 1;
for ($i = 1; $i <= 42; $i++){
    if ($i < $weekNoOfFirstDayOfMonthDisplayed || $j > $daysInMonthDisplayed) { //swap 31 for total days of month
    echo "
    <div class = 'hidden'>".$j."</div>
    ";
    }
    else if ($i >= $weekNoOfFirstDayOfMonthDisplayed) { // i = first day of month
        echo "<div class = 'day'>".$j."</div>";
        $j++;
    }
    if ($i%7 == 0) {
        echo "
        </div>
        <div class = 'col'>
        ";
    }
}

?>

<form action = '' method = 'post'>
    <button name = 'prev' value = 'previous'>Prev</button>
    <button name = 'next' value = 'next'>Next</button>
</form>

<?php
    


?>

</body>
</html>
