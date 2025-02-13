<?php

session_start();

include "db.php";

$updateStatusSQL = "UPDATE collaboration 
SET Status = 'f'
WHERE CID = " . $_GET["q"];

mysqli_query($db, $updateStatusSQL);

header('Location: ' . $_SERVER['HTTP_REFERER']);