<?php

function debugOutput($input){
    echo "<pre>";
    var_dump($input);
    echo "</pre>";
}


function convertDateToMDY($dateToConvert) {
    $datePosted = $dateToConvert;
    $datePosted = new DateTime($datePosted);
    $datePosted = $datePosted->format('m-d-Y');
    return $datePosted;
}