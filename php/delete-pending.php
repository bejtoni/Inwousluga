<?php

include "db.php";

$deletePendingSql = "DELETE FROM collaboration WHERE CID = " . $_GET["q"];

mysqli_query($db, $deletePendingSql);

header('Location: ' . $_SERVER['HTTP_REFERER']);