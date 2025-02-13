<?php
include "db.php";  // Assuming db.php is in the same directory as search.php

if (isset($_POST['search'])) {
  $searchParam = $_POST['search'];

  if (!isset($searchParam) || $searchParam == "") {
    echo json_encode([]);
    return;
  }

  $inputedCategory = mysqli_real_escape_string($db, $searchParam);

  $query = "SELECT * FROM category WHERE Category_Type LIKE '%" . $inputedCategory . "%'";
  $response = mysqli_query($db, $query);

  $categories = [];
  while ($row = mysqli_fetch_assoc($response)) {
    $categories[] = $row;
  }

  echo json_encode($categories);
} else {
  echo json_encode([]);
}