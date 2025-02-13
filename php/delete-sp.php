<?php
session_start();
include "../php/db.php";

include "../php/check-admin.php";

if (isset($_GET['psid'])) {
    $psid = $_GET['psid'];

    $deleteSql = "DELETE FROM provider_service WHERE PSID = '$psid'";
    mysqli_query($db, $deleteSql);

    $_SESSION['message'] = "User deleted successfully.";
    header("Location: ../public/admin.php?q=provider_service");
    exit();
} else {
    $_SESSION['error'] = "User ID is required.";
    header("Location: ../public/admin.php?q=provider_service");
    exit();
}
