<?php
include("include\initialize.php");
$result = dbQuery("SHOW TABLES")->fetchAll();
var_dump($result);

