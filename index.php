<?php session_start(); ?>

<?php
$indexPath = "./";
$logoPath = "./assets/inwousluga-logo.svg";
$addServicePath = "./public/add-provider-service.php";
$likedServicePath = "./public/liked-service.php";
$collaborationsPath = "./public/collaborations.php";
$profilePath = "./public/profile.php";
$loginPath = "./public/login.php";
$servicePath = "./public/services.php";
$logoutPath = "./php/logout.php";
$php = "./php/db.php";
?>

<?php

include "./php/db.php";


$allCategories = mysqli_query($db, "select * from category");
$allCategoriesTwo = mysqli_query($db, "select * from category");

$categoryID = isset($_GET["q"]) ? $_GET["q"] : false;

$categoryID && $categoryServies = mysqli_query($db, "SELECT * FROM service WHERE Category_ID = " . $categoryID);

if ($_POST) {
  $seachParam = $_POST["search"];
  if (!isset($seachParam) || $seachParam == "") {
    header("Location: ./");
    return;
  }

  $inputedCategory = mysqli_real_escape_string($db, $seachParam);

  $query = "SELECT * FROM category WHERE Category_Type LIKE '%" . $inputedCategory . "%'";

  $response = mysqli_query($db, $query);

  $data = mysqli_fetch_assoc($response);

  if ($data["CID"])
    header("Location: ./?q=" . $data["CID"]);

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Categories - Choose Service Category</title>

  <link rel="stylesheet" href="./php/header/header.css" />

  <link rel="stylesheet" href="./styles/general.css" />

  <link rel="stylesheet" href="./styles/style.css" />

  <link rel="stylesheet" href="./styles/picker.css" />

  <link rel="stylesheet" href="./php/category/category.css" />

  <link rel="stylesheet" href="./php/service/service.css" />

  <link rel="stylesheet" href="./php/service-row/service-row.css" />

  <link rel="stylesheet" href="./php/site-header/site-header.css" />

  <link rel="stylesheet" href="./php/footer/footer.css" />

  <link rel="stylesheet" href="./styles/media.css" />


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

  <?php require_once 'php/header/header.php' ?>

  <main>

    <section class="section category-section">

      <?php include "./php/site-header/site-header.php" ?>


      <div class="container margin-bottom-xsm">
        <h1 class="heading-primary">Choose Service</h1>
      </div>

      <div class="container wrapper margin-bottom-sm">
        <div class="tab-icon">
          <i id="left" class="fa-solid fa-arrow-left"></i>
        </div>
        <ul class="tabs-box">
          <?php while ($rows = mysqli_fetch_assoc($allCategoriesTwo)): ?>
            <a href=<?= "./?q=" . $rows["CID"] ?>>
              <li class="<?= "tab " . ($rows['CID'] == $categoryID ? ' active' : '') ?>">
                <?= $rows["Category_Type"] ?>
              </li>
            </a>
          <?php endwhile; ?>
        </ul>
        <div class="tab-icon">
          <!-- <i id="right" class="fa-solid fa-angle-right"></i> -->
          <i id="right" class="fa-solid fa-arrow-right"></i>
        </div>
      </div>

      <div class="container margin-bottom-md">
        <form class="form-search" method="POST" id="search-form">
          <input type="text" placeholder="Type the category you want" class="search" name="search" id="search" />
          <button type="submit" class="search-button">
            <i class="fa-solid fa-magnifying-glass search-icon"></i>
          </button>
        </form>
      </div>

      <div class="container grid grid--3-cols categories-list">
        <?php
        if (!isset($_GET["q"]))
          while ($row = mysqli_fetch_assoc($allCategories))
            include "php/category/category.php";
        else {
          $row = mysqli_fetch_assoc(mysqli_query($db, "select * from category where CID = " . $categoryID));
          $categoryActive = "span-whole-grid";

          include "php/category/category.php";

          while ($service = mysqli_fetch_assoc($categoryServies)) {
            $path = $servicePath . '?q=' . $service["SID"];
            include "./php/service-row/service-row.php";
          }
          ;
        }
        ?>
      </div>


    </section>

  </main>

  <?php require_once './php/footer/footer.php' ?>

  <script src="js/script.js"></script>
</body>

</html>