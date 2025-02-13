<?php

include "./db.php";

mysqli_query($db, "DELETE FROM liked_service where LSID = " . $_GET["q"]);

header('Location: ' . $_SERVER['HTTP_REFERER']);
