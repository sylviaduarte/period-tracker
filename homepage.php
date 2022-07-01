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

if (isset($_POST['<'])) {

}
if (isset($_POST['>'])) {
    
}
#date variables



#experiment



?>
<form action = 'homepage.php' method = 'post'>
    <button name = '<'><</button>
    <button name = '>'>></button>
</form>

<h1>period tracker.</h1>

<main>

    <section class = 'calendar-container'>
        <div class = 'month-name'>
            <!-- change with php later -->
            <h3>June 2022</h3>
            <div class = 'cal-arrows'>
                <h3><</h3>
                <h3>></h3>
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