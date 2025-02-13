<?php
include "../php/db.php";

if (isset($_POST['categoryID'])) {
  $categoryID = $_POST['categoryID'];

  // Debug output
  error_log("Debug: get-services.php accessed");
  error_log("Debug: categoryId = " . $categoryID);

  $query = "SELECT * FROM service WHERE Category_ID = ?";
  $stmt = $db->prepare($query);

  if ($stmt === false) {
    error_log("Debug: prepare() failed: " . $db->error);
    die("prepare() failed: " . $db->error);
  }

  $stmt->bind_param("i", $categoryID);

  if ($stmt->execute() === false) {
    error_log("Debug: execute() failed: " . $stmt->error);
    die("execute() failed: " . $stmt->error);
  }

  $result = $stmt->get_result();

  if ($result === false) {
    error_log("Debug: get_result() failed: " . $stmt->error);
    die("get_result() failed: " . $stmt->error);
  }

  $services = [];
  while ($row = $result->fetch_assoc()) {
    $services[] = $row;
  }

  echo json_encode($services);
} else {
  echo json_encode([]);
}
