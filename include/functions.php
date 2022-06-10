<?php

function debugOutput($input){
    echo "<pre>";
    var_dump($input);
    echo "</pre>";
}


function convertDateToMDY($dateToConvert) {
    $datePosted= new DateTime($dateToConvert);
    $datePosted = $datePosted->format('m-d-Y');
    return $datePosted;
}

function fetchPeriodDates () {
    $dates = dbQuery(' 
          SELECT startDate, endDate 
          FROM periods
        ')->fetchAll();
    return $dates;
}