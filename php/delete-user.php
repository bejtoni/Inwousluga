<?php
session_start();
include "../php/db.php";

include "../php/check-admin.php";

if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    $deleteSql = "DELETE FROM users WHERE UID = '$uid'";
    mysqli_query($db, $deleteSql);

    $_SESSION['message'] = "User deleted successfully.";
    header("Location: ../public/admin.php?q=users");
    exit();
} else {
    $_SESSION['error'] = "User ID is required.";
    header("Location: ../public/admin.php?q=users");
    exit();
}
