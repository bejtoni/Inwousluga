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

$selectMyServices = "SELECT * FROM provider_service WHERE User_ID = " . $_GET["q"];
$selectMyServiesRes = mysqli_query($db, $selectMyServices);

$providerSql = "SELECT * FROM users WHERE UID =" . $_GET["q"];
$providerRes = mysqli_query($db, $providerSql);
$provider = mysqli_fetch_assoc($providerRes);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>

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
  <?php include "../php/header/header.php" ?>
  <main>

    <section class="section provider-section">
      <div class="container provider-container grid">
        <div class="service-icon">
          <i class="fa-regular fa-user"></i>
        </div>
        <div class="provider-right">

          <h2 class="heading-secondary"><?= $provider["First_Name"] . $provider["Last_Name"] ?></h2>

          <div class="total-rating-container">
            <span>Total rating:</span>
            <div>
              <?php for (
                $i = 0;
                $i < $provider["Total_Rating"];
                $i++
              ): ?>
                <!-- <i class="fa-regular fa-star"></i> -->
                <i class="fa-solid fa-star"></i>
              <?php endfor; ?>
              <?php for (
                $i = 0;
                $i < 5 - $provider["Total_Rating"];
                $i++
              ): ?>
                <i class="fa-regular fa-star"></i>
                <!-- <i class="fa-solid fa-star"></i> -->
              <?php endfor; ?>
            </div>
          </div>

          <div>
            <i class="fa-solid fa-envelope"></i>
            <a class="service-links" href="<?= $provider["Email"] ?>"><?= $provider["Email"] ?></a>
          </div>


          <div>
            <i class="fa-solid fa-phone"></i>
            <a class="service-links" href="<?= $provider["Phone"] ?>"><?= $provider["Phone"] ?></a>
          </div>
        </div>
      </div>

    </section>

    <section class="section my-services-section">


      <div class="container margin-bottom-xsm">
        <span class="subheading"><?= $provider["First_Name"] ?></span>
        <h1 class="heading-primary">The Services <?= $provider["First_Name"] ?> Provides</h1>
      </div>

      <div class="container grid grid--2-cols services-list margin-bottom-md">
        <?php while ($row = mysqli_fetch_assoc($selectMyServiesRes)): ?>
          <?php $hrefNone = "./services.php?q=" . $row["Service_ID"] . "&provider=" . $row["PSID"] ?>
          <?php include "../php/service/service.php" ?>
        <?php endwhile; ?>
      </div>


    </section>

  </main>

  <?php include "../php/footer/footer.php" ?>

  <script src="../js/script.js"></script>
</body>

</html>