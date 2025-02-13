<?php
session_start();
session_unset();
session_destroy();
sleep(1);
header("Location: ../index.php");
exit;