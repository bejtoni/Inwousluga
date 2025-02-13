<?php

session_start();

if (isset($_SESSION['is_admin'])) {
  if ($_SESSION['is_admin'] === "1") {
    header("Location: ../public/admin.php");
    exit();
  } else {
    header("Location: ../index.php");
    exit();
  }
} else {
  // Handle the case where 'is_admin' is not set
  header("Location: ../index.php");
  exit();
}