<?php

$db = mysqli_connect("132.226.217.5", "admin", "Admin123.", "inwousluga");
// $db = mysqli_connect("localhost", "root", "Laganini123!", "inwousluga");
// $db = mysqli_connect("localhost", "root", "napoleonlm10", "inwobaza1");

if (mysqli_connect_errno()) {
  printf("", mysqli_connect_error());
}
