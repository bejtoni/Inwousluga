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
?>


<?php


include "../php/db.php";

$service = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM service WHERE SID = " . $_GET["q"]));


$categoryServicesQuery = "SELECT ps.*, u.* FROM provider_service ps JOIN users u ON ps.User_ID = u.UID WHERE ps.Service_ID = " . $_GET["q"];
$likedServicesQuery = "SELECT * FROM liked_service WHERE User_ID = " . $_SESSION["user_id"];

$categoryServies = mysqli_query($db, $categoryServicesQuery);
$categoryServies2 = mysqli_query($db, $categoryServicesQuery);
$likedServices = mysqli_query($db, $likedServicesQuery);


$arr = [];
while ($red = mysqli_fetch_assoc($likedServices)) {
    $r = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM provider_service WHERE psid = " . $red["Provider_Service_ID"]));
    if ($r["Service_ID"] == $_GET["q"])
        array_push($arr, $r["PSID"]);
}

if (isset($_GET["provider"])) {

    $serviceProviderSql = "SELECT * FROM provider_service WHERE PSID=" . $_GET["provider"];

    $serviceProviderRes = mysqli_query($db, $serviceProviderSql);

    $selectedServiceProvider = mysqli_fetch_assoc($serviceProviderRes);

    $serviceProviderSql = "SELECT * FROM provider_service WHERE PSID=" . $_GET["provider"];

    $provider = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM liked_service WHERE User_ID = " . $_SESSION["user_id"] . " AND Provider_Service_ID = " . $_GET["provider"]));


    $isProviderLiked = isset($provider);


}

/*
if (isset($_POST) && isset($_POST["comment"])) {
    $commentSql = "UPDATE liked_service SET Comment = '" . $_POST["comment"] . "' WHERE LSID = " . $provider["LSID"];

    mysqli_query($db, $commentSql);

    $provider = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM liked_service WHERE User_ID = " . $_SESSION["user_id"] . " AND Provider_Service_ID = " . $_GET["provider"]));

}
*/

if (isset($_POST) && isset($_POST["comment"])) {
    $comment = mysqli_real_escape_string($db, $_POST["comment"]);
    $commentSql = "UPDATE liked_service SET Comment = '$comment' WHERE LSID = " . intval($provider["LSID"]);

    mysqli_query($db, $commentSql);

    $provider = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM liked_service WHERE User_ID = " . intval($_SESSION["user_id"]) . " AND Provider_Service_ID = " . intval($_GET["provider"])));
}


if (isset($_POST) && isset($_POST["collaborate"])) {
    $sendCollabRequestSql = "INSERT INTO collaboration(Status, Service_User_Message, User_ID, Provider_Service_ID, Date_Requested) VALUES ('p', '" . $_POST["collaborate-comment"] . "', '" . $_SESSION["user_id"] . "', '" . $_POST["collaborate"] . "', SYSDATE());";

    mysqli_query($db, $sendCollabRequestSql);

}

$edit = false;

if (isset($_POST) && isset($_POST["edit"])) {
    $edit = true;
}

/*
if (isset($_POST) && isset($_POST["confirm-edit"])) {

    // $editSql = "UPDATE provider_service SET 
    // Name_Of_Service = '" . $_POST["service-name"] . "', 
    // Location = '" . $_POST["location"] . "',
    // Telephone_Number = '" . $_POST["telephone"] . "',
    // Description = '" . $_POST["description"] . "',
    // Website = '" . $_POST["website"] . "',
    // Email = '" . $_POST["email"] . "'
    // WHERE PSID = " . $_GET["provider"] . ";";
    $editSql = "UPDATE provider_service SET 
    Name_Of_Service = '" . mysqli_real_escape_string($db, $_POST["service-name"]) . "', 
    Location = '" . mysqli_real_escape_string($db, $_POST["location"]) . "',
    Telephone_Number = '" . mysqli_real_escape_string($db, $_POST["telephone"]) . "',
    Description = '" . mysqli_real_escape_string($db, $_POST["description"]) . "',
    Website = '" . mysqli_real_escape_string($db, $_POST["website"]) . "',
    Email = '" . mysqli_real_escape_string($db, $_POST["email"]) . "'
    WHERE PSID = " . intval($_GET["provider"]) . ";";

    mysqli_query($db, $editSql);

    $serviceProviderSql = "SELECT * FROM provider_service WHERE PSID=" . $_GET["provider"];

    $serviceProviderRes = mysqli_query($db, $serviceProviderSql);

    $selectedServiceProvider = mysqli_fetch_assoc($serviceProviderRes);

    $serviceProviderSql = "SELECT * FROM provider_service WHERE PSID=" . $_GET["provider"];

    $provider = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM liked_service WHERE User_ID = " . $_SESSION["user_id"] . " AND Provider_Service_ID = " . $_GET["provider"]));


    $isProviderLiked = isset($provider);

    $edit = false;
}
*/
if (isset($_POST) && isset($_POST["confirm-edit"])) {
    $serviceName = mysqli_real_escape_string($db, $_POST["service-name"]);
    $location = mysqli_real_escape_string($db, $_POST["location"]);
    $telephone = mysqli_real_escape_string($db, $_POST["telephone"]);
    $description = mysqli_real_escape_string($db, $_POST["description"]);
    $website = mysqli_real_escape_string($db, $_POST["website"]);
    $email = mysqli_real_escape_string($db, $_POST["email"]);

    $editSql = "UPDATE provider_service SET 
                Name_Of_Service = '$serviceName', 
                Location = '$location',
                Telephone_Number = '$telephone',
                Description = '$description',
                Website = '$website',
                Email = '$email'
                WHERE PSID = " . intval($_GET["provider"]);

    mysqli_query($db, $editSql);

    $serviceProviderSql = "SELECT * FROM provider_service WHERE PSID=" . intval($_GET["provider"]);
    $serviceProviderRes = mysqli_query($db, $serviceProviderSql);
    $selectedServiceProvider = mysqli_fetch_assoc($serviceProviderRes);

    $provider = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM liked_service WHERE User_ID = " . intval($_SESSION["user_id"]) . " AND Provider_Service_ID = " . intval($_GET["provider"])));

    $isProviderLiked = isset($provider);

    $edit = false;
}

// }


$num = 5;


?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service - <?= $service["Service_Name"] ?></title>

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

<body>

    <?php require_once '../php/header/header.php' ?>

    <section class="section services-section">

        <?php include "../php/site-header/site-header.php" ?>

        <div class="container margin-bottom-xsm">
            <span class="subheading"><?= $service["Service_Name"] ?></span>
            <h1 class="heading-primary">Choose The Service You Want From <span
                    class="highlight"><?= $service["Service_Name"] ?></span>
            </h1>
        </div>

        <div class="container grid grid--2-cols services-list">

            <?php if (!isset($_GET["provider"])): ?>

                <?php while ($row = mysqli_fetch_assoc($categoryServies)): ?>
                    <?php $isLiked = in_array($row["PSID"], $arr) ?>
                    <?php $isLiked && $row["User_ID"] != $_SESSION["user_id"] ? include "../php/service/service.php" : "" ?>
                <?php endwhile; ?>

                <?php while ($row = mysqli_fetch_assoc($categoryServies2)): ?>
                    <?php $isLiked = in_array($row["PSID"], $arr) ?>
                    <?php !$isLiked && $row["User_ID"] != $_SESSION["user_id"] ? include "../php/service/service.php" : "" ?>
                <?php endwhile; ?>

            <?php endif; ?>

            <?php if (isset($_GET["provider"])): ?>
                <div class="services-list--service grid">
                    <form method="POST" class="grid">
                        <div class="service-list-contact">

                            <div class="service-icon">
                                <i class="fa-regular fa-user"></i>
                            </div>

                            <div>
                                <i class="fa-solid fa-globe"></i>
                                <?php if (!$edit): ?>
                                    <a class="service-links"
                                        href="<?= $selectedServiceProvider["Website"] ?>"><?= $selectedServiceProvider["Website"] ?></a>
                                <?php endif; ?>
                                <?php if ($edit): ?>
                                    <input class="service-links input-text" value="<?= $selectedServiceProvider["Website"] ?>"
                                        name="website" />
                                <?php endif; ?>
                            </div>
                            <div>
                                <i class="fa-solid fa-envelope"></i>
                                <?php if (!$edit): ?>
                                    <a class="service-links"
                                        href="<?= $selectedServiceProvider["Email"] ?>"><?= $selectedServiceProvider["Email"] ?></a>
                                <?php endif; ?>
                                <?php if ($edit): ?>
                                    <input class="service-links input-text" value="<?= $selectedServiceProvider["Email"] ?>"
                                        name="email" />
                                <?php endif; ?>
                            </div>
                            <div>
                                <i class="fa-solid fa-location-dot"></i>
                                <?php if (!$edit): ?>
                                    <a class="service-links"
                                        href="<?= $selectedServiceProvider["Location"] ?>"><?= $selectedServiceProvider["Location"] ?></a>
                                <?php endif; ?>
                                <?php if ($edit): ?>
                                    <input class="service-links input-text" value="<?= $selectedServiceProvider["Location"] ?>"
                                        name="location" />
                                <?php endif; ?>
                            </div>
                            <div>
                                <i class="fa-solid fa-phone"></i>
                                <?php if (!$edit): ?>
                                    <a class="service-links"
                                        href="<?= $selectedServiceProvider["Telephone_Number"] ?>"><?= $selectedServiceProvider["Telephone_Number"] ?></a>
                                <?php endif; ?>
                                <?php if ($edit): ?>
                                    <input class="service-links input-text"
                                        value="<?= $selectedServiceProvider["Telephone_Number"] ?>" name="telephone" />
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="service-properties-container">
                            <?php if (!$edit): ?>
                                <h3>
                                    <?= $selectedServiceProvider["Name_Of_Service"] ?>
                                </h3>
                            <?php endif; ?>
                            <?php if ($edit): ?>
                                <h3>Service Title</h3>
                                <input value="<?= $selectedServiceProvider["Name_Of_Service"] ?>" class="input-text"
                                    name="service-name"></input>
                            <?php endif; ?>


                            <div class="total-rating-container margin-bottom-xsm">
                                <span>Total rating:</span>
                                <div>
                                    <?php for (
                                        $i = 0;
                                        $i < $selectedServiceProvider["Total_Service_Rating"];
                                        $i++
                                    ): ?>
                                        <!-- <i class="fa-regular fa-star"></i> -->
                                        <i class="fa-solid fa-star"></i>
                                    <?php endfor; ?>
                                    <?php for (
                                        $i = 0;
                                        $i < 5 - $selectedServiceProvider["Total_Service_Rating"];
                                        $i++
                                    ): ?>
                                        <i class="fa-regular fa-star"></i>
                                        <!-- <i class="fa-solid fa-star"></i> -->
                                    <?php endfor; ?>
                                </div>
                            </div>

                            <?php if (!$edit): ?>
                                <p class="paragraph"><?= $selectedServiceProvider["Description"] ?></p>
                            <?php endif; ?>
                            <?php if ($edit): ?>
                                <p>Description</p>
                                <input value="<?= $selectedServiceProvider["Description"] ?>" class="input-text"
                                    name="description"></input>
                            <?php endif; ?>
                        </div>

                        <?php if ($edit): ?>
                            <button type="submit" class="button">Confirm</button>
                        <?php endif; ?>
                        <input name="confirm-edit" class="none" />
                    </form>



                    <div class="service-buttons non-transparent margin-bottom-xsm">
                        <form method="POST">
                            <?php if (!$edit && ($selectedServiceProvider["User_ID"] == $_SESSION["user_id"])): ?>
                                <button class="button">Edit</button>
                            <?php endif; ?>

                            <input value="edit" name="edit" class="none" />
                        </form>

                        </form>
                        <?php if ($selectedServiceProvider["User_ID"] != $_SESSION["user_id"]): ?>
                            <a class="button"
                                href="<?= $isProviderLiked ? "../php/delete-liked-service.php?q=" . $provider["LSID"] : "../php/like-service.php?q=" . $_GET["provider"] ?>">
                                <?= $isProviderLiked ? "Dislike" : "Like" ?>
                                <i class="fa-<?= $isProviderLiked ? "solid" : "regular" ?> fa-heart"></i>
                            </a>
                        <?php endif; ?>
                    </div>

                    <?php if ($selectedServiceProvider["User_ID"] != $_SESSION["user_id"]): ?>
                        <div class="comment-container">
                            <form method="POST">
                                <h3>Leave Messege To The <?= $selectedServiceProvider["Name_Of_Service"] ?></h3>
                                <textarea class="input-text margin-bottom-xsm" name="collaborate-comment"
                                    placeholder="Hey, I need quick fix on my house."></textarea>
                                <button class="button">Collaborate<i class="fa-regular fa-handshake"></i></button>
                                <input class="none" name="collaborate" value=<?= $_GET["provider"] ?> />
                            </form>
                        </div>
                    <?php endif; ?>

                    <?php if ($isProviderLiked): ?>
                        <div class="comment-container">
                            <?php if (!isset($provider["Comment"]) || $provider["Comment"] == null || $provider["Comment"] == ""): ?>
                                <h3>Your Note About <?= $selectedServiceProvider["Name_Of_Service"] ?></h3>
                                <form method="POST">
                                    <textarea class="input-text margin-bottom-xsm" name="comment" placeholder="Comment"></textarea>
                                    <button type="submit" class="button">Comment</button>
                                </form>
                            <?php endif; ?>

                            <?php if (isset($provider["Comment"]) && $provider["Comment"] != null && $provider["Comment"] != ""): ?>
                                <h3>Comment</h3>
                                <form method="POST">

                                    <input class="input-text margin-bottom-xsm commented" name="comment" placeholder="Comment"
                                        value='<?= $provider["Comment"] ?>'>
                                    </input>

                                    <button type="submit" class="button">Edit</button>
                                </form>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>



        </div>
    </section>

    <?php require_once '../php/footer/footer.php' ?>

    <script src="../js/script.js"></script>
</body>

</html>