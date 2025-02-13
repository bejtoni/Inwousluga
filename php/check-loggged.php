<?php

if (!($_SESSION['authenticated'] ?? false)) {

  $_SESSION['msg'] = 'You need to login in order to access requested page';

  header('Location: ../index.php');

  // exit;
}