<?php
$indexPath = "../";
$logoPath = "../assets/inwousluga-logo.svg";
$addServicePath = "./add-provider-service.php";
$likedServicePath = "./liked-service.php";
$collaborationsPath = "./collaborations.php";
$profilePath = "./profile.php";
$loginPath = "../login.php";
$servicePath = "./services.php";
$logoutPath = "../php/logout.php";
?>

<?php

session_start();

include "../php/check-loggged.php";
include "../php/db.php";


if (isset($_POST) && isset($_POST["accept"]))
    mysqli_query($db, "UPDATE collaboration SET Status = 'a' WHERE CID = " . $_POST["accept"]);


if (isset($_POST) && isset($_POST["deny"]))
    mysqli_query($db, "DELETE FROM collaboration WHERE CID = " . $_POST["deny"]);


if (isset($_POST) && count($_POST) > 0 && isset($_POST["collab"]) && isset($_POST["comment"])) {
    $commentSql = "UPDATE collaboration SET Comment = '" . $_POST["comment"] . "' WHERE CID = " . $_POST["collab"];

    mysqli_query($db, $commentSql);

}


$incomingCollaborationsSQL = "SELECT u.First_Name as incFname, u.Last_Name as incLname, u.UID as incUID , c.* FROM collaboration c, users u, provider_service p WHERE u.UID = c.User_ID AND c.Status = 'p' AND c.Provider_Service_ID = p.PSID AND p.User_ID = " . $_SESSION["user_id"];

$incomingCollaborationsRes = mysqli_query($db, $incomingCollaborationsSQL);

// 
// 
// 
$currentCollaborationsSQL = "SELECT u.First_Name as incFname, u.Last_Name as incLname, u.UID as incUID , c.*, p.*, s.*
FROM collaboration c, users u, provider_service p, service s
WHERE p.User_ID = " . $_SESSION["user_id"] . " AND p.PSID = c.Provider_Service_ID AND c.Status = 'a' AND s.SID = p.Service_ID AND u.UID = c.User_ID";

$currentCollaborationsRes = mysqli_query($db, $currentCollaborationsSQL);
// 
// 
// 
$finishedCollaborationsSQL = "SELECT u.First_Name as incFname, u.Last_Name as incLname, u.UID as incUID , c.*, p.*, s.*
FROM collaboration c, users u, provider_service p, service s
WHERE p.User_ID = " . $_SESSION["user_id"] . " AND p.PSID = c.Provider_Service_ID AND c.Status = 'f' AND s.SID = p.Service_ID AND u.UID = c.User_ID";

$finishedCollaborationsRes = mysqli_query($db, $finishedCollaborationsSQL);
// 
// 
// 
$myPendingCollaborationsSQL = "SELECT u.First_Name as incFname, u.Last_Name as incLname, u.UID as incUID , c.*, p.* FROM collaboration c, users u, provider_service p WHERE u.UID = " . $_SESSION["user_id"] . " AND c.Status = 'p' AND c.User_ID = " . $_SESSION["user_id"] . " AND c.Provider_Service_ID = p.PSID ";

$myPendingCollaborationsRes = mysqli_query($db, $myPendingCollaborationsSQL);
// 
// 
// 
$myCurrentCollaborationsSQL = "SELECT u.First_Name as incFname, u.Last_Name as incLname, u.UID as incUID , c.*, p.*, s.* FROM collaboration c, users u, provider_service p, service s
WHERE c.User_ID = " . $_SESSION["user_id"] . " AND c.Provider_Service_ID = p.PSID AND p.User_ID = u.UID AND c.Status = 'a' AND p.Service_ID = s.SID";

$myCurrentCollaborationsRes = mysqli_query($db, $myCurrentCollaborationsSQL);

$myFinishedCollaborationsSQL = "SELECT u.First_Name as incFname, u.Last_Name as incLname, u.UID as incUID , c.*, p.*, s.* FROM collaboration c, users u, provider_service p, service s
WHERE c.User_ID = " . $_SESSION["user_id"] . " AND c.Provider_Service_ID = p.PSID AND p.User_ID = u.UID AND c.Status = 'f' AND p.Service_ID = s.SID";

$myFinishedCollaborationsRes = mysqli_query($db, $myFinishedCollaborationsSQL);
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Collaborations</title>

    <link rel="stylesheet" href="../styles/general.css" />

    <link rel="stylesheet" href="../styles/style.css" />

    <link rel="stylesheet" href="../php/service/service.css" />

    <link rel="stylesheet" href="../php/site-header/site-header.css" />

    <link rel="stylesheet" href="../php/footer/footer.css" />

    <link rel="stylesheet" href="../php/header/header.css" />

    <link rel="stylesheet" href="../styles/picker.css" />

    <link rel="stylesheet" href="../styles/media.css" />

    <link rel="stylesheet" href="../php/current-collaboration/current-collaboration.css" />

    <link rel="stylesheet" href="../php/requesting-collaboration/requesting-collaboration.css" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <?php include "../php/header/header.php" ?>

    <main>
        <section class="section section-new-collaborations">

            <div class="big-container margin-bottom-sm">
                <span class="subheading">Requests</span>
                <h2 class="heading-secondary">
                    <?= mysqli_num_rows($incomingCollaborationsRes) > 0 ? "You Have New Collaborations Requests" : "You Don't Have New Collaborations Requests" ?>
                </h2>
            </div>

            <div class="big-container flex flex-column">
                <?php while ($incomingCollaboration = mysqli_fetch_assoc($incomingCollaborationsRes)): ?>
                    <div class="incoming-collaboration">
                        <div class="incoming-collaboration-row">

                            <div class="incoming-collaboration-text">
                                <p><span><?= $incomingCollaboration["incFname"] . " " . $incomingCollaboration["incLname"] ?></span>
                                    is requesting collaboration</p>
                            </div>

                            <div class="flex flex-gap-sm">
                                <a href="./provider-profile.php?q=<?= $incomingCollaboration["incUID"] ?>"
                                    class="button button-pink">See <?= $incomingCollaboration["incFname"] ?></a>
                                <form method="POST">
                                    <button type="submit" class="button">Deny</button>
                                    <input name="deny" class="none" value="<?= $incomingCollaboration["CID"] ?>" />
                                </form>
                                <form method="POST">
                                    <button type="submit" class="button">Accept</button>
                                    <input name="accept" class="none" value="<?= $incomingCollaboration["CID"] ?>" />
                                </form>
                            </div>
                        </div>

                        <div class="flex flex-gap-sm">
                            <span class="subheading">Message:</span>
                            <p><?= $incomingCollaboration["Service_User_Message"] ?></p>
                        </div>

                    </div>
                <?php endwhile; ?>
            </div>

        </section>

        <section class="section section-current-collaborations">
            <div class="big-container margin-bottom-sm">
                <span class="subheading">Collaboration</span>
                <h2 class="heading-secondary">You Provide Service To</h2>
            </div>

            <!-- <div class="big-container flex flex-column flex-gap-sm margin-bottom-sm">
                <div class="filters">
                    <div class="filter-box filter-box-pink">
                        <p>Status</p>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="filter-box filter-box-pink">
                        <p>Year</p>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="filter-box filter-box-pink">
                        <p>Grade</p>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="filter-box">
                        <p>Tags</p>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="filter-box">
                        <p>Order By</p>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>

                <div class="tags">
                    <div class="tag-box">
                        <p>Liked</p>
                        <i class="fa-solid fa-x"></i>
                    </div>
                </div>
            </div> -->

            <div class="big-container grid current-collaborations-container">
                <div class="current-collaborations">

                    <?php while ($serviceTo = mysqli_fetch_assoc($currentCollaborationsRes)): ?>
                        <?php include "../php/current-collaboration/current-collaboration.php" ?>
                    <?php endwhile; ?>
                    <?php if ((mysqli_num_rows($currentCollaborationsRes) <= 0)): ?>

                    <?php endif; ?>

                    <?php while ($serviceTo = mysqli_fetch_assoc($finishedCollaborationsRes)): ?>
                        <?php include "../php/current-collaboration/current-collaboration.php" ?>
                    <?php endwhile; ?>

                    <?php if ((mysqli_num_rows($currentCollaborationsRes) <= 0) && (mysqli_num_rows($finishedCollaborationsRes) <= 0)): ?>
                        <img
                            src="https://cdn2.iconfinder.com/data/icons/oops-404-error/64/208_oops-face-emoji-emoticon-sad-512.png" />
                        <h3 style="text-align: center" class="margin-bottom-xsm">You do not currently provide service to
                            anyone.</h3>
                    <?php endif; ?>

                </div>

                <div class="right-picture">
                    <img class="background-img-part" src="../assets/construction.jpg" alt="construction" />
                </div>
            </div>
        </section>

        <section class="section section-pending-collaborations">
            <div class="big-container margin-bottom-sm">
                <span class="subheading">Request</span>
                <h2 class="heading-secondary">You Are Requesting Services from</h2>
            </div>

            <!-- <div class="big-container flex flex-column flex-gap-sm margin-bottom-sm"> -->
            <!-- <div class="filters">
                    <div class="filter-box filter-box-pink">
                        <p>Status</p>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="filter-box filter-box-pink">
                        <p>Year</p>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="filter-box filter-box-pink">
                        <p>Grade</p>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="filter-box">
                        <p>Tags</p>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="filter-box">
                        <p>Order By</p>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>

                <div class="tags">
                    <div class="tag-box">
                        <p>Liked</p>
                        <i class="fa-solid fa-x"></i>
                    </div>
                </div> -->
            <!-- </div> -->

            <div class="big-container grid current-collaborations-container">
                <div class="left-picture">
                    <img class="background-img-part" src="../assets/construction.jpg" alt="construction" />
                </div>

                <div class="current-collaborations">
                    <?php while ($serviceFrom = mysqli_fetch_assoc($myCurrentCollaborationsRes)): ?>
                        <?php include "../php/requesting-collaboration/requesting-collaboration.php" ?>
                    <?php endwhile; ?>
                    <?php while ($serviceFrom = mysqli_fetch_assoc($myFinishedCollaborationsRes)): ?>
                        <?php include "../php/requesting-collaboration/requesting-collaboration.php" ?>
                    <?php endwhile; ?>
                </div>


            </div>
        </section>

        <section class="section section-pending-collaborations">

            <div class="container margin-bottom-xsm">
                <span class="subheading">Collaboration Request</span>
                <h1 class="heading-primary">People You Want to Collaborate With</h1>
            </div>

            <div class="container grid grid--2-cols services-list">
                <div class="services-list-block services-list-left">
                    <div>
                        <?php while ($row = mysqli_fetch_assoc($myPendingCollaborationsRes)): ?>
                            <?php $hrefNone = "./services.php?q=" . $row["Service_ID"] . "&provider=" . $row["Provider_Service_ID"] ?>

                            <?php $isLiked = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM liked_service WHERE User_ID = " . $_SESSION["user_id"] . " AND Provider_Service_ID = " . $row["Provider_Service_ID"])) != null ?>
                            <?php include "../php/service/service.php" ?>
                            <div class="service-addition">
                                <div>
                                    <span>Pending Request: </span>
                                    <span><?php
                                    $currentDate = new DateTime();
                                    $startDate = new DateTime($row["Date_Requested"]);
                                    $interval = $currentDate->diff($startDate);
                                    $days = $interval->days;
                                    $hours = $interval->h + ($interval->days * 24);

                                    echo ($days == 0 ? "" : "days") . $hours . " hours";

                                    ?></span>
                                </div>
                                <a href="../php/delete-pending.php?q=<?= $row["CID"] ?>">

                                    <i class="fa-solid fa-x"></i>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>

                </div>
            </div>
        </section>

        <section class="section collaborations-likes-buttons-section">
            <div class="big-container grid grid--2-cols big-buttons">
                <a href="./profile.php" class="big-button collaborations-big-button">
                    <span> Check Your Profile</span>
                    <img src="../assets/hands.jpg" />
                    <div class="hue" aria-label="background"></div>
                </a>
                <a href="./liked-service.php" class="big-button liked-big-button">
                    <span>Liked Services</span>
                    <img src="../assets/like.jpg" />
                </a>
            </div>
        </section>

    </main>

    <?php include "../php/footer/footer.php" ?>

    <script src="../js/rating.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>