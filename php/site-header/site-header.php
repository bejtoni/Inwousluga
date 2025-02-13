<?php


if (isset($_SESSION["authenticated"])) {

    // include "../php/db.php";
    include $php;

    $_SESSION["user_name"] = $name = mysqli_fetch_assoc(mysqli_query($db, "SELECT First_Name from users WHERE UID=" . $_SESSION["user_id"]))["First_Name"];

}

?>

<div class="container grid grid--2-cols heading-site margin-bottom-md">
    <p>Hello <span class="bold dark-gray"><?= $_SESSION["user_name"] ?? "User" ?></span></p>
    <p class="current-date">
    </p>
</div>