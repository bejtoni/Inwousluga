<?php

session_start();

include "db.php";

mysqli_query($db, 'INSERT INTO liked_service (Comment, Date_Liked, User_ID, Provider_Service_ID) VALUES("", SYSDATE(), ' . $_SESSION["user_id"] . ', ' . $_GET["q"] . ')');

header('Location: ' . $_SERVER['HTTP_REFERER']);