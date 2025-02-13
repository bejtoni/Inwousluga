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

$selectMyServices = "SELECT * FROM provider_service WHERE User_ID = " . $_SESSION["user_id"];
$selectMyServiesRes = mysqli_query($db, $selectMyServices);


if ($_POST) {
  $insertSql = "UPDATE users SET First_Name = '" . $_POST["name"] . "', Last_Name = '" . $_POST["surname"] . "', DOB = '" . $_POST["dateOfBirth"] . "', Phone = '" . $_POST["telephone"] . "', Email = '" . $_POST["email"] . "', Password = '" . $_POST["password"] . "' WHERE UID = " . $_SESSION["user_id"];

  mysqli_query($db, $insertSql);


}

$profileSql = "SELECT * FROM users WHERE UID = " . $_SESSION["user_id"];
$profileRes = mysqli_query($db, $profileSql);
$profile = mysqli_fetch_assoc($profileRes);

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

    <section class="section my-services-section">

      <?php include "../php/site-header/site-header.php" ?>


      <div class="container margin-bottom-xsm">
        <span class="subheading">YOURS</span>
        <h1 class="heading-primary">Services You Provide</h1>
      </div>

      <div class="container grid grid--2-cols services-list margin-bottom-md">
        <?php while ($row = mysqli_fetch_assoc($selectMyServiesRes)): ?>
          <?php $hrefNone = "./services.php?q=" . $row["Service_ID"] . "&provider=" . $row["PSID"]; ?>
          <?php include "../php/service/service.php" ?>
        <?php endwhile; ?>
      </div>

      <div class="container flex-center">
        <a href="./add-provider-service.php" class="button">
          <i class="fa-regular fa-square-plus"></i>
          <p>Add services</p>
        </a>
      </div>
    </section>

    <section class="section edit-section">

      <div class="grid grid--2-cols">

        <div class="left">

          <div class="form">
            <div class="form-heading">
              <span class="subheading">Profile</span>

              <h2 class="heading-secondary">
                Edit Your <span>Profile</span>
              </h2>

            </div>

            <form class="form" id="contactForm" method="POST">
              <div class="form-row">
                <label for="name" class="form-paragraph">Name</label>
                <input type="text" id="name" name="name" class="input-text" placeholder="Amer" required
                  value=<?= $profile["First_Name"] ?> />
              </div>

              <div class="form-row">
                <label for="surname" class="form-paragraph">Surname</label>
                <input type="text" id="surname" name="surname" class="input-text" placeholder="Hadžikadić" required
                  value=<?= $profile["Last_Name"] ?> />
              </div>

              <div class="form-row">
                <label for="email" class="form-paragraph">Email</label>
                <input type="email" id="email" name="email" class="input-text" placeholder="amer@hadzikadic.com"
                  required value=<?= $profile["Email"] ?> />
              </div>

              <div class="form-row">
                <label for="telephone" class="form-paragraph">Telephone</label>
                <input type="phone" id="telephone" name="telephone" class="input-text" placeholder="+387 62 842 009"
                  required value=<?= $profile["DOB"] ?> />
              </div>

              <div class="form-row">
                <label for="dateOfBirth" class="form-paragraph">Date of Birth</label>
                <input type="date" id="dateOfBirth" name="dateOfBirth" class="input-text" placeholder="04/09/1976"
                  required value=<?= $profile["DOB"] ?> />
              </div>

              <div class="form-block">
                <div class="form-row">
                  <label for="currentPassword" class="form-paragraph">Current Password</label>
                  <input type="password" id="currentPassword" name="currentPassword" class="input-text" required />
                </div>
                <div class="form-row">
                  <label for="password" class="form-paragraph">Password</label>
                  <input type="password" id="password" name="password" class="input-text" required />
                </div>
              </div>

              <button type="submit" class="button">EDIT</button>
            </form>
            <!-- Form ends here -->
          </div>
        </div>

        <div class="right-picture">
          <img class="background-img-part" src="../assets/form-flowers.jpg" alt="flowers" />
          <div class="hue" aria-label="background"></div>
        </div>

      </div>
    </section>

    <section class="section collaborations-likes-buttons-section">
      <div class="big-container grid grid--2-cols big-buttons">
        <a href="./collaborations.php" class="big-button collaborations-big-button">
          <span> Check Your Collaborations</span>
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

  <script src="../js/script.js"></script>
</body>

</html>