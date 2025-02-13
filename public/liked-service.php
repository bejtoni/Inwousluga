<?php
$indexPath = "../";
$logoPath = "../assets/inwousluga-logo.svg";
$addServicePath = "./add-provider-service.php";
$likedServicePath = "./liked-service.php";
$collaborationsPath = "./collaborations.php";
$profilePath = "./profile.php";
$loginPath = "./login.php";
$logoutPath = "../php/logout.php";
$php = "../php/db.php";
?>

<?php
session_start();

include "../php/check-loggged.php";

include "../php/db.php";

$userID = $_SESSION["user_id"] ?? false;


$sql = "SELECT * FROM liked_service WHERE User_ID = " . $userID;

$likedServices = mysqli_query($db, $sql);
$likedServices2 = mysqli_query($db, $sql);

$hrefNone = "../index.php";

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liked Service</title>

    <link rel="stylesheet" href="../styles/general.css" />

    <link rel="stylesheet" href="../styles/style.css" />

    <link rel="stylesheet" href="../php/service/service.css" />

    <link rel="stylesheet" href="../php/site-header/site-header.css" />

    <link rel="stylesheet" href="../php/footer/footer.css" />

    <link rel="stylesheet" href="../php/header/header.css" />

    <link rel="stylesheet" href="../styles/media.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<?php include "../php/header/header.php" ?>

<body>

    <section class="section section-liked-services">

        <?php include "../php/site-header/site-header.php" ?>


        <div class="container margin-bottom-xsm">
            <span class="subheading">LIKED</span>
            <h1 class="heading-primary">The Services You Like</h1>
        </div>

        <div class="container grid grid--2-cols services-list margin-bottom-md">
            <?php while ($red = mysqli_fetch_assoc($likedServices)): ?>
                <div>
                    <?php $row = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM provider_service WHERE psid = " . $red["Provider_Service_ID"])) ?>
                    <?php $isLiked = true; ?>

                    <?php $hrefNone = "./services.php?q=" . $row["Service_ID"] . "&provider=" . $red["Provider_Service_ID"] ?>
                    <?php include "../php/service/service.php" ?>

                    <div class="service-addition service-addition-padding">
                        <div>
                            <span></span>
                            <span><?= $red["Comment"] ?></span>
                        </div>
                        <?php $dislikeServiceId = $red["LSID"]; ?>
                        <a href=<?= "../php/delete-liked-service.php?q=" . $red["LSID"] ?>>
                            <i class="fa-solid fa-x"></i>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>


    </section>

    <script src="../js/script.js"></script>
</body>

<?php include "../php/footer/footer.php" ?>

</html>