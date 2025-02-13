<?php
// Include your database connection
include "../php/db.php";

// Debugging: Confirm the file is being accessed
echo "Debug: get-services.php accessed\n";
error_log("Debug: get-services.php accessed");

// Check if the categoryId is provided and is a valid integer
if (isset($_GET['categoryId']) && is_numeric($_GET['categoryId'])) {
  $categoryId = $_GET['categoryId'];

  // Debugging: Log the received categoryId
  echo "Debug: categoryId = " . $categoryId . "\n";
  error_log("Debug: categoryId = " . $categoryId);

  // Prepare a query to fetch services based on the selected category
  $query = "SELECT * FROM service WHERE Category = $categoryId";

  // Execute the query
  $result = mysqli_query($db, $query);

  // Debugging: Log the query execution status
  if (!$result) {
    echo "Debug: Query failed\n";
    error_log("MySQL Error: " . mysqli_error($db));
  }

  // Check if there are any results
  if ($result && mysqli_num_rows($result) > 0) {
    // Build options for the select element
    $options = '';
    while ($row = mysqli_fetch_assoc($result)) {
      $options .= '<option value="' . $row['CID'] . '">' . $row['ServiceName'] . '</option>';
    }

    // Output the options
    echo $options;
  } else {
    // If no services found for the selected category, output a default option
    echo '<option value="">No services found</option>';
  }
} else {
  // If categoryId is not provided or not valid, return an error message
  echo '<option value="">Invalid request</option>';
}

// Debugging statements
error_log("Category ID: " . (isset($categoryId) ? $categoryId : "Not set"));
error_log("Query: " . (isset($query) ? $query : "No query executed"));
?>